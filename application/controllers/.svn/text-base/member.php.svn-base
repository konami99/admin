<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of article
 *
 * @author Richard
 */
class Member extends CI_Controller {
    //put your code here
    /*
	function index()
    {
        $this->template->load('news/layout', 'news/member/index');
    }
    */
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('MemberObj');
	}
	
	function index()
	{
		//$data['memberQuery'] = $this->MemberObj->findAllMembers();
		//exit(0);
        //$this->template->load('news/layout', 'news/member/index', $data);
        
        $data['contentData']['queryResult'] = $this->MemberObj->findAllMembers();
    	$data['innerContents'] = 'news/member/index';
        $this->template->load('layout', 'news/layout', $data);
	}
	function newMember()
    {
    	//$this->template->load('news/layout', 'news/member/new');
    	
    	$data['contentData'] = '';
    	$data['innerContents'] = 'news/member/new';
    	$this->template->load('layout', 'news/layout', $data);
    }
    function create()
    {
    	$this->MemberObj->insert();
    	$this->index();
    }
	function edit()
    {
    	//$data = $this->MemberObj->edit();
    	//$this->template->load('news/layout', 'news/member/edit', $data);
    	
    	$data['contentData']['queryResult'] = $this->MemberObj->edit();
    	$data['innerContents'] = 'news/member/edit';
    	//$this->template->load('news/layout', 'news/status/edit', $data);
    	$this->template->load('layout', 'news/layout', $data);
    }
    
    function update()
    {
    	$this->MemberObj->update();
    	$this->index();
    }
    
    function delete()
    {
    	$this->MemberObj->delete();
    	$this->index();
    }
}
?>
