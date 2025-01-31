<?php
// Start the session
session_start();

// Check if the user is authenticated
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page
    header('Location: \session.php');
    exit;
}

// Your page content goes here
?>
