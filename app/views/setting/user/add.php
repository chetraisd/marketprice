<div class="row result_info">
    <div class="col-xs-3">
        <strong>USER INFORMATION</strong>
    </div>
    <div class="col-sm-9" style="text-align: center">
        <strong>
            <center style='color:red;'><?php echo $save->error; ?></center>
        </strong>
        
    </div>
</div>
<style type="text/css">
	tr ul{display: none !important;}
	table{
		border-collapse: collapse;
		/*border:1px solid #CCCCCC;*/
	}
	/*#listuser td,#listuser th{
		border:1px solid #CCCCCC;
		padding: 5px ;
	}*/
	td,th{
		padding: 5px ;
	}
	#listbody tr td a img{height: 25px !important; border:none !important;}
	#pgt{
		border:solid 0px !important;
	}
	img{border:solid 1px #CCCCCC;);
		background-position:center;
		background-size:cover;
		padding: 3px;
	}
	/*th{
			background-color: #383547; 
			text-align: center;
			color: white;
	}*/
	a{cursor: pointer;}
</style>


	
	<div class="col-sm-12">
	    <div class="panel panel-default">
	      	<div class="panel-body">
		        <div class="table-responsive" id="tab_print">
				<form  enctype="multipart/form-data" accept-charset="utf-8" method="post" id="defaultform" action='<?php echo site_url('setting/user/saveuser');?>'>
					<table align='center' width="900">
						<tr>
							<td><label for="emailField">First Name</label></td>
							<td> : </td>
							<td><input  type='text' class="form-control" name='txtf_name' id='txtf_name' required data-parsley-required-message="Enter First Name" placeholder="your First name"/>
								<input  type='hidden' class="user_id" name='user_id' id='user_id' />
                            </td>
							<td><label for="emailField" class="no-wrap">Last Name</label></td>
							<td> : </td>
							<td><input type='text' class="form-control" name='txtl_name' id='txtl_name' required data-parsley-required-message="Enter Last Name" placeholder="your Last name"/>
							</td>
							
							<td rowspan='3' style='border:0px solid #CCCCCC; text-align:center; width:200px'>
							
								<img src="<?php echo base_url('assets/upload/user_profile/No_person.jpg') ?>" id="uploadPreview" style='width:120px; height:150px; margin-bottom:15px'>
								<input id="uploadImage" accept="image/gif, image/jpeg, image/jpg, image/png" type="file" name="userfile" onchange="PreviewImage();" style="visibility:hidden; display:none" />
								<input type='button' class="btn btn-success" onclick="$('#uploadImage').click();" value='Browse'/>
							
							</td> 	
						</tr>
						<tr>
							<td><label for="emailField">User Name</label></td>
							<td> : </td>
							<td><input type='text' class="form-control" name='txtu_name' id='txtu_name' required data-parsley-required-message="Enter User Name" placeholder="your User name"/></td>
							<td><label for="emailField">Password</label></td>
							<td> : </td>
							<td><input type='password' class="form-control" name='txtpwd' id='txtpwd'  data-parsley-required-message="Enter Password" placeholder="your Password"/>
                            	<input type='hidden' class="pass_edit" name='pass_edit' id='pass_edit'/>
                            </td>
							
						</tr>
						<tr>
							<td><label for="emailField">Email address</label></td>
							<td> : </td>
							<td class='control-group'><input type='text' class="form-control" name='txtemail' id='txtemail' data-parsley-required-message="Enter Email" placeholder="your Email Address"/></td>
							
							<td><label >Role</label></td>
							<td> : </td>
							<td>
								<select name='cborole' id='cborole' class="form-control">
									<?php

									foreach ($this->role->getallrole() as $role_row) {
										echo "<option value='$role_row->roleid'>$role_row->role</option>";
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td><label >Park</label></td>
							<td> : </td>
							<td class='control-group'>
								<select  multiple name='cbopark[]' id='cbopark' class="form-control" required data-parsley-required-message="Enter First Name" >
									<?php
									
										echo $this->green->user_access_park(1);
																					
										// foreach ($this->park->getallpark() as $park_row) {										
										// 	echo "<option  value='$park_row->par_typeno'>$park_row->park_name</option>";												
										// }
									
									?>
								</select>
							</td>
							
							<td><label >Entrance</label></td>
							<td> : </td>
							<td>
								<select name='cbogate' id='cbogate' class="form-control">
								
									<?php																					
										foreach ($this->gate->getallgate() as $gate_row) {
										echo "<option value='$gate_row->gat_typeno'>$gate_row->gat_name</option>";
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td colspan="6">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">Startup Page</h4>
									</div>
									<div class="panel-body">
										<table width="100%">
											<tr style="display:none">
												<td style="width: 30%"><label for="emailField">Dashboard</label></td>
												<td style="width: 5%">:</td>
												<td>
													<select  class="form-control months"  name="dashboard" id="dashboard" >
														<?php foreach ($dash as $key => $value) {
															echo "<option value='$value'>$key</option>";
														} ?>
													</select>
												</td>
											</tr>
											<tr>
												<td><label>Module</label></td>
												<td>:</td>
												<td>
													<select  class="form-control months" name="moduleallow[]" id="moduleallow" >
														<option></option>
													</select>
												</td>
											</tr>
											<tr>
												<td><label for="emailField">Def. Page</label></td>
												<td>:</td>
												<td>
													<select  class="form-control months"  name="defpage" id="defpage" >
														<option></option>
													</select>
												</td>
											</tr>
										</table>
									</div>
								</div>
							</td>							
						</tr>						
						<tr>
							<td></td>
							<td></td>
							<td colspan='2'>
							<?php if ($this->green->gAction("C")) { ?>
								<input type='submit' class="btn btn-primary" name='btnsubmit' id='btnsubmit' value='Save'>
							<?php } ?>	
								<input type='reset' class="btn btn-warning" name='btnreset' id='btnreset'>
							</td>
							
							<td></td>
							<td></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- *************************List all of user******************************* -->
<h3  align='center' class="text-muted">User List</h3>

	<div class="col-sm-12">
	    <div class="panel panel-default">
	      	<div class="panel-body">
		        <div class="table-responsive" id="tab_print">
					<table align='center' class='table'>
						<thead>
							<th class='col-xs-1' style="text-align:center;">Nº</th>
							<th class='col-xs-1'>First Name</th>
							<th class='col-xs-1'>Last Name</th>
							<th class='col-xs-1'>User Name</th>
							<th class='col-xs-2'>Email</th>
							<th class='col-xs-1'>Role</th>
							<th class='col-xs-1'>Last visit</th>
							<th class='col-xs-1'>Created date</th>
							<th class='col-xs-1' style="text-align:center;">Action</th>
						</thead>
						<tbody id='listbody'>
						</tbody>
                        <tfoot>						
                        <tr>
                            <td colspan='12' id='pgt'><div style='text-align:center'><ul class='pagination' style='text-align:center'><?php echo $this->pagination->create_links(); ?></ul></div></td>
                        </tr> 
						</tfoot>
					</table>
				</div>
			</div>	
		</div>
	</div>


<script type="text/javascript">
	$(function(){

		show_inf();
		checkRequired();
		LoadModule();
		defaulselect();
		$(document).on('change','#cborole',function(){
			LoadModule();
		});
		$(document).on('change','#moduleallow',function(){
			LoadPage();
		});
		$("#txtpwd").keyup(function(){
			$("#pass_edit").val($(this).val());
			checkRequired();
		});

		$("body").delegate("a#edite","click",function(){
			var valEdite = $(this).attr("att_edit");
			$("#cbopark option:selected").removeAttr("selected");
			$.ajax({
				type : "POST",
				url  : "<?php echo site_url('setting/user/cEdite')?>",
				dataType: 'json',
				async: false,
				data: {
					val_edit : valEdite
				},
				success:function(data){
					$("#user_id").val(data.tbl.userid);
					$("#txtf_name").val(data.tbl.first_name);
					$("#txtl_name").val(data.tbl.last_name);
					$("#txtu_name").val(data.tbl.user_name);
					//$("#txtpwd").val(data.tbl.password);
					$("#txtemail").val(data.tbl.email);
					$("#cborole").val(data.tbl.roleid);
					$("#cbopark").val(data.tbl.par_typeno);
					$("#cbogate").val(data.tbl.gat_typeno);
					$("#uploadPreview").attr("src",data.img);

					var userparks=data.user_park;
					if(userparks!=""){
						$("#cbopark").html(userparks);
					}
				}
			});
			checkRequired();
			LoadModule();
		});
		$("body").delegate("#btnreset","click",function(){
			$("#user_id").val("");
			$("#uploadPreview").attr("src","<?=base_url('assets/upload/user_profile/No_person.jpg')?>");
		});
		$("body").delegate("#delete","click",function(){
			var att_delete = $(this).attr("att_del");
			var conf = confirm("Do you want to delete?");
			if(conf == true){
				$.ajax({
					type : "POST",
					url  : "<?php echo site_url('setting/user/cDeleteUser')?>",
					dataType: 'json',
					async: false,
					data: {
						att_delete : att_delete
					},
					success:function(data){
						
					}
				});
				show_inf();
			}else{
				return false;	
			}
		});

	});

	function defaulselect(){
		$("#cbopark").find("option").attr("selected",true);
	}
	
	function show_inf(){
		$.ajax({
				type : "POST",
				url  : "<?php echo site_url('setting/user/cshow_tbl')?>",
				dataType: 'json',
				async: false,
				data: {
					show_tbl : 1
				},
				success:function(data){
					$("tbody#listbody").html(data.tr);
					
				}
			});
	}

	function checkRequired(){
		if($("#user_id").val()=="" && $("#pass_edit").val()==""){
			$("#txtpwd").attr("required","required");	
		}else{
			$("#txtpwd").removeAttr("required");
		}
	}

	function PreviewImage() {
		var oFReader = new FileReader();
		oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

		oFReader.onload = function (oFREvent) {
			document.getElementById("uploadPreview").src = oFREvent.target.result;
			document.getElementById("uploadPreview").style.backgroundImage = "none";
		};
	};
	function LoadModule(){
		    	$.ajax({
		    		type : "POST",
		    		url  : "<?php echo site_url('setting/user/getModule')?>",
		    		dataType: 'json',
		    		async: false,
		    		data: {
		    			'roleid' : $("#cborole").val()
		    		},
		    		success:function(data){
		    			$('#moduleallow').html(data.op);
		    			$('#defpage').html(data.oppage);
		    		}
		    	});
	}//End Load Module
	function LoadPage(){
		    	$.ajax({
		    		type : "POST",
		    		url  : "<?php echo site_url('setting/user/getPage')?>",
		    		dataType: 'json',
		    		async: false,
		    		data: {
		    			'moduleid' : $("#moduleallow").val()
		    		},
		    		success:function(data){
		    			$('#defpage').html(data);
		    		}
		    	});
	}//End Load Module
	
</script>