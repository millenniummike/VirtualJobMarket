<?php
if ($board){
?>
<?php
foreach($board as $post) {?>
<div class="tableitem" style="width:300px;">
<span style="float:left;">
<a href="<?php echo site_url();?>index.php/profile/view/<?php echo $post->user_id;?>"><?php echo $post->firstname.' '.$post->lastname;?></a></span>
</div>
<div class="tableitem" style="width:100%">
<?php echo $post->description;?>
</div>
<div style="clear:both;"></div>
<span style="font-size:80%; float:left;padding:2px; color:#ccc"><?php echo time_elapsed_string2($post->dateposted);?> ago</span> 
<div style="clear:both;"></div>
<?php } }?>

<?php if ($this->session->userdata('user_id')&&$jobs[0]->status=='Bidding Stage'){ ?>
<form method="post">
       <div class="error"><?php echo form_error('description'); ?></div>
Comment<br/>
 <textarea name="description" style="width:900px;height:50px"></textarea><br/>  
    <input class="button" type="submit" name="board" value="Comment"/>
</form>
<?php } else {?>
<?php } ?>

<?php
function time_elapsed_string2($ptime) {
     date_default_timezone_set('GMT');
    $ptime=strtotime($ptime);
    $etime = time() - $ptime;
    
    if ($etime < 1) {
        return '0 seconds';
    }
    
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

