<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Groupuser extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		 $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model('M_api');
	}
	public function index()
	{	
		$_body = [];
		$_data = [];    
		$group_data = $this->M_api->getlistgroup();
		$data['listgroup'] = json_decode($group_data,true)['data'];

		$__jsonCount = file_get_contents('http://test.tavicosoft.com/crm/index.php/group/countgroupid');
		$data['countPeople'] = json_decode($__jsonCount,true)['data'];
		$_data['script'] = $this->load->view('script/script_dashboard', NULL, TRUE); 
		$_data['script2'] = $this->load->view('script/script_group_edit', NULL, TRUE);  
		$_data['mainview'] = $this->load->view('groupuser/center/gu_info', $data , TRUE);
		$this->load->view('dashboard',$_data);
	}

	public function fielduser()
	{
		$_data = [];    
		$_jsonlistext = file_get_contents('http://test.tavicosoft.com/crm/index.php/extdata/select/user');
        $list_ext = json_decode($_jsonlistext,true);
        $customer['list_ext'] = $list_ext['data']; 
		$_data['script'] = $this->load->view('script/script_dashboard', NULL, TRUE);  
		$_data['mainview'] = $this->load->view('groupuser/center/gu_fielduser', $customer , TRUE);
		$this->load->view('dashboard',$_data);
	}
	public function fielddetail()
	{
		$list_extend['list_ext'] = [];
		$list_extend['detail'] =[];
		$fieldtype = $this->uri->segment(4);
		if($fieldtype == 'D')
		{
			$datasource = $this->uri->segment(5);
			$_jsonlistext = file_get_contents('http://test.tavicosoft.com/crm/index.php/codedictionary/select/'.$datasource);
	        $list_ext = json_decode($_jsonlistext,true);
	        $list_extend['list_ext'] = $list_ext['data']; 
		}
		$fieldcode  = $this->uri->segment(3);
		$_jsondetail = file_get_contents('http://test.tavicosoft.com/crm/index.php/extdata/getextdatabycode/'.$fieldcode);
	        $list_field = json_decode($_jsondetail,true);
	        $list_detail['detail'] = $list_field['data']; 
	        $list_extend['detail'] = $list_field['data']; 
		$_body = [];
		$_body['left'] = $this->load->view('groupuser/left/gu_left_field',$list_detail,TRUE); 
		$_body['center'] = $this->load->view('groupuser/center/gu_center_field', $list_extend, TRUE);
		$_data = [];    
		$_data['navbar'] = $this->load->view('navbar/navbar', NULL, TRUE); 
		$_data['sidebar'] = $this->load->view('sidebar/sidebar', NULL, TRUE); 
		$_data['script'] = $this->load->view('script/script_dashboard', NULL, TRUE);  
		$_data['mainview'] = $this->load->view('groupuser/gu_main', $_body , TRUE);
		$this->load->view('dashboard',$_data);	
	}

	public function fieldticket()
	{
		$_data = [];    
		$_jsonlistext = file_get_contents('http://test.tavicosoft.com/crm/index.php/extdata/select/ticket');
        $list_ext = json_decode($_jsonlistext,true);
        $customer['list_ext'] = $list_ext['data']; 
		$_data['script'] = $this->load->view('script/script_dashboard', NULL, TRUE);  
		$_data['mainview'] = $this->load->view('groupuser/center/gu_fieldticket', $customer , TRUE);
		$this->load->view('dashboard',$_data);
	}

	public function groupuserdetail()
	{
		$groupid=$this->input->get('groupid');
		$_body = [];
		$group = [];
		$group_detail = $this->M_api->getlistgroup($groupid);
		$group['gdetail'] = json_decode($group_detail,true)['data'][0];
		$customerbygroup = $this->M_api->getlistcustomerbygroupid($group['gdetail']['groupid']);
		$group['useringroup'] = json_decode($customerbygroup,true)['data']; 
		$_body['left'] = $this->load->view('groupuser/left/gu_left_groupuser',$group,TRUE);
		$_body['center'] = $this->load->view('groupuser/center/gu_center_groupuser', $group, TRUE);
		$_data = [];    
		$_data['navbar'] = $this->load->view('navbar/navbar', NULL, TRUE); 
		$_data['sidebar'] = $this->load->view('sidebar/sidebar', NULL, TRUE); 
		$_data['script'] = $this->load->view('script/script_group_edit', NULL, TRUE);  
		$_data['script2'] = $this->load->view('script/script_dashboard', NULL, TRUE);  
		$_data['mainview'] = $this->load->view('groupuser/gu_main', $_body , TRUE);
		$this->load->view('dashboard',$_data);	
	}

	public function updategroup(){
		$groupid = $this->input->post('groupid');
        $ticketrule = $this->input->post('ticketrule');
        $postdata = http_build_query([
            'ticketrule'=>$ticketrule,
            'userrule'=>$this->input->post('userrule'),
            'taskrule'=>$this->input->post('taskrule'),
            'knowledgerule'=>$this->input->post('knowledgerule'),
            'status'=>$this->input->post('status'),
        ]);
        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context  = stream_context_create($opts);

        $result = file_get_contents('http://test.tavicosoft.com/crm/index.php/group/update/'.$groupid.'',false,$context);
        echo $result;
	}

	public function groupuserinsert()
	{
		$data =$this->input->post();
		$postdata = http_build_query(['groupname' => $data['groupname'],
						'roleid' =>$data['roleid'],
						'status' =>$data['status'],
						'userrule' =>$data['userrule'],
						'ticketrule'=>$data['ticketrule'],
						'taskrule'=>$data['taskrule'],
						'knowledgerule'=>$data['knowledgerule']]);
		$opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context  = stream_context_create($opts);

        $result = file_get_contents('http://test.tavicosoft.com/crm/index.php/GroupTest/insert',false,$context);
        echo $result;
	}

	public function viewInsertGroup()
	{
		$_body = [];
		$group = [];
		$_body['left'] = $this->load->view('groupuser/left/gu_left_creategroup',null,TRUE);
		$_data = [];    
		$_data['navbar'] = $this->load->view('navbar/navbar', NULL, TRUE); 
		$_data['sidebar'] = $this->load->view('sidebar/sidebar', NULL, TRUE);  
		$_data['script'] = $this->load->view('script/script_create_groupuser', NULL, TRUE); 
		$_data['mainview'] = $this->load->view('groupuser/gu_main', $_body , TRUE);
		$this->load->view('dashboard',$_data);	
	}

	public function postData($array,$url)
	{
		$postdata = http_build_query([
                $array
        ]); 
        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context  = stream_context_create($opts);

        $result = file_get_contents($url,false,$context) ;
        return $result;
	}

	public function insertFieldUser()
	{
		$data= $this->input->post();
		$postdata = http_build_query([
						'tvcdb' => 'AGT',
						'status'=>'1',
						'fieldtype' => isset($data['fieldtype'])?$data['fieldtype']:'',
						'formid' => isset($data['formid'])?$data['formid']:'',
						'fieldcode' =>isset($data['fieldcode'])?$data['fieldcode']:'',
						'datasource' =>isset($data['datasource'])?$data['datasource']:'',
						'fieldname' =>isset($data['fieldname'])?$data['fieldname']:'']);
		$opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context  = stream_context_create($opts);

        $result = file_get_contents('http://test.tavicosoft.com/crm/index.php/extdata/insert',false,$context);

		 $__data1 = parse_str($data['dataExt'], $get_array);
         if($data['dataExt'] !=null)
         {
         	for ($i=0; $i <count($get_array['code']) ; $i++) { 
         				$postdata_codic = http_build_query([
										'code' => $get_array['code'][$i],
										'name' => $get_array['name'][$i],
										'status' =>'W',
										'category' =>$data['datasource'],
										'tvcdb' =>'AGT']);
						$opts_codic = array('http' =>
				            array(
				                'method'  => 'POST',
				                'header'  => 'Content-type: application/x-www-form-urlencoded',
				                'content' => $postdata_codic
				            )
				        );
				        $context_codic  = stream_context_create($opts_codic);

				        $result_codic = file_get_contents('http://test.tavicosoft.com/crm/index.php/codedictionary/insert',false,$context_codic);
         	}
         }
        echo $result;
	}

	public function insertSelectBox()
	{
		$data = $this->input->post();
		$postdata = http_build_query([
						'code' => $data['code'],
						'name' => $data['name'],
						'status' =>'W',
						'category' =>$data['category'],
						'tvcdb' =>'AGT']);
		$opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context  = stream_context_create($opts);

        $result = file_get_contents('http://test.tavicosoft.com/crm/index.php/codedictionary/insert',false,$context);
        echo $result;
	}

	public function updateFields()
	{
		$data = $this->input->post();
		$postdata = http_build_query([
						'fieldcode' => $data['fieldcode'],
						'fieldname' => $data['fieldname'],
						'status' =>$data['status']]);
		$opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context  = stream_context_create($opts);

        $result = file_get_contents('http://test.tavicosoft.com/crm/index.php/extdata/update/'.$data['fieldcode'],false,$context);
        echo $result;
	}

	public function updateCodictionary()
	{
		$data = $this->input->post();
		if($data['action'] == 'delete')
		{
			$status = 'C';
		}
		else
		{
			$status = 'W';
		}
		$postdata = http_build_query([
						'code' => $data['code'],
						'category' => $data['category'],
						'status' =>$status,
						'name'=> isset($data['name'])?$data['name']:null
					]);
		$opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context  = stream_context_create($opts);

        $result = file_get_contents('http://test.tavicosoft.com/crm/index.php/codedictionary/update/'.$data['category'].'/'.$data['code'],false,$context);
        echo $result;
	}

}

/* End of file Groupuser.php */
/* Location: ./application/controllers/Groupuser.php */
?>