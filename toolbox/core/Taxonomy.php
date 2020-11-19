<?php

class Taxonomy extends WCCore{

	public $name = 'Crafty Taxonomy';
	public $slug = '';// set the a lowercase version of the called class name

	public $labels = array(
		'singular'=>'Taxonomy',
		'plural'=>'Taxonomies'
	);

	public $args = array(); // http://codex.wordpress.org/Function_Reference/register_taxonomy#Arguments
	
	public function __construct(){

		$this->content = get_class();

		// Register the post type
		$this->slug = strtolower(preg_replace('/(?<=\\w)(?=[A-Z])/',"_$1",get_called_class()));
		$this->post_type = $this->register();

		// Execute Core Constructor
		parent::__construct();

		// Setup Admin Environment
		if(is_admin()){
			//add_action('wp_loaded',array(&$this,'is_admin'));
			add_action('admin_print_scripts',array(&$this,'admin_print_scripts'));
			add_action('add_meta_boxes',array(&$this,'add_meta_boxes'));
			add_action('admin_head',array(&$this,'admin_head'));
			add_action('save_post',array(&$this,'save_META'));
		}else{
			//add_action('wp',array(&$this,'is_site'));
			add_action('wp_enqueue_scripts',array(&$this,'site_scripts'));
		}

	}

	public function setup_admin(){

		if(!$this->is_current_type()) return;

		// Default Scripts and Style
		if(method_exists($this,'edit_default')) $this->edit_default();

		// Template Specific Scripts Style
		$methodname = preg_replace('/\-/','_','edit_'.$this->get_template_name());
		if(method_exists($this,$methodname)) $this->$methodname();

	}

	public function setup_site(){

		if(!$this->is_current_type()) return;

		// Default Scripts and Style
		if(method_exists($this,'visit_default')) $this->visit_default();

		// Template Specific Scripts Style
		$methodname = preg_replace('/\-/','_','visit_'.$this->get_template_name());
		if(method_exists($this,$methodname)) $this->$methodname();

	}
	
	// Registers the post type
	public function register(){

		// Check to see if we're in a core Post_Type otherwise, execute registration
		if(taxonomy_exists($this->slug)) return get_taxonomy($this->slug);

		// Setup Default args http://codex.wordpress.org/Function_Reference/register_taxonomy#Arguments
		$args = array(
		    'label'                       => __(ucwords($this->name)),
		    'labels'                      => array(
			    'name'                          => __(ucwords($this->name)),
			    'singular_name'                 => __(ucwords($this->labels->singular)),
			    'search_items'                  => __(ucwords('Search '.$this->labels->plural)),
			    'popular_items'                 => __(ucwords('Popular '.$this->labels->plural)),
			    'all_items'                     => __(ucwords('All '.$this->labels->plural)),
			    'parent_item'                   => __(ucwords('Parent '.$this->labels->singular)),
			    'parent_item_colon'             => __(ucwords('Parent '.$this->labels->singular.':')),
			    'edit_item'                     => __(ucwords('Edit '.$this->labels->singular)),
			    'update_item'                   => __(ucwords('Update '.$this->labels->singular)),
			    'add_new_item'                  => __(ucwords('Add New '.$this->labels->singular)),
			    'new_item_name'                 => __(ucwords('New '.$this->labels->singular)),
			    'separate_items_with_commas'    => __(ucwords('Seperate '.$this->labels->plural.' With Commas')),
			    'add_or_remove_items'           => __(ucwords('Add or Remove '.$this->labels->plural)),
			    'choose_from_most_used'         => __(ucwords('Choose from the Most Used '.$this->labels->plural))
			),
		    'public'                      => true,
		    'show_ui'                     => true,
//		    'show_in_nav_menus'	          => true,
//		    'show_tagcloud'		          => false,
//		    'show_admin_column'	          => false,
//		    'hierarchical'                => false,
//		    'update_count_callback'       => false,
//		    'query_var'                   => true,
		    'rewrite'                     => array( 'slug' => $this->slug, 'with_front' => true, 'hierarchial' => true ),
		    'capabilities'                => array( 'manage_terms', 'edit_terms', 'delete_terms', 'assign_terms'),
//		    'sort' 			              => false,
		);
		
		// Merge custom Taxonomy args over default $args
		$this->args = array_merge($args,$this->args);

		register_taxonomy($this->slug,null,$this->args);

		// Insert terms
		wp_insert_term('Truck Stop & Circulation Media',            'distribution_network', array('description'=> '','slug' => 'truck-stop-circulation-media'));
		wp_insert_term('Online Media & Services',                   'distribution_network', array('description'=> '','slug' => 'online-media-services'));
		wp_insert_term('Mobile Media & Services',                   'distribution_network', array('description'=> '','slug' => 'mobile-media-services'));
		wp_insert_term('Event Media & Additional Services',         'distribution_network', array('description'=> '','slug' => 'event-media-additional-services'));
		wp_insert_term('Driver Databases & Lists',                  'distribution_network', array('description'=> '','slug' => 'driver-databases-lists'));
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
	 
	  Renders scripts and CSS
	
	*/
	public function admin_print_scripts(){
		if(!$this->is_current_type()) return;

		// Default Scripts and Style
		if(method_exists($this,'admin_scripts')) $this->admin_scripts();

		// Template Specific Scripts Style
		$methodname = preg_replace('/\-/','_',$this->get_template_name()).'_admin_scripts';
		if(method_exists($this,$methodname)) $this->$methodname();
	}

	/**

		Renders Admin METABOX Interfaces

	*/
	public function add_meta_boxes(){
		if(!$this->is_current_type()) return;
		$META = $this->get_META($this->post->ID);

		foreach($this->queue->metabox as $args){
			extract((array)$args);
			add_meta_box(
				$this->slug.'_'.$name.'_meta',
				$title,
				array(&$this,'render_metabox'),
				$this->slug,
				$context,
				$priority,
				array($view,array_merge((array)$data,(array)$META))
			);
		}

	}

	public function add_metabox($name, $title, $view, $data = array(), $context = 'normal', $priority = 'default'){
		// Queue Metabox properties to build on the "add_meta_boxes" action
		$this->queue->metabox[] = array(
			'name'=>$name,
			'title'=>$title,
			'view'=>$view,
			'data'=>$data,
			'context'=>$context,
			'priority'=>$priority
		);
	}


	public function remove_metabox($name,$location='default',$builtin=false){
		add_action('add_meta_boxes',function(){
			if(!$builtin)
				remove_meta_box($this->slug.'_'.$name.'_meta',get_current_screen(),$location);
			else 
				remove_meta_box($name,get_current_screen(),$location);
		});
	}

	public function render_metabox($page,$box){
		$data = array_merge_recursive((array)$data,array(
			'META'=>$this->get_META($this->post->id),
			'post_id'=>$this->post->id,
			'post_type'=>$this->post->type
		));
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
		$META = $this->get_META($this->post->ID);
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
		$replacements = array("'",'\"',"\r\n\r\n");

		if(!isset($this)){
			$JSON = preg_replace($patterns,$replacements,get_post_meta($post_id,'META',true)) ;
			return ($as_array) ? ($JSON=='') ? array() : json_decode($JSON,true) : ($JSON=='') ? (object)array() : json_decode($JSON) ;
		}else{
			if(isset($this->META)) return $as_array ? $this->META->array : $this->META->obj;
			$JSON = preg_replace($patterns,$replacements,get_post_meta($post_id,'META',true));
			$this->META = new stdClass();
			$this->META->obj = ($JSON=='') ? (object)array() : json_decode($JSON);
			$this->META->array = ($JSON=='') ? array() : json_decode($JSON,true);
			return $as_array ? $this->META->array : $this->META->obj;
		}
	}

	public function get_template_name(){
		$find =    array('/\-\s/','/\.php/','/\./');
		$replace = array('_'     ,''       ,''    );
		$template = get_post_meta($this->post->ID,'_wp_page_template',true);

		if($template == 'default') {
			// Page Name Specific Meta Boxes
			$filename = 'page-'.preg_replace('/[^a-z0-9_]+/i','',preg_replace('/\s/','-',strtolower($this->post->post_title))).'.php';
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

			$JSON = preg_quote(json_encode($_POST['META']));	
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