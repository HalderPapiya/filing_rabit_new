(function($, window, Typist) {

    // Product Slider Slick
    $('.product_slider').slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 3,
        slidesToScroll: 3,
        prevArrow: $('.product_arrow .prev'),
        nextArrow: $('.product_arrow .next'),
        responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });


    //   Served Slider
    $('.served_slider').slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        prevArrow: $('.industry_arrow .prev'),
        nextArrow: $('.industry_arrow .next'),
        responsive: [{
                breakpoint: 991,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    /* ==================================================
                FAQ Accordion jQuery
    ================================================== */
    $(function() {
        $('.acc__title').click(function(j) {

            var dropDown = $(this).closest('.acc__card').find('.acc__panel');
            $(this).closest('.acc').find('.acc__panel').not(dropDown).slideUp();

            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
            } else {
                $(this).closest('.acc').find('.acc__title.active').removeClass('active');
                $(this).addClass('active');
            }

            dropDown.stop(false, true).slideToggle();
            j.preventDefault();
        });
    });

    $(function() {
        $('.tabs-nav li a').click(function() {

            // Check for active
            $('.tabs-nav li').removeClass('active');
            $(this).parent().addClass('active');
            // Display active tab
            let currentTab = $(this).attr('href');
            $('.tabs-content .tab-data').hide();
            $(currentTab).show();


            return false;
        });
    });





})(jQuery, window);