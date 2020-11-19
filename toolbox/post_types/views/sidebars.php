					<div class="meta-box">
						<div class=" whole">
							<div class="pad">
								<input id="sb_none" type="radio" name="META[sidebar]" value="none" <?=($sidebar == 'none') ? 'checked' : '' ?>/> <label for="sb_none">None</lable>
							</div>
<?php foreach($sidebars as $id=>$sb):?>
							<div class="pad">
								<input id="sb_<?=$id?>" type="radio" name="META[sidebar]" value="<?=$id?>" <?=($sidebar == $id) ? 'checked' : '' ?>/> <label for="sb_<?=$id?>"><?=$sb['name']?></lable>
							</div>
<?php endforeach;?>
							<p class="info"> You can edit the content in these sidebars from the the <a href="/wp-admin/widgets.php">Widgets</a> section.</p>
						</div>
					</div>