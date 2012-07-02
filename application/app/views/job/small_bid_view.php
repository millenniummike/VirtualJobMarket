<?php

if ($bid){
   
    echo "<b>Current Bids (".count($bid).")</b>"
?>
<div style="clear:both;"></div>
<div class="tableheader" style="width:180px;">
Status
</div>
<div class="tableheader" style="width:180px;">
When
</div>
<div class="tableheader" style="width:180px;">
Who
</div>
<?php if ($jobowner){?>
<div class="tableheader">
Amount
</div>
<?php } ?>
<div style="clear:both;"></div>
<?php
foreach($bid as $biditem) {?>
<div class="tableitem" style="width:180px;">
<?php echo $biditem->bid_status;?>
</div>

<div class="tableitem" style="width:180px;color:#ccc;font-size:80%;">
<?php echo time_elapsed_string($biditem->biddateposted);?> ago
</div>

<div class="tableitem" style="width:180px;">
<a href="<?php echo site_url();?>index.php/profile/view/<?php echo $biditem->candidate_id;?>"><?php echo $biditem->firstname.' '.$biditem->lastname;?></a>
</div>
<?php if ($jobowner){?>
<div class="tableitem">
<?php echo $biditem->amount;?>
</div>


<?php if ($jobs[0]->status=='Bidding Stage') { ?>
<a class="navbutton" style="margin:0px;" onclick="javascript:return confirm('Are you sure you want to accept this bid?')" href="<?php echo site_url();?>index.php/job/accept_bid/<?php echo $biditem->job_id;?>/<?php echo $biditem->bid_id;?>">Accept Bid</a>
<?php } ?>
<?php } ?>
<div style="clear:both;"></div>
<?php } }?>


<?php
function time_elapsed_string($ptime) {
    

    
     date_default_timezone_set('GMT');
    $ptime=strtotime($ptime);
    $etime = time() - $ptime;

    
    $a = array( 12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                7 * 24 * 60 * 60        =>  'week',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
                );
    
    foreach ($a as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . ' ' . $str . ($r > 1 ? 's' : '');
        }
    }
}
?>
