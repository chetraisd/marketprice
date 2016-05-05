<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Magency extends CI_Model {
	
	function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
	}

	// edit =======
	function edit(){
		$agency_typeno = $this->input->post('agency_typeno');
		$row = $this->db->query("SELECT
										ag.agency_type,
										ag.agency_typeno,
										ag.agency_code,
										ag.agency_name,
										ag.email,
										ag.tel,
										ag.address,
										ag.is_agency,
										ag.create_by,
										ag.create_date,
										ag.modify_by,
										ag.modify_date,
										ag.note
									FROM
										set_agency_register AS ag
									WHERE
												ag.agency_typeno = '{$agency_typeno}' ")->row();
		return json_encode($row);
	}

	// delete ========
	function delete(){
		$agency_typeno = $this->input->post('agency_typeno');

		$c = $this->db->query("SELECT
									COUNT(agt.agency_typeno) AS c
								FROM
									tran_agency_approval AS agt
								WHERE
									agt.agency_typeno = '{$agency_typeno}' ")->row()->c - 0;
		if($c == 0){
			$this->db->delete('set_agency_register', array('agency_typeno' => $agency_typeno));
			$arr['success'] = 'true';
		}else{
			$arr['success'] = 'false';
		}
		
		return json_encode($arr);
	}

	// save =========
	function save(){
		$agency_typeno = $this->input->post('agency_typeno', TRUE);

		$create_date = date('Y-m-d H:i:s');
		$create_by = $this->session->userdata('userid');
		$modify_date = date('Y-m-d H:i:s');		
		$modify_by = $this->session->userdata('userid');

		$agency_code = trim($this->input->post('agency_code', TRUE));
		$agency_name = trim($this->input->post('agency_name', TRUE));
		$agency_tel = trim($this->input->post('agency_tel', TRUE));
		$agency_email = trim($this->input->post('agency_email', TRUE));
		$address = trim($this->input->post('address', TRUE));
		$note = trim($this->input->post('note', TRUE));		
		$agency_is_group = trim($this->input->post('agency_is_group', TRUE));			

		$c = $this->db->query("SELECT
											COUNT(*) AS c
										FROM
											set_agency_register AS ag
										WHERE
											ag.agency_code = '{$agency_code}' AND ag.agency_typeno <> '{$agency_typeno}'")->row()->c - 0;
		
		if($agency_typeno != ''){
			$data_upd = array('modify_date' => $modify_date,
									'modify_by' => $modify_by,
									'agency_name' => $agency_name,
									'agency_code' => $agency_code,
									'email' => $agency_email,
									'tel' => $agency_tel,
									'address' => $address,
									'note' => $note,
									'is_agency' => $agency_is_group																			
								);
										
			$agency_code_ = $this->green->getValue("SELECT
															ag.agency_code AS agency_code
														FROM
															set_agency_register AS ag
														WHERE
															ag.agency_typeno <> '{$agency_typeno}' AND ag.agency_code = '{$agency_code}' ");
			
			if($c == 0){				
				$this->db->update('set_agency_register', $data_upd, array('agency_typeno' => $agency_typeno));
				$arr['success'] = 'true';
			}else if($agency_code != $agency_code_){
				$this->db->update('set_agency_register', $data_upd, array('agency_typeno' => $agency_typeno));
				$arr['success'] = 'true';
			}else{
				$arr['success'] = 'false';
			}
		}else{			
			if($c == 0){
				$agency_typeno = $this->green->nextTran(21, 'agency_type');
				$data_ins = array('create_date' => $create_date,
									'create_by' => $create_by,
									'agency_type' => 21,
									'agency_typeno' => $agency_typeno,
									'agency_code' => $agency_code,
									'agency_name' => $agency_name,
									'email' => $agency_email,
									'tel' => $agency_tel,
									'address' => $address,
									'note' => $note,
									'is_agency' => $agency_is_group	);																			
										
				$this->db->insert('set_agency_register', $data_ins);				
				$arr['success'] = 'true';
			}else{
				$arr['success'] = 'false';
			}			
		}
		$arrs = array('arr' => $arr, 'agency_typeno' => $agency_typeno);
		return json_encode($arrs);		
	}

	// show data =====
	function grid(){
		$where = '';
		$search_agen_name = trim(($this->input->post('search_agen_name', TRUE)));
		$search_agen_code = trim(($this->input->post('search_agen_code', TRUE)));
		$search_agen_group = trim(($this->input->post('search_agen_group', TRUE)));
		$fd = $this->input->post('fd');
		$order = $this->input->post('order');
		$offset = $this->input->post('offset') - 0;
		$limit = $this->input->post('limit') - 0;
		
		if($search_agen_code != ''){
			$where .= " AND agency_code LIKE '%{$search_agen_code}%' ";			
		}
		if($search_agen_name != ''){
			$where .= "AND agency_name LIKE '%{$search_agen_name}%' ";					
		}
		if($search_agen_group != ''){
			$where .= "AND is_agency LIKE '%{$search_agen_group}%' ";					
		}		

		$total_records = $this->db->query("SELECT
												COUNT(ag.agency_typeno) AS c
											FROM
												set_agency_register AS ag
											WHERE
												1=1 {$where} ")->row()->c - 0;
		$total_pages = ceil($limit > 0 ? $total_records/$limit : $total_records/5) - 0;

		$result = $this->db->query("SELECT
										ag.agency_type,
										ag.agency_typeno,
										ag.agency_code,
										ag.agency_name,
										ag.email,
										ag.tel,
										ag.address,
										ag.is_agency,
										ag.create_by,
										ag.create_date,
										ag.modify_by,
										ag.modify_date,
										ag.note
									FROM
										set_agency_register AS ag
									WHERE
										1=1 {$where}
									ORDER BY {$fd} {$order}
									LIMIT {$offset}, {$limit} ")->result();
		$arr = array('total_records' => $total_records,
						'total_pages' => $total_pages,
						'result' => $result			
					);
		return json_encode($arr);
	}

}