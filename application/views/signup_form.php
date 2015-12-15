<div class="white_box">
    <div class="virus_title">Create an Account</div>
</div>
<div class="gray_box">

        <?php echo form_open('login/create_user', array('id' => 'signup_form')); ?>
        <?php echo validation_errors('<p class="error">');?>
        <fieldset>
            <legend>Personal Information</legend>
            <div class="row">
                <?php
                    echo form_label('First Name:');
                    echo form_input(array('id'=>'first_name', 'name'=>'first_name', 'class'=>'rounded', 'value'=> set_value('first_name')));
                ?>
            </div>

            <div class="row">
                <?php
                    echo form_label('Last Name:');
                    echo form_input(array('id'=>'last_name', 'name'=>'last_name', 'class'=>'rounded', 'value'=>set_value('last_name')));
                ?>
            </div>

            <div class="row">
                <?php
                    echo form_label('Email Address:');
                    echo form_input(array('id'=>'email_address', 'name'=>'email_address', 'class'=>'rounded', 'value'=> set_value('email_address')));
                ?>
            </div>

        </fieldset>

        <fieldset>
            <legend>Login Info</legend>

            <div class="row">
                <?php
                    echo form_label('Username');
                    echo form_input(array('id' => 'username', 'name' => 'username', 'class' => 'rounded', 'value' => set_value('username')));
                ?>
            </div>

            <div class="row">
                <?php
                    echo form_label('Password');
                    echo form_password(array('id' => 'password', 'name' => 'password', 'class' => 'rounded', 'value' => set_value('password')));
                ?>
            </div>

            <div class="row">
                <?php
                    echo form_label('Confirm Password');
                    echo form_password(array('id' => 'password_confirm', 'name' => 'password_confirm', 'class' => 'rounded', 'value' => set_value('password_confirm')));
                ?>
            </div>
            <div class="row centered" style="margin-top: 10px;">
                <?php echo form_submit('submit', 'Create Account');?>
            </div>
        </fieldset>
        <?php echo form_close();?>
    
</div>
