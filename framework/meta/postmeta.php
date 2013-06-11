<?php

require_once 'meta.php';

class PostMeta extends Meta {

    private $boxes = array();

    public function __construct() {
        parent::__construct();          
     
        add_action( 'admin_enqueue_scripts',  array($this, 'my_enqueue') );
    }
    
    function my_enqueue() {
    wp_register_style( 'custom_wp_admin_css', $this->fURL .'css/style.css', false, '1.0.0' );
    wp_enqueue_style( 'custom_wp_admin_css' );
    wp_enqueue_script( 'my_custom_script', $this->fURL ."js/custom.js") ;
}


    function addMetaBox($boxId, $boxTitle, $postType, $context) {
        add_meta_box(
                $this->fName . '_' . $boxId, __($boxTitle, $this->fName), array($this, "loadBoxView"), $postType, $context, 'default', array(
            "view" => $boxId
                )
        );
        return $this;
    }

    function addMetaBoxes() {
        
    }

    function loadBoxView($post , $boxMeta) {
        include 'views/metaboxes/' . $boxMeta["args"]["view"] . '.php';
    }

}

class PostPostMeta extends PostMeta {

    public function __construct() {
        parent::__construct();
        add_action('add_meta_boxes', array($this, 'addMetaBoxes'));
    }

    function addMetaBoxes() {
        parent::addMetaBoxes();
        $this->addMetaBox('post_options', 'Post Options', 'page', "normal");
        
    }
}
?>
