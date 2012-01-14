<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
	{
    	parent::__construct();
    	$this->newsdb = $this->load->database('news', true);
	}

	function index()
	{
		$this->load->view('welcome/index');
	}
	
    function login()
    {
    	$this->load->helper('form');
    	$this->load->view('welcome/login');
    }
    
    function logout()
    {
    	$this->load->helper('url');
    	$this->session->unset_userdata(array('username'=>''));	
    	redirect('welcome/index', 'refresh');
    }
    
    function doLogin()
    {
    	$this->load->helper('url');
    	$username = $this->input->post('username');
    	$password = $this->input->post('password');
    	$query = $this->newsdb->get_where('members', array('Username' => $username, 'Password' => sha1($password)));
    	if($query->num_rows()==1)
    	{
    		$this->session->set_userdata(array('username'=>$username));
    		redirect('article/index', 'refresh');
    		//$this->index();
    		//var_dump($this->session->userdata('Username'));
    		//die();
    	}
    	else
    	{
    		$this->login();	
    	}
    	//var_dump($query);
    	//var_dump($username);
    	//var_dump($password);
    	//die();
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */