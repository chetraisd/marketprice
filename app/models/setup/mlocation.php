<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mlocation extends CI_Model {
	
	function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
	}

	// edit =======
	function edit(){
		$loc_typeno = $this->input->post('loc_typeno');
		$row = $this->db->query("SELECT
												l.create_date,
												l.create_by,
												l.modify_by,
												l.modify_date,
												l.loc_type,
												l.loc_typeno,
												l.loc_name,
												l.address,
												l.description
											FROM
												set_location AS l
											WHERE
												l.loc_typeno = '{$loc_typeno}' ")->row();
		return json_encode($row);
	}

	// delete ========
	function delete(){
		$loc_typeno = $this->input->post('loc_typeno');

		$c = $this->db->query("SELECT
									COUNT(p.loc_typeno) AS c
								FROM
									set_park AS p
								WHERE
									p.loc_typeno = '{$loc_typeno}' ")->row()->c - 0;
		if($c == 0){
			$this->db->delete('set_location', array('loc_typeno' => $loc_typeno));
			$arr['success'] = 'true';
		}else{
			$arr['success'] = 'false';
		}
		
		return json_encode($arr);
	}

	// save =========
	function save(){
		$loc_typeno = $this->input->post('loc_typeno', TRUE);
		$create_date = date('Y-m-d H:i:s');
		$create_by = $this->session->userdata('userid');
		$modify_date = date('Y-m-d H:i:s');		
		$modify_by = $this->session->userdata('userid');		
		$loc_name = trim($this->input->post('loc_name', TRUE));
		$description = trim($this->input->post('description', TRUE));		
		$address = trim($this->input->post('address', TRUE));			

		$c = $this->db->query("SELECT
											COUNT(*) AS c
										FROM
											set_location AS l
										WHERE
											l.loc_name = '{$loc_name}' ")->row()->c - 0;
		if($loc_typeno != ''){
			$data_upd = array('modify_date' => $modify_date,
									'modify_by' => $modify_by,
									'loc_name' => $loc_name,
									'description' => $description,
									'address' => $address																			
								);
			$loc_name_ = $this->db->query("SELECT
															l.loc_name AS loc_name
														FROM
															set_location AS l
														WHERE
															l.loc_typeno = '{$loc_typeno}' ")->row()->loc_name;
			if($c == 0){				
				$this->db->update('set_location', $data_upd, array('loc_typeno' => $loc_typeno));
				$arr['success'] = 'true';
			}else if($loc_name_ == $loc_name){
				$this->db->update('set_location', $data_upd, array('loc_typeno' => $loc_typeno));
				$arr['success'] = 'true';
			}else{
				$arr['success'] = 'false';
			}
		}else{			
			if($c == 0){
				$loc_typeno = $this->green->nextTransLocations(9, 'loc_type');
				$data_ins = array('create_date' => $create_date,
											'create_by' => $create_by,
											'loc_type' => 9,
											'loc_typeno' => $loc_typeno,
											'loc_name' => $loc_name,									
											'description' => $description,
											'address' => $address																			
										);
				$this->db->insert('set_location', $data_ins);				
				$arr['success'] = 'true';
			}else{
				$arr['success'] = 'false';
			}			
		}
		$arrs = array('arr' => $arr, 'loc_typeno' => $loc_typeno);
		return json_encode($arrs);		
	}

	// show data =====
	function grid(){
		$where = '';
		$search_loc_name = trim(($this->input->post('search_loc_name', TRUE)));
		$search_address = trim(($this->input->post('search_address', TRUE)));
		$search_description = trim(($this->input->post('search_description', TRUE)));
		$fd = $this->input->post('fd');
		$order = $this->input->post('order');
		$offset = $this->input->post('offset') - 0;
		$limit = $this->input->post('limit') - 0;
		
		if($search_loc_name != ''){
			$where .= "AND loc_name LIKE '%{$search_loc_name}%' ";			
		}
		if($search_address != ''){
			$where .= "AND address LIKE '%{$search_address}%' ";					
		}
		if($search_description != ''){
			$where .= "AND description LIKE '%{$search_description}%' ";					
		}		

		$total_records = $this->db->query("SELECT
												COUNT(l.loc_typeno) AS c
											FROM
												set_location AS l
											WHERE
												1=1 {$where} ")->row()->c - 0;
		$total_pages = ceil($limit > 0 ? $total_records/$limit : $total_records/5) - 0;

		$result = $this->db->query("SELECT
										l.create_date,
										l.create_by,
										l.modify_by,
										l.modify_date,
										l.loc_type,
										l.loc_typeno,
										l.loc_name,
										l.address,
										l.description										
									FROM
										set_location AS l
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