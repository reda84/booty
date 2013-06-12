<?php 

class OffsetContentBlock extends PostMeta {

    public function __construct() {
        parent::__construct();
        add_action('add_meta_boxes', array($this, 'addMetaBoxes'));
    }

    function addMetaBoxes() {
        parent::addMetaBoxes();
        $this->addMetaBox('post_options', 'Post Options', 'page', "normal");
        
    }

    function renderBlock($data){
    	extract($data);
    	echo '<div class="span'. $size.'"></div>'."\n";
 		
	}
}