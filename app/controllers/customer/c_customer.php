<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_customer extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("mcustomer/m_model","m");
        $this->lang->load('general', $this->session->userdata('lang'));
		$this->lang->load('customer', $this->session->userdata('lang'));
	}
	function index(){
		$this->load->view('header');
		$this->load->view('customer/vcustomer');
		$this->load->view('footer');

	}
	function csave(){
		$json['custcode']=$this->m->msave();
		header("Content-Type:application/json");
		echo json_encode($json);
		die();
	}
	function cshowdata(){
		header("Content-Type:application/json");
		echo json_encode($this->m->mshowdata());
		//echo $this->m->mshowdata();
		die();
	}
	function cedit(){
		header("Content-Type:application/json");
		echo json_encode($this->m->medit());
		die();
	}
	function cdelete(){
		header("Content-Type:application/json");
		echo json_encode($this->m->mdelete());
		die();
	}
	function ccheck(){
		header("Content-Type:application/json");
		echo json_encode($this->m->mcheck());
		die();
	}
	function ccheck_tran(){
		header("Content-Type:application/json");
		echo json_encode($this->m->mcheck_tran());
		die();
	}
	function cautoCustomer(){
		header("Content-Type:application/json");
		$show_para = $_GET["cond_1_2"];
		
		$key = $_GET['term'];
		$array=array();
		foreach ($this->m->getCustomer($key) as $row) {
			if($show_para == 1){
				$array[]=array('value'=>$row->customercode,
					  		   'id'=>$row->customercode);
			}else{
				$array[]=array('value'=>$row->customername,
					  		   'id'=>$row->customercode);
			}
		}
		echo json_encode($array);
		die();
	}
	function ccalculate_y(){
		$dob_age  = $this->input->post("dob_age");
		$date_convert = date('Y-m-d',strtotime($dob_age));
		$year = $this->db->query("SELECT DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS('".$date_convert."')), '%Y')+0 AS age")->row();
		header("Content-Type:application/json");
		$show_age = $year->age;
		/*if($show_age == 0){
			$show_age = 0;	
		}*/
		$arr['age'] = $show_age;
		echo json_encode($arr);
		die();
	}

	/* --- ajax pagination ---- */
	// function searchStdAjax(){
		
	// 	$name  = (isset($_POST['name']))?$_POST['name']:"";
	// 	$WHERE = "";
	// 	if($name!=""){
	// 		$WHERE.=" AND (service_code like '%".$name."%'
	// 					OR service_name like '%".$name."%')";
	// 	}		

	// 	$sql       = "SELECT * FROM tbl_service_type WHERE 1=1 {$WHERE}";
	// 	$total_row = $this->green->getValue("select count(*) as numrow FROM ($sql) as cc ");
	// 	$paging    = $this->green->ajax_pagination($total_row,site_url('customer/c_customer/searchStdAjax'),4);
	// 	$data      = $this->green->getTable("$sql limit {$paging['start']}, {$paging['limit']}");

	// 	$arrJson['paging'] = $paging;
	// 	$tr = "";
	// 	if(count($data)>0){
	// 		foreach ($data as $value) {
	// 			$tr.='<tr>
	// 					<td>'.$value['service_code'].'</td>
	// 					<td>'.$value['service_name'].'</td>
	// 					<td>'.$value['service_name'].'</td>
	// 				</tr>';
	// 		}
	// 	}
	// 	$arrJson['datas']=$tr;
	// 	header("Content-type:text/x-json");
	// 	echo json_encode($arrJson);
	// 	exit();
		
	// }
	// function getAjaxPage(){
	// 	$this->load->view('header');
	// 	$this->load->view('test/ajax_pagination');
	// 	$this->load->view('footer');	
					
	// }header("Content-Type:application/json");

	function coustomer_code_df(){
		header("content-type:application/json");
		$result =  $this->m->customer_code()-0+1;
		$arr = array(); 
		$arr['code'] = $result;
		$arr['cus'] = "CUS";
		echo json_encode($arr);
	}
}