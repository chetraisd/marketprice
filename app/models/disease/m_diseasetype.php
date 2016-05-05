<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_diseasetype extends CI_Controller{
	function __construct(){
		parent::__construct();
	}
	
	function msave(){
		$get_arr = $this->input->post("Para_arr");
		$data = array("disease_code"=>$get_arr['code'],
					  "disease_name"=>$get_arr['name'], 
					  "note"=>$get_arr['note']);
		/*$count = $this->db->query("SELECT count(*) as amtcount 
								      FROM tbl_disease_type 
								      WHERE disease_code='".$get_arr['code']."'")->row();*/
		
		if($get_arr['h_code'] != ""){
			$this->db->update("tbl_disease_type",$data,array("disease_code"=>$get_arr['h_code']));
		}else if($get_arr['h_code'] == "" and $count->amtcount == 0){
			$this->db->insert("tbl_disease_type",$data);
		}
	}
	function mshow(){
		$result = $this->db->query("SELECT
									tbl_disease_type.id,
									tbl_disease_type.disease_code,
									tbl_disease_type.disease_name,
									tbl_disease_type.note
									FROM
									tbl_disease_type
									ORDER BY id desc")->result();
		
		$tr = "";
		if($result > 0){
			$i =1;
			foreach($result as $row){
				$tr.="<tr>
						<td>".$i."</td>
						<td>".$row->disease_code."
							<input type='hidden' id='h_diseasecode' class='h_diseasecode' value='".$row->disease_code."'>
						</td>
						<td>".$row->disease_name."</td>
						<td>".$row->note."</td>
						<td style='text-align:center'><a href='javascript:void(0)' id='a_delete'><img rel='2510' src='".base_url()."/assets/images/icons/delete.png'></a></td>
					  	<td><a href='javascript:void(0)' id='a_edite'><img rel='2510' width='15' height='15' src='".base_url()."/assets/images/icons/edit.png'></a></td>
					  </tr>";
				$i++;
			}
		}
		return $tr;
	}
	function medite(){
		$disease_code = $this->input->post("Para_code");
		//$result = $this->db->select("tbl_disease_type",array("disease_code"=>$disease_code))->row();
		$result = $this->db->query("SELECT
									tbl_disease_type.id,
									tbl_disease_type.disease_code,
									tbl_disease_type.disease_name,
									tbl_disease_type.note
									FROM
									tbl_disease_type
									WHERE disease_code ='".$disease_code."'")->row();
		return $result;
									
	}
	function mcheckcode(){
		$ccheckcode   = $this->input->post("Para_checkcode");
		//$hcheckedcode = $this->input->post("Para_hcode");	
		$count = $this->db->query("SELECT count(*) as amtcount
								   FROM tbl_disease_type 
								   WHERE disease_code='".$ccheckcode."'")->row();
		
		return $count->amtcount;
	}
	function mch_befor_delete(){
		$val_ch = $this->input->post("par_code");
		$ch_count = $this->db->query("SELECT count(*) as amtcount
									   FROM tbl_service_type 
									   WHERE disease_code='".$val_ch."'")->row();
		return $ch_count->amtcount;
	}
	function mdelete(){
		$Para_delete = $this->input->post("Para_delete");
		$this->db->delete("tbl_disease_type",array("disease_code"=>$Para_delete));
	}
}