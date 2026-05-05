    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <i class="fas fa-home me-2"></i>iTrackRent
                </a>
            </div>
            <div class="ms-auto d-flex align-items-center">
                <span class="me-3"><?= $_SESSION['user_name']; ?></span>
                <div class="dropdown">
                    <a class="dropdown-toggle d-flex align-items-center text-decoration-none" href="#" role="button" data-bs-toggle="dropdown">
                        <img src="../assets/images/user1.webp" class="rounded-circle" width="40" height="40" alt="Profile">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>