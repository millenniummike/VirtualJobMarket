<?php

class Front extends CI_Controller {
    
    var $loginstatus;
    
    function __construct(){
        session_start();
        parent::__construct();
        $this->load->model('Jobmodel','',TRUE);
        $this->load->model('Usermodel','',TRUE);
    }
     public function index(){
    
    $data['page_title']='Welcome Page';
    $data['page_description']='The description of the page.';
    $data['links']='';
    $data['jobs']=$this->Jobmodel->get_jobs(5);
    $data['users']=$this->Usermodel->get_users(5,0,'candidate'); 
     $data['jobcloud']=$this->Jobmodel->get_job_cloud(); 
     $data['jobcloudcategories']=$this->Jobmodel->get_job_cloud_categories();
     
    $data['content'] = '/front/index_view';
    $this->load->view('template_view', $data); 
    
    }
    
public function subcategories(){

    // outputs in json
    $category=$this->input->get('id');
    $data['jobcloudcategories']=$this->Jobmodel->get_subcategories('subcategory',$category);
    
    $totalcount=count($data['jobcloudcategories']);
    echo '[';
    $counter=0;
    foreach($data['jobcloudcategories'] as $item):
        $counter++;
        if ($counter<$totalcount) {
        echo '{"optionValue":"'.$item->subcategory.'", "optionDisplay": "'.$item->subcategory.'"},';
        }
        else
        {
            echo '{"optionValue":"'.$item->subcategory.'", "optionDisplay": "'.$item->subcategory.'"}]';
        }
    
    endforeach;

    }
}
?>
