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
                        <h1 class="display-5 fw-bold text-danger mb-4">Elton Boarding House</h1>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <div class="row g-2 h-100">

                            <!-- Image 1 -->
                            <div class="col-6">
                                <div class="overflow-hidden rounded-4 shadow h-100" style="height: 300px;">
                                    <img src="../assets/images/elton3.jpg"
                                        class="img-fluid w-100 h-100"
                                        style="object-fit: cover;"
                                        alt="">
                                </div>
                            </div>

                            <!-- Image 2 -->
                            <div class="col-6">
                                <div class="overflow-hidden rounded-4 shadow h-100" style="height: 300px;">
                                    <img src="../assets/images/elton1.jpg"
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
                                <h3 class="text-success mb-0 me-3">₱3,000<span class="fs-5">/month</span></h3>
                                <span class="badge bg-success fs-6">Available Now</span>
                            </div>

                            <p class="mt-4 lead">Welcome sa Elton Boarding House, usa ka komportable ug limpyo nga puy-anan nga angay para sa students ug workers.</p>

                            <ul class="feature-list">
                                <li>✔️ Fully furnished rooms </li>
                                <li>✔️ Naa’y aircon para presko ug relax ang pagpuyo</li>
                                <li>✔️ Naa’y private CR (comfort room)</li>
                                <li>✔️ Limpyo ug well-maintained nga lugar</li>
                                <li>✔️ Safe ug secure ang palibot</li>
                                <li>✔️ Naay tubig ug kuryente 24/7</li>
                                <li>✔️ FREE WiFi para sa inyong internet needs</li>
                            </ul>

                            <p class="mt-4 lead">Perfect para sa mga nangita ug affordable pero kumpleto nga boarding house nga pwede dayon puy-an.</p>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-start mt-4">
                                <a href="../room-details/bedspace-details.php" class="btn btn-success btn-lg">
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