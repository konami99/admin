<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of www
 *
 * @author Richard
 */
class Www extends CI_Controller{
    function __construct(){
        parent::__construct();
    }
    //put your code here
    function index(){
        $this->load->helper('form');
        $this->load->library('session');
        
        $this->db->select('aboutme');
        $aboutme_query = $this->db->get('summary');
        $this->db->select('myprojects');
        $myprojects_query = $this->db->get('summary');

        $data['aboutme_query'] = $aboutme_query;
        $data['myprojects_query'] = $myprojects_query;
      
        $this->load->view('www/index', $data);
    }

    function update(){
        $this->load->helper('url');
        $this->load->library('session');
        
        $aboutme_data = $this->input->post('aboutme_editor');
        $myprojects_data = $this->input->post('myprojects_editor');
        //var_dump($aboutme_data);
        //var_dump($myprojects_data);
        $data = array(
            'aboutme'=>$aboutme_data,
            'myprojects'=>$myprojects_data
        );
        $this->db->update('summary', $data);
        $this->session->set_flashdata('update_message', 'Update Succeeded.');
        redirect('www/index', 'location');
        //exit(0);
    }
}
?>
