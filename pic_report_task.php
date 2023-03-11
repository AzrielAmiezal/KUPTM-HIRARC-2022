<?php

    require "connection.php";
    require "pic_css_function.php";

    session_start();

    if($_SESSION["picLogged"] == 1)
    {
        echo '<html lang="en">';
            echo '<head>' .
                '<meta charset="utf-8">' .
                '<meta http-equiv="X-UA-Compatible" content="IE=edge">' .
                '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">' .
                '<meta name="description" content="">' .
                '<meta name="author" content="">' .

                '<title>KUPTM PIC HIRARC</title>' .

                '<link href="pic_template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">' .
                '<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">' .
                '<link href="pic_template/css/sb-admin-2.min.css" rel="stylesheet">' .
                '<link href="pic_template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">' .

                '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>' .
                '<script src="notification_script.js"></script>' .

            '</head>';

            echo '<body id="page-top">';
                echo '<div id="wrapper">';
                    echo sidebar();
                    echo '<div id="content-wrapper" class="d-flex flex-column">';
                        echo '<div id="content">';
                            echo topbar($_SESSION['picFullname']);
                            echo '<div class="container-fluid">';

                            // echo 
                            // '<div class="card shadow mb-4">' .
                            //     '<div class="card-header py-3">' .
                            //         '<h6 class="m-0 font-weight-bold text-primary">Task List</h6>' .
                            //     '</div>' .
                            //     '<div class="card-body">' .
                            //         '<div class="table-responsive">' .
                            //             '<table class="table table-bordered" id="dataTableTask" width="100%" cellspacing="0">' .
                            //                 '<thead>' .
                            //                     '<tr>' .
                            //                     '<th>Hello</th>';
                            //                     '</tr>' .
                            //                 '</thead>' .
                            //                 '<tbody>' .
                            //                     '<tr>' .
                            //                             '<td>World</td>' .
                            //                     '</tr>' .
                            //                 '</tbody>' .
                            //             '</table>' .
                            //         '</div>' .
                            //     '</div>' .
                            // '</div>';
                                
                                $counter = 0;
                                // $query = sprintf("SELECT report.*, report_handler.*, complaint.*, hazard.*, risk_analysis.*, risk_control.*
                                //                     FROM report 
                                //                     JOIN report_handler	
                                //                         ON report_handler.picID = '%s' 
                                //                         AND report_handler.stages = 1 
                                //                         AND report_handler.reportID = report.reportID 
                                //                     JOIN complaint 
                                //                         ON complaint.reportID = report.reportID 
                                //                     JOIN hazard 
                                //                         ON hazard.reportID = report.reportID 
                                //                     JOIN risk_analysis 
                                //                         ON risk_analysis.reportID = report.reportID   
                                //                     JOIN risk_control 
                                //                         ON risk_control.reportID = report.reportID", 
                                //                     mysqli_real_escape_string($link, $_SESSION['picID']));
                                
                                // $query = sprintf("SELECT report.*, report_handler.*, complaint.*, hazard.*, risk_analysis.*, risk_control.*
                                //                     FROM report 
                                //                     JOIN report_handler	
                                //                         ON report_handler.picID = '%s' 
                                //                         AND report_handler.reportID = report.reportID 
                                //                     JOIN complaint 
                                //                         ON complaint.reportID = report.reportID 
                                //                     JOIN hazard 
                                //                         ON hazard.reportID = report.reportID
                                //                     JOIN risk_analysis 
                                //                         ON risk_analysis.reportID = report.reportID   
                                //                         AND risk_analysis.mitigationID = hazard.mitigationID
                                //                     JOIN risk_control 
                                //                         ON risk_control.reportID = report.reportID
                                //                         AND risk_control.mitigationID = hazard.mitigationID
                                //                         AND risk_control.status IN (0, 1)
                                //                     ORDER BY report.reportID DESC", 
                                //                     mysqli_real_escape_string($link, $_SESSION['picID']));
                                                
                                $query = sprintf("SELECT
                                                    report.*,
                                                    report_handler.*,
                                                    complaint.*,
                                                    hazard.*,
                                                    risk_analysis.*,
                                                    risk_control.*,
                                                    CASE
                                                        WHEN risk_control.status = 0 THEN 'Open'
                                                        WHEN risk_control.status = 1 THEN 'In Progress'
                                                        WHEN risk_control.status = 2 THEN 'Monitoring'
                                                        WHEN risk_control.status = 3 THEN 'Resolve'
                                                        WHEN risk_control.status = 4 THEN 'Closed'
                                                    END AS statusText
                                                FROM
                                                    report
                                                JOIN report_handler 
                                                    ON report_handler.picID = '%s'
                                                    AND report_handler.reportID = report.reportID
                                                JOIN complaint 
                                                    ON complaint.reportID = report.reportID
                                                JOIN hazard 
                                                    ON hazard.reportID = report.reportID
                                                JOIN risk_analysis 
                                                    ON risk_analysis.reportID = report.reportID 
                                                    AND risk_analysis.mitigationID = hazard.mitigationID
                                                JOIN risk_control 
                                                    ON risk_control.reportID = report.reportID 
                                                    AND risk_control.mitigationID = hazard.mitigationID 
                                                    AND risk_control.status IN(0, 1)
                                                ORDER BY
                                                    report.reportID
                                                DESC", 
                                        mysqli_real_escape_string($link, $_SESSION["picID"]));
                                $result = mysqli_query($link, $query);

                                //echo "PIC ID: " . $_SESSION['picID'] . "<br />" . "Num Rows: " . mysqli_num_rows($result);

                                if(!$result) { 
                                    echo("Error description: " . mysqli_error($link));
                                }
                                else if(mysqli_num_rows($result) > 0)
                                {
                                    echo  
                                    '<div class="card shadow mb-4">' .
                                        '<div class="card-header py-3">' .
                                            '<h6 class="m-0 font-weight-bold text-primary">Task List</h6>' .
                                        '</div>' .
                                        '<div class="card-body">' .
                                            '<div class="table-responsive">' .
                                                '<table class="table table-bordered" id="dataTableTask" width="100%" cellspacing="0">' .
                                                    '<thead>' .
                                                        "<tr>" .
                                                            '<th>No</th>' .
                                                            '<th>Hazard Description</th>' .
                                                            '<th><div style="writing-mode: sideways-lr; text-orientation: mixed;">Probability</div></th>' .
                                                            '<th><div style="writing-mode: sideways-lr; text-orientation: mixed;">Impact</div></th>' .
                                                            '<th>Category (Risk Level)</th>' .
                                                            '<th>Mitigation Plan</th>' .
                                                            '<th>Expected Date Completed</th>' .
                                                            '<th>Status</th>' .
                                                            '<th>Action</th>' .
                                                            '<th>View</th>' .
                                                        "</tr>" .
                                                    '</thead>' .
                                                    '<tbody>';
                                                        while(($row = mysqli_fetch_assoc($result)))
                                                        {
                                                            $counter++;

                                                            echo 
                                                            "<tr>" .
                                                                "<td>" .
                                                                    '<p>' . $counter . '</p>' .
                                                                    '<p>ReportID: ' . $row['reportID'] . '</p>' .
                                                                    '<p>Mitigation: ' . $row['mitigationID'] . '</p>' .
                                                                "</td>" .
                                                                "<td>" . $row['hazardActivity'] . "</td>" .
                                                                "<td>" . $row['probability'] . "</td>" .
                                                                "<td>" . $row['impact'] . "</td>" .
                                                                "<td>" . $row['riskLevel'] . "</td>" .
                                                                "<td>" . $row['mitigationPlan'] . "</td>" .
                                                                "<td>" . $row['expectedDateSolved'] . "</td>" .
                                                                "<td>" . $row["statusText"] . "</td>" .
                                                                    // if($row['status'] == '0') {  echo 'Open'; }
                                                                    // else if($row['status'] == '1') { echo 'In progress'; }
                                                                    // else if($row['status'] == '2') { echo 'Monitoring'; }
                                                                    // else if($row['status'] == '3') { echo 'Resolved'; }
                                                                    // else if($row['status'] == '4') { echo 'Closed'; }
                                                                    // else { echo 'Not stated.'; }
                                                                "<td>" .
                                                                    "<form class='user' action='pic_report_feedback.php?id=" . $row['reportID'] . "&mit_id=" . $row["mitigationID"] . "' method='POST'>" .
                                                                        //"<button class='btn btn-primary btn-user' type='submit' name='feedback_reportid' value='" . $row['reportID'] . "'>Feedback</button>" . 
                                                                        "<button class='btn' type='submit' name='feedback_reportid' value='" . $row['reportID'] . "' data-toggle='tooltip' data-placement='top' title='Give Feedback'>" . css_circle_button("primary", "", "fas fa-file-signature") . "</button>" .
                                                                    "</form>" .
                                                                "</td>" .
                                                                "<td>" .
                                                                    "<div class='row'>" .
                                                                        "<form class='user' action='pic_report_viewer.php?id=" . $row['reportID'] . "' method='POST'>" .
                                                                            "<button class='btn' type='submit' name='view_reportid' value='" . $row['reportID'] . "' data-toggle='tooltip' data-placement='top' title='View Report'>" . css_circle_button("info", "", "far fa-file-alt") . "</button>" .
                                                                        "</form>" .
                                                                        "<form class='user' action='pic_report_viewer.php?id=" . $row['reportID'] . "' method='POST'>" .
                                                                            "<button class='btn' type='submit' name='view_reportid_full' value='" . $row['reportID'] . "' data-toggle='tooltip' data-placement='top' title='View Full Report'>" . css_circle_button("info", "", "fas fa-file-alt") . "</button>" .
                                                                        "</form>" .
                                                                    "</div>" .
                                                                "</td>" .
                                                            "</tr>";
                                                        }
                                                    echo '</tbody>' .
                                                '</table>' .
                                            '</div>' .
                                        '</div>' .
                                    '</div>';
                                }
                                else
                                {
                                    echo 
                                    '<div class="card shadow mb-4">' .
                                        '<div class="card-header py-3">' .
                                            '<h6 class="m-0 font-weight-bold text-primary">Task List</h6>' .
                                        '</div>' .
                                        '<div class="card-body">' .
                                            '<div class="table-responsive">' .
                                                '<table class="table table-bordered" id="dataTableTask" width="100%" cellspacing="0">' .
                                                    '<thead>' .
                                                        '<tr>' .
                                                            '<th>No</th>' .
                                                            '<th>Hazard Description</th>' .
                                                            '<th><div style="writing-mode: sideways-lr; text-orientation: mixed;">Probability</div></th>' .
                                                            '<th><div style="writing-mode: sideways-lr; text-orientation: mixed;">Impact</div></th>' .
                                                            '<th>Category (Risk Level)</th>' .
                                                            '<th>Mitigation Plan</th>' .
                                                            '<th>Expected Date Completed</th>' .
                                                            '<th>Status</th>' .
                                                            '<th>Action</th>' .
                                                            '<th>View</th>' .
                                                        '</tr>' .
                                                    '</thead>' .
                                                    '<tbody>' .
                                                    
                                                    '</tbody>' .
                                                '</table>' .
                                            '</div>' .
                                        '</div>' .
                                    '</div>';
                                }

                            echo "</div>";
                        echo '</div>';
                        echo footer(); 
                    echo '</div>';
                echo '</div>';

                echo modal();

                echo '<script src="pic_template/vendor/jquery/jquery.min.js"></script>';
                echo '<script src="pic_template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>';
                echo '<script src="pic_template/vendor/jquery-easing/jquery.easing.min.js"></script>';
                echo '<script src="pic_template/js/sb-admin-2.min.js"></script>';
                echo '<script src="pic_template/vendor/chart.js/Chart.min.js"></script>';
                echo '<script src="pic_template/js/demo/chart-area-demo.js"></script>';
                echo '<script src="pic_template/js/demo/chart-pie-demo.js"></script>';
                echo '<script src="pic_template/js/demo/chart-pie-demo.js"></script>';
                echo '<script src="pic_template/vendor/datatables/jquery.dataTables.min.js"></script>';
                echo '<script src="pic_template/vendor/datatables/dataTables.bootstrap4.min.js"></script>';
                echo '<script src="pic_template/js/demo/datatables-demo.js"></script>';

            echo '</body>';
        echo '</html>';
    }
    else
    {
        header("Location: pic_login");
    }
?>

<script>
$(document).ready( function () {
    $('#dataTableTask').DataTable();
} );


fetch_pic_notification_function(<?php echo $_SESSION["picID"] ?>);
change_pic_read_status(<?php echo $_SESSION["picID"] ?>);
</script>