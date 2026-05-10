<?php
// ================= DATABASE CONNECTION =================
$host = "localhost";
$user = "root";
$pass = "";
$db   = "iTrack_db";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


// ================= FORM HANDLING =================
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize input
    $name  = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $role  = htmlspecialchars($_POST['role']);

    $password = $_POST['password'];

    // Validate
    if (empty($name) || empty($email) || empty($password) || empty($role)) {
        $message = "<div class='alert alert-danger'>All required fields must be filled.</div>";
    } else {

        // Hash password
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Default values
        $status = "active";
        $profile_photo = "default.png";

        // ================= INSERT DATA =================
        $stmt = mysqli_prepare($conn, "INSERT INTO users (name, email, password_hash, role, status, profile_photo, phone) VALUES (?, ?, ?, ?, ?, ?, ?)");

        mysqli_stmt_bind_param($stmt, "sssssss", $name, $email, $password_hash, $role, $status, $profile_photo, $phone);

        if (mysqli_stmt_execute($stmt)) {
            $message = "<div class='alert alert-success alert-dismissible fade show'>
                            Registration successful!
                            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                        </div>";
        } else {
            $message = "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
        }

        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>User Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow">
                    <div class="card-header text-center">
                        <h4>Register</h4>
                    </div>

                    <div class="card-body">

                        <!-- ALERT -->
                        <?php echo $message; ?>

                        <!-- FORM -->
                        <form method="POST">

                            <div class="mb-3">
                                <label class="form-label">Full Name *</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email *</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Role *</label>
                                <select name="role" class="form-select" required>
                                    <option value="">Select Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="tenant">Tenant</option>
                                    <option value="renter">Renter</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password *</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>