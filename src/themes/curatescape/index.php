<?php
if ((get_theme_option('stealth_mode')==1)&&(is_allowed('Items', 'edit')!==true)){
    queue_css_file('stealth');
    include_once('stealth-index.php');
} 
else { //if not stealth mode, do everything else
?> 
    <?php 
        $classname='home';
        if(get_theme_option('expand_map')==1){
            $classname = 'home expand-map';
        }else{
            $classname = 'home';
        }
        echo head(array('maptype'=>'focusarea','bodyid'=>'home','bodyclass'=>$classname)); 
    ?>

    <article>
        <section class="hero section heroSection">
            <div class="hero-text f-center f-h2 f-title u-max800">
                <?php echo mh_home_about();?>
            </div>
        </section>

        <?php echo homepage_widget_sections(); ?>

        <section id="map" class="featuredSection">
            <div class="featuredMap">
                <h3 class="featuredMap-label">Explore</h3>

                <div class="featuredMap-map">
                    <?php mh_display_map($type='global'); ?>
                    <?php mh_map_actions();?> 

                </div>

                <h2 class="featuredMap-title">
                    <a class="featuredMap-titleInner" href="#">Check out the map to visit MHC Locations!</a>
                </h2>
            </div>
        </section>
            <?php //echo mh_display_featured_section($title='Vist', null, null, ); ?>

    </article>

    <!-- <script>
        // add map overlay for click function if map is not already expanded
        jQuery('body:not(.expand-map) #hm-map').append('<div class="home-map-overlay"></div>');
        jQuery('#hm-map .home-map-overlay').click(function(){
            jQuery('#home').addClass('expand-map');
            jQuery('.home-map-overlay').remove();
    });
    </script> -->

    <?php echo foot(); ?>

    <?php
        //end stealth mode else statement
}?>
