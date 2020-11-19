<?php
// register_sidebar( array(
    // 'id'          => 'default',
    // 'name'        => __( 'Default', $text_domain ),
    // 'description' => __( 'This is the default sidebar', $text_domain ),
    // 'before_widget' => '',
    // 'after_widget' => '',
    // 'before_title' => '<!--',
    // 'after_title' => '-->',
// ));

// Site menus
add_theme_support( 'menus' );

// Add Class Depth to Wordpress Menus
add_filter( 'nav_menu_css_class',function( $classes = array(), $item = false ) {
	$current_url = WCCore::get_current_url();
	$homepage_url = trailingslashit( get_bloginfo( 'url' ) );
	if( is_404() or $item->url == $homepage_url ) return $classes;
	if($current_url == $item->url){ $classes[] = 'active';}elseif ( strstr( $current_url, $item->url) ) {$classes[] = 'current-parent';}
	return $classes;
}, 10, 2 );



$menus = array(
	'Top Menu' => wp_nav_menu(array(
		'theme_location'  => '',
		'menu'            => 'Top Menu',
		'container'       => '', 
		'container_class' => '',
		'container_id'    => '',
		'menu_class'      => '', 
		'menu_id'         => '',
		'echo'            => false,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
	)),
	'Services' => wp_nav_menu(array(
		'theme_location'  => '',
		'menu'            => 'Services',
		'container'       => '', 
		'container_class' => '',
		'container_id'    => '',
		'menu_class'      => '', 
		'menu_id'         => '',
		'echo'            => false,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '<span></span>',
		'link_after'      => '',
		'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
	)),
	'About Us' => wp_nav_menu(array(
		'theme_location'  => '',
		'menu'            => 'About Us',
		'container'       => '', 
		'container_class' => '',
		'container_id'    => '',
		'menu_class'      => '', 
		'menu_id'         => '',
		'echo'            => false,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '<span></span>',
		'link_after'      => '',
		'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
	)),
	'For Patients' => wp_nav_menu(array(
		'theme_location'  => '',
		'menu'            => 'For Patients',
		'container'       => '', 
		'container_class' => '',
		'container_id'    => '',
		'menu_class'      => '', 
		'menu_id'         => '',
		'echo'            => false,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
	))
);


// admin menus
add_filter('custom_menu_order', create_function('', 'return true;'));
add_filter('menu_order', function($menu){
	$dev_menu = array(
		'edit.php?post_type=page',
		'upload.php');
	array_splice($menu, 2, 0, $dev_menu);
	return array_unique($menu);
});

// hide the posts menu
add_action('admin_menu', function () {
	global $menu;
	$restricted = array(__('Posts'),__('Links'),__('Comments'));
	end ($menu);
	while (prev($menu)){
		$value = explode(' ',$menu[key($menu)][0]);
		if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
	}
});