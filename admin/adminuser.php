<?php
  include 'header.php';
?>

<link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">

<script defer src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script defer src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
<script defer src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>

<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">Admins</h5>
      <a class="btn btn-primary" role="button" href="adminadd.php" style="margin-bottom: 20px; margin-top: -18px;">Add</a>
      <?php
            $msg = Session::get("msg");
            if(isset($msg)){
              echo $msg;
              Session::set("msg", NULL);
            }
      ?>
      <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered text-nowrap mb-0 align-middle" id="table">
                <thead class="text-dark">
                  <tr>
                    <th class="border-bottom-0">ID</th>
                    <th class="border-bottom-0">Name</th>
                    <th class="border-bottom-0">Address</th>
                    <th class="border-bottom-0">Email</th> 
                    <th class="border-bottom-0" style="text-align: left !important;">Contact Number</th>                  
                    <th class="border-bottom-0">Action</th>
                  </tr>
                </thead>
                <tbody>

                <?php                         
                          $i = 0;
                          $users = $function->GetAllUsers();
                          if ($users) {
                            foreach ($users as $user):
                              $id = $user['id'];
                              $firstname = $user['firstname'];
                              $middlename = $user['middlename']; 
                              $lastname = $user['lastname'];
                              $suffix = $user['suffix'];
                              $address = $user['address'];
                              $email = $user['email']; 
                              $contactnumber = $user['contactnumber'];
                              $i++;
                            ?>
                        <tr class="text-center">
                            <td class="text-center"><label><?=$i;?></label></td> 
                            <td><label><?=$firstname;?> <?=$middlename;?> <?=$lastname;?> <?=$suffix;?></label></td> 
                            <td><label><?=$address;?></label></td> 
                            <td><label><?=$email;?></label></td> 
                            <td class="text-center"><label><?=$contactnumber;?></label></td>                 
                            <td>
                              <form method="post" action="navigate.php">
                                <a class="btn btn-primary" href="adminedit.php?id=<?=$id;?>">Edit</a> &nbsp;
                                <input type="hidden" name="id" value="<?=$id;?>">
                                <button class="btn btn-danger" type="submit" name="btn-delete-user">Delete</button></td> 
                              </form>
                            </td>
                        </tr>
                        <?php

                            endforeach;
                          }

                        ?>                    

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
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

  <script>
$(document).ready(function() {
    $('#table').DataTable();
});
</script>
</body>
