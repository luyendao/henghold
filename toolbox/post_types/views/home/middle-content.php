<div class="meta-box selfclear">
	
	<?php $index='center'?>
	<div>
		<div class="pad selfclear">
			<label class="one-quarter">title:</label>
			<input class="whole" type="text" name="META[middle][<?=$index?>][title]" value="<?=isset($middle->$index->title) ? $middle->$index->title : null?>">
		</div>
		<div class="pad">
			<label class="whole">description:</label>
			<?php wp_editor(isset($middle->$index->description) ? $middle->$index->description : null, 'META[middle]['.$index.'][description]', $settings = array('teeny'=>false,'media_buttons'=>false)); ?>
		</div>
	</div>
	
</div>