<?php
session_start();
// ================= ACCESS CONTROL =================
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'renter') {
    $_SESSION['flash_message'] = "<div class='alert alert-danger'>Unauthorized access.</div>";
    header("Location: ../auth/login.php");
    exit;
}

?>

<?php include __DIR__ . '/../includes/header.php' ?>

<body>
    <!-- Top Navbar -->
    <?php include __DIR__ . '/../includes/nav.php' ?>

    <!-- Sidebar Navigation -->
    <?php include __DIR__ . '/sidebar.php' ?>

    <!-- Main Content -->
    <div class="main-content mt-5">


    </div>

    <?php include __DIR__ . '/../includes/footer.php' ?>