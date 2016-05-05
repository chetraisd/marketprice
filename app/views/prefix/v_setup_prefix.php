<html>
<title>Create Prefix Type</title>
<body>
<div class="wrapper">
	<div class="col-sm-12">
    	<div class="panel-heading">
        	<div class="row result_info">
            	<div class="col-xs-6">
        		<strong>Ticket Number format</strong>
                </div>
            </div>
            
            <div class="row">
           
            	 <div class="col-sm-12">
                 	<div class="col-sm-6">
                    	<label class="control-label">Package/Park</label>                        
                        <input type="hidden" id="h_code" name="h_code" class="form-control input-xs">
                        <select id="package_typeno" name="package_typeno" class="form-control input-xs">
                        <?php
							$query = $this->db->query("SELECT
															set_park_package.package_name,
															set_park_package.package_typeno,
															set_park_package.prefix
														FROM
															set_park_package
														WHERE set_park_package.is_active=1 ")->result();
							$option = '<option val=""></option>';
							foreach($query as $row){
								$option .= '<option value="'.$row->package_typeno.'" valprefix="'.$row->prefix.'">'.$row->package_name.'</option>';
							}
							
							echo $option;
						
						?>
                        </select>
                	</div>
                 	<div class="col-sm-6">
                    	<label class="control-label">Prefix<span style="color:red">*</span></label>
                        <input type="text" name="prefixname" id="prefixname" class="form-control input-xs" value="" />
                	</div>                    
                </div>
                 <div class="col-sm-12">
                 	<div class="col-sm-6">
                    	<label class="control-label">Symbool</label>
                        <select id="symbool" name="symbool" class="form-control input-xs">
                        	<option value=""></option>
                        	<option value=".">.</option>
                        	<option value="-">-</option>
                            <option value="/">/</option>
                            
                        </select>
                	</div> 
                 	<div class="col-sm-6">
                    	<label class="control-label">Length</label>
                        <input type="text" name="length" id="length" class="form-control input-xs" value="6" />
                	</div>                      
                </div>                 
                <div class="col-sm-12">
                 	<div class="col-sm-6">
                    	<label class="control-label">Sequence Number / Start Number</label>
                        <input type="text" name="sequence" id="sequence" class="form-control input-xs" value="1" />
                    </div> 
                 	<div class="col-sm-6">
                    	<label class="control-label">Sample</label>
                        <input readonly type="text" name="sample" id="sample" class="form-control input-xs" />
                	</div>         
                </div>
                <div class="col-sm-12">
                 	<div class="col-sm-6">
                    	<label class="control-label">Current year</label>
                    	
                    	<input type="text" name="curryear" id="curryear" class="form-control input-xs curryear" readonly="readonly" value="<?= date("Y") ?>" />
                    
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
                    <th class="col-xs-2">prefix</th>
                    <th class="col-xs-3">simbool</th>
                    <th class="col-xs-2">lengh</th>
                    <th class="col-xs-3">sequence</th>
                    <th class="col-xs-3">sample</th>
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
//-------------------------
$(document).ready(function(){
	var obj_show = new fn_process();
	obj_show.fn_show();
	FgetSequen();

	$("#package_typeno").on("change",function(){
		var myval = $(this).find("option:selected").attr("valprefix");
		$("#prefixname").val(myval);
	});

	$("#symbool,#package_typeno,#length,#prefixname,#sequence").on("change",function(){		
		FgetSequen();
	});
	$("#save").on("click",function(){
	 	var obj = new fn_process();
		if(obj.length == ""){
			alert("Please input Package/Park before process.");
			$("#length").focus();
		}else if(obj.prefixname == ""){
			alert("Please input Package/Park name before process.");
			$("#prefixname").focus();
		}else if(obj.package_typeno == ""){
			alert("Please input Package/Park code before process.");
			$("#package_typeno").focus();
		}else{
			var check = obj.fn_check();
			if(obj.package_typeno != ""){
				if(check > 0){
					alert("Your Package/Park is duplicate. Please try again.");
					$("#package_typeno").focus();
					return false;
				}
			}
			var conf = "";
			if(obj.h_code == ""){
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
		var h_id = $(this).parent().parent().find("#h_id").val();
		//alert(h_id);
		$("#h_code").val(h_id);
		var obj_edite = new fn_process();
		obj_edite.fn_edite(h_id);
		$("#save").val("UPDATE");
	});
	$("body").delegate("#a_delete","click",function(){
		var hservicecode = $(this).parent().parent().find("#h_id").val();
		var conf = confirm("Do you want to delete this record ?");
		if(conf == true){
			var obj_delete = new fn_process();
			obj_delete.fn_delete(hservicecode);
			obj_delete.fn_show();
			obj_delete.fn_clear();
			
		}
		return false;
	});
});
function defaulselect(){
		var checkval = $("#package_typeno").find("option").attr("selected",true);
		checkval.attr("valprefix");
	}
//-------------------------

function fn_process(){
		this.h_code 	= $("#h_code").val();
		this.symbool	= $("#symbool").val();
		this.prefixname = $("#prefixname").val();
		this.package_typeno = $("#package_typeno").val();
		this.length  	= $("#length").val();
		this.sequence 	= $("#sequence").val();
		this.sample   	= $("#sample").val();
		this.curryear   = $("#curryear").val();
		var arr_obj = {
			"h_code": this.h_code,
			"sequence":this.sequence,
			"sample":this.sample,
			"symbool":this.symbool,
			"prefixname":this.prefixname,
			"package_typeno":this.package_typeno,
			"length": this.length,
			"curryear":this.curryear
		}
		this.fn_save = function fn_save(){
			$.ajax({
					type:"POST",
					url:"<?= site_url('setup/c_setup_prefix/csave') ?>",
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
					url:"<?= site_url('setup/c_setup_prefix/cshow') ?>",
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
		this.fn_edite = function fn_edite(h_id){
			$.ajax({
					type:"POST",
					url:"<?= site_url('setup/c_setup_prefix/cedit') ?>",
					DataType:"JSON",
					async:false,
					data:{
						Para_edite : 1,
						h_id :h_id	
					},
					success:function(data){
						$("#length").val(data.length);
						$("#symbool").val(data.simbool);
						$("#prefixname").val(data.prefix);
						$("#curryear").val(data.years);
						$("#package_typeno").val(data.package_typeno);
						$("#sequence").val(data.sequence);
						$("#sample").val(data.sample);
					}
			});
		},
		this.fn_check = function fn_check(){
			var amt_v = 0;
			$.ajax({
					type:"POST",
					url:"<?= site_url('setup/c_setup_prefix/ccheck'); ?>",
					DataType:"JSON",
					async:false,
					data:{
						para_check : this.package_typeno,
						para_check_update : this.h_code
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
					url:"<?= site_url('setup/c_setup_prefix/cdelete'); ?>",
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
			$("#length").val("");
			$("#symbool").val("");
			$("#prefixname").val("");
			$("#package_typeno").val("");
			$("#sequence").val("");
			$("#sample").val("");
		}
}

function FgetSequen(){
	
	var symbool=$("#symbool").val();
	var length=$("#length").val();
	var sequence=$("#sequence").val();
	var curryear=$("#curryear").val();
	var prefixname=$("#prefixname").val();

	$.ajax({
			type:"POST",
			url:"<?= site_url('setup/c_setup_prefix/get_prefix'); ?>",
			DataType:"JSON",
			async:false,
			data:{
				prefixname : prefixname,
				symbool : symbool,
				length : length,
				sequence : sequence,
				curryear : curryear			
			},
			success:function(data){
				$("#sample").val(data);
			}
	});	
}
</script>