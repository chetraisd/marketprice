<?php 
	class M_report_sale extends CI_Model{ 
		public function __construct(){ 
			parent:: __construct();
		}

		function ticket_no_auto(){ 
			$key=$_GET['term'];		    

		    $data=$this->db->query('SELECT DISTINCT 
		    							tran_ticket.ticket_no 
		    						FROM 
		    							tran_ticket 
		    						WHERE ticket_no like "%'.$key.'%"')->result();
		    $array=array();
		    foreach ($data as $row) {
		       	$array[]=array('value'=> $row->ticket_no);
		    }
		    echo json_encode($array);
		}

		function select_pk(){ 
			$sql = $this->db->query("SELECT DISTINCT
										set_park_package.package_name,
										tran_ticket.package_typeno
									FROM
										tran_ticket
									INNER JOIN set_park_package ON tran_ticket.package_typeno = set_park_package.package_typeno");
			$option = '<option></option>';
			if($sql->num_rows() > 0){ 
				foreach($sql->result() as $row){ 
					$option .='<option value="'.$row->package_typeno.'">'.$row->package_name.'</option>';
				}
			}
			return $option;						
		}

		// function ticket_no(){ 
		// 	$sql = $this->db->query("SELECT DISTINCT tran_ticket.ticket_no FROM tran_ticket");
		// 	$option = '<option></option>';
		// 	if($sql->num_rows() > 0){ 
		// 		foreach($sql->result() as $row){ 
		// 			$option .='<option value="'.$row->ticket_no.'">'.$row->ticket_no.'</option>';
		// 		}
		// 	}
		// 	return $option;						
		// }

		function select_country(){ 
			$sql = $this->db->query("SELECT DISTINCT
									tran_ticket.country,
									countries.`name`
									FROM
									tran_ticket
									INNER JOIN countries ON tran_ticket.country = countries.id_countries 
									WHERE vis_typeno = 1");
			$option = '<option></option>';
			if($sql->num_rows() > 0){ 
				foreach($sql->result() as $row){ 
					$option .='<option value="'.$row->country.'">'.$row->name.'</option>';
				}
			}
			return $option;		
		}

		function select_agency(){ 
			$sql = $this->db->query("SELECT DISTINCT
									tran_ticket.app_typeno,
									set_agency_register.agency_code,
									set_agency_register.agency_name,
									tran_agency_approval.agency_typeno
									FROM
									tran_ticket
									INNER JOIN tran_agency_approval ON tran_ticket.app_typeno = tran_agency_approval.agency_trans_typeno
									INNER JOIN set_agency_register ON tran_agency_approval.agency_typeno = set_agency_register.agency_typeno
									WHERE vis_typeno = 2");
			$option = '<option></option>';
			if($sql->num_rows() > 0){ 
				foreach($sql->result() as $row){ 
					$option .='<option value="'.$row->agency_typeno.'">'.$row->agency_code.' | '.$row->agency_name.'</option>';
				}
			}
			return $option;
		}

		function show_report(){ 
			$from_date = $this->input->post('from_date');
			$to_date = $this->input->post('to_date');
			$visitor_type = $this->input->post('visitor_type');
			$report_type = $this->input->post('report_type');
			$sch_status = $this->input->post('sch_status');
			$where = '';
			$todate = $this->green->convertSQLDate($to_date);
			$fromdate =$this->green->convertSQLDate($from_date);

			$sch_pk_package = $this->input->post('sch_pk_package');
			$sch_ticket_no = $this->input->post('sch_ticket_no');

			$country = $this->input->post('country');
			$gender = $this->input->post('gender');
			$remark = $this->input->post('remark');
			$sch_agency = $this->input->post('sch_agency');


			if($from_date != ''){ 
				$where .= " AND date(tran_application.create_date) >= '".$fromdate."' AND date(tran_application.create_date) <= '".$todate."'";
			}
			if($visitor_type !=''){ 
				$where .= " AND tran_application.vis_typeno = '".$visitor_type."'";
			}

			if($sch_status !=''){ 
				$where .= " AND tran_application.checkin_status = '".$sch_status."'";
			}
			$sql_symbol = $this->db->query("SELECT symbol FROM set_currencies WHERE cur_default=1")->row()->symbol;
			if($report_type == 0){
				
				// $sql_query = $this->db->query("SELECT
				// 							date(tran_application.create_date) AS app_date,
				// 							tran_application.vis_typeno,
				// 							tran_application.checkin_status,
				// 							tran_application.total_amount,
				// 							tran_application.discount_amount,
				// 							tran_application.app_typeno
				// 							FROM
				// 							tran_application 
				// 							WHERE 1=1 {$where}");

				$sql_query = $this->db->query("SELECT
											date(tran_application.create_date) AS app_date
											FROM
											tran_application 
											WHERE 1=1 
											GROUP BY app_date");

				$tr = '';
				if($sql_query->num_rows() > 0){ 
					$i = 1;
					$total_amount = 0;
					foreach($sql_query->result() as $row){

						$tr .= '<tr>
									<td colspan="5" style="color: #337ab7; font-weight: bold;">
										'.$i++.'. Date: '.$row->app_date.' 
									<td> 
								</tr>'; 

						$sql_de = $this->db->query("SELECT			
														tran_application.vis_typeno,
														tran_application.checkin_status,
														tran_application.total_amount,
														tran_application.discount_amount,
														tran_application.app_typeno
														FROM
														tran_application 
														WHERE 1=1 {$where} AND date(tran_application.create_date) = '".$row->app_date."'");
						if($sql_de->num_rows() > 0){  
							$j = 1;
							$amount = 0;

							foreach($sql_de->result() as $row_de){ 
								$price = $row_de->total_amount-0;
								$discount = $row_de->discount_amount-0;
								$amount = ($price - $discount)-0;
								$total_amount += $amount-0;
								if($row_de->vis_typeno == 1){ 
									$Visitor = 'Individual';
								}else{ 
									$Visitor = 'Tour Group';
								}
								
								if($row_de->checkin_status == 1){ 
									$status = 'Close';
								}else{ 
									$status = 'Open';
								}

								$tr .='<tr> 
										<td style="text-align:center">'.$j.'</td>								
										<td>'.$Visitor.'</td>
										<td>'.$status.'</td>
										<td style="text-align:right;">'.number_format($price,2).'</td>
										<td style="text-align:right;">'.number_format($discount,2).'</td>
										<td style="text-align:right;">'.number_format($amount,2).'&nbsp;'.$sql_symbol.'</td>
									</tr>';
								$j++;	
							}

							$tr .= '<tr> 
										<td colspan="5" style="text-align:right">Total amount:</td>
										<td style="text-align:right">'.number_format($total_amount,2).'&nbsp;'.$sql_symbol.'</td>
									</tr>';
							$i++;
						}
					}

					$table = '<table class="table table-condensed">
									<thead> 
										<tr> 
											<th>No</th>
											<th>Visiter Type</th>								
											<th>Status</th>
											<th style="text-align:center;">Price</th>
											<th style="text-align:center;">Discount</th>
											<th style="text-align:center;">Amount</th>
										</tr>
									</thead>
									<tbody>'.$tr.'
									</tbody>
								</table>';

				}else{ 
					$table ='<table class="table table-condensed">
								<tr> 
									<td colspan="6" align="center"><i style="font-size:15px; color:red;">Result not data.</i></td>
								</tr><tr><td colspan="6"></td></tr> 
							</table>';
				}
				
			}else{

				$where_de = '';
				if($sch_pk_package !=''){ 
					$where_de .= " AND tran_ticket.package_typeno = '".$sch_pk_package."'";
				}
				if($sch_ticket_no !=''){ 
					$where_de .= " AND tran_ticket.ticket_no = '".$sch_ticket_no."'";
				}

				if($visitor_type == ''){

					$sql_query = $this->db->query("SELECT
													date(tran_application.create_date) AS app_date,
													tran_application.checkin_status,
													tran_application.app_typeno,
													tran_application.vis_typeno,
													tran_application.discount_amount,
													tran_application.total_amount
												FROM
													tran_application 
												WHERE 1=1 {$where}");
					$tr = '';
					if($sql_query->num_rows() > 0){ 
						
						$i = 1;

						$total_amount = 0;
						$discount_amount = 0;
						$payment = 0;
						$total_all = 0;
						foreach($sql_query->result() as $row_tran){ 
							$total_amount = $row_tran->total_amount-0;
							$discount_amount = $row_tran->discount_amount-0;
							$payment = ($total_amount - $discount_amount)-0;

							if($row_tran->vis_typeno == 1){ 
								$visitor = 'Individual';
							}else{ 
								$visitor = 'Tour Group';
							}

							// $tr .= '<tr>
							// 			<td colspan="6" style="color: #337ab7; font-weight: bold;">
							// 				'.$i.'. Date: '.$row_tran->app_date.', Visitor: '.$visitor.' 
							// 			<td> 
							// 		</tr>';
							
							$sql = $this->db->query("SELECT
														tran_ticket.package_typeno,
														tran_ticket.ticket_no,
														tran_ticket.checkin_status,
														tran_ticket.price,
														tran_ticket.discount,
														tran_ticket.vis_typeno,
														tran_ticket.ticket_typeno
													FROM
														tran_ticket 
													WHERE 1=1 AND app_typeno = '".$row_tran->app_typeno."' {$where_de}"); 
													
							
							if($sql->num_rows() > 0){ 

								$tr .= '<tr>
										<td colspan="6" style="color: #337ab7; font-weight: bold;">
											'.$i++.'. Date: '.$row_tran->app_date.', Visitor: '.$visitor.' 
										<td> 
									</tr>';
								$j = 1;
								$price = '';
								foreach($sql->result() as $tran_ticket){ 
									$package_name = $this->db->query("SELECT package_name FROM set_park_package WHERE package_typeno = '".$tran_ticket->package_typeno."'");
									if($package_name->num_rows() > 0){ 
										$pk_name = $package_name->row()->package_name;
									}else{ 
										$pk_name = '';
									}

									if($tran_ticket->checkin_status == 0){ 
										$status = 'Open';
									}else{ 
										$status = 'Close';
									}

									if($tran_ticket->vis_typeno == 1){ 
										$price = $tran_ticket->price;
										
										if($tran_ticket->discount != ''){ 
											$discount = $tran_ticket->discount;
										}else{ 
											$discount = number_format(0,2);
										}
										$amount = $price-$discount;
									}else{ 
										$appr = $this->db->query("SELECT
																	tran_agency_approval_detail.price,
																	tran_agency_approval_detail.discount,
																	tran_agency_approval_detail.amount
																FROM
																	tran_agency_approval_detail 
																WHERE ticket_typeno = '".$tran_ticket->ticket_typeno."'");
										$price = $appr->row()->price;
										$discount = $appr->row()->discount;
										$amount = $appr->row()->amount;
									}

									$tr .='<tr>
											<td style="text-align:center">'.$j.'</td>
											<td>'.$pk_name.'</td>
											<td>'.$tran_ticket->ticket_no.'</td>
											<td>'.$status.'</td>
											<td style="text-align:right">'.number_format($price,2).'</td>
											<td style="text-align:right">'.number_format($discount,2).'</td>
											<td style="text-align:right">'.number_format($amount,2).'&nbsp;'.$sql_symbol.'</td>
										</tr>';
									$j++;
								}
							}
							// $i++;
							if($sch_pk_package =='' && $sch_ticket_no ==''){ 
								$tr .= '<tr><td colspan="6" style="color: #337ab7; text-align:right;">Total amount:</td><td style="color: #337ab7; text-align:right;">'.number_format($total_amount,2).'&nbsp;'.$sql_symbol.'</td></tr>
										<tr><td colspan="6" style="color: #337ab7; text-align:right;">Discount amount:</td><td style="color: #337ab7; text-align:right;">'.number_format($discount_amount,2).'&nbsp;'.$sql_symbol.'</td></tr>
										<tr><td colspan="6" style="color: #337ab7; text-align:right;">Payment amount:</td><td style="color: #337ab7; text-align:right;">'.number_format($payment,2).'&nbsp;'.$sql_symbol.'</td></tr>';
							}else{ 
								$tr .'<tr style="display:none"></tr>';
							}
							$total_all += $payment-0;
						}

						$tr .= '<tr><td colspan="6" style="color: #337ab7; text-align:right; font-weight: bold;">Total: </td><td style="color: #337ab7; text-align:right;">'.number_format($total_all,2).'&nbsp;'.$sql_symbol.'</td></tr>';

						$table = '<table class="table table-condensed">
										<thead> 
											<tr> 
												<th>No</th>
												<th>Pack/parkage</th>
												<th>Tiket No</th>
												<th>Status</th>
												<th style="text-align:center;">Price</th>
												<th style="text-align:center;">Discount</th>
												<th style="text-align:center;">Amount</th>
											</tr>
										</thead>
										<tbody>'.$tr.'
										</tbody>
									</table>';

					}else{ 
						$table ='<table class="table table-condensed">
									<tr> 
										<td colspan="6" align="center"><i style="font-size:15px; color:red;">Result not data.</i></td>
									</tr><tr><td colspan="6"></td></tr> 
								</table>';
					}

				}else if($visitor_type == 1){
					$where_ad = '';
					if($country != ''){ 
						$where_ad .= ' AND tran_ticket.country = "'.$country.'"'; 
					}
					if($gender != ''){ 
						$where_ad .= ' AND tran_ticket.gender = "'.$gender.'"'; 
					}
					if($remark != ''){ 
						$where_ad .= ' AND tran_ticket.old_type = "'.$remark.'"'; 
					}

					$sql_query = $this->db->query("SELECT
													date(tran_application.create_date) AS app_date,
													tran_application.checkin_status,
													tran_application.app_typeno,
													tran_application.vis_typeno,
													tran_application.discount_amount,
													tran_application.total_amount
												FROM
													tran_application
												WHERE 1=1 {$where} AND  vis_typeno ='".$visitor_type."'
												GROUP BY app_date");
					 $tr = '';
					if($sql_query->num_rows() > 0){ 
						
						$i = 1;
						$total_amount = 0;
						foreach($sql_query->result() as $row_tran){ 
							$total_amount = $row_tran->total_amount-0;
							$discount_amount = $row_tran->discount_amount-0;
							$amount_app =  $total_amount-$discount_amount;

							// $tr .= '<tr>
							// 			<td colspan="6" style="color: #337ab7; font-weight: bold;">
							// 				'.$i.'. Date: '.$row_tran->app_date.' 
							// 			<td> 
							// 		</tr>';

							$sql = $this->db->query("SELECT
														tran_ticket.package_typeno,
														tran_ticket.ticket_no,
														tran_ticket.checkin_status,
														tran_ticket.country,
														tran_ticket.gender,
														tran_ticket.price,
														tran_ticket.discount,
														tran_ticket.old_type
													FROM
														tran_ticket 
													WHERE 1=1 {$where_de} {$where_ad} {$where}
													AND vis_typeno = '".$row_tran->vis_typeno."'
													AND DATE_FORMAT(create_date,'%Y-%m-%d')='".$row_tran->app_date."'");
							// echo $table;
							// die();
							
							if($sql->num_rows() > 0){

								$tr .= '<tr>
											<td colspan="6" style="color: #337ab7; font-weight: bold;">
												'.$i++.'. Date: '.$row_tran->app_date.' 
											<td> 
										</tr>';

								$j = 1; 
								foreach($sql->result() as $row_detail){ 
									$package_name = $this->db->query("SELECT package_name FROM set_park_package WHERE package_typeno = '".$row_detail->package_typeno."'");
									if($package_name->num_rows() > 0){ 
										$pk_name = $package_name->row()->package_name;
									}else{ 
										$pk_name = '';
									}

									if($row_detail->checkin_status == 0){ 
										$status = 'Open';
									}else{ 
										$status = 'Close';
									}

									$query_ctry = $this->db->query("SELECT countries.`name` FROM countries WHERE id_countries = '".$row_detail->country."'");
									if($query_ctry->num_rows() > 0){ 
										$country = $query_ctry->row()->name;
									}else{ 
										$country = '';
									}

									if($row_detail->gender == 0){ 
										$gender = 'Male';
									}else{ 
										$gender = 'Femail';
									}

									if($row_detail->old_type == 0){ 
										$old_type = 'Adult';
									}else{ 
										$old_type = 'Child';
									}

									if($row_detail->discount !=''){ 
										$discount = $row_detail->discount;
									}else{ 
										$discount = 0;
									}

									$price = $row_detail->price;
									$amount = $price-$discount-0;

									$tr .= '<tr> 
											<td style="text-align:center">'.$j.'</td>
											<td>'.$pk_name.'</td>
											<td>'.$row_detail->ticket_no.'</td>
											<td>'.$status.'</td>
											<td>'.$country.'</td>
											<td>'.$gender.'</td>
											<td>'.$old_type.'</td>
											<td style="text-align:right;">'.number_format($price,2).'</td>
											<td style="text-align:right;">'.number_format($discount,2).'</td>
											<td style="text-align:right;">'.number_format($amount,2).'&nbsp;'.$sql_symbol.'</td>
										</tr>';
									$j++;
								}
							}
							if($sch_pk_package =='' && $sch_ticket_no ==''){
								$tr .= ' 
										<tr><td colspan="9" style="color: #337ab7; text-align:right;">Total amount :</td><td style="color: #337ab7; text-align:right;"> '.number_format($total_amount,4).'&nbsp;'.$sql_symbol.'</td></tr>
										<tr><td colspan="9" style="color: #337ab7; text-align:right;">Discount amount :</td><td style="color: #337ab7; text-align:right;">'.number_format($discount_amount,4).'&nbsp;'.$sql_symbol.'</td></tr>
										<tr><td colspan="9" style="color: #337ab7; text-align:right;">Payment :</td><td style="color: #337ab7; text-align:right;">'.number_format($amount_app,2).'&nbsp;'.$sql_symbol.'</td></tr>';
									
							}else{ 
								$tr .='<tr style="display:none"></tr>'; 
							}			

							// $i++;
						}

							$table = '<table class="table table-condensed">
											<thead> 
												<tr> 
													<th>No</th>
													<th>Pack/parkage</th>
													<th>Tiket No</th>
													<th>Status</th>
													<th>Country</th>
													<th>Gender</th>
													<th>Remark</th>
													<th style="text-align:center;">Price</th>
													<th style="text-align:center;">Discount</th>
													<th style="text-align:center;">Amount</th>
												</tr>
											</thead>
											<tbody>'.$tr.'
											</tbody>
										</table>';

					}else{ 
						$table ='<table class="table table-condensed">
								<tr> 
									<td colspan="6" align="center"><i style="font-size:15px; color:red;">Result not data.</i></td>
								</tr><tr><td colspan="6"></td></tr> 
							</table>';
					}

				}else{ 

					$where_ag = '';
					if($sch_agency !=''){ 
						$where_ag .=' AND tran_agency_approval.agency_typeno = "'.$sch_agency.'"';
					}

					$sql_query = $this->db->query("SELECT
													date(tran_application.app_typeno) as app_date,
													tran_agency_approval.visitor_number,
													tran_agency_approval.agency_refer_code,
													tran_agency_approval.reguester_by,
													tran_application.vis_typeno,
													tran_agency_approval.agency_typeno,
													tran_agency_approval.amount,
													tran_agency_approval.disocunt,
													tran_agency_approval.payment
												FROM
													tran_agency_approval
												INNER JOIN tran_application ON tran_application.app_typeno = tran_agency_approval.agency_trans_typeno
												WHERE 1=1 {$where} {$where_ag} AND tran_application.vis_typeno = 2");
					if($sql_query->num_rows() > 0){ 
						$tr = '';
						$i = 1;
						$total_amount = 0;
						$discount_amount = 0;
						$payment = 0;
						foreach($sql_query->result() as $row_tran){ 
							$agency = $this->db->query("SELECT set_agency_register.agency_name FROM set_agency_register WHERE agency_typeno = '".$row_tran->agency_typeno."'");
							if($agency->num_rows() > 0){ 
								$agency_name = $agency->row()->agency_name;
							}else{ 
								$agency_name = '';
							}
							$tr .= '<tr>
										<td colspan="5" style="color: #337ab7; font-weight: bold;">
											'.$i.'. Date: '.$row_tran->app_date.', Agency: '.$agency_name.', Number Visitor: '.$row_tran->visitor_number.', Tour Guide: '.$row_tran->reguester_by.', Tiket No: '.$row_tran->agency_refer_code.' 
										<td> 
									</tr>';

							$total_amount = $row_tran->amount-0;
							$discount_amount = $row_tran->disocunt-0;
							$payment = $row_tran->payment-0;

							$sql = $this->db->query("SELECT
														tran_agency_approval_detail.agency_trans_typeno,
														tran_agency_approval_detail.package_typeno,
														tran_agency_approval_detail.price,
														tran_agency_approval_detail.discount,
														tran_agency_approval_detail.amount,
														tran_agency_approval_detail.checkin_status
													FROM
														tran_agency_approval_detail");

							if($sql->num_rows() > 0){ 
								$j = 1;
								
								foreach($sql->result() as $row_detail){ 
									$package_name = $this->db->query("SELECT package_name FROM set_park_package WHERE package_typeno = '".$row_detail->package_typeno."'");
									if($package_name->num_rows() > 0){ 
										$pk_name = $package_name->row()->package_name;
									}else{ 
										$pk_name = '';
									}

									if($row_detail->checkin_status == 0){ 
										$status = 'Open';
									}else{ 
										$status = 'Close';
									}

									$price =  $row_detail->price;
									$discount =  $row_detail->discount;
									$amount =  $row_detail->amount;

									$tr .='<tr> 
											<td style="text-align:center">'.$j.'</td>
											<td>'.$pk_name.'</td>
											<td>'.$status.'</td>
											<td style="text-align:right;">'.number_format($price,2).'</td>
											<td style="text-align:right;">'.number_format($discount,2).'</td>
											<td style="text-align:right;">'.number_format($amount,2).'&nbsp;'.$sql_symbol.'</td>
										</tr>';
									$j++;
									// $total_amount += $amount-0;
								}

								$tr .= '<tr><td colspan="5" style="text-align:right;color: #337ab7;">Total amount : </td><td style="text-align:right;color: #337ab7;">'.number_format($total_amount,2).'&nbsp;'.$sql_symbol.'</td></tr>
										<tr><td colspan="5" style="text-align:right;color: #337ab7;">Discount amount : </td><td style="text-align:right;color: #337ab7;">'.number_format($discount_amount,2).'&nbsp;'.$sql_symbol.'</td></tr>
										<tr><td colspan="5" style="text-align:right;color: #337ab7;">Payment:</td><td style="text-align:right;color: #337ab7;">'.number_format($payment,2).'&nbsp;'.$sql_symbol.'</td></tr>';
							}
							$i++;
						}
							$table = '<table class="table table-condensed">
											<thead> 
												<tr> 
													<th>No</th>
													<th>Pack/parkage</th>
													<th>Status</th>
													<th style="text-align:center;">Price</th>
													<th style="text-align:center;">Discount</th>
													<th style="text-align:center;">Amount</th>
												</tr>
											</thead>
											<tbody>'.$tr.'
											</tbody>
										</table>';
					}else{ 
						$table ='<table class="table table-condensed">
									<tr> 
										<td colspan="6" align="center"><i style="font-size:15px; color:red;">Result not data.</i></td>
									</tr><tr><td colspan="6"></td></tr> 
								</table>';
					}
				}
			}

			echo json_encode($table);
		}
	}
?>