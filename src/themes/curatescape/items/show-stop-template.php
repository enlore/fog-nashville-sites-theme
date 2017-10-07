<?php
//var_dump($this);
//var_dump($this->item);
//var_dump($this->item->Type);

$tourId = $_GET['tour'];
$tour = get_record('Tour', array('id' => $tourId));
$items = $tour->Items;
$itemCount = count($items);
$index = (int) $_GET['index'];

$isLastItem = $index == $itemCount - 1 ? true : false;
$isFirstItem = $index === 0;

if (count($item->Files) > 0) {
    $headerImageUrl = file_display_url($item->Files[0]);
} else {
    $headerImageUrl = '/themes/curatescape/images/logo-as-placeholder.png';
}

$nextItem = ! $isLastItem ? $items[$index + 1] : null;
$prevItem = $isFirstItem ? null : $items[$index - 1];

$nextItemHref = $nextItem ? record_url($nextItem, 'show', false, array('tour' => $tourId, 'index' =>  $index + 1)) : null;
$prevItemHref = $prevItem ? record_url($prevItem, 'show', false, array('tour' => $tourId, 'index' => $index - 1)) : null;
$tourHref = record_url($tour, 'show', false);

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
            <?php echo metadata($item, array('Dublin Core', 'Title'), array('index'=>0)); ?>
        </h1>

        <!--
         <h3 class="item-subtitle">
            <?php //echo mh_the_subtitle($item); ?>
        </h3>
        -->

        <?php //echo mh_the_byline($item,true,true); echo item_is_private($item);?>
    </header>

    <section class="item-copy section" style="">
        <div class="columns tourStop-columns">
            <div class="column">
                <div class="item-lede">
                    <?php echo mh_the_lede($item);?>
                </div>

                <div class="item-description item-description--tight content">
                    <h2 class="f-upper f-body" style="margin-bottom: 24px"> Description </h2>
                    <?php echo mh_the_text($item); ?>
                </div>

                <div class="tourStop-pagination">
                    <?php
                        if ($prevItem) {
                            echo '<a class="tourStop-paginationControl tourStop-pagePrev" href="' . $prevItemHref. '">'
                                . 'Prev Stop'
                                . '</a>';
                        }

                        echo '<a class="tourStop-paginationControl tourStop-pageTop" href="' . $tourHref . '">'
                            . 'Back to Start'
                            . '</a>';

                        if ($nextItem) {
                            echo '<a class="tourStop-paginationControl tourStop-pageNext" href="' . $nextItemHref. '">'
                                . 'Next Stop'
                                . '</a>';
                        }
                    ?>
                </div>

                <div class="item-map">
                    <h2 class="f-upper f-body" style="margin-bottom: 24px;"> Where can I find it? </h2>
                    <?php echo mh_display_map('story', $item, null) ?>
                    <?php mh_map_actions($item,null);?>
                </div>
            </div>

            <div class="column tourStop-imageColumn">
                <div class="item-headerImage"
                    style="background-image: url(<?php echo $headerImageUrl; ?>)">
                </div>
            </div>
        </div>
    </section>

    <section class="item-media section">
        <h2 class="f-upper f-body"> Take a Look </h2>
        <div class="columns">
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

        <div class="container">
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
