<?php
    $fileTitle = metadata('file', array('Dublin Core', 'Title')) ? strip_formatting(metadata('file', array('Dublin Core', 'Title'))) : metadata('file', 'original filename');

    echo head(array('file'=>$file, 'maptype'=>'none','bodyid'=>'file','bodyclass'=>'show item-file','title' => $fileTitle )); 
?>

<article class="file instapaper_body hentry" role="main">
    <header class="file-header">
        <h1 class="item-title"><?php echo $fileTitle; ?></h1>

        <?php 
            $info          = array();
            $record        = get_record_by_id('Item', $file->item_id);
            $title         = metadata($record, array('Dublin Core','Title'));
            $appearsInLink = link_to_item('<i class = "icon-chevron-left"></i>'.__('This file appears in: <em><strong>%s</strong></em>', $title), array('class' =>'file-appears-in-item'), 'show', $record);
            $rights        = metadata('file', array('Dublin Core','Rights'));
            $desc          = metadata('file', array('Dublin Core','Description'));

            ($fileid=metadata('file', 'id')) ? $info[]='<span class="file-id">ID: '.$fileid.'</span>' : null;

            ($source=metadata('file', array('Dublin Core','Source'))) ? $info[] = '<span class="file-source">Source: '.$source.'</span>' : null;
            ($creators=metadata('file', array('Dublin Core','Creator'),true)) ? $info[] = '<span class="file-creator">Creator: '.mh_format_creators_string($creators).'</span>' : null;

        //echo count($info)
            //?  '<span class="file-header-info" class="story-meta byline">'
                //.link_to_file_edit($file,' ')
            //.'</span>'
            //: null;
            //
            $citation = '<div class="file-citation">' . implode(" | ", $info) . '</div>';
        ?>
    </header>

    <div class="file-body">
        <div class="columns is-desktop">
            <div class="column file-content">
                <div class="file-contentInnter" style="display: inline-block; margin: 0 auto;">
                    <?php echo $citation; ?>
                    <?php echo mh_single_file_show($file); ?>
                    <?php if ($rights) echo '<div class="rights-caption">'.$rights.'</div>';?>
                    <?php echo $desc ? '<p class="file-desc">'.$desc.'</p>' : null; ?>  
                    <?php echo $appearsInLink; ?>   
                </div>
            </div>

            <div class="column">
                <h2 class="f-body item-legend"> INFO </h2>

                <div class="file-metadata item-fieldset file-pad-left">
                    <?php echo all_element_texts('file'); ?>        

                    <div class="format-metadata element-set">
                        <h2 class="element-setTitlte element-setTitleFormat"><?php echo __('Format Metadata'); ?></h2>

                        <div class="original-filename element">
                            <h3><?php echo __('Original Filename'); ?></h3>
                            <div class="element-text"><?php echo metadata('file', 'Original Filename'); ?></div>
                        </div>

                        <div class="file-size element">
                            <h3><?php echo __('File Size'); ?></h3>
                            <div class="element-text"><?php echo __('%s bytes', metadata('file', 'Size')); ?></div>
                        </div>

                    </div><!-- end format-metadata -->

                    <div class="type-metadata element-set">
                        <h2 class="element-setTitle element-setTitleType"><?php echo __('Type Metadata'); ?></h2>

                        <div class="mime-type-browser element">
                            <h3><?php echo __('Mime Type'); ?></h3>
                            <div class="element-text"><?php echo metadata('file', 'MIME Type'); ?></div>
                        </div>

                        <div class="file-type-os element">
                            <h3><?php echo __('File Type / OS'); ?></h3>
                            <div class="element-text"><?php echo metadata('file', 'Type OS'); ?></div>
                        </div>
                    </div><!-- end type-metadata -->

                </div><!-- end file-metadata -->
            </div>
        </div>
    </div>
</article>


<div id="share-this" class="browse">
<?php echo mh_share_this(__('File'));?>
</div>  

<?php echo foot(); ?>
