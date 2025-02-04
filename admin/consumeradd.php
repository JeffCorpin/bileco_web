<?php
include 'header.php';
?>
<html>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">New Consumer</h5>
            <div class="col-lg-12 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0 align-middle">
                                <form method="post" action="navigate.php">
                                <div class="row mb-3">
                                        <label class="col-form-label col-sm-3">Account Number</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="accountnum" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-form-label col-sm-3">First Name</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="firstname" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-form-label col-sm-3">Middle Name</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="middlename" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-form-label col-sm-3">Last Name</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="lastname" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-form-label col-sm-3">Suffix</label>
                                        <div class="col-sm-6">
                                        <select class="form-select" name="suffix">
                                            <option value=""></option>
                                            <option value="Jr.">Jr.</option>
                                            <option value="Jra.">Jra.</option>
                                            <option value="Sr.">Sr.</option>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-form-label col-sm-3">Address</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="address" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-form-label col-sm-3">Email</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="email" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-form-label col-sm-3">Contact Number</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="contactnumber" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-form-label col-sm-3">Password</label>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control" name="password" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-form-label col-sm-3">Confirm Password</label>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control" name="confirmpassword" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="offset-sm-3 col-sm-3 d-grid">
                                            <button name="btn-add-consumer" type="submit" class="btn btn-primary" style="justify-content: center !important;">Submit</button>
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