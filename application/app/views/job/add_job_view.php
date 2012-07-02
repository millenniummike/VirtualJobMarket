<?php
if ($budget==''){$budget=5;}
if ($bidperiod==''){$bidperiod=2;}

?>
<script src="http://www.mcginleyjobs.co.uk/virtualmarket/js/jquery.multiselect.js" type="text/javascript"></script>
<link rel="stylesheet" href="http://www.mcginleyjobs.co.uk/virtualmarket/css/jquery.multiselect.css" type="text/css" media="all" />

<style>
	#demo-frame > div.demo { padding: 10px !important; };
	</style>
        
	<script>
	$(function() {
		$( "#slider-range-min" ).slider({
			range: "min",
			value: <?php echo $budget;?>,
			min: 5,
                        step: 5,
			max: 5000,
			slide: function( event, ui ) {
				$( "#budget" ).val( "" + ui.value );
			}
		});

                $( "#budget" ).val( <?php echo $budget;?> );
                $( "#slider-range-min2" ).slider({
			range: "min",
			value: <?php echo $bidperiod;?>,
			min: 2,
                        step: 1,
			max: 20,
			slide: function( event, ui ) {
				$( "#bidperiod" ).val( "" + ui.value );
			}
		});
                $( "#bidperiod" ).val( <?php echo $bidperiod;?> );
        
                var warning = $(".message");
	
	$("#category").multiselect({  
		header: "Choose only 4 categories",
                selectedList:4,
                minWidth:600,
		click: function(e){
		
			if( $(this).multiselect("widget").find("input:checked").length > 4 ){
				warning.addClass("error").removeClass("success").html("You can only check two checkboxes!");
				return false;
			} else {
				warning.addClass("success").removeClass("error").html("Check a few boxes.");
			}
			
		}
	});

	});
	</script>
<div class="framepanel" style="padding:10px;"/>
        <h1>Add Job or Project</h1>
<div class="error"><?php //echo validation_errors(); ?></div>

<form method="post">
    <h2>Job / Project Details</h2>
    <div class="error"><?php echo form_error('title'); ?></div>
    title<br/>
    <input style="width:400px;" type="text" value="<?php echo $title;?>" name="title"/><br/>
    <div class="error"><?php echo form_error('description'); ?></div>
    description<br/>
    <textarea style="width:400px; height:100px;" name="description"/><?php echo $description;?></textarea><br/>

<br/>
<div class="error"><?php echo form_error('category'); ?></div>
     categories<br/>
     
<select id="category" name="category[]" multiple="multiple">

    <?php
foreach($subcategories as $itemchoice):
?>
      
<option name="<?php echo $itemchoice->subcategory;?>" <?php if ($category==$itemchoice->subcategory){echo "Selected";} ?> value="<?php echo $itemchoice->id;?>"><?php echo $itemchoice->category;?> - <?php echo $itemchoice->subcategory;?></option>

 <?php
            endforeach;
 ?>

</select>

    <br/>
    <h2>Budget</h2>
    budgettype <select name="budgettype">
        <option <?php if ($budgettype=='Fixed') {echo ' selected="selected"';}?> value="Fixed">Fixed</option>
        <option <?php if ($budgettype=='Per Day') {echo ' selected="selected"';}?>value="Per Day">Per Day</option>
        <option <?php if ($budgettype=='Per Hour') {echo ' selected="selected"';}?>value="Per Hour">Per Hour</option>
    </select> 
    currency 
    <select name="currency">
        <option <?php if ($currency=='UK Pounds') {echo ' selected="selected"';}?> value="UK Pounds">UK Pounds</option>
        <option <?php if ($currency=='Euros') {echo ' selected="selected"';}?>value="Euros">Euros</option>
        <option <?php if ($currency=='US Dollars') {echo ' selected="selected"';}?>value="US Dollars">US Dollars</option>
    </select> 
    <br/>
    amount
    <br/>
    <input style="margin:5px;padding:5px;color:#f6931f; font-weight:bold; width:60px;" type="text" id="budget" name="budget"/>
<div style="margin:5px;width:800px;" id="slider-range-min"></div>

<br/>
<h2>Bidding Details</h2>
    <div class="error"><?php echo form_error('bidperiod'); ?></div>
    bid period (how many days to allow bidding)<br/>
    <input style="margin:5px;padding:5px;color:#f6931f; font-weight:bold; width:40px;" type="text" id="bidperiod" name="bidperiod"/>
    <div style="margin:5px;width:50px;" id="slider-range-min2"></div>
    <br/>

    <input type="submit" class="button" value="Add"/>
</form>
</div>