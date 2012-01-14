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
class ArticleType extends CI_Controller {
    //put your code here
	function __construct()
	{
		parent::__construct();
		$this->load->model('ArticleTypeObj');
	}
	function index()
	{
		$data['contentData']['queryResult'] = $this->ArticleTypeObj->findAllArticleTypes();
    	$data['innerContents'] = 'news/articletype/index';
        $this->template->load('layout', 'news/layout', $data);
	}
	function newArticleType()
    {
    	$data['contentData'] = '';
    	$data['innerContents'] = 'news/articletype/new';
    	$this->template->load('layout', 'news/layout', $data);
    }
	function create()
    {
    	$this->ArticleTypeObj->insert();
    	$this->index();
    }
	function edit()
    {
    	$data['contentData']['queryResult'] = $this->ArticleTypeObj->edit();
    	$data['innerContents'] = 'news/articletype/edit';
    	$this->template->load('layout', 'news/layout', $data);
    }
 	function update()
    {
    	$this->ArticleTypeObj->update();
    	$this->index();
    }
    
    function delete()
    {
    	$this->ArticleTypeObj->delete();
    	$this->index();
    }
}
?>
