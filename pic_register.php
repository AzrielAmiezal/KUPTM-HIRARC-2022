<!-- =============================================PHP======================================= -->
<?php

require "connection.php";
require "pic_css_function.php";

session_start();

//echo register_login_body("PIC Register", $login_body);


if (isset($_POST['pic_register_button'])) {
    if (
        $_POST['pic_id_no'] != "" &&
        $_POST['pic_username'] != "" &&
        $_POST['pic_fullname'] != "" &&
        $_POST['pic_email'] != "" &&
        $_POST['pic_password'] != "" &&
        $_POST['pic_phone_number'] != ""
    ) {
        $query = sprintf("SELECT * FROM pic WHERE picUsername = '%s'", mysqli_real_escape_string($link, $_POST['pic_username']));
        $result = mysqli_query($link, $query);

        //echo "num rows: " . mysqli_num_rows($result);

        if (mysqli_num_rows($result) == 0) {
            $query = sprintf(
                "INSERT INTO pic VALUE ('', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
                mysqli_real_escape_string($link, $_POST['pic_id_no']),
                mysqli_real_escape_string($link, $_POST['pic_username']),
                mysqli_real_escape_string($link, $_POST['pic_fullname']),
                mysqli_real_escape_string($link, password_hash($_POST['pic_password'], PASSWORD_DEFAULT)),
                mysqli_real_escape_string($link, $_POST['pic_phone_number']),
                mysqli_real_escape_string($link, $_POST['pic_email']),
                mysqli_real_escape_string($link, $_POST['pic_departmentid'])
            );

            $result = mysqli_query($link, $query);

            if (!$result) {
                echo "ERROR:" . mysqli_error($link);
            } else {
                 echo "<script>alert('New PIC has been registered.');</script>";
                //echo overlay(css_small_card("success", "SUCCESS", "New PIC has been registered.", "fas fa-check-circle"));
            }
        } else {
            //echo "<script>alert('PIC existed. Please use other name.');</script>";
            //echo "<p>PIC existed. Please use other name.</p>";
            //echo "<script>alert('PIC existed. Please use other name.');</script>";
            echo overlay(css_small_card("warning", "WARNING", "PIC name existed. Please user other name.", "fas fa-exclamation-circle"));
        }
    } else {
        //echo "<script>alert('Please fill in all of the information.');</script>";
        //echo "<p>Please fill in all of the information.</p>";
        echo overlay(css_small_card("warning", "WARNING", "Please fill in all of the information.", "fas fa-exclamation-circle"));
    }
}

?>
<!-- =============================================END PHP======================================= -->

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

    <!-- Custom styles for this page -->
    <link href="admin_template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="notification_script.js"></script>
    <script src="admin_function.js"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion toggled" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin_index.php">
                <div class="sidebar-brand-text mx-3">HIRARC ADMINISTRATOR</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="admin_index.php">
                <i class="fas fa-home"></i>
                    <span>Home</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Report Management
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="admin_dashboard.php">
                    <i class="fas fa-cog"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="admin_pi_map.php">
                    <i class="fas fa-table"></i>
                    <span>Risk Matrix</span>
                </a>
            </li>

        <?php

        if($_SESSION["admin_fullname"] == "ADMIN")
        {

          echo 
          '<!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
              PIC Management
            </div>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
              <a class="nav-link collapsed" href="pic_register.php">
                <i class="fas fa-address-card"></i>
                <span>PIC Register</span>
              </a>
            </li>

          <!-- Heading -->
            <div class="sidebar-heading">
              Admin Management
            </div>

            <li class="nav-item">
              <a class="nav-link collapsed" href="admin_register_nav.php">
                <i class="fas fa-user-shield"></i>
                <span>Manage Admin</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link collapsed" href="admin_manage_dept.php">
                <i class="fas fa-building"></i>
                <span>Manage Department</span>
              </a>
            </li>';
        }
      

        ?>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Logo -->
                    <div class="text-center">
                        <img src="KUPTM logo.png" alt="kuptm logo" width="25%" draggable="false">
                    </div>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter" id="not_read_counter"></span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Notification
                                </h6>
                                <div id="notification_body"></div>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>
                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <form action="" method="POST">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">PIC Register</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <tr>
                                            <th>
                                                <label>PIC ID No: </label>
                                            </th>
                                            <td>
                                                <input class='form-control form-control-sm' type='text' name='pic_id_no' autocomplete='off' required />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                <label>PIC Username: </label>
                                            </th>
                                            <td>
                                                <input class='form-control form-control-sm' type='text' name='pic_username' autocomplete='off' required />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                <label>PIC Full Name:</label>
                                            </th>
                                            <td>
                                                <input class='form-control form-control-sm' style='text-transform: capitalize;' type='text' name='pic_fullname' autocomplete='off' autocapitalize='word' required />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                <label>PIC Email Address:</label>
                                            </th>
                                            <td>
                                                <input class='form-control form-control-sm' type='text' name='pic_email' autocomplete='off' required />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                <label>PIC Password:</label>
                                            </th>
                                            <td>
                                                <input class='form-control form-control-sm' type='password' name='pic_password' required />
                                            </td>
                                        </tr>
                                        <tr>
                                            <?php
                                                $query = "SELECT * FROM department";
                                                $result = mysqli_query($link, $query);
                                            ?>
                                            <th>
                                                <label>Department:</label>
                                            </th>

                                            <td>
                                                <?php 
                                                    if(mysqli_num_rows($result) > 0)
                                                    { 
                                                        $echo_string = 
                                                            "<select class='form-control form-control-sm' name='pic_departmentid' required>
                                                                <option value='' selected hidden>Select one</option>";
                                                                while(($data = mysqli_fetch_assoc($result)))
                                                                {
                                                                   $echo_string .= "<option value=" . $data["departmentID"] . ">" . $data["departmentName"] . "</option>";
                                                                }
                                                        $echo_string .= "</select>";
                                                        echo $echo_string;
                                                    }
                                                    else
                                                    {
                                                        echo "No department exist";
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                <label>PIC Phone Number:</label>
                                            </th>
                                            <td>
                                                <input class='form-control form-control-sm' type='text' name='pic_phone_number' autocomplete='off' required />
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <br />
                                <button class="btn btn-primary btn-user btn-block" type="submit" name="pic_register_button">Register</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <!-- end card shadow -->

            <!-- Footer -->
            <footer class="sticky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <!-- <span>Copyright &copy; Your Website 2019</span> -->
                        <span style="font-family: 'Times New Roman', Times, serif; font-size: 16px;">Copyright &copy;2021 - <?= date('Y'); ?> <a href="http://www.kuptm.edu.my/">Kolej Universiti Poly-Tech MARA (KUPTM) Kuala Lumpur</a> <br /> All rights reserved.</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Main Content -->

    </div>
    <!-- end contain wrapper -->



    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="admin_logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="admin_template/vendor/jquery/jquery.min.js"></script>
    <script src="admin_template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="admin_template/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="admin_template/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="admin_template/vendor/chart.js/Chart.min.js"></script>
    <script src="admin_template/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="admin_template/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="admin_template/js/demo/chart-area-demo.js"></script>
    <script src="admin_template/js/demo/chart-pie-demo.js"></script>
    <script src="admin_template/js/demo/datatables-demo.js"></script>

    


</body>

</html>

<script>
    fetch_admin_notification_function(<?php echo $_SESSION["adminID"] ?>);
    change_pic_read_status(<?php echo $_SESSION["picID"] ?>);
</script>