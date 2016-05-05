<?php
    $user_photo = base_url('assets/upload/No_person.jpg');
    if(file_exists(FCPATH."assets/upload/".$query->userid."_thumb.png")){
        $user_photo=base_url("assets/upload/".$query->userid."_thumb.png");
    }
?>

<div class="result_info">
			      	<div class="col-sm-6">
			      		<strong>USER INFORMATION</strong>
			      	</div>
			      	<div class="col-sm-6" style="text-align: center">
			      		<strong>
			      			<center style='color:red;'>
			      				<?php if(isset($error->error))
									echo $error->error;?>
							</center>
			      		</strong>	
			      	</div>
</div> 
<?php
	$dash= array('Full'=>'/system/dashboard',
				'Socail'=>'system/dashboard/view_soc/',
				'Health'=>'/system/dashboard/view_health/',
				'Employee'=>'/system/dashboard/view_staff',
				'Student'=>'/system/dashboard/view_std/');
	$moduleid = '';
	if($query->def_open_page != ''){
		parse_str($query->def_open_page,$arr);
		$moduleid = $arr['m'];
	}
	
?>
<style type="text/css">
	tr ul{display: none !important;}
</style>
<div class="row">
	<div class="col-sm-12">
	    <div class="panel panel-default">
	      	<div class="panel-body">
		        <div class="table-responsive" id="tab_print">
						<form enctype="multipart/form-data" accept-charset="utf-8" method='post' id="defaultform" action='<?php echo site_url('setting/user/update');?>'>
							<input type='text' id='txtuserid' style='display:none;' name='txtuserid' value="<?php echo $query->userid;?>">
							<table align='center' width="900">
								<tr>
									<td><label for="emailField">First Name</label></td>
									<td> : </td>
									<td><input  type='text' class="form-control" name='txtf_name' value="<?php echo $query->first_name;?>" id='txtf_name' required data-parsley-required-message="Enter First Name" placeholder="your First name"/>
									</td>
									<td><label for="emailField">last name</label></td>
									<td> : </td>
									<td><input type='text' class="form-control" name='txtl_name' value="<?php echo $query->last_name;?>" id='txtl_name' required data-parsley-required-message="Enter Last Name" placeholder="your Last name"/>
									</td>
									<td rowspan='3' style='border:0px solid #CCCCCC; text-align:center; width:200px'>
										<img src="<?php echo $user_photo ?>" id="uploadPreview" style='width:120px; height:150px; margin-bottom:15px'>
										<input id="uploadImage" type="file" accept="image/gif, image/jpeg, image/jpg, image/png" name="userfile" onchange="PreviewImage();" style="visibility:hidden; display:none;" />
										<input type='button' class="btn btn-success" onclick="$('#uploadImage').click();" value='Browse'/>
									</td>
									<td rowspan='3' style='border:0px solid #CCCCCC; text-align:center; width:200px; display:none;'>
										<div class="form-group">
											<label class="control-label">School Level</label>
											<select  class="form-control months" multiple  name="schlevelid[]" id="schlevel" >
												
											</select>
										</div>
									</td>
								</tr>
								<tr>
									<td><label for="emailField">User Name</label></td>
									<td> : </td>
									<td><input type='text' class="form-control" name='txtu_name' value="<?php echo $query->user_name;?>" id='txtu_name' required data-parsley-required-message="Enter User Name" placeholder="your User name"/></td>
									<td><label for="emailField">Password</label></td>
									<td> : </td>
									<td><input type='password' class="form-control" name='txtpwd' id='txtpwd' value="<?php echo $query->password;?>" required data-parsley-required-message="Enter Password" placeholder="your Password"/></td>

								</tr>
								<tr>
									<td><label for="emailField">Email address</label></td>
									<td> : </td>
									<td class='control-group'><input type='text' class="form-control" value="<?php echo $query->email;?>" name='txtemail' id='txtemail' required data-parsley-required-message="Enter Email" placeholder="your Email Address"/></td>
									<td><label for="emailField">Role</label></td>
									<td> : </td>
									<td>
										<select name='cborole' id='cborole' class="form-control">
											<?php
											foreach ($this->role->getallrole() as $role_row) {?>
												<option value='<?php echo $role_row->roleid; ?>' <?php if($query->roleid==$role_row->roleid) echo 'selected';?>> <?php echo $role_row->role ; ?></option>
											<?php }
											?>
										</select>
									</td>
									
								</tr>
								<tr style="display:none">
									<td colspan="6">
										<div class="panel panel-default">
											<div class="panel-heading">
												<h4 class="panel-title">Startup Page</h4>
											</div>
											<div class="panel-body">
												<table width="100%">
													<tr>
														<td style="width: 30%"><label for="emailField">Dashboard</label></td>
														<td style="width: 5%">:</td>
														<td>
															<select  class="form-control months"  name="dashboard" id="dashboard" >
																<?php foreach ($dash as $key => $value) { ?>
																	<option value='<?PHP echo $value ?>' <?php if($query->def_dashboard==$value) echo 'selected'; ?>><?php echo $key ?> </option>";
															<?php 	} ?>
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
										<input type='submit' class="btn btn-primary" name='btnsubmit' id='btnsubmit' value='Save User'>
										<input type='reset' class="btn btn-warning" name='btnreset' id='btnreset'>
										<button type="button" class="btn btn-danger" id='btncancel'>Cancel</button>
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
	</div>
		
		<script type="text/javascript">
		$(document).ready(function(){

			LoadModule("<?php echo $moduleid ;?>");
			loadPage("<?php echo $query->def_open_page?>");

			$(document).on('change','#cborole',function(){
				LoadModule();
			});
			$(document).on('change','#moduleallow',function(){
				loadPage();
			});
			$('#btncancel').click(function(){
				var r = confirm("Are you sure to cancel !");
				if (r == true) {
					location.href="<?PHP echo site_url('setting/user/');?>";
				} else {
				   
				}
			});
		});
		function PreviewImage() {
		        var oFReader = new FileReader();
		        oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

		        oFReader.onload = function (oFREvent) {
		            document.getElementById("uploadPreview").src = oFREvent.target.result;
		            document.getElementById("uploadPreview").style.backgroundImage = "none";
		        };
		};
	    $(function(){
			$('#defaultform').parsley();				
		})
		function loadPage(defpage=''){
			$.ajax({
	    		type : "POST",
	    		url  : "<?php echo site_url('setting/user/getPage')?>",
	    		data: {
	    			'moduleid' : $("#moduleallow").val(),
	    			'defpage'  : defpage
	    		},
	    		success:function(data){
	    			$('#defpage').html(data);
	    		}
	    	});
		}
		function LoadModule(moduleid=''){
	    	$.ajax({
	    		type : "POST",
	    		url  : "<?php echo site_url('setting/user/getModule')?>",
	    		dataType: 'json',
	    		async: false,
	    		data: {
	    			'roleid' : $("#cborole").val(),
	    			'moduleid': moduleid
	    		},
	    		success:function(data){
	    			$('#moduleallow').html(data.op);
	    			$('#defpage').html(data.oppage);
	    		}
	    	});
	    }//End Load Module
	</script>