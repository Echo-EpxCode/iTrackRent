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
                    <img src="../assets/images/bedspace.jpg" class="room-image" alt="Standard Single">
                    <div class="room-content">
                        <h3 class="room-title">Bedspace</h3>
                        <p class="room-description">Affordable and practical, perfect for students and workers looking to save.</p>
                        <div class="room-price">₱2,500/month</div>
                        <div class="room-type">Boarding House A • Available</div>
                    </div>
                </div>
            </a>

            <!-- Room Card 2 -->
            <a class="nav-link" href="../rooms/private-room.php">
                <div class="room-card">
                    <img src="../assets/images/private-room.jpg" class="room-image" alt="Standard Single">
                    <div class="room-content">
                        <h3 class="room-title">Private Room Boarding House</h3>
                        <p class="room-description">Private space with shared facilities at a reasonable price.</p>
                        <div class="room-price">₱3,500/month</div>
                        <div class="room-type">Boarding House A • Available</div>
                    </div>
                </div>
            </a>

            <!-- Room Card 3 -->
            <a class="nav-link" href="../rooms/studio-type.php">
                <div class="room-card">
                    <img src="../assets/images/studio-type.jpg" class="room-image" alt="Standard Single">
                    <div class="room-content">
                        <h3 class="room-title">Studio-Type / Premium Boarding House</h3>
                        <p class="room-description">Modern private living with complete amenities.</p>
                        <div class="room-price">₱7,000/month</div>
                        <div class="room-type">Boarding House A • Available</div>
                    </div>
                </div>
            </a>

            <!-- Room Card 10 -->
            <a class="nav-link" href="../rooms/unit.php">
                <div class="room-card">
                    <img src="../assets/images/studio-unit.jpeg" class="room-image" alt="Executive Room">
                    <div class="room-content">
                        <h3 class="room-title">Studio Unit (Compact Living)</h3>
                        <p class="room-description">Compact and private space ideal for solo living.</p>
                        <div class="room-price">₱5,000 – ₱12,000 / month</div>
                        <div class="room-type">Room 17A • Available</div>
                    </div>
                </div>
            </a>


        </div>
    </div>

    <?php include __DIR__ . '/../partials/footer.php' ?>