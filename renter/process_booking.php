<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once __DIR__ . '/../config/setup.php';

// Access
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'renter') {
    $_SESSION['flash_message'] = "<div class='alert alert-danger'>Unauthorized access.</div>";
    header("Location: ../auth/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: browse.php");
    exit;
}

// Input
$renter_id  = $_SESSION['user_id'];
$listing_id = (int) $_POST['listing_id'];
$check_in   = $_POST['check_in_date'];
$check_out  = $_POST['check_out_date'];
$message    = trim($_POST['message']);

// Validation
if (empty($listing_id) || empty($check_in) || empty($check_out)) {
    $_SESSION['flash_message'] = "<div class='alert alert-danger'>All fields are required.</div>";
    header("Location: view_listing.php?id=" . $listing_id);
    exit;
}

if ($check_out <= $check_in) {
    $_SESSION['flash_message'] = "<div class='alert alert-danger'>Invalid date range.</div>";
    header("Location: view_listing.php?id=" . $listing_id);
    exit;
}

// Get listing info
$stmt = $conn->prepare("
    SELECT price, payment_type 
    FROM listings 
    WHERE id = ?
");
$stmt->bind_param("i", $listing_id);
$stmt->execute();
$res = $stmt->get_result();
$listing = $res->fetch_assoc();

if (!$listing) {
    $_SESSION['flash_message'] = "<div class='alert alert-danger'>Listing not found.</div>";
    header("Location: browse.php");
    exit;
}

// Compute total
$start = new DateTime($check_in);
$end   = new DateTime($check_out);
$days  = $start->diff($end)->days;

if ($days <= 0) {
    $_SESSION['flash_message'] = "<div class='alert alert-danger'>Invalid dates.</div>";
    header("Location: view_listing.php?id=" . $listing_id);
    exit;
}

$price = $listing['price'];

if ($listing['payment_type'] === 'monthly') {
    $total_price = ceil($days / 30) * $price;
} else {
    $total_price = $days * $price;
}

// ================= PAYMENT INPUT =================
$payment_reference = trim($_POST['payment_reference']);

// ================= VALIDATION =================
if (empty($payment_reference)) {
    $_SESSION['flash_message'] = "<div class='alert alert-danger'>Payment reference required.</div>";
    header("Location: view_listing.php?id=" . $listing_id);
    exit;
}

// ================= UPLOAD PAYMENT PROOF =================
if (!isset($_FILES['payment_proof']) || $_FILES['payment_proof']['error'] !== 0) {
    $_SESSION['flash_message'] = "<div class='alert alert-danger'>Payment proof is required.</div>";
    header("Location: view_listing.php?id=" . $listing_id);
    exit;
}

$proofDir = __DIR__ . '/../uploads/payments/';
if (!is_dir($proofDir)) mkdir($proofDir, 0777, true);

$ext = pathinfo($_FILES['payment_proof']['name'], PATHINFO_EXTENSION);
$proofName = uniqid("pay_") . "." . $ext;

move_uploaded_file(
    $_FILES['payment_proof']['tmp_name'],
    $proofDir . $proofName
);

// Insert
$stmt = $conn->prepare("
    INSERT INTO reservations
    (listing_id, renter_id, check_in_date, check_out_date, total_price, message, 
     payment_method, payment_reference, payment_proof, payment_status, status, created_at, updated_at)
    VALUES (?, ?, ?, ?, ?, ?, 'gcash', ?, ?, 'pending', 'pending', NOW(), NOW())
");

$stmt->bind_param(
    "iissdsss",
    $listing_id,
    $renter_id,
    $check_in,
    $check_out,
    $total_price,
    $message,
    $payment_reference,
    $proofName
);

$stmt->execute();

// Success
$_SESSION['flash_message'] = "<div class='alert alert-success'>Reservation submitted.</div>";
header("Location: my_reservations.php");
exit;
