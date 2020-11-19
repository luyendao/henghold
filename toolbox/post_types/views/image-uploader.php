<?php
	$defaultimg = isset($defaultimg) ? $defaultimg : get_stylesheet_directory_uri().'/toolbox/img/upload.png';
?>
					<div class="meta-box">
						<div class="image-uploader whole">
							<div class="pad">
								<div class="image-uploader-container">
									<div class="img">
										<img class="browse" rel="META[<?=$fieldname?>]" description="click to select/upload and image" src="<?=$$fieldname!='' ? $$fieldname : $defaultimg?>" />
									</div>
								</div>
								<input type="hidden" name="META[<?=$fieldname?>]" value="<?=$$fieldname?>"/>
							</div>
							<div class="pad">
								<button class="clear">clear</button>
								<span class="info">click the image above to upload or select an image.</span>
							</div>
						</div>
					</div>
<style>
	.image-uploader-container{
		background:#AAA;
		padding:20px;
	}
	.image-uploader-container .img{
		text-align:center;
	}
	.image-uploader-container .img img{
		border:1px solid #999;
	}
</style>
<script>
jQuery(window).ready(function($){
	
	$('.image-uploader .browse').wpfiles(function(file){
		$(this).attr('src',file);
	});

	$('.image-uploader button.clear').click(function(e){
		e.preventDefault();
		$('input[name="META[<?=$fieldname?>]"]').val('');
		$('img[rel="META[<?=$fieldname?>]"]').attr('src','<?= $defaultimg ?>')
	});
	
});
</script>