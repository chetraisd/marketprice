<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_report_print extends CI_Controller {
	function __construct(){
		parent::__construct();
		//$this->load->model("report/m_report_detail","m");
        $this->lang->load('general', $this->session->userdata('lang'));
	}
	function index(){
		$this->load->view('report/vreport_print');
	}
	
	
}