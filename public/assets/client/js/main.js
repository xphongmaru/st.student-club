(function(window, document, $, undefined) {
    'use strict';

    $(window).on("load", function () {
        $(".preloader").fadeOut();
    });

    setTimeout(function () {
        $(".preloader").fadeOut();
    }, 1000);

    // Khi bất kỳ modal nào mở
    $('.modal').on('show.bs.modal', function () {
        $('html').addClass('scrollbar-hidden');
    });

    // Khi tất cả modal đều đóng
    $('.modal').on('hidden.bs.modal', function () {
        // Kiểm tra nếu không còn modal nào mở nữa thì mới remove
        if ($('.modal.show').length === 0) {
            $('html').removeClass('scrollbar-hidden');
        }
    });

    $('#owl-demo').owlCarousel({
        loop: false,
        items: 4,
        margin: 10,
        nav: false,
        navText : ['<i data-feather="arrow-left-circle"></i>','<i data-feather="arrow-right-circle"></i>'],
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        fade: true,
        transitionStyle: "fade",
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        responsive:{
            0: {
                items: 1,
                margin: 15
            },
            320: {
                items: 2,
                margin: 15
            },
            479: {
                items: 2,
                margin: 15
            },
            540: {
                items: 2,
                margin: 15
            },
            750: {
                items: 2,
                margin: 15
            },
            768: {
                items: 2
            },
            979: {
                items: 3
            },
            1199: {
                items: 4
            },
            1399: {
                items: 4
            },
            1599: {
                items: 4
            }
        }

    });


    // $(document).ready(function() {
        $('#item1').click(function() {
            $('#item1').addClass('active');
            $('#item2').removeClass('active');
            $('#item3').removeClass('active');
            $('#item4').removeClass('active');
            $('#item5').removeClass('active');
        });

        $('#item2').click(function() {
            $('#item2').addClass('active');
            $('#item1').removeClass('active');
            $('#item3').removeClass('active');
            $('#item4').removeClass('active');
            $('#item5').removeClass('active');
        });

        $('#item3').click(function() {
             $('#item3').addClass('active');
            $('#item1').removeClass('active');
            $('#item2').removeClass('active');
            $('#item4').removeClass('active');
            $('#item5').removeClass('active');
        });

        $('#item4').click(function() {
            $('#item4').addClass('active');
            $('#item1').removeClass('active');
            $('#item2').removeClass('active');
            $('#item3').removeClass('active');
            $('#item5').removeClass('active');
        });
        $('#item5').click(function() {
            $('#item5').addClass('active');
            $('#item1').removeClass('active');
            $('#item2').removeClass('active');
            $('#item3').removeClass('active');
            $('#item4').removeClass('active');
        });

    // });

    var doobJs = {
        i: function(e) {
            doobJs.d();
            doobJs.methods();
        },

        d: function(e) {
            this._window = $(window),
                this._document = $(document),
                this._body = $('body'),
                this._html = $('html')
        },

        methods: function(e) {
            doobJs.smothScroll();
            doobJs.backToTopInit();
            doobJs.backToTopInit();
            doobJs.counterUpActivation();
            doobJs.wowActivation();
            doobJs.headerTopActivation();
            doobJs.headerSticky();
            doobJs.salActive();
            doobJs.popupMobileMenu();
            doobJs.masonryActivation();
            doobJs.magnigyPopup();
            doobJs.lightBoxJs();
            doobJs.slickSliderActivation();
            doobJs.radialProgress();
            doobJs.contactForm();
            doobJs.menuCurrentLink();
            doobJs.onePageNav();
            doobJs.darkLight();
        },

        menuCurrentLink: function() {
            var currentPage = location.pathname.split("/"),
                current = currentPage[currentPage.length - 1];
            $('.mainmenu li a').each(function() {
                var $this = $(this);
                if ($this.attr('href') === current) {
                    $this.addClass('active');
                    $this.parents('.has-menu-child-item').addClass('menu-item-open')
                }
            });
        },

        smothScroll: function() {
            $(document).on('click', '.smoth-animation', function(event) {
                event.preventDefault();
                $('html, body').animate({
                    scrollTop: $($.attr(this, 'href')).offset().top - 50
                }, 300);
            });
        },


        lightBoxJs: function() {
            lightGallery(document.getElementById('animated-lightbox'), {
                thumbnail: true,
                animateThumb: false,
                showThumbByDefault: false,
                cssEasing: 'linear'
            });

            lightGallery(document.getElementById('animated-lightbox2'), {
                thumbnail: true,
                animateThumb: false,
                showThumbByDefault: false,
                cssEasing: 'linear'
            });

            lightGallery(document.getElementById('animated-lightbox3'), {
                thumbnail: true,
                animateThumb: false,
                showThumbByDefault: false,
                cssEasing: 'linear'
            });
        },

        magnigyPopup: function() {
            $(document).on('ready', function() {
                $('.popup-video').magnificPopup({
                    type: 'iframe'
                });
            });
        },

        masonryActivation: function name(params) {
            $(window).load(function() {
                $('.masonary-wrapper-activation').imagesLoaded(function() {
                    // filter items on button click
                    $('.messonry-button').on('click', 'button', function() {
                        var filterValue = $(this).attr('data-filter');
                        $(this).siblings('.is-checked').removeClass('is-checked');
                        $(this).addClass('is-checked');
                        $grid.isotope({
                            filter: filterValue
                        });
                    });

                    // init Isotope
                    var $grid = $('.mesonry-list').isotope({
                        percentPosition: true,
                        transitionDuration: '0.7s',
                        layoutMode: 'masonry',
                        masonry: {
                            columnWidth: '.resizer',
                        }
                    });
                });
            })
        },


        popupMobileMenu: function(e) {
            $('.hamberger-button').on('click', function(e) {
                $('.popup-mobile-menu').addClass('active');
            });

            $('.close-menu').on('click', function(e) {
                $('.popup-mobile-menu').removeClass('active');
                $('.popup-mobile-menu .mainmenu .has-droupdown > a, .popup-mobile-menu .mainmenu .with-megamenu > a').siblings('.submenu, .rainbow-megamenu').removeClass('active').slideUp('400');
                $('.popup-mobile-menu .mainmenu .has-droupdown > a, .popup-mobile-menu .mainmenu .with-megamenu > a').removeClass('open')
            });

            $('.popup-mobile-menu .mainmenu .has-droupdown > a, .popup-mobile-menu .mainmenu .with-megamenu > a').on('click', function(e) {
                e.preventDefault();
                $(this).siblings('.submenu, .rainbow-megamenu').toggleClass('active').slideToggle('400');
                $(this).toggleClass('open')
            })

            $('.popup-mobile-menu, .popup-mobile-menu .mainmenu.onepagenav li a').on('click', function(e) {
                e.target === this && $('.popup-mobile-menu').removeClass('active') && $('.popup-mobile-menu .mainmenu .has-droupdown > a, .popup-mobile-menu .mainmenu .with-megamenu > a').siblings('.submenu, .rainbow-megamenu').removeClass('active').slideUp('400') && $('.popup-mobile-menu .mainmenu .has-droupdown > a, .popup-mobile-menu .mainmenu .with-megamenu > a').removeClass('open');
            });
        },



        slickSliderActivation: function() {
            $('.testimonial-activation').not('.slick-initialized').slick({
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true,
                arrows: true,
                adaptiveHeight: true,
                cssEase: 'linear',
                prevArrow: '<button class="slide-arrow prev-arrow"><i data-feather="arrow-left"></i></button>',
                nextArrow: '<button class="slide-arrow next-arrow"><i data-feather="arrow-right"></i></button>'
            });

            $('.slider-activation').not('.slick-initialized').slick({
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true,
                arrows: true,
                adaptiveHeight: true,
                cssEase: 'linear',
                autoplay: true,
                autoplaySpeed:3000,
                prevArrow: '<button class="slide-arrow prev-arrow text-white"><i data-feather="arrow-left"></i></button>',
                nextArrow: '<button class="slide-arrow next-arrow text-white"><i data-feather="arrow-right"></i></button>'
            });

            $('.blog-carousel-activation').not('.slick-initialized').slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                dots: true,
                arrows: false,
                adaptiveHeight: true,
                cssEase: 'linear',
                responsive: [{
                        breakpoint: 769,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 581,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });

            $('.brand-carousel-activation').not('.slick-initialized').slick({
                infinite: true,
                slidesToShow: 6,
                slidesToScroll: 1,
                dots: true,
                arrows: true,
                adaptiveHeight: true,
                cssEase: 'linear',
                prevArrow: '<button class="slide-arrow prev-arrow"><i class="feather-arrow-left"></i></button>',
                nextArrow: '<button class="slide-arrow next-arrow"><i class="feather-arrow-right"></i></button>',
                responsive: [{
                        breakpoint: 769,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 581,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                ]
            });

            $('.brand-carousel-init').not('.slick-initialized').slick({
                infinite: true,
                slidesToShow: 5,
                slidesToScroll: 1,
                dots: false,
                arrows: true,
                adaptiveHeight: true,
                cssEase: 'linear',
                prevArrow: '<button class="slide-arrow prev-arrow"><i class="feather-arrow-left"></i></button>',
                nextArrow: '<button class="slide-arrow next-arrow"><i class="feather-arrow-right"></i></button>',
                responsive: [{
                        breakpoint: 769,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 581,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                ]
            });


            $('.about-app-activation').not('.slick-initialized').slick({
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true,
                arrows: false,
                adaptiveHeight: true,
                cssEase: 'linear',
                prevArrow: '<button class="slide-arrow prev-arrow"><i class="feather-arrow-left"></i></button>',
                nextArrow: '<button class="slide-arrow next-arrow"><i class="feather-arrow-right"></i></button>',
            });



            $('.template-galary-activation').not('.slick-initialized').slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                dots: true,
                arrows: true,
                adaptiveHeight: true,
                cssEase: 'linear',
                centerMode: false,
                prevArrow: '<button class="slide-arrow prev-arrow"><i class="feather-arrow-left"></i></button>',
                nextArrow: '<button class="slide-arrow next-arrow"><i class="feather-arrow-right"></i></button>',
                responsive: [{
                        breakpoint: 769,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 581,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                        }
                    },
                ]
            });




        },

        salActive: function() {
            sal({
                threshold: 0.01,
                once: true,
            });
        },

        backToTopInit: function() {
            var scrollTop = $('.rainbow-back-top');
            $(window).scroll(function() {
                var topPos = $(this).scrollTop();
                if (topPos > 150) {
                    $(scrollTop).css('opacity', '1');
                } else {
                    $(scrollTop).css('opacity', '0');
                }
            });
            $(scrollTop).on('click', function() {
                $('html, body').animate({
                    scrollTop: 0,
                    easingType: 'linear',
                }, 10);
                return false;
            });
        },

        headerSticky: function() {
            $(window).scroll(function() {
                if ($(this).scrollTop() > 250) {
                    $('.header-sticky').addClass('sticky')
                } else {
                    $('.header-sticky').removeClass('sticky')
                }
            })
        },

        counterUpActivation: function() {
            $('.counter').counterUp({
                delay: 10,
                time: 1000
            });
        },

        wowActivation: function() {
            new WOW().init();
        },

        headerTopActivation: function() {
            $('.bgsection-activation').on('click', function() {
                $('.header-top-news').addClass('deactive')
            })
        },

        radialProgress: function() {
            $('.radial-progress').waypoint(function() {
                $('.radial-progress').easyPieChart({
                    lineWidth: 10,
                    scaleLength: 0,
                    rotate: 0,
                    trackColor: false,
                    lineCap: 'round',
                    size: 220
                });
            }, {
                triggerOnce: true,
                offset: 'bottom-in-view'
            });
        },


        contactForm: function() {
            $('.rainbow-dynamic-form').on('submit', function(e) {
                e.preventDefault();
                var _self = $(this);
                var __selector = _self.closest('input,textarea');
                _self.closest('div').find('input,textarea').removeAttr('style');
                _self.find('.error-msg').remove();
                _self.closest('div').find('button[type="submit"]').attr('disabled', 'disabled');
                var data = $(this).serialize();
                $.ajax({
                    url: 'mail.php',
                    type: "post",
                    dataType: 'json',
                    data: data,
                    success: function(data) {
                        _self.closest('div').find('button[type="submit"]').removeAttr('disabled');
                        if (data.code == false) {
                            _self.closest('div').find('[name="' + data.field + '"]');
                            _self.find('.rainbow-btn').after('<div class="error-msg"><p>*' + data.err + '</p></div>');
                        } else {
                            $('.error-msg').hide();
                            $('.form-group').removeClass('focused');
                            _self.find('.rainbow-btn').after('<div class="success-msg"><p>' + data.success + '</p></div>');
                            _self.closest('div').find('input,textarea').val('');

                            setTimeout(function() {
                                $('.success-msg').fadeOut('slow');
                            }, 5000);
                        }
                    }
                });
            });
        },

        onePageNav: function() {
            $('.onepagenav').onePageNav({
                currentClass: 'current',
                changeHash: false,
                scrollSpeed: 500,
                scrollThreshold: 0.2,
                filter: '',
                easing: 'swing',
            });
        },

        darkLight: function() {
            var styleMode = document.querySelector('meta[name="theme-style-mode"]').content;
            var cookieKey = styleMode == 1 ? 'client_dark_mode_style_cookie' : 'client_light_mode_style_cookie';
            if (Cookies.get(cookieKey) == 'dark') {
                $('body').removeClass('active-light-mode');
                $('body').addClass('active-dark-mode');

            } else if (Cookies.get(cookieKey) == 'light') {
                $('body').removeClass('active-dark-mode');
                $('body').addClass('active-light-mode');

            } else {
                if (styleMode == 1) {
                    $('body').addClass('active-dark-mode');
                } else {
                    $('body').addClass('active-light-mode');
                }

            }
        },
    }
    doobJs.i();

})(window, document, jQuery)
