<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ================= DATABASE =================
include_once __DIR__ . '/../config/setup.php';

// ================= ACCESS CONTROL =================
if (
    !isset($_SESSION['user_id']) ||
    $_SESSION['user_role'] !== 'renter'
) {
    $_SESSION['flash_message'] =
        "<div class='alert alert-danger'>Unauthorized access.</div>";

    header("Location: ../auth/login.php");
    exit;
}

// ================= FETCH DATA =================
$renter_id = $_SESSION['user_id'];

$stmt = $conn->prepare("
SELECT 
    r.*,
    l.house_name,

    p.reference_no,
    p.status AS payment_status,
    p.id AS payment_id

    FROM reservations r

    JOIN listings l
        ON r.listing_id = l.id

    LEFT JOIN payments p
        ON p.reservation_id = r.id

    WHERE r.renter_id = ?

    ORDER BY r.created_at DESC
");

$stmt->bind_param("i", $renter_id);

$stmt->execute();

$result = $stmt->get_result();

// ================= FLASH MESSAGE =================
$message = "";

if (isset($_SESSION['flash_message'])) {
    $message = $_SESSION['flash_message'];
    unset($_SESSION['flash_message']);
}
?>

<?php include __DIR__ . '/../includes/header.php'; ?>

<body>

    <!-- Top Navbar -->
    <?php include __DIR__ . '/../includes/nav.php'; ?>

    <!-- Sidebar -->
    <?php include __DIR__ . '/sidebar.php'; ?>

    <div class="main-content mt-4">

        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <h1 class="dashboard-title">My Reservations</h1>
            <p class="dashboard-subtitle">
                Track your bookings, reservations, and payments
            </p>
        </div>

        <div class="container-fluid px-4 mt-4">

            <?= $message ?>

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle table-lg">

                    <thead class="table-dark">
                        <tr>
                            <th>Property</th>
                            <th>Check-in</th>
                            <th>Check-out</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Message</th>
                            <th>Refund / Rejection Details</th>
                            <th>Actions</th>
                            <th>Date Requested</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if ($result->num_rows > 0): ?>

                            <?php while ($row = $result->fetch_assoc()): ?>

                                <?php
                                $status = $row['status'];

                                $badge = "secondary";

                                if ($status === 'pending') {
                                    $badge = "warning";
                                }

                                if ($status === 'approved') {
                                    $badge = "success";
                                }

                                if ($status === 'rejected') {
                                    $badge = "danger";
                                }

                                if ($status === 'cancelled') {
                                    $badge = "secondary";
                                }

                                if ($status === 'refunded') {
                                    $badge = "success";
                                }

                                if ($status === 'completed') {
                                    $badge = "primary";
                                }
                                ?>

                                <tr>

                                    <!-- PROPERTY -->
                                    <td>
                                        <?= htmlspecialchars($row['house_name']) ?>
                                    </td>

                                    <!-- CHECK-IN -->
                                    <td>
                                        <?= $row['check_in_date'] ?>
                                    </td>

                                    <!-- CHECK-OUT -->
                                    <td>
                                        <?= $row['check_out_date'] ?>
                                    </td>

                                    <!-- TOTAL -->
                                    <td class="fw-bold text-success">
                                        ₱<?= number_format($row['total_price'], 2) ?>
                                    </td>

                                    <!-- STATUS -->
                                    <td>

                                        <span class="badge bg-<?= $badge ?>">
                                            <?= ucfirst($status) ?>
                                        </span>

                                        <?php if ($status === 'cancelled'): ?>

                                            <div class="alert alert-warning mt-2 p-2 small">
                                                Waiting for tenant refund.
                                            </div>

                                        <?php endif; ?>

                                    </td>

                                    <!-- MESSAGE -->
                                    <td>
                                        <?= htmlspecialchars($row['message']) ?>
                                    </td>

                                    <!-- REFUND / REJECTION -->
                                    <td>

                                        <!-- REJECTED BY TENANT -->
                                        <?php if ($row['status'] === 'rejected'): ?>

                                            <div class="alert alert-danger mb-2">

                                                <strong>
                                                    Reject Message:
                                                </strong>

                                                <hr>

                                                <?= nl2br(htmlspecialchars($row['rejected_reason'])) ?>

                                            </div>

                                        <!-- CANCELLED BY RENTER -->
                                        <?php elseif ($row['status'] === 'cancelled'): ?>

                                            <div class="alert alert-warning mb-2">

                                                <strong>
                                                    Cancel Message:
                                                </strong>

                                                <hr>

                                                <?= nl2br(htmlspecialchars($row['rejected_reason'])) ?>

                                            </div>

                                        <!-- REFUNDED BY TENANT -->
                                        <?php elseif ($row['status'] === 'refunded'): ?>

                                            <div class="alert alert-success mb-2">

                                                <strong>
                                                    Refund Message:
                                                </strong>

                                                <hr>

                                               <?= nl2br(htmlspecialchars($row['refund_note'])) ?>

                                            </div>

                                            <?php if (!empty($row['reference_no'])): ?>

                                                <div class="mb-2">

                                                    <strong>
                                                        Refund Reference:
                                                    </strong>

                                                    <br>

                                                    <?= htmlspecialchars($row['reference_no']) ?>

                                                </div>

                                            <?php endif; ?>

                                            <?php if (!empty($row['proof_image'])): ?>

                                                <button class="btn btn-outline-primary btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#refundProofModal<?= $row['id'] ?>">

                                                    View Refund Proof

                                                </button>

                                            <?php else: ?>

                                                <div class="text-muted">
                                                    No refund proof uploaded.
                                                </div>

                                            <?php endif; ?>

                                        <?php else: ?>

                                            -

                                        <?php endif; ?>

                                    </td>

                                    <!-- ACTIONS -->
                                    <td>

                                        <?php if ($status === 'pending'): ?>

                                            <button
                                                class="btn btn-danger btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#cancelModal<?= $row['id'] ?>">

                                                <i class="fa-solid fa-xmark me-1"></i>
                                                Cancel Booking

                                            </button>

                                        <?php else: ?>

                                            <span class="text-muted small">
                                                No Actions
                                            </span>

                                        <?php endif; ?>

                                    </td>

                                    <!-- CREATED -->
                                    <td>
                                        <?= $row['created_at'] ?>
                                    </td>

                                </tr>

                                <!-- REFUND PROOF MODAL -->
                                <?php include __DIR__ . '/../modals/renter_refund.php'; ?>

                                <!-- CANCEL MODAL -->
                                <?php include __DIR__ . '/../modals/cancel_modal.php'; ?>

                            <?php endwhile; ?>

                        <?php else: ?>

                            <tr>

                                <td colspan="9" class="text-center">

                                    <div class="alert alert-info m-0">
                                        No reservations found.
                                    </div>

                                </td>

                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <?php include __DIR__ . '/../includes/footer.php'; ?>

</body>
</html>