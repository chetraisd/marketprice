<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ccurrency extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("setup/mcurrency","m");
        $this->lang->load('general', $this->session->userdata('lang'));
		$this->lang->load('currency', $this->session->userdata('lang'));
	}

	function index(){
		$data['select_country'] = $this->m->select_country();
		$this->load->view('header'); 
		$this->load->view('setup/currency/vcurrency',$data);
		$this->load->view('footer');
	}

	function show_curr(){
		header('Content-type: application/json');
		$result = $this->m->show();
		echo json_encode($result);
		exit();
	}

	function ch_curr(){ 
		$this->m->ch_curr();
	}

	function save_curr(){ 
		header('Content-type: application/json');
		$re_save = $this->m->save();
		echo json_encode($re_save);	
	}

	function edit_curr(){ 
		header('Content-type: application/json');
		$result_sql = $this->m->edit();
		echo json_encode($result_sql);
		exit();
	}

	function delete_curr(){ 
		$this->m->delete();
	}

	function change_country(){
	 	header('Content-type: application/json');
		$result = $this->m->change_country();
		echo json_encode($result);
		die();
	}

	function ch_curr_payment(){ 
		$this->m->ch_curr_payment();
		die();	
	}

}