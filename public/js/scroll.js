/* Scroll percentage code from: https://codepen.io/achudars/pen/Cpast */
$(document).ready(function() {
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
});