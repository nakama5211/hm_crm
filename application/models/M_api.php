<?php

class M_api extends CI_Model
{
	private $url_api_db = "http://test.tavicosoft.com/crm/index.php/api/";

	private $ClientId = 'API@AGT';

    private $SecurityKey = "25D5-2C80-94C8-7BA5-48F8-4BBF-23AE-7308-E091-B91D";

    private $TvcToken = "C49D0F74-286D-4180-ABA1-D0F37685E8C4";

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('date'));
        $this->load->driver('cache');
    }

    public function execute_tvc_api($url,$action,$method,$data,$type="rpc",$tid="1"){

		$req_data = array(
			"action" => $action, 
			"method" => $method,
			"data" => $data,
			"type" => $type,
			"tid" => $tid
		);  

		$raw_data = json_encode($req_data);          

		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
		curl_setopt($ch, CURLOPT_POSTFIELDS, $raw_data);                                                                  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		    'Content-Type: application/json;charset=uft-8',                                                                                
		    'ClientId: '.$this->ClientId,
			'SecurityKey: '.$this->SecurityKey,
			'TvcToken: '.$this->TvcToken                                                                       
		));                                                                                                   

		// echo($raw_data);           

		$result = curl_exec($ch);

        return $result;

		// var_dump($data_string);
    }

    public function execute_normal_api($url,$data){

    	$raw_data = json_encode($data);          

		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
		curl_setopt($ch, CURLOPT_POSTFIELDS, $raw_data);                                                                  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		    'Content-Type: application/json'                                                                       
		));                                                                                                   

		// echo($raw_data);           

		$result = curl_exec($ch);

        return $result;
    }

    public function gen_custid(){
    	$datestring = '%Y%m%d%h%i%s';
        $now = time();
        $time =  mdate($datestring, $now);
        $ran = rand(100,999);
        return $time.$ran;
    }

    public function gen_taskid(){
    	$datestring = '%h%i%s';
        $now = time();
        $time =  mdate($datestring, $now);
        $ran = rand(1000,9999);
        return $time.$ran;
    }

    public function getlistcustomer($roleid=0){

    	$result = file_get_contents('http://test.tavicosoft.com/crm/index.php/Customer/getcustomerbyroleid/'.$roleid.'?pagesize=1000');
        return $result;
    }

    public function getlistcustomerbygroupid($groupid=0){
    	$result = file_get_contents('http://test.tavicosoft.com/crm/index.php/Customer/getcustomerbygroupid/'.$groupid.'?pagesize=1000');
        return $result;
    }

    public function getlistgroup($groupid=''){
    	$result = file_get_contents('http://test.tavicosoft.com/crm/index.php/group/select/'.$groupid);
        return $result;
    }

    public function getlistgroup_array($groupid=''){
        $result = $this->cache->memcached->get('crm_groupdetail_'.$groupid);
        if (!$result){
            $result = file_get_contents('http://test.tavicosoft.com/crm/index.php/group/select/'.$groupid);
            $this->cache->memcached->save('crm_groupdetail_'.$groupid,$result, 86400);
        }
    	$result_array = json_decode($result,true);
    	if($result_array['code']==1){
    		if($groupid!=''){
    			return $result_array['data'][0];
    		}
    		return $result_array['data'];
    	}else{
    		return [];
    	}
    }


    public function getListGroupCache(){
        $result = $this->cache->memcached->get('crm_group');
        if (!$result){
            $result = file_get_contents('http://test.tavicosoft.com/crm/index.php/api/group');
            $this->cache->memcached->save('crm_group',$result, 86400);
        }
        return $result;
    }

    public function getTicketById($ticketid){
        //$result = $this->cache->memcached->get('ticket_'.$ticketid);
        if (!$result){
            $result = file_get_contents('http://test.tavicosoft.com/crm/index.php/ticket/search?search=&ticketid='.$ticketid.'');
            $this->cache->memcached->save('ticket_'.$ticketid,$result, 86400);
        }
        return $result;
    }

}