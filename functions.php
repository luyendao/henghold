<?php
require_once(TEMPLATEPATH.'/toolbox/wcinit.php');

// Adds the theme style to visual editor. This makes the content look consistent between the live site and the editor.
add_editor_style('/css/editor-style.css');

function load_base_scripts(){
	if(!is_admin()){
		wp_enqueue_script('jquery');
	}
}
add_action('init', 'load_base_scripts');

function add_class_next_post_link($html){
    $html = str_replace('<a','<a class="see-more-btn next"',$html);
	$html = str_replace('</a>','<span></span></a>',$html);
    return $html;
}

add_filter('next_post_link','add_class_next_post_link',10,1);

function add_class_previous_post_link($html){
    $html = str_replace('<a','<a class="see-more-btn prev"',$html);
	$html = str_replace('">','"><span></span>',$html);	
    return $html;
}

add_filter('previous_post_link','add_class_previous_post_link',10,1);

function custom_password_form() {  
    global $post;  
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );  
    $o = '<form class="protected-post-form" action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post"> 
    <input name="post_password" class="password" id="' . $label . '" type="password" size="20" /><input type="submit" name="Submit" class="password-btn" value="' . esc_attr__( "Submit" ) . '" />  
    </form>
    ';  
    return $o;  
}

add_filter( 'the_password_form', 'custom_password_form' ); 

function get_archive_filter( $where , $r ) {
  $post_type = 'news';
  return str_replace( "post_type = 'post'" , "post_type = '$post_type'" , $where );
}

?>