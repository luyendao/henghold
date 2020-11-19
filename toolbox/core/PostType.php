<?php

class PostType extends WCCore{

	public $name = 'Craftsmen\'s Post Type';
	public $slug = ''; // set the a lowercase version of the called class name

	public $labels = array(
		'singular'=>'canvas',
		'plural'=>'canvases'
	);
	
	//public $taxonomies = array('category');

	public $settings = array();
	public $metaboxes = array();
	
	public function __construct(){

		$this->content = get_class();

		// Register the post type
		$this->slug = strtolower(get_called_class());
		$this->post_type = $this->register();

		// Execute Core Constructor
		parent::__construct();

		// Setup Admin Environment
		if(is_admin() && $this->is_current_type()){
			add_action('admin_head',array(&$this,'admin_head'));
			add_action('add_meta_boxes',array(&$this,'setup_meta_interfaces'));
			add_action('save_post',array(&$this,'save_META'));
			add_action('init',array(&$this,'taxonomies'));
		}

	}

	public function setup_admin(){
		if(!$this->is_current_type()) return;

		// establish a post value for $this
		$this->post = parent::$post;

		// Default Scripts and Style
		if(method_exists($this,'edit_default')) $this->edit_default();

		// Template Specific Scripts Style
		$methodname = preg_replace('/\-/','_','edit_'.$this->get_template_name());
		if(method_exists($this,$methodname)) $this->$methodname();

	}

	public function setup_site(){
		if(!$this->is_current_type()) return;

		// establish a post value for $this
		$this->post = parent::$post;

		global $META,$wc;
		$wc = $this;
		$META = $this->get_META(parent::$post->ID);

		// setting the_post() up;
		the_post();

		// Default Scripts and Style
		if(method_exists($this,'visit_default')) $this->site_default();

		// Template Specific Scripts Style
		$methodname = preg_replace('/\-/','_','site_'.$this->get_template_name());
		if(method_exists($this,$methodname)) $this->$methodname();

	}
	
	// Registers the post type
	public function register(){

		// Check to see if we're in a core Post_Type otherwise, execute registration
		if(post_type_exists($this->slug)) return get_post_type_object($this->slug);

		$this->labels = (object)$this->labels;

		// These are our default settings
		$settings = array(
			'label'				=> $this->name,
			'show_ui'         	=> true,
			'show_in_nav_menus'	=> true,
			'show_in_menu'		=> true,
			'show_in_admin_bar' => true,
			'public'          	=> true,
			'menu_position'   	=> 4,
			'has_archive' 	  	=> true,
			'hierarchical'	 	=> false,
			'rewrite' 			=> array('slug' => $this->slug),
			'capability_type' 	=> 'post',
			'labels'	 		=> array(
				'name' 					=> __( ucwords($this->name)),
				'singular_name' 		=> __( ucwords($this->labels->singular)),
				'add_new'				=> __('Add New '.ucwords($this->labels->singular)),
				'all_items' 			=> __('All '.ucwords($this->labels->plural)),
				'add_new_item' 			=> __('Add New '.ucwords($this->labels->singular)),
				'edit_item' 			=> __('Edit '.ucwords($this->labels->singular)),
				'new_item' 				=> __('New '.ucwords($this->labels->singular)),
				'view_item' 			=> __('View '.ucwords($this->labels->singular)),
				'search_items' 		 	=> __('Search '.ucwords($this->labels->plural)),
				'not_found' 			=> __('No '.ucwords($this->labels->plural).' Found'),
				'not_found_in_trash' 	=> __('No '.ucwords($this->labels->plural).' in Trash'),
				'parent_item_colon'		=> __('Parent '.ucwords($this->labels->singular)),
				'menu_name'				=> __(ucwords($this->name))
			)
		);

		// look for an icon for this post-type
		if(is_file(TEMPLATEPATH.'img/menu_icon_'.$this->slug.'.png')) $settings['menu_icon'] = TEMPLATEPATH.'img/menu_icon_'.$this->slug.'.png';

		// merge the post type's settings over the default ones
		$this->settings = array_merge($settings,$this->settings);

		//print_r($this->settings);
		
		/**
			REGISTER MI POST TYPE NAO!!!
		*/
		return register_post_type($this->slug,$this->settings);
	}

	public function taxonomies(){
		if(!is_array($this->taxonomies))return;

		foreach($this->taxonomies as $taxonomy){
			register_taxonomy_for_object_type($taxonomy, $this->slug);
		}
	}

	public function site_wp_loaded(){
		if(!$this->is_current_type()) return;

		// Default Scripts and Style
		if(method_exists($this,'site_loaded')) $this->site_loaded();

		// Template Specific Scripts Style
		$methodname = preg_replace('/\-/','_',$this->get_template_name()).'_site_loaded';
		if(method_exists($this,$methodname)) $this->$methodname();
	}

	public function admin_head(){
		if(!$this->is_current_type()) return;

		// Default Site Scripts
		if(method_exists($this,'default_admin_head')) $this->default_admin_head();
		
		// Template Specific Site sCripts
		$methodname = preg_replace('/\-/','_',$this->get_template_name()).'_admin_head';
		if(method_exists($this,$methodname)) $this->$methodname();
		
	}

	/**

		Renders Admin METABOX Interfaces

	*/
	public function setup_meta_interfaces(){
		if(!$this->is_current_type()) return;
		$META = $this->get_META(parent::$post->ID);

		// Add Metaboxes
		if(is_array($this->queue->metabox))
			foreach($this->queue->metabox as $box)
				add_meta_box(
					$this->slug.'_'.$box->name.'_meta',
					$box->title,
					array(&$this,'render_metabox'),
					$this->slug,
					$box->context,
					$box->priority,
					array($box->view,array_merge((array)$META,(array)$box->data))
				);

		if(is_array($this->queue->rmmetabox))
			foreach($this->queue->rmmetabox as $box)
				remove_meta_box($box->name,get_current_screen(),$box->location);

	}

	public function add_metabox($name, $title, $view, $data = array(), $context = 'normal', $priority = 'default'){
		// Queue Metabox properties to build on the "add_meta_boxes" action
		$this->queue->metabox[] = (object)array(
			'name'=>$name,
			'title'=>$title,
			'view'=>$view,
			'data'=>$data,
			'context'=>$context,
			'priority'=>$priority
		);
	}


	public function remove_metabox($name,$location='default',$builtin=false){

		// Queue Metabox properties to build on the "add_meta_boxes" action
		$this->queue->rmmetabox[] = (object)array(
			'name'=>!$builtin ? $this->slug.'_'.$name.'_meta' : $name,
			'location'=>$location
		);
	}

	public function render_metabox($page,$box){
		$this->load->view($box['args'][0],$box['args'][1]);
	}

	/**

		Public Site Handlers
	
	*/

	public function site_data(){
		if(!$this->is_current_type()) return;

		the_post();
		$this->post = $this->get_current_post();
		if(isset($this->post)) $this->post_type = $this->get_current_post_type();

		global $wc,$META;
		$wc = $this;
		$META = $this->get_META(parent::$post->ID);
	}

	public function site_scripts(){

		if(!$this->is_current_type()) return;
		// Default Site Scripts
		if(method_exists($this,'default_site_scripts')) $this->default_site_scripts();
		// Template Specific Site sCripts
		$methodname = preg_replace('/\-/','_',$this->get_template_name()).'_site_scripts';

		if(method_exists($this,$methodname)) $this->$methodname();
	}


	/**

		Helpers

	*/

	public function is_current_type(){
		$current = $this->get_current_post_type();
		if(is_object($current))$current = $current->name;
		return ($this->slug == $current);
	}

	public function add_reorder_support($order='ASC'){
		add_action( 'wp_loaded', array( &$this,'reorder'), 100 );
	}

	public function reorder(){
		require(WC_TOOLBOXPATH.'/libraries/Reorder.php' );
	    // Instantiate new reordering
	    new Reorder(
	        array(
	            'post_type'   => $this->name,
	            'order'       => 'ASC',
	            'heading'     => __( 'Reorder '.$this->labels->plural, 'reorder' ),
	            'final'       => '',
	            'initial'     => '',
	            'menu_label'  => __( 'Reorder '.$this->labels->plural, 'reorder' ),
	            'post_status' => 'publish'
	        )
	    );
	}

	public function remove_default_editor(){
		global $_wp_post_type_features;
		unset($_wp_post_type_features[$this->slug]['editor']);
	}

	/*
	 * META Object
	*/
	public function get_META($post_id,$as_array=false){
		$patterns = array("/\\\\\\\'/",'/\\\\\\\\\\\\"/',"/rnrn/");
		$replacements = array("'",'\"',"\r\n\r\n","rn");

		if(!isset($this)){

			$JSON = get_post_meta($post_id,'META',true);

			if(strpos($JSON,'\"') === false){

					$JSON = addslashes($JSON);
					$JSON = preg_replace('/\{\\\"/','{"',$JSON);
					$JSON = preg_replace('/\\\\"}/','"}',$JSON);
					$JSON = preg_replace("/\\\'/","'",$JSON);

					$JSON = preg_replace('/:\\\"/',':"',$JSON);
					$JSON = preg_replace('/\\\"\:/','":',$JSON);

					$JSON = preg_replace('/\\\",/','",',$JSON);
					$JSON = preg_replace('/,\\\"/',',"',$JSON);
					$JSON = preg_replace('`\\\/`','/',$JSON);


			}else{
					$JSON = preg_replace($patterns,$replacements,$JSON);
			}

			$response = ($JSON=='') ? ($as_array) ? array() : (object)array() : json_decode($JSON,$as_array);

			return $response;

		}else{
			if(isset($this->META)) return $as_array ? $this->META->array : $this->META->obj;

			$JSON = utf8_encode(get_post_meta($post_id,'META',true));

// 			echo "


// ---------------------------------------------------


// " . $JSON,"UTF-8" . "


// ---------------------------------------------------


// ";


			if(strpos($JSON,'\"') === false){

					$JSON = addslashes($JSON);
					$JSON = preg_replace('/\{\\\"/','{"',$JSON);
					$JSON = preg_replace('/\\\\"}/','"}',$JSON);
					$JSON = preg_replace("/\\\'/","'",$JSON);

					$JSON = preg_replace('/:\\\"/',':"',$JSON);
					$JSON = preg_replace('/\\\"\:/','":',$JSON);

					$JSON = preg_replace('/\\\",/','",',$JSON);
					$JSON = preg_replace('/,\\\"/',',"',$JSON);
					$JSON = preg_replace('`\\\/`','/',$JSON);


			}else{

					$JSON = preg_replace($patterns,$replacements,$JSON);
			}

			
			// strip endoded characters cuz... dafuq?
			$JSON = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $JSON);

			// convert unicodes to htmlencoded character codes
			// $JSON = html_entity_decode($JSON);
			$JSON = preg_replace('/u([0-9A-F]{4})/', '&#x$1;', $JSON);

			$this->META = new stdClass();
			$this->META->obj = ($JSON=='') ? (object)array() : json_decode($JSON);
			$this->META->array = ($JSON=='') ? array() : json_decode($JSON,true);

			return $as_array ? $this->META->array : $this->META->obj;
		}
	}

	public function get_template_name(){
		$find =    array('/\-\s/','/\.php/','/\./');
		$replace = array('_'     ,''       ,''    );
		$template = get_post_meta(parent::$post->ID,'_wp_page_template',true);

		if($template == 'default') {
			// Page Name Specific Meta Boxes
			$filename = 'page-'.preg_replace('/[^a-z0-9_]+/i','',preg_replace('/\s/','-',strtolower(parent::$post->post_title))).'.php';
			if(file_exists(TEMPLATEPATH.'/'.$filename)){
				$template = $filename;
			}else{
				return false;
			}
		}
		return ($template == '') ? false : preg_replace($find,$replace,$template);
	}


/**
	SAVE META DATA
*/
	public function save_META(){
		if($_POST['action']=='inline-save'
		|| !$this->is_current_type()
		|| !isset($_POST) 
		|| !isset($_POST['META']) 
		|| !isset($_POST['post_ID'])
		|| !current_user_can( 'edit_page', $_POST['post_ID'] )) return; // don't act unless it's an update

		if($revision_id = wp_is_post_revision( $_POST['post_ID'] )){
			// if this is a revision
			$revision  = get_post( $revision_id );
			$META = get_post_meta( $revision->ID, 'META', true );

			if($META !== false) add_metadata( 'post', $post_id, 'META', $my_meta );

		}else{

			$JSON = preg_quote(json_encode($_POST['META'], JSON_UNESCAPED_SLASHES));

			// echo $JSON;exit;

			update_post_meta($_POST['post_ID'],'META',$JSON);
		}
	}
/**
	SAVE META DATA
*/

	public function restore_META($post_id, $revision_id){

		$post = get_post($post_id);
		$revision = get_post($revision_id);
		$my_meta = get_metadata('post',$revision->ID,'META',true );

		if ( false !== $my_meta ){
			update_post_meta( $post_id, 'my_meta', $my_meta );
		}else{
			delete_post_meta( $post_id, 'my_meta' );
		}

	}

}

?>