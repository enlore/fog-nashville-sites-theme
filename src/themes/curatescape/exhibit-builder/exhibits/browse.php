<?php 
$tag = (isset($_GET['tag']) ? $_GET['tag'] : null);
$tags = (isset($_GET['tags']) ? $_GET['tags'] : null);
$term = (isset($_GET['term']) ? $_GET['term'] : null);
$query = (isset($_GET['search']) ? $_GET['search'] : null);
$advanced = (isset($_GET['advanced']) ? true : false);
$bodyclass='browse';
$maptype='focusarea';

if ( (isset($tag) || isset($tags)) && !isset($query) ) {
	$title = __('Exhibits tagged "%s"',($tag ? $tag : $tags));
	$bodyclass .=' queryresults';
	$maptype='queryresults';
}
elseif ( isset($term) && !isset($query) ) {
	$title = __('Results for subject term "%s"',$term);
	$bodyclass .=' queryresults';
	$maptype='queryresults';
}
elseif (isset($query)) {
	$title = (!($advanced) ? __('Search Results for "%s"',$query) :__('Advanced Search Results'));
	$bodyclass .=' queryresults';
	$maptype='queryresults';
}	
else{
	$title = __('All Exhibits');
	$bodyclass .=' exhibits stories';
}	
echo head(array('maptype'=>'none','title'=>$title,'bodyid'=>'exhibits','bodyclass'=>$bodyclass)); 

$title .= ( ($total_results) ? ': <span class="item-number">'.$total_results.'</span>' : '');
?>

<section class="section">	
	<h2><?php echo $title; ?></h2>

    <?php if (count($exhibits) > 0): ?>
        <nav class="secondary-nav" id="item-browse"> 
            <?php echo nav(array(
                array(
                    'label' => __('All'),
                    'uri' => url('exhibits')
                ),
                array(
                    'label' => __('Tags'),
                    'uri' => url('exhibits/tags')
                )
            )); ?>
        </nav>    
    
    
    <div class="pagination"><?php echo pagination_links(); ?></div>
    
    <?php $exhibitCount = 0; ?>

    <?php foreach (loop('exhibit') as $exhibit): ?>
        <?php $exhibitCount++; ?>

        <div class="browseExhibit <?php if ($exhibitCount%2==1) echo ' even'; else echo ' odd'; ?>">
            <h2 class="browseExhibit-title"><?php echo link_to_exhibit(); ?></h2>

            <?php if ($exhibitDescription = metadata('exhibit', 'description', array('no_escape' => true))): ?>
                <div class="browseExhibit-description"><?php echo $exhibitDescription; ?></div>
            <?php endif; ?>

            <?php if ($exhibitTags = tag_string('exhibit', 'exhibits', '')): ?>
                <p class="browseExhibit-tags"><?php echo $exhibitTags; ?></p>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
    
    <div class="pagination"><?php echo pagination_links(); ?></div>

    <?php else: ?>
        <p><?php echo __('There are no exhibits available yet.'); ?></p>
    <?php endif; ?>
                    
</section>

<div id="share-this" class="browse">
<?php echo mh_share_this();?>
</div>

<?php echo foot(); ?>
