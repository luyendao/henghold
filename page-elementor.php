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
				
                   </div>
                </div>
            </div><!-- /main container -->

<?=get_footer()?>
