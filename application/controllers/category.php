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
class Category extends CI_Controller {
    //put your code here
	function __construct()
	{
		parent::__construct();
		$this->load->model('CategoryObj');
	}
	function index()
	{
		$data['contentData']['queryResult'] = $this->CategoryObj->findAllCategories();
    	$data['innerContents'] = 'news/category/index';
        $this->template->load('layout', 'news/layout', $data);
	}
	function newCategory()
    {
    	$data['contentData'] = '';
    	$data['innerContents'] = 'news/category/new';
    	$this->template->load('layout', 'news/layout', $data);
    }
	function create()
    {
    	$this->CategoryObj->insert();
    	$this->index();
    }
	function edit()
    {
    	$data['contentData']['queryResult'] = $this->CategoryObj->edit();
    	$data['innerContents'] = 'news/category/edit';
    	$this->template->load('layout', 'news/layout', $data);
    }
    
    function update()
    {
    	$this->CategoryObj->update();
    	$this->index();
    }
    
    function delete()
    {
    	$this->CategoryObj->delete();
    	$this->index();
    }
}
?>
