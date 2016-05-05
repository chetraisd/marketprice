<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_setup_prefix extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("setup/m_setup_prefix","m");
        $this->lang->load('general', $this->session->userdata('lang'));
	}
	function index(){
		$this->load->view('header');
		$this->load->view('setup/prefix/v_setup_prefix');
		$this->load->view('footer');
	}

	function csave(){
		header("Content-Type:application/json");
		echo $this->m->msave();
		die();	
	}

	function cshow(){
		header("Content-Type:application/json");
		echo json_encode($this->m->mshow());
		die();
	}

	function cedit(){
		header("Content-Type:application/json");
		echo json_encode($this->m->medit());
		die();
	}

	function ccheck(){
		header("Content-Type:application/json");
		$arr['amt'] = $this->m->mcheckcode();
		echo json_encode($arr);
		die();
	}

	function cdelete(){
		header("Content-Type:application/json");
		echo json_encode($this->m->mdelete());
		die();
	}
	
	function get_prefix(){
		header("Content-Type:application/json");
		echo json_encode($this->m->m_get_prefix());		
		die();
	}
}