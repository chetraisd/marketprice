<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mticket_type extends CI_Model{
	function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
	}

	function check_duplicat(){ 
		$arr_data = $this->input->post('arr_data');
		$select_park = $arr_data['select_park'];
		$tickettype_name = trim($arr_data['ticket_type_name']);
		$ch_name = "";
		$ch_park = "";
		$i = 0;
		foreach ($select_park as $par_typeno) {
			$check_typeno = $this->green->getValue("SELECT tic_type_typeno FROM set_ticket_type WHERE tickettype_name = '".$tickettype_name."' AND par_typeno = '".$par_typeno."'");
			
			if($check_typeno !=""){ 
				$select_ticket_park = $this->db->query("SELECT
															set_ticket_type.tickettype_name,
															set_ticket_type.par_typeno,
															set_park.park_name
														FROM
															set_ticket_type
														INNER JOIN set_park ON set_ticket_type.par_typeno = set_park.par_typeno
														WHERE tic_type_typeno = '".$check_typeno."'")->result();
				
				$tick_name= "";
				$park_name= "";
				foreach ($select_ticket_park as $value) {
					$tick_name = $value->tickettype_name;
					$park_name .= $value->park_name;
					$i++;
				}
				$ch_name = $tick_name;
				$ch_park .= $park_name." -";						
				
			}
		}

		if($ch_park !=""){
			$arr['confirm'] ='true';
			if(COUNT($select_park) != $i){ 
				$arr['save_new'] ='true';
			}else{ 
				$arr['save_new'] ='false';
			}

		}else{
			$arr['confirm'] ='false';	
		}
		$arr['tick_name'] =$ch_name;
		$arr['park_name'] =$ch_park;
		header('Content-type: application/json');
		echo json_encode($arr);
	}

	function save(){
		$session_user = $this->session->userdata('userid');
		$h_typeno = trim($this->input->post('h_typeno')); 
		$arr_data = $this->input->post('arr_data');
		$tickettype_name = trim($arr_data['ticket_type_name']);
		$h_ticket_type_name = $this->input->post('h_ticket_type_name');
		// $typeno = $this->green->nextTran(1,'ticket_type');
		
		$select_park = $arr_data['select_park']; 
			
			foreach ($select_park as $par_typeno ) {
				
				$data_insert = array(
					'description' => trim($arr_data['description_t']),
					'price'       => trim($arr_data['price_t']),
					'qty_day'     => trim($arr_data['qty_date']),
					'par_typeno'  => $par_typeno,
					'tickettype_name' => trim($arr_data['ticket_type_name']),
					'create_date' => date('Y-m-d H:i:s'),
					'create_by'   => $session_user,
					'tic_type_typeno' => $this->green->nextTran(1,'ticket_type'),
					'tic_type_type'   => 1,
					'par_type'    => 10
				);

				$data_update = array( 
					'tickettype_name' => trim($arr_data['ticket_type_name']),
					'description' => trim($arr_data['description_t']),
					'par_typeno'  => $par_typeno,
					'price'       => trim($arr_data['price_t']),
					'qty_day'     => trim($arr_data['qty_date']),
					'modify_date' => date('Y-m-d H:i:s'),
					'modify_by'   => $session_user
				);

				$check_typeno = $this->green->getValue("SELECT tic_type_typeno FROM set_ticket_type WHERE tickettype_name = '".$tickettype_name."' AND par_typeno = '".$par_typeno."'");

				if($check_typeno !=""){

					$arr['confirm'] ='true';

					$this->db->update('set_ticket_type',$data_update,array('tic_type_typeno' => $check_typeno));					
					$arr['success'] = "true";
					
				}else{
					if(COUNT($select_park) == 1 && $h_typeno !=""){ 
						$this->db->update('set_ticket_type',$data_update,array('tic_type_typeno' => $h_typeno));
					}else{ 
						$this->db->insert('set_ticket_type',$data_insert);	
					}
					
					$arr['success'] = "true";
				}				
			}

		header('Content-type: application/json');
		echo json_encode($arr);
	}

	function save_new(){ 
		$session_user = $this->session->userdata('userid');
		$h_typeno = $this->input->post('h_typeno');
		$arr_data = $this->input->post('arr_data');
		$tickettype_name = $arr_data['ticket_type_name'];
		$h_ticket_type_name = $this->input->post('h_ticket_type_name');

		$select_park = $arr_data['select_park'];

		foreach ($select_park as $par_typeno ) { 

			$data_insert = array(
				'description' => trim($arr_data['description_t']),
				'price'       => trim($arr_data['price_t']),
				'qty_day'     => trim($arr_data['qty_date']),
				'par_typeno'  => $par_typeno,
				'tickettype_name' => trim($arr_data['ticket_type_name']),
				'create_date' => date('Y-m-d H:i:s'),
				'create_by'   => $session_user,
				'tic_type_typeno' => $this->green->nextTran(1,'ticket_type'),
				'tic_type_type'   => 1,
				'par_type'    => 10
			);

			$check_typeno = $this->green->getValue("SELECT tic_type_typeno FROM set_ticket_type WHERE tickettype_name = '".$tickettype_name."' AND par_typeno = '".$par_typeno."'");

			if($check_typeno !=""){
									
				$arr['success'] = "false";
				
			}else{

				$this->db->insert('set_ticket_type',$data_insert);
				$arr['success'] = "true";
			}

		}

		header('Content-type: application/json');
		echo json_encode($arr);

	}

	function show(){ 
		
		$s_name_t = trim($this->input->post('s_name_t'));
		$s_park_t = trim($this->input->post('s_park_t'));
		$s_qty_day_t = trim($this->input->post('s_qty_day_t'));
		$s_price_t = trim($this->input->post('s_price_t'))-0;
		$offset = $this->input->post('offset');
		$limit = $this->input->post('limit');
		$fname = $this->input->post('fname');
		$order = $this->input->post('order');
		$search = '';
		if($s_name_t != ""){ 
			$search .= " AND t.tickettype_name like '%".$s_name_t."%'";
		}
		if($s_park_t !=""){ 
			$search .= " AND set_park.park_name like '%".$s_park_t."%'";
		}
		if($s_qty_day_t != ""){ 
			$search .= " AND t.qty_day = '".$s_qty_day_t."'";
		}
		if($s_price_t > 0){ 
			$search .= " AND t.price = '".$s_price_t."'";
		}

		$total_records = $this->db->query("SELECT COUNT(t.tic_type_typeno) as c FROM set_ticket_type as t 
			INNER JOIN set_park ON t.par_typeno = set_park.par_typeno WHERE 1=1 {$search}")->row()->c - 0;
		$total_pages = ceil($limit > 0 ? $total_records/$limit : $total_records/5) - 0;

		$result_sql = $this->db->query("SELECT
										t.create_date,
										t.create_by,
										t.modify_by,
										t.modify_date,
										t.tic_type_type,
										t.tic_type_typeno,
										t.qty_day,
										t.price,
										t.par_type,
										t.par_typeno,
										t.description,
										t.tickettype_name,
										set_park.park_name
									FROM
										set_ticket_type as t
									INNER JOIN set_park ON t.par_typeno = set_park.par_typeno
									WHERE 1=1 {$search}
									ORDER BY {$fname} {$order} 
									LIMIT {$offset}, {$limit}")->result();
		$arr['total_records'] = $total_records;
		$arr['total_pages'] = $total_pages;
		$arr['result_sql'] = $result_sql;
		return json_encode($arr);
	}

	function edit(){ 
		$attr_tyno = $this->input->post('attr_tyno');
		$sql = $this->db->query('SELECT
									set_ticket_type.tic_type_type,
									set_ticket_type.tic_type_typeno,
									set_ticket_type.qty_day,
									set_ticket_type.price,
									set_ticket_type.par_type,
									set_ticket_type.par_typeno,
									set_ticket_type.description,
									set_ticket_type.tickettype_name,
									set_park.park_name
								FROM
									set_ticket_type
								INNER JOIN set_park ON set_ticket_type.par_typeno = set_park.par_typeno
								WHERE  tic_type_typeno = "'.$attr_tyno.'"')->row();
		return $sql;
	}

	function delete_t(){ 
		$attr_tyno = $this->input->post('attr_tyno');
		$this->db->delete('set_ticket_type',array('tic_type_typeno' => $attr_tyno));
		if($attr_tyno !=""){ 
			$success['success'] = 'true';
			header('Content-type : application/json');
			echo json_encode($success);
		}
	}

	function select_park(){ 
		$sql_select = $this->db->query("SELECT
											set_park.par_type,
											set_park.par_typeno,
											set_park.park_name,
											set_park.description
										FROM
											set_park")->result();
		$option = "";
		if(count($sql_select) > 0){ 
			foreach($sql_select as $row_opt){ 
				$option.="<option value='".$row_opt->par_typeno."'>".$row_opt->park_name."</option>";
			}
		}
		return 	$option;									
	}

	function select_location(){ 
		$sql_select = $this->db->query("SELECT
											set_location.loc_typeno,
											set_location.loc_name
										FROM
											set_location")->result();
		$option = "<option value=''></option>";
		if(count($sql_select) > 0){ 
			foreach ($sql_select as $row_opt){
				$option .="<option value='".$row_opt->loc_typeno."'>".$row_opt->loc_name."</option>";
			}
		}
		return $option;
	}
}

