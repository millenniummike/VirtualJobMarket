<?php

class Profile extends CI_Controller {

    function __construct(){
        session_start();
        parent::__construct();
        $this->load->model('Jobmodel','',TRUE); 
        $this->load->model('Usermodel','',TRUE); 
         $this->load->helper(array('form','url','file'));
    }
    

    function picupload()
    {
        //Load Model
        //$this->load->model('Process_image');

        
        $config['upload_path'] = '/var/www/html/mcginleyjobs.co.uk/virtualmarket/uploadimages';
        $config['allowed_types'] = 'gif|jpg|png';
	$config['max_size']	= '1024';
        $config['filename']='test.jpg';
	$this->load->library('upload', $config);
        

if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
                        print_r($error);

			//$this->load->view('upload_form', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
                        print_r($data['upload_data']);
                        
                        $filename="http://www.mcginleyjobs.co.uk/virtualmarket/uploadimages/".$data['upload_data']['file_name'];
                       
                        
                        
                          $this->Usermodel->update_photo_user($this->session->userdata('user_id'),$filename);
       
			//$this->load->view('upload_success', $data);
		}
                
       redirect("/index.php/profile/edit/".$this->session->userdata('user_id'));

        
        
        
    } 
    
    
    
     public function index(){
    
    $data['page_title']='Job Page';
    $data['page_description']='The description of the page.';
    
    
    $data['content'] = '/profile/index_view';
    $this->load->view('template_view', $data);  
    }
    
    public function view($userid){
    
    $data['page_title']='Profile Page';
    $data['page_description']='The description of the page.';
    
    $data['userid']=$userid;
    $data['user']=$this->Usermodel->get_user($userid);
    $data['wall']=$this->Usermodel->get_wall($userid);
    $data['skills']=$this->Usermodel->get_skills($userid);
    
    $data['content'] = '/profile/profile_view';
    $this->load->view('template_view', $data);  
    }
    
    public function edit($userid){
       if ($this->session->userdata('logged_in')!= TRUE){
             redirect('/index.php/login');
        }
        
       // print_r($this->input->post());
        

          $data['id'] = $userid;
          $data['firstname'] = $this->input->post('firstname');
          $data['lastname'] = $this->input->post('lastname');
          $data['company'] = $this->input->post('company');
          $data['description'] = $this->input->post('description');
          $data['skillname'] = $this->input->post('skillname');
          $data['skillrating'] = $this->input->post('skillrating');
    
    $this->load->library('form_validation');
    $this->form_validation->set_rules('firstname', 'firstname', 'trim|required');
    $this->form_validation->set_rules('description', 'description', 'trim|required');
    $this->form_validation->set_rules('lastname', 'lastname', 'trim|required');
    $this->form_validation->set_rules('company', 'company', 'trim|required');

    if ($this->form_validation->run() == FALSE)
		{
                    // form invalid
		}
		else
		{
                    // update
                if ($this->session->userdata('user_id')){    
                    $this->Usermodel->update_user($this->session->userdata('user_id'),$data['firstname'],$data['lastname'],$data['company'],$data['description']);
                    $data['message']='Updated profile'; 
                    $this->Usermodel->delete_skills($this->session->userdata('user_id'));
                    
                    $counter=0;
                    foreach($data['skillname'] as $item) {
                        $this->Usermodel->update_skill_user($this->session->userdata('user_id'),$item,$data['skillrating'][$counter]);
                        $counter++;
                    }
                    
                }
                    
                }
                
                
        $data['page_title']='Job Page';
        $data['page_description']='The description of the page.';

        $data['user']=$this->Usermodel->get_user($this->session->userdata('user_id'));
        $data['skills']=$this->Usermodel->get_skills($userid);

        $data['content'] = 'profile/amend_view';
        $this->load->view('template_view', $data); 

    }
    
}
?>
