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
                    <img src="../assets/images/RODENTOR.jpg" class="room-image" alt="Executive Room">
                    <div class="room-content">
                        <h3 class="room-title">RODENTOR PENSION HOUSE</h3>
                        <div class="room-price">₱700 – ₱1,200 / night</div>
                        <div class="room-type">Room 17A • Available</div>
                    </div>
                </div>
            </a>

            <!-- Room Card 8 -->
            <a class="nav-link" href="../rooms/residential-pension.php">
                <div class="room-card">
                    <img src="../assets/images/MARGOS-MAIN.jpg" class="room-image" alt="Executive Room">
                    <div class="room-content">
                        <h3 class="room-title"> MARGOSATUBIG VIEW PENSION HOUSE & STAYCATION</h3>
                        <div class="room-price">₱800 – ₱1,500 / night</div>
                        <div class="room-type">Room 17A • Available</div>
                    </div>
                </div>
            </a>


        </div>
    </div>

    <?php include __DIR__ . '/../partials/footer.php' ?>