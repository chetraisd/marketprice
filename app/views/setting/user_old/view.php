<style type="text/css">
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
		
<!-- *************************List all of user******************************* -->
<h3  align='center' class="text-muted">LIST USER</h3>
<div class="row">
	<div class="col-sm-12">
	    <div class="panel panel-default">
	      	<div class="panel-body">
		        <div class="table-responsive" id="tab_print">
					<table align='center' class='table'>
						<thead>
							<th class='col-xs-1'>No</th>
							<th class='col-xs-1'>First_Name</th>
							<th class='col-xs-1'>Last_Name </th>
							<th class='col-xs-1'>User_Name</th>
							<th class='col-xs-2'>Email</th>
							<th class='col-xs-1'>Role</th>
							<th class='col-xs-1'>Last_Visit</th>
							<th class='col-xs-1'>Created_Date</th>
							<th class='col-xs-1'>Action</th>
						</thead>
						<tbody>
						</tbody>
						<tbody id='listbody'>
						<?php
						 $i=1;
							foreach ($query as $row) {
								echo "<tr>
										<td align='center'>$i</td>
										<td>$row->first_name</td>
										<td>$row->last_name</td>
										<td>$row->user_name</td>
										<td>$row->email</td>
										<td>$row->role</td>
										<td>".date("d-m-Y", strtotime($row->last_visit))."</td>
										<td>".date("d-m-Y", strtotime($row->created_date))."</td>
										<td align='center' class='ro_wrap'><a><img rel='$row->userid' onclick='deleteuser(event);' src='".site_url('../assets/images/icons/delete.png')."'/></a> <a><img  rel='$row->userid' onclick='updateuser(event);' src='".site_url('../assets/images/icons/edit.png')."'/></a></td>
									  </tr>";
								$i++;
							}
						?>
                        <tr>
                            <td colspan='12' id='pgt'><div style='text-align:center'><ul class='pagination' style='text-align:center'><?php echo $this->pagination->create_links(); ?></ul></div></td>
                        </tr> 
						</body>
					</table>
				</div>
			</div>	
		</div>
	</div>
</div>

	<script type="text/javascript">
		$(document).ready(function(){

			
		})
		function search(event){
			
				var f_name=jQuery('#txts_fname').val();
				var l_name=jQuery('#txts_lname').val();
				var email=jQuery('#txts_email').val();
				var roleid=jQuery('#cbos_role').val();
				var u_name=jQuery('#txts_uname').val();
				var schoolid=jQuery('#txts_school').val();
				var year=jQuery('#txts_year').val();
				//alert('f_name:'+f_name+"l_name"+l_name+"email:"+email+"roleid:"+roleid+"u_name:"+u_name+"schoolid:"+schoolid+"year:"+year);
				$.ajax({
						url:"<?php echo base_url(); ?>index.php/setting/user/search",    
						data: {'f_name':f_name,'l_name':l_name,'email':email,'roleid':roleid,'u_name':u_name,'schoolid':schoolid,'year':year},
						type: "POST",
						success: function(data){
                           //alert(data);
                           jQuery('#listbody').html(data);
                           
						}
				});
		}
		function deleteuser(event){
			var r = confirm("Are you sure to delet this item !");
			if (r == true) {
			    var u_id=jQuery(event.target).attr("rel");
				location.href="<?PHP echo site_url('setting/user/delete');?>/"+u_id;
			} else {
			    txt = "You pressed Cancel!";
			}
			
		}
		function updateuser(event){
				var u_id=jQuery(event.target).attr("rel");
				location.href="<?PHP echo site_url('setting/user/edit');?>/"+u_id;
			
		}
	</script>
	