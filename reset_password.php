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
        unset($_SESSION["reset_otp"]); // Remove OTP session
        unset($_SESSION["reset_email"]); // Remove email session
        $stmt->close();
        $connection->close();
        
        // Redirect to login page
        header("Location: login.php");
        exit(); // Ensure script stops execution after redirection
    } else {
        $message = "Error updating password.";
    }
    $stmt->close();
}
$connection->close();
?>


<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bileco</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/logos/bilecologo.png" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />
</head>
<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="#" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="assets/images/logos/bilecologo.png" width="180" alt="">
                </a>
                <p class="text-center">Reset Password</p>
                <form action="" method="post">
                  <div class="mb-4">
                    <label for="" class="form-label">New Password</label>
                    <input type="password" name="password" class="form-control" id="" required>
                  </div>
                 
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Reset Password</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <a class="text-primary fw-bold ms-2" href="login.php">Cancel</a>
                  </div>
                </form>
                <p><?php echo $message; ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
