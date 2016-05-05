<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_report_detail extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("report/m_report_detail","m");
        $this->lang->load('general', $this->session->userdata('lang'));
		$this->lang->load('report_detail',$this->session->userdata('lang'));
	}
	function index(){
		//$data['opt_serviceType'] = "<option>OKOK</option>";
		$this->load->view('header');
		$this->load->view('report/vreport_detail');
		$this->load->view('footer');
	}
	function cshowData(){
		header("Content-Type:application/json");
		$tbl_tr = $this->m->mshow();
		if($tbl_tr == ""){
			$tbl_tr = "<tr><td colspan='8' align='center'><b>".$this->lang->line("no_data")."</b></td></tr>";
		}
		$arr["tbl"] = $tbl_tr;
		echo json_encode($arr);
		die();
	}
	function cdelete_inv(){
		$this->m->mdelete_inv();
		echo "complete";
		die();
	}
	function cservice(){
		header("Content-Type:application/json");
		$arr_ser['opt_service'] = $this->m->mservice();
		echo json_encode($arr_ser);
		die();
	}
	function cautoCust(){
		header("Content-Type:application/json");
		$key=$_GET['term'];
		$array=array();
		foreach ($this->m->mautoCust($key) as $row) {
			$array[]=array('value'=>$row->customername,
				  		   'id'=>$row->customercode,
				  		   'cust_code'=>$row->customercode);
		}
		echo json_encode($array);
		die();
	}
}