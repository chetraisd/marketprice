<div class="wrapper">

		<div class="col-xs-12">         
			<div class="result_info">            
				<div class="col-xs-6" style="font-weight: bold;"><?= $this->lang->line("checking ticketing report")?><span id="title_top" ></span></div>
				<div class="col-xs-6" style="text-align: right;">
				   <?php if($this->green->gAction("R")){ ?>
				      <!-- <a href="javascript: void(0)" id="a_search" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
				        <img width="24px" height="24px" src="<?= base_url('assets/images/icons/searchs.png') ?>">
				      </a> -->
				   <?php } ?>
				   <?php if($this->green->gAction("E")){ ?>
				      <a href="javascript: void(0)" id="export">
				        <img width="24px" height="24px" src="<?= base_url('assets/images/icons/exports.png') ?>">
				      </a>
				   <?php } ?>
				   <?php if($this->green->gAction("P")){ ?>
				      <a href="javascript: void(0)" id="print">
				        <img width="24px" height="24px" src="<?= base_url('assets/images/icons/prints.png') ?>">
				      </a>
				   <?php } ?>
				</div>
			</div>
			
		</div>


   		<div class="col-sm-6">
   			<label for="fdate">From Date</label>
   			<input type="text" name="fdate" id="fdate" class="form-control" value="<?= $this->green->gdate_format();?>">
   		</div>
   		<div class="col-sm-6">
   			<label for="todate">To Date</label>
   			<input type="text" name="todate" id="todate" class="form-control" value="<?= $this->green->gdate_format();?>">
   		</div>
		<div class="col-sm-12" style="height: 10px"></div>
   		<div class="col-sm-6">
	   		<div class="panel panel-default" id="printtotaltour">
				<div class="panel-heading" style="text-align: center;"><b>Total Tourist by Park/Package</b></div>
				<div class="panel-body" style="padding:0px;">
				<?php
					// $sql_tour = $this->db->query("SELECT spp.package_typeno,spp.package_name,IFNULL(ttr.amt,0) AS amt_tour 
					// 								FROM set_park_package AS spp
					// 								LEFT JOIN(SELECT COUNT(*) AS amt,package_typeno FROM tran_ticket GROUP BY package_typeno) AS ttr
					// 								ON spp.package_typeno = ttr.package_typeno");


				?>
			    	<table class="table" id="tbl_park"  style="width:100%">
			    		
			    	</table>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
	   		<div class="panel panel-default" id="printbycountry">
				<div class="panel-heading" style="text-align: center;"><b>Total Tourist by Country</b></div>
				<div class="panel-body" style="padding:0px;">
				<table class="table" id="tbl_by_country" style="width:100%">
		    		
		    	</table>
				</div>
			</div>
		</div>

</div>
<script type="text/javascript">
$(function(){


	$('#fdate,#todate').datepicker({
		forceParse: false,
		format: "<?php echo $this->green->jdate_format();?>",
		autoclose: true
	}).on('changeDate', function(){
		//$('#f_save').parsley().validate();
		show_data();
	});
	$("body").delegate("a#export","click",function(){
		$("#tbl_park,#tbl_by_country").attr("border","1");
		var data = fn_pr_ex().split("####");
		window.open('data:application/vnd.ms-excel,' + encodeURIComponent(data[1]));
		$("#tbl_park,#tbl_by_country").attr("border","0");
	})
	$("body").delegate("a#print","click",function(){
		$("#tbl_park,#tbl_by_country").attr("border","1");
		var data_pr = fn_pr_ex().split("####");
		gsPrint(data_pr[1]);
		$("#tbl_park,#tbl_by_country").attr("border","0");
	})
	$('#export').tooltip({title: 'Export'});
    $('#print').tooltip({title: 'Print'});
	show_data();
})
function show_data(){
	var fdate  = $("#fdate").val();
	var todate = $("#todate").val();
	$.ajax({
		type:"POST",
		url:"<?php echo base_url('dashboard/dashboard/search_data'); ?>",
		dataType:"JSON",
		//async:false,
		data:{
			para  : 1,
			fdata : fdate,
			todate: todate
		},
		success:function(data){
			$("#tbl_park").html(data.total_tour);
			$("#tbl_by_country").html(data.total_tour_bycountry);
		}
	})
}
function fn_pr_ex(){
	$("#tbl_print").find(".delete_td").remove();
	//var title_date = 'Date: ' + $('#in_date').val();
	var title = "<center style='font-weight:bold; font-size:14px;'><div>Display tours in parks and countries</div></center>";
	var data  = $("#printtotaltour").html()+"<br>"+$("#printbycountry").html();
	var export_data = $("<center>" + data + "</center>").html();
	return title + "####" + export_data;
}
</script>