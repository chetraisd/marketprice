<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcomparison extends CI_Model {
	
	function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
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

	// get gates ========
	function get_gate(){		
		// $par_typeno = $this->input->post('par_typeno', TRUE);
		$result = $this->db->query("SELECT
													g.gat_typeno,
													g.gat_name
												FROM
													set_gate AS g
												ORDER BY
													g.gat_name ASC ")->result();	
		return json_encode($result);
	}

	// get coun ========
	function get_turnstile(){		
		// $gat_typeno = $this->input->post('gat_typeno', TRUE);
		$result = $this->db->query("SELECT DISTINCT
											c.cou_typeno,
											c.counter_name
										FROM
											set_counter AS c
										ORDER BY
											c.counter_name ASC ")->result();	
		return json_encode($result);
	}

	// edit =======
	function edit(){
		$com_typeno = $this->input->post('com_typeno', TRUE);
		$row = $this->db->query("SELECT
										cm.com_type,
										cm.com_typeno,
										cm.create_date,
										cm.create_by,
										cm.qty,
										cm.ticket_typeno,
										cm.par_typeno,
										cm.gat_typeno,
										cm.cou_typeno,
										DATE_FORMAT(cm.count_date, '%Y-%m-%d') AS count_date,
										cm.`status`,
										cm.note,
										cm.park_name,
										cm.gat_name,
										c.counter_name
									FROM
										(
											SELECT
												cm.com_type,
												cm.com_typeno,
												cm.create_date,
												cm.create_by,
												cm.qty,
												cm.ticket_typeno,
												cm.par_typeno,
												cm.gat_typeno,
												cm.cou_typeno,
												count_date,
												cm.`status`,
												cm.note,
												cm.park_name,
												g.gat_name
											FROM
												(
													SELECT
														cm.com_type,
														cm.com_typeno,
														cm.create_date,
														cm.create_by,
														cm.qty,
														cm.ticket_typeno,
														cm.par_typeno,
														cm.gat_typeno,
														cm.cou_typeno,
														cm.count_date,
														cm.`status`,
														cm.note,
														p.park_name
													FROM
														tran_comparison AS cm
													LEFT JOIN set_park AS p ON cm.par_typeno = p.par_typeno
												) AS cm
											LEFT JOIN set_gate AS g ON cm.gat_typeno = g.gat_typeno
										) AS cm
									LEFT JOIN set_counter AS c ON cm.cou_typeno = c.cou_typeno
									WHERE
										cm.com_typeno = '{$com_typeno}' ")->row();
		return json_encode($row);
	}

	// delete ========
	function delete(){
		$com_typeno = $this->input->post('com_typeno', TRUE);
		$this->db->delete('tran_comparison', array('com_typeno' => $com_typeno));
		$arr['success'] = 'true';
		return json_encode($arr);
	}

	// save =========
	function save(){
		$com_typeno = $this->input->post('com_typeno', TRUE);
		$create_date = date('Y-m-d H:i:s');
		$create_by = $this->session->userdata('userid');
		$modify_date = date('Y-m-d H:i:s');		
		$modify_by = $this->session->userdata('userid');	
		$park_name = trim($this->input->post('park_name', TRUE));	
		$gat_name = trim($this->input->post('gat_name', TRUE));
		$counter_name = trim($this->input->post('counter_name', TRUE));
		$count_date = trim($this->input->post('count_date', TRUE));
		$qty = trim($this->input->post('qty', TRUE));
		$status = trim($this->input->post('status', TRUE));
		$note = trim($this->input->post('note', TRUE));				

		$c = $this->db->query("SELECT
											COUNT(*) AS c
										FROM
											tran_comparison AS cm
										WHERE
											cm.gat_typeno = '{$gat_name}'
										AND cm.count_date = '{$count_date}' ")->row()->c - 0;
		if($com_typeno != ''){
			$data_upd = array('modify_date' => $modify_by,
									'modify_by' => $modify_by,
									'qty' => $qty,
									'par_typeno' => $park_name,											
									'gat_typeno' => $gat_name,
									'cou_typeno' => $counter_name,
									'count_date' => $count_date,
									'status' => $status,
									'note' => $note
								);
			$gat_name_ = $this->db->query("SELECT
															cm.gat_typeno AS gat_name
														FROM
															tran_comparison AS cm
														WHERE
															cm.com_typeno = '{$com_typeno}' ")->row()->gat_name;
			$count_date_ = $this->db->query("SELECT
															cm.count_date AS count_date
														FROM
															tran_comparison AS cm
														WHERE
															cm.com_typeno = '{$com_typeno}' ")->row()->count_date;
			
			if($c == 0){				
				$this->db->update('tran_comparison', $data_upd, array('com_typeno' => $com_typeno));
				$arr['success'] = 'true';
			}else if($gat_name_ == $gat_name && $count_date_ == $count_date){
				$this->db->update('tran_comparison', $data_upd, array('com_typeno' => $com_typeno));
				$arr['success'] = 'true';
			}else{
				$arr['success'] = 'false';
			}
		}else{			
			if($c == 0){
				$com_typeno = $this->green->nextTran(15, 'com_type');
				$data_ins = array('com_type' => 15,
											'com_typeno' => $com_typeno,
											'create_date' => $create_date,
											'create_by' => $create_by,
											'qty' => $qty,
											'par_typeno' => $park_name,											
											'gat_typeno' => $gat_name,
											'cou_typeno' => $counter_name,									
											'count_date' => $count_date,
											'status' => $status,
											'note' => $note
										);
				$this->db->insert('tran_comparison', $data_ins);				
				$arr['success'] = 'true';
			}else{
				$arr['success'] = 'false';
			}			
		}
		return json_encode($arr);		
	}

	// show data =====
	function grid(){
		$where = '';
		$search_park_name = trim(($this->input->post('search_park_name', TRUE)));
		$search_gat_name = trim(($this->input->post('search_gat_name', TRUE)));
		$search_counter_name = trim(($this->input->post('search_counter_name', TRUE)));
		$search_count_date = trim(($this->input->post('search_count_date', TRUE)));
		$search_status = trim(($this->input->post('search_status', TRUE)));
		
		$fd = $this->input->post('fd');
		$order = $this->input->post('order');
		$offset = $this->input->post('offset') - 0;
		$limit = $this->input->post('limit') - 0;
		
		if($search_park_name != ''){
			$where .= "AND park_name LIKE '%{$search_park_name}%' ";			
		}
		if($search_gat_name != ''){
			$where .= "AND cm.gat_name LIKE '%{$search_gat_name}%' ";					
		}
		if($search_counter_name != ''){
			$where .= "AND c.counter_name LIKE '%{$search_counter_name}%' ";					
		}	
		if($search_count_date != ''){
			$where .= "AND cm.count_date = '{$search_count_date}' ";					
		}
		if($search_status != ''){
			$where .= "AND cm.status = '{$search_status}' ";					
		}		

		$total_records = $this->db->query("SELECT
												COUNT(cm.com_typeno) AS c
											FROM
												(
													SELECT
														cm.com_type,
														cm.com_typeno,
														cm.qty,
														cm.ticket_typeno,
														cm.par_typeno,
														cm.gat_typeno,
														cm.cou_typeno,
														count_date,
														cm.`status`,
														cm.note,
														cm.park_name,
														g.gat_name
													FROM
														(
															SELECT
																cm.com_type,
																cm.com_typeno,
																cm.qty,
																cm.ticket_typeno,
																cm.par_typeno,
																cm.gat_typeno,
																cm.cou_typeno,
																cm.count_date,
																cm.`status`,
																cm.note,
																p.park_name
															FROM
																tran_comparison AS cm
															LEFT JOIN set_park AS p ON cm.par_typeno = p.par_typeno
														) AS cm
													LEFT JOIN set_gate AS g ON cm.gat_typeno = g.gat_typeno
												) AS cm
											LEFT JOIN set_counter AS c ON cm.cou_typeno = c.cou_typeno
											WHERE
												1 = 1 {$where} ")->row()->c - 0;
		
		$total_pages = ceil($limit > 0 ? $total_records/$limit : $total_records/5) - 0;

		$result = $this->db->query("SELECT
											cm.com_type,
											cm.com_typeno,
											cm.create_date,
											cm.create_by,
											cm.qty,
											cm.ticket_typeno,
											cm.par_typeno,
											cm.gat_typeno,
											cm.cou_typeno,
											DATE_FORMAT(cm.count_date, '%Y-%m-%d') AS count_date,
											cm.`status`,
											cm.note,
											cm.park_name,
											cm.gat_name,
											c.counter_name
										FROM
											(
												SELECT
													cm.com_type,
													cm.com_typeno,
													cm.create_date,
													cm.create_by,
													cm.qty,
													cm.ticket_typeno,
													cm.par_typeno,
													cm.gat_typeno,
													cm.cou_typeno,
													count_date,
													cm.`status`,
													cm.note,
													cm.park_name,
													g.gat_name
												FROM
													(
														SELECT
															cm.com_type,
															cm.com_typeno,
															cm.create_date,
															cm.create_by,
															cm.qty,
															cm.ticket_typeno,
															cm.par_typeno,
															cm.gat_typeno,
															cm.cou_typeno,
															cm.count_date,
															cm.`status`,
															cm.note,
															p.park_name
														FROM
															tran_comparison AS cm
														LEFT JOIN set_park AS p ON cm.par_typeno = p.par_typeno
													) AS cm
												LEFT JOIN set_gate AS g ON cm.gat_typeno = g.gat_typeno
											) AS cm
										LEFT JOIN set_counter AS c ON cm.cou_typeno = c.cou_typeno
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