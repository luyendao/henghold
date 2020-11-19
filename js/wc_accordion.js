jQuery(window).ready(function($){
	$('.accordion li .toggle').click(function(e){
	    e.preventDefault();
	    $(this).parents('li').toggleClass('active');
	    $current = $(this).parents('li');
	    $('.accordion li').each(function(i,el){
	        if(el!=$current[0]) $(el).removeClass('active');
	    });

	    if($current.hasClass('active'))
	    	$current.find('div.accordion-content').slideDown();
	    else
	    	$current.find('div.accordion-content').slideUp();

	});
});