// ON SCROLL HEADER EFFECT
$(function () {
    var changeHeader = 150;
    $(window).scroll(function () {
        var scroll = getCurrentScroll();
        if (scroll >= changeHeader) {
            $('.home-header').addClass('change-header');
        }
        else {
            $('.home-header').removeClass('change-header');
        }
    });

    function getCurrentScroll() {
        return window.pageYOffset || document.documentElement.scrollTop;
    }
});