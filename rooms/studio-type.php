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
                        <h1 class="display-5 fw-bold text-danger mb-4"> NIÑA BOARDING HOUSE</h1>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <div class="row g-2 h-100">

                            <!-- Image 1 -->
                            <div class="col-6">
                                <div class="overflow-hidden rounded-4 shadow h-100" style="height: 300px;">
                                    <img src="../assets/images/NIÑA 1.jpg"
                                        class="img-fluid w-100 h-100"
                                        style="object-fit: cover;"
                                        alt="">
                                </div>
                            </div>

                            <!-- Image 2 -->
                            <div class="col-6">
                                <div class="overflow-hidden rounded-4 shadow h-100" style="height: 300px;">
                                    <img src="../assets/images/NIÑA 2.jpg"
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
                                <h3 class="text-success mb-0 me-3">₱2,500 – ₱3,000<span class="fs-5">/month</span></h3>
                                <span class="badge bg-success fs-6">Available Now</span>
                            </div>

                            <p class="mt-4 lead">Welcome sa Niña Boarding House, usa ka limpyo, komportable ug affordable nga puy-anan para sa students ug workers.</p>

                            <ul class="feature-list">
                                <li>✔️ Limpyo ug hayahay nga kwarto</li>
                                <li>✔️ Naay higdaan ug bentilasyon</li>
                                <li>✔️ Naay WiFi</li>
                                <li>✔️ Shared comfort room (CR)</li>
                                <li>✔️ Safe ug accessible nga location</li>
                                <li>✔️ Duol sa Poblacion proper</li>
                            </ul>

                            <p class="mt-4 lead">👥 Room Capacity:
                                • Good for 2–4 persons per room <br>
                                💰 Price:
                                • ₱2,500 – ₱3,000 per room <BR>(monthly, depende sa room size).</p>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-start mt-4">
                                <a href="../room-details/studio-type-details.php" class="btn btn-success btn-lg">
                                    <i class="fas fa-map-marker-alt me-2"></i>View Location
                                </a>
                                <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fas fa-book me-2"></i>Book Reservation
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h3 class="text-success"> You have Successfully Booked!</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../partials/footer.php' ?>