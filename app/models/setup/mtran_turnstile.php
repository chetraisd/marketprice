<?php 
	class Mtran_turnstile extends CI_Model{ 
		public function __construct(){ 
			parent:: __construct();
		}

		function select_turnstile(){ 
			$query_turnstile = $this->db->query("SELECT
								set_counter.gat_typeno,
								set_park_gate.par_typeno,
								set_counter.counter_name,
								set_counter.cou_typeno
								FROM
								set_counter
								INNER JOIN set_park_gate ON set_counter.gat_typeno = set_park_gate.gat_typeno");
			$option = '<option></option>';
			if($query_turnstile->num_rows() > 0){ 
				foreach($query_turnstile->result() as $row){ 
					$option .= '<option value="'.$row->cou_typeno.'" par_typeno="'.$row->par_typeno.'">'.$row->counter_name.'</option>';
				}
			}
			return $option;
		}

		function turnstile_search(){ 

			$sql = $this->db->query("SELECT DISTINCT
									tran_turnstile_entry.cou_typneno,
									set_counter.counter_name
									FROM
									tran_turnstile_entry
									INNER JOIN set_counter ON tran_turnstile_entry.cou_typneno = set_counter.cou_typeno");
			$option = '<option></option>';
			if($sql->num_rows() > 0){ 
				foreach($sql->result() as $row){ 
					$option .='<option value="'.$row->cou_typneno.'">'.$row->counter_name.'</option>';
				}
			}
			return $option;
		}

		function select_old_value(){ 
			$this_typeno = $this->input->post('this_typeno');
			$query_old = $this->db->query('SELECT
											Max(tran_turnstile_entry.new_value) AS max_old,
											Max(tran_turnstile_entry.count_date) as max_date
											FROM
											tran_turnstile_entry
											WHERE tran_turnstile_entry.cou_typneno = "'.$this_typeno.'"');
			if($query_old->num_rows() > 0){ 
				$data['old_value'] = $query_old->row()->max_old;
				$data['to_day'] = $query_old->row()->max_date;
			}else{ 
				$data['old_value'] = '';
				$data['to_day'] = '';
			}

			return json_encode($data);
		}

		function save_turnstile(){ 

			$select_turnstile = $this->input->post('select_turnstile');
			$hdd_par_typeno = $this->input->post('hdd_par_typeno');
			$new_value = $this->input->post('new_value')-0;			
			$select_status = $this->input->post('select_status');

			$com_typeno = $this->green->nextTran(15, 'com_type');
			$session_user = $this->session->userdata('userid');

			$query_new_value = $this->db->query("SELECT
											MAX(tran_turnstile_entry.new_value) as max_new
											FROM
											tran_turnstile_entry
											WHERE cou_typneno='".$select_turnstile."'");

			if($query_new_value->row()->max_new == 0 or $query_new_value->row()->max_new == ''){
				$old_value = 0;
			}else{
				$old_value = $query_new_value->row()->max_new;
			}

			$changed = ($new_value - $old_value)-0;
			
			$count_individual = $this->db->query("SELECT
													COUNT(tran_ticket_check_park.check_in_status) as check_in
													FROM
													tran_ticket_check_park 
													WHERE tran_ticket_check_park.check_in_status = 1 
													AND date(tran_ticket_check_park.checking_date) = '".date('Y-m-d')."' 
													AND tran_ticket_check_park.vis_typeno = 1
													AND tran_ticket_check_park.park = '".$hdd_par_typeno."'")->row()->check_in;

			$app_group = $this->db->query("SELECT
											tran_ticket_check_park.app_agency,
											tran_ticket_check_park.check_in_status
											FROM
											tran_ticket_check_park
											WHERE date(tran_ticket_check_park.checking_date) = '".date('Y-m-d')."' 
											AND tran_ticket_check_park.vis_typeno = 2 
											AND tran_ticket_check_park.park = '".$hdd_par_typeno."'");
			$count_group = 0;
			$sum_count_group = 0;
			if($app_group->num_rows() > 0){ 
				foreach($app_group->result() as $count_row){ 
					$count_group = $this->db->query("SELECT DISTINCT
												tran_agency_approval.visitor_number,
												tran_ticket_check_park.app_agency
												FROM
												tran_ticket_check_park
												INNER JOIN tran_agency_approval ON tran_ticket_check_park.app_agency = tran_agency_approval.agency_trans_typeno
												WHERE tran_ticket_check_park.vis_typeno = 2 
												AND tran_ticket_check_park.app_agency = '".$count_row->app_agency."'")->row()->visitor_number;
					
					$sum_count_group += $count_group-0;
				}
			}
			
			$check_ticket = ($count_individual + $sum_count_group)-0;
			$checked_vs_turnstile = ($changed - $check_ticket)-0;

			$data_insert = array( 
							'com_type' => 15,
							'com_typeno' => $com_typeno,
							'count_date' => date('Y-m-d H:i:s'),
							'new_value' => $new_value,
							'old_value' => $old_value,
							'changed_value' => $changed,
							'status' => $select_status,
							'cou_typneno' => $select_turnstile,
							'cou_type' => 4,
							'created_date' => date('Y-m-d H:i:s'),
							'created_by' => $session_user,				
							'package_typeno' => $hdd_par_typeno,
							'package_type' => 19,
							'actual_checked_ticket' => $check_ticket, 
							'checked_vs_turnstile' => $checked_vs_turnstile
			);

			$save = $this->db->insert('tran_turnstile_entry',$data_insert);
			if(COUNT($save) > 0){ 
				$arr['success'] = 'true';
			}else{ 
				$arr['success'] = 'false';
			}
			
			return json_encode($arr);
		}

		function show_list_turnstile(){ 

			$from_date = $this->input->post('from_date');
			$to_date = $this->input->post('to_date');
			$turnstile_auto = $this->input->post('turnstile_auto');
			$where = '';
			// if($from_date != ''){ 
				
			// }

			$sql_query = $this->db->query("SELECT
										set_counter.counter_name,
										tran_turnstile_entry.com_typeno,
										date(tran_turnstile_entry.count_date) as count_date,
										tran_turnstile_entry.new_value,
										tran_turnstile_entry.old_value,
										tran_turnstile_entry.changed_value,
										tran_turnstile_entry.`status`,
										tran_turnstile_entry.cou_typneno,
										tran_turnstile_entry.package_typeno,
										tran_turnstile_entry.actual_checked_ticket,
										tran_turnstile_entry.checked_vs_turnstile
										FROM
										tran_turnstile_entry
										INNER JOIN set_counter ON tran_turnstile_entry.cou_typneno = set_counter.cou_typeno");

			if($sql_query->num_rows() > 0){ 
				$arr['query'] = $sql_query->result();
			}else{ 
				$arr['query'] = 0;
			}

			return json_encode($arr);
		}
	}

?>


