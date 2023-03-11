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
                            echo '<div class="container-fluid">' .
                                '<div class="card shadow mb-4">' .
                                    '<div class="card-header py-3">' .
                                        '<h6 class="m-0 font-weight-bold text-primary">PIC Notification List</h6>' .
                                    '</div>' .
                                    '<div class="card-body">' .
                                        '<div class="table-responsive">' .
                                            '<table class="table table-bordered" id="dataTable" cellspacing="0">' .
                                                '<thead width="25%">' .
                                                   '<tr>' .
                                                        '<th><b>Subject</b></th>' .
                                                        '<th>Message</th>' .
                                                    '</tr>' .
                                                '</thead width="75%">' .
                                                '<tbody id="pic_subject_and_message"></tbody>' .
                                            '</table>' .
                                        '</div>' .
                                    '</div>' .
                                '</div>';
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
    fetch_pic_notification_function(<?php echo $_SESSION["picID"] ?>);
    fetch_full_pic_notification_function(<?php echo $_SESSION["picID"] ?>);
    change_pic_read_status(<?php echo $_SESSION["picID"] ?>);
</script>