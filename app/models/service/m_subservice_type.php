<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_subservice_type extends CI_Controller{
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
	function msave(){
		$get_arr = $this->input->post("arr_obj");
		$data = array("sub_servicecode"=>$get_arr['sub_service_code'],
					  "sub_name"=>$get_arr['sub_service_name'],
					  "note"=>$get_arr['note']);
		
		//$this->db->insert("tbl_subservice_type",$data);
		if($get_arr['h_sub_code'] != ""){
			$this->db->update("tbl_subservice_type",$data,array("sub_servicecode"=>$get_arr['h_sub_code']));
		}else{
			$this->db->insert("tbl_subservice_type",$data);
		}
		return "OK";
	}
	
	function mshow(){
		$result = $this->db->query("SELECT
									tbl_subservice_type.id,
									tbl_subservice_type.sub_servicecode,
									tbl_subservice_type.sub_name,
									tbl_subservice_type.note
									FROM
									tbl_subservice_type
									ORDER BY id desc")->result();
		
		$tr = "";
		if($result > 0){
			$i =1;
			foreach($result as $row){
				$tr.="<tr>
						<td>".$i."</td>
						<td>".$row->sub_servicecode."
							<input type='hidden' id='h_subservice_code' class='h_subservice_code' value='".$row->sub_servicecode."'>
						</td>
						<td>".$row->sub_name."</td>
						<td>".$row->note."</td>
						<td style='text-align:center' class='remove_tag'><a href='javascript:void(0)' id='a_delete'><img rel='2510' src='".base_url()."/assets/images/icons/delete.png'></a></td>
					  	<td><a href='javascript:void(0)' id='a_edite'><img rel='2510' width='15' height='15' src='".base_url()."/assets/images/icons/edit.png'></a></td>
					  </tr>";
				$i++;
			}
		}
		if($tr == ""){
			$tr.= "<tr><td colspan='5' style='text-align:center;'><b>No have data</b></td></tr>";
		}
		return $tr;
	}
	
	function medit(){
		$service_code = $this->input->post("servicecode");
		$result = $this->db->query("SELECT
									tbl_subservice_type.id,
									tbl_subservice_type.sub_servicecode,
									tbl_subservice_type.sub_name,
									tbl_subservice_type.note
									FROM
									tbl_subservice_type
									WHERE sub_servicecode ='".$service_code."'")->row();
		return $result;
									
	}
	function mcheckcode(){
		$ccheckcode   = $this->input->post("para_check");
		$count = $this->db->query("SELECT COUNT(*) as amtcount FROM tbl_subservice_type 
								   WHERE sub_servicecode='".$ccheckcode."'")->row();
		return $count->amtcount;
	}
	function mdelete(){
		$para_delete   = $this->input->post("para_delete");
		$this->db->delete("tbl_subservice_type",array("sub_servicecode"=>$para_delete));
	}
	function ch_delete(){
		$pa_code   = $this->input->post("pa_code");
		$count = $this->db->query("SELECT COUNT(*) as amtcount FROM tbl_service_type 
								   WHERE subservice_code='".$pa_code."'")->row();
		return $count->amtcount;
	}
	// function mautoService($key){
	// 	$this->db->like('service_name',$key);
	// 	return $this->db->get('tbl_service_type')->result();
	// }
}