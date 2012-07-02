<?php
if ($jobs){
?>
<?php
foreach($jobs as $job) {?>
<div style="border-top:1px solid #4f8fad;">
<div class="tableitem" style="width:95%;">
    <a href="<?php echo site_url();?>index.php/job/view_job/<?php echo $job->id;?>">
<?php echo $job->title;?>
    </a>
</div>
    <div style="clear:both;"></div>  
    <div class="tableitem" style="width:400px;font-size:70%;color:#999;float:left;">
<?php 

$explode_categories=explode(',',$job->categories);

foreach($explode_categories as $category_item){
echo "<a href='".site_url()."index.php/job/jobs/?subcategory=".$category_item."'>".$category_item."</a> | ";
}
?>
</div>


<div class="tableitem" style="float:left;">
<?php echo $job->status;?>
</div>

<div class="tableitem" style="width:100px;float:left;">
<?php echo $job->budgettype;?> 
</div>
    <div class="tableitem" style="width:100px;float:left;">
<?php echo $job->budget;?>
</div>
<div class="tableitem" style="color:#ccc; width:200px;float:left">
<?php echo $job->dateposted;?>
</div>
</div>
<div style="clear:both;"></div>
<?php } }?>

<p>
<?php
if ($links) {echo $links;} ?>
</p>