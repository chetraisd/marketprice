
<div class="wrapper">
	<div class="col-sm-12">
    	<div class="panel-heading">
        	<div class="row result_info">
            	<div class="col-sm-9"><?php echo $this->lang->line('search_title')?></div>
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
                        <span class="top_action_button">
                            <?php if ($this->green->gAction("P")) { ?>
                                <a href="javascript:void(0)" id="a_dialog" class="a_dialog">
									<img src="<?php echo base_url("assets/images/icons/add.png")?>"/>
								</a>
                            <?php } ?>
                        </span>
                        
        		</div>
            </div>
            
            <div class="row">
            	<div class="col-sm-12">
                 	<div class="col-sm-6">
                        <label class="control-label"><?php echo $this->lang->line('service')?></label>
                        <input type="text" name="s_service_name" id="s_service_name" class="form-control input-xs s_service_name" />
                		 <input type="hidden" name="h_serviceCode" id="h_serviceCode" class="form-control input-xs h_serviceCode" />
                	</div>
                	<div class="col-sm-6">
                        <label class="control-label"><?php echo $this->lang->line('service_type')?></label>
                        <select name="s_service_type" id="s_service_type" class="form-control input-xs s_service_type" style="font-size:12px;">
                        <?php  echo $option_des; ?>					
						</select>
                	</div>
                </div>
                
        	</div> <!-- div row-->
        </div><!-- div head-->
     </div>
     
	<div class="col-sm-6">
	    <div class="col-sm-12">
	        <input type="button" name="search" id="search" class="btn btn-primary" value="<?php echo $this->lang->line('search')?>" />
	        <input type="button" name="clear" id="clear" class="btn btn-warning" value="<?php echo $this->lang->line('clear')?>" />
	    </div>
	</div>

	<div class="col-sm-12">
	 	<div class="table-responsive" id="dv-print">
	    <table class="table table-condensed">
	        <thead>
	            <tr>
	                <th class="col-xs-1"><?php echo $this->lang->line('no')?></th>
	                <th class="col-xs-2"><?php echo $this->lang->line('code')?></th>
					<th class="col-xs-2"><?php echo $this->lang->line('service')?></th>
	                <th class="col-xs-2"><?php echo $this->lang->line('service_type')?></th>
                    <th class="col-xs-2"><?php echo $this->lang->line('sub_service_type')?></th>
	                <th class="col-xs-2" style=""><?php echo $this->lang->line('note')?></th>
	                <th class="col-xs-2" style="text-align:center;"><?php echo $this->lang->line('price')?></th>
	                <th class="col-xs-1 remove_tag" colspan="2" style="text-align:center;">
	                	<?php echo $this->lang->line("action")?>
	                </th>
	            </tr>
	        </thead>
	        <tbody id="show_tbl">
	        
	        </tbody>
	    </table>
	    </div>
	</div>
</div>
<div id="show_dialog" style="display:none">
	<div class="col-sm-12">
    	<div class="panel-heading">
            <div class="row">
            	<div class="col-sm-12">
                 	<div class="col-sm-6">
                        <label class="control-label"><?php echo $this->lang->line('service_code')?><span style="color:red">*</span></label>
                        <input type="text" name="service_code" id="service_code" class="form-control input-xs" />
                        <input type="hidden" name="h_serviceCode" id="h_serviceCode" class="form-control input-xs" />
                    </div>
                    <div class="col-sm-6">
                        <label class="control-label"><?php echo $this->lang->line('service_name')?><span style="color:red">*</span></label>
                        <input type="text" name="service_name" id="service_name" class="form-control input-xs" />
                	</div>
                </div>
                <div class="col-sm-12">
                 	<div class="col-sm-6">
                    	<label class="control-label"><?php echo $this->lang->line('service_type')?><span style="color:red">*</span></label>
                        <select id="disease_type" name="disease_type" class="form-control input-xs" style="font-size:12px;">
                        <?php
							echo $option_des;						
						?>
                        </select>
                	</div>
                	<div class="col-sm-6">
                    	<label class="control-label"><?php echo $this->lang->line('sub_service_type')?></label>
                        <select id="sub_disease_type" name="sub_disease_type" class="form-control input-xs" style="font-size:12px;">
                        <?php
							echo $opt_subservice;						
						?>
                        </select>
                	</div>
                    
                </div>
                <div class="col-sm-12">
                 	<div class="col-sm-6">
                    	<label class="control-label"><?php echo $this->lang->line('note')?></label>
                        <input type="text" name="note" id="note" class="form-control input-xs">
                    </div>
                    <div class="col-sm-6">
                    	<label class="control-label"><?php echo $this->lang->line('price')?></label>
                        <input type="text" name="price" id="price" class="form-control input-xs price">
                    </div>
                </div>            
        	</div> <!-- div row -->
        </div><!-- div head -->
     </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	var obj_show = new fn_process();
	obj_show.fn_show();
	$("#s_service_type").on("change",function(){
		var obj_show1 = new fn_process();
		obj_show1.fn_show();
	})
	$("#search").on("click",function(){
		var obj_show1 = new fn_process();
		obj_show1.fn_show();
	})
	// add service new
	$('body').delegate("a#a_dialog","click",function(){
		show_dialog();
	})
	$("#price").on("keydown", function (e) {
        if ((e.keyCode >= 96 && e.keyCode <= 105) || (e.keyCode >= 48 && e.keyCode <= 57) || e.keyCode == 8 || e.keyCode == 190 || e.keyCode == 110) {
            $(this).removeAttr("readonly");
        } else {
            $(this).attr("readonly", "readonly");
        }

    });
	// end add service new
	$("#clear").on("click",function(){
		var obj_clear = new fn_process();
		obj_clear.fn_clear();
	});
	$("body").delegate("#a_edite","click",function(){
		var servicecode = $(this).parent().parent().find("#h_diseasecode").val();
		var obj_edite = new fn_process();
		obj_edite.fn_edite(servicecode);
		show_dialog();
	});
	$("body").delegate("#a_delete","click",function(){
		var hservicecode = $(this).parent().parent().find("#h_diseasecode").val();
		var conf = confirm("<?php echo $this->lang->line('confirm_delete')?>");
		if(conf == true){
			var obj_delete = new fn_process();
			obj_delete.fn_delete(hservicecode);
			obj_delete.fn_show();
		}
		return false;
	});
	$("body").delegate("#s_service_name","keyup",function(){
		var ser_val = $(this).val();
		if(ser_val == ""){
			$("#h_serviceCode").val("");
		}
	});
	$("#s_service_name").focus(function (){
	        $(this).select();
	       autoService();
	});

	$("body").delegate("a#export","click",function(){
        var arr_exp = fn_pr_ex().split("####");
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent(arr_exp[1]));
    });
    
    $("body").delegate("a#print","click",function(){
        var arr_pr = fn_pr_ex().split("####");
        gsPrint(arr_pr[0],arr_pr[1]);
    });
});

function show_dialog(){
	$("#show_dialog").dialog({
			autoOpen:true,
			title:"<?php echo $this->lang->line('add_new_service')?>",
			width:700,
			height: 350,
			modal:true,
			closeOnEscape: false,
			open: function(event, ui) { 
				$(".ui-dialog-titlebar-close", ui.dialog | ui).hide();
			},
			buttons:{
					"<?php echo $this->lang->line('save')?>":function(){
						var obj_save = new fn_process();
						var get_cond = obj_save.fn_save();
						if(get_cond == true){
							obj_save.fn_clear();
							obj_save.fn_show();
							$("#show_dialog").dialog("destroy");
						}
					},
					
					"<?php echo $this->lang->line('close')?>":function(){
						var show_clear = new fn_process();
						show_clear.fn_clear();
						$("#show_dialog").dialog("destroy");
					}		
			}
	});
}
function autoService(get_selector,para_cond) {
    var url = "<?php echo site_url('service/c_service/cautoService');?>";
	$("#s_service_name").autocomplete({
        source: url,
        minLength: 0,
        select: function (events, ui) {
            $('#h_serviceCode').val(ui.item.id);
        }
    });
    
}
function fn_pr_ex(){
        $(".remove_inv").removeAttr("href");
        // var htmlToPrint = ''+'<style type="text/css">' +
        //                        'table th, table td {' +
        //                        'border:1px solid #000 !important;' +
        //                        'padding;0.5em;' +
        //                        '}' +
        //                        '</style>';
        var title   = "<center><span style='font-weight:bold; font-size:16px;'>Report Service List</span></center><br>";
        //var s_adr   = "Title</div>";
        //    title+=s_adr;
        //title +="<h4 align='center'>Invoice</h4>"; 
        var data = $("#dv-print").html().replace(/<img[^>]*>/gi,"");
        var export_data = $("<center>"+data+"</center>").clone().find(".remove_tag").remove().end().html();
        //export_data+=htmlToPrint;
        return title+"####"+export_data;
}
function fn_process(){
		this.service_code = $("#service_code").val();
		this.h_serviceCode= $("#h_serviceCode").val();
		this.service_name = $("#service_name").val();
		this.disease_type = $("#disease_type").val();
		this.sub_disease_type = $("#sub_disease_type").val();
		this.note         = $("#note").val();
		this.price        = $("#price").val();
		var arr_obj = {
						"servicecode": this.service_code,
						"h_serviceCode":this.h_serviceCode,
						"service_name":this.service_name,
						"disease_type":this.disease_type,
						"sub_disease_type":this.sub_disease_type,
						"note": this.note,
						"price": this.price
					}
		
		this.fn_save = function fn_save(){
			if(this.service_code == ""){
				alert("<?php echo $this->lang->line('alert_code')?>");
		 		//alert("Please input service code before process.");
				$("#service_code").focus();
				return false;
			}else if(this.service_name == ""){
				alert("<?php echo $this->lang->line('alert_service_name')?>");
				//alert("Please input service name before process.");
				$("#service_name").focus();
				return false;
			}else if(this.disease_type == ""){
				alert("<?php echo $this->lang->line('alert_disease_type')?>");
				//alert("Please input disease type before process.");
				$("#disease_type").focus();
				return false;
			}else{
				var check = this.fn_check();
				if(this.h_serviceCode == "" || this.h_serviceCode != this.service_code){
					if(check > 0){
						alert("<?php echo $this->lang->line('alert_duplicate')?>");
						// alert("Your service code is duplicate. Please try again.");
						$("#service_code").focus();
						return false;
					}
				}
				var conf = "";
				if(this.h_serviceCode == ""){
					conf = confirm("<?php echo $this->lang->line('confirm_save')?>");
				}else{
					conf = confirm("<?php echo $this->lang->line('confirm_update')?>");
				}
				if(conf == true){
					$.ajax({
							type:"POST",
							url:"<?= site_url("service/C_service/csave") ?>",
							DataType:"JSON",
							async:false,
							data:{
								Para_save : 1,
								arr_obj   : arr_obj	
							},
							success:function(data){
							}
					});
					return true;	
				}else{
					return false;
				}
				
			}
			
		},
		this.fn_show = function fn_show(){
			$.ajax({
					type:"POST",
					url:"<?= site_url("service/C_service/cshow") ?>",
					DataType:"JSON",
					async:false,
					data:{
						h_serviceCode  : $("#h_serviceCode").val(),
						s_service_type : $("#s_service_type").val()
					},
					success:function(data){
						 $("#show_tbl").html(data);
					}
			});
		},
		this.fn_edite = function fn_edite(servicecode){
			$.ajax({
					type:"POST",
					url:"<?= site_url("service/c_service/cedit") ?>",
					DataType:"JSON",
					async:false,
					data:{
						Para_edite : 1,
						servicecode :servicecode	
					},
					success:function(data){
						if(data['arr_count']['amt_count'] > 0){
							$("#service_code").val(data['arr_sql']['service_code']);
							$("#service_code").attr('disabled', 'disabled');
						}else{
							$("#service_code").val(data['arr_sql']['service_code']);
							$("#service_code").removeAttr("disabled");
						}
						
						$("#h_serviceCode").val(data['arr_sql']['service_code']);
						$("#service_name").val(data['arr_sql']['service_name']);
						$("#disease_type").val(data['arr_sql']['disease_code']);
						$("#sub_disease_type").val(data['arr_sql']['subservice_code']);
						$("#note").val(data['arr_sql']['note']);
						$("#price").val(data['arr_sql']['price']);
					}
			});
		},
		this.fn_check = function fn_check(){
			var amt_v = 0;
			$.ajax({
					type:"POST",
					url:"<?= site_url("service/c_service/ccheck"); ?>",
					DataType:"JSON",
					async:false,
					data:{
						para_check : this.service_code
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
					url:"<?= site_url("service/c_service/cdelete"); ?>",
					DataType:"JSON",
					async:false,
					data:{
						para_delete : code_delete
					},
					success:function(data){
						if(data.arr_label == 100){
							alert("<?php echo $this->lang->line('alert_check')?>");
							//alert("Sorry this record can't delete ? It has transection already.");
						}else{
							alert("<?php echo $this->lang->line('delete_success')?>");

						}
					}
			});
		},
		this.fn_clear = function fn_clear(){
			$("#service_code").val("");
			$("#h_serviceCode").val("");
			$("#service_name").val("");
			$("#disease_type").val("");
			$("#sub_disease_type").val("");
			$("#note").val("");
			$("#price").val("");
		}
}
</script>