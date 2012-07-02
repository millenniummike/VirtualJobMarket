<div style="float:left; padding:10px;">
    <a class="navbutton" href="<?php echo site_url();?>">Home</a>
    <?php
if ($this->session->userdata('logged_in')== FALSE){
?>
    <a class="navbutton" href="<?php echo site_url();?>index.php/login">Login</a>
    <?php } ?>
    <a class="navbutton" href="<?php echo site_url();?>index.php/job/jobs">Jobs</a>
    <a class="navbutton" href="<?php echo site_url();?>index.php/candidate/candidates">Candidates</a> 
</div>

