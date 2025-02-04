<?php
session_start();

// Check if admin is logged in; adjust session variable as needed
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

include 'header.php'; // Include your header

$servername = "localhost";  // Change if your database is hosted elsewhere
$username   = "root";       // Your MySQL username
$password   = "";           // Your MySQL password
$database   = "bileco_system";  // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character encoding to UTF-8
$conn->set_charset("utf8");

$user_id = $_SESSION['id']; // Retrieve admin ID from session

// Fetch admin details from the admins table
$sql  = "SELECT * FROM admins WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user   = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Profile</title>
    <!-- Include any additional CSS or meta tags here -->
</head>
<body>
<div class="container mt-4">
    <h2>Admin Profile</h2>
    <?php if ($user): ?>
        <table class="table">
            <tr>
                <th>Account Number:</th>
                <td><?= htmlspecialchars($user['accountnum']); ?></td>
            </tr>
            <tr>
                <th>First Name:</th>
                <td><?= htmlspecialchars($user['firstname']); ?></td>
            </tr>
            <tr>
                <th>Middle Name:</th>
                <td><?= htmlspecialchars($user['middlename']); ?></td>
            </tr>
            <tr>
                <th>Last Name:</th>
                <td><?= htmlspecialchars($user['lastname']); ?></td>
            </tr>
            <tr>
                <th>Email:</th>
                <td><?= htmlspecialchars($user['email']); ?></td>
            </tr>
            <tr>
                <th>Address:</th>
                <td><?= htmlspecialchars($user['address']); ?></td>
            </tr>
            <tr>
                <th>Contact Number:</th>
                <td><?= htmlspecialchars($user['contactnumber']); ?></td>
            </tr>
        </table>
    <?php else: ?>
        <p>User not found.</p>
    <?php endif; ?>
</div>
</body>
</html>
