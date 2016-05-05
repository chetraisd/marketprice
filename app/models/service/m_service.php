<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_service extends CI_Controller{
	function __construct(){
		parent::__construct();
	}
	function show_desease(){
		$db_desease = $this->db->query("SELECT
										tbl_disease_type.id,
										tbl_disease_type.disease_code,
										tbl_disease_type.disease_name,
										tbl_disease_type.note
										FROM
										tbl_disease_type")->result();
		$option_desease = "<option value=''></option>";
		if(count($db_desease) > 0){
			foreach($db_desease as $row_desease){
				$option_desease.= "<option value='".$row_desease->disease_code."'>".$row_desease->disease_name."</option>";
			}
		}
		return $option_desease;
	}
	function show_subservice(){
		$db_subservice = $this->db->query("SELECT
										tbl_subservice_type.id,
										tbl_subservice_type.sub_servicecode,
										tbl_subservice_type.sub_name,
										tbl_subservice_type.note
										FROM
										tbl_subservice_type")->result();
		$opt_subservice = "<option value=''></option>";
		if(count($db_subservice) > 0){
			foreach($db_subservice as $row_subserv){
				$opt_subservice.= "<option value='".$row_subserv->sub_servicecode."'>".$row_subserv->sub_name."</option>";
			}
		}
		return $opt_subservice;
	}
	function msave(){
		$get_arr = $this->input->post("arr_obj");
		$data = array("service_code"=>$get_arr['servicecode'],
					  "service_name"=>$get_arr['service_name'], 
					  "disease_code"=>$get_arr['disease_type'],
					  "subservice_code"=>$get_arr['sub_disease_type'],
					  "note"=>$get_arr['note'],
					  "price"=>$get_arr['price']);
		
		if($get_arr['h_serviceCode'] != ""){
			$this->db->update("tbl_service_type",$data,array("service_code"=>$get_arr['h_serviceCode']));
		}else{
			$this->db->insert("tbl_service_type",$data);
		}
		return "OK";
	}
	
	function mshow(){
		$h_serviceCode  = $this->input->post("h_serviceCode");
		$s_service_type = $this->input->post("s_service_type");
		
		$where = "";
		if($h_serviceCode != ""){
			$where.= " AND sv.service_code = '".$h_serviceCode."'";
		}
		if($s_service_type != ""){
			$where.= " AND sv.disease_code = '".$s_service_type."'";
		}
		
		// ==================== old ===================
		$result = $this->db->query("SELECT
										sv.id,
										sv.service_code,
										sv.service_name,
										sv.disease_code,
										dt.disease_name,
										sv.note,
										sv.price,
										sub.sub_name
										FROM
										tbl_service_type AS sv
										INNER JOIN tbl_disease_type AS dt ON sv.disease_code = dt.disease_code
										INNER JOIN tbl_subservice_type AS sub ON sv.subservice_code = sub.sub_servicecode
									WHERE 1=1 {$where}
									ORDER BY id desc")->result();
		$tr = "";
		if($result > 0){
			$i =1;
			foreach($result as $row){
				$tr.="<tr>
						<td>".$i."</td>
						<td>".$row->service_code."
							<input type='hidden' id='h_diseasecode' class='h_diseasecode' value='".$row->service_code."'>
						</td>
						<td>".$row->service_name."</td>
						<td>".$row->disease_name."</td>
						<td>".$row->sub_name."</td>
						<td>".$row->note."</td>
						<td style='text-align:center;'>".$row->price."</td>
						<td style='text-align:center' class='remove_tag'><a href='javascript:void(0)' id='a_delete'><img rel='2510' src='".base_url()."/assets/images/icons/delete.png'></a></td>
					  	<td><a href='javascript:void(0)' id='a_edite'><img rel='2510' width='15' height='15' src='".base_url()."/assets/images/icons/edit.png'></a></td>
					  </tr>";
				$i++;
			}
		}
		if($tr == ""){
			$tr.= "<tr><td colspan='8' style='text-align:center;'><b>No have data</b></td></tr>";
		}
		return $tr;
	}
	// ===================== end old =====================
	function medit(){
		$service_code = $this->input->post("servicecode");
			
		$result = $this->db->query("SELECT
									tbl_service_type.id,
									tbl_service_type.service_code,
									tbl_service_type.service_name,
									tbl_service_type.disease_code,
									tbl_service_type.subservice_code,
									tbl_service_type.note,
									tbl_service_type.price
									FROM
									tbl_service_type
									WHERE service_code ='".$service_code."'")->row();
		$count_del = $this->db->query("SELECT COUNT(*) AS amt_count FROM tbl_invoice_detail WHERE service_code='".$service_code."'")->row();
		$arr_edit["arr_count"] = $count_del;
		$arr_edit["arr_sql"] = $result;
		return $arr_edit;
									
	}
	function mcheckcode(){
		$ccheckcode   = $this->input->post("para_check");
		$count = $this->db->query("SELECT count(*) as amtcount
								   FROM tbl_service_type 
								   WHERE service_code='".$ccheckcode."'")->row();
		
		return $count->amtcount;
	}
	
	function mdelete(){
		$Para_delete = $this->input->post("para_delete");
		$label_alert = "";
		$count_del = $this->db->query("SELECT COUNT(*) AS amt_count FROM tbl_invoice_detail WHERE service_code='".$Para_delete."'")->row();
		if($count_del->amt_count > 0){
			$label_alert = 100;
		}else{
			$this->db->delete("tbl_service_type",array("service_code"=>$Para_delete));
			$label_alert = 200;
		}
		return $label_alert;
	}
	function mautoService($key){
		$this->db->like('service_name',$key);
		return $this->db->get('tbl_service_type')->result();
	}
}