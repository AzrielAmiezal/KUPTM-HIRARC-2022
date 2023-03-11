<?php
require 'admin_function.php';
require 'email_notify.php';

if ($_SESSION["adminLogged"] == 0) { header("Location: admin_login.php"); }

//if(!isset($_GET["id"]) && !isset($_GET["mit_id"])) { header("Location: admin_index.php"); }

?>

<!-- =========================================================== -->

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
                        <a class="dropdown-item text-center small text-gray-500" id="change_admin_read_status" href="admin_notification_list.php">Show All Alerts</a>
                    </div>
                </li>
            </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- =============================================FORM======================================= -->
          <!-- <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Report Management</h6>
            </div> -->

          <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">

                <!-- =============================================PAGE SELECTION======================================= -->
                <ul class="nav nav-tabs">
                    <li class="nav-item active">
                      <a href="#Investigate" class="nav-link active" aria-selected="true" role="tab" data-toggle="tab">1. Investigation</a>
                    </li>

                    <li class="nav-item">
                      <a href="#Report" class="nav-link" role="tab" data-toggle="tab">2. Report</a>
                    </li>

                    <?php 
                        if($_GET["mit_id"] == 0)
                        {
                            echo
                            '<li class="nav-item">
                            <a href="#Assign" class="nav-link" role="tab" data-toggle="tab">3. Assign PIC</a>
                            </li>';
                        }
                    ?>

                    <li class="nav-item">
                      <a href="#feedback" class="nav-link" role="tab" data-toggle="tab">4. PIC Feedback</a>
                    </li>
                </ul>

                    
                <div class="tab-content">

                    <div role="tabpanel" class="tab-pane fade active show" id="Investigate">

                        <?php
                            $query = sprintf("SELECT report_handler.*
                                            FROM report_handler 
                                            WHERE report_handler.reportID = '$_GET[id]'",
                            mysqli_real_escape_string($conn, $_GET["id"]),
                            mysqli_real_escape_string($conn, $_GET["mit_id"]));

                            $result = mysqli_query($conn, $query);
                            $d = mysqli_fetch_assoc($result);
                        ?>
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Investigation Details</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <input type="hidden" name="reportID" id="reportID" value="<?= $_GET["id"] ?>">
                                    <input type="hidden" name="mitigationID" id="mitigationID" value="'<?= $_GET["mit_id"] ?>">
                                
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <?php    
                                            $query = sprintf("SELECT admin.*
                                                            FROM admin
                                                            JOIN report_handler 
                                                            ON report_handler.reportID = '$_GET[id]'
                                                            AND report_handler.adminID = admin.adminID",
                                            mysqli_real_escape_string($conn, $_GET["id"]));

                                            $result = mysqli_query($conn, $query);
                                            
                                            $r = mysqli_fetch_assoc($result);
                                            //echo "num rows: " . $r["adminID"];
                                            // if(mysqli_num_rows($result) > 0)
                                            // {
                                                
                                            //     echo 
                                            //     '<tr>
                                            //         <th>Admin Investigate:</th>
                                            //         <td><input type="text" name="dateInvestigate" id="dateInvestigate" value="' . $r["adminFullname"] . '" size="50" readonly />
                                            //          <a data-toggle="tooltip" data-placement="right" title="Name of admin that investigate the hazard" 

                                            //           style="color: blue; font-size: 25px;"> <i class="fas fa-info-circle" ></i></a> 
                                            //         </td>
                                            //     </tr>';
                                            // }
                                            // else 
                                            // {
                                            //     echo 
                                            //     '<tr>
                                            //         <th>Admin Investigate:</th>
                                            //         <td><input type="text" name="dateInvestigate" id="dateInvestigate" value="None" size="50" readonly />
                                            //           <a data-toggle="tooltip" data-placement="right" title="No admin investigate the hazard" 

                                            //           style="color: blue; font-size: 25px;"> <i class="fas fa-info-circle" ></i></a>

                                            //         </td>
                                            //     </tr>';
                                            // }
                                        ?>
                                        <tr>
                                            <th>Investigation Remarks: </th>
                                            <!-- <td><input type="textarea" name="investigateRemarks" id="investigeRemarks" /></td> -->
                                            <td><textarea  name="investigateRemarks" id="investigateRemarks" rows="4" cols="50"><?= $d["investigateRemarks"]; ?></textarea>

                                              <a data-toggle="tooltip" data-placement="right" title="Description of the hazard" 

                                              style="color: blue; font-size: 25px;"> <i class="fas fa-info-circle" ></i></a>
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <th>Date Investigate:</th>
                                            <td><input type="date" name="dateInvestigate" id="dateInvestigate" value="<?= $d["dateInvestigate"]; ?>"/>

                                              <a data-toggle="tooltip" data-placement="right" title="Date admin investigate the hazard" 

                                              style="color: blue; font-size: 25px;"> <i class="fas fa-info-circle" ></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Picture:</th>
                                            <td>
                                                <?= getInvestigatePictureList($_GET["id"]); ?>
                                                <?php 
                                                if($r["adminID"] == $_SESSION["adminID"] || empty($r["adminID"])) { echo '<input type="file" name="investigatePictures[]" id="investigatePictures" multiple />'; } 
                                                else if ($r["adminID"] == (-1)) { echo '<input type="file" name="investigatePictures[]" id="investigatePictures" multiple/>'; }
                                                ?>
                                                <div id="imagePreview"></div>
                                            </td>
                                        </tr>
                                    </table>
                                    <?php 
                                    if($r["adminID"] == $_SESSION["adminID"] || empty($r["adminID"])) { echo '<br /><button class="btn btn-primary" type="submit" name="submit">Submit</button>'; } 
                                    else if ($r["adminID"] == (-1)) { echo '<br /><button class="btn btn-primary" type="submit" name="submit">Submit</button>'; }
                                    ?>
                                    
                                    <!-- <button class="btn btn-primary" type="submit" name="submitAll">Submit All</button> -->
                                </div>
                            </div>

                            <script>
                                document.getElementById('investigatePictures').addEventListener('change', function(e) {
                                if (e.target.files.length > 0){
                                    Array.from(e.target.files).forEach((file) => {
                                        document.getElementById('imagePreview').innerHTML += '<img id="displayImage" src="' + URL.createObjectURL(file) + '" alt="Image preview" width="15%" height="40%" /> ';
                                        //document.getElementById('fileNames').innerHTML += '<br>' + file.name;
                                    })
                                }
                                
                                });
                            </script>
                        </div>

                    </div>

                    <div role="tabpanel" class="tab-pane fade" id="Report">
                    <?php
                    $query = sprintf("SELECT
                                            report.*,
                                            complainant.*,
                                            complaint.*,
                                            report_handler.*,
                                            hazard.*,
                                            risk_analysis.*,
                                            risk_control.*
                                        FROM
                                            report
                                        JOIN complainant 
                                            ON report.reportID = '%s'
                                        JOIN complaint 
                                            ON complaint.reportID = report.reportID
                                            AND complaint.complainantID = complainant.complainantID 
                                        JOIN report_handler 
                                            ON report_handler.reportID = report.reportID
                                        JOIN hazard 
                                            ON hazard.reportID = report.reportID 
                                            AND hazard.mitigationID = '%s'
                                        JOIN risk_analysis 
                                            ON risk_analysis.reportID = report.reportID 
                                            AND risk_analysis.mitigationID = hazard.mitigationID
                                        JOIN risk_control 
                                            ON risk_control.reportID = report.reportID 
                                            AND risk_control.mitigationID = hazard.mitigationID",
                                            mysqli_real_escape_string($conn, $_GET["id"]),
                                            mysqli_real_escape_string($conn, $_GET["mit_id"]));

                    $result = mysqli_query($conn, $query);
                    $data = mysqli_fetch_assoc($result);

                    if (!$result) {
                        echo "ERROR: " . mysqli_error($conn);
                    } else {
                        
                        // echo "Report Type: " . $data['reportType']; 

                        echo '<input type="hidden" name="reportID" id="reportID" value="' . $_GET["id"] . '">';
                        echo '<input type="hidden" name="mitigationID" id="mitigationID" value="' . $_GET["mit_id"] . '">';
                        echo '<input type="hidden" name="picId" id="picId" value="' .  $data["picID"] . '">';
                        //<!-- <input type="hidden" name="rarc" id="rarc" value='<? echo $rarc'> -->


                        //<!-- =============================================TABLE======================================= -->
                        echo '
                            <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Report Details</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    
                                        <tr>
                                            <th colspan="2" class="text-center">
                                            Complainant Information
                                            </th>
                                        </tr>

                                        <tr>
                                            <th>
                                            <label for="complainantRole">Complainant Role: </label> 
                                            </th>
                                            <td>
                                                
                                                <input type="text" value="' . $data['complainantRole'] . '" size="50" readonly>
                                                <a data-toggle="tooltip" data-placement="right" title="Complaint are from Staff or Student" 

                                              style="color: blue; font-size: 25px;"> <i class="fas fa-info-circle" ></i></a>

                                            </td> 
                                        </tr>


                                        <tr>
                                            <th>
                                            <label for="complainantFullname">Complainant Full name: </label> 
                                            </th>
                                            <td>
                                            <input type="text" value="' . $data['complainantFullName'] . '" size="50" readonly>

                                            <a data-toggle="tooltip" data-placement="right" title="Complainant Name that do the complaint" 

                                              style="color: blue; font-size: 25px;"> <i class="fas fa-info-circle" ></i></a>

                                            </td> 
                                        </tr>

                                        <tr>
                                            <th>
                                            <label for="complainantIDNo">Complainant ID No: </label> 
                                            </th>
                                            <td>
                                            <input type="text" value="' . $data['complainantIDNo'] . '" size="50" readonly>

                                            <a data-toggle="tooltip" data-placement="right" title="Complainant ID that do the complaint" 

                                              style="color: blue; font-size: 25px;"> <i class="fas fa-info-circle" ></i></a>

                                            </td> 
                                        </tr>

                                        <tr>
                                            <th>
                                            <label for="complainantEmail">Complainant Email: </label> 
                                            </th>
                                            <td>
                                            <input type="text" value="' . $data['complainantEmail'] . '" size="50" readonly>

                                            <a data-toggle="tooltip" data-placement="right" title="Complainant Email that do the complaint" 

                                              style="color: blue; font-size: 25px;"> <i class="fas fa-info-circle" ></i></a>

                                            </td> 
                                        </tr>

                                        <tr>
                                            <th>
                                            <label for="complainantEmail">Comment: </label> 
                                            </th>
                                            <td>
                                            <input type="text" value="' . $data['remarks'] . '" size="50" readonly>

                                            <a data-toggle="tooltip" data-placement="right" title="Complainant comment or description of the hazard" 

                                              style="color: blue; font-size: 25px;"> <i class="fas fa-info-circle" ></i></a>

                                            </td> 
                                        </tr>

                                        <tr>
                                            <th colspan="2" class="text-center">
                                            Report
                                            </th>
                                        </tr>

                                        <tr>
                                        <th>
                                            <label for="reportPicture">Report Picture: </label> 
                                        </th>
                                        <td>';
                                            echo getReportPictureList($_GET["id"]);
                                        echo '</td> 
                                        </tr>
                                        <tr>

                                            <th>
                                            <label for="reportType">Report Type: </label>
                                            </th>
                                            <td>
                                            
                                            <select name="reportType" id="reportType" onchange="ddl();" style="width: 300px">
                                                <option>Select Report</option>';
                                            //<input type="text" name="reportType" id="reportType" value=' .  $data['reportType'] . '>

                                            if ($data['reportType'] == '1') {
                                                echo '<option selected="selected" value="1">Electrical Hazard</option>';
                                                echo '<option value="2">Mechanical Hazard</option>';
                                                echo '<option value="3">Chemical Hazard</option>';
                                                echo '<option value="4">Radiation Hazard</option>';
                                                echo '<option value="5">Biology Hazard</option>';
                                                echo '<option value="6">Physical Hazard</option>';
                                            } else if ($data['reportType'] == '2') {
                                                echo '<option value="1">Electrical Hazard</option>';
                                                echo '<option selected="selected" value="2">Mechanical Hazard</option>';
                                                echo '<option value="3">Chemical Hazard</option>';
                                                echo '<option value="4">Radiation Hazard</option>';
                                                echo '<option value="5">Biology Hazard</option>';
                                                echo '<option value="6">Physical Hazard</option>';
                                            } else if ($data['reportType'] == '3') {
                                                echo '<option value="1">Electrical Hazard</option>';
                                                echo '<option value="2">Mechanical Hazard</option>';
                                                echo '<option selected="selected" value="3">Chemical Hazard</option>';
                                                echo '<option value="3">Radiation Hazard</option>';
                                                echo '<option value="4">Biology Hazard</option>';
                                                echo '<option value="6">Physical Hazard</option>';
                                            } else if ($data['reportType'] == '4') {
                                                echo '<option value="1">Electrical Hazard</option>';
                                                echo '<option value="2">Mechanical Hazard</option>';
                                                echo '<option value="3">Chemical Hazard</option>';
                                                echo '<option selected="selected" value="4">Radiation Hazard</option>';
                                                echo '<option value="5">Biology Hazard</option>';
                                                echo '<option value="6">Physical Hazard</option>';
                                            } else if ($data['reportType'] == '5') {
                                                echo '<option value="1">Electrical Hazard</option>';
                                                echo '<option value="2">Mechanical Hazard</option>';
                                                echo '<option value="3">Chemical Hazard</option>';
                                                echo '<option value="4">Radiation Hazard</option>';
                                                echo '<option selected="selected" value="5">Biology Hazard</option>';
                                                echo '<option value="6">Physical Hazard</option>';
                                            } else if ($data['reportType'] == '6') {
                                                echo '<option value="1">Electrical Hazard</option>';
                                                echo '<option value="2">Mechanical Hazard</option>';
                                                echo '<option value="3">Chemical Hazard</option>';
                                                echo '<option value="4">Radiation Hazard</option>';
                                                echo '<option value="5">Biology Hazard</option>';
                                                echo '<option selected="selected" value="6">Physical Hazard</option>';
                                            } else {
                                                echo '<option value="1">Electrical Hazard</option>';
                                                echo '<option value="2">Mechanical Hazard</option>';
                                                echo '<option value="3">Chemical Hazard</option>';
                                                echo '<option value="4">Radiation Hazard</option>';
                                                echo '<option value="5">Biology Hazard</option>';
                                                echo '<option value="5">Physical Hazard</option>';
                                            }
                                            echo '</select>

                                            <a data-toggle="tooltip" data-placement="right" title="Type of hazard that related to the complainant complaint" 

                                              style="color: blue; font-size: 25px;"> <i class="fas fa-info-circle" ></i></a>

                                            </td> 
                                        </tr>
                                        <tr>
                                            <th>
                                            <label for="venue">Venue: </label>
                                            </th>
                                            <td>
                                            <input type="text" name="venue" id="venue" value="' . $data['venue'] . '" size="50" autocomplete="off">

                                            <a data-toggle="tooltip" data-placement="right" title="Venue or place the hazard happen" 

                                              style="color: blue; font-size: 25px;"> <i class="fas fa-info-circle" ></i></a>

                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                            <label for="venue">Date Complaint: </label>
                                            </th>
                                            <td>
                                            <input type="date" name="dateComplaint" id="dateComplaint" value="' . $data['dateComplaint'] . '" readonly>

                                            <a data-toggle="tooltip" data-placement="right" title="Date of complaint" 

                                              style="color: blue; font-size: 25px;"> <i class="fas fa-info-circle" ></i></a>

                                            </td>
                                        </tr>

                                        <tr>
                                            <th colspan="2" class="text-center">
                                            Hazard
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>
                                            <label for="hazardActivity">Hazard Activity: </label>
                                            </th>
                                            <td>
                                            <input type="text" name="hazardActivity" id="hazardActivity" value="' . $data['hazardActivity'] . '" size="50" autocomplete="off">

                                            <a data-toggle="tooltip" data-placement="right" title="Cause of hazard" 

                                              style="color: blue; font-size: 25px;"> <i class="fas fa-info-circle" ></i></a>

                                            </td> 
                                        </tr> 
                                        <tr>
                                            <th>
                                            <label for="hazard">Hazard: </label>
                                            </th>
                                            <td>
                                            <input type="text" name="hazard" id="hazard" value="' . $data['hazard'] . '" size="50" autocomplete="off">

                                            <a data-toggle="tooltip" data-placement="right" title="Reason hazard is occur" 

                                              style="color: blue; font-size: 25px;"> <i class="fas fa-info-circle" ></i></a>

                                            </td> 
                                        </tr> 
                                        <tr>
                                            <th>
                                            <label for="hazardImpact">Hazard Impact: </label>
                                            </th>
                                            <td>
                                            <input type="text" name="hazardImpact" id="hazardImpact" value="' . $data['hazardImpact'] . '" size="50" autocomplete="off">

                                            <a data-toggle="tooltip" data-placement="right" title="The hazard outcome if no action be done" 

                                              style="color: blue; font-size: 25px;"> <i class="fas fa-info-circle" ></i></a>

                                            </td> 
                                        </tr> 
 
                                        <tr>
                                            <th colspan="2" class="text-center">
                                            Risk Analysis
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>
                                            <label for="existingControl">Existing Control: </label>
                                            </th>
                                            <td>
                                            <input type="text" name="existingControl" id="existingControl" value="' . $data['existingControl'] . '" size="50" autocomplete="off">

                                            <a data-toggle="tooltip" data-placement="right" title="The action that have been done" 

                                              style="color: blue; font-size: 25px;"> <i class="fas fa-info-circle" ></i></a>

                                            </td> 
                                        </tr> 
                                        <tr>
                                            <th>
                                            <label for="probability">Probability: </label>
                                            </th>
                                            <td>
                                            <select name="probability" id="probability" onchange="ddl();" style="width: 300px">
                                                <option>Select Probability</option>';

                                            if ($data['probability'] == '5') {
                                                echo '<option selected="selected" value="5">Almost Certain - 5</option>';
                                                echo '<option value="4">Quite Possible - 4</option>';
                                                echo '<option value="3">Remotely Possible - 3</option>';
                                                echo '<option value="2">Conceivable - 2</option>';
                                                echo '<option value="1">Practically Impossible - 1</option>';
                                            } else if ($data['probability'] == '4') {
                                                echo '<option value="5">Almost Certain - 5</option>';
                                                echo '<option selected="selected" value="4">Quite Possible - 4</option>';
                                                echo '<option value="3">Remotely Possible - 3</option>';
                                                echo '<option value="2">Conceivable - 2</option>';
                                                echo '<option value="1">Practically Impossible - 1</option>';
                                            } else if ($data['probability'] == '3') {
                                                echo '<option value="5">Almost Certain - 5</option>';
                                                echo '<option value="4">Quite Possible - 4</option>';
                                                echo '<option selected="selected" value="3">Remotely Possible - 3</option>';
                                                echo '<option value="2">Conceivable - 2</option>';
                                                echo '<option value="1">Practically Impossible - 1</option>';
                                            } else if ($data['probability'] == '2') {
                                                echo '<option value="5">Almost Certain - 5</option>';
                                                echo '<option value="4">Quite Possible - 4</option>';
                                                echo '<option value="3">Remotely Possible - 3</option>';
                                                echo '<option selected="selected" value="2">Conceivable - 2</option>';
                                                echo '<option value="1">Practically Impossible - 1</option>';
                                            } else if ($data['probability'] == '1') {
                                                echo '<option value="5">Almost Certain - 5</option>';
                                                echo '<option value="4">Quite Possible - 4</option>';
                                                echo '<option value="3">Remotely Possible - 3</option>';
                                                echo '<option value="2">Conceivable - 2</option>';
                                                echo '<option selected="selected" value="1">Practically Impossible - 1</option>';
                                            } else {
                                                echo '<option value="5">Almost Certain - 5</option>';
                                                echo '<option value="4">Quite Possible - 4</option>';
                                                echo '<option value="3">Remotely Possible - 3</option>';
                                                echo '<option value="2">Conceivable - 2</option>';
                                                echo '<option value="1">Practically Impossible - 1</option>';
                                            }
                                            echo '</select>

                                            <a data-toggle="tooltip" data-placement="right" title="The probability that hazard will occur" 

                                              style="color: blue; font-size: 25px;"> <i class="fas fa-info-circle" ></i></a>

                                            </td> 
                                        </tr> 
                                        <tr>
                                            <th>
                                            <label for="impact">Impact: </label>
                                            </th>
                                            <td>
                                            <select name="impact" id="impact" onchange="ddl();" style="width: 300px">
                                                <option>Select Impact</option>';
                                            if ($data['impact'] == '5') {
                                                echo '<option value="5" selected>Catastrophic - 5</option>';
                                                echo '<option value="4">Major - 4</option>';
                                                echo '<option value="3">Moderate - 3</option>';
                                                echo '<option value="2">Minor - 2</option>';
                                                echo '<option value="1">Negligible - 1</option>';
                                            } else if ($data['impact'] == '4') {
                                                echo '<option value="5">Catastrophic - 5</option>';
                                                echo '<option value="4" selected>Major - 4</option>';
                                                echo '<option value="3">Moderate - 3</option>';
                                                echo '<option value="2">Minor - 2</option>';
                                                echo '<option value="1">Negligible - 1</option>';
                                            } else if ($data['impact'] == '3') {
                                                echo '<option value="5">Catastrophic - 5</option>';
                                                echo '<option value="4">Major - 4</option>';
                                                echo '<option value="3" selected>Moderate - 3</option>';
                                                echo '<option value="2">Minor - 2</option>';
                                                echo '<option value="1">Negligible - 1</option>';
                                            } else if ($data['impact'] == '2') {
                                                echo '<option value="5">Catastrophic - 5</option>';
                                                echo '<option value="4">Major - 4</option>';
                                                echo '<option value="3">Moderate - 3</option>';
                                                echo '<option value="2" selected>Minor - 2</option>';
                                                echo '<option value="1">Negligible - 1</option>';
                                            } else if ($data['impact'] == '1') {
                                                echo '<option value="5">Catastrophic - 5</option>';
                                                echo '<option value="4">Major - 4</option>';
                                                echo '<option value="3">Moderate - 3</option>';
                                                echo '<option value="2">Minor - 2</option>';
                                                echo '<option value="1" selected>Negligible - 1</option>';
                                            } else {
                                                echo '<option value="5">Catastrophic - 5</option>';
                                                echo '<option value="4">Major - 4</option>';
                                                echo '<option value="3">Moderate - 3</option>';
                                                echo '<option value="2">Minor - 2</option>';
                                                echo '<option value="1">Negligible - 1</option>';
                                            }
                                            echo '</select>

                                            <a data-toggle="tooltip" data-placement="right" title="The rate impact of the hazard" 

                                              style="color: blue; font-size: 25px;"> <i class="fas fa-info-circle" ></i></a>

                                            </td> 
                                        </tr> 
                                        <tr>
                                            <th>
                                                <label for="riskLevel">Risk Level: </label>
                                    
                                            </th>
                                            <td>
                                                <input type="text" name="riskLevel" id="riskLevel" value="' . $data['riskLevel'] . '" readonly>

                                                <a data-toggle="tooltip" data-placement="right" title="The risk level according to Probability and Impact" 

                                              style="color: blue; font-size: 25px;"> <i class="fas fa-info-circle" ></i></a>

                                            </td> 
                                        </tr>

                                        <tr>
                                            <th colspan="2" class="text-center">
                                            Risk Control
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>
                                                <label for="mitigationAction">Mitigation Plan: </label>
                                            </th>
                                            <td>
                                                <input type="text" name="mitigationAction" id="mitigationAction" value="' . $data['mitigationPlan'] . '" size="50" autocomplete="off">

                                                <a data-toggle="tooltip" data-placement="right" title="Temporary solution for the hazard. Mitigation Plan will only have 4 phase." 

                                              style="color: blue; font-size: 25px;"> <i class="fas fa-info-circle" ></i></a>

                                            </td> 
                                        </tr>
                                        <tr>
                                            <th>
                                                <label for="dateSolved">Expected Date Solve: </label>
                                            </th>
                                            <td>
                                                <input type="date" name="dateSolved" id="dateSolved" value="' . $data['expectedDateSolved'] . '">

                                                <a data-toggle="tooltip" data-placement="right" title="Expected date for PIC to solve the hazard follow the Mitigation Plan solution" 

                                              style="color: blue; font-size: 25px;"> <i class="fas fa-info-circle" ></i></a>

                                            </td> 
                                        </tr>
                                        <tr>
                                            <th>
                                                <label for="status">Status: </label>
                                            </th>' .
                                            //   <td>
                                            //     <input type="text" name="status" id="status" value="' . $data['status'] . '">
                                            //   </td> 
                                            '<td><select name="status" id="status">
                                                <option value="-1">Select status</option>';
                                                if($data['status'] == '0')
                                                { 
                                                    echo '<option value="0" selected>Open</option>';
                                                    echo '<option value="1">In Progress</option>';
                                                    echo '<option value="2">Monitoring</option>';
                                                    echo '<option value="3">Resolved</option>';
                                                    echo '<option value="4">Close</option>';
                                                }
                                                else if($data['status'] == '1')
                                                { 
                                                    echo '<option value="0">Open</option>';
                                                    echo '<option value="1" selected>In Progress</option>';
                                                    echo '<option value="2">Monitoring</option>';
                                                    echo '<option value="3">Resolved</option>';
                                                    echo '<option value="4">Close</option>';
                                                }
                                                else if($data['status'] == '2')
                                                { 
                                                    echo '<option value="0">Open</option>';
                                                    echo '<option value="1">In Progress</option>';
                                                    echo '<option value="2" selected>Monitoring</option>';
                                                    echo '<option value="3">Resolved</option>';
                                                    echo '<option value="4">Close</option>';
                                                }
                                                else if($data['status'] == '3')
                                                { 
                                                    echo '<option value="0">Open</option>';
                                                    echo '<option value="1">In Progress</option>';
                                                    echo '<option value="2">Monitoring</option>';
                                                    echo '<option value="3" selected>Resolved</option>';
                                                    echo '<option value="4">Close</option>';
                                                }
                                                else if($data['status'] == '4')
                                                { 
                                                    echo '<option value="0">Open</option>';
                                                    echo '<option value="1">In Progress</option>';
                                                    echo '<option value="2">Monitoring</option>';
                                                    echo '<option value="3">Resolved</option>';
                                                    echo '<option value="3" selected>Close</option>';
                                                }
                                                else
                                                {
                                                    echo '<option value="0">Open</option>';
                                                    echo '<option value="1">In Progress</option>';
                                                    echo '<option value="2">Monitoring</option>';
                                                    echo '<option value="3">Resolved</option>';
                                                    echo '<option value="3">Close</option>';
                                                }
                                                echo '</select>

                                                <a data-toggle="tooltip" data-placement="right" title="Status of the hazard case" 

                                              style="color: blue; font-size: 25px;"> <i class="fas fa-info-circle" ></i></a>

                                            </td>
                                        </tr>
                                    </table>
                              <br /><button class="btn btn-primary" type="submit" name="report">Edit</button>';
                            //   <button class="btn btn-primary" type="submit" name="submitAll">Submit All</button>
                            echo '</div>
                        </div>';
                    
                // </div>
                //<!-- =============================================TABLE END======================================= -->
                    } ?>
                    </div>
                </div>

                <?php 
                if($_GET["mit_id"] == 0)
                {
                    $query = sprintf("SELECT pic.*, report_handler.*, department.* 
                                    FROM pic 
                                    JOIN report_handler 
                                        ON report_handler.picID = pic.picID
                                        AND report_handler.reportID = '%s'
                                    JOIN department
                                        ON department.departmentID = pic.departmentID", mysqli_real_escape_string($conn, $_GET["id"]));
                    $result = mysqli_query($conn, $query);

                    $r = mysqli_fetch_assoc($result);
                    
                    echo 
                    '<div role="tabpanel" class="tab-pane fade" id="Assign">

                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Assign Person In Charge (PIC)</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                        <input type="hidden" name="reportID" id="reportID" value="' . $_GET["id"] . '" />
                                        <input type="hidden" name="mitigationID" id="mitigationID" value="' . $_GET["mit_id"] . '" />
                                        <tr>
                                            <th colspan="2" class="text-center">Details</th>
                                        </tr>
                                        <tr>
                                            <th><label for="expectedDateSolved">Expected Date Completed: </label></th>
                                            <td><input type="date" name="expectedDateSolved" id="expectedDateSolved" value="' .  $data['expectedDateSolved'] . '">

                                              <a data-toggle="tooltip" data-placement="right" title="Date to complete the task" 

                                              style="color: blue; font-size: 25px;"> <i class="fas fa-info-circle" ></i></a>

                                            </td> 
                                        </tr>
                                        <tr>
                                            <th><label for="picID">PIC Department: </label></th>
                                            <td>';
                                                // if($r["picDepartment"] != (-1))
                                                // {
                                                //     if($r["picDepartment"] == "Department_Academic") { echo '<input style="text-transform: capitalize;" type="text" value="Academic Department" size="50" readonly><br /><br />'; }
                                                //     else if($r["picDepartment"] == "Department_Admin") { echo '<input style="text-transform: capitalize;" type="text" value="Admin Department" size="50" readonly><br /><br />'; }
                                                //     else if($r["picDepartment"] == "Department_IT") { echo '<input style="text-transform: capitalize;" type="text" value="IT Department" size="50" readonly><br /><br />'; }
                                                //     else { echo '<input style="text-transform: capitalize;" type="text" value="None" size="50" readonly><br /><br />'; }
                                                // }
                                                // else
                                                // {
                                                //     echo '<select name="picDepartment" id="picDepartment" style="width: 300px">
                                                //             <option value="-1">Please select department</option>
                                                //             <option value="Department_Academic">Acadamic Department</option>
                                                //             <option value="Department_Admin">Admin Department</option>
                                                //             <option value="Department_IT">IT Department</option>
                                                //         </select>';
                                                // }                                                 

                                                  echo '<tr>
                                                        <th><label for="picID">PIC Department: </label></th>
                                                        <td><input style="text-transform: capitalize;" type="text" value="' . $r["departmentName"] . '" size="50" readonly> <br /> <br />';
                                               
                                                // echo '<select name="picDepartment" id="picDepartment" style="width: 300px">
                                                //             <option value="-1">Please select department</option>
                                                //             <option value="Department_Academic">Acadamic Department</option>
                                                //             <option value="Department_Admin">Admin Department</option>
                                                //             <option value="Department_IT">IT Department</option>
                                                //         </select>';

                                                
                                                    $query = "SELECT * FROM department";
                                                    $result = mysqli_query($conn, $query);
                                               
                                                   
                                                    if(mysqli_num_rows($result) > 0)
                                                    { 
                                                        $echo_string = 
                                                            "<select class='form-control form-control-sm' name='pic_departmentid' id='pic_departmentid' required style='width: 300px'>
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
                                                    

                                            echo '<a data-toggle="tooltip" data-placement="right" title="Choose Department that responsible for the task" 

                                              style="color: blue; font-size: 25px;"> <i class="fas fa-info-circle" ></i></a>
                                              </td>
                                        </tr>
                                        <tr>
                                            <th><label for="picID">PIC: </label></th>
                                            <td>';
                                            // if($r["picDepartment"] != (-1)) { echo '<input style="text-transform: capitalize;" type="text" value="' . $r["picFullname"] . '" size="50" readonly><br /><br />'; }
                                            // else
                                            // {
                                            //     echo '<select class="text-capitalize" name="picID" id="picID" style="width: 300px">
                                            //                 <option value="-1">Select PIC</option>
                                            //             </select>';
                                            // }   
                                            echo '<input style="text-transform: capitalize;" type="text" value="' . $r["picFullname"] . '" size="50" readonly><br /><br />'; 
                                            echo '<select class="text-capitalize" name="picID" id="picID" style="width: 300px">
                                                            <option value="-1">Select PIC</option>
                                                        </select>';

                                            echo '<a data-toggle="tooltip" data-placement="right" title="Select the PIC Name according to the department" 

                                              style="color: blue; font-size: 25px;"> <i class="fas fa-info-circle" ></i></a>
                                              </td> 
                                        </tr>
                                        
                                    </table>
                                    <br /><button class="btn btn-primary" type="submit" name="assign">Assign</button>';
                                    // <button class="btn btn-primary" type="submit" name="submitAll">Submit All</button>
                                echo '</div>
                            </div>
                        </div>
                    </div> ';
                    
                    
                }
                
                ?>
<!-- ==============================================FEEDBACK PANEL=============================================== -->
                <div role="tabpanel" class="tab-pane" id="feedback">
                  <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">PIC Feedback</h6>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <input type="hidden" name="reportID" id="reportID" value="<?= $_GET["id"] ?>">
                        <input type="hidden" name="mitigationID" id="mitigationID" value="'<?= $_GET["mit_id"] ?>">
                                
                          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <?php    
                              $query = sprintf("SELECT admin.*
                                FROM admin
                                JOIN report_handler 
                                ON report_handler.reportID = '$_GET[id]'
                                AND report_handler.adminID = admin.adminID",
                              mysqli_real_escape_string($conn, $_GET["id"]));

                              $result = mysqli_query($conn, $query);
                              
                              $r = mysqli_fetch_assoc($result);
                              //echo "num rows: " . $r["adminID"];
                              if(mysqli_num_rows($result) > 0)
                              {
                                  
                                echo 
                                '<tr>
                                    <th>Admin Investigate:</th>
                                    <td><input type="text" name="dateInvestigate" id="dateInvestigate" value="' . $r["adminFullname"] . '" size="50" readonly />
                                     <a data-toggle="tooltip" data-placement="right" title="Name of admin that investigate the hazard" 

                                      style="color: blue; font-size: 25px;"> <i class="fas fa-info-circle" ></i></a> 
                                    </td>
                                </tr>';
                              }
                              else 
                              {
                                echo 
                                '<tr>
                                    <th>Admin Investigate:</th>
                                    <td><input type="text" name="dateInvestigate" id="dateInvestigate" value="None" size="50" readonly />
                                      <a data-toggle="tooltip" data-placement="right" title="No admin investigate the hazard" 

                                      style="color: blue; font-size: 25px;"> <i class="fas fa-info-circle" ></i></a>

                                    </td>
                                </tr>
                                ';
                              }
                            ?>

                            <?php 
                              if($_GET["mit_id"] == 0)
                              {
                                  $query = sprintf("SELECT pic.*, report_handler.*, department.* 
                                                  FROM pic 
                                                  JOIN report_handler 
                                                      ON report_handler.picID = pic.picID
                                                      AND report_handler.reportID = '%s'
                                                  JOIN department
                                                      ON department.departmentID = pic.departmentID", mysqli_real_escape_string($conn, $_GET["id"]));
                                  $result = mysqli_query($conn, $query);

                                  $r = mysqli_fetch_assoc($result);

                              echo '<tr>
                                    <th><label for="picID">PIC Department: </label></th>
                                    <td><input style="text-transform: capitalize;" type="text" value="' . $r["departmentName"] . '" size="50" readonly> <br /> <br />';
                                        
                                        // if($r["picDepartment"] == "Department_Academic") { echo '<input style="text-transform: capitalize;" type="text" value="Academic Department" size="50" readonly><br /><br />'; }
                                        // else if($r["picDepartment"] == "Department_Admin") { echo '<input style="text-transform: capitalize;" type="text" value="Admin Department" size="50" readonly><br /><br />'; }
                                        // else if($r["picDepartment"] == "Department_IT") { echo '<input style="text-transform: capitalize;" type="text" value="IT Department" size="50" readonly><br /><br />'; }
                                        // else { echo '<input style="text-transform: capitalize;" type="text" value="None" size="50" readonly><br /><br />'; }


                                       
                                    echo '<a data-toggle="tooltip" data-placement="right" title="Department that responsible for the task" 

                                      style="color: blue; font-size: 25px;"> <i class="fas fa-info-circle" ></i></a>
                                      </td>
                                </tr>
                                <tr>
                                    <th><label for="picID">PIC: </label></th>
                                    <td>';
                                     
                                    echo '<input style="text-transform: capitalize;" type="text" value="' . $r["picFullname"] . '" size="50" readonly><br /><br />'; 

                                    echo '<a data-toggle="tooltip" data-placement="right" title="PIC Name responsible for the task" 

                                      style="color: blue; font-size: 25px;"> <i class="fas fa-info-circle" ></i></a>
                                      </td> 
                                </tr>
                                <tr>
                                    <th colspan="2" class="text-center">Feedback Details</th>
                                </tr>
                                <tr>
                                    <th><label for="feedbackRemarks">Feedback Comment: </label></th>
                                    <td><textarea name="feedbackRemarks" id="feedbackRemarks" rows="4" cols="50" readonly>' . $r['feedbackRemarks'] . '</textarea>

                                    <a data-toggle="tooltip" data-placement="right" title="Feedback from the PIC that assign with the task." 

                                      style="color: blue; font-size: 25px;"> <i class="fas fa-info-circle" ></i></a>

                                      </td> 
                                </tr>
                                <tr>
                                    <th><label for="dateFeedback">Feedback Date: </label></th>
                                    <td><input type="date" name="dateFeedback" id="dateFeedback" value="' .  $r['dateFeedback'] . '" readonly>

                                      <a data-toggle="tooltip" data-placement="right" title="PIC feedback date" 

                                      style="color: blue; font-size: 25px;"> <i class="fas fa-info-circle" ></i></a>

                                    </td> 
                                </tr>
                                <tr>
                                    <th><label for="feedbackDate">Picture: </label></th>
                                    <td>' . getFeedbackPictureList($_GET{"id"}) . ' </td>
                                </tr>';
                              }
                            ?>

                          </table>

                      </div>
                    </div>
                  </div>
                </div>

                     <!-- <label for="reportPicture">Report Picture :</label>
                    <input type="file" name="reportPicture" id="reportPicture">
                        <br>
                        <br> -->
            </form>
          </div>

        </div>
        <!-- =============================================END FORM======================================= -->


      </div>
      <!-- end container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <footer class="sticky-footer bg-white">
      <div class="container my-auto">
        <div class="copyright text-center my-auto">
          <!-- <span>Copyright &copy; Your Website 2019</span> -->
          <span style="font-family: 'Times New Roman', Times, serif; font-size: 16px;">Copyright &copy;2021 - <?= date('Y'); ?> <a href="http://www.kuptm.edu.my/">Kolej Universiti Poly-Tech MARA (KUPTM) Kuala Lumpur</a> <br /> All rights reserved.</span>
        </div>
      </div>
    </footer>
    <!-- End of Footer -->

  </div>
  <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

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

  <script src="admin_function.js"></script>

</body>

</html>

<?php
    if(isset($_POST["submit"]))
    {
        //echo "submit";
        $i = 0;
        $mitigation_id = $_POST["mitigationID"];
        $reportId = $_POST["reportID"];
        $investigateRemarks = $_POST["investigateRemarks"];
        $dateInvestigate = $_POST["dateInvestigate"];
        //echo $dateInvestigate;
        //echo "date: " . date_format($dateInvestigate, "Y-m-d");

        $total = count($_FILES['investigatePictures']['name']);
        
        for($i = 0; $i < $total; $i++)
        {
            $file_name = $_FILES['investigatePictures']['name'][$i];
            $file_tmp_name = $_FILES['investigatePictures']['tmp_name'][$i];

            $file_extension = explode('.', $file_name);
            $file_extension = strtolower(end($file_extension));
            $new_file_name = uniqid() . '.' . $file_extension;

            move_uploaded_file($file_tmp_name, 'images/' . $new_file_name);

            $query = sprintf("INSERT INTO investigate_picture_list 
                    VALUES (null, '%s', '%s')",
                    mysqli_real_escape_string($conn, $new_file_name),
                    mysqli_real_escape_string($conn, $reportId));

            $result = mysqli_query($conn, $query);
            
            if(!$result) { 
                echo("Error description: " . mysqli_error($conn));    
                unlink('images/' . $new_file_name);
                //header("location: pic_report_task_accepted");
            }
        }
        
        $query = "UPDATE report_handler
                SET 
                    investigateRemarks = '$investigateRemarks', 
                    dateInvestigate = '$dateInvestigate',
                    adminID = '" . $_SESSION["adminID"] . "'
                WHERE 
                    reportID = '$reportId'";
        $result = mysqli_query($conn, $query);

        if (!$result) { echo mysqli_error($conn); } 
        else 
        {
            //echo alertModal("Alert", "Data successfully submitted!");
            //echo '<script>window.location.href = "admin_dashboard.php";</script>';
            echo '<script>alert("data successfully submitted!"); window.location.href = "admin_dashboard.php";</script>';
        }      
    }

    if (isset($_POST["report"])) 
    {

        //check whether data success add in database
        // if (edit($_POST) > 0 ) {
        // 	//echo "data success edited!";
        //   echo '<script>alert("data successfully edited!");</script>';
        // } else {
        // 	//echo "data failed edited!";
        //   echo '<script>alert("data failed to edit!");</script>';
        // }

        //echo '<script>alert("probably value:'  . $_POST["probability"] . '");</script>';

        $mitigation_id = $_POST["mitigationID"];
        $reportId = $_POST["reportID"];
        $reportType = $_POST["reportType"];
        $venue = $_POST["venue"];

        $dateManaged = $_POST["dateInvestigate"];
        $hazardActivity = $_POST["hazardActivity"];
        $hazard = $_POST["hazard"];
        $hazardImpact = $_POST["hazardImpact"];
        $existingControl = $_POST["existingControl"];
        $probability = $_POST["probability"];
        $impact = $_POST["impact"];
        $risklevel = $_POST["riskLevel"];
        $mitigationPlan = $_POST["mitigationAction"];
        $dateSolved = $_POST["dateSolved"];
        $status = $_POST["status"];

        $query = "UPDATE report, report_handler, hazard, risk_analysis, risk_control 
            SET
                report.reportType = '$reportType',
                hazard.hazardActivity = '$hazardActivity',
                hazard.hazard = '$hazard',
                hazard.hazardImpact = '$hazardImpact',
                risk_analysis.existingControl = '$existingControl',
                risk_analysis.probability = '$probability',
                risk_analysis.impact = '$impact',
                risk_analysis.riskLevel = '$risklevel',
                risk_control.mitigationPlan = '$mitigationPlan',
                risk_control.expectedDateSolved = '$dateSolved',
                risk_control.status = '$status'
            WHERE report.reportID = '$reportId'
            AND hazard.reportID = '$reportId'
            AND hazard.mitigationID = '$mitigation_id'
            AND risk_analysis.reportID = '$reportId'
            AND risk_analysis.mitigationID = '$mitigation_id'
            AND risk_control.reportID = '$reportId'
            AND risk_control.mitigationID = '$mitigation_id'";
        // -- AND risk_analysis.RAID = '$rarc'
        // -- AND risk_control.RCID = '$rarc'";

        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

        if($status == 3)
        {
            $mitCount = $_POST["mitigationID"];

            for($mitCount; $mitCount > -1; $mitCount--)
            {
                $query = "UPDATE report, report_handler, hazard, risk_analysis, risk_control 
                        SET
                            risk_control.status = '$status'
                        WHERE report.reportID = '$reportId'
                        AND hazard.reportID = '$reportId'
                        AND hazard.mitigationID = '$mitCount'
                        AND risk_analysis.reportID = '$reportId'
                        AND risk_analysis.mitigationID = '$mitCount'
                        AND risk_control.reportID = '$reportId'
                        AND risk_control.mitigationID = '$mitCount'";
                $result = mysqli_query($conn, $query);

                if (!$result) { echo mysqli_error($conn); } 
            }

            // echo 
            // "<script>
            //     investigate_notification
            //     (
            //         '', 
            //         'ReportID: " . $reportId . " with Mitigation: " . $mitigation_id . " has been solved', 
            //         'Solved', 
            //         'ReportID: " . $reportId . " with Mitigation: " . $mitigation_id . " has been solved', 
            //         " . $_SESSION["adminID"] . ", 
            //         " . $picID . "
            //     );
            // </script>";
        }

        //echo "mit id: " . $mitigation_id;


        // if($status == 1)
        // {      
        //     echo 
        //     "<script>
        //         managed_solved_notification
        //         (
        //             'Managed', 
        //             'ReportID: " . $reportId . " with Mitigation: " . $mitigation_id . " has been managed', 
        //             'Managed', 
        //             'You have new task on reportID: " . $reportId . " with Mitigation: " . $mitigation_id . "', 
        //             " . $_SESSION["adminID"] . ", 
        //             " . $picID . "
        //         );
        //     </script>";
        // }

        if (!$result) { echo mysqli_error($conn); } 
        else 
        {
            echo '<script>alert("data successfully edited!"); window.location.href = "admin_dashboard.php";</script>';

            echo 
            "<script>
                new_submission_notification
                (
                    'Investigation', 
                    'ReportID: " . $reportId . " with Mitigation: " . $mitigation_id . ", admin " . $_SESSION["admin_fullname"] . " has filled the investigation report.'
                );
            </script>";
        }      
    }

    if(isset($_POST["assign"])) 
    {
        //echo '<script>alert("picID: ' . $_POST["picID"] . '");</script>';
        
        if($_POST["picID"] != -1)
        {
            $mitigation_id = $_POST["mitigationID"];
            //echo "mitigationid: " . $mitigation_id;
            $reportId = $_POST["reportID"];
            //echo 'reportid: ' . $reportId;
            $expectedDateSolved = $_POST["expectedDateSolved"];
            //echo 'expecteddatesolved: ' . $expectedDateSolved;
            $picID = $_POST["picID"];
            //echo 'picID: ' . $picID;
            $status = $_POST["status"];
            //echo 'status: ' . $status;

            echo '<script>alert("picID: "' . $picID . ');</script>';

            $query = "UPDATE report_handler
                SET
                    picID = '$picID'
                WHERE reportID = '$reportId'";

            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

            // if($status == 1)
            // {      
            //     echo 
            //     "<script>
            //         managed_solved_notification
            //         (
            //             'Assigned', 
            //             'ReportID: " . $reportId . " with Mitigation: " . $mitigation_id . ", admin " . $_SESSION["admin_fullname"] . " has assigned pic.', 
            //             'Managed', 
            //             'You have new task on reportID: " . $reportId . " with Mitigation: " . $mitigation_id . "', 
            //             " . $_SESSION["adminID"] . ", 
            //             " . $picID . "
            //         );
            //     </script>";
            // }

            if (!$result) { echo mysqli_error($conn); } 
            else 
            {
                if($picID != -1)
                {

                    echo '<script>alert("data successfully edited!"); window.location.href = "admin_dashboard.php";</script>';
                    //echo '<script>alert("data successfully edited!");';
                    //header("Location: admin_dashboard.php");
                    echo 
                    "<script>
                        investigation_notification
                        (
                            'Assigned', 
                            'ReportID: " . $reportId . " with Mitigation: " . $mitigation_id . ", admin " . $_SESSION["admin_fullname"] . " has assigned pic.', 
                            'Assigned', 
                            'You have new task on reportID: " . $reportId . " with Mitigation: " . $mitigation_id . "', 
                            " . $_SESSION["adminID"] . ", 
                            " . $picID . "
                        );
                    </script>";
                }
                else 
                {
                    echo '<script>alert("You need to choose pic in order to edit!");</script>';
                }
            }      
        }
        else 
        {
            echo '<script>alert("You need to choose pic in order to edit!");</script>';
        }
    }

    if(isset($_POST["submitAll"]))
    {
        echo '<script>alert("Submit all button");</script>';   
    }
?>

<script>
// function picidtest()
// {
//   var e = document.getElementById("picID");
//   alert("PICID:" + e.value);
// }

fetch_admin_notification_function(<?php echo $_SESSION["adminID"] ?>);
change_admin_read_status(<?php echo $_SESSION["adminID"] ?>);

$("#pic_departmentid").change(function()
{
    $.ajax(
    {
        type: "POST",
        url: "admin_function.php",
        data:
        {
            process: "pic_department",
            department: $("#pic_departmentid").val()
        },
        dataType: 'json',
        success: function (response) {
            var jsonData = response;
            
            if (jsonData.success == 1) {
                $("#picID").html(jsonData.picList);
            }
        },
        error: function (data, status, error) {
            //handle your error
            alert('Data: ' + data + ' status: ' + status + ' Error: ' + error);
        }
    });
});
</script>