<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_data_API extends CI_Model {
	public function __construct()
	{
		parent::__construct();
        $this->dayCompare = strtotime('2000-01-01T00:00:00');
	}
	public function loadTicketContract($contractid)
	{
		$json_ticket_bottom = file_get_contents('http://test.tavicosoft.com/crm/index.php/ticket/search?transref='.$contractid.'');
        $data['trade_cntt'] = json_decode($json_ticket_bottom,true)['data'];
        $text = '';
        for ($i=0; $i < count($data['trade_cntt']); $i++) { 
            $timeCreate = preg_replace('/\s/', 'T',$data['trade_cntt'][$i]['createat']);
                $timeUpdate = preg_replace('/\s/', 'T',$data['trade_cntt'][$i]['lastupdate']);
                if(strtotime($timeCreate) > $this->dayCompare)
                {
                    $createat = date("d/m/Y",strtotime($timeCreate));
                }else{$createat='';}
                if(strtotime($timeUpdate) > $this->dayCompare)
                {
                    $lastupdate = date("d/m/Y",strtotime($timeUpdate));
                }else{$lastupdate='';}
            $href = ''.base_url().'ticket/detail/'.$data['trade_cntt'][$i]['ticketid'].'/'.$data['trade_cntt'][$i]['custid'].'';
            $onclick = "addTab('".$href."','".$data['trade_cntt'][$i]['ticketid']."')";
            if($i == (count($data['trade_cntt'])-1))
            {
                
                $text .= '[
                       "<a onclick='.$onclick.' href=\'#\'><span class=\'id-label span-danger\'>O</span> #' .$data['trade_cntt'][$i]['ticketid']. '</a>",
                       "'.$data['trade_cntt'][$i]['title'].'",
                       "'.$createat.'",
                       "'.$data['trade_cntt'][$i]['name'].'",
                       "'.$lastupdate.'"
                      ]';
            }
            else
            {
                $text .= '[
                       "<a onclick='.$onclick.' href=\'#\'><span class=\'id-label span-danger\'>O</span> #' .$data['trade_cntt'][$i]['ticketid']. '</a>",
                       "'.$data['trade_cntt'][$i]['title'].'",
                       "'.$createat.'",
                       "'.$data['trade_cntt'][$i]['name'].'",
                       "'.$lastupdate.'"
                      ],
                      ';
            }
        }

        echo '{
              "data": 
                [
                    '.$text.'
                ]
            }';
	}
	public function getContractByIdcard($idcard,$opid)
	{
		$data_contractc = array(
            'reportcode'=>'crmContract01',
            'limit'=>25,
            'start'=>0,
            'queryFilters'=>array(
                'idcard'=> $idcard
            )
        );

        $result_contractc = $this->M_api->execute_normal_api("http://crm.tavicosoft.com/dev/api/get_list_contract",$data_contractc);
        $_json_contractc = json_decode($result_contractc,true);
        $_json2_contractc = json_decode($_json_contractc,true);
        $data['trade_cntt'] = $_json2_contractc["result"]["data"]; 
        $text = '';
        $array['data'] = [];
        for ($i=0; $i < count($data['trade_cntt']); $i++) { 
            if(strtotime($data['trade_cntt'][$i]['startdate']) > $this->dayCompare)
            {
                $startdate = date("d/m/Y",strtotime($data['trade_cntt'][$i]['startdate']));
            }else{$startdate='';}
            if(strtotime($data['trade_cntt'][$i]['effectivedate']) > $this->dayCompare)
            {
                $effectivedate = date("d/m/Y",strtotime($data['trade_cntt'][$i]['effectivedate']));
            }else{$effectivedate='';}
            $href = ''.base_url().'user/contract/'.$data['trade_cntt'][$i]['contractid'].'?opid='.$opid.'';
            $onclick = "addTab('".$href."','".$data['trade_cntt'][$i]['contractid']."')";
            $_arr = ["<a onclick=".$onclick." href='#'>".$data['trade_cntt'][$i]['contractid']. "</a>","".$data['trade_cntt'][$i]['status']."","".$data['trade_cntt'][$i]['property']."","".$startdate."","".$effectivedate."","".$data['trade_cntt'][$i]['notes'].""];
            array_push($array['data'],$_arr);
        }
        echo json_encode($array);
	}
	public function getCongnoThanhtoan($contractid)
	{
		$data_contractc = array(
            'method' => 'getReturnData',
            'reportcode'=>'crmContract01c',
            'limit'=>25,
            'start'=>0,
            'queryFilters'=>array(
                'contractid'=> $contractid
            )
        );

        $result_contractc = $this->M_api->execute_normal_api("http://crm.tavicosoft.com/dev/api/get_list_contract",$data_contractc);
        $_json_contractc = json_decode($result_contractc,true);
        $_json2_contractc = json_decode($_json_contractc,true);
        $data['trade_cntt'] = $_json2_contractc["result"]["data"];
        $text = '';
        for ($i=0; $i < count($data['trade_cntt']); $i++) { 
          if(strtotime($data['trade_cntt'][$i]['transdate']) > $this->dayCompare)
                {
                    $transdate = date("d/m/Y",strtotime($data['trade_cntt'][$i]['transdate']));
                }else{$transdate='';}
                if(strtotime($data['trade_cntt'][$i]['duedate']) > $this->dayCompare)
                {
                    $duedate = date("d/m/Y",strtotime($data['trade_cntt'][$i]['duedate']));
                }else{$duedate='';}
            if($i == (count($data['trade_cntt'])-1))
            {
                
                $text .= '[
                       "'.$data['trade_cntt'][$i]['revenuetype'].'",
                       "'.$data['trade_cntt'][$i]['value0'].'",
                       "'.$data['trade_cntt'][$i]['value4'].'",
                       "'.$transdate.'",
                       "'.$duedate.'",
                       "'.number_format(abs($data['trade_cntt'][$i]['amount'])).'",
                       "'.$data['trade_cntt'][$i]['extdescription1'].'",
                       "'.$data['trade_cntt'][$i]['allocation'].'",
                       "'.$data['trade_cntt'][$i]['anal_r9'].'"
                      ]';
            }
            else
            {
                $text .= '[
                       "'.$data['trade_cntt'][$i]['revenuetype'].'",
                       "'.$data['trade_cntt'][$i]['value0'].'",
                       "'.$data['trade_cntt'][$i]['value4'].'",
                       "'.$transdate.'",
                       "'.$duedate.'",
                       "'.number_format(abs($data['trade_cntt'][$i]['amount'])).'",
                       "'.$data['trade_cntt'][$i]['extdescription1'].'",
                       "'.$data['trade_cntt'][$i]['allocation'].'",
                       "'.$data['trade_cntt'][$i]['anal_r9'].'"
                      ],
                      ';
            }
        }

        echo '{
              "data": 
                [
                    '.$text.'
                ]
            }';
	}
	public function getHistory($contractid)
	{
		$data_contractc = array(
            'method' => 'qry',
            'reportcode'=>'crmContract01b',
            'limit'=>25,
            'start'=>0,
            'queryFilters'=>array(
                'contractid'=> $contractid
            )
        );
        $result_contractc = $this->M_api->execute_normal_api("http://crm.tavicosoft.com/dev/api/get_list_contract",$data_contractc);
        $_json_contractc = json_decode($result_contractc,true);
        $_json2_contractc = json_decode($_json_contractc,true);
        $data['trade_cntt'] = $_json2_contractc["result"]["data"];
        $text = '';
        for ($i=0; $i < count($data['trade_cntt']); $i++) { 
                if(strtotime($data['trade_cntt'][$i]['statusdate']) > $this->dayCompare)
                {
                    $statusdate = date("d/m/Y",strtotime($data['trade_cntt'][$i]['statusdate']));
                }else{$statusdate='';}
            if($i == (count($data['trade_cntt'])-1))
            {
                $text .= '[
                       "'.$data['trade_cntt'][$i]['status'].'",
                       "'.$statusdate.'",
                       "'.number_format($data['trade_cntt'][$i]['name']).'",
                       "'.number_format($data['trade_cntt'][$i]['name1']).'",
                       "'.$data['trade_cntt'][$i]['remarks'].'"
                      ]';
            }
            else
            {
                $text .= '[
                       "'.$data['trade_cntt'][$i]['status'].'",
                       "'.$statusdate.'",
                       "'.$data['trade_cntt'][$i]['name'].'",
                       "'.$data['trade_cntt'][$i]['name1'].'",
                       "'.$data['trade_cntt'][$i]['remarks'].'"
                      ],
                      ';
            }
        }

        echo '{
              "data": 
                [
                    '.$text.'
                ]
            }';
	}
	public function getGift($contractid)
	{
		$data_contractc = array(
            'method' => 'qry',
            'reportcode'=>'crmContract01d',
            'limit'=>25,
            'start'=>0,
            'queryFilters'=>array(
                'contractid'=> $contractid
            )
        );
        $result_contractc = $this->M_api->execute_normal_api("http://crm.tavicosoft.com/dev/api/get_list_contract",$data_contractc);
        $_json_contractc = json_decode($result_contractc,true);
        $_json2_contractc = json_decode($_json_contractc,true);
        $data['trade_cntt'] = $_json2_contractc["result"]["data"];
        $text = '';
        for ($i=0; $i < count($data['trade_cntt']); $i++) { 
                if(strtotime($data['trade_cntt'][$i]['promotiondate']) > $this->dayCompare)
                {
                    $promotiondate = date("d/m/Y",strtotime($data['trade_cntt'][$i]['promotiondate']));
                }else{$promotiondate='';}
            if($i == (count($data['trade_cntt'])-1))
            {
                $text .= '[
                       "'.$promotiondate.'",
                       "'.$data['trade_cntt'][$i]['description'].'",
                       "'.number_format($data['trade_cntt'][$i]['quantity']).'",
                       "'.number_format(abs($data['trade_cntt'][$i]['amount'])).'",
                       "'.$data['trade_cntt'][$i]['remarks'].'"
                      ]';
            }
            else
            {
                $text .= '[
                       "'.$promotiondate.'",
                       "'.$data['trade_cntt'][$i]['description'].'",
                       "'.$data['trade_cntt'][$i]['quantity'].'",
                       "'.$data['trade_cntt'][$i]['amount'].'",
                       "'.$data['trade_cntt'][$i]['remarks'].'"
                      ],
                      ';
            }
        }

        echo '{
              "data": 
                [
                    '.$text.'
                ]
            }';
	}
	public function getBussEmployee($contractid)
	{
		$data_contractc = array(
            'method' => 'qry',
            'reportcode'=>'crmContract01f',
            'limit'=>25,
            'start'=>0,
            'queryFilters'=>array(
                'contractid'=> $contractid
            )
        );
        $result_contractc = $this->M_api->execute_normal_api("http://crm.tavicosoft.com/dev/api/get_list_contract",$data_contractc);
        $_json_contractc = json_decode($result_contractc,true);
        $_json2_contractc = json_decode($_json_contractc,true);
        $data['trade_cntt'] = $_json2_contractc["result"]["data"];
        $text = '';
        for ($i=0; $i < count($data['trade_cntt']); $i++) { 
            if($i == (count($data['trade_cntt'])-1))
            {
                $text .= '[
                       "'.$data['trade_cntt'][$i]['name'].'",
                       "'.$data['trade_cntt'][$i]['name1'].'",
                       "'.number_format((float)$data['trade_cntt'][$i]['commissionrate'],5,'.','').'",
                       "'.$data['trade_cntt'][$i]['remarks'].'"
                      ]';
            }
            else
            {
                $text .= '[
                       "'.$data['trade_cntt'][$i]['name'].'",
                       "'.$data['trade_cntt'][$i]['name1'].'",
                       "'.number_format((float)$data['trade_cntt'][$i]['commissionrate'],5,'.','').'",
                       "'.$data['trade_cntt'][$i]['remarks'].'"
                      ],
                      ';
            }
        }

        echo '{
              "data": 
                [
                    '.$text.'
                ]
            }';
	}
	public function getNotes($contractid)
	{
		$data_contractc = array(
            'method' => 'qry',
            'reportcode'=>'crmContract01h',
            'limit'=>25,
            'start'=>0,
            'queryFilters'=>array(
                'contractid'=> $contractid
            )
        );
        $result_contractc = $this->M_api->execute_normal_api("http://crm.tavicosoft.com/dev/api/get_list_contract",$data_contractc);
        $_json_contractc = json_decode($result_contractc,true);
        $_json2_contractc = json_decode($_json_contractc,true);
        $data['trade_cntt'] = $_json2_contractc["result"]["data"];
        $text = '';
        for ($i=0; $i < count($data['trade_cntt']); $i++) { 
                if(strtotime($data['trade_cntt'][$i]['eventdate']) > $this->dayCompare)
                {
                    $eventdate = date("d/m/Y",strtotime($data['trade_cntt'][$i]['eventdate']));
                }else{$eventdate='';}
            if($i == (count($data['trade_cntt'])-1))
            {
                $text .= '[
                       "'.$data['trade_cntt'][$i]['eventtype'].'",
                       "'.$eventdate.'",
                       "'.$data['trade_cntt'][$i]['eventstatus'].'",
                       "'.$data['trade_cntt'][$i]['name'].'",
                       "'.$data['trade_cntt'][$i]['notes'].'"
                      ]';
            }
            else
            {
                $text .= '[
                       "'.$data['trade_cntt'][$i]['eventtype'].'",
                       "'.$eventdate.'",
                       "'.$data['trade_cntt'][$i]['eventstatus'].'",
                       "'.$data['trade_cntt'][$i]['name'].'",
                       "'.$data['trade_cntt'][$i]['notes'].'"
                      ],
                      ';
            }
        }

        echo '{
              "data": 
                [
                    '.$text.'
                ]
            }';
	}
}

/* End of file M_data_API.php */
/* Location: ./application/models/M_data_API.php */
?>