<?php
include_once('meta/postmeta.php');
class Booty extends Base{
    
    public $postMeta = null;
    function __construct() {
        parent::__construct();
        $this->postMeta = new PostPostMeta();
    }
}
?>
