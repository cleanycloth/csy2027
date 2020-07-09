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

    // AJAX
    // Adding product to basket from product page.
    $('.purchasebox').find('form').submit(function(e) {
        e.preventDefault();

        var productId = $('#productId').val();
        var quantity = $('#quantity').val();
        var url = $(this).attr('action');

        var outputMsg = $(this).find('output');

        $.post(url, {productId: productId, quantity: quantity})
            .done(function(data) {
                outputMsg.val(data.status);
                fetchBasket();
            })
            .fail(function() {
                outputMsg.val('An error has occurred.');
            });
    });

    // Removing existing item from the basket.
    $(document).on('submit', '.item-main-info form', function(e) {
        e.preventDefault();

        var productId = $(this).find('input[type=hidden]').val();
        var url = $(this).attr('action');

        $.post(url, {productId: productId})
            .done(function(data) {
                fetchBasket();
            });

        return false;
    });

    // Updating the quantity for an existing item in the basket.
    $(document).on('submit', '.item-price-qty-info form', function(e) {
        e.preventDefault();

        var productId = $(this).find('input[type=hidden]').val();
        var quantity = $(this).find('input[type=number]').val();
        var url = $(this).attr('action');

        $.post(url, {productId: productId, quantity: quantity}).
            done(function() {
                fetchBasket();
        });

        return false;
    });

    // Function for retrieving the contents of the user's basket.
    function fetchBasket() {
        $.ajax({
            method: 'GET',
            url: '/basket/get',
            dataType: 'json',
            success: function(data) {
                // Clear basket contents.
                $('#basket-contents').empty();

                // Variable for storing the total cost of items in the basket.
                var basketTotal = 0.00;

                // Check if there are any items in the basket.
                if (data['basket'].length != null) {
                    // Append new 'basket-item' div elements to the basket for each product.
                    console.log(data['basket']);
                    $.map(data['basket'], function(post, i) {
                        var basketItem = '<div class="basket-item">' +
                            '<div class="item-main-info">' +
                                '<img src="' + data['basket'][i].imageUrl + '" alt="' + data['basket'][i].name + '">' +
                                '<a class="product-name" href="/product?id=' + data['basket'][i].productId + '"><h4>' + data['basket'][i].name + '</h4></a>' +
                                '<form action="/basket/remove" method="post">' +
                                '   <input type="hidden" value="' + data['basket'][i].productId + '">' +
                                '   <button class="delete-button"><i class="fas fa-trash-alt"></i></button>' +
                                '</form>' +
                            '</div>' +
                            '<div class="item-price-qty-info">' +
                                '<form action="/basket/update" method="post">' +
                                    '<input type="hidden" value="' + data['basket'][i].productId + '">' +
                                    '<label><b>Qty</b></label>' +
                                    '<input type="number" min="1" max="99" value="' + data['basket'][i].quantity + '">' + 
                                    '<button class="update-button"><i class="fas fa-sync"></i></button>' +
                                '</form>' +
                                '<p>£' + (data['basket'][i].price*data['basket'][i].quantity).toFixed(2) + '</p>' +
                            '</div>' +
                        '</div>' +
                        '<hr>';
    
                        // Calculate the total cost of the basket.
                        basketTotal = basketTotal + data['basket'][i].price*data['basket'][i].quantity;

                        // Append the div to the basket.
                        $('#basket-contents').append(basketItem);
                    });

                    // Update basket total with current value of basketTotal.
                    $('.basket-total').find('p').html('<b>TOTAL</b>: £' + basketTotal.toFixed(2));
                }
                else {
                    // Append a message saying that the user has no items in their basket.
                    $('#basket-contents').append('<p class="msg">You have not added any items to your basket.</p><hr>');

                    // Update basket total with current value of basketTotal.
                    $('.basket-total').find('p').html('<b>TOTAL</b>: £' + basketTotal.toFixed(2));
                }
            }
        });
    }
    
    // Function for returning search results according to what was typed in the search bar.
    $('#search-box').on('input', 'form', function(e) {
        e.preventDefault();
    
        var search = $('#search').val();
        var url = "/search";

        $.get(url, {search: search})
            .done(function(data) {
                console.log(data['results']);
                // Clear predictive search contents.
                $('#search-box #search-results').empty();

                $.map(data['results'], function(get, i) {
                    if (i < 5)
                        $('#search-box #search-results').append('<button class="result">' + data['results'][i]  + '</button>');
                });
            });
    });

    $('#search-box').on('click', '.result', function() {
        // Fill search bar with contents from selected result.
        $('#search-box form #search').val($(this).text());

        // Clear predictive search contents.
        $('#search-box #search-results').empty();
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

    $(document).ready(function() {
        $('#basket-contents .msg').text('Fetching your basket...');
        fetchBasket();
    });
});