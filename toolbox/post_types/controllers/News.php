<?php 
class News extends PostType{

    public $name = 'News';

    public $labels = array(
        'singular'=>'News Article',
        'plural'=>'News Articles'
    );

    public $settings = array(
        "rewrite"=> array('slug'=>'news')
    );
	
	public $taxonomies = array('category');

    public $sidebar = 'default';
    public $menu = 'News Articles';

    function edit_default(){
    	
        // Scripts
        $this->add_script('thickbox_media-upload',site_URL().'/wp-admin/load-scripts.php?c=0&load=thickbox,media-upload',array('jquery'));
        //$this->add_script('image-uploader','/toolbox/js/image-uploader.js',array('jquery','wpfiles','thickbox_media-upload'));

        // Styles
        $this->add_style('image-uploader','/toolbox/css/image-uploader.css');
        $this->add_style('thickbox',site_URL().'/wp-includes/js/thickbox/thickbox.css');
        
        // add Metaboxes
        $this->remove_default_editor();

        // global $wp_registered_sidebars;
        // $META = $this->get_META($this->post->ID);
        // !isset($META->sidebar) ? $META->sidebar = 'default' : null ;
        // $META->sidebars = $wp_registered_sidebars;
        // $this->add_metabox(
            // 'choose-sidebar',
            // 'Choose a Sidebar',
            // 'sidebars',
            // $META,
            // 'side',
            // null,
            // false
        // );


        $this->add_metabox(
            'featured-graphic',
            'Featured Graphic',
            'image-uploader',
            array('fieldname'=>'featured','defaultimg'=>get_stylesheet_directory_uri().'/img/page-img-default.jpg')
        );

        $this->add_metabox(
            'article-body',
            'News Body',
            'full_content'
        );
    }
}
// end of file