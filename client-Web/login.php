<?php 
    session_name('SESSION');
    session_start();
    include('page/connexionbd.php');
    if (isset($_POST["connexion"])) {
        if(isset($_POST["login"]) AND isset($_POST["password"])){
          $_SESSION=[];
          session_unset();
            $login=strip_tags($_POST['login']);
            $sql="SELECT * FROM customer WHERE login=? AND password=?";
            $query=$myPDO->prepare($sql);
            $query->execute(array($_POST['login'],$_POST['password']));
            if($donnees=$query->fetch()){
                $_SESSION['no_customer'] =$donnees['no_customer'];
                $_SESSION['pseudo'] =$donnees['login'];
                $_SESSION['fist_name']=$donnees['fist_name'];
                $_SESSION['last_name']=$donnees['last_name'];
                $_SESSION['email']=$donnees['email'];
                $_SESSION['start_date']=$donnees['start_date'];
                $_SESSION['expire_date']=$donnees['expire_date'];
                $_SESSION['number_of_card']=$donnees['number_of_card'];
                $_SESSION['point']=$donnees['points'];
               
                header("location:index.php");
            }
         }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>log In</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
             <!--  <div class="brand-logo">
                <img src="../../images/logo.svg" alt="logo">
              </div> -->
              <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <?php if (isset($_POST["login"]) AND !isset($_SESSION['pseudo'])) {
                 echo"<div class='alert alert-danger'>Login ou mot de passe incorrects.</div>";
              } ?>
              <form  method="post" action="#" enctype="multipart/form-data">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username" name="login" required="pseudo obligatoire">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" name="password" required="">
                </div>
                <div class="mt-3">
                  <input type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" href="" value="connexion" name="connexion">
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <!-- <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div> -->
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div>
                <!-- <div class="mb-2">
                  <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                    <i class="ti-facebook mr-2"></i>Connect using facebook
                  </button>
                </div> -->
                <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="register.php" class="text-primary">Create</a>
                </div>
              </form>
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
  <script src="vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
</body>
</html>
