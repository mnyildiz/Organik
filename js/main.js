var swiper1 = new Swiper(".main-slider .mySwiper ", {
 
  slidesPerView:1,


  speed:1500,
 effect:'fade',
      fadeEffect: { crossFade: true },
 autoplay: {
       delay: 2500,
       disableOnInteraction: false,
     },
  
  pagination: {
          el: ".swiper-pagination",
      clickable : true
        },
  breakpoints: {
     0: {
       slidesPerView: 1,

     },
     768: {
       slidesPerView: 1,
     
     },
     1024: {
       slidesPerView: 1,
    
     },
   }

   });


var swiper1 = new Swiper(".main-services .mySwiper ", {
 
  slidesPerView:5.8,
  spaceBetween: 20,
    loop:true,
  speed:1500,
 
 autoplay: {
       delay: 2500,
       disableOnInteraction: false,
     },
  
  pagination: {
          el: ".swiper-pagination",
      clickable : true
        },
  breakpoints: {
     0: {
       slidesPerView: 2,
       spaceBetween: 20,
     },
     768: {
       slidesPerView: 2,
       spaceBetween: 10,
     },
     1024: {
       slidesPerView: 5.8,
       spaceBetween: 20,
     },
   }

   });

var swiper1 = new Swiper(".services-bottom .mySwiper ", {
 
  slidesPerView:5,
  spaceBetween: 0,
    loop:true,
  speed:1500,
 
 autoplay: {
       delay: 2500,
       disableOnInteraction: false,
     },
  
  pagination: {
          el: ".swiper-pagination",
      clickable : true
        },
  breakpoints: {
     0: {
       slidesPerView: 1,
       spaceBetween: 0,
     },
     768: {
       slidesPerView: 2,
       spaceBetween: 0,
     },
     1024: {
       slidesPerView: 5,
       spaceBetween: 0,
     },
   }

   });

var swiper1 = new Swiper(".main-news .mySwiper ", {
 
  slidesPerView:1,
    loop:true,
  speed:1500,
 
 autoplay: {
       delay: 2500,
       disableOnInteraction: false,
     },
    effect: 'fade',
    fadeEffect: { crossFade: true },
  
  pagination: {
          el: ".swiper-pagination",
      clickable : true
        },
    navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
  breakpoints: {
     0: {
       slidesPerView: 1,

     },
     768: {
       slidesPerView: 1,

     },
     1024: {
       slidesPerView: 1,
       
     },
   }

   });


var swiper1 = new Swiper(".banner-slider .mySwiper ", {
 
  slidesPerView:1.4,
  spaceBetween: 50,
    loop:true,
  speed:1500,
    parallax: true,
 
 autoplay: {
       delay: 2500,
       disableOnInteraction: false,
     },
  navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
  pagination: {
          el: ".swiper-pagination",
      clickable : true
        },
  breakpoints: {
     0: {
       slidesPerView: 1,
       spaceBetween: 10,
     },
     768: {
       slidesPerView: 1,
       spaceBetween: 10,
     },
     1024: {
       slidesPerView: 1.4,
       spaceBetween: 50,
     },
   }

   });



var swiper1 = new Swiper(".news-slider .mySwiper ", {
 
  slidesPerView:1.4,
  spaceBetween: 50,
    loop:true,
  speed:1500,
    parallax: true,
 
 autoplay: {
       delay: 2500,
       disableOnInteraction: false,
     },
  navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
  pagination: {
          el: ".swiper-pagination",
      clickable : true
        },
  breakpoints: {
     0: {
       slidesPerView: 1,
       spaceBetween: 10,
     },
     768: {
       slidesPerView: 1,
       spaceBetween: 10,
     },
     1024: {
       slidesPerView: 1.4,
       spaceBetween: 50,
     },
   }

   });


// References: ten logos per page, with independent navigation.
$('.reference-carousel').each(function () {
    var carousel = this;
    var slider = carousel.querySelector('.reference-swiper');
    var multiplePages = slider.querySelectorAll('.swiper-slide').length > 1;
    var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var references = new Swiper(slider, {
        slidesPerView: 1,
        spaceBetween: 24,
        loop: multiplePages,
        speed: reducedMotion ? 0 : 1800,
        watchOverflow: true,
        autoplay: multiplePages && !reducedMotion ? {
            delay: 6000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true
        } : false,
        navigation: {
            prevEl: carousel.querySelector('.reference-prev'),
            nextEl: carousel.querySelector('.reference-next')
        },
        a11y: {
            prevSlideMessage: carousel.querySelector('.reference-prev') ? carousel.querySelector('.reference-prev').getAttribute('aria-label') : '',
            nextSlideMessage: carousel.querySelector('.reference-next') ? carousel.querySelector('.reference-next').getAttribute('aria-label') : ''
        }
    });
    carousel.addEventListener('focusin', function () {
        references.autoplay.stop();
    });
    carousel.addEventListener('focusout', function (event) {
        if (multiplePages && !reducedMotion && !carousel.contains(event.relatedTarget)) {
            references.autoplay.start();
        }
    });
});

$('.menu .toggle').click(function(){
    $(this).toggleClass('active');
    $('.menu-box').toggleClass('active');
})

$('.menu-list ul li .open').click(function(e){
    $(this).next().slideToggle();
    e.preventDefault();
});


$('.services-tab .tab-content').filter(':first').show();
$('.s-menu ul li').click(function(){
    $('.s-menu ul li').removeClass('active');
    var dgr = $(this).index();
    $(this).addClass('active');
    $('.services-tab .tab-content').hide().eq(dgr).show();
})
$('.s-menu ul li a').click(function(e){
    e.preventDefault();
})

AOS.init();

$(document).ready(function() {
    $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,

        fixedContentPos: false
    });
});


$('.search').click(function(){
    $('.search-box').addClass('active');
})

$('.search-box .clos').click(function(){
    $('.search-box').removeClass('active');
})

 $('video').on('ended', function () {
  this.load();
  this.play();
});



