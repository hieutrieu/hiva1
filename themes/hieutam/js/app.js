$(function(){
    //alert($(window).width());
    $('a.login-link').popover({
        html: 'true',
        trigger: 'click',
        placement: 'bottom',
        content : function() {
            return $('#popover-content').html();
        }
    });
    $(document).click(function(){
        $('.order_price_info').find('.popover').fadeOut();
    });
    $('.order_price_info').hover(function() {
        var that = this;
        $.ajax({
            url: '/shoppingcart/order/is_ajax/true',
            dataType: 'html',
            /*cache: true,*/
            beforeSend: function() {
                $(that).find('.popover').fadeIn(100);
            },
            success:function(result) {
                $(that).find('.popover-content').html(result);
                $(that).find('.popover-content').slimScroll({
                    height: '250px'
                });
                
            },
            error: function(jqXHR){
            }
        });
    });
    /*
    $('.order_info').popover({
        html: true,
        trigger: 'focus',
        placement: 'bottom',
        container: '.order_price_info',
    }).click(function(e) {
            $.ajax({
                url: '/shoppingcart/order/is_ajax/true',
                dataType: 'html',
                beforeSend: function() {
                    
                },
                success:function(result) {
                    $('.order_price_info').find('.popover-content').html(result);
                    $('.order_price_info').find('.popover-content').slimScroll({
                        height: '250px'
                    });
                    
                },
                error: function(jqXHR){
                }
            });
            $(this).popover('toggle');
        }
    );
    */
    $('.mega_dropdown').hover(
        function(e) {
            e.stopPropagation()
            $(this).find('.dropdown_menu').show();
        },
        function(e) {
            e.stopPropagation()
            $('.dropdown_menu').fadeOut();
        }
    );
    
    
    var jcarousel = $('.mainmenu-slider-container').jcarousel();
    $('.mainmenu-control-prev')
        .on('jcarouselcontrol:active', function() {
            $(this).removeClass('inactive');
        })
        .on('jcarouselcontrol:inactive', function() {
            $(this).addClass('inactive');
        })
        .jcarouselControl({
            target: '-=2'
        });

    $('.mainmenu-control-next')
        .on('jcarouselcontrol:active', function() {
            $(this).removeClass('inactive');
        })
        .on('jcarouselcontrol:inactive', function() {
            $(this).addClass('inactive');
        })
        .jcarouselControl({
            target: '+=2'
        });
});

function addtocart(event, myself, href) {
    event.stopPropagation();
    $.ajax({
        url: href,
        type: "GET",
        beforeSend: function() {
            $(myself).button('loading');
        },
        success:function(result) {
            $(myself).button('reset');
        },
        error: function(jqXHR){
            $(myself).button('reset');
        }
    });
}

function validateLogin(myself) {
    var email = $('#login_email').val();
    var password = $('#login_password').val();
    var validate = true;
    if(email == '' || !validateEmail(email)) {
        $('#login_email').addClass('error');
        validate = false;
    }
    if(password == '') {
        $('#login_password').addClass('error');
        validate = false;
    }
    return validate;
}

function subscribe(myself) {
    $('#show_msg').hide();
    var email = $('#subscribe_email').val();
    if(email == '' || !validateEmail(email)) {
        $('#subscribe_email').addClass('error');
        return false;
    } else {
        $.ajax({
            url: '/newsletter/subscribe',
            data: 'email='+ email,
            dataType: 'json',
            type: "POST",
            beforeSend: function() {
                $('#newsletter').button('loading');
            },
            success:function(result) {
                $('#newsletter').button('reset');
                $('#subscribe_msg').fadeIn();
                $('#subscribe_msg').html(result.msg);
                if(result.error == 1) {
                    $('#subscribe_msg').addClass('error');
                }
                $('#show_msg').css('left', $('#newsletter_container').width()+20);
                $('#show_msg').fadeIn();
            },
            error: function(jqXHR){
                
            }
        });
    }
}

function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} 