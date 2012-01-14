<?php
class StatusObj extends CI_Model
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
		$statusID = $this->uri->segment(3);
    	$status = $this->input->post('status');
    	
    	$query = $this->newsdb->get_where('Statuses', array('status'=>$status));
    	if($query->num_rows()==0){
    		$this->newsdb->where('StatusID', $statusID);
    		$this->newsdb->update('statuses', array('Status'=>$status));
    		//$this->session->set_flashdata('update_message', 'Update StatusID ' . $statusID . ' Succeeded.');
    	}
    	else{
    		
    	}
	}
	function findAllStatuses()
	{
		$statusQuery = $this->newsdb->query("SELECT StatusID, Status FROM statuses");
		return $statusQuery;
	}
	function insert()
	{
		$this->newsdb->insert('statuses', array('Status'=>$this->input->post('status')));
	}
	function edit()
	{
		$statusID = $this->uri->segment(3);
    	$status = $this->newsdb->get_where('Statuses', array('StatusID'=>$statusID));
    	//$data['statusObj'] = $status;
    	//$data['statusID'] = $statusID;
    	//$data['status'] = $status->row()->Status;
    	return $status;
	}
	function delete()
	{
		$statusID = $this->uri->segment(3);
		$this->newsdb->delete('statuses', array('StatusID'=>$statusID));
	}
}