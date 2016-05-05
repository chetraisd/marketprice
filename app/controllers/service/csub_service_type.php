<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Csub_service_type extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("service/m_subservice_type","m");
        $this->lang->load('general', $this->session->userdata('lang'));
        $this->lang->load('servicegroup', $this->session->userdata('lang'));
	}
	function index(){
		//$data['option_des'] = $this->m->show_desease();
		$this->load->view('header');
		$this->load->view('service/vsubservice_type');
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
		$condition_del = $this->input->post("pa_del");
		if($condition_del == 1){
			$arr['amt'] = $this->m->mcheckcode();
		}else{
			$arr['amt'] = $this->m->ch_delete();
		}
		echo json_encode($arr);
		die();
	}
	function cdelete(){
		header("Content-Type:application/json");
		$this->m->mdelete();
		echo "OK";
		die();
	}
	function ch_befor_delet(){
		//$ch_in_servicelist = $this->db->query("");	
	}
	// function cautoService(){
	// 	header("Content-Type:application/json");
	// 	$key  = $_GET['term'];
	// 	$array=array();
	// 	foreach ($this->m->mautoService($key) as $row) {
	// 			$array[]=array('value'=>$row->service_name,
	// 						   'id'=>$row->service_code);
			
	// 	}
	// 	echo json_encode($array);
	// 	die();
	// }

}