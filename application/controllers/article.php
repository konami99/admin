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
    	
    	
    	//exit();
    	
    	//$gp->enableRequestDebugLogging('d:\gp_requests.log');
    	
    	try {
    		//$userFeed = $gp->getuserFeed("default");
    		//foreach ($userFeed as $userEntry){
    		//	echo $userEntry->title->text . $userEntry->id->text . "<br/>\n";
    			//}
    	
    			//exit(0);
    				
    			$query = new Zend_Gdata_Photos_AlbumQuery();
    				
    			$query->setUser("");
    			$query->setThumbsize ("104");
    			$query->setAlbumName("auburn");
    			//$query->setAlbumId("5620271770485001921");
    				
    			$albumFeed = $gp->getAlbumFeed($query);
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
    		echo "Error: " . $e->getMessage() . "<br />\n";
    		if ($e->getResponse() != null) {
    			echo "Body: <br />\n" . $e->getResponse()->getBody() .
    			             "<br />\n"; 
    		}
    		// In new versions of Zend Framework, you also have the option
    		// to print out the request that was made.  As the request
    		// includes Auth credentials, it's not advised to print out
    		// this data unless doing debugging
    		// echo "Request: <br />\n" . $e->getRequest() . "<br />\n";
    	}
    	catch (Zend_Gdata_App_Exception $e) {
    		echo "Error: " . $e->getMessage() . "<br />\n";
    	}
    	//exit(0);
    	
    	//var_dump($imageArray);exit();
    	
    	$data['contentData']['normalSizeImageArray'] = $normalSizeImageArray;
    	$data['contentData']['thumbnailImageArray'] = $thumbnailImageArray;
    	
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
