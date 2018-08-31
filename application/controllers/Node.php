<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Node extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
    }

	public function index()
	{
		$_data = [];    
		$_data['navbar'] = $this->load->view('navbar/navbar', NULL, TRUE); 
		$_data['sidebar'] = $this->load->view('sidebar/sidebar', NULL, TRUE);  
		$_data['nodejs'] = $this->load->view('node/dashboard', NULL, TRUE);
		$_data['mainview'] = $this->load->view('node/view', NULL , TRUE);
		$this->load->view('master',$_data);
	}

	public function detail(){
		$_body = [];
		$_body['top'] = $this->load->view('user/top/ud_breadcrumb', NULL, TRUE);
		$_body['left'] = $this->load->view('user/left/ud_info', NULL, TRUE); 
		$_body['right'] = $this->load->view('user/right/ud_history', NULL, TRUE);
		$_body['center'] = $this->load->view('user/center/ud_body', NULL, TRUE);

		$_data = [];    
		$_data['navbar'] = $this->load->view('navbar/navbar', NULL, TRUE); 
		$_data['sidebar'] = $this->load->view('sidebar/sidebar', NULL, TRUE);  
		$_data['script'] = $this->load->view('script/script', NULL, TRUE);
		$_data['nodejs'] = $this->load->view('node/node', NULL, TRUE);
		$_data['mainview'] = $this->load->view('user/user_detail', $_body , TRUE);
		$this->load->view('master',$_data);
	}
}
