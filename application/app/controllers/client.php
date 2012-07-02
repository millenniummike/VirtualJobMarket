<?php

class Client extends CI_Controller {

    function __construct(){
        session_start();
        parent::__construct();
        $this->load->model('Jobmodel','',TRUE); 
        $this->load->model('Usermodel','',TRUE); 
        $this->load->library('pagination');
    }
    
    public function index(){
    
    $data['content'] = '/client/index_view';
    $this->load->view('template_view', $data);  
    
    }

    public function jobs($page=0){
    
    if ($this->session->userdata('logged_in')!= TRUE){
    redirect('/index.php/login');
}

    $data['keyword']=$this->input->post('keyword');
    $data['budgettype']=$this->input->post('budgettype');
    
    $config['base_url'] = site_url()."/index.php/job/jobs";
    $config['total_rows'] = $this->Jobmodel->get_client_jobs_count($this->session->userdata('user_id'));
    $data['total_results']=$config['total_rows'];
    $config['num_links'] = 20;
    $config['per_page'] = 20;
    $config['uri_segment'] = 3;
    $config['use_page_numbers'] = TRUE;
    
    $this->pagination->initialize($config);

    $data['links'] = $this->pagination->create_links();

    $data['page_title']='Jobs Available Page';
    $data['page_description']='The description of the page.';
    
    $data['jobs']=$this->Jobmodel->get_client_jobs($this->session->userdata('user_id')); 
    
    $data['content'] = '/job/client_jobs_view';
    $this->load->view('template_view', $data);  
 
    }
}
?>
