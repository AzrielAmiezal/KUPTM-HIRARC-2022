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
                                // echo "<p>PIC ID: " . $_SESSION["picID"] . "</p>";
                                // echo css_small_primary_card("", $_SESSION["picID"]);

                                // $paragraph = 
                                // "<p>Frozen is a 2013 American 3D computer-animated musical fantasy film produced by Walt Disney Animation Studios 
                                // and released by Walt Disney Pictures. The 53rd Disney animated feature film, it is inspired by Hans Christian Andersen's 
                                // 1844 fairy tale \"The Snow Queen\". It tells the story of a fearless princess who sets off on 
                                // a journey alongside a rugged iceman, his loyal reindeer, and a naive snowman to find her estranged sister,
                                // whose icy powers have inadvertently trapped their kingdom in eternal winter.</P>
                    
                                // <p>Frozen underwent several story treatments before being commissioned in 2011, with a screenplay written by Jennifer Lee, 
                                // who also co-directed with Chris Buck. The film features the voices of Kristen Bell, Idina Menzel, Jonathan Groff, 
                                // Josh Gad, and Santino Fontana. Christophe Beck was hired to compose the film's orchestral score, while Robert Lopez and 
                                // Kristen Anderson-Lopez wrote the songs.</p>
                                
                                // <p>Frozen premiered at the El Capitan Theatre in Hollywood, California, on November 19, 2013, had a limited release 
                                // on November 22 and went into general theatrical release on November 27. It was met with praise for its visuals, screenplay, 
                                // themes, music, and voice acting; some film critics consider Frozen to be the best Disney animated feature film since the 
                                // studio's renaissance era. The film also achieved significant commercial success, earning $1.280 billion in worldwide 
                                // box office revenue, including $400 million in the United States and Canada and $247 million in Japan. It went on to surpass 
                                // Toy Story 3 (which was also distributed by Disney) as the highest-grossing animated film at the time as well as the 
                                // highest grossing musical film before being surpassed by the remake of The Lion King in 2019; it also ranks as the 16th 
                                // highest-grossing film of all time, the highest-grossing film of 2013, and the third highest-grossing film in Japan. It 
                                // was also the highest-earning film with a female director in terms of US earnings, until surpassed by Warner Bros. 
                                // Pictures' Wonder Woman.With over 18 million home media sales in 2014, it entered the list of best-selling films in 
                                // the United States. By January 2015, Frozen had become the all-time best-selling Blu-ray Disc in the United States.</p>
                                
                                // <p>Frozen won two Academy Awards for Best Animated Feature and Best Original Song (\"Let It Go\"), the Golden 
                                // Globe Award for Best Animated Feature Film, the BAFTA Award for Best Animated Film, five Annie Awards 
                                // (including Best Animated Feature), two Grammy Awards for Best Compilation Soundtrack for Visual Media and 
                                // Best Song Written for Visual Media (\"Let It Go\"), and two Critics' Choice Movie Awards for Best Animated 
                                // Feature and Best Original Song (\"Let It Go\"). An animated short sequel, Frozen Fever, premiered on March 13, 
                                // 2015,an animated featurette titled Olaf's Frozen Adventure, premiered on November 22, 2017, and a feature-
                                // length sequel, Frozen II, was released on November 22, 2019.</p>";

                                $paragraph = "<h2>Welcome To PIC Panel ".strtoupper($_SESSION['picFullname'])."</h2>";
                                
                                echo css_basic_card("", $paragraph);
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
    change_pic_read_status(<?php echo $_SESSION["picID"] ?>);
</script>