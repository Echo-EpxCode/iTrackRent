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

            <!-- Room Card 1 -->
            <a class="nav-link" href="../rooms/bedspace.php">
                <div class="room-card">
                    <img src="../assets/images/elton1.jpg" class="room-image" alt="Standard Single">
                    <div class="room-content">
                        <h3 class="room-title">ELTON BOARDING HOUSE</h3>
                        <div class="room-price">₱3,000/month</div>
                        <div class="room-type">Boarding House • Available</div>
                    </div>
                </div>
            </a>

            <!-- Room Card 2 -->
            <a class="nav-link" href="../rooms/private-room.php">
                <div class="room-card">
                    <img src="../assets/images/DottiesInn_Main.jpg" class="room-image" alt="Standard Single">
                    <div class="room-content">
                        <h3 class="room-title">DOTTIES INN BOARDING HOUSE</h3>
                        <div class="room-price">₱3,000/month</div>
                        <div class="room-type">Boarding House • Available</div>
                    </div>
                </div>
            </a>

            <!-- Room Card 3 -->
            <a class="nav-link" href="../rooms/studio-type.php">
                <div class="room-card">
                    <img src="../assets/images/NIÑA.jpg" class="room-image" alt="Standard Single">
                    <div class="room-content">
                        <h3 class="room-title">NIÑA BOARDING HOUSE</h3>
                        <div class="room-price">₱2,500 – ₱3,000/month</div>
                        <div class="room-type">Boarding House A • Available</div>
                    </div>
                </div>
            </a>


        </div>
    </div>

    <?php include __DIR__ . '/../partials/footer.php' ?>