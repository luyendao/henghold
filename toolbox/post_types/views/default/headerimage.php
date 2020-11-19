<?php 

?>
					<div class="meta-box">
						
						<div class="image-uploader whole">

							<div class="pad">
								<div class="image-uploader-container">
									<div class="img">
										<img class="browse" rel="META[header_image]" description="click to select/upload and image" src="<?=$header_image!='' ? $header_image : $default_header_image?>" />
									</div>
								</div>
								<input type="hidden" name="META[header_image]" value="<?=$header_image?>"/>
							</div>
							<div class="buttom-buttons"> 
								<button class="clear-header">clear</button>
								<span class="info">Click the image above to upload a header image for this page.</span>
							</div>

						</div>
					</div>

<script>
jQuery(window).ready(function($){
	$('.clear-header').click(function(e){
		e.preventDefault();
		$('.browse').attr('src','<?=$default_header_image?>');
		$('input[name="META[header_image]"]').val('');
	});
});
</script>