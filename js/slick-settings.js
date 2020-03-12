jQuery(document).ready(function($){

    // Hero banner slider
    $('.slider').slick({
        arrow: false,
        dots: false,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 5000, // speed is in milliseconds
        speed: 300
    });

    // Award slider
    $('.award-slider').slick({
        arrow: true,
        dots: false,
        infinite: true,
        centerPadding: '40px',
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 5000, // speed is in milliseconds
        speed: 300,
        // responsive: [
        //     {
        //       breakpoint: 768,
        //       settings: {
        //         centerMode: true,
        //         // centerPadding: '40px',
        //         slidesToShow: 3
        //       }
        //     }
        //   ]
    });


});