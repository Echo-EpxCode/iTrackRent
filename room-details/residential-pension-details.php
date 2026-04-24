<?php include __DIR__ . '/../partials/header.php' ?>

<body>
    <!-- Top Navbar -->
    <?php include __DIR__ . '/../partials/nav.php' ?>

    <!-- Sidebar Navigation -->
    <?php include __DIR__ . '/../partials/sidebar.php' ?>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Dashboard Header -->
        <!-- Location Section -->
        <section class="py-5">
            <div class="container">
                <div class="row justify-content-center text-center mb-2">
                    <div class="col-lg-8">
                        <h1 class="display-5 fw-bold text-danger mb-4">MARGOSATUBIG VIEW PENSION HOUSE & STAYCATION </h1>
                    </div>
                </div>

                <div class="row g-5">
                    <!-- Map -->
                    <div class="col-lg-8">
                        <div class="rounded-4 shadow overflow-hidden">

                            <div class="ratio ratio-16x9">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3954.9901669052156!2d123.16334527389098!3d7.576048110040152!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3256adad3dddf9b1%3A0xe3eb339ec8e37a06!2sPoblacion%2C%20Margosatubig%2C%20Zamboanga%20Del%20Sur%20-%20Barangay%20Hall!5e0!3m2!1sen!2sph!4v1776712769340!5m2!1sen!2sph"
                                    class="w-100 h-100 border-0"
                                    allowfullscreen=""
                                    loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>

                        </div>
                    </div>

                    <!-- Location Details -->
                    <div class="col-lg-4">
                        <div class="h-100 p-4 border rounded-4 shadow-sm">
                            <a class="nav-link fw-bold mb-2" href="../rooms/residential-pension.php"><i class="fa-solid fa-angles-left"></i> Back</a>

                            <h3 class="text-success mb-4"><i class="fas fa-map-pin me-2"></i>Address</h3>
                            <address class="mb-4">
                                <strong> Poblacion</strong><br>
                                Margosatubig, Zamboanga Del Sur
                            </address>

                            <h5 class="text-success mb-3"><i class="fas fa-compass me-2"></i>Nearby</h5>
                            <ul class="list-unstyled small">
                                <li class="mb-2"><i class="fas fa-shopping-cart text-success me-2"></i>Store - 0.3 mi</li>
                                <li class="mb-2"><i class="fas fa-hospital text-warning me-2"></i>Hospital - 1.2 mi</li>
                                <li><i class="fas fa-school text-danger me-2"></i>Schools - 0.8 mi</li>
                            </ul>

                            <hr class="my-4">

                            <h5 class="text-success mb-3"><i class="fas fa-phone me-2"></i>Contact</h5>
                            <div class="d-grid gap-2">
                                <a href="tel:+1234567890" class="btn btn-outline-primary">
                                    <i class="fas fa-phone me-2"></i>(123) 456-7890
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </div>

    <?php include __DIR__ . '/../partials/footer.php' ?>