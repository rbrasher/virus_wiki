<div id="content">
    <div class="gray_box">
        <div id="login_form">
                <?php echo form_open('login/validate_credentials');?>
            <div class="row">
                <?php
                    echo form_label('Username', 'username') . '<br />';
                    echo form_input(array('id' => 'username', 'value' => '', 'name' => 'username', 'class'=>'rounded'));
                ?>
            </div>

            <div class="row">
                <?php
                    echo form_label('Password&nbsp;', 'password') . '<br />';
                    echo form_password(array('id' => 'password', 'value' => '', 'name' => 'password', 'class'=>'rounded'));
                ?>
            </div>

            <div class="row centered" style="margin-top: 10px;">
                <?php
                    echo form_submit('submit', 'Login');
                    echo anchor('../login/signup', 'Create Account', array('id' => 'ca_link', 'class' => 'black_btn'));
                ?>
            </div>
            <?php echo form_close();?>

        </div>
    </div>
</div>
