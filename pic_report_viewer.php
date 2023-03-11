<?php
    require "connection.php";
    require "pic_css_function.php";

    session_start();

    $id = $_GET['id'];

    if($_SESSION["picLogged"] != 1) { header("Location: pic_login"); }

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
                            
                            if(isset($_POST['view_reportid']))
                            {
                                $query = sprintf("SELECT report.*, report_handler.*, complaint.*
                                                FROM report 
                                                JOIN report_handler	
                                                    ON report_handler.picID = '%s' 
                                                    AND report_handler.reportID = '$id' 
                                                JOIN complaint 
                                                    ON complaint.reportID = '$id'", 
                                                mysqli_real_escape_string($link, $_SESSION['picID']));
                                $result = mysqli_query($link, $query);
                    
                                // echo "num rows: " . mysqli_affected_rows($result);
                    
                                if(!$result)
                                {
                                    // echo 
                                    // "<p>Something wrong while processing.</p>" . 
                                    // "<p>ERROR: " . mysqli_error($link) . "</p>" .
                                    // "<p><a href='pic_main' />Back</a></p>"; 
                                    header("location: pic_report_task");
                                }
                                else if(mysqli_num_rows($result) > 0)
                                {
                                    $row = mysqli_fetch_assoc($result);

                                    echo 
                                    '<div class="card shadow mb-4">' .
                                        '<div class="card-header py-3">' .
                                            '<h6 class="m-0 font-weight-bold text-primary">Report Details</h6>' .
                                        '</div>' .
                                        '<div class="card-body">' .
                                            '<div class="table-responsive">' .
                                                '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">' .
                                                    // '<tr>'.
                                                    //     '<th></th>' .
                                                    //     '<td></td>' .
                                                    // '</tr>' .
                                                    "<tr>" . 
                                                        "<th>Picture</th>" . 
                                                        "<td>" . getReportPictureList($row['reportID']) . "</td>" .
                                                    "</tr>" .
                                                    "<tr>" .
                                                        "<th>ID</th>" . 
                                                        "<td>" . $row['reportID'] . "</td>" .
                                                    "</tr>" .
                                                    "<tr>" . 
                                                        "<th>Remarks</th>" .
                                                        "<td>" . $row['remarks'] . "</td>" .
                                                    "</tr>" .
                                                    "<tr>" . 
                                                        "<th>Venue</th>" .
                                                        "<td>" . $row['venue'] . "</td>" .
                                                    "</tr>" .
                                                    "<tr>" . 
                                                        "<th>Complaint Date</th>" .
                                                        "<td>" . $row['dateComplaint'] . "</td>" .
                                                    "</tr>" .
                                                '</table>' .
                                            '</div>' .
                                        '</div>' .
                                    '</div>';
                                }
                            }


                            if(isset($_POST['view_reportid_full']))
                            {
                                $query = sprintf("SELECT report_handler.*, report.*, hazard.*, risk_analysis.*, risk_control.*, complaint.* 
                                                FROM report_handler 
                                                JOIN report 
                                                    ON report_handler.picId = '%s' 
                                                    AND report.reportId = '%s' 
                                                    AND report_handler.reportId = '%s' 
                                                JOIN hazard 
                                                    ON hazard.reportID = report.reportID 
                                                JOIN risk_analysis 
                                                    ON risk_analysis.reportID = report.reportID 
                                                JOIN risk_control 
                                                    ON risk_control.reportID = report.reportID
                                                JOIN complaint
                                                    ON complaint.reportID = report.reportID", 
                                            mysqli_escape_string($link, $_SESSION['picID']),
                                            mysqli_escape_string($link, $id),
                                            mysqli_escape_string($link, $id));
                                $result = mysqli_query($link, $query);

                                // echo "num rows: " . mysqli_affected_rows($result);

                                if(!$result)
                                {
                                    echo 
                                    "<p>Something wrong while processing.</p>" . 
                                    "<p>ERROR: " . mysqli_error($link) . "</p>";
                                    // "<p><a href='pic_main' />Back</a></p>"; 
                                // header("location: pic_main");
                                }
                                else if(mysqli_num_rows($result) > 0)
                                {
                                    $row = mysqli_fetch_assoc($result);

                                    echo 
                                    '<div class="card shadow mb-4">' .
                                        '<div class="card-header py-3">' .
                                            '<h6 class="m-0 font-weight-bold text-primary">Report Details</h6>' .
                                        '</div>' .
                                        '<div class="card-body">' .
                                            '<div class="table-responsive">' .
                                                '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">' .
                                                    // '<tr>'.
                                                    //     '<th></th>' .
                                                    //     '<td></td>' .
                                                    // '</tr>' .
                                                    "<tr>". 
                                                        "<th>Report Picture</th>". 
                                                        // "<td><img src='images/" . $row['reportPicture'] . "' alt='Report Picture' style='width:150px;height:150px;' /></td>" .
                                                        "<td style='text-align: center;'>" . getReportPictureList($row['reportID']) . "</td>" .
                                                    "</tr>" .
                                                    "<tr>" . 
                                                        "<th>Feedback Picture</th>" .
                                                        "<td style='text-align: center;'>" . getFeedbackPictureList($row['reportID']) . "</td>" .
                                                    "</tr>" .
                                                    "<tr>".
                                                        "<th>ID</th>" . 
                                                        "<td>" . $row['reportID'] . "</td>" .
                                                    "</tr>" .
                                                    // "<tr>".
                                                    //     "<th>Status</th>" . 
                                                    //     "<td>" . $row['stages'] . "</td>" .
                                                    // "</tr>" .
                                                    "<tr>" . 
                                                        "<th>Feedback Remarks</th>" .
                                                        "<td>" . $row['feedbackRemarks'] . "</td>" .
                                                    "</tr>" .
                                                    "<tr>" . 
                                                        "<th>Managed Remarks</th>" .
                                                        "<td>" . $row['investigateRemarks'] . "</td>" .
                                                    "</tr>" .
                                                    "<tr>" . 
                                                        "<th>Feedback Date</th>" .
                                                        "<td>" . $row['dateFeedback'] . "</td>" .
                                                    "</tr>" .
                                                    "<tr>" . 
                                                        "<th>Managed Date</th>" .
                                                        "<td>" . $row['dateInvestigate'] . "</td>" .
                                                    "</tr>" .
                                                    "<tr>" . 
                                                        "<th>Complaint Date</th>" .
                                                        "<td>" . $row['dateComplaint'] . "</td>" .
                                                    "</tr>" .
                                                    "<tr>" . 
                                                        "<th>Category</th>" .
                                                        "<td>" . $row['reportType'] . "</td>" .
                                                    "</tr>" .
                                                    // "<tr>" . 
                                                    //     "<th>Stages</th>" .
                                                    //     "<td>" . $row['stages'] . "</td>" .
                                                    // "</tr>" .
                                                    "<tr>" . 
                                                        "<th style='text-align: center;' colspan='2'>Hazard</th>" .
                                                    "</tr>" .
                                                    "<tr>" . 
                                                        "<th>Hazard Activity</th>" .
                                                        "<td>" . $row['hazardActivity'] . "</td>" .
                                                    "</tr>" .
                                                    "<tr>" . 
                                                        "<th>Hazard</th>" .
                                                        "<td>" . $row['hazard'] . "</td>" .
                                                    "</tr>" .
                                                    "<tr>" . 
                                                        "<th>Hazard Impact</th>" .
                                                        "<td>" . $row['hazardImpact'] . "</td>" .
                                                    "</tr>" .
                                                    "<tr>" . 
                                                        "<th style='text-align: center;' colspan='2'>Risk Analysis</th>" .
                                                    "</tr>" .
                                                    "<tr>" . 
                                                        "<th>Existing Control</th>" .
                                                        "<td>" . $row['existingControl'] . "</td>" .
                                                    "</tr>" .
                                                    "<tr>" . 
                                                        "<th>Probability</th>" .
                                                        "<td>" . $row['probability'] . "</td>" .
                                                    "</tr>" .
                                                    "<tr>" . 
                                                        "<th>Impact</th>" .
                                                        "<td>" . $row['impact'] . "</td>" .
                                                    "</tr>" .
                                                    "<tr>" . 
                                                        "<th>Risk Level</th>" .
                                                        "<td>" . $row['riskLevel'] . "</td>" .
                                                    "</tr>" .
                                                    "<tr>" . 
                                                        "<th style='text-align: center;' colspan='2'>Risk Control</th>" .
                                                    "</tr>" .
                                                    "<tr>" . 
                                                        "<th>Mitigation Action</th>" .
                                                        "<td>" . $row['mitigationPlan'] . "</td>" .
                                                    "</tr>" .
                                                    "<tr>" . 
                                                        "<th>Date Solved</th>" .
                                                        "<td>" . $row['expectedDateSolved'] . "</td>" .
                                                    "</tr>" .
                                                    "<tr>" . 
                                                        "<th>Status</th>";
                                                        //"<td>" . $row['status'] . "</td>";
                                                        if($row['status'] == '0')
                                                        { 
                                                            echo '<td>New Submission</td>';
                                                        }
                                                        else if($row['status'] == '1')
                                                        { 

                                                            echo '<td>Managed</td>';
                                                        }
                                                        else if($row['status'] == '2')
                                                        { 
                                                            echo '<td>Feedback Given</td>';
                                                        }
                                                        else if($row['status'] == '3')
                                                        { 
                                                            echo '<td>Solved</td>';
                                                        }
                                                    echo "</tr>" .
                                                '</table>' .
                                            '</div>' .
                                        '</div>' .
                                    '</div>';
                                }
                            }

                        echo '</div>';
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

    function getReportPictureList($reportID) 
    {
        include "connection.php";

        $query = sprintf("SELECT reportPicture FROM report_picture_list WHERE reportID = %s",
                mysqli_real_escape_string($link, $reportID));
        $resultPicture = mysqli_query($link, $query);

        if(!$resultPicture)
        {
            return "<td>Error displaying picture: " . mysqli_error($link) . "</td>";
        }
        else 
        {
            if(mysqli_num_rows($resultPicture) > 0)
            {
                $pictureList = null;
                while(($img = mysqli_fetch_assoc($resultPicture)))
                {
                    $pictureList .= "<a href='images/" . $img['reportPicture'] . "' target='_blank'><img src='images/" . $img['reportPicture'] . "' alt='Report Picture' style='width:100px;height:100px;'/></a>";
                } 
                return $pictureList;
            }
            else
            {
                return "<p></p>No picture to display.</p>";
            }    
        }
    }
    
    function getFeedbackPictureList($rhID) 
    {
        include "connection.php";

        $query = sprintf("SELECT feedbackPicture FROM report_feedbackpicture_list WHERE reportID = %s",
            mysqli_real_escape_string($link, $rhID));
        $resultPicture = mysqli_query($link, $query);

        if(!$resultPicture)
        {
            return "<td>Error displaying picture: " . mysqli_error($link) . "</td>";
        }
        else 
        {
            if(mysqli_num_rows($resultPicture) > 0)
            {
                $pictureList = null;
                while(($img = mysqli_fetch_assoc($resultPicture)))
                {
                    $pictureList .= "<a href='images/" . $img['feedbackPicture'] . "' target='_blank'><img src='images/" . $img['feedbackPicture'] . "' alt='Report Picture' style='width:100px;height:100px;'/></a>";
                } 
                return $pictureList;
            }
            else
            {
                return "<p></p>No picture to display.</p>";
            }    
        }
    }
?>

<script>
    fetch_pic_notification_function(<?php echo $_SESSION["picID"] ?>);
    change_pic_read_status(<?php echo $_SESSION["picID"] ?>);
</script>