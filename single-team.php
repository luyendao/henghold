<?=get_header()?>
	    <div class="heading-wrap">
                <div class="heading container-fluid">
                    <h1><?=the_title()?></h1>
                </div>
            </div>

            <!-- main container -->
            <div class="container-fluid main page">
                <div class="row-fluid">

                    <div class="main-content">

                            <div class="content">
                                <?php the_content(); ?>
                            </div>

                    </div>
        
                </div>
            </div><!-- /main container -->
<?=get_footer()?>
