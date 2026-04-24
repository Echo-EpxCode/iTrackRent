<?php
// 1. Database Connection
include '../config/setup.php';

// 2. Query
$sql = "SELECT full_name, email, phone_no FROM user_tbl";
$result = mysqli_query($conn, $sql);
?>

<?php include __DIR__ . '/../partials/header.php' ?>

<body>
    <!-- Top Navbar -->
    <?php include __DIR__ . '/../partials/nav.php' ?>

    <!-- Sidebar Navigation -->
    <?php include __DIR__ . '/admin-sidebar.php' ?>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Dashboard Header -->
        <?php include __DIR__ . '/admin-dashboard-header.php' ?>
        <!-- here -->
        <div class="row justify-content-center">
            <div class="col-12">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="text-danger mb-0">
                        <i class="bi bi-calendar3-event-fill me-2"></i>
                        Reservations (5 Pending)
                    </h2>
                    <button class="btn btn-outline-danger">
                        <i class="bi bi-plus-circle me-2"></i> New Reservation
                    </button>
                </div>

                <!-- Table Container -->
                <div class="card shadow-lg border-0 overflow-hidden">
                    <div class="card-header bg-danger text-white py-3">
                        <h5 class="mb-0 fw-bold">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            Urgent Action Required
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-danger table-hover mb-0 align-middle">
                                <thead class="table-dark sticky-top">
                                    <tr>
                                        <th scope="col" class="border-0 fw-bold text-white py-3">Full Name</th>
                                        <th scope="col" class="border-0 fw-bold text-white py-3">Email</th>
                                        <th scope="col" class="border-0 fw-bold text-white py-3">Phone No.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Row 1 -->
                                    <?php
                                    // 3. Fetch + Display
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>" . $row['full_name'] . "</td>";
                                            echo "<td>" . $row['email'] . "</td>";
                                            echo "<td>" . $row['phone_no'] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='3'>No users found</td></tr>";
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Table Footer -->
                    <div class="card-footer bg-light border-0 py-3">

                    </div>
                </div>
            </div>
        </div>
        <!-- end here -->
    </div>

    <?php include __DIR__ . '/../partials/footer.php' ?>