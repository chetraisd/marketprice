<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_currency extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("mcustomer/m_currency","m");
        $this->lang->load('general', $this->session->userdata('lang'));
		$this->lang->load('currency', $this->session->userdata('lang'));
	}
	function index(){
		$this->load->view('header');
		$this->load->view('customer/vcurrency');
		$this->load->view('footer');
	}
	function cshowCurrency(){
		header("Content-Type:application/json");
		$show_currency = $this->m->mshowCurrency();
		echo json_encode($show_currency);
		die();
	}
	function csave(){
		header("Content-Type:application/json");
		$edite_currency = $this->m->msave();
		echo "OK";
		die();
	}
	function cedite(){
		header("Content-Type:application/json");
		$edite_currency = $this->m->medite();
		echo json_encode($edite_currency);
		die();
	}
	function cdelete(){
		header("Content-Type:application/json");
		$this->m->cdelete();
		echo "OK";
		die();
	}
	function check_tran(){
		$curr_code = $this->input->post("curr_code");
		$amt_count = $this->db->query("SELECT count(*) amt FROM tbl_customer WHERE curcode='".$curr_code."' GROUP BY curcode")->row()->amt;
		header("Content-Type:application/json");
		$arr_count['amt_curr'] = $amt_count;
		echo json_encode($arr_count);
		//echo $amt_count;
		die();
	}
}