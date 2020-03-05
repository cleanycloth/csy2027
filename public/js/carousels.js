$(document).ready(function(){
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

    $('.product-carousel').slick({
        dots: true,
        infinite: true,
        draggable: true,
        slidesToShow: 3,
        slidesToScroll: 1
    });
});