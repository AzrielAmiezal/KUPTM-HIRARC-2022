<?php 
require 'admin_function.php';

if($_SESSION["adminLogged"] == 0) { header("Location: admin_login.php"); }

if(!isset($_GET["id"]) && !isset($_GET["mit_id"])) { header("Location: admin_index.php"); }

if (isset($_POST["submit"]))
{
	
	//check whether data success add in database
	// if (edit($_POST) > 0 ) {
	// 	echo "data success mitigation!";
	// } else {
	// 	echo "data failed mitigation!";
	// }
}
    



//     $query = "SELECT risk_analysis.*, risk_control.*
//         FROM risk_analysis 
//       JOIN risk_control
//         ON risk_control.reportID = '$reportId'
//         AND risk_analysis.reportID = '$reportId'";

//   $result = mysqli_query($conn, $query);

//   if(!$result) { echo "Error: " . mysqli_error($conn); }
//   else
//   {
//     $data = mysqli_fetch_assoc($result);
//     //echo mysqli_num_rows($result);
//     //echo "Count: " . count($data);
//     if(mysqli_num_rows($result) > 3) { echo "<script>alert('You can't add more than 4 mitigation.');</script>"; }
//     else 
//     {
//       $query_ha = "INSERT INTO hazard VALUES (null, '$reportId', '', '', '', '$mitigationid')";
//       $query_ra = "INSERT INTO risk_analysis VALUES (null, '$reportId', '$existingControl', '$probability', '$impact', '$risklevel', '$mitigationid')";
//       $query_rc = "INSERT INTO risk_control VALUES (null, '$reportId', '$mitigationAction', '$convdt', '$status', '$mitigationid', '$picID')";
//       $result_ha = mysqli_query($conn, $query_ha);
//       $result_ra = mysqli_query($conn, $query_ra);
//       $result_rc = mysqli_query($conn, $query_rc);

//       echo "Suck LA SESS";

//       //echo "RA: " . mysqli_num_rows($result_ra);
//       //echo "RC: " . mysqli_num_rows($result_rc);
//       if(!($result_ra && $result_rc && $result_ha)) { echo "Error: " . mysqli_error($conn); }
//     }
//   }
// }

//$pic = query("SELECT * FROM report WHERE reportId = '$id'")[0];	
// $query = "SELECT report.*, hazard.*, risk_analysis.*, risk_control.*
//           FROM report
//           JOIN hazard
//             ON hazard.reportID = report.reportID
//           JOIN risk_analysis
//             ON risk_analysis.reportID = report.reportID
//           JOIN risk_control
//             ON risk_control.reportID = report.reportID";
// $query = "SELECT report.*, hazard.*, risk_analysis.*, risk_control.*
// FROM report
// JOIN hazard
// ON hazard.reportID = report.reportID
// AND hazard.mitigationID = 0
// JOIN risk_analysis
// ON risk_analysis.reportID = report.reportID
// AND risk_analysis.mitigationID = 0
// JOIN risk_control
// ON risk_control.reportID = report.reportID
// AND risk_control.mitigationID = 0"

// $result = mysqli_query($conn, $query);

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
          <?php 
            if(isset($_POST['submit2']))
            {
                $reportId = $_POST["reportID"];
                $mitigationid = $_GET["mit_id"] + 1;
                $existingControl = $_POST["existingControl"];
                $probability = $_POST["probability"];
                $impact = $_POST["impact"];
                $risklevel = $_POST["riskLevel"];
                $mitigationAction = $_POST["mitigationAction"];
                $dateSolved = $_POST["dateSolved"];
                $status = $_POST["status"];
                $picID = $_POST["picID"];
                
                $mit_id = $_GET["mit_id"];

                if($picID != -1)
                {

                    $query = "SELECT hazard.*, risk_analysis.*, risk_control.*
                                FROM hazard
                                JOIN risk_analysis
                                    ON hazard.reportID = '$reportId'
                                    AND hazard.mitigationID = '$mit_id'
                                    AND risk_analysis.reportID = hazard.reportID
                                    AND risk_analysis.mitigationID = hazard.mitigationID
                                JOIN risk_control
                                    ON risk_control.reportID = hazard.reportID
                                    AND risk_control.mitigationID = hazard.mitigationID";
                    $result = mysqli_query($conn, $query);

                    if (!$result) {
                        echo "Error: " . mysqli_error($conn);
                    } 
                    else 
                    {
                        $data = mysqli_fetch_assoc($result);

                        //echo '<script>alert("Status: " + ' . $data["status"] . ');</script>';

                        //echo "Status: " . $data["status"];

                        if($data["status"] == 4) { echo '<script>alert("Mitigation already solved. You can\'t add anymore mitigation.");</script>'; }
                        else
                        {
                            $query = "SELECT
                                        report.*
                                    FROM
                                        report
                                    JOIN hazard ON report.reportID = '$reportId' AND hazard.reportID = report.reportID AND hazard.mitigationID = '$mitigationid'
                                    JOIN risk_analysis ON risk_analysis.reportID = hazard.reportID AND risk_analysis.mitigationID = hazard.mitigationID
                                    JOIN risk_control ON risk_control.reportID = hazard.reportID AND risk_control.mitigationID = hazard.mitigationID";
                            $result = mysqli_query($conn, $query);
                            
                            if (!$result) {
                                echo "Error: " . mysqli_error($conn);
                            } 
                            else 
                            {
                                if($mitigationid > 3) 
                                { 
                                echo '<script>alert("You cant add more than 4 mitigation.");</script>'; 
                                }
                                else
                                {
                                    if(mysqli_num_rows($result) == 1)
                                    {
                                        echo '<script>alert("Mitigation already exitsted.");</script>';
                                    }
                                    else 
                                    {
                                        //$query_rh = "INSERT INTO report_handler (picID) VALUES ('$picID')";
                                        $query_ha = "INSERT INTO hazard VALUES (null, '$reportId', '', '', '', '$mitigationid')";
                                        $query_ra = "INSERT INTO risk_analysis VALUES (null, '$reportId', '$existingControl', '$probability', '$impact', '$risklevel', '$mitigationid')";
                                        $query_rc = "INSERT INTO risk_control VALUES (null, '$reportId', '$mitigationAction', '$dateSolved', '$status', '$mitigationid')";
                                        //$result_rh = mysqli_query($conn, $query_rh);
                                        $result_ha = mysqli_query($conn, $query_ha);
                                        $result_ra = mysqli_query($conn, $query_ra);
                                        $result_rc = mysqli_query($conn, $query_rc);
                                        
                                        if($status == 1)
                                        {      
                                            echo 
                                            "<script>
                                                investigation_notification
                                                (
                                                    'New Mitigation Added', 
                                                    'ReportID: " . $reportId . " with Mitigation: " . $mitigationid . " has been added', 
                                                    'New Mitigation Added', 
                                                    'You have new task on reportID: " . $reportId . " with Mitigation: " . $mitigationid . "', 
                                                    " . $_SESSION["adminID"] . ", 
                                                    " . $picID . "
                                                );
                                            </script>";

                                            echo '<script>alert("Mitigation successfully added."); window.location.href = "admin_dashboard.php";</script>';
                                        }

                                        //echo "<script>window.open('admin_dashboard.php', '_self');</script>";
                                        //header("location: admin_dashboard.php");

                                        //echo "RA: " . mysqli_num_rows($result_ra);
                                        //echo "RC: " . mysqli_num_rows($result_rc);
                                        if(!($result_ra && $result_rc && $result_ha)) { echo "Error: " . mysqli_error($conn); }
                                    }
                                
                                }
                            }
                        } 
                    }
                }
                else 
                {
                    echo '<script>alert("You need to choose pic in order to edit!");</script>';
                }
            }
            ?>
          <!-- <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Form</h6>
            </div>

            <div class="card-body"> -->
              <form action="" method="post" enctype="multipart/form-data">
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">Mitigation</h6>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                          <?php
                            $query = sprintf("SELECT report.*, report_handler.*, hazard.*, risk_analysis.*, risk_control.*
                                      FROM report
                                      JOIN report_handler
                                        ON report_handler.reportID = report.reportID
                                      JOIN hazard
                                        ON hazard.reportID = '%s'
                                      JOIN risk_analysis
                                        ON (risk_analysis.reportID = report.reportID) AND (risk_analysis.mitigationID = %s)
                                      JOIN risk_control
                                        ON (risk_control.reportID = report.reportID) AND (risk_analysis.mitigationID = %s)",
                                        mysqli_escape_string($conn, $_GET["id"]),
                                        mysqli_escape_string($conn, $_GET["mit_id"]),
                                        mysqli_escape_string($conn, $_GET["mit_id"]));

                            $result = mysqli_query($conn, $query);

                            if(!$result) 
                            {
                              echo "ERROR: " . mysqli_error($conn);
                            }
                            else
                            {
                              $data = mysqli_fetch_assoc($result); 
                            

                              echo 
                              '<input type="hidden" name="reportID" id="reportID" value="' . $_GET["id"] . '">';
                              
                            //   <tr>
                            //     <th class="text-center" colspan="2">Report Details</th>
                            //   </tr>';
                            //   <tr>
                            //     <th><label for="mitigationID">Mitigation ID:</label></th>
                            //     <td><input type="text" name="mitigationID" id="mitigationID" readonly value="' . $_GET['mit_id'] . '" ></td>
                            //   </tr>

                            $query = 'SELECT pic.*, report_handler.* 
                                    FROM pic
                                    JOIN report_handler
                                        ON report_handler.picID = pic.picID
                                        AND report_handler.reportID = "' . $_GET["id"] . '"';
                            $result = mysqli_query($conn, $query);

                            $pic = mysqli_fetch_assoc($result);
                            echo
                            '<tr>
                                <th class="text-center" colspan="2">Report Handler</th>
                            </tr>
                            <tr>
                                <th><label for="picID">Person In Charge (PIC):</label></th>
                                <td><input type="text" style="text-transform: capitalize" name="picID" id="picID" value="' . $pic["picFullname"] . '" readonly />

                                  <a data-toggle="tooltip" data-placement="right" title="Person in charge for the task" 

                                              style="color: blue; font-size: 25px;"> <i class="fas fa-info-circle" ></i></a>

                                </td>
                            </tr>';

                                // <td><select class="text-capitalize" name="picID" id="picID" readonly>
                                //     <option value="-1">Select PIC</option>';
                                
                                //     $query = 'SELECT * FROM pic';
                                //     //$query = "SELECT * FROM pic WHERE picID = (SELECT picID FROM report_handler.picID WHERE report_handler.reportID=". $data['reportID'] . ")";
                                //     $result = mysqli_query($conn, $query);
                
                                //     if (!$result)
                                //     {
                                //         echo "Error: " . mysqli_error($conn);
                                //     }
                                //     else
                                //     {
                                //         if (mysqli_num_rows($result) > 0) 
                                //         {
                                //             while($row = mysqli_fetch_assoc($result))
                                //             {
                                //                 if($row["picID"] == $data["picID"]) 
                                //                 {
                                //                 echo "<option class='text-capitalize' value=" . $row["picID"] . " selected>" . $row["picFullname"] . "</option>";
                                //                 }
                                //                 else
                                //                 {
                                //                 echo "<option class='text-capitalize' value=" . $row["picID"] . ">" . $row["picFullname"] . "</option>";
                                //                 }
                                //             }
                                //         }
                                //     }
                                //   echo '</select>
                                // </td>

                            echo
                              '<tr>
                                <th class="text-center" colspan="2">Risk Analysis</th>
                              </tr>
                              <tr>
                                <th><label for="existingControl">Existing Control: </label></th>
                                <td><input type="text" name="existingControl" id="existingControl" value="' . $data['existingControl'] . '" autocomplete="off">
                                  <a data-toggle="tooltip" data-placement="right" title="The current solution of the hazard" 

                                              style="color: blue; font-size: 25px;"> <i class="fas fa-info-circle" ></i></a>
                                </td>
                              </tr>
                              <tr>
                                <th>
                                  <label for="probability">Probability: </label>
                                </th>
                                <td>
                                  <select name="probability" id="probability" onchange="ddl();" >
                                    <option>Select Probability</option>'; 
                                    if($data['probability'] == '5-Almost Certain')
                                    { 
                                      echo '<option selected="selected" value="5-Almost Certain">Almost Certain</option>';
                                      echo '<option value="4-Quite Possible">Quite Possible</option>';
                                      echo '<option value="3-Remotely Possible">Remotely Possible</option>';
                                      echo '<option value="2-Conceivable">Conceivable</option>';
                                      echo '<option value="1-Practically Impossible">Practically Impossible</option>';
                                    }
                                    else if($data['probability'] == '4-Quite Possible') 
                                    { 
                                      echo '<option value="5-Almost Certain">Almost Certain</option>';
                                      echo '<option selected="selected" value="4-Quite Possible">Quite Possible</option>';
                                      echo '<option value="3-Remotely Possible">Remotely Possible</option>';
                                      echo '<option value="2-Conceivable">Conceivable</option>';
                                      echo '<option value="1-Practically Impossible">Practically Impossible</option>';
                                    }
                                    else if($data['probability'] == '3-Remotely Possible') 
                                    { 
                                      echo '<option value="5-Almost Certain">Almost Certain</option>';
                                      echo '<option value="4-Quite Possible">Quite Possible</option>';
                                      echo '<option selected="selected" value="3-Remotely Possible">Remotely Possible</option>';
                                      echo '<option value="2-Conceivable">Conceivable</option>';
                                      echo '<option value="1-Practically Impossible">Practically Impossible</option>';
                                    }
                                    else if($data['probability'] == '2-Conceivable') 
                                    { 
                                      echo '<option value="5-Almost Certain">Almost Certain</option>';
                                      echo '<option value="4-Quite Possible">Quite Possible</option>';
                                      echo '<option value="3-Remotely Possible">Remotely Possible</option>';
                                      echo '<option selected="selected" value="2-Conceivable">Conceivable</option>';
                                      echo '<option value="1-Practically Impossible">Practically Impossible</option>';
                                    }
                                    else if($data['probability'] == '1-Practically Impossible') 
                                    { 
                                      echo '<option value="5-Almost Certain">Almost Certain</option>';
                                      echo '<option value="4-Quite Possible">Quite Possible</option>';
                                      echo '<option value="3-Remotely Possible">Remotely Possible</option>';
                                      echo '<option value="2-Conceivable">Conceivable</option>';
                                      echo '<option selected="selected" value="1-Practically Impossible">Practically Impossible</option>';
                                    }
                                    else
                                    {
                                      echo '<option value="5-Almost Certain">Almost Certain</option>';
                                      echo '<option value="4-Quite Possible">Quite Possible</option>';
                                      echo '<option value="3-Remotely Possible">Remotely Possible</option>';
                                      echo '<option value="2-Conceivable">Conceivable</option>';
                                      echo '<option value="1-Practically Impossible">Practically Impossible</option>';
                                    }
                                    echo '</select>

                                    <a data-toggle="tooltip" data-placement="right" title="The probability that hazard will occur" 

                                        style="color: blue; font-size: 25px;"> <i class="fas fa-info-circle" ></i></a>

                                  </td>
                              </tr>
                              <tr>
                                <th><label for="impact">Impact: </label></th>
                                <td><select name="impact" id="impact" onchange="ddl();">
                                  <option>Select Impact</option>';
                                  if($data['impact'] == '5-Disaster')
                                  { 
                                    echo '<option value="5-Disaster" selected>Disaster</option>';
                                    echo '<option value="4-Big">Big</option>';
                                    echo '<option value="3-Medium">Medium</option>';
                                    echo '<option value="2-Small">Small</option>';
                                    echo '<option value="1-Very Small">Very Small</option>';
                                  }
                                  else if($data['impact'] == '4-Big')
                                  { 
                                    echo '<option value="5-Disaster">Disaster</option>';
                                    echo '<option value="4-Big" selected>Big</option>';
                                    echo '<option value="3-Medium">Medium</option>';
                                    echo '<option value="2-Small">Small</option>';
                                    echo '<option value="1-Very Small">Very Small</option>';
                                  }
                                  else if($data['impact'] == '3-Medium')
                                  { 
                                    echo '<option value="5-Disaster">Disaster</option>';
                                    echo '<option value="4-Big">Big</option>';
                                    echo '<option value="3-Medium" selected>Medium</option>';
                                    echo '<option value="2-Small">Small</option>';
                                    echo '<option value="1-Very Small">Very Small</option>';
                                  }
                                  else if($data['impact'] == '2-Small')
                                  { 
                                    echo '<option value="5-Disaster">Disaster</option>';
                                    echo '<option value="4-Big">Big</option>';
                                    echo '<option value="3-Medium">Medium</option>';
                                    echo '<option value="2-Small" selected>Small</option>';
                                    echo '<option value="1-Very Small">Very Small</option>';
                                  }
                                  else if($data['impact'] == '1-Very Small')
                                  { 
                                    echo '<option value="5-Disaster">Disaster</option>';
                                    echo '<option value="4-Big">Big</option>';
                                    echo '<option value="3-Medium">Medium</option>';
                                    echo '<option value="2-Small">Small</option>';
                                    echo '<option value="1-Very Small" selected>Very Small</option>';
                                  }
                                  else
                                  {
                                    echo '<option value="5-Disaster">Disaster</option>';
                                    echo '<option value="4-Big">Big</option>';
                                    echo '<option value="3-Medium">Medium</option>';
                                    echo '<option value="2-Small">Small</option>';
                                    echo '<option value="1-Very Small">Very Small</option>';
                                  }
                                echo '</select>

                                <a data-toggle="tooltip" data-placement="right" title="The rate impact of the hazard" 

                                      style="color: blue; font-size: 25px;"> <i class="fas fa-info-circle" ></i></a>

                                </td>
                                </tr>
                                <tr>
                                    <th><label for="riskLevel">Risk Level: </label></th>
                                    <td><input type="text" name="riskLevel" id="riskLevel" value="' . $data['riskLevel'] . '" readonly>

                                    <a data-toggle="tooltip" data-placement="right" title="The risk level according to Probability and Impact" 

                                        style="color: blue; font-size: 25px;"> <i class="fas fa-info-circle" ></i></a>
                                    </td>
                                </tr>

                                <tr>
                                    <th class="text-center" colspan="2">Risk Control</th>
                                </tr>
                                <tr>
                                    <th> <label for="mitigationAction">Mitigation Action: </label></th>
                                    <td><input type="text" name="mitigationAction" id="mitigationAction" value="' . $data['mitigationPlan'] . '" autocomplete= "off">
                                      <a data-toggle="tooltip" data-placement="right" title="Temporary solution for the hazard. Mitigation Plan will only have 4 phase." 

                                        style="color: blue; font-size: 25px;"> <i class="fas fa-info-circle" ></i></a>

                                    </td>
                                </tr>
                                <tr>
                                    <th><label for="dateSolved">Date Solved: </label></th>
                                    <td><input type="date" name="dateSolved" id="dateSolved" value="' . $data['expectedDateSolved'] . '">

                                      <a data-toggle="tooltip" data-placement="right" title="Expected date for PIC to solve the hazard follow the Mitigation Plan solution" 

                                        style="color: blue; font-size: 25px;"> <i class="fas fa-info-circle" ></i></a>

                                    </td>
                                </tr>
                                <tr>
                                    <th><label for="status">Status :</label></th>' .
                                    //<td><input type="text" name="status" id="status" value="' . $data['status'] . '"></td>
                                    '<td><select name="status" id="status" required>
                                    <option value="-1">Select status</option>';
                                    $data['status'] = $data['status'] - 1;

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
                              </tr>';
                            }
                            ?>
                            
                        </table>
                        <br /><button class="btn btn-secondary" type="submit" name="submit2">ADD MITIGATION</button>
                      </div>
                    </div>
                  </div>
                <!-- <input type="hidden" name="reportID" id="reportID" value="' . $data['reportID']; -->
              </form>
            <!-- </div>

          </div> -->
          <!-- =============================================END FORM======================================= -->


        </div>
        <!-- end container-fluid -->

      </div>
      <!-- End of Main Content -->

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

<script>
fetch_admin_notification_function(<?php echo $_SESSION["adminID"] ?>);
change_admin_read_status(<?php echo $_SESSION["adminID"] ?>);
</script>