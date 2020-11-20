<?php 
/*
	Template Name: FullWidth Page
*/
?>
<?php extract((array)$META); ?>
<?=get_header()?>
  			<div class="heading-wrap">
                <div class="heading container-fluid">
                    <h1><?=the_title()?></h1>
                </div>

<?php
the_content(); 
?>
       
				<?php if(!post_password_required(get_the_ID())): ?>
		            <?php if($media->slideshow == 'on'): ?>
					    <!-- carousel -->
					    <div class="carousel-wrap default-page">
					    	<script>var $slider_interval = <?=isset($slider->interval) ? $slider->interval*1000 : 5000?>;</script>
					        <div id="slider" class="carousel slide">
					            <!-- carousel content -->
					            <div class="carousel-inner container-fluid">
		
									<?php
										$slidernav = '';
										$index = -1;
										foreach($slides as $key=>$slide):
											if($slide->hide)continue;
											$index++;
											$active = $index==0 ? 'active' : null;
											$slidernav .= '<li data-target="#slider" data-slide-to="'.$index.'" class="'.$active.'"></li>
											';
									?>
						                
			                            <div class="item row-fluid <?=$active?>" style="background-image:url(<?=$slide->img?>);">
											<?php if($slide->title || $slide->description || ($slide->moretxt and $slide->morelink)){ ?>
				                                <div class="carousel-caption">
				                                    <?=($slide->title) ? '<h1>'.$slide->title.'</h1>' : null?>
				                                    <?=($slide->description) ? wpautop($slide->description) : null?>
							                        <?php if($slide->moretxt and $slide->morelink): ?>
							                        	<a <?=($slide->moretarget)?' target="_blank"':null?> href="<?=$slide->morelink?>" class="learn-more-btn"><?=$slide->moretxt?><span></span></a>
							                        <?php endif; ?>
				                                </div>
			                                <?php } ?>
			                            </div>				                
		
									<?php endforeach;?>
		
					            </div><!-- /carousel content -->
		
					            <div class="carousel-controls-wrap">
					                <a class="carousel-control left" href="#slider" data-slide="prev"></a>
					                <ol class="carousel-indicators">
										<?=$slidernav?>
					                </ol>
					                <a class="carousel-control right" href="#slider" data-slide="next"></a>
					            </div>
					        </div><!-- /carousel -->
					    </div>
				    <?php endif; ?>
			    <?php endif ?>
		    
		  </div><!--.heading-wrp-->

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
                    	<?php if(!post_password_required(get_the_ID())): ?>
	                    	<?php if($media->image == 'on'): ?>
	                        	<?=($header_image) ? '<img src="'.$header_image.'" alt="">' : null?>
	                        <?php endif; ?>
	
							<?=wpautop(do_shortcode($main->content))?>
							
							<?php if(false):/* PLACEHOLDER ACCORDIAN MARKUP */ ?>
	                        <ul class="accordion">
	                            <li class="active">
	                                <a href="#" class="toggle">Lorem Ipsum Dolar?<span></span></a>
	
	                                <div class="accordion-content">
	                                    <div class="video-wrap">
	                                        <img src="<?=get_stylesheet_directory_uri()?>/img/accordion-placeholder.jpg" alt="" data-video="http://www.youtube.com/embed/mzPxo7Y6JyA?autoplay=1&enablejsapi=1&version=3&playerapiid=ytplayer" class="accordion-video">
	                                    </div>
	
	                                    <p>Lorem ipsum dolor sit amet, <a href="#">consectetur adipisicing elit</a>, sed do smod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do smod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
	                                </div>
	                            </li>
	
	                            <li>
	                                <a href="#" class="toggle">Lorem Ipsum Dolar?<span></span></a>
	
	                                <div class="accordion-content">
	                                    <div class="video-wrap">
	                                        <img src="img/accordion-placeholder.jpg" alt="" data-video="http://www.youtube.com/embed/mzPxo7Y6JyA?autoplay=1&enablejsapi=1&version=3&playerapiid=ytplayer" class="accordion-video">
	                                    </div>
	
	                                    <p>Lorem ipsum dolor sit amet, <a href="#">consectetur adipisicing elit</a>, sed do smod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do smod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
	                                </div>
	                            </li>
	
	                            <li>
	                                <a href="#" class="toggle">Lorem Ipsum Dolar?<span></span></a>
	
	                                <div class="accordion-content">
	                                    <div class="video-wrap">
	                                        <img src="img/accordion-placeholder.jpg" alt="" data-video="http://www.youtube.com/embed/mzPxo7Y6JyA?autoplay=1&enablejsapi=1&version=3&playerapiid=ytplayer" class="accordion-video">
	                                    </div>
	
	                                    <p>Lorem ipsum dolor sit amet, <a href="#">consectetur adipisicing elit</a>, sed do smod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do smod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
	                                </div>
	                            </li>
	                        </ul>
	                        <?php endif;/* END PLACEHOLDER ACCORDIAN MARKUP */ ?>						
							
	                        
	                    </div>
                    <?php else: ?>
                    	<?php the_content(); ?>
                   	<?php endif; ?>
                </div>
            </div><!-- /main container -->

<?=get_footer()?>
