<?php global $menus?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if IE 9]>         <html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php wp_title(); ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="<?=get_stylesheet_directory_uri()?>/css/style.css?v=1.1.8">
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">

        <script src="<?=get_stylesheet_directory_uri()?>/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        
        <?php wp_head(); ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-98288483-1', 'auto');
  ga('send', 'pageview');

</script>
<meta name="msvalidate.01" content="08ED43FC8110B2D88A6B38BD59417568" />
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- wrap -->
        <div class="wrap">
            <!-- header -->
            <header class="main">
                <h1>
                    <a href="/" class="logo">Henghold Skin Health &amp; Surgery Group</a>
                </h1>
            </header><!-- /header -->

            <!-- navigation -->
            <nav class="main navbar">
				<a class="btn custom-btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				            	
            	<div class="nav-collapse collapse">
            		<?=$menus['Top Menu']?>
            	</div>
            </nav><!-- /navigation -->