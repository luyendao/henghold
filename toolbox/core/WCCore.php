<?php

class WCCore{

	// variables
	public $wp;
	public $content;
	public $queue;

	static public $user;
	static public $post;
	static public $current_post_type;



	public function __construct(){
		// Setup default objects
		require_once(WC_TOOLBOXPATH.'libraries/Loader.php');
		$this->load = new Loader($this,$this->content);
		
		$this->queue = new stdClass();

		if(is_admin()){
			add_action('wp_loaded',array($this,'init_admin'));
			add_action('admin_print_scripts',array($this,'print_assets'));
			add_action('admin_head',array(&$this,'print_head'));
		}else{
			add_action('wp',array($this,'init_site'));
			add_action('wp_enqueue_scripts',array($this,'print_assets'));
			add_action('wp_head',array(&$this,'print_head'));

			// Custom WP Front-End Actions
			$this->execute_custom_action($_REQUEST['action']);
		}
	}

	public function init_admin(){
		// setup important shit
		global $wp;
		$this->wp =& $wp;

		$this->set_core();

		$this->add_script('wpfiles','toolbox/js/jquery.wpfiles.js?121233',array('jquery'), false);
		$this->add_style('WC_Admin_Style','toolbox/css/admin.css');

		if(method_exists($this,'setup_admin'))$this->setup_admin();
	}

	public function init_site(){
		// setup important shit
		global $wp;
		$this->wp =& $wp;

		$this->set_core();

		if(method_exists($this,'setup_site'))$this->setup_site();
	}

	public function set_core(){
		if(!isset(self::$user)) 				$this->user = self::$user = new WCUser(get_current_user_id());
		if(!isset(self::$post)) 				$this->post = self::$post = $this->get_current_post();
		if(!isset(self::$current_post_type))	$this->current_post_type = self::$current_post_type = $this->get_current_post_type();
	}

	public function get_current_post(){
		if(isset($this->post)) return $this->post;
		$id = isset($_POST['post_ID']) ? $_POST['post_ID'] : isset($_REQUEST['post']) ? $_REQUEST['post'] : get_the_ID();
		return get_post($id);
	}

	public function get_current_post_type(){
		if(isset($this->current_post_type))
			return $this->current_post_type;
		
		if(isset($_REQUEST['post_type']) && $_REQUEST['post_type'] != '')
			return $this->current_post_type = get_post_type_object($_REQUEST['post_type']);
		
		if($post = $this->get_current_post())
			return $this->current_post_type = get_post_type($post->ID);
		
		global $post_type;
		if(isset($post_type))return $this->current_post_type = $post_type;
		return null;
	}

	public function short_excerpt($limit) {
		$excerpt = explode(' ', get_the_excerpt(), $limit);
		if (count($excerpt)>=$limit) {
			array_pop($excerpt);
			$excerpt = implode(" ",$excerpt).'...';
		} else {
			$excerpt = implode(" ",$excerpt);
		}	
		$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
		return $excerpt;
	}
	 
	public function short_content($limit) {
		$content = explode(' ', strip_tags(get_the_content()), $limit);
		if (count($content)>=$limit) {
			array_pop($content);
			$content = implode(" ",$content).'...';
		} else {
			$content = implode(" ",$content);
		}	
		$content = preg_replace('/\[.+\]/','', $content);
		$content = apply_filters('the_content', $content); 
		$content = str_replace(']]>', ']]&gt;', $content);
		return $content;
	}

	public function sendmail($from,$to,$subject='Site Email',$template,$data){
		$this->load->library('Simplate');

		$headers  = "From: ".$from."\r\n";
	    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

		$message = $this->simplate->render($template,$data);

		return mail($to, $subject, $message, $headers);
	}

	public function get_parent($post,$levels=0){
		// Get Post Parent
		$post_ID = is_object($post) ? $post->ID : is_int($post) ? $post : false;
		
		if($post_ID){
			$parents = get_post_ancestors( $post_ID );
			$id = ($parents) ? $parents[($levels)>-1 ? $levels : count($parents)-1] : $post_ID;
			return get_page( $id );
		}else{
			return false;
		}
	}

	// insert into <head>
	public function add_head($content){
		$this->queue->head[] = $content;
	}

	public function print_head(){
		if(!is_array($this->queue->head))return;
		foreach($this->queue->head as $content){
			echo $content;
		}
	}


	// Interface Methods
	public function add_interface(){
		$args = func_get_arg();
		switch($this->content){
			case 'PostType':
				$this->add_metabox(
					$args[0],
					$args[1],
					$args[2],
					isset($args[3])?$args[3]:null,
					isset($args[4])?$args[4]:null,
					isset($args[5])?$args[5]:null
				);
				break;
			case 'Taxonomy':
				$this->add_optionbox();
				break;
		}
	}

	// Register & Queue / Dequeu Scripts and CSS
	public function add_script($name,$uri,$queue = array(),$ver=null,$footer=true){
		if(!preg_match('/http/',$uri)) $uri = get_stylesheet_directory_uri().'/'.$uri;
		$this->queue->scripts[] = array(
			'name'=>$name,
			'uri'=>$uri,
			'queue'=>$queue,
			'ver'=>$ver,
			'footer'=>$footer
		);
	}

	public function remove_script($name){
		$this->queue->remscripts[] = $name;
	}
	
	public function add_style($name,$uri,$queue = array(),$ver=null,$media=null){
		if(!preg_match('/http/',$uri)) $uri = get_stylesheet_directory_uri().'/'.$uri;
		$this->queue->style[] = array(
			'name'=>$name,
			'uri'=>$uri,
			'queue'=>$queue,
			'ver'=>$ver,
			'media'=>$media
		);
	}

	public function remove_style($name){
		$this->queue->remstyle[] = $name;
	}

	public function print_assets(){
		if(!$this->is_current_type()) return;
		
		if(is_array($this->queue->scripts)){
			foreach($this->queue->scripts as $script){
				$script = (object)$script;
				wp_register_script($script->name, $script->uri, $script->queue, $script->ver, $script->footer);
				wp_enqueue_script($script->name);
			};
		}

		if(is_array($this->queue->remscripts)){
			foreach($this->queue->remscripts as $name){
				wp_deregister_script($name);
				wp_dequeue_script($name);
			}
		}

		if(is_array($this->queue->style)){
			foreach($this->queue->style as $style){
				$style = (object)$style;
				wp_register_style($style->name, $style->uri, $style->queue, $style->ver, $style->media);
				wp_enqueue_style($style->name);
			}
		}

		if(is_array($this->queue->remstyle)){
			foreach($this->queue->remstyle as $name){
				wp_deregister_style($name);
				wp_dequeue_style($name);
			}
		}
	}

	public function get_current_url() {
		// Protocol
		$url = ( 'on' == $_SERVER['HTTPS'] ) ? 'https://' : 'http://';
		$url .= $_SERVER['SERVER_NAME'];
		// Port
		$url .= ( '80' == $_SERVER['SERVER_PORT'] ) ? '' : ':' . $_SERVER['SERVER_PORT'];
		$url .= $_SERVER['REQUEST_URI'];
		return trailingslashit( $url );
	}

	public function execute_custom_action($action=null){
		$method = 'action_'.$action;
		if(isset($action) && method_exists($this, $method)) die($this->$method());
		// silent fault to discourage brute force
	}

	// Core Toolbox actions
	public function action_wcthumb(){
		include_once(WC_INCLUDESPATH.'thumb.php');
		die(null);
	}

	public function ajax_actions(){
		$method = 'ajax_'.$_REQUEST['do'];
		if(isset($_REQUEST['do']) && method_exists($this, $method)) die($this->$method());
		// silent fault to discourage brute force
	}
}


//end of file
