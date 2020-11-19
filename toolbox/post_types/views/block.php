<div class="meta-box selfclear">
	<div class="whole left">
		<div class="pad">
			<label class="one-quarter">title:</label>
			<input class="whole" type="text" name="META[<?=$section?>][title]" value="<?=isset($$section->title) ? $$section->title : null?>">
		</div>
		<div class="pad">
			<label class="whole">description:</label>
			<textarea class="whole" type="text" name="META[<?=$section?>][description]"><?=isset($$section->description) ? $$section->description : null?></textarea>
		</div>
		

		<div class="one-third"><label>Link Text:</label></div>
		<div class="one-third"><label>Link URL:</label></div>
		<div class="one-third"><label>&nbsp;&nbsp;</label></div>

		<div class="one-third">
			<input class="whole" type="text" name="META[<?=$section?>][link][text]" value="<?=isset($$section->link->text) ? $$section->link->text : null?>">
		</div>
		<div class="one-third">
			<input class="whole" type="text" name="META[<?=$section?>][link][url]" value="<?=isset($$section->link->url) ? $$section->link->url : null?>">
		</div>
		<div class="one-third">
			<input id="<?=$section?>_target" type="checkbox" name="META[<?=$section?>][link][target]" <?=isset($$section->link->target) && $$section->link->target ?'checked': null?> />
			<label for="<?=$section?>_target"> : Open in New Window</label>
		</div>

	</div>
</div>