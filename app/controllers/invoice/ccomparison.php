<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ccomparison extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('invoice/mcomparison','m');
        $this->lang->load('general', $this->session->userdata('lang'));
		$this->lang->load('comparisons', $this->session->userdata('lang')); 
	}

	function index(){
		$this->load->view('header');
		$this->load->view('invoice/index');
		$this->load->view('footer');
	}

	function get_park(){
		header("Content-type: application/json; charset=utf-8");
		echo $this->m->get_park();
	}

	function get_gate(){
		header("Content-type: application/json; charset=utf-8");
		echo $this->m->get_gate();
	}

	function get_turnstile(){
		header("Content-type: application/json; charset=utf-8");
		echo $this->m->get_turnstile();
	}

	function edit(){
		header("Content-type: application/json; charset=utf-8");
		echo $this->m->edit();
	}

	function delete(){
		header("Content-type: application/json; charset=utf-8");
		echo $this->m->delete();
	}

	function save(){				
		header("Content-type: application/json; charset=utf-8");
		echo $this->m->save();
	}

	function grid(){
		header("Content-type: application/json; charset=utf-8");
		echo $this->m->grid();
	}

}