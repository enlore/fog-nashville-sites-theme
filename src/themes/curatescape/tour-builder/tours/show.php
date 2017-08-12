<?php
$tourTitle = strip_formatting( tour( 'title' ) );
$label = mh_tour_label();
if( $tourTitle != '' && $tourTitle != '[Untitled]' ) {
} else {
   $tourTitle = '';
}
$dc = get_theme_option('dropcap')==1 ? 'dropcap' : null;
echo head( array( 'maptype'=>'tour','title' => ''.$label.' | '.$tourTitle, 'content_class' => 'horizontal-nav', 'bodyid'=>'tours',
   'bodyclass' => 'show tour '.$dc, 'tour'=>$tour ) );
?>

<?php mh_map_actions(null,$tour);?>

<article class="tour show" role="main">
    <header id="tourShow-header">
        <h2 class="tourShow-title instapaper_title"><?php echo $tourTitle; ?></h2>

        <?php if(tour( 'Credits' )){
            echo '<span class="tourShow-meta">'.__('%1s curated by: %2s', mh_tour_label_option('singular'),tour( 'Credits' )).'</span>';
        }elseif(get_theme_option('show_author') == true){
            echo '<span class="tourShow-meta">'.__('%1s curated by: The %2s Team',mh_tour_label_option('singular'),option('site_title')).'</span>';
        }else{}?>
    </header>
            
    <div id="primary">
        <section id="text">
           <div id="tourShow-description">
            <?php echo htmlspecialchars_decode(nls2p( tour( 'Description' ) )); ?>
           </div>

           <div id="tourShow-postscript">
            <?php echo htmlspecialchars_decode(metadata('tour','Postscript Text')); ?>
           </div>
        </section>
           
        <section id="tourShow-items">
            <h3><?php echo __('Locations for %s', $label);?></h3>

             <?php 
             $i = 1;

             foreach( $tour->getItems() as $tourItem ): 
                if ($tourItem->public) {
                    set_current_record( 'item', $tourItem );
                    $itemID=$tourItem->id;
                    $hasImage=metadata($tourItem,'has thumbnail');
             ?>
                     <article class="item-result <?php echo $hasImage ? 'has-image' : null;?>">
                         <h3>
                            <a class="permalink" href="<?php echo url('/') ?>items/show/<?php echo $itemID.'?tour='.tour( 'id' ).'&index='.($i-1).''; ?>"><?php echo '<span class="number">'.$i.'</span>';?> 
                             <?php echo metadata( $tourItem, array('Dublin Core', 'Title') ); ?>
                             </a>
                        </h3>

            <?php
                    if ($hasImage){
                        preg_match('/<img(.*)src(.*)=(.*)"(.*)"/U', item_image('fullsize'), $result);
                        $item_image = array_pop($result);				
                    }
                    echo isset($item_image) ? '<a href="'. url('/') .'items/show/'.$itemID.'?tour='.tour( 'id' ).'&index='.($i-1).'"><span class="item-image" style="background-image:url('.$item_image.');"></span></a>' : null; 
            ?>
                                     
                         <div class="item-description"><?php echo snippet(mh_the_text($tourItem),0,250); ?></div>
                     </article>
             <?php 
                     $i++;
                     $item_image=null;
             
                 }

             endforeach;
             ?>
        </section>

        <div class="comments">
            <?php echo (get_theme_option('tour_comments') ==1) ? mh_display_comments() : null;?>
        </div>			   
    </div>
</article>

<div id="share-this" class="browse">
<?php echo mh_share_this(mh_tour_label()); ?>
</div>

<?php echo foot(); ?>
