
<div class="wrapper">
	<div class="col-sm-12">
        	<div class="row result_info">
            	<div class="col-sm-9"><?php echo $this->lang->line("add_sub_service_type")?></div>
           		<div class="col-xs-3" style="text-align: right">
                    <span class="top_action_button">
                        <?php if ($this->green->gAction("E")) { ?>
                            <a href="javascript:void(0)" id="export" title="Export">
                                <img id='export1' src="<?php echo base_url('assets/images/icons/export.png') ?>"/>
                            </a>
                        <?php } ?>
                    </span>
                    <span class="top_action_button">
                        <?php if ($this->green->gAction("P")) { ?>
                            <a href="javascript:void(0)" id="print" title="Print">
                                <img src="<?php echo base_url('assets/images/icons/print.png') ?>"/>
                            </a>
                        <?php } ?>
                    </span>
    			</div>
            
            </div>

            <div class="row">
            	<div class="col-sm-12">
                 	<div class="col-sm-6">
                        <label class="control-label"><?php echo $this->lang->line("code")?><span style="color:red">*</span></label>
                        <input type="text" name="sub_service_code" id="sub_service_code" class="form-control input-xs" />
                        <input type="hidden" name="h_sub_code" id="h_sub_code" class="form-control input-xs h_sub_code" />
                     </div>
                    <div class="col-sm-6">
                        <label class="control-label"><?php echo $this->lang->line("group_name")?><span style="color:red">*</span></label>
                        <input type="text" name="sub_service_name" id="sub_service_name" class="form-control input-xs" />
                	</div>
                </div>
                <div class="col-sm-12">
                 	<div class="col-sm-6">
                        <label class="control-label"><?php echo $this->lang->line("note")?></label>
                        <input type="text" name="note" id="note" class="form-control input-xs" />
                     </div>
                    
                </div>
        	</div> <!-- div row-->
        	<br>
        	<div class="row">
		        <div class="col-sm-12">
					<div class="col-sm-6">
						<input type="button" name="save" id="save" class="btn btn-primary" value="<?php echo $this->lang->line("save")?>" />
						<input type="button" name="clear" id="clear" class="btn btn-warning" value="<?php echo $this->lang->line("clear")?>" />
					</div>
				</div>
			</div>	
    </div>
		
</div>  <!--  end div wrap -->

<div class="col-sm-12">
	<meta charset="Utf-8">
 	<div class="table-responsive" id="dv-print">
    <table class="table table-condensed">
        <thead>
            <tr>
                <th class="col-xs-1"><?php echo $this->lang->line("no")?></th>
                <th class="col-xs-3"><?php echo $this->lang->line("code")?></th>
				<th class="col-xs-3"><?php echo $this->lang->line("group_name")?></th>
                <th class="col-xs-4"><?php echo $this->lang->line("note")?></th>
                <th class="col-xs-1 remove_tag" colspan="2" style="text-align:center;"><?php echo $this->lang->line("action")?></th>
            </tr>
        </thead>
        <tbody id="show_tbl">
        
        </tbody>
    </table>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	var obj_show = new fn_process();
	obj_show.fn_show();
	
	$("#save").on("click",function(){
	 	var obj = new fn_process();
		if(obj.sub_service_code == ""){
			alert("<?php echo $this->lang->line('alert_code')?>");
			//alert("Please input sub service code before process.");
			$("#sub_service_code").focus();
		}else if(obj.sub_service_name == ""){
			alert("<?php echo $this->lang->line('alert_name')?>");
			//alert("Please input sub service name before process.");
			$("#sub_service_name").focus();
		}else{
			var check = obj.fn_check(1,"");
			if(obj.h_sub_code == "" || obj.h_sub_code != obj.sub_service_code){
				if(check > 0){
					alert("<?php echo $this->lang->line('alert_check')?>");
					//alert("Your service code is duplicate. Please try again.");
					$("#sub_service_code").focus();
					return false;
				}
			}
			var h_sub_code = $("#h_sub_code").val();
			var check_update = obj.fn_check(2,h_sub_code);
			if(check_update > 0){
				alert("<?php echo $this->lang->line("alert_check_update"); ?>");
				
				return false;
			}
			var conf = "";
			if(obj.h_sub_code == ""){
				conf = confirm("<?php echo $this->lang->line('confirm_save')?>");
				//conf = confirm("Do you want to save ?");
			}else{
				conf = confirm("<?php echo $this->lang->line('confirm_update')?>");
				//conf = confirm("Do you want to update ?");
			}
			if(conf == true){
				obj.fn_save();
				obj.fn_clear();
				obj.fn_show();
				$("#save").val("<?php echo $this->lang->line("save")?>");
			}
			return false;
		}
	});
	$("#clear").on("click",function(){
		var obj_clear = new fn_process();
		obj_clear.fn_clear();
		$("#save").val("<?php echo $this->lang->line("save")?>");
	});
	$("body").delegate("a#a_edite","click",function(){
		var servicecode = $(this).parent().parent().find("#h_subservice_code").val();
		var obj_edite = new fn_process();
		obj_edite.fn_edite(servicecode);
		$("#save").val("<?php echo $this->lang->line("update")?>");
	});
	$("body").delegate("#a_delete","click",function(){
		var hservicecode = $(this).parent().parent().find("#h_subservice_code").val();
		var obj_delete = new fn_process();
		if(obj_delete.fn_check(2,hservicecode) > 0){
			alert("<?php echo $this->lang->line("alert_check_tran"); ?>");
			return false;
		}else{
			var conf = confirm("<?php echo $this->lang->line('confirm_delete');?>");
			if(conf == true){
				obj_delete.fn_delete(hservicecode);
				obj_delete.fn_show();
			}
			return false;
		}
	});


	$("body").delegate("a#export","click",function(){
        var arr_exp = fn_pr_ex().split("####");
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent(arr_exp[1]));
        // alert('OK export');
    });
    
    $("body").delegate("a#print","click",function(){
        var arr_pr = fn_pr_ex().split("####");
        gsPrint(arr_pr[0],arr_pr[1]);
        // alert('OK print');
    });
	
});

function fn_pr_ex(){
        $(".remove_inv").removeAttr("href");
        // var htmlToPrint = ''+'<style type="text/css">' +
        //                        'table th, table td {' +
        //                        'border:1px solid #000 !important;' +
        //                        'padding;0.5em;' +
        //                        '}' +
        //                        '</style>';
        var title   = "<center><span style='font-weight:bold; font-size:16px;'>Report Service Group</span></center><br>";
        //var s_adr   = "Title</div>";
        //    title+=s_adr;
        //title +="<h4 align='center'>Invoice</h4>"; 
        var data = $("#dv-print").html().replace(/<img[^>]*>/gi,"");
        var export_data = $("<center>"+data+"</center>").clone().find(".remove_tag").remove().end().html();
        //export_data+=htmlToPrint;
        return title+"####"+export_data;
}


function fn_process(){
		this.sub_service_code = $("#sub_service_code").val();
		this.h_sub_code       = $("#h_sub_code").val();
		this.sub_service_name = $("#sub_service_name").val();
		this.note             = $("#note").val();
		var arr_obj = {
			"sub_service_code": this.sub_service_code,
			"h_sub_code": this.h_sub_code,
			"sub_service_name":this.sub_service_name,
			"note": this.note 
		}
		this.fn_save = function fn_save(){
			$.ajax({
					type:"POST",
					url:"<?= site_url('service/csub_service_type/csave') ?>",
					DataType:"JSON",
					async:false,
					data:{
						Para_save : 1,
						arr_obj   : arr_obj	
					},
					success:function(data){
						 alert("success...");
					}
			});	
		},
		this.fn_show = function fn_show(){
			$.ajax({
					type:"POST",
					url:"<?= site_url("service/csub_service_type/cshow") ?>",
					DataType:"JSON",
					async:false,
					data:{
						Para_show:1
					},
					success:function(data){
						 $("#show_tbl").html(data);
					}
			});
		},
		this.fn_edite = function fn_edite(servicecode){
			$.ajax({
					type:"POST",
					url:"<?= site_url('service/csub_service_type/cedit') ?>",
					DataType:"JSON",
					async:false,
					data:{
						Para_edite : 1,
						servicecode :servicecode	
					},
					success:function(data){
						$("#sub_service_code").val(data.sub_servicecode);
						$("#h_sub_code").val(data.sub_servicecode);
						$("#sub_service_name").val(data.sub_name);
						$("#note").val(data.note);
					}
			});
		},
		this.fn_check = function fn_check(pa_del,pa_code){
			var amt_v = 0;
			$.ajax({
					type:"POST",
					url:"<?= site_url('service/csub_service_type/ccheck'); ?>",
					DataType:"JSON",
					async:false,
					data:{
						para_check : this.sub_service_code,
						pa_code    : pa_code,
						pa_del     : pa_del
					},
					success:function(data){
						amt_v = data.amt;
					}
			});
			return amt_v;
		},
		this.fn_delete = function fn_delete(code_delete){
			$.ajax({
					type:"POST",
					url:"<?= site_url("service/csub_service_type/cdelete"); ?>",
					DataType:"JSON",
					async:false,
					data:{
						para_delete : code_delete
					},
					success:function(data){
						//amt_v = data.amt;
					}
			});
		},
		this.fn_clear = function fn_clear(){
			$("#sub_service_code").val("");
			$("#sub_service_name").val("");
			$("#h_sub_code").val("");
			$("#note").val("");
		}
}

</script>