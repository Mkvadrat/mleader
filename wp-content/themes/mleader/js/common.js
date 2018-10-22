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
    
     $("[data-fancybox]").fancybox();

    // Плавный скролл до якоря
    $("a.ancLinks").click(function () {
        var elementClick = $(this).attr("href");
        var destination = $(elementClick).offset().top;
        $('html,body').animate( { scrollTop: destination }, 1100 );
        return false;
    });
    
    $(window).load(function(){
        $('#submit1').prop('disabled', true);
    });
    
    $(window).load(function(){
        $('#submit2').prop('disabled', true);
    });
    
    $(window).load(function(){
        $('#submit3').prop('disabled', true);
    });
    
    $(window).load(function(){
        $('#submit4').prop('disabled', true);
    });
    
    $(window).load(function(){
        $('#submit5').prop('disabled', true);
    });
    
    $(window).load(function(){
        $('#submit6').prop('disabled', true);
    });
    
    $(window).load(function(){
        $('#submit7').prop('disabled', true);
    });
    
    $(window).load(function(){
        $('#submit8').prop('disabled', true);
    });
    
    $(window).load(function(){
        $('#submit9').prop('disabled', true);
    });
    
    $(window).load(function(){
        $('#submit10').prop('disabled', true);
    });
    
    $('input[name=\'user_avl_a[]\']').click(function() {
        if($(this).is(':checked')) {
            $('#submit1').prop('disabled', false).addClass('active-button');
            $(this).parent('label').addClass('checked');
        } else {
            $('#submit1').prop('disabled', true).removeClass('active-button');
            $(this).parent('label').removeClass();
        }
    });
    
    $('input[name=\'user_avl_b[]\']').click(function() {
        if($(this).is(':checked')) {
            $('#submit2').prop('disabled', false).addClass('active-button');
            $(this).parent('label').addClass('checked');
        } else {
            $('#submit2').prop('disabled', true).removeClass('active-button');
            $(this).parent('label').removeClass();
        }
    });
    
    $('input[name=\'user_avl_c[]\']').click(function() {
        if($(this).is(':checked')) {
            $('#submit3').prop('disabled', false).addClass('active-button');
            $(this).parent('label').addClass('checked');
        } else {
            $('#submit3').prop('disabled', true).removeClass('active-button');
            $(this).parent('label').removeClass();
        }
    });
    
    $('input[name=\'user_avl_d[]\']').click(function() {
        if($(this).is(':checked')) {
            $('#submit4').prop('disabled', false).addClass('active-button');
            $(this).parent('label').addClass('checked');
        } else {
            $('#submit4').prop('disabled', true).removeClass('active-button');
            $(this).parent('label').removeClass();
        }
    });
    
    $('input[name=\'user_avl_e[]\']').click(function() {
        if($(this).is(':checked')) {
            $('#submit5').prop('disabled', false).addClass('active-button');
            $(this).parent('label').addClass('checked');
        } else {
            $('#submit5').prop('disabled', true).removeClass('active-button');
            $(this).parent('label').removeClass();
        }
    });
    
    $('input[name=\'user_avl_f[]\']').click(function() {
        if($(this).is(':checked')) {
            $('#submit6').prop('disabled', false).addClass('active-button');
            $(this).parent('label').addClass('checked');
        } else {
            $('#submit6').prop('disabled', true).removeClass('active-button');
            $(this).parent('label').removeClass();
        }
    });
    
    $('input[name=\'user_avl_g[]\']').click(function() {
        if($(this).is(':checked')) {
            $('#submit7').prop('disabled', false).addClass('active-button');
            $(this).parent('label').addClass('checked');
        } else {
            $('#submit7').prop('disabled', true).removeClass('active-button');
            $(this).parent('label').removeClass();
        }
    });
    
    $('input[name=\'user_avl_h[]\']').click(function() {
        if($(this).is(':checked')) {
            $('#submit8').prop('disabled', false).addClass('active-button');
            $(this).parent('label').addClass('checked');
        } else {
            $('#submit8').prop('disabled', true).removeClass('active-button');
            $(this).parent('label').removeClass();
        }
    });
    
    $('input[name=\'user_avl_i[]\']').click(function() {
        if($(this).is(':checked')) {
            $('#submit9').prop('disabled', false).addClass('active-button');
            $(this).parent('label').addClass('checked');
        } else {
            $('#submit9').prop('disabled', true).removeClass('active-button');
            $(this).parent('label').removeClass();
        }
    });
    
    $('input[name=\'user_avl_j[]\']').click(function() {
        if($(this).is(':checked')) {
            $('#submit10').prop('disabled', false).addClass('active-button');
            $(this).parent('label').addClass('checked');
        } else {
            $('#submit10').prop('disabled', true).removeClass('active-button');
            $(this).parent('label').removeClass();
        }
    });
});