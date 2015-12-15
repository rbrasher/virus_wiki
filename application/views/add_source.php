<div class="breadcrumb blue" onclick="history.back();return false;">&laquo; Back</div>
<div class="white_box">
    <div class="virus_title">Add a New Source</div>
</div>
<div class="white_box">
    <?php echo validation_errors('<p class="error">');?>
</div>
<div class="gray_box">
    <?php echo form_open_multipart('admin/add_source', array('id' => 'add_source_form')); ?>

        <div class="row">
            <label>Source Name:</label>
            <input type="text" id="source_name" name="source_name" value="" />
        </div>

        <div class="row">
            <label>Source Website:</label>
            <input type="text" id="source_website" name="source_website" value="" />
        </div>
        
        <div class="row">
            <label>Source Logo:</label>
            <?php echo form_upload(array('name' => 'source_logo', 'id' => 'source_logo', 'class' => 'file_upload'));?>
        </div>

        <div class="row" style="text-align: center; margin-top: 20px;">
            <input type="submit" name="submit" id="submit" value="Submit" />
        </div>
    
    <?php echo form_close();?>
   
</div>