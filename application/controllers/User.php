<?php
// error_reporting(0);
// ini_set('display_errors', 0);
// defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model('M_api');
        $this->load->model('M_data_API');
        $this->load->driver('cache');
        $dayCompare = strtotime('2000-01-01T00:00:00');
        $time = microtime();
        $time = explode(' ', $time);
        $time = $time[1] + $time[0];
        $start = $time;
        $this->_init['start'] = $start;

        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );  


        $_jsongroup = $this->M_api->getListGroupCache();
        $this->_init['_jsongroup'] = json_decode($_jsongroup,true);
        $_jsoncity = $this->cache->memcached->get('_jsoncity');
        if(!$_jsoncity){
             $_jsoncity = json_decode(file_get_contents('https://hungminhits.com/api/list_city',false, stream_context_create($arrContextOptions)))  ;
        }
        $this->_init['_jsoncity'] = $_jsoncity;

        $_jsonlistext = file_get_contents('http://test.tavicosoft.com/crm/index.php/extdata/select/user');
        $this->_init['_jsonlistext'] = json_decode($_jsonlistext,true);
        $_jsonlistcodic = file_get_contents('http://test.tavicosoft.com/crm/index.php/codedictionary/select/');
        $this->_init['_jsonlistcodic'] = json_decode($_jsonlistcodic,true);
        

    }

    public function index()
    {
        $_body = [];
        $_body['left'] = $this->load->view('user/left/ud_dashboard_left',null,TRUE); 
        $_body['right'] = $this->load->view('user/right/ud_dashboard_right', null, TRUE);
        $_body['center'] = $this->load->view('user/center/ud_dashboard_center', null, TRUE);
        $_data = [];    
        $_data['navbar'] = $this->load->view('navbar/navbar', NULL, TRUE); 
        $_data['sidebar'] = $this->load->view('sidebar/sidebar', NULL, TRUE); 
        $_data['script'] = $this->load->view('script/script_dashboard', NULL, TRUE);  
        $_data['mainview'] = $this->load->view('user/user', $_body , TRUE);
        $this->load->view('dashboard',$_data);
    }
    public function testContract()
    {
        $idcard = $this->uri->segment(3);
        $this->M_data_API->getContractByIdcard($idcard);
    }
    public function detail(){
        $_body = [];
        $customer = [];
        if(isset($_GET['cusid'])){
            $_cusid = $_GET['cusid']; 
        }
        else
        {
            $_cusid = '';
        }
        if(isset($_GET['phone'])){
            $_phone = $_GET['phone']; 
        }
        else
        {
            $_phone = '';
        }
        if(isset($_GET['roleid'])){
            $_roleid = $_GET['roleid']; 
        }
        else
        {
            $_roleid = '';
        }
        //Get Thong tin dia chi
        $customer['city'] = $this->_init['_jsoncity'];
        //Get thông tin khách hàng dựa vào id hoặc số phone
        $var = $this->session->userdata;
        if(isset($_GET['action']))
        {
            if($_GET['action'] == 'profile')
                {
                    $roleid = '1'; 
                }
                else
                {
                    $roleid = $var['roleid'];
                }
        }
        else
        {
            $roleid = $var['roleid'];
        }
        $_jsonuser = json_decode(file_get_contents('http://test.tavicosoft.com/crm/index.php/customer/search?search=&custid='.$_cusid.'&telephone='.$_phone.'&roleid='.$roleid), true);
        $_dataContract['user'] = $_jsonuser['data'];
        //Get thông tin ticket dựa vào cusid
        $_jsonticket = json_decode(file_get_contents('http://test.tavicosoft.com/crm/index.php/ticket/select/'.$_cusid.''), true);
        $_dataContract['ticket'] = $_jsonticket['data'];
            $_dataContract['trade'] = array();
        //Get thông tin cuộc gọi từ SDT
        $var = $this->session->userdata;
        $roleid = $var['roleid'];
        $role_list = array();
        // if($roleid==1){
            $role_list['1']="Quản Trị Viên";
            $role_list['2']="Chuyên Viên";
        // }
            $role_list['3']="Khách hàng";

        //Get List Địa chỉ

        //Group List
        $group_list = $this->_init['_jsongroup'];
        $customer['role_list'] = $role_list; 
        $right['role_list'] = $role_list; 
        $customer['group_list'] = $group_list['data']; 
        $right['group_list'] = $group_list['data']; 
        
        $customer['detail'] = $_jsonuser['data'];

        $list_ext = $this->_init['_jsonlistext'];
        $customer['list_ext'] = $list_ext['data']; 
        $right['list_ext'] = $list_ext['data']; 

        $list_codic = $this->_init['_jsonlistcodic'];
        $customer['list_codic'] = $list_codic['data']; 

        $_jsonaddress = json_decode(file_get_contents('http://test.tavicosoft.com/crm/index.php/api/address/'.$_cusid.''), true);

        $_jsonhistory = file_get_contents('http://test.tavicosoft.com/crm/index.php/api/user_history/'.$_cusid.'');
        $_jsonhistory_data= json_decode($_jsonhistory,true);
        $right['history'] = $_jsonhistory_data['data'];
        $customer['address'] = $_jsonaddress['data'];

        $_body['top'] = $this->load->view('user/top/ud_breadcrumb', NULL, TRUE);
        $_body['left'] = $this->load->view('user/left/ud_info',$customer,TRUE); 
        $_body['right'] = $this->load->view('user/right/ud_history', $right, TRUE);
        $_body['center'] = $this->load->view('user/center/ud_body', $_dataContract, TRUE);


        $_data = [];
        $_data['link'] = 'user/detail';      
        $_data['script'] = $this->load->view('script/script_user_info', NULL, TRUE);
        $_data['mainview'] = $this->load->view('user/user_detail', $_body , TRUE);
        $this->load->view('dashboard',$_data);
    }

    public function getHistoryUser()
    {
        $_cusid = $this->input->post('custid');
        $_jsonhistory = file_get_contents('http://test.tavicosoft.com/crm/index.php/api/user_history/'.$_cusid.'');
        echo $_jsonhistory;
    }



    public function create(){
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );  
        $_jsoncity = json_decode(file_get_contents('https://hungminhits.com/api/list_city',false, stream_context_create($arrContextOptions)))  ;
        

        $var = $this->session->userdata;
        $roleid = $var['roleid'];
        $role_list = array();
        if($roleid==1){
            $role_list['1']="Quản Trị Viên";
            $role_list['2']="Chuyên Viên";
        }
        $role_list['3']="Khách hàng";

        //Group List
        $_jsongroup = file_get_contents('http://test.tavicosoft.com/crm/index.php/api/group');
        $group_list = json_decode($_jsongroup,true);

        $_data = [];   

        $_jsonlistcodic = file_get_contents('http://test.tavicosoft.com/crm/index.php/codedictionary/select/');
        $list_codic = json_decode($_jsonlistcodic,true);
        $_data['list_codic'] = $list_codic['data']; 

        $_jsonlistext = file_get_contents('http://test.tavicosoft.com/crm/index.php/extdata/select/user');
        $list_ext = json_decode($_jsonlistext,true);
        $_data['list_ext'] = $list_ext['data']; 

        $_data['role_list'] = $role_list; 
        $_data['group_list'] = $group_list['data']; 
        $_data['list_ext'] = $list_ext['data']; 
        $_data['city'] = $_jsoncity;
        $_body = [];
        $_body['top'] = $this->load->view('user/top/ud_breadcrumb', NULL, TRUE);
        $_body['left'] = $this->load->view('user/left/ud_info_create', $_data, TRUE); 
        $_data['navbar'] = $this->load->view('navbar/navbar', NULL, TRUE); 
        $_data['sidebar'] = $this->load->view('sidebar/sidebar', NULL, TRUE);  
        $_data['script'] = $this->load->view('script/script_user_info_create', NULL, TRUE);
        $_data['mainview'] = $this->load->view('user/user_create', $_body , TRUE);
        $this->load->view('dashboard',$_data);
    }

    public function getCongnoThanhtoan()
    {
        $contractid = $this->uri->segment(3);
        $this->M_data_API->getCongnoThanhtoan($contractid);
    }

    public function getHistory()
    {
        $contractid = $this->uri->segment(3);
        $this->M_data_API->getHistory($contractid);
    }

    public function getGift()
    {
        $contractid = $this->uri->segment(3);
        $this->M_data_API->getGift($contractid);
    }

    public function getBussEmployee()
    {
        $contractid = $this->uri->segment(3);
        $this->M_data_API->getBussEmployee($contractid);
    }

    public function getNotes()
    {
        $contractid = $this->uri->segment(3);
        $this->M_data_API->getNotes($contractid);
    }

    public function contract(){
        $data['contractid'] = $this->uri->segment(3);
        //a
        $data = array(
            'reportcode'=>'crmContract01a',
            'limit'=>25,
            'start'=>0,
            'queryFilters'=>array(
                'contractid'=> $data['contractid']
            )
        );


        $result = $this->M_api->execute_normal_api("http://crm.tavicosoft.com/api/get_list_contract",$data);
        $_json = json_decode($result,true);
        $_json2 = json_decode($_json,true);
        $data_left['trade'] = $_json2["result"]["data"];
        //c

       

        $data['ticket_bottom'] = array('data' => [] );
        $right['history'] =[];
        $_body = [];
        $_body['top'] = $this->load->view('user/top/ud_breadcrumb', NULL, TRUE);
        $_body['left'] = $this->load->view('user/left/ud_contract', $data_left, TRUE); 
        $_body['right'] = $this->load->view('user/right/ud_history', $right, TRUE);
        $_body['center'] = $this->load->view('user/center/ud_contract', $data, TRUE);

        $_data = [];    
        $_data['navbar'] = $this->load->view('navbar/navbar', NULL, TRUE); 
        $_data['sidebar'] = $this->load->view('sidebar/sidebar', NULL, TRUE);  
        $_data['script'] = $this->load->view('script/script_user', NULL, TRUE);
        $_data['mainview'] = $this->load->view('user/user_detail', $_body , TRUE);
        $this->load->view('dashboard',$_data);
        $time = microtime();
        $time = explode(' ', $time);
        $time = $time[1] + $time[0];
        $finish = $time;
        $total_time = round(($finish - $this->_init['start']), 4);
        // echo 'Page generated in '.$total_time.' seconds.';
    }
    public function loadTicketContract()
    {
        $contractid = $this->uri->segment(3);
        $this->M_data_API->loadTicketContract($contractid);
    }
    public function insertPhoneList()
    {
        $telephonelist = $this->input->post('telephonelist');
        $idcard = strval($_GET['idcard']);
        $custid = strval($_GET['cusid']);
        $roleid = strval($_GET['roleid']);
        $postdata = http_build_query([
                'telephonelist' => $telephonelist
        ]);
        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context  = stream_context_create($opts);

        $result = file_get_contents('http://test.tavicosoft.com/crm/index.php/api/customer/update/'.$custid.'',false,$context);
         header('location:/user/detail/?cusid='.$custid.'&idcard='.$idcard.'&roleid='.$roleid);
    }

    public function insertEmailList()
    {
        $emaillist = $this->input->post('emaillist');
        $idcard = strval($_GET['idcard']);
        $custid = strval($_GET['cusid']);
        $roleid = strval($_GET['roleid']);
        $postdata = http_build_query([
                'emaillist' => $emaillist
        ]);
        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context  = stream_context_create($opts);

        $result = file_get_contents('http://test.tavicosoft.com/crm/index.php/api/customer/update/'.$custid.'',false,$context);
         header('location:/user/detail/?cusid='.$custid.'&idcard='.$idcard.'&roleid='.$roleid);
    }

    public function selectCity()
    {
        $id_city = $this->input->post('id_city');
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );  
        $_jsoncity = json_decode(file_get_contents('https://hungminhits.com/api/list_district/'.$id_city.'',false, stream_context_create($arrContextOptions)))  ;
        $city = $_jsoncity;
        echo json_encode($city);
    }

    public function selectDistrict()
    {
        $id_district = $this->input->post('id_district');
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );  
        $_jsoncity = json_decode(file_get_contents('https://hungminhits.com/api/list_ward/'.$id_district.'',false, stream_context_create($arrContextOptions)))  ;
        $city = $_jsoncity;
        echo json_encode($city);
    }

    public function getListExt()
    {
        $_jsonlistext = file_get_contents('http://test.tavicosoft.com/crm/index.php/extdata/select/user');
        echo $_jsonlistext;
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

    public function getGroupByRoleId()
    {
        $roleid = $this->input->post('roleid');
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );  
        $_jsongroup = file_get_contents('http://test.tavicosoft.com/crm/index.php/api/group/'.$roleid);
        echo $_jsongroup;
    }

    public function updateUser()
    {
        $var            = $this->session->userdata;
        $data = $this->input->post();
        $__data= $this->input->post('ext');
        $__data1 = parse_str($__data, $get_array);
        $__extinfo = json_encode($get_array);
        $thunhap = json_encode($__data);
        $postdata = http_build_query([
                'custid' => isset($data['custid'])?$data['custid']:null,
                'roleid' => isset($data['roleid'])?$data['roleid']:null,
                'groupid' => isset($data['groupid'])?$data['groupid']:null,
                'custname' =>isset($data['custname'])?$data['custname']:null,
                'gender' =>isset($data['gender'])?$data['gender']:null,
                // 'idcard' => isset($data['idcard'])?$data['idcard']:null,
                'fullbirthday' => isset($data['fullbirthday'])?$data['fullbirthday']:null,
                'telephone' =>isset($data['telephone'])?$data['telephone']:null,
                'email' => isset($data['email'])?$data['email']:null,
                'country' => isset($data['country'])?$data['country']:null,
                'log_custid' =>isset($data['custid'])?$data['custid']:null,
                'log_roleid' =>$var['roleid'],
                'log_groupid' =>$var['groupid'],
                // 'city' => isset($data['city'])?$data['city']:null,
                // 'district' =>isset($data['district'])?$data['district']:null,
                // 'ward' =>isset($data['ward'])?$data['ward']:null,
                // 'address' => isset($data['address'])?$data['address']:null,

                'comments' =>isset($data['comments'])?$data['comments']:null,
                'queue'=> isset($data['queue'])?$data['queue']:null,
                'extinfo'=> $__extinfo
                // 'fulladdress'=> isset($data['fulladdress'])?$data['fulladdress']:null
        ]);
        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context  = stream_context_create($opts);

        $result = file_get_contents('http://test.tavicosoft.com/crm/index.php/customer/update/'.$data['custid'],false,$context);
        $queue = isset($data['queue'])?$data['queue']:null;
        if($queue !=null)
        {
        $postdata_queue = http_build_query([
                'extension' =>$data['telephone'],
                'queue' => $data['queue']
        ]);
        $opts_queue = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata_queue
            )
        );
        $context_queue  = stream_context_create($opts_queue);
        $result_queue_login = file_get_contents('http://test.tavicosoft.com/crm/index.php/queue/loginQueue',false,$context_queue);

        $postdata_logout = http_build_query([
                'extension' =>$data['telephone'],
                'queue' => $data['queueold']
        ]);
        $opts_logout = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata_logout
            )
        );
        $context_logout  = stream_context_create($opts_logout);  
        $result_queue_logout = file_get_contents('http://test.tavicosoft.com/crm/index.php/queue/logoutQueue',false,$context_logout);
        
        }


        echo $result;
        
    }

    public function aj_insert(){

        $post = $this->input->post();
        $custid = $this->M_api->gen_custid();

        $res_data = array(
            'custid'                       =>$custid,
            'roleid'                       =>isset($post['roleid'])?$post['roleid']:'',
            'groupid'                      =>isset($post['groupid'])?$post['groupid']:'',
            'custname'                     =>isset($post['custname'])?$post['custname']:'',
            'gender'                       =>isset($post['gender'])?$post['gender']:'',
            'idcard'                       =>isset($post['idcard'])?$post['idcard']:'',
            'fullbirthday'                 =>isset($post['fullbirthday'])?$post['fullbirthday']:'',
            'telephone'                    =>isset($post['telephone'])?$post['telephone']:'',
            'email'                        =>isset($post['email'])?$post['email']:'',
            
            'comments'                     =>isset($post['comments'])?$post['comments']:'',
            'extinfo'                      =>isset($post['ext'])?json_encode($post['ext']):'',
            
            'password'                     =>isset($post['password'])?$post['password']:'',
            'queue'                        =>isset($post['queue'])?$post['queue']:''
        );

        foreach ($res_data as $key => $value) {
            if ($value=='') {
                unset($res_data[$key]);
            }
        }

        $postdata = http_build_query($res_data);
        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context  = stream_context_create($opts);

        $result = file_get_contents('http://test.tavicosoft.com/crm/index.php/customer/insert',false,$context);
        echo $result;

        $res_re = json_decode($result,true);
        $address = array(
                'custid'                        => $custid,
                'country'                       =>isset($post['country'])?$post['country']:'',
                'city'                          =>isset($post['city'])?$post['city']:'',
                'district'                      =>isset($post['district'])?$post['district']:'',
                'ward'                          =>isset($post['ward'])?$post['ward']:'',
                'street'                        =>isset($post['street'])?$post['street']:'',
                'address'                       =>isset($post['address'])?$post['address']:'',
                'label'                         =>"Địa chỉ thường trú"
        );
        $address['fulladdress'] = $address['country'].', '.$address['city'].', '.$address['district'].', '.$address['ward'].', '.$address['street'].', '.$address['address'];
        if ($res_re['code']==1) {
            $r_addr = $this->api_save_address($address);
        }
    }

    public function api_save_address($data){

        $postdata = http_build_query($data);
        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context  = stream_context_create($opts);

        $result = file_get_contents('http://test.tavicosoft.com/crm/index.php/address/insert',false,$context);
        return $result;
    }

    //
    public function updateUserEmailList()
    {
        $data = $this->input->post();
        $custid = isset($data['custid'])?$data['custid']:null;
        $email = isset($data['email'])?$data['email']:null;
        $emaillist = isset($data['emaillist'])?$data['emaillist']:null;
        $array_email = explode(',', $emaillist);
        $listemailnew = '';
        for($i =0;$i< sizeof($array_email);$i++){
            if($array_email[$i]==$email){
                unset($array_email[$i]);
            }else{
                if(strlen($listemailnew) == 0){
                    $listemailnew = $array_email[$i];
                }else{
                    $listemailnew.= $array_email[$i];
                }
            }
        }
        $var = $this->session->userdata;
        $log_custid = $var['custid'];
        $log_roleid = $var['roleid'];
        $log_groupid = $var['groupid'];

        $postdata = http_build_query([
            'log_custid' => $log_custid,
            'log_roleid' => $log_roleid,
            'log_groupid' => $log_groupid,
            'emaillist' => $listemailnew
        ]);
        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context  = stream_context_create($opts);

        $result = file_get_contents('http://test.tavicosoft.com/crm/index.php/Customer/update/'.$custid,false,$context);
        echo $result;
        
    }

    public function updateUserPhoneList()
    {
        $data = $this->input->post();
        $custid = isset($data['custid'])?$data['custid']:null;
        $phone = isset($data['phone'])?$data['phone']:null;
        $phonelist = isset($data['phonelist'])?$data['phonelist']:null;
        $array_phone = explode(',', $phonelist);
        $listphone = '';
        for($i =0;$i< sizeof($array_phone);$i++){
            if($array_phone[$i]==$phone){
                unset($array_phone[$i]);
            }else{
                if(strlen($listphone) == 0){
                    $listphone = $array_phone[$i];
                }else{
                    $listphone.= $array_phone[$i];
                }
            }
        }
        $var = $this->session->userdata;
        $log_custid = $var['custid'];
        $log_roleid = $var['roleid'];
        $log_groupid = $var['groupid'];
        
        $postdata = http_build_query([
            'log_custid' => $log_custid,
            'log_roleid' => $log_roleid,
            'log_groupid' => $log_groupid,
            'telephonelist' => $listphone
        ]);
        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context  = stream_context_create($opts);

        $result = file_get_contents('http://test.tavicosoft.com/crm/index.php/Customer/update/'.$custid,false,$context);
        echo $result;
        
    }

    public function updateAddress()
    {
        $data = $this->input->post();
        $addressid = $data['addressid'];
        unset($data['addressid']);
        $var = $this->session->userdata;
        $log_custid = $var['custid'];
        $log_roleid = $var['roleid'];
        $log_groupid = $var['groupid'];
        //$data['log_custid'] => $log_custid;
        $postdata = http_build_query($data);
        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context  = stream_context_create($opts);

        $result = file_get_contents('http://test.tavicosoft.com/crm/index.php/address/update/'.$addressid,false,$context);
        echo $result;
        
    }


    public function searchUser()
    {
        $keyword1 = $this->input->post('keyword');
        $keyword = urlencode($keyword1);
        $_jsonSearch = file_get_contents('http://test.tavicosoft.com/crm/index.php/api/search?action=search_customer&roleid=1&search='.$keyword);
        echo $_jsonSearch;
    }
}
?>