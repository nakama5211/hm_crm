<?php
error_reporting(0);
ini_set('display_errors', 0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends CI_Controller {

    private $_init = [];

    

	public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model(array('M_api'));
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

        $l_cate = file_get_contents('http://test.tavicosoft.com/crm/index.php/codedictionary/select/knwdetail');
        $this->_init['l_cate'] = json_decode($l_cate,true)['data'];
        

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
        $json = file_get_contents('http://test.tavicosoft.com/crm/index.php/ticket/selectTicketLog/'.$ticketid.'');
        $data['listticketlog'] =  json_decode($json,TRUE)['data'];

        $json_ticket = $this->M_api->getTicketById($ticketid);
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

        $list_user_request = file_get_contents('http://test.tavicosoft.com/crm/index.php/api/getuserbylistid?listid='.$crequest.','.$agentcurrent);
        $list_user_request = json_decode($list_user_request,true)['data'];
        if($list_user_request[0]['custid']==$crequest){
            $data['crequest'] = $list_user_request[0];
            $data['agentcurrent'] = $list_user_request[1];

        }else{
            $data['crequest'] = $list_user_request[1];
            $data['agentcurrent'] = $list_user_request[0];
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

        
        $knowledge['news'] = $this->_init['json_news'];
        $idcustomer = $this->uri->segment(4);
        $json_info_customer = file_get_contents('http://test.tavicosoft.com/crm/index.php/customer/search?search=&roleid=1&custid='.$idcustomer) ;
        $knowledge['info_customer'] = json_decode($json_info_customer,true)['data'];
        if($knowledge['info_customer'] ==null)
        {
         $knowledge['info_customer']= [];   
        }

        // $json_recent_ticket = file_get_contents('http://test.tavicosoft.com/crm/index.php/ticket/getticketinfo/'.$idcustomer.'/3') ;
        $json_recent_ticket = file_get_contents('http://test.tavicosoft.com/crm/index.php/ticket/search?custid='.$idcustomer.'&agentcurrent='.$custid);
        $knowledge['recent_ticket'] = json_decode($json_recent_ticket,true)['data'];
        if($knowledge['recent_ticket'] == null)
        {
            $knowledge['recent_ticket'] =[];
        }

        $idcard = $this->uri->segment(5);
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
        $knowledge['contract'] = $_json3["result"]["data"];
        $knowledge['ticketid'] = $ticketid;

        $res = file_get_contents('http://test.tavicosoft.com/crm/index.php/task/gettask?ticketid='.$ticketid);
        $data['_task'] = json_decode($res,true)['data'];

		$_body = [];
		$_body['left'] = $this->load->view('ticket/left/t_info', $data, TRUE); 
		$_body['right'] = $this->load->view('ticket/right/t_history', $knowledge, TRUE);
		$_body['center'] = $this->load->view('ticket/center/t_body', $data, TRUE);

		$_data = [];    
        $_data['script'] = $this->load->view('script/script_update_ticket', null, TRUE);
        $_data['script2'] = $this->load->view('script/knowledge', NULL, TRUE);   
		$_data['mainview'] = $this->load->view('ticket/ticket_detail', $_body , TRUE);
		$this->load->view('dashboard',$_data);
        $time = microtime();
        $time = explode(' ', $time);
        $time = $time[1] + $time[0];
        $finish = $time;
        $total_time = round(($finish - $this->_init['start']), 4);
        // echo 'Page generated in '.$total_time.' seconds.';
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
        $data['l_stage'] = $this->_init['l_cate'];
        // get the type ticket
        $data['l_type'] = $this->_init['l_type'];
        //extend data
        $data['l_ext'] = $this->_init['l_ext'];
        // get the category of ticket
        $data['l_cate'] = $this->_init['l_cate'];

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
    public function insertTicket()
    {
        $action = "Tạo phiếu";
        $title = $this->input->post('title');
        $contractid = $this->input->post('contractid');
        $crequest = $this->input->post('crequest');
        $agentcurrent = $this->input->post('agentcurrent');
        $priority = $this->input->post('priority'); 
        $ticketchanel = $this->input->post('ticketchannel');
        $cmt = $this->input->post('cmt');
        $bds_data = [];
        $bds_data['bds'] = $this->input->post('bds');
        $bds_data['gd'] = $this->input->post('gd');
        $bds_data['duan'] = $this->input->post('duan');
        $bds_data['dot'] = $this->input->post('dot');
        $data_ext = json_encode($bds_data);

        $var = $this->session->userdata;
        $custid = $var['custid'];
        $roleid = $var['roleid'];
        $groupid = $var['groupid'];
        $agentcreated = $custid;

        $userlist = $custid;
        if($agentcreated != $agentcurrent){
            $userlist .= ','.$agentcurrent;
        }
        $postdata = http_build_query([
                'log_custid' => $custid,
                'log_roleid' => $roleid,
                'log_groupid' => $groupid,
                'custid' => $crequest,
                'agentcreated' => $custid,
                'agentcurrent' => $agentcurrent,
                'contractid' => $contractid,
                'priority' => $priority,
                'sla'=>$this->input->post('sla'),
                'duedate'=>$this->input->post('duedate'),
                'levelticket'=>$this->input->post('levelticket'),
                'type'=>$this->input->post('type'),
                'status' => 0,
                'action' => $action,
                'title' => $title,
                'useraction' => $custid,
                'ticketusers' => $userlist,
                'ticketchannel'=>$ticketchanel,
                'extension'=> $data_ext,
                'cmt'=> $cmt
        ]); 
        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context  = stream_context_create($opts);

        $result = file_get_contents('http://test.tavicosoft.com/crm/index.php/ticket/insert',false,$context) ;
        

        echo $result;
    }

    public function aj_insert_ticket(){

        $post           = $this->input->post();        //var_dump($post);
        $var            = $this->session->userdata;
        $data_ext       = isset($post['ext'])?json_encode($post['ext']):null;
        $ticket         = [];


        $ticket['log_custid']       = $var['custid'];
        $ticket['log_roleid']       = $var['roleid'];
        $ticket['log_groupid']      = $var['groupid'];
        $ticket['agentcurrent']     = isset($post['agentcurrent'])?$post['agentcurrent']:'';
        $ticket['agentcreated']     = $var['custid'];
        $ticket['custid']           = isset($post['customer'])?$post['customer']:'';
        $ticket['contractid']       = isset($post['contractid'])?$post['contractid']:'';
        $ticket['ticketchannel']    = isset($post['ticketchannel'])?$post['ticketchannel']:'';
        $ticket['priority']         = isset($post['priority'])?$post['priority']:'';
        $ticket['extension']        = $data_ext!=null?$data_ext:'';
        $ticket['action']           = "Tạo phiếu";
        $ticket['useraction']       = $var['custid'];
        $ticket['status']           = 0;
        $ticket['cmt']              = isset($post['cmt'])?$post['cmt']:'';
        $ticket['sla']              = isset($post['sla'])?$post['sla']:'';
        $ticket['status']           = isset($post['ticketstatus'])?$post['ticketstatus']:'';
        $ticket['duedate']          = isset($post['duedate'])?$post['duedate']:'';
        $ticket['finishdate']       = isset($post['finishdate'])?$post['finishdate']:'';
        $ticket['levelticket']      = isset($post['levelticket'])?$post['levelticket']:'';
        $ticket['categoryid']       = isset($post['categoryid'])?$post['categoryid']:'';
        $ticket['type']             = isset($post['tickettype'])?$post['tickettype']:'';
        $ticket['ticketusers']      = $ticket['agentcurrent'].','.($ticket['agentcurrent']!=$ticket['agentcreated']?$ticket['                          agentcreated']:'');
        $ticket['title']            = isset($post['title'])?$post['title']:'';

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
    }

    public function updateTicketStatus(){
        $ticketid = $this->input->post('ticketid');
        $status = 4;
        /*
        if(isset($this->input->post('status'))){
            $status = $this->input->post('status');
        }
        */
        $var = $this->session->userdata;
        $custid = $var['custid'];
        $roleid = $var['roleid'];
        $groupid = $var['groupid'];
        $postdata = http_build_query([
            'log_custid' => $custid,
            'log_roleid' => $roleid,
            'log_groupid' => $groupid,
            'ticketid' => $ticketid,
            'status' => $status,
            'action' => "Cập nhật trạng thái phiếu",
            'useraction'=> $custid,
            'cmt'=>'Hoàn thành'
        ]);
        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context  = stream_context_create($opts);

        $result = file_get_contents('http://test.tavicosoft.com/crm/index.php/ticket/update/'.$ticketid.'',false,$context);
        echo $result;
    }

    public function updateTicketNew()
    {
        $var = $this->session->userdata;
        $custid = $var['custid'];
        $roleid = $var['roleid'];
        $groupid = $var['groupid'];
        $ticketid = $this->input->post('ticketid');
        $ticketchannel = $this->input->post('ticketchannel');
        $priority = $this->input->post('priority');
        $bds_data = [];
        $bds_data['bds'] = $this->input->post('bds');
        $bds_data['gd'] = $this->input->post('gd');
        $bds_data['duan'] = $this->input->post('duan');
        $bds_data['dot'] = $this->input->post('dot');
        $agentcurrent = $this->input->post('agentcurrent');
        $ticketusers = $this->input->post('ticketusers');
        $changelog = $this->input->post('changelog');
        if(strpos($ticketusers,$agentcurrent)===false){
            $ticketusers.=",".$agentcurrent;
        }
        $data_ext = json_encode($bds_data);
        $postdata = http_build_query([
            'log_custid' => $custid,
            'log_roleid' => $roleid,
            'log_groupid' => $groupid,
            'agentcurrent'=>$agentcurrent,
            'ticketid' => $ticketid,
            'ticketchannel'=> $ticketchannel,
            'priority'=>$priority,
            'extension' => $data_ext,
            'action' => "Cập nhật phiếu",
            'useraction'=> $custid,
            'cmt'=>$this->input->post('cmt'),
            'sla'=>$this->input->post('sla'),
            'duedate'=>$this->input->post('duedate'),
            'finishdate'=>$this->input->post('finishdate'),
            'levelticket'=>$this->input->post('levelticket'),
            'type'=>$this->input->post('type'),
            'ticketusers'=>$ticketusers,
            'changelog'=>$changelog
        ]);
        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context  = stream_context_create($opts);

        $result = file_get_contents('http://test.tavicosoft.com/crm/index.php/ticket/update/'.$ticketid.'',false,$context);
        echo $result;
    }

    public function aj_update_ticket()
    {
        $post           = $this->input->post();        //var_dump($post);
        $var            = $this->session->userdata;
        $data_ext       = isset($post['ext'])?json_encode($post['ext']):null;
        $ticket         = [];

        $tid = $ticket['ticketid']  = isset($post['ticketid'])?$post['ticketid']:'';

        $ticket['log_custid']       = $var['custid'];
        $ticket['log_roleid']       = $var['roleid'];
        $ticket['log_groupid']      = $var['groupid'];
        $ticket['agentcurrent']     = isset($post['agentcurrent'])?$post['agentcurrent']:'';
        $ticket['title']     = isset($post['title'])?$post['title']:'';
        $ticket['ticketchannel']    = isset($post['ticketchannel'])?$post['ticketchannel']:'';
        $ticket['priority']         = isset($post['priority'])?$post['priority']:'';
        $ticket['extension']        = $data_ext!=null?$data_ext:'';
        $ticket['action']           = "Cập nhật phiếu";
        $ticket['useraction']       = $var['custid'];
        $ticket['cmt']              = isset($post['cmt'])?$post['cmt']:'';
        $ticket['sla']              = isset($post['sla'])?$post['sla']:'';
        $ticket['status']           = isset($post['ticketstatus'])?$post['ticketstatus']:'';
        $ticket['duedate']          = isset($post['duedate'])?$post['duedate']:'';
        $ticket['finishdate']       = isset($post['finishdate'])?$post['finishdate']:'';
        $ticket['levelticket']      = isset($post['levelticket'])?$post['levelticket']:'';
        $ticket['type']             = isset($post['tickettype'])?$post['tickettype']:'';
        $ticket['categoryid']       = isset($post['categoryid'])?$post['categoryid']:'';
        $ticket['ticketusers']      = isset($post['ticketusers'])?$post['ticketusers']:'';
        $ticket['changelog']        = isset($post['changelog'])?$post['changelog']:'';

        foreach ($ticket as $key => $value) {
            if ($value == '') {
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
    }

    public function updateTicketLog()
    {
        $var = $this->session->userdata;
        $custid = $var['custid'];
        $roleid = $var['roleid'];
        $groupid = $var['groupid'];
        $ticketid = $this->input->post('ticketid');
        $cmt = $this->input->post('cmt');
        $action  = "Ghi chú phiếu";
        $postdata = http_build_query([
            'log_custid' => $custid,
            'log_roleid' => $roleid,
            'log_groupid' => $groupid,
            'action' => $action,
            'useraction'=> $custid,
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

}
