let toggle_callbell = false;
let fb_appID = "912333495590130";

$(document).ready(function() {

    
    // Update tooltips width
    $("#chatHeadTooltips p").css("width", $("#chatHeadTooltips p").width());
    $("#chatHeadTooltips").addClass("off");
    setTimeout(function() {
        $("#chatHeadTooltips").removeClass("off");
    }, 15000);

    // Adjust chathead item position
    var position = 65;
    $(".chathead-item").each(function(i, obj) {
        $(obj).css("top", "-" + position + "px");
        position += 65;
        $(obj).css("right", 20 + "px");
    });

    // On click chatHead button
    $(document).on("click", "#chatToggle", function() {
        $("#chatHeadTooltips").addClass("off");
        $("#chatOption").toggleClass("off");

        if ($("#chatOption").hasClass("off")) {
            $(".material-scrolltop").fadeIn(300);
        } else {
            $(".material-scrolltop").fadeOut(300);
        }
    });

    // Initial Facebook chat widget
    window.fbAsyncInit = function() {
        FB.init({
            // appId: fb_appID,
            // autoLogAppEvents: true,
            xfbml: true,
            version: "v16.0"
        });
        $("#chatHeadWidget").addClass("loaded");
    };
    (function(d, s, id) {
        var js,
            fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src =  'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    })(document, "script", "facebook-jssdk");


});