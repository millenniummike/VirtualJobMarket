<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class api extends REST_Controller
{
        function __construct(){
        parent::__construct(); 
        $this->load->model("usermodel");
                 
    }
    
    function index_get()
    {    
      echo "<h1>REST API</h1>";
      echo "<h2>Get</h2><br/>Example <br/>jobs/format/json";
      echo "<br/>job/id/1/format/json";
      
      
    }
    	function jobs_get()
    {

        if(!$this->get('format'))
        {
        	$this->response($user, 200); // 200 being the HTTP response code
        }
        
    	$user = ''.$this->get('format');
        
        //$user = $this->usermodel->get_gpsid($id);
    	
        if($user)
        {
            $this->response($user, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'Error - no data found'), 404);
        }
    }
    
	function job_get()
    {
        if(!$this->get('id'))
        {
        	$this->response($user, 200); // 200 being the HTTP response code
        }
        $id=$this->get('id');
        
    	$user = ''.$id;
        //$user = $this->usermodel->get_gpsid($id);
    	
        if($user)
        {
            $this->response($user, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'Error - no data found'), 404);
        }
    }
    
    function job_post()
    {
        $message = array('id' => $this->get('id'), 'name' => $this->post('name'), 'email' => $this->post('email'), 'message' => 'ADDED!');
        
        $this->response($message, 200); // 200 being the HTTP response code
    }
    
    function job_delete()
    {

        $message = array('id' => $this->get('id'), 'message' => 'DELETED!');  
        $this->response($message, 200); // 200 being the HTTP response code
    }


}