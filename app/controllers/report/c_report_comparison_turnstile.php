<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_report_comparison_turnstile extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("report/m_report_comparison_turnstile","m");
        $this->lang->load('general', $this->session->userdata('lang'));
        $this->lang->load('report_comparison_turnstile', $this->session->userdata('lang'));
	}
	
	function index(){
		$this->load->view('header');
		$this->load->view('report/vreport_comparison_turnstile');
		$this->load->view('footer');
	}

	function get_park() {
		header("Content-type: application/json; charset=utf-8");
		echo $this->m->get_park();
	}

	function get_gate() {
		// header("Content-type: application/json; charset=utf-8");
		echo $this->m->get_gate();
	}

	function get_turnstile() {
		header("Content-type: application/json; charset=utf-8");
		echo $this->m->get_turnstile();
	}

	function grid() {
		echo $this->m->grid();
	}	
	
}