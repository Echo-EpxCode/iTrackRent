<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ================= DATABASE =================
include_once __DIR__ . '/../config/setup.php';

// ================= ACCESS CONTROL =================
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'renter') {
    $_SESSION['flash_message'] = "<div class='alert alert-danger'>Unauthorized access.</div>";
    header("Location: ../auth/login.php");
    exit;
}

// ================= FETCH LISTINGS =================
$stmt = $conn->prepare("
    SELECT * FROM listings 
    WHERE status = 'available'
    ORDER BY id DESC
");

$stmt->execute();
$result = $stmt->get_result();

// ================= FLASH MESSAGE =================
$message = "";
if (isset($_SESSION['flash_message'])) {
    $message = $_SESSION['flash_message'];
    unset($_SESSION['flash_message']);
}
?>

<?php include __DIR__ . '/../includes/header.php' ?>

<body>
    <!-- Top Navbar -->
    <?php include __DIR__ . '/../includes/nav.php' ?>

    <!-- Sidebar Navigation -->
    <?php include __DIR__ . '/sidebar.php' ?>

    <!-- Main Content -->
    <div class="main-content mt-4">

        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <h1 class="dashboard-title">Browse Properties</h1>
            <p class="dashboard-subtitle">Explore available rooms, boarding houses, and rentals</p>
        </div>

        <div class="rooms-grid mt-4">

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