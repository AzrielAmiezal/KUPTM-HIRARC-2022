<?php
require 'admin_function.php';
require 'email_notify.php';

if ($_SESSION["adminLogged"] == 0) { header("Location: admin_login.php"); }

if(!isset($_GET["id"]) && !isset($_GET["mit_id"])) { header("Location: admin_index.php"); }

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
    <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

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

      <!-- Divider -->
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

              if (!$result) {
                echo "ERROR: " . mysqli_error($conn);
              } else {
                $data = mysqli_fetch_assoc($result);
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
                                        ' . $data['complainantRole'] . '
                                    </td> 
                                  </tr>


                                  <tr>
                                    <th>
                                      <label for="complainantFullname">Complainant Full name: </label> 
                                    </th>
                                    <td>
                                      ' . $data['complainantFullName'] . '
                                    </td> 
                                  </tr>

                                  <tr>
                                    <th>
                                      <label for="complainantIDNo">Complainant ID No: </label> 
                                    </th>
                                    <td>
                                      ' . $data['complainantIDNo'] . '
                                    </td> 
                                  </tr>

                                  <tr>
                                    <th>
                                      <label for="complainantEmail">Complainant Email: </label> 
                                    </th>
                                    <td>
                                     ' . $data['complainantEmail'] . '
                                    </td> 
                                  </tr>

                                  <tr>
                                    <th>
                                      <label for="complainantEmail">Remarks: </label> 
                                    </th>
                                    <td>
                                    ' . $data['remarks'] . '
                                    </td> 
                                  </tr>

                                  <tr>
                                    <th colspan="2" class="text-center">
                                      Report Handler
                                    </th>
                                  </tr>
                                  <tr>
                                    <th>
                                      <label for="feedbackRemarks">Feedback Remarks: </label> 
                                    </th>
                                    <td>
                                      <input type="text" name="feedbackRemarks" id="feedbackRemarks" value="' . $data['feedbackRemarks'] . '" autocomplete="off">
                                    </td> 
                                  </tr>
                                  <tr>
                                    <th>
                                      <label for="managedRemarks">Managed Remarks: </label>
                                    </th>
                                    <td>
                                      <input type="text" name="managedRemarks" id="managedRemarks" value="' . $data['managedRemarks'] . '" autocomplete="off">
                                    </td>
                                  </tr>
                                  <tr>
                                    <th>
                                      <label for="dateFeedback">Date Feedback :</label></th>
                                    <td>
                                      <input type="date" name="dateFeedback" id="dateFeedback" value="' . $data['dateFeedback'] . '">
                                    </td> 
                                  </tr>
                                  <tr>
                                    <th>
                                      <label for="dateManaged">Date Managed :</label>
                                    </th>
                                    <td>
                                      <input type="date" name="dateManaged" id="dateManaged" value="' .  $data['dateManaged'] . '">
                                    </td> 
                                  </tr>
                                  <tr>
                                      <th>
                                        <label for="picID">PIC:</label>
                                      </th>
                                      <td>
                                        <select class="text-capitalize" name="picID" id="picID">' .
                                          //<!-- <?php echo selectedPIC(); -->
                                          '<option value="-1">Select PIC</option>';
                                        //<?php echo listPIC();

                                        $query = 'SELECT * FROM pic';
                                        //$query = "SELECT * FROM pic WHERE picID = (SELECT picID FROM report_handler.picID WHERE report_handler.reportID=". $data['reportID'] . ")";
                                        $result = mysqli_query($conn, $query);

                                        if (!$result) {
                                          echo "Error: " . mysqli_error($conn);
                                        } else {
                                          if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                              if ($row["picID"] == $data["picID"]) {
                                                echo '<option class="text-capitalize" value="' . $row["picID"] . '" selected>' . $row["picFullname"] . '</option>';
                                              } else {
                                                echo '<option class="text-capitalize" value="' . $row["picID"] . '">' . $row["picFullname"] . '</option>';
                                              }
                                            }
                                          }
                                        }
                                        echo '</select>
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
                                      <label for="reportType">Report Type :</label>
                                    </th>
                                    <td>
                                      
                                      <select name="reportType" id="reportType" onchange="ddl();" >
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
                                    </td> 
                                  </tr>
                                  <tr>
                                    <th>
                                      <label for="venue">Venue:</label>
                                    </th>
                                    <td>
                                      <input type="text" name="venue" id="venue" value="' . $data['venue'] . '" autocomplete="off">
                                    </td>
                                  </tr>
                                  <tr>
                                    <th>
                                      <label for="venue">Date Complaint:</label>
                                    </th>
                                    <td>
                                      <input type="date" name="dateComplaint" id="dateComplaint" value="' . $data['dateComplaint'] . '" readonly>
                                    </td>
                                  </tr>

                                  <tr>
                                    <th colspan="2" class="text-center">
                                      Hazard
                                    </th>
                                  </tr>
                                  <tr>
                                    <th>
                                      <label for="hazardActivity">Hazard Activity :</label>
                                    </th>
                                    <td>
                                      <input type="text" name="hazardActivity" id="hazardActivity" value="' . $data['hazardActivity'] . '" autocomplete="off">
                                    </td> 
                                  </tr> 
                                  <tr>
                                    <th>
                                      <label for="hazard">Hazard :</label>
                                    </th>
                                    <td>
                                      <input type="text" name="hazard" id="hazard" value="' . $data['hazard'] . '" autocomplete="off">
                                    </td> 
                                  </tr> 
                                  <tr>
                                    <th>
                                      <label for="hazardImpact">Hazard Impact :</label>
                                    </th>
                                    <td>
                                      <input type="text" name="hazardImpact" id="hazardImpact" value="' . $data['hazardImpact'] . '" autocomplete="off">
                                    </td> 
                                  </tr> 

                                  <tr>
                                    <th colspan="2" class="text-center">
                                      Risk Analysis
                                    </th>
                                  </tr>
                                  <tr>
                                    <th>
                                      <label for="existingControl">Existing Control :</label>
                                    </th>
                                    <td>
                                      <input type="text" name="existingControl" id="existingControl" value="' . $data['existingControl'] . '" autocomplete="off">
                                    </td> 
                                  </tr> 
                                  <tr>
                                    <th>
                                    <label for="probability">Probability :</label>
                                    </th>
                                    <td>
                                      <select name="probability" id="probability" onchange="ddl();" >
                                        <option>Select Probability</option>';

                                      if ($data['probability'] == '5') {
                                        echo '<option selected="selected" value="5">Almost Certain</option>';
                                        echo '<option value="4">Quite Possible</option>';
                                        echo '<option value="3">Remotely Possible</option>';
                                        echo '<option value="2">Conceivable</option>';
                                        echo '<option value="1">Practically Impossible</option>';
                                      } else if ($data['probability'] == '4') {
                                        echo '<option value="5">Almost Certain</option>';
                                        echo '<option selected="selected" value="4">Quite Possible</option>';
                                        echo '<option value="3">Remotely Possible</option>';
                                        echo '<option value="2">Conceivable</option>';
                                        echo '<option value="1">Practically Impossible</option>';
                                      } else if ($data['probability'] == '3') {
                                        echo '<option value="5">Almost Certain</option>';
                                        echo '<option value="4">Quite Possible</option>';
                                        echo '<option selected="selected" value="3">Remotely Possible</option>';
                                        echo '<option value="2">Conceivable</option>';
                                        echo '<option value="1">Practically Impossible</option>';
                                      } else if ($data['probability'] == '2') {
                                        echo '<option value="5">Almost Certain</option>';
                                        echo '<option value="4">Quite Possible</option>';
                                        echo '<option value="3">Remotely Possible</option>';
                                        echo '<option selected="selected" value="2">Conceivable</option>';
                                        echo '<option value="1">Practically Impossible</option>';
                                      } else if ($data['probability'] == '1') {
                                        echo '<option value="5">Almost Certain</option>';
                                        echo '<option value="4">Quite Possible</option>';
                                        echo '<option value="3">Remotely Possible</option>';
                                        echo '<option value="2">Conceivable</option>';
                                        echo '<option selected="selected" value="1">Practically Impossible</option>';
                                      } else {
                                        echo '<option value="5">Almost Certain</option>';
                                        echo '<option value="4">Quite Possible</option>';
                                        echo '<option value="3">Remotely Possible</option>';
                                        echo '<option value="2">Conceivable</option>';
                                        echo '<option value="1">Practically Impossible</option>';
                                      }
                                      echo '</select>
                                    </td> 
                                  </tr> 
                                  <tr>
                                    <th>
                                      <label for="impact">Impact :</label>
                                    </th>
                                    <td>
                                      <select name="impact" id="impact" onchange="ddl();">
                                        <option>Select Impact</option>';
                                      if ($data['impact'] == '5') {
                                        echo '<option value="5" selected>Catastrophic</option>';
                                        echo '<option value="4">Major</option>';
                                        echo '<option value="3">Moderate</option>';
                                        echo '<option value="2">Minor</option>';
                                        echo '<option value="1">Negligible</option>';
                                      } else if ($data['impact'] == '4') {
                                        echo '<option value="5">Catastrophic</option>';
                                        echo '<option value="4" selected>Major</option>';
                                        echo '<option value="3">Moderate</option>';
                                        echo '<option value="2">Minor</option>';
                                        echo '<option value="1">Negligible</option>';
                                      } else if ($data['impact'] == '3') {
                                        echo '<option value="5">Catastrophic</option>';
                                        echo '<option value="4">Major</option>';
                                        echo '<option value="3" selected>Moderate</option>';
                                        echo '<option value="2">Minor</option>';
                                        echo '<option value="1">Negligible</option>';
                                      } else if ($data['impact'] == '2') {
                                        echo '<option value="5">Catastrophic</option>';
                                        echo '<option value="4">Major</option>';
                                        echo '<option value="3">Moderate</option>';
                                        echo '<option value="2" selected>Minor</option>';
                                        echo '<option value="1">Negligible</option>';
                                      } else if ($data['impact'] == '1') {
                                        echo '<option value="5">Catastrophic</option>';
                                        echo '<option value="4">Major</option>';
                                        echo '<option value="3">Moderate</option>';
                                        echo '<option value="2">Minor</option>';
                                        echo '<option value="1" selected>Negligible</option>';
                                      } else {
                                        echo '<option value="5">Catastrophic</option>';
                                        echo '<option value="4">Major</option>';
                                        echo '<option value="3">Moderate</option>';
                                        echo '<option value="2">Minor</option>';
                                        echo '<option value="1">Negligible</option>';
                                      }
                                      echo '</select>
                                    </td> 
                                  </tr> 
                                  <tr>
                                      <th>
                                        <label for="riskLevel">Risk Level :</label>
                            
                                      </th>
                                      <td>
                                        <input type="text" name="riskLevel" id="riskLevel" value="' . $data['riskLevel'] . '" readonly>
                                      </td> 
                                  </tr>

                                  <tr>
                                    <th colspan="2" class="text-center">
                                      Risk Control
                                    </th>
                                  </tr>
                                  <tr>
                                      <th>
                                        <label for="mitigationAction">Mitigation Action :</label>
                                      </th>
                                      <td>
                                        <input type="text" name="mitigationAction" id="mitigationAction" value="' . $data['mitigationAction'] . '" autocomplete="off">
                                      </td> 
                                  </tr>
                                  <tr>
                                      <th>
                                        <label for="dateSolved">Date Solved :</label>
                                      </th>
                                      <td>
                                        <input type="date" name="dateSolved" id="dateSolved" value="' . $data['dateSolved'] . '">
                                      </td> 
                                  </tr>
                                  <tr>
                                      <th>
                                        <label for="status">Status :</label>
                                      </th>' .
                                    //   <td>
                                    //     <input type="text" name="status" id="status" value="' . $data['status'] . '">
                                    //   </td> 
                                    '<td><select name="status" id="status">
                                        <option value="-1">Select status</option>';
                                        if($data['status'] == '0')
                                        { 
                                            echo '<option value="0" selected>New Submission</option>';
                                            echo '<option value="1">Managed</option>';
                                            echo '<option value="2">Feedback Given</option>';
                                            echo '<option value="3">Solved</option>';
                                        }
                                        else if($data['status'] == '1')
                                        { 
                                            echo '<option value="0">New Submission</option>';
                                            echo '<option value="1" selected>Managed</option>';
                                            echo '<option value="2">Feedback Given</option>';
                                            echo '<option value="3">Solved</option>';
                                        }
                                        else if($data['status'] == '2')
                                        { 
                                            echo '<option value="0">New Submission</option>';
                                            echo '<option value="1">Managed</option>';
                                            echo '<option value="2" selected>Feedback Given</option>';
                                            echo '<option value="3">Solved</option>';
                                        }
                                        else if($data['status'] == '3')
                                        { 
                                            echo '<option value="0">New Submission</option>';
                                            echo '<option value="1">Managed</option>';
                                            echo '<option value="2">Feedback Given</option>';
                                            echo '<option value="3" selected>Solved</option>';
                                        }
                                        else
                                        {
                                            echo '<option value="0">New Submission</option>';
                                            echo '<option value="1">Managed</option>';
                                            echo '<option value="2">Feedback Given</option>';
                                            echo '<option value="3">Solved</option>';
                                        }
                                        echo '</select>
                                    </td>
                                  </tr>
                              </table>
                              <br /><button class="btn btn-primary" type="submit" name="submit">Proceed</button>
                          </div>
                      </div>';
                // </div>
                //<!-- =============================================TABLE END======================================= -->
              }
              ?>
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
    if (isset($_POST["submit"])) 
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
        $feedbackRemarks = $_POST["feedbackRemarks"];
        $managedRemarks = $_POST["managedRemarks"];
        $dateFeedback = $_POST["dateFeedback"];
        $dateManaged = $_POST["dateManaged"];
        $hazardActivity = $_POST["hazardActivity"];
        $hazard = $_POST["hazard"];
        $hazardImpact = $_POST["hazardImpact"];
        $existingControl = $_POST["existingControl"];
        $probability = $_POST["probability"];
        $impact = $_POST["impact"];
        $risklevel = $_POST["riskLevel"];
        $mitigationAction = $_POST["mitigationAction"];
        $dateSolved = $_POST["dateSolved"];
        $status = $_POST["status"];
        $picID = $_POST["picID"];

        $query = "UPDATE report, report_handler, hazard, risk_analysis, risk_control 
            SET
                report.reportType = '$reportType',
                report_handler.picID = '$picID',
                report_handler.feedbackRemarks = '$feedbackRemarks',
                report_handler.managedRemarks = '$managedRemarks',
                report_handler.dateFeedback = '$dateFeedback',
                report_handler.dateManaged = '$dateManaged',
                hazard.hazardActivity = '$hazardActivity',
                hazard.hazard = '$hazard',
                hazard.hazardImpact = '$hazardImpact',
                risk_analysis.existingControl = '$existingControl',
                risk_analysis.probability = '$probability',
                risk_analysis.impact = '$impact',
                risk_analysis.riskLevel = '$risklevel',
                risk_control.mitigationAction = '$mitigationAction',
                risk_control.dateSolved = '$dateSolved',
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

            echo 
            "<script>
                managed_solved_notification
                (
                    'Solved', 
                    'ReportID: " . $reportId . " with Mitigation: " . $mitigation_id . " has been solved', 
                    'Solved', 
                    'ReportID: " . $reportId . " with Mitigation: " . $mitigation_id . " has been solved', 
                    " . $_SESSION["adminID"] . ", 
                    " . $picID . "
                );
            </script>";
        }

        //echo "mit id: " . $mitigation_id;


        if($status == 1)
        {      
            echo 
            "<script>
                managed_solved_notification
                (
                    'Managed', 
                    'ReportID: " . $reportId . " with Mitigation: " . $mitigation_id . " has been managed', 
                    'Managed', 
                    'You have new task on reportID: " . $reportId . " with Mitigation: " . $mitigation_id . "', 
                    " . $_SESSION["adminID"] . ", 
                    " . $picID . "
                );
            </script>";
        }

        if (!$result) { echo mysqli_error($conn); } 
        else 
        {
            if($picID != -1)
            {

                echo '<script>alert("data successfully edited!"); window.location.href = "admin_dashboard.php";</script>';

                //header("Location: admin_dashboard.php");
            }
            else 
            {
                echo '<script>alert("You need to choose pic in order to edit!");</script>';
            }
        }      
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
</script>