
<script src="http://www.mcginleyjobs.co.uk/virtualmarket/js/jquery.multiselect.js" type="text/javascript"></script>
<link rel="stylesheet" href="http://www.mcginleyjobs.co.uk/virtualmarket/css/jquery.multiselect.css" type="text/css" media="all" />

<style>
	#demo-frame > div.demo { padding: 10px !important; };
	</style>

        	<script>
	$(function() {
		$( "#slider-range-min" ).slider({
			range: "min",
			value: 5,
			min: 5,
                        step: 5,
			max: 7000,
			slide: function( event, ui ) {
				$( "#amount" ).val( "" + ui.value );
			}
		});

                $( "#amount" ).val( 5 );

     

	});
	</script>
        
<div class="error"><?php //echo validation_errors(); ?></div>
<div class="framepanel" style="padding:0px;margin:10px;width:940px;"/>
<?php
if ($message){
    echo $message;
}
if ($jobs){
?>
<?php
foreach($jobs as $job) {?>

<h1 style="background-color:#ccc; padding:5px;">
<?php echo $job->title;?>
</h1>

<div class="framepanel" style="width:800px;float:none;">
        <h1>Job Details</h1>
<div class="jobitem">
<?php echo $job->description;?>
</div>
        
<div class="tableitem" style="width:100%;font-size:70%;color:#999;">
<?php 

$explode_categories=explode(',',$job->categories);

foreach($explode_categories as $category_item){
echo " | <a href='".site_url()."index.php/job/jobs/?subcategory=".$category_item."'>".$category_item."</a>";
}
?> |
</div>
  
        <div class="jobitem" style="font-size:80%;">
Date Posted <?php echo $job->dateposted;?>
</div>
        
<div class="jobitem" style="float:left;">
    <b>Status</b><br/>
<?php echo $job->status;?>
</div>
<div class="jobitem" style="float:left;">
    <b>Budget Type</b><br/><?php echo $job->budgettype;?>
</div>
<div class="jobitem" style="float:left;">
    <b>Currency</b><br/> <?php echo $job->currency;?>
</div>
<div class="jobitem" style="float:left;">
    <b>Budget</b><br/> <?php echo $job->budget;?>
</div>
        <div style="clear:both;"></div>
<hr/>
<div><h1>Employer Details</h1>
<div class="jobitem">
<a href="<?php echo site_url();?>index.php/profile/view/<?php echo $job->user_id;?>"><?php echo $job->firstname.' '.$job->lastname;?></a>
</div>
<div class="jobitem">
<?php echo $job->company;?>
</div>
</div>
<hr/>
        <h1>Bid Details</h1>
        <div class="jobitem" style="float:none">
 <h3 style="color: #F6931F;">Employer's Budget <b><?php echo $job->budget;?></b></h3>
        </div>
        
<div class="jobitem" style="float:left;">
    <b>Date Bids Finish</b><br/>
        <?php
         date_default_timezone_set('GMT');
$date = strtotime(date("Y-m-d", strtotime($job->dateposted)) . " +".$job->bidperiod." day");
$biddate= date("Y-m-d",$date);
$datenow= date("Y-m-d");
echo $biddate;

?>
</div>
<div class="jobitem" style="float:left;">        
    <b>Days Remaining to Bid</b><br/>
    <?php
    $days = (strtotime($biddate) - strtotime($datenow)) / (60 * 60 * 24);
    echo round($days);
    ?>
</div>

<div style="clear:both;"/></div>
<br/>
<?php 
$this->load->view('/job/small_bid_view'); ?> 

    
<?php if (!$jobowner){?>
<?php if ($this->session->userdata('user_id')&&$job->status=='Bidding Stage'){ ?>   
<form method="post">
    <div class="error"><?php echo form_error('amount'); ?></div>
Your Bid<br/>


   <input style="margin:5px;padding:5px;color:#f6931f; font-weight:bold; width:60px;" type="text" id="amount" name="amount"/>
<div style="margin:5px;width:800px;float:left;" id="slider-range-min"></div>

    <br/><input class="button" type="submit" name="bid" value="Enter Bid"/>
</form>
<?php } else {?>

<?php } ?>

<?php } ?>
</div>
        
<div style="clear:both;"></div>
<?php } }?>
</div>
<hr/>
<div class="framepanel" style="float:none;">
    <h1>Question and Answer Board</h1>
<?php $this->load->view('/job/board_view'); ?> 
</div>
<div style="clear:both;"></div>
</div>
