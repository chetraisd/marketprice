<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Ccounter extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('setup/mcounter', 'm');
		$this->lang->load('general', $this->session->userdata('lang'));
		$this->lang->load('counters', $this->session->userdata('lang'));
	}

	function index() {
		$this->load->view('header');
		$this->load->view('setup/counter/index');
		$this->load->view('footer');
	}

	function form() {
		$this->load->view('header');
		$this->load->view('setup/counter/form');
		$this->load->view('footer');
	}

	function get_gate(){
		header("Content-type: application/json; charset=utf-8");
		echo $this->m->get_gate();
	}

	function get_park(){
		header("Content-type: application/json; charset=utf-8");
		echo $this->m->get_park();
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
