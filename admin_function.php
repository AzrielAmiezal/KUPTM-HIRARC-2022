
<?php

// connect to database
$conn = mysqli_connect("localhost", "root", "", "hazard");

session_start();


// ===========================QUERY==============================
function query($q)
{
	global $conn;
	$result = mysqli_query($conn, $q);
	$rows = [];
	if (!$result) {
		echo mysqli_error($conn);
	}
	while ($r = mysqli_fetch_assoc($result)) {
		$rows[] = $r;
	}
	return $rows;
}

// =========================================REPORT========================================================

// ===========================ADD==============================
// function add($data)
// {
// 	global $conn;

// 	$reportID = $data["reportID"];
// 	$ReportType = $data["ReportType"];
// 	$Haza = $data["reportDate"];
// 	$reportRemarks = $data["reportRemarks"];
// 	$department = $data["department"];
// 	$rc = $data["rc"];
// 	$rrc = $data["rrc"];
// 	$ri = $data["ri"];
// 	$rmr = $data["rmr"];

// 	$query = sprintf(
// 		"INSERT INTO report_handler VALUES (null, 1, '', '', now(), %s, %s, %s)",
// 		mysqli_real_escape_string($conn, $_SESSION["adminID"]),
// 		mysqli_real_escape_string($conn, $picIDSelection),
// 		mysqli_real_escape_string($conn, $reportID)
// 	);

// 	mysqli_query($conn, $query);



// 	$reportId = $data["reportId"];


// 	$query = "INSERT INTO report VALUES (null, '$reportType')";
// 	$query = "INSERT INTO complaint VALUES (0, null, '$reportRemarks', 'none', '$reportDate'";
// 	"'$reportPicture', '$rc', '$rrc', '$ri', '$rmr')";
// 	mysqli_query($conn, $query);

// 	// $query = "UPDATE admin_report SET picDepartment =".$department.",adminId =".$_SESSION['adminId'].",status = 1 WHERE reportId =".$reportId;
// 	// mysqli_query($conn, $query); 

// 	return mysqli_affected_rows($conn);
// }

// ===========================UPLOAD==============================
// function upload()
// {
// 	$nameFile = $_FILES['reportPicture']['name'];
// 	$sizeFile = $_FILES['reportPicture']['size'];
// 	$error = $_FILES['reportPicture']['error'];
// 	$tmpName = $_FILES['reportPicture']['tmp_name'];


// 	//check if the picture is upload
// 	if ($error === 4) {
// 		echo "<script>
// 				alert('please upload the picture');
// 			</script>";
// 			return false;
// 	}

// 	//check if the file is picture or not
// 	$ExtentionValidPic = ['jpg', 'jpeg', 'png'];
// 	$ExtentionPic = explode('.', $nameFile);
// 	$ExtentionPic = strtolower(end($ExtentionPic));

// 	if (!in_array($ExtentionPic, $ExtentionValidPic)) {
// 		echo "<script>
// 				alert('the file you upload is not a picture');
// 			</script>";
// 			return false;
// 	}
// }

// ===========================REGISTER==============================
function register($data)
{
	global $conn;

	$AdminIDNo = htmlspecialchars(mysqli_real_escape_string($conn, $data["adminIDNo"]));
	$AdminFullname = htmlspecialchars(strtoupper(stripslashes($data["adminFullname"])));
	$AdminPassword = mysqli_real_escape_string($conn, $data["adminPassword"]);
	$AdminPassword2 = mysqli_real_escape_string($conn, $data["adminPassword2"]);
	$AdminEmail = htmlspecialchars(mysqli_real_escape_string($conn, $data["adminEmail"]));

	//check if admin id no is already exist
	$result = mysqli_query($conn, "SELECT adminIDNo FROM admin WHERE adminIDNo = '$AdminIDNo'");

	if (mysqli_fetch_assoc($result)) {
		echo "<script>
				alert('This Admin ID No is already exist!');
				</script>";
		return false;
	}

	 //if admin id no, full name, password/password2, email is empty
    if (empty($AdminIDNo) || empty($AdminFullname) || empty($AdminPassword) || empty($AdminPassword2) || empty($AdminEmail)) {

        echo "<script>
                alert('Please fill in the form before register!');
            </script>";
        return false;
    }

	// check confirmation password
	if ($AdminPassword !== $AdminPassword2) {
		echo "<script>
				alert('the confirmation password is not match!');
				</script>";
		return false;
	}

	//encrypt password
	$AdminPassword = password_hash($AdminPassword, PASSWORD_DEFAULT);

	//add new user
	mysqli_query($conn, "INSERT INTO admin VALUES('', '$AdminIDNo','$AdminFullname', '$AdminPassword', '$AdminEmail')");

	return mysqli_affected_rows($conn);
}


// ===========================EDIT==============================
function edit($data)
{
	global $conn;

	$mitigation_id = $data["mitigationID"];
	$reportId = $data["reportID"];
	$reportType = $data["reportType"];
	$hazardActivity = $data["hazardActivity"];
	$hazard = $data["hazard"];
	$hazardImpact = $data["hazardImpact"];
	$existingControl = $data["existingControl"];
	$probability = $data["probability"];
	$impact = $data["impact"];
	$risklevel = $data["riskLevel"];
	$mitigationPlan = $data["mitigationPlan"];
	$dateSolved = $data["dateSolved"];
	$status = $data["status"];
	$picID = $data["picID"];

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
                risk_control.dateSolved = '$dateSolved',
                risk_control.status = '$status',
                report_handler.picID = '$picID'
            WHERE report.reportID = '$reportId'
       			AND hazard.reportID = '$reportId'
       			AND risk_analysis.reportID = '$reportId'
       			AND risk_control.reportID = '$reportId'";
	// -- AND risk_analysis.RAID = '$rarc'
	// -- AND risk_control.RCID = '$rarc'";

	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

	if (!$result) {
		echo mysqli_error($conn);
	}

	return mysqli_affected_rows($conn);
}


function edit_dept($data)
{
	global $conn;

	$department_id = $data["departmentID"];
	$department_name = $data["departmentName"];
	

	$query = "UPDATE department
    			SET
                department.departmentName = '$departmentName',
            WHERE department.departmentID = '$departmentID'";
	// -- AND risk_analysis.RAID = '$rarc'
	// -- AND risk_control.RCID = '$rarc'";

	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

	if (!$result) {
		echo mysqli_error($conn);
	}

	return mysqli_affected_rows($conn);
}


// ===========================DELETE==============================
function delete($id, $mit_id)
{
	global $conn;

	//delete picture in folder img
	// $pic = query("SELECT * FROM report WHERE reportId = $id");
	// echo $pic["reportPicture"];
	// if ($pic["reportPicture"] != 'default.png') {
	//     unlink('img/' . $pic["reportPicture"]);
	// }

	mysqli_query($conn, "DELETE
                            hazard,
                            risk_analysis,
                            risk_control
                        FROM
                            hazard, risk_analysis, risk_control
                        WHERE hazard.reportID = '$id' 
                            AND hazard.mitigationID = '$mit_id'
                            AND risk_analysis.reportID = hazard.reportID 
                            AND risk_analysis.mitigationID = hazard.mitigationID
                            AND risk_control.reportID = hazard.reportID 
                            AND risk_control.mitigationID = hazard.mitigationID");

	return mysqli_affected_rows($conn);
}


function delete_dept($id)
{
	global $conn;

	//delete picture in folder img
	// $pic = query("SELECT * FROM report WHERE reportId = $id");
	// echo $pic["reportPicture"];
	// if ($pic["reportPicture"] != 'default.png') {
	//     unlink('img/' . $pic["reportPicture"]);
	// }

	mysqli_query($conn, "DELETE
                            department
                        FROM
                            department
                        WHERE department.departmentID = '$id'");

	return mysqli_affected_rows($conn);
}

// function addMitigation($data)
// {
// 	global $conn;

// 	$reportId = $data["reportID"];
// 	$existingControl = $data["existingControl"];
//     $probability = $data["probability"];
//     $impact = $data["impact"];
//     $risklevel = $data["riskLevel"];
//     $mitigationPlan = $data["mitigationPlan"];
//     $dateSolved = $data["dateSolved"];
//     $status = $data["status"];
//     $picID = $data["picID"];

//     $convdt = strtotime($dateSolved);

//     $query = "SELECT risk_analysis.*, risk_control.*
//     		FROM risk_analysis 
// 			JOIN risk_control
// 				ON risk_control.reportID = '$reportId'
// 				AND risk_analysis.reportID = '$reportId'";

// 	$result = mysqli_query($conn, $query);

// 	if(!$result) { echo "Error: " . mysqli_error($conn); }
// 	else
// 	{
// 		$data = mysqli_fetch_assoc($result);
// 		echo mysqli_num_rows($result);
// 		//echo "Count: " . count($data);
// 		if(mysqli_num_rows($result) > 4) { echo "<script>alert('You can't add more than 4 mitigation.');</script>"; }
// 		else 
// 		{
// 			$query_ra = "INSERT INTO risk_analysis VALUES ('', '$reportId', '$existingControl', '$probability', '$impact', '$risklevel', '0')";
// 			$query_rc = "INSERT INTO risk_control VALUES ('', '$reportId', '$mitigationPlan', '$convdt', '$status', '$picID')";
// 			$result_ra = mysqli_query($conn, $query_ra);
// 			$result_rc = mysqli_query($conn, $query_rc);

// 			//echo "RA: " . mysqli_num_rows($result_ra);
// 			//echo "RC: " . mysqli_num_rows($result_rc);
// 			if(!($result_ra && $result_rc)) { echo "Error: " . mysqli_error($conn); }
// 		}
// 	}
// }


// =========================================END REPORT========================================================

function getReportPictureList($reportID)
{
	//include "connection.php";
	global $conn;

	$query = sprintf(
		"SELECT reportPicture FROM report_picture_list WHERE reportID = %s",
		mysqli_real_escape_string($conn, $reportID)
	);
	$resultPicture = mysqli_query($conn, $query);

	if (!$resultPicture) {
		return "<td>Error displaying picture: " . mysqli_error($conn) . "</td>";
	} else {
		if (mysqli_num_rows($resultPicture) > 0) {
			$pictureList = null;
			while (($img = mysqli_fetch_assoc($resultPicture))) {
				$pictureList .= "<a href='images/" . $img['reportPicture'] . "' target='_blank'><img src='images/" . $img['reportPicture'] . "' alt='Report Picture' style='width:100px;height:100px;'/></a>";
			}
			return $pictureList;
		} else {
			return "<p></p>No picture to display.</p>";
		}
	}
}

function getInvestigatePictureList($reportID)
{
	//include "connection.php";
	global $conn;

	$query = sprintf(
		"SELECT investigatePicture FROM investigate_picture_list WHERE reportID = %s",
		mysqli_real_escape_string($conn, $reportID)
	);
	$resultPicture = mysqli_query($conn, $query);

	if (!$resultPicture) {
		return "<td>Error displaying picture: " . mysqli_error($conn) . "</td>";
	} else {
		if (mysqli_num_rows($resultPicture) > 0) {
			$pictureList = null;
			while (($img = mysqli_fetch_assoc($resultPicture))) {
				$pictureList .= "<a href='images/" . $img['investigatePicture'] . "' target='_blank'><img src='images/" . $img['investigatePicture'] . "' alt='Report Picture' style='width:100px;height:100px;'/></a>";
			}
			return $pictureList;
		} else {
			return "<p></p>No picture to display.</p>";
		}
	}
}

function getFeedbackPictureList($reportID)
{
	//include "connection.php";
	global $conn;

	$query = sprintf(
		"SELECT feedbackPicture FROM report_feedbackpicture_list WHERE reportID = %s",
		mysqli_real_escape_string($conn, $reportID)
	);
	$resultPicture = mysqli_query($conn, $query);

	if (!$resultPicture) {
		return "<td>Error displaying picture: " . mysqli_error($conn) . "</td>";
	} else {
		if (mysqli_num_rows($resultPicture) > 0) {
			$pictureList = null;
			while (($img = mysqli_fetch_assoc($resultPicture))) {
				$pictureList .= "<a href='images/" . $img['feedbackPicture'] . "' target='_blank'><img src='images/" . $img['feedbackPicture'] . "' alt='Report Picture' style='width:100px;height:100px;'/></a>";
			}
			return $pictureList;
		} else {
			return "<p></p>No picture to display.</p>";
		}
	}
}

// function alertModal($title, $body)
// {
//     return '<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' .
//         '<div class="modal-dialog" role="document">' .
//             '<div class="modal-content">' .
//                 '<div class="modal-header">' .
//                 '<h5 class="modal-title" id="exampleModalLabel">' . $title . '</h5>' .
//                 '<button class="close" type="button" data-dismiss="modal" aria-label="Close">' .
//                     '<span aria-hidden="true">×</span>' .
//                 '</button>' .
//                 '</div>' .
//                 '<div class="modal-body">' . $body . '</div>' .
//                 '<div class="modal-footer">' .
//                     '<button class="btn btn-primary" type="button" data-dismiss="modal">Ok</button>' .
//                 '</div>' .
//             '</div>' .
//         '</div>' .
//     '</div>';
// }

if(isset($_POST["process"]) == "pic_department")
{
    $query = sprintf("SELECT * FROM pic WHERE departmentID = '%s'", mysqli_real_escape_string($conn, $_POST["department"]));
    $result = mysqli_query($conn, $query);

    if(!$result) { echo json_encode(array('success'=>0, 'error'=>mysqli_error($conn))); }
    else 
    {
        $picList = '<option value="-1">Select PIC</option>';
        while(($row = mysqli_fetch_assoc($result)))
        {

            $picList .= "<option value='" . $row["picID"] ."'>" . $row["picFullname"] . "</option>";
        }
        echo json_encode(array('success'=>1, 'picList'=>$picList)); 
    }
}



// if(isset($_POST["process"]) == "pic_department_existed")
// {
//     $query = sprintf("SELECT pic.picDepartment FROM pic
//     JOIN report_handler
//         ON report_handler.picID = pic.picID
//         AND report_handler.reportID = '%s'", mysqli_real_escape_string($conn, $_POST["reportid"]));
//     $result = mysqli_query($conn, $query);
//     $row = mysqli_fetch_assoc($result);

//     if(!$result) { echo json_encode(array('success'=>0, 'error'=>mysqli_error($conn))); }
//     else 
//     {
//         $existedDepartmentList = '<option value="-1">Select Department</option>';
//         if($row["picDepartment"] == "Department_Academic") { $existedDepartmentList = '<option value="Department_Academic" selected>Acadamic Department</option>'; }
//         if($row["picDepartment"] == "Department_Admin") { $existedDepartmentList = '<option value="Department_Academic">Acadamic Department</option>'; }
//                                                     <option value="Department_Admin">Admin Department</option>
//                                                     <option value="Department_IT">IT Department</option>
//         $picList = 
//         while(())
//         {

//             $picList .= "<option value='" . $row["picID"] ."'>" . $row["picFullname"] . "</option>";
//         }
//         echo json_encode(array('success'=>1, 'picList'=>$picList)); 
//     }
// }