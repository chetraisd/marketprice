<div class="result_info">
			      	<div class="col-sm-6">
			      		<strong>PAGE INFORMATION</strong>
			      		
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
					<form  enctype="multipart/form-data" accept-charset="utf-8" method="post" id="defaultform" action='<?php echo site_url('setting/page/savepage');?>'>
						<table align='center' width="700">
							<tr>
								<td><label for="emailField">Page Name</label></td>
								<td> : </td>
								<td><input  type='text' class="form-control" name='txtp_name' id='txtp_name' required data-parsley-required-message="Enter Page Name" placeholder="Place Page name"/>
								<td rowspan='4' style='border:0px solid #CCCCCC; width:200px'>
									<fieldset style='border:solid 1px #CCCCCC; padding:10px;'>
											<input type='checkbox' name='is_insert' > <label for="emailField"> B_Insert</label></br>
											<input type='checkbox' name='is_delete' > <label for="emailField"> B_Delete</label></br>
											<input type='checkbox' name='is_update' > <label for="emailField"> B_Update</label></br>
											<input type='checkbox' name='is_show' > <label for="emailField"> B_Show</label></br>
											<input type='checkbox' name='is_print' > <label for="emailField"> B_Print</label></br>
											<input type='checkbox' name='is_export' > <label for="emailField"> B_Export</label></br>
									</fieldset>	
									
								</td>
							</tr>
							<tr>
								<td><label for="emailField">Page Link</label></td>
								<td> : </td>
								<td><input type='text' class="form-control" name='txtp_link' id='txtp_link' required data-parsley-required-message="Enter Page Link" placeholder="Place Menu Link "/></td>
								
							</tr>
							<tr>
								<td><label for="emailField">Module</label></td>
								<td> : </td>
								<td class='control-group'>
									<select class="form-control" id='cbomodule'name='cbomodule' placeholder='select Module'>
											
											<?php
												foreach ($this->module->getmodule() as $role_row) {
													echo "<option value='$role_row->moduleid'>$role_row->module_name</option>";
												}
											?>
									
									</select>
								</td>
								
							</tr>
							<tr>
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
		    $(function(){
				$('#defaultform').parsley();				
			})
		$(document).ready(function() {

		$
        });
	</script>