<?php


if ($this->session->userdata('logged_in')== TRUE){
?>
<div class="textpanel" style="float:left;margin:2px; text-align:left; width:948px;;overflow:visible">
<div> 
    <?php $this->load->view('subnavigation_view'); ?> 
</div>

    
<?php //print_r($this->session->userdata); ?>
</div>


<?php   
}
?>
