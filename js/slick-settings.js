jQuery(document).ready(function($){

    $('.slider').slick({
        arrow: true,
        dots: true,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 5000, // speed is in milliseconds
        speed: 300
    });

});