<?php

/*
    mt - margin top
    mb - margin bottom
    mr - margin right
    ml - margin left
    usage: mt-1, mb-2, mr-3, ml-4
    note: size depending on the number after the key var

    sm - small
    md - medium
    lg - large
    xl - extra large

*/

/*
****************************************************************************************************   
*   Card
**************************************************************************************************** 
*/
function css_default_card(string $header, string $body)
{
    return
    "<div class='card'>" .
        "<div class='card-header'>" .
            $header .
        "</div>" .
        "<div class='card-body'>" .
            $body .
        "</div>" .
    "</div>";
}

function css_basic_card(string $header, string $body)
{
    return
    '<div class="card shadow">' .
        '<div class="card-header m-0 font-weight-bold text-primary py-3">' .
            $header .
        '</div>' .
        '<div class="card-body">' .
            $body .
        '</div>' .
    '</div>';
}

function css_dropdown_card(string $header, string $body)
{
    return
    '<div class="card shadow">' .
        '<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">' .
            '<h6 class="m-0 font-weight-bold text-primary">' . $header . '</h6>' .
            '<div class="dropdown no-arrow">' .
                '<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' .
                    '<i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>' .
                '</a>' .
                '<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">' .
                '<div class="dropdown-header">Dropdown Header:</div>' .
                    '<a class="dropdown-item" href="#">Action</a>' .
                    '<a class="dropdown-item" href="#">Another action</a>' .
                '<div class="dropdown-divider"></div>' .
                    '<a class="dropdown-item" href="#">Something else here</a>' .
                '</div>' .
            '</div>' .
        '</div>' .
        '<div class="card-body">' .
        $body .
        '</div>' .
    '</div>';
}

function css_collapsable_card(string $header, string $body)
{
    return
    '<div class="card shadow">' .
        '<a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">' .
            '<h6 class="m-0 font-weight-bold text-primary">' . $header . '</h6>' .
        '</a>' .
        '<div class="collapse show" id="collapseCardExample">' .
            '<div class="card-body">' . $body . '</div>' .
        '</div>' .
    '</div>';
}

/*
****************************************************************************************************   
*   Small Card
**************************************************************************************************** 
*/
function css_small_card(string $type, string $head, string $body, string $icon_name)
{
    $border_type = '';
    $heading_type = '';

    if ($type == "primary") {
        $border_type = '<div class="card border-left-primary shadow py-2">';
        $heading_type = '<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">';
    } else if ($type == "success") {
        $border_type = '<div class="card border-left-success shadow py-2">';
        $heading_type = '<div class="text-xs font-weight-bold text-success text-uppercase mb-1">';
    } else if ($type == "info") {
        $border_type = '<div class="card border-left-info shadow py-2">';
        $heading_type = '<div class="text-xs font-weight-bold text-info text-uppercase mb-1">';
    } else if ($type == "warning") {
        $border_type = '<div class="card border-left-warning shadow py-2">';
        $heading_type = '<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">';
    } else if ($type == "danger") {
        $border_type = '<div class="card border-left-danger shadow py-2">';
        $heading_type = '<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">';
    } else if ($type == "secondary") {
        $border_type = '<div class="card border-left-secondary shadow py-2">';
        $heading_type = '<div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">';
    } else if ($type == "light") {
        $border_type = '<div class="card border-left-light shadow py-2">';
        $heading_type = '<div class="text-xs font-weight-bold text-light text-uppercase mb-1">';
    } else if ($type == "dark") {
        $border_type = '<div class="card border-left-dark shadow py-2">';
        $heading_type = '<div class="text-xs font-weight-bold text-dark text-uppercase mb-1">';
    }


    return
    $border_type .
    '<div class="card-body">' .
        '<div class="row no-gutters align-items-center">' .
            '<div class="col mr-2">' .
                $heading_type . $head . '</div>' .
                '<div class="h5 mb-0 font-weight-bold text-gray-800">' . $body . '</div>' .
            '</div>' .
            '<div class="col-auto">' .
                '<i class="' . $icon_name . ' fa-2x text-gray-300"></i>' .
            '</div>' .
        '</div>' .
    '</div>';
}

/*
****************************************************************************************************   
*   Flat Button
**************************************************************************************************** 
*/

function css_button(string $type, string $button_name, string $icon_name)
{
    $return_string = '';

    if ($type == "primary") {
        $return_string = '<div class="btn btn-primary btn-icon-split">';
    } else if ($type == "success") {
        $return_string = '<div class="btn btn-success btn-icon-split">';
    } else if ($type == "info") {
        $return_string = '<div class="btn btn-info btn-icon-split">';
    } else if ($type == "warning") {
        $return_string = '<div class="btn btn-warning btn-icon-split">';
    } else if ($type == "danger") {
        $return_string = '<div class="btn btn-danger btn-icon-split">';
    } else if ($type == "secondary") {
        $return_string = '<div class="btn btn-secondary btn-icon-split">';
    } else if ($type == "light") {
        $return_string = '<div class="btn btn-light btn-icon-split">';
    }

    return
        $return_string .
        '<span class="icon text-white-50">' .
        '<i class=' . $icon_name . '></i>' .
        '</span>' .
        '<span class="text">' . $button_name . '</span>' .
        '</div>';
}

function css_small_button(string $button_name)
{
    return
        '<div class="btn btn-primary btn-icon-split btn-sm">' .
        '<span class="icon text-white-50">' .
        '<i class="fas fa-flag"></i>' .
        '</span>' .
        '<span class="text">' . $button_name . '</span>' .
        '</div>';
}

function css_big_button(string $button_name)
{
    return
        '<div class="btn btn-primary btn-icon-split btn-lg">' .
        '<span class="icon text-white-50">' .
        '<i class="fas fa-flag"></i>' .
        '</span>' .
        '<span class="text">' . $button_name . '</span>' .
        '</div>';
}

function css_brand_button(string $button_name, string $icon_name)
{
    return
        '<div class="btn btn-google btn-block">' .
        '<i class="' . $icon_name . '"></i>' .
        $button_name .
        '</div>';
}

/*
****************************************************************************************************   
* Circle Button
**************************************************************************************************** 
*/

function css_circle_button(string $type, string $button_name, string $icon_name)
{
    $button_type = '';

    if ($type == "primary") {
        $button_type = '<div class="btn btn-primary btn-circle">';
    } else if ($type == "success") {
        $button_type = '<div class="btn btn-success btn-circle">';
    } else if ($type == "info") {
        $button_type = '<div class="btn btn-info btn-circle">';
    } else if ($type == "warning") {
        $button_type = '<div class="btn btn-warning btn-circle">';
    } else if ($type == "danger") {
        $button_type = '<div class="btn btn-danger btn-circle">';
    } else if ($type == "secondary") {
        $button_type = '<div class="btn btn-secondary btn-circle">';
    }

    return
        $button_type .
        '<i class="' . $icon_name . '"></i>' .
        $button_name .
        '</div>';
}

/*
****************************************************************************************************   
* Data Tables
**************************************************************************************************** 
*/
function css_table(string $table_title, array $table_header, array $table_data)
{
    $return_string =
    '<div class="card shadow mb-4">' .
        '<div class="card-header py-3">' .
            '<h6 class="m-0 font-weight-bold text-primary">' . $table_title . '</h6>' .
        '</div>' .
            '<div class="card-body">' .
                '<div class="table-responsive">' .
                    '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">' .
                        '<tr>';
                        for ($i = 0; $i < count($table_header); $i++) {
                            $return_string .= '<th>' . $table_header[$i] . '</th>';
                        }
                        $return_string .= '</tr>';
                        for ($i = 0; $i < count($table_data); $i++) {
                            $return_string .= '<tr>';
                            for ($j = 0; $j < count($table_data[$i]); $j++) {
                                $return_string .= '<td>' . $table_data[$i][$j] . '</td>';
                            }
                            $return_string .= '</tr>';
                        }
                    $return_string .= '</table>' .
                '<div>' .
            '</div>' .
        '</div>' .
    '</div>';

    return $return_string;
}

function css_data_table(string $table_title, array $table_header, array $table_data)
{
    $return_string =
    '<div class="card shadow mb-4">' .
        '<div class="card-header py-3">' .
            '<h6 class="m-0 font-weight-bold text-primary">' . $table_title . '</h6>' .
        '</div>' .
        '<div class="card-body">' .
            '<div class="table-responsive">' .
                '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">' .
                    '<thead>' .
                        '<tr>';
                            for ($i = 0; $i < count($table_header); $i++) {
                                $return_string .= '<th>' . $table_header[$i] . '</th>';
                            }
                            $return_string .= '</tr>' .
                                '</thead>' .
                                '<tbody>';
                            for ($i = 0; $i < count($table_data); $i++) {
                                $return_string .= '<tr>';
                                for ($j = 0; $j < count($table_data[$i]); $j++) {
                                    $return_string .= '<td>' . $table_data[$i][$j] . '</td>';
                                }
                                $return_string .= '</tr>';
                            }
                    $return_string .= '</tbody>' .
                '</table>' .
            '</div>' .
        '</div>' .
    '</div>';

    return $return_string;
}

/*
****************************************************************************************************   
*   Main Site
**************************************************************************************************** 
*/
function sidebar(string $nav_title = 'HIRARC PIC')
{
    return
        '<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion toggled" id="accordionSidebar">' .

            '<a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">' .
                // '<div class="sidebar-brand-icon rotate-n-15">' .
                // '<i class="fas fa-laugh-wink"></i>' .
                // '</div>' .
                '<div class="sidebar-brand-icon">' .
                    $nav_title .
                '</div>' .
            '</a>' .

            '<li class="nav-item active">' .
                '<a class="nav-link" href="pic_main.php">' .
                '<i class="fas fa-bell fa-3x"></i>' .
                '<span>Main</span></a>' .
            '</li>' .

            
            '<hr class="sidebar-divider">' .

            '<div class="sidebar-heading"> ' .
                'Report Management' .
            '</div>' .

            '<li class="nav-item">' .
                '<a class="nav-link" href="pic_report_task.php">' .
                '<i class="fas fa-clipboard-list fa-3x"></i>' .
                '<span>Task</span></a>' .
            '</li>' .

            '<li class="nav-item">' .
                '<a class="nav-link" href="pic_report_in_monitor.php">' .
                '<i class="fas fa-comment-alt"></i>' .
                '<span>In Monitor</span></a>' .
            '</li>' .

            '<li class="nav-item">' .
                '<a class="nav-link" href="pic_report_closed.php">' .
                '<i class="fas fa-clipboard-check fa-3x"></i>' .
                '<span>Closed</span></a>' .
            '</li>' .

            '<hr class="sidebar-divider">' .

            '<div class="sidebar-heading"> ' .
                'Profile' .
            '</div>' .

                '<li class="nav-item">' .
                '<a class="nav-link" href="pic_change_password.php">' .
                '<i class="fas fa-key"></i>' .
                '<span>Change Password</span></a>' .
            '</li>' .

            '<li class="nav-item">' .
                '<a class="nav-link" href="pic_profile.php">' .
                '<i class="fas fa-id-card"></i>' .
                '<span>Profile Information</span></a>' .
            '</li>' .

            '<br />' .

            '<li class="nav-item">' .
                '<a class="nav-link collapsed" href="#" data-toggle="modal" data-target="#logoutModal">' .
                    // '<a class="nav-link" href="pic_logout.php">' .
                    '<i class="fas fa-sign-out-alt"></i>' .
                    '<span>Logout</span>' .
                '</a>' .
            '</li>' .

            '<div class="text-center d-none d-md-inline">' .
                '<button class="rounded-circle border-0" id="sidebarToggle"></button>' .
            '</div>' .
        '</ul>';
}

function topbar(string $user_name)
{
    return
    '<div id="content">' .
        '<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">' .

            // '<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">' .
            //     '<i class="fa fa-bars"></i>' .
            // '</button>' .

            // '<ul class="navbar-nav ml-auto" style="text-transform: capitalize;" >' .
            //     //'<li>' . $user_name . '</li>' .
            //     // '<li class="nav-item dropdown no-arrow">' .
            //     //     '<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' .
            //     //         '<span class="mr-2 d-none d-lg-inline text-gray-600 small">Valerie Luna</span>' .
            //     //         '<img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">' .
            //     //     '</a>' .
            //     // '</li>' .
            //     // '<div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">' .
            //     //     '<form class="form-inline mr-auto w-100 navbar-search">' .
            //     //         '<div class="input-group">' .
            //     //             '<input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">' .
            //     //                 '<div class="input-group-append">' .
            //     //                     '<button class="btn btn-primary" type="button">' .
            //     //                         '<i class="fas fa-search fa-sm"></i>' .
            //     //                     '</button>' .
            //     //                 '</div>' .
            //     //             '</div>' .
            //     //         '</form>' .
            //     //     '</div>' . 
            //     // '</li>' .

            //     //alerts
            //     '<li class="nav-item dropdown no-arrow mx-1">' .
            //         '<a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' .
            //             '<i class="fas fa-bell fa-fw"></i>' .
            //             '<!-- Counter - Alerts -->' .
            //             '<span class="badge badge-danger badge-counter">3+</span>' .
            //         '</a>' .
            //         '<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">' .
            //             '<h6 class="dropdown-header">' .
            //             'Alerts Center' .
            //             '</h6>' .
            //             '<a class="dropdown-item d-flex align-items-center" href="#">' .
            //                 '<div class="mr-3">' .
            //                     '<div class="icon-circle bg-primary">' .
            //                     '<i class="fas fa-file-alt text-white"></i>' .
            //                     '</div>' .
            //                 '</div>' .
            //                 '<div>' .
            //                     '<div class="small text-gray-500">December 12, 2019</div>' .
            //                     '<span class="font-weight-bold">A new monthly report is ready to download!</span>' .
            //                 '</div>' .
            //             '</a>' .
            //             '<a class="dropdown-item d-flex align-items-center" href="#">' .
            //                 '<div class="mr-3">' .
            //                     '<div class="icon-circle bg-success">' .
            //                     '<i class="fas fa-donate text-white"></i>' .
            //                     '</div>' .
            //                 '</div>' .
            //                 '<div>' .
            //                     '<div class="small text-gray-500">December 7, 2019</div>' .
            //                     '$290.29 has been deposited into your account!' .
            //                 '</div>' .
            //             '</a>' .
            //             '<a class="dropdown-item d-flex align-items-center" href="#">' .
            //                 '<div class="mr-3">' .
            //                     '<div class="icon-circle bg-warning">' .
            //                     '<i class="fas fa-exclamation-triangle text-white"></i>' .
            //                     '</div>' .
            //                 '</div>' .
            //                 '<div>' .
            //                     '<div class="small text-gray-500">December 2, 2019</div>' .
            //                     'Spending Alert: We\'ve noticed unusually high spending for your account.' .
            //                 '</div>' .
            //             '</a>' .
            //             '<a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>' .
            //         '</div>' .
            //     '</li>' .

            //     //user information
            //     '<li class="nav-item dropdown no-arrow">' .
            //         '<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' .
            //             '<span class="mr-2 d-none d-lg-inline text-gray-600 small">' . $user_name . '</span>' .
            //             '<img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">' .
            //         '</a>' .
            //         '<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">' .
            //             '<a class="dropdown-item" href="pic_profile.php">' .
            //                 '<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>' .
            //                 'Profile' .
            //             '</a>' .
            //             '<a class="dropdown-item" href="pic_change_password.php">' .
            //                 '<i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>' .
            //                 'Change Password' .
            //             '</a>' .

            //             '<div class="dropdown-divider"></div>' .

            //             '<a class="dropdown-item" href="pic_logout.php">' .
            //                 '<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>' .
            //                 'Logout' .
            //             '</a>' .
            //         '</div>' .  
            //     '</li>' .

            // '</ul>' .

            '<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">' .
            '<i class="fa fa-bars"></i>' .
            '</button>' .

            '<div class="text-center">' .
                '<img src="KUPTM logo.png" alt="kuptm logo" width="25%" draggable="false">' .
            '</div>' .

            '<ul class="navbar-nav ml-auto">' .
               '<li class="nav-item dropdown no-arrow mx-1">' .
                   ' <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"' .
                        'data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' .
                        '<i class="fas fa-bell fa-fw"></i>' .
                        '<!-- Counter - Alerts -->' .
                        '<span class="badge badge-danger badge-counter" id="not_read_counter"></span>' .
                    '</a>' .
                    '<!-- Dropdown - Alerts -->' .
                    '<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">' .
                        '<h6 class="dropdown-header">' .
                           ' Notification' .
                        '</h6>' .
                        '<div id="notification_body"></div>' .
                        '<a class="dropdown-item text-center small text-gray-500" id="change_pic_read_status" href="pic_notification_list.php">Show All Alerts</a>' .
                    '</div>' .
                '</li>' .
            '</ul>' .
        '</nav>' .
    '</div>';
}

function modal()
{
    return 
    // scroll to top modal
    '<a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>' .
    // logout modal
    '<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' .
        '<div class="modal-dialog" role="document">' .
            '<div class="modal-content">' .
                '<div class="modal-header">' .
                '<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>' .
                '<button class="close" type="button" data-dismiss="modal" aria-label="Close">' .
                    '<span aria-hidden="true">×</span>' .
                '</button>' .
                '</div>' .
                '<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>' .
                '<div class="modal-footer">' .
                    '<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>' .
                    '<a class="btn btn-primary" href="pic_logout.php">Logout</a>' .
                '</div>' .
            '</div>' .
        '</div>' .
    ' </div>';
}

function footer()
{
    return
    '<footer class="sticky-footer">' .
        '<div class="container my-auto">' .
            '<div class="copyright text-center my-auto">' .
                //'<span>Copyright &copy; Kolej Universiti Poly-Tech Mara 2020</span>' .
                //'<span>Copyright &copy; ' . date("Y") . ' Kolej Universiti Poly-Tech MARA (KUPTM) Kuala Lumpur. All rights reserved</span>' .
                '<span style="font-family:Times New Roman, Times, serif; font-size: 16px;">Copyright &copy;2021 - ' . date("Y") . ' <a href="http://www.kuptm.edu.my/">Kolej Universiti Poly-Tech MARA (KUPTM) Kuala Lumpur</a> <br /> All rights reserved.</span>' .
            '</div>' .
        ' </div>' .
    '</footer>';
}

/*
****************************************************************************************************   
*   Form Body
**************************************************************************************************** 
*/

function register_login_body(string $title, string $body)
{
    // card
    echo '<div class="row justify-content-center">';
    echo '<div class="col-xl-10 col-lg-12 col-md-9">';
    echo '<div class="card o-hidden border-0 shadow-lg my-5">';
    echo '<div class="card-body p-0">';
    // content
    //echo '<div class="row">';
    //echo '<div class="col-lg-6 d-none d-lg-block bg-login-image"></div>';
    //echo '<div class="col-lg-6">';
    echo '<div class="p-5">';
    echo
    '<div class="text-center">' .
        '<h1 class="h4 text-gray-900 mb-4">' . $title . '</h1>' .
        '</div>';
    echo $body;
    echo "</div>";
    //echo "</div>";
    //echo "</div>";
    //echo "</div>";
    // end content
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    // end card
}

function login_body(string $title, string $body)
{
    return
        '<div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">' .
            '
                                
                                <div class="text-center">
                                    <img src="KUPTM logo.png" alt="logo" width="60%" draggable="false">
                                </div>

                                <div class=" text-center">
                                    <h1 class="h5 text-gray-900 mb-4">HAZARD AND RISK MANAGEMENT SYSTEM (HIRARC)</h1>
                                </div>

                                <hr />
                                
                                <div class="form-group">
                                    <select style="border-radius: 25px;" class="custom-select input-lg " name="dropdown_login" onchange="location = this.value;">
                                    <option value="Choose role" selected>Choose Role</option>
                                    <option value="admin_login.php">Admin</option>
                                    <option value="pic_login.php">PIC</option>
                                    </select>
                                </div>

                                ' . $body . '

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>';
}

/*
****************************************************************************************************   
*   Overlay Message
**************************************************************************************************** 
*/
echo
'<style>
    #overlay {
        position: fixed;
        display: none;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0,0,0,0.5);
        z-index: 2;
        cursor: pointer;
    }

    #text{
        position: absolute;
        top: 50%;
        left: 50%;
        font-size: 50px;
        color: white;
        transform: translate(-50%,-50%);
        -ms-transform: translate(-50%,-50%);
    }
</style>';

// function alert($title, $body)
// {
//     '<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' .
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
//     ' </div>';
// }

function overlay($overlay_text)
{
    return
        '<div id="overlay" onclick="off()">' .
            '<div id="text">' . $overlay_text . '</div>' .
        '</div>' .
        '<script>on();</script>';
}

?>

<script>
function on() {
    document.getElementById("overlay").style.display = "block";
}

function off() {
    document.getElementById("overlay").style.display = "none";
}
</script>