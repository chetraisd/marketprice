<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
	class Cpayment_type extends CI_Controller {
		function __construct(){ 
			parent:: __construct();
			$this->load->model('setup/mpayment_type','m');
			$this->lang->load('general', $this->session->userdata('lang'));
			$this->lang->load('payment_type', $this->session->userdata('lang'));
		}
		 
		function index(){ 
			$this->load->view('header'); 
			$this->load->view('setup/payment_type/vpayment_type');
			$this->load->view('footer');
		}

		function save_payment_type(){
			$this->m->save();
		}

		function show_payment_type(){ 
			header('Content-type: application/json');
			$result = $this->m->show();
			echo $result;
		}

		function edit_payment_type(){ 
			header('Content-type: application/json');
			echo $this->m->edit();
		}

		function delete_payment_type(){ 
			$this->m->delete();
		}

	}
	
?>