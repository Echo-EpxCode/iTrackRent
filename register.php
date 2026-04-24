<?php
include 'config/setup.php';

if (isset($_POST['submit'])) {
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone_no = mysqli_real_escape_string($conn, $_POST['phone_no']);
    $password = mysqli_real_escape_string($conn, $_POST['pasword']);

    $sql = "INSERT INTO `user_tbl` (`full_name`, `email`, `phone_no`, `password`) 
            VALUES ('$full_name', '$email', '$phone_no', '$password')";

    if (mysqli_query($conn, $sql)) {
        header('location: login.php');
    } else {
        echo "❌ Error: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - iTrackRent</title>

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

    <!-- Main Register Container -->
    <div class="login-container">
        <!-- Single Row with 2 Full-Height Divisions -->
        <div class="login-row">
            <!-- FIRST DIVISION: Form Section -->
            <div class="form-division">
                <!-- Form Container FILLS ENTIRE DIVISION -->
                <div class="login-form-container">
                    <h1 class="form-title">Register</h1>

                    <form action="<?= $_SERVER['PHP_SELF'] ?> ?>" method="POST" id="loginForm">
                        <div class="form-group">
                            <input type="text" class="form-input" placeholder="Full Name" name="full_name" required>
                            <i class="fas fa-envelope form-icon"></i>
                        </div>

                        <div class="form-group">
                            <input type="number" class="form-input" placeholder="Phone no." name="phone_no" required>
                            <i class="fas fa-envelope form-icon"></i>
                        </div>

                        <div class="form-group">
                            <input type="email" class="form-input" placeholder="Username" name="email" required>
                            <i class="fas fa-envelope form-icon"></i>
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-input" placeholder="Password" name="pasword" required>
                            <i class="fas fa-lock form-icon"></i>
                        </div>

                        <button type="submit" name="submit" class="btn-login">
                            <i class="fas fa-arrow-right me-2"></i>Register
                        </button>

                        <div class="divider">
                            <span>or</span>
                        </div>

                        <div class="auth-links">
                            <p>Aready have an account? <a href="login.php">Login</a></p>
                        </div>
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
        // Input placeholder animation
        document.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('focus', function() {
                this.setAttribute('placeholder', this.getAttribute('placeholder') || '');
            });
        });
    </script>
</body>

</html>