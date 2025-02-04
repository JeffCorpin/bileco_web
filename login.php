<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "bileco_system";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accountnum = $_POST["accountnum"];
    $password = $_POST["password"];

    // Prepare statement to prevent SQL Injection
    $stmt = $connection->prepare("SELECT id, accountnum, hashedpassword FROM consumer WHERE accountnum = ?");
    $stmt->bind_param("s", $accountnum);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $accountnum, $hashedpassword);
        $stmt->fetch();

        if (password_verify($password, $hashedpassword)) {
            $_SESSION["loggedin"] = true;
            $_SESSION["accountnum"] = $accountnum;
            $_SESSION["id"] = $id;
            header("Location: /bileco/consumer/index.php");
            exit;
        } else {
            $error = "Invalid account number or password.";
        }
    } else {
        $error = "No account found with that account number.";
    }
    $stmt->close();

    // Prepare statement to prevent SQL Injection
    $stmt = $connection->prepare("SELECT id, accountnum, hashedpassword FROM admins WHERE accountnum = ?");
    $stmt->bind_param("s", $accountnum);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $accountnum, $hashedpassword);
        $stmt->fetch();

        if (password_verify($password, $hashedpassword)) {
            $_SESSION["loggedin"] = true;
            $_SESSION["accountnum"] = $accountnum;
            $_SESSION["id"] = $id;
            header("Location: /bileco/admin/index.php");
            exit;
        } else {
            $error = "Invalid accountnum or password.";
        }
    } else {
        $error = "No account found with that account number.";
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
                <p class="text-center">Bileco</p>
                <form action="login.php" method="post">
                  <div class="mb-3">
                    <label for="accountnum" class="form-label">Account Number</label>
                    <input type="accountnum" name="accountnum" class="form-control" id="accountnum" required>
                  </div>
                  <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                      <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                      <label class="form-check-label text-dark" for="flexCheckChecked">
                        Remember this Device
                      </label>
                    </div>
                    <a class="text-primary fw-bold" href="forgotpassword.php">Forgot Password?</a>
                  </div>
                  <?php if (!empty($error)) echo "<p class='text-danger'>$error</p>"; ?>
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign In</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <a class="text-primary fw-bold ms-2" href="consumercreate.php">Create an account</a>
                  </div>
                </form>
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
