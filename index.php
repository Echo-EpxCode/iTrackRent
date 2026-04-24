<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iTrackRent - Boarding House Tracking System</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fas fa-home me-2"></i>iTrackRent</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#rooms">Rooms</a></li>
                    <li class="nav-item"><a class="nav-link" href="#buildings">Buildings</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">About</a></li>
                    <!-- Buttons Group - Right Side -->
                    <div class="d-flex gap-2">

                        <!-- Primary CTA Button -->
                        <a href="admin-login.php" class="btn btn-danger btn-md">Admin login</a>
                    </div>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="text-outline">Find Your Perfect Stay</h1>
                    <p class="lead mb-4 fw-bold text-outline" style="font-size: 1.3rem;">Search and track boarding houses, lodgings, <br> and pension houses effortlessly</p>
                    <a href="login.php" class="btn btn-primary btn-lg">Sign In</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Rooms Carousel Section -->
    <section id="rooms" class="py-5">
        <div class="container">
            <h2 class="section-title">Available Rooms</h2>
            <div id="roomsCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#roomsCarousel" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#roomsCarousel" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#roomsCarousel" data-bs-slide-to="2"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card room-card h-100">
                                    <img src="assets/images/room4.jpg" class="card-img-top" alt="Standard Room">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Standard Room</h5>
                                        <p class="card-text">Comfortable single room with essential amenities and modern furnishings.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card room-card h-100">
                                    <img src="assets/images/RODENTOR1.jpg" class="card-img-top" alt="Deluxe Room">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Deluxe Room</h5>
                                        <p class="card-text">Spacious room with premium bedding, work desk, and city views.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card room-card h-100">
                                    <img src="assets/images/ap3.jpg" class="card-img-top" alt="Family Suite">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Family Suite</h5>
                                        <p class="card-text">Perfect for families with multiple beds and living area.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card room-card h-100">
                                    <img src="assets/images/ap.jpg" class="card-img-top" alt="Executive Room">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Executive Room</h5>
                                        <p class="card-text">Business-class room with high-speed WiFi and conference facilities.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card room-card h-100">
                                    <img src="assets/images/studio.jpg" class="card-img-top" alt="Studio Apartment">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Studio Apartment</h5>
                                        <p class="card-text">Compact apartment with kitchenette and separate sleeping area.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card room-card h-100">
                                    <img src="assets/images/apartment.jpg" class="card-img-top" alt="Penthouse">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Penthouse</h5>
                                        <p class="card-text">Luxury rooftop suite with panoramic views and premium amenities.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#roomsCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#roomsCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <!-- Buildings Section -->
    <section id="buildings" class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title">Property Types</h2>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="card building-card h-100">
                        <img src="assets/images/house4rent1.jpg" class="card-img-top" alt="Boarding House">
                        <div class="card-body text-center">
                            <h5 class="card-title">Boarding House</h5>
                            <p class="card-text">Traditional student and worker accommodations with shared facilities and home-like atmosphere.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card building-card h-100">
                        <img src="assets/images/lodge.jpg" class="card-img-top" alt="Lodging">
                        <div class="card-body text-center">
                            <h5 class="card-title">Lodging House</h5>
                            <p class="card-text">Short-term stays with flexible booking options and convenient location access.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card building-card h-100">
                        <img src="assets/images/MARGOS-MAIN.jpg" class="card-img-top" alt="Pension House">
                        <div class="card-body text-center">
                            <h5 class="card-title">Pension House</h5>
                            <p class="card-text">Retiree-friendly accommodations with comprehensive care services and community living.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="footer">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-6 mb-5 text-center">
                    <h5 class="mb-4"><i class="fas fa-home fw-bold me-2"></i>iTrackRent</h5>
                    <p class="lead fs-4 fw-bold mb-4 opacity-90">
                        "Find rooms, connect with landlords, and secure your next home effortlessly with iTrackRent – the complete solution designed for renters everywhere."

                    </p>
                </div>
            </div>
            <hr class="my-4 opacity-25">
            <div class="row text-center">
                <div class="col">
                    <p>iTrackRent: A Web-Based Reak-Time Rental Tracking System.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Smooth scrolling for navigation links -->
    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Navbar background on scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.backgroundColor = 'rgba(255, 255, 255, 0.98)';
            } else {
                navbar.style.backgroundColor = 'rgba(255, 255, 255, 0.95)';
            }
        });
    </script>
</body>

</html>