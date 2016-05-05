<?php 
	Class M_comparision_by_user extends CI_Model{ 
		public function __construct(){ 
			parent:: __construct();
		}
		
		function show(){ 
			$from_date = $this->input->post("from_date");
			$to_date   = $this->input->post("to_date");
			$report_type = $this->input->post("report_type");
			$by_park   = $this->input->post("by_park");
			$by_gate   = $this->input->post("by_gate");
			$sort_type = $this->input->post("sort_type");
			$search_user = $this->input->post("search_user");
			$sort_by   = $this->input->post("sort_by");

			$search = '';
			$search_d = '';
			$todate = $this->green->convertSQLDate($to_date);
			$fromdate =$this->green->convertSQLDate($from_date);
			
			if($from_date !=''){ 
				$search .=" AND date(tran_application.create_date) >= '".$fromdate."'"; 
			}
			if($to_date !=''){ 
				$search .=" AND date(tran_application.create_date) <= '".$todate."'";
			}
			if($by_park !=''){ 
				$park = '';
				foreach($by_park as $arr_park){ 
					$park .= "'".$arr_park."',";
				}
				$val_park = $park."''";
				$search .=" AND tran_ticket.par_typeno IN (".$val_park.")";
				$search_d .=" AND tran_ticket.par_typeno IN (".$val_park.")";
			}
			if($by_gate !=''){ 
				$search .=" AND tran_ticket.gat_typeno = '".$by_gate."'";
				$search_d .=" AND tran_ticket.gat_typeno = '".$by_gate."'";
			}
			if($search_user !=''){ 
				$search .=" AND tran_application.create_by = '".$search_user."'";
				$search_d .=" AND tran_application.create_by = '".$search_user."'";
			}

			if($report_type == 0){

				$sql_query = $this->db->query("SELECT
												tran_ticket.gat_typeno,
												Sum(tran_ticket.`status`) AS qty_ticket,
												Sum(tran_ticket.price) AS amount,
												set_park.park_name,
												set_gate.gat_name,
												tran_application.create_by,
												sch_user.user_name
											FROM
												tran_application
											INNER JOIN tran_ticket ON tran_application.app_typeno = tran_ticket.app_typeno
											INNER JOIN set_park ON tran_ticket.par_typeno = set_park.par_typeno
											INNER JOIN set_gate ON tran_ticket.gat_typeno = set_gate.gat_typeno
											INNER JOIN sch_user ON tran_application.create_by = sch_user.userid
											WHERE 1=1 {$search}
											GROUP BY 
												tran_application.create_by,
												tran_ticket.par_typeno,
												tran_ticket.gat_typeno 
											ORDER BY {$sort_by} {$sort_type}")->result();

				$query_amount = $this->db->query("SELECT
												Sum(tran_ticket.price) As amount
											FROM
												tran_application
											INNER JOIN tran_ticket ON tran_application.app_typeno = tran_ticket.app_typeno
											WHERE 1=1 {$search}")->row()->amount;
				if(COUNT($sql_query) > 0){ 
					$i = 1;
					$tr = '';
					$rate = '';
					$sum_qty_ticket = 0;
					$sum_amount = 0;
					$sum_rate = 0;
					foreach($sql_query as $row_data){
						$rate = ($row_data->amount * 100) / $query_amount-0;
						$sum_qty_ticket += $row_data->qty_ticket-0;
						$sum_amount += $row_data->amount-0;
						$sum_rate += $rate-0;

						$tr .='<tr> 
								<td>'.$i++.'</td>
								<td>'.$row_data->park_name.'</td>
								<td>'.$row_data->gat_name.'</td>
								<td>'.$row_data->user_name.'</td>
								<td>'.$row_data->qty_ticket.'</td>
								<td>'.$row_data->amount.'</td>
								<td>'.number_format($rate,1).'</td>
							</tr>';	
					}
					$tr .='<tr> 
							<td></td><td></td><td></td>
							<td style="color:#337ab7; font-weight:bold;">Total : </td>
							<td style="color:#337ab7; font-weight:bold;">'.$sum_qty_ticket.'</td>
							<td style="color:#337ab7; font-weight:bold;">'.number_format($sum_amount,4).'</td>
							<td style="color:#337ab7; font-weight:bold;">'.$sum_rate.'</td>
						</tr>';	
				}else{ 
					$tr ='<tr> 
							<td colspan="7" align="center"><i style="font-size:15px; color:red;">Result not data.</i></td>
						</tr><tr><td colspan="7"></td></tr>';
				}
				
			}else{ 

				$sql_query = $this->db->query("SELECT
												date(tran_application.create_date) as app_date
											FROM
												tran_application
											INNER JOIN tran_ticket ON tran_application.app_typeno = tran_ticket.app_typeno
											WHERE 1=1 {$search} 
											GROUP BY date(tran_application.create_date) ")->result();
				if(COUNT($sql_query) > 0){ 
					$tr = '';
					$i = 1;
					$g_qty_ticket = 0;
					$g_amount = 0;
					foreach($sql_query as $row){ 
						$tr .='<tr> 
								<td colspan="7" style="color:#337ab7; font-weight:bold;">'.$i++.' &nbsp; Date : '.$row->app_date.'</td>
							</tr>';
						$query = $this->db->query("SELECT
													tran_ticket.par_typeno,
													tran_ticket.gat_typeno,
													Sum(tran_ticket.`status`) AS qty_ticket,
													Sum(tran_ticket.price) AS amount,
													tran_ticket.create_by,
													sch_user.user_name,
													set_gate.gat_name,
													set_park.park_name
												FROM
													tran_ticket
													INNER JOIN sch_user ON tran_ticket.create_by = sch_user.userid
													INNER JOIN set_gate ON tran_ticket.gat_typeno = set_gate.gat_typeno
													INNER JOIN set_park ON tran_ticket.par_typeno = set_park.par_typeno
													WHERE 1=1 AND tran_ticket.`status` = 1 AND date(tran_ticket.create_date) = '".$row->app_date."' {$search_d}
												GROUP BY
													tran_ticket.create_by,
													tran_ticket.par_typeno,
													tran_ticket.gat_typeno 
												ORDER BY {$sort_by} {$sort_type}")->result();

						$query_amount = $this->db->query("SELECT Sum(tran_ticket.price) AS amount 
															FROM tran_ticket 
															WHERE 1=1 AND tran_ticket.`status` = 1 AND date(tran_ticket.create_date) = '".$row->app_date."' {$search_d}")->row()->amount;
													
						if(COUNT($query) > 0){ 

							
							$j = 1;
							$rate = 0;
							$sum_rate = 0;
							$sum_amount = 0;
							$sum_qty_ticket = 0;
							foreach($query as $row_data){
								$rate = ($row_data->amount * 100) / $query_amount -0;
								$sum_qty_ticket += $row_data->qty_ticket-0;
								$sum_amount += $row_data->amount-0; 
								$sum_rate += $rate-0;
								
								$tr .='<tr> 
										<td align="center">'.$j++.'</td>
										<td>'.$row_data->park_name.'</td>
										<td>'.$row_data->gat_name.'</td>
										<td>'.$row_data->user_name.'</td>
										<td>'.$row_data->qty_ticket.'</td>
										<td>'.$row_data->amount.'</td>
										<td>'.number_format($rate,1).'</td>
									</tr>';
							}

							$g_qty_ticket += $sum_qty_ticket-0;
							$g_amount += $sum_amount-0;
							
							$tr .='<tr> 
									<td></td><td></td><td></td>
									<td style="color:#337ab7; font-weight:bold;">Total : </td>
									<td style="color:#337ab7; font-weight:bold;">'.$sum_qty_ticket.'</td>
									<td style="color:#337ab7; font-weight:bold;">'.number_format($sum_amount,4).'</td>
									<td style="color:#337ab7; font-weight:bold;">'.$sum_rate.'</td>
								</tr>';	
						}
					}

					$tr .='<tr>
							<td></td><td></td><td></td> 
							<td align="center" style="color:#337ab7; font-weight:bold; font-size:14px;">Grand Total </td>
							<td style="text-align:center; color:#337ab7; font-weight:bold; font-size:14px;" colspan="3">Quantity Ticket : '.$g_qty_ticket.' &nbsp; &nbsp; &nbsp; Amount : '.number_format($g_amount,4).'</td>
							
						</tr>';
				}else{ 
					$tr ='<tr> 
							<td colspan="7" align="center"><i style="font-size:15px; color:red;">Result not data.</i></td>
						</tr><tr><td colspan="7"></td></tr>';
				}
			}

			return json_encode($tr);
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

		function select_user(){ 
			$sql = $this->db->query("SELECT
										sch_user.user_name,
										sch_user.userid
									FROM
										sch_user")->result();
			if(COUNT($sql) > 0){
				$option = "<option></option>";
				foreach($sql as $row){ 
					$option .='<option value="'.$row->userid.'">'.$row->user_name.'</option>';
				}
				return $option;
			}
		}

	}
?>