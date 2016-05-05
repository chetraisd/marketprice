<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Ccountry extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('setup/mcountry', 'm');
		$this->lang->load('general', $this->session->userdata('lang'));
		$this->lang->load('countries', $this->session->userdata('lang')); 
	}

	function index() {		
		$this->load->view('header');
		$this->load->view('setup/country/index');
		$this->load->view('footer');
	}

	function form() {
		$this->load->view('header');
		$this->load->view('setup/country/form');
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

	function save() {
		header("Content-type: application/json; charset=utf-8");
		echo $this->m->save();
	}

	function country_upload() {
		echo $this->m->country_upload();
	}

	function get_location() {
		header("Content-type: application/json; charset=utf-8");
		echo $this->m->get_location();
	}	

	function grid() {
		header("Content-type: application/json; charset=utf-8");
		echo $this->m->grid();
	}

	function check_local(){ 
		$this->m->check_local();
	}

	function check_top(){ 
		$this->m->check_top();
	}

}
