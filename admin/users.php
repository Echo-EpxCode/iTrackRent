<?php
// ================= START SESSION =================
session_start();

// ================= DATABASE CONNECTION =================
$host = "localhost";
$user = "root";
$pass = "";
$db   = "iTrack_db";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = "";

// ================= HANDLE ACTION =================
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {

    $user_id = intval($_POST['user_id']);
    $action  = $_POST['action'];

    if ($action == 'accept') {

        $status = "approved";

        $stmt = mysqli_prepare($conn, "UPDATE users SET status = ?, updated_at = NOW() WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "si", $status, $user_id);

        if (mysqli_stmt_execute($stmt)) {
            $message = "<div class='alert alert-success alert-dismissible fade show'>
                            User approved successfully.
                            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                        </div>";
        } else {
            $message = "<div class='alert alert-danger'>Failed to approve user.</div>";
        }

        mysqli_stmt_close($stmt);
    } elseif ($action == 'delete') {

        $stmt = mysqli_prepare($conn, "DELETE FROM users WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $user_id);

        if (mysqli_stmt_execute($stmt)) {
            $message = "<div class='alert alert-success alert-dismissible fade show'>
                            User deleted successfully.
                            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                        </div>";
        } else {
            $message = "<div class='alert alert-danger'>Failed to delete user.</div>";
        }

        mysqli_stmt_close($stmt);
    }
}


// Query for Tenants 
$sql = "SELECT `id`,`name`, `email`,`role`,`phone`, `status`, `created_at` FROM users WHERE `role` = 'tenant' AND `status` = 'approved'";
$result_tenant = mysqli_query($conn, $sql);

// Query for Renters 
$sql = "SELECT `id`,`name`, `email`,`role`,`phone`, `status`, `created_at` FROM users WHERE `role` = 'renter' AND `status` = 'approved'";
$result_renter = mysqli_query($conn, $sql);

?>

<?php include __DIR__ . '/../includes/header.php' ?>

<body>
    <!-- Top Navbar -->
    <?php include __DIR__ . '/../includes/nav.php' ?>

    <!-- Sidebar Navigation -->
    <?php include __DIR__ . '/sidebar.php' ?>

    <div class="main-content mt-4">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <h1 class="dashboard-title">User Management</h1>
            <p class="dashboard-subtitle">Review, approve, and manage system users efficiently</p>
        </div>


        <div class="row">
            <div class="col-md-12">
                <!-- Add Form Here -->
                <div class="container-fluid ">
                    <div class="row justify-content-center">
                        <div class="col-12">

                            <!-- Table Container -->
                            <?php echo $message; ?>
                            <div class="card shadow-lg border-0 overflow-hidden mb-4">
                                <div class="card-header bg-danger text-white py-3">
                                    <h5 class="mb-0 fw-bold">
                                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                        TENANTS
                                    </h5>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-danger table-hover mb-0 align-middle">
                                            <thead class="table-dark sticky-top">
                                                <tr>
                                                    <th scope="col" class="border-0 fw-bold text-white py-3">Name</th>
                                                    <th scope="col" class="border-0 fw-bold text-white py-3">Email</th>
                                                    <th scope="col" class="border-0 fw-bold text-white py-3">Phone</th>
                                                    <th scope="col" class="border-0 fw-bold text-white py-3">Status</th>
                                                    <th scope="col" class="border-0 fw-bold text-white py-3">Created At</th>
                                                    <th scope="col" class="border-0 fw-bold text-white py-3">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (mysqli_num_rows($result_tenant) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result_tenant)) {

                                                        echo "<tr>";
                                                        echo "<td>{$row['name']}</td>";
                                                        echo "<td>{$row['email']}</td>";
                                                        echo "<td>{$row['phone']}</td>";
                                                        echo "<td>";

                                                        // Status Badge
                                                        if ($row['status'] == 'pending') {
                                                            echo "<span class='badge bg-warning'>Pending</span>";
                                                        } elseif ($row['status'] == 'approved') {
                                                            echo "<span class='badge bg-success'>Active</span>";
                                                        } else {
                                                            echo "<span class='badge bg-danger'>Rejected</span>";
                                                        }

                                                        echo "</td>";
                                                        echo "<td>{$row['created_at']}</td>";

                                                        // ACTION BUTTONS
                                                        echo "<td>";

                                                        if ($row['status'] == 'pending') {

                                                            echo "
                                                                <form method='POST' class='d-inline'>
                                                                    <input type='hidden' name='user_id' value='{$row['id']}'>
                                                                    <button name='action' value='accept' class='btn btn-success btn-sm'>Accept</button>
                                                                </form>

                                                                <form method='POST' class='d-inline'>
                                                                    <input type='hidden' name='user_id' value='{$row['id']}'>
                                                                    <button name='action' value='delete' class='btn btn-danger btn-sm'
                                                                        onclick=\"return confirm('Are you sure you want to delete this user?');\">
                                                                        Delete
                                                                    </button>
                                                                </form>
                                                                ";
                                                        } else {

                                                            echo "
                                                                <form method='POST' class='d-inline'>
                                                                    <input type='hidden' name='user_id' value='{$row['id']}'>
                                                                    <button name='action' value='delete' class='btn btn-outline-danger btn-sm'
                                                                        onclick=\"return confirm('Delete this user?');\">
                                                                        Delete
                                                                    </button>
                                                                </form>
                                                                ";
                                                        }

                                                        echo "</td>";
                                                        echo "</tr>";
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='6' class='text-center'>No users found</td></tr>";
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

                            <!-- RENTERS -->

                            <!-- Table Container -->
                            <div class="card shadow-lg border-0 overflow-hidden">
                                <div class="card-header bg-danger text-white py-3">
                                    <h5 class="mb-0 fw-bold">
                                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                        RENTERS
                                    </h5>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-danger table-hover mb-0 align-middle">
                                            <thead class="table-dark sticky-top">
                                                <tr>
                                                    <th scope="col" class="border-0 fw-bold text-white py-3">Name</th>
                                                    <th scope="col" class="border-0 fw-bold text-white py-3">Email</th>
                                                    <th scope="col" class="border-0 fw-bold text-white py-3">Phone</th>
                                                    <th scope="col" class="border-0 fw-bold text-white py-3">Status</th>
                                                    <th scope="col" class="border-0 fw-bold text-white py-3">Created At</th>
                                                    <th scope="col" class="border-0 fw-bold text-white py-3">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (mysqli_num_rows($result_renter) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result_renter)) {

                                                        echo "<tr>";
                                                        echo "<td>{$row['name']}</td>";
                                                        echo "<td>{$row['email']}</td>";
                                                        echo "<td>{$row['phone']}</td>";
                                                        echo "<td>";

                                                        // Status Badge
                                                        if ($row['status'] == 'pending') {
                                                            echo "<span class='badge bg-warning'>Pending</span>";
                                                        } elseif ($row['status'] == 'approved') {
                                                            echo "<span class='badge bg-success'>Active</span>";
                                                        } else {
                                                            echo "<span class='badge bg-danger'>Rejected</span>";
                                                        }

                                                        echo "</td>";
                                                        echo "<td>{$row['created_at']}</td>";

                                                        // ACTION BUTTONS
                                                        echo "<td>";

                                                        if ($row['status'] == 'pending') {

                                                            echo "
                                                                <form method='POST' class='d-inline'>
                                                                    <input type='hidden' name='user_id' value='{$row['id']}'>
                                                                    <button name='action' value='accept' class='btn btn-success btn-sm'>Accept</button>
                                                                </form>

                                                                <form method='POST' class='d-inline'>
                                                                    <input type='hidden' name='user_id' value='{$row['id']}'>
                                                                    <button name='action' value='delete' class='btn btn-danger btn-sm'
                                                                        onclick=\"return confirm('Are you sure you want to delete this user?');\">
                                                                        Delete
                                                                    </button>
                                                                </form>
                                                                ";
                                                        } else {

                                                            echo "
                                                                <form method='POST' class='d-inline'>
                                                                    <input type='hidden' name='user_id' value='{$row['id']}'>
                                                                    <button name='action' value='delete' class='btn btn-outline-danger btn-sm'
                                                                        onclick=\"return confirm('Delete this user?');\">
                                                                        Delete
                                                                    </button>
                                                                </form>
                                                                ";
                                                        }

                                                        echo "</td>";
                                                        echo "</tr>";
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='6' class='text-center'>No users found</td></tr>";
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
                </div>
                <!-- End of Form -->

            </div>
        </div>
    </div> <!-- Custom JS for file input label -->
    <script>
        // Update file input label when files are selected
        document.getElementById('imagesUpload').addEventListener('change', function(e) {
            const fileName = e.target.files[0] ? e.target.files[0].name : 'Choose images';
            const label = e.target.nextElementSibling;
            const count = e.target.files.length;
            label.innerHTML = count > 1 ?
                `<i class="bi bi-images me-2"></i>${count} images selected` :
                `<i class="bi bi-image me-2"></i>${fileName}`;
        });
    </script>

    <?php include __DIR__ . '/../includes/footer.php' ?>