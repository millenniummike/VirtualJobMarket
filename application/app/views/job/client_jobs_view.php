<div class="framepanel" style="padding:10px;">
<h1>My Jobs/Projects</h1>
<?php
if ($jobs){
?>
<div class="jobs">

<?php
foreach($jobs as $job) {?>

<div class="tableitem" style="width:400px;">
    <a href="<?php echo site_url();?>index.php/job/view_job/<?php echo $job->id;?>">
<?php echo $job->title;?>
    </a>
</div>

<div class="tableitem">
<?php echo $job->status;?>
</div>
<div style="clear:both;"></div>
<div class="tableitem" style="font-size:80%; width:300px;">
<?php echo $job->budget;?> <?php echo $job->currency;?> <?php echo $job->budgettype;?> 
</div>
<div style="clear:both;"></div>
<div class="tableitem" style="font-size:80%; color:#ccc; width:300px;">
<?php echo $job->dateposted;?>
</div>
<div style="clear:both;"></div>
<?php } ?>

<p>
<?php
if ($links) {echo $links;} ?>
</p>
</div>
<?php } ?>
</div>