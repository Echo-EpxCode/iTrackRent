<?php
// ================= START SESSION =================
session_start();

include_once __DIR__ . '/../config/setup.php';

// TOTAL USERS (exclude admin)
$total_users = $conn->query("
    SELECT COUNT(*) as total 
    FROM users 
    WHERE role != 'admin'
")->fetch_assoc()['total'];

// TOTAL TENANTS
$total_tenants = $conn->query("
    SELECT COUNT(*) as total FROM users WHERE role='tenant'
")->fetch_assoc()['total'];

// TOTAL RENTERS
$total_renters = $conn->query("
    SELECT COUNT(*) as total FROM users WHERE role='renter'
")->fetch_assoc()['total'];

// TOTAL PROPERTIES
$total_properties = $conn->query("
    SELECT COUNT(*) as total FROM listings
")->fetch_assoc()['total'];
?>

<?php include __DIR__ . '/../includes/header.php' ?>

<style>
    .stat-card {
        background: #fff;
        border-radius: 16px;
        transition: 0.3s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }
</style>

<body>
    <!-- Top Navbar -->
    <?php include __DIR__ . '/../includes/nav.php' ?>

    <!-- Sidebar Navigation -->
    <?php include __DIR__ . '/sidebar.php' ?>

    <!-- Main Content -->
    <div class="main-content mt-4 ">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <h1 class="dashboard-title">User Management</h1>
            <p class="dashboard-subtitle">Review, approve, and manage system users efficiently</p>
        </div>

        <!-- Stats Overview -->
        <div class="row g-4 mb-5">

            <div class="col-lg-3 col-md-6">
                <div class="stat-card p-4 shadow rounded-4 text-center h-100">

                    <div class="stat-icon mb-3">
                        <i class="fa-solid fa-users fa-2x text-primary"></i>
                    </div>

                    <div class="stat-number fw-bold mb-2">
                        <?= $total_users ?>
                    </div>

                    <div class="stat-label text-muted">
                        Total Users
                    </div>

                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="stat-card p-4 shadow rounded-4 text-center h-100">

                    <div class="stat-icon mb-3">
                        <i class="fa-solid fa-building-user fa-2x text-success"></i>
                    </div>

                    <div class="stat-number fw-bold mb-2">
                        <?= $total_tenants ?>
                    </div>

                    <div class="stat-label text-muted">
                        Tenants
                    </div>

                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="stat-card p-4 shadow rounded-4 text-center h-100">

                    <div class="stat-icon mb-3">
                        <i class="fa-solid fa-user fa-2x text-warning"></i>
                    </div>

                    <div class="stat-number fw-bold mb-2">
                        <?= $total_renters ?>
                    </div>

                    <div class="stat-label text-muted">
                        Renters
                    </div>

                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="stat-card p-4 shadow rounded-4 text-center h-100">

                    <div class="stat-icon mb-3">
                        <i class="fa-solid fa-house fa-2x text-danger"></i>
                    </div>

                    <div class="stat-number fw-bold mb-2">
                        <?= $total_properties ?>
                    </div>

                    <div class="stat-label text-muted">
                        Properties
                    </div>

                </div>
            </div>

        </div>

    </div>

    <?php include __DIR__ . '/../includes/footer.php' ?>