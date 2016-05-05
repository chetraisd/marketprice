<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_report_comparison_turnstile extends CI_Controller{
	
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

	// get gate ========
	function get_gate(){
		$qr = $this->db->query("SELECT DISTINCT
										g.gat_typeno,
										g.gat_name
									FROM
										set_gate AS g
									ORDER BY
										g.gat_name ASC ");

		$opt = '<option></option>';			
		if($qr->num_rows() > 0){				
			foreach ($qr->result() as $row){
				$opt .= '<option value="'.$row->gat_typeno.'">'.$row->gat_name.'</option>';
			}
		}	

		return $opt;

		// $park_name = $this->input->post('park_name', TRUE);
		// $str_park_name = '';
		// if($park_name != ''){
		// 	foreach($park_name as $row){
		// 		$str_park_name .= '"'. $row['park_name'].'",';
		// 	}
		// }	
		// $str_park_name_r = rtrim($str_park_name, ',');

		// if($str_park_name_r != ''){
		// 	$qr = $this->db->query("SELECT
		// 											p.par_typeno,
		// 											p.park_name
		// 										FROM
		// 											set_park AS p
		// 										WHERE
		// 											p.par_typeno IN (
		// 												". $str_park_name_r ."
		// 											)
		// 										ORDER BY
		// 											p.park_name ASC ");

		// 	$optgroup = '';
		// 	$optgroup .= '<option></option>';			
		// 	if($qr->num_rows() > 0){				
		// 	   foreach ($qr->result() as $row){	
		// 	   	$optgroup .= '<optgroup label="'.$row->park_name.'">';   	
		// 	   	$qr_g = $this->db->query("SELECT
		// 														g.gat_typeno,
		// 														g.gat_name
		// 													FROM
		// 														set_gate AS g
		// 													WHERE
		// 														g.par_typeno = '{$row->par_typeno}'
		// 													ORDER BY
		// 														g.gat_name ASC ");
		// 			if($qr_g->num_rows() > 0){
		// 	   		foreach ($qr_g->result() as $row1){
		// 					$optgroup .= '<option value="'.$row1->gat_typeno.'">'.$row1->gat_name.'</option>';
		//    			}
	 //   			}	   	
		// 	   }
		// 	}
		// 	$optgroup .= '</optgroup>';
		// 	return ($optgroup);
		// }
	}

	// get turnstile ========
	function get_turnstile(){
		// $gat_name = $this->input->post('gat_name', TRUE);		
		$result = $this->db->query("SELECT
													c.cou_typeno,
													c.counter_name
												FROM
													set_counter AS c
												ORDER BY
													c.counter_name ASC ")->result();	
		return json_encode($result);
	}

	// show ​data =====
	function grid(){
		$where = '';
		$from_date = trim($this->input->post('from_date', TRUE));
		$to_date = trim($this->input->post('to_date', TRUE));

		$gat_name = trim($this->input->post('gat_name', TRUE));
		$counter_name = trim($this->input->post('counter_name', TRUE));
		$report_type = trim($this->input->post('report_type', TRUE)) - 0;

		$sort_by = trim($this->input->post('sort_by', TRUE));
		$sort_type = trim($this->input->post('sort_type', TRUE));
			
		if($from_date != ''){
			$where .= "AND DATE_FORMAT(tc.count_date, '%Y-%m-%d') >= '{$from_date}' ";				
		}

		if($to_date != ''){
			$where .= "AND DATE_FORMAT(tc.count_date, '%Y-%m-%d') <= '{$to_date}' ";				
		}			

		if($gat_name != ''){
			$where .= "AND tc.gat_typeno = '{$gat_name}' ";				
		}

		if($counter_name != ''){
			$where .= "AND c.cou_typeno = '{$counter_name}' ";				
		}

		$park_name = $this->input->post('park_name');
		$str_park_name = '';
		if($park_name != ''){
			foreach($park_name as $row){
				$str_park_name .= '"'. $row['park_name'].'",';
			}
			$str_park_name_r = rtrim($str_park_name, ',');
			$where .= "AND tc.par_typeno IN (
														". $str_park_name_r ."
													) ";
		}

		$where .= "AND tc.`status` = 1 ";

		$tr = "";
		if($report_type == 1){
			$qr = $this->db->query("SELECT
											tc.par_typeno,
											tc.gat_typeno,
											tc.cou_typeno,
											p.park_name,
											g.gat_name,
											c.counter_name,
											Sum(tc.qty) AS qty
										FROM
											tran_comparison AS tc
										LEFT JOIN set_park AS p ON tc.par_typeno = p.par_typeno
										LEFT JOIN set_gate AS g ON tc.gat_typeno = g.gat_typeno
										LEFT JOIN set_counter AS c ON tc.cou_typeno = c.cou_typeno
										WHERE
											1 = 1 {$where}
										GROUP BY
											tc.par_typeno,
											tc.gat_typeno 
										ORDER BY {$sort_by} {$sort_type} ");

		$i = 1;				
	   	$toal_ticket = 0;
	   	$toal_turnstile = 0;	
	   	$toal_avalide = 0;			

			if ($qr->num_rows() > 0){
			   foreach ($qr->result() as $row){
				$where_ticket = '';		   	
				$where_ticket .= "AND DATE_FORMAT(tt.validitydate, '%Y-%m-%d') >= '{$from_date}' ";				
				$where_ticket .= "AND DATE_FORMAT(tt.expirydate, '%Y-%m-%d') <= '{$to_date}' ";
				$where_ticket .= "AND tt.`status` = 1 ";

			   	$qr_c_ticket = $this->db->query("SELECT
														tt.gat_typeno,
														tt.par_typeno,
														SUM(tt.`status`) AS total_ticket
													FROM
														tran_ticket AS tt
													WHERE
														1 = 1 {$where_ticket}													
													GROUP BY
														tt.gat_typeno,
														tt.par_typeno ")->row()->total_ticket - 0;			   	
			   	
			   	$avalide = 0;
			   	$avalide += $qr_c_ticket - ($row->qty - 0);
			   	// total ======
			   	$toal_ticket += $qr_c_ticket;
			   	$toal_turnstile += $row->qty - 0;
			   	$toal_avalide += $qr_c_ticket - ($row->qty - 0);			   	

	   			$tr .= "<tr>".
			   					"<td>".$i++."</td>".
			   					"<td>".$row->park_name."</td>".
			   					"<td>".$row->gat_name."</td>".					   					
			   					"<td>".$row->counter_name."</td>".
			   					"<td style='text-align: right;'>".(number_format($qr_c_ticket,0,".",","))."</td>".
			   					"<td style='text-align: right;'>".(number_format($row->qty,0,".",","))."</td>".
			   					"<td style='text-align: right;'>".(number_format($avalide,0,".",","))."</td>".
		   					"</tr>";		   	
			   }
			   
			   $tr .= "<tr style='background: #F5F5F5;'>".
		   					"<td colspan='4' style='text-align: right;font-weight: bold;'>Total</td>".
		   					"<td style='text-align: right;font-weight: bold;'>".(number_format($toal_ticket,0,".",","))."</td>".
		   					"<td style='text-align: right;font-weight: bold;'>".(number_format($toal_turnstile,0,".",","))."</td>".
	   						"<td style='text-align: right;font-weight: bold;'>".(number_format($toal_avalide,0,".",","))."</td>".		   						
	   					"</tr>";
			}else{
				$tr .= "<tr style='background: #F5F5F5;'>". 
	                     "<td colspan='7' style='font-size: 14px;text-align: center;font-weight: bold;'>No Results</td>".
	                  "</tr>";
			}			
		}else{// detail =======
			$qr = $this->db->query("SELECT
											tc.par_typeno,
											tc.gat_typeno,
											tc.cou_typeno,
											p.park_name,
											g.gat_name,
											c.counter_name,
											tc.qty,
											tc.count_date
										FROM
											tran_comparison AS tc
										LEFT JOIN set_park AS p ON tc.par_typeno = p.par_typeno
										LEFT JOIN set_gate AS g ON tc.gat_typeno = g.gat_typeno
										LEFT JOIN set_counter AS c ON tc.cou_typeno = c.cou_typeno
										WHERE
											1 = 1 {$where}
										ORDER BY {$sort_by} {$sort_type} ");

			$i = 1;				
		   	$toal_ticket = 0;
		   	$toal_turnstile = 0;	
		   	$toal_avalide = 0;			

			if ($qr->num_rows() > 0){
			   foreach ($qr->result() as $row){
				$where_ticket = '';		   	
				$where_ticket .= "AND DATE_FORMAT(tt.validitydate, '%Y-%m-%d') >= '{$from_date}' ";				
				$where_ticket .= "AND DATE_FORMAT(tt.expirydate, '%Y-%m-%d') <= '{$to_date}' ";
				$where_ticket .= "AND tt.`status` = 1 ";

			   	$qr_c_ticket = $this->db->query("SELECT
														tt.gat_typeno,
														tt.par_typeno,
														tt.`status` AS total_ticket
													FROM
														tran_ticket AS tt
													WHERE
														1 = 1 {$where_ticket} ")->row()->total_ticket - 0;			   	
			   	
			   	$avalide = 0;
			   	$avalide += $qr_c_ticket - ($row->qty - 0);
			   	// total ======
			   	$toal_ticket += $qr_c_ticket;
			   	$toal_turnstile += $row->qty - 0;
			   	$toal_avalide += $qr_c_ticket - ($row->qty - 0);			   	

	   			$tr .= "<tr>".
			   					"<td>".$i++."</td>".
			   					"<td>".$row->count_date."</td>".
			   					"<td>".$row->park_name."</td>".
			   					"<td>".$row->gat_name."</td>".					   					
			   					"<td>".$row->counter_name."</td>".
			   					"<td style='text-align: right;'>".(number_format($qr_c_ticket,0,".",","))."</td>".
			   					"<td style='text-align: right;'>".(number_format($row->qty,0,".",","))."</td>".
			   					"<td style='text-align: right;'>".(number_format($avalide,0,".",","))."</td>".
		   					"</tr>";		   	
			   }
			   
			   $tr .= "<tr style='background: #F5F5F5;'>".
		   					"<td colspan='5' style='text-align: right;font-weight: bold;'>Total</td>".
		   					"<td style='text-align: right;font-weight: bold;'>".(number_format($toal_ticket,0,".",","))."</td>".
		   					"<td style='text-align: right;font-weight: bold;'>".(number_format($toal_turnstile,0,".",","))."</td>".
	   						"<td style='text-align: right;font-weight: bold;'>".(number_format($toal_avalide,0,".",","))."</td>".		   						
	   					"</tr>";
			}else{
				$tr .= "<tr style='background: #F5F5F5;'>". 
	                     "<td colspan='8' style='font-size: 14px;text-align: center;font-weight: bold;'>No Results</td>".
	                  "</tr>";
			}
		}

		return $tr;
	}
	
}