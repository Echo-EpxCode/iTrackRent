<?php

session_start();
// ================= ACCESS CONTROL =================
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'tenant') {
    $_SESSION['flash_message'] = "<div class='alert alert-danger'>Unauthorized access.</div>";
    header("Location: ../auth/login.php");
    exit;
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

// fallback map link
$mapLink = $listing['map_link'];
?>

<?php include __DIR__ . '/../includes/header.php' ?>

<body>
    <!-- Top Navbar -->
    <?php include __DIR__ . '/../includes/nav.php' ?>

    <!-- Sidebar Navigation -->
    <?php include __DIR__ . '/sidebar.php' ?>

    <!-- Main Content -->
    <div class="main-content mt-5">
        <!-- Main Content -->
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

                    <!-- MAP -->
                    <div class="col-lg-8">

                        <div class="rounded-4 shadow overflow-hidden">

                            <div class="ratio ratio-16x9">

                                <iframe
                                    src="<?= htmlspecialchars($mapLink) ?>"
                                    class="w-100 h-100 border-0"
                                    allowfullscreen
                                    loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade">
                                </iframe>

                            </div>

                        </div>

                    </div>

                    <!-- LOCATION DETAILS -->
                    <div class="col-lg-4">

                        <div class="h-100 p-4 border rounded-4 shadow-sm">

                            <!-- BACK -->
                            <a class="nav-link fw-bold mb-2"
                                href="view_listing.php?id=<?= $listing['id'] ?>">
                                <i class="fa-solid fa-angles-left"></i> Back
                            </a>

                            <!-- ADDRESS -->
                            <h3 class="text-success mb-4">
                                <i class="fas fa-map-pin me-2"></i>Address <br>
                                <p class="text-muted mb-1">
                                    <?= htmlspecialchars($listing['address']) ?>
                                </p>
                            </h3>

                            <address class="mb-4">
                                <?= nl2br(htmlspecialchars($listing['description'])) ?>
                            </address>

                            <!-- NEARBY (STATIC FOR NOW) -->
                            <h5 class="text-success mb-3">
                                <i class="fas fa-compass me-2"></i>Nearby
                            </h5>

                            <ul class="list-unstyled small">
                                <li class="mb-2"><i class="fas fa-shopping-cart text-success me-2"></i>Market nearby</li>
                                <li class="mb-2"><i class="fas fa-hospital text-warning me-2"></i>Hospital nearby</li>
                                <li><i class="fas fa-school text-danger me-2"></i>School nearby</li>
                            </ul>

                            <hr class="my-4">



                        </div>

                    </div>

                </div>

            </div>
        </section>

    </div>

    <!-- Custom JS for file input label -->
    <script>
        // Update file input label when files are selected
        document.getElementById('imagesUpload').addEventListener('change', function(e) {
            const fileName = e.target.files[0] ? e.target.files[0].name : 'Choose images';
            const label = e.target.nextElementSibling;
            const count = e.target.files.length;
            label.innerHTML = count > 1 ?
                `<i class="bi bi-images me-2"></i>${count} images selected` :
                `<i class="bi bi-image me-2"></i>${fileName}`;
        });
    </script>

    <?php include __DIR__ . '/../includes/footer.php' ?>