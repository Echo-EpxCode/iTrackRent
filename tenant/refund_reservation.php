<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once __DIR__ . '/../config/setup.php';

// ================= ACCESS CONTROL =================
if (
    !isset($_SESSION['user_id']) ||
    $_SESSION['user_role'] !== 'tenant'
) {
    $_SESSION['flash_message'] =
        "<div class='alert alert-danger'>
            Unauthorized access.
        </div>";

    header("Location: ../auth/login.php");
    exit;
}

// ================= VALIDATION =================
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit;
}

if (
    !isset($_GET['id']) ||
    !is_numeric($_GET['id'])
) {
    exit;
}

$reservation_id = (int) $_GET['id'];
$tenant_id      = $_SESSION['user_id'];

// ================= INPUT =================
$refund_reference = trim($_POST['refund_reference']);
$refund_note      = trim($_POST['refund_note']);

// ================= VALIDATION =================
if (
    empty($refund_reference) ||
    empty($refund_note)
) {

    $_SESSION['flash_message'] =
        "<div class='alert alert-danger'>
            All refund fields are required.
        </div>";

    header("Location: reservations.php");
    exit;
}

// ================= VERIFY OWNERSHIP =================
$stmtCheck = $conn->prepare("
    SELECT r.id
    FROM reservations r
    JOIN listings l ON r.listing_id = l.id
    WHERE r.id = ?
    AND l.tenant_id = ?
    AND r.status IN ('pending', 'cancelled')
");

$stmtCheck->bind_param(
    "ii",
    $reservation_id,
    $tenant_id
);

$stmtCheck->execute();

$checkResult = $stmtCheck->get_result();

if ($checkResult->num_rows === 0) {

    $_SESSION['flash_message'] =
        "<div class='alert alert-danger'>
            Invalid reservation.
        </div>";

    header("Location: reservations.php");
    exit;
}

// ================= UPLOAD REFUND PROOF =================
$refundProofName = null;

if (
    isset($_FILES['refund_proof']) &&
    $_FILES['refund_proof']['error'] === 0
) {

    $refundDir = __DIR__ . '/../uploads/refunds/';

    // CREATE DIRECTORY
    if (!is_dir($refundDir)) {
        mkdir($refundDir, 0777, true);
    }

    // FILE EXTENSION
    $ext = strtolower(
        pathinfo(
            $_FILES['refund_proof']['name'],
            PATHINFO_EXTENSION
        )
    );

    // ALLOWED FILES
    $allowed = ['jpg', 'jpeg', 'png', 'webp'];

    if (!in_array($ext, $allowed)) {

        $_SESSION['flash_message'] =
            "<div class='alert alert-danger'>
                Invalid image format.
            </div>";

        header("Location: reservations.php");
        exit;
    }

    // GENERATE UNIQUE FILE NAME
    $refundProofName =
        uniqid('refund_', true) . '.' . $ext;

    // MOVE FILE
    move_uploaded_file(
        $_FILES['refund_proof']['tmp_name'],
        $refundDir . $refundProofName
    );
}

// ================= UPDATE PAYMENTS TABLE =================
$stmtPayment = $conn->prepare("
    UPDATE payments
    SET
        status = 'refunded',
        reference_no = ?
    WHERE reservation_id = ?
");

$stmtPayment->bind_param(
    "si",
    $refund_reference,
    $reservation_id
);

$stmtPayment->execute();

// ================= UPDATE RESERVATIONS TABLE =================
$stmtReservation = $conn->prepare("
    UPDATE reservations
    SET
        status = 'refunded',
        payment_status = 'refunded',
        proof_image = ?,
        refund_note = ?
    WHERE id = ?
");

$stmtReservation->bind_param(
    "ssi",
    $refundProofName,
    $refund_note,
    $reservation_id
);

$stmtReservation->execute();

// ================= SUCCESS =================
$_SESSION['flash_message'] =
    "<div class='alert alert-success'>
        Refund processed successfully.
    </div>";

header("Location: reservations.php");
exit;
?>