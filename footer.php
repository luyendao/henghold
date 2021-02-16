<?php global $menus?>
            <div class="push"></div>
        </div><!-- /wrap -->

        <!-- footer -->
        <footer class="main">
            <div class="container-fluid footer">
                <div class="row-fluid">
                    <div class="span8 offset2">
                        <div class="col">
                            <h4>Navigate</h4>
                            <nav>
								<?php /*?><?=$menus['Top Menu']?><?php */?>
                                <ul>
                                	<li><a href="http://www.henghold.com/">Home</a>
                                    </li>
                                	<li><a href="http://www.henghold.com/about-us/">About Us</a>
                                    </li>
                                    <li><a href="http://www.henghold.com/treatment-services/">Treatment & Services</a>
                                    </li>
                                    <li><a href="http://www.henghold.com/for-patients/">For Patients</a>
                                    </li>
                                    <li><a href="http://www.henghold.com/locations/">Locations</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="col">
                            <h4>Connect</h4>
                            <ul>
                                <li><a href="https://www.facebook.com/Hengholddermatology/" class="fb">Facebook</a></li>
                                <!-- <li><a href="#" class="in">Linkedin</a></li> -->
                                <li><a href="https://www.youtube.com/channel/UC_tbRCp1RYqst9hC41_FDtA" class="yt">Youtube</a></li>
                            </ul>
                        </div>
                        <div class="col">
                            <h4>Contact</h4>
                            <p>530 Fontaine Street Pensacola, FL 32503</p>
                            <br>
                            <p><strong>P</strong> 850-474-4775</p>
                            <p><strong>T</strong> 800-243-SKIN</p>
                            <p><strong>F</strong> 850-484-8223</p>
                        </div>
                        <div class="col">
                            <a href="/" class="logo">Henghold</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="copyright">
                <p>Copyright <?= date('Y'); ?>, Henghold Skin Health &amp; Surgery Group. All Rights Reserved.</p>
                         </div>
        </footer><!-- /footer -->

        <script src="<?=get_stylesheet_directory_uri()?>/js/vendor/bootstrap.min.js"></script>
        <script src="<?=get_stylesheet_directory_uri()?>/js/vendor/jquery.icarousel.js"></script>
        <script src="<?=get_stylesheet_directory_uri()?>/js/vendor/jquery.fitvids.min.js"></script>  
        <script src="<?=get_stylesheet_directory_uri()?>/js/vendor/jquery.cj-swipe.js"></script>    

        <script src="<?=get_stylesheet_directory_uri()?>/js/global.js"></script>
        
        <?=wp_footer()?>

        <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

 ga('create', 'UA-44184745-2', 'henghold.com');
ga('require', 'displayfeatures');
 ga('send', 'pageview');

</script>
    </body>
</html>

