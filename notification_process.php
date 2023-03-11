<?php
    require "connection.php";


    //echo "Process: " . $_POST["process"];

    /*
    * New submission process
    */

    if($_POST["process"] == "new_submission")
    {
        $query = "SELECT * FROM admin";
        $result = mysqli_query($link, $query);
        
        if(!$result) { echo json_encode(array('success'=>0, 'error'=>mysqli_error($link))); }
        else 
        {
            while(($row = mysqli_fetch_assoc($result)))
            {
                $query2 = sprintf("INSERT INTO notification
                    VALUES (null, '%s', '%s', 0, 0, '%s', -1)",
                    mysqli_real_escape_string($link, $_POST["notSubject"]),
                    mysqli_real_escape_string($link, $_POST["notText"]), 
                    mysqli_real_escape_string($link, $row["adminID"]));

                $result2 = mysqli_query($link, $query2);

                if(!$result2) { echo json_encode(array('success'=>0, 'error'=>mysqli_error($link))); }
            }
            echo json_encode(array('success'=>1)); 
        }
    }
    /*
    * Managed & solved process
    */
    else if($_POST["process"] == "managed_solved")
    {
        $query = "SELECT * FROM admin";
        $result = mysqli_query($link, $query);
        
        if(!$result) { echo json_encode(array('success'=>0, 'error'=>mysqli_error($link))); }
        else 
        {
            while(($row = mysqli_fetch_assoc($result)))
            {
                if($row["adminID"] != $_POST["adminID"])
                {
                    $query2 = sprintf("INSERT INTO notification
                        VALUES (null, '%s', '%s', 0, 0, '%s', -1)",
                        mysqli_real_escape_string($link, $_POST["notSubjectAdm"]),
                        mysqli_real_escape_string($link, $_POST["notTextAdm"]),
                        mysqli_real_escape_string($link, $row["adminID"]));

                    $result2 = mysqli_query($link, $query2);

                    if(!$result2) { echo json_encode(array('success'=>0, 'error'=>mysqli_error($link))); }
                }

                //echo "adminID: " . $row["adminID"] . " post adminId: " . $_POST["adminID"];
            }

            $query3 = sprintf("INSERT INTO notification
                VALUES (null, '%s', '%s', 0, 0, -1, '%s')",
                mysqli_real_escape_string($link, $_POST["notSubjectPIC"]),
                mysqli_real_escape_string($link, $_POST["notTextPIC"]), 
                mysqli_real_escape_string($link, $_POST["picID"]));

            $result3 = mysqli_query($link, $query3);

            //echo "picID: " . $_POST["picID"];

            if(!$result3) { echo json_encode(array('success'=>0, 'error'=>mysqli_error($link))); }
            else { echo json_encode(array('success'=>1)); } 
        }
    }
    /*
    * feedback given process
    */
    else if($_POST["process"] == "feedback_given")
    {
        $query = "SELECT * FROM admin";
        $result = mysqli_query($link, $query);
        
        if(!$result) { echo json_encode(array('success'=>0, 'error'=>mysqli_error($link))); }
        else 
        {
            while(($row = mysqli_fetch_assoc($result)))
            {
                $query2 = sprintf("INSERT INTO notification
                    VALUES (null, '%s', '%s', 0, 0, '%s', -1)",
                    mysqli_real_escape_string($link, $_POST["notSubjectAdm"]),
                    mysqli_real_escape_string($link, $_POST["notTextAdm"]),
                    mysqli_real_escape_string($link, $row["adminID"]));

                $result2 = mysqli_query($link, $query2);

                if(!$result2) { echo json_encode(array('success'=>0, 'error'=>mysqli_error($link))); }
            }

            echo json_encode(array('success'=>1)); 
        }
    }
    /*
    * Insert notification message on certain admin process
    */
    else if($_POST["process"] == "insert_admin")
    {
        $query = sprintf("INSERT INTO notification
            VALUES (null, '%s', '%s', 0, 0, '%s', -1)",
            mysqli_real_escape_string($link, $_POST["notSubject"]),
            mysqli_real_escape_string($link, $_POST["notText"]), 
            mysqli_real_escape_string($link, $_POST["adminID"]));

        $result = mysqli_query($link, $query);

        if(!$result) { echo json_encode(array('success'=>0, 'error'=>mysqli_error($link))); }
        else 
        { 
            echo json_encode(array('success'=>1)); 
        }
    }
    /*
    * Insert notification message on certain pic process
    */
    else if($_POST["process"] == "insert_pic")
    {
        $query = sprintf("INSERT INTO notification
            VALUES (null, '%s', '%s', 0, 0, -1, '%s')",
            mysqli_real_escape_string($link, $_POST["notSubject"]),
            mysqli_real_escape_string($link, $_POST["notText"]),
            mysqli_real_escape_string($link, $_POST["picID"]));

        $result = mysqli_query($link, $query);

        if(!$result) { echo json_encode(array('success'=>0, 'error'=>mysqli_error($link))); }
        else 
        { 
            echo json_encode(array('success'=>1)); 
        }
    }
    /*
    * Fetch admin notification message based on adminid
    */
    else if($_POST["process"] == "fetch_admin_notification")
    {
        $notification = '';
        $not_read_counter = 0;

        // $query = sprintf("SELECT * FROM notification WHERE adminID='%s'", 
        //         mysqli_real_escape_string($link, $_POST["adminID"]));

        // $result = mysqli_query($link, $query);

        // if(!$result) { echo json_encode(array('success'=>0, 'error'=>mysqli_error($link))); }
        // else 
        // { 
        //     while(($row = mysqli_fetch_assoc($result)))
        //     {
        //         if($row["admReadStatus"] == 0) { $not_read_counter++; } 
        //     }
        // }

        $query = sprintf("SELECT * FROM notification WHERE adminID='%s' ORDER BY notificationID DESC LIMIT 3", 
                mysqli_real_escape_string($link, $_POST["adminID"]));

        $result = mysqli_query($link, $query);

        if(!$result) { echo json_encode(array('success'=>0, 'error'=>mysqli_error($link))); }
        else 
        { 
            while(($row = mysqli_fetch_assoc($result)))
            {
                if($row["admReadStatus"] == 0) 
                {
                    $not_read_counter++;

                    $notification .= 
                    '<a class="dropdown-item d-flex align-items-center">
                        <div class="mr-3">
                            <div class="icon-circle bg-primary">\
                                <i class="fas fa-file-alt text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">' . $row["notSubject"] . '</div>
                            <!-- notText -->
                            <span class="font-weight-bold">' . $row["notText"] . '</span>
                        </div>
                    </a>';
                }
            }

            $output = array('success'=>1, 'content'=>$notification, 'not_read_counter'=>$not_read_counter); 
            echo json_encode($output);
            
            http_response_code(200);
        }
    }

    else if($_POST["process"] == "fetch_full_admin_notification")
    {
        $notification = '';
        $not_read_counter = 0;

        $query = sprintf("SELECT * FROM notification WHERE adminID='%s'", 
                mysqli_real_escape_string($link, $_POST["adminID"]));

        $result = mysqli_query($link, $query);

        if(!$result) { echo json_encode(array('success'=>0, 'error'=>mysqli_error($link))); }
        else 
        { 
            while(($row = mysqli_fetch_assoc($result)))
            {
                
                $notification .= 
                '<tr>
                    <td>' . $row["notSubject"] . '</td>
                    <td>' . $row["notText"] . '</td>
                </tr>';
            }

            $output = array('success'=>1, 'content'=>$notification); 
            echo json_encode($output);
            
            http_response_code(200);
        }
    }

    else if($_POST["process"] == "change_admin_read_status")
    {
        $query = sprintf("UPDATE notification SET admReadStatus=1 WHERE adminID='%s'", 
                mysqli_real_escape_string($link, $_POST["adminID"]));

        $result = mysqli_query($link, $query);

        if(!$result) { echo json_encode(array('success'=>0, 'error'=>mysqli_error($link))); }
        else 
        { 
            $output = array('success'=>1); 
            echo json_encode($output);
            
            http_response_code(200);
        }
    }
    /*
    * Fetch pic notification message based on pic
    */
    else if($_POST["process"] == "fetch_pic_notification")
    {
        $notification = '';
        $not_read_counter = 0;

        // $query = sprintf("SELECT * FROM notification WHERE picID='%s'", 
        //         mysqli_real_escape_string($link, $_POST["picID"]));

        // $result = mysqli_query($link, $query);

        // if(!$result) { echo json_encode(array('success'=>0, 'error'=>mysqli_error($link))); }
        // else 
        // { 
        //     while(($row = mysqli_fetch_assoc($result)))
        //     {
        //         if($row["admReadStatus"] == 0) { $not_read_counter++; } 
        //     }
        // }

        $query = sprintf("SELECT * FROM notification WHERE picID='%s' ORDER BY notificationID DESC LIMIT 3", 
                mysqli_real_escape_string($link, $_POST["picID"]));

        $result = mysqli_query($link, $query);

        if(!$result) { echo json_encode(array('success'=>0, 'error'=>mysqli_error($link))); }
        else 
        { 
            while(($row = mysqli_fetch_assoc($result)))
            {
                if($row["picReadStatus"] == 0) 
                {   
                    $not_read_counter++;

                    $notification .= 
                    '<a class="dropdown-item d-flex align-items-center">
                        <div class="mr-3">
                            <div class="icon-circle bg-primary">\
                                <i class="fas fa-file-alt text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">' . $row["notSubject"] . '</div>
                            <!-- notText -->
                            <span class="font-weight-bold">' . $row["notText"] . '</span>
                        </div>
                    </a>';
                }
            }

            $output = array('success'=>1, 'content'=>$notification, 'not_read_counter'=>$not_read_counter); 
            echo json_encode($output);
            
            http_response_code(200);
        }
    }
    else if($_POST["process"] == "fetch_full_pic_notification")
    {
        $notification = '';
        $not_read_counter = 0;

        $query = sprintf("SELECT * FROM notification WHERE picID='%s'", 
                mysqli_real_escape_string($link, $_POST["picID"]));

        $result = mysqli_query($link, $query);

        if(!$result) { echo json_encode(array('success'=>0, 'error'=>mysqli_error($link))); }
        else 
        { 
            while(($row = mysqli_fetch_assoc($result)))
            {
                
                $notification .= 
                '<tr>
                    <td>' . $row["notSubject"] . '</td>
                    <td>' . $row["notText"] . '</td>
                </tr>';
            }

            $output = array('success'=>1, 'content'=>$notification); 
            echo json_encode($output);
            
            http_response_code(200);
        }
    }
    else if($_POST["process"] == "change_pic_read_status")
    {
        $query = sprintf("UPDATE notification SET picReadStatus=1 WHERE picID='%s'", 
                mysqli_real_escape_string($link, $_POST["picID"]));

        $result = mysqli_query($link, $query);

        if(!$result) { echo json_encode(array('success'=>0, 'error'=>mysqli_error($link))); }
        else 
        { 
            $output = array('success'=>1); 
            echo json_encode($output);
            
            http_response_code(200);
        }
    }
?>