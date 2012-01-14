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
class Author extends CI_Controller {
    //put your code here
	function __construct()
	{
		parent::__construct();
		$this->load->model('AuthorObj');
	}
    function index()
    {
        $data['contentData']['queryResult'] = $this->AuthorObj->findAllAuthors();
    	$data['innerContents'] = 'news/author/index';
        $this->template->load('layout', 'news/layout', $data);
    }
    
    function newAuthor()
    {
    	$data['contentData'] = '';
    	$data['innerContents'] = 'news/author/new';
    	$this->template->load('layout', 'news/layout', $data);
    }
    function create()
    {
    	$this->AuthorObj->insert();
    	$this->index();
    }
    function edit()
    {
    	$data['contentData']['queryResult'] = $this->AuthorObj->edit();
    	$data['innerContents'] = 'news/author/edit';
    	$this->template->load('layout', 'news/layout', $data);
    }
	function update()
    {
    	$this->AuthorObj->update();
    	$this->index();
    }
	function delete()
    {
    	$this->AuthorObj->delete();
    	$this->index();
    }
}
?>
