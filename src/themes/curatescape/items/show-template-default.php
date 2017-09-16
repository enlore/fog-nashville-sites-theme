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
        <h1 class="item-title">
            <div class="container">
                <?php echo metadata($item, array('Dublin Core', 'Title'), array('index'=>0)); ?>
            </div>
        </h1>

         <h3 class="item-subtitle">
            <?php //echo mh_the_subtitle($item); ?>
        </h3>

        <?php //echo mh_the_byline($item,true,true); echo item_is_private($item);?>
    </header>

    <div class="columns is-desktop columns-is-col">
        <div class="column">
            <section class="item-copy section" style="padding-top: 0px;">
                    <div class="item-description">
                        <h2 class="f-upper f-body" style="margin-bottom: 24px"> Description </h2>
                        <?php echo mh_the_text($item); ?>
                    </div>

                    <div class="item-map">
                        <h2 class="f-upper f-body" style="margin-bottom: 24px;"> Where can I find it? </h2>
                        <?php echo mh_display_map('story', $item) ?>
                        <?php mh_map_actions($item,null);?>

                    </div>

                    <div class="item-lede">
                        <?php echo mh_the_lede($item);?>
                    </div>
            </section>

            <section class="item-media section">
                <div class="columns flex-wrap">
                    <?php //mh_item_images($item);?>
                    <?php foreach($item->Files as $file):
                        $fileUrl = file_display_url($file);
                        $fileTitle = metadata($file, array('Dublin Core', 'Title'));
                        $fileDesc = metadata($file, array('Dublin Core', 'Description'));
                        $fileHref = record_url($file, 'show');
                        $fileElement = '';
                        $fileElement
                            .= '<div class="column is-half-desktop">'
                                .'<a href="'. $fileHref .'">'
                                    . '<div class="item-mediaImage" style="background-image: url('. $fileUrl .')">'
                                    . '</div>'

                                    . '<div class="item-mediaTitle f-h4">'
                                        . $fileTitle
                                    . '</div>'

                                    . '<div class="item-mediaDescription">'
                                        . $fileDesc
                                    . '</div>'
                                . '</a>'
                            . '</div>'
                            ;

                        echo $fileElement;
                    endforeach; ?>

                    <?php mh_audio_files($item);?>

                    <?php mh_video_files($item);?>
                </div>
            </section>


            <div id="share-this" class="instapaper_ignore">
                <?php echo mh_share_this(mh_item_label());?>
            </div>

        </div>

        <div class="column item-order-1-mobile">
            <section class="item-metadata section instapaper_ignore">
                <div class="item-headerImage"
                    style="background-image: url(<?php echo file_display_url($item->Files[0]) ?>)">
                </div>

                <div class="f-h3 item-legend"> Info </div>

                <div class="item-fieldset">
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


                <div class="item-tags">
                    <?php //mh_tags();?>
                    <?php if (metadata($item, 'has tags') ): ?>
                        <?php $tags=tag_string(get_current_record('item') , url('items/browse'), ''); ?>
                        <h2 class="item-tagsTitle f-body f-upper"> <?php echo __('Tags');?> </h2>

                        <div class="item-tagsList f-h4">
                            <?php echo $tags; ?>
                        </div>
                    <?php endif; ?>
                </div>

            </section>
        </div>
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
