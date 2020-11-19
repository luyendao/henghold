/* Show/Hide the Get In Touch Div */

jQuery(document).ready(function($){

    // $('.carousel').carousel();

	if($('.carousel').length > 0){
	    $('.carousel').carousel({
	        'pause' : 'hover',
	        'interval' : $slider_interval
	    });
	}

    $('.accordion-video').click(function() {
        video = '<iframe width="'+ $(this).width() +'" height="'+ $(this).height() +'" src="'+ $(this).attr('data-video') +'" frameborder="0" allowfullscreen class="player-vid"></iframe>';
        $(this).replaceWith(video);
    });
    
    //this makes the click work on touch 
    $('.container-fluid.main.home .span3').on('click',function(){});
    
    // swipes for mobile
    $('.carousel').touchSwipeLeft(function() {
    	$('.carousel').carousel('next')
    });
    
    $('.carousel').touchSwipeRight(function() {
    	$('.carousel').carousel('prev')
    });    

    $('.slide-video').click(function(){
        video = '<iframe width="'+ $(this).width() +'" height="'+ $(this).height() +'" src="'+ $(this).attr('data-video') +'" frameborder="0" allowfullscreen class="player-vid" data-img="'+ $(this).attr('src') +'"></iframe>';
        $(this).hide();
        $(this).parent('.video-wrap').addClass('video');
        $(this).parent('.video-wrap').append(video);
        $('.carousel').carousel('pause'); 
    });    

    $('.carousel').bind('slid',function(){
        $('.carousel .item').each(function(index,el){
            if($(el).hasClass('active')) $($('.carousel-indicators li')[index]).addClass('active');
            if($(el).find('iframe').length > 0){
            	$(this).find('.video-wrap').removeClass('video')
            	$(el).find('img').show();
            	$(el).find('iframe').remove();
            	$('.carousel').carousel('cycle');
            }
        });
    });

    $('.carousel').bind('slide', function() {
        $('.carousel-indicators li').removeClass('active');
    });

    $('.carousel-indicators li').click(function(e) {
        e.preventDefault();
        $($(this).attr('href')).carousel(Number($(this).attr('data-slide-to')));

        // var myPlayer = $('.player-vid');
        // myPlayer.stopVideo();
    });

    // main navigation dropdown
    $('.btn-nav').click(function(e) {
        e.preventDefault();
        $('nav.main ul').slideToggle();
    });

    // sub navigation dropdown
    $('.sub-nav-btn').click(function(e) {
        e.preventDefault();
        $(this).next('ul').slideToggle();
        //$('.sub-nav ul').slideToggle();
    });
    
    $(window).on('scroll resize', function() {
    	var scrollTop = $('header.main').height();
    	if($(this).width() < 979){
	        if($(window).scrollTop() >= scrollTop){
				$('nav.main').addClass('navbar-fixed-top');
				$('nav.sub-nav').addClass('fixed');
	        }
	        if($(window).scrollTop() < scrollTop){
				$('nav.main').removeClass('navbar-fixed-top'); 
				$('nav.sub-nav').removeClass('fixed')
	        }			    	
		}else{
			$('nav.main').removeClass('navbar-fixed-top'); 
			$('nav.sub-nav').removeClass('fixed')
		}
	});
});
