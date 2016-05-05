<html>
<title>Customer information</title>
<body>
<div class="wrapper">
	<div class="col-sm-12">
    	<div class="panel-heading" id="h_add">
        	<div class="row result_info">
            	<div class="col-xs-6">
        		<?php echo $this->lang->line("cust_inf")?>
                </div>
            </div>
            <div class="row">
            	<div class="col-sm-12">
                 	<div class="col-sm-6">
                    <label class="control-label"><?php echo $this->lang->line("cust_code");?><span style="color:red">*</span></label>
                    <input type="text" name="custcode" id="custcode" class="form-control input-xs" />
                    <input type="hidden" name="h_custcode" id="h_custcode" class="form-control input-xs" />
                    </div>
                    <div class="col-sm-6">
                    <label class="control-label"><?php echo $this->lang->line("cust_name")?><span style="color:red">*</span></label>
                    <input type="text" name="custname" id="custname" class="form-control input-xs" />
                	</div>
                </div>
                <div class="col-sm-12">
                 	<div class="col-sm-6">
                    <label class="control-label"><?php echo $this->lang->line("gender")?><span style="color:red">*</span></label>
                    <SELECT name="gender" id="gender" class="form-control input-xs" style="font-size:12px;">
                    	<option value="Male"><?php echo $this->lang->line("male")?></option>
                        <option value="Female"><?php echo $this->lang->line("female")?></option>
                    </SELECT>
                    <!--<input type="text" name="gender" id="gender" class="form-control input-xs" />-->
                    </div>
                    <div class="col-sm-6">
	                    <label class="control-label"><?php echo $this->lang->line("dob")?></label>
	                    <input type="text" name="dob" id="dob" class="form-control input-xs"/>
                	</div>
                    
                </div>
                <div class="col-sm-12">
                	<div class="col-sm-6">
	                    <label class="control-label"><?php echo $this->lang->line("age")?></label>
	                    <input type="text" name="years" id="years" class="form-control input-xs"/>
                	</div>
                 	<div class="col-sm-6">
	                    <label class="control-label"><?php echo $this->lang->line("address")?></label>
	                    <input type="text" name="address" id="address" class="form-control input-xs" />
                    </div>
                    
                </div>
                <div class="col-sm-12">
                	<div class="col-sm-6">
	                    <label class="control-label"><?php echo $this->lang->line("phone")?></label>
	                    <input type="text" name="phone" id="phone" class="form-control input-xs" />
                	</div>
                 	<div class="col-sm-6">
	                    <label class="control-label"><?php echo $this->lang->line("note")?></label>
	                    <input type="text" name="note" id="note" class="form-control input-xs" />
                    </div>
                </div>
                <div class="col-sm-12">
	                <div class="col-sm-6">
	                    <label class="control-label"><?php echo $this->lang->line("currency")?></label>
	                    <SELECT name="currency" id="currency" class="form-control input-xs">
	                    <?php
							$sql_cur = $this->db->query("SELECT curcode,currencyname FROM currencies  ORDER BY curcode ASC")->result();
							foreach($sql_cur as $row_curr){
								$opt_curr.= "<option value='".$row_curr->curcode."'>".$row_curr->currencyname."</option>";
							}
							echo $opt_curr;
						?>
	                    </SELECT>
	                </div>
	            </div>
        	</div> <!-- div row-->
        </div><!-- div head-->

        <div class="col-sm-12" id="h_search" style="display:none;">
	    	<div class="panel-heading" id="h_add">
	        	<div class="row result_info">
	            	<div class="col-xs-10">
	        			<?php echo $this->lang->line("search_customer")?>
	                </div>
	            </div>
			    <div class="row">
			    	<div class="col-sm-12">
			         	<div class="col-sm-6">
			            <label class="control-label"><?php echo $this->lang->line("cust_code")?></label>
			            <input type="text" name="s_custcode" id="s_custcode" class="form-control input-xs" />
			            <input type="hidden" name="h_s_custcode" id="h_s_custcode" class="form-control input-xs" />
			            </div>
			            <div class="col-sm-6">
			            <label class="control-label"><?php echo $this->lang->line("cust_name")?></label>
			            <input type="text" name="s_custname" id="s_custname" class="form-control input-xs" />
			        	</div>
			        </div>
			    </div>
			</div>
		</div>

    </div>
    <div class="col-sm-6">
        <div class="col-sm-12">
            <input type="button" name="save" id="save" class="btn btn-primary" value="<?php echo $this->lang->line('save');?>" />
            <input type="button" name="search" id="search" class="btn btn-primary" value="<?php echo $this->lang->line("search");?>" style="display:none;" />
            <input type="button" name="clear" id="clear" class="btn btn-warning" value="<?php echo $this->lang->line("clear");?>" />
        </div>
    </div>
     
	<div class="col-sm-12">
         <div class="row result_info">
            <div class="col-sm-9"><?php echo $this->lang->line("cust_list")?></div>
            <div class="col-xs-3" style="text-align: right">

            	<span class="top_action_button">
	                <?php if ($this->green->gAction("E")) { ?>
	                    <a href="#" id="sh_search" class="sh_search" title="Search customer">
	                    	<img id='export1' src="<?php echo base_url('assets/images/icons/search.png') ?>"/>
	                    </a>
	                <?php } ?>
	            </span>
	            <span class="top_action_button">
	                <?php if ($this->green->gAction("E")) { ?>
	                    <a href="#" id="export" title="Export">
	                        <img id='export1' src="<?php echo base_url('assets/images/icons/export.png') ?>"/>
	                    </a>
	                <?php } ?>
	            </span>
	            <span class="top_action_button">
	                <?php if ($this->green->gAction("P")) { ?>
	                    <a href="#" id="print" title="Print">
	                        <img src="<?php echo base_url('assets/images/icons/print.png') ?>"/>
	                    </a>
	                <?php } ?>
				</span>
			</div>
         </div>
     	<div class="table-responsive" id="dv-print">
         <table class="table table-condensed" id="tbl_content">
            <thead>
                <tr>
                    <th class="col-xs-1"><?php echo $this->lang->line("no")?></th>
                    <th class="col-xs-2"><?php echo $this->lang->line("cust_name")?></th>
                    <th class="col-xs-1"><?php echo $this->lang->line("gender")?></th>
                    <th class="col-xs-1"><?php echo $this->lang->line("age")?></th>
                    <th class="col-xs-2"><?php echo $this->lang->line("address")?></th>
                    <th class="col-xs-2"><?php echo $this->lang->line("phone")?></th>
                    <th class="col-xs-2"><?php echo $this->lang->line("note")?></th>
                    <th class="col-xs-1 remove_tag"><?php echo $this->lang->line("action")?></th>
                </tr>
            </thead>
            <tbody id="show_tbl">
            
            </tbody>
         </table>
         </div>
    </div>
</div>
<div id="pagination"></div>
</body>
</html>
<script type="text/javascript">
$(document).ready(function(){
	
	$("#dob").datepicker({
		language : "en",
		pick12HourFormat : true,
       	format: 'dd/mm/yyyy',
		startDate: '-15d',
		autoclose: true,
		endDate: '+0d'
	}).on("changeDate",function(ev){
		var show_date = $('#dob').val();
		$("#years").val(claculate_year(show_date));
	});
	
	coustomer_code_df();
	$("#search").on("click",function(){
		var obj_search = new fn_process();
		obj_search.fn_show(1);
	});	
	$(document).on('click', '.pagenav', function(){
	    var page = $(this).attr("id");
		var obj_search = new fn_process();
		$(this).addClass("test");
		obj_search.fn_show(page);
	});

	$("body").delegate(".sh_search","click",function(){
		$(this).addClass("sh_add");
		$("#h_add").hide();
		$("#h_search").show();
		$(this).html("<img id='export1' src='<?php echo base_url('assets/images/icons/add.png') ?>'/>");
		$("#sh_search").attr("title","add new customer");
		$("#save").hide();
		$("#search").show();
		$("#sh_search").removeClass("sh_search");
	});
	$("body").delegate(".sh_add","click",function(){
		$(this).addClass("sh_search");
		$("#h_add").show();
		$("#h_search").hide();
		$(this).html("<img id='export1' src='<?php echo base_url('assets/images/icons/search.png') ?>'/>");
		$("#sh_search").attr("title","Search customer");
		$("#save").show();
		$("#search").hide();
		$("#sh_search").removeClass("sh_add");
		
	});

	var showObj = new fn_process();
	showObj.fn_show(1);
	$("#save").on("click",function(){
		if($("#custcode").val() == ""){
			alert("<?php echo $this->lang->line('alert_code')?>");
			//alert("Please input customer code.");
			$("#custcode").focus();
			return false;
		}else if($("#custname").val() == ""){
			alert("<?php echo $this->lang->line('alert_names')?>");
			//alert("Please input customer name.");
			$("#custname").focus();
			return false;
		}else if($("#gender").val() == ""){
			alert("<?php echo $this->lang->line('alert_gender')?>");
			//alert("Please input gender.");
			$("#gender").focus();
			return false;
		}else{
			var h_custcode = $("#h_custcode").val();
			var obj = new fn_process();
			if(h_custcode == "" || obj.custcode != h_custcode){
				var get_cof = obj.fn_check();
				if(get_cof > 0){
					alert("<?php echo $this->lang->line('alert_customer_code');?>");
					//alert("Your customer code is duplicate. Please try again.");
					$("#custcode").select();
					return false;
				}
			}
			if(obj.fn_ch_tran(h_custcode) > 0){
				alert("<?php echo $this->lang->line("alert_check_update"); ?>");
				return false;
			}
			
			var conf = confirm("<?php echo $this->lang->line('confirm_save')?>");
			//var conf = confirm("Do you want to save ?");
			if(conf == true){
				obj.save();
				obj.fn_show();
				obj.fn_clear();
				$("#save").val("<?php echo $this->lang->line("save")?>");
				coustomer_code_df();
			}
			
		}
		
	});
	
	$("body").delegate("#a_edit","click",function(){
		$("#save").val("<?php echo $this->lang->line("update")?>");
		var tr = $(this).parent().parent();
		var h_code = tr.find("#h_code").val();
		var obj = new fn_process();
		obj.fn_edit(h_code);
	});
	
	$("#clear").on("click",function(){
		$("#save").val("<?php echo $this->lang->line("save")?>");
		var obj = new fn_process();
		obj.fn_clear();
		coustomer_code_df();
	});
	
	$("body").delegate("#a_delete","click",function(){
		var att_delete = $(this).parent().parent().find("#h_code").val();
		var obj_delete = new fn_process();
		var count_code = obj_delete.fn_ch_tran(att_delete);
		if(count_code > 0){
			alert("<?php echo $this->lang->line('can_not_delete')?>");
			//alert("Sorry you can not delete this recode. It has trasection already.");
		}else{
			var conf = confirm("<?php echo $this->lang->line('confirm_delete')?>");
			//var conf = confirm("Do you want to delete this record ?");
			 if(conf == true){
				obj_delete.fn_delete(att_delete);
				obj_delete.fn_show();
				coustomer_code_df();
			 }
			 return false;
		}
		
	});
	$("#years").on("keydown",function(e){
		if((e.keyCode >= 96 && e.keyCode <= 105) || (e.keyCode >= 48 && e.keyCode <= 57) || e.keyCode == 8 ){
			$(this).removeAttr("readonly");	
		}else{
			$(this).attr("readonly","readonly");
		}
		
	});
	$("body").delegate("a#export","click",function(){
        // $("#tbl_content_exp #show_img").remove();
        // var htmltable= document.getElementById('tbl_content_exp');
        // var html = htmltable.outerHTML;
        // window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));

        var arr_exp = fn_pr_ex().split("####");
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent(arr_exp[1]));
    });
	$("#s_custcode,#s_custname").focus(function (){
        $(this).select();
        var show_this = $(this);
        autoCustomer(1,show_this);
    });
    $("#s_custname").focus(function (){
        $(this).select();
        var show_this = $(this);
        autoCustomer(2,show_this);
    });
    $("body").delegate("a#print","click",function(){
        var arr_pr = fn_pr_ex().split("####");
        gsPrint(arr_pr[0],arr_pr[1]);
    });
	
});
function claculate_year(dob_age){
	var ret_age =0;
	$.ajax({ 
			type:"POST",
			url:"<?= site_url("customer/c_customer/ccalculate_y"); ?>",
			DataType:"JSON",
			async:false,
			data:{
				dob_age : dob_age
			},
			success:function(data){
				ret_age = data.age;
			}
	});
	return ret_age;
}
function autoCustomer(get_para,get_this) {
    var url = "<?php echo site_url('customer/c_customer/cautoCustomer');?>?cond_1_2="+get_para;
	get_this.autocomplete({
        source: url,
        minLength: 0,
        select: function (events, ui) {
           	get_this.val(ui.item.id);
        }
    });
    
}
function fn_pr_ex(){
        // $(".remove_inv").remove();
        // var htmlToPrint = ''+'<style type="text/css">' +
        //                        'table th, table td {' +
        //                        'border:1px solid #000 !important;' +
        //                        'padding;0.5em;' +
        //                        '}' +
        //                        '</style>';
        var title   = "<center><span style='font-weight:bold; font-size:16px;'>List customer</span></center><br>";
        //var s_adr   = "Title</div>";
        //    title+=s_adr;
        //title +="<h4 align='center'>Invoice</h4>"; 
        var data = $("#dv-print").html().replace(/<img[^>]*>/gi,"");
        var export_data = $("<center>"+data+"</center>").clone().find(".remove_tag").remove().end().html();
        //export_data+=htmlToPrint;
        return title+"####"+export_data;
}
function fn_process(){
	this.custcode = $("#custcode").val();
	this.custname = $("#custname").val();
	this.gender   = $("#gender").val();
	this.years    = $("#years").val();
	this.dob      = $("#dob").val();
	this.address  = $("#address").val();
	this.phone    = $("#phone").val();
	this.note     = $("#note").val();
	this.h_custcode = $("#h_custcode").val();
	this.currency = $("#currency").val();
	var showAlert = "";
	var arr_obj = {custcode: this.custcode,
				   h_custcode : this.h_custcode,
				   custname: this.custname,
				   gender  : this.gender,
				   years   : this.years,
				   dob     : this.dob,
				   address : this.address,
				   phone   : this.phone,
				   note    : this.note,
				   currency : this.currency
				   };
	this.save = function save(){
		$.ajax({ 
				type:"POST",
				url:"<?= site_url("customer/c_customer/csave"); ?>",
				DataType:"HTML",
				async:false,
				data:{
					save:1,
					para_obj : arr_obj
				},
				success:function(data){
				}
		});
	},
	this.fn_show = function fn_show(page){
		var get_arr;
		var name = "";
		$.ajax({
				type:"POST",
				url:"<?= site_url("customer/c_customer/cshowdata"); ?>",
				DataType:"JSON",
				async:false,
				data:{
					getStd : 1,
					cust_code  : $("#s_custcode").val(),
					s_custname : $("#s_custname").val(),	
					page : page,
					name : name
				},
				success:function(data){
					$("#show_tbl").html(data.datas);
					$("#pagination").html(data.paging.pagination);

					// $(this).addClass("bg_color").css("background","black");
					// var tr="";
					// $.each(data,function(k,v){
					// 	tr+="<tr>";
					// 	tr+="<td>"+v['customercode']+"<input type='hidden' name='h_code' id='h_code' class='h_code' value='"+v['customercode']+"'></td>";
					// 	tr+="<td>"+v['customername']+"</td>";
					// 	tr+="<td>"+v['gender']+"</td>";
					// 	tr+="<td>"+v['years']+"</td>";
					// 	tr+="<td>"+v['address']+"</td>";
					// 	tr+="<td>"+v['phone']+"</td>";
					// 	tr+="<td>"+v['note']+"</td>";
					// 	tr+="<td><a href='javascript:void(0)' id='a_delete'><img rel='2510' src='<?php echo base_url(); ?>/assets/images/icons/delete.png'></a>&nbsp;&nbsp;";
					// 	tr+="<a href='javascript:void(0)' id='a_edit'><img rel='2510' width='15' height='15' src='<?php echo base_url(); ?>/assets/images/icons/edit.png'></a></td>";
					// 	tr+="</tr>";
					// });
					//$("#show_tbl").html(tr);
				}
		});
	},
	this.fn_edit = function fn_edit(para_code){
		$.ajax({
				type:"POST",
				url:"<?= site_url("customer/c_customer/cedit"); ?>",
				DataType:"JSON",
				async:false,
				data:{
					para_edit : para_code
				},
				success:function(data){
					$("#custcode").val(data.customercode);
					$("#h_custcode").val(data.customercode);
					$("#custname").val(data.customername);
					$("#gender").val(data.gender);
					$("#years").val(data.years);
					$("#address").val(data.address);
					$("#phone").val(data.phone);
					$("#note").val(data.note);
					$("#currency").val(data.curcode);
					$("#dob").val(data.dob);
					//$("#dob").val(new Date(("")).format("d/m/Y"));
				}
		});
	},
	this.fn_delete = function fn_delete(para_delete){
		$.ajax({
				type:"POST",
				url:"<?= site_url("customer/c_customer/cdelete"); ?>",
				DataType:"JSON",
				async:false,
				data:{
					para_delet : para_delete
				},
				success:function(data){
				}
		});
	},
	this.fn_check = function fn_check(){
		var amt_v = 0;
		$.ajax({
				type:"POST",
				url:"<?= site_url("customer/c_customer/ccheck"); ?>",
				DataType:"JSON",
				async:false,
				data:{
					para_check : this.custcode
				},
				success:function(data){
					amt_v = data.amt;
				}
		});
		return amt_v;
	},
	this.fn_ch_tran = function fn_ch_tran(para_tran){
		var amt_tran = 0;
		$.ajax({
				type:"POST",
				url:"<?= site_url("customer/c_customer/ccheck_tran"); ?>",
				DataType:"JSON",
				async:false,
				data:{
					para_tran : para_tran
				},
				success:function(data){
					amt_tran = data;
				}
		});
		return amt_tran;
	},
	this.fn_clear = function fn_clear(){
		$("#custcode").val("");
		$("#h_custcode").val("");
		$("#custname").val("");
		//$("#gender").val("");
		$("#years").val("");
		$("#address").val("");
		$("#phone").val("");
		$("#note").val("");
		//$("#currency").val("");
		$("#s_custcode").val("");
		$("#s_custname").val("");
		$("#dob").val("");
	}
}

function coustomer_code_df(){ 
	$.ajax({ 
		type : 'POST',
		url  : "<?= site_url("customer/c_customer/coustomer_code_df"); ?>",
		DataType : "JSON",
		async : false,
		data : { 
			code_auto : 1
		},
		success:function(data){ 
			//console.log(data);
			$('#custcode').val(data.cus+"-"+data.code);
		}
	});
}
</script>