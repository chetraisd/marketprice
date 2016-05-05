<html>
<title>Report Summary</title>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--  barcode   --> 

</head>
<?php
	$type = $_REQUEST['type'];
	$typeno = $_REQUEST['typeno'];
	
	$sql_order = $this->db->query("SELECT
										tbl_invoice_order.id,
										tbl_invoice_order.customercode,
										DATE_FORMAT(tbl_invoice_order.date_inv,'%d-%m-%Y') as show_date,
										tbl_invoice_order.invoice,
										tbl_invoice_order.disease_code,
										tbl_invoice_order.amount,
										tbl_invoice_order.note,
										tbl_invoice_order.type,
										tbl_invoice_order.typeno,
										tbl_invoice_order.typeno,
										tbl_invoice_order.currcode
										FROM
										tbl_invoice_order
										WHERE type='".$type."' AND typeno='".$typeno."'")->row();
	$disease_type = $this->db->query("SELECT disease_name FROM tbl_disease_type WHERE disease_code='".$sql_order->disease_code."'")->row();
	$cust_inf     = $this->db->query("SELECT
											tbl_customer.customercode,
											tbl_customer.customername,
											tbl_customer.gender,
											tbl_customer.years
											FROM
											tbl_customer
											WHERE customercode='".$sql_order->customercode."'")->row();
	
	
	$sql_detail = "SELECT
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
						WHERE type='".$type."' AND typeno='".$typeno."'";
	$tr_detail = "";
	$ii = 1; 
	$total_paid = 0;
	$result = $this->db->query($sql_detail)->result();
	foreach($result as $row_detail){
		$service_type = $this->db->query("SELECT service_name FROM tbl_service_type WHERE service_code='".$row_detail->service_code."'")->row();
		$tr_detail.= '<tr>
							<td style="text-align:center;" class="td_center">'.$ii++.'</td>
							<td class="td_center">&nbsp;'.$disease_type->disease_name.'</td>
							<td class="td_center">&nbsp;'.$service_type->service_name.'</td>
							<td style="text-align:center;" class="td_center">'.$row_detail->quantity.'</td>
							<td style="text-align:right;" class="td_right td_center">'.$row_detail->amount.'&nbsp;&nbsp;'.$row_detail->currcode.'&nbsp;</td>
					  </tr>';
		$total_paid += $row_detail->amount;
	}
	$tr_detail.='<tr><td style="text-align:right;" colspan="4"><b>សរុប</b>&nbsp;&nbsp;</td><td style="text-align:right;" class="td_right"><b>'.$total_paid.'&nbsp;&nbsp;'.$row_detail->currcode.'&nbsp;</b></td></tr>';
	$barcode_cust = $cust_inf->customercode;
?>
<body>

<div class="contain" id="show_print">
<style type="text/css">
/* CSS Document */

.contain{
	width:95%;
	height:100%;
	margin-left: -10px;
	/*margin:0 auto;*/
	border:0px solid black;
	border: 0px solid #f00;
}
.title_head{
	width:100%;
	height:150px;
	border:0px solid #333;
	float:left;
}
#img_logo,#footer_logo{
	margin-top: -5px;
}
#logo_left{
	border:0px solid #333;
	float:left;
	width:20%;
	height:117px;
}
#title_logo{
	width:100%;
}
#logo_right{
	border:0px solid #333;
	float:right;
	width:30%;
	height:145px;
}
#titl_inv{
	float: left;
	border: 0px solid #333;
	width: 48%;
	margin: 110px 0px 0px 10px;
}

#inf_cust{
	float:left;
	width:100%;
	height:30px;
	margin-top:10px;
	border:0px solid #333;	
}
#show_tbl{
	float:left;
	width:100%;
	margin-top:5px;
}
#tbl_data{
	border:1px solid #000;
}
#tbl_data thead td{
	border-right:1px solid #000;
	border-bottom:1px solid #000;
}
#tbl_data .th_right{
	border-right:0px solid #000;
}

#show_data .td_center{
	/*border:1px solid #000;*/
	border-bottom:1px dotted #000;
}
#show_data td{
	border-right:1px dotted #000;
}
#show_data .td_right{
	border-right:0px solid #000;
}
</style>
	<div class="row result_info">
    	<div class="col-sm-12" style="text-align:center;">
        	<div class="title_head">
                    <div id="logo_left">
                        <div id="title_logo"><font style="font-family:Khmer OS Muol Light; font-size:14px;">ក្រសួងសុខាភិបាល</font></div>
                        <div id="img_logo"><img src="<?php echo base_url("assets/images/logo/logo_inv.png"); ?>" width="100" height="100"></div>
                        <div id="footer_logo"><font style="font-family:Khmer OS Muol Light; font-size:14px;">មន្ទីរពេទ្យព្រះអង្គឌួង</font></div>
					</div>
       				<div id="titl_inv"><b><font style="font-family:Khmer OS Muol Light; font-size:20px; margin-left:50px;">វិក្កយបត្រ</font></b></div>
                    <div id="logo_right">
                        <div id="img_barcode"><img src="<?php echo base_url('assets/barcode/Barcode39.php?code='.$barcode_cust); ?>"></div>
                        <br>
                        <div id="show_date">
                            <table style="tbl_heard">
                            	<tr><td>Invoice</td><td>:</td><td>&nbsp;<b> <?= $sql_order->invoice ?></b></td></tr>
                                <tr><td>Date</td><td>:</td><td>&nbsp;<b> <?= $sql_order->show_date ?></b></td></tr>
                                <!-- <tr><td>Disease type</td><td>:</td><td>&nbsp;<b><?= $disease_type->disease_name ?></b></td></tr> -->
                            </table>
                            
                        </div>
                    </div>
            </div><!-- end title header --> 
        </div>
    </div> 
    
    <div class="row">
    	<div class="col-sm-12">
        	<div id="inf_cust" style="text-align:center;">
            	<span style="">ឈ្មោះ&nbsp;&nbsp;&nbsp; :</span><span style="margin-left:30px;"><b><?=$cust_inf->customername ?></b></span>
                <span style="margin-left:50px;"> ភេទ​ </span><span style="margin-left:10px;"><b><?=$cust_inf->gender  ?></b></span>
                <span style="margin-left:30px;">អាយុ</span><span style="margin-left:10px;"><b><?= ($cust_inf->years != 0?$cust_inf->years:"") ?></b></span>
            </div>
        </div>
    </div>
    <br />
    
    <div class="row">
    	<div  class="table-responsive">
            <div class="col-sm-12">
            <center>
            	<div id="show_tbl">
                     <table id="tbl_data" class="table table-condensed" width="99%" cellpadding="0" cellspacing="0">
                        <colgroup>
                        	<col width="5%">
                        	<col width="30%">
                            <col width="40%">
                            <col width="10%">
                            <col width="15%">
                        </colgroup>
                        <thead>
                            <tr>
                                <td style="text-align:center;">ល.រ</td>
                                <td style="text-align:center;">ប្រភេទជំងឺ</td>
                                <td style="text-align:center;">សេវាកម្ម</td>
                                <td style="text-align:center;">បរិមាណ</td>
                                <td style="text-align:center;" class="th_right">ប្រាក់បានបង់</td>
                            </tr>
                        </thead>
                        <tbody id="show_data">
                        <?php echo $tr_detail;?>
                        </tbody>
                    </table>
                </div>
            </center>
            </div>
        </div>
        <div class="col-sm-12">
        	<div style="float:right; margin:40px 100px 0 0;"><span>អ្នកទទួលប្រាក់​</b></div>
        </div>
    </div>
</div>
<div id="get_data"></div>
</body>
</html>
<?php //die();?>
<script src="<?php echo base_url('assets/js_print/jquery/jquery-1.4.4.js');?>"></script>
<script src="<?php echo base_url('assets/js_print/jqprint.0.3.js');?>"></script>
<script type="text/javascript">
$(function(){
	//$("#show_print").jqprint();
	$(window).load(function(e){
		//var data = $("#show_print").html();
		$("#show_print").jqprint();
	});
});
</script>