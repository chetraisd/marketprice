<style type="text/css"> 
	.pd-bottom{ padding-bottom: 10px;}
</style>
<html>
	<!-- <center>  -->

	<?php 

	$app_typeno = $_GET['app_typeno'];
	//$symbol = $_GET['curr_code'];
	$sql_ticket = $this->db->query("SELECT
										tran_ticket.ticket_typeno,
										tran_ticket.app_typeno,
										DATE_FORMAT(tran_ticket.create_date,'%d/%m/%Y') AS display_date,
										set_park_package.package_name,
										ROUND(tran_ticket.price,3) AS price,
										ROUND(tran_ticket.discount,3) AS discount,
										tran_ticket.ticket_no
										FROM
										tran_ticket
										INNER JOIN set_park_package ON tran_ticket.package_typeno = set_park_package.package_typeno
										WHERE 1=1 AND tran_ticket.app_typeno='".$app_typeno."'");
	$tr="";
	$symbol = $this->db->query("SELECT symbol FROM set_currencies WHERE cur_default=1")->row()->symbol;
	// if($symbol->num_rows() > 0){
	// 	$symbol = $symbol;
	// }
	//$symbol = $this->db->query("SELECT symbol FROM set_currencies WHERE cur_typeno='".$symbol11."'")->row()->symbol;
	if($sql_ticket->num_rows() > 0){
		foreach($sql_ticket->result() as $row_ticket){
			$tr.='<table align="center" id="tbl_receipt" cellpadding="0" style="font-size:13px; font-family:Verdana;" width="300px">
					<tr> 
						<td colspan="3" style="text-align:center;"><img src="'.base_url('assets/images/logo/V-logo.png').'" width="100"></td>
					</tr>
					<tr><td colspan="3">&nbsp;</td></tr>
					<tr> 
						<td class="pd-bottom">Date</td>
						<td class="pd-bottom">:</td>
						<td class="pd-bottom">'.$row_ticket->display_date.'</td>
					</tr>
					<tr> 
						<td class="pd-bottom">Ticket No</td>
						<td class="pd-bottom">:</td>
						<td class="pd-bottom">'.$row_ticket->ticket_no.'</td>
					</tr>
					<tr> 
						<td class="pd-bottom">Park/Package</td>
						<td class="pd-bottom">:</td>
						<td class="pd-bottom">'.$row_ticket->package_name.'</td>
					</tr>
					<tr> 
						<td class="pd-bottom">Price</td>
						<td class="pd-bottom">:</td>
						<td class="pd-bottom">'.$row_ticket->price.'</td>
					</tr>
					<tr> 
						<td class="pd-bottom">Discount</td>
						<td class="pd-bottom">:</td>
						<td class="pd-bottom">'.$row_ticket->discount.'</td>
					</tr>
					<tr> 
						<td class="pd-bottom">Amount</td>
						<td class="pd-bottom">:</td>
						<td class="pd-bottom">'.($row_ticket->price-$row_ticket->discount).'</td>
					</tr>
				</table>';

			$tr.='<br><div style="height: 2px;page-break-after: always;"></div>';
		}
	}

	?>
	<div id="show_receipt"><?php echo $tr;?></div>
<!-- </center> -->
</html>
<script src="<?php echo base_url('assets/js_print/jquery/jquery-1.4.4.js');?>"></script>
<script src="<?php echo base_url('assets/js_print/jqprint.0.3.js');?>"></script>
<script type="text/javascript">
$(function(){
	$(window).load(function(e){
		//var data = $("#show_print").html();
		$("#show_receipt").jqprint();
	});
});

</script>