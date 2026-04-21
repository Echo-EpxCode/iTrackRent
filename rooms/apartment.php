<?php include __DIR__ . '/../partials/header.php' ?>

<body>
    <!-- Top Navbar -->
    <?php include __DIR__ . '/../partials/nav.php' ?>

    <!-- Sidebar Navigation -->
    <?php include __DIR__ . '/../partials/sidebar.php' ?>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Dashboard Header -->


        <!-- Property Hero -->
        <section class="py-5 bg-light" style="padding-top: 100px;">
            <div class="container">
                <div class="row justify-content-center text-center mb-2">
                    <div class="col-lg-8">
                        <h1 class="display-5 fw-bold text-danger mb-4">Apartment Unit</h1>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-6 mb-4 mb-md-0 position-relative overflow-hidden rounded-4 shadow" style="height: 300px;">
                        <img src="../assets/images/apartment1.webp"
                            class="img-fluid w-100 h-100 position-absolute top-0 start-0"
                            style="object-fit: cover;"
                            alt="">
                    </div>
                    <div class="col-md-6">
                        <div class="property-card h-100 p-4">
                            <h2 class="display-5 fw-bold mb-3">Details</h2>
                            <div class="d-flex align-items-center mb-4">
                                <h3 class="text-success mb-0 me-3">₱10,000 – ₱25,000<span class="fs-5">/month</span></h3>
                                <span class="badge bg-success fs-6">Available Now</span>
                            </div>

                            <ul class="feature-list">
                                <li><i class="fas fa-bed text-primary me-2"></i>Shared room (2–6 occupants)</li>
                                <li><i class="fas fa-bath text-primary me-2"></i>2 Bathrooms</li>
                                <li><i class="fas fa-expand-arrows-alt text-primary me-2"></i>1,450 sqft</li>
                                <li><i class="fas fa-parking text-primary me-2"></i>2 Parking Spaces</li>
                                <li><i class="fas fa-wifi text-primary me-2"></i>High-Speed Internet</li>
                            </ul>

                            <p class="mt-4 lead">Apartment units provide separate rooms for living, sleeping, and cooking, making them ideal for families or groups. They offer more space and structure compared to studio units, with better comfort for long-term living.</p>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-start mt-4">
                                <a href="../room-details/apartment-details.php" class="btn btn-success btn-lg">
                                    <i class="fas fa-map-marker-alt me-2"></i>View Location
                                </a>
                                <button class="btn btn-outline-primary btn-lg">
                                    <i class="fas fa-phone me-2"></i>Contact Agent
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <?php include __DIR__ . '/../partials/footer.php' ?>