<?php

require "email_notify.php";
//database connection
$conn = mysqli_connect('localhost', 'root', '', 'hazard');

function query($query)
{
    global $conn;

    $result = mysqli_query($conn, $query);

    //if the result only have 1 data
    // if (mysqli_num_rows($result) == 1) {
    //     return mysqli_fetch_assoc($result);
    // }

    if (!$result) {
        echo "ERROR: " . mysqli_error($conn);
    }

    //if the results have many data
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function upload(int $latest_id)
{
    global $conn;
    $total = count($_FILES['reportPictureID']['name']);
    //echo "Total: " . $total;
    if ($_FILES['reportPictureID']['size'][0] != 0) {

        //echo "File name: " . $_FILES['reportPictureID']['name'][0];
        //$img = '';
        for ($i = 0; $i < $total; $i++) {
            //foreach (($_FILES['reportPictureID']['tmp_name']) as $key => $value) {

            $file_name = $_FILES['reportPictureID']['name'][$i];
            $file_type = $_FILES['reportPictureID']['type'][$i];
            $file_size = $_FILES['reportPictureID']['size'][$i];
            //$file_error = $_FILES['reportPictureID']['error'][$i];
            $file_tmp_name = $_FILES['reportPictureID']['tmp_name'][$i];



            //when no picture upload
            // if ($total == 0) {
            //     // echo "<script>
            //     //     alert('Please upload a picture!');
            //     // </script>";
            //     //$new_file_name = 'default.jpg';
            //     $_FILES['reportPictureID'] = $_POST['reportPictureDefault'];
            // }

            //check file extension
            $upload_extension = ['jpg', 'jpeg', 'png'];
            $file_extension = explode('.', $file_name);
            $file_extension = strtolower(end($file_extension));

            //check file uploaded whether the file is not jpg/png format
            if (!in_array($file_extension, $upload_extension)) {
                echo "<script>
                alert('Uploaded file is not a valid image. Only JPG,JPEG and PNG files are allowed!');
            </script>";

                $query = "DELETE FROM complainant
                    WHERE complainantID = $latest_id";
                mysqli_query($conn, $query);

                return false;
            }

            //check file type
            if ($file_type != 'image/jpeg' && $file_type != 'image/png') {
                echo "<script>
                alert('Uploaded file is not a valid image. Only JPG,JPEG and PNG files are allowed!');
            </script>";
                return false;
            }

            //check file size
            //maximum 2MB == 2000000
            if ($file_size > 2000000) {
                echo "<script>
                alert('File too large. Your file must be less than 2MB!');
                </script>";
                return false;
            }

            $directory = 'images/';

            //generate new file name.
            $new_file_name = uniqid() . '.' . $file_extension;
            move_uploaded_file($file_tmp_name, $directory . $new_file_name);

            //$latest_id =  mysqli_insert_id($conn);
            $query = "INSERT INTO report_picture_list
                    VALUES 
                    (null,'$new_file_name',$latest_id)
                ";

            mysqli_query($conn, $query) or die(mysqli_error($conn));
            //return $new_file_name;
        }
    } else {
        //$latest_id =  mysqli_insert_id($conn);
        $query = "INSERT INTO report_picture_list
                VALUES 
                (null,'default.jpg',$latest_id)
            ";
        mysqli_query($conn, $query) or die(mysqli_error($conn));
    }

    return mysqli_affected_rows($conn);
}

function addReport($data)
{
    global $conn;

    $complainantRole = htmlspecialchars($data['complainantRole']);
    $complainantFullName = htmlspecialchars($data['complainantFullName']);
    $complainantNoID = htmlspecialchars($data['complainantNoID']);
    $complainantEmail = htmlspecialchars($data['complainantEmail']);

    if (empty($data['reportType'])) {

        echo "<script>
                alert('Please tick at least one hazard type!');
                document.location.href = 'applicant_index.php';
            </script>";

        return false;
    } else {
        $typeofhazard = $data['reportType'];

        //count checkbox value using for loop
        $totalCount = count($typeofhazard);
        $chk = "";
        for ($i = 0; $i < $totalCount; $i++) {

            if ($i == ($totalCount - 1)) {

                $chk .= $typeofhazard[$i] . ".";
            } else {

                $chk .= $typeofhazard[$i] . ", ";
            }
        }
    }




    //using foreach
    // $chk = "";
    // foreach ($typeofhazard as $chk1) {
    //     $chk .= $chk1 . ",";
    // }

    $remarks = htmlspecialchars($data['complainantRemarks']);
    $venue = htmlspecialchars($data['venue']);

    //if name, no id, email, venue is empty
    if (empty($complainantFullName) || empty($complainantNoID) || empty($complainantEmail) || empty($venue)) {

        echo "<script>
                alert('Please fill in the form before submitting!');
                document.location.href = 'applicant_index.php';
            </script>";

        return false;
    }

    //check whether checkbox is tick or not
    if (empty($typeofhazard)) {

        echo "<script>
                alert('Please tick at least one hazard type!');
                document.location.href = 'applicant_index.php';
            </script>";

        return false;
    }


    if (!filter_var($complainantEmail, FILTER_VALIDATE_EMAIL)) {

        echo "<script>
                alert('Please enter a valid email address!');
                document.location.href = 'applicant_index.php';
            </script>";

        return false;
    }

    $query = "INSERT INTO complainant (complainantID, complainantRole, complainantIDNo, complainantFullName, complainantEmail)
                VALUES 
                (null, '$complainantRole', '$complainantNoID', '$complainantFullName', '$complainantEmail')
            ";
    // $query = "INSERT INTO complainant (complainantID, complainantIDNo, complainantFullName, complainantEmail)
    //             VALUES 
    //             (null,'$complainantNoID', '$complainantFullName', '$complainantEmail')
    //         ";

    mysqli_query($conn, $query) or die(mysqli_error($conn));

    $latest_id =  mysqli_insert_id($conn);

    //upload pictures
    $picture = upload($latest_id);
    if (!$picture) {
        return false;
    }

    $query = "INSERT INTO complaint (complainantID, reportID, remarks, venue, dateComplaint)
                VALUES 
                ($latest_id, $latest_id, '$remarks','$venue',NOW())
            ";

    mysqli_query($conn, $query) or die(mysqli_error($conn));

    $query = "INSERT INTO report
            VALUES
            ($latest_id, '$chk')
            ";

    mysqli_query($conn, $query) or die(mysqli_error($conn));

    $query = "INSERT INTO hazard (hazardID, reportID)
        VALUES
        (null, $latest_id)
    ";

    mysqli_query($conn, $query) or die(mysqli_error($conn));

    $query = "INSERT INTO risk_analysis (RAID, reportID)
        VALUES
        (null, $latest_id)
    ";

    mysqli_query($conn, $query) or die(mysqli_error($conn));

    $query = "INSERT INTO risk_control (RCID, reportID)
        VALUES
        (null, $latest_id)
    ";

    mysqli_query($conn, $query) or die(mysqli_error($conn));

    
    $query = "INSERT INTO report_handler 
        VALUES
        (null, '', '', '', '', '-1', '-1', $latest_id)
    ";

    mysqli_query($conn, $query) or die(mysqli_error($conn));

    $query = "SELECT * FROM pic WHERE picID = -1";
    $result = mysqli_query($conn, $query) or die(mysqli_erro($conn));
    if(mysqli_num_rows($result) < 1)
    {
        
        $query = "INSERT INTO pic
        VALUES
        ('-1', 'None', 'None', 'None', 'None', 'None', 'None', 'None')";

        mysqli_query($conn, $query) or die(mysqli_error($conn));
    }

    $query = "SELECT * FROM admin WHERE adminID = -1";
    $result = mysqli_query($conn, $query) or die(mysqli_erro($conn));
    if(mysqli_num_rows($result) < 1)
    {
        
        $query = "INSERT INTO admin
        VALUES
        ('-1', 'None', 'None', 'None', 'None')";

        mysqli_query($conn, $query) or die(mysqli_error($conn));
    }

    // send_email($complainantEmail, 
    //         "HIRARC REPORT SUBMISSION", 
    //         "Hello, " . $complainantFullName . ".<br /> 
    //         Thank you for your report submission. <br /><br />
    //         Your report has been escalated to the proper department for further review. <br />
    //         Please note, report are addressed in the order they are received. We appreciated your concerns.");

    // $query = "SELECT adminFullname, adminEmail FROM admin";
    // $result = mysqli_query($conn, $query);

    // if(!$result) { echo overlay(css_small_card("danger", "ERROR", "ERROR: " . mysqli_error($conn) , "fas fa-exclamation-circle")); }
    // else
    // {
    //     if(mysqli_num_rows($result) > 0)
    //     {
    //         while($row = mysqli_fetch_assoc($result))
    //         {
    //             send_email($row["adminEmail"], 
    //                 "HIRARC REPORT SUBMISSION", 
    //                 "Hello, " . $row["adminFullname"] . ".<br /> 
    //                 You have a new report to manage. <br /><br />
    //                 Logon to administrator page for further information.");
    //         }
    //     }
    // }

    return mysqli_affected_rows($conn);
}
