<?php
$dc = get_theme_option('dropcap')==1 ? 'dropcap' : null;
echo head(array(
    'item'=>$item,
    //'maptype'=>'story',
    'maptype'=>'none',
    'bodyid'=>'items',
    'bodyclass'=>'show item-story '.$dc,
    'title' => metadata($item,array('Dublin Core', 'Title'))
));
?>

<article class="item instapaper_body hentry" role="main">

    <header class="item-header">
        <div class="item-headerImage"
            style="background-image: url(<?php echo file_display_url($item->Files[0]) ?>)">
        </div>

        <div class="section container">
            <h2 class="item-title">
                <?php echo metadata($item, array('Dublin Core', 'Title'), array('index'=>0)); ?>
            </h2>
        </div>
        <!--
         <h3 class="item-subtitle">
            <?php //echo mh_the_subtitle($item); ?>
        </h3>
        -->

        <?php //echo mh_the_byline($item,true,true); echo item_is_private($item);?>
    </header>

    <section class="item-metadata section instapaper_ignore">
        <div class="f-h3 item-legend"> Info </div>

        <div class="item-fieldset container">
            <aside id="factoid">
            <?php echo mh_factoid(); ?>
            </aside>

            <div id="access-info">
            <?php echo mh_the_access_information(); ?>
            </div>

            <div id="street-address">
            <?php echo mh_street_address();?>
            </div>

            <div id="official-website">
            <?php echo mh_official_website();?>
            </div>

            <div id="cite-this">
            <?php echo mh_item_citation(); ?>
            </div>

            <?php if(function_exists('tours_for_item')){
                 $label=mh_tour_label_option('plural');
                 echo tours_for_item($item->id, __('Related %s', $label));
            }?>

            <div id="subjects">
            <?php mh_subjects(); ?>
            </div>

            <div id="tags">
            <?php mh_tags();?>
            </div>

            <?php echo function_exists('tour_nav') ? tour_nav(null,mh_tour_label()) : null; ?>

            <div class="item-related-links">
            <?php mh_related_links();?>
            </div>

            <div class="date-stamp">
            <?php echo mh_post_date(); ?>
            </div>

            <div class="comments">
            <?php mh_display_comments();?>
            </div>
        </div>
    </section>

    <section class="item-copy section" style="padding-top: 0px;">
        <div class="container">
            <div class="item-map">
                <h2 class="f-upper f-body" style="margin-bottom: 24px;"> Where can I find it? </h2>
                <?php echo mh_display_map('story') ?>
                <?php mh_map_actions($item,null);?>

            </div>

            <div class="item-lede">
                <?php echo mh_the_lede($item);?>
            </div>

            <div class="item-description">
                <h2 class="f-upper f-body" style="margin-bottom: 24px"> Description </h2>
                <?php echo mh_the_text($item); ?>
            </div>
        </div>
    </section>

    <section class="item-media section">
        <div class="container">
            <?php mh_item_images($item);?>

            <?php mh_audio_files($item);?>

            <?php mh_video_files($item);?>
        </div>
    </section>


    <div id="share-this" class="instapaper_ignore">
        <?php echo mh_share_this(mh_item_label());?>
    </div>

</article>

<script>

    if(jQuery('.tour-nav').length > 0){
        jQuery(window).scroll(function() {
            if( (jQuery('.meta').isOnScreen() || jQuery('footer.main').isOnScreen()) !== false) {
                jQuery('.tour-nav').addClass('look-at-me');
            }else{
                jQuery('.tour-nav').removeClass('look-at-me');
            }
        }).scroll();
    }

</script>

<?php echo foot(); ?>
