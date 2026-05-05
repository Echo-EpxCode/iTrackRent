<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once __DIR__ . '/../config/setup.php';

// ================= GET ID =================
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    die("Invalid listing ID");
}

// ================= FETCH LISTING =================
$stmt = $conn->prepare("SELECT * FROM listings WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

$listing = $result->fetch_assoc();

if (!$listing) {
    die("Listing not found");
}

// ================= FETCH IMAGES =================
$stmt_img = $conn->prepare("SELECT * FROM listing_photos WHERE listing_id = ?");
$stmt_img->bind_param("i", $id);
$stmt_img->execute();
$images = $stmt_img->get_result()->fetch_all(MYSQLI_ASSOC);

// fallback if less than 2 images
while (count($images) < 2) {
    $images[] = ['image_path' => $listing['cover_photo']];
}

// payment label
$priceLabel = $listing['payment_type'] === 'monthly' ? 'month' : 'night';
?>

<?php include __DIR__ . '/../includes/header.php' ?>

<body>
    <!-- Top Navbar -->
    <?php include __DIR__ . '/../includes/nav.php' ?>

    <!-- Sidebar Navigation -->
    <?php include __DIR__ . '/sidebar.php' ?>

    <!-- Main Content -->
    <div class="main-content mt-5">
        <!-- PUT THE CONTENT HERE -->
        <!-- Property Hero -->
        <section class="py-5 bg-light" style="padding-top: 100px;">
            <div class="container">

                <!-- TITLE -->
                <div class="row justify-content-center text-center mb-2">
                    <div class="col-lg-8">
                        <h1 class="display-5 fw-bold text-danger mb-4">
                            <?= htmlspecialchars($listing['house_name']) ?>
                        </h1>
                    </div>
                </div>

                <div class="row align-items-center">

                    <!-- IMAGES -->
                    <div class="col-md-6 mb-4 mb-md-0">
                        <div class="row g-2 h-100">
                            <div class="col-md-8 mb-4 mb-md-0">
                                <div class="row g-2 h-100">

                                    <?php
                                    $count = 0;
                                    foreach ($images as $img):
                                        if ($count >= 4) break; // limit display to 4 images
                                    ?>

                                        <div class="col-6">
                                            <div class="overflow-hidden rounded-4 shadow h-100" style="height: 300px;">
                                                <img src="../uploads/listings/<?= htmlspecialchars($img['image_path']) ?>"
                                                    class="img-fluid w-100 h-100"
                                                    style="object-fit: cover;">
                                            </div>
                                        </div>

                                    <?php
                                        $count++;
                                    endforeach;
                                    ?>

                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- DETAILS -->
                    <div class="col-md-6">
                        <div class="property-card h-100 p-4">

                            <h2 class="display-5 fw-bold mb-3">Details</h2>

                            <div class="d-flex align-items-center mb-4">
                                <h3 class="text-success mb-0 me-3">
                                    ₱<?= number_format($listing['price'], 2) ?>
                                    <span class="fs-5">/<?= $priceLabel ?></span>
                                </h3>

                                <span class="badge bg-success fs-6">Available</span>
                            </div>

                            <ul class="feature-list">
                                <li><i class="fas fa-home text-primary me-2"></i><?= ucfirst($listing['property_type']) ?></li>
                                <li><i class="fas fa-map-marker-alt text-primary me-2"></i>Google Map Location</li>
                                <li><i class="fas fa-calendar text-primary me-2"></i><?= ucfirst($listing['payment_type']) ?> Payment</li>
                            </ul>

                            <p class="mt-4 lead">
                                <?= nl2br(htmlspecialchars($listing['description'])) ?>
                            </p>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-start mt-4">

                                <a href="location_details.php?id=<?= $listing['id'] ?>" class="btn btn-success btn-lg">
                                    <i class="fas fa-map-marker-alt me-2"></i>View Location
                                </a>


                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </div>


    <?php include __DIR__ . '/../includes/footer.php' ?>