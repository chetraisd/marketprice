<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcounter extends CI_Model {
	
	function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
	}

	// edit =======
	function edit(){
		$cou_typeno = $this->input->post('cou_typeno');
		$row = $this->db->query("SELECT
												c.create_date,
												c.create_by,
												c.modify_by,
												c.modify_date,
												c.gat_type,
												c.gat_typeno,
												c.cou_type,
												c.cou_typeno,
												c.counter_name,
												c.description
											FROM
												set_counter AS c
											WHERE
												cou_typeno = {$cou_typeno} ")->row();
		return json_encode($row);
	}

	// delete ========
	function delete(){
		$cou_typeno = $this->input->post('cou_typeno', TRUE);
		$c = $this->db->query("SELECT
										COUNT(tt.cou_typeno) AS c
									FROM
										tran_ticket AS tt
									WHERE		
										tt.cou_typeno = '{$cou_typeno}' ")->row()->c - 0;
		if($c == 0){
			$this->db->delete('set_counter', array('cou_typeno' => $cou_typeno));	
			$arr['success'] = 'true';
		}else{
			$arr['success'] = 'false';
		}										
		
		return json_encode($arr);		
	}

	// save =========
	function save(){		
		$cou_typeno = $this->input->post('cou_typeno', TRUE);
		$create_date = date('Y-m-d H:i:s');
		$create_by = $this->session->userdata('userid');
		$modify_date = date('Y-m-d H:i:s');		
		$modify_by = $this->session->userdata('userid');		
		$gate = $this->input->post('gate', TRUE);
		$counter_name = trim($this->input->post('counter_name', TRUE));
		$description = trim($this->input->post('description', TRUE));

		$c = $this->db->query("SELECT
											COUNT(*) AS c
										FROM
											set_counter AS cc
										WHERE
											cc.counter_name = '{$counter_name}' ")->row()->c - 0;
		
		if($cou_typeno != ''){
			$counter_name_ = $this->db->query("SELECT
															c.counter_name AS counter_name
														FROM
															set_counter AS c
														WHERE
															c.cou_typeno = '{$cou_typeno}' ")->row()->counter_name;
			
			$data_upd = array('modify_date' => $modify_date,
										'modify_by' => $modify_by,
										'gat_typeno' => $gate,								
										'counter_name' => $counter_name,													
										'description' => $description								
								);
			if($c == 0){				
				$this->db->update('set_counter', $data_upd, array('cou_typeno' => $cou_typeno));
				$arr['success'] = 'true';
			}else if($counter_name_ == $counter_name){
				$this->db->update('set_counter', $data_upd, array('cou_typeno' => $cou_typeno));
				$arr['success'] = 'true';
			}else{
				$arr['success'] = 'false';
			}
		}else{
			if($c == 0){
				$cou_typeno = $this->green->nextTran(10, 'cou_type');
				$data_ins = array('create_date' => $create_date,
										'create_by' => $create_by,
										'gat_type' => 7,
										'gat_typeno' => $gate,								
										'cou_type' => 4,
										'cou_typeno' => $cou_typeno,										
										'counter_name' => $counter_name,													
										'description' => $description								
									);
				$this->db->insert('set_counter', $data_ins);	
				$arr['success'] = 'true';
			}else{
				$arr['success'] = 'false';
			}						
		}
		return json_encode($arr);		
	}

	function park_upload(){
		$image_insert = $this->input->post('image_insert', TRUE);
		$image_edit = $this->input->post('image_edit', TRUE);

		if($image_insert != ''){
			if($_FILES['photo']['size'] > 0){
				$path = "assets/upload/";
				if(file_exists($path.$this->input->post('image_edit'))){
					unlink($path.$this->input->post('image_edit'));													
				}
				$name = $_FILES['photo']['name'];
				$ext = pathinfo($name, PATHINFO_EXTENSION);
				$exts = $image_insert.'.'.$ext;
				$this->db->update('set_park', array('image' => $exts), array('par_typeno' => $image_insert));
				$target = $path.$exts;				
				if(file_exists($target)){
					unlink($target);													
				}
				$tmp_name = $_FILES['photo']['tmp_name'];							
				move_uploaded_file($tmp_name, $target);
			}
		}
	}

	// get counters ========
	function get_gate(){		
		$result = $this->db->query("SELECT
													g.gat_typeno,
													g.gat_name
												FROM
													set_gate AS g
												ORDER BY
													g.gat_name ASC ")->result();	
		return json_encode($result);
	}

	// get parks ========
	function get_park(){		
		$result = $this->db->query("SELECT
													p.par_typeno,
													p.park_name
												FROM
													set_park AS p
												ORDER BY
													p.park_name ASC ")->result();	
		return json_encode($result);
	}

	// show ​data =====
	function grid(){
		$where = '';
		$search_counter_name = trim($this->input->post('search_counter_name', TRUE));
		$search_description = trim($this->input->post('search_description', TRUE));
		$search_gat_name = trim($this->input->post('search_gat_name', TRUE));
		
		$offset = $this->input->post('offset') - 0;
		$limit = $this->input->post('limit') - 0;
		$fd = $this->input->post('fd');
		$order = $this->input->post('order');		
		
		if($search_counter_name != ''){
			$where .= "AND counter_name LIKE '%{$search_counter_name}%' ";				
		}
		if($search_description != ''){
			$where .= "AND c.description LIKE '%{$search_description}%' ";				
		}
		if($search_gat_name != ''){
			$where .= "AND g.gat_name LIKE '%{$search_gat_name}%' ";				
		}			
		
		$total_records = $this->db->query("SELECT
															COUNT(c.cou_typeno) AS cc
														FROM
															set_counter AS c
														LEFT JOIN set_gate AS g ON c.gat_typeno = g.gat_typeno
														WHERE
															1 = 1 {$where} ")->row()->cc - 0;
		
		$total_pages = ceil($limit > 0 ? $total_records/$limit : $total_records/5) - 0;

		$result = $this->db->query("SELECT
													c.create_date,
													c.create_by,
													c.modify_by,
													c.modify_date,
													c.gat_type,
													c.gat_typeno,
													c.cou_type,
													c.cou_typeno,
													c.counter_name,
													c.description,
													g.gat_name
												FROM
													set_counter AS c
												LEFT JOIN set_gate AS g ON c.gat_typeno = g.gat_typeno
												WHERE
													1 = 1 {$where}
												ORDER BY {$fd} {$order}
												LIMIT {$offset},
												 {$limit} ")->result();
		$arr = array('total_records' => $total_records,
					'total_pages' => $total_pages,					
					'result' => $result			
				);
		return json_encode($arr);
	}

}