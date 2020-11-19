<?php
define('WC_TOOLBOXPATH',__dir__.'/');
define('WC_COREPATH',WC_TOOLBOXPATH.'/core/');
define('WC_POSTTYPEPATH',WC_TOOLBOXPATH.'/post_types/');
define('WC_WIDGETSPATH',WC_TOOLBOXPATH.'/widgets/');
define('WC_INCLUDESPATH',WC_TOOLBOXPATH.'/includes/');


/**

	SESSION Handling

*/
add_action('init',function(){if(!session_id())session_start();});
add_action('wp_logout',function(){session_destroy();});
add_action('wp_login',function(){session_destroy();});

/**

	Include core files (stuff to load every time)

*/

require_once(WC_COREPATH.'/Common.php');
require_once(WC_COREPATH.'/WCUser.php');
require_once(WC_COREPATH.'/WCCore.php');
require_once(WC_COREPATH.'/PostType.php');

$wc = null;
$META = null;

/**

	Include Post_Type Controllers

*/
	
$post_types = scandir(WC_POSTTYPEPATH.'controllers/');
foreach($post_types as $file) if(preg_match('/\.php/',$file)) {
	require_once(WC_POSTTYPEPATH.'controllers/'.$file);
	$PostTypeClass = preg_replace('/.php/','',$file);

	// Execute the Post_Type
	if(class_exists($PostTypeClass)) new $PostTypeClass();
}

/**

	Include Widgets and Sidebars

*/

// add_action( 'widgets_init', function(){
	// $widgets = scandir(WC_WIDGETSPATH.'controllers/');
	// foreach($widgets as $file) if(preg_match('/\.php/',$file)) {
		// require_once(WC_WIDGETSPATH.'controllers/'.$file);
		// $WIDGET = preg_replace('/.php/','',$file);
// 
		// // Call and instanciate the Post_Type
		// if(class_exists($WIDGET)) register_widget($WIDGET);
	// }
// });

/**

	Menus and Sidebars "I've not got a good way to break these into the toolbox yet sot hey will be here for now." -Gary

*/

include_once(WC_TOOLBOXPATH.'menus-and-sidebars.php');


// Flush rewrites while developing.
add_action('init', function(){

/**
	-------- Flush rewrite rules for custom post types. -------------------------------

	!!!!!!!! Please be sure to re-comment this after you're done flushing !!!!!!!!!!!!!
*/
	
	//flush_rewrite_rules();

});

/**

	Wordpress Editor Majiggory

*/
add_filter('mce_buttons_2',function ($buttons) {	
	
	// Add in a core buttona that are disabled by default
	$buttons[] = 'hr';
	
	return $buttons;
});
?>