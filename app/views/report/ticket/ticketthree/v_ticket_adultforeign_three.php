<meta charset="UTF-8"> 
<style type="text/css">
	body{
		margin:0;
		padding:0;
	}
	.container_three_adultfor{
		border: 1px solid black;
		width:19.5cm;
		height:8.5cm;
		margin:0px;
		padding:0px;
		float:left;
	}
	.container_three_adultfor #cont_left_three{
		float:left;
		width:3.7cm;
		height:100%;
		border-right:0px dotted black;
		background:: blue;
		text-align: center;
	}
	.container_three_adultfor #cont_center_three{
		float:left;
		width:9.2cm;
		height:100%;
		border-right:0px dotted black;
		margin:0;
		padding:0;
	}

	.container_three_adultfor #cont_right_three{
		float:left;
		width:4.2cm;
		height:100%;
		border-right:0px dotted black;
	}

	.container_three_adultfor #check_date_three{
		float: left;
		width: 2.30cm;
		height: 100%;
		border-right: 0px dotted black;
	}
	
	/*#tick_check{
		float: left;
		width: 2cm;
		height: 20px;
		border-bottom: 1px dotted black;
		text-align:: center;
		
	}
	#tick_check:last-child{
		border-bottom:none;
	}*/
</style>
<?php
$symbal_curr = $this->db->query("SELECT symbol FROM set_currencies WHERE cur_typeno='".$symbal_cur."'")->row()->symbol;
?>
<div class="container_three_adultfor">
	<div id="cont_left_three">
		<p style="margin:123.72px 0px 0px 60px;float: left;font-size: 10px;width:100%;text-align: left;"><?php echo $number_form;?>&nbsp;</p>
		<p style="margin:0px 0px 0px 66px;float: left;font-size: 9px;width:100%;text-align: left;"><?php echo $prefix;?>&nbsp;</p>
		<span style="margin:41px 0px 0px 60px;float: left;width:100%;text-align: left;">
			<p style="font-size: 10px;float: left; margin:0px;padding:0px;"><?php echo $price;?></p>&nbsp;&nbsp;
			<p style="font-size: 15px;float: left; margin:0px;padding:0px;"><b><?php echo $symbal_curr;?></b></p>
		</span>
		<p style="margin:25px 0px 0px 30.23px;float: left;font-size: 10px;width:100%;text-align: left;"><?php echo $ticket;?></p>
		<?php
			$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
			//include APPPATH."libraries/qrcode/qrlib.php";
			$filename = $PNG_TEMP_DIR.'/'.$ticket.'.png';
			QRcode::png($ticket, $filename, "L", 1, 4);

		?>
		<span style="float:left;margin:20px 0 0 11.33px;">
			<img src="<?php echo site_url('app/views/report/ticket/ticketthree/temp/'.basename($filename));?>">
		</span>
	</div>
	<div id="cont_center_three">
		
	</div>
	<div id="cont_right_three">
		<p style="margin:138px 0px 0px 75px;float: left;font-size: 10px;width:100%;text-align: left;"><?php echo $number_form;?>&nbsp;</p>
		<p style="margin:0px 0px 0px 80px;float: left;font-size: 10px;width:100%;text-align: left;"><?php echo $prefix;?></p>
		<span style="margin:36px 0px 0px 85px;float: left;width:100%;text-align: left;">
			<p style="font-size: 10px;float: left; margin:0px;"><?php echo $price;?></p>&nbsp;&nbsp;
			<p style="font-size: 15px;float: left; margin:0px;padding:0px;"><b><?php echo $symbal_curr;?></b></p>
		</span>
		<p style="margin:18px 0px 0px 45px;float: left;font-size: 10px; width:100%; text-align: left;"><?php echo $ticket;?></p>
		<span style="float:left;margin:20px 0 0 11.33px;">
			<img src="<?php echo site_url('app/views/report/ticket/ticketthree/temp/'.basename($filename));?>">
		</span>
	</div>
	<div id="check_date_three">
		
	</div>
</div>