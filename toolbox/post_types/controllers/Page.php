<?php
//////////////////////////////////////////////////////////////////////
// pages // class to manage the
//////////////////////////////////////////////////////////////////////

class Page extends PostType{

	public $name = 'Page';
	public $settings = array(); // not needed because this is a core PostType

	/**
		page.php (all pages)
	*/

	public function edit_default(){

		// Admin Head
		$this->add_head($this->load->view('default/admin_head',array('post_ID'=>$this->get_current_post()->ID,'post_type'=>$this->slug),true));

		// Scripts
		$this->add_script('image-uploader','/toolbox/js/image-uploader.js',array('jquery','wpfiles'),true);
		$this->add_script('image-uploader','/toolbox/js/page-admin.js',array('jquery'),true);

		// Styles
		$this->add_style('image-uploader','/toolbox/css/image-uploader.css');
		$this->add_style('page-slider' ,'/toolbox/css/page-slider.css');
		
		// Remove Editor on default page
		$this->remove_default_editor();
		
		// Remove meta boxes 
		$this->remove_metabox('commentstatusdiv','normal',true);	
		$this->remove_metabox('revisionsdiv','normal',true);
		$this->remove_metabox('commentsdiv','normal',true);
		$this->remove_metabox('authordiv','normal',true);
		$this->remove_metabox('slugdiv','normal',true);		
		
		$this->add_metabox(
			'choose-media',
			'Choose Media',
			'default/choose-media'
		);		
		
		$this->add_metabox(
			'HeaderImage',
			'Header Image',
			'default/headerimage',
			array('default_header_image' => get_stylesheet_directory_uri().'/img/page-img-default.jpg')
		);
		
		$META = $this->get_META($this->post->ID);
		$this->load->library('Simplate');
		$this->add_metabox(
			'page-slider',
			'Page Slideshow Options',
			'default/slide-manager',
			array('defaultimg' => get_stylesheet_directory_uri().'/img/slide.jpg')
		);	
		
		$this->add_metabox(
			'main-content',
			'Page Content',
			'default/main-content'
		);					

	}

	/**
		page-home.php (Home Page)
	*/

	public function edit_page_home(){
		// remove scripts-n-style
		$this->remove_script('image-uploader');
		$this->remove_style('image-uploader');
		$this->remove_style('page-slider');

		// Style
		$this->add_style('home-default','/toolbox/css/home.css');
		$this->add_style('home-slider' ,'/toolbox/css/slider.css');
		$this->add_style('home-stories','/toolbox/css/stories.css');

		// Remove Editor on homepage
		$this->remove_default_editor();
		
		// Remove meta boxes 
		$this->remove_metabox('page_HeaderImage_meta','normal',true);
		$this->remove_metabox('page_page-slider_meta','normal',true);
		$this->remove_metabox('page_choose-media_meta','normal',true);
		$this->remove_metabox('page_main-content_meta','normal',true);

		// Add META BOXES
		$META = $this->get_META($this->post->ID);
		$this->load->library('Simplate');
		$this->add_metabox(
			'slider',
			'Slideshow Options',
			'home/slide-manager',
			array('defaultimg' => get_stylesheet_directory_uri().'/img/default-video-placeholder.png')
		);
		
		$this->add_metabox(
			'middle-content',
			'Middle Content',
			'home/middle-content'
		);
		
		$this->add_metabox(
			'bottom-content',
			'Bottom Content',
			'home/bottom-content'
		);		
		
	}

	public function site_page_home(){
	}
	
}
?>