<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clocation extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('setup/mlocation','m');
        $this->lang->load('general', $this->session->userdata('lang'));
		$this->lang->load('locations', $this->session->userdata('lang'));
	}

	function index(){
		$this->load->view('header');
		$this->load->view('setup/location/index');
		$this->load->view('footer');
	}

	function form(){
		$this->load->view('header');
		$this->load->view('setup/location/form');
		$this->load->view('footer');
	}

	function edit(){
		header("Content-type: application/json; charset=utf-8");
		echo $this->m->edit();
	}

	function delete(){
		$loc_code = $this->input->post('loc_code');
		header("Content-type: application/json; charset=utf-8");
		echo $this->m->delete($loc_code);
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