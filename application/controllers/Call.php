<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Call extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('session'));
        $this->load->helper(array('url'));
	}
	public function getSSLPage($url) {
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_HEADER, false);
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_SSLVERSION,3); 
	    $result = curl_exec($ch);
	    curl_close($ch);
	    return $result;
	}
	public function index()
	{

		$mitek_url = 'https://api-popupcontact-02.mitek.vn/api/v1/call';
		$secret = 'ac97db2cca493ad87045946aed59eb29';
		$extension = '7101';
		$phone = '0933961912';
		// $json = $this->getSSLPage($mitek_url.'/clicktocall?secret='.$secret.'&extension='.$extension.'&phone='.$phone.'');
		// $json= $this->getSSLPage('https://api-popupcontact-02.mitek.vn/api/v1/call/getstatusagent?secret=ac97db2cca493ad87045946aed59eb29&extension=2300&phone=2300');
		// $data['result'] = json_decode($json,TRUE);
		$data['result'] = $this->getSSLPage('https://api-popupcontact-02.mitek.vn/api/v1/call/clicktocall?secret=ac97db2cca493ad87045946aed59eb29&extension=2300&phone=2300');
		$_data['mainview'] = $this->load->view('call/call', $data , TRUE);
		$this->load->view('dashboard',$_data);;
	}
	
}

/* End of file Call.php */
/* Location: ./application/controllers/Call.php */ ?>