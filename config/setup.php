<?php
// Basic PHP - No classes, no PDO, pure mysqli
$host = 'localhost';
$username = 'root';        // Change this
$password = '';            // Change this
$dbname = 'iTrack_db';

// Function to connect to MySQL
function connect($host, $username, $password)
{
    $conn = mysqli_connect($host, $username, $password);
    if (!$conn) {
        die("❌ Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}

// Step 1: Connect and create database

$conn = connect($host, $username, $password);

// Create database if not exists
$createDB = "CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
if (!mysqli_query($conn, $createDB)) {
    die("❌ Database creation failed: " . mysqli_error($conn));
}

// Step 2: Select database and create table
mysqli_select_db($conn, $dbname);

$createTable = "
    CREATE TABLE IF NOT EXISTS `user_tbl` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `full_name` VARCHAR(100) NOT NULL,
        `email` VARCHAR(100) NOT NULL UNIQUE,
        `phone_no` VARCHAR(20) NOT NULL,
        `password` VARCHAR(255) NOT NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        `is_active` TINYINT(1) DEFAULT 1,
        PRIMARY KEY (`id`),
        INDEX `idx_email` (`email`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
";

if (!mysqli_query($conn, $createTable)) {
    die("❌ Table creation failed: " . mysqli_error($conn));
}

// Step 3: Create user with hashed password
$password = 'user123';           // Your password
$full_name_val = 'user';
$email_val = 'user@example.com';
$phone_no_val = '1234567890';

$insertUser = "
    INSERT INTO `user_tbl` (`full_name`, `email`, `phone_no`, `password`) 
    VALUES ('$full_name_val', '$email_val', '$phone_no_val', '$password')
    ON DUPLICATE KEY UPDATE `updated_at` = CURRENT_TIMESTAMP
";

if (mysqli_query($conn, $insertUser)) {
    $user_id = mysqli_insert_id($conn);
} else {
    echo "⚠️ Insert warning: " . mysqli_error($conn) . "\n";
}

// Step 4: Show all users
$result = mysqli_query($conn, "SELECT * FROM `user_tbl` ORDER BY `id` DESC LIMIT 5");


mysqli_close($conn);
