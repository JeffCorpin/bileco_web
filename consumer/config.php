<?php
$servername = "localhost"; // Change if needed
$username = "root"; // Default XAMPP user
$password = ""; // Default XAMPP password (empty)
$database = "bileco_system"; // Your database name

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
