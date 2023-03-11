<?php

    require "connection.php";
    require "email_notify.php";

    session_start();

    $reportID = $_GET["id"];
    $mitigationID = $_GET["mit_id"];

    echo 
    '<head>
        <title>KUPTM PIC HIRARC</title>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <link rel="stylesheet" href="pic_template/css/sb-admin-2.css" type="text/css">
        <link href="pic_template/font-awesome5.14.0/css/all.css" rel="stylesheet">
        <link href="pic_template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="notification_script.js"></script>
    </head>';

    echo '<body id="page-top">';
        echo '<div id="wrapper">';
            echo sidebar(); 
            echo '<div id="content-wrapper" class="flex-column">';
                echo '<div id="content"';
                    echo topbar("Muhammad Mubarrak");
                    echo '<div class="container-fluid">';

                    if(isset($_POST['submit']))
                    {
                        if($_FILES['feedback_picture']['error'] == 4)
                        {
                            //echo "<script>alert('There is no picture selected.');</script>";
                            echo overlay(css_small_card("warning", "WARNING", "There is no picture selected.", "fas fa-exclamation-circle")); 
                        }
                        else 
                        {
                            $query = sprintf("SELECT rhID 
                                            FROM report_handler
                                            WHERE reportID = '%s' 
                                                AND picID = '%s'",
                                    mysqli_real_escape_string($link, $reportID),
                                    mysqli_real_escape_string($link, $_SESSION['picID']));
                
                            $result = mysqli_query($link, $query);
                
                            if(!$result) { 
                                echo("Error description: " . mysqli_error($link));  
                                //header("location: pic_report_task_accepted");
                            }
                            else
                            {
                                $row = mysqli_fetch_assoc($result);
                
                                $total = count($_FILES['feedback_picture']['name']);
                                //echo "Picture Number(s): " . $total;
                                for($i = 0; $i < $total; $i++)
                                {
                                    $file_name = $_FILES['feedback_picture']['name'][$i];
                                    $file_tmp_name = $_FILES['feedback_picture']['tmp_name'][$i];
                
                                    $file_extension = explode('.', $file_name);
                                    $file_extension = strtolower(end($file_extension));
                                    $new_file_name = uniqid() . '.' . $file_extension;
                
                                    move_uploaded_file($file_tmp_name, 'images/' . $new_file_name);
                
                                    $query = sprintf("INSERT INTO report_feedbackpicture_list 
                                            VALUES (null, '%s', '%s')",
                                            mysqli_real_escape_string($link, $new_file_name),
                                            mysqli_real_escape_string($link, $row['rhID']));
                
                                    $result = mysqli_query($link, $query);
                                    
                                    if(!$result) { 
                                        echo("Error description: " . mysqli_error($link));    
                                        unlink('images/' . $new_file_name);
                                        //header("location: pic_report_task_accepted");
                                    }
                                }
                
                                $query = sprintf("UPDATE report_handler 
                                        SET feedbackRemarks='%s', dateFeedback=NOW()
                                        WHERE reportID='%s'
                                        AND picID='%s'",
                                        mysqli_real_escape_string($link, $_POST['feedback_remarks']),
                                        mysqli_real_escape_string($link, $reportID),
                                        mysqli_real_escape_string($link, $_SESSION['picID']));
                
                                $result = mysqli_query($link, $query);

                                $query = sprintf("UPDATE risk_control
                                        SET status='2'
                                        WHERE reportID='%s'
                                        AND mitigationID='%s'",
                                        mysqli_real_escape_string($link, $reportID),
                                        mysqli_real_escape_string($link, $mitigationID));

                                $result = mysqli_query($link, $query);
                
                                if(!$result) { echo("Error description: " . mysqli_error($link)); }
                
                                // $query = "SELECT adminFullname, adminEmail FROM admin";
                                // $result = mysqli_query($link, $query);

                                // if(!$result) { echo overlay(css_small_card("danger", "ERROR", "ERROR: " . mysqli_error($conn) , "fas fa-exclamation-circle")); }
                                // else
                                // {
                                //     if(mysqli_num_rows($result) > 0)
                                //     {
                                //         while($row = mysqli_fetch_assoc($result))
                                //         {
                                //             send_email($row["adminEmail"], 
                                //                 "HIRARC TASK", 
                                //                 "Hello, " . $row["adminFullname"] . ".<br /> 
                                //                 " . $_SESSION["picFullname"] . " gave feedback on the report. <br /><br />
                                //                 Logon to administrator page for further information.");
                                //         }
                                //     }
                                // }

                                
                                
                                
                                    
                                // echo 
                                // "<p>Feedback has successfuly submitted.</p>" . 
                                // "<p><a href='pic_report_task' />Back</a></p>";
                                
                                //echo overlay(css_small_card("success", "SUCCESS", "Feedback has successfuly submitted.", "fas fa-check-circle")); 
                                
                                echo 
                                "<script>
                                    feedback_given_notification
                                    (
                                        'Feedback Given', 
                                        'ReportID: " . $reportID . " with Mitigation: " . $mitigationID . ", PIC " . $_SESSION["picFullname"] . " has given feedback', 
                                        " . $_SESSION["picID"] . "
                                    );
                                </script>";
                                //echo "<script>window.location.href = 'pic_report_feedback_given.php';</script>";
                                
                                $_SESSION["reportid"] = 0;

                                //header("Location: pic_feedback_given.php");

                                // echo '<script>
                                //     function pageRedirect() {
                                //         window.location.replace("pic_report_task.php");
                                //     }      
                                //     setTimeout("pageRedirect()", 1000);
                                // </script>';

                                
                            }  
                            
                        }
                    }
                    else
                    {
                        $query = sprintf("SELECT report.*, report_handler.*, complaint.*, hazard.*, risk_analysis.*, risk_control.*
                                        FROM report 
                                        JOIN report_handler	
                                            ON report.reportID = '%s' 
                                            AND report_handler.picID = '%s' 
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
                                            AND risk_control.mitigationID = hazard.mitigationID",
                                        mysqli_real_escape_string($link, $reportID),
                                        mysqli_real_escape_string($link, $_SESSION['picID']));
                        $result = mysqli_query($link, $query);
                
                        // echo "num rows: " . mysqli_affected_rows($result);
                
                        if(!$result)
                        {
                            echo 
                            "<p>Something wrong while processing.</p>" . 
                            "<p>ERROR: " . mysqli_error($link) . "</p>" .
                            "<p><a href='pic_main' />Back</a></p>"; 
                        }
                        else if(mysqli_num_rows($result) > 0)
                        {
                            $row = mysqli_fetch_assoc($result);
                
                            // if status open, it will change in progress after the pic view the feedback
                            if($row["status"] == 0) {
                                $query = "UPDATE report, report_handler, hazard, risk_analysis, risk_control 
                                            SET
                                                risk_control.status = 1
                                            WHERE report.reportID = '$reportID'
                                            AND hazard.reportID = '$reportID'
                                            AND hazard.mitigationID = '$mitigationID'
                                            AND risk_analysis.reportID = '$reportID'
                                            AND risk_analysis.mitigationID = '$mitigationID'
                                            AND risk_control.reportID = '$reportID'
                                            AND risk_control.mitigationID = '$mitigationID'";
                                $result = mysqli_query($link, $query);

                                if (!$result) { echo mysqli_error($link); } 
                            }

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
                                                "<th>Picture</th>". 
                                                "<td>" . getImageList($row['reportID']) . "</td>" .
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
                                            "<tr>" . 
                                                "<th>Existing Control</th>" .
                                                "<td>" . $row['existingControl'] . "</td>" .
                                            "</tr>" .
                                            "<tr>" . 
                                                "<th>Mitigation Action</th>" .
                                                "<td>" . $row['mitigationPlan'] . "</td>" .
                                            "</tr>" .
                                        '</table>' .
                                    '</div>' .
                                '</div>' .
                            '</div>';
                        }
                
                        $card_body =
                        "<form action='' method='POST' enctype='multipart/form-data'>" .
                            "<p>
                                <a data-toggle='tooltip' data-placement='right' title='Feedback image for the task' style='color: blue; font-size: 25px;''> <i class='fas fa-info-circle' ></i></a>
                                <input class='form-control form-control-user' type='file' name='feedback_picture[]' accept='image/*' value='Select Image' multiple/><br />  
                            </p>" .

                            "<p>
                                <a data-toggle='tooltip' data-placement='right' title='Feedback description' style='color: blue; font-size: 25px;''> <i class='fas fa-info-circle' ></i></a> 
                                <textarea placeholder='State your comment here...' class='form-control form-control-user' name='feedback_remarks' rows='2' cols='50'></textarea><br /> 
                            </p>" .

                            "<p><input class='btn btn-primary btn-user btn-block' type='submit' name='submit' value='Submit' /><br /></p>" .
                        "</form>";
                        echo css_basic_card("Feedback Form", $card_body);
                    }

                echo '</div>';
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
?>

<?php

    // include "connection.php";
    
    // session_start();

    // $reportID = $_GET["id"];

    // echo "<div class='main_body'>";

    // echo  
    // "<ul>" .
    //     "<li><p><a href='pic_main' />Main</a></p></li>" . 
    //     "<li><p><a href='pic_report_task' />Task</a></p></li>" . 
    //     //"<li><p><a href='pic_report_task_accepted' />Accepted</a></p></li>" .
    //     "<li><p><a href='pic_report_solved' />Solved</a></p></li>" .
    //     "<li><p><a href='pic_logout' />Logout</a></p></li>" .
    // "</ul>";
    
    // if(isset($_POST['submit']))
    // {
    //     if($_FILES['feedback_picture']['error'] == 4)
    //     {
    //         echo "<script>alert('There is no picture selected.');</script>";
    //     }
    //     else 
    //     {

    //         //$fp = addslashes(file_get_contents($_FILES["feedback_picture"]["tmp_name"]));

    //         // $query = "UPDATE report_handler 
    //         //         SET feedbackPicture='" . $new_file_name . "', 
    //         //             feedbackRemarks='" . 
    //         //             htmlspecialchars($_POST['feedback_remarks']) . "', 
    //         //             status=3, 
    //         //             dateSolved=now() 
    //         //         WHERE reportId=". $_SESSION["reportid"] . "
    //         //         AND picId=" . $_SESSION["picID"];

    //         $query = sprintf("SELECT rhID 
    //                         FROM report_handler
    //                         WHERE reportID = '%s' 
    //                             AND picID = '%s'",
    //                 mysqli_real_escape_string($link, $reportID),
    //                 mysqli_real_escape_string($link, $_SESSION['picID']));

    //         $result = mysqli_query($link, $query);

    //         if(!$result) { 
    //             echo("Error description: " . mysqli_error($link));  
    //             //header("location: pic_report_task_accepted");
    //         }
    //         else
    //         {
    //             $row = mysqli_fetch_assoc($result);

    //             $total = count($_FILES['feedback_picture']['name']);
    //             //echo "Picture Number(s): " . $total;
    //             for($i = 0; $i < $total; $i++)
    //             {
    //                 $file_name = $_FILES['feedback_picture']['name'][$i];
    //                 $file_tmp_name = $_FILES['feedback_picture']['tmp_name'][$i];

    //                 $file_extension = explode('.', $file_name);
    //                 $file_extension = strtolower(end($file_extension));
    //                 $new_file_name = uniqid() . '.' . $file_extension;

    //                 move_uploaded_file($file_tmp_name, 'img/' . $new_file_name);

    //                 $query = sprintf("INSERT INTO report_feedbackpicture_list 
    //                         VALUES (null, '%s', '%s')",
    //                         mysqli_real_escape_string($link, $new_file_name),
    //                         mysqli_real_escape_string($link, $row['rhID']));

    //                 $result = mysqli_query($link, $query);
                    
    //                 if(!$result) { 
    //                     echo("Error description: " . mysqli_error($link));    
    //                     unlink('img/' . $new_file_name);
    //                     //header("location: pic_report_task_accepted");
    //                 }
    //             }

    //             $query = sprintf("UPDATE report_handler 
    //                     SET feedbackRemarks='%s', dateFeedback=now(), stages=2,
    //                     WHERE reportID='%s'
    //                     AND picID='%s'",
    //                     mysqli_real_escape_string($link, $_POST['feedback_remarks']),
    //                     mysqli_real_escape_string($link, $reportID),
    //                     mysqli_real_escape_string($link, $_SESSION['picID']),);

    //             $result = mysqli_query($link, $query);

    //             if(!$result) { 
    //                 echo("Error description: " . mysqli_error($link)); 
    //             }


    //             $_SESSION["reportid"] = 0;
                    
    //             echo 
    //             "<p>Feedback has successfuly submitted.</p>" . 
    //             "<p><a href='pic_report_task' />Back</a></p>"; 
    //         }  
    //     }
    // }
    // else
    // {
    //     $query = sprintf("SELECT report.*, report_handler.*, complaint.*
    //                     FROM report 
    //                     JOIN report_handler	
    //                         ON report.reportID = '%s' 
    //                         AND report_handler.picID = '%s' 
    //                         AND report_handler.reportID = report.reportID 
    //                     JOIN complaint 
    //                         ON complaint.reportID = report.reportID",
    //                     mysqli_real_escape_string($link, $reportID),
    //                     mysqli_real_escape_string($link, $_SESSION['picID']));
    //     $result = mysqli_query($link, $query);

    //     // echo "num rows: " . mysqli_affected_rows($result);

    //     if(!$result)
    //     {
    //         echo 
    //         "<p>Something wrong while processing.</p>" . 
    //         "<p>ERROR: " . mysqli_error($link) . "</p>" .
    //         "<p><a href='pic_main' />Back</a></p>"; 
    //     }
    //     else if(mysqli_num_rows($result) > 0)
    //     {
    //         $row = mysqli_fetch_assoc($result);

    //         echo "<div style='margin-top: 50px; margin-bottom: 20px; margin-right: 250px; margin-left: 250px; th { column-width: 20px; }'>";
    //         echo 
    //         "<table>" .
    //             "<tr>". 
    //                 "<th>Picture</th>". 
    //                 "<td>" . getImageList($row['reportID']) . "</td>" .
    //             "</tr>" .
    //             "<tr>" .
    //                     "<th>ID</th>" . 
    //                     "<td>" . $row['reportID'] . "</td>" .
    //                 "</tr>" .
    //                 "<tr>" . 
    //                     "<th>Remarks</th>" .
    //                     "<td>" . $row['remarks'] . "</td>" .
    //                 "</tr>" .
    //                 "<tr>" . 
    //                     "<th>Venue</th>" .
    //                     "<td>" . $row['venue'] . "</td>" .
    //                 "</tr>" .
    //                 "<tr>" . 
    //                     "<th>Complaint Date</th>" .
    //                     "<td>" . $row['dateComplaint'] . "</td>" .
    //                 "</tr>" .
    //         "</table>";
    //         echo "</div>";
    //     }

    //     echo "<div class='form_body'>";
    //     echo
    //     "<form action='' method='POST' enctype='multipart/form-data'>" .
    //         "<p><input type='file' name='feedback_picture[]' accept='image/*' value='Select Image' multiple/><br /></p>" .
    //         "<p><textarea name='feedback_remarks' rows='2' cols='50'></textarea><br /></p>" .
    //         "<p><input type='submit' name='submit' value='Submit' /><br /></p>" .
    //     "</form>";
    //     echo "</div>";
    // }
    // echo "</div>";

    function getImageList($reportID) 
    {
        include "connection.php";

        $query = "SELECT reportPicture FROM report_picture_list WHERE reportID = " . $reportID;
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
?>

<script>
    fetch_pic_notification_function(<?php echo $_SESSION["picID"] ?>);
    change_pic_read_status(<?php echo $_SESSION["picID"] ?>);
</script>