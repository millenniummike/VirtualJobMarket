<div id="content">
    <div class="panel">
        <h1>Signup for an account</h1>

<?php echo form_open(site_url().'/index.php/login/signup'); ?>

Email Address<br/>
<div class="error"><?php echo form_error('email'); ?></div>
<input class="input-with-default-title" type="text" name="email" value="<?php echo set_value('email'); ?>" size="50" />
<br/>
Password<br/>
<div class="error"><?php echo form_error('password'); ?></div>
<input  class="inputbox" type="password" name="password" value="<?php echo set_value('password'); ?>" size="50" />
<br/>
Password Confirm<br/>
<div class="error"><?php echo form_error('passconf'); ?></div>
<input  class="input"  type="password" name="passconf" value="<?php echo set_value('passconf'); ?>" size="50" />
<div style="clear:both;"></div>

Account Type<br/>
<input type="radio" checked name="accounttype" value="candidate" />I would like to provide services<br />
<input type="radio" name="accounttype" value="client" />I am looking for virtual workers
<br/>
    
<br/>
<div><input type="submit" class="button"  value="Join" /></div>

</form>
    </div>
</div>
