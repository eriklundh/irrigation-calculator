$( document ).ready(function() {

    if (location.href.indexOf("about") >= 0)
        $("#about").addClass("active");
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

});