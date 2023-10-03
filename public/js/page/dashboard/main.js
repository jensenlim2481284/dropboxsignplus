
//Function to show loader
function showLoader() {
    $(".page-loader").fadeIn("slow");
}


//Function to hide Loader
function hideLoader() {
    $(".page-loader").fadeOut("slow");
}


$(document).ready(function() {

    //Onsubmit form - auto show loader 
    $("form").submit(function() {
        showLoader();
    });

    //If hide-form class is added will not show loader onsumbit 
    $(".hide-form").submit(function() {
        hideLoader();
    });

    //localization
    $(".language-select").change(function() {
        showLoader();
        location.href = $(this).val();
    });

    //Lazy loader 
    $('.lazy').lazy();

  
    //loader button
    $(document).on("click", "a", function () {
        if($(this).attr('href') != null  &&  !$(this).attr('href').includes("#"))
            showLoader();
    });

    $(document).on('click','.no-loader, a[target="_blank"]',function(){
        setTimeout(function(){
            hideLoader();
        },200)
    })

    //Page loader
    setTimeout(function(){
        hideLoader();
    },800);
    
    //Action button  : pass value to specific target id based on attribute
    $(document).on("click", ".action-btn", function () {
        var target = $(this).attr("target-id");
        $("#" + target).val($(this).val());
    });


});
