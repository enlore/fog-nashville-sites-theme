<?php 

// Determine which template to use based on the item type

$type = $item->getItemType();
$type = $type['name'];

// garbaaaaaaaage ugh
if (isset($_GET['tour'])) {
    include('show-stop-template.php');

} else {
    switch($type){

    //	case 'Curatescape Story':
    //	include('show-template-story.php');
    //	break;
        
        default:
        include('show-template-default.php');
        break;
        
    }
}
