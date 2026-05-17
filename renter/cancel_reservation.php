<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once __DIR__ . '/../config/setup.php';

// ================= VALIDATE =================
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit;
}

$reservation_id = (int) $_GET['id'];
$renter_id      = $_SESSION['user_id'];

$cancel_reason = trim($_POST['cancel_reason']);

// ================= UPDATE =================
$stmt = $conn->prepare("
    UPDATE reservations
    SET
        status = 'cancelled',
        rejected_reason = ?
    WHERE id = ?
    AND renter_id = ?
");

$stmt->bind_param(
    "sii",
    $cancel_reason,
    $reservation_id,
    $renter_id
);

$stmt->execute();

// ================= SUCCESS =================
$_SESSION['flash_message'] =
"<div class='alert alert-success'>
    Reservation cancelled successfully.
</div>";

header("Location: my_reservations.php");
exit;
?>