<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_report_detail extends CI_Controller{
	function __construct(){
		parent::__construct();
		
	}
	function mservice(){
		$desease = $this->input->post("desease_type");
		$sql_service = $this->db->query("SELECT service_code,service_name FROM tbl_service_type WHERE disease_code='".$desease."'")->result();
		$opt_service = "<option value=''></option>";
		foreach($sql_service as $row_service){
			$opt_service.='<option value="'.$row_service->service_code.'">'.$row_service->service_name.'</option>';
		}
		return $opt_service;
	}
	
	function mshow(){
		
		$cust_code    = $this->input->post("cust_code");
		$disease_code = $this->input->post("disease_code");
		$invoice_number = $this->input->post("invoice_number");
		$serviceType = $this->input->post("serviceType");
		$from_date = $this->input->post("from_date");
		$to_date = $this->input->post("to_date");
		$where = "";
		if($cust_code != ""){
			$where.= " AND in_ord.customercode = '".$cust_code."'";
		}
		if($disease_code != ""){
			$where.= " AND in_ord.disease_code = '".$disease_code."'";
		}
		if($invoice_number != ""){
			$where.= " AND in_ord.invoice = '".$invoice_number."'";
		}
		$wh_service = "";
		if($serviceType != ""){
			$wh_service.= " AND service_code = '".$serviceType."'";
		}
		
		if($from_date != ""){
			$arr_fdate  = explode("/",$from_date);
			$fdate  = date('Y-m-d',strtotime($arr_fdate[2].'-'.$arr_fdate[1].'-'.$arr_fdate[0]));
			$where.= " AND in_ord.date_inv >= '".$fdate."'";
		}
		if($to_date != ""){
			$arr_tdate  = explode("/",$to_date);
			$todate  = date('Y-m-d',strtotime($arr_tdate[2].'-'.$arr_tdate[1].'-'.$arr_tdate[0]));
			$where.= " AND in_ord.date_inv <= '".$todate."'";
		}
		
		$result = $this->db->query("SELECT
									in_ord.id,
									in_ord.customercode,
									in_ord.date_inv,
									in_ord.invoice,
									in_ord.disease_code,
									in_ord.amount,
									in_ord.note,
									in_ord.type,
									in_ord.typeno,
									in_ord.currcode
									FROM
									tbl_invoice_order AS in_ord
									INNER JOIN tbl_invoice_detail AS in_det ON in_ord.typeno = in_det.typeno AND in_ord.type = in_det.type
									WHERE 1=1 {$where} {$wh_service} GROUP BY in_ord.typeno");
		
		$tr = "";
		$grand_total = 0;
		$show_currency = "";
		if($result->num_rows() > 0){
			$i =1;
			foreach($result->result() as $row){
				$show_currency = $this->db->query("SELECT symbol FROM currencies WHERE curcode='".$row->currcode."'")->row();
				$tr.=   "<tr>
							<td colspan='7'>
								<span><b>".$i.".</b>&nbsp;</span>
								<span>".$this->lang->line("invoice_number")."&nbsp;:&nbsp;<b><a href='".site_url("report/c_report_print")."?type=".$row->type."&typeno=".$row->typeno."' target='_blank' class='remove_inv'>".$row->invoice."</a></b></span>
							</td>
					      	<td style='text-align:center;' class='remove_tag'>
								<a href='javascript:void(0)' id='a_delete' att_type='".$row->type."' att_typeno='".$row->typeno."'><img rel='2510' src='".base_url()."/assets/images/icons/delete.png'></a>&nbsp;&nbsp;
			  					<a href='".site_url("invoice/c_invoice")."?type=".$row->type."&typeno=".$row->typeno."' target='_blank' id='a_edite'>
									<img rel='2510' width='15' height='15' src='".base_url()."/assets/images/icons/edit.png'>
								</a>
							</td>
				        </tr>";

				
				$result_detail = $this->db->query("SELECT
														tbl_invoice_detail.id,
														tbl_invoice_detail.customercode,
														DATE_FORMAT(tbl_invoice_detail.date,'%d-%m-%Y') as new_date,
														tbl_invoice_detail.invoice,
														tbl_invoice_detail.disease_code,
														tbl_invoice_detail.service_code,
														tbl_invoice_detail.quantity,
														tbl_invoice_detail.amount,
														tbl_invoice_detail.type,
														tbl_invoice_detail.typeno,
														tbl_invoice_detail.row_index,
														tbl_invoice_detail.currcode
														FROM
														tbl_invoice_detail
														WHERE 1=1 {$wh_service}
														AND type   = '".$row->type."'
														AND typeno = '".$row->typeno."' 
														AND invoice= '".$row->invoice."'");
				$sum_detail = 0;
				if($result_detail->num_rows() > 0){
					$n = 1;
					foreach($result_detail->result() as $row_detail){ 
						$serviceType = $this->db->query("SELECT service_name FROM tbl_service_type WHERE service_code='".$row_detail->service_code."'")->row();
						$customer    = $this->db->query("SELECT customername FROM tbl_customer WHERE customercode='".$row_detail->customercode."'")->row();
						$diseaseType = $this->db->query("SELECT disease_name FROM tbl_disease_type WHERE disease_code='".$row_detail->disease_code."'")->row();
						
						$tr.="<tr>
									<td style='text-align:right;'>".$n++."</td>
									<td>".(isset($customer->customername)?$customer->customername:" ")."</td>
									<td style='text-align:center;'>".$row_detail->new_date."</td>
									<td>".(isset($diseaseType->disease_name)?$diseaseType->disease_name:" ")."</td>
									<td>".(isset($serviceType->service_name)?$serviceType->service_name:" ")."</td>
									<td style='text-align:right;'>".$row_detail->quantity."</td>
									<td style='text-align:right;'>".$row_detail->amount."&nbsp;&nbsp;".$show_currency->symbol."</td>
									<td class='remove_tag'>&nbsp</td>
							  </tr>";
						$sum_detail+= $row_detail->amount;	  
					}
					
				}
				$grand_total+= $sum_detail;
				$tr.= "<tr><td style='text-align:right;' colspan='6'>".$this->lang->line("total")."</b></td><td style='text-align:right;'><b>".$sum_detail."&nbsp;&nbsp;".$show_currency->symbol."</b></td><td class='remove_tag'>&nbsp;</td></tr>";
				$i++;
			}
			if($i == 1){
				$tr.= "<tr><td colspan='8'>".$this->lang->line("no_data")."</td></tr>";
			}else{
				$tr.= "<tr><td style='text-align:right;' colspan='6'><b>".$this->lang->line("grand_total")."</b></td><td style='text-align:right;'><b>".$grand_total."&nbsp;&nbsp;".$show_currency->symbol."</b></td><td class='remove_tag'>&nbsp;</td></tr>";
			}
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