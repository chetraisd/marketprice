<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cinterface extends CI_Controller {
	function __construct(){
		parent::__construct();
	}
	function index(){
		$this->load->view('header');
		//$data['user_id'] = $this->session->userdata("userid");
		$data['currency'] = $this->fn_currency();
		$this->load->view("interface/interface",$data);
		$this->load->view('footer');
	}
	function fn_search_ticket(){
		$search_ticket = $this->input->post("search_ticket");
		$sql_check = $this->db->query("SELECT ticket_no,DATE_FORMAT(create_date,'%d-%m-%Y') AS create_date FROM tran_ticket WHERE ticket_no='".$search_ticket."' AND checkin_status=0");
		$ticket_no = "";
		$date = "";
		if($sql_check->num_rows() > 0){
			$ticket_no = $sql_check->row()->ticket_no;
			$date      = $sql_check->row()->create_date;
		}
		$arr['ticketno'] = $ticket_no;
		$arr['s_date'] 	 = $date;
		header("Content-Type:text/x-json");
		echo json_encode($arr);
		die();
	}
	function fn_currency(){
		$sql_currency = $this->db->query("SELECT 
												set_currencies.cur_typeno,
												set_currencies.cur_type,
												set_currencies.curcode,
												set_currencies.rate,
												set_currencies.symbol
												FROM set_currencies
												WHERE cur_default=1")->row();
		return $sql_currency;
	}
	function show_price(){
		$is_local	   = $this->input->post("is_local");
		$old		   = $this->input->post("old");
		$typeno_parkage= $this->input->post("typeno_parkage");
		//echo "SELECT price,discount FROM set_price_list WHERE package_typeno='".$typeno_parkage."' AND is_local='".$is_local."' AND old_type='".$old."'";die();
		$sql_parkage   = $this->db->query("SELECT ROUND(price) AS price,ROUND(discount) AS discount FROM set_price_list WHERE package_typeno='".$typeno_parkage."' AND is_local='".$is_local."' AND old_type='".$old."'")->row();
		$price    = 0;
		$discount = 0;
		if(count($sql_parkage) > 0){
			$price    = $sql_parkage->price;
			$discount = $sql_parkage->discount;
			//$arr_query = 
		}
		header("Content-type:text/x-json");
		//$arr['parkage'] = $arr_query;
		$arr['price']    = $price;
		$arr['discount'] = $discount;
		echo json_encode($arr);
		die();
	}

	function save(){
		$arr_save    = $this->input->post("arr_save");
		$app_typeno  = $this->green->nextTransAppTicket(3,"app_type");
		$create_date = date('Y-m-d H:i:s');
		$userid      = $this->session->userdata("userid");
		$curr_typeno = $this->input->post("curr_typeno");
		$rate        = $this->input->post("rate");
		$total_amt   = $this->input->post("total_amt");
		$discount_amt = $this->input->post("discount_amt");
		$show_package_typeno = "";
        if(count($arr_save) > 0){
			$this->db->query("INSERT INTO tran_application SET total_amount='".$total_amt."',
															   discount_amount='".$discount_amt."',
															   cur_typeno='".$curr_typeno."',
															   exchange_rate='".$rate."',
															   app_type='3',
															   app_typeno='".$app_typeno."',
															   create_date='".$create_date."',
															   create_by='".$userid."',
															   vis_type=14,
															   vis_typeno=1");
			$reciept_typeno   = $this->green->nextTran(2,"reciept_type");
			$this->db->query("INSERT INTO tran_reciept_payment SET 
														reciept_type ='2',
														reciept_typeno ='".$reciept_typeno."',
														create_date ='".$create_date."',
														create_by ='".$userid."',
														app_type ='3',
														app_typeno ='".$app_typeno."',
														pay_amount ='".$total_amt."',
														cur_type ='5',
														cur_typeno ='".$curr_typeno."',
														pay_type ='11',
														pay_typeno ='41512041109502',
														`status` ='1',
														exchange_rate ='".$rate ."',
														discount ='".$discount_amt."'");
			//$arr_package[$app_typeno] = array("parkage_typeno"=>$val['parkage_typeno'],"is_local"=>$val['is_local'],"remake"=>$val['remake']);
			$show_package_typeno = $app_typeno;
			foreach($arr_save as $val){
				//if($val['qtyticket'] > 1){
					for($ii=1;$ii<=$val['qtyticket'];$ii++){
						$ticket_typeno  = $this->green->nextTransTicket(1, "ticket_type",$val['parkage_typeno']);
						$ticket_no  = $this->green->nextTransTicketnumber("24","ticketnumber",$val['parkage_typeno']);
						$this->db->query("INSERT INTO tran_ticket SET ticket_type='1',
																	  ticket_typeno='".$ticket_typeno."',
																	  app_type = '3',
																	  app_typeno ='".$app_typeno."',
																	  type_of_package ='".$val['type_of']."',
																	  package_typeno = '".$val['parkage_typeno']."',
																	  price='".$val['price']."',
																	  discount='".$val['discount']."',
																	  validitydate='".$create_date."',
																	  expirydate ='".$create_date."',
																	  qty_day = '".($val['type_of'] == 0?1:2)."',
																	  create_by='".$userid."',
																	  create_date = '".$create_date."',
																	  cur_typeno = '".$curr_typeno."',
																	  exchange_rate ='".$rate."',
																	  country='".$val['country']."',
																	  gender = '".$val['gender']."',
																	  old_type ='".$val['remake']."',
																	  is_local ='".$val['is_local']."',
																	  ticket_no = '".$ticket_no."',
																	  `status`=1");
																		
						$this->db->query("INSERT INTO tran_reciept_payment_detail SET 
																					create_by = '".$userid."',
																					create_date = '".$create_date."',
																					reciept_type = '2',
																					reciept_typeno = '".$reciept_typeno."',
																					app_type = '3',
																					app_typeno = '".$app_typeno."',
																					ticket_type = '1',
																					ticket_typeno = '".$ticket_typeno."',
																					t_amount = '".$val['total']."',
																					discount = '".$val['discount']."'");
						
						$sql_parkage_ch = $this->db->query("SELECT par_typeno,package_typeno FROM set_park_package_detail WHERE package_typeno='".$val['parkage_typeno']."'")->result();
						if(count($sql_parkage_ch) > 0){
							foreach($sql_parkage_ch as $row_pack_ch){
								$this->db->query("INSERT INTO tran_ticket_check_park SET 
																				app_agency = '".$app_typeno."',
																				ticket_agency_typeno='".$ticket_typeno."',
																				package_typeno='".$val['parkage_typeno']."',
																				park='".$row_pack_ch->par_typeno."',
																				`status`=1,
																				vis_typeno=1");
							}
						}
						
					}
			}
			
		}
		//window.open("report/c_report_payment");
		header("Content-type:text/x-json");
		$arr_package["app_typeno"] = $show_package_typeno;
		echo json_encode($arr_package);
		die();
	}

	// function cautoCustomer(){
	// 	header("Content-Type:application/json");
	// 	$key  = $_GET['term'];
	// 	$array=array();
		//$this->db->like('agency_trans_typeno',$key);
		//$sql_approval = $this->db->get('tran_agency_approval')->result();
		// $sql_approval = $this->db->query("SELECT * FROM tran_agency_approval WHERE agency_trans_typeno LIKE '".$key."%' AND check_status = 0")->result();
		// if(count($sql_approval) > 0){
		// 	foreach ($sql_approval as $row) {
		// 		$array[]=array('value'=>$row->agency_trans_typeno,
		// 			  		   'id'=>$row->agency_trans_type,
		// 			  		   'agency_typeno'=>$row->agency_typeno,
		// 			  		   'visitor_number'=>$row->visitor_number,
		// 			  		   'description'=>$row->description);
		// 	}
		// }	
		// echo json_encode($array);
	// 	die();
	// }
	function auto_agency(){
		header("Content-Type:application/json");
		$key = $_GET['term'];
		$sql_approval = $this->db->query("SELECT * FROM tran_agency_approval WHERE agency_trans_typeno LIKE '".$key."%' AND approv_status = 0");
		$array = array();
		if($sql_approval->num_rows() > 0){
			foreach ($sql_approval->result() as $row){
				$park_agency   = $this->db->query("SELECT
														agapdet.agency_trans_typeno,
														agapdet.package_typeno,
														tcpark.park,
														tcpark.`status`,
														pk.park_name,
														agapdet.ticket_typeno
														-- pk.type_of
														FROM
														tran_agency_approval_detail AS agapdet
														INNER JOIN tran_ticket_check_park AS tcpark ON agapdet.ticket_typeno = tcpark.ticket_agency_typeno
														INNER JOIN set_park AS pk ON tcpark.park = pk.par_typeno
														WHERE tcpark.`status`=0 AND agency_trans_typeno='".$row->agency_trans_typeno."'")->result();																	
				
				$li_park = "";
				
				if(count($park_agency)>0){
					$jj = 0;
					foreach($park_agency as $row_parckname){
						$chpark = "";
						if($jj == 0){
							$chpark = "checked='checked'";
						}
						$jj++;
						// att_park_type='".$row_parckname->type_of."'
						$li_park.="<li style='display: inline;'><input type='checkbox' ".$chpark." name='ch_".$row_parckname->package_typeno."' parktypeno='".$row_parckname->park."' att_packagetypeno='".$row_parckname->package_typeno."' att_ticket_typeno='".$row_parckname->ticket_typeno."' class='ch_park ch_data'>&nbsp;".$row_parckname->park_name."</li>&nbsp;&nbsp;&nbsp;";
					}
				}
				$approval_name = $this->db->query("SELECT user_name FROM sch_user WHERE userid='".$row->authorize_by."'")->row();
				$agency_name   = $this->db->query("SELECT agency_name,agency_code FROM set_agency_register WHERE agency_typeno='".$row->agency_typeno."'")->row();
				$array[]=array('value'=>$row->agency_refer_code,
							   'agency_trans_typeno'=>$row->agency_trans_typeno,
					  		   'id'=>$row->agency_trans_type,
					  		   'tourname'=>$agency_name->agency_name,
					  		   'tourcode'=>$agency_name->agency_code,
					  		   'visitor_number'=>$row->visitor_number,
					  		   'authorize_code'=>$row->authorize_by,
					  		   'authorize_by'=>$approval_name->user_name,
					  		   'description'=>$row->description,
					  		   'li_park'=>$li_park);
			}
		}	
		echo json_encode($array);
		die();
	}
	
	function save_agency(){
		$arr_agency = $this->input->post("arr_agency");
		$date   = date("Y-m-d");
		$userid = $this->session->userdata("userid");
		$app_typeno  = $this->green->nextTransAppTicket(3,"app_type");
		//$typeno_tick_agency = $this->green->nextTrans(23,"tick_agency_type");
		$ticket_typeno  = $this->green->nextTransTicket(1, "ticket_type",$arr_agency['ticket_typeno']);
		//$ticket_no      = $this->green->nextTransTicketnumber("24","ticketnumber",$arr_agency['package_typeno']);
		
		// $this->db->query("INSERT INTO tran_application SET 
		// 												create_date='".$date."',
		// 												create_by  ='".$userid."',
		// 												app_type   ='3',
		// 												app_typeno ='".$app_typeno."',
		// 												vis_type   ='14',
		// 												vis_typeno ='2',
		// 												agency_trans_typeno = '".$arr_agency['agency_tran_typeno']."',
		// 												agency_trans_type   = '22'");
		
		// $this->db->query("INSERT INTO tran_ticket SET 
		// 											ticket_type = '1',
		// 											ticket_typeno = '".$ticket_typeno."',
		// 											app_type = '3',
		// 											app_typeno = '".$app_typeno."',
		// 											package_typeno ='".$arr_agency['package_typeno']."', 
		// 											`status`    = 0,
		// 											create_by   = '".$userid."',
		// 											create_date = '".$date."',
		// 											number_visitor = '".$arr_agency['vistornumber']."',
		// 											vis_typeno  = '2',
		// 											is_local    = '0',
		// 											ticket_no   = '".$arr_agency['tourreference']."',
		// 											ticket_typeno_agency='".$arr_agency['ticket_typeno']."',
		// 											park_agency_code='".$arr_agency['parktypeno']."'");
		$this->db->update("tran_ticket_check_park",array('status' => 1),array('ticket_agency_typeno'=>$arr_agency['ticket_typeno'],'package_typeno'=>$arr_agency['package_typeno'],'park'=>$arr_agency['parktypeno']));
		
		$sql_check = $this->db->query("SELECT 
											tbl_notcheck.amta,
											tbl_check.amtb
										FROM
										(
										SELECT count(*) AS amta,trancha.ticket_agency_typeno FROM tran_ticket_check_park AS trancha 
										WHERE 1=1
										-- trancha.status = 0 
										AND ticket_agency_typeno ='".$arr_agency['ticket_typeno']."'
										GROUP BY ticket_agency_typeno) AS tbl_notcheck
										LEFT JOIN(
										SELECT count(*) AS amtb,trancha.ticket_agency_typeno FROM tran_ticket_check_park AS trancha 
										WHERE trancha.status = 1 
										AND ticket_agency_typeno ='".$arr_agency['ticket_typeno']."'
										GROUP BY ticket_agency_typeno) AS tbl_check
										ON tbl_notcheck.ticket_agency_typeno = tbl_check.ticket_agency_typeno");

		if($sql_check->num_rows() > 0){
			if($sql_check->row()->amta == $sql_check->row()->amtb){
				$this->db->query("UPDATE tran_agency_approval_detail SET approv_status=1 WHERE ticket_typeno='".$arr_agency['ticket_typeno']."'");
				$this->db->query("UPDATE tran_ticket SET status=1 WHERE ticket_typeno='".$arr_agency['ticket_typeno']."' AND app_typeno='".$arr_agency['agency_tran_typeno']."'");
			}
		}
		$sql_app1 = $this->db->query("SELECT count(*) AS amt_app1 FROM tran_agency_approval_detail WHERE 1=1 AND approv_status=1 AND agency_trans_typeno='".$arr_agency['agency_tran_typeno']."' GROUP BY agency_trans_typeno");
		$sql_app0 = $this->db->query("SELECT count(*) AS amt_app0 FROM tran_agency_approval_detail WHERE 1=1 AND agency_trans_typeno='".$arr_agency['agency_tran_typeno']."' GROUP BY agency_trans_typeno");
		if($sql_app1->num_rows() > 0 AND $sql_app0->num_rows() > 0){
			if($sql_app1->row()->amt_app1 == $sql_app0->row()->amt_app0){
				$this->db->query("UPDATE tran_agency_approval SET approv_status=1 WHERE agency_trans_typeno='".$arr_agency['agency_tran_typeno']."'");
				$this->db->query("UPDATE tran_agency_approval SET approv_status=1 WHERE agency_trans_typeno='".$arr_agency['agency_tran_typeno']."'");
				
			}
		}
		header("Content-type:text/x-json");
		$arr_succes["ok"] = 10000;
		//$arr_succes["qqq"] = $sql_app1->row()->amt_app1." - ".$sql_app0->row()->amt_app0;
		echo json_encode($arr_succes);
		die();
	}

	
}