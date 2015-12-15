<div class="breadcrumb blue" onclick="history.back();return false;">&laquo; Back</div>
<div class="white_box">
    <div class="virus_title">Edit Source</div>
</div>
<div class="white_box">
    <?php echo validation_errors('<p class="error">');?>
</div>
<div class="gray_box">
    <?php echo form_open_multipart('admin/edit_source/' . $source['id'], array('id' => 'edit_source_form')); ?>

        <div class="row">
            <label>Source Name:</label>
            <input class="rounded" type="text" id="source_name" name="source_name" value="<?php echo $source['name'];?>" />
        </div>

        <div class="row">
            <label>Source Website:</label>
            <input class="rounded" type="text" id="source_website" name="source_website" value="<?php echo $source['website'];?>" />
        </div>
        
        <div class="row">
            <label>Source Logo:</label>
            <input type="text" readonly="true" name="source_logo" id="source_logo" value="<?php echo $source['logo'];?>" style="border: 0 none; background: none;" />
            
        </div>
    
        <div class="row centered" style="margin-top: 10px;">
            <img src="<?php echo base_url();?>images/sources/<?php echo $source['logo'];?>" />
        </div>

        <div class="row" style="text-align: center; margin-top: 20px;">
            <input type="submit" name="submit" id="submit" value="Submit" />
        </div>
    
    <?php echo form_close();?>
   
</div>