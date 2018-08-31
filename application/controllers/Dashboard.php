<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Dashboard extends CI_Controller {
		public function __construct()
		{
			parent::__construct();
			$this->load->library(array('session'));
        	$this->load->helper(array('url'));
		}
		public function index()
		{
			if($this->input->post('custid', TRUE) != '')
			{
				$this->session->set_userdata('custid', $this->input->post('custid', TRUE));
		        $this->session->set_userdata('telephone', $this->input->post('telephone', TRUE));
		        $this->session->set_userdata('custname',$this->input->post('custname',TRUE));
		        $this->session->set_userdata('groupid',$this->input->post('groupid', TRUE));
		        $this->session->set_userdata('avatar',$this->input->post('avatar', TRUE));
		        $this->session->set_userdata('roleid',$this->input->post('roleid', TRUE));
		        $this->session->set_userdata('idcard',$this->input->post('idcard', TRUE));
	        }
			if(!$this->session->userdata("custid"))//If already logged in
		        {
		            redirect(base_url('login'));
		        }

			
			$_data = [];    
			//Role Admin -> go to Setting
			if($this->input->post('roleid', TRUE) == 1){
				$_data['link'] = 'setting';
				$_data['tab_title'] = "Setting";
			}else{
				$var = $this->session->userdata;
        		$roleid = $var['roleid'];
        		if($roleid == 1)
        		{
        			$_data['link'] = 'setting';
					$_data['tab_title'] = "Setting";
        		}
        		else
        		{
				$_data['link'] = 'ticket';
				$_data['tab_title'] = "Ticket";
				}
			}
			$_data['navbar'] = $this->load->view('navbar/navbar', $_data, TRUE); 
			$_data['sidebar'] = $this->load->view('sidebar/sidebar', NULL, TRUE);  
			$_data['mainview'] = $this->load->view('dashboard', NULL , TRUE);
			$_data['script2'] = $this->load->view('script/script_call', NULL, TRUE);
			$_data['nodejs'] = $this->load->view('node/dashboard', NULL, TRUE);
			$_data['script'] = $this->load->view('script/script', NULL , TRUE);
			$this->load->view('master',$_data);
		}
		public function user()
		{
			$_data = [];    
			$_data['link'] = 'user';
			$_data['navbar'] = $this->load->view('navbar/navbar', NULL, TRUE); 
			$_data['sidebar'] = $this->load->view('sidebar/sidebar', NULL, TRUE);  
			$_data['mainview'] = $this->load->view('dashboard', NULL , TRUE);
			$this->load->view('master',$_data);
		}
	}
	
	/* End of file Dashboard.php */
	/* Location: ./application/controllers/Dashboard.php */
?>