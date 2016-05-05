<html>
<title>Create Service Type</title>
<body>
<div class="wrapper">
	<div class="col-sm-12">
    	<div class="panel-heading">
        	<div class="row result_info">
            	<div class="col-xs-6">
        		<strong>Service type</strong>
                </div>
            </div>
            <div class="row">
            	<div class="col-sm-12">
                 	<div class="col-sm-6">
                        <label class="control-label">Service code<span style="color:red">*</span></label>
                        <input type="text" name="service_code" id="service_code" class="form-control input-xs" />
                        <input type="hidden" name="h_serviceCode" id="h_serviceCode" class="form-control input-xs" />
                    </div>
                    <div class="col-sm-6">
                        <label class="control-label">Service name<span style="color:red">*</span></label>
                        <input type="text" name="service_name" id="service_name" class="form-control input-xs" />
                	</div>
                </div>
                <div class="col-sm-12">
                 	<div class="col-sm-6">
                    	<label class="control-label">Disease type<span style="color:red">*</span></label>
                        <select id="disease_type" name="disease_type" class="form-control input-xs">
                        <?php
							$query = $this->db->query("SELECT
															tbl_disease_type.disease_code,
															tbl_disease_type.disease_name
															FROM
															tbl_disease_type
															")->result();
							$option = "<option value=''></option>";
							foreach($query as $row){
								$option .= '<option value="'.$row->disease_code.'">'.$row->disease_name.'</option>';
							}
							echo $option;
						
						?>
                        </select>
                	</div>
                    <div class="col-sm-6">
                    	<label class="control-label">Note</label>
                        <input type="text" name="note" id="note" class="form-control input-xs">
                    </div>
                </div>      
        	</div> <!-- div row-->
        </div><!-- div head-->
     </div>
     
     <div class="col-sm-6">
        <div class="col-sm-12">
            <input type="button" name="save" id="save" class="btn btn-primary" value="SAVE" />
            <input type="button" name="clear" id="clear" class="btn btn-warning" value="CLEAR" />
        </div>
     </div>
     
	 <div class="col-sm-12">
        <div class="row result_info">
            <div class="col-sm-6"><strong>Service list</strong></div>
        </div>
     	<div class="table-responsive">
         <table class="table table-condensed">
            <thead>
                <tr>
                    <th class="col-xs-1">No</th>
                    <th class="col-xs-2">Service code</th>
                    <th class="col-xs-3">Service type</th>
                    <th class="col-xs-2">Disease name</th>
                    <th class="col-xs-3">Note</th>
                    <th class="col-xs-1" colspan="2" style="text-align:center;">Action</th>
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
	obj_show.fn_show();
	$("#save").on("click",function(){
	 	var obj = new fn_process();
		if(obj.service_code == ""){
			alert("Please input service code before process.");
			$("#service_code").focus();
		}else if(obj.service_name == ""){
			alert("Please input service name before process.");
			$("#service_name").focus();
		}else if(obj.disease_type == ""){
			alert("Please input disease type before process.");
			$("#disease_type").focus();
		}else{
			var check = obj.fn_check();
			if(obj.h_serviceCode == "" || obj.h_serviceCode != obj.service_code){
				if(check > 0){
					alert("Your service code is duplicate. Please try again.");
					$("#service_code").focus();
					return false;
				}
			}
			var conf = "";
			if(obj.h_serviceCode == ""){
				conf = confirm("Do you want to save ?");
			}else{
				conf = confirm("Do you want to update ?");
			}
			if(conf == true){
				obj.fn_save();
				obj.fn_clear();
				obj.fn_show();
				$("#save").val("SAVE");
			}
			return false;
		}
	});
	$("#clear").on("click",function(){
		var obj_clear = new fn_process();
		obj_clear.fn_clear();
		$("#save").val("SAVE");
	});
	$("body").delegate("#a_edite","click",function(){
		var servicecode = $(this).parent().parent().find("#h_diseasecode").val();
		var obj_edite = new fn_process();
		obj_edite.fn_edite(servicecode);
		$("#save").val("UPDATE");
	});
	$("body").delegate("#a_delete","click",function(){
		var hservicecode = $(this).parent().parent().find("#h_diseasecode").val();
		var conf = confirm("Do you want to delete this record ?");
		if(conf == true){
			var obj_delete = new fn_process();
			obj_delete.fn_delete(hservicecode);
			obj_delete.fn_show();
		}
		return false;
	});
});
function fn_process(){
		this.service_code = $("#service_code").val();
		this.h_serviceCode= $("#h_serviceCode").val();
		this.service_name = $("#service_name").val();
		this.disease_type = $("#disease_type").val();
		this.note         = $("#note").val();
		var arr_obj = {
			"servicecode": this.service_code,
			"h_serviceCode":this.h_serviceCode,
			"service_name":this.service_name,
			"disease_type":this.disease_type,
			"note": this.note 
		}
		this.fn_save = function fn_save(){
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
						 alert("success...");
					}
			});	
		},
		this.fn_show = function fn_show(){
			$.ajax({
					type:"POST",
					url:"<?= site_url("service/C_service/cshow") ?>",
					DataType:"JSON",
					async:false,
					data:{
						Para_show : 1	
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
						$("#service_code").val(data.service_code);
						$("#h_serviceCode").val(data.service_code);
						$("#service_name").val(data.service_name);
						$("#disease_type").val(data.disease_code);
						$("#note").val(data.note);
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
						//amt_v = data.amt;
					}
			});
		},
		this.fn_clear = function fn_clear(){
			$("#service_code").val("");
			$("#h_serviceCode").val("");
			$("#service_name").val("");
			$("#disease_type").val("");
			$("#note").val("");
		}
}
</script>