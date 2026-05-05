<?php
include __DIR__ . '/process_register.php';
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
    <link rel="stylesheet" href="../assets/css/form.css">
</head>

<body>
    <!-- Navbar (Exact from landing page) -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="../index.php">
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
                    <!-- ALERT -->
                    <?php echo $message; ?>

                    <!-- FORM -->

                    <h1 class="form-title">Register</h1>

                    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" id="loginForm">
                        <div class="form-group">
                            <select name="role" class="form-select form-input" required>
                                <option value="" disabled selected>Register as</option>
                                <option value="tenant">Tenant</option>
                                <option value="renter">Renter</option>
                            </select>

                            <i class="fas fa-user-tag form-icon"></i>
                        </div>

                        <div class="form-group">
                            <input type="text"
                                class="form-input"
                                name="name"
                                placeholder="Full Name"
                                minlength="3"
                                maxlength="100"
                                pattern="[A-Za-zÀ-ÿ\s\.\-]+"
                                title="Letters, spaces, dot (.) and hyphen (-) only"
                                required>

                            <i class="fas fa-user form-icon"></i>
                        </div>

                        <div class="form-group">
                            <input type="text"
                                class="form-input"
                                name="phone"
                                placeholder="Phone no. (09XXXXXXXXX)"
                                maxlength="11"
                                pattern="09[0-9]{9}"
                                required>

                            <i class="fas fa-phone form-icon"></i>
                        </div>

                        <div class="form-group">
                            <input type="email"
                                class="form-input"
                                placeholder="Email Address"
                                name="email"
                                required>

                            <i class="fas fa-envelope form-icon"></i>
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-input" placeholder="Password" name="password" required>
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
                <img src="./../assets/images/wallpaper.jpg"
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