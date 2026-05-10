<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ================= DATABASE =================
include_once __DIR__ . '/../config/setup.php';

// ================= ACCESS CONTROL =================
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'tenant') {
    exit;
}

// ================= VALIDATE =================
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    exit;
}

$listing_id = (int) $_GET['id'];
$tenant_id  = $_SESSION['user_id'];

// ================= INPUT =================
$house_name    = trim($_POST['house_name']);
$property_type = $_POST['property_type'];
$payment_type  = $_POST['payment_type'];
$price         = $_POST['price'];
$address       = trim($_POST['address']);
$description   = trim($_POST['description']);
$map_link      = trim($_POST['map_link']);

// ================= EXTRACT MAP SRC =================
preg_match('/src="([^"]+)"/', $map_link, $matches);

if (isset($matches[1])) {
    $map_link = $matches[1];
}

// ================= FETCH OLD PHOTO =================
$stmt_old = $conn->prepare("
    SELECT cover_photo 
    FROM listings 
    WHERE id = ? AND tenant_id = ?
");

$stmt_old->bind_param("ii", $listing_id, $tenant_id);
$stmt_old->execute();

$old = $stmt_old->get_result()->fetch_assoc();

$cover_photo = $old['cover_photo'];

// ================= REPLACE COVER =================
if (
    isset($_FILES['cover_photo']) &&
    $_FILES['cover_photo']['error'] === 0
) {

    $coverDir = __DIR__ . '/../uploads/covers/';

    $ext = pathinfo($_FILES['cover_photo']['name'], PATHINFO_EXTENSION);

    $newName = uniqid('cover_') . '.' . $ext;

    move_uploaded_file(
        $_FILES['cover_photo']['tmp_name'],
        $coverDir . $newName
    );

    // DELETE OLD
    if (file_exists($coverDir . $cover_photo)) {
        unlink($coverDir . $cover_photo);
    }

    $cover_photo = $newName;
}

// ================= UPDATE =================
$stmt = $conn->prepare("
    UPDATE listings
    SET
        house_name = ?,
        property_type = ?,
        payment_type = ?,
        price = ?,
        address = ?,
        description = ?,
        map_link = ?,
        cover_photo = ?
    WHERE id = ? AND tenant_id = ?
");

$stmt->bind_param(
    "sssissssii",
    $house_name,
    $property_type,
    $payment_type,
    $price,
    $address,
    $description,
    $map_link,
    $cover_photo,
    $listing_id,
    $tenant_id
);

$stmt->execute();

// ================= SUCCESS =================
$_SESSION['flash_message'] =
"<div class='alert alert-success'>
    Listing updated successfully.
</div>";

header("Location: view_listing.php?id=" . $listing_id);
exit;
?>