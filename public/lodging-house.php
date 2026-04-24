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
                    <img src="../assets/images/lodge.jpg" class="room-image" alt="Executive Room">
                    <div class="room-content">
                        <h3 class="room-title"> CASA DENCIA LODGE</h3>
                        <div class="room-price">₱700 / night</div>
                        <div class="room-type">Room 1A • Available</div>
                    </div>
                </div>
            </a>

            <!-- Room Card 5 -->
            <a class="nav-link" href="../rooms/standard-lodge.php">
                <div class="room-card">
                    <img src="../assets/images/JANETTE.jpg" class="room-image" alt="Executive Room">
                    <div class="room-content">
                        <h3 class="room-title">JANETTE LODGE</h3>
                        <div class="room-price">₱300–₱500 / night</div>
                        <div class="room-type">Room 1B • Available</div>
                    </div>
                </div>
            </a>

            <!-- Room Card 6 -->
            <a class="nav-link" href="../rooms/premium-lodge.php">
                <div class="room-card">
                    <img src="../assets/images/VILLA-MAIN.jpg" class="room-image" alt="Executive Room">
                    <div class="room-content">
                        <h3 class="room-title"> VILLA LODGING HOUSE</h3>
                        <div class="room-price">₱300 – ₱500 / night</div>
                        <div class="room-type">Room 17A • Available</div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <?php include __DIR__ . '/../partials/footer.php' ?>