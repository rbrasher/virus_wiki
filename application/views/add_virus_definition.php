<div class="white_box">
    <div class="virus_title">Add a Virus Definition</div>
</div>
<div class="white_box">
    <?php echo validation_errors('<p class="error">');?>
</div>
<div class="gray_box">
    <?php echo form_open_multipart('add_virus_definition', array('id' => 'add_virus_definition')); ?>

        <div class="half_row">
            <label>Source:</label>
            <select class="rounded" id="virus_source" name="virus_source">
                <option value="0">- Select a Source -</option>
                <?php foreach($sources as $source) { ?>
                <option value="<?php echo $source['id'];?>"><?php echo $source['name'];?></option>
                <?php } ?>
            </select>   
        </div>
    
        <div class="half_row">
            <label>Category:</label>
            <select class="rounded" id="virus_category" name="virus_category">
                <option value="0">- Select a Category -</option>
                <?php foreach($categories as $category) { ?>
                <option value="<?php echo $category['name'];?>"><?php echo $category['name'];?></option>
                <?php } ?>
            </select>
        </div>

        <div class="row">
            <label>Title:</label>
            <input class="rounded" type="text" id="virus_title" name="virus_title" value="" />
        </div>

        <div class="row">
            <label>Virus Pub Date:</label>
            <input class="rounded" type="text" id="virus_pub_date" name="virus_pub_date" value="" />
        </div>
        
        <div class="row">
            <label>Occurrences:</label>
            <?php echo form_input(array('name' => 'virus_occurences', 'id' => 'virus_occurences', 'class' => 'rounded'));?>
        </div>
    
        <div class="row">
            <label>Virus Definition:</label>
            <textarea id="virus_description" name="virus_description"></textarea>
        </div>
    
        <div class="row">
            <label>Additional Virus Details:</label>
            <textarea id="virus_additional_details" name="virus_additional_details"></textarea>
        </div>
    
        <div class="row">
            <label>Repair:</label>
            <textarea id="virus_repair" name="virus_repair"></textarea>
        </div>
    
        <div class="row">
            <label>Related Links:</label>
            <textarea id="virus_related_links" name="virus_related_links"></textarea>
        </div>
    
        <div class="row">
            <label>Read More Link:</label>
            <?php echo form_input(array('name' => 'virus_link', 'id' => 'virus_link', 'class' => 'rounded'));?>
        </div>

        <div class="row" style="text-align: center;">
            <input type="submit" name="submit" id="submit" value="Submit" />
        </div>
        
    
    <?php echo form_close();?>

     
   
</div>