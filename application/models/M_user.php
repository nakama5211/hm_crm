<?php
//Lê Cường
//Ngày : 10-09-09
//Custid : Mã khách hàng , duy nhất
defined('BASEPATH') OR exit('No direct script access allowed');
class M_user extends CI_Model
{

    /*Xứ lý tất cả logic của user ở đây*/

     public function __construct()
    {
        parent::__construct();
    }
    //API URL Gọi lấy dự liệu DB
	private $url_api_db = "http://test.tavicosoft.com/crm/index.php/";

    //Lấy user bằng custid
	public function getUserByCustId($custid,$dataAuth=''){
        $user = $this->cache->memcached->get('user_'.$custid);
        if (!$user){
            $user = file_get_contents($this->url_api_db.'customer/getcustomerbycustid/'.$custid.'');
            $this->cache->memcached->save('user_'.$custid,$user, 86400);
        }
        return json_decode($user,true);
    }



    public function getTicketById($ticketid){
        //$result = $this->cache->memcached->get('ticket_'.$ticketid);
        if (!$result){
            $result = file_get_contents('http://test.tavicosoft.com/crm/index.php/ticket/search?search=&ticketid='.$ticketid.'');
            $this->cache->memcached->save('ticket_'.$ticketid,$result, 86400);
        }
        return $result;
    }

    public function updateUser($custid,$dataUpdate){
        $this->cache->memcached->delete('user_'.$custid);
    }

}