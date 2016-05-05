<html>
<title>Create Service Type</title>
<body>
<div class="wrapper">
	<div class="col-sm-12">
    	<div class="panel-heading">
        	<div class="row result_info">
            	<div class="col-xs-9">
        			<?php echo $this->lang->line("new_service_type");?>
                </div>

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
                        <label class="control-label"><?php echo $this->lang->line('disease_type_code')?><span style="color:red">*</span></label>
                        <input type="text" name="diseasecode" id="diseasecode" class="form-control input-xs" />
                        <input type="hidden" name="h_diseasecode" id="h_diseasecode" class="form-control input-xs" />
                        <input type="hidden" id="input_h">
                    </div>
                    <div class="col-sm-6">
                        <label class="control-label"><?php echo $this->lang->line('service_type'); ?><span style="color:red">*</span></label>
                        <input type="text" name="diseasename" id="diseasename" class="form-control input-xs" />
                	</div>
                </div>
                <div class="col-sm-12">
                 	<div class="col-sm-6">
                    	<label class="control-label"><?php echo $this->lang->line('note')?></label>
                    	<input type="text" name="note" id="note" class="form-control input-xs" />
                	</div>
                </div>      
        	</div> <!-- div row-->
        </div><!-- div head-->
     </div>
     
     <div class="col-sm-6">
        <div class="col-sm-12">
            <input type="button" name="save" id="save" class="btn btn-primary" value="<?php echo $this->lang->line("save")?>" />
            <input type="button" name="clear" id="clear" class="btn btn-warning" value="<?php echo $this->lang->line("clear")?>" />
        </div>
     </div>
     
	 <div class="col-sm-12">
        <div class="row result_info">
            <div class="col-sm-6"><?php echo $this->lang->line("list_of_services_type")?></div>
        </div>
     	<div class="table-responsive" id="dv-print">
         <table class="table table-condensed">
            <thead>
                <tr>
                    <th class="col-xs-1"><?php echo $this->lang->line("no")?></th>
                    <th class="col-xs-2"><?php echo $this->lang->line("type_code")?></th>
                    <th class="col-xs-3"><?php echo $this->lang->line("service_type")?></th>
                    <th class="col-xs-3"><?php echo $this->lang->line("note")?></th>
                    <th class="col-xs-1 remove_tag" colspan="2" style="text-align:center;"><?php echo $this->lang->line("action")?></th>
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
	var obj1 = new fn_process();
	obj1.showTable();
	$("#save").on("click",function(){
		var diseasecode = $("#diseasecode").val();
		var diseasename = $("#diseasename").val();
		var h_diseasecode = $("#h_diseasecode").val();
		var label = $(this).val();
		var obj = new fn_process();
		if(diseasecode == ""){
			alert("<?php echo $this->lang->line('alert_code')?>");
			//alert("Please input service type code before process.");
			$("#diseasecode").select();
		}else if(diseasename == ""){
			alert("<?php echo $this->lang->line('alert_name')?>");
			//alert("Please input service type before process.");
			$("#diseasename").select();
		}else{
			var checkcode = obj.fn_check(1,"")-0;
			
			if(checkcode > 0 && obj.diseasecode != obj.h_diseasecode){
				alert("<?php echo $this->lang->line('alert_service')?>");
				//alert("You service type is existed. Please try agian.");
				$("#diseasecode").select();
				return false;
			}else{
				if(obj.fn_check(2,h_diseasecode) > 0){
					alert("<?php echo $this->lang->line('alert_check_update');?>");
					return false;
				}
				var conf = "";
				if($("#input_h").val() != ""){
					conf = confirm("<?php echo $this->lang->line('confirm_update')?>");
					//conf = confirm("Do you want to update ?");
				}else{
					conf = confirm("<?php echo $this->lang->line('confirm_save')?>");
					//conf = confirm("Do you want to save ?");
				}
				if(conf == true){
					obj.save();
					obj.showTable();
					obj.fn_clear();
					$(this).val("<?php echo $this->lang->line("save")?>");
					$("#input_h").val('');
				}
				return false;
			}
			
		}
	});
	$("body").delegate("#a_delete","click",function(){
		var code_delete = $(this).parent().parent().find("#h_diseasecode").val();
		var obj_delete = new fn_process();
		if(obj_delete.fn_check(2,code_delete) == 0 ){
			var conf = confirm("<?php echo $this->lang->line('confirm_delete')?>");
			if(conf == true){
				obj_delete.fn_delete(code_delete);
				obj_delete.showTable();
			}
			return false;
		}else{
			alert("<?php echo $this->lang->line("confirm_befor_delete");?>");
			return false;
		}
	});
	$("#clear").on("click",function(){
		var obj_clear = new fn_process();
		obj_clear.fn_clear();
	});
	$("body").delegate("#a_edite","click",function(){
		var h_diseasecode = $(this).parent().parent().find("#h_diseasecode").val();
		var obj_edite = new fn_process();
		obj_edite.editetbl(h_diseasecode);
		$("#save").val("<?php echo $this->lang->line("update")?>");
	});


	$("body").delegate("a#export","click",function(){
        var arr_exp = fn_pr_ex().split("####");
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent(arr_exp[1]));
        //alert('OK export');
    });
    
    $("body").delegate("a#print","click",function(){
        var arr_pr = fn_pr_ex().split("####");
        gsPrint(arr_pr[0],arr_pr[1]);
        //alert('OK print');
    });

});
function fn_process(){
	this.diseasecode   = $("#diseasecode").val();
	this.h_diseasecode = $("#h_diseasecode").val();
	this.diseasename   = $("#diseasename").val();
	this.note          = $("#note").val();
	this.arr_obj = {
					code  : this.diseasecode,
					h_code: this.h_diseasecode,
					name  : this.diseasename,
					note  : this.note
					};
	this.save  = function save(){
		var show_alert;
		$.ajax({
			type: "POST",
			url :"<?= site_url("disease/c_diseasetype/csave") ?>",
			DataType:"JSON",
			async:false,
			data:{
				Para_arr : this.arr_obj
			},
			success:function(data){
				show_alert = data.arr_alert;
			}
		});
		return show_alert;
	},
	this.showTable = function showTable(){
		$.ajax({
			type: "POST",
			url :"<?= site_url("disease/c_diseasetype/cshow") ?>",
			dataType:"HTML",
			async:false,
			data:{
				Para_show : 1
			},
			success:function(data){
				$("#show_tbl").html(data);
			}
		});
	},
	this.fn_delete = function fn_delete(code_delete){
		$.ajax({
			type: "POST",
			url :"<?= site_url("disease/c_diseasetype/cdelete") ?>",
			dataType:"JSON",
			async:false,
			data:{
				Para_delete : code_delete
			},
			success:function(data){
				alert(data);
				//$("#show_tbl").html(data);
			}
		});
	},
	this.editetbl = function editetbl(dis_code){
		$.ajax({
			type: "POST",
			url :"<?= site_url("disease/c_diseasetype/cedite") ?>",
			dataType:"JSON",
			async:false,
			data:{
				Para_code : dis_code
			},
			success:function(data){
				$("#diseasecode").val(data.disease_code);
				$("#h_diseasecode").val(data.disease_code);
				$("#diseasename").val(data.disease_name);
				$("#note").val(data.note);
				$("#input_h").val(data.disease_code);
			}
		});
	},
	this.fn_check = function fn_check(par_cond,par_code){
		var amtcount;
		$.ajax({
			type: "POST",
			url :"<?= site_url("disease/c_diseasetype/ccheckcode") ?>",
			DataType:"JSON",
			async:false,
			data:{
				Para_checkcode : this.diseasecode,
				Para_hcode     : this.h_diseasecode,
				par_cond       : par_cond,
				par_code       : par_code
			},
			success:function(data){
				amtcount = data;
			}
		});
		return amtcount;
	},
	this.fn_clear = function fn_clear(){
		$("#diseasecode").val("");
		$("#h_diseasecode").val("");
		$("#diseasename").val("");
		$("#note").val("");
		$("#input_h").val('');
	}
	
}

function fn_pr_ex(){
        $(".remove_inv").removeAttr("href");
        // var htmlToPrint = ''+'<style type="text/css">' +
        //                        'table th, table td {' +
        //                        'border:1px solid #000 !important;' +
        //                        'padding;0.5em;' +
        //                        '}' +
        //                        '</style>';
        var title   = "<center><span style='font-weight:bold; font-size:16px;'><?php echo $this->lang->line("title_print"); ?></span></center><br>";
        //var s_adr   = "Title</div>";
        //    title+=s_adr;
        //title +="<h4 align='center'>Invoice</h4>"; 
        var data = $("#dv-print").html().replace(/<img[^>]*>/gi,"");
        var export_data = $("<center>"+data+"</center>").clone().find(".remove_tag").remove().end().html();
        //export_data+=htmlToPrint;
        return title+"####"+export_data;
}

</script>