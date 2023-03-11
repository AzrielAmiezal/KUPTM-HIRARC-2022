<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KUPTM HIRARC FORM</title>

    <!-- Bootstrap plugin -->
    <link href="applicant_template/css/bootstrap.min.css" rel="stylesheet">
    <script src="applicant_template/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="notification_script.js"></script>
</head>

<body class="bg-light">
<!-- <body class="bg-gradient-light"> -->

    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5 col-lg-8 mx-auto">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <img src="KUPTM logo.png" alt="logo" width="37%" draggable="false">
                            </div>
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4"><b>HAZARD IDENTIFICATION, RISK ASSESMENT AND RISK CONTROL (HIRARC)</b></h1>
                            </div>
                            <form action="" method="POST" enctype="multipart/form-data">

                                <label class="form-label"><b>Select User Role</b></label><label style="color: red; font-style: italic;">*</label>
                                <select class="form-select form-select-sm" name="complainantRole" required>
                                    <option value="" selected>--Select--</option>
                                    <option value="Staff">Staff</option>
                                    <option value="Student">Student</option>
                                </select>


                                <!-- <div class="form-group">
                                    <div class="form-check-inline"><label style="color: red;">*</label> <label><b>Role</b></label>*</div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="complainantRole" value="Staff" checked>
                                        <label class="form-check-label" for="complainantRole">
                                            Staff
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="complainantRole" value="Student">
                                        <label class="form-check-label" for="complainantRole">
                                            Student
                                        </label>
                                    </div>
                                </div> -->

                                <p>
                                <div class="form-group">
                                    <label for="complainantFullName" class="form-label"><b>Full Name</b></label><label style="color: red; font-style: italic;">*</label>
                                    <input class="form-control form-control-sm" type="text" name="complainantFullName" id="complainantFullName" placeholder="Write your full name here" autocomplete="off" required>
                                </div>
                                </p>

                                <p>
                                <div class="form-group">
                                    <label for="complainantFullName" class="form-label"><b>Staff / Student ID NO</b></label><label style="color: red; font-style: italic;">*</label>
                                    <input class="form-control form-control-sm" type="text" name="complainantNoID" id="complainantNoID" placeholder="Write your staff/student ID No here" autocomplete="off" required>
                                </div>
                                </p>

                                <p>
                                <div class="form-group">
                                    <label for="complainantFullName" class="form-label"><b>Email address</b></label><label style="color: red; font-style: italic;">*</label>
                                    <input class="form-control form-control-sm" type="email" name="complainantEmail" id="complainantEmail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Please enter a valid email address: yourname@domain.com" placeholder=" Write your email address here" autocomplete="off" required>
                                </div>
                                </p>

                                <div class="form-group">
                                    <div class="form-check-inline"><label><b>Please tick hazard type</b></label><label style="color: red; font-style: italic;">*</label> <label style="font-size: 14px; font-style: italic;">(at least one)</label></div>
                                    <p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="reportType[]" name="reportType[]" value="Electrical Hazard">
                                        <label class="form-check-label" for="reportType[]">
                                            Electrical Hazard
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="reportType[]" name="reportType[]" value="Mechanical Hazard">
                                        <label class="form-check-label" for="reportType[]">
                                            Mechanical Hazard
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="reportType[]" name="reportType[]" value="Chemical Hazard ">
                                        <label class="form-check-label" for="reportType[]">
                                            Chemical Hazard
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="reportType[]" name="reportType[]" value="Radiation Hazard">
                                        <label class="form-check-label" for="reportType[]">
                                            Radiation Hazard
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="reportType[]" name="reportType[]" value="Biology Hazard ">
                                        <label class="form-check-label" for="reportType[]">
                                            Biology Hazard
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="reportType[]" name="reportType[]" value="Physical Hazard ">
                                        <label class="form-check-label" for="reportType[]">
                                            Physical Hazard
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="reportType[]" name="reportType[]" value="Others" checked>
                                        <label class="form-check-label" for="reportType[]">
                                            Others/Not Sure
                                        </label>
                                    </div>
                                    </p>
                                </div>

                                <p>
                                <div class="form-floating">
                                    <textarea class="form-control" name="complainantRemarks" id="complainantRemarks" placeholder="Leave a comment here" style="height: 150px; resize: none;"></textarea>
                                    <label for="complainantRemarks">Comments <label style="font-size: 14px; font-style: italic;">(optional)</label></label>
                                </div>
                                <!-- <textarea class="form-control" placeholder="Give comment..." cols="50" rows="5" style="font-family: Arial, Helvetica, sans-serif; resize: none;"></textarea> -->
                                </p>

                                <p>
                                <div class="form-group">
                                    <label for="complainantFullName" class="form-label"><b>Venue</b></label><label style="color: red; font-style: italic;">*</label>
                                    <input type="text" class="form-control form-control-sm" name="venue" id="venue" placeholder="Enter Venue" autocomplete="off" required>
                                </div>
                                </p>

                                <div class="form-group">
                                    <div class="mb-3">
                                        <label for="reportPictureID[]" class="form-label"><b>Files Upload</b></label> <label style="font-size: 14px; font-style: italic;">(optional)</label>
                                        <input class="form-control form-control-sm" type="file" name="reportPictureID[]" id="reportPictureID" multiple>
                                    </div>
                                </div>

                                <br>
                                <div class="d-grid gap-2 col-6 mx-auto">
                                    <button type="submit" class="btn btn-dark btn-sm" name="submit" onclick="return confirm('Please check the details before submitting. Click OK to proceed! ')">Submit Report</button>
                                    <button type="reset" class="btn btn-light btn-sm" name="reset">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Footer -->
    <footer class="sticky-footer">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span style="font-family: 'Times New Roman', Times, serif; font-size: 16px;">Copyright &copy;2021 - <?= date('Y'); ?> <a href="http://www.kuptm.edu.my/">Kolej Universiti Poly-Tech MARA (KUPTM) Kuala Lumpur</a> <br /> All rights reserved.</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->
</body>

</html>

<?php

require 'applicant_functions.php';

// session_start();

//check whether the submit button is click or not
if (isset($_POST['submit'])) {

    //check whether data has been added or not
    if (addReport($_POST) > 0) 
    {
        // echo "<script>insert_all_admin_notification('New Submission', 'New report has been submitted.');</script>";
        echo 
        "<script>
            new_submission_notification('New Submission', '" . $_POST["complainantFullName"] . " has submitted a report.');
        </script>";

        echo "<script>
            alert('Your report has been submitted!');
            document.location.href = 'applicant_index.php';
            </script>";
    } else {
        echo "<script>
            alert('Failed to submit hazard report!');
            document.location.href = 'applicant_index.php';
            </script>";
    }
}
//echo "<button onClick=\"insert_notification('New Submission', 'New report has been submitted');\">INSERT NOTIFICATION TEST</button>";

?>