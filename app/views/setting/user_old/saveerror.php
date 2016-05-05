<?php
	$dash= array('Full'=>'/system/dashboard',
				'Socail'=>'system/dashboard/view_soc/',
				'Health'=>'/system/dashboard/view_health/',
				'Employee'=>'/system/dashboard/view_staff',
				'Student'=>'/system/dashboard/view_std/');
	$moduleid = '';
	if($save->def_open_page != ''){
		parse_str($save->def_open_page,$arr);
		$moduleid = $arr['m'];
	}
?>
<div class="result_info">
			      	<div class="col-sm-6">
			      		<strong>USER INFORMATION</strong>
			      		
			      	</div>
			      	<div class="col-sm-6" style="text-align: center">
			      		<strong>
			      			<center style='color:red;'><?php echo $save->error; ?></center>
			      		</strong>	
			      	</div>
			      </div> 
<div class="row">
	<div class="col-sm-12">
	    <div class="panel panel-default">
	      	<div class="panel-body">
		        <div class="table-responsive" id="tab_print">
					<form enctype="multipart/form-data" accept-charset="utf-8" method='post' id="defaultform" action='<?php echo site_url('setting/user/saveuser');?>'>
						<table align='center' width="900">
							<tr>
								<td><label for="emailField">First Name</label></td>
								<td> : </td>
								<td><input  type='text' class="form-control" name='txtf_name' id='txtf_name' value="<?php echo $save->first_name; ?>" required data-parsley-required-message="Enter First Name" placeholder="your First name"/>
								</td>
								<td><label for="emailField">last name</label></td>
								<td> : </td>
								<td><input type='text' class="form-control" name='txtl_name' id='txtl_name' value="<?php echo $save->last_name; ?>" required data-parsley-required-message="Enter Last Name" placeholder="your Last name"/>
								</td>
								<td rowspan='3' style='border:0px solid #CCCCCC; text-align:center; width:200px'>
									<div class="form-group">
										<label class="control-label">School Level</label>
										<select  class="form-control months" multiple  name="schlevelid[]" id="schlevel" >
											<?php foreach ($this->db->get('sch_school_level')->result() as $schl) {
												$selec=$this->db->select('count(userid) as count')->from('sch_user_schlevel')->where('userid',$query->userid)->where('schlevelid',$schl->schlevelid)->get()->row()->count;
											 ?>
												<option value="<?php echo $schl->schlevelid ?>" <?php if($selec>0) echo 'selected' ?>><?php echo $schl->sch_level ?></option>";
											<?php } ?>
										</select>
									</div>
								</td>
							</tr>
							<tr>
								<td><label for="emailField">User Name</label></td>
								<td> : </td>
								<td><input type='text' class="form-control" name='txtu_name' id='txtu_name' value="<?php echo $save->user_name; ?>" required data-parsley-required-message="Enter User Name" placeholder="your User name"/></td>
								<td><label for="emailField">Password</label></td>
								<td> : </td>
								<td><input type='password' class="form-control" name='txtpwd' id='txtpwd' required data-parsley-required-message="Enter Password" placeholder="your Password"/></td>
								
							</tr>
							<tr>
								<td><label for="emailField">Email address</label></td>
								<td> : </td>
								<td class='control-group'><input type='text' class="form-control" value="<?php echo $save->email; ?>" name='txtemail' id='txtemail' required data-parsley-required-message="Enter Email" placeholder="your Email Address"/></td>
								
								<td><label for="emailField">Role</label></td>
								<td> : </td>
								<td>
									<select name='cborole' id='cborole' class="form-control">
										<?php
										foreach ($this->role->getallrole() as $role_row) {?>
											<option value='<?php echo $role_row->roleid; ?>' <?php if($save->roleid==$role_row->roleid) echo 'selected';?>> <?php echo $role_row->role ; ?></option>
										<?php }
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
												<tr>
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
								<td style='border:0px solid #CCCCCC; text-align:center; width:200px'>
									<img src="<?php echo site_url('../upload/No_person.jpg') ?>" id="uploadPreview" style='width:120px; height:150px'>
									<input id="uploadImage" type="file" accept="image/gif, image/jpeg, image/jpg, image/png" name="userfile" onchange="PreviewImage();" style="visibility:hidden;" />
									<input type='button' class="btn btn-success" onclick="$('#uploadImage').click();" value='Browse'/>
									
								</td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td colspan='2'>
									<input type='submit' class="btn btn-primary" name='btnsubmit' id='btnsubmit' value='Save User'>
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
</div>
		<div style='text-align:center; color:red;'></div>
		<hr/>
		
		<script type="text/javascript">
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
		$(document).ready(function() {
			LoadModule("<?php echo $moduleid?>");
			loadPage("<?php echo $save->def_open_page?>");

			$(document).on('change','#cborole',function(){
				LoadModule();
			});
			$(document).on('change','#moduleallow',function(){
				loadPage();
			});
        });
	</script>