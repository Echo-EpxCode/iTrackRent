<?php
// ================= START SESSION =================
session_start();

// ================= DATABASE CONNECTION =================
include_once __DIR__ . '/config/setup.php';

// ================= MESSAGE HANDLING =================
$message = "";

// Check for flash message from session (e.g., from registration)
if (isset($_SESSION['flash_message'])) {
    $message = $_SESSION['flash_message'];
    unset($_SESSION['flash_message']);
}

// ================= LOGIN PROCESS =================
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // ================= INPUT =================
    $username = trim($_POST['email']);
    $password = trim($_POST['password']);

    // ================= VALIDATION =================
    if (empty($username) || empty($password)) {
        $_SESSION['flash_message'] = "<div class='alert alert-danger'>Username and password are required.</div>";
        header("Location:admin-login.php");
        exit;
    }

    // ================= QUERY =================
    $stmt = $conn->prepare("SELECT id, name, email, password_hash, role, status 
                        FROM users 
                        WHERE email = ? AND role = 'admin' LIMIT 1");

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // ================= CHECK USER =================
    if ($result->num_rows === 1) {

        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password_hash'])) {

            if ($user['status'] !== 'approved') {
                $_SESSION['flash_message'] = "<div class='alert alert-warning'>Admin account is not active.</div>";
                header("Location:admin-login.php");
                exit;
            }

            // ================= SUCCESS =================
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_role'] = $user['role'];

            header("Location: /admin/dashboard.php");
            exit;
        } else {
            $_SESSION['flash_message'] = "<div class='alert alert-danger'>Invalid password.</div>";
            header("Location:admin-login.php");
            exit;
        }
    } else {
        $_SESSION['flash_message'] = "<div class='alert alert-danger'>Admin not found.</div>";
        header("Location:admin-login.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - iTrackRent</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/form.css">
</head>

<body>
    <!-- Navbar (Exact from landing page) -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/index.php">
                <i class="fas fa-home me-2"></i>iTrackRent
            </a>
        </div>
    </nav>

    <!-- Main Login Container -->
    <div class="login-container">
        <!-- Single Row with 2 Full-Height Divisions -->
        <div class="login-row">
            <!-- FIRST DIVISION: Form Section -->
            <div class="form-division">
                <!-- Form Container FILLS ENTIRE DIVISION -->
                <div class="login-form-container">
                    <h1 class="form-title">Admin Login</h1>

                    <!-- ALERT -->
                    <?php echo $message; ?>

                    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" id="loginForm">
                        <div class="form-group">
                            <input type="email" class="form-input" placeholder="Username" name="email" required>
                            <i class="fas fa-envelope form-icon"></i>
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-input" placeholder="Password" name="password" required>
                            <i class="fas fa-lock form-icon"></i>
                        </div>

                        <button type="submit" name="submit" class="btn-login">
                            <i class="fas fa-arrow-right me-2"></i>Login

                        </button>
                    </form>

                </div>
            </div>

            <!-- SECOND DIVISION: Visual Section -->
            <div class="visual-division">
                <div class="visual-overlay"></div>
                <!-- Centered Image FILLS ENTIRE DIVISION -->
                <img src="./assets/images/wallpaper.jpg"
                    alt="Modern Boarding House Room" class="visual-image">
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Form handling
        // document.getElementById('loginForm').addEventListener('submit', function(e) {
        //     e.preventDefault();
        //     // Simulate login
        //     const formData = new FormData(this);
        //     console.log('Login attempt:', Object.fromEntries(formData));
        //     alert('Login successful!');
        // });

        // Input placeholder animation
        document.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('focus', function() {
                this.setAttribute('placeholder', this.getAttribute('placeholder') || '');
            });
        });
    </script>
</body>

</html>