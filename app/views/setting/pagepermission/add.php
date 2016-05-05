<div class="result_info">
			      	<div class="col-sm-6">
			      		<strong>ROLE ACCESS INFORMATION</strong>
			      		
			      	</div>
			      	<div class="col-sm-6" style="text-align: center">
			      		<strong>
			      			<center class='member_error' style='color:red;'>
			      				<?php if(isset($error->error))
										echo $error->error;
								?>
			      			</center>
			      		</strong>	
			      	</div>
</div> 
<div class="row">
	<div class="col-sm-12">
	    <div class="panel panel-default">
	      	<div class="panel-body">
		        <div class="table-responsive" id="tab_print">
						<form  enctype="multipart/form-data" accept-charset="utf-8" method="post" id="defaultform" action='<?php echo site_url('setting/permission/save');?>'>
							<table align='center' width="700">
								<tr>
									<td width='100'><label for="emailField">Role Name</label></td>
									<td> : </td>
									<td><select class="form-control" id='cborole_as'name='cborole_as' onchange='fillmodule(event);' required data-parsley-required-message="Please Choose Page" min="1" >
												<option value='0'>Select Role</option>
												<?php
													foreach ($this->role->getallrole() as $role_add) {
														echo "<option value='$role_add->roleid'>$role_add->role</option>";
													}
												?>
										
										</select>
									</td>

									<td rowspan='4' style='border:0px solid #CCCCCC; width:200px'>
										<fieldset style='border:solid 1px #CCCCCC; padding:10px;'>
												<input type='checkbox' name='is_insert' > <label for="emailField"> is_Insert</label></br>
												<input type='checkbox' name='is_delete' > <label for="emailField"> is_Delete</label></br>
												<input type='checkbox' name='is_update' > <label for="emailField"> is_Update</label></br>
												<input type='checkbox' name='is_show' > <label for="emailField"> is_Show</label></br>
												<input type='checkbox' name='is_print' > <label for="emailField"> is_Print</label></br>
												<input type='checkbox' name='is_export' > <label for="emailField"> is_Export</label></br>
												<input type='checkbox' name='is_import' > <label for="emailField"> is_import</label></br>
										</fieldset>	
										
									</td>
								</tr>
								<tr>
									<td><label for="emailField">Module Name</label></td>
									<td> : </td>
									<td><select class="form-control" id='cbomodule_as' name='cbomodule_as'  onchange='filpage(event);'>
												
												<?php
													// foreach ($this->module->getmodule() as $role_row) {
													// 	echo "<option value='$role_row->moduleid'>$role_row->module_name</option>";
													// }
												?>
										
										</select>
									</td>
									
								</tr>
								<tr>
									<td><label for="emailField">Page Name</label></td>
									<td> : </td>
									<td class='control-group'>
										<select class="form-control" id='cbopage_as'name='cbopage_as' required data-parsley-required-message="Please Choose Page" min="1">
												
										</select>
									</td>
									
								</tr>
									<td></td>
									<td></td>
									<td colspan='2'>
										<input type='submit' class="btn btn-primary" name='btnsubmit' id='btnsubmit' value='Save Page'>
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
		<script type="text/javascript">
			function PreviewImage() {
		        var oFReader = new FileReader();
		        oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

		        oFReader.onload = function (oFREvent) {
		            document.getElementById("uploadPreview").src = oFREvent.target.result;
		             document.getElementById("uploadPreview").style.backgroundImage = "none";
		        };
		    };
		    function fillmodule(event){
				var roleid=jQuery('#cborole_as').val();
					$.ajax({
							url:"<?php echo base_url(); ?>index.php/setting/permission/fillmodule",    
							data: {'roleid':roleid},
							type: "POST",
							success: function(data){
                               jQuery('#cbomodule_as').html(data);
                               jQuery('#cbopage_as').html("");
                           
						}
					});
			}
			 function filpage(event){
				var moduleid=jQuery('#cbomodule_as').val();
					$.ajax({
							url:"<?php echo base_url(); ?>index.php/setting/permission/fillpage",    
							data: {'moduleid':moduleid},
							type: "POST",
							success: function(data){
								//alert(data);
                               jQuery('#cbopage_as').html(data);
						}
					});
			}
			$(function(){
				$('#defaultform').parsley();				
			})
		$(document).ready(function() {
					
        });
	</script>