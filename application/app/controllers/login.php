<?php

class Login extends CI_Controller {
    
        var $loginstatus;
    
    function __construct(){
        session_start();
        parent::__construct();
        $this->load->model('Usermodel','',TRUE); 
        
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
    
    public function index(){
        
    $data['content'] = '/login/index_view';
    $data['message']='';
    $this->load->view('template_view', $data);
                
    }

    public function logout(){
        session_destroy();
        $this->session->sess_destroy(); 
        $redirect=site_url().'index.php/front';
        redirect($redirect);
    }
    
    public function verify(){
       #Get POST data
        $email = $this->input->get('email');
        $key = $this->input->get('key');
        
        $this->load->model("Usermodel");
        $verified=0;
        $verified = $this->Usermodel->verify($email,$key);
        
          if ($verified==1){
            $subject="Account Verification Success";
            $content='Congratulations you have verified your account. Please login!<br/>
You can now <a href="'.site_url().'index.php/login">Login to the system.                
';
                    
            $this->send_email($email,$subject,$content);

            $data['content'] = 'login/verify_success_view';
            $this->load->view('template_view', $data);
          }
        
        
    }

    
    public function local_login(){
  
  $data['message'] = 'Please Login';
              
  #Get POST data
  $email = $this->input->post('email');
  $password = $this->input->post('password');            
  if ($email) {

    $authenticated=0;
    $authenticated = $this->Usermodel->authenticate($email,$password);
    
    if ($authenticated){  
      
    $sessiondata = array(
                   'email'     => $email,
                   'logged_in' => TRUE,
                   'login_view' => TRUE
               );
    $this->session->set_userdata($sessiondata);
    $data['message'] = 'Login Successful!';
    
    $this->session->set_userdata('logged_in',TRUE);
    $this->session->set_userdata('login_type','local');
    $this->session->set_userdata('user_id',$authenticated);
    $this->session->set_userdata('login_id',$email);
    $this->session->set_userdata('login_username',$email);
    $this->session->set_userdata('permissions',$this->Usermodel->get_user_permissions($authenticated));
    $this->session->set_userdata('role',$this->Usermodel->get_user_role($authenticated));
    $this->session->set_userdata('firstname',$this->Usermodel->get_user_firstname($authenticated));
    
    $redirect=$this->session->userdata('urltarget');
           if ($redirect==''){$redirect=site_url().'index.php/front';}
           
           $this->session->set_userdata('urltarget','');
        
           redirect($redirect);
  
  }
  else
  {
     $data['message'] = ' <div class="error">Login Failed</div>'; 
  }
  }
                $data['content'] = '/login/local_login_view';
                $this->load->view('template_view', $data);
            
    }
   
    public function signup(){
         
$this->load->library('form_validation');

$this->form_validation->set_rules('password', 'Password', 'trim|required|matches[passconf]');
$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_username_check');

    if ($this->form_validation->run() == FALSE)
		{
			$data['content'] = 'login/signup_view';
                        $this->load->view('template_view', $data); 

		}
		else
		{
                   
                      #Get POST data
                    $email = $this->input->post('email');
                    $password = $this->input->post('password');
                    $accounttype = $this->input->post('accounttype');
                    
                    $type='User';
                    
                    // generate key
                    $key = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',8)),0,8);
                    $subject="Account Registration";
                    $content='Thanks for creating a Login Account. Please use this link <a href="'.site_url().'index.php/login/verify?email='.$email.'&key='.$key.'">Verify</a> to verify your account.';
                    
                    $this->send_email($email,$subject,$content);
                                       
                    $company='';
                    $phone='';
                    $position='';
                    $this->Usermodel->create_user($email,$password,$key,$accounttype); 
                    
                    $data['content'] = 'login/signup_success_view';
                    $this->load->view('template_view', $data); 
                     
		}
  
        

    }
    

    public function forgot_password($email='')
    {

        $email = $this->input->post('email');

        if ($email){
        $this->load->model("Usermodel");
        $authenticated=0;
        $authenticated = $this->Usermodel->check_email_exists($email);
        
      if ($authenticated){ 
                  
        $subject="Account Password Details";
        $password=$authenticated[0]->password;       
        $content='The password you used was '.$password;
        $data[message]="Details have been sent to the email provided.";
        $email=$authenticated[0]->email;
        $this->send_email($email,$subject,$content);
      } 
        }
      			$data['content'] = 'login/login_forgot_view';
                        $this->load->view('template_view', $data); 
    }
    
    public  function username_check($str)
	{
           $this->load->model("Usermodel");
           $test=$this->Usermodel->user_exist($str); 
          
		if ($test >0)
		{
			$this->form_validation->set_message('username_check', ' Sorry - That email is already in use!');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	} 
               
}
?>
