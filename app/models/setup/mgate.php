<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mgate extends CI_Model {
	
	function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
	}

	// get park ========
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

	// edit =======
	function edit(){
		$gat_typeno = $this->input->post('gat_typeno');
		$row = $this->db->query("SELECT
												g.create_date,
												g.create_by,
												g.modify_by,
												g.modify_date,
												g.par_type,
												g.par_typeno,
												g.gat_type,
												g.gat_typeno,
												g.gat_name,
												g.description,
												p.park_name
											FROM
												set_gate AS g
											LEFT JOIN set_park AS p ON g.par_typeno = p.par_typeno
											WHERE
												g.gat_typeno = '{$gat_typeno}' ")->row();

		$p = $this->db->query("SELECT
										pg.par_gat_typeno,
										pg.par_typeno,
										pg.gat_typeno,
										p.park_name
									FROM
										set_park_gate AS pg
									LEFT JOIN set_park AS p ON pg.par_typeno = p.par_typeno
									WHERE
										pg.gat_typeno = '{$gat_typeno}'
									ORDER BY
										p.park_name ASC ")->result();


		$arr = array('row' => $row, 'p' => $p);
		return json_encode($arr);
	}

	// delete ========
	function delete(){
		$gat_typeno = $this->input->post('gat_typeno');
		$par_gat_typeno = $this->input->post('par_gat_typeno');

		$c = $this->db->query("SELECT
										COUNT(tt.gat_typeno) AS c
									FROM
										tran_ticket AS tt
									WHERE
										tt.gat_typeno = '{$gat_typeno}' ")->row()->c - 0;
		
		$cc = $this->db->query("SELECT
										COUNT(t.gat_typeno) AS cc
									FROM
										set_counter AS t
									WHERE
										t.gat_typeno = '{$gat_typeno}' ")->row()->cc - 0;

		if(($c == 0) && ($cc == 0)){
			$cg = $this->db->query("SELECT
											COUNT(g.gat_typeno) AS cg
										FROM
											set_gate AS g
										LEFT JOIN set_park_gate AS pg ON g.gat_typeno = pg.gat_typeno
										WHERE
										g.gat_typeno = '{$gat_typeno}' ")->row()->cg - 0;
			if($cg == 1){
				$this->db->delete('set_gate', array('gat_typeno' => $gat_typeno));
				$this->db->delete('set_park_gate', array('gat_typeno' => $gat_typeno));			
				$arr['success'] = 'true';
			}else if($cg > 1){
				if($par_gat_typeno != ''){
					$this->db->delete('set_park_gate', array('par_gat_typeno' => $par_gat_typeno));			
					$arr['success'] = 'true';
				}			
			}			

		}else{
			$arr['success'] = 'false';
		}	
		
		return json_encode($arr);
	}

	// save =========
	function save(){
		$gat_typeno = $this->input->post('gat_typeno', TRUE);
		$create_date = date('Y-m-d H:i:s');
		$create_by = $this->session->userdata('userid');
		$modify_date = date('Y-m-d H:i:s');		
		$modify_by = $this->session->userdata('userid');
		$gat_name = trim($this->input->post('gat_name', TRUE));
		$description = trim($this->input->post('description', TRUE));		

		$par_typeno = $this->input->post('par_typeno');		

		$c = $this->db->query("SELECT
											COUNT(*) AS c
										FROM
											set_gate AS g
										WHERE
											g.gat_name = '{$gat_name}' ")->row()->c - 0;
		if($gat_typeno != ''){
			$this->db->delete('set_park_gate', array('gat_typeno' => $gat_typeno)); 

			// multiple park =====
			if(count($par_typeno) > 0){
				foreach($par_typeno as $row_p){
					$par_gat_typeno = $this->green->nextTran(18, 'par_gat_type');
					$data_ins_p = array('par_gat_typeno' => $par_gat_typeno,								
										'par_typeno' => $row_p['par_typeno'],
										'gat_typeno' => $gat_typeno											
										);
					$this->db->insert('set_park_gate', $data_ins_p);
				}
			}

			$data_upd = array('modify_date' => $modify_date,
									'modify_by' => $modify_by,
									// 'par_typeno' => $par_typeno,
									'gat_name' => $gat_name,									
									'description' => $description									
								);
			$gat_name_ = $this->db->query("SELECT
															g.gat_name AS gat_name
														FROM
															set_gate AS g
														WHERE
															g.gat_typeno = '{$gat_typeno}' ")->row()->gat_name;
			if($c == 0){				
				$this->db->update('set_gate', $data_upd, array('gat_typeno' => $gat_typeno));
				$arr['success'] = 'true';
			}else if($gat_name_ == $gat_name){
				$this->db->update('set_gate', $data_upd, array('gat_typeno' => $gat_typeno));
				$arr['success'] = 'true';
			}else{
				$arr['success'] = 'false';
			}
		}else{			
			if($c == 0){
				$gat_typeno = $this->green->nextTran(10, 'gat_type');	

				// multiple park =====
				if(count($par_typeno) > 0){
					foreach($par_typeno as $row_p){
						$par_gat_typeno = $this->green->nextTran(18, 'par_gat_type');
						$data_ins_p = array('par_gat_typeno' => $par_gat_typeno,								
											'par_typeno' => $row_p['par_typeno'],
											'gat_typeno' => $gat_typeno											
											);
						$this->db->insert('set_park_gate', $data_ins_p);
					}
				}	

				// gate ======
				$data_ins = array('create_date' => $create_date,
											'create_by' => $create_by,
											'par_type' => 10,
											// 'par_typeno' => $par_typeno,
											'gat_type' => 7,
											'gat_typeno' => $gat_typeno,											
											'gat_name' => $gat_name,									
											'description' => $description
										);
				$this->db->insert('set_gate', $data_ins);				
				$arr['success'] = 'true';
			}else{
				$arr['success'] = 'false';
			}			
		}
		$arrs = array('arr' => $arr, 'gat_typeno' => $gat_typeno);
		return json_encode($arrs);		
	}

	// show data =====
	function grid(){
		$where = '';
		$search_gat_name = trim(($this->input->post('search_gat_name', TRUE)));
		$search_description = trim(($this->input->post('search_description', TRUE)));
		$search_park_name = trim(($this->input->post('search_park_name', TRUE)));
		
		$fd = $this->input->post('fd');
		$order = $this->input->post('order');
		$offset = $this->input->post('offset') - 0;
		$limit = $this->input->post('limit') - 0;
		
		if($search_gat_name != ''){
			$where .= "AND g.gat_name LIKE '%{$search_gat_name}%' ";			
		}
		if($search_description != ''){
			$where .= "AND g.description LIKE '%{$search_description}%' ";					
		}	
		if($search_park_name != ''){
			$where .= "AND p.park_name LIKE '%{$search_park_name}%' ";					
		}

		$total_records = $this->db->query("SELECT
												COUNT(g.gat_typeno) AS c
											FROM
												set_park_gate AS pg
											RIGHT JOIN set_gate AS g ON g.gat_typeno = pg.gat_typeno
											LEFT JOIN set_park AS p ON pg.par_typeno = p.par_typeno
											WHERE
												1=1 {$where} ")->row()->c - 0;
		$total_pages = ceil($limit > 0 ? $total_records/$limit : $total_records/5) - 0;

		$result = $this->db->query("SELECT
												pg.par_gat_typeno,
												g.gat_typeno,
												g.gat_name,
												g.description,
												p.park_name
											FROM
												set_park_gate AS pg
											RIGHT JOIN set_gate AS g ON g.gat_typeno = pg.gat_typeno
											LEFT JOIN set_park AS p ON pg.par_typeno = p.par_typeno
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