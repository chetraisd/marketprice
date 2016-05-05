<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class m_report_summary extends CI_Controller{
	function __construct(){
		parent::__construct();
	}
	
	function mshow(){
		$cust_code    = $this->input->post("cust_code");
		$disease_code = $this->input->post("disease_code");
		$from_date    = $this->input->post("from_date");
		$to_date      = $this->input->post("to_date");
		$where = "";
		if($cust_code != ""){
			$where.= " AND tbl_customer.customername LIKE '".$cust_code."%'";
		}
		if($disease_code != ""){
			$where.= " AND tbl_invoice_order.disease_code = '".$disease_code."'";
		}
		
		if($from_date != ""){
			$arr_fdate  = explode("/",$from_date);
			$fdate  = date('Y-m-d',strtotime($arr_fdate[2].'-'.$arr_fdate[1].'-'.$arr_fdate[0]));
			$where.= " AND tbl_invoice_order.date_inv >= '".$fdate."'";
		}
		if($to_date != ""){
			$arr_tdate  = explode("/",$to_date);
			$todate  = date('Y-m-d',strtotime($arr_tdate[2].'-'.$arr_tdate[1].'-'.$arr_tdate[0]));
			$where.= " AND tbl_invoice_order.date_inv <= '".$todate."'";
		}
		
		$result = $this->db->query("SELECT
									tbl_invoice_order.id,
									tbl_invoice_order.customercode,
									DATE_FORMAT(date_inv,'%d-%m-%Y') AS showDate,
									tbl_invoice_order.invoice,
									tbl_invoice_order.disease_code,
									tbl_invoice_order.amount,
									tbl_invoice_order.note,
									tbl_invoice_order.type,
									tbl_invoice_order.typeno,
									tbl_invoice_order.currcode,
									tbl_customer.customername,
									tbl_disease_type.disease_name
									FROM
									tbl_invoice_order
									INNER JOIN tbl_customer ON tbl_invoice_order.customercode = tbl_customer.customercode
									INNER JOIN tbl_disease_type ON tbl_invoice_order.disease_code = tbl_disease_type.disease_code


									WHERE 1=1 {$where}");
		
		$tr = "";
		$sum = 0;
		if($result->num_rows() > 0){
			$i =1;
			$currency = "";
			foreach($result->result() as $row){
				//$customer    = $this->db->query("SELECT customername FROM tbl_customer WHERE customercode='".$row->customercode."'")->row();
				//$diseaseType = $this->db->query("SELECT disease_name FROM tbl_disease_type WHERE disease_code='".$row->disease_code."'")->row();
				$show_currency = $this->db->query("SELECT symbol FROM currencies WHERE curcode='".$row->currcode."'")->row();
				$tr.="<tr>
						<td>".$i."
							<input type='hidden' name='type' id='type' class='type' value='".$row->type."'>
							<input type='hidden' name='typeno' id='typeno' class='typeno' value='".$row->typeno."'>
						</td>
						<td>".$row->customername."</td>
						<td>".$row->showDate."</td>
						<td><a href='".site_url("report/c_report_print")."?type=".$row->type."&typeno=".$row->typeno."' target='_blank'  class='remove_inv'>".$row->invoice."</a></td>
						<td>".$row->disease_name."</td>
						<td style='text-align:right;'>".$row->amount."&nbsp;&nbsp;".$show_currency->symbol."</td>
						<td style='text-align:center' class='remove_tag'>
							<a href='javascript:void(0)' delete='".$row->typeno."' id='a_delete'><img rel='2510' src='".base_url()."/assets/images/icons/delete.png'></a>&nbsp;&nbsp;
					  		<a href='".site_url("invoice/c_invoice")."?type=".$row->type."&typeno=".$row->typeno."' target='_blank' id='a_edite'><img rel='2510' width='15' height='15' src='".base_url()."/assets/images/icons/edit.png'></a>
						</td>
					  </tr>";
				$i++;
				//$currency= $row->currcode;
				$sum+= $row->amount;
			}
			$tr.='<tr><td colspan="5" style="text-align:right;"><b>'.$this->lang->line("total").'</b></td><td style="text-align:right;"><b>'.$sum.'&nbsp;&nbsp;'.$show_currency->symbol.'</b></td><td>&nbsp;</td></tr>';
		}
		if($tr == ""){
			$tr.= "<tr><td colspan='7' style='text-align:center;'><b>".$this->lang->line("no_data")."</b></td></tr>";
		}
		return $tr;
	}
	function mautoCust($key){
		$this->db->like('customername',$key);
		return $this->db->get('tbl_customer')->result();
	}

	function delete_report($typeno){
		$this->db->delete('tbl_invoice_detail','typeno = '.$typeno.'');
		$this->db->delete('tbl_invoice_order','typeno = '.$typeno.'');
	}
	
}