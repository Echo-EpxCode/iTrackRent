<?php include __DIR__ . '/../partials/header.php' ?>

<body>
    <!-- Top Navbar -->
    <?php include __DIR__ . '/../partials/nav.php' ?>

    <!-- Sidebar Navigation -->
    <?php include __DIR__ . '/../partials/sidebar.php' ?>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Dashboard Header -->
        <?php include __DIR__ . '/../partials/dashboard-header.php' ?>
        <!-- 12 Rooms Grid -->
        <div class="rooms-grid">
            <!-- Room Card 7 -->
            <a class="nav-link" href="../rooms/short-pension.php">
                <div class="room-card">
                    <img src="../assets/images/short-stay.avif" class="room-image" alt="Executive Room">
                    <div class="room-content">
                        <h3 class="room-title">Short-Stay Pension House</h3>
                        <p class="room-description">Ideal for quick overnight stays with simple and clean accommodations.</p>
                        <div class="room-price">₱700 – ₱1,800 / night</div>
                        <div class="room-type">Room 17A • Available</div>
                    </div>
                </div>
            </a>

            <!-- Room Card 8 -->
            <a class="nav-link" href="../rooms/residential-pension.php">
                <div class="room-card">
                    <img src="../assets/images/residential-stay.avif" class="room-image" alt="Executive Room">
                    <div class="room-content">
                        <h3 class="room-title">Residential Pension House</h3>
                        <p class="room-description">Comfortable long-stay rooms designed for work, study, or relocation.</p>
                        <div class="room-price">₱1,800 – ₱4,500 / night</div>
                        <div class="room-type">Room 17A • Available</div>
                    </div>
                </div>
            </a>

            <!-- Room Card 9 -->
            <a class="nav-link" href="../rooms/executive-pension.php">
                <div class="room-card">
                    <img src="../assets/images/executive-stay.jpg" class="room-image" alt="Executive Room">
                    <div class="room-content">
                        <h3 class="room-title">Executive Pension House</h3>
                        <p class="room-description">Modern, private, and hotel-style pension accommodation.</p>
                        <div class="room-price">₱4,000 – ₱8,500+ / night</div>
                        <div class="room-type">Room 17A • Available</div>
                    </div>
                </div>
            </a>

            <!-- Room Card 12 -->
            <a class="nav-link" href="../rooms/house-rent.php">
                <div class="room-card">
                    <img src="../assets/images/house-rent.webp" class=" room-image" alt="Executive Room">
                    <div class="room-content">
                        <h3 class="room-title">House for Rent (Full Home Living)</h3>
                        <p class="room-description">Complete home with maximum space, privacy, and comfort.</p>
                        <div class="room-price">₱20,000 – ₱60,000+ / month</div>
                        <div class="room-type">Room 17A • Available</div>
                    </div>
                </div>
            </a>


        </div>
    </div>

    <?php include __DIR__ . '/../partials/footer.php' ?>