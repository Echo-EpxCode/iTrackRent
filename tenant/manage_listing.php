<?php

session_start();


// ================= ACCESS CONTROL =================
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'tenant') {
    $_SESSION['flash_message'] = "<div class='alert alert-danger'>Unauthorized access.</div>";
    header("Location: ../auth/login.php");
    exit;
}

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
    <div class="main-content mt-4">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <h1 class="dashboard-title">Manage Listings</h1>
            <p class="dashboard-subtitle">Create, update, and monitor your property listings</p>
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

                                    <form action="<?= htmlspecialchars('process_listing.php') ?>" method="POST" enctype="multipart/form-data">

                                        <!-- Property Name -->
                                        <div class="mb-3">
                                            <label class="form-label">Name of Boarding House</label>
                                            <input type="text" name="house_name" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Address</label>
                                            <input type="text" name="address" class="form-control" required>
                                        </div>

                                        <!-- Property Type -->
                                        <div class="mb-3">
                                            <label class="form-label">Property Type</label>
                                            <select name="property_type" class="form-select" required>
                                                <option value="">Select Type</option>
                                                <option value="Boarding House">Boarding House</option>
                                                <option value="Lodging House">Lodging House</option>
                                                <option value="Pension House">Pension House</option>
                                            </select>
                                        </div>

                                        <!-- Payment Type -->
                                        <div class="mb-3">
                                            <label class="form-label">Payment Type</label>
                                            <select name="payment_type" class="form-select" required>
                                                <option value="">Select Payment</option>
                                                <option value="monthly">Monthly</option>
                                                <option value="night">Night</option>
                                            </select>
                                        </div>

                                        <!-- Price -->
                                        <div class="mb-3">
                                            <label class="form-label">Price</label>
                                            <input type="number" name="price" step="0.01" class="form-control" required>
                                        </div>

                                        <!-- Description -->
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" class="form-control" rows="4" required></textarea>
                                        </div>

                                        <!-- Cover Photo -->
                                        <div class="mb-3">
                                            <label class="form-label">Cover Photo</label>
                                            <input type="file" name="cover_photo" class="form-control" accept="image/*" required>
                                        </div>

                                        <!-- Listing Photos (MAX 5) -->
                                        <div class="mb-3">
                                            <label class="form-label">Listing Photos (Max 5 Images)</label>
                                            <input type="file" name="listing_photos[]" class="form-control" accept="image/*" multiple required>
                                            <small class="text-muted">You can upload up to 5 images only.</small>
                                        </div>

                                        <!-- Google Map -->
                                        <div class="mb-3">

                                            <label class="form-label fw-bold">
                                                Google Map Location (Embed Code or Link)
                                            </label>

                                            <textarea
                                                name="map_link"
                                                class="form-control"
                                                rows="4"
                                                placeholder="Paste Google Maps iframe embed code OR embed link here..."
                                                required></textarea>

                                            <small class="text-muted">
                                                ⚠️ You can paste either:<br>
                                                • Full iframe embed code<br>
                                                • Or direct embed URL<br><br>

                                                Example iframe:
                                                <code>&lt;iframe src="https://www.google.com/maps/embed?pb=..."&gt;&lt;/iframe&gt;</code>
                                            </small>

                                        </div>

                                        <!-- Submit -->
                                        <button type="submit" name="submit" class="btn btn-danger w-100">
                                            Submit Listing
                                        </button>

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