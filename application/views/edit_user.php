<div class="breadcrumb blue" onclick="history.back();return false;">&laquo; Back</div>
<div class="white_box">
    <div class="virus_title">Edit User</div>
</div>
<div class="white_box">
    <?php echo validation_errors('<p class="error">');?>
</div>
<div class="gray_box">
    <?php echo form_open_multipart('admin/edit_user/' . $user['id'], array('id' => 'edit_user_form')); ?>

        <div class="row">
            <label>First Name:</label>
            <input class="rounded" type="text" id="user_first_name" name="user_first_name" value="<?php echo $user['first_name'];?>" />
        </div>

        <div class="row">
            <label>Last Name:</label>
            <input class="rounded" type="text" id="user_last_name" name="user_last_name" value="<?php echo $user['last_name'];?>" />
        </div>
        
        <div class="row">
            <label>Username:</label>
            <input class="rounded" type="text" name="user_username" id="user_username" value="<?php echo $user['username'];?>" />
        </div>
    
        <div class="row">
            <label>Password:</label>
            <input class="rounded" type="text" name="user_password" id="user_password" value="<?php echo $user['password'];?>" />
        </div>
    
        <div class="row">
            <label>Email Address:</label>
            <input class="rounded" type="text" name="user_email" id="user_email" value="<?php echo $user['email_address'];?>" />
        </div>
    
        <div class="row">
            <label>Admin:</label>
            <?php echo form_checkbox(array('name' => 'chk_admin', 'id' => 'chk_admin', 'checked' => $user['admin']));?>
        </div>

        <div class="row" style="text-align: center; margin-top: 20px;">
            <input type="submit" name="submit" id="submit" value="Submit" />
        </div>
    
    <?php echo form_close();?>
   
</div>
<script type="text/javascript">
$(function() {
    $('#chk_admin').click(function() {
        if(this.checked)
            this.value = 1;
        
        if(!this.checked)
            this.value = 0;
    });
});
</script>