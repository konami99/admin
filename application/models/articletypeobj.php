<?php
class ArticleTypeObj extends CI_Model
{
	private $newsdb;
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
        $this->load->library('session');
		$this->newsdb = $this->load->database('news', true);
	}
	function update()
	{
		$articleTypeID = $this->uri->segment(3);
    	
    	$data = array(
    		'Type'=>$this->input->post('type')
    	);
    	$this->newsdb->where('ArticleTypeID', $articleTypeID);
    	$this->newsdb->update('article_types', $data);
	}
	function findAllArticleTypes()
	{
		$sql = "
				SELECT ArticleTypeID, Type
				FROM article_types
					";
		$articleTypeQuery = $this->newsdb->query($sql);
		return $articleTypeQuery;
	}
	function insert()
	{
		$data = array(
			'Type'=>$this->input->post('type'),
		);
		$this->newsdb->insert('article_types', $data);
	}
	function edit()
	{
		$articleTypeID = $this->uri->segment(3);
    	$articletype = $this->newsdb->get_where('article_types', array('ArticleTypeID'=>$articleTypeID));
    	return $articletype;
	}
	function delete()
	{
		$articleTypeID = $this->uri->segment(3);
		$this->newsdb->delete('article_types', array('ArticleTypeID'=>$articleTypeID));
	}
}