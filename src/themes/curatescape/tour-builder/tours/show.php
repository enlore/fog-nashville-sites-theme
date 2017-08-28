<?php
$tourTitle = strip_formatting( tour( 'title' ) );
$label = mh_tour_label();
$heroImageUrl = fog_get_image_url_of_first_public_item($tour);
//var_dump($tour);


if( $tourTitle != '' && $tourTitle != '[Untitled]' ) {
} else {
   $tourTitle = '';
}
$dc = get_theme_option('dropcap')==1 ? 'dropcap' : null;
echo head( array( 'maptype'=>'tour','title' => ''.$label.' | '.$tourTitle, 'content_class' => 'horizontal-nav', 'bodyid'=>'tours',
   'bodyclass' => 'show tour '.$dc, 'tour'=>$tour ) );
?>

<article class="tour" role="main">

    <header class="tourShow-header">
        <h2 class="tourShow-title instapaper_title">
            <span class="tourShow-title--raggedBackground">
                <?php echo $tourTitle; ?>
            </span>
        </h2>

        <?php if ($heroImageUrl !== null) {
            echo '<div class="tourShow-heroImage" style="background-image: url(' . $heroImageUrl . ')"></div>';
        } ?>

    </header>

    <section class="tourShow-copy section">
        <?php if(tour( 'Credits' )){
            echo '<div class="tourShow-credits">'
                    .'<h2 class="tourShow-sectionLabel">Credits</h2>'
                    .'<p>'
                        .__('%1s curated by: %2s', mh_tour_label_option('singular'),tour( 'Credits' ))
                    .'</p>'
                .'</div>';
        }elseif(get_theme_option('show_author') == true){
            echo '<div class="tourShow-credits">'
                    .'<h2 class="tourShow-sectionLabel">Credits</h2>'
                    .'<p>'
                        .__('%1s curated by: The %2s Team',mh_tour_label_option('singular'),option('site_title'))
                    .'</p>'
                .'</div>';
        }else{}?>


       <div class="tourShow-description">
           <h2 class="tourShow-sectionLabel"> About This Tour </h2>
            <?php echo htmlspecialchars_decode(nls2p( tour( 'Description' ) )); ?>
       </div>

       <div class="tourShow-postscript">
        <?php echo htmlspecialchars_decode(metadata('tour','Postscript Text')); ?>
       </div>

       <div class="tourShow-map">
           <?php mh_display_map('tour', null, $tour) ?>
           <?php mh_map_actions(null, $tour, null, null);?>
       </div>
    </section>

    <section class="tourShow-items section">
        <h2 class="tourShow-itemsTitle"><?php echo __('Stops Along the %s', $label);?></h2>

         <?php
         $i = 1;

         foreach( $tour->getItems() as $tourItem ):
            if ($tourItem->public) {
                set_current_record( 'item', $tourItem );
                $itemID=$tourItem->id;
                $hasImage=metadata($tourItem,'has thumbnail');
                $itemHref = url('/') . 'items/show/' . $itemID . '?tour=' . tour( 'id' ) . '&index=' . ($i-1) . '';
         ?>
                 <div class="tourShow-item <?php echo $hasImage ? 'has-image' : null;?>">
                     <h3 class="tourShow-itemTitle">
                        
                         <a href="<?php echo $itemHref; ?>">
                             <?php //echo '<span class="number">'.$i.'</span>';?>
                             <?php echo metadata( $tourItem, array('Dublin Core', 'Title') ); ?>
                         </a>
                    </h3>

        <?php
                if ($hasImage){
                    preg_match('/<img(.*)src(.*)=(.*)"(.*)"/U', item_image('fullsize'), $result);
                    $item_image = array_pop($result);
                }
                echo isset($item_image) ? '<a href="'. url('/') .'items/show/'.$itemID.'?tour='.tour( 'id' ).'&index='.($i-1).'"><div class="tourShow-itemImage" style="background-image:url('.$item_image.');"></div></a>' : null;
        ?>

                     <div class="tourShow-itemDescription"><?php echo snippet(mh_the_text($tourItem),0,250); ?></div>
                 </div>
         <?php
                 $i++;
                 $item_image=null;
             }

         endforeach;
         ?>
    </section>

    <section class="comments">
        <?php echo (get_theme_option('tour_comments') ==1) ? mh_display_comments() : null;?>
    </section>

</article>

<div id="share-this" class="browse">
<?php echo mh_share_this(mh_tour_label()); ?>
</div>

<?php echo foot(); ?>
