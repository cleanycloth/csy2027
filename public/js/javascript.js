$(document).ready(function() {
    // Scroll percentage code from: https://codepen.io/achudars/pen/Cpast
    $(window).scroll(function(e){
        var scrollTop = $(window).scrollTop();
        var docHeight = $(document).height();
        var winHeight = $(window).height();
        var scrollPercent = (scrollTop) / (docHeight - winHeight);
        var scrollPercentRounded = Math.round(scrollPercent*100);

        if (scrollPercentRounded >= 50) {
            $('#return-to-top').removeClass('hide');
            $('#return-to-top').addClass('show');
        }
        else {
            $('#return-to-top').removeClass('show');
            $('#return-to-top').addClass('hide');
        }
    });

    // Basket Overlay
    $('#basket-button').click(function() {
        if ($('#basket').hasClass('hidden')) {
            // Makes the overlay slide in when button has been clicked.
            $('#basket-button').html('<i class="fas fa-times-circle"></i>');
            $('#basket').removeClass('hidden');
            $('#basket').addClass('visible');
            $('#return-to-top').addClass('extra-spacing');
        }
        else {
            // Makes the overlay slide out when button has been clicked.
            $('#basket-button').html('<i class="fas fa-shopping-cart"></i>');
            $('#basket').removeClass('visible');
            $('#return-to-top').removeClass('extra-spacing');
            $('#basket').addClass('hidden');
        }
    });

    // AJAX Test
    $('.update-button').click(function() {
        return false;
    });

    $('#register-form').find('.buttons').find('input').click(function() {
        $.ajax({
            type: "POST",
            url: "/register",
            data: dataString,
            success: function(data) {
                $('.content').find('form').find('output').val(data.formError);
            }
        });
        return false;
    });

    // Carousels
    $('.main-carousel').slick({
        dots: true,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 5000,
        speed: 1000,
        draggable: true,
        nextArrow: false,
        prevArrow: false,
        slidesToShow: 1,
        slidesToScroll: 1
    });

    $('.featured-product-carousel').slick({
        dots: true,
        infinite: true,
        draggable: true,
        slidesToShow: 3,
        slidesToScroll: 1
    });

    $('.product-carousel').slick({
        dots: true,
        infinite: true,
        draggable: true,
        slidesToShow: 1,
        slidesToScroll: 1
    });
});