<div class="panel">
    <?php echo $message;?>
   

<?php echo form_open(site_url()."/index.php/login/local_login"); ?>

Email Address<br/>
<?php echo form_error('email'); ?>
<input class="input" type="text" name="email" value="<?php echo set_value('email'); ?>" size="50" />
<br/>
Password<br/>
<?php echo form_error('password'); ?>
<input class="input" type="password" name="password" value="<?php echo set_value('password'); ?>" size="50" />
<div style="clear:both;"></div>
<div><input type="submit" class="button"  value="Enter" /></div>
<br/>
<a href="<?php echo site_url();?>/index.php/login/signup">Create Account</a> | <a href="<?php echo site_url();?>/index.php/login/forgot_password">Forgot Password</a>
</div>
