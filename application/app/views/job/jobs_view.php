<?php
$this->load->helper('text');
?>
<div class="search" style="width:250px;"><form method="get" action="<?php echo site_url();?>index.php/job/jobs">
    Keyword<br/>
    <input type="text" name="keyword" value="<?php echo $keyword;?>"/><br/>
    Budget Type<br/>
        <select name="budgettype">
            <option <?php if ($budgettype=='Any') {echo ' selected="selected"';}?> value="">Any</option>
        <option <?php if ($budgettype=='Fixed') {echo ' selected="selected"';}?> value="Fixed">Fixed</option>
        <option <?php if ($budgettype=='Per Day') {echo ' selected="selected"';}?>value="Per Day">Per Day</option>
        <option <?php if ($budgettype=='Per Hour') {echo ' selected="selected"';}?>value="Per Hour">Per Hour</option>
    </select>
    <br/>
    category<br/>
    <select id="category" name="category">
  <option name="<?php echo $itemchoice->category;?>" <?php if ($category==''){echo "Selected";} ?> value="">All</option>      
        <?php
foreach($categories as $itemchoice):
?>

        
<option name="<?php echo $itemchoice->category;?>" <?php if ($category==$itemchoice->category){echo "Selected";} ?> value="<?php echo $itemchoice->category;?>"><?php echo $itemchoice->category;?></option>

 <?php
            endforeach;
 ?>
    </select><br/>
 
    
    <script type="text/javascript" charset="utf-8">
		$(function(){
			$("select#category").change(function(){
				$.getJSON("<?php echo site_url();?>/index.php/front/subcategories/",{id: $(this).val()}, function(j){
					var options = '';
					for (var i = 0; i < j.length; i++) {
						options += '<option value="' + j[i].optionValue + '">' + j[i].optionDisplay + '</option>';
					}
					$("#subcategory").html(options);
					$('#subcategory option:first').attr('selected', 'selected');
				})
			})			
		})
		</script>
                
    subcategory<br/>
    <select id="subcategory" name="subcategory">
  <option name="<?php echo $itemchoice->subcategory;?>" <?php if ($subcategory==''){echo "Selected";} ?> value="">All</option>      
        <?php
foreach($subcategories as $itemchoice):
?>

        
<option name="<?php echo $itemchoice->subcategory;?>" <?php if ($subcategory==$itemchoice->subcategory){echo "Selected";} ?> value="<?php echo $itemchoice->subcategory;?>"><?php echo $itemchoice->subcategory;?></option>

 <?php
            endforeach;
 ?>
    </select>
    
    
    <br/>
    <input id="search" value="Search" type="submit"/>
</form>
    
    <?php //$this->load->view('/job/jobs_tag_cloud_view'); ?>
    
</div>
<div class="jobs">
<?php
if ($jobs){
?>
<?php
foreach($jobs as $job) {?>

<div class="tableitem" style="padding:0px;width:100%;font-size:120%;">
    <a href="<?php echo site_url();?>index.php/job/view_job/<?php echo $job->id;?>">
<?php echo $job->title;?>
    </a>
</div>
    
<div class="tableitem" style="width:600px;font-size:70%;color:#999;">
<?php 

$explode_categories=explode(',',$job->categories);

foreach($explode_categories as $category_item){
echo " | <a href='".site_url()."index.php/job/jobs/?subcategory=".$category_item."'>".$category_item."</a>";
}
?> |
</div>

<div class="tableitem" style="width:400px;font-size:70%;">
<?php echo character_limiter($job->description,250);?>
</div>
    
<div class="tableitem">
<?php echo $job->status;?>
</div>
<div style="clear:both;"></div>

<div class="tableitem" style="font-size:80%; width:100px;">
<?php echo $job->budgettype;?> 
</div>

<div class="tableitem" style="font-size:80%; width:100px; float:left;">
<?php echo $job->budget;?>
</div>

<div style="clear:both;"></div>
<div class="tableitem" style="font-size:80%; color:#aaa; width:300px;">
<?php echo $job->dateposted;?>
</div>
<div style="clear:both;"></div>
<hr/>
<?php } }
else
{?>
Sorry no jobs or projects matched your criteria.
<?php } ?>
<p>
<?php
if ($links) {echo $links;} ?>
</p>
</div>