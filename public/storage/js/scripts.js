$(document).ready(function (){
    $(".catalog_button").on('click',function (){
            let state = $(this).attr('data-state'),
                top = parseInt($(".sectionWrap.header").height())  + parseInt($(".sectionWrap.headerSearch").height())
            $(".burgerOverlay").css("top",top);
            
            if(state === 'closed'){
                $(this).find('.burger').hide();
                $(this).find('.burger.Active').css('display',"flex");
                $(".burgerCatalogMenu").show();
                $(".burgerOverlay").show();
                $(this).attr('data-state','opened');
                $('body').addClass('fixed');
            } else {
                $(this).find('.burger').hide();
                $(this).find('.burger:first').show();
                $(".burgerCatalogMenu").hide();
                $(".burgerOverlay").hide();
                $(this).attr('data-state','closed');
                $('body').removeClass('fixed');
            }
    })
    $(".connectPhone").on('mouseover',function () {
        $(".popupContact").show();
    });
    $(".popupContact").on('mouseleave',function (){
        $(this).hide();
    })
    $('.mainMenu .menu-item').on('mouseover',function (){
        $('.mainMenu .menu-item').removeClass('active');
        $(this).addClass('active');
        let ind = $(this).attr('data-group');
        $(".subMenu").hide();
        $("#" + ind).show();
    });
    $('[data-toggle="tooltip"]').tooltip({
        placement: 'top'
    })
    $('body').on('click',".filterTitle",function(){
        if($(this).hasClass('active')){
            $(this).removeClass('active');
        } else {
            $(this).addClass('active');
        }
    });
    $(".profileLink").on('click',function (){
        $('.popup_account').slideToggle();
    });
    $(document).mouseup(function (e){
        let div = $(".top-nav-account");
        if (!div.is(e.target)
            && div.has(e.target).length === 0) {
            $('.popup_account').hide();
        }
    });
})
