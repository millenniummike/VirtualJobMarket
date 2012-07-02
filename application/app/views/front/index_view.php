<div>
    <div>
        <h1 style="margin:5px; font-size:220%;">Virtual Working is the Future</h1>
        <p style="font-size:120%; margin:5px;">
        In a busy workplace there are so many jobs and projects that you need a scalable workforce. Virtual Jobs provides a market and matching service so that you can remain flexible. No project is too small or too big to find effective virtual - working from home - resources.</p>

        <div style="" class="framepanel">
            <h1 style="text-align:center">Employers</h1>
            <div style="text-align:center">
             <img height="160px" src="http://t3.gstatic.com/images?q=tbn:ANd9GcRR0HFTf_HbjzTtEj17-jrhmNfAczy3UvewtUiGpXNpHuzUd2o4Qg"/></div>
            <div style="text-align:center">
             <a class="button" href="<?php echo site_url();?>index.php/job/add_job">Add Project/Job</a>
            </div>
            <p style="height:100px;"> 
    
There are hundreds of skilled information workers available. As an employer you can resource your jobs and projects to this talent pool. <br/><br/> <a href="<?php echo site_url();?>index.php/client">Find out more</a></p>

       </div>
        <div style="" class="framepanel">
            <h1 style="text-align:center">Candidates</h1>
            <div style="text-align:center">
             <img src="http://t3.gstatic.com/images?q=tbn:ANd9GcT2SrN6GThROpdw-qGhKo2ycztGKYlD2XsfP8U0Bgjm8xytXWT_"/></div>
            <div style="text-align:center">
            <a class="button" href="<?php echo site_url();?>index.php/profile/edit/<?php echo $this->session->userdata('user_id')?>">Provide Skills</a>
            </div>
        <p style="height:100px;">There are hundreds of jobs that can be done remotely and from home. As a skilled information worker you can supply your skills to potential employers.<br/><br/><a href="<?php echo site_url();?>index.php/candidate">Find out more</a></p>

        </div>
</div>

    <div style="clear:both;"></div>

<div>
    <?php $this->load->view('/front/stats_view'); ?>
</div>
    <div class="framepanel" style="height:800px;color:#879CB1;background-color:#2C4762;border:1px solid #aaa">
<h1 style="color:#eff;">Recent Jobs/Projects</h1>
<?php $this->load->view('/job/latestjobs_view'); ?>
</div>
    <div class="framepanel" style="height:800px;color:#879CB1;background-color:#2C4762;border:1px solid #aaa">
<h1 style="color:#eff;">Recent Candidates</h1>
<?php $this->load->view('/candidate/recent_candidates_view'); ?>
</div>