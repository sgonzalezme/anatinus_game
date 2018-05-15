<h3>Login Form</h3><hr/>

<div class='error_msg'>
    <?php if (isset($error_message)) {
        echo $error_message;
    }
    echo validation_errors();
    ?>
</div>

<?php echo form_open('login/index'); ?>
    <label for="username">Username :</label>
    <input type="text" name="username" id="username" placeholder="username"/><br /><br />
    <label for="password">Password :</label>
    <input type="password" name="password" id="password" placeholder="**********"/><br/><br />
    <input type="submit" value="Login"/><br />
    <a href="<?php echo site_url('/register/index')?>">Not a member? Sign up here</a>
<?php echo form_close(); ?>