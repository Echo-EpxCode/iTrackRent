<?php
// ================= START SESSION =================
session_start();

// ================= DATABASE CONNECTION =================
include_once __DIR__ . '/../config/setup.php';

// ================= MESSAGE HANDLING =================
$message = "";

// Check for flash message from session (e.g., from registration)
if (isset($_SESSION['flash_message'])) {
    $message = $_SESSION['flash_message'];
    unset($_SESSION['flash_message']);
}

// ================= LOGIN PROCESS =================
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $message = "<div class='alert alert-danger'>Email and Password are required.</div>";
    } else {

        $stmt = mysqli_prepare($conn, "SELECT id, name, email, password_hash, role, status FROM users WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {

            if (password_verify($password, $row['password_hash'])) {

                // ================= STATUS CHECK =================
                if ($row['status'] !== 'approved') {
                    $message = "<div class='alert alert-warning'>Account not yet approved.</div>";
                } else {

                    // ================= SESSION =================
                    $_SESSION['user_id']   = $row['id'];
                    $_SESSION['user_name'] = $row['name'];
                    $_SESSION['user_role'] = $row['role'];

                    // ================= UPDATE LOGIN TIME =================
                    $update = mysqli_prepare($conn, "UPDATE users SET updated_at = NOW() WHERE id = ?");
                    mysqli_stmt_bind_param($update, "i", $row['id']);
                    mysqli_stmt_execute($update);
                    mysqli_stmt_close($update);

                    // ================= ROLE REDIRECT =================
                    if ($row['role'] === 'tenant') {
                        header("Location: ../tenant/dashboard.php");
                        exit;
                    } elseif ($row['role'] === 'renter') {
                        header("Location: ../renter/dashboard.php");
                        exit;
                    } else {
                        header("Location: login.php");
                        exit;
                    }
                }
            } else {
                $message = "<div class='alert alert-danger'>Invalid password.</div>";
            }
        } else {
            $message = "<div class='alert alert-danger'>Email not found.</div>";
        }

        mysqli_stmt_close($stmt);
    }
}
