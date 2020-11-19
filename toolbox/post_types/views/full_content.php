<?php
	$teeny = isset($teeny) ? $teeny : false;
	$media = isset($media) ? $media : true;
?>
					<div class="meta-box">
						<div class=" whole">
							<div class="pad">
								<?php wp_editor($this->post->post_content, 'content', array('teeny'=>$teeny,'media_buttons'=>$media)); ?>
							</div>
						</div>
					</div>