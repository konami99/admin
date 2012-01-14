<?php
class MemberObj extends CI_Model
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
		$memberID = $this->uri->segment(3);
    	$data = array(
    		'Username'=>trim($this->input->post('username')),
    		'Email'=>trim($this->input->post('email')),
    		'FirstName'=>trim($this->input->post('firstname')),
    		'LastName'=>trim($this->input->post('lastname'))
    	);
    	$this->newsdb->where('MemberID', $memberID);
    	$this->newsdb->update('members', $data);
	}
	function findAllMembers()
	{
		$sql = "
				SELECT MemberID, Username, Password, Email, FirstName, LastName 
				FROM members
					";
		$memberQuery = $this->newsdb->query($sql);
		return $memberQuery;
	}
	function insert()
	{
		$data = array(
			'Username'=>trim($this->input->post('username')),
			'Password'=>sha1(trim($this->input->post('password'))),
			'Email'=>trim($this->input->post('email')),
			'FirstName'=>trim($this->input->post('firstname')),
			'LastName'=>trim($this->input->post('lastname'))
		);
		$this->newsdb->insert('members', $data);
	}
	function edit()
	{
		$memberID = $this->uri->segment(3);
    	$member = $this->newsdb->get_where('members', array('MemberID'=>$memberID));
    	//$data['memberObj'] = $member;
    	return $member;
	}
	function delete()
	{
		$memberID = $this->uri->segment(3);
		$this->newsdb->delete('members', array('MemberID'=>$memberID));
	}
}