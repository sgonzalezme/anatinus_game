<h3>Login Form</h3><hr/>
<div class="error_msg">
    <?php if (isset($error_message)) {
        echo $error_message;
    }
    echo validation_errors();
    ?>
</div>

<div class="form-group col-md-4">
    <?php echo form_open('login/index'); ?>
        <label for="username">Username :</label>
        <input type="text" name="username" id="username" class="form-control" placeholder="username"/><br />
        <label for="password">Password :</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="**********"/><br/>
        <button class="btn btn-primary" type="submit">Login</button><br />
    <?php echo form_close(); ?>

    <a href="<?php echo site_url('/register/index')?>">Not a member? Sign up here</a>
</div>