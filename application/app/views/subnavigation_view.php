<?php
if ($this->session->userdata('logged_in')== TRUE){
?>
<?php 

if ($this->session->userdata('permissions')=='client'){?>
<a class="navbutton" href="<?php echo site_url();?>index.php/job/add_job">Add Job</a>
<a class="navbutton" href="<?php echo site_url();?>index.php/client/jobs">My Jobs</a>
<a class="navbutton" href="<?php echo site_url();?>index.php/profile/edit/<?php echo $this->session->userdata('user_id');?>">My Profile</a>

<?php } ?>
<?php if ($this->session->userdata('permissions')=='candidate'){?>
<a class="navbutton" href="<?php echo site_url();?>index.php/profile/edit/<?php echo $this->session->userdata('user_id');?>">My Profile</a> 
<a class="navbutton" href="<?php echo site_url();?>index.php/candidate/jobs">My Jobs</a>
<a class="navbutton" href="<?php echo site_url();?>index.php/candidate/bids">My Bids</a>

<?php } ?>
<a class="navbutton" href="<?php echo site_url();?>index.php/login/logout">Logout</a> 
<?php } ?>
