<?php 
/*
	Template Name: Home Page
*/
?>
<?php extract((array)$META);
get_header(); ?>

	<?php echo do_shortcode('[rev_slider alias="slider1"]'); ?>

    <?php if (false) : ?>
    <!-- carousel -->
    <div class="carousel-wrap home" <?=($slider->background)?' style="background-image:url('.$slider->background.');"':null?>>
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
				       	
	                <div class="item row-fluid <?=$active?>">
	                    <div class="video-wrap span6">
	                        <img src="<?=$slide->img?>" alt="" <?=($slide->videolink)?'data-video="http://www.youtube.com/embed/'.$slide->videolink.'?autoplay=1&rel=0&enablejsapi=1&version=3&playerapiid=ytplayer"':null?> class="<?=($slide->videolink)?'slide-video':'slide'?>">
	                    </div>
	
	                    <div class="carousel-caption span6">
	                        <h1><?=$slide->title?></h1>
	                        <?=wpautop($slide->description)?>
	                        <a <?=($slide->moretarget)?' target="_blank"':null?> href="<?=$slide->morelink?>" class="learn-more-btn"><span></span><?=$slide->moretxt?></a>
	                    </div>
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

    <!-- main container -->
    <div class="container-fluid main home">
        <div class="row-fluid hero">
            <h1><?=$middle->center->title?></h1>
            <?=wpautop($middle->center->description)?>
        </div>
        <!--<div class="row-fluid">
           <div class="question-box span3">
            	<div class="question">
            		<h3><?=$bottom->one->content?></h3>
            	</div>
            	<div class="hover">
	                <?=wpautop($bottom->one->hover->content)?>
	                <?php if($bottom->one->link->url): ?>
	                	<a <?=($bottom->one->link->target)?' target="_blank"':null?> href="<?=$bottom->one->link->url?>"><span><?=$bottom->one->link->text?></span> ></a>
	                <?php endif; ?>
				</div>
            </div>
            <div class="question-box span3">
                <div class="question">
                    <h3><?=$bottom->two->content?></h3>
                </div>
             	<div class="hover">
	                <?=wpautop($bottom->two->hover->content)?>
	                <?php if($bottom->two->link->url): ?>
	                	<a <?=($bottom->two->link->target)?' target="_blank"':null?> href="<?=$bottom->two->link->url?>"><span><?=$bottom->two->link->text?></span> ></a>
	                <?php endif; ?>
				</div>               
            </div>
            <div class="question-box span3 three">
                <div class="question">
                    <h3><?=$bottom->three->content?></h3>
                </div>
             	<div class="hover">
	                <?=wpautop($bottom->three->hover->content)?>
	                <?php if($bottom->three->link->url): ?>
	                	<a <?=($bottom->three->link->target)?' target="_blank"':null?> href="<?=$bottom->three->link->url?>"><span><?=$bottom->three->link->text?></span> ></a>
	                <?php endif; ?>
				</div> 
            </div>
            <div class="span3 last">
                <?=wpautop($bottom->four->content)?>
                <a <?=($bottom->four->link->target)?' target="_blank"':null?> href="<?=$bottom->four->link->url?>" class="see-more-btn"><?=$bottom->four->link->text?><span></span></a>
            </div>
        </div>-->
		
		<?php the_content();?>
    </div><!-- /main container -->
    
<?=get_footer()?>
