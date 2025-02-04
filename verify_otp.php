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
                <p class="text-center">Verify OTP</p>
                <form action="" method="post">
                  <div class="mb-4">
                    <label for="" class="form-label">Enter OTP</label>
                    <input type="text" name="otp" class="form-control" id="" required>
                  </div>
                 
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Verify</button>
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
