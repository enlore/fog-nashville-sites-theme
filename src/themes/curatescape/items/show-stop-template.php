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

<?php mh_map_actions($item,null);?>

<article class="item instapaper_body hentry" role="main">

    <header class="item-header">
        <div class="item-headerImage"
            style="background-image: url(<?php echo file_display_url($item->Files[0]) ?>)">

            <div class="item-headerInner">
                <h2 class="item-title">
                    <span class="item-title--raggedBackground">
                        <?php echo metadata($item, array('Dublin Core', 'Title'), array('index'=>0)); ?>
                    </span>
                </h2>
            </div>

        </div>


        <!--
         <h3 class="item-subtitle">
            <?php //echo mh_the_subtitle($item); ?>
        </h3>
        -->

        <?php //echo mh_the_byline($item,true,true); echo item_is_private($item);?>
    </header>

    <section class="item-copy section" style="padding-top: 64px;">
        <div class="container">
            <div class="item-lede">
                <?php echo mh_the_lede($item);?>
            </div>

            <div class="item-description content">
                <h2 class="f-upper" style="margin-bottom: 24px"> Description </h2>
                <?php echo mh_the_text($item); ?>
            </div>
        </div>
    </section>

    <section>
        <div class="tourStop-pagination">
        <?php
        if ($prevItem) {
            echo '<a class="tourStop-paginationControl" href="' . $prevItemHref. '">'
                . 'Prev Stop'
                . '</a>';
        }

        echo '<a class="tourStop-paginationControl" href="' . $tourHref . '">'
            . 'Back to Start'
            . '</a>';

        if ($nextItem) {
            echo '<a class="tourStop-paginationControl" href="' . $nextItemHref. '">'
                . 'Next Stop'
                . '</a>';
        }
        ?>
        </div>
    </section>

    <section class="item-mapSection section">
        <div class="item-map">
            <h2 class="f-upper" style="margin-bottom: 24px;"> Where can I find it? </h2>
            <?php echo mh_display_map('story', $item, null) ?>
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
