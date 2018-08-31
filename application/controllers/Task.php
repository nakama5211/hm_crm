<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {
    private $_init = [];
	public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model(array('M_api'));

        //get list of ticket id
        $res = file_get_contents('http://test.tavicosoft.com/crm/index.php/ticket/selectticket');
        $this->_init['l_ticket'] = json_decode($res,true)['data'];
        // get the type ticket
        $l_type = file_get_contents('http://test.tavicosoft.com/crm/index.php/codedictionary/select/tcktype');
        $this->_init['l_type'] = json_decode($l_type,true)['data'];
    }

	public function index()
	{

		$data = [];
		$res = file_get_contents('http://test.tavicosoft.com/crm/index.php/task/gettask?pic='.$this->session->userdata('custid'));
        $data['record'] = json_decode($res,true)['data'];
        // var_dump($data);

		$_data = [];
		$_data['script']  = $this->load->view('task/s_task', null, TRUE);
		$_data['mainview'] = $this->load->view('task/task', $data , TRUE);

		$this->load->view('dashboard',$_data);
	}

	public function create()
	{
		$data = [];
        $data['l_ticket']       = $this->_init['l_ticket'];
        $data['l_type']         = $this->_init['l_type'];

		$list_user = json_decode($this->M_api->getlistcustomer(0),true);
        $data['l_cus'] = $list_user['data'];

		$_data = [];
		$_data['script']    = $this->load->view('task/s_insert', null, TRUE);
		$_data['mainview']  = $this->load->view('task/new', $data , TRUE);

		$this->load->view('dashboard',$_data);
	}

	public function detail($taskid)
	{
		$data = [];
        $data['l_ticket']       = $this->_init['l_ticket'];
        $data['l_type']         = $this->_init['l_type'];
        
		$list_user = json_decode($this->M_api->getlistcustomer(0),true);
        $data['l_cus'] = $list_user['data'];
		$res = file_get_contents('http://test.tavicosoft.com/crm/index.php/task/select/'.$taskid);
        $data['record'] = json_decode($res,true)['data'];
        $res = file_get_contents('http://test.tavicosoft.com/crm/index.php/taskdetail/select/'.$taskid);
        $data['comment'] = json_decode($res,true)['data'];
        // var_dump($data);

		$_data = [];
		$_data['script']    = $this->load->view('task/s_update', null, TRUE);
		$_data['mainview'] = $this->load->view('task/detail', $data , TRUE);

		$this->load->view('dashboard',$_data);
	}

    public function de_tail($recordid)
    {
        $data = [];
        $data['l_ticket']       = $this->_init['l_ticket'];
        $data['l_type']         = $this->_init['l_type'];
        
        $list_user = json_decode($this->M_api->getlistcustomer(0),true);
        $data['l_cus'] = $list_user['data'];
        $res = file_get_contents('http://test.tavicosoft.com/crm/index.php/task/gettask?recordid='.$recordid);
        $data['record'] = json_decode($res,true)['data'];
        $res = file_get_contents('http://test.tavicosoft.com/crm/index.php/taskdetail/select/'.$data['record'][0]['taskid']);
        $data['comment'] = json_decode($res,true)['data'];
        // var_dump($data);

        $_data = [];
        $_data['script']    = $this->load->view('task/s_update', null, TRUE);
        $_data['mainview'] = $this->load->view('task/detail', $data , TRUE);

        $this->load->view('dashboard',$_data);
    }

	public function ticket()
	{
		$_data = [];
		$_data['navbar'] = $this->load->view('navbar/navbar', NULL, TRUE); 
		$_data['sidebar'] = $this->load->view('sidebar/sidebar', NULL, TRUE);  
		$_data['mainview'] = $this->load->view('task/ticket', NULL , TRUE);

		$this->load->view('master',$_data);
	}




	public function aj_api_insert(){
		$post = $this->input->post();
		//var_dump($post);

        $var            = $this->session->userdata;

        $req_data         = [];

        $taskid = $req_data['taskid'] = $this->M_api->gen_taskid();
        $req_data['status']     	  = isset($post['status'])?$post['status']:'O';
        $req_data['taskmaster']       = isset($post['u_request'])?$post['u_request']:'';
        $req_data['pic']       		  = isset($post['u_responsi'])?$post['u_responsi']:'';
        $req_data['ticketid']     	  = isset($post['ticketid'])?$post['ticketid']:'';
        $req_data['tasktype']     	  = isset($post['type'])?$post['type']:'';
        $req_data['requestdate']      = isset($post['req_date'])?$post['req_date']:'';
        $req_data['sla']    		  = isset($post['ola_date'])?$post['ola_date']:'';
        $req_data['duedate']          = isset($post['due_date'])?$post['due_date']:'';
        $req_data['priority']         = isset($post['priority'])?$post['priority']:'';
        $req_data['finishdate']       = isset($post['fns_date'])?$post['fns_date']:'';
        $req_data['title']            = isset($post['title'])?$post['title']:'';
        $req_data['createdby']        = isset($var['custid'])?$var['custid']:'';

        // var_dump($req_data);
        $postdata   = http_build_query($req_data);
        $opts       = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context  = stream_context_create($opts);

        $result = file_get_contents('http://test.tavicosoft.com/crm/index.php/task/insert',false,$context);

        $_res = json_decode($result,true);
        if (isset($_res['code']) && $_res['code'] == 1 && isset($post['cmt']) && $post['cmt'] !='') {
        	$log['taskid']     		= $taskid;
        	$log['tvcdb']     		= "AGT";
        	$log['tskaction']  		= "";
        	$log['comments']   		= $post['cmt'];
            $log['avatar']          = isset($post['avatar'])?$post['avatar']:'';
        	$log['changelog']  		= '';
        	$log['createdby']  		= isset($var['custid'])?$var['custid']:'';
        	$_result 				= $this->task_log($log);
        }
        echo $result;
	}

	public function aj_api_update(){
		$post = $this->input->post();
		//var_dump($post);

        $var            = $this->session->userdata;

        $req_data         = [];

        $taskid     	  			  = isset($post['taskid'])?$post['taskid']:'';

        $req_data['status']     	  = isset($post['status'])?$post['status']:'';
        $req_data['taskmaster']       = isset($post['u_request'])?$post['u_request']:'';
        $req_data['pic']       		  = isset($post['u_responsi'])?$post['u_responsi']:'';
        $req_data['ticketid']     	  = isset($post['ticketid'])?$post['ticketid']:'';
        $req_data['tasktype']     	  = isset($post['type'])?$post['type']:'';
        $req_data['requestdate']      = isset($post['req_date'])?$post['req_date']:'';
        $req_data['sla']    		  = isset($post['ola_date'])?$post['ola_date']:'';
        $req_data['duedate']          = isset($post['due_date'])?$post['due_date']:'';
        $req_data['priority']         = isset($post['priority'])?$post['priority']:'';
        $req_data['finishdate']       = isset($post['fns_date'])?$post['fns_date']:'';
        $req_data['title']            = isset($post['title'])?$post['title']:'';
        $req_data['createdby']        = isset($var['custid'])?$var['custid']:'';

        foreach ($req_data as $key => $value) {
            if ($value == '') {
                unset($req_data[$key]);
            }
        }

        // var_dump($req_data);
        $postdata   = http_build_query($req_data);
        $opts       = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context  = stream_context_create($opts);

        $result = file_get_contents('http://test.tavicosoft.com/crm/index.php/task/update/'.$taskid,false,$context);

        $_res = json_decode($result,true);
        if (isset($_res['code']) && $_res['code'] == 1) {
        	$log['taskid']     		= $taskid;
        	$log['tskaction']  		= isset($post['action'])?$post['action']:"Cập nhật công việc";
        	$log['comments']   		= isset($post['cmt'])?$post['cmt']:'';
            $log['avatar']          = isset($post['avatar'])?$post['avatar']:'';
        	$log['changelog']  		= isset($post['changelog'])?$post['changelog']:'';
        	$log['createdby']  		= isset($var['custid'])?$var['custid']:'';
        	$_result 				= $this->task_log($log);
        }

        echo $result;
	}

	private function task_log($log){
		$postdata   = http_build_query($log);
        $opts       = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context  = stream_context_create($opts);

        $result = file_get_contents('http://test.tavicosoft.com/crm/index.php/taskdetail/insert',false,$context);
        return $result;
	}
}