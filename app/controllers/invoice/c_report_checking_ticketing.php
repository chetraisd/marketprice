<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_report_checking_ticketing extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("invoice/m_report_checking_ticketing","m");
        $this->lang->load('general', $this->session->userdata('lang'));
        $this->lang->load('report_checking_ticketing', $this->session->userdata('lang'));
	}
	
	function index(){
		$this->load->view('header');
		$this->load->view('invoice/vreport_checking_ticketing');
		$this->load->view('footer');
	}

	function get_park() {
		header("Content-type: application/json; charset=utf-8");
		echo $this->m->get_park();
	}
	
	function autocomplete() {
		header("Content-type: application/json; charset=utf-8");
		echo $this->m->autocomplete();
	}

	function save_all_chk() {
		header("Content-type: application/json; charset=utf-8");
		echo $this->m->save_all_chk();
	}

	function checkticketno() {
		header("Content-type: application/json; charset=utf-8");
		echo $this->m->checkticketno();
	}

	// function update_to_1_() {
	// 	header("Content-type: application/json; charset=utf-8");
	// 	echo $this->m->update_to_1_();
	// }

	// function update_to_1() {
	// 	header("Content-type: application/json; charset=utf-8");
	// 	echo $this->m->update_to_1();
	// }

	function grid() {
		header("Content-type: application/json; charset=utf-8");
		echo $this->m->grid();
	}
	function check_ticket(){
		header("Content-type: application/json; charset=utf-8");
		echo $this->m->mcheck_ticket();
		die();
	}	
	
}