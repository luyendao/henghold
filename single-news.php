<?php extract((array)$META); ?>
<?=get_header()?>
			<div class="heading-wrap">
                <div class="heading container-fluid">
                    <h1><?=the_title()?></h1>
                </div>
            </div>

            <!-- main container -->
            <div class="container-fluid main page">
                <div class="row-fluid">
					<?php get_sidebar('news'); ?>

                    <div class="span9 main-content">
                        <div class="news single">
                            <h3 class="author">by <?php the_author(); ?></h3>
                            <span class="date-published"><?php the_date('F d, Y'); ?></span>

							<?=($featured) ? '<img src="'.$featured.'" alt="">' : null?>

                            <div class="content">
                                <?php the_content(); ?>
                            </div>

                            <div class="prev-next-wrap">
                                <?php previous_post_link('%link','Previous'); ?>
                                <?php next_post_link('%link','Next'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /main container -->
<?=get_footer()?>