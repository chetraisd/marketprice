<meta charset="UTF-8"> 
<style type="text/css">
	body{
		margin:0;
		padding:0;
	}
	.container_four_childfor{
		border: 1px solid black;
		width:19.5cm;
		height:8.5cm;
		margin:0px;
		padding:0px;
		float:left;
	}
	.container_four_childfor #cont_left_four{
		float:left;
		width:3.7cm;
		height:100%;
		border-right:0px dotted black;
		background:: blue;
		text-align: center;
	}
	.container_four_childfor #cont_center_four{
		float:left;
		width:9.2cm;
		height:100%;
		border-right:0px dotted black;
		margin:0;
		padding:0;
	}

	.container_four_childfor #cont_right_four{
		float:left;
		width:4.2cm;
		height:100%;
		border-right:0px dotted black;
	}

	.container_four_childfor #check_date_four{
		float: left;
		width: 2.29cm;
		height: 100%;
		border-right: 0px dotted black;
	}
	
</style>
<?php 
$symbal_curr = $this->db->query("SELECT symbol FROM set_currencies WHERE cur_typeno='".$symbal_cur."'")->row()->symbol;
?> 

<div class="container_four_childfor">
	<div id="cont_left_four">
		<p style="margin:123.72px 0px 0px 60px;float: left;font-size: 10px;"><?php echo $number_form;?></p>
		<p style="margin:0px 0px 0px 66px;float: left;font-size: 9px;"><?php echo $prefix;?></p>
		<span style="margin:41px 0px 0px 60px;float: left;">
			<p style="font-size: 10px;float: left; margin:0px;padding:0px;"><?php echo $price;?></p>&nbsp;&nbsp;
			<p style="font-size: 15px;float: left; margin:0px;padding:0px;"><b><?php echo $symbal_curr;?></b></p>
		</span>
		<p style="margin:25px 0px 0px 30.23px;float: left;font-size: 10px;"><?php echo $ticket;?></p>
		<?php
			$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
			//include APPPATH."libraries/qrcode/qrlib.php";
			$filename = $PNG_TEMP_DIR.'/'.$ticket.'.png';
			QRcode::png($ticket, $filename, "L", 1, 4);

		?>
		<span style="float:left;margin:20px 0 0 5px;">
			<img src="<?php echo site_url('app/views/report/ticket/ticketfour/temp/'.basename($filename));?>">
		</span>
	</div>
	<div id="cont_center_four">
		
	</div>
	<div id="cont_right_four">
		<div id="cont_right_one">
			<p style="margin:138px 0px 0px 75px;float: left;font-size: 10px;"><?php echo $number_form;?></p>
			<p style="margin:0px 0px 0px 80px;float: left;font-size: 10px;"><?php echo $prefix;?></p>
			<span style="margin:36px 0px 0px 85px;float: left;">
				<p style="font-size: 10px;float: left; margin:0px;"><?php echo $price;?></p>&nbsp;&nbsp;
				<p style="font-size: 15px;float: left; margin:0px;padding:0px;"><b><?php echo $symbal_curr;?></b></p>
			</span>
			<p style="margin:18px 0px 0px 45px;float: left;font-size: 10px;"><?php echo $ticket;?></p>
			<span style="float:left;margin:20px 0 0 25px;">
				<img src="<?php echo site_url('app/views/report/ticket/ticketfour/temp/'.basename($filename));?>">
			</span>
		</div>
	</div>
	<div id="check_date_four">
		
	</div>
</div>