<?php 
/**
 * Template Name: Elementor Template
 * Template Post Type: post, page
 *
 */

?>


<?php extract((array)$META); ?>
<?=get_header()?>
  			<div class="heading-wrap">
                <div class="heading container-fluid">
                    <h1><?=the_title()?></h1>
                </div>
                
	    
		  </div><!--.heading-wrp-->

<?php

$menu = wc_get_section_menu();

?>
            <!-- main container -->
            <div class="container-fluid main page">
                <div class="row-fluid<?=(!$menu) ? ' no-menu' : null?>">
                	<?php if(!(!$menu)): ?>
	                    <nav class="sub-nav span3">
	                        <a href="#" class="sub-nav-btn">Sub-navigation<span></span></a>
                            <?=$menu;?>
	                    </nav>
                    <?php endif; ?>

                    <div class="span9 main-content pull-left">
	
			    <?=wpautop(do_shortcode($main->content))?>
			
                            <?php the_content(); ?>
				
						
	                        <ul class="share-btn">
	                            <li>
	                                <a href="#">+ Share</a>
	
	                                <div class="share-links-wrapper">
	                                    <ul class="share-links">
	                                        <li><a target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?=WCCore::get_current_url()?>" class="fb"><span></span>Facebook</a></li>
	                                        <li><a target="_blank" href="http://www.twitter.com/share?url=<?=WCCore::get_current_url()?>" class="tw"><span></span>Twitter</a></li>
	                                        <li><a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=<?=WCCore::get_current_url()?>" class="in"><span></span>Linkedin</a></li>
	                                        <li>
	                                        	<a href="mailto:?body=<?=WCCore::get_current_url()?>" class="mail">
		                                        	<span></span>
		                                        	Email
		                                        </a>
		                                    </li>
	                                    </ul>
	                                </div>
	                            </li>
	                        </ul>
	                    </div>
                </div>
            </div><!-- /main container -->

<?=get_footer()?>
