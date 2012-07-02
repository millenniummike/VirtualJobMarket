<div style="background-color:white;"/>
<div style="padding:5px;">
<?php
if ($jobcloudcategories){

foreach($jobcloudcategories as $item) { 

    if ($item->category!=$lastcategory) {
        if ($lastcategory==''&&1==99){echo '<div style="float:left;">'.$item->category.'</div>';}
        else
        {
          // echo '<div style="float:left;">'.$item->category.'</div>';
        }
    }
    $lastcategory=$item->category;
//echo " | <a style='font-size:70%;' href='".site_url()."index.php/job/jobs/?subcategory=".$item->subcategory."'>".$item->subcategory." (".$item->total.")</a>";
?>
    <div style="width:220px; font-size:100%; float:left;color:#aaa; margin:1px; padding:2px;">
        <div style="float:left;"><a style='font-size:100%;' href='<?php echo site_url();?>index.php/job/jobs/?category=<?php echo $item->category;?>'><?php echo $item->category;?></a> (<?php echo $item->total;?>)</div>
    </div>  

<?php }
}?>
</div>
<div style="clear:both;"></div>

<div style="padding:5px;">
<?php
if ($jobcloud){

foreach($jobcloud as $item) { 

    if ($item->category!=$lastcategory) {
        if ($lastcategory==''&&1==99){echo '<div style="float:left;">'.$item->category.'</div>';}
        else
        {
          // echo '<div style="float:left;">'.$item->category.'</div>';
        }
    }
    $lastcategory=$item->category;
//echo " | <a style='font-size:70%;' href='".site_url()."index.php/job/jobs/?subcategory=".$item->subcategory."'>".$item->subcategory." (".$item->total.")</a>";
?>
    <div style="width:220px; font-size:100%; float:left;color:#aaa; margin:1px; padding:2px;">
        <div style="float:left;"><a style='font-size:70%;' href='<?php echo site_url();?>index.php/job/jobs/?subcategory=<?php echo $item->subcategory;?>'><?php echo $item->subcategory;?></a> (<?php echo $item->total;?>)</div>
    </div>  

<?php }
}?>
</div>
<div style="clear:both;"></div>
</div>