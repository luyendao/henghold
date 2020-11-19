<nav class="sub-nav span3 archive">
    <h3>Categories</h3>
    <ul>
    	<?php $categories = get_categories(array('exclude'=>1));
		foreach($categories as $category){
			echo '<li><a href="';
			echo get_category_link($category->cat_ID);
			echo '">';
			echo $category->name;
			echo '</a></li>';
		} ?>
    </ul>

    <h3>Archives</h3>
    <ul>
    	
        <?php add_filter( 'getarchives_where' , 'get_archive_filter' , 10 , 2 );
        $archives = wp_get_archives(array('type'=>'monthly','echo'=>0)); 
		$archives = preg_replace("|href='(.*)/'|", "href='$1/?post_type=news'", $archives);
		echo $archives;
		remove_filter( 'getarchives_where' , 'get_archive_filter' , 10 , 2 );
        ?> 
        
        <?php /*                       	
        <li>
            <a href="#">2013</a>

            <div class="archive-wrap">
                <ul>
                    <li><a href="#">January</a></li>
                    <li><a href="#">February</a></li>
                    <li><a href="#">March</a></li>
                </ul>
            </div>
        </li>
        <li>
            <a href="#">2012</a>

            <div class="archive-wrap">
                <ul>
                    <li><a href="#">January</a></li>
                    <li><a href="#">February</a></li>
                    <li><a href="#">March</a></li>
                </ul>
            </div>
        </li>
        <li>
            <a href="#">2011</a>

            <div class="archive-wrap">
                <ul>
                    <li><a href="#">January</a></li>
                    <li><a href="#">February</a></li>
                    <li><a href="#">March</a></li>
                </ul>
            </div>
        </li>
	*/ ?>
    </ul>
	
</nav>