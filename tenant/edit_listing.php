<?php

session_start();

// ================= DATABASE =================
include_once __DIR__ . '/../config/setup.php';



// ================= ACCESS CONTROL =================
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'tenant') {
    $_SESSION['flash_message'] = "<div class='alert alert-danger'>Unauthorized access.</div>";
    header("Location: ../auth/login.php");
    exit;
}

// ================= VALIDATE ID =================
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid listing ID.");
}

$listing_id = (int) $_GET['id'];
$tenant_id  = $_SESSION['user_id'];


// ================= FETCH LISTING =================
$stmt = $conn->prepare("
    SELECT * FROM listings 
    WHERE id = ? AND tenant_id = ?
");

$stmt->bind_param("ii", $listing_id, $tenant_id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Listing not found.");
}

$listing = $result->fetch_assoc();


// ================= FLASH MESSAGE =================
$sms = "";

if (isset($_SESSION['flash_message'])) {
    $sms = $_SESSION['flash_message'];
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
    <div class="main-content mt-5">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <h1 class="dashboard-title">Edit Listings</h1>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!-- Add Form Here -->
                <div class="container-fluid ">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card shadow-lg border-0">
                                <div class="card-header bg-danger text-white text-center py-4">

                                </div>
                                <div class="card-body p-4">

                                    <?= $sms ?? '' ?>


                        <form action="update_listing.php?id=<?= $listing['id'] ?>" 
                              method="POST"
                              enctype="multipart/form-data">

                            <div class="row">

                                <!-- HOUSE NAME -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">House Name</label>

                                    <input type="text"
                                           name="house_name"
                                           class="form-control"
                                           value="<?= htmlspecialchars($listing['house_name']) ?>"
                                           required>
                                </div>

                                <!-- PROPERTY TYPE -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Property Type</label>

                                    <select name="property_type"
                                            class="form-select"
                                            required>

                                        <option value="boarding_house"
                                            <?= ($listing['property_type'] === 'boarding_house') ? 'selected' : '' ?>>
                                            Boarding House
                                        </option>

                                        <option value="lodging_house"
                                            <?= ($listing['property_type'] === 'lodging_house') ? 'selected' : '' ?>>
                                            Lodging House
                                        </option>

                                        <option value="pension_house"
                                            <?= ($listing['property_type'] === 'pension_house') ? 'selected' : '' ?>>
                                            Pension House
                                        </option>

                                    </select>
                                </div>

                                <!-- PAYMENT TYPE -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Payment Type</label>

                                    <select name="payment_type"
                                            class="form-select"
                                            required>

                                        <option value="monthly"
                                            <?= ($listing['payment_type'] === 'monthly') ? 'selected' : '' ?>>
                                            Monthly
                                        </option>

                                        <option value="night"
                                            <?= ($listing['payment_type'] === 'night') ? 'selected' : '' ?>>
                                            Per Night
                                        </option>

                                    </select>
                                </div>

                                <!-- PRICE -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Price</label>

                                    <input type="number"
                                           step="0.01"
                                           name="price"
                                           class="form-control"
                                           value="<?= $listing['price'] ?>"
                                           required>
                                </div>

                                <!-- ADDRESS -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Address</label>

                                    <input type="text"
                                           name="address"
                                           class="form-control"
                                           value="<?= htmlspecialchars($listing['address']) ?>"
                                           required>
                                </div>

                                <!-- DESCRIPTION -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Description</label>

                                    <textarea name="description"
                                              rows="5"
                                              class="form-control"
                                              required><?= htmlspecialchars($listing['description']) ?></textarea>
                                </div>

                                <!-- MAP -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">
                                        Google Map Embed Link
                                    </label>

                                    <textarea name="map_link"
                                              rows="3"
                                              class="form-control"
                                              required><?= htmlspecialchars($listing['map_link']) ?></textarea>

                                    <small class="text-muted">
                                        Paste full Google Maps iframe embed code.
                                    </small>
                                </div>

                                <!-- CURRENT COVER -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Current Cover Photo</label>

                                    <div>
                                        <img src="../uploads/covers/<?= $listing['cover_photo'] ?>"
                                             class="img-fluid rounded shadow"
                                             style="max-height:250px;">
                                    </div>
                                </div>

                                <!-- NEW COVER -->
                                <div class="col-md-12 mb-4">
                                    <label class="form-label">
                                        Replace Cover Photo
                                    </label>

                                    <input type="file"
                                           name="cover_photo"
                                           class="form-control">
                                </div>

                            </div>

                            <!-- BUTTONS -->
                            <div class="d-flex gap-2">

                                <button type="submit"
                                        class="btn btn-primary btn-lg">
                                    <i class="fa-solid fa-floppy-disk me-2"></i>
                                    Update Listing
                                </button>

                                <a href="view_listing.php?id=<?= $listing['id'] ?>"
                                   class="btn btn-secondary btn-lg">
                                    Cancel
                                </a>

                            </div>

                        </form>

                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Form -->

            </div>
        </div>
    </div>

    <!-- Custom JS for file input label -->


    <?php include __DIR__ . '/../includes/footer.php' ?>