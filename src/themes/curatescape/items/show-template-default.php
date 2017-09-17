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

    <div class="item-body float-container">
        <div class="float-right-desktop width-50-desktop pad-lr-desktop">
            <section class="item-headerImage"
                style="background-image: url(<?php echo file_display_url($item->Files[0]) ?>)">
            </section>

            <section class="item-metadata none block-desktop instapaper_ignore">
                <div class="f-h2 item-legend"> Info </div>

                <div class="item-fieldset item-fieldset--nopad">
                    <div id="factoid">
                        <?php echo mh_factoid(); ?>
                    </div>

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
                        <h3> <?php echo __('Cite this Page:'); ?> </h3>

                        <?php echo html_entity_decode(metadata('item', 'citation'));?>
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
                        <?php //mh_display_comments();?>
                    </div>
                </div>
            </section>

            <section class="item-tags none block-desktop pad-bot-desktop">
                <?php //mh_tags();?>
                <?php if (metadata($item, 'has tags') ): ?>
                    <?php $tags=tag_string(get_current_record('item') , url('items/browse'), ''); ?>
                    <h2 class="item-tagsTitle f-body f-upper"> <?php echo __('Tags');?> </h2>

                    <div class="item-tagsList f-h4">
                        <?php echo $tags; ?>
                    </div>
                <?php endif; ?>
            </section>
        </div>


        <!--
        <section class="item-lede width-50-desktop">
            <?php //echo mh_the_lede($item);?>
        </section>
        -->
        <section class="item-description">
            <h2 class="f-upper f-body" style="margin-bottom: 24px"> Description </h2>
            <?php echo mh_the_text($item); ?>
        </section>

        <section class="item-map float-clear-both">
            <h2 class="f-upper f-body" style="margin-bottom: 24px;"> Where can I find it? </h2>
            <?php echo mh_display_map('story', $item) ?>
            <?php mh_map_actions($item,null);?>
        </section>

        <section class="item-metadata none-desktop instapaper_ignore">
            <div class="f-h2 item-legend"> Info </div>

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
        </section>

        <section class="item-tags none-desktop">
            <?php //mh_tags();?>
            <?php if (metadata($item, 'has tags') ): ?>
                <?php $tags=tag_string(get_current_record('item') , url('items/browse'), ''); ?>
                <h2 class="item-tagsTitle f-body f-upper"> <?php echo __('Tags');?> </h2>

                <div class="item-tagsList f-h4">
                    <?php echo $tags; ?>
                </div>
            <?php endif; ?>
        </section>

        <section class="item-media">
            <h2 class="f-body f-upper"> Take a Look </h2>

            <div class="item-mediaGallery columns flex-wrap">
                <?php //mh_item_images($item);?>
                <?php foreach($item->Files as $file):
                    $fileUrl = file_display_url($file);
                $fileTitle = metadata($file, array('Dublin Core', 'Title'));
                $fileDesc = metadata($file, array('Dublin Core', 'Description'));
                $fileHref = record_url($file, 'show');
                $fileElement = '';
                $fileElement
                    .= '<div class="column is-6 is-4-desktop">'
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


        <section id="share-this" class="instapaper_ignore width-50-desktop">
            <?php echo mh_share_this('Page');?>
        </section>

        <div class="float-clear"></div>
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
