addEventListener("load", function(){
    setTimeout(hideURLbar, 0);
    }, false);
function hideURLbar(){
    window.scrollTo(0,1); 
}
function myShowPassword() {
    var x = document.getElementById("pass");
    if (x.type === "password") {
        x.type = "text";
    }
    else {
        x.type = "password";
    }
}
$(document).ready(function () {

    $('.notification-login').fadeOut(1500);

    

})
