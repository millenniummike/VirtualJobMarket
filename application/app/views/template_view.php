<?php $this->load->view('header_view'); ?>
<?php $this->load->view('logo_view'); ?>
<div class="frame">
<div class="page">
    <?php $this->load->view('/login/login_status_view'); ?> 
<div class="page" style="clear:both; background-color:#eee; border:1px solid grey; width:958px;"/>
<?php $this->load->view($content); ?>
<?php $this->load->view('footer_view'); ?> 
</div>
</div>