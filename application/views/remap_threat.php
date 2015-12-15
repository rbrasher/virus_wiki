<div class="white_box">
    <div class="virus_title">Remap Threat</div>
</div>
<div class="white_box">
    <?php echo validation_errors('<p class="error">');?>
</div>
<div class="gray_box">
    <?php echo form_open('../remap_threat/' . $threat['id'], array('id' => 'remap_threat_form')); ?>

    <?php echo form_fieldset('Mapping Data');?>
        <div class="half_row">
            <label>Engine:</label>
            <input class="rounded" type="text" readonly="true" id="engine" name="engine" value="<?php echo $threat['engine'];?>" />
        </div>
    
        <div class="half_row">
            <label>Threat:</label>
            <input class="rounded" type="text" readonly="true" id="threat" name="threat" value="<?php echo $threat['threat'];?>" />
        </div>
    
        <div class="half_row">
            <label>Category:</label>
            <input class="rounded" type="text" readonly="true" id="category" name="category" value="<?php echo $threat['category'];?>" />
        </div>
    
        <div class="half_row">
            <label>New Category:</label>
            <input class="rounded" type="text" id="new_category" name="new_category" value="<?php echo $threat['new_category'];?>" />
        </div>
    
        <div class="half_row">
            <label>Name:</label>
            <input class="rounded" type="text" readonly="true" id="name" name="name" value="<?php echo $threat['name'];?>" />
        </div>
    
        <div class="half_row">
            <label>New Name:</label>
            <input class="rounded" type="text" id="new_name" name="new_name" value="<?php echo $threat['new_name'];?>" />
        </div>
    
        <div class="half_row">
            <label>Group:</label>
            <input class="rounded" type="text" readonly="true" id="group" name="group" value="<?php echo $threat['group'];?>" />
        </div>
    
        <div class="half_row">
            <label>New Group:</label>
            <input class="rounded" type="text" id="new_group" name="new_group" value="<?php echo $threat['new_group'];?>" />
        </div>
        
    <?php echo form_fieldset_close();?>
    
    <div class="row" style="text-align: center; margin-top: 20px;">
        <input type="submit" name="submit" id="submit" value="Submit" />
    </div>
    <?php echo form_close();?>
   
</div>