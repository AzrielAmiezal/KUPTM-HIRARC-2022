<?php 
require 'admin_function.php';

if (isset($_POST["register"])) {
	
	if (register($_POST) > 0 ) {
		echo "<script>
				alert('New admin successfully added!');
				document.location.href = 'admin_login.php';
				</script>";
	} else {
		echo mysqli_error($conn);
	}
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
    <div class="row justify-content-center">
		 <div class="col-lg-5">
 			<div class="card o-hidden border-0 shadow-lg my-5">
				<div class="card-body p-0">
					<div class="row">
						<div class="col-lg">
						<div class="p-5">
						 		<div class="text-center">
              	<img src="KUPTM logo.png" alt="logo" width="50%" draggable="false">
            	 	</div>

                <div class=" text-center">
                  <h1 class="h5 text-gray-900 mb-4">HAZARD AND RISK MANAGEMENT SYSTEM (HIRARC)</h1>
									<h3 class="h5 text-gray-900 mb-4"><b>ADMIN REGISTRATION</b></h3>
                </div>

								<hr />

								<form class="user" action="" method="POST">

								<div class="form-group">
                      <input class="form-control form-control-user" type="text" name="adminIDNo" id="adminIDNo" placeholder="Admin ID No" autocomplete="off" required>
              	</div>

								<div class="form-group">
											<input class="form-control form-control-user" type="text" name="adminFullname" id="adminFullname" placeholder="Full Name" autocomplete="off" required>	
								</div>

								<div class="form-group">
											<input class="form-control form-control-user" type="password" name="adminPassword" id="adminPassword" placeholder="Password" autocomplete="off" required>
								</div>

								<div class="form-group">
											<input class="form-control form-control-user" type="password" name="adminPassword2" id="adminPassword2" placeholder="Confirm Password" autocomplete="off" required>
								</div>

								<div class="form-group">
											<input class="form-control form-control-user" type="text" name="adminEmail" id="adminEmail" placeholder="Admin Email address" autocomplete="off" required>
								</div>

								<button class="btn btn-secondary btn-user btn-block text-black" type="submit" name="register">Register as Admin</button>
                <hr>
								<a href="admin_login.php" style="text-decoration: none;"><button class="btn btn-secondary btn-user btn-block text-black" type="button">Login as Admin</button></a>  

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
