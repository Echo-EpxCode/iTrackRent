<?php
session_start();
// ================= DATABASE CONNECTION =================
include_once __DIR__ . '/../config/setup.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ================= ACCESS CHECK =================
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'tenant') {
    $_SESSION['flash_message'] = "<div class='alert alert-danger'>Unauthorized access.</div>";
    header("Location: ../auth/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: manage_listing.php");
    exit;
}

// ================= INPUT =================
$tenant_id = $_SESSION['user_id'];

$house_name    = trim($_POST['house_name']);
$address = trim($_POST['address']);
$property_type = $_POST['property_type'];
$payment_type  = $_POST['payment_type'];
$price         = $_POST['price'];
$description   = trim($_POST['description']);

// ================= GOOGLE MAP CLEANING =================
$map_link_raw = trim($_POST['map_link']);
$map_link = "";

if (!empty($map_link_raw)) {

    libxml_use_internal_errors(true);

    $doc = new DOMDocument();
    $doc->loadHTML($map_link_raw);

    $iframes = $doc->getElementsByTagName('iframe');

    if ($iframes->length > 0) {
        $map_link = $iframes->item(0)->getAttribute('src');
    } else {
        $map_link = $map_link_raw;
    }

    libxml_clear_errors();
}

// ================= VALIDATION =================
if (
    empty($house_name) ||
    empty($address) ||
    empty($property_type) ||
    empty($payment_type) ||
    empty($price) ||
    empty($description) ||
    empty($map_link)
) {
    $_SESSION['flash_message'] = "<div class='alert alert-danger'>All fields are required.</div>";
    header("Location: manage_listing.php");
    exit;
}

// ================= COVER PHOTO UPLOAD =================
if (!isset($_FILES['cover_photo']) || $_FILES['cover_photo']['error'] !== 0) {
    $_SESSION['flash_message'] = "<div class='alert alert-danger'>Cover photo is required.</div>";
    header("Location: manage_listing.php");
    exit;
}


$coverDir = __DIR__ . '/../uploads/covers/';
if (!is_dir($coverDir)) mkdir($coverDir, 0777, true);

$coverExt = pathinfo($_FILES['cover_photo']['name'], PATHINFO_EXTENSION);
$coverName = uniqid("cover_") . "." . $coverExt;

move_uploaded_file(
    $_FILES['cover_photo']['tmp_name'],
    $coverDir . $coverName
);

// ================= INSERT LISTING =================
$stmt = $conn->prepare("
    INSERT INTO listings
    (tenant_id, house_name, address, property_type, payment_type, price, description, cover_photo, map_link)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
");

$stmt->bind_param(
    "issssdsss",
    $tenant_id,
    $house_name,
    $address,
    $property_type,
    $payment_type,
    $price,
    $description,
    $coverName,
    $map_link
);

$stmt->execute();

$listing_id = $stmt->insert_id;

// ================= GALLERY UPLOAD (MAX 5) =================
if (isset($_FILES['listing_photos'])) {

    $photos = $_FILES['listing_photos'];
    $count = min(count($photos['name']), 5);

    $photoDir = __DIR__ . '/../uploads/listings/';
    if (!is_dir($photoDir)) mkdir($photoDir, 0777, true);

    for ($i = 0; $i < $count; $i++) {

        if ($photos['error'][$i] === 0) {

            $ext = pathinfo($photos['name'][$i], PATHINFO_EXTENSION);
            $photoName = uniqid("img_") . "." . $ext;

            move_uploaded_file(
                $photos['tmp_name'][$i],
                $photoDir . $photoName
            );

            $stmt_img = $conn->prepare("
                INSERT INTO listing_photos (listing_id, image_path)
                VALUES (?, ?)
            ");

            $stmt_img->bind_param("is", $listing_id, $photoName);
            $stmt_img->execute();
        }
    }
}

// ================= SUCCESS =================
$_SESSION['flash_message'] = "<div class='alert alert-success'>Listing created successfully.</div>";

header("Location: manage_listing.php");
exit;
