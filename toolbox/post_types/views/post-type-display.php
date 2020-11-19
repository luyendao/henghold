<?php
	$post_type = get_post_type_object($post_type);

	$query = new WP_Query('post_type='.$post_type->name);
	//print_r($query);
?>
	<div class="actions" style="padding:10px">
		<div class="pad">
			<a href="post-new.php?post_type=<?php echo $post_type->name?>" class="add-new-h2"><?php echo $post_type->labels->add_new?></a>
			<a href="edit.php?post_type=<?php echo $post_type->name?>" class="add-new-h2">Sort <?php echo $post_type->labels->name?></a>
		</div>
	</div>
	<table class="wp-list-table widefat fixed pages" cellspacing="0">
		<thead>
			<tr>
				<th scope="col" id="cb" class="manage-column column-cb check-column" style="">
					<!--label class="screen-reader-text" for="cb-select-all-1">Select All</label><input id="cb-select-all-1" type="checkbox"-->
				</th>
				<th scope="col" id="title" class="manage-column column-title sortable desc" style="">
					<span>Title</span>
				</th>
				<th scope="col" id="date" class="manage-column column-date sortable asc" style="">
					<span>Date</span>
				</th>
			</tr>
		</thead>

		<tfoot>
			<tr>
				<th scope="col" class="manage-column column-cb check-column" style="">
					<!--label class="screen-reader-text" for="cb-select-all-2">Select All</label><input id="cb-select-all-2" type="checkbox"-->
				</th>
				<th scope="col" id="title" class="manage-column column-title sortable desc" style="">
					<span>Title</span>
				</th>
				<th scope="col" id="date" class="manage-column column-date sortable asc" style="">
					<span>Date</span>
				</th>
			</tr>
		</tfoot>

		<tbody id="the-list" class="ui-sortable">
<?php 
	if(count($query->posts) > 0):
		foreach($query->posts as $post):
?>
			<tr id="post-875" class="post-875 type-ceevents status-draft hentry alternate iedit author-self" valign="top">
				<th scope="row" class="check-column">
					<!--label class="screen-reader-text" for="cb-select-875">Select Test Event</label>
					<input id="cb-select-875" type="checkbox" name="post[]" value="875"-->
				</th>
				<td class="post-title page-title column-title">
					<strong><a class="row-title" href="http://retina.thewebcraftsmen.com/wp-admin/post.php?post=<?php echo $post->ID?>&amp;action=edit" title="Edit “<?php echo $post->post_title?>”"><?php echo $post->post_title?></a> - <span class="post-state"><?php echo $post->post_status?></span></strong>
				</td>
				<td class="date column-date">
					<abbr title="<?php echo date('Y/m/d h:m:s',strtotime($post->post_modified))?>"><?php echo date('Y/m/d',strtotime($post->post_modified))?></abbr><br>Last Modified
				</td>
			</tr>
<?php
		endforeach;
	endif;
?>
		</tbody>
	</table>

	<div class="actions" style="overflow:hidden;margin-top:10px">
		<div class="pad" style="padding:10px;">
			<a href="post-new.php?post_type=<?php echo $post_type->name?>" class="add-new-h2"><?php echo $post_type->labels->add_new?></a>
			<a href="edit.php?post_type=<?php echo $post_type->name?>" class="add-new-h2">Sort <?php echo $post_type->labels->name?></a>
		</div>
	</div>