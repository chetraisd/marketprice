<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_invoice extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("invoice/m_invoice","m");

        $this->lang->load('general', $this->session->userdata('lang'));
		$this->lang->load('invoice', $this->session->userdata('lang'));
		$this->lang->load('customer', $this->session->userdata('lang'));
		$this->lang->load('service', $this->session->userdata('lang'));

	}
	function index(){
		$data['option_dis']=$this->m->get_OptionService();
		$this->load->view('header');
		$this->load->view('invoice/vinvoice',$data);
		$this->load->view('footer');
	}
	function cdiseasetype(){
		header("Content-Type:application/json");
		$getOption = $this->m->mdiseasetype();
		echo $getOption;
		die();
	}
	function csave(){
		header("Content-Type:application/json");
		$Para_save = $this->m->msave();
		echo json_encode($Para_save);
		die();
	}
	
	function cedite(){
		header("Content-Type:application/json");
		$Para_edite = $this->m->medite();
		echo json_encode($Para_edite);
		die();
	}
	function autoCust(){
		$key  = $_GET['term'];
		$array=array();
		foreach ($this->m->getCustomer($key) as $row) {
			$show_date = "";
			if($row->dob !='0000-00-00'){
				$date_cust = strtotime($row->dob);
				$show_date = " | ".date("d-m-Y",$date_cust);
			}
			//$array[] = strtotime($date_sh);
			
			$array[]= array('value'=>($row->customername." | ".$row->years.$show_date),
				  			'id'=>$row->customercode,
				  			'gender'=>$row->gender,
				  			'years'=>$row->years,
				  			'currcode'=>$row->curcode);
		}
		echo json_encode($array);
		die();
	}
	// function autoService(){
	// 	$key=$_GET['term'];
	// 	$array=array();
	// 	foreach ($this->m->get_servicetype($key) as $row) {
	// 		$array[]=array('value'=>$row->service_name,
	// 			  			'id'=>$row->service_code);
	// 	}
	// 	echo json_encode($array);
	// }
}