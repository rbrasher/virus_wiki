<div class="breadcrumb blue" onclick="history.back();return false;">&laquo; Back</div>
<div class="white_box">
    <div class="virus_title">Add a New Category</div>
</div>
<div class="white_box">
    <?php echo validation_errors('<p class="error">');?>
</div>
<div class="gray_box">
    <?php echo form_open_multipart('admin/add_category', array('id' => 'add_category_form')); ?>

        <div class="row">
            <label>Category Name:</label>
            <input type="text" id="category_name" name="category_name" value="" />
        </div>

        <div class="row" style="text-align: center; margin-top: 20px;">
            <input type="submit" name="submit" id="submit" value="Submit" />
        </div>
    
    <?php echo form_close();?>
   
</div>