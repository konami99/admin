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
class Status extends CI_Controller {
	
	//private $newsdb;
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('StatusObj');
	}
    //put your code here
    function index()
    {
    	$data['contentData']['queryResult'] = $this->StatusObj->findAllStatuses();
    	$data['innerContents'] = 'news/status/index';
        $this->template->load('layout', 'news/layout', $data);
    }
    
    function create()
    {
    	$this->StatusObj->insert();
    	$this->index();
    }
    
    function newStatus()
    {
    	$data['contentData'] = '';
    	$data['innerContents'] = 'news/status/new';
    	$this->template->load('layout', 'news/layout', $data);
    }
    
    function edit()
    {
    	$data['contentData']['queryResult'] = $this->StatusObj->edit();
    	$data['innerContents'] = 'news/status/edit';
    	//$this->template->load('news/layout', 'news/status/edit', $data);
    	$this->template->load('layout', 'news/layout', $data);
    }
    
    function update()
    {
    	$this->StatusObj->update();
    	$this->index();
    }
    
    function delete()
    {
    	$this->StatusObj->delete();
    	$this->index();
    }
}
?>
