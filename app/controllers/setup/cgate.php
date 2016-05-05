<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cgate extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('setup/mgate','m');
        $this->lang->load('general', $this->session->userdata('lang'));
		$this->lang->load('gates', $this->session->userdata('lang'));
	}

	function index(){
		$this->load->view('header');
		$this->load->view('setup/gate/index');
		$this->load->view('footer');
	}

	function form(){
		$this->load->view('header');
		$this->load->view('setup/gate/form');
		$this->load->view('footer');
	}

	function get_park(){
		header("Content-type: application/json; charset=utf-8");
		echo $this->m->get_park();
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