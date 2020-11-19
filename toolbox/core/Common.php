<?php
/* Common Functions */

function wc_get_sub_menu($return_pages = false){
	global $post; 
	if($post->post_parent > 0) $sub_page = true;
	if($sub_page == false){
		$args = array(
			'child_of' => $post->ID,
			'title_li' => ''
		);
	}else{
		$args = array(
			'child_of' => $post->post_parent,
			'title_li' => ''
		);
	}
	$pages = get_pages($args);
	if($sub_page == false){
		if(count($pages)>0) $has_children = true;
	}
	if($return_pages == false){
		if($has_children == true or $sub_page == true) return true;
		else return false;
	}else{
		// print_r($pages);
		uasort($pages,function($a, $b){
			if ($a->menu_order == $b->menu_order) return 0;
			return ($a->menu_order < $b->menu_order) ? -1 : 1;
		});

		foreach($pages as $page){
			($post->ID==$page->ID) ? $active='active' : null;
			$markup.= '<li class="'.$active.'"><a href="'.get_permalink($page->ID).'">'.$page->post_title.'</a>';
		}
		return $markup;
	}
}

function wc_get_section_menu($echo=false,$settings=false){
	global $wc;
	$settings = !$settings ? array(
		'theme_location'  => '',
		'container'       => '', 
		'container_class' => '',
		'container_id'    => '',
		'menu_class'      => '', 
		'menu_id'         => '',
		'echo'            => false,
		'fallback_cb'     => false,
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
	) : $settings;

	$parent = $wc->get_parent(get_the_ID(),-1);
	$settings['menu'] = $parent->post_title;

	$markup = wp_nav_menu($settings);

	if(!$echo) return $markup;
	echo $markup;
}

// end of file