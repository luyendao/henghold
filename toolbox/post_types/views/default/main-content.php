<div class="meta-box selfclear">

	<div>
		<div class="pad">
			<?php wp_editor(isset($main->content) ? $main->content : null, 'physician_details', $settings = array('teeny'=>false,'media_buttons'=>true, 'textarea_name' => 'META[main][content]')); ?>
		</div>
	</div>
	
</div>