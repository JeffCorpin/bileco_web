<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
}

include 'header.php'; // Include your header

$servername = "localhost"; // Change this if your database is hosted elsewhere
$username = "root"; // Your MySQL username (default is "root" in XAMPP)
$password = ""; // Your MySQL password (default is empty in XAMPP)
$database = "bileco_system"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character encoding to UTF-8
$conn->set_charset("utf8");

$user_id = $_SESSION['id']; // Retrieve user ID from session

// Fetch user details from the consumer table
$sql = "SELECT * FROM consumer WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<html>
<head>
    <title>Profile</title>
    <style>
        .profile-image-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ddd;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h2>User Profile</h2>
    <?php if ($user): ?>
        <div class="profile-image-container">
            <?php 
            // Check if a profile image exists, else use a default image.
            $profileImage = !empty($user['profile_image']) ? htmlspecialchars($user['profile_image']) : 'default-profile.png'; 
            ?>
            <img src="<?= $profileImage; ?>" alt="Profile Picture" class="profile-image">
        </div>
        <table class="table">
            <tr><th>Account Number:</th><td><?= htmlspecialchars($user['accountnum']); ?></td></tr>
            <tr><th>First Name:</th><td><?= htmlspecialchars($user['firstname']); ?></td></tr>
            <tr><th>Middle Name:</th><td><?= htmlspecialchars($user['middlename']); ?></td></tr>
            <tr><th>Last Name:</th><td><?= htmlspecialchars($user['lastname']); ?></td></tr>
            <tr><th>Email:</th><td><?= htmlspecialchars($user['email']); ?></td></tr>
            <tr><th>Address:</th><td><?= htmlspecialchars($user['address']); ?></td></tr>
            <tr><th>Contact Number:</th><td><?= htmlspecialchars($user['contactnumber']); ?></td></tr>
        </table>
        <a href="edit_profile.php" class="btn btn-primary">Edit Profile</a>
    <?php else: ?>
        <p>User not found.</p>
    <?php endif; ?>
</div>
</body>
</html>
