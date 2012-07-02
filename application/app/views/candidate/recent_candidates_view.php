<?php
$this->load->helper('text');
?>
<div style="clear:both;"></div>
<?php
if ($users){
?>
<div class="tableheader" style="width:200px;">
Name
</div>
<div class="tableheader" style="width:200px;">
Description
</div>

<div style="clear:both;"></div>

    <?php
foreach($users as $user) {?>

<div class="tableitem" style="width:200px;">
    <a href="<?php echo site_url();?>index.php/profile/view/<?php echo $user->id;?>">
<?php echo $user->firstname;?> <?php echo $user->lastname;?>
    </a>
</div>

<div class="tableitem" style="width:200px;">
<?php echo character_limiter($user->description,200);?>
</div>

<div style="clear:both; border-top:1px solid #4f8fad;"></div>
<?php } }?>

<p>
<?php
if ($links) {echo $links;} ?>
</p>
