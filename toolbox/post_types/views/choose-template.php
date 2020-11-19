					<div class="meta-box">
						<div class="whole">
							<div class="pad">
								<p><strong><?php _e('Template') ?></strong></p>
								<label class="screen-reader-text" for="page_template"><?php _e('Page Template') ?></label>
								<select name="page_template" id="page_template">
									<option value="<?=is_string($default) && $default!='' ? $default : 'default'?>"><?php _e('Default Template'); ?></option>
<?php 
	$templates = get_page_templates();
	ksort($tempaltes);

	foreach (array_keys( $templates ) as $name=>$file): 
		if(strstr($this->slug.'-',$file)):
			continue;
		elseif( $current == $templates[$template] ):
			$selected = ' selected="selected"';
		else:
			$selected = '';
		endif;
?>
									<option value=".<?=$file?>"<?=$selected?>><?=$name?></option>

<?php 
	endforeach;
?>
								</select>
							</div>
						</div>
					</div>