<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_model extends CI_Controller {
	function __construct(){
		parent::__construct();
	}
	function msave(){
		$obj_arr = $this->input->post("para_obj");
		$dob     = $obj_arr["dob"];
		$get_dob = explode("/",$dob);
		$show_datedob  = date('Y-m-d',strtotime($get_dob[2].'-'.$get_dob[1].'-'.$get_dob[0]));

		if(count($obj_arr)>0){
			if($obj_arr['h_custcode'] == ""){
				$data = array("customercode"=>$obj_arr['custcode'],
							  "customername"=>$obj_arr['custname'],
							  "gender"=>$obj_arr['gender'],
							  "years"=>$obj_arr['years'],
							  "address"=>$obj_arr['address'],
							  "phone"=>$obj_arr['phone'],
							  "note"=>$obj_arr['note'],
							  "curcode" =>$obj_arr['currency'],
							  "dob" =>$show_datedob
							 );
				$this->db->insert("tbl_customer",$data);
				// echo "Save success...";

			}else{
				$data = array("customercode"=>$obj_arr['custcode'],
							  "customername"=>$obj_arr['custname'],
							  "gender"=>$obj_arr['gender'],
							  "years"=>$obj_arr['years'],
							  "dob" =>$show_datedob,
							  "address"=>$obj_arr['address'],
							  "phone"=>$obj_arr['phone'],
							  "note"=>$obj_arr['note'],
							  "curcode" =>$obj_arr['currency']
							 );
				$this->db->update("tbl_customer",$data,array("customercode"=>$obj_arr['h_custcode']));
				// echo "Update success...";
			}
		}
		return $obj_arr['custcode'];
	}
	function mshowdata(){
		$name  = (isset($_POST['name']))?$_POST['name']:"";
		$cust_code = $this->input->post("cust_code");
		$custname  = $this->input->post("s_custname");
		$WHERE = "";
		if($name != ""){
			$WHERE.=" AND (service_code like '%".$name."%'
					  OR service_name like '%".$name."%')";
		}
		if($cust_code != ""){
			$WHERE.= " AND customercode = '".$cust_code."'";
		}
		if($custname != ""){
			$WHERE.= " AND customername LIKE '".$custname."%'";
		}
		$sql  = "SELECT
					tbl_customer.id,
					tbl_customer.customercode,
					tbl_customer.customername,
					tbl_customer.gender,
					tbl_customer.years,
					tbl_customer.address,
					tbl_customer.phone,
					tbl_customer.note,
					tbl_customer.curcode,
					DATE_FORMAT(tbl_customer.dob,'%d/%m/%Y') as dob
					FROM
					tbl_customer
					WHERE 1=1 {$WHERE}";

		$total_row = $this->green->getValue("select count(*) as numrow FROM ($sql) as cc ");
		$paging    = $this->green->ajax_pagination($total_row,site_url('customer/c_customer/cshowdata'),5);
		//return "$sql limit {$paging['start']}, {$paging['limit']}";
		$data      = $this->green->getTable("$sql limit {$paging['start']}, {$paging['limit']}");
		
		$arrJson['paging'] = $paging;
		$tr = "";
		$ii = 1;
		if(count($data)>0){
			foreach($data as $value){
				$tr.=  "<tr>
							<td>".$ii."<input type='hidden' name='h_code' id='h_code' class='h_code' value='".$value['customercode']."'></td>
							<td>".$value['customername']."</td>
							<td>".$value['gender']."</td>
							<td>".$value['years']."</td>
							<td>".$value['address']."</td>
							<td>".$value['phone']."</td>
							<td>".$value['note']."</td>
							<td class='remove_tag'>
								<a href='javascript:void(0)' id='a_delete'><img rel='2510' src='".base_url()."/assets/images/icons/delete.png'></a>&nbsp;&nbsp;
								<a href='javascript:void(0)' id='a_edit'><img rel='2510' width='15' height='15' src='".base_url()."/assets/images/icons/edit.png'></a>
							</td>
						</tr>";
				$ii++;
			}
		}
		if($tr == ""){
			$tr.= "<tr><td colspan='8' style='text-align:center;'><b>Data not found..</b></td></tr>";
		}
		$arrJson['datas']=$tr;
		return $arrJson;
	}
	function medit(){
		$h_code = $this->input->post("para_edit");
		$result = $this->db->query("SELECT
										tbl_customer.id,
										tbl_customer.customercode,
										tbl_customer.customername,
										tbl_customer.gender,
										tbl_customer.years,
										tbl_customer.address,
										tbl_customer.phone,
										tbl_customer.note,
										tbl_customer.curcode,
										DATE_FORMAT(tbl_customer.dob,'%d/%m/%Y') as dob
										FROM
										tbl_customer
										WHERE customercode='".$h_code."'")->row();
		return $result;
	}
	function mdelete(){
		$h_code = $this->input->post("para_delet");
		$this->db->delete("tbl_customer",array("customercode"=>$h_code));
		return "OK";
	}
	function mcheck(){
		$cust_code = $this->input->post("para_check");
		$count = $this->db->query("SELECT COUNT(*) as amt FROM tbl_customer WHERE customercode='".$cust_code."'")->row();
		return $count;	
	}
	function mcheck_tran(){
		$cust_tran = $this->input->post("para_tran");
		//$this->db->where("customercode",$cust_tran);
		//$this->db->qroup_by("customercode");
		//$count_tran = $this->db->get("tbl_invoice_order")->result();
		//$count_tran = $this->db->select('customercode')->from('tbl_invoice_order')->where("customercode", $cust_tran)->qroup_by("customercode")->result();
		$count_tran = $this->db->query("SELECT COUNT(*) AS amt_tran FROM tbl_invoice_order WHERE customercode='".$cust_tran."'")->row();
		
		return $count_tran->amt_tran;
	}
	function getCustomer($key){
		$this->db->like('customername',$key);
		//if($custid!='' && $custid !=0)
		//$this->db->where('customercode',$custid);
		return $this->db->get('tbl_customer')->result();
	}

	function customer_code(){ 
		$sql_cus_code = $this->db->query("SELECT MAX(id) AS max_id FROM tbl_customer")->row()->max_id;
		return $sql_cus_code;
	}
}