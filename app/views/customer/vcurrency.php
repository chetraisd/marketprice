<html>
<title>Currency</title>
<body>
<div class="wrapper">
	<div class="col-sm-12">
    	<div class="panel-heading">
        	<div class="row result_info">
            	<div class="col-xs-6">
        		<?php echo $this->lang->line("create_currency"); ?>
                </div>
            </div>
            <div class="row">
            	<div class="col-sm-12">
                 	<div class="col-sm-6">
                    <label class="control-label"><?php echo $this->lang->line("currency_code"); ?><span style="color:red">*</span></label>
                    <input type="text" name="currencyCode" id="currencyCode" class="form-control input-xs" />
                    <input type="hidden" name="h_currencyCode" id="h_currencyCode" class="form-control input-xs"/>
                    </div>
                    <div class="col-sm-6">
                    <label class="control-label"><?php echo $this->lang->line("currency_name"); ?><span style="color:red">*</span></label>
                    <input type="text" name="currencyName" id="currencyName" class="form-control input-xs" />
                	</div>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <label class="control-label"><?php echo $this->lang->line("exchange_rate"); ?><span style="color:red">*</span></label>
                        <input type="text" name="exchangeRage" id="exchangeRage" class="form-control input-xs" />
                    </div>
                 	<div class="col-sm-6">
                    <label class="control-label"><?php echo $this->lang->line("country"); ?></label>
                    <input type="text" name="country" id="country" class="form-control input-xs" />
                    </div>
                </div>
                <div class="col-sm-12">
                 	
                    <div class="col-sm-6">
                    <label class="control-label"><?php echo $this->lang->line("symbol"); ?><span style="color:red">*</span></label>
                    <input type="text" name="symbol" id="symbol" class="form-control input-xs" />
                	</div>
                </div>
        	</div> <!-- div row-->
        </div><!-- div head-->
    </div>
     
    <div class="col-sm-6">
        <div class="col-sm-12">
            <input type="button" name="save" id="save" class="btn btn-primary" value="<?php echo $this->lang->line("save"); ?>" />
            <input type="button" name="clear" id="clear" class="btn btn-warning" value="<?php echo $this->lang->line("clear"); ?>" />
        </div>
    </div>
     
	 <div class="col-sm-12">
         <div class="row result_info">
            <div class="col-sm-6"><?php echo $this->lang->line("currency_list"); ?></div>
         </div>
     	<div class="table-responsive">
         <table class="table table-condensed">
            <thead>
                <tr>
                    <th class="col-xs-1"><?php echo $this->lang->line("no"); ?></th>
                    <th class="col-xs-2"><?php echo $this->lang->line("currency_code"); ?></th>
                    <th class="col-xs-2"><?php echo $this->lang->line("currency_name"); ?></th>
                    <th class="col-xs-1"><?php echo $this->lang->line("country"); ?></th>
                    <th class="col-xs-1" style="text-align:center;"><?php echo $this->lang->line("exchange_rate"); ?></th>
                    <th class="col-xs-2" style="text-align:center;"><?php echo $this->lang->line("symbol"); ?></th>
                    <th class="col-xs-1"><?php echo $this->lang->line("action"); ?></th>
                </tr>
            </thead>
            <tbody id="show_tbl">
            
            </tbody>
         </table>
         </div>
     </div>
</div>
</body>
</html>
<script type="text/javascript">
$(document).ready(function(){
	var obj_show = new fn_process();
	obj_show.fn_showCurrency();
	$("body").delegate("#a_edite","click",function(){
		var curr_code = $(this).parent().parent().find("#h_currencyCode").val();
		var obj_edite = new fn_process();
		obj_edite.fn_edite(curr_code);
		$("#save").val("<?php echo $this->lang->line("update"); ?>");
	});
	$("body").delegate("#a_delete","click",function(){
		var curr_code = $(this).parent().parent().find("#h_currencyCode").val();
		var objDelete = new fn_process();
		var ch_delete = objDelete.fn_check_tran(curr_code);
		
		if(ch_delete > 0){
			alert("<?php echo $this->lang->line('alert_cannot_delete')?>");
			//alert("Sorry, you cannot delete this record because it is used in at least one transaction.");
			return false;
		}else{
			var conf = confirm("<?php echo $this->lang->line('confirm_delete')?>");
			if(conf == true){
				objDelete.fn_delete(curr_code);
				objDelete.fn_showCurrency();
			}else{
				return false;	
			}
		}
		
	});
	$("#save").on("click",function(){
		var obj_save = new fn_process();
		if(obj_save.currencyCode == ""){
			alert("<?php echo $this->lang->line('alert_code')?>");
			//alert("Please input currency code !");
			$("#currencyCode").focus();
			return false;
		}else if(obj_save.currencyName == ""){
			alert("<?php echo $this->lang->line('alert_name')?>");
			//alert("Please input currency name !");
			$("#currencyName").focus();
			return false;
		}else if(obj_save.exchangeRage == ""){
			alert("<?php echo $this->lang->line('alert_exchangeRage')?>");
			//alert("Please input Exchange Rate !");
			$("#exchangeRage").focus();
			return false;
		}else if(obj_save.symbol == ""){
			alert("<?php echo $this->lang->line('alert_symbol')?>");
			//alert("Please input symbol currency !");
			$("#symbol").focus();
			return false;
		}else{
			var conf = "";
			if(obj_save.h_currencyCode == ""){
				conf = confirm("<?php echo $this->lang->line('confirm_save')?>");
				//conf = confirm("Do you want to save ?");
			}else{
				conf = confirm("<?php echo $this->lang->line('confirm_update')?>");
				//conf = confirm("Do you want to update ?");
			}
			if(conf == true){
				obj_save.fn_save();
				obj_save.fn_clear();
				obj_save.fn_showCurrency();
			}else{
				return false;	
			}
		}
	});
	 $("body").delegate("#exchangeRage","keydown", function (e) {
	   // alert(e.keyCode);
		if ((e.keyCode >= 96 && e.keyCode <= 105) || (e.keyCode >= 48 && e.keyCode <= 57) || e.keyCode == 8 || e.keyCode == 190 || e.keyCode == 110) {
			$(this).removeAttr("readonly");
		} else {
			$(this).attr("readonly", "readonly");
		}
	});    
	$("#clear").on("click",function(){
		var obj_clear = new fn_process();
		obj_clear.fn_clear();
		$("#save").val("<?php echo $this->lang->line("save"); ?>");
	});
});

function fn_process(){
	this.currencyCode = $("#currencyCode").val();
	this.h_currencyCode = $("#h_currencyCode").val();
	this.currencyName = $("#currencyName").val();
	this.country      = $("#country").val();
	this.exchangeRage = $("#exchangeRage").val();
	this.symbol       = $("#symbol").val();
	this.arr_save = {}
	
	this.fn_showCurrency = function fn_showCurrency(){
		$.ajax({
				type:"POST",
				url :"<?= site_url("customer/c_currency/cshowCurrency") ?>",
				dataType:"JSON",
				async:false,
				data:{
					Para_currency:1
				},
				success:function(data){
					var tr = "";
					var i =1;
					$.each(data,function(k,v){
						tr+= '<tr>'+
									'<td>'+(i++)+
									'<input type="hidden" name="h_currencyCode" id="h_currencyCode" value="'+v['curcode']+'">'+
									'</td>'+
									'<td>'+v['curcode']+'</td>'+
									'<td>'+v['currencyname']+'</td>'+
									'<td>'+v['country']+'</td>'+
									'<td style="text-align:right;">'+v['rate']+'</td>'+
									'<td style="text-align:center;">'+v['symbol']+'</td>'+
									'<td>'+
										'<a href="javascript:void(0)" id="a_delete"><img rel="2510" src="<?= base_url(); ?>/assets/images/icons/delete.png"></a>&nbsp;&nbsp;'+
										'<a href="javascript:void(0)" id="a_edite"><img rel="2510" width="15" height="15" src="<?= base_url(); ?>/assets/images/icons/edit.png"></a>'+
									'</td>'+
							 '</tr>';
					});
					$("#show_tbl").html(tr);
				}
		});
	},
	this.fn_save = function fn_save(){
		$.ajax({
				type:"POST",
				url :"<?= site_url("customer/c_currency/csave") ?>",
				dataType:"JSON",
				async:false,
				data:{
					currencyCode : $("#currencyCode").val(),
					h_currencyCode : $("#h_currencyCode").val(),
					currencyName : $("#currencyName").val(),
					country      : $("#country").val(),
					exchangeRage : $("#exchangeRage").val(),
					symbol       : $("#symbol").val()
				},
				success:function(data){
					
				}
		});
	},
	this.fn_edite = function fn_edite(para_code){
		$.ajax({
				type:"POST",
				url :"<?= site_url("customer/c_currency/cedite") ?>",
				dataType:"JSON",
				async:false,
				data:{
					para_code : para_code,
				},
				success:function(data){
					$("#currencyCode").val(data.curcode);
					$("#h_currencyCode").val(data.curcode);
					$("#currencyName").val(data.currencyname);
					$("#country").val(data.country);
					$("#exchangeRage").val(data.rate);
					$("#symbol").val(data.symbol);
				}
		});
	},
	this.fn_check_tran = function fn_check_tran(curr_code){
		var amt_ch = 0;
		$.ajax({
				type:"POST",
				url :"<?= site_url("customer/c_currency/check_tran") ?>",
				dataType:"JSON",
				async:false,
				data:{
					curr_code : curr_code
				},
				success:function(data){
					amt_ch = data.amt_curr;
				}
		});
		return amt_ch;
	},
	this.fn_delete = function fn_delete(curCodeDelete){
		var del_val;
		$.ajax({
				type:"POST",
				url :"<?= site_url("customer/c_currency/cdelete") ?>",
				dataType:"JSON",
				async:false,
				data:{
					para_delete : curCodeDelete
				},
				success:function(data){
					del_val = data.arr_del;
				}
		});
		return del_val;
	},
	this.fn_clear = function fn_clear(){
		$("#currencyCode").val("");
		$("#h_currencyCode").val("");
		$("#currencyName").val("");
		$("#country").val("");
		$("#exchangeRage").val("");
		$("#symbol").val("");
	}
}

</script>