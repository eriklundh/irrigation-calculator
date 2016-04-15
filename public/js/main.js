var output_ready = true;
$( document ).ready(function() {

    if (location.href.indexOf("about") >= 0)
        $("#about").addClass("active");
    else if(location.href.indexOf("templates")>=0)
        $("#templates").addClass("active");
    else if (location.href.indexOf("contact") >= 0)
        $("#contact").addClass("active");

    else if (location.href.indexOf("user/climate-data") >= 0)
        $("#climate-data").addClass("active");
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

    $("input[name='climate_model']").change(function(){
        if($("input:radio[name=climate_model]:checked").val()=='SelfSuppliedStation')
            $("#weather_data_div").css("display", "block");
        else
            $("#weather_data_div").css("display", "none");
    });

    $("input[name='model']").change(function(){
        $("#kml_div").css("display", "block");
    });

    $("input[name='climate_data_radio']").change(function(){
        if($("input:radio[name=climate_data_radio]:checked").val()=='Coordinates') {
            $("#climate_data_coordinates").css("display", "block");
            $("#climate_data_kml").css("display", "none");
            $("#climate_data_submit").css("display", "block");
        }
        else {
            $("#climate_data_coordinates").css("display", "none");
            $("#climate_data_kml").css("display", "block");
            $("#climate_data_submit").css("display", "block");
        }
    });

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

function run_model() {
    var url = get_ajax_url('run-model');
    $.ajax({
        url: url,
        type: "get",
        async: false,
        success: function(response) {
            var obj = jQuery.parseJSON(response);
            if(obj.state==0)
                alert('Please upload '+obj.type+' file!');
            //else if(obj.state==1)
            //    alert('Please wait few seconds until '+obj.type+' file is ready for processing');
            else window.location.reload();
        },
        error: function(xhr) {}
    });
}