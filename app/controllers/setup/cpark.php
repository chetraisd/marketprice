<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Cpark extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('setup/mpark', 'm');
		$this->lang->load('general', $this->session->userdata('lang'));
		$this->lang->load('parks', $this->session->userdata('lang'));
	}

	function index() {		
		$this->load->view('header');
		$this->load->view('setup/park/index');		
		$this->load->view('footer');
	}

	function form() {
		$this->load->view('header');
		$this->load->view('setup/park/form');
		$this->load->view('footer');
	}

	function edit() {
		header("Content-type: application/json; charset=utf-8");
		echo $this->m->edit();
	}
	
	function delete() {
		// $p_code = $this->input->post('p_code');
		header("Content-type: application/json; charset=utf-8");
		echo $this->m->delete();
	}

	function save() {
		header("Content-type: application/json; charset=utf-8");
		echo $this->m->save();
	}

	function park_upload() {
		echo $this->m->park_upload();
	}

	function get_location() {
		header("Content-type: application/json; charset=utf-8");
		echo $this->m->get_location();
	}	

	function grid() {
		header("Content-type: application/json; charset=utf-8");
		echo $this->m->grid();
	}

}
