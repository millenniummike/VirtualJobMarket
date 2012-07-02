<?php

class Candidate extends CI_Controller {

    function __construct(){
        session_start();
        parent::__construct();
        $this->load->model('Jobmodel','',TRUE); 
        $this->load->model('Usermodel','',TRUE); 
        $this->load->library('pagination');
    }
    
    public function index(){
    
    $data['content'] = '/candidate/index_view';
    $this->load->view('template_view', $data);  
    
    }
    
     public function candidates($page=0){
    
    $data['page_title']='Potential Candidates';
    $data['page_description']='The description of the page.';
    
    $data['keyword']=$this->input->post('keyword');
    $data['budgettype']=$this->input->post('budgettype');

    $data['links'] = $this->pagination->create_links();
    
    $config['base_url'] = site_url()."/index.php/candidate/candidates";
    $config['total_rows'] = $this->Usermodel->get_users_count('candidate',$data['keyword']);
    $data['total_results']=$config['total_rows'];
    $config['num_links'] = 20;
    $config['per_page'] = 20;
    $config['uri_segment'] = 3;
    $config['use_page_numbers'] = TRUE;
    
    $this->pagination->initialize($config);
 
    $data['users']=$this->Usermodel->get_users($config['per_page'],$page,'candidate',$data['keyword']); 
    $data['links'] = $this->pagination->create_links();
    
    $data['content'] = '/candidate/candidates_view';
    $this->load->view('template_view', $data);  
    }
    
    public function jobs($page=0){
    
    $data['content'] = '/candidate/jobs_view';
    $this->load->view('template_view', $data);  
    
    }
    
    public function bids($page=0){
        
            if ($this->session->userdata('logged_in')!= TRUE){
    redirect('/index.php/login');
}
    
    $data['page_title']='Job Page';
    $data['page_description']='The description of the page.';
    
    $config['base_url'] = site_url()."/index.php/candidate/bids";
    $config['total_rows'] = $this->Jobmodel->get_candidate_bid_count($this->session->userdata('user_id'));
    $data['total_results']=$config['total_rows'];
    $config['num_links'] = 20;
    $config['per_page'] = 10;
    $config['uri_segment'] = 3;
    $config['use_page_numbers'] = TRUE;
    
    $this->pagination->initialize($config);
    
    $data['jobowner']=true;
    $data['bid']=$this->Jobmodel->get_candidate_bid($config['per_page'],$page,$this->session->userdata('user_id'));
    $data['links'] = $this->pagination->create_links();
        
    $data['content'] = '/candidate/bid_view';
    $this->load->view('template_view', $data);  
    }
}
?>
