$(document).ready(function() {

	// Кнопка на верх
    $(function() {
        $(window).scroll(function() {
            if($(this).scrollTop() != 0) {
                $('#toTop').fadeIn();
            } else {
                $('#toTop').fadeOut();
            }
        });
        $('#toTop').click(function() {
            $('body,html').animate({scrollTop:0},800);
        });
    });

	// PARALAX

    $(document).ready(function(){
        $window = $(window);
        $('body[data-type="background"]').each(function(){
         var $bgobj = $(this);
         $(window).scroll(function() {
            var yPos = -($window.scrollTop() / $bgobj.data('speed')); 
            var coords = '45% '+ yPos + 'px';
            $bgobj.css({ backgroundPosition: coords });
        }); 
     });    
    });

    // MMENU

    $(function() {
        $('nav#menu').mmenu({
            extensions  : [ 'fx-listitems-slide', 'fx-panels-zoom', 'fx-listitems-slide', 'multiline', 'shadow-page', 'shadow-panels', 'listview-large', 'pagedim-black' ]
        });
    });

    $(function() {
        $('.mm-navbar .mm-title').text('Меню');
    });

    // slider

    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:false,
        autoplay:true,
        smartSpeed:2000,
        autoplayTimeout:5000,
        dots:true,
        stopOnHover:true,
        navigationText:["",""],
        rewindNav:true,
        pagination:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });

    // fancybox

    $(".fancybox").fancybox();

});