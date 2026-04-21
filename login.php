<?php
session_start();
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'iTrack_db';

$conn = mysqli_connect($host, $username, $password, $dbname);

$error = '';

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password_input = $_POST['password'];

    $sql = "SELECT * FROM `user_tbl` WHERE `email` = '$email' AND `is_active` = 1";
    $result = mysqli_query($conn, $sql);

    if ($user = mysqli_fetch_assoc($result)) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['email'] = $user['email'];
        header("Location: public/dashboard.php");
    } else {
        $error = "❌ Email not found!";
    }
}
mysqli_close($conn);
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
    <link rel="stylesheet" href="assets/css/form.css">
</head>

<body>
    <!-- Navbar (Exact from landing page) -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
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
                    <h1 class="form-title">Sign In</h1>

                    <?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>

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
                            <a class="nav-link" href="public/dashboard.php"><i class="fas fa-arrow-right me-2"></i>Login</a>
                        </button>

                        <div class="divider">
                            <span>or</span>
                        </div>

                        <div class="auth-links">
                            <p>Don't have an account? <a href="register.php">Sign up</a></p>
                        </div>
                    </form>

                </div>
            </div>

            <!-- SECOND DIVISION: Visual Section -->
            <div class="visual-division">
                <div class="visual-overlay"></div>
                <!-- Centered Image FILLS ENTIRE DIVISION -->
                <img src="./assets/images/wall.jpg"
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