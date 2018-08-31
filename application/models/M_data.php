<?php

class M_data extends CI_Model
{
    var $otherdb;
    public function __construct()
    {
        parent::__construct();
        $this->otherdb = $this->load->database('sqlsvr12', TRUE);
    }
    function record_exists($record,$table)
    {
        $this->db->where($record);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    function key_record_exists($key,$record,$table)
    {
        $this->db->where($key,$record);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    function null_key($match,$key,$table)
    {
        $this->db->select($key);
        $this->db->where($match);
        $this->db->where($key.'!=','');
        $query = $this->db->get($table);
        if ($query->num_rows() > 0){
            return false;
        }
        else{
            return true;
        }
    }

    function load_field_table($table){
        return $this->db->list_fields($table);
    }

    function select_option($select,$match,$table){
        $this->db->select($select)
            ->from($table)
            ->where($match);
        $query = $this->db->get();
        return $query->result_array();
    }

    function select_row_limit($select,$match,$table,$start,$numrow){
        $this->db->select($select)
            ->from($table)
            ->where($match)
            ->limit($numrow,$start);
        $query = $this->db->get();
        return $query->result_array();
    }

    function update($match,$data,$table){
        $result = $this->db->where($match)
            ->update($table,$data);
        return $result;
    }

    function insert($data,$table)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    function get_all_row($table){
        $this->db->select()
            ->from($table);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function get_row($match,$table){
        $this->db->select()
            ->from($table)
            ->where($match);
        $query = $this->db->get();
        return $query->result_array();
    }

    function select_row($where,$orwhere,$table){
        $this->db->select();
        $this->db->from($table);
        $this->db->where($where);
        if(!empty($orwhere))$this->db->or_where($orwhere);
        $query = $this->db->get();
        return $query->result_array();
    }

    function user_login($username, $password, $table)
    {
        $pass = md5($password);
        $sql = "SELECT * FROM $table WHERE (custid = '$username' OR email = '$username' OR telephone = '$username') AND password = '$pass'";
        $query = $this->otherdb->query($sql);
        if (!$query) {
            return $this->otherdb->error();
        }
        return $query->result_array();
    }

    public function uploadfile($file,$name){
        // var_dump($file);
        $config['upload_path'] = '../upload/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $file[$name]['name'];

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload($name)) {
          $uploadData = $this->upload->data();
          var_dump($uploadData);
          return $this->config->item('file_upload_url').$uploadData['file_name'];
          echo "file upload success!! ";
        } else{
          var_dump($this->upload->display_errors());
          return false;
        }
    }
    public function array_to_string($array,$index_key,$index_value){
        $string = '';
        // var_dump($array);
        foreach ($array as $key => $value) {
            $string.=$value[$index_key].':'.$value[$index_value].';';
        }
        return substr($string, 0, strlen($string)-1);
    }

    public function count_row($select,$where,$table,$join,$order_by,$like,$or_like){
        $this->db->select($select);
        $this->db->from($table);
        if(!empty($join)){
            foreach ($join as $key => $value) {
                $this->db->join($value['table'],$value['match']);       
            }
        }
        $this->db->where($where);
        if(!empty($like))$this->db->like($like);
        if(!empty($or_like))$this->db->or_like($or_like);
        $this->db->order_by($order_by['colname'],$order_by['typesort']);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function select_row_option($select,$where,$table,$join,$limit,$order_by,$like,$or_like){
        $this->db->select($select);
        $this->db->from($table);
        if(!empty($join)){
            foreach ($join as $key => $value) {
                $this->db->join($value['table'],$value['match']);       
            }
        }
        $this->db->where($where);
        if(!empty($like))$this->db->like($like);
        if(!empty($or_like))$this->db->or_like($or_like);
        if(!empty($order_by))$this->db->order_by($order_by['colname'],$order_by['typesort']);
        if(!empty($limit))$this->db->limit($limit['numrow'],$limit['start']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function toPermission($array){
        $arr = [];
        if (!empty($array)) {
            for ($i=0; $i < count($array); $i++) { 
                $arr[$array[$i]['to_table']][$array[$i]['id_rights']] = $array[$i]['active'];
            }
        }
        return $arr;
    }

    function trans_insert_baohiem($data1,$data2){
        $this->db->trans_start();

            $id = $this->insert($data2,'customer');
            var_dump($id);
            $data1['id_customer'] = $id;
            $this->insert($data1,'pre_traff');

        if($this->db->trans_status() === FALSE){
           $this->db->trans_rollback();
           return false;
        }else{
           $this->db->trans_complete();
           return true;
        }
    }

    function trans_insert_user($user_acc,$user_info){
        $this->db->trans_start();
            $id = $this->insert($user_info,'user_info');
            $user_acc['user_info'] = $id;
           $this->insert($user_acc,'users');
        if($this->db->trans_status() === FALSE){
           $this->db->trans_rollback();
           return false;
        }else{
           $this->db->trans_complete();
           return true;
        }
    }

    public function send_sms($phone,$text){
        try {
            
            $client = new SoapClient('http://g3g4.vn:8008/smsws/services/SendMT?wsdl');
            $content = array(
                'username' => 'globalsafe1', 
                'password' => 'hKm-26W-ewY-SKW', 
                'receiver' => $phone, 
                'content' => $text, 
                'loaisp' => '2', 
                'brandname' => 'GLOBALSAFE', 
                'target' => '123456', 
            );
            $quote = $client->sendSMS($content);
            return $quote->return;
        
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

