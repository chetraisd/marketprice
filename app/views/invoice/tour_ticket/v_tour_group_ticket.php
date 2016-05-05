<meta charset="UTF-8"> 
<style type="text/css">
	.container_two{
		border: 0px solid black;
		width:19.5cm;
		height:8.5cm;
		margin:10px 0;
		background-color:;
	}
	#cont_left_two{
		float:left;
		width:6.4cm;
		height:100%;
		border-right:1px dotted black;
		background:: blue;
		text-align: center;
	}
	#cont_center_two{
		float:left;
		width:6.5cm;
		height:100%;
		border-right:1px dotted black;
		margin:0;
		padding:0;
	}

	#cont_right_two{
		float:left;
		width:6.4cm;
		height:100%;
		border:0px dotted black;
	}

</style>
<?php 
	
	$query_agency = $this->db->query("SELECT
										tran_agency_approval.agency_trans_typeno,
										tran_agency_approval.visitor_number,
										tran_agency_approval.visit_date,
										tran_agency_approval.description,
										tran_agency_approval.agency_refer_code,
										tran_agency_approval.reguester_by,
										tran_agency_approval.agency_typeno
									FROM
										tran_agency_approval 
									WHERE agency_trans_typeno = '".$agency_trans_typeno."'")->row(); 
	if(COUNT($query_agency) > 0){

		$agency_trans_typeno = $query_agency->agency_trans_typeno;
		$visitor_number = $query_agency->visitor_number;
		$note = $query_agency->description;
		$visit_date = $query_agency->visit_date;
		$tour_guide = $query_agency->reguester_by;

		$agency_code = $this->db->query("SELECT
											set_agency_register.agency_code
										FROM
											set_agency_register 
										WHERE agency_typeno = '".$query_agency->agency_typeno."'")->row()->agency_code;
		
		$query_agency_detail = $this->db->query("SELECT
													tran_agency_approval_detail.ticket_no
												FROM
													tran_agency_approval_detail 
												WHERE agency_trans_typeno = '".$agency_trans_typeno."' AND package_typeno='".$package_typeno."'")->result();
		$ticket_number = '';
		foreach($query_agency_detail as $data){
			$ticket_number = $data->ticket_no;
?>
			<center>
			<div class="container_two">
				<div id="cont_left_two">
					<center>
						<table style="padding-top:5px; color:#337ab7; width:90%;">
							<tr> 
								<td style="text-align:center; font-size:10px;">CÔNG TY TNHH MỘT THÀNH VIÊN <br>DỊCH VỤ LỮ HÀNH SAIGONTOURIST</td>
							</tr>
							
							<tr> 
								<td style="text-align:center; font-weight:bold; font-family:Verdana; font-size:10px;">CHI NHÁNH TẠI ĐÀ NẴNG</td>
							</tr>
							<tr> 
								<td style="text-align:center; font-weight:bold; font-size:12px; font-family:Verdana;">PHIẾU THAM QUAN</td>
							</tr>
							<tr> 
								<td style="text-align:center; font-size:16px; font-weight: bold; font-family:Verdana;"><i>KHẢI ĐỊNH</i></td>
							</tr>
							<tr> 
								<td style="text-align:center; font-weight:bold; font-size:10px;">(VÉ DÀNH CHO KHÁCH NƯỚC NGOÀI)</td>
							</tr>
							<tr> 
								<td style="text-align: center;"><span style=" font-weight:bold; font-family:Verdana; font-size:10px;">No: <?php echo $ticket_number; ?> </span> <span style="font-size:15px; color:red;"><b> <?php echo $query_agency->agency_refer_code; ?></b></span></td>
							</tr>
							<tr> 
								<td style="padding-top:0px;"><span style="font-size:12px;">Code đoàn : <b><?php echo $agency_code; ?></b></span></td>
							</tr>
							<tr> 
								<td style="padding-top:0px;"><span style="font-size:12px;">Số khách : <b><?php echo $visitor_number; ?></b></span></td>
							</tr>
							<tr> 
								<td style="padding-top:0px;"><span style="font-size:10px;">Bằng chữ : <?php echo $note; ?></span></td>
							</tr>
							<tr> 
								<td style="padding-top:0px;"><span style="font-size:10px;">Ngày tham quan: <?php echo $visit_date; ?></span></td>
							</tr>
							<tr>
								<td>
									<table style="width:100%; color:#337ab7;">
										<tr>
											<td style="width:50%;text-align:center;"><span style="font-size:8px; font-weight:bold;"><?php echo $tour_guide; ?></span></br><span style="font-size:8px;">( Ký ghi rõ họ tên )</span></td>
											<td style="width:50%;text-align:center;"><span style="font-size:8px; font-weight:bold;">Đơn vị phát hành</span></br><span style="font-size:8px;">( Saigontourist CN. Đà Nẵng )</span></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr> 
								<td style=" padding-top:20px;"><span style=" font-size:8px; padding-left:10px;">Phát hành theo sự thỏa thuận giữa</span></td>
							</tr>
							<tr> 
								<td><span style="font-size:8px; padding-left:10px;">CT TNHH MTV DV LH Saigon Tourist CN. Đà Nẵng</span></td>
							</tr>
							<tr> 
								<td><span style="font-size:8px; padding-left:10px;">Và trung tâm bảo tồn di tích cố đô huế</span></td>
							</tr>
							<tr> 
								<td style="padding-top:2px; text-align:center; font-size:10px;"><input type="checkbox" checked="checked">Phiếu có giá trị thanh toán</td>
							</tr>
						</table>
					</center>
				</div>
				<div id="cont_center_two">
					<center>
						<table style="padding-top:5px; color:#337ab7; width:90%;">
							<tr> 
								<td style="text-align:center; font-size:10px;">CÔNG TY TNHH MỘT THÀNH VIÊN <br>DỊCH VỤ LỮ HÀNH SAIGONTOURIST</td>
							</tr>
							
							<tr> 
								<td style="text-align:center; font-weight:bold; font-family:Verdana; font-size:10px;">CHI NHÁNH TẠI ĐÀ NẴNG</td>
							</tr>
							<tr> 
								<td style="text-align:center; font-weight:bold; font-size:12px; font-family:Verdana;">PHIẾU THAM QUAN</td>
							</tr>
							<tr> 
								<td style="text-align:center; font-size:16px; font-weight: bold; font-family:Verdana;"><i>KHẢI ĐỊNH</i></td>
							</tr>
							<tr> 
								<td style="text-align:center; font-weight:bold; font-size:10px;">(VÉ DÀNH CHO KHÁCH NƯỚC NGOÀI)</td>
							</tr>
							<tr> 
								<td style="text-align: center;"><span style=" font-weight:bold; font-family:Verdana; font-size:10px;">No: <?php echo $ticket_number; ?> </span> <span style="font-size:15px; color:red;"><b><?php echo $query_agency->agency_refer_code; ?></b></span></td>
							</tr>
							<tr> 
								<td style="padding-top:0px;"><span style="font-size:12px;">Code đoàn : <b><?php echo $agency_code; ?></b></span></td>
							</tr>
							<tr> 
								<td style="padding-top:0px;"><span style="font-size:12px;">Số khách : <b><?php echo $visitor_number; ?></b></span></td>
							</tr>
							<tr> 
								<td style="padding-top:0px;"><span style="font-size:10px;">Bằng chữ : <?php echo $note; ?></span></td>
							</tr>
							<tr> 
								<td style="padding-top:0px;"><span style="font-size:10px;">Ngày tham quan: <?php echo $visit_date; ?></span></td>
							</tr>
							<tr>
								<td>
									<table style="width:100%; color:#337ab7;">
										<tr>
											<td style="width:50%;text-align:center;"><span style="font-size:8px; font-weight:bold;"><?php echo $tour_guide; ?></span></br><span style="font-size:8px;">( Ký ghi rõ họ tên )</span></td>
											<td style="width:50%;text-align:center;"><span style="font-size:8px; font-weight:bold;">Đơn vị phát hành</span></br><span style="font-size:8px;">( Saigontourist CN. Đà Nẵng )</span></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr> 
								<td style=" padding-top:20px;"><span style=" font-size:8px; padding-left:10px;">Phát hành theo sự thỏa thuận giữa</span></td>
							</tr>
							<tr> 
								<td><span style="font-size:8px; padding-left:10px;">CT TNHH MTV DV LH Saigon Tourist CN. Đà Nẵng</span></td>
							</tr>
							<tr> 
								<td><span style="font-size:8px; padding-left:10px;">Và trung tâm bảo tồn di tích cố đô huế</span></td>
							</tr>
							<tr> 
								<td style="padding-top:2px; text-align:center; font-size:10px;"><input type="checkbox" checked="checked">Phiếu có giá trị thanh toán</td>
							</tr>
						</table>
					</center>
				</div>
				<div id="cont_right_two">
					<center>
						<table style="padding-top:5px; color:#337ab7; width:90%;">
							<tr> 
								<td style="text-align:center; font-size:10px;">CÔNG TY TNHH MỘT THÀNH VIÊN <br>DỊCH VỤ LỮ HÀNH SAIGONTOURIST</td>
							</tr>
							
							<tr> 
								<td style="text-align:center; font-weight:bold; font-family:Verdana; font-size:10px;">CHI NHÁNH TẠI ĐÀ NẴNG</td>
							</tr>
							<tr> 
								<td style="text-align:center; font-weight:bold; font-size:12px; font-family:Verdana;">PHIẾU THAM QUAN</td>
							</tr>
							<tr> 
								<td style="text-align:center; font-size:16px; font-weight: bold; font-family:Verdana;"><i>KHẢI ĐỊNH</i></td>
							</tr>
							<tr> 
								<td style="text-align:center; font-weight:bold; font-size:10px;">(VÉ DÀNH CHO KHÁCH NƯỚC NGOÀI)</td>
							</tr>
							<tr> 
								<td style="text-align: center;"><span style=" font-weight:bold; font-family:Verdana; font-size:10px;">No: <?php echo $ticket_number; ?> </span> <span style="font-size:15px; color:red;"><b><?php echo $query_agency->agency_refer_code; ?></b></span></td>
							</tr>
							<tr> 
								<td style="padding-top:0px;"><span style="font-size:12px;">Code đoàn :<b><?php echo $agency_code; ?></b></span></td>
							</tr>
							<tr> 
								<td style="padding-top:0px;"><span style="font-size:12px;">Số khách : <b><?php echo $visitor_number; ?></b></span></td>
							</tr>
							<tr> 
								<td style="padding-top:0px;"><span style="font-size:10px;">Bằng chữ : <?php echo $note; ?></span></td>
							</tr>
							<tr> 
								<td style="padding-top:0px;"><span style="font-size:10px;">Ngày tham quan: <?php echo $visit_date; ?></span></td>
							</tr>
							<tr>
								<td>
									<table style="width:100%; color:#337ab7;">
										<tr>
											<td style="width:50%;text-align:center;"><span style="font-size:8px; font-weight:bold;"><?php echo $tour_guide; ?></span></br><span style="font-size:8px;">( Ký ghi rõ họ tên )</span></td>
											<td style="width:50%;text-align:center;"><span style="font-size:8px; font-weight:bold;">Đơn vị phát hành</span></br><span style="font-size:8px;">( Saigontourist CN. Đà Nẵng )</span></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr> 
								<td style=" padding-top:20px;"><span style=" font-size:8px; padding-left:10px;">Phát hành theo sự thỏa thuận giữa</span></td>
							</tr>
							<tr> 
								<td><span style="font-size:8px; padding-left:10px;">CT TNHH MTV DV LH Saigon Tourist CN. Đà Nẵng</span></td>
							</tr>
							<tr> 
								<td><span style="font-size:8px; padding-left:10px;">Và trung tâm bảo tồn di tích cố đô huế</span></td>
							</tr>
							<tr> 
								<td style="padding-top:2px; text-align:center; font-size:10px;"><input type="checkbox" checked="checked">Phiếu có giá trị thanh toán</td>
							</tr>
						</table>
					</center>
				</div>
			</div>
			<hr style="border:1px dotted black; width:100%;">
			</center>

<?php 

		}
	}else{ 
		echo "Error this =>".$agency_trans_typeno;
	}

?>
<script src="<?php echo base_url('assets/js_print/jquery/jquery-1.4.4.js');?>"></script>
<script src="<?php echo base_url('assets/js_print/jqprint.0.3.js');?>"></script>
<script type="text/javascript">
$(function(){
	$(window).load(function(e){
		//var data = $("#show_print").html();
		$("#container_two").jqprint();
	});
	//$(".td_right").html(formatNumber($(".td_right").html()));
});

</script>