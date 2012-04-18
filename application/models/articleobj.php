<?php
class ArticleObj extends CI_Model
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
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		
		$this->load->library('upload', $config);
		
		$articleID = $this->uri->segment(3);
    	
    	$data = array(
    		'Title'=>$this->input->post('title'),
    		'ArticleTypeID'=>$this->input->post('articletype'),
			'AuthorID'=>$this->input->post('author'),
			'CategoryID'=>$this->input->post('category'),
			'NameSpace'=>$this->input->post('namespace'),
			'FeatureStartDate'=>$this->mySQLDateFormat($this->input->post('featureStartDate')),
			'FeatureEndDate'=>$this->mySQLDateFormat($this->input->post('featureEndDate')),
			'SubFeatureStartDate'=>$this->mySQLDateFormat($this->input->post('subFeatureStartDate')),
			'SubFeatureEndDate'=>$this->mySQLDateFormat($this->input->post('subFeatureEndDate')),
			'Summary'=>$this->input->post('summary'),
			'Content'=>$this->input->post('content')
    	);
    	$this->newsdb->where('ArticleID', $articleID);
    	$this->newsdb->update('articles', $data);
    	
    	if(! $this->upload->do_upload("image1")){
    		echo $this->upload->display_errors();
    		exit();
    	}
    	$uploadData = $this->upload->data();
    	
    	var_dump($uploadData);exit();
    	
	}
	function findAllArticles()
	{
		$sql = "
				SELECT ArticleID, Title, Summary
				FROM articles
					";
		$articleQuery = $this->newsdb->query($sql);
		return $articleQuery;
	}
	function insert()
	{
		$data = array(
			'Title'=>$this->input->post('title'),
			'ArticleTypeID'=>$this->input->post('articletype'),
			'AuthorID'=>$this->input->post('author'),
			'CategoryID'=>$this->input->post('category'),
			'NameSpace'=>$this->input->post('namespace'),
			'FeatureStartDate'=>$this->mySQLDateFormat($this->input->post('featureStartDate')),
			'FeatureEndDate'=>$this->mySQLDateFormat($this->input->post('featureEndDate')),
			'SubFeatureStartDate'=>$this->mySQLDateFormat($this->input->post('subFeatureStartDate')),
			'SubFeatureEndDate'=>$this->mySQLDateFormat($this->input->post('subFeatureEndDate')),
			'Summary'=>$this->input->post('summary'),
			'Content'=>$this->input->post('content')
		);
		$this->newsdb->insert('articles', $data);
	}
	function edit()
	{
		$articleID = $this->uri->segment(3);
    	$article = $this->newsdb->get_where('articles', array('ArticleID'=>$articleID));
    	return $article;
	}
	function delete()
	{
		$articleID = $this->uri->segment(3);
		$this->newsdb->delete('articles', array('ArticleID'=>$articleID));
	}
	
	private function mySQLDateFormat($dateString)
	{
		// '07/02/2011' 
		if($dateString !== ""){
			return substr($dateString, 6, 4) . '-' . substr($dateString, 0, 2) . '-' . substr($dateString, 3, 2);
		}
		else{
			return NULL;
		}
	}
}