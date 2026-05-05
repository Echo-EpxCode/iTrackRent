<?php
session_start();

// ================= DATABASE CONNECTION =================
include_once __DIR__ . '/../config/setup.php';

// ================= FORM HANDLING =================
$message = "";

if (isset($_SESSION['flash_message'])) {
    $message = $_SESSION['flash_message'];
    unset($_SESSION['flash_message']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize input
    $name  = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $role  = htmlspecialchars($_POST['role']);
    $password = $_POST['password'];

    // ================= VALIDATION =================
    if (empty($name) || empty($email) || empty($password) || empty($role)) {
        $_SESSION['flash_message'] = "<div class='alert alert-danger'>All required fields must be filled.</div>";
        header("Location: register.php");
        exit;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['flash_message'] = "<div class='alert alert-danger'>Invalid email format.</div>";
        header("Location: register.php");
        exit;
    } else {

        // ================= CHECK EMAIL EXISTS =================
        $check_stmt = mysqli_prepare($conn, "SELECT id FROM users WHERE email = ?");
        mysqli_stmt_bind_param($check_stmt, "s", $email);
        mysqli_stmt_execute($check_stmt);
        mysqli_stmt_store_result($check_stmt);

        if (mysqli_stmt_num_rows($check_stmt) > 0) {
            $_SESSION['flash_message'] = "<div class='alert alert-warning'>Email already registered.</div>";
            mysqli_stmt_close($check_stmt);
            header("Location: register.php");
            exit;
        } else {

            // ================= PROCESS DATA =================
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            if ($role === 'tenant') {
                $status = "pending";
            } else {
                $status = "approved";
            }

            // ================= INSERT =================
            $stmt = mysqli_prepare(
                $conn,
                "INSERT INTO users (name, email, password_hash, role, status, phone, created_at, updated_at) 
                 VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())"
            );

            mysqli_stmt_bind_param(
                $stmt,
                "ssssss",
                $name,
                $email,
                $password_hash,
                $role,
                $status,
                $phone
            );

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                mysqli_stmt_close($check_stmt);
                if ($role === 'tenant') {
                    $_SESSION['flash_message'] = "<div class='alert alert-success alert-dismissible fade show text-center'>Registration successful! <br> Waiting for approval.<button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
                    header("Location: register.php");
                    exit;
                } else {
                    $_SESSION['flash_message'] = "<div class='alert alert-success alert-dismissible fade show text-center'>Registration successful!.<button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
                    header("Location: login.php");
                    exit;
                }
            } else {
                mysqli_stmt_close($stmt);
                mysqli_stmt_close($check_stmt);
                $_SESSION['flash_message'] = "<div class='alert alert-danger'>Database error.</div>";
                header("Location: register.php");
                exit;
            }
        }
    }
}
