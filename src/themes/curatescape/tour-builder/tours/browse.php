<?php
$label=mh_tour_label('plural');
echo head( array('maptype'=>'none', 'title' => $label, 'bodyid'=>'tours',
   'bodyclass' => 'browse' ) );
?>
    <section class="section browseToursSection">			

        <header>
            <h2><?php echo __('All %1$s: %2$s', $label, total_tours());?></h2>
        </header>

        <div id="primary" class="container">
            <div id="results">
                <nav class="tours-nav navigation secondary-nav">
                  <?php echo public_nav_tours(); ?>
                </nav>	

                <div class="pagination bottom"><?php echo pagination_links(); ?></div>

                <?php 
                
                if( has_tours() ){
                if( has_tours_for_loop() ){
                    $i=1;
                    $tourimg=0;
                    foreach( $tours as $tour ){ 
                    set_current_record( 'tour', $tour );
                    
                        $tourdesc = strip_tags( htmlspecialchars_decode(tour( 'description' )) );
                        $imgSrc = fog_get_image_url_of_first_public_item($tour);
                    
                        echo '<article id="item-result-'.$i.'" class="browseTour columns is-tablet is-desktop">';
                            echo '<div class="column">';
                                echo '<h3 class="browseTour-title">'.link_to_tour(null,array('class'=>'permalink')).'</h3>';
                                echo '<div class="browseTour-imageBg" style="background-image: url(' . $imgSrc . ')">' . '</div>';

                                echo '<div class="browseTour-meta">';
                                    if(tour( 'Credits' )){
                                        echo __('%1s curated by: %2s', mh_tour_label_option('singular'),tour( 'Credits' )).' | ';
                                    }elseif(get_theme_option('show_author') == true){
                                        echo __('%1s curated by: The %2s Team',mh_tour_label_option('singular'),option('site_title')).' | ';
                                    }		

                                    echo count($tour->Items).' '.__('Locations').
                                '</div>';
                            echo '</div>';
                        

                            echo '<div class="browseTour-description column"><p>'.snippet($tourdesc,0,250).'</p></div>'; 
                        echo '</article>';
                        $i++;
                    
                        }
                        
                    }
                }
                ?>
                
            </div>
        </div>
            
        <div class="pagination bottom"><?php echo pagination_links(); ?></div>

    </section>

<div id="share-this" class="browse">
<?php echo mh_share_this(); ?>
</div>

<?php echo foot();?>
