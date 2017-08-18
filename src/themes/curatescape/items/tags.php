<?php 
	$tags=get_records('Tag',array('sort_field' => 'count', 'sort_dir' => 'd'),0);
	echo head(array('maptype'=>'focusarea', 'title'=>'Browse by Tag','bodyid'=>'items','bodyclass'=>'browse tags')); 
	?>


<section class="allTagsScreen section">		
        <header>
            <h2 class="allTags-title"><?php echo __('Tags: %s', total_records('Tags'));?></h2>
        </header>

	    <nav class="secondary-nav" id="tag-browse"> 
			<?php mh_item_browse_subnav(); ?>
	    </nav>
	
	    <?php // echo fog_tag_cloud($tags, url('items/browse'), 9, false, null, array('class' => 'browseTag')); ?>

        <div class="allTagsList">
        <?php foreach ($tags as $tag) {
            $_href = url('/items/browse', array('tags' => $tag['name']));

            $href = html_escape($_href);

            echo '<a class="allTagsList-tag" href="' . $href . '">' . $tag['name'] . '</a>';
        }?>
        </div>
</section>	

<div id="share-this" class="browse">
<?php echo mh_share_this();?>
</div>
<?php echo foot(); ?>
