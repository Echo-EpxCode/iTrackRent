<?php
include_once __DIR__ . '/../config/setup.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'tenant') {
    header("Location: ../auth/login.php");
    exit;
}

$id = (int) $_REQUEST['id'];
$status = $_REQUEST['status'];

$reason = isset($_POST['rejected_reason']) ? trim($_POST['rejected_reason']) : null;

if ($status === 'approved') {

    $stmt = $conn->prepare("
        UPDATE reservations 
        SET status = 'approved'
        WHERE id = ?
    ");

    $stmt->bind_param("i", $id);
    $stmt->execute();
} elseif ($status === 'rejected') {

    $stmt = $conn->prepare("
        UPDATE reservations 
        SET status = 'rejected', rejected_reason = ?
        WHERE id = ?
    ");

    $stmt->bind_param("si", $reason, $id);
    $stmt->execute();
}

$_SESSION['flash_message'] = "<div class='alert alert-success'>Reservation updated.</div>";

header("Location: reservations.php");
exit;
