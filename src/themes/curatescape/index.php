<?php
if ((get_theme_option('stealth_mode')==1)&&(is_allowed('Items', 'edit')!==true)){
    queue_css_file('stealth');
    include_once('stealth-index.php');
}
else{
    //if not stealth mode, do everything else
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

 <?php //mh_map_actions();?> 

<div id="content" role="main">
    <article id="homepage">

        <section class="hero">
            <div class="hero-text">
                <?php echo mh_home_about();?>
            </div>
        </section>

        <?php 
            echo homepage_widget_sections();
        ?>
            <section id="map" class="home-page-map">
        <?php
            echo mh_display_discover($title='Vist');
            mh_display_map($type='global');
            
?>
        <div class="featuredItem-text">
            <div class="featuredItem-textInner">
                <h3 class="featuredItem-title"><a href="#">Check out the map to visit MHC Locations!</a></h3>
            </div>
        </div>
        </section>



        

    </article>
</div> <!-- end content -->
<div class="grey-banner">
</div>
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
