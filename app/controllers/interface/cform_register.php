<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cform_register extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('interface/mform_contact','m');
		$this->load->helper(array('form', 'url'));
	}
	function index(){
		$data['opt_visitor'] = $this->fn_visitor_type();
		$data['opt_parkname'] = $this->fn_parkname("");
		$data['opt_countries'] = $this->fn_countries();
		//$data['opt_datetype'] = $this->fn_datetype("","");
		$data['opt_currency'] = $this->fn_currency();
		$data['def_currency'] = $this->fn_default_cur();
		$data['opt_payment_mode'] = $this->fn_payment_mode();
		$this->load->view('header');
		$this->load->view("interface/form_register",$data);
		$this->load->view('footer');
	}
	function csave(){
		header("Content-type:text/x-json");
		$typno_contact = $this->m->msave();
		echo json_encode($typno_contact);
		die();
	}
	function fn_payment_mode(){
		$sql_payment_mode = $this->db->query("SELECT
												set_payment_type.pay_type,
												set_payment_type.pay_typeno,
												set_payment_type.description,
												set_payment_type.payment_name
												FROM
												set_payment_type
												ORDER BY `order`")->result();
		$opt_paymentmode = "";
		if(count($sql_payment_mode) > 0){
			foreach($sql_payment_mode as $val_paymentmode){
				$opt_paymentmode.="<option value='".$val_paymentmode->pay_typeno."'>".$val_paymentmode->payment_name."</option>";
			}
		}
		return $opt_paymentmode;
	}
	function fn_default_cur(){
		$def_cur  = $this->db->query("SELECT symbol,rate,cur_typeno FROM set_currencies WHERE cur_default='1'")->row();
		$arr_def[0] = $def_cur->symbol;
		$arr_def[1] = $def_cur->rate;
		$arr_def[2] = $def_cur->cur_typeno;
		return $arr_def;
	}

	function fn_currency(){
		$currency = $this->db->query("SELECT
											set_currencies.cur_typeno,
											set_currencies.currencyname,
											set_currencies.rate,
											set_currencies.symbol,
											set_currencies.reciept_payment,
											set_currencies.cur_default
											FROM
											set_currencies
											WHERE reciept_payment = 1")->result();
		$opt_currency = "";
		if(count($currency) > 0){
			foreach($currency as $val_curr){
				$select = "";
				if($val_curr->cur_default==1){
					$select = "selected='selected'";
				}
				$opt_currency.="<option att_rate='".$val_curr->rate."' att_symbol='".$val_curr->symbol."' cur_def='".$val_curr->cur_default."'  value='".$val_curr->cur_typeno."' $select >".$val_curr->currencyname."</option>";
			}
		}
		return $opt_currency;
	}
	function fn_visitor_type(){
		$sql_visitor = $this->db->query("SELECT
											set_visitor_type.vis_type,
											set_visitor_type.vis_typeno,
											set_visitor_type.description,
											set_visitor_type.vistor_name
											FROM
											set_visitor_type")->result();
		$opt_visitor = "";
		if(count($sql_visitor) > 0){
			foreach($sql_visitor as $val){
				$opt_visitor.= "<option value='".$val->vis_typeno."'>".$val->description."</option>";
			}
		}
		return $opt_visitor;
	}
	function fn_parkname($park_no){
		/*$sql_parkname = $this->db->query("SELECT
											set_park.par_type,
											set_park.par_typeno,
											set_park.park_name
											FROM
											set_park
											")->result();*/
		$sql_parkname=$this->green->user_access_park(0);
		$opt_parkname = '<option value=""></option>';
		if(count($sql_parkname) > 0){
			foreach($sql_parkname as $val_park){
				$opt_parkname.= "<option ".($val_park['par_typeno'] == $park_no?"selected='selected'":"")." value=".$val_park['par_typeno'].">".$val_park['park_name']."</option>";
			}
		}
		return $opt_parkname;
	}
	function fn_datetype(){
		$park_typeno    = $this->input->post("park_typeno");
		$sql_tickettype = $this->db->query("SELECT
											set_ticket_type.tic_type_type,
											set_ticket_type.tic_type_typeno,
											set_ticket_type.qty_day,
											set_ticket_type.price,
											set_ticket_type.tickettype_name
											FROM
											set_ticket_type
											WHERE par_typeno='".$park_typeno."' ORDER BY qty_day ASC")->result();
		$opt_tickettype = '<option value=""></option>';
		if(count($sql_tickettype) > 0){
			$n = 1;
			foreach($sql_tickettype as $val_tickettype){
				if($n == 1){
					$opt_tickettype.= "<option selected='selected' value=".$val_tickettype->tic_type_typeno." att_type=".$val_tickettype->tic_type_type." att_price=".$val_tickettype->price." qty_day=".$val_tickettype->qty_day.">".$val_tickettype->tickettype_name."</option>";
				}else{
					$opt_tickettype.= "<option value=".$val_tickettype->tic_type_typeno." att_type=".$val_tickettype->tic_type_type." att_price=".$val_tickettype->price." qty_day=".$val_tickettype->qty_day.">".$val_tickettype->tickettype_name."</option>";
				}
				$n++;
			}
		}
		header("Content-type:text/x-json");
		$arr_opt['opt_date_type'] = $opt_tickettype;
		echo json_encode($arr_opt);
		die();
	}
	function fn_aut_ticketnumber(){
		$park_id = $this->input->post("park_id");
	}
	function fn_countries(){
		$sql_countries = $this->db->query("SELECT
											countries.id_countries,
											countries.name
											FROM
											countries")->result();
		$opt_countries = "";
		if(count($sql_countries) > 0){
			foreach($sql_countries as $val_countries){
				$opt_countries.= "<option value='".$val_countries->id_countries."'>".$val_countries->name."</option>";
			}
		}
		return $opt_countries;
	}
	function fn_save_ticket(){
		$arr_tran_app = $this->input->post("arr_tran_app");
		$arr_ticket   = $this->input->post("arr_ticket");
		$app_typeno = "";
		$user = $this->session->userdata("userid");
		$gat_typeno = $this->db->query("SELECT gat_type,gat_typeno FROM sch_user WHERE userid='".$user."'")->row();
		$create_date = date('Y-m-d H:i:s');
		if($arr_tran_app['h_typeno_app'] == ""){
			$app_typeno = $this->green->nextTransAppTicket(3,"app_type");
			$cus_typeno = $this->green->nextTran(6,"cus_type");
			
			$data = array('create_date'=>$create_date,'create_by'=>$user,
						  'app_type'=>3,'app_typeno'=>$app_typeno,
						  'con_type'=>15,'con_typeno'=>$arr_tran_app['cont_typeno'],
						  'cus_type'=>6,'cus_typeno'=>$cus_typeno,
						  'customer_firstname'=>$arr_tran_app['firstname'],'customer_lastname'=>$arr_tran_app['lastname'],
						  'gender'=>$arr_tran_app['sex'],'nationality'=>$arr_tran_app['nationality'],'country'=>$arr_tran_app['country'],
						  'remark'=>$arr_tran_app['remark'],'passportno'=>$arr_tran_app['passportno'],'age'=>$arr_tran_app['age'],
						  'total_amount'=>$arr_tran_app['show_total'],'discount_amount'=>$arr_tran_app['discount']
						);
			$this->db->insert("tran_application",$data);
		}else{
			$app_typeno = $arr_tran_app['h_typeno_app'];
			$data = array('create_date'=>$create_date,'create_by'=>$user,
						  'customer_firstname'=>$arr_tran_app['firstname'],'customer_lastname'=>$arr_tran_app['lastname'],
						  'gender'=>$arr_tran_app['sex'],'nationality'=>$arr_tran_app['nationality'],'country'=>$arr_tran_app['country'],
						  'remark'=>$arr_tran_app['remark'],'passportno'=>$arr_tran_app['passportno'],'age'=>$arr_tran_app['age'],
						  'total_amount'=>$arr_tran_app['show_total'],'discount_amount'=>$arr_tran_app['discount']
						 );
			$this->db->where('app_typeno',$arr_tran_app['h_typeno_app']);
			$this->db->update("tran_application",$data);
			$this->db->delete("tran_ticket",array("app_typeno"=>$app_typeno));
		}
				
		if(count($arr_ticket) > 0){
			foreach($arr_ticket as $val_ticket){
				//$ticket_typeno = $this->green->nextTran(1,"ticket_type");
				$ticket_typeno = $this->green->nextTransTicket(1, "ticket_type",$val_ticket['park_name']);
				// echo $ticket_typeno."<br>";
				$validity_date = explode("/",$val_ticket['validity_date']);
				$expiry_date = explode("/",$val_ticket['expiry_date']);
				$data = array('ticket_type'=>1,'ticket_typeno'=>$ticket_typeno,
							  'app_type'=>3,'app_typeno'=>$app_typeno,
							  'gat_type'=>$gat_typeno->gat_type,
							  'gat_typeno'=>$gat_typeno->gat_typeno,
							  'validitydate'=>date('Y-m-d',strtotime($validity_date[2]."-".$validity_date[1]."-".$validity_date[0])),
							  'expirydate'=>date('Y-m-d',strtotime($expiry_date[2]."-".$expiry_date[1]."-".$expiry_date[0])),
							  'qty_day'=>$val_ticket['qty_days'],
							  'price'=>$val_ticket['price'],
							  'par_type'=>10,
							  'par_typeno'=>$val_ticket['park_name'],
							  'tic_type_type'=>13,
							  'tic_type_typeno'=>$val_ticket['date_type'],
							  'create_date'=>$create_date,
							  'create_by'=>$user
							  //'cur_typeno'=>$arr_tran_app['currency_code'],
							  //'exchange_rate'=>$arr_tran_app['rate']
							 );
				$this->db->insert("tran_ticket",$data);
			}

		}
		
		$sql_app_cont = $this->db->query("SELECT
												tran_application.create_date,
												tran_application.create_by,
												tran_application.app_type,
												tran_application.app_typeno,
												tran_application.cus_type,
												tran_application.cus_typeno,
												tran_application.con_type,
												tran_application.con_typeno,
												tran_application.customer_firstname,
												tran_application.customer_lastname,
												tran_application.country,
												tran_application.nationality,
												tran_application.gender,
												tran_application.age,
												tran_application.passportno,
												tran_application.remark,
												tran_application.cur_typeno,
												tran_application.exchange_rate,
												tran_application.discount_amount,
												tran_application.total_amount,
												tran_application.photo,
												tran_application.passport_id_image
												FROM
												tran_application
												WHERE con_typeno='".$arr_tran_app['cont_typeno']."' AND con_type=15 AND status=0")->result();
		$show_curr = $this->db->query("SELECT symbol FROM set_currencies WHERE cur_default=1")->row()->symbol;
		$ii = 1;
		$total_discount = 0;
		$total_amount   = 0;
		$all_total      = 0;
		$tr_show_register = "";
		if(count($sql_app_cont) > 0){
			foreach($sql_app_cont as $row_app_ticket){
				$total_discount+= $row_app_ticket->discount_amount;
				$total_amount+= $row_app_ticket->total_amount;
				$countries    = $this->db->query("SELECT `name` FROM countries WHERE id_countries='".$row_app_ticket->nationality."'")->row()->name;

				$sql_tran_ticket = $this->db->query("SELECT
														tran_ticket.ticket_type,
														tran_ticket.ticket_typeno,
														tran_ticket.app_type,
														tran_ticket.app_typeno,
														tran_ticket.cou_type,
														tran_ticket.cou_typeno,
														tran_ticket.price,
														tran_ticket.validitydate,
														tran_ticket.expirydate,
														tran_ticket.qty_day,
														tran_ticket.`status`,
														tran_ticket.tic_type_typeno,
														tran_ticket.par_typeno
														FROM
														tran_ticket
														WHERE app_typeno='".$row_app_ticket->app_typeno."' AND app_type=3")->result();
				
				if(count($sql_tran_ticket) > 0){
					foreach($sql_tran_ticket as $row_tran_ticket){
						$all_total+= $row_tran_ticket->price;
						$show_parkname = $this->db->query("SELECT park_name FROM set_park WHERE par_typeno='".$row_tran_ticket->par_typeno."'")->row()->park_name;
						$tr_show_register.= "<tr>
												<td style='text-align:center;' class='row_index'>".($ii++)."</td>
												<td>".$row_app_ticket->customer_firstname."&nbsp;".$row_app_ticket->customer_lastname."
												<input type='hidden' name='customername' id='customername' class='customername' value='".$row_app_ticket->customer_firstname."&nbsp;".$row_app_ticket->customer_lastname."'>
												<input type='hidden' name='typeno_ticket' id='typeno_ticket' class='typeno_ticket' value='".$row_tran_ticket->ticket_typeno."'>
												<input type='hidden' name='tic_type_typeno' id='tic_type_typeno' class='tic_type_typeno' value='".$row_tran_ticket->tic_type_typeno."'>
												<input type='hidden' name='tran_app_typeno' id='tran_app_typeno' class='tran_app_typeno' value='".$row_tran_ticket->app_typeno."'>
												<input type='hidden' name='tran_park_typeno' id='tran_park_typeno' class='tran_park_typeno' value='".$row_tran_ticket->par_typeno."'>
												<input type='hidden' name='count_".$row_app_ticket->app_typeno."' class='count_".$row_app_ticket->app_typeno."' value='".$row_app_ticket->app_typeno."'>
												</td>
												<td>".$row_app_ticket->gender."</td>
												<td>".$countries."</td>
												<td>".($row_app_ticket->remark == 1?"Adult":"Child")."</td>
												<td>".$show_parkname."</td>
												<td>".$row_tran_ticket->ticket_typeno."</td>
												<td style='text-align:center;'>".$row_tran_ticket->qty_day."</td>
												<td style='text-align:right;'>".$row_tran_ticket->price."&nbsp;".$show_curr."
												<input type='hidden' name='h_price' id='h_price' class='h_price' value='".$row_tran_ticket->price."'>
												</td>
												<td style='text-align:center;'>
													<a href='javascript:void(0)' id='row_delete'><img src='".base_url('assets/images/icons/delete.png')."'></a>&nbsp;&nbsp;
													<a href='javascript:void(0)' id='edite_all' typeno_app='".$row_app_ticket->app_typeno."'><img src='".base_url('assets/images/icons/edit.png')."' width='14' height='14'></a>
												</td>
											</tr>";
					}
				}
			}
		}
		$count_app = $this->db->query("SELECT COUNT(*) AS numberticket FROM tran_application WHERE con_typeno='".$arr_tran_app['cont_typeno']."'  GROUP BY con_typeno")->row()->numberticket;
		header("Content-type:text/x-json");
		$arr_row["count_app"] = $count_app;
		$arr_row["tr_register"] = $tr_show_register;
		$arr_row["typeno_app"]  = $app_typeno;
		$arr_row['total_dis'] = $total_discount;
		$arr_row['total_amt'] = $total_amount;
		$arr_row['all_total'] = $all_total;
		echo json_encode($arr_row);
		die();
	}

	function fn_update_stats(){
		$arr_status = $this->input->post("arr_status");
		if(count($arr_status) > 0){
			foreach($arr_status as $val_status){
				$this->db->where("ticket_typeno",$val_status);
				$this->db->update("tran_ticket",array("status"=>1));
			}
		}
		header("Content-type:text/x-json");
		$arr['ok'] = 1;
		echo json_encode($arr);
		die();
	}
 	
 	function edit_ticket(){
 		$typeno_app = $this->input->post("typeno_app");
		$sql_app = $this->db->query("SELECT
										tran_application.create_date,
										tran_application.create_by,
										tran_application.customer_firstname,
										tran_application.customer_lastname,
										tran_application.country,
										tran_application.nationality,
										tran_application.gender,
										tran_application.age,
										tran_application.passportno,
										tran_application.remark,
										tran_application.cur_typeno,
										tran_application.exchange_rate,
										tran_application.discount_amount,
										tran_application.total_amount,
										tran_application.photo,
										tran_application.passport_id_image	
										FROM
										tran_application
										WHERE app_typeno = '".$typeno_app."' 
										AND app_type = 3")->result();
		
		$sql_ticket = $this->db->query("SELECT
											tran_ticket.ticket_type,
											tran_ticket.ticket_typeno,
											tran_ticket.app_type,
											tran_ticket.app_typeno,
											tran_ticket.tic_type_type,
											tran_ticket.tic_type_typeno,
											tran_ticket.par_type,
											tran_ticket.par_typeno,
											tran_ticket.gat_type,
											tran_ticket.gat_typeno,
											tran_ticket.cou_type,
											tran_ticket.cou_typeno,
											tran_ticket.price,
											DATE_FORMAT(validitydate,'%d/%m/%Y') AS validitydate,
											DATE_FORMAT(expirydate,'%d/%m/%Y') AS expirydate, 
											tran_ticket.qty_day,
											tran_ticket.`status`,
											tran_ticket.cur_typeno,
											tran_ticket.exchange_rate
											FROM
											tran_ticket
											WHERE app_typeno='".$typeno_app."'
											AND app_type = 3")->result();
		$tr_edit = "";
		
		if(count($sql_ticket)>0){
			foreach($sql_ticket as $val_tran){
				$show_curr = $this->db->query("SELECT symbol FROM set_currencies WHERE cur_default=1")->row()->symbol;
				$sql_datetype_edit = $this->db->query("SELECT
													set_ticket_type.tic_type_type,
													set_ticket_type.tic_type_typeno,
													set_ticket_type.qty_day,
													set_ticket_type.price,
													set_ticket_type.tickettype_name
													FROM
													set_ticket_type
													WHERE par_typeno='".$val_tran->par_typeno."'")->result();
				$opt_datettype = '<option value=""></option>';
				if(count($sql_datetype_edit) > 0){
					foreach($sql_datetype_edit as $val_datetype){
						$select = "";
						if($val_datetype->tic_type_typeno == $val_tran->tic_type_typeno){
							$select="selected='selected'";
						}
						$opt_datettype.= "<option value=".$val_datetype->tic_type_typeno." $select att_type=".$val_datetype->tic_type_type." att_price=".$val_datetype->price." qty_day=".$val_datetype->qty_day.">".$val_datetype->tickettype_name."</option>";
					}
				}
				$tr_edit.='<tr class="new_row">
							    <td><SELECT name="park_name" id="park_name" class="form-control park_name" placeholder="park name">'.$this->fn_parkname($val_tran->par_typeno).'</SELECT></td>
							    <td><SELECT name="date_type" id="date_type" class="form-control date_type" placeholder="type">'.$opt_datettype.'</SELECT></td>
								<td><input type="text" name="validity_date" id="validity_date" class="form-control validity_date" placeholder="validity date" value="'.$val_tran->validitydate.'"></td>
								<td><input type="text" name="expiry_date" id="expiry_date" class="form-control expiry_date" placeholder="expiry date" value="'.$val_tran->expirydate.'"></td>
								<td><span style="float:right;margin:10px 0 0 10px;" id="show_symbol">'.$show_curr.'</span><input type="text" name="price" id="price" class="form-control price" placeholder="price" value="'.$val_tran->price.'" style="text-align:right; width:100px; float:right;"></td>
								<td style="text-align:center; vertical-align: middle;"><a href="javascript:void(0)" id="delete_row"><img src="'.site_url("assets/images/icons/delete.png").'"></a></td>
							</tr>';
			}
		}
		header("Content-type:text/x-json");
		$arr_edit['tran_app']    = $sql_app;
		$arr_edit['tran_ticket'] = $tr_edit;

		$sql_img = $this->db->query("SELECT photo FROM tran_application WHERE app_typeno='".$typeno_app."'")->row()->photo;
		$img = base_url("assets/upload/customer_photo/".$sql_img);
		//$arr_edit['img'] = $img;
		$show_img = "";
		if($sql_img != ""){
			$show_img = $img;
		}else{
			$show_img = base_url("assets/upload/images.png");
		}
		$arr_edit['img'] = $show_img;
		echo json_encode($arr_edit);
		die();
 	}

 	function fn_delet_ticket(){
 		$typeno_ticket = $this->input->post("typeno_ticket");
 		$total_app_tr  = $this->input->post("total_app_tr");
 		$typeno_app    = $this->input->post("typeno_app");
 		if($total_app_tr > 1){
			$this->db->where("ticket_typeno",$typeno_ticket);
	 		$this->db->where("ticket_type",1);
	 		$this->db->delete("tran_ticket");
 		}else{
 			$this->db->delete("tran_ticket",array('ticket_typeno'=>$typeno_ticket,'ticket_type'=>1));
			$img_del = $this->db->query("SELECT photo FROM tran_application WHERE app_typeno='".$typeno_app."' AND app_type='3'")->row()->photo;
 			if($typeno_app != ''){
				$target = "assets/upload/customer_photo/".$img_del;
				if(file_exists($target)){
					unlink($target);			
				}
			}
			$this->db->delete("tran_application",array('app_typeno'=>$typeno_app,'app_type'=>3));
 		}
 		
 		echo "OK";
 		die();
 	}

 	function fn_save_payment(){
 		$arr_rec_mast  = $this->input->post("arr_master_recipt");
 		$reciept_detail= $this->input->post("arr_detail_rec");
 		$create_date  = date("Y-m-d H:i:s");
 		$user         = $this->session->userdata("userid");
 		$show_inv     = "";
 		if(count($arr_rec_mast) > 0){
 			$reciept_typeno   = $this->green->nextTran(2,"reciept_type");
 			$inv_typeno       = $this->green->nextTran(8,"inv_type");
 			$show_inv         = $inv_typeno;
 			$data['save_inv'] = array("create_by"=>$user,"create_date"=>$create_date,
			 						  "inv_type"=>8,"inv_typeno"=>$inv_typeno,
			 						  "con_type"=>15,"con_typeno"=>$arr_rec_mast['cont_typeno'],
			 						  "cur_type"=>5,"cur_typeno"=>$arr_rec_mast['currency']);

 			$data['save_rec'] = array("reciept_type"=>1,"reciept_typeno"=>$reciept_typeno,
			 						  "con_type"=>15,"con_typeno"=>$arr_rec_mast['cont_typeno'],
			 						  "create_date"=>$create_date,"create_by"=>$user,
			 						  "inv_type"=>8,"inv_typeno"=>$inv_typeno,
			 						  "amount"=>$arr_rec_mast['cash_receive'],
			 						  "cur_type"=>5,"cur_typeno"=>$arr_rec_mast['currency'],
			 						  "exchange_rate"=>$arr_rec_mast['rate'],
			 						  "pay_type"=>11,"pay_typeno"=>$arr_rec_mast['payment_mode']
			 						  );
 			$this->db->query("UPDATE tran_application SET status=1 WHERE con_typeno='".$arr_rec_mast['cont_typeno']."' AND status=0");
 			$this->db->insert("tran_invoice",$data['save_inv']);
 			$this->db->insert("tran_reciept_payment",$data['save_rec']);
 			
 		 	if(count($reciept_detail) > 0){
	 			foreach($reciept_detail as $val_detail){
	 				$sql_park = $this->db->query("SELECT sequen FROM set_park WHERE par_typeno='".$val_detail['park_typeno']."'")->row()->sequen;
	 				$data = array("sequen"=>($sql_park+1));
	 				$this->db->where("par_typeno",$val_detail['park_typeno']);
	 				$this->db->update("set_park",$data);
	 				$this->db->query("INSERT INTO tran_invoice_detail SET
	 										ticket_type =1,
	 										ticket_typeno = '".$val_detail['typeno_ticket']."',
											inv_type = 8,
											inv_typeno ='".$inv_typeno."',
											tic_type_type = 13,
											tic_type_typeno='".$val_detail['tic_type_typeno']."',
											app_type=3,
											app_typeno='".$val_detail['tran_app_typeno']."',
											price='".$val_detail['price']."',
											create_date='".$create_date."'
	 								");	 			
	 				$this->db->query("INSERT INTO tran_reciept_payment_detail SET
	 										create_by ='".$user."',
	 										create_date = '".$create_date."',
											reciept_type = 1,
											reciept_typeno ='".$reciept_typeno."',
											inv_type = 8,
											inv_typeno ='".$inv_typeno."',
											app_type = 3,
											app_typeno='".$val_detail['tran_app_typeno']."',
											ticket_type =1,
											ticket_typeno ='".$val_detail['typeno_ticket']."',
											t_amount = '".$val_detail['price']."'
	 								");
	 			}
	 		}
	 	}
	 	header("Content-type:text/x-json");
	 	$arr['inv_typeno']= $show_inv;
 		echo json_encode($arr);
 		die();
 	}

 
	function customer_upload() {
		echo $this->m->mcust_upload();
	}
	// function show_park(){
	// 	header("Content-type:text/x-json");
	// 	$box_park = $this->green->user_access_park(0);
	// 	$show_park = "";
	// 	if(count($box_park)>0 ){
	// 		foreach($box_park as $val_park){
	// 			$show_park.='<div class="park_center bg-primary">
	// 							<a href="javascript:void(0)" id="id_park" park_typeno="'.$val_park['par_typeno'].'" style="text-align:center;display: block;margin-left: auto;margin-right: auto; width:100%;height:100%;border:0px solid black;float:left; text-decoration:none;color:#FFF;">'.$val_park['park_name'].'</a>
	// 							<span id="h_'.$val_park['par_typeno'].'" style="display:none;">'.$val_park['description'].'</span>
	// 						</div>';
	// 		}
	// 	}
	// 	$arr_park['park'] =  $show_park;
	// 	echo json_encode($arr_park);
	// 	die();

	// }
}