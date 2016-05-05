<?php 
	class Magency_approval extends CI_Model{ 
		public function __construct(){ 
			parent:: __construct();
		}

		function select_package(){ 
			$sql = $this->db->query("SELECT
										set_park_package.package_name,
										set_park_package.package_typeno
									FROM
										set_park_package
									WHERE is_active=1 AND notforsale = 0
									ORDER BY type_of
									")->result();
			$option = '<option value=""></option>';
			if(COUNT($sql) > 0){
				foreach($sql as $row){ 
					$option .='<option value="'.$row->package_typeno.'">'.$row->package_name.'</option>';
				}
			}
			return $option;
		}

		// function select_agency(){ 
		// 	$sql = $this->db->query("SELECT
		// 								set_agency_register.agency_name,
		// 								set_agency_register.agency_code,
		// 								set_agency_register.agency_typeno
		// 							FROM
		// 							set_agency_register")->result();
		// 	if(COUNT($sql) > 0){ 
		// 		$option = '<option></option>';
		// 		foreach($sql as $row){ 
		// 			$option .= '<option value="'.$row->agency_typeno.'" attr_typeno="'.$row->agency_typeno.'">'.$row->agency_code.' | '.$row->agency_name.'</option>';
		// 		}
		// 		return $option;
		// 	}
		// }

		function save_approval(){ 

			$agency_typeno = $this->input->post('agency_typeno');
			$number_visitor = $this->input->post('number_visitor');
			$visit_date = $this->input->post('visit_date');
			$tour_garde = $this->input->post('tour_garde');
			$tour_reference = $this->input->post('tour_reference');
			$note = $this->input->post('note');
			$total_amt = $this->input->post('total_amt');
			$discount_amt = $this->input->post('discount_amt');
			$payment_amt = $this->input->post('payment_amt');
			$balance_amt = $this->input->post('balance_amt');
			$array_data = $this->input->post('array_data');
			$authuriz_by = $this->input->post('authuriz_by');
			//$agency_trans_typeno = $this->green->nextTran(22,'agency_trans_type');
			$agency_trans_typeno = $this->green->nextTransApproval("22","agency_trans_type");
			$insert_date = $this->green->convertSQLDate($visit_date);
			$session_user = $this->session->userdata('userid');
			$reciept_typeno = $this->green->nextTran(2,'reciept_type');

			$hdd_edit_app = $this->input->post('hdd_edit_app');

			$currency = $this->db->query('SELECT
											set_currencies.cur_typeno,
											set_currencies.rate,
											set_currencies.symbol
											FROM
											set_currencies
											WHERE cur_default = 1')->row();
			$cur_typeno = $currency->cur_typeno;
			$rate       = $currency->rate;
			$symbol     = $currency->symbol;
			// $rate = $this->db->query('SELECT
											
			// 								FROM
			// 								set_currencies
			// 								WHERE cur_default = 1')->row()->rate;

			$pay_typeno = $this->db->query('SELECT
											set_payment_type.pay_typeno
											FROM
											set_payment_type
											WHERE pay_typeno = 41512041109502')->row()->pay_typeno;


			$tran_reciept_payment = array( 
										'reciept_type' => 2,
										'reciept_typeno' => $reciept_typeno,
										'app_type' => 22,
										'app_typeno' => $agency_trans_typeno,
										'pay_amount' => $total_amt,
										'discount' => $discount_amt,
										'pay_type' => 11,
										'pay_typeno' => $pay_typeno,
										'cur_type' => 5,
										'cur_typeno' => $cur_typeno,
										'exchange_rate' => $rate,
										'status' => 1,
										'create_date' => date('Y-m-d H:i:s'),
										'create_by' => $session_user
										// 'is_agency' => 1
									);

			if($hdd_edit_app ==''){ 
				$agency_approval = array( 
										'agency_trans_type' => 22,
										'agency_trans_typeno' => $agency_trans_typeno,
										'agency_type' => 21,
										'agency_typeno' => $agency_typeno,
										'visitor_number' => $number_visitor,
										'visit_date' => $insert_date,
										'description' => $note,
										'amount' => $total_amt,
										'disocunt' => $discount_amt,
										'payment' => $payment_amt,
										'balance' => $balance_amt,
										'create_by' => $session_user,
										'create_date' => date('Y-m-d H:i:s'),
										'agency_refer_code' => $tour_reference,
										'is_agency' => 0,
										'reguester_by' => $tour_garde,
										'check_status' => 0,
										'authorize_by' => $authuriz_by,
										'curr_typeno'=>$cur_typeno,
										'rate'=>$rate,
										'symbol'=>$symbol
									);	
				$tran_application = array(
										'create_date'=>date('Y-m-d H:i:s'),
										'create_by'=>$session_user,
										'app_type'=>22,
										'app_typeno'=>$agency_trans_typeno,
										'discount_amount'=>$discount_amt,
										'total_amount'=>$total_amt,
										'cur_typeno'=>$cur_typeno,
										'exchange_rate'=>$rate,
										'vis_type'=>14,
										'vis_typeno'=>2
									);			

				$this->db->insert('tran_agency_approval',$agency_approval);
				$this->db->insert('tran_reciept_payment',$tran_reciept_payment);
				$this->db->insert('tran_application',$tran_application);

			}else{ 

				$agency_approval = array( 
										'agency_trans_type' => 22,
										'agency_trans_typeno' => $agency_trans_typeno,
										'agency_type' => 21,
										'agency_typeno' => $agency_typeno,
										'visitor_number' => $number_visitor,
										'visit_date' => $insert_date,
										'description' => $note,
										'amount' => $total_amt,
										'disocunt' => $discount_amt,
										'payment' => $payment_amt,
										'balance' => $balance_amt,
										'modify_by' => $session_user,
										'modify_date' => date('Y-m-d H:i:s'),
										'agency_refer_code' => $tour_reference,
										'is_agency' => 0,
										'reguester_by' => $tour_garde,
										'check_status' => 0,
										'authorize_by' => $authuriz_by,
										'curr_typeno'=>$cur_typeno,
										'rate'=>$rate,
										'symbol'=>$symbol
									);

				$this->db->update('tran_agency_approval',$agency_approval,array('agency_trans_typeno' => $hdd_edit_app));
				$this->db->update('tran_reciept_payment',$tran_reciept_payment,array('app_typeno' => $hdd_edit_app));

			}

			foreach($array_data as $data){
					$ticket_typeno= $this->green->nextTransTicket("1","ticket_type",$data['park_package']);
					// $ticket_no = $this->green->nextTransTicketnumber("24","ticketnumber",$data['park_package']);
					$ticket_no = '';
					$tran_agency_approval_detail = array( 
														'agency_trans_typeno' => $agency_trans_typeno,
														'package_typeno' => $data['park_package'],
														'price' => $data['price'],
														'discount' => $data['discount'],
														'amount' => $data['amount'],
														'date' => $insert_date,
														'create_by' => $session_user,
														'create_date' => date('Y-m-d H:i:s'),
														'ticket_no'=>$ticket_no,
														'ticket_typeno'=>$ticket_typeno,
														'ticket_type'=>'1'
													);
					$tran_ticket_detail = array(
												'ticket_type'=>1,
												'ticket_typeno'=>$ticket_typeno,
												'app_type'=>22,
												'app_typeno'=>$agency_trans_typeno,
												'package_typeno'=>$data['park_package'],
												'price'=>$data['price'],
												'discount'=> $data['discount'],
												'create_by'=>$session_user,
												'create_date'=>date('Y-m-d H:i:s'),
												'cur_typeno'=>$cur_typeno,
												'exchange_rate'=>$rate,
												'vis_typeno'=>2,
												'ticket_no'=>$tour_reference,
												'status'=>0
											);
					$tran_reciept_payment_detail = array( 
														'reciept_type' => 2,
														'reciept_typeno' => $reciept_typeno,
														'app_type' => 22,
														'app_typeno' => $agency_trans_typeno,
														'ticket_type' => 1,
														'ticket_typeno' => $ticket_typeno,
														't_amount' => $data['amount'],
														'discount' => $data['discount'],
														'create_by' => $session_user,
														'create_date' => date('Y-m-d H:i:s')
													);

					if($hdd_edit_app !=''){ 
						$sql_pk = $this->db->query("SELECT
														tran_agency_approval_detail.ticket_typeno
														FROM
														tran_agency_approval_detail
														WHERE agency_trans_typeno = '".$hdd_edit_app."'");
						if($sql_pk->num_rows() > 0){ 
							foreach($sql_pk->result() as $ticket_no){ 
								$this->db->delete('tran_ticket_check_park',array('ticket_agency_typeno' => $ticket_no->ticket_typeno));
							}
						}
					}

					$sql_check_park = $this->db->query("SELECT
				 								set_park_package_detail.par_typeno
													FROM
				 								set_park_package_detail 
												WHERE package_typeno = '".$data['park_package']."'")->result();

						if(COUNT($sql_check_park) > 0){ 
							foreach($sql_check_park as $row_park){ 
								$tran_ticket_check_park = array( 
																'app_agency'=>$agency_trans_typeno,
																'ticket_agency_typeno' => $ticket_typeno,
																'package_typeno' => $data['park_package'],
																'park' => $row_park->par_typeno,
																'status' => 0,
																'vis_typeno'=>2
															);
								
								$this->db->insert('tran_ticket_check_park',$tran_ticket_check_park);
							}
						}
						
				if($hdd_edit_app ==''){ 
					$this->db->insert('tran_agency_approval_detail',$tran_agency_approval_detail);
					$this->db->insert('tran_reciept_payment_detail',$tran_reciept_payment_detail);
					$this->db->insert('tran_ticket',$tran_ticket_detail);
				}else{ 
					$this->db->delete('tran_agency_approval_detail',array('agency_trans_typeno' => $hdd_edit_app));
					$this->db->delete('tran_reciept_payment_detail',array('app_typeno' => $hdd_edit_app));
				
					$this->db->insert('tran_agency_approval_detail',$tran_agency_approval_detail);
					$this->db->insert('tran_reciept_payment_detail',$tran_reciept_payment_detail);
				}	
				

			}

			$arr['agency_trans_typeno'] = $agency_trans_typeno;
			//$arr['aaa'] = $aaa;
			return json_encode($arr);
		}

		function check_package(){ 
			$pk_tyno = $this->input->post('pk_tyno');
			$query = $this->db->query("SELECT COUNT(package_typeno) as count_pk
									FROM
										z_setup_prefix 
									WHERE package_typeno = '".$pk_tyno."'")->row()->count_pk;
			$arr_console['sql_check'] = $query;
			return json_encode($arr_console);
		}

		function agency_auto(){ 
			
			$tour_class = $_GET['tour_class'];
			$key=$_GET['term'];
		    // $this->db->like('agency_code',$key || 'agency_name',$key);

		    $data=$this->db->query('SELECT
									set_agency_register.agency_name,
									set_agency_register.agency_code,
									set_agency_register.agency_typeno,
									set_agency_register.is_agency
									FROM
										set_agency_register 
									WHERE 1=1 AND (agency_code like "%'.$key.'%" or agency_name like "%'.$key.'%") AND is_agency = "'.$tour_class.'"')->result();
		    $array=array();
		    foreach ($data as $row) {
		       	$array[]=array('agency_typeno'=>$row->agency_typeno,
		       				'value'=> $row->agency_name,
		       				'agency_code'=>$row->agency_code,
		       				'agency_name'=>$row->agency_name);
		    }
		      echo json_encode($array);
		}

		function select_user($user_id){ 
			// if($user_id !=''){ 
			// 	$userid = $this->db->query("SELECT tran_agency_approval.authorize_by FROM tran_agency_approval WHERE agency_trans_typeno = '".$user_id."'")->row()->authorize_by;
			// }else{ 
			// 	$userid ='';
			// }
			
			$sql_user = $this->db->query("SELECT
											sch_user.userid,
											sch_user.user_name
										FROM
											sch_user")->result();
			$option = "<option></option>";
			if(COUNT($sql_user) > 0){ 
				foreach($sql_user as $data_user){ 
					// if($userid !=''){ 
					// 	if($data_user->userid == $userid){ 
					// 		$select = "selected";
					// 	}else{ 
					// 		$select = '';
					// 	}
					// }else{ 
					// 	$select = '';
					// } 

					// ".$select."

					$option .= "<option value='".$data_user->userid."' >".$data_user->user_name."</option>";
				}
			}
			return $option;
		}

		function check_agency(){ 
			$this_value = $this->input->post('get_value');
			$tour_class = $this->input->post('tour_class');
			// echo $this_value; die();

			if($this_value !=''){
				$check_typeno = $this->db->query("SELECT
													set_agency_register.agency_typeno
												FROM
													set_agency_register 
												WHERE  agency_code =  '".$this_value."' AND is_agency = '".$tour_class."'");
				// echo $check_typeno; die();
				
				if($check_typeno->num_rows() > 0){ 
					$arr_data['agency_typeno'] = $check_typeno->row()->agency_typeno;
				}else{ 
					$arr_data['agency_typeno'] = 0;
				} 
			}else{ 
				$arr_data['agency_typeno'] = 1;
			}

			return json_encode($arr_data);
		}
		
	}
?>
