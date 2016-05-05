<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_report_checking_ticketing extends CI_Controller{
	
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

	
	// autocomplete ========
	function autocomplete(){		
		$term = $_GET['term'];
		$where = '';
		if(trim($term) != ''){
			$where .= " AND tt.ticket_typeno LIKE '%{$term}%' ";
		}
		$qr = $this->db->query("SELECT
										tt.ticket_type,
										tt.ticket_typeno,
										tt.checkin_status
									FROM
									 	tran_ticket AS tt 
								 	WHERE 1=1 {$where} "); 
									
		if ($qr->num_rows() > 0)
		{
			foreach ($qr->result() as $row)
			{
			  $data[] = array('ticket_no' => $row->ticket_typeno, 
			  					'check_in' => $row->checkin_status
		  					 );
			}
			return json_encode($data);
		}
				
	}

	// save all_chk ========
	function save_all_chk(){
		$arr = $this->input->post('arr');
		$in_date = date('Y-m-d H:i:s');

		if(count($arr) > 0){
			foreach ($arr as $row) {
				$data = array('date_checkin' => $in_date,
								'checkin_status' => $row['checkin_status']
							);
				$this->db->update('tran_ticket', $data, array('ticket_typeno' => $row['ticket_typeno']));
			}
			$da['success'] = 'true';	
		}else{
			$da['success'] = 'false';
		}				

		return json_encode($da);
	}

	// show checkticket new ========
	function checkticketno(){
		$ticket_no = trim($this->input->post('ticket_typeno', TRUE));
		$ticketno_or_ref = trim($this->input->post('ticketno_or_ref', TRUE));
		$where = "";
		if($ticketno_or_ref != ""){
			if($ticketno_or_ref == 1){
				$where = " AND tt.vis_typeno = 1";
			}else{
				$where = " AND tt.vis_typeno = 2";
			}
		}
		$qr = $this->db->query("SELECT
										tt.ticket_no
									FROM
										tran_ticket AS tt
									WHERE 1=1
									{$where}
									AND tt.ticket_no = '{$ticket_no}' ");
										
		if($qr->num_rows() > 0){
			$data['success'] = 'true';			
		}else{
			$data['success'] = 'false';
		}
		return json_encode($data);
	}

	// update to 1 ========
	// function update_to_1_(){
	// 	$ticket_typeno = trim($this->input->post('ticket_typeno', TRUE));	
	// 	$date_checkin = date('Y-m-d H:i:s');

	// 	$qr = $this->db->query("SELECT
	// 									tt.checkin_status
	// 								FROM
	// 									tran_ticket AS tt
	// 								WHERE
	// 									tt.ticket_typeno = '{$ticket_typeno}' ");
		
	// 	if($qr->num_rows() > 0){
	// 		if($qr->row()->checkin_status - 0 == 0){
	// 			$data = array('date_checkin' => $date_checkin,
	// 									'checkin_status' => 1
	// 								);

	// 			$this->db->update('tran_ticket', $data, array('ticket_typeno' => $ticket_typeno));
	// 			$da['success'] = 'true';
	// 		}else{
	// 			$da['success'] = 'false';
	// 		}
	// 	}else{
	// 		$da['success'] = 'no';
	// 	}							

	// 	return json_encode($da);
	// }

	// update to 1 ========
	// function update_to_1(){
	// 	$ticket_typeno = trim($this->input->post('ticket_typeno', TRUE));	
	// 	$date_checkin = date('Y-m-d H:i:s');

	// 	$data = array('date_checkin' => $date_checkin,
	// 					'checkin_status' => 1
	// 				);

	// 	$this->db->update('tran_ticket', $data, array('ticket_typeno' => $ticket_typeno));
	// 	$da['success'] = 'true';			

	// 	return json_encode($da);
	// }

	// show ​data  new=====
	function grid(){
		$where = '';
		$ticket_no = trim($this->input->post('ticket_no', TRUE));
		$fromdate  = trim($this->input->post('fromdate', TRUE));
		$todate    = trim($this->input->post('todate', TRUE));
		$c_fromdate = $this->green->convertSQLDate($fromdate);
		$c_todate  = $this->green->convertSQLDate($todate);
		$tourreference = trim($this->input->post('tourreference', TRUE));
		$parkage_code = trim($this->input->post('park_name', TRUE));
		
		if($ticket_no != '' && $tourreference != ''){
			$where .= " AND tran_ticket.ticket_no = '".$ticket_no."' OR tran_ticket.ticket_no = '".$tourreference."'";				
		}else if($ticket_no != '' && $tourreference == ''){
			$where .= " AND tran_ticket.ticket_no = '".$ticket_no."'";
		}else if($ticket_no == '' && $tourreference != ''){
			$where .= " AND tran_ticket.ticket_no = '".$tourreference."'";
		}	
		if($c_fromdate != ''){
			$where .= " AND date(tran_application.create_date) >= '".$c_fromdate."'";
		}
		if($c_todate != ''){
			$where .= " AND date(tran_application.create_date) <= '".$c_todate."'";
		}
		
		if($parkage_code != ''){
			$where .= " AND tran_ticket.package_typeno = '".$parkage_code."'";				
		}

		$tr = "";
		$sql = "SELECT
					tran_application.create_date,
					tran_application.create_by,
					tran_application.app_type,
					tran_application.app_typeno,
					tran_application.vis_typeno,
					tran_ticket.ticket_typeno,
					tran_ticket.country,
					tran_ticket.old_type,
					tran_ticket.package_typeno,
					tran_ticket.ticket_no,
					tran_ticket.park_agency_code,
					tran_ticket.ticket_typeno_agency,
					tran_ticket.checkin_status,
					set_park_package.package_name
					FROM
					tran_application
					INNER JOIN tran_ticket ON tran_application.app_typeno = tran_ticket.app_typeno AND tran_application.app_type = tran_ticket.app_type
					INNER JOIN set_park_package ON tran_ticket.package_typeno = set_park_package.package_typeno
					WHERE 1=1 AND tran_ticket.checkin_status='0' {$where}";
		$total_row = $this->green->getValue("select count(*) as numrow FROM ($sql) as cc");
		$paging    = $this->green->ajax_pagination($total_row,site_url('invoice/c_report_checking_ticketing/grid'),10);
		$data      = $this->db->query("$sql limit {$paging['start']}, {$paging['limit']}");
		$arrJson['paging'] = $paging;
		$tr = "";
		$ii = 1;
		if($data->num_rows() > 0){
			foreach($data->result() as $row_qr){
				$visitor_type = $this->db->query("SELECT vistor_name FROM set_visitor_type WHERE vis_typeno='".$row_qr->vis_typeno."'");
				if($visitor_type->num_rows() > 0){
					$visitor_type = $visitor_type->row()->vistor_name;
				}else{
					$visitor_type = "";
				}
				$user = $this->db->query("SELECT user_name FROM sch_user WHERE userid='".$row_qr->create_by."'");
				if($user->num_rows() > 0){
					$user = $user->row()->user_name;
				}else{
					$user = "";
				}
				$country = $this->db->query("SELECT `name` FROM countries WHERE id_countries='".$row_qr->country."'");
				if($country->num_rows() > 0){
					$country = $country->row()->name;
				}else{
					$country = "";
				}
				$tickagencytypeno = "";
				$parkagency       = "";
				$reference        = "";
				
				if($row_qr->vis_typeno == 2){
					
					$tickagencytypeno = $row_qr->ticket_typeno;
					$parkagency = ' AND ttcp.park="'.$row_qr->park_agency_code.'"';
					$reference  = "Reference";
				}else{
					$tickagencytypeno = $row_qr->ticket_typeno;
					$reference  = "Ticket no";
					$parkagency = '';
				}
				$sql_check_ticket = $this->db->query("SELECT
															ttcp.ticket_agency_typeno,
															ttcp.package_typeno,
															ttcp.park,
															ttcp.`status`,
															ttcp.check_in_status,
															set_park.park_name
															FROM
															tran_ticket_check_park as ttcp
															INNER JOIN set_park ON ttcp.park = set_park.par_typeno
															WHERE ttcp.ticket_agency_typeno='".$tickagencytypeno."'
															AND ttcp.package_typeno='".$row_qr->package_typeno."'
															AND ttcp.status='1' AND ttcp.check_in_status = 0");
				$row_check_ticket = "";
				$jj = 1;
				if($sql_check_ticket->num_rows() > 0){
					foreach($sql_check_ticket->result() as $row_cticket){
						if($jj == 1){
							$row_check_ticket.='<tr>
													<td style="text-align:right;">&nbsp;</td>
													<td>'.$user.'</td>
													<td>'.date('d-m-Y',strtotime($row_qr->create_date)).'</td>
													<td>'.$visitor_type.'</td>
													<td>'.$country.'</td>
													<td>'.($row_qr->vis_typeno == 2?'':($row_qr->old_type == 0?'Adult':'Child')).'</td>
													<td>'.$row_cticket->park_name.'</td>
													<td style="text-align: center;" class="delete_td">
														<input type="checkbox" id="check_park" class="btn btn-default check_park" data-toggle="tooltip" data-placement="top" style="width: 16px;height: 16px;">
														<input type="hidden" name="app_typeno" id="app_typeno" class="app_typeno" value="'.$row_qr->app_typeno.'">
														<input type="hidden" name="ticket_agency_typeno" id="ticket_agency_typeno" class="ticket_agency_typeno" value="'.$row_cticket->ticket_agency_typeno.'">
														<input type="hidden" name="package_typeno" id="package_typeno" class="package_typeno" value="'.$row_cticket->package_typeno.'">
														<input type="hidden" name="parkcode" id="parkcode" class="parkcode" value="'.$row_cticket->park.'">
														<input type="hidden" name="vis_typeno" id="vis_typeno" class="vis_typeno" value="'.$row_qr->vis_typeno.'">
													</td>
												</tr>';
						}else{
							$row_check_ticket.='<tr>
													<td colspan="6">&nbsp;</td>
													<td>'.$row_cticket->park_name.'</td>
													<td style="text-align: center;" class="delete_td">
														<input type="checkbox" id="check_park" class="btn btn-default check_park" data-toggle="tooltip" data-placement="top" style="width: 16px;height: 16px;">
														<input type="hidden" name="ticket_agency_typeno" id="ticket_agency_typeno" class="ticket_agency_typeno" value="'.$row_cticket->ticket_agency_typeno.'">
														<input type="hidden" name="package_typeno" id="package_typeno" class="package_typeno" value="'.$row_cticket->package_typeno.'">
														<input type="hidden" name="parkcode" id="parkcode" class="parkcode" value="'.$row_cticket->park.'">
														<input type="hidden" name="vis_typeno" id="vis_typeno" class="vis_typeno" value="'.$row_qr->vis_typeno.'">
													</td>
												</tr>';
						}
						$jj++;
					}
				}
				if($jj > 1){
					$tr.='<tr>
							<td>'.($ii++).'</td>
							<td colspan="6">Package name :<b>'.$row_qr->package_name.'</b>&nbsp;&nbsp;
							'.$reference.' :<b>'.$row_qr->ticket_no.'</b>
							</td>
							<td class="delete_td">&nbsp;</td>
						</tr>'.$row_check_ticket;
				}
			}
		}
		
		$arrJson['tr'] = $tr;
		return json_encode($arrJson);	
	}

	function mcheck_ticket(){
		$ticket_agency_typeno =  trim($this->input->post('ticket_agency_typeno',true));
		$app_typeno           =  trim($this->input->post('app_typeno',true));
        $package_typeno       =  trim($this->input->post('package_typeno',true));
        $parkcode 			  =  trim($this->input->post('parkcode',true));
        $vis_typeno 		  =  trim($this->input->post('vis_typeno',true));
        $date                 =  date('Y-m-d H:i:s');
        $this->db->query("UPDATE tran_ticket_check_park SET check_in_status =1,checking_date='".$date."'
        												WHERE 1=1
        												AND ticket_agency_typeno='".$ticket_agency_typeno."' 
        												AND package_typeno='".$package_typeno."'
        												AND park='".$parkcode."'");
       	

        $update_appr = $this->db->query("SELECT
											tbl1.app_agency,
											tbl1.ticket_agency_typeno,
											tbl1.amtch1,
											IFNULL(tbl2.amtch2,0) AS amtch2
										FROM
										(
											SELECT COUNT(*) AS amtch1,tt1.ticket_agency_typeno,app_agency FROM tran_ticket_check_park AS tt1 GROUP BY tt1.ticket_agency_typeno
										) AS tbl1
										LEFT JOIN
										(
											SELECT COUNT(*) AS amtch2,tt2.ticket_agency_typeno FROM tran_ticket_check_park AS tt2 
											WHERE tt2.check_in_status=1 GROUP BY tt2.ticket_agency_typeno
										) AS tbl2
										ON tbl1.ticket_agency_typeno = tbl2.ticket_agency_typeno
										WHERE tbl1.ticket_agency_typeno = '".$ticket_agency_typeno."'
										AND tbl1.app_agency='".$app_typeno."'");
    	if($update_appr->num_rows() > 0){
        	if($update_appr->row()->amtch1 == $update_appr->row()->amtch2){
    			$this->db->query("UPDATE tran_agency_approval_detail SET checkin_status=1 WHERE 1=1 AND ticket_typeno='".$ticket_agency_typeno."'");
    			$this->db->query("UPDATE tran_ticket SET checkin_status=1, date_checkin='".$date."' WHERE 1=1 AND ticket_typeno='".$ticket_agency_typeno."'");
    		}
        }
	    $sql_updatestatus = $this->db->query("SELECT
											tblcheck1.app_typeno,
											tblcheck1.amt_check1,
											tblcheck2.amt_check2
											FROM
											(SELECT COUNT(*) amt_check1,app_typeno FROM tran_ticket GROUP BY app_typeno) AS tblcheck1
											LEFT JOIN(SELECT COUNT(*) amt_check2,app_typeno FROM tran_ticket WHERE checkin_status=1 GROUP BY app_typeno) AS tblcheck2
											ON tblcheck1.app_typeno = tblcheck2.app_typeno
											WHERE tblcheck1.app_typeno='".$app_typeno."'");
	    if($sql_updatestatus->num_rows() > 0){
	    	if($sql_updatestatus->row()->amt_check1 == $sql_updatestatus->row()->amt_check2){
	    		if($vis_typeno == 2){
					$this->db->query("UPDATE tran_agency_approval SET check_status=1 WHERE 1=1 AND agency_trans_typeno='".$app_typeno."'");
	    		}
	    		$this->db->query("UPDATE tran_application SET checkin_status=1 WHERE 1=1 AND app_typeno='".$app_typeno."'");
	    	}
	    }
        
	    $arr['ok'] = "OK";
        return json_encode($arr);
	}
}