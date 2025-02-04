<?php
session_start();
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $otp = $_POST["otp"];

    // Check if OTP matches
    if ($otp == $_SESSION["reset_otp"]) {
        header("Location: reset_password.php"); // Redirect to password reset page
        exit();
    } else {
        $message = "Invalid OTP. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Verify OTP</title>
</head>
<body>
    <h2>Verify OTP</h2>
    <form method="POST">
        <label>Enter OTP:</label>
        <input type="text" name="otp" required>
        <br>
        <button type="submit">Verify</button>
    </form>
    <p><?php echo $message; ?></p>
</body>
</html>
