(function ($) {
    $(document).ready(function() {
        // $('.view-slideshow .view-content').slick({
        //     infinite: false,
        //     speed: 300,
        //     slidesToShow: 3,
        //     slidesToScroll: 1,
        //     arrows: true,
        //     responsive: [
        //         {
        //             breakpoint: 1024,
        //             settings: {
        //                 slidesToShow: 3,
        //                 slidesToScroll: 1,
        //             }
        //         },
        //         {
        //             breakpoint: 600,
        //             settings: {
        //                 slidesToShow: 2,
        //                 slidesToScroll: 2
        //             }
        //         },
        //         {
        //             breakpoint: 480,
        //             settings: {
        //                 slidesToShow: 1,
        //                 slidesToScroll: 1
        //             }
        //         }
        //     ]
        // });

        $("#example-basic").steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slideLeft",
            autoFocus: true
        });
        console.log('1111');

    });
})(jQuery);