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
        "<div class='alert alert-danger'>Unauthorized access.</div>";

    header("Location: ../auth/login.php");
    exit;
}

$tenant_id = $_SESSION['user_id'];

// ================= FETCH RESERVATIONS =================
$stmt = $conn->prepare("
    SELECT 
        r.*,

        l.house_name,

        u.name  AS renter_name,
        u.phone AS renter_phone,

        p.reference_no,
        p.status AS payment_status

    FROM reservations r

    JOIN listings l
        ON r.listing_id = l.id

    JOIN users u
        ON r.renter_id = u.id

    LEFT JOIN payments p
        ON p.reservation_id = r.id

    WHERE l.tenant_id = ?

    ORDER BY r.created_at DESC
");

$stmt->bind_param("i", $tenant_id);
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

    <!-- Navbar -->
    <?php include __DIR__ . '/../includes/nav.php'; ?>

    <!-- Sidebar -->
    <?php include __DIR__ . '/sidebar.php'; ?>

    <div class="main-content mt-5">

        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <h1 class="dashboard-title">Reservations</h1>
            <p class="dashboard-subtitle">
                Manage booking requests from renters
            </p>
        </div>

        <div class="container">

            <?= $message ?>

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-dark">
                        <tr>
                            <th>Property</th>
                            <th>Renter</th>
                            <th>Phone</th>
                            <th>Dates</th>
                            <th>Total</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if ($result->num_rows > 0): ?>

                            <?php while ($row = $result->fetch_assoc()): ?>

                                <?php
                                $status = $row['status'];

                                $payment_status =
                                    $row['payment_status'] ?? 'pending';

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

                                if ($payment_status === 'refunded') {
                                    $badge = "success";
                                }
                                ?>

                                <tr>

                                    <!-- PROPERTY -->
                                    <td>
                                        <?= htmlspecialchars($row['house_name']) ?>
                                    </td>

                                    <!-- RENTER -->
                                    <td>
                                        <?= htmlspecialchars($row['renter_name']) ?>
                                    </td>

                                    <!-- PHONE -->
                                    <td>
                                        <?= htmlspecialchars($row['renter_phone']) ?>
                                    </td>

                                    <!-- DATES -->
                                    <td>
                                        <?= $row['check_in_date'] ?>
                                        →
                                        <?= $row['check_out_date'] ?>
                                    </td>

                                    <!-- TOTAL -->
                                    <td class="fw-bold text-success">
                                        ₱<?= number_format($row['total_price'], 2) ?>
                                    </td>

                                    <!-- PAYMENT -->
                                    <td>

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-info"
                                            data-bs-toggle="modal"
                                            data-bs-target="#proofModal<?= $row['id'] ?>">

                                            View Proof

                                        </button>

                                    </td>

                                    <!-- STATUS -->
                           
                                    <td>

                                        <span class="badge bg-<?= $badge ?>">
                                            <?= ucfirst($status) ?>
                                        </span>

                                        <!-- RENTER CANCELLATION NOTE -->
                                        <?php if (
                                            $status === 'cancelled' &&
                                            !empty($row['rejected_reason'])
                                        ): ?>

                                            <div class="alert alert-warning mt-2 mb-0">

                                                <strong>
                                                    Renter Cancellation Note:
                                                </strong>

                                                <hr>

                                                <?= nl2br(htmlspecialchars($row['rejected_reason'])) ?>

                                            </div>

                                        <?php endif; ?>

                                        <!-- TENANT REFUND NOTE -->
                                        <?php if (
                                            $status === 'refunded' &&
                                            !empty($row['refund_note'])
                                        ): ?>

                                            <div class="alert alert-success mt-2 mb-0">

                                                <strong>
                                                    Refund Note:
                                                </strong>

                                                <hr>

                                                <?= nl2br(htmlspecialchars($row['refund_note'])) ?>

                                            </div>

                                        <?php endif; ?>

                                    </td>

                                    <!-- MESSAGE COLUMN -->
                                    <td style="min-width: 150px;">

                                        <?php if (!empty($row['message'])): ?>

                                            <div class="small">

                                                <?= nl2br(htmlspecialchars($row['message'])) ?>

                                            </div>

                                        <?php else: ?>

                                            <span class="text-muted">
                                                No message
                                            </span>

                                        <?php endif; ?>

                                    </td>

                                    <!-- ACTION -->
                                    <td>

                                        <?php if ($status === 'pending'): ?>

                                            <!-- ACCEPT -->
                                            <a
                                                href="update_reservation.php?id=<?= $row['id'] ?>&status=approved"
                                                class="btn btn-success btn-sm">

                                                Accept

                                            </a>

                                        <!-- REJECT / REFUND -->
                                        <button class="btn btn-danger btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#refundModal<?= $row['id'] ?>">

                                            Reject & Refund

                                        </button>

                                        <?php endif; ?>

                                        <?php if ($status === 'cancelled'): ?>

                                            <?php if ($payment_status !== 'refunded'): ?>

                                                <button
                                                    class="btn btn-primary btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#refundModal<?= $row['id'] ?>">

                                                    Refund

                                                </button>

                                            <?php endif; ?>

                                        <?php endif; ?>

                                        <?php include __DIR__ . '/../modals/refund_modal.php'; ?>

                                        <?php include __DIR__ . '/../modals/proof_modal.php'; ?>

                                    </td>

                                </tr>

                            <?php endwhile; ?>

                        <?php else: ?>

                            <tr>

                                <td colspan="8" class="text-center">

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