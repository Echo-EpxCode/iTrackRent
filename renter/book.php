<?php
session_start();
// ================= ACCESS CONTROL =================
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'renter') {
    $_SESSION['flash_message'] = "<div class='alert alert-danger'>Unauthorized access.</div>";
    header("Location: ../auth/login.php");
    exit;
}

include_once __DIR__ . '/../config/setup.php';

$property_id = (int) $_GET['id'];

?>

<?php include __DIR__ . '/../includes/header.php' ?>

<body>
    <!-- Top Navbar -->
    <?php include __DIR__ . '/../includes/nav.php'; ?>

    <!-- Sidebar Navigation -->
    <?php include __DIR__ . '/sidebar.php' ?>

    <!-- Main Content -->
    <div class="main-content mt-5">
        <div class="container">

            <div class="card shadow p-4">

                <h3 class="mb-4">Book Reservation</h3>

                <form action="process_booking.php" method="POST">

                    <input type="hidden" name="property_id" value="<?= $property_id ?>">

                    <!-- Check-in -->
                    <div class="mb-3">
                        <label>Check-in Date</label>
                        <input type="date" name="check_in_date" class="form-control" required>
                    </div>

                    <!-- Check-out -->
                    <div class="mb-3">
                        <label>Check-out Date</label>
                        <input type="date" name="check_out_date" class="form-control" required>
                    </div>

                    <!-- Message -->
                    <div class="mb-3">
                        <label>Message (Optional)</label>
                        <textarea name="message" class="form-control"></textarea>
                    </div>

                    <button type="submit" class="btn btn-success w-100">
                        Submit Reservation
                    </button>

                </form>

            </div>

        </div>
    </div>

    <?php include __DIR__ . '/../includes/footer.php' ?>