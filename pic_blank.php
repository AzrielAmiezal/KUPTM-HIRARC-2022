<?php
    require "pic_css_function.php";

    echo '<html lang="en">';
        echo '<head>' .
            '<meta charset="utf-8">' .
            '<meta http-equiv="X-UA-Compatible" content="IE=edge">' .
            '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">' .
            '<meta name="description" content="">' .
            '<meta name="author" content="">' .

            '<title>Page Title</title>' .

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
                        echo topbar("Muhammad Mubarrak");
                        echo '<div class="container-fluid">';
                            // '<h1 class="h3 mb-4 text-gray-800">Blank Page</h1>';
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
?>

<script>
    fetch_pic_notification_function(<?php echo $_SESSION["picID"] ?>);
</script>