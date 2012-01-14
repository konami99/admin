<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Test filter - logs message on filter enter and exit
*/
class Auth_filter extends Filter {
    function before() {
    	$session = &load_class('Session');
    	if(!$session->userdata('username'))
    	{
    		$CI =& get_instance();
     		$CI->load->helper('url');
     		redirect('welcome/login', 'refresh');
     	}
    }
}
?>