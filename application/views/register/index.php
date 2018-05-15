<h3>Registration form</h3><hr/>
<div class="error_msg">
    <?php
        echo validation_errors();
        if (isset($error_message)) {
            echo $error_message;
        }
    ?>
</div>
<?php echo form_open('register/index'); ?>

    <label for="username">Username: </label>
    <input name="username" id="username" type="text" placeholder="john.doe" /> <br/>
    <label for="password">Password: </label>
    <input name="password" id="password" type="password" placeholder="********" /> <br/>
    <label for="repeat_password">Repeat password: </label>
    <input name="repeat_password" id="repeat_password" type="password" placeholder="********" /> <br/>
    <input type="submit" value="Create user"/><br />

<?php echo form_close(); ?>
<a href="<?php echo site_url('/login/index') ?>">Already an user? Log in</a>