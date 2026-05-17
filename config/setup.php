<?php
// ================= DATABASE CONFIG =================
$host = "localhost";
$user = "root";
$pass = "";
$db_name = "iTrack_db";

// ================= CONNECT =================
$conn = new mysqli($host, $user, $pass);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ================= CREATE DATABASE =================
$sql = "CREATE DATABASE IF NOT EXISTS $db_name";
$conn->query($sql);

$conn->select_db($db_name);

// =====================================================
// USERS TABLE
// =====================================================
$sql = "CREATE TABLE IF NOT EXISTS users (

    id INT AUTO_INCREMENT PRIMARY KEY,

    name VARCHAR(150) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,

    role ENUM(
        'admin',
        'tenant',
        'renter'
    ) NOT NULL,

    status ENUM(
        'pending',
        'approved',
        'rejected',
        'suspended'
    ) DEFAULT 'pending',

    phone VARCHAR(30),

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ON UPDATE CURRENT_TIMESTAMP

)";
$conn->query($sql);

// =====================================================
// LISTINGS TABLE
// =====================================================
$sql = "CREATE TABLE IF NOT EXISTS listings (

    id INT AUTO_INCREMENT PRIMARY KEY,

    tenant_id INT NOT NULL,

    house_name VARCHAR(255) NOT NULL,

    address VARCHAR(255) NOT NULL,

    property_type ENUM(
        'Boarding House',
        'Lodging House',
        'Pension House'
    ) NOT NULL,

    payment_type ENUM(
        'monthly',
        'night'
    ) NOT NULL,

    price DECIMAL(10,2) NOT NULL,

    description TEXT,

    cover_photo VARCHAR(255),

    map_link TEXT,

    status ENUM(
        'available',
        'not_available'
    ) DEFAULT 'available',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (tenant_id)
    REFERENCES users(id)
    ON DELETE CASCADE

)";
$conn->query($sql);

// =====================================================
// LISTING PHOTOS TABLE
// =====================================================
$sql = "CREATE TABLE IF NOT EXISTS listing_photos (

    id INT AUTO_INCREMENT PRIMARY KEY,

    listing_id INT NOT NULL,

    image_path VARCHAR(255) NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (listing_id)
    REFERENCES listings(id)
    ON DELETE CASCADE

)";
$conn->query($sql);

// =====================================================
// RESERVATIONS TABLE
// =====================================================
$sql = "CREATE TABLE IF NOT EXISTS reservations (

    id INT AUTO_INCREMENT PRIMARY KEY,

    listing_id INT NOT NULL,

    renter_id INT NOT NULL,

    check_in_date DATE NOT NULL,

    check_out_date DATE NOT NULL,

    total_price DECIMAL(10,2),

    message TEXT,

    status ENUM(
        'pending',
        'approved',
        'rejected',
        'cancelled',
        'refunded',
        'completed'
    ) DEFAULT 'pending',

    -- renter cancellation / rejection message
    rejected_reason TEXT,

    -- tenant refund note
    refund_note TEXT,

    payment_method VARCHAR(50)
    DEFAULT 'GCash',

    payment_reference VARCHAR(100),

    -- renter payment proof
    payment_proof VARCHAR(255),

    -- tenant refund proof
    proof_image VARCHAR(255),

    payment_status ENUM(
        'pending',
        'approved',
        'rejected',
        'cancelled',
        'refunded',
        'completed'
    ) DEFAULT 'pending',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (listing_id)
    REFERENCES listings(id)
    ON DELETE CASCADE,

    FOREIGN KEY (renter_id)
    REFERENCES users(id)
    ON DELETE CASCADE

)";
$conn->query($sql);

// =====================================================
// PAYMENTS TABLE
// =====================================================
$sql = "CREATE TABLE IF NOT EXISTS payments (

    id INT AUTO_INCREMENT PRIMARY KEY,

    reservation_id INT NOT NULL,

    amount DECIMAL(10,2) NOT NULL,

    payment_method VARCHAR(50)
    DEFAULT 'GCash',

    reference_no VARCHAR(100),

    status ENUM(
        'pending',
        'verified',
        'rejected',
        'refunded',
        'completed'
    ) DEFAULT 'pending',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (reservation_id)
    REFERENCES reservations(id)
    ON DELETE CASCADE

)";
$conn->query($sql);

// =====================================================
// DEFAULT ADMIN
// =====================================================
$check = $conn->query("
    SELECT id
    FROM users
    WHERE role = 'admin'
    LIMIT 1
");

if ($check && $check->num_rows == 0) {

    $name = "Admin";

    $email = "admin@gmail.com";

    $password = password_hash(
        "admin123",
        PASSWORD_DEFAULT
    );

    $stmt = $conn->prepare("
        INSERT INTO users (
            name,
            email,
            password_hash,
            role,
            status
        )
        VALUES (
            ?, ?, ?,
            'admin',
            'approved'
        )
    ");

    $stmt->bind_param(
        "sss",
        $name,
        $email,
        $password
    );

    $stmt->execute();
}
?>