<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of meta
 *
 * @author reda
 */
include_once '/../base.php';

class Meta extends Base {

    function __construct() {
        parent::__construct();
        add_action('save_post', array($this, 'save_meta_boxes'));
    }

    public function text($id, $label, $desc = '') {
        global $post;

        $html .= '<div class="' . $this->fName . '_metabox_field">';
        $html .= '<label for="' . $this->fName . '_' . $id . '">';
        $html .= $label;
        $html .= '</label>';
        $html .= '<div class="field">';
        $html .= '<input type="text" id="' . $this->fName . '_' . $id . '" name="' . $this->fName . '_' . $id . '" value="' . get_post_meta($post->ID, $this->fName . '_' . $id, true) . '" />';
        if ($desc) {
            $html .= '<p>' . $desc . '</p>';
        }
        $html .= '</div>';
        $html .= '</div>';

        echo $html;
    }

    public function select($id, $label, $options, $desc = '') {
        global $post;

        $html .= '<div class="' . $this->fName . '_metabox_field">';
        $html .= '<label for="' . $this->fName . '_' . $id . '">';
        $html .= $label;
        $html .= '</label>';
        $html .= '<div class="field">';
        $html .= '<select id="' . $this->fName . '_' . $id . '" name="' . $this->fName . '_' . $id . '">';
        foreach ($options as $key => $option) {
            if (get_post_meta($post->ID, $this->fName . '_' . $id, true) == $key) {
                $selected = 'selected="selected"';
            } else {
                $selected = '';
            }

            $html .= '<option ' . $selected . 'value="' . $key . '">' . $option . '</option>';
        }
        $html .= '</select>';
        if ($desc) {
            $html .= '<p>' . $desc . '</p>';
        }
        $html .= '</div>';
        $html .= '</div>';

        echo $html;
    }

    public function save_meta_boxes($post_id) {


        
         $post_options = array();
        

        
         $items = $_POST["booty_item-name"];
         $items_size = $_POST["booty_item-width"];



        $i=0;
        foreach ($items as $item) {
            
            $post_options[] = array(
                    "item" => $item,
                    "size" => $items_size[$i],
                );
            $i++;
        }
        $value = json_encode($post_options);
        update_post_meta($post_id, "booty_post_options", $value);

    }

}

?>
