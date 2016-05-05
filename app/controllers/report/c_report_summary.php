<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_report_summary extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("report/m_report_summary","m");
        $this->lang->load('general', $this->session->userdata('lang'));
		$this->lang->load('report_summary', $this->session->userdata('lang'));
	}
	function index(){
		$this->load->view('header');
		$this->load->view('report/vreport_summary');
		$this->load->view('footer');
	}
	function showTbl(){
		$tbl = $this->m->mshow();
		header("Content-Type:application/json");
		echo json_encode($tbl);
		die();
	}
	function cautoCust(){
		header("Content-Type:application/json");
		$key=$_GET['term'];
		$array=array();
		foreach ($this->m->mautoCust($key) as $row) {
			$array[]=array('value'=>$row->customername,
				  		   'id'=>$row->customercode,
				  		   'cust_code'=>$row->customercode);
		}
		echo json_encode($array);
		die();
	}

	function delete_report(){ 
		$typeno = $this->input->post('attr_typeno');
		$this->m->delete_report($typeno);
	}
	
}