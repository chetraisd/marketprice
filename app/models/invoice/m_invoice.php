<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_invoice extends CI_Controller{
	function __construct(){
		parent::__construct();
	}
	
	function mdiseasetype(){
		$diseasetype = $this->input->post("diseasetype");
		$select = $this->db->query("SELECT
									tbl_service_type.id,
									tbl_service_type.service_code,
									tbl_service_type.service_name,
									tbl_service_type.disease_code,
									tbl_service_type.note,
									tbl_service_type.price
									FROM
									tbl_service_type
									WHERE disease_code = '".$diseasetype."'")->result();
		$opt_service = '<option value=""></option>';
		foreach($select as $row){ 
			$opt_service.= '<option value="'.$row->service_code.'" att_price="'.$row->price.'">'.$row->service_name.'</option>';
		}
		return  $opt_service;
	}
	function msave(){
			$typeno   = $this->input->post("typeno_save");
			$type     = $this->input->post("type_save");
			$arr       = $this->input->post("arr");
			$show_date = $arr['arr_order']['dateinv'];
			
			$arr_date  = explode("/",$show_date);
			$date_inv  = date('Y-m-d',strtotime($arr_date[2].'-'.$arr_date[1].'-'.$arr_date[0]));
			
			$data_detail= "";
			$number_inv = "";
			if($type != 0 and $typeno != 0) //  save
			{
				$fix_inv = $this->db->query("SELECT invoice FROM tbl_invoice_order WHERE type='".$type."' AND typeno='".$typeno."'")->row();
				$number_inv = $fix_inv->invoice;
				$table = array('tbl_invoice_order','tbl_invoice_detail');
				$this->db->where("type",$type);
				$this->db->where("typeno",$typeno);
				$this->db->delete($table);
			}else{
				$number_inv = FgetPrefix($arr['arr_order']['diseasetype']);
			}

			$sequene = $this->db->query("SELECT sequence,typeid FROM sch_z_systype WHERE typeid=1")->row();
			$arr_update = array("sequence"=>($sequene->sequence+1));
			$this->db->update("sch_z_systype",$arr_update,array("typeid"=>1)); 
			
			//$number_inv = FgetPrefix($arr['arr_order']['diseasetype']);
			$type   = $sequene->typeid;
			$typeno = ($sequene->sequence+1);

			$data_order = array("customercode"=>$arr['arr_order']['custcode'],
							  "date_inv"=>$date_inv,
							  "invoice"=>$number_inv,
							  "type"=>$sequene->typeid,
							  "typeno"=>($sequene->sequence+1),
							  "disease_code"=>$arr['arr_order']['diseasetype'],
							  "amount"=>$arr['arr_order']['total_paid'],
							  "note"=>$arr['arr_order']['note'],
							  "currcode"=>$arr['arr_order']['h_currency']);

			$this->db->insert("tbl_invoice_order",$data_order);

			
			foreach($arr["arr_detail"] as $v_detail)
			{
				$data_detail  = array( "customercode"=>$v_detail['custCodeDetail'],
								"date"=>$date_inv,
								"invoice"=>$number_inv,
								"disease_code"=>$v_detail['disease_Detail'],
								"service_code"=>$v_detail['servicetype'],
								"quantity"=>$v_detail['quantity'],
								"amount"=>$v_detail['amtpaid'],
								"type"=>$sequene->typeid,
								"typeno"=>($sequene->sequence+1),
								"row_index"=>$v_detail['row_index'],
								"currcode"=>$v_detail['currency']
							   );
				$this->db->insert("tbl_invoice_detail",$data_detail);
			}
			//$data_detail = "10000";
			
			// else{ // update
			// 	$table = array('tbl_invoice_order','tbl_invoice_detail');
			// 	$this->db->where("type",$type);
			// 	$this->db->where("typeno",$typeno);
			// 	$this->db->delete($table);

			// 	$data_order =   array("customercode"=>$arr['arr_order']['custcode'],
			// 						  "date_inv"=>$date_inv,
			// 						  "disease_code"=>$arr['arr_order']['diseasetype'],
			// 						  "amount"=>$arr['arr_order']['total_paid'],
			// 						  "note"=>$arr['arr_order']['note']);
			// 	$this->db->where("type", $type);	
			// 	$this->db->where("typeno",$typeno);	
			// 	$this->db->update("tbl_invoice_order",$data_order);
			// 	foreach($arr["arr_detail"] as $v_detail){
			// 		$data_detail  =  array( "customercode"=>$v_detail['custCodeDetail'],
			// 								"date"=>$date_inv,
			// 								"disease_code"=>$v_detail['disease_Detail'],
			// 								"service_code"=>$v_detail['servicetype'],
			// 								"quantity"=>$v_detail['quantity'],
			// 								"amount"=>$v_detail['amtpaid']
			// 							   );
			// 		$this->db->where("type",$type);	
			// 		$this->db->where("typeno",$typeno);	
			// 		$this->db->where("row_index",$v_detail['row_index']);	
			// 		$this->db->update("tbl_invoice_detail",$data_detail);
			// 	}
			// }
			
			return array("type"=>$type,"typeno"=>$typeno);
		
	}
	
	function medite(){
		$type   = $this->input->post("type");
		$typeno = $this->input->post("typeno");
		$sql_order = $this->db->query("SELECT
											tbl_invoice_order.id,
											tbl_invoice_order.customercode,
											DATE_FORMAT(tbl_invoice_order.date_inv,'%d/%m/%Y') as date_inv,
											tbl_invoice_order.invoice,
											tbl_invoice_order.disease_code,
											tbl_invoice_order.amount,
											tbl_invoice_order.note,
											tbl_invoice_order.type,
											tbl_invoice_order.typeno,
											tbl_invoice_order.currcode,
											tbl_customer.customername,
											tbl_customer.gender,
											tbl_customer.years
											FROM
											tbl_invoice_order
											INNER JOIN tbl_customer ON tbl_invoice_order.customercode = tbl_customer.customercode
											WHERE type='".$type."' AND typeno='".$typeno."'")->result();
	
		
		$sql_detail = $this->db->query("SELECT
										tbl_invoice_detail.id,
										tbl_invoice_detail.customercode,
										tbl_invoice_detail.date,
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
										WHERE type='".$type."' AND typeno='".$typeno."'");
		$tr_detail = "";
		$i = 1;
		if($sql_detail->num_rows() > 0){
			foreach($sql_detail->result() as $row){
				$sql_option = $this->db->query("SELECT
												tbl_service_type.id,
												tbl_service_type.service_code,
												tbl_service_type.service_name,
												tbl_service_type.disease_code,
												tbl_service_type.note
												FROM
												tbl_service_type
												WHERE disease_code = '".$row->disease_code."'")->result();
				$opt_service = '<option value=""></option>';
				foreach($sql_option as $row_opt){ 
					$opt_service.= '<option value="'.$row_opt->service_code.'"'.($row_opt->service_code==$row->service_code?"selected='selected'":"").'>'.$row_opt->service_name.'</option>';
				}
				$tr_detail.='<tr>
									<td>'.$i.'<input type="hidden" id="row_index" id="row_index" class="row_index" value="'.$row->row_index.'"></td>
									<td><select id="servicetype" class="form-control input-xs servicetype" name="servicetype">'.$opt_service.'</select></td>
									<td><input type="text" name="quantity" id="quantity" class="form-control quantity" value="'.$row->quantity.'" style="text-align:right;"></td>
									<td><input type="text" name="amtpaid" id="amtpaid" class="form-control input-xs amtpaid" value="'.$row->amount.'" style="text-align:right; width:150px;float:left;"><span class="currency input-xs"  style="padding-top:5px; float:right; margin-left:5px;">'.$row->currcode.'</span></td>
									<td style="text-align:center;"><a href="javascript:void(0)" id="delete_tr"><img rel="2510" src="'.base_url().'assets/images/icons/delete.png"></a></td>
							 </tr>';
				$i++;
			}
		}
		$arr_return = array($sql_order,$tr_detail);
		return $arr_return;
	}

	function getCustomer($key){
		$this->db->like('customername',$key);
		//if($custid!='' && $custid !=0)
		//$this->db->where('customercode',$custid);
		return $this->db->get('tbl_customer')->result();
	}
	
	// function  getOptionCust(){
	// 	$cust = $this->db->query("SELECT
	// 								tbl_customer.customercode,
	// 								tbl_customer.customername,
	// 								tbl_customer.gender,
	// 								tbl_customer.years,
	// 								tbl_customer.curcode,
	// 								tbl_customer.dob
	// 								FROM
	// 								tbl_customer")->result();
	// 	$option = "<option value=''></option>";
	// 	foreach($cust as $row){
	// 		$option.='<option value="'.$row->customercode.'" att_gender="'.$row->gender.'" att_age="'.$row->years.'" att_curr="'.$row->curcode.'">'.$row->customername.'</option>';
	// 	}
	// 	echo $option;
	// 	die();
	// }
	
	function get_OptionService(){
		$select = $this->db->query("SELECT
										stype.disease_code,
										stype.disease_name,
										stype.note
									FROM
										tbl_disease_type AS stype
									ORDER BY disease_name")->result();
		$opt_service = '<option value=""></option>';
		foreach($select as $row){
			$opt_service.= '<option value="'.$row->disease_code.'">'.$row->disease_name.'</option>';
		}
		return  $opt_service;
	}

}