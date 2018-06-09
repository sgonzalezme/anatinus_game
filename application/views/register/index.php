<h3>Registration form</h3><hr/>
<div class="error_msg">
    <?php if (isset($error_message)) {
        echo $error_message;
    }
    echo validation_errors();
    ?>
</div>

<div class="form-group col-md-4">
    <?php echo form_open('register/index'); ?>
        <label for="username">Username: </label>
        <input name="username" id="username" type="text" class="form-control" placeholder="john.doe" /> <br/>
        <label for="password">Password: </label>
        <input name="password" id="password" type="password" class="form-control" placeholder="********" /> <br/>
        <label for="repeat_password">Repeat password: </label>
        <input name="repeat_password" id="repeat_password" type="password" class="form-control" placeholder="********" /> <br/>
        <button class="btn btn-primary" type="submit">Create user</button><br />
    <?php echo form_close(); ?>

    <a href="<?php echo site_url('/login/index') ?>">Already an user? Log in</a>
</div>