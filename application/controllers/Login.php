<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        //$this->load->model(array('M_data'));
    }

	public function index()
	{
		if($this->session->userdata("custid"))//If already logged in
        {
            redirect(base_url('dashboard'));
        }
		$_data = []; 
        $_data['script'] = $this->load->view('script/script_login', NULL, TRUE);
		$this->load->view('login/login',$_data);
	}

	public function login(){
		if($this->session->userdata("custid"))//If already logged in
        {
            redirect(base_url('dashboard'));
        }
        $data['error'] = 0;
        redirect(base_url('login'));
	}

    public function post_login()  
    {  

        $username = $this->input->post('username');  
        $password = $this->input->post('password');  

        $postdata = http_build_query([
                'username' => $username,
                'password' => $password
            
        ]);
        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context  = stream_context_create($opts);

        $result = file_get_contents('http://test.tavicosoft.com/crm/index.php/Api/login',false,$context);
        $response = json_decode($result,true);
        if (isset($response['data'])) {
            $this->session->set_userdata('custid',$response['data'][0]['custid']);
            $this->session->set_userdata('groupid',$response['data'][0]['groupid']);
            $this->session->set_userdata('telephone',$response['data'][0]['telephone']);
            $this->session->set_userdata('custname',$response['data'][0]['custname']);
            $this->session->set_userdata('avatar',$response['data'][0]['avatar']);
            $this->session->set_userdata('roleid',$response['data'][0]['roleid']);
            $this->session->set_userdata('idcard',$response['data'][0]['idcard']);
        }
        echo $result;
    }

	public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('login'));
    }
    public function connect(){
        // phpinfo();
        $otherdb = $this->load->database('sqlsvr12', TRUE);
        $query = $otherdb->select('*')->get('crcustomer')->result_array();
        var_dump($query);
    }
}