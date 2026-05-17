<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once __DIR__ . '/../config/setup.php';

// ================= ACCESS CONTROL =================
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'renter') {
    $_SESSION['flash_message'] = "<div class='alert alert-danger'>Unauthorized access.</div>";
    header("Location: ../auth/login.php");
    exit;
}

// ================= FETCH DATA =================
$renter_id = $_SESSION['user_id'];

$stmt = $conn->prepare("
    SELECT r.*, l.house_name 
    FROM reservations r
    JOIN listings l ON r.listing_id = l.id
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

    <!-- Sidebar Navigation -->
    <?php include __DIR__ . '/sidebar.php' ?>

    <div class="main-content mt-4">

        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <h1 class="dashboard-title">Renter Dashboard</h1>
            <p class="dashboard-subtitle">Track your bookings, reservations, and payments</p>
        </div>

        <div class="container mt-4">

            <?= $message ?>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-dark">
                        <tr>
                            <th>Property</th>
                            <th>Check-in</th>
                            <th>Check-out</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Message</th>
                            <th>Rejected Reason</th>
                            <th>Date Requested</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if ($result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>

                                <?php
                                // Status Badge
                                $status = $row['status'];
                                $badge = "secondary";

                                if ($status === 'pending') $badge = "warning";
                                if ($status === 'approved') $badge = "success";
                                if ($status === 'rejected') $badge = "danger";
                                ?>

                                <tr>
                                    <td><?= htmlspecialchars($row['house_name']) ?></td>
                                    <td><?= $row['check_in_date'] ?></td>
                                    <td><?= $row['check_out_date'] ?></td>

                                    <td class="fw-bold text-success">
                                        ₱<?= number_format($row['total_price'], 2) ?>
                                    </td>

                                    <td>
                                        <span class="badge bg-<?= $badge ?>">
                                            <?= ucfirst($status) ?>
                                        </span>
                                    </td>

                                    <td><?= htmlspecialchars($row['message']) ?></td>

                                    <td>
                                        <?= $row['rejected_reason'] ? htmlspecialchars($row['rejected_reason']) : '-' ?>
                                    </td>

                                    <td><?= $row['created_at'] ?></td>
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