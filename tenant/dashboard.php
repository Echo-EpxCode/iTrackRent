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

// ================= FETCH LISTINGS =================
$stmt = $conn->prepare("SELECT * FROM listings WHERE tenant_id = ? ORDER BY id DESC");
$stmt->bind_param("i", $tenant_id);
$stmt->execute();
$result = $stmt->get_result();


?>

<?php include __DIR__ . '/../includes/header.php' ?>

<body>
    <!-- Top Navbar -->
    <?php include __DIR__ . '/../includes/nav.php' ?>

    <!-- Sidebar Navigation -->
    <?php include __DIR__ . '/sidebar.php' ?>

    <!-- Main Content -->
    <div class="main-content mt-5">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <h1 class="dashboard-title">Tenant Dashboard</h1>
            <p class="dashboard-subtitle">Manage your property listings and booking requests</p>
        </div>

        <div class="rooms-grid">

            <?php while ($row = $result->fetch_assoc()): ?>

                <?php
                $priceLabel = ($row['payment_type'] === 'monthly') ? 'month' : 'night';
                $imagePath = "../uploads/covers/" . $row['cover_photo'];
                ?>

                <div class="room-card">

                    <!-- CLICKABLE CARD -->
                    <a class="nav-link p-0" href="view_listing.php?id=<?= $row['id'] ?>">

                        <!-- COVER PHOTO -->
                        <img src="<?= $imagePath ?>" class="room-image" alt="Cover">

                        <div class="room-content">

                            <!-- TITLE -->
                            <h3 class="room-title">
                                <?= htmlspecialchars($row['house_name']) ?>
                            </h3>

                            <!-- PRICE -->
                            <div class="room-price">
                                ₱<?= number_format($row['price'], 2) ?>/<?= ($row['payment_type'] === 'monthly') ? 'month' : 'night' ?>
                            </div>

                            <!-- TYPE -->
                            <div class="room-type">
                                <?= ucwords(str_replace('_', ' ', $row['property_type'])) ?>
                                • <?= ucfirst($row['status']) ?>
                            </div>

                        </div>

                    </a>

                </div>

            <?php endwhile; ?>

            <?php if ($result->num_rows === 0): ?>
                <div class="col-12">
                    <div class="alert alert-info">No listings found.</div>
                </div>
            <?php endif; ?>

        </div>
    </div>


    <?php include __DIR__ . '/../includes/footer.php' ?>