<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of base
 *
 * @author reda
 */
class Base {
   protected $fName = "booty"; 
   protected $fURL = null;
   
   function __construct() {
        $this->fURL = get_bloginfo("template_url")."/framework/"; 
        
   }
           
}

?>
