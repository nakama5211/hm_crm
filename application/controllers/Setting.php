<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model('M_api');
    }
    public function index()
    {
        $_body = [];
        $_body['left'] = $this->load->view('user/left/ud_dashboard_left',null,TRUE); 
        $_body['right'] = $this->load->view('user/right/ud_dashboard_right', null, TRUE);
        // $_body['center'] = $this->load->view('user/center/ud_dashboard_center', $data, TRUE);
        $_data = [];    
        $_data['navbar'] = $this->load->view('navbar/navbar', NULL, TRUE); 
        $_data['sidebar'] = $this->load->view('sidebar/sidebar', NULL, TRUE); 
        $_data['script'] = $this->load->view('script/script_dashboard', NULL, TRUE); 
        $_data['script2'] = $this->load->view('script/script_group_user', NULL, TRUE);  
        $_data['mainview'] = $this->load->view('user/user', $_body , TRUE);
        $this->load->view('dashboard',$_data);
    }
    public function viewUser()
    {
        $var = $this->session->userdata();
        $roleid = $var['roleid'];
        $json = file_get_contents('http://test.tavicosoft.com/crm/index.php/customer/search?roleid='.$roleid);
        $data['user'] = json_decode($json,TRUE)['data'];
        $_data = [];    
        $_data['script'] = $this->load->view('script/script_dashboard', NULL, TRUE); 
        $_data['script2'] = $this->load->view('script/script_group_user', NULL, TRUE);  
        $_data['mainview'] = $this->load->view('user/center/ud_dashboard_center', $data , TRUE);
        $this->load->view('dashboard',$_data);
    }
    public function viewGroupUser()
    {
        $_data = [];    
        $_data['script'] = $this->load->view('script/script_dashboard', NULL, TRUE); 
        $_data['script2'] = $this->load->view('script/script_group_user', NULL, TRUE);  
        $_data['mainview'] = $this->load->view('groupuser/center/gu_center_detail', null , TRUE);
        $this->load->view('dashboard',$_data);
    }
    public function searchUser()
    {
        $keywordPost = $this->input->post('keyword');
        $keyword = urlencode($keywordPost);
        $_jsonSearch = file_get_contents('http://test.tavicosoft.com/crm/index.php/customer/search?roleid=1&search='.$keyword);
        echo $_jsonSearch;
    }

	public function getSSLPage($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSLVERSION,3); 
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
	}


}
?>