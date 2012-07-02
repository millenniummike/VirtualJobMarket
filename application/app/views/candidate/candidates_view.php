<div class="framepanel" style="padding:0px;margin:10px;width:940px;"/>
<h1>Candidates</h1>
<div class="search"><form method="post">
    <input type="text" style="float:left;" name="keyword" value="<?php echo $keyword;?>"/>
    <input class="button" style="float:left;margin:0px;" value="Search" type="submit"/>
</form>
</div>
<div style="clear:both;"></div>
<?php
if ($users){
?>

<div class="tableheader" style="width:400px;">
Name
</div>
<div class="tableheader" style="width:400px;">
Description
</div>

<div style="clear:both;"></div>

    <?php
foreach($users as $user) {?>

<div class="tableitem" style="width:400px;">
    <a href="<?php echo site_url();?>index.php/profile/view/<?php echo $user->id;?>">
<?php echo $user->firstname;?> <?php echo $user->lastname;?>
    </a>
</div>

<div class="tableitem" style="width:400px;">
<?php echo $user->description;?>
</div>

<div style="clear:both; border-top:1px solid #ccc;"></div>
<?php } }?>

<p>
<?php
if ($links) {echo $links;} ?>
</p>
</div>
