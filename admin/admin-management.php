<?php include __DIR__ . '/../partials/header.php' ?>

<body>
    <!-- Top Navbar -->
    <?php include __DIR__ . '/../partials/nav.php' ?>

    <!-- Sidebar Navigation -->
    <?php include __DIR__ . '/admin-sidebar.php' ?>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Dashboard Header -->
        <?php include __DIR__ . '/admin-dashboard-header.php' ?>

        <div class="row">
            <div class="col-md-12">
                <!-- Add Form Here -->
                <div class="container-fluid ">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-10">
                            <div class="card shadow-lg border-0">
                                <div class="card-header bg-danger text-white text-center py-4">
                                    <h3 class="mb-0"><i class="bi bi-building me-2"></i>Property Information Form</h3>
                                </div>
                                <div class="card-body p-5 bg-light">
                                    <form>
                                        <!-- Row 1 -->
                                        <div class="row mb-4">
                                            <div class="col-md-6 mb-3">
                                                <label for="locationName" class="form-label fw-bold text-dark">Name of Location</label>
                                                <input type="text" class="form-control form-control-lg shadow-sm" id="locationName"
                                                    placeholder="Enter location name" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="ownerName" class="form-label fw-bold text-dark">Name of Owner</label>
                                                <input type="text" class="form-control form-control-lg shadow-sm" id="ownerName"
                                                    placeholder="Enter owner name" required>
                                            </div>
                                        </div>

                                        <!-- Row 2 -->
                                        <div class="row mb-4">
                                            <div class="col-md-6 mb-3">
                                                <label for="monthlyPayment" class="form-label fw-bold text-dark">Monthly Payment</label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-white border-end-0">₱</span>
                                                    <input type="number" class="form-control form-control-lg shadow-sm border-start-0"
                                                        id="monthlyPayment" placeholder="0.00" step="0.01" required>
                                                    <span class="input-group-text bg-white">.00</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="imagesUpload" class="form-label fw-bold text-dark">Upload Images</label>
                                                <div class="custom-file">
                                                    <input type="file" class="form-control form-control-lg shadow-sm" id="imagesUpload"
                                                        multiple accept="image/*">

                                                </div>
                                            </div>
                                        </div>

                                        <!-- Row 3 -->
                                        <div class="row mb-4">
                                            <div class="col-md-12 mb-3">
                                                <label for="googleMapLink" class="form-label fw-bold text-dark">Google Map Link</label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-white border-end-0">
                                                        <i class="bi bi-geo-alt text-danger"></i>
                                                    </span>
                                                    <input type="url" class="form-control form-control-lg shadow-sm border-start-0"
                                                        id="googleMapLink" placeholder="https://maps.google.com/maps?q=..." required>
                                                    <button class="btn btn-outline-danger" type="button">
                                                        <i class="bi bi-link-45deg"></i> Validate
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="row">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-danger btn-lg w-100 py-3 fw-bold shadow-lg">
                                                    <i class="bi bi-check-circle me-2"></i>Submit Property Details
                                                </button>
                                            </div>
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

    <?php include __DIR__ . '/../partials/footer.php' ?>