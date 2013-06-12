<?php
include_once('meta/postmeta.php');
include_once('meta/offsetcontentblock.php');
class Booty extends Base{
    
    public $postMeta = null;
    public $offset = null;
    function __construct() {
        parent::__construct();
        $this->postMeta = new PagePostMeta();
        $this->offset = new OffsetContentBlock();
    }

    function renderPostBlocks($post_id){

$items = get_post_meta($post_id, "booty_post_options",true);
 
 $items = json_decode($items);
 

 $current_width = 0;
	foreach ($items as $item) {


if( ($current_width + $item->size) > 12){
	echo '</div><div class="row-fluid">';

	$current_width = 0;
}elseif($current_width == 0)
{

	echo '<div class="row-fluid">'."\n";
}else{echo "";}
		switch ($item->item) {
			case 'offset':
			 
				$this->offset->renderBlock(array("size"=> $item->size));

				break;
			
			 
		}
		$current_width = $current_width + $item->size;
 
	}
 
	echo "</div>\n";
 
		
	}
}
?>
