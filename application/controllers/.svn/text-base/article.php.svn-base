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
class Article extends CI_Controller {
    //put your code here
	function __construct()
	{
		parent::__construct();
		$this->load->model('ArticleObj');
		$this->load->model('ArticleTypeObj');
		$this->load->model('AuthorObj');
		$this->load->model('CategoryObj');
	}
	function index()
	{
		$data['contentData']['queryResult'] = $this->ArticleObj->findAllArticles();
    	$data['innerContents'] = 'news/article/index';
        $this->template->load('layout', 'news/layout', $data);
	}
	function newArticle()
    {
    	$data['contentData'] = '';
    	$data['contentData']['allArticleTypes'] = $this->ArticleTypeObj->findAllArticleTypes();
    	$data['contentData']['allAuthors'] = $this->AuthorObj->findAllAuthors();
    	$data['contentData']['allCategories'] = $this->CategoryObj->findAllCategories();
    	$data['innerContents'] = 'news/article/new';
    	$this->template->load('layout', 'news/layout', $data);
    }
	function create()
    {
    	$this->ArticleObj->insert();
    	$this->index();
    }
	function edit()
    {
    	$data['contentData']['queryResult'] = $this->ArticleObj->edit();
    	$data['contentData']['allArticleTypes'] = $this->ArticleTypeObj->findAllArticleTypes();
    	$data['contentData']['allAuthors'] = $this->AuthorObj->findAllAuthors();
    	$data['contentData']['allCategories'] = $this->CategoryObj->findAllCategories();
    	$data['innerContents'] = 'news/article/edit';
    	$this->template->load('layout', 'news/layout', $data);
    }
 	function update()
    {
    	$this->ArticleObj->update();
    	$this->index();
    }
    
    function delete()
    {
    	$this->ArticleObj->delete();
    	$this->index();
    }
}
?>
