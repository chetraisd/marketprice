<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_report_receipt extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("report/m_report_receipt","m");
        $this->lang->load('general', $this->session->userdata('lang'));
        $this->lang->load('report_receipt', $this->session->userdata('lang'));
	}
	
	function index(){
		$this->load->view('header');
		$this->load->view('report/vreport_receipt');
		$this->load->view('footer');
	}	

	function get_gate() {
		header("Content-type: application/json; charset=utf-8");
		echo $this->m->get_gate();
	}

	function grid() {
		echo $this->m->grid();
	}	
	
}