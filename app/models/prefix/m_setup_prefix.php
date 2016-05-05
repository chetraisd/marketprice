<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_setup_prefix extends CI_Controller{
	function __construct(){
		parent::__construct();
	}
	
	function msave(){

		$pre_id = $this->green->nextTran(12, 'pre_type');
		$create_date = date('Y-m-d H:i:s');
		$create_by = $this->session->userdata('userid');
		$get_arr = $this->input->post("arr_obj");
		
		if($get_arr['h_code'] != ""){
			$modify_date = date('Y-m-d H:i:s');		
			$modify_by = $this->session->userdata('userid');
		}else{
			$modify_date = "";		
			$modify_by = "";			
		}///"sample"=>$get_arr['sample'],	
		$transno=$this->green-> nextTransTicketnumber("24","ticketnumber",$get_arr['package_typeno']);
		$data = array("pre_typeno"=>$pre_id, 
					  "sequence"=>$get_arr['sequence'], 
					  "sample"=>$transno,	
					  "simbool"=>$get_arr['symbool'],					  
					  "prefix"=>$get_arr['prefixname'], 
					  "package_typeno"=>$get_arr['package_typeno'],					  
					  "length"=>$get_arr['length'],				  
					  "create_date"=>$create_date, 				  
					  "create_by"=>$create_by,
					  "modify_by"=>$create_by,
					  "modify_date"=>$create_date,
					  "sys_typeid"=>"24",  
					  "years"=>$get_arr['curryear']);

		if($get_arr['h_code'] != ""){
			$this->db->update("z_setup_prefix",$data,array("pre_typeno"=>$get_arr['h_code']));
		}else{
			$this->db->insert("z_setup_prefix",$data);
		}
		return "OK";
	}
	
	function mshow(){
		$result = $this->db->query("SELECT
										z_setup_prefix.pre_type,
										z_setup_prefix.pre_typeno,
										z_setup_prefix.sys_typeid,
										z_setup_prefix.package_typeno,
										z_setup_prefix.prefix,
										z_setup_prefix.length,
										z_setup_prefix.simbool,
										z_setup_prefix.sequence,
										z_setup_prefix.years,
										z_setup_prefix.sample,
										z_setup_prefix.status
									FROM
										z_setup_prefix ")->result();
		
		$tr = "";
		if($result > 0){
			$i =1;
			foreach($result as $row){
				$tr.="<tr>
						<td>".$i."</td>
						<td style='display:none'>".$row->pre_typeno."
							<input type='hidden' id='h_id' class='h_id' value='".$row->pre_typeno."'>
						</td>
						<td>".$row->prefix."</td>
						<td>".$row->simbool."</td>
						<td>".$row->length."</td>
						<td>".$row->sequence."</td>
						<td>".$row->sample."</td>";
				if($this->green->gAction("D")){
					$tr.=	"<td style='text-align:center'><a href='javascript:void(0)' id='a_delete'><img rel='2510' src='".base_url()."/assets/images/icons/delete.png'></a></td>";
				}
				if($this->green->gAction("U")){
					$tr.=	"<td><a href='javascript:void(0)' id='a_edite'><img rel='2510' width='15' height='15' src='".base_url()."/assets/images/icons/edit.png'></a></td>";
				}
				$tr.="</tr>";
				$i++;
			}
		}
		return $tr;
	}
	
	function medit(){
		$id = $this->input->post("h_id");			
		$result = $this->db->query("SELECT										
										z_setup_prefix.pre_type,
										z_setup_prefix.pre_typeno,
										z_setup_prefix.sys_typeid,
										z_setup_prefix.package_typeno,
										z_setup_prefix.prefix,
										z_setup_prefix.length,
										z_setup_prefix.simbool,
										z_setup_prefix.sequence,
										z_setup_prefix.years,
										z_setup_prefix.sample
										FROM
										z_setup_prefix
									WHERE pre_typeno ='".$id."'")->row();
		return $result;
									
	}
	function mcheckcode(){
		$package_typeno   = $this->input->post("para_check");
		$Para_delete = $this->input->post("para_delete");	
		if($package_typeno !=""){
			$para_check_update   = $this->input->post("para_check_update");
			if($para_check_update !=""){
				$where_check = " AND pre_typeno <> '".$para_check_update."'";
			}else{
				$where_check = "";		
			}
			$count = $this->db->query("SELECT count(*) as amtcount
									   FROM z_setup_prefix 
									   WHERE package_typeno='".$package_typeno."' AND status=1 {$where_check}")->row();
			
			
			$checked = $count->amtcount;
		}
		if($Para_delete !=""){
			$sequence = $this->green->getValue("SELECT sequence
									   FROM z_setup_prefix 
									   WHERE pre_typeno='".$Para_delete."'")-0;
			if($sequence>1){
				$checked = 1;
			}else{
				$checked = 0;
			}
		}

		return $checked;
	}

	function mdelete(){
		$Para_delete = $this->input->post("para_delete");	

		$this->db->delete("z_setup_prefix",array("pre_typeno"=>$Para_delete));
	}
	
	function m_get_prefix(){
		$symbool = $this->input->post("symbool");
		$length = $this->input->post("length");
		$sequence = $this->input->post("sequence");
		$curryear = $this->input->post("curryear");
		$prefix = $this->input->post("prefixname");
		$years = date('y', strtotime($curryear));
		$sample = $prefix.$years.$symbool.str_pad($sequence,$length,'0',STR_PAD_LEFT);
		return $sample;
	}
}