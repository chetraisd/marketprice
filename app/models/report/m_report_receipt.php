<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_report_receipt extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
	}

	// get park ========
	

	// get gate ========
	function get_gate(){		
		$result = $this->db->query("SELECT DISTINCT
											g.gat_typeno,
											g.gat_name
										FROM
											tran_ticket AS tt
										LEFT JOIN set_gate AS g ON tt.gat_typeno = g.gat_typeno
										ORDER BY
											g.gat_name ASC ")->result();	
		return json_encode($result);
	}

	// show ​data =====
	function grid(){
		$where = '';

		$from_date = trim($this->input->post('from_date', TRUE));
		$c_from_date = $this->green->convertSQLDate($from_date);

		$to_date = trim($this->input->post('to_date', TRUE));
		$c_to_date = $this->green->convertSQLDate($to_date);

		$receipt_no = trim($this->input->post('receipt_no', TRUE));
		$report_type = trim($this->input->post('report_type', TRUE)) - 0;		
		$sort_by = trim($this->input->post('sort_by', TRUE));
		$sort_type = trim($this->input->post('sort_type', TRUE));	
		$ticket_type = trim($this->input->post('ticket_type', TRUE));

		if($c_from_date != '' && $c_to_date != ''){
			$where .= "AND date(rp.create_date) >= '".$c_from_date."' AND date(rp.create_date) <= '".$c_to_date."' ";				
		}

		if($receipt_no != ''){
			$where .= "AND rp.reciept_typeno = '".$receipt_no."' ";				
		}

		if($ticket_type == 'all'){
			$where .= "AND 1=1 ";				
		}else{
			$where .= "AND rp.is_agency = '".$ticket_type."' ";

		}
				
		$tr = '';	
		$i = 1;	

		// detail =====
		if($report_type == 1){
			$qr = $this->db->query("SELECT
									rp.reciept_type,
									rp.reciept_typeno,
									rp.create_date,
									rp.create_by,
									rp.app_type,
									rp.app_typeno,
									rp.pay_amount,
									rp.cur_type,
									rp.cur_typeno,
									rp.pay_type,
									rp.pay_typeno,
									rp.`status`,
									rp.exchange_rate,
									rp.discount,
									rp.is_agency
								FROM
									tran_reciept_payment AS rp
								WHERE
									1 = 1 {$where}
								ORDER BY
									{$sort_by} {$sort_type} ");

			// currency symbol ========
			$sym_cur = $this->db->query("SELECT
													cu.symbol
												FROM
													set_currencies AS cu
												WHERE
													cu.cur_default = '1' ")->row()->symbol;
			
			if($qr->num_rows() > 0){				
				$total = 0;
				foreach ($qr->result() as $row) {
					$total_amt = 0;

					$amt = $row->pay_amount - 0;
					$discount = $row->discount - 0;
					$total_amt += ($amt - 0) + ($discount - 0);
					$total += $total_amt - 0;
					// .($amt - 0 > 0 ? number_format($amt - 0,2,".",",") : '0.00')."&nbsp;".$sym_cur.

					$tr .= "<tr>".
			   					"<td>".$i++."</td>".
			   					"<td>".($row->create_date != '' ? $this->green->gdate_format($row->create_date, 0) : '')."</td>".
			   					"<td>".($row->reciept_typeno != null ? $row->reciept_typeno : '')."</td>".
			   					"<td>".($row->is_agency == '0' ? 'Individual' : 'Group Tour')."</td>".
			   					"<td style='text-align: right;'>".($amt - 0 > 0 ? number_format($amt - 0,2,".",",") : '0.00')."&nbsp;".$sym_cur."</td>".
			   					"<td style='text-align: right;'>".($discount - 0 > 0 ? number_format($discount - 0,2,".",",") : '0.00')."&nbsp;".$sym_cur."</td>".
			   					"<td style='text-align: right;'>".($total_amt - 0 > 0 ? number_format($total_amt - 0,2,".",",") : '0.00')."&nbsp;".$sym_cur."</td>".			   					
			   				"</tr>";
   				}

   				$tr .= "<tr style='background: #F5F5F5;font-weight: bold;'>".
			   					"<td colspan='6' style='text-align: right;'>Total</td>".
			   					"<td style='text-align: right;'>".($total - 0 > 0 ? number_format($total - 0,2,".",",") : '0.00')."&nbsp;".$sym_cur."</td>".
			   				"</tr>";
			}else{
				$tr .= "<tr style='background: #F5F5F5;font-weight: bold;'>".
		   					"<td colspan='7' style='text-align: center;font-size: 14px;'>No Results</td>".
		   				"</tr>";
			}
		}else{// summary =====
			$amt = 10;
			$tr .= "<tr>".
	   					"<td>1</td>".
	   					"<td>2</td>".
	   					"<td style='text-align: right;'>".number_format(10,4,".",",")."</td>".
	   					"<td style='text-align: right;'>".number_format(10,4,".",",")."</td>".
	   				"</tr>";
		
			$tr .= "<tr style='background: #F5F5F5;font-weight: bold;'>".
	   					"<td colspan='3' style='text-align: right;'>Total</td>".
	   					"<td style='text-align: right;'>".number_format($amt,4,".",",")."</td>".   						
	   				"</tr>";
		}
		
		return $tr;
	}

}



