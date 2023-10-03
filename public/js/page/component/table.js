$(document).ready(function () {

    if ($(".datepicker").length) {
        $('.datepicker').flatpickr();
    }

    if ($(".menu-tooltip").length) {
        //Dropdown tooltip animation
        $(".menu-tooltip").tooltipster({
            animation: "fade",
            delay: 0,
            trigger: "click",
            contentCloning: true,
            arrow: true,
            side: 'left',
            interactive: true
        });
        $(document).on('click','.tooltip_menus button',function(){
            $(".menu-tooltip").tooltipster('hide');
        });
    }

});
