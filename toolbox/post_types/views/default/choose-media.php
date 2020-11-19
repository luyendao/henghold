<div class="meta-box selfclear">

	<div>
		<div class="pad">

			<div class="one-third left">
				<input id="media_slideshow" type="checkbox" name="META[media][slideshow]" <?=isset($media->slideshow) && $media->slideshow ?'checked': null?> />
				<label for="media_slideshow">Slideshow</label>
			</div>
			
			<div class="one-third left">
				<input id="media_image" type="checkbox" name="META[media][image]" <?=isset($media->image) && $media->image ?'checked': null?> />
				<label for="media_image">Top Image</label>
			</div>			

		</div>
	</div>
	
</div>

<script>
jQuery(window).ready(function($){
	if($('input#media_slideshow').is(':checked')){
		$('#page_page-slider_meta').show();
	}else{
		$('#page_page-slider_meta').hide();
	}
	if($('input#media_image').is(':checked')){
		$('#page_HeaderImage_meta').show();
	}else{
		$('#page_HeaderImage_meta').hide();
	}
	$('input#media_slideshow').click(function(e){
		$('#page_page-slider_meta').slideToggle();
	});
	$('input#media_image').click(function(e){
		$('#page_HeaderImage_meta').slideToggle();
	});
});
</script>