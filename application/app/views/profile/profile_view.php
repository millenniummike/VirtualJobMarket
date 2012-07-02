<div class="framepanel" style="padding:0px;margin:10px;width:940px;"/>
<div class="error"><?php //echo validation_errors(); ?></div>
<div class="message"><?php echo $message; ?></div>
<div>

<?php //print_r($user); ?>

<?php
foreach($user as $item) {?>
    <h1>
        
<img style="width:200px;" src="<?php echo $item->image_url;?>"/>
<br/>
<?php echo $item->firstname;?> <?php echo $item->lastname;?>
    </h1>
    <h1>
<?php echo $item->company;?>
    </h1>
<p>
<?php echo $item->description;?>
</p>
<?php } ?>

</div>


<?php $this->load->view('profile/skills_view'); ?> 
<hr/>
<?php $this->load->view('profile/wall_view'); ?> 
</div>
