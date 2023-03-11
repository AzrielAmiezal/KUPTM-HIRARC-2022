<?php

require 'admin_function.php';
require 'pic_css_function.php';

if ($_SESSION["adminLogged"] == 0) { header("Location: admin_login.php"); }
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
        <div class="sidebar-brand-icon rotate-n-15">
          <!-- <i class="fas fa-laugh-wink"></i> -->
        </div>
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
      <hr class="sidebar-divider">

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

        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Risk Matrix</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                  <tr>
                    <th colspan="1" rowspan="2" width="15%" style="background-color:#f5d6a9;">Likelyhood (probability)</th>
                    <th colspan="5" style="background-color:#f5d6a9;">Severity (impact)</th>
                  </tr>
                  <tr style="background-color:#bac8f0;">
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                  </tr>
                  <tr>
                    <th style="background-color:#bac8f0;">5</th>
                    <th style="background-color:#fff58d;"><a href="admin_pi_map_viewer.php?p=5&i=1">5</a></th>
                    <th style="background-color:#feda79;"><a href="admin_pi_map_viewer.php?p=5&i=2">10</a></th>
                    <th style="background-color:#ff8282;"><a href="admin_pi_map_viewer.php?p=5&i=3">15</a></th>
                    <th style="background-color:#ff8282;"><a href="admin_pi_map_viewer.php?p=5&i=4">20</a></th>
                    <th style="background-color:#ff8282;"><a href="admin_pi_map_viewer.php?p=5&i=5">25</a></th>
                  </tr>
                  <tr>
                    <th style="background-color:#bac8f0;">4</th>
                    <th style="background-color:#fff58d;"><a href="admin_pi_map_viewer.php?p=4&i=1">4</a></th>
                    <th style="background-color:#feda79;"><a href="admin_pi_map_viewer.php?p=4&i=2">8</a></th>
                    <th style="background-color:#feda79;"><a href="admin_pi_map_viewer.php?p=4&i=3">12</a></th>
                    <th style="background-color:#ff8282;"><a href="admin_pi_map_viewer.php?p=4&i=4">16</a></th>
                    <th style="background-color:#ff8282;"><a href="admin_pi_map_viewer.php?p=4&i=5">20</a></th>
                  </tr>
                  <tr>
                    <th style="background-color:#bac8f0;">3</th>
                    <th style="background-color:#b4fa83;"><a href="admin_pi_map_viewer.php?p=3&i=1">3</a></th>
                    <th style="background-color:#fff58d;"><a href="admin_pi_map_viewer.php?p=3&i=2">6</a></th>
                    <th style="background-color:#feda79;"><a href="admin_pi_map_viewer.php?p=3&i=3">9</a></th>
                    <th style="background-color:#feda79;"><a href="admin_pi_map_viewer.php?p=3&i=4">12</a></th>
                    <th style="background-color:#ff8282;"><a href="admin_pi_map_viewer.php?p=3&i=5">15</a></th>
                  </tr>
                  <tr>
                    <th style="background-color:#bac8f0;">2</th>
                    <th style="background-color:#b4fa83;"><a href="admin_pi_map_viewer.php?p=2&i=1">2</a></th>
                    <th style="background-color:#fff58d;"><a href="admin_pi_map_viewer.php?p=2&i=2">4</a></th>
                    <th style="background-color:#fff58d;"><a href="admin_pi_map_viewer.php?p=2&i=3">6</a></th>
                    <th style="background-color:#feda79;"><a href="admin_pi_map_viewer.php?p=2&i=4">8</a></th>
                    <th style="background-color:#feda79;"><a href="admin_pi_map_viewer.php?p=2&i=5">10</a></th>
                  </tr>
                  <tr>
                    <th style="background-color:#bac8f0;">1</th>
                    <th style="background-color:#b4fa83;"><a href="admin_pi_map_viewer.php?p=1&i=1">1</a></th>
                    <th style="background-color:#b4fa83;"><a href="admin_pi_map_viewer.php?p=1&i=2">2</a></th>
                    <th style="background-color:#b4fa83;"><a href="admin_pi_map_viewer.php?p=1&i=3">3</a></th>
                    <th style="background-color:#fff58d;"><a href="admin_pi_map_viewer.php?p=1&i=4">4</a></th>
                    <th style="background-color:#fff58d;"><a href="admin_pi_map_viewer.php?p=1&i=5">5</a></th>
                  </tr>


                  <!-- <tr>
                    <th></th>
                    <td></td>
                  </tr> -->
                </table>

                <br />

                <div style="margin:0% 50% 0% 0%">
                  <p><b>Reference:</b></p>
                  <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                      <th style="background-color:#b4fa83;"><a href="admin_risklevel_viewer.php?rl=LOW" style="text-decoration:none;">Low</a></th>
                      <th style="background-color:#fff58d;"><a href="admin_risklevel_viewer.php?rl=MEDIUM" style="text-decoration:none;">Medium</a></th>
                      <th style="background-color:#feda79;"><a href="admin_risklevel_viewer.php?rl=HIGH" style="text-decoration:none;">High</a></th>
                      <th style="background-color:#ff8282;"><a href="admin_risklevel_viewer.php?rl=VERY HIGH" style="text-decoration:none;">Very High</a></th>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>

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

</body>

</html>

<?php
    function mitigation_table(int $mitigation_id)
    {
        $query = "SELECT hazard.reportID AS r_reportID, hazard.mitigationid AS mit_id, report.*, report_handler.picID, hazard.*, risk_analysis.*, risk_control.*, pic.*
        FROM report
        JOIN hazard
            ON hazard.reportID = report.reportID
        JOIN report_handler
            ON report_handler.reportID = report.reportID 
        JOIN risk_analysis
            ON risk_analysis.reportID = report.reportID
        JOIN risk_control
            ON risk_control.reportID = report.reportID
            AND risk_control.RCID = risk_analysis.RAID
            AND ((hazard.MitigationID = risk_analysis.MitigationID) AND (risk_analysis.MitigationID = risk_control.MitigationID))
            AND hazard.MitigationID = $mitigation_id
        JOIN pic
            ON pic.picID = report_handler.picID";
        $result = query($query);

        // <th>No</th>
        // <th>Report Type</th>
        // <th>Category (Risk Level)</th>
        // <th>Status</th>
        // <th>Action</th>
        $table =
        '<br />
        <div class="table-responsive">
             <table class="table table-bordered" id="dataTable' . $mitigation_id . '" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Hazard Description</th>
                        <th><div style="writing-mode: sideways-lr; text-orientation: mixed;">Probability</div></th>
                        <th><div style="writing-mode: sideways-lr; text-orientation: mixed;">Impact</div></th>
                        <th>Category (Risk Level)</th>
                        <th>Mitigation Plan</th>
                        <th>Person In Charge (PIC)</th>
                        <th>Expected Date Completed</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>'; 
                    $i = 1; 
                    foreach ($result as $p) :
                        // if($p["status"] == 1) { $table .= '<tr style="background-color: #b8fff1">'; }
                        // else if($p["status"] == 2) { $table .= '<tr style="background-color: #ffffb8">'; }
                            $table .='<tr>
                            <td>
                                <p>' . $i . '</p>
                                <p>ReportID: ' . $p['r_reportID'] . '</p>
                                <p>Mitigation: ' . $p['mit_id'] . '</p>
                            </td>
                            <td>' . $p["hazardActivity"] . '</td>
                            <td>' . $p["probability"] . '</td>
                            <td>' . $p["impact"] . '</td>
                            <td>' . $p["riskLevel"] . '</td>
                            <td>' . $p["mitigationPlan"] . '</td>
                            <td style="text-transform: capitalize;">' . $p["picFullname"] . '</td>
                            <td>' . $p["expectedDateSolved"] . '</td>
                            <td>';
                                if($p['status'] == '0')
                                { 
                                    $table .= 'Open';
                                }
                                else if($p['status'] == '1')
                                { 
                                    $table .= 'In Progress';
                                }
                                else if($p['status'] == '2')
                                { 
                                    $table .= 'Monitoring';
                                }
                                else if($p['status'] == '3')
                                { 
                                    $table .= 'Resolved';
                                }
                                else if($p['status'] == '4')
                                { 
                                    $table .= 'Close';
                                }
                            $table .= '</td>';
                            // '<td>';
                            //     if ($p['reportType'] == '1') {
                            //         $table .= 'Electrical Hazard';
                            //       } else if ($p['reportType'] == '2') {
                            //         $table .= 'Mechanical Hazard';
                            //       } else if ($p['reportType'] == '3') {
                            //         $table .= 'Chemical Hazard';
                            //       } else if ($p['reportType'] == '4') {
                            //         $table .= 'Radiation Hazard';
                            //       } else if ($p['reportType'] == '5') {
                            //         $table .= 'Biology Hazard';
                            //       } else if ($p['reportType'] == '6') {
                            //         $table .= 'Physical Hazard';
                            //       } else {
                            //         $table .= $p["reportType"];
                            //       }
                            // $table .= '</td>
                            // $table .= '<td>' . $p["riskLevel"] . '</td>';
                           
                            //<td>' . getReportPictureList($p["reportID"]) . '</td>
                            $table .= '<td>
                                <a href="admin_investigate.php?id=' . $p['r_reportID'] . '&mit_id=' . $mitigation_id . '" data-toggle="tooltip" data-placement="top" title="Investigate" >' . css_circle_button("warning", "", "fas fa-edit") . '</a>';
                                // if($p["status"] == 1 && $mitigation_id == 0) { $table .= ' | <a href="admin_assign.php?id=' . $p['r_reportID'] . '&mit_id=' . $mitigation_id . '" data-toggle="tooltip" data-placement="top" title="Assign PIC" >' . css_circle_button("warning", "", "fa fa-user-circle") . '</a>'; }
                                if($p["status"] != 4) { $table .= ' | <a href="admin_mitigation.php?id=' . $p['r_reportID'] . '&mit_id=' . $mitigation_id . '" data-toggle="tooltip" data-placement="top" title="Mitigation" >' . css_circle_button("primary", "", "fas fa-plus-square") . '</a>'; }
                                if($mitigation_id != 0) { 
                                    //$table .=  ' | <a href=\"admin_delete.php?id=' . $p['r_reportID'] . '&mit_id=' . $mitigation_id . '\" data-toggle="tooltip" data-placement="top" title="Delete" onClick=\"javaScript: return confirm('Are you sure to delete this mitigation bitch?');\">' . css_circle_button("danger", "", "fas fa-trash-alt") . '</a>'; 
                                    $table .= " | <a onClick=\"javascript: return confirm('Are you sure to delete this mitigation?');\" href='admin_delete.php?id=" . $p['r_reportID'] . "&mit_id=" . $mitigation_id . "'>" . css_circle_button("danger", "", "fas fa-trash-alt") . "</a>";
                                }
                                //if($p["status"] == 3) { $table .= ' | <a href="admin_print_page.php?id=' . $p['r_reportID'] . '&mit_id=' . $mitigation_id . '" data-toggle="tooltip" data-placement="top" title="Print" >' . css_circle_button("secondary", "", "fas fa-print") . '</a>'; }
                            $table .= '</td>';
                            //<!-- <td><?= $p["hazardActivity"] . '</td>''
                            // <td>' . $p["hazard"] . '</td>
                            // <td>' . $p["hazardImpact"] . '</td>

                            // <td>' . $p["existingControl"] . '</td>
                            // <td>' . $p["probability"] . '</td>
                            // <td>' . $p["impact"] . '</td>
                            // <td>' . $p["riskLevel"] . '</td>
                            // <td>' . $p["mitigationAction"] . '</td>
                            // <td>' . $p["dateSolved"] . '</td>
                            // <td>' . $p["status"] . '</td>
                            // <td>' .= $p["picID"] . '</td>
                        $table .= '</tr>';
                        $i++;
                    endforeach; 
                $table .= '</tbody>
             </table>
        </div>';

        return $table;
    }
?>        

<script>
$(document).ready( function () {
    $('#dataTable0').DataTable();
    $('#dataTable1').DataTable();
    $('#dataTable2').DataTable();
    $('#dataTable3').DataTable();
} );

fetch_admin_notification_function(<?php echo $_SESSION["adminID"] ?>);
change_admin_read_status(<?php echo $_SESSION["adminID"] ?>);
</script>