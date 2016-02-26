var output_ready = true;
$( document ).ready(function() {

    if (location.href.indexOf("about") >= 0)
        $("#about").addClass("active");
    else if(location.href.indexOf("templates")>=0)
        $("#templates").addClass("active");
    else if (location.href.indexOf("contact") >= 0)
        $("#contact").addClass("active");

    else if (location.href.indexOf("user/uploads/list") >= 0)
        $("#uploads").addClass("active");
    else if (location.href.indexOf("admin/users/list") >= 0)
        $("#users").addClass("active");
    else if (location.href.indexOf("admin/roles/list") >= 0)
        $("#roles").addClass("active");

    else
        $("#home").addClass("active");

    first_check_output();
    if(output_ready==false)
        setInterval(check_output, 5000);

});

function get_ajax_url(value) {
    var url = window.location.href;
    var position = url.lastIndexOf("/uploads");
    var new_url = url.substr(0, position);
    new_url += "/uploads/" + value;
    return new_url;
}

function first_check_output() {
    var url = get_ajax_url('check-output');
    $.ajax({
        url: url,
        type: "get",
        async: false,
        success: function(response) {
            var obj = jQuery.parseJSON(response);
            //console.log(obj.ready);
            if(obj.ready==false)
                output_ready = false;
        },
        error: function(xhr) {}
    });
}

function check_output() {
    var url = get_ajax_url('check-output');
    $.ajax({
        url: url,
        type: "get",
        async: true,
        success: function(response) {
            var obj = jQuery.parseJSON(response);
            //console.log(obj.ready);
            if(obj.ready==true)
                window.location.reload();
        },
        error: function(xhr) {}
    });
}