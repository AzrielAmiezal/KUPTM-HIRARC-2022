<?php
    include "connection.php";

    session_start();

    echo "<div class='main_body'>";

    

    if($_SESSION["picLogged"] == 1)
    {
        echo  
        "<ul>" .
            "<li><p><a href='pic_main' />Main</a></p></li>" . 
            "<li><p><a href='pic_report_task' />Task</a></p></li>" . 
            //"<li><p><a class='active' href='pic_report_task_accepted' />Accepted</a></p></li>" .
            "<li><p><a href='pic_report_solved' />Solved</a></p></li>" .
            "<li><p><a href='pic_logout' />Logout</a></p></li>" .
        "</ul>";
        
        $counter = 0;

        $query = sprintf("SELECT report_handler.*, report.* FROM report_handler JOIN report ON report_handler.picId = '%s' AND report_handler.stages=2 AND report_handler.reportId = report.reportId", 
                            mysqli_real_escape_string($link, $_SESSION['picID']));
        $result = mysqli_query($link, $query);

        //echo "PIC ID: " . $_SESSION['picId'] . "<br />" . "Affected Rows: " . mysqli_affected_rows($link);

        if(!$result) { 
            echo("Error description: " . mysqli_error($link));
        }
        else if(mysqli_num_rows($result) > 0)
        {
            echo
            "<table>" .
                "<tr>" . 
                    "<th>No.</th>" .
                    // "<th>Picture</th>" .
                    // "<th>Status</th>" .
                    // "<th>Category</th>" .
                    // "<th>Risk Category</th>" .
                    // "<th>Impact</th>" .
                    "<th>Remarks</th>" .
                    "<th>Date</th>" .
                    "<th>Action</th>" .
                "</tr>";
                
                while($row = mysqli_fetch_assoc($result))
                {
                    $counter++;

                    echo
                    "<tr>" .
                        "<td>" . $counter . "</td>" .
                        // "<td><img src='img/" . $row['reportPicture'] . "' alt='Report Picture' style='width:150px;height:150px;' /></td>" .
                        // //"<td><img src='data:image/*;base64, " . base64_encode($row['reportPicture']) . "' alt='Report Picture' style='width:150px;height:150px;' /></td>" .
                        // "<td>" . $row['status'] . "</td>" .
                        // "<td>" . $row['reportCategory'] . "</td>" .
                        // "<td>" . $row['reportRiskCategory'] . "</td>" .
                        // "<td>" . $row['reportImpact'] . "</td>" .
                        "<td>" . $row['reportRemarks'] . "</td>" .
                        "<td>" . $row['reportDate'] . "</td>" .
                        "<td>" . 
                            "<form action='pic_report_solving' method='POST'>" .
                                "<button type='submit' name='solving_reportid' value='" . $row['reportId'] . "'>Solve</button>" . 
                            "</form>" .
                            "<form action='pic_report_viewer' method='POST'>" .
                                "<p><button type='submit' name='view_reportid' value='" . $row['reportId'] . "'>View</button></p>" .
                            "</form>" .
                        "</td>" .
                    "</tr>"; 
                }
            echo "</table>"; 
        }
        else
        {
            echo
                "<table>" .
                    "<tr>" . 
                        "<th>No.</th>" .
                        // "<th>Picture</th>" .
                        // "<th>Status</th>" .
                        // "<th>Category</th>" .
                        // "<th>Risk Category</th>" .
                        // "<th>Impact</th>" .
                        "<th>Remarks</th>" .
                        "<th>Date</th>" .
                        "<th>Action</th>" .
                    "</tr>" . 
                    "<tr>" . 
                        "<td colspan='9'>No task is accepted.</td>" .
                    "</tr>" . 
                "</table>";
        }
    }
    else
    {
        header("Location: pic_login");
    }

    echo "</div>";

?>