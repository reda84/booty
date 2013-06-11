


<?php
$this->text("test_multi[]","test_multi");
$this->text("test_multi[]","test_multi");
$this->text("test_multi[]","test_multi");
$this->text("test_multi[]","test_multi");
?>

<div id="available-widgets">

    <select id="page-select-element-list">
        <option> Please select item </option>
        <option>Accordion</option>
        <option>Blog</option>
        <option>Contact-Form</option>
        <option>Column</option>
        <option>Content</option>
        <option>Divider</option>
        <option>Feature-Media</option>
        <option>Gallery</option>
        <option>Message-Box</option>
        <option>Page</option>
        <option>Portfolio</option>
        <option>Price-Item</option>
        <option>Slider</option>
        <option>Stunning-Text</option>
        <option>Tab</option>
        <option>Testimonial</option>
        <option>Toggle-Box</option>
        <option>Twitter</option>							
    </select>
    <input type="button" id="page-add-item-button" class="page-add-item-button" value="Add item">
    
    
    <ul id="sortable1" class="connectedSortable">
        <li class="ui-state-default grey-gre">
            <div class="delete item-action"></div>
            <div class="edit item-action"></div>
            <div class="content">Item 1</div>
        </li>
        
    </ul>   
</div>
<div id="page-content">


    <div id="grid">





    </div>
    <ul id="sortable2" class="connectedSortable"> 
 <?php 
$post_id = $_GET["post"];

 $items = get_post_meta(2, "booty_post_options",true);
 
 $items = json_decode($items);
 
print_r($items);
foreach ($items as $item) : ?> 


<li class="booty-item ui-state-default grey-gre ui-resizable"><?php echo $item->item; ?></li>
    <?php endforeach; ?> 

    </ul>
</div>