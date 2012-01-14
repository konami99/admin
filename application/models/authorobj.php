<?php
class AuthorObj extends CI_Model
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
		$authorID = $this->uri->segment(3);
    	
    	$data = array(
    		'FirstName'=>$this->input->post('firstname'),
    		'LastName'=>$this->input->post('lastname'),
    		'Email'=>$this->input->post('email')
    	);
    	$this->newsdb->where('AuthorID', $authorID);
    	$this->newsdb->update('authors', $data);
	}
	function findAllAuthors()
	{
		$sql = "
				SELECT AuthorID, FirstName, LastName, Email 
				FROM authors
					";
		$authorQuery = $this->newsdb->query($sql);
		return $authorQuery;
	}
	function insert()
	{
		$data = array(
			'FirstName'=>$this->input->post('firstname'),
			'LastName'=>$this->input->post('lastname'),
			'Email'=>$this->input->post('email')
		);
		$this->newsdb->insert('authors', $data);
	}
	function edit()
	{
		$authorID = $this->uri->segment(3);
    	$author = $this->newsdb->get_where('authors', array('AuthorID'=>$authorID));
    	return $author;
	}
	function delete()
	{
		$authorID = $this->uri->segment(3);
		$this->newsdb->delete('authors', array('authorID'=>$authorID));
	}
}