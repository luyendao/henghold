<div class="meta-box selfclear">
	
	<?php $index='one'?>
	<div class="one-quarter left">
		<div class="pad">
			<label class="whole">Question:</label>
			<?php wp_editor(isset($bottom->$index->content) ? $bottom->$index->content : null, 'META[bottom]['.$index.'][content]', $settings = array('teeny'=>false,'media_buttons'=>false,'textarea_rows'=>4)); ?>
		</div>
		<div class="pad">
			<label class="whole">Hover Content:</label>
			<?php wp_editor(isset($bottom->$index->hover->content) ? $bottom->$index->hover->content : null, 'META[bottom]['.$index.'][hover][content]', $settings = array('teeny'=>false,'media_buttons'=>false,'textarea_rows'=>12)); ?>
		</div>		
		<div class="pad">
			<div class="full"><label>Link Text:</label></div>
			<div class="full">
				<input class="whole" type="text" name="META[bottom][<?=$index?>][link][text]" value="<?=isset($bottom->$index->link->text) ? $bottom->$index->link->text : null?>">
			</div>
			<div class="full"><label>Link URL:</label></div>
			<div class="full">
				<input class="whole" type="text" name="META[bottom][<?=$index?>][link][url]" value="<?=isset($bottom->$index->link->url) ? $bottom->$index->link->url : null?>">
			</div>
			<div class="full">
				<input id="<?=$index?>_target" type="checkbox" name="META[bottom][<?=$index?>][link][target]" <?=isset($bottom->$index->link->target) && $bottom->$index->link->target ?'checked': null?> />
				<label for="<?=$index?>_target"> : Open in New Window</label>
			</div>

			<p class="info">for on-site URLs "/my/page/link"<br/>for off-site URLs "http://offsite.com/someones/page"</p>
		</div>
	</div>
	
	<?php $index='two'?>
	<div class="one-quarter left">
		<div class="pad">
			<label class="whole">Question:</label>
			<?php wp_editor(isset($bottom->$index->content) ? $bottom->$index->content : null, 'META[bottom]['.$index.'][content]', $settings = array('teeny'=>false,'media_buttons'=>false,'textarea_rows'=>4)); ?>
		</div>
		<div class="pad">
			<label class="whole">Hover Content:</label>
			<?php wp_editor(isset($bottom->$index->hover->content) ? $bottom->$index->hover->content : null, 'META[bottom]['.$index.'][hover][content]', $settings = array('teeny'=>false,'media_buttons'=>false,'textarea_rows'=>12)); ?>
		</div>		
		<div class="pad">
			<div class="full"><label>Link Text:</label></div>
			<div class="full">
				<input class="whole" type="text" name="META[bottom][<?=$index?>][link][text]" value="<?=isset($bottom->$index->link->text) ? $bottom->$index->link->text : null?>">
			</div>
			<div class="full"><label>Link URL:</label></div>
			<div class="full">
				<input class="whole" type="text" name="META[bottom][<?=$index?>][link][url]" value="<?=isset($bottom->$index->link->url) ? $bottom->$index->link->url : null?>">
			</div>
			<div class="full">
				<input id="<?=$index?>_target" type="checkbox" name="META[bottom][<?=$index?>][link][target]" <?=isset($bottom->$index->link->target) && $bottom->$index->link->target ?'checked': null?> />
				<label for="<?=$index?>_target"> : Open in New Window</label>
			</div>

			<p class="info">for on-site URLs "/my/page/link"<br/>for off-site URLs "http://offsite.com/someones/page"</p>
		</div>		
	</div>
	
	<?php $index='three'?>
	<div class="one-quarter left">
		<div class="pad">
			<label class="whole">Question:</label>
			<?php wp_editor(isset($bottom->$index->content) ? $bottom->$index->content : null, 'META[bottom]['.$index.'][content]', $settings = array('teeny'=>false,'media_buttons'=>false,'textarea_rows'=>4)); ?>
		</div>
		<div class="pad">
			<label class="whole">Hover Content:</label>
			<?php wp_editor(isset($bottom->$index->hover->content) ? $bottom->$index->hover->content : null, 'META[bottom]['.$index.'][hover][content]', $settings = array('teeny'=>false,'media_buttons'=>false,'textarea_rows'=>12)); ?>
		</div>		
		<div class="pad">
			<div class="full"><label>Link Text:</label></div>
			<div class="full">
				<input class="whole" type="text" name="META[bottom][<?=$index?>][link][text]" value="<?=isset($bottom->$index->link->text) ? $bottom->$index->link->text : null?>">
			</div>
			<div class="full"><label>Link URL:</label></div>
			<div class="full">
				<input class="whole" type="text" name="META[bottom][<?=$index?>][link][url]" value="<?=isset($bottom->$index->link->url) ? $bottom->$index->link->url : null?>">
			</div>
			<div class="full">
				<input id="<?=$index?>_target" type="checkbox" name="META[bottom][<?=$index?>][link][target]" <?=isset($bottom->$index->link->target) && $bottom->$index->link->target ?'checked': null?> />
				<label for="<?=$index?>_target"> : Open in New Window</label>
			</div>

			<p class="info">for on-site URLs "/my/page/link"<br/>for off-site URLs "http://offsite.com/someones/page"</p>
		</div>		
	</div>
	
	<?php $index='four'?>
	<div class="one-quarter left">
		<div class="pad">
			<label class="whole">Patient Story Content:</label>
			<?php wp_editor(isset($bottom->$index->content) ? $bottom->$index->content : null, 'META[bottom]['.$index.'][content]', $settings = array('teeny'=>false,'media_buttons'=>false,'textarea_rows'=>26)); ?>
		</div>
		<div class="pad">
			<div class="full"><label>Link Text:</label></div>

			<div class="full">
				<input class="whole" type="text" name="META[bottom][<?=$index?>][link][text]" value="<?=isset($bottom->$index->link->text) ? $bottom->$index->link->text : null?>">
			</div>
			
			<div class="full"><label>Link URL:</label></div>
			
			<div class="full">
				<input class="whole" type="text" name="META[bottom][<?=$index?>][link][url]" value="<?=isset($bottom->$index->link->url) ? $bottom->$index->link->url : null?>">
			</div>
			<div class="full">
				<input id="<?=$index?>_target" type="checkbox" name="META[bottom][<?=$index?>][link][target]" <?=isset($bottom->$index->link->target) && $bottom->$index->link->target ?'checked': null?> />
				<label for="<?=$index?>_target"> : Open in New Window</label>
			</div>

			<p class="info">for on-site URLs "/my/page/link"<br/>for off-site URLs "http://offsite.com/someones/page"</p>
		</div>
	</div>	
	
</div>