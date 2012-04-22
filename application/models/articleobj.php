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
		$config['upload_path'] = './files/';
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
    	
    	if(! $this->upload->do_upload("heroimage")){
    		echo $this->upload->display_errors();
    		exit();
    	}
    	$uploadData = $this->upload->data();
    	
    	//var_dump($uploadData);exit();
    	
    	//check if album is created
    	$CI =& get_instance();
    	$CI->load->library('zend');
    	$CI->zend->load('Zend/Gdata/Photos');
    	$CI->zend->load('Zend/Gdata/Photos/AlbumQuery');
    	$CI->zend->load('Zend/Gdata/Photos/AlbumFeed');
    	$CI->zend->load('Zend/Gdata/App/HttpException');
    	$CI->zend->load('Zend/Gdata/App/Exception');
    	$CI->zend->load('Zend/Gdata/ClientLogin');
    	 
    	 
    	//$this->ZendGdata = new Zend_Gdata();
    	 
    	//exit();
    	 
    	$serviceName = Zend_Gdata_Photos::AUTH_SERVICE_NAME;
    	$user = "";
    	$pass = "";
    	 
    	 
    	 
    	$client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $serviceName);
    	$gp = new Zend_Gdata_Photos($client, "Google-DevelopersGuide-1.0");
    	
    	
    	try {
    		    	
    		$query = new Zend_Gdata_Photos_AlbumQuery();
    	
    		$query->setUser("");
    		$query->setThumbsize ("104");
    		$query->setAlbumName("article" + $articleID);
    		//$query->setAlbumId("5620271770485001921");
    	
    		$albumFeed = $gp->getAlbumFeed($query);
    		
    		
    		var_dump($albumFeed);exit();
    		
    		foreach ($albumFeed as $albumEntry) {
    			//echo $albumEntry->title->text . " " . $albumEntry->getGphotoId()->getText() ."<br />\n";
    			//var_dump($albumEntry);exit(0);
    			 
    			$mediaContentArray = $albumEntry->getMediaGroup()->getContent();
    			$normalSizeImage = $mediaContentArray[0]->getUrl();
    	
    			$t = $albumEntry->getMediaGroup()->getThumbnail();
    			$thumbnailImage = $t[0]->getUrl();
    	
    			//var_dump($s[0]->getUrl());exit();
    	
    			$normalSizeImageArray[] = $normalSizeImage;
    			$thumbnailImageArray[] = $thumbnailImage;
    			//var_dump($contentUrl);
    		}
    		 
    		//exit(0);
    		 
    	}
    	catch (Zend_Gdata_App_HttpException $e) {
    		
    		if (strpos($e->getMessage(), 'No album found') !== false) {
    			//create album
    			//$service = Zend_Gdata_Photos::AUTH_SERVICE_NAME;
    			//$client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $service);
    			//$service = new Zend_Gdata_Photos($client);
    			
    			
    			echo "here";
    			
    			$entry = new Zend_Gdata_Photos_AlbumEntry();
    			$entry->setTitle($gp->newTitle("article" . $articleID));
    			 
    			$gp->insertAlbumEntry($entry);
    			//insert image
    		
    			echo "done";
    		}
    		
    		
    		/*
    		echo "Error: " . $e->getMessage() . "<br />\n";
    		if ($e->getResponse() != null) {
    			echo "Body: <br />\n" . $e->getResponse()->getBody() .
    	    			             "<br />\n"; 
    		}
    		*/
    	}
    	catch (Zend_Gdata_App_Exception $e) {
    		echo "Error: " . $e->getMessage() . "<br />\n";
    	}
    	
    	
    	
    	
    	
    	
    	
    	var_dump($uploadData);exit();
    	exit();
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