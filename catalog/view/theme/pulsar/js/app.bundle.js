$(document).ready(function() {
    $('parallax').height($(window).height());
    var hamburgerMenu = (function () {

        var menu = $('.header__menu');

        var init = function () {

            $('.hamburger-menu__link').on('click', _openMenu);
        };

        var _openMenu = function (e) {

              e.preventDefault();

            if ($(this).hasClass('active')) {

                $(this).removeClass('active');

                menu.slideUp();

            } else {

                $(this).addClass('active');

                menu.slideDown();

            }

        };
        return{

            init:init

        };

    })();
    if($('.hamburger-menu').length){

        $('.menu .menu__item:first-child').css('color', '#e64814');
        hamburgerMenu.init();
    }
    //slider
    if($('.slider').length){
        slider.init();
    };

    if($('.slider2').length){
        slider2.init();
    };
    if($('.product-sort').length){
        var sort_items = $('.product-sort__items');
        $('.product-sort__link').on('click', function (e) {

             e.preventDefault();
            if ($(this).hasClass('active')) {

                $(this).removeClass('active');

                sort_items.slideUp();

            } else {

                $(this).addClass('active');

                sort_items.slideDown();

            }

        });

        $('.product-sort__items').on('click', function (e) {
            e.preventDefault();

            $(this).slideUp();


        });
    };

    //окно фильтра
    //проверку
    $('.filter-catefory__byname').on('click', function (e) {

        e.preventDefault();
        el = $('#filter_name');
        el.find('.filter-box').css('display', 'block');
        el.css('display', 'block');

        //$('.filter-box-overlay').css('display', 'block');
        //$('.filter-box').css('display', 'block');


    });
    $('.filter-box__close').on('click', function (e) {
        e.preventDefault();

        $('.filter-box').slideUp();
        $('.filter-box').css('display', 'none');
        $('.filter-box-overlay').css('display', 'none');

    });


    $('.filter-catefory__bygost').on('click', function (e) {
        e.preventDefault();

        el = $('#filter_gost');
        el.find('.filter-box').css('display', 'block');
        el.css('display', 'block');


    });
    $('.filter-box__close').on('click', function (e) {
        e.preventDefault();

        $('.filter-box').slideUp();
        $('.filter-box').css('display', 'none');
        $('.filter-box-overlay').css('display', 'none');

    });

    //соц сети
    $('.social-share__link').on('click', function (e) {
        e.preventDefault();

        el = $('#social-share');

        if ($(this).hasClass('active')) {

            $(this).removeClass('active');
            $('.social-share').css('display', 'none');


        } else {

            $(this).addClass('active');

            $('.social-share').css('display', 'block');

        }




    });

    $('.social-share__link-footer').on('click', function (e) {
        e.preventDefault();


        if ($(this).hasClass('active')) {

            $(this).removeClass('active');
            $('.social-share2').css('display', 'none');


        } else {

            $(this).addClass('active');

            $('.social-share2').css('display', 'block');

        }




    });
    $('.catalog-filter-cat').on('click', function (e) {
        e.preventDefault();
        var element  = document.getElementById('catalog-filter-cat__arrow');
        var display =  element.currentStyle ? element.currentStyle.display :  getComputedStyle(element, null).display;


        if(display =='inline-block') {
            ShowCategoryList();
        }
    });
/*
    $('.catalog-filter-cat__arrow').one('click', function (e) {
        ShowCategoryList();
    });
    */
    function ShowCategoryList() {

        var catalog_list = $('.catalog-list');
        var $this = $('.catalog-filter-cat__arrow');
        if ($this.hasClass('active')) {

            $this.removeClass('active');
            catalog_list.slideUp();

        } else {

            $this.addClass('active');
            catalog_list.slideDown();

        }

    }



});

//slider
var slider  = (function () {
    var
        flag = true,
        timer = 0,
        timerDuration = 3000;
    return {
        init : function () {
            var _this = this;
            _this.createDots();
            //start auto switch
            _this.autoSwitch();

            $('.slider__controls-button').on('click', function (e) {

                e.preventDefault();
                var $this = $(this),
                    slides = $this.closest('.slider').find('.slider__item'),
                    activeSlide = slides.filter('.active'),
                    nextSlide = activeSlide.next(),
                    prevSlide = activeSlide.prev(),
                    firstSlide = slides.first(),
                    lastSlide = slides.last();


                _this.clearTimer();
                if($this.hasClass('slider__controls-button_next')){
                    if(!nextSlide.length) nextSlide = firstSlide;
                    _this.moveSlide(nextSlide, 'forward');

                }
                else if($('.slider__controls-button').hasClass('slider__controls-button_prev')){
                    if(!prevSlide.length) prevSlide = lastSlide;
                    _this.moveSlide(prevSlide, 'backward');
                }
            });
            $('.slider__dots-link').on('click', function (e) {
                e.preventDefault();
                _this.clearTimer();
                var $this = $(this),
                    dotItmes = $this.closest('.slider_dots').find('.slider__dots-item'),
                    activeDot = dotItmes.filter('.active'),
                    currentDot = $this.closest('.slider__dots-item'),
                    currentDonNumber = currentDot.index(),
                    direction =  activeDot.index() < currentDonNumber ? 'forward' : 'backward',
                    reqSlide =  $this.closest('.slider').find('.slider__item').eq(currentDonNumber);
                _this.moveSlide(reqSlide, direction);

            })
        },
        moveSlide: function (slide, direction) {

            var _this = this,
                container  = slide.closest('.slider'),
                slides = container.find('.slider__item'),
                activeSlide = slides.filter('.active'),
                slideWidth = slides.width(),
                dotsContainer = container.find('.slider_dots'),
                duration = 500,
                reqCssPosion = 0,
                reqSlideStrafe = 0;


            if(direction === 'forward'){
                reqCssPosion = slideWidth,
                    reqSlideStrafe = -slideWidth;
            }
            else if(direction === 'backward'){

                reqCssPosion = -slideWidth,
                    reqSlideStrafe = slideWidth;
            }
            slide.css('left', reqCssPosion).addClass('inslide');
            var movableSlide = slides.filter('.inslide');

            activeSlide.animate({left:reqSlideStrafe},duration);
            movableSlide.animate({left:0},duration, function () {
                slides.css('left', '0').removeClass('active');
                $(this).toggleClass('inslide active');
                _this.setActiveDots(dotsContainer);
            });


        },
        createDots : function () {

            var _this = this,
                container = $('.slider'),
                dotMarkup = '<li class="slider__dots-item">\
                            <a class = "slider__dots-link" href="#">\
                           </a></li> ';
            container.each(function () {
                var $this = $(this),
                    slides = $this.find('.slider__item'),
                    dotsContainer =  $this.find('.slider_dots');

                for (i = 0; i < slides.length; i++){
                    dotsContainer.append(dotMarkup);
                }
                _this.setActiveDots(dotsContainer);
            })


        },
        setActiveDots : function (container) {
            var slides = container.closest('.slider__list-wrap').find('.slider__item');
            container
                .find('.slider__dots-item')
                .eq(slides.filter('.active').index())
                .addClass('active')
                .siblings()
                .removeClass('active');
        },
        autoSwitch: function () {

            var _this = this;
            timer = setInterval(function () {
                var
                    slides = $('.slider__items .slider__item'),
                    activeSlide = slides.filter('.active'),
                    nextSlide = activeSlide.next(),
                    firstSlide = slides.first();

                if(!nextSlide.length) nextSlide = firstSlide;
                _this.moveSlide(nextSlide, 'forward');

            },timerDuration);

        },
        clearTimer: function () {
            if(timer){
                clearInterval(timer);
                this.autoSwitch();
            }
        }

    }

}());


var slider2  = (function () {
    var
        flag = true,
        timer = 0,
        timerDuration = 3000;
    return {
        init : function () {
            var _this = this;



            $('.slider2__controls-button').on('click', function (e) {
                console.log("clicked");
                e.preventDefault();
                var $this = $(this),
                    slides = $('.slider2').find('.slider__item'),
                    activeSlide = slides.filter('.active'),
                    nextSlide = activeSlide.next(),
                    prevSlide = activeSlide.prev(),
                    firstSlide = slides.first(),
                    lastSlide = slides.last();


               // _this.clearTimer();
                if($this.hasClass('slider2__controls-button_next')){
                    if(!nextSlide.length) nextSlide = firstSlide;
                    _this.moveSlide(nextSlide, 'forward');

                }
                else if($('.slider2__controls-button').hasClass('slider2__controls-button_prev')){
                    if(!prevSlide.length) prevSlide = lastSlide;
                    _this.moveSlide(prevSlide, 'backward');
                }
            });

        },
        moveSlide: function (slide, direction) {

            var _this = this,
                container  = $('.slider2'),
                slides = container.find('.slider__item'),
                activeSlide = slides.filter('.active'),
                slideWidth = slides.width(),
                dotsContainer = container.find('.slider_dots'),
                duration = 500,
                reqCssPosion = 0,
                reqSlideStrafe = 0;


            if(direction === 'forward'){
                reqCssPosion = slideWidth,
                    reqSlideStrafe = -slideWidth;
            }
            else if(direction === 'backward'){

                reqCssPosion = -slideWidth,
                    reqSlideStrafe = slideWidth;
            }
            slide.css('left', reqCssPosion).addClass('inslide');
            var movableSlide = slides.filter('.inslide');

            activeSlide.animate({left:reqSlideStrafe},duration);
            movableSlide.animate({left:0},duration, function () {
                slides.css('left', '0').removeClass('active');
                $(this).toggleClass('inslide active');

            });


        },


    }

}());

ymaps.ready(function () {
    var map = new ymaps.Map("map", {
        center: [55.777708, 37.649308],
        zoom: 15,
        controls: []
    });
    map.behaviors.disable('scrollZoom');
    // Создаём макет содержимого.
    MyIconContentLayout = ymaps.templateLayoutFactory.createClass(
        '<div style="color: #FFFFFF; font-weight: bold;">$[properties.iconContent]</div>'
    ),


        myPlacemark = new ymaps.Placemark([55.777708, 37.649308], {
            hintContent: 'ООО Пульсар',
            balloonContent: 'ООО Пульсар'
        }, {
            // Опции.
            // Необходимо указать данный тип макета.
            iconLayout: 'default#image',
            // Своё изображение иконки метки.
            iconImageHref: 'catalog/view/theme/pulsar/img/icons/pointer.svg',
            // Размеры метки.
            iconImageSize: [30, 42],
            // Смещение левого верхнего угла иконки относительно
            // её "ножки" (точки привязки).
            iconImageOffset: [-5, -38]
        });


    map.geoObjects.add(myPlacemark);


});
