<?php
// error_reporting(0);
// ini_set('display_errors', 0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Issuegroup extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model('M_api');
    }

    public function index(){
        $_data = [];     
        $_data['mainview'] = $this->load->view('datasource/issuegroup/form', NULL , TRUE);
        $this->load->view('dashboard',$_data);
    }
}