$(document).ready(function(){

    //Initial Upload Input Box
    initialUploadBox('notification-upload', 'notification-drag', 'notification-message', 'notification-label', 'notification-response', 'notification-message');

    //Current image toggle 
    $(".current-image-btn").hide();
    $(document).on('click','.add-btn',function(){
        $(".current-image-btn").hide();
        $("#manageModal .modal-body input").val('');
    })


    // Onclick edit banner button 
    $(document).on('click','.edit-btn',function(){
       
        var id = $(this).val();
        showLoader();
        $.ajax({
            type: 'GET',
            url: '/agent/get/'+ id,
            success: function (data) {
                $.each(data, function (index, value) {                    
                    $("[name='" + index + "']").val(value);
                });
                $(".current-image-btn").attr('href',data.currentPicture).show();
            }
        }).done(function(){
            hideLoader();
        });

    });
})