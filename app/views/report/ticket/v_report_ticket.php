<meta charset="UTF-8"> 
<style type="text/css">
</style>
<center>
<?php include APPPATH."libraries/qrcode/qrlib.php";?>
<div class="container" id="show_contain" style="border:: 1px solid black;">
	<?php 
		$where = "";
		if($ticket_no != ""){
			$where = " AND ticket_no='".$ticket_no."'";
		}
		$sql_ticket = $this->db->query("SELECT
											tran_ticket.ticket_type,
											tran_ticket.ticket_typeno,
											tran_ticket.app_type,
											tran_ticket.app_typeno,
											tran_ticket.tic_type_typeno,
											tran_ticket.type_of_package,
											tran_ticket.package_typeno,
											tran_ticket.price,
											tran_ticket.discount,
											tran_ticket.validitydate,
											tran_ticket.expirydate,
											tran_ticket.qty_day,
											tran_ticket.`status`,
											tran_ticket.create_by,
											tran_ticket.create_date,
											tran_ticket.cur_typeno,
											tran_ticket.exchange_rate,
											tran_ticket.date_checkin,
											tran_ticket.checkin_status,
											tran_ticket.number_visitor,
											tran_ticket.country,
											tran_ticket.gender,
											tran_ticket.old_type,
											tran_ticket.vis_typeno,
											tran_ticket.is_local,
											tran_ticket.ticket_no
											FROM
											tran_ticket
											WHERE app_typeno='".$app_typeno."' AND app_type='3' {$where}")->result();
			
			if(count($sql_ticket) > 0){
				foreach($sql_ticket as $row_ticket){
					$ticket_typeno = $row_ticket->ticket_typeno;
					$ticket_price  = $row_ticket->price;
					$old_type      = $row_ticket->old_type;
					$is_local      = $row_ticket->is_local;

					$sql_ser_form = "";
					if($old_type == 0 AND $is_local == 0){
						$sql_ser_form = $this->db->query("SELECT fore_adult_form AS tform,fore_adult_series AS tseries FROM set_park_package WHERE package_typeno='".$row_ticket->package_typeno."'");
					}else if($old_type == 0 AND $is_local == 1){
						$sql_ser_form = $this->db->query("SELECT loc_adult_form AS tform,loc_adult_series AS tseries FROM set_park_package WHERE package_typeno='".$row_ticket->package_typeno."'");
					}else if($old_type == 1 AND $is_local == 0){
						$sql_ser_form = $this->db->query("SELECT fore_child_form AS tform,fore_child_series AS tseries FROM set_park_package WHERE package_typeno='".$row_ticket->package_typeno."'");
					}else if($old_type == 1 AND $is_local == 1){
						$sql_ser_form = $this->db->query("SELECT loc_child_form AS tform,loc_child_series AS tseries FROM set_park_package WHERE package_typeno='".$row_ticket->package_typeno."'");
					}
					//$prefix        = $row_ticket->ticket_no;
					$symbal_cur    = $row_ticket->cur_typeno;
					$number_form   = "";
					$prefix        = "";
					if($sql_ser_form->num_rows() > 0){
						$number_form = $sql_ser_form->row()->tform;
						$prefix      = $sql_ser_form->row()->tseries;
					}
					$sql_packege   = $this->db->query("SELECT
														sppd.package_type,
														sppd.package_typeno,
														sppd.par_type,
														sppd.par_typeno,
														sppd.type_of,
														set_park.park_name,
														set_park.description
														FROM
														set_park_package_detail as sppd
														INNER JOIN set_park ON sppd.par_typeno = set_park.par_typeno AND sppd.par_type = set_park.par_type
														WHERE package_typeno = '".$row_ticket->package_typeno."'");
					$name_park = "";
					$ii = 0;
					$parkname = array();
					if($sql_packege->num_rows() > 0){
						foreach($sql_packege->result() as $row_park){
							$ii++;
							$parkname[$ii] = $row_park->park_name;
							$name_park.='<span>'.$row_park->park_name.'</span>';
						}
					}
					if($ii == 1){
						//$data['ticket']   = $ticket_typeno;
						$data['ticket']   = $row_ticket->ticket_no;
						$data['parkname'] = $parkname;
						$data['price']    = $ticket_price;
						$data['prefix']   = $prefix;
						$data['symbal_cur']= $symbal_cur;
						$data['number_form']=$number_form;
						$this->load->view("report/ticket/ticketone/v_ticket_one",$data);
						
						
					}
					else if($ii == 2){
						//$data['ticket']    = $ticket_typeno;
						$data['ticket']   = $row_ticket->ticket_no;
						$data['parkname']  = $parkname;
						$data['price']     = $ticket_price;
						$data['prefix']    = $prefix;
						$data['symbal_cur']= $symbal_cur;
						$data['number_form']=$number_form;
						$this->load->view("report/ticket/tickettwo/v_ticket_two",$data);
						
					}
					else if($ii == 3){
						//$data['ticket']   = $ticket_typeno;
						$data['ticket']   = $row_ticket->ticket_no;
						$data['parkname'] = $parkname;
						$data['price']     = $ticket_price;
						$data['prefix']    = $prefix;
						$data['symbal_cur']= $symbal_cur;
						$data['number_form']=$number_form;
						$this->load->view("report/ticket/ticketthree/v_ticket_three",$data);
						
					}
					else if($ii == 4){
						//$data['ticket']   = $ticket_typeno;
						$data['ticket']   = $row_ticket->ticket_no;
						$data['parkname'] = $parkname;
						$data['price']     = $ticket_price;
						$data['prefix']    = $prefix;
						$data['symbal_cur']= $symbal_cur;
						$data['number_form']=$number_form;
						$this->load->view("report/ticket/ticketfour/v_ticket_four",$data);
						
					}
				}
			}

		?>
</div>
</center>
<script src="<?php echo base_url('assets/js_print/jquery/jquery-1.4.4.js');?>"></script>
<script src="<?php echo base_url('assets/js_print/jqprint.0.3.js');?>"></script>
<script type="text/javascript">
$(function(){

	$(window).load(function(e){
		var app_typeno = <?= $app_typeno; ?>;
		var $symbal_cur = <?= $symbal_cur; ?>;
		var ii = 1;
		if( ii == 1){
			$("#show_contain").jqprint();
		}else if(ii == 2){
			window.open("<?= site_url('report/c_report_payment/print_receipt') ?>?app_typeno="+app_typeno+"&curr_code='ssfdsf'","_blank");
		}else if( ii == 3){
			$("#show_contain").jqprint();
			window.open("<?= site_url('report/c_report_payment/print_receipt') ?>?app_typeno="+app_typeno+"&curr_code="+$symbal_cur,"_blank");
		}
		
	});
	//$(".td_right").html(formatNumber($(".td_right").html()));
});

</script>
