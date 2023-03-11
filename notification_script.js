function new_submission_notification($notSubject, $notText) {
    $.ajax(
        {
            type: "POST",
            url: "notification_process.php",
            data:
            {
                process: "new_submission",
                notSubject: $notSubject,
                notText: $notText
            },
            success: function (response) {
                //alert('response: ' + response);

                var jsonData = $.parseJSON(response);

                if (jsonData.success == 1) {
                    //alert("insert success"); 
                    isHeard = false;
                    //new Audio('pristine.mp3').play(); 
                }
            },
            error: function (err) {
                //handle your error
                alert('did not work: ' + err);
            }
        });
}

function investigate_notification($notSubjectAdm, $notTextAdm, $notSubjectPIC, $notTextPIC, $adminID, $picID) {
    $.ajax(
        {
            type: "POST",
            url: "notification_process.php",
            data:
            {
                process: "managed_solved",
                notSubjectAdm: $notSubjectAdm,
                notTextAdm: $notTextAdm,
                notSubjectPIC: $notSubjectPIC,
                notTextPIC: $notTextPIC,
                adminID: $adminID,
                picID: $picID
            },
            success: function (response) {
                //alert('response: ' + response);

                var jsonData = $.parseJSON(response);

                if (jsonData.success == 1) {
                    //alert("insert success"); 
                    isHeard = false;
                    //new Audio('pristine.mp3').play(); 
                }
            },
            error: function (err) {
                //handle your error
                alert('did not work: ' + err);
            }
        });
}

function feedback_given_notification($notSubjectAdm, $notTextAdm, $picID) {
    $.ajax(
        {
            type: "POST",
            url: "notification_process.php",
            data:
            {
                process: "feedback_given",
                notSubjectAdm: $notSubjectAdm,
                notTextAdm: $notTextAdm,
                picID: $picID
            },
            success: function (response) {
                //alert('response: ' + response);

                var jsonData = $.parseJSON(response);

                if (jsonData.success == 1) {
                    //alert("insert success"); 
                    isHeard = false;
                    //new Audio('pristine.mp3').play(); 
                }
            },
            error: function (err) {
                //handle your error
                alert('did not work: ' + err);
            }
        });
}

function insert_pic_notification($notSubject, $notText, $picID) {
    $.ajax(
        {
            type: "POST",
            url: "notification_process.php",
            data:
            {
                process: "insert_pic",
                notSubject: $notSubject,
                notText: $notText,
                picID: $picID
            },
            success: function (response) {
                //alert('response: ' + response);

                var jsonData = $.parseJSON(response);

                if (jsonData.success == 1) {
                    //alert("insert success"); 
                    isHeard = false;
                    //new Audio('pristine.mp3').play(); 
                }
            },
            error: function (err) {
                //handle your error
                alert('did not work: ' + err);
            }
        });
}


function change_admin_read_status($adminID) {
    $("#change_admin_read_status").click(function () {
        $.ajax(
            {
                type: "POST",
                url: "notification_process.php",
                data: { process: "change_admin_read_status", adminID: $adminID },
                success: function (response) {
                    var jsonData = $.parseJSON(response);

                    if (jsonData.success == "1") {
                        //alert("admin read status has changed to 1");
                    }
                    else {
                        alert('failed!: ' + jsonData.error);
                    }
                }
            });
    });
}

function change_pic_read_status($picID) {
    $("#change_pic_read_status").click(function () {
        $.ajax(
            {
                type: "POST",
                url: "notification_process.php",
                data: { process: "change_pic_read_status", picID: $picID },
                success: function (response) {
                    var jsonData = $.parseJSON(response);

                    if (jsonData.success == "1") {
                        //alert("admin read status has changed to 1");
                    }
                    else {
                        alert('failed!: ' + jsonData.error);
                    }
                }
            });
    });
}



var isHeard = false;
var current_read_counter = 0;

function fetch_admin_notification($adminID) {
    $.ajax(
        {
            type: "POST",
            url: "notification_process.php",
            data: { process: "fetch_admin_notification", adminID: $adminID },
            success: function (response) {
                var jsonData = $.parseJSON(response);

                if (jsonData.success == "1") {
                    current_read_counter = $('#not_read_counter').val();

                    if ((jsonData.not_read_counter > 0) && (jsonData.not_read_counter > current_read_counter)) {
                        //isHeard = true;
                        //new Audio('pristine.mp3').play();
                    }

                    $('#notification_body').html(jsonData.content);
                    $('#not_read_counter').html(jsonData.not_read_counter);
                    $('#not_read_counter').val(jsonData.not_read_counter);
                }
                else {
                    alert('failed!: ' + jsonData.error);
                }
            }
        });
}

function fetch_admin_notification_function($adminID) {
    setInterval(function () {
        fetch_admin_notification($adminID);
    }, 1000);
}

function fetch_full_admin_notification($adminID) {
    $.ajax(
        {
            type: "POST",
            url: "notification_process.php",
            data: { process: "fetch_full_admin_notification", adminID: $adminID },
            success: function (response) {
                var jsonData = $.parseJSON(response);

                if (jsonData.success == "1") {
                    $('#admin_subject_and_message').html(jsonData.content);
                }
                else {
                    alert('failed!: ' + jsonData.error);
                }
            }
        });
}

function fetch_full_admin_notification_function($adminID) {
    fetch_full_admin_notification($adminID);
    setInterval(function () {
        fetch_full_admin_notification($adminID);
    }, 1000);
}


function fetch_pic_notification($picID) {
    $.ajax(
        {
            type: "POST",
            url: "notification_process.php",
            data: { process: "fetch_pic_notification", picID: $picID },
            success: function (response) {
                var jsonData = $.parseJSON(response);

                if (jsonData.success == "1") {
                    current_read_counter = $('#not_read_counter').val();

                    if ((jsonData.not_read_counter > 0) && (jsonData.not_read_counter > current_read_counter)) {
                        //isHeard = true;
                        //new Audio('pristine.mp3').play();
                    }

                    $('#notification_body').html(jsonData.content);
                    $('#not_read_counter').html(jsonData.not_read_counter);
                    $('#not_read_counter').val(jsonData.not_read_counter);
                }
                else {
                    alert('failed!: ' + jsonData.error);
                }
            }
        });
}

function fetch_pic_notification_function($picID) {
    setInterval(function () {
        fetch_pic_notification($picID);
    }, 1000);
}

function fetch_full_pic_notification($picID) {
    $.ajax(
        {
            type: "POST",
            url: "notification_process.php",
            data: { process: "fetch_full_pic_notification", picID: $picID },
            success: function (response) {
                var jsonData = $.parseJSON(response);

                if (jsonData.success == "1") {
                    $('#pic_subject_and_message').html(jsonData.content);
                }
                else {
                    alert('failed!: ' + jsonData.error);
                }
            }
        });
}

function fetch_full_pic_notification_function($picID) {
    fetch_full_pic_notification($picID);
    setInterval(function () {
        fetch_full_pic_notification($picID);
    }, 1000);
}