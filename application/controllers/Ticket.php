<?php
// error_reporting(0);
// ini_set('display_errors', 0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends CI_Controller {

    private $_init = [];

    

	public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url','json_output'));
        $this->load->model(array('M_api','M_user'));
        $var = $this->session->userdata;
        $groupid = $var['groupid'];
       
        $group = $this->M_api->getlistgroup_array($groupid);
        if($group['ticketrule']==0){
            echo "Chức năng không khả dụng";
            exit;
        }
        
        $time = microtime();
        $time = explode(' ', $time);
        $time = $time[1] + $time[0];
        $start = $time;
        $this->_init['start'] = $start;
        
        $json_news = file_get_contents('http://test.tavicosoft.com/crm/index.php/news/select?pagesize=3') ;
        $this->_init['json_news'] = json_decode($json_news,true)['data'];
        //group 
        $l_group = file_get_contents('http://test.tavicosoft.com/crm/index.php/codedictionary/select/knwgroup');
        $this->_init['l_group'] = json_decode($l_group,true)['data'];
        
        $l_dtsrc = file_get_contents('http://test.tavicosoft.com/crm/index.php/codedictionary/select');
        $this->_init['l_dtsrc'] = json_decode($l_dtsrc,true)['data'];
        // get the stage of ticket
        $l_cate = file_get_contents('http://test.tavicosoft.com/crm/index.php/codedictionary/select/tckstage');
        $this->_init['l_stage'] = $this->_init['l_cate'] = json_decode($l_cate,true)['data'];
        // get the type ticket
        $l_type = file_get_contents('http://test.tavicosoft.com/crm/index.php/codedictionary/select/tcktype');
        $this->_init['l_type'] = json_decode($l_type,true)['data'];
        //extend data
        $l_ext = file_get_contents('http://test.tavicosoft.com/crm/index.php/extdata/select/ticket');
        $this->_init['l_ext'] = json_decode($l_ext,true)['data'];
        //category
        $l_cate = file_get_contents('http://test.tavicosoft.com/crm/index.php/codedictionary/select/knwdetail');
        $this->_init['l_cate'] = json_decode($l_cate,true)['data'];
        //Group List
        $_jsongroup = file_get_contents('http://test.tavicosoft.com/crm/index.php/api/group');
        $this->_init['l_agentgroup'] = json_decode($_jsongroup,true)['data'];
    }

	public function index()
	{
		$data1['error'] = 0;
		$_data = [];    
        $var = $this->session->userdata;
		$custid = $var['custid'];
        $json = file_get_contents('http://test.tavicosoft.com/crm/index.php/ticket/getticketinfo/'.$custid);
        
        $data['custid'] = $custid;
        $data['result'] = json_decode($json,TRUE);

        $json = file_get_contents('http://test.tavicosoft.com/crm/index.php/ticket/countticket/'.$this->session->userdata('groupid').'/1');
        $data['counter'] = json_decode($json,true)['data'];

        $_data['script'] = $this->load->view('script/script_ticket', NULL, TRUE);
		$_data['mainview'] = $this->load->view('ticket/ticket', $data , TRUE);
		$this->load->view('dashboard',$_data);
	}

	public function detail(){

        $var = $this->session->userdata;

        $custid = $var['custid'];
        $roleid = $var['roleid'];
        $groupid = $var['groupid'];

		$ticketid = $this->uri->segment(3);

        $json_ticket = file_get_contents('http://test.tavicosoft.com/crm/index.php/ticket/selectByTicketid/'.$ticketid.'');
        $data['ticket'] = $ticket_detail =  json_decode($json_ticket,TRUE);
        

        $ticket_detail = $ticket_detail['data'][0];
        $ticket_users = $ticket_detail['ticketusers'];
        $crequest = $ticket_detail['custid'];
        $agentcurrent = $ticket_detail['agentcurrent'];

        $list_user = json_decode($this->M_api->getlistcustomer(0),true);
        $data['listuser'] = $list_user['data'];

        //Xử lý việc nhận phiếu
        $data['finish'] = false;
        $data['update'] = false;
        if($custid == $agentcurrent && $ticket_detail['status']!=4){
            $data['finish'] = true;
        }
        if($custid == $agentcurrent){
            $data['update'] = true;
        }

        $extinfo = json_decode($ticket_detail['extension'],true);
        $data['extinfo'] = $extinfo;
        $data['ticketdetail'] = $ticket_detail;
        $list_user_support_ticket = file_get_contents('http://test.tavicosoft.com/crm/index.php/api/getuserbylistid?listid='.$ticket_users);
        $list_user_support_ticket = json_decode($list_user_support_ticket,true);

        $data['userssuppot'] = $list_user_support_ticket['data'];
        
        // get the stage of ticket
        $data['l_dtsrc'] = $this->_init['l_dtsrc'];
        // get the stage of ticket
        $data['l_stage'] = $this->_init['l_stage'];
        // get the category of ticket
        $data['l_cate'] = $this->_init['l_cate'];
        // get the type ticket
        $data['l_type'] = $this->_init['l_type'];
        //extend data
        $data['l_ext'] = $this->_init['l_ext'];
        // get the category of ticket
        $data['l_group'] = $this->_init['l_group'];
        // get the category of ticket
        $data['l_agentgroup'] = $this->_init['l_agentgroup'];

        
        $right['news'] = $this->_init['json_news'];
        $json = file_get_contents('http://test.tavicosoft.com/crm/index.php/customer/getcustomerbycustid/'.$data['ticket']['data'][0]['custid']);
        $right['customer'] =  json_decode($json,TRUE)['data'];
        $script = [];
        $script['param']['idcard'] = $right['customer'][0]['idcard'];
        $script['param']['opid'] = $right['customer'][0]['opid'];

		$_body            = [];
		$_body['left']    = $this->load->view('ticket/left/t_info', $data, TRUE); 
		$_body['right']   = $this->load->view('ticket/right/t_history', $right, TRUE);
		$_body['center']  = $this->load->view('ticket/center/t_body', $data, TRUE);

		$_data                = [];    
        $_data['script']      = $this->load->view('script/script_update_ticket', $script, TRUE);
        $_data['script2']     = $this->load->view('script/knowledge', NULL, TRUE);   
		$_data['mainview']    = $this->load->view('ticket/ticket_detail', $_body , TRUE);
		$this->load->view('dashboard',$_data);
	}

    public function view_ticket_log($ticketid){
        $json = file_get_contents('http://test.tavicosoft.com/crm/index.php/ticket/selectTicketLog/'.$ticketid.'');
        $data['listticketlog'] =  json_decode($json,TRUE)['data'];
        $_data['mainview'] = $this->load->view('ticket/ticketlog/log', $data , TRUE);
        $this->load->view('dashboard',$_data);
    }

    public function view_ticket_task($ticketid){
        $res = file_get_contents('http://test.tavicosoft.com/crm/index.php/task/gettask?ticketid='.$ticketid);
        $data['_task'] = json_decode($res,true)['data'];
        $_data['script'] = $this->load->view('ticket/task/script', NULL , TRUE);
        $_data['mainview'] = $this->load->view('ticket/task/task', $data , TRUE);
        $this->load->view('dashboard',$_data);
    }

    public function recent_ticket($custid='',$agentcurrent='',$idcard=''){
        $json = file_get_contents('http://test.tavicosoft.com/crm/index.php/ticket/selectTicketLimited/'.$custid.'/'.$agentcurrent);
        $res = json_decode($json,true)['data'];
        $out = [];
        $out['data'] = [];
        for ($i=0; $i < count($res); $i++) { 
            foreach ($res[$i] as $key => $value) {
                if ($key=='ticketid') {
                    $href = base_url().'ticket/detail/'.$value.'/'.$custid.'/'.$idcard;
                    $onclick = "addTab('".$href."','#".$value."')";
                    $out['data'][$i][] = "<a onclick=".$onclick." href='#'>#".$value. "</a>";
                }elseif ($key=='title') {
                    $out['data'][$i][] = $this->limit_text($value,8);
                }
            };
        }
        json_output(200,$out);
    }

    public function recent_contract($idcard='',$opid=''){
        $data1 = array(
            'reportcode'=>'crmContract01',
            'limit'=>3,
            'start'=>0,
            'queryFilters'=>array(
                'idcard'=> $idcard
            )
        );
        $result1 = $this->M_api->execute_normal_api("http://crm.tavicosoft.com/api/get_list_contract",$data1);
        $_json1 = json_decode($result1,true);
        $_json3 = json_decode($_json1,true);
        $res = $_json3["result"]["data"];
        $out = [];
        $out['data'] = [];
        for ($i=0; $i < count($res); $i++) { 
            foreach ($res[$i] as $key => $value) {
                if ($key=='contractid') {
                    $href = base_url().'user/contract/'.$value.'?opid='.$opid;
                    $onclick = "addTab('".$href."','".$value."')";
                    $out['data'][$i][] = "<a onclick=".$onclick." href='#'>#".$value. "</a>";
                }elseif ($key=='status' || $key=='property') {
                    $out['data'][$i][] = $value;
                }
            };
        }
        json_output(200,$out);
    }

    public function getrecentticket()
    {
        $idcard = $this->input->post('idcard');
             $data1 = array(
                'reportcode'=>'crmContract01',
                'limit'=>3,
                'start'=>0,
                'queryFilters'=>array(
                    'idcard'=> $idcard
                )
            );

            $result1 = $this->M_api->execute_normal_api("http://crm.tavicosoft.com/api/get_list_contract",$data1);
            // var_dump($result);
            $_json1 = json_decode($result1,true);
            $_json3 = json_decode($_json1,true);
        $knowledge['contract'] = $_json3["result"]["data"];
        echo json_encode($knowledge);
    }

    public function test_detail(){

        $_body = [];
        $_body['left'] = $this->load->view('ticket/left/test_left', NULL, TRUE); 
        $_body['right'] = $this->load->view('ticket/right/test_right', NULL, TRUE);
        $_body['center'] = $this->load->view('ticket/center/test_center', NULL, TRUE);

        $_data = [];    
        // $_data['script'] = $this->load->view('script/script_update_ticket', null, TRUE);
        // $_data['script2'] = $this->load->view('script/knowledge', NULL, TRUE);   
        $_data['mainview'] = $this->load->view('ticket/ticket_detail', $_body , TRUE);
        $this->load->view('dashboard',$_data);
    }

    public function test_left_detail(){

        // get the stage of ticket
        $data['l_dtsrc'] = $this->_init['l_dtsrc'];
        // get the stage of ticket
        $data['l_stage'] = $this->_init['l_stage'];
        // get the type ticket
        $data['l_type'] = $this->_init['l_type'];
        //extend data
        $data['l_ext'] = $this->_init['l_ext'];

        $_data = [];
        $_data['mainview'] = $this->load->view('ticket/left/t_insert', $data , TRUE);
        
        $this->load->view('dashboard',$_data);
    }

	public function contract(){
		$_body = [];
		$_body['top'] = $this->load->view('user/top/ud_breadcrumb', NULL, TRUE);
		$_body['left'] = $this->load->view('user/left/ud_contract', NULL, TRUE); 
		$_body['right'] = $this->load->view('user/right/ud_history', NULL, TRUE);
		$_body['center'] = $this->load->view('user/center/ud_contract', NULL, TRUE);

		$_data = [];    
		$_data['navbar'] = $this->load->view('navbar/navbar', NULL, TRUE); 
		$_data['sidebar'] = $this->load->view('sidebar/sidebar', NULL, TRUE);  
		$_data['mainview'] = $this->load->view('user/user_detail', $_body , TRUE);
		$this->load->view('master',$_data);
	}
    //insert ticket
    public function viewInsert()
    {
        //get list cus
        $list_user = json_decode($this->M_api->getlistcustomer(0),true);

        $data = [];
        $data['listuser'] = $list_user['data'];
        
        $knowledge['news'] = $this->_init['json_news'];

        // get the stage of ticket
        $data['l_dtsrc'] = $this->_init['l_dtsrc'];
        // get the stage of ticket
        $data['l_stage'] = $this->_init['l_stage'];
        // get the type ticket
        $data['l_type'] = $this->_init['l_type'];
        //extend data
        $data['l_ext'] = $this->_init['l_ext'];
        // get the category of ticket
        $data['l_cate'] = $this->_init['l_cate'];
        // get the category of ticket
        $data['l_group'] = $this->_init['l_group'];
        // get the category of ticket
        $data['l_agentgroup'] = $this->_init['l_agentgroup'];

        $_body = [];
        $_body['left'] = $this->load->view('ticket/left/t_insert', $data, TRUE); 
        $_body['right'] = $this->load->view('ticket/right/t_history', $knowledge, TRUE);
        $_body['center'] = $this->load->view('ticket/center/t_insert', null, TRUE);
        
        $_data = [];   
        $_data['script'] = $this->load->view('script/script_insert_ticket', null, TRUE);  
        $_data['script2'] = $this->load->view('script/knowledge', null, TRUE); 
        $_data['mainview'] = $this->load->view('ticket/ticket_insert', $_body , TRUE);
        $this->load->view('dashboard',$_data); 
        $time = microtime();
        $time = explode(' ', $time);
        $time = $time[1] + $time[0];
        $finish = $time;
        $total_time = round(($finish - $this->_init['start']), 4);
        echo 'Page generated in '.$total_time.' seconds.';
    }

    public function aj_insert_ticket(){

        $post           = $this->input->post();        //var_dump($post);
        $var            = $this->session->userdata;
        $data_ext       = isset($post['ext'])?json_encode($post['ext']):null;
        $ticket         = [];

        $ticket['agentcurrent']     = isset($post['agentcurrent'])?$post['agentcurrent']:'';
        $ticket['agentgroup']       = isset($post['agentgroup'])?$post['agentgroup']:'';
        $ticket['agentcreated']     = $var['custid'];
        $ticket['custid']           = isset($post['customer'])?$post['customer']:'';
        $ticket['contractid']       = isset($post['contractid'])?$post['contractid']:'';
        $ticket['ticketchannel']    = isset($post['ticketchannel'])?$post['ticketchannel']:'';
        $ticket['priority']         = isset($post['priority'])?$post['priority']:'';
        $ticket['extension']        = $data_ext!=null?$data_ext:'';
        $ticket['status']           = 0;
        $ticket['sla']              = isset($post['sla'])?$post['sla']:'';
        $ticket['status']           = isset($post['ticketstatus'])?$post['ticketstatus']:'';
        $ticket['duedate']          = isset($post['duedate'])?$post['duedate']:'';
        $ticket['finishdate']       = isset($post['finishdate'])?$post['finishdate']:'';
        $ticket['requestdate']      = isset($post['requestdate'])?$post['requestdate']:'';
        $ticket['firstreply']       = isset($post['firstreply'])?$post['firstreply']:'';
        $ticket['levelticket']      = isset($post['levelticket'])?$post['levelticket']:'';
        $ticket['categoryid']       = isset($post['categoryid'])?$post['categoryid']:'';
        $ticket['groupid']          = isset($post['groupid'])?$post['groupid']:'';
        $ticket['tickettype']       = isset($post['tickettype'])?$post['tickettype']:'';
        $ticket['ticketusers']      = $ticket['agentcurrent'].','.($ticket['agentcurrent']!=$var['custid']?$var['custid']:'');
        $ticket['title']            = isset($post['title'])?$post['title']:'';
        $ticket['transref']         = isset($post['transref'])?$post['transref']:'';

        // var_dump($ticket);
        $postdata   = http_build_query($ticket);
        $opts       = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context  = stream_context_create($opts);

        $result = file_get_contents('http://test.tavicosoft.com/crm/index.php/ticket/insert',false,$context);
        echo $result;

        $_res = json_decode($result,true);
        if (isset($_res['code']) && $_res['code'] == 1 && isset($post['cmt']) && $post['cmt'] !='') {
            $log['action']           = "";
            $log['useraction']       = $var['custid'];
            $log['cmt']              = isset($post['cmt'])?$post['cmt']:'';
            $log['ticketid']         = $_res['data'];
            $_result                 = $this->aj_insert_ticket_log($log);
            // echo $_result;
        }
    }

    public function aj_update_ticket()
    {
        $post           = $this->input->post();        //var_dump($post);
        $var            = $this->session->userdata;
        $data_ext       = isset($post['ext'])?json_encode($post['ext']):null;
        $ticket         = [];

        $tid = $ticket['ticketid']  = isset($post['ticketid'])?$post['ticketid']:'-1';

        // $ticket['log_custid']       = $var['custid'];
        // $ticket['log_roleid']       = $var['roleid'];
        // $ticket['log_groupid']      = $var['groupid'];
        $ticket['agentgroup']       = isset($post['agentgroup'])?$post['agentgroup']:'-1';
        $ticket['agentcurrent']     = isset($post['agentcurrent'])?$post['agentcurrent']:'-1';
        $ticket['title']            = isset($post['title'])?$post['title']:'-1';
        $ticket['ticketchannel']    = isset($post['ticketchannel'])?$post['ticketchannel']:'-1';
        $ticket['priority']         = isset($post['priority'])?$post['priority']:'-1';
        $ticket['extension']        = $data_ext!=null?$data_ext:'-1';
        $ticket['sla']              = isset($post['sla'])?$post['sla']:'-1';
        $ticket['status']           = isset($post['ticketstatus'])?$post['ticketstatus']:'-1';
        $ticket['duedate']          = isset($post['duedate'])?$post['duedate']:'-1';
        $ticket['finishdate']       = isset($post['finishdate'])?$post['finishdate']:'-1';
        $ticket['requestdate']      = isset($post['requestdate'])?$post['requestdate']:'-1';
        $ticket['firstreply']       = isset($post['firstreply'])?$post['firstreply']:'-1';
        $ticket['levelticket']      = isset($post['levelticket'])?$post['levelticket']:'-1';
        $ticket['tickettype']       = isset($post['tickettype'])?$post['tickettype']:'-1';
        $ticket['categoryid']       = isset($post['categoryid'])?$post['categoryid']:'-1';
        $ticket['groupid']          = isset($post['groupid'])?$post['groupid']:'-1';
        $ticket['ticketusers']      = isset($post['ticketusers'])?$post['ticketusers']:'-1';
        $ticket['title']            = isset($post['title'])?$post['title']:'-1';
        $ticket['transref']         = isset($post['transref'])?$post['transref']:'-1';

        foreach ($ticket as $key => $value) {
            if ($value == '-1') {
                unset($ticket[$key]);
            }
        }
        // var_dump($ticket);
        $postdata   = http_build_query($ticket);
        $opts       = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context  = stream_context_create($opts);

        $result = file_get_contents('http://test.tavicosoft.com/crm/index.php/ticket/update/'.$tid,false,$context);
        echo $result;

        $_res = json_decode($result,true);
        if (isset($_res['code']) && $_res['code'] == 1 && ((isset($post['cmt']) && $post['cmt'] !='')||(isset($post['changelog'])&&$post['changelog']!=''))) {
            $log['action']           = "Cập nhật phiếu";
            $log['useraction']       = $var['custid'];
            $log['cmt']              = isset($post['cmt'])?$post['cmt']:'';
            $log['changelog']        = isset($post['changelog'])?$post['changelog']:'';
            $log['ticketid']         = $tid;
            $_result                 = $this->aj_insert_ticket_log($log);
            // echo $_result;
        }
    }

    public function aj_insert_ticket_log($log){

        $postdata = http_build_query($log);
        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context  = stream_context_create($opts);

        $result = file_get_contents('http://test.tavicosoft.com/crm/index.php/ticket/insert_ticketlog/',false,$context);
        return $result;
    }

    public function updateTicketLog()
    {
        $ticketid = $this->input->post('ticketid');
        $cmt = $this->input->post('cmt');
        $action  = "Ghi chú phiếu";
        $postdata = http_build_query([
            'action' => $action,
            'useraction'=> $this->session->userdata('custid'),
            'cmt'=>$cmt,
            'ticketid' => $ticketid,
        ]);
        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context  = stream_context_create($opts);

        $result = file_get_contents('http://test.tavicosoft.com/crm/index.php/ticket/insert_ticketlog/'.'',false,$context);
        echo $result;
    }

    public function get_to_my_ticket($tckid){

        $ticket         = [];
        $ticket['agentcurrent']     = $this->session->userdata['custid'];
        $ticket['ticketid']         = $tckid;

        $postdata   = http_build_query($ticket);
        $opts       = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context  = stream_context_create($opts);

        $result = file_get_contents('http://test.tavicosoft.com/crm/index.php/ticket/update/'.$tckid,false,$context);
        echo $result;

        $_res = json_decode($result,true);
        if (isset($_res['code']) && $_res['code'] == 1) {
            $log['action']           = "Tiếp nhập phiếu";
            $log['useraction']       = $this->session->userdata['custid'];
            $log['cmt']              = '';
            $log['changelog']        = 'Người phụ trách: '.$this->session->userdata['custname'];
            $log['ticketid']         = $tckid;
            $_result                 = $this->aj_insert_ticket_log($log);
            // echo $_result;
        }
    }

    public function deleteTicket()
    {
        $ticketid = $this->input->post('ticketid');
        $result = file_get_contents('http://test.tavicosoft.com/crm/index.php/Api/ticket/delete/'.$ticketid.'');
        header('location:../ticket');
        // var_dump($ticketid);
    }    

    public function getIdCard()
    {
        $var = $this->session->userdata;
        $custid = $var['custid'];
        $roleid = $var['roleid'];
        $telephone = $this->input->post('telephone');
        $result = file_get_contents('http://test.tavicosoft.com/crm/index.php/api/search?action=search_customer&telephone='.$telephone.'&roleid='.$roleid);
        echo $result;
    }
    

    public function getIdCardTicket()
    {
        $ticketid = $this->input->post('ticketid');
        $result = file_get_contents('http://test.tavicosoft.com/crm/index.php/ticket/search?ticketid='.$ticketid.'');
        echo $result;
    }

    private function limit_text($text, $limit) {
      if (str_word_count($text, 0) > $limit) {
          $words = str_word_count($text, 2);
          $pos = array_keys($words);
          $text = substr($text, 0, $pos[$limit]) . '...';
      }
      return $text;
    }

}
