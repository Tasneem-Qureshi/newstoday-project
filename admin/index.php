<?php include "inc/connection.php";?>
<?php include "inc/functions.php";?>\
<?php 
session_start();
ob_start();

if(!empty($_SESSION['u_id'])){
  header('Location: dashboard.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>NewsToday Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo font-weight-bold text-center">
                <span style="color:#4B49AC; font-size: 32px;font-weight: bold;">NewsToday</span>
              </div>
              <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form class="pt-3" method="POST">
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email" name="useremail">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" name="password">
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" name="signin">SIGN IN</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Remember Me
                    </label>
                  </div>
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div>
                <div class="mb-2">
                  <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                    <i class="ti-facebook mr-2"></i>Connect using facebook
                  </button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="registration.php" class="text-primary">Create</a>
                </div>
              </form>

              <?php

              if(isset($_POST['signin'])){

                $useremail = mysqli_real_escape_string($db,$_POST['useremail']);
                $password  = mysqli_real_escape_string($db,$_POST['password']);

                $hass = sha1($password);

                $login_sql = "SELECT * FROM users WHERE u_email='$useremail'";
                $login_res = mysqli_query($db,$login_sql);

                while($row = mysqli_fetch_assoc($login_res)){

                  $_SESSION['u_id']        = $row['u_id'];
                  $_SESSION['u_name']      = $row['u_name'];
                  $_SESSION['u_email']     = $row['u_email'];
                  $u_pass                  = $row['u_pass'];
                  $_SESSION['u_phone']     = $row['u_phone'];
                  $_SESSION['u_gender']    = $row['u_gender'];
                  $_SESSION['u_posts']     = $row['u_posts'];
                  $_SESSION['u_thumbnail'] = $row['u_thumbnail'];
                  $_SESSION['user_type']   = $row['user_type'];
                  $_SESSION['u_status']    = $row['u_status'];

                  if($_SESSION['u_email'] == $useremail && $hass == $u_pass){
                    header('Location: dashboard.php');
                  }
                  else if($_SESSION['u_email'] != $useremail || $hass != $u_pass){
                    header('Location: index.php');
                  }else{
                    header('Location: index.php');
                  }
                }

              }


              ?>






            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <?php ob_end_flush(); ?>
</body>

</html>
