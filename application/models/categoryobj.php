<?php
class CategoryObj extends CI_Model
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
		$categoryID = $this->uri->segment(3);

    	//$query = $this->newsdb->get_where('members', array('status'=>$status));
    	//if($query->num_rows()==0){
    	$data = array(
    		'Category'=>$this->input->post('category')
    	);
    	$this->newsdb->where('CategoryID', $categoryID);
    	$this->newsdb->update('categories', $data);
    		//$this->session->set_flashdata('update_message', 'Update StatusID ' . $statusID . ' Succeeded.');
    	//}
    	//else{
    		
    	//}
	}
	function findAllCategories()
	{
		$sql = "
				SELECT CategoryID, Category
				FROM categories
					";
		$categoryQuery = $this->newsdb->query($sql);
		return $categoryQuery;
	}
	function insert()
	{
		$data = array(
			'Category'=>$this->input->post('category'),
		);
		$this->newsdb->insert('categories', $data);
	}
	function edit()
	{
		$categoryID = $this->uri->segment(3);
    	$category = $this->newsdb->get_where('categories', array('CategoryID'=>$categoryID));
    	return $category;
	}
	function delete()
	{
		$categoryID = $this->uri->segment(3);
		$this->newsdb->delete('categories', array('CategoryID'=>$categoryID));
	}
}