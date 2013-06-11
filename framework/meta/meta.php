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


        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
         $post_content = array();
        foreach ($_POST as $key => $value) {
        if (strstr($key, $this->fName)) {
            $post_content[$key] = $value;
            }
        }
        
        $value = json_encode($post_content);
        
        update_post_meta($post_id, "bootypost_content", $value);

    }

}

?>
