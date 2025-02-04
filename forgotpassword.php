<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "bileco_system";

// Include PHPMailer files
// OR for manual download:
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Create database connection
$connection = new mysqli($servername, $username, $password, $database);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accountnum = $_POST["accountnum"];
    $email = $_POST["email"];

    $stmt = $connection->prepare("SELECT id FROM consumer WHERE accountnum = ? AND email = ?");
    $stmt->bind_param("ss", $accountnum, $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $otp = rand(100000, 999999);
        $_SESSION["reset_otp"] = $otp;
        $_SESSION["reset_email"] = $email;

        $mail = new PHPMailer(true);

        try {
            // SMTP Configuration
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'jeffcorpin03@gmail.com'; // Your email address
            $mail->Password   = 'xapc poty zwab qfor'; // Replace with your App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Email Content
            $mail->setFrom('jeffcorpin03@gmail.com', 'BILECO Support');
            $mail->addAddress($email); 
            $mail->Subject = 'Password Reset OTP';
            $mail->Body    = "Your OTP for password reset is: $otp";

            if ($mail->send()) {
                header("Location: verify_otp.php");
                exit();
            } else {
                $message = "Failed to send OTP. Please try again.";
            }
        } catch (Exception $e) {
            $message = "Mailer Error: " . $mail->ErrorInfo;
        }
    } else {
        $message = "No account found with that Account Number and Email.";
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
                <p class="text-center">Forgot Password</p>
                <form action="" method="post">
                  <div class="mb-3">
                    <label for="accountnum" class="form-label">Account Number</label>
                    <input type="text" name="accountnum" class="form-control" id="accountnum" required>
                  </div>
                  <div class="mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" id="email" required>
                  </div>
                 
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Send OTP</button>
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
