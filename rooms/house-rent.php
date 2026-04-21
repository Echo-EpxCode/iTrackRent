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
                        <h1 class="display-5 fw-bold text-danger mb-4">House for Rent (Full Home Living)</h1>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <div class="row g-2 h-100">

                            <!-- Image 1 -->
                            <div class="col-6">
                                <div class="overflow-hidden rounded-4 shadow h-100" style="height: 300px;">
                                    <img src="../assets/images/house-rent.webp"
                                        class="img-fluid w-100 h-100"
                                        style="object-fit: cover;"
                                        alt="">
                                </div>
                            </div>

                            <!-- Image 2 -->
                            <div class="col-6">
                                <div class="overflow-hidden rounded-4 shadow h-100" style="height: 300px;">
                                    <img src="../assets/images/house-rent.avif"
                                        class="img-fluid w-100 h-100"
                                        style="object-fit: cover;"
                                        alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="property-card h-100 p-4">
                            <h2 class="display-5 fw-bold mb-3">Details</h2>
                            <div class="d-flex align-items-center mb-4">
                                <h3 class="text-success mb-0 me-3">₱20,000 – ₱60,000+<span class="fs-5">/night</span></h3>
                                <span class="badge bg-success fs-6">Available Now</span>
                            </div>

                            <ul class="feature-list">
                                <li><i class="fas fa-bed text-primary me-2"></i>Multiple bedrooms and bathrooms</li>
                                <li><i class="fas fa-fan text-primary me-2"></i>Air-conditioned premium rooms</li>
                                <li><i class="fas fa-bath text-primary me-2"></i>Bathroom with hot & cold shower</li>
                                <li><i class="fas fa-tv text-primary me-2"></i>Entertainment setup</li>
                                <li><i class="fas fa-square-parking text-primary me-2"></i>Parking area</li>
                                <li><i class="fas fa-utensils text-primary me-2"></i>Full kitchen</li>
                            </ul>

                            <p class="mt-4 lead">A full house rental offers the most space and privacy, suitable for families or long-term tenants. It includes multiple rooms, outdoor areas, and full home amenities, providing a comfortable and independent living experience..</p>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-start mt-4">
                                <a href="../room-details/house-rent-details.php" class="btn btn-success btn-lg">
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