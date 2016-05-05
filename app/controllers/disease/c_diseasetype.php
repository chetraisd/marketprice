<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_diseasetype extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("disease/M_diseasetype","m");
        $this->lang->load('general', $this->session->userdata('lang'));
		$this->lang->load('disease', $this->session->userdata('lang'));
	}
	function index(){
		$this->load->view('header');
		$this->load->view('disease/vdiseasetype');
		$this->load->view('footer');
	}
	function csave(){
		header("Content-Type:application/json");
		$this->m->msave();
		//$arr['arr_alert'] = array($show_alert);
		echo json_encode("OK");
		die();
	}
	function cshow(){
		header("Content-Type:application/json");
		$tbl = $this->m->mshow();
		echo $tbl;
		die();
	}
	function cedite(){
		header("Content-Type:application/json");
		$result = $this->m->medite();
		echo json_encode($result);
		die();
	}
	function cdelete(){
		header("Content-Type:application/json");
		$this->m->mdelete();
		echo "OK";
		die();
	}
	function ccheckcode(){
		header("Content-Type:application/json");
		$par_cond = $this->input->post("par_cond");
		if($par_cond == 1){
			$countcode = $this->m->mcheckcode();
		}else{
			$countcode = $this->m->mch_befor_delete();
		}
		echo json_encode($countcode);
		die();
	}
}