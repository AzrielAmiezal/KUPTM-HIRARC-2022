<?php

require 'admin_function.php';

if (isset($_POST["login"])) {

  $AdminIDNo = $_POST["adminIDNo"];
  $AdminPassword = $_POST["adminPassword"];

  //echo $AdminIDNo;
  //echo $AdminPassword;

  $result = mysqli_query($conn, "SELECT * FROM admin WHERE adminIDNo = '$AdminIDNo'");

  if (!$result) {
    echo "Error: " . mysqli_error($conn);
  } else {
    //echo mysqli_num_rows($result);
    if (mysqli_num_rows($result) === 1) {

      // check passsword
      $row = mysqli_fetch_assoc($result);
      if (password_verify($AdminPassword, $row["adminPassword"])) {
        // 	$_SESSION["adminID"] = $row{"adminID"};
        $_SESSION["adminLogged"] = 1;
        $_SESSION["adminID"] = $row["adminID"];
        $_SESSION["admin_fullname"] = $row["adminFullname"];
        //$_SESSION["adminID"] = $row{"adminID"};
        header("Location: admin_index.php");
        exit;
      }
    }

    $error = true;
  }
  //check username

}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>KUPTM ADMIN HIRARC</title>

  <!-- Custom fonts for this template-->
  <link href="admin_template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="admin_template/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-light">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-lg-5">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg">
                <div class="p-5">
                  <!-- <div class="text-center">
                    
                    <ul class="nav nav-tabs">
                      <li class="nav-item">
                          <a class="nav-link active" href="">Admin</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="pic_login.php">PIC</a>
                      </li>
                    </ul>
                  </div> -->


                  <div class="text-center">
                    <img src="KUPTM logo.png" alt="logo" width="60%" draggable="false">
                  </div>

                  <div class=" text-center">
                    <h1 class="h5 text-gray-900 mb-4">HAZARD AND RISK MANAGEMENT SYSTEM (HIRARC)</h1>
                  </div>

                  <hr />

                  <?php if (isset($error)) : ?>
                    <p style="color: red; font-style:italic; font-family: 'Times New Roman', Times, serif; text-align: center;">ID number or password is incorrect!</p>
                  <?php endif; ?>
                  <form class="user" action="" method="POST">

                    <div class="form-group">
                      <select style="border-radius: 25px;" class="custom-select input-lg " name="dropdown_login" onchange="location = this.value;" required>
                        <option value="Choose role" selected>Choose Role</option>
                        <option value="admin_login.php">Admin</option>
                        <option value="pic_login.php">PIC</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <input type="text" name="adminIDNo" class="form-control form-control-user" id="" placeholder="ID Number" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                      <input type="password" name="adminPassword" class="form-control form-control-user" id="adminPassword" placeholder="Password" required>
                    </div>

                    <button class="btn btn-secondary btn-user btn-block text-black" type="submit" name="login">Login</button>
                    <hr>
                    <div class="text-center">
                      <p>
                        <a href="admin_forgot_password.php">Forgot Password?</a>
                      </p>
                      <!-- <p>
                        Don't have an account yet?<br> 
                        <a class="small" href="admin_register.php">Sign Up!</a> <br>
                      </p> -->
                    </div>

                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

    <!-- Footer -->
    <footer class="sticky-footer">
      <div class="container my-auto">
        <div class="copyright text-center my-auto">
          <!-- <span>Copyright &copy;<?= date('Y'); ?> Kolej Universiti Poly-Tech MARA (KUPTM) Kuala Lumpur. <br> All rights reserved.</span> -->
          <span style="font-family: 'Times New Roman', Times, serif; font-size: 16px;">Copyright &copy;2021 - <?= date('Y'); ?> <a href="http://www.kuptm.edu.my/">Kolej Universiti Poly-Tech MARA (KUPTM) Kuala Lumpur</a> <br /> All rights reserved.</span>
        </div>
      </div>
    </footer>
    <!-- End of Footer -->

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="admin_template/vendor/jquery/jquery.min.js"></script>
  <script src="admin_template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="admin_template/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="admin_template/js/sb-admin-2.min.js"></script>

</body>

</html>