<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_report_application extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("report/m_report_application","m");
        $this->lang->load('general', $this->session->userdata('lang'));
        $this->lang->load('report_application', $this->session->userdata('lang'));
	}
	
	function index(){
		$this->load->view('header');
		$this->load->view('report/vreport_application');
		$this->load->view('footer');
	}

	function get_remark() {
		header("Content-type: application/json; charset=utf-8");
		echo $this->m->get_remark();
	}

	function get_gender() {
		header("Content-type: application/json; charset=utf-8");
		echo $this->m->get_gender();
	}

	function get_visitor_type() {
		header("Content-type: application/json; charset=utf-8");
		echo $this->m->get_visitor_type();
	}

	function get_country() {
		header("Content-type: application/json; charset=utf-8");
		echo $this->m->get_country();
	}

	function grid() {
		echo $this->m->grid();
	}	
	
}