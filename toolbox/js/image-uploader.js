
jQuery(window).ready(function($){
	
	$('.image-uploader .browse').wpfiles(function(file){
		$(this).attr('src',file);
	});

	$('.image-uploader button.clear').click(function(e){
		e.preventDefault();
		var name = $(this).attr('rel');
		$('input[name="'+name+'"]').val('');
		$('img[rel="'+name+'"]').attr('src',imgdefault)
	});
	
});