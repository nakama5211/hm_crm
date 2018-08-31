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
		$_data = [];   
		if($_GET['search'] != '')
		{
			$search1 = urlencode(strval($_GET['search']));
			$search = '?search='.$search1;
		}
		else{$search ='?search=';}
		if($_GET['custname'] != '')
		{
			$custname1 = urlencode(strval($_GET['custname']));
			$custname = '&custname='.$custname1;
		}else{$custname ='';}
		if($_GET['custid'] != '')
		{
			$custid1 = urlencode(strval($_GET['custid']));
			$custid = '&idcard='.$custid1;
		}else{$custid ='';}
		if($_GET['telephone'] != '')
		{
			$telephone1 = urlencode(strval($_GET['telephone']));
			$telephone = '&telephone='.$telephone1;
		}else{$telephone ='';}
		if($_GET['email'] != '')
		{
			$email1 = urlencode(strval($_GET['email']));
			$email = '&email='.$email1;
		}else{$email ='';}
		if($_GET['mapping1'] != '')
		{
			$mapping11 = urlencode(strval($_GET['mapping1']));
			$mapping1 = '&mapping1='.$mapping11;
		}else{$mapping1 ='';}
		$var = $this->session->userdata;
        $roleid = $var['roleid'];
        $json = file_get_contents('http://test.tavicosoft.com/crm/index.php/customer/search'.$search.$custname.$custid.$telephone.$email.'&roleid='.$roleid.$mapping1);
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
		$agent = $_GET['agentcurrent'];
		if(isset($_GET['agent'])){
			$agent = $_GET['agent'];
		}
		$status = $_GET['status'];

		$_data = [];   
		if($_GET['search'] != '')
		{
			$search1 = urlencode(strval($_GET['search']));
			$search = '?search='.$search1;
		}
		else{$search ='?search=';}
		if($_GET['custid'] != '')
		{
			$agentcreated1 = urlencode(strval($_GET['custid']));
			$agentcreated = '&custid='.$agentcreated1;
		}else{$agentcreated ='';}
		if($_GET['agentcurrent'] != '')
		{
			$agentcurrent1 = $agent;
			$agentcurrent = '&agentcurrent='.$agentcurrent1;
		}else{$agentcurrent ='';}
		if($_GET['priority'] != '')
		{
			$priority1 = urlencode(strval($_GET['priority']));
			$priority = '&priority='.$priority1;
		}else{$priority ='';}
		if($_GET['status'] != '')
		{
			$status1 = urlencode(strval($_GET['status']));
			$status = '&status='.$status1;
		}else{$status ='';}
		if($_GET['ticketchannel'] != '')
		{
			$ticketchannel1 = urlencode(strval($_GET['ticketchannel']));
			$ticketchannel = '&ticketchannel='.$ticketchannel1;
		}else{$ticketchannel ='';}
		
		$json = file_get_contents('http://test.tavicosoft.com/crm/index.php/ticket/search'.$search.$agentcreated.$agentcurrent.$priority.$status.$ticketchannel);
		
		$var = $this->session->userdata;
        $custidLogin = $var['custid'];
		$data['agentcurrent'] = $custidLogin;
        $data['result'] = json_decode($json,true);
        $data['status'] = $_GET['status'];
		$_data['script'] = $this->load->view('script/script_search', NULL, TRUE);  
		$_data['mainview'] = $this->load->view('search/right_search_ticket_input', $data , TRUE);
		$this->load->view('dashboard',$_data);
	}
}