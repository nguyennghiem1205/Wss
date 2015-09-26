var Global = {
    fixedMenu: function() {
        var offsetTop = $('.banner').offset().top;
        var heightMenu = $('.banner').height();
        $(window).scroll(function() {
            if ($(this).scrollTop() >= offsetTop) {
                $('body').addClass('fixedMenu');

            } else {
                $('body').removeClass('fixedMenu');

            }
        })
    }
};

$(document).ready(function() {
    Global.fixedMenu();
});