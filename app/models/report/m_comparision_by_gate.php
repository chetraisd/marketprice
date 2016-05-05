<?php 
	class M_comparision_by_gate extends CI_Model{ 
		public function __construct(){ 
			parent:: __construct();
		}

		function select_gate(){ 
			$sql = $this->db->query("SELECT DISTINCT
										tran_ticket.gat_typeno,
										set_gate.gat_name
									FROM
										tran_ticket
									INNER JOIN set_gate ON tran_ticket.gat_typeno = set_gate.gat_typeno")->result();
									
			if(COUNT($sql) > 0){ 
				$option = "<option></option>";
				foreach($sql as $row){ 
					$option .='<option value="'.$row->gat_typeno.'">'.$row->gat_name.'</option>';
				}
				return $option;
			}
		}

		// function select_park(){ 
		// 	$sql = $this->db->query("SELECT DISTINCT
		// 								tran_ticket.par_typeno,
		// 								set_park.park_name
		// 							FROM
		// 								tran_ticket
		// 							INNER JOIN set_park ON tran_ticket.par_typeno = set_park.par_typeno")->result();
		// 	if(COUNT($sql) > 0){ 
		// 		$option = "";
		// 		foreach($sql as $row){ 
		// 			$option .='<option value="'.$row->par_typeno.'">'.$row->park_name.'</option'."<br>";
		// 		}
		// 		return $option;
		// 	}						
		// }

		function show(){ 
			$from_date = $this->input->post('from_date');
			$to_date = $this->input->post('to_date');
			$by_park = $this->input->post('by_park');
			$by_gate = $this->input->post('by_gate');
			$report_type = $this->input->post('report_type');
			$search_type = $this->input->post('search_type');
			$sort_field = $this->input->post('sort_field');

			$search = '';
			$search_d = '';
			$todate = $this->green->convertSQLDate($to_date);
			$fromdate =$this->green->convertSQLDate($from_date);
			
			if($from_date !=""){ 

				//$explode_from_date = explode("/",$from_date);
				//$format_from_date = date('Y-m-d',strtotime($explode_from_date[2].'-'.$explode_from_date[1].'-'.$explode_from_date[0]));
				$search .=" AND date(tran_application.create_date) >= '".$fromdate."'"; 
			}
			if($to_date !=""){
				//$explode_to_date = explode("/",$to_date);
				//$format_to_date = date('Y-m-d',strtotime($explode_to_date[2].'-'.$explode_to_date[1].'-'.$explode_to_date[0])); 
				$search .=" AND date(tran_application.create_date) <= '".$todate."'";
			}
			if($by_park !=""){
				$val_park = "";
				foreach($by_park as $arr_park){ 
					$val_park .= "'".$arr_park."',";
				}
				$park = $val_park."''";
				$search .=" AND tran_ticket.par_typeno IN (".$park.")";
				$search_d .=" AND tran_ticket.par_typeno IN (".$park.")"; 
			}
			if($by_gate !=""){ 
				$search .=" AND tran_ticket.gat_typeno = '".$by_gate."'";
				$search_d .=" AND tran_ticket.gat_typeno = '".$by_gate."'";
			}


			if($report_type == 0){

				$sql_query = $this->db->query("SELECT
												tran_ticket.gat_typeno,
												tran_ticket.par_typeno,
												Sum(tran_ticket.price) AS amount,
												Sum(tran_ticket.`status`) AS qty_ticket,
												set_park.park_name,
												set_gate.gat_name
											FROM
												tran_application
											INNER JOIN tran_ticket ON tran_application.app_typeno = tran_ticket.app_typeno
											INNER JOIN set_park ON tran_ticket.par_typeno = set_park.par_typeno
											INNER JOIN set_gate ON tran_ticket.gat_typeno = set_gate.gat_typeno
											WHERE 1=1 AND `status`=1 {$search}
											GROUP BY 
												tran_ticket.gat_typeno,
												tran_ticket.par_typeno 
											ORDER BY {$sort_field} {$search_type}")->result();

				$sum_all_amount = $this->db->query("SELECT
												sum(tran_ticket.price) as total_amount
											FROM
												tran_application
											INNER JOIN tran_ticket ON tran_application.app_typeno = tran_ticket.app_typeno
											WHERE 1=1 {$search}")->row()->total_amount; 
											
				
				if(COUNT($sql_query) > 0){
					$tr = '';
					$i = 1;
					$sum_qty_ticket = 0;
					$sum_amount = 0;
					$sum_rate = 0;
					$rate = 0;
					foreach($sql_query as $row){ 
						$rate = ($row->amount * 100 ) / $sum_all_amount-0;
						$sum_qty_ticket += $row->qty_ticket-0;
						$sum_amount += $row->amount-0;
						$sum_rate += $rate-0;
						
						$tr .='<tr> 
								<td>'.$i++.'</td>
								<td>'.$row->park_name.'</td>
								<td>'.$row->gat_name.'</td>
								<td>'.$row->qty_ticket.'</td>
								<td>'.$row->amount.'</td>
								<td>'.number_format($rate,1).'</td>
							</tr>';
					}
					$tr .='<tr>
							<td></td><td></td> 
							<td align="center" style="color:#337ab7; font-weight:bold;">Total</td>
							<td style="color:#337ab7; font-weight:bold;">'.$sum_qty_ticket.'</td>
							<td style="color:#337ab7; font-weight:bold;">'.number_format($sum_amount,4).'</td>
							<td style="color:#337ab7; font-weight:bold;">'.number_format($sum_rate).'</td>
						</tr>'; 
				}else{ 
					$tr ='<tr> 
							<td colspan="6" align="center"><i style="font-size:15px; color:red;">Result not data.</i></td>
						</tr><tr><td colspan="6"></td></tr>';
				}

			}else{ 

				$sql_query = $this->db->query("SELECT
												date(tran_application.create_date) as app_date
											FROM
												tran_application
											INNER JOIN tran_ticket ON tran_application.app_typeno = tran_ticket.app_typeno
											WHERE 1=1 AND `status`=1 {$search} 
											GROUP BY date(tran_application.create_date) ")->result();
				
			
				if(COUNT($sql_query) > 0){ 
					$tr = '';
					$i = 1;
					$g_qty_ticket = 0;
					$g_total_amount = 0;
					foreach($sql_query as $row){ 
						$tr .='<tr> 
								<td colspan="6" style="color:#337ab7; font-weight:bold;"><b>'.$i++.'</b> &nbsp; Date : '.$row->app_date.'</td>
							</tr>';



						$kkkk = "";

						$query = $this->db->query("SELECT
													
													tran_ticket.par_typeno,
													tran_ticket.gat_typeno,
													sum(tran_ticket.`status`) as qty_ticket,
													sum(tran_ticket.price) as amount,
													set_park.park_name,
													set_gate.gat_name
												FROM
													tran_ticket
												INNER JOIN set_gate ON tran_ticket.gat_typeno = set_gate.gat_typeno
												INNER JOIN set_park ON tran_ticket.par_typeno = set_park.par_typeno
												WHERE 1=1 AND `status`=1 AND date(tran_ticket.create_date) = '".$row->app_date."' {$search_d}
												GROUP BY tran_ticket.par_typeno,
														 tran_ticket.gat_typeno 
												ORDER BY {$sort_field} {$search_type}")->result();  
												

						$sql_amount = $this->db->query("SELECT
													sum(tran_ticket.price) as amount
												FROM
													tran_ticket 
												WHERE 1=1 AND `status`=1 AND date(create_date) = '".$row->app_date."' {$search_d}")->row()->amount;

						if(COUNT($query) > 0){ 
							$j = 1;
							$sum_qty_ticket = 0;
							$sum_amount = 0;
							$sum_rate = 0;
							$rate = 0;
							foreach($query as $row_data){
								$rate = ($row_data->amount * 100 ) / $sql_amount-0;
								$sum_qty_ticket += $row_data->qty_ticket-0;
								$sum_amount += $row_data->amount-0;
								$sum_rate += $rate-0;
								
								$tr .='<tr>
										<td align="center">'.$j++.'</td> 
										<td>'.$row_data->park_name.'</td>
										<td>'.$row_data->gat_name.'</td>
										<td>'.$row_data->qty_ticket.'</td>
										<td>'.$row_data->amount.'</td>
										<td>'.number_format($rate,1).'</td>
									</tr>';
							}

							$g_qty_ticket += $sum_qty_ticket-0;
							$g_total_amount += $sum_amount-0;
							$tr .='<tr>
									<td></td><td></td> 
									<td align="center" style="color:#337ab7; font-weight:bold;">Total</td>
									<td style="color:#337ab7; font-weight:bold;">'.$sum_qty_ticket.'</td>
									<td style="color:#337ab7; font-weight:bold;">'.number_format($sum_amount,4).'</td>
									<td style="color:#337ab7; font-weight:bold;">'.number_format($sum_rate).'</td>
								</tr>'; 
						}
					}

					$tr .='<tr>
							<td></td><td></td> 
							<td align="center" style="color:#337ab7; font-weight:bold; font-size:14px;">Grand Total </td>
							<td style="text-align:center; color:#337ab7; font-weight:bold; font-size:14px;" colspan="3">Quantity Ticket : '.$g_qty_ticket.' &nbsp; &nbsp; &nbsp; Amount : '.number_format($g_total_amount,4).'</td>
							
						</tr>'; 

				}else{ 
					$tr ='<tr> 
							<td colspan="6" align="center"><i style="font-size:15px; color:red;">Result not data.</i></td>
						</tr><tr><td colspan="6"></td></tr>';
				}
			}

			return json_encode($tr);
		}
	}

?>