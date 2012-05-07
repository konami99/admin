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
		
		$articleID = $this->uri->segment(3);
		
		mkdir('./files/article' . $articleID);
		
		$config['upload_path'] = './files/article' . $articleID;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		
		$this->load->library('upload', $config);
		
		//var_dump($this->input->post('isHero'));exit();
		
		$data = array(
    		'Title'=>$this->input->post('title'),
    		'ArticleTypeID'=>$this->input->post('articletype'),
			'AuthorID'=>$this->input->post('author'),
			'CategoryID'=>$this->input->post('category'),
			'NameSpace'=>$this->input->post('namespace'),
			'HeroStartDate'=>$this->mySQLDateFormat($this->input->post('heroStartDate')),
			'HeroEndDate'=>$this->mySQLDateFormat($this->input->post('heroEndDate')),
			'FeatureStartDate'=>$this->mySQLDateFormat($this->input->post('featureStartDate')),
			'FeatureEndDate'=>$this->mySQLDateFormat($this->input->post('featureEndDate')),
			'SubFeatureStartDate'=>$this->mySQLDateFormat($this->input->post('subFeatureStartDate')),
			'SubFeatureEndDate'=>$this->mySQLDateFormat($this->input->post('subFeatureEndDate')),
			'Summary'=>$this->input->post('summary'),
			'Content'=>$this->input->post('content'),
			'IsHero'=>$this->input->post('isHero'),
			'IsFeature'=>$this->input->post('isFeature'),
			'IsSubFeature'=>$this->input->post('isSubFeature')
    	);
    	
    	//check if album is created
    	$CI =& get_instance();
    	$CI->load->library('zend');
    	$CI->zend->load('Zend/Gdata/Photos');
    	$CI->zend->load('Zend/Gdata/Photos/AlbumQuery');
    	$CI->zend->load('Zend/Gdata/Photos/AlbumFeed');
    	$CI->zend->load('Zend/Gdata/App/HttpException');
    	$CI->zend->load('Zend/Gdata/App/Exception');
    	$CI->zend->load('Zend/Gdata/ClientLogin');
    	 
    	$serviceName = Zend_Gdata_Photos::AUTH_SERVICE_NAME;
    	$user = "";
    	$pass = "";
    	 
    	 
    	 
    	$client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $serviceName);
    	$gp = new Zend_Gdata_Photos($client);
    	
    	
    	try {
    		    	
    		$query = new Zend_Gdata_Photos_AlbumQuery();
    	
    		$query->setUser("");
    		$query->setAlbumName("article" . $articleID);
    	
    		$albumFeed = $gp->getAlbumFeed($query);
    		 
    	}
    	catch (Zend_Gdata_App_HttpException $e) {
    		
    		if (strpos($e->getMessage(), 'No album found') !== false) {
    			//create album
    			 			
    			$entry = new Zend_Gdata_Photos_AlbumEntry();
    			$entry->setTitle($gp->newTitle("article" . $articleID));
    			 
    			$gp->insertAlbumEntry($entry);
    			
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
    	
    	
    	
    	if($this->upload->do_upload("heroimage")){
    		$uploadData = $this->upload->data();
    		
    		$imageName = $uploadData["raw_name"] . "_" . date('U') . $uploadData["file_ext"];
    		
    		//upload image
    		$fd = $gp->newMediaFileSource($uploadData["full_path"]);
    		$fd->setContentType($uploadData["file_type"]);
    		
    		$entry = new Zend_Gdata_Photos_PhotoEntry();
    		$entry->setMediaSource($fd);
    		$entry->setTitle($gp->newTitle($imageName));
    		
    		$albumEntry = $gp->getAlbumEntry($query);
    		
    		$insertedEntry = $gp->insertPhotoEntry($entry, $albumEntry);
    		
    		$mediaContent = $insertedEntry->getMediaGroup()->getContent();
    		
    		$mediaContent = $mediaContent[0];
    		
    		$imageURL = $mediaContent->getUrl();
    		
			//$imageURL = $mediaContent[0].getUrl();
			//var_dump($mediaContent->getUrl());
			//exit();
    		
    		$data["HeroImage"] = $imageURL;
    		
    	}
    	
    	for($i=1; $i<=5; $i++){
    		if($this->upload->do_upload("upload" . $i)){
    			$uploadData = $this->upload->data();
    		
    			$imageName = $uploadData["file_name"];
    		
    			//upload image
    			$fd = $gp->newMediaFileSource($uploadData["full_path"]);
    			$fd->setContentType($uploadData["file_type"]);
    		
    			$entry = new Zend_Gdata_Photos_PhotoEntry();
    			$entry->setMediaSource($fd);
    			$entry->setTitle($gp->newTitle($imageName));
    		
    			$albumEntry = $gp->getAlbumEntry($query);
    		
    			$gp->insertPhotoEntry($entry, $albumEntry);
    		
    		}
    		
    	}
    	
    	$this->newsdb->where('ArticleID', $articleID);
    	$this->newsdb->update('articles', $data);
    	
    	
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
			'HeroStartDate'=>$this->mySQLDateFormat($this->input->post('heroStartDate')),
			'HeroEndDate'=>$this->mySQLDateFormat($this->input->post('heroEndDate')),
			'FeatureStartDate'=>$this->mySQLDateFormat($this->input->post('featureStartDate')),
			'FeatureEndDate'=>$this->mySQLDateFormat($this->input->post('featureEndDate')),
			'SubFeatureStartDate'=>$this->mySQLDateFormat($this->input->post('subFeatureStartDate')),
			'SubFeatureEndDate'=>$this->mySQLDateFormat($this->input->post('subFeatureEndDate')),
			'Summary'=>$this->input->post('summary'),
			'Content'=>$this->input->post('content'),
			'IsHero'=>$this->input->post('isHero'),
			'IsFeature'=>$this->input->post('isFeature'),
			'IsSubFeature'=>$this->input->post('isSubFeature')
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