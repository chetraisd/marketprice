<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Cpackage extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('setup/mpackage', 'm');
		$this->lang->load('general', $this->session->userdata('lang'));
		$this->lang->load('package', $this->session->userdata('lang'));
	}

	function index() {
		$data['park_select'] = $this->m->get_park();		
		$this->load->view('header');
		$this->load->view('setup/package/index',$data);		
		$this->load->view('footer');
	}

	function form() {
		$this->load->view('header');
		$this->load->view('setup/package/form');
		$this->load->view('footer');
	}

	function edit() {
		header("Content-type: application/json; charset=utf-8");
		echo $this->m->edit();
	}
	
	function delete() {
		header("Content-type: application/json; charset=utf-8");
		echo $this->m->delete();
	}

	function delete_pckd() {
		header("Content-type: application/json; charset=utf-8");
		echo $this->m->delete_pckd();
	}

	function save() {
		header("Content-type: application/json; charset=utf-8");
		echo $this->m->save();
	}

	function package_upload() {
		echo $this->m->package_upload();
	}

	function get_park() {
		header("Content-type: application/json; charset=utf-8");
		echo json_encode($this->m->get_park());
	}	

	function grid() {
		header("Content-type: application/json; charset=utf-8");
		echo $this->m->grid();
	}

}
