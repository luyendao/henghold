<?php extract((array)$META); ?>
<?=get_header()?>
            <div class="heading-wrap">
                <div class="heading container-fluid">
                    <h1><?=wp_title('');?></h1>
                </div>
            </div>

            <!-- main container -->
            <div class="container-fluid main page">
                <div class="row-fluid">
					<?php get_sidebar('news'); ?>

                    <div class="span9 main-content">
                    	
                    	<?php global $wp_query;
						query_posts(
						   array_merge(
								$wp_query->query,
								array(
									'post_type' => 'news',
									'posts_per_page' => 10
								)
						   )
						);
                    	while ( have_posts() ) : the_post(); ?>
                        <div class="news">
                            <h2><?=the_title();?></h2>
                            <span class="date-published"><?=the_time('F d, Y');?></span>
                            <div class="excerpt">
                                <?=the_excerpt();?>
                            </div>

                            <a href="<?=the_permalink();?>" class="see-more-btn">Read More<span></span></a>
                        </div>
                        <?php endwhile; ?>
                        
                        <?php $next_link = get_next_posts_link('Next'); 
						$prev_link = get_previous_posts_link('Previous');
						if($next_link or $prev_link){ ?>
	                        <div class="prev-next-wrap archive">
	                        	<?php 
								$next_link = preg_replace('|a href|','a class="see-more-btn next" href',$next_link);
								$next_link = str_replace('</a>','<span></span></a>',$next_link);
								echo $next_link;
	                        	?>
	                        	<?php 
								$prev_link = preg_replace('|a href|','a class="see-more-btn prev" href',$prev_link);
								$prev_link = str_replace('Previous','<span></span>Previous',$prev_link);
								echo $prev_link;
	                        	?>                        	
	                        </div> 
                        <?php } ?>                       

                    </div>
                </div>
            </div><!-- /main container -->

<?=get_footer()?>

