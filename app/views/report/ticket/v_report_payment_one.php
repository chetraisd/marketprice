<meta charset="UTF-8"> 
<style type="text/css">
	.container_one{
		border: 1px solid black;
		width:19.5cm;
		height:8.5cm;
		margin:10px 0px;
	}
	#cont_left_one{
		float:left;
		width:3.8cm;
		height:100%;
		border-right:1px dotted black;
		background:: blue;
		text-align: center;
	}
	#cont_center_one{
		float:left;
		width:9.2cm;
		height:100%;
		border-right:1px dotted black;
		margin:0;
		padding:0;
	}

	#cont_right_one{
		float:left;
		width:4.2cm;
		height:100%;
		border-right:1px dotted black;
	}

	#check_date_one{
		-ms-transform: rotate(-90deg); /* IE 9 */
	    -webkit-transform: rotate(-90deg); /* Chrome, Safari, Opera */
	    transform: rotate(-90deg);
		float: right;
		width:8.5cm;
		height:2.29cm;
		border: 0px solid black;
		margin:-205px -117px 0px 0px;
		padding:0;
	}
	

</style>
<?php 
// $sql_tranticket = $this->db->query("SELECT
// 										tran_ticket.app_type,
// 										tran_ticket.app_typeno,
// 										tran_ticket.par_type,
// 										tran_ticket.par_typeno,
// 										tran_ticket.price,
// 										tran_ticket.validitydate,
// 										tran_ticket.expirydate,
// 										tran_ticket.qty_day,
// 										tran_ticket.ticket_type,
// 										tran_ticket.ticket_typeno
// 									FROM
// 										tran_ticket
// 									WHERE app_typeno = '".$app_typeno."'")->result();
// $img = "";
// $prince = 0;
// if(count($sql_tranticket) > 0){
// 	foreach($sql_tranticket as $row_tan){
// 		$img = $this->db->query("SELECT image,park_name FROM set_park WHERE par_typeno='".$row_tan->par_typeno."'")->row();
// 		$prince+=$row_tan->price;
// 	}
// }

if($old_type == 1 AND $is_local == 1 ){
	echo "Chile and local";
}else if($old_type == 1 AND $is_local == 0 ){
	echo "Child and foreing";
}else if($old_type == 0 AND $is_local == 1 ){
	echo "Adult and local";
}else{
	echo "Adult and foreing";
}
?>
<center>
<div class="container_one">
	<div id="cont_left_one">
		<p style="text-align:center;margin:0;color:red;font-size:14px;">HUẾ</p>
		<p style="text-align:center;margin:0;font-size:10px;color:#0099ff;"><b>DI SÀN VÂN HÒA THẾ GIỜ</b></p>
		<p style="text-align:center;margin:0;font-size:7px;color:#0099ff;">WORLD CULTURAL HERITAGE</p>
		<p style="text-align:center;margin:0;font-size:6px;"><b>TRUNG TÂM BẢO TỒN DI TÍCH CỐ ĐÔ HUẾ<br></b>
		<p style="text-align:center;margin:0;font-size:5px;"><b>HUẾ MONUMENTS CONSERVATION CENTER</b></P>
		<p style="text-align:center;margin:0px 0px 5px 0px;font-size:6px;">23 Tống Duy Tân, TP. Huế * MST: 3300100723</p>
		<img src="<?php echo base_url("assets/images/logo/V-logo.png"); ?>" style="text-align:center;width:37.79px;height:37.79px;">
		<p style="text-align:center;margin:5px 0px 0px 0px;font-size:7px;letter-spacing:-1px;"><b>BIÊN LAI THU TIỀN PHÍ, LÊ PHÍ IN SẴN MÊNH GIÁ</b></p>
		<p style="text-align:center;margin:0;font-size:6px;"><b>FEE RECEIPT WITH FACE VALUE</b></p>
		<p style="text-align:left;margin:5px 0px 0px 9px;font-size:8px;">Mẫu số <i>(Form)</i>:</p>
		<p style="text-align:left;margin:0px 9px;font-size:8px;">Ký hiêu <i>(Series)</i>:AH-15P</p>
		<p style="text-align:left;margin:0px 9px;font-size:8px;">Liên 1: Lưu <i>(For archives)</i></p>
		<p style="text-align:center;margin:5px 0px 0px 0px;font-size:7px;"><b>VÉ THAM QUAN LÂNG MINH MẠNG</b></p>
		<p style="text-align:center;margin:0px;font-size:7px;"><b>MINH MANG TOMB ENTRANCE TICKET</b></p>
		<p style="text-align:center;margin:0px;font-size:10px;"><b>Giá tiền</b><i>(Price)</i>: <b><?php echo $price; ?> VNĐ</b></p>
		<p style="text-align:center;margin:0px;font-size:6px;">
			<b><i>Bằng chữ </b>(in words):<b> Một trăm nghìn đồng</i></b>
		</p>
		<p style="text-align:center;margin:0px;font-size:6px;">
			<i>One hundred thousand dong</i>
		</p>
		<p style="margin:15px 0px 0px 10px;font-size:9px;text-align:left;"><b>Số:&nbsp;<?php echo $ticket1;?></b></p>
		<p style="margin:0px 0px 5px 10px;font-size:5px;text-align:left;">(No):</p>
		<p style="margin:0px;font-size:5px;text-align:left;">
			<span style="margin-left:10px;font-size:5px;float:left;">Ngày <i>(Date)</i>..........tháng <i>(month)</i>............năm <i>(year)</i>...............</span>
			<span style="margin-right:20px;font-size:5px;float:right;"><b>Người thu tiền</b> <i>(Cashier)</i></span>
			<span style="margin-right:10px;font-size:5px;float:right;">Ký ghi rõ họ tên (Signature & full name)</span><br>
		</p>
		<p style="margin:58px 0px 0px 0px;font-size:4px;">In tại Công ty Cổ phần in Thuận Phát, 15 Lê Quý Đôn, Huế</p>
		<p style="margin:0px;font-size:4px;">Printed in Thuan Phat Joint-Stock company. Add: 15 Le Quy Don, Hue</p>
	</div>
	<div id="cont_center_one">
		<div style="margin:0; text-align:center;background:url('<?php echo base_url("assets/upload/27.jpg");?>');width: 9.2cm;height:7cm; background-size: 9.2cm 7cm;background-repeat: no-repeat;">
			<p style="margin:0;font-size:10px"><b>VÉ THAM QUAN LĂNG MINH MẠNG</b></p>
			<p style="margin:0;font-size:10px"><b>MINH MANG TOMB ENTRANCE TICKET</b></p>
		</div>
		<div style="border:0px solid black;float:left;width:200px;">
			<p style="font-size:8px;text-align:left;margin:17px 0px 0px 10px;"><i>Nhà tài trợ in vé tham quan</i></p>
			<p style="font-size:7px;text-align:left;margin:0px 0px 0px 10px;"><b>NGÂN HÀNG TMCP NGOAI THƯƠNG VIỆT NAM</b></p>
			<p style="font-size:7px;text-align:left;margin:0px 0px 0px 10px;"><b>www.vietcombank.com.vn</b></p>
		</div>
		<div style="float:left;width:140px;border:0px solid black;margin:10px 0px 0px 7px;">
			<img src="<?php echo base_url("assets/images/logo/vietcombank2.png");?>" width="113.38" height="37.79">
		</div>
	</div>
	<div id="cont_right_one">
		<p style="font-size:7px; margin:5px 0 0 0;">CÔNG HÒA XÃ HÔI CHỦ NGHĨA VIÊT NAM</p>
		<p style="font-size:7px; margin:0px;"><b>Độc lập - Tư do - Hạnh phúc</b></p>
		<hr style="margin:0px; width:95px;">
		<p style="font-size:6px; margin:0px;">SOCIALIST REPUBLIC OF VIETNAM</p>
		<p style="font-size:6px; margin:0px;"><b>Independence - Freedom - Happiness</b></p>
		<p style="font-size:10px;margin:0;color:red;">HUẾ</p>
		<p style="font-size:8px;margin:0;color:#0099ff;">DI SẢN VĂN HÓA THE GIỨI</p>
		<p style="font-size:6px;margin:0;color:#0099ff;">WORLD CULTURAL HERITAGE</p>
		<p style="font-size:5px;margin:0;"><b>TRUNG TÂM BẢO TỒN DI TÍCH CỐ ĐÔ HUẾ<br>HUE MONUMENTS CONSERVATION CENTER</b></p>
		<p style="text-align:center;margin:0px 0px 5px 0px;font-size:5px;">23 Tống Duy Tân, TP. Huế * MST: 3300100723</p>
		<img src="<?php echo base_url("assets/images/logo/V-logo.png"); ?>" style="text-align:center;width:30px;height:30px;">
		<p style="margin:0px;font-size:6px;letter-spacing:0px;"><b>BIÊN LAI THU TIỀN PHÍ, LÊ PHÍ IN SẴN MÊNH GIÁ</b></p>
		<p style="margin:0px 9px;font-size:6px;"><b>FEE RECEIPT WITH FACE VALU</b></p>
		<p style="text-align:left;margin:0px 0px 0px 5px;font-size:8px;">Mẫu số:&nbsp;<?php echo $app_typeno;?></p>
		<p style="text-align:left;margin:0px 0px 0px 5px;font-size:8px;">Ký hiêu:&nbsp;AH-15P</p>
		<p style="text-align:left;margin:0px 0px 0px 5px;font-size:8px;">Liên 2:&nbsp;Giao người nộp tiền <i>(For visitor)</i></p>
		<p style="text-align:center;margin:0px;font-size:8px;"><b>VÉ THAM QUAN LĂNG MINH MẠNG</b></p>
		<p style="text-align:center;margin:0px;font-size:8px;"><b>MINH MANG TOMB ENTRANCE TICKET</b></p>
		<p style="text-align:center;margin:0px;font-size:10px;"><b>Giá tiền&nbsp;</b><i>(Prices)</i>:<span><b><?php echo $price; ?> VNĐ</b></span></p>
		<p style="text-align:center;margin:0px;font-size:6px;">
			<b><i>Bằng chũ </b>(In words):<b> Một trăm nghìn đồng</i></b>
		</p>
		<p style="text-align:center;margin:0px;font-size:6px;"><i>One hundred thousand dong</i></p>
		<p style="text-align:left;margin:5px 0px 0px 9px;font-size:9px;"><b>Số:&nbsp;<?php echo $ticket1;?></b></p>
		<p style="text-align:left;margin:0px 0px 0px 9px;font-size:5px;">(No):</p>
		<p style="margin:0px;font-size:10px;">
			<span style="margin-left:20px;font-size:5px;float:left;">Ngày <i>(Date)</i>............tháng <i>(month)</i>............năm <i>(year)</i>...............</span>
			<span style="margin:0px 5px 0px 0px;font-size:5px;float:right;width:100%;text-align:right;"><b>Người thu tiền</b><i> (Cashier)</i></span>
			<span style="margin:0px 5px 0px 0px;font-size:5px;float:right;width:100%;text-align:right;"><i>Ký ghi rõ họ tên (Signature &full name)</i></span>
		</p>
		<p style="margin-top:66px;font-size:4px;">
			In tại Công ty Cổ phần in Thuận Phát, 15 Lê Quý Đôn, Huế<br>
			Printed in Thuan Phat Joint-Stock company. Add: 15 Le Quy Don, Hue City*Mã số thuế: 3300372452
		</p>
	</div>
	<div id="check_date_one">
    	<p style="font-size:12px; margin:10px 0px 0px 0px;"><b><?php echo $parkname1[1];?></b></p>
    	<p style="font-size:9px; margin:0px;"><b>CHECKING PART</b></p>
		<p style="font-size:8px; margin:0px;"><b>Giá tiền</b><i> (Price)</i>:<b style="font-size:10px;"><?php echo $price; ?> VNĐ</b></p>
		<p style="font-size:7px; margin:0px;"><b>Bằng chữ </b><i>(In words)</i>:<b><i> Một trăm nghìn đồng</i></b></p>
    	<p style="font-size:7px; margin:0px;"><i>One hundred thousand dong </i></p>
	</div>
</div>
<hr style="border:1px dotted black; width:100%;">
</center>