<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Knowledge extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url','json_output'));
    }

	public function index()
	{
		$_data = [];    
		$json_data = file_get_contents('http://test.tavicosoft.com/crm/index.php/news/select/') ;
		$knowledge['news'] = json_decode($json_data,true)['data'];
		$agent = file_get_contents('http://test.tavicosoft.com/crm/index.php/customer/getcustomerbyroleid/2');
		$knowledge['agent'] = json_decode($agent,true)['data'];

		$l_group = file_get_contents('http://test.tavicosoft.com/crm/index.php/codedictionary/select/knwgroup');
		$knowledge['l_group'] = json_decode($l_group,true)['data'];

		$l_cate = file_get_contents('http://test.tavicosoft.com/crm/index.php/codedictionary/select/knwdetail');
		$knowledge['l_cate'] = json_decode($l_cate,true)['data'];

		$l_type = file_get_contents('http://test.tavicosoft.com/crm/index.php/codedictionary/select/tcktype');
		$knowledge['l_type'] = json_decode($l_type,true)['data'];

		$_data['navbar'] = $this->load->view('navbar/navbar', NULL, TRUE); 
		$_data['sidebar'] = $this->load->view('sidebar/sidebar', NULL, TRUE);  
		$_data['mainview'] = $this->load->view('knowledge/knowledge', $knowledge , TRUE);
		$_data['script'] = $this->load->view('script/script_knowledge', NULL, TRUE);
		$this->load->view('dashboard',$_data);
	}

	public function detail($action = 'add',$id ='')
	{
		$_script = [];
		if($action =='add')
		{
			$_script['action'] = 'add';
		}
		$_data = [];   
		$data=[]; 
		if($action=='edit')
		{
			$json_data = file_get_contents('http://test.tavicosoft.com/crm/index.php/news/select/'.$id);
			$data['knowledge'] = json_decode($json_data,true)['data'];
		}

		$l_group = file_get_contents('http://test.tavicosoft.com/crm/index.php/codedictionary/select/knwgroup');
		$data['l_group'] = json_decode($l_group,true)['data'];

		$l_cate = file_get_contents('http://test.tavicosoft.com/crm/index.php/codedictionary/select/knwdetail');
		$data['l_cate'] = json_decode($l_cate,true)['data'];

		$l_type = file_get_contents('http://test.tavicosoft.com/crm/index.php/codedictionary/select/tcktype');
		$data['l_type'] = json_decode($l_type,true)['data'];

		$_data['navbar'] = $this->load->view('navbar/navbar', NULL, TRUE); 
		$_data['sidebar'] = $this->load->view('sidebar/sidebar', NULL, TRUE);  
		$_data['mainview'] = $this->load->view('knowledge/detail', $data , TRUE);
		$_data['script'] = $this->load->view('script/ckeditor', $_script, TRUE);

		$this->load->view('dashboard',$_data);
	}

	public function detailKnowledge()
	{
		$id = $this->input->post('id');
		$json_data = file_get_contents('http://test.tavicosoft.com/crm/index.php/news/select/'.$id) ;
		echo $json_data;
	}

	public function insertKnowledge()
	{
		$data = $this->input->post();
		$postdata = http_build_query([
                'title' => isset($data['title'])?$data['title']:null,
                'article' => isset($data['article'])?$data['article']:null,
                'groupid' => isset($data['group'])?$data['group']:null,
                'categoryid' => isset($data['cate'])?$data['cate']:null,
                'hidden' => isset($data['status'])?$data['status']:null,
                'tickettype' => isset($data['type'])?$data['type']:null,
                'createby' => $this->session->userdata('custid'),
                'ticketprioty' => isset($data['ticketprioty'])?$data['ticketprioty']:null
        ]); 
        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context  = stream_context_create($opts);

        $result = file_get_contents('http://test.tavicosoft.com/crm/index.php/news/insert',false,$context) ;
        echo $result;
	}

	public function updateKnowledge()
	{
		$data = $this->input->post();
		$postdata = http_build_query([
                'title' => isset($data['title'])?$data['title']:null,
                'article' => isset($data['article'])?$data['article']:null,
                'groupid' => isset($data['group'])?$data['group']:null,
                'categoryid' => isset($data['cate'])?$data['cate']:null,
                'hidden' => isset($data['status'])?$data['status']:null,
                'tickettype' => isset($data['type'])?$data['type']:null,
                'ticketprioty' => isset($data['ticketprioty'])?$data['ticketprioty']:null
        ]); 
        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context  = stream_context_create($opts);

        $result = file_get_contents('http://test.tavicosoft.com/crm/index.php/news/update/'.$data['id'],false,$context) ;
        echo $result;
	}


	public function search()
	{
		$get = $this->input->get();
		$query = '?';
		foreach ($get as $key => $value) {
			$v = '';
			if (($key=='categoryid' || $key=='tickettype' || $key=='groupid') && $value == "all") {
				$v = '';
			}else{
				$v = $value;
			}
			$query.=$key.'='.rawurlencode($v).'&';
		}  
		$json_data = file_get_contents('http://test.tavicosoft.com/crm/index.php/news/search'.$query);
		$knowledge['news'] = json_decode($json_data,true)['data'];

		$l_group = file_get_contents('http://test.tavicosoft.com/crm/index.php/codedictionary/select/knwgroup');
		$knowledge['l_group'] = json_decode($l_group,true)['data'];

		$l_cate = file_get_contents('http://test.tavicosoft.com/crm/index.php/codedictionary/select/knwdetail');
		$knowledge['l_cate'] = json_decode($l_cate,true)['data'];

		$l_type = file_get_contents('http://test.tavicosoft.com/crm/index.php/codedictionary/select/tcktype');
		$knowledge['l_type'] = json_decode($l_type,true)['data'];
		$_data['script'] = $this->load->view('script/script_knowledge', NULL, TRUE);  
		$_data['mainview'] = $this->load->view('knowledge/iframe', $knowledge , TRUE);
		$this->load->view('dashboard',$_data);
		// echo $query;
	}

	public function fulltext()
	{
		$get = $this->input->get();
		$query = '?';
		foreach ($get as $key => $value) {
			$query.=$key.'='.rawurlencode($value).'&';
		}  
		$json_data = file_get_contents('http://test.tavicosoft.com/crm/index.php/news/search'.$query);
		$knowledge = json_decode($json_data,true)['data'];
		json_output(200,$knowledge);
	}
}