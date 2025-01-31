<?php

  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "bileco_system";

  $connection = new mysqli($servername, $username, $password, $database);

  $firstname = "";
  $middlename = "";
  $lastname = "";
  $suffix = "";
  $address = "";
  $email = "";
  $contactnumber = "";
  $password = "";
  $confirmpassword = "";

  $errorMessage = "";
  $successMessage = "";

  if ( $_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST["firstname"];
    $middlename = $_POST["middlename"];
    $lastname = $_POST["lastname"];
    $suffix = $_POST["suffix"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $contactnumber = $_POST["contactnumber"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];


    do {
      $emailExistsQuery = "SELECT * FROM consumer WHERE email='$email'";
      $emailExistsResult = $connection->query($emailExistsQuery);
    if ($emailExistsResult->num_rows > 0) {
        $errorMessage = "Email already exists!";
    } else {
        // Email is unique, proceed with insertion
        if (empty($firstname) || empty($middlename) || empty($lastname) || empty($address) || empty($email) || empty($contactnumber) || empty($password) || empty($confirmpassword)) {
            $errorMessage = "All the fields are required";
        } else if ($password !== $confirmpassword) {
            $errorMessage = "Passwords do not match";
        } else {

            // Hash the password before storing
            $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
            // Perform the database insertion
            $sql = "INSERT INTO consumer (firstname, middlename, lastname, suffix, address, email, contactnumber, hashedpassword) VALUES ('$firstname', '$middlename', '$lastname', '$suffix', '$address', '$email', '$contactnumber', '$hashedpassword')";
            $result = $connection->query($sql);

            if (!$result) {
                $errorMessage = "Invalid Query: " . $connection->error;
            } else {
                $successMessage = "Account added successfully";
                // Clear form fields after successful insertion
                $firstname = "";
                $lastname = "";
                $address = "";
                $email = "";
                $contactnumber = "";
                $password = "";
                $confirmpassword = "";
            }
        }
    }
} while(false);

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
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="#" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="assets/images/logos/bilecologo.png" width="150" alt="">
                </a>
                <p class="text-center">WELCOME TO <strong>BILECO</strong></p>
                <p class="text-center">Register</p>

                <?php

                  if (!empty($errorMessage)) {
                    echo "
                      <div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
                        <strong>$errorMessage</strong>
                        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
                      </div>
                    ";
                    }


                  if (!empty($successMessage)) {
                      echo "
                          <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                            <strong>$successMessage</strong>
                            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
                          </div>
                      ";
                    }

                    if (!empty($successMessage)) {
                      echo '<script>setTimeout(function(){ window.location.href = "/bileco/consumer/index.php"; }, ' . rand(1000, 1000) . ');</script>';
                    }
                  ?>


                <form method="POST">
                  <div class="mb-4">
                    <label class="form-label">First Name</label>
                    <div>
                    <input type="text" class="form-control" name="firstname" value="<?php echo $firstname; ?>">
                    </div>
                  </div>
                  <div class="mb-4">
                    <label class="form-label">Middle Name</label>
                    <div>
                    <input type="text" class="form-control" name="middlename" value="<?php echo $middlename; ?>">
                    </div>
                  </div>
                  <div class="mb-4">
                    <label class="form-label">Last Name</label>
                    <div>
                    <input type="text" class="form-control" name="lastname" value="<?php echo $lastname; ?>">
                    </div>
                  </div>
                  <div class="mb-4">
                    <label class="form-label">Last Name</label>
                    <div>
                        <select class="form-select" name="suffix">
                          <option value="" <?php echo ($suffix == '') ? 'selected' : ''; ?>>No Suffix</option>
                          <option value="Jr." <?php echo ($suffix == 'Jr.') ? 'selected' : ''; ?>>Jr.</option>
                          <option value="Jra." <?php echo ($suffix == 'Jra.') ? 'selected' : ''; ?>>Jra.</option>
                          <option value="Sr." <?php echo ($suffix == 'Sr.') ? 'selected' : ''; ?>>Sr.</option>
                        </select>
                    </div>
                  </div>
                  <div class="mb-4">
                    <label class="form-label">Address</label>
                    <div>
                    <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
                    </div>
                  </div>
                  <div class="mb-4">
                    <label class="form-label">Email</label>
                    <div>
                    <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
                    </div>
                  </div>
                  <div class="mb-4">
                    <label class="form-label">Contact Number</label>
                    <div>
                    <input type="tel" class="form-control" name="contactnumber" value="<?php echo $contactnumber; ?>">
                    </div>
                  </div>
                  <div class="mb-4">
                    <label class="form-label">Password</label>
                    <div>
                    <input type="password" class="form-control" name="password" value="<?php echo $password; ?>">
                    </div>
                  </div>
                  <div class="mb-4">
                    <label class="form-label">Confirm Password</label>
                    <div>
                    <input type="password" class="form-control" name="confirmpassword" value="<?php echo $confirmpassword; ?>">
                    </div>
                  </div>

                  <button type="submit" name="consumercreate_btn" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign Up</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Already have an account?</p>
                    <a class="text-primary fw-bold ms-2" href="login.php">Sign In</a>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
