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

            <!-- Room Card 4 -->
            <a class="nav-link" href="../rooms/budget-lodge.php">
                <div class="room-card">
                    <img src="../assets/images/budget-lodge.jpeg" class="room-image" alt="Executive Room">
                    <div class="room-content">
                        <h3 class="room-title">Budget Lodging House</h3>
                        <p class="room-description">Affordable stay for quick and convenient lodging.</p>
                        <div class="room-price">₱500 – ₱1,500 / night</div>
                        <div class="room-type">Room 1A • Available</div>
                    </div>
                </div>
            </a>

            <!-- Room Card 5 -->
            <a class="nav-link" href="../rooms/standard-lodge.php">
                <div class="room-card">
                    <img src="../assets/images/standard-lodge.jpg" class="room-image" alt="Executive Room">
                    <div class="room-content">
                        <h3 class="room-title">Standard Lodging House</h3>
                        <p class="room-description">Comfortable and reliable stay at a reasonable price.</p>
                        <div class="room-price">₱1,500 – ₱3,500 / night</div>
                        <div class="room-type">Room 1B • Available</div>
                    </div>
                </div>
            </a>

            <!-- Room Card 6 -->
            <a class="nav-link" href="../rooms/premium-lodge.php">
                <div class="room-card">
                    <img src="../assets/images/premium-lodge.jpg" class="room-image" alt="Executive Room">
                    <div class="room-content">
                        <h3 class="room-title">Premium Lodging House</h3>
                        <p class="room-description">Modern and stylish living with hotel-like comfort.</p>
                        <div class="room-price">₱3,500 – ₱7,000 / night</div>
                        <div class="room-type">Room 17A • Available</div>
                    </div>
                </div>
            </a>


            <!-- Room Card 11 -->
            <a class="nav-link" href="../rooms/apartment.php">
                <div class="room-card">
                    <img src="../assets/images/apartment.webp" class=" room-image" alt="Executive Room">
                    <div class="room-content">
                        <h3 class="room-title">Apartment Unit (Multi-Room Living)</h3>
                        <p class="room-description">Spacious and functional home for families or shared living.</p>
                        <div class="room-price">₱10,000 – ₱25,000 / month</div>
                        <div class="room-type">Room 17A • Available</div>
                    </div>
                </div>
            </a>

        </div>
    </div>

    <?php include __DIR__ . '/../partials/footer.php' ?>