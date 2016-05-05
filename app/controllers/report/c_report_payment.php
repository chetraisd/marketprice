<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_report_payment extends CI_Controller {
	function __construct(){
		parent::__construct();
		//$this->load->model("report/m_report_detail","m");
        $this->lang->load('general', $this->session->userdata('lang'));
	}
	function index(){
		$app_typeno = $this->input->get('app_typeno');
		$ticket_no = $this->input->get('ticket_no');
		$data['app_typeno'] = $app_typeno;
		$data['ticket_no'] = $ticket_no;
		$this->load->view('report/ticket/v_report_ticket',$data);
		
		
	}
	function print_receipt(){
		$app_typeno = $this->input->get('app_typeno');
		$ticket_no = $this->input->get('ticket_no');
		$data['app_typeno'] = $app_typeno;
		$data['ticket_no'] = $ticket_no;
		$this->load->view('report/ticket/vinvoice_receipt',$data);
	}	
	
}