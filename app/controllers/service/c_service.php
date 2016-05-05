<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_service extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("service/m_service","m");
        $this->lang->load('general', $this->session->userdata('lang'));
		$this->lang->load('servicelist', $this->session->userdata('lang'));
	}
	function index(){
		$data['option_des'] = $this->m->show_desease();
		$data['opt_subservice'] = $this->m->show_subservice();
		$this->load->view('header');
		$this->load->view('service/vservice',$data,$data);
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
	// function ccheckdelete(){
	// 	header("Content-Type:application/json");
	// 	$amt_del = $this->m->check_delete();
	// 	$arr_del['amt_del'] = $amt_del;
	// 	echo json_encode($arr_del);
	// 	die();
	// }
	function cdelete(){
		header("Content-Type:application/json");
		$val_label = $this->m->mdelete();
		$arr_label['arr_label'] = $val_label;
		echo json_encode($arr_label);
		die();
	}
	function cautoService(){
		header("Content-Type:application/json");
		$key  = $_GET['term'];
		$array=array();
		foreach ($this->m->mautoService($key) as $row) {
				$array[]=array('value'=>$row->service_name,
							   'id'=>$row->service_code);
			
		}
		echo json_encode($array);
		die();
	}

}