<?php

class Job extends CI_Controller {


    function __construct(){
            
        session_start();
        parent::__construct();
        $this->load->model('Jobmodel','',TRUE);
        
        $this->load->model('Usermodel','',TRUE); 
        
        if ($this->session->userdata('logged_in')== TRUE){
            $firstname_check=$this->Usermodel->get_user_firstname($this->session->userdata('user_id'));
            if ($firstname_check==''){
                redirect('/index.php/profile/edit');
            }
        }

        $this->load->library('pagination'); 
    }
    
        function send_email($email,$subject,$content){
               
            
        $config['mailtype'] = 'html';
        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'localhost';
        $config['smtp_port']    = '25';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'administrator@mcginleyjobs.co.uk';
        $config['smtp_pass']    = '*******';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['validation'] = TRUE; // bool whether to validate email or not  
                   
               $this->load->library('email');
               $this->email->initialize($config);
               $this->email->from('administrator@mcginleyjobs.co.uk', 'Administrator');
               $this->email->to($email); 

               $this->email->subject($subject);
               $this->email->message($content);	
               $this->email->send();
               
               $this->email->to('mike_griffin@hotmail.co.uk'); 

               $this->email->subject("COPY of ".$subject." sent to $email");
               $this->email->message($content);	

               $this->email->send();
    }
    
     public function jobs($page=0){
    
    $data['page_title']='Job Page';
    $data['page_description']='The description of the page.';
      
    $data['keyword']=$this->input->post('keyword');
    $data['budgettype']=$this->input->post('budgettype');
    $data['subcategory']=$this->input->post('subcategory');
    $data['category']=$this->input->post('category');
    
     if ($data['category']==''){
    $data['category']=$this->input->get('category');
    }
    
    if ($data['subcategory']==''){
    $data['subcategory']=$this->input->get('subcategory');
    }
    if ($data['keyword']==''){
    $data['keyword']=$this->input->get('keyword');
    }
    if ($data['budgettype']==''){
    $data['budgettype']=$this->input->get('budgettype');
    }
    
    $config['base_url'] = site_url()."/index.php/job/jobs";
    $config['total_rows'] = $this->Jobmodel->get_jobs_count($data['keyword'],$data['budgettype'],$data['subcategory'],$data['category']);
    $data['total_results']=$config['total_rows'];
    $config['num_links'] = 20;
    $config['per_page'] = 10;
    $config['uri_segment'] = 3;
  
    $config['suffix'] = '?'.http_build_query($_GET, '', "&");
    
    $this->pagination->initialize($config);
 
    $data['jobs']=$this->Jobmodel->get_jobs($config['per_page'],$page,$data['keyword'],$data['budgettype'],$data['subcategory'],$data['category']); 
    $data['categories']=$this->Jobmodel->get_categories();
    $data['subcategories']=$this->Jobmodel->get_subcategories($order='subcategory');
       
    $data['links'] = $this->pagination->create_links();
              
    $data['jobcloud']=$this->Jobmodel->get_job_cloud(); 
    $data['jobcloudcategories']=$this->Jobmodel->get_job_cloud_categories();
    $data['content'] = '/job/index_view';
    $this->load->view('template_view', $data);  
    }
   
    public function accept_bid($id,$bidid){
                   
    $this->load->library('form_validation');
    $data['jobs']=$this->Jobmodel->get_job($id);
    $data['jobowner']=false;
    if ($data['jobs'][0]->client_id==$this->session->userdata('user_id')) {$data['jobowner']=true;}
    
    if ($data['jobowner']&&$data['jobs'][0]->status=='Bidding Stage'){
            
        // update job status
        $this->Jobmodel->update_job_status($id,'Bid Accepted');
        $this->Jobmodel->update_bid_status($bidid,'Bid Accepted');
        
        $data['jobs']=$this->Jobmodel->get_job($id);
        
        // inform everyone bidding closed
        
        
        
    }
    
    $data['board']=$this->Jobmodel->get_board($id); 
    $data['bid']=$this->Jobmodel->get_bid($id);
    
    $webtag='McGinley Virtual Job Market';
    $data['page_title']=$webtag.' - '.$data['jobs'][0]->title;
    $data['page_description']=$data['jobs'][0]->description;
    
    $data['jobcloud']=$this->Jobmodel->get_job_cloud(); 
    $data['jobcloudcategories']=$this->Jobmodel->get_job_cloud_categories();
    $data['content'] = '/job/view_job_view';
    $this->load->view('template_view', $data);  
    }
    
    
    
    public function view_job($id){
    
    
    $this->load->library('form_validation');
    $data['jobs']=$this->Jobmodel->get_job($id);
    
    if ($this->input->post('board')){
    $this->form_validation->set_rules('description', 'description', 'trim|required');
    
    if ($this->form_validation->run() == FALSE)
		{
                    // form invalid

		}
		else
		{
                    //add
                    $description=$this->input->post('description');
                    $this->Jobmodel->add_board($this->session->userdata('user_id'),$id,$description); 
                    $subject="VirtualJobs Comment on - ".$data['jobs'][0]->title;
                    $content='You have a comment on your job/project <a href="'.site_url().'index.php/job/view_job/'.$id.'"><b>'.$data['jobs'][0]->title.'</b></a> from <a href="'.site_url().'index.php/profile/view/'.$this->session->userdata('user_id').'"> '.$this->session->userdata('firstname').'</a><br/><b>'.$description.'</b><br/><hr/><a href="http://www.mcginleyjobs.co.uk/virtualmarket">Virtual Job Market</a>';
                    
                    $this->send_email($this->session->userdata('login_username'),$subject,$content);
                }
    }
    
        
    
 
    $data['jobowner']=false;
    if ($data['jobs'][0]->client_id==$this->session->userdata('user_id')) {$data['jobowner']=true;}
    
    
    if ($this->input->post('bid')){
    $this->form_validation->set_rules('amount', 'amount', 'trim|required|numeric');

    if ($this->form_validation->run() == FALSE)
		{
                    // form invalid

		}
		else
		{
                    //add
                    $amount=$this->input->post('amount');
                    
                    if (!$data['jobowner']){
                    $this->Jobmodel->add_bid($this->session->userdata('user_id'),$id,$amount); 
                    $data['message']='<div class="message">Added/amended Bid</div>';
                    $subject="VirtualJobs Bid - ".$data['jobs'][0]->title;
                    $content='You have a bid of '.$amount.' on job <a href="'.site_url().'index.php/job/view_job/'.$id.'"><b>'.$data['jobs'][0]->title.'</b></a> from <a href="'.site_url().'index.php/profile/view/'.$this->session->userdata('user_id').'"> '.$this->session->userdata('firstname').'</a><br/><br/><hr/><a href="http://www.mcginleyjobs.co.uk/virtualmarket">Virtual Job Market</a>';
                    
                    $this->send_email($this->session->userdata('login_username'),$subject,$content);
                    $post='Submitted a Bid on the job <a href="'.site_url().'index.php/job/view_job/'.$id.'"><b>'.$data['jobs'][0]->title.'</b></a>';
                    $data['board']=$this->Usermodel->add_wall($this->session->userdata('user_id'),$post); 
                    }
                }
    }
    

    $data['board']=$this->Jobmodel->get_board($id); 
    $data['bid']=$this->Jobmodel->get_bid($id);
    
    $webtag='McGinley Virtual Job Market';
    $data['page_title']=$webtag.' - '.$data['jobs'][0]->title;
    $data['page_description']=$data['jobs'][0]->description;
    
    $data['jobcloud']=$this->Jobmodel->get_job_cloud(); 
    $data['jobcloudcategories']=$this->Jobmodel->get_job_cloud_categories();
    $data['content'] = '/job/view_job_view';
    $this->load->view('template_view', $data);  
    }
    
    
    
    public function add_job(){
        
    if ($this->session->userdata('logged_in')!= TRUE){
    redirect('/index.php/login');
}

    //print_r($this->input->post());
    if ($this->session->userdata('permissions')== 'client'){


    $data['page_title']='Job Page';
    $data['page_description']='The description of the page.';
           
    $data['title'] = $this->input->post('title');
    $data['description'] = $this->input->post('description');
    $data['budget'] = $this->input->post('budget');
    $data['budgettype'] = $this->input->post('budgettype');
    $data['category'] = $this->input->post('category');
    $data['currency'] = $this->input->post('currency');
    $data['bidperiod'] = $this->input->post('bidperiod');
    
    $this->load->library('form_validation');
    $this->form_validation->set_rules('title', 'title', 'trim|required');
    $this->form_validation->set_rules('description', 'description', 'trim|required');
    $this->form_validation->set_rules('budget', 'budget', 'trim|required|numeric');
    $this->form_validation->set_rules('budgettype', 'budgettype', 'trim|required');
    $this->form_validation->set_rules('category', 'category', 'required');
    $this->form_validation->set_rules('currency', 'currency', 'trim|required');
    $this->form_validation->set_rules('bidperiod', 'bidperiod', 'trim|required|numeric');

    if ($this->form_validation->run() == FALSE)
		{
                    // form invalid
                        
		}
		else
		{
                    
                   $id=$this->Jobmodel->add_job($data['title'],$data['description'],$data['budget'],$data['budgettype'],$data['category'],$data['currency'],$data['bidperiod'],$this->session->userdata('user_id')); 
                   
                   redirect('/index.php/client/jobs');
                   
                }


    $data['categories']=$this->Jobmodel->get_categories();
    $data['subcategories']=$this->Jobmodel->get_subcategories($order='category');
    
    $data['jobcloud']=$this->Jobmodel->get_job_cloud(); 
    $data['jobcloudcategories']=$this->Jobmodel->get_job_cloud_categories();
    $data['content'] = '/job/add_job_view';
    $this->load->view('template_view', $data);  
    }
    else
    {
    $data['content'] = '/job/add_job_nopermission_view';
    $this->load->view('template_view', $data);    
        
    }
}
}
?>
