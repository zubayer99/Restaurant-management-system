$(document).ready(function(){
    function toggleNavbarMethod() {
        if ($(window).width() > 992) {
            $('.navbar .dropdown').on('mouseover', function () {
                $('.dropdown-toggle', this).trigger('click');
            }).on('mouseout', function () {
                $('.dropdown-toggle', this).trigger('click').blur();
            });
        } else {
            $('.navbar .dropdown').off('mouseover').off('mouseout');
        }
    }
    toggleNavbarMethod();
    $(window).resize(toggleNavbarMethod);


    // Main carousel
    $(".carousel .owl-carousel").owlCarousel({
        autoplay: true,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        items: 1,
        smartSpeed: 300,
        dots: false,
        loop: true,
        nav : false
    });


    /*increase cart counter in menu page*/

    $('.increase-cart-counter').click(function(){
        var count = $(this).siblings('.form-control').val();
        count++;
        $(this).siblings('.form-control').val(count);
    });
    $('.decrease-cart-counter').click(function(){
        var count = $(this).siblings('.form-control').val();
        count--;
        $(this).siblings('.form-control').val(count);
    });
});