<?php
  include 'header.php';
  $id = $_GET['id'];
  $user = $function->GetUserConsumer($id);
?>


<html>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">Edit Consumer</h5>
      <?php
         if($user)
           { 
            $id = $user->id;
            $firstname = $user->firstname;
            $middlename = $user->middlename;
            $lastname = $user->lastname;
            $suffix = $user->suffix;
            $address = $user->address;
            $email = $user->email;
            $contactnumber = $user->contactnumber;
            $password = $user->hashedpassword;
        ?>
      <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table text-nowrap mb-0 align-middle">
                <form method="post" action="navigate.php?id=<?=$id;?>">
                  <div class="row mb-3">
                    <label class="col-form-label col-sm-3">First Name</label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" name="firstname" value="<?=($firstname)?$firstname:'';?>" required>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-form-label col-sm-3">Middle Name</label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" name="middlename" value="<?=($middlename)?$middlename:'';?>" required>
                  </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-form-label col-sm-3">Last Name</label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" name="lastname" value="<?=($lastname)?$lastname:'';?>" required>
                    </div>
                  </div>
                  </div>
                  <div class="row mb-3">
                      <label class="col-form-label col-sm-3">Suffix</label>
                      <div class="col-sm-6">
                      <select class="form-select" name="suffix">
                        <option value=""></option>
                        <option value="Jr." <?php echo ($suffix == 'Jr.') ? 'selected' : ''; ?>>Jr.</option>
                        <option value="Jra." <?php echo ($suffix == 'Jra.') ? 'selected' : ''; ?>>Jra.</option>
                        <option value="Sr." <?php echo ($suffix == 'Sr.') ? 'selected' : ''; ?>>Sr.</option>
                      </select>
                      </div>
                  </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-form-label col-sm-3">Address</label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?=($address)?$address:'';?>" required>
                    </div>
                  </div>
                   <div class="row mb-3">
                    <label class="col-form-label col-sm-3">Email</label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?=($email)?$email:'';?>" required>
                    </div>
                  </div>
                   <div class="row mb-3">
                    <label class="col-form-label col-sm-3">Contact Number</label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" name="contactnumber" value="<?=($contactnumber)?$contactnumber:'';?>" required>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-form-label col-sm-3">Password</label>
                    <div class="col-sm-6">
                    <input type="password" class="form-control" name="password">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-form-label col-sm-3">Confirm Password</label>
                    <div class="col-sm-6">
                    <input type="password" class="form-control" name="confirmpassword">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="offset-sm-3 col-sm-3 d-grid">
                      <button name="btn-edit-consumer" type="submit" class="btn btn-primary" style="justify-content: center !important;">Submit</button>
                    </div>
                    <div class="col-sm-3 d-grid">
                      <a class="btn btn-danger" style="justify-content: center !important;" href="consumeruser.php" role="button">Cancel</a>
                    </div>
                  </div>
                </form>
              </table>
            </div>
          </div>
        </div>
      </div>
      <?php
        }
        ?>
    </div>
  </div>
</div>

</div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../assets/js/dashboard.js"></script>
</body>
</html>