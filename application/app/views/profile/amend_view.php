	<link rel="stylesheet" href="http://code.jquery.com/ui/1.8.18/themes/base/jquery-ui.css" type="text/css" media="all" />
			<link rel="stylesheet" href="http://static.jquery.com/ui/css/demo-docs-theme/ui.theme.css" type="text/css" media="all" />
			<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
			<script src="http://code.jquery.com/ui/1.8.18/jquery-ui.min.js" type="text/javascript"></script>


<div class="framepanel" style="padding:10px;"/>
    <h1>Amend <a href="<?php echo site_url();?>index.php/profile/view/<?php echo $id;?>">Profile</a></h1>
    
    
        <div id="completeness_percentage_top"><div class="navProgressBarContainer"><div class="bar" style="width:<?php echo $user[0]->profile_complete;?>%">&nbsp;</div></div><?php echo $user[0]->profile_complete;?>% complete</div>
        <br/>
        
        
        
    <?php if ($user[0]->firstname==''){?>
   <p style="width:800px;color:red;font-weight:bold;">Before you can fully use the system - Please fill all your profile details.</p>
    <?php } ?>
<div class="message"><?php echo $message; ?></div>

<?php

foreach($user as $item) {?>

<img style="width:200px;" src="<?php echo $item->image_url;?>"/>
<form action="/virtualmarket/index.php/profile/picupload" method="post" enctype="multipart/form-data">
<input type="file" name="userfile" size="20" />
  <input type="submit" value="Upload Image File" />
</form>

<br/><br/>
<form method="post">
    <div class="error"><?php echo form_error('firstname'); ?></div>
Firstname<br/>
<input type="text" name="firstname" value="<?php echo $item->firstname;?>"/>
<br/>
<div class="error"><?php echo form_error('lastname'); ?></div>
Lastname<br/>
<input type="text" name="lastname" value="<?php echo $item->lastname;?>"/>
<br/>
<div class="error"><?php echo form_error('company'); ?></div>

Company<br/>
<input type="text" name="company" value="<?php echo $item->company;?>"/>
<br/>
<div class="error"><?php echo form_error('description'); ?></div>
Description<br/>
<textarea style="width:800px;height:100px;"name="description"><?php echo $item->description;?></textarea>
<br/>
<?php $this->load->view('profile/skills_edit_view'); ?> 

<input class="button" type="submit" value="Update"/>
</form>

<?php } ?>


</div>

