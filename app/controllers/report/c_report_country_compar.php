<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_report_country_compar extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("report/m_report_compar","m");
        $this->lang->load('general', $this->session->userdata('lang'));
		$this->lang->load('report',$this->session->userdata('lang'));
		
	}
	function index(){
		//$data['opt_serviceType'] = "<option>OKOK</option>";
		$this->load->view('header');
		$this->load->view('report/v_report_country_compar');
		$this->load->view('footer');
	}
	function cshowcountry(){
		header("Content-Type:application/json");
		$tbl_tr = $this->m->mshowcountry();
		if($tbl_tr == ""){
			$tbl_tr = "<tr><td colspan='5' align='center'><b>".$this->lang->line("no_data")."</b></td></tr>";
		}
		$arr["tbl"] = $tbl_tr;
		echo json_encode($arr);
		die();
	}
	
	function cnatoinal(){
		header("Content-Type:application/json");
		$arr_ser['opt_national'] = $this->m->mnatoinal();
		echo json_encode($arr_ser);
		die();
	}	
}