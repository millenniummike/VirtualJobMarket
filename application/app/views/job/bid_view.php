<?php
if ($bid){
    echo "<h3>Total Bids (".count($bid).")</h3>"
?>
<div class="tableheader" style="width:120px;">
When
</div>
<div class="tableheader" style="width:400px;">
Job
</div>
<div class="tableheader">
Candidate
</div>
<?php if ($jobowner){?>
<div class="tableheader">
Amount
</div>
<?php } ?>
<div style="clear:both;"></div>
<?php
foreach($bid as $post) {?>
<div class="tableitem" style="width:120px;">
<?php echo time_elapsed_string($post->biddateposted);?> ago
</div>
<div class="tableitem" style="width:400px;">
<a href="<?php echo site_url();?>index.php/job/view_job/<?php echo $post->job_id;?>"><?php echo $post->title;?></a>
</div>
<div class="tableitem">
<a href="<?php echo site_url();?>index.php/profile/view/<?php echo $post->candidate_id;?>"><?php echo $post->firstname.' '.$post->lastname;?></a>
</div>
<?php if ($jobowner){?>
<div class="tableitem">
<?php echo $post->amount;?>
</div>
<a class="navbutton" href="<?php echo site_url();?>index.php/job/add_job">Add Job</a>
<?php } ?>
<div style="clear:both;border-top:1px solid #ccc;"></div>
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
