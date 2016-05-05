<?php 
	class M_agency_approval extends CI_Model{ 
		public function __construct(){ 
			parent:: __construct();
		}

		function select_tour_guide(){ 
			$sql_query = $this->db->query("SELECT
											tran_agency_approval.reguester_by
											FROM
											tran_agency_approval");
			$option = '<option></option>';
			if($sql_query->num_rows() > 0){ 
				foreach($sql_query->result() as $row){ 
					$option .='<option value="'.$row->reguester_by.'">'.$row->reguester_by.'</option>';
				}
			}
			return $option;
		}

		function select_package(){ 
			$sql_query = $this->db->query("SELECT DISTINCT
												tran_agency_approval_detail.package_typeno,
												set_park_package.package_name
											FROM
												tran_agency_approval_detail
											INNER JOIN set_park_package ON tran_agency_approval_detail.package_typeno = set_park_package.package_typeno");
			$option = '<option></option>';
			if($sql_query->num_rows() > 0){ 
				foreach($sql_query->result() as $row){ 
					$option .='<option value="'.$row->package_typeno.'">'.$row->package_name.'</option>';
				}
			}
			return $option;
		}

		function select_agency(){ 
			$sql_query = $this->db->query("SELECT
												tran_agency_approval.agency_typeno,
												set_agency_register.agency_name
											FROM
												tran_agency_approval
											INNER JOIN set_agency_register ON tran_agency_approval.agency_typeno = set_agency_register.agency_typeno
											GROUP BY tran_agency_approval.agency_typeno");
			$option = '<option></option>';
			if($sql_query->num_rows() > 0){ 
				foreach($sql_query->result() as $row){ 
					$option .='<option value="'.$row->agency_typeno.'">'.$row->agency_name.'</option>';
				}
			}
			return $option;
		}

		function query_appeoval(){ 
			$from_date = $this->input->post('from_date');
			$to_date = $this->input->post('to_date');
			$tour_guide = $this->input->post('tour_guide');
			$park_package = $this->input->post('park_package');
			$group_agency = $this->input->post('group_agency');
			$where = '';
			$where_p = '';
			$todate = $this->green->convertSQLDate($to_date);
			$fromdate =$this->green->convertSQLDate($from_date);
			$display = '';
			if($from_date !=''){ 
				$where .= ' AND tran_agency_approval.visit_date >= "'.$fromdate.'"';
			}
			if($to_date !=''){ 
				$where .= ' AND tran_agency_approval.visit_date <= "'.$todate.'"';
			}
			if($tour_guide !=''){ 
				$where .= ' AND tran_agency_approval.reguester_by = "'.$tour_guide.'"';
			}
			if($group_agency !=''){ 
				$where .= ' AND tran_agency_approval.agency_typeno = "'.$group_agency.'"';
			}
			if($park_package !=''){ 
				$where_p .=' AND tran_agency_approval_detail.package_typeno ="'.$park_package.'"';
			}

			$query_app = $this->db->query("SELECT
								date(tran_agency_approval.visit_date) as date_app,
								tran_agency_approval.agency_typeno,
								tran_agency_approval.visitor_number,
								tran_agency_approval.amount,
								tran_agency_approval.disocunt,
								tran_agency_approval.payment,
								tran_agency_approval.balance,
								tran_agency_approval.agency_trans_typeno,
								tran_agency_approval.reguester_by,
								tran_agency_approval.symbol
							FROM
								tran_agency_approval 

							WHERE 1=1 {$where}")->result();
			$tr = '';
			$tr2 = '';
			if(COUNT($query_app) > 0){ 
				$i = 1;
				$total_amount = 0;
				foreach($query_app as $row){
					$total_amount += $row->amount-0;
					$agency = $this->db->query("SELECT
													set_agency_register.agency_typeno,
													set_agency_register.agency_name
												FROM
													set_agency_register 
												WHERE agency_typeno = '".$row->agency_typeno."'")->row()->agency_name;
				
					$query_app_detail = $this->db->query("SELECT
															tran_agency_approval_detail.package_typeno,
															tran_agency_approval_detail.price,
															tran_agency_approval_detail.discount,
															tran_agency_approval_detail.amount
														FROM
															tran_agency_approval_detail 
														WHERE 1=1 {$where_p} AND agency_trans_typeno = '".$row->agency_trans_typeno."'")->result();

					
					if(COUNT($query_app_detail) > 0){	
						$tr .='<tr>
									<td colspan="5" style="color: #337ab7; font-weight: bold;"> 
										'.$i++.'. &nbsp; Date: '.$row->date_app.' , &nbsp; Agency: '.$agency.' , &nbsp;  Tourist: '.$row->visitor_number.' , &nbsp; Tour Guide: '.$row->reguester_by.'
									</td> 
									<td class="remove_tag">
			                            <a href="javascript:void(0)" class="a_edit" agecy_trans='.$row->agency_trans_typeno.'><img rel="2510" height="15" width="15" src='.base_url("/assets/images/icons/edit.png").'></a> &nbsp; &nbsp;
			                            <a href="javascript:void(0)" class="a_delete" agecy_trans='.$row->agency_trans_typeno.'><img rel="2510" src='.base_url("/assets/images/icons/delete.png").'></a>
			                        </td>
								</tr>';
					}

					if(COUNT($query_app_detail) > 0){ 
						$j = 1;
						$total_amount = 0;
						$discount_all = 0;
						foreach($query_app_detail as $row_detail){
							// $total_amount += $row_detail->amount-0;

							$pack_parkage = $this->db->query("SELECT
																set_park_package.package_name
															FROM
																set_park_package 
															WHERE package_typeno = '".$row_detail->package_typeno."'")->row()->package_name;
							$tr .= '<tr> 
										<td style="text-align:center;">'.$j++.'</td>
										<td>'.$pack_parkage.'</td>
										<td style="text-align:right;">'.$row_detail->price.'</td>
										<td style="text-align:right;">'.$row_detail->discount.'</td>
										<td style="text-align:right;">'.$row_detail->amount.'&nbsp;&nbsp;'.$row->symbol.'</td>
										<td>&nbsp;</td>
									<tr>';

						}

						if($park_package ==''){
							$tr .='<tr><td style="color: #337ab7;text-align:right;" colspan="4">Total amount </td><td style="color: #337ab7;text-align:right;">'.$row->amount.'&nbsp;&nbsp;'.$row->symbol.'</td><td>&nbsp;</td></tr>
								   <tr><td style="color: #337ab7;text-align:right;" colspan="4">Discount</td><td style="color: #337ab7;text-align:right;">'.$row->disocunt.'&nbsp;&nbsp;'.$row->symbol.'</td><td>&nbsp;</td></tr>
								   <tr><td style="color: #337ab7;text-align:right;" colspan="4">Payment</td><td style="color: #337ab7;text-align:right;">'.$row->payment.'&nbsp;&nbsp;'.$row->symbol.'</td><td>&nbsp;</td></tr>
								   <tr><td style="color: #337ab7;text-align:right;" colspan="4">Balance</td><td style="color: #337ab7;text-align:right;">'.$row->balance.'&nbsp;&nbsp;'.$row->symbol.'</td><td>&nbsp;</td></tr>';
								
						}else{ 
							$tr .='<tr style="display:none"></tr>';
						}
					}
				}
			}

			$arr_data['result_query'] = $tr;
			return json_encode($arr_data);
		}

		function delete_approval(){ 
			$this_typeno = $this->input->post('this_typeno');
			if($this_typeno !=''){
				$sql_pk = $this->db->query("SELECT
														tran_agency_approval_detail.ticket_typeno
														FROM
														tran_agency_approval_detail
														WHERE agency_trans_typeno = '".$this_typeno."'");
				if($sql_pk->num_rows() > 0){ 
					foreach($sql_pk->result() as $ticket_no){ 
						$this->db->delete('tran_ticket_check_park',array('ticket_agency_typeno' => $ticket_no->ticket_typeno));
					}
				}
				
				$this->db->delete('tran_agency_approval',array('agency_trans_typeno' => $this_typeno));
				$this->db->delete('tran_reciept_payment',array('app_typeno' => $this_typeno));
				$this->db->delete('tran_agency_approval_detail',array('agency_trans_typeno' => $this_typeno));
				$this->db->delete('tran_reciept_payment_detail',array('app_typeno' => $this_typeno));
				$arr['success'] = 'true';
			}else{ 
				$arr['success'] = 'false';
			}
			echo json_encode($arr);
		}
	}
?>