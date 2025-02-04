<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "bileco_system";

$connection = new mysqli($servername, $username, $password, $database);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $email = $_SESSION["reset_email"];

    // Update the password in the database
    $stmt = $connection->prepare("UPDATE consumer SET hashedpassword = ? WHERE email = ?");
    $stmt->bind_param("ss", $new_password, $email);

    if ($stmt->execute()) {
        $message = "Password reset successfully. <a href='login.php'>Login here</a>";
        unset($_SESSION["reset_otp"]); // Remove OTP session
        unset($_SESSION["reset_email"]); // Remove email session
    } else {
        $message = "Error updating password.";
    }
    $stmt->close();
}
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset Password</h2>
    <form method="POST">
        <label>New Password:</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit">Reset Password</button>
    </form>
    <p><?php echo $message; ?></p>
</body>
</html>
