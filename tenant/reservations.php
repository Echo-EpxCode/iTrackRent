<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once __DIR__ . '/../config/setup.php';

// ================= ACCESS CONTROL =================
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'tenant') {
    $_SESSION['flash_message'] = "<div class='alert alert-danger'>Unauthorized access.</div>";
    header("Location: ../auth/login.php");
    exit;
}

$tenant_id = $_SESSION['user_id'];

// ================= FETCH PENDING RESERVATIONS =================
$stmt = $conn->prepare("
    SELECT 
        r.*,
        l.house_name,
        u.name AS renter_name,
        u.phone AS renter_phone
    FROM reservations r
    JOIN listings l ON r.listing_id = l.id
    JOIN users u ON r.renter_id = u.id
    WHERE l.tenant_id = ?
    AND r.status = 'pending'
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
    <!-- Top Navbar -->
    <?php include __DIR__ . '/../includes/nav.php' ?>

    <!-- Sidebar Navigation -->
    <?php include __DIR__ . '/sidebar.php' ?>

    <div class="main-content mt-4">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <h1 class="dashboard-title">Reservations</h1>
            <p class="dashboard-subtitle">Manage booking requests from renters</p>
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
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php while ($row = $result->fetch_assoc()): ?>

                            <?php
                            include __DIR__ . '/../modals/proof_modal.php';
                            $status = $row['status'];
                            $badge = "secondary";

                            if ($status === 'pending') $badge = "warning";
                            if ($status === 'approved') $badge = "success";
                            if ($status === 'rejected') $badge = "danger";
                            ?>

                            <tr>
                                <td><?= htmlspecialchars($row['house_name']) ?></td>
                                <td><?= htmlspecialchars($row['renter_name']) ?></td>
                                <td><?= htmlspecialchars($row['renter_phone']) ?></td>

                                <td>
                                    <?= $row['check_in_date'] ?> → <?= $row['check_out_date'] ?>
                                </td>

                                <td class="fw-bold text-success">
                                    ₱<?= number_format($row['total_price'], 2) ?>
                                </td>

                                <td>
                                    <button type="button"
                                        class="btn btn-sm btn-info"
                                        data-bs-toggle="modal"
                                        data-bs-target="#proofModal<?= $row['id'] ?>">
                                        View Proof
                                    </button>
                                </td>

                                <td>
                                    <span class="badge bg-<?= $badge ?>">
                                        <?= ucfirst($status) ?>
                                    </span>
                                </td>

                                <td>

                                    <!-- ACCEPT -->
                                    <a href="update_reservation.php?id=<?= $row['id'] ?>&status=approved"
                                        class="btn btn-success btn-sm">
                                        Accept
                                    </a>

                                    <!-- REJECT -->
                                    <button class="btn btn-danger btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#rejectModal<?= $row['id'] ?>">
                                        Reject
                                    </button>

                                    <!-- REJECT MODAL -->
                                    <div class="modal fade" id="rejectModal<?= $row['id'] ?>" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <form action="update_reservation.php" method="POST">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Reject Booking</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <div class="modal-body">

                                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                        <input type="hidden" name="status" value="rejected">

                                                        <textarea name="rejected_reason"
                                                            class="form-control"
                                                            placeholder="Enter reason..."
                                                            required></textarea>

                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger w-100">
                                                            Confirm Reject
                                                        </button>
                                                    </div>

                                                </form>

                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>

                        <?php endwhile; ?>

                        <?php if ($result->num_rows === 0): ?>
                            <tr>
                                <td colspan="8" class="text-center">
                                    No reservations found.
                                </td>
                            </tr>
                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>
    </div>

    <?php include __DIR__ . '/../includes/footer.php'; ?>