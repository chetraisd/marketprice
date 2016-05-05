<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_report_compar extends CI_Controller{
	function __construct(){
		parent::__construct();
		
	}
	function mnatoinal(){
		$country = $this->input->post("country");
		$valcon = $this->db->query("SELECT nationality FROM countries WHERE id_countries='".$country."'")->row();
			$opt_national=$valcon->nationality;
		return $opt_national;
	}
	
	function mshowcountry(){
		$selectpark = $this->input->post("park");			
		$country = $this->input->post("country");
		$nationality = $this->input->post("nationality");
		$report_type = $this->input->post("report_type"); 
		$sort_by = $this->input->post("sort_by");
		$sort_type = $this->input->post("sort_type");
		$from_date = $this->input->post("from_date");
		$to_date = $this->input->post("to_date");

		$where = "";
		if($country != ""){
			$where.= " AND app.country = '".$country."'";
		}
		if($nationality != ""){
			$where.= " AND app.nationality = '".$nationality."'";
		}
		$wherePark ="";
		if($selectpark != ""){
			$userpark ="";
			foreach ($selectpark AS $park){
					$userpark .= "'".$park."',";
			}
			$val_park = $userpark."''";
			$wherePark = " AND tick.par_typeno IN (".$val_park.")";
		}
		
		if($from_date != ""){
			$fdate  = $this->green->convertSQLDate($from_date);

			//$arr_fdate  = explode("-",$from_date);
			//$fdate  = date('Y-m-d',strtotime($arr_fdate[2].'-'.$arr_fdate[1].'-'.$arr_fdate[0]));
			//$fdate  = date('Y-m-d',$from_date);
			$where.= " AND date(app.create_date) >= '".$fdate."'";
		}
		if($to_date != ""){
			$todate  = $this->green->convertSQLDate($to_date);
			//$arr_tdate  = explode("-",$to_date);
			//$todate  = date('Y-m-d',strtotime($arr_tdate[2].'-'.$arr_tdate[1].'-'.$arr_tdate[0]));
			//$todate  = date('Y-m-d',$to_date);
			$where.= " AND date(app.create_date) <= '".$todate."'";
		}
				
		if($sort_by != ""){
			$ORDER = " ORDER BY app.".$sort_by." ".$sort_type;
		}
		$result = $this->db->query("SELECT
										app.country,
										app.nationality,
										tick.cur_typeno,
										SUM(tick.`status`) AS qty_ticket,
										SUM(IFNULL(tick.price,0)) AS amount
									FROM
										tran_application AS app
									INNER JOIN tran_ticket AS tick ON app.app_typeno = tick.app_typeno
									WHERE 1=1  AND tick.`status`=1 {$where} {$wherePark}
									GROUP BY
										app.country,
										app.nationality,
										tick.cur_typeno
									{$ORDER} ");
													
				$tr = "";
				$show_currency = "";
				$sum_summary = 0;				
				$n = 1;
		if($report_type==1){				
				//$Grand_amount = $this->green->getValue("SELECT sum");
				foreach($result->result() as $row_summary){ 
					$show_currency = $this->green->getValue("SELECT set_currencies.symbol FROM set_currencies WHERE set_currencies.cur_typeno='".$row_summary->cur_typeno."'");
					$show_country = $this->green->getValue("SELECT countries.`name` FROM countries WHERE countries.id_countries='".$row_summary->country."'");
					
					$total_rate = $this->green->getValue("SELECT
															SUM(IFNULL(tick.price,0)) AS amount 
														  FROM
																tran_application AS app
														  INNER JOIN tran_ticket AS tick ON app.app_typeno = tick.app_typeno 
														  WHERE 1=1 AND tick.`status`=1 AND tick.par_typeno ='".$row_park."' {$where} 
														  GROUP BY  tick.par_typeno ");
					
					$rate =0;
					$tr.="<tr>
								<td style='text-align:right;'>".$n++."</td>
								<td>".$show_country."</td>
								<td style='text-align:center;'>".$row_summary->qty_ticket."</td>
								<td>".$row_summary->amount."&nbsp;&nbsp;".$show_currency."</td>
								<td style='text-align:right;'>".$rate."</td>
						  </tr>";
					$sum_summary += $row_summary->amount;	  
				}

			if($n == 1){
				$tr.= "<tr><td colspan='5'>".$this->lang->line("no_data")."</td></tr>";
			}else{
				$tr.= "<tr><td style='text-align:right;' colspan='4'><b>".$this->lang->line("total")."</b></td><td style='text-align:right;'><b>".$sum_summary."&nbsp;&nbsp;".$show_currency."</b></td></tr>";
			}
				
		}else{
			$j =1;
			$Grand_sum =0;
			$total_rate = 0;
			if($selectpark != ""){
				foreach ($selectpark AS $row_park){
					$parkname="";
					$wpark="";
					if($row_park != ""){
						$wpark = " AND tick.par_typeno ='".$row_park."'";
						$parkname = $this->green->getValue("SELECT park_name FROM set_park WHERE par_typeno='".$row_park."'");
					}
					$result = $this->db->query("SELECT
											app.country,
											app.nationality,
											tick.par_typeno,
											tick.cur_typeno,
											SUM(tick.`status`) AS qty_ticket,
											SUM(IFNULL(tick.price,0)) AS amount
										FROM
											tran_application AS app
										INNER JOIN tran_ticket AS tick ON app.app_typeno = tick.app_typeno
										WHERE 1=1 AND tick.`status`=1 {$where} {$wpark}
										GROUP BY
											app.country,
											app.nationality,
											tick.cur_typeno
										{$ORDER} ")->result();
					if(count($result) >0){	

						$tr.='<tr>
									<td style="text-align:left;"><b>'.$this->lang->line("park").':</b></td>
									<td colspan="4" style="text-align:left;"><b>'.$parkname.'</b></td>							
							  </tr>';

						$rate =0;
						$sum_summary =0;

						$total_rate = $this->green->getValue("SELECT
																SUM(IFNULL(tick.price,0)) AS amount 
															  FROM
																	tran_application AS app
															  INNER JOIN tran_ticket AS tick ON app.app_typeno = tick.app_typeno 
															  WHERE 1=1 AND tick.`status`=1 AND tick.par_typeno ='".$row_park."' {$where} 
															  GROUP BY  tick.par_typeno ");
						
						foreach($result as $row_summary){ 
							$show_currency = $this->green->getValue("SELECT set_currencies.symbol FROM set_currencies WHERE set_currencies.cur_typeno='".$row_summary->cur_typeno."'");
							$show_country = $this->green->getValue("SELECT countries.`name` FROM countries WHERE countries.id_countries='".$row_summary->country."'");
							$amount = $row_summary->amount;
							$sum_summary += $row_summary->amount;
							$rate = ($amount * 100)/$total_rate;
							$tr.='<tr>
										<td style="text-align:right;">'.$n++.'</td>
										<td>'.$show_country.'</td>
										<td style="text-align:center;">'.$row_summary->qty_ticket.'</td>
										<td>'.$amount.'&nbsp;&nbsp;'.$show_currency.'</td>
										<td style="text-align:right;">'.$rate.'</td>
								  </tr>';
								  
						}///foreach($result->result() as $row_summary){ 
						$tr.='<tr>
									<td colspan="3" style="text-align:right;"><b>'.$this->lang->line("total").'</b></td>
									<td style="text-align:left;"><b>'.$sum_summary.'&nbsp;'.$show_currency.'</b></td>	
									<td style="text-align:left;"><b>100</b></td>						
							  </tr>';	
						$Grand_sum +=$sum_summary;	
					}///if($result>0){
				}	////foreach ($selectpark AS $park){
			}
			$tr.='<tr>
						<td colspan="3" style="text-align:left;"><label class="control-label">'.$this->lang->line("Grand Total").'</label></td>
						<td style="text-align:left;"><b>'.$Grand_sum.'&nbsp;'.$show_currency.'</b></td>	
						<td style="text-align:left;"><b></b></td>						
				</tr>';	
		}
		return $tr;
	}
	
	function mautoCust($key){
		// $select_cust = $this->db->query("SELECT customercode,customername FROM tbl_customer")->result();
		// $option_cust = '<option value=""></option>';
		// foreach($select_cust as $row){
		// 	$option_cust.='<option value="'.$row->customercode.'">'.$row->customername.'</option>';
		// }
		// return $option_cust;
		$this->db->like('customername',$key);
		return $this->db->get('tbl_customer')->result();
	}

	function mdelete_inv(){
		$type   = $this->input->post("type");
     	$typeno = $this->input->post("typeno");
     	$table  = array('tbl_invoice_order','tbl_invoice_detail');
     	$this->db->where('type',$type);
     	$this->db->where('typeno',$typeno);
     	$this->db->delete($table);
        return "complete";
	}	
}