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

    // Filter Dropdowns
    //var dropdown = document.getElementsByClassName("dropdown-btn");
    //var i;

    /*
    for (var i=0; i<dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } 
            else {
                dropdownContent.style.display = "block";
            }
        });
    }
    */

    $('.dropdown-btn').click(function() {
        if ($(this).next().hasClass("visible")) {
            $(this).next().removeClass("visible");
            $(this).next().addClass("hidden");
            $(this).find('i').removeClass('fa-caret-down');
            $(this).find('i').addClass('fa-caret-up');
        }
        else {
            $(this).next().removeClass("hidden");
            $(this).next().addClass("visible");
            $(this).find('i').removeClass('fa-caret-up');
            $(this).find('i').addClass('fa-caret-down');
        }
    });

    // AJAX Test
    $('.update-button').click(function() {
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