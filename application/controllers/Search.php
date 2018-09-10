<?php

error_reporting(0);
ini_set('display_errors', 0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model(array('M_api'));
    }

	public function index()
	{
		$_data = [];
		$body = [];    
		$list_user = json_decode($this->M_api->getlistcustomer(0),true);
        $body['listuser'] = $list_user['data'];
		$_data['script'] = $this->load->view('script/script_search', NULL, TRUE);  
		$_data['mainview'] = $this->load->view('search/search', $body , TRUE);
		$this->load->view('dashboard',$_data);
	}

	public function rightSearch()
	{
		$get = $this->input->get();
		$query = '?';
		foreach ($get as $key => $value) {
			$query.=$key.'='.rawurlencode($value).'&';
		}
        $json = file_get_contents('http://test.tavicosoft.com/crm/index.php/customer/search'.$query);
        $data['result'] = json_decode($json,true);
		$_data['script'] = $this->load->view('script/script_search', NULL, TRUE);  
		$_data['mainview'] = $this->load->view('search/right_search', $data , TRUE);
		$this->load->view('dashboard',$_data);
	}

	public function rightSearchTicket()
	{
		$agent = $_GET['agentcurrent'];
		$json = file_get_contents('http://test.tavicosoft.com/crm/index.php/ticket/getticketinfo/'.$agent);
		$lienquan = $_GET['lienquan'];
		$data['lienquan'] = $lienquan;
		$data['agentcurrent'] = $agent;
        $data['result'] = json_decode($json,true);
        $data['status'] = $_GET['status'];
		$_data['script'] = $this->load->view('script/script_search', NULL, TRUE);  
		$_data['mainview'] = $this->load->view('search/right_search_ticket', $data , TRUE);
		$this->load->view('dashboard',$_data);
	}

	public function rightSearchTicketInput()
	{
		$get = $this->input->get();
		$query = '?';
		foreach ($get as $key => $value) {
			$query.=$key.'='.rawurlencode($value).'&';
		}
		
		$json = file_get_contents('http://test.tavicosoft.com/crm/index.php/ticket/search'.$query);
		
		$var = $this->session->userdata;
        $custidLogin = $var['custid'];
		$data['agentcurrent'] = $custidLogin;
        $data['result'] = json_decode($json,true);
        $data['status'] = $_GET['status'];
		$_data['script'] = $this->load->view('script/script_search', NULL, TRUE);  
		$_data['mainview'] = $this->load->view('search/right_search_ticket_input', $data , TRUE);
		$this->load->view('dashboard',$_data);
		// echo ('http://test.tavicosoft.com/crm/index.php/ticket/search'.$query);
	}
}