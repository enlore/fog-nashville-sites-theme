<!--
<aside id="action-buttons">
	<?php echo random_item_link("View A Random ".mh_item_label('singular'),'big-button');?>
	<?php mh_appstore_downloads(); ?>
</aside> 
-->

</div><!--end wrap-->

<footer class="footer is-desktop">
    <div class="columns">
        <div class="footer-brand column">
            <?php echo link_to_home_page(mh_the_logo(), array('class'=>'home-link')); ?>
        </div>

        <nav class="footer-nav column is-2-tablet">
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/tours/browse">Take a Tour</a></li>
                <li><a href="/items/browse">Items</a></li>
                <li><a href="/about">About</a></li>
            </ul>
        </nav>

        <p class="footer-about column is-5-tablet">
            The Metropolitan Historical Commission Foundation is a 501(c)(3) non-profit
            friends group which assists the Metro Historical Commission in its efforts to
            identify, protect, study, and interpret the rich history of Nashville.
        </p>

        <div class="footer-address column">
            <address>
                Sunnyside in Sevier Park<br/>
                3000 Granny White Pike<br/>
                Nashville, Tennesee 37204
            </address>

            <p> Phone: 615-862-7970 </p>

            <p> Copyright 2017. <br /> All rights reserved. </p>

            <div class="footer-byline">
                <div>Designed for this time</div>
                <div>and place by</div>
                <a href="http://fog.haus">
                    <img class="footer-fog" src="/themes/curatescape/images/fog-logo-white.png" alt="fog.haus"/>
                </a>
            </div>
        </div>

        <!--<nav id="footer-nav">    
            <?php echo mh_global_nav(); ?>      	
             <div id="search-wrap">
                <?php echo mh_simple_search($formProperties=array('id'=>'footer-search')); ?>
            </div>   
        </nav>	
        <p class="default">
              <span id="app-store-links"><?php mh_appstore_footer(); ?></span>  
            <?php echo mh_footer_find_us();?>
            <span id="copyright"><?php echo mh_license();?></span> 
            <span id="powered-by"><?php echo __('Powered by <a href="http://omeka.org/">Omeka</a> + <a href="http://curatescape.org">Curatescape</a>');?></span>
        </p>
        <div class="custom">
            <?php echo get_theme_option('custom_footer_html');?>
        </div> -->

    <?php 		
    echo mh_footer_scripts_init(); 
    ?>


        <!-- Plugin Stuff -->
        <?php echo fire_plugin_hook('public_footer', array('view'=>$this)); ?>	

    <!-- <div class="clearfix"></div> -->
    </div>
</footer>
</body>

</html>
