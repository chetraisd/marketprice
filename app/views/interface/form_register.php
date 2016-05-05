
<style type="text/css">
	html, body
	{
		width: 100%;
		height: 100%;
	}
	body
	{
		width: 100%;
		height: 100%;
		background-color: #f0f0f0;
		background-attachment: fixed;
	}
#navigation_left,.navbar{
	display: none;
}
#page-wrapper{
	margin:0 !important;
	padding:0 !important;
	min-height :100% !important;
}
#main{
	margin:0;
	padding:0;
	background-color: #f0f0f0;
}
#header{
	height:200px;
	position:relative;
	/*width:100%;*/
}
#mainue{
	height:40px;
	border:1px solid #333;
	margin-top:2px;
	background:#095E7A;
	/*width:100%;*/
}
#contain{
	border:0px solid #333;
	/*width:100%;*/
	margin-top:5px;
}
/*#footer{
	height:100px;
	border:1px solid #333;
	margin-top:0px;
}*/

#wrap_right{
	width:93%;
	height:98%;
	border:0px solid #333;
	margin:0px 0 0 15px;
}
#tbl_register {
	white-space: nowrap;
    width: 100%;
    height: 460px; 
    border:1px; 
    border-color:blue;
    overflow-y: scroll;
    margin-bottom: 10px;
}
fieldset {
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
	border: 1px solid black;
	padding-bottom: 15px;
}
#ul_print{
	list-style: none;
}
#ul_print li{
	text-decoration: none;
}
#tbl_register thead th{
	background-color: #5cb85c;
	color: #FFFFFF;
}
#footer{
	position: fixed;
	bottom: 0px;
}
</style>
<div id="main" class="container-fluid">
    	<div class="col-sm-12">
    		<div id="header">
    			
            	<div class="col-sm-5 col-md-5" style="position: absolute;top:10px;right:0;">
                       	<!-- <div class="" style="float:left; margin-right:5px;">
                       		<a href="<?php echo site_url('interface/cinterface')?>" class="alert-link">Home</a>
                       	</div> -->
                       
					    <a class="btn btn-default" href="<?php echo site_url('interface/cinterface')?>" style="float:left; margin-right:5px;">
						    <img alt="Brand" src="<?php echo site_url('assets/images/icons/home(5).png') ?>" width="18" height="18">
							
					    </a>
                        <div class="dropdown" style="float:left; margin-right:5px;">
                              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Administration
                                <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a href="#">Action</a></li>
                              </ul>
                        </div>
                        
                        <div class="input-group">
	                            <input type="text" class="form-control" placeholder="Search ticket number">
	                            <span class="input-group-btn">
	                                <button class="btn btn-default" type="button"><img src="<?php echo base_url("assets/images/icons/search2.png"); ?>" class="img-rounded"></button>
	                            </span>
                        </div>
                </div>
    			<img src="<?php echo base_url("assets/profile/ticking_banner.png"); ?>" width="100%" height="100%">
            </div><!-- div header -->
        </div><!-- div header 12 -->
    	<!--<div class="col-sm-12">
    		<div id="mainue">
    			<MARQUEE><p style="font-size:15px;color:white; margin-top:5px;"><strong>Welcome to Cambodia National Museum(Running Text...)</strong></p></MARQUEE>
    		</div>
        </div>-->
    	<div class="col-sm-12" id="contain">
           	<div class="col-sm-9" style="padding:0;">
           		<div class="table-responsive" id="tbl_register">
           			<table class="table table-bordered">
           				<thead>
	           				<tr>
	           					<th class="col-sm-1">No</th>
	           					<th class="col-sm-2">Name</th>
	           					<th class="col-sm-1">Sex</th>
	           					<th class="col-sm-1">Nationality</th>
	           					<th class="col-sm-1">Remark</th>
	           					<th class="col-sm-1">Park Name</th>
	           					<th class="col-sm-3">Ticket #</th>
	           					<th class="col-sm-1">Visit Period</th>
	           					<th class="col-sm-1" style="text-align:center;">Price</th>
	           					<th class="col-sm-1" style="text-align:center;">&nbsp;</th>
	           				</tr>
	           			</thead>
	           			<tbody id="show_data_register">
	           				
	           			</tbody>
	           			<tfoot></tfoot>
           			</table>
           		</div>
           		<div class="col-sm-12" style="padding-left:10px;">
           			<div class="bg-info col-sm-3" style="float:right;padding:2px 5px; text-align:right; margin-right:5px;">
           				<input type="hidden" id="all_total" class="all_total" value="0">
           				<p><b>Total discount :&nbsp;&nbsp;<span id="show_disc">0</span>&nbsp;&nbsp;<span class="currency_total"></span></b></p>
           				<b>Total Amount :&nbsp;&nbsp;<span id="total_price">0</span>&nbsp;&nbsp;<span class="currency_total"></span></b>
           			</div>
           			<button type="button" class="btn btn-success btn-lg col-sm-5" style="float:right;margin-right:5px;" id="btn_payment">Pay & Print Ticket & Receipt(F1)</button>
       				<button type="button" class="btn btn-warning btn-lg col-sm-3" style="float:right;margin-right:5px;display:none;" id="btn_clear">Clear (Ctr+D)</button>
           		</div>
           	</div>
            <!--  end div col-sm-9 -->
            
            <div class="col-sm-3 col-md-3" style="padding:0;" id="visit_right">
            	<div id="wrap_right">
            		<button type="button" class="btn btn-success btn-lg btn-block" id="buy_ticket">Buy Ticket(Ctr+1)</button>
            		<?php
                    	$sql_curr = $this->db->query("SELECT 
                    										set_currencies.rate,
															set_currencies.symbol,
															set_currencies.reciept_payment,
															set_currencies.cur_default 
													FROM set_currencies
													WHERE reciept_payment=1
													ORDER BY cur_default DESC")->result();
	                    $var_cur = array();
	                    $ii = 0;
	                    if(count($sql_curr) > 0){
	                    	foreach($sql_curr as $row_cur){
	                    		 $var_cur[$ii++]=array($row_cur->rate,$row_cur->symbol,$row_cur->reciept_payment,$row_cur->cur_default);
	                    	}
	                    }
	                    $show_rate = "";
	                    $show_rate_cur = 0;
	                    if(count($var_cur)>0){
	                    	$val_arr    = "";
	                    	$val_symbal = "";
	                    	
	                    	foreach($var_cur as $arr_v){
	                    		if($arr_v[3] == 1){
	                    			$val_arr.= $arr_v[1].$arr_v[0];
	                    			//$val_symbal.= $arr_v[1];
	                    		}else{
	                    			 $show_rate.= '<h4 style="margin:0px;width:100%;float:left;">'.$val_arr.' = '.$arr_v[0].$arr_v[1].'</h4>';
	                    			 $show_rate_cur++;
	                    		}
	                    	}
	                    }
	                    	                    
	                    $ses_user = $this->session->userdata("userid");
	                    $sql_user = $this->db->query("SELECT userid,user_name,last_visit FROM sch_user WHERE userid='".$ses_user."'")->row();
                    	$url = FCPATH."assets/upload/user_profile/".$ses_user."_thumb.png";
                    	if(file_exists($url)){
                    		$url = base_url("assets/upload/user_profile/".$ses_user."_thumb.png");
                    	}else{
                    		$url = base_url("assets/upload/user_profile/No_person.jpg");
                    	}	
                                       
            		
                	if($show_rate_cur > 0){
	                ?> 
                	<!-- <span style="margin-top:5px;margin-bottom: 5px; float:left; width:100%;text-align: center">
						<strong>Exchange Rate:</strong></span>
                    	<span style="margin-top:0px; padding:10px; float:left;border-bottom-color: black;border: solid 0.0em; width:100%; background:#5bc0de;height:50px auto;">
							<span style="margin:0px;width:100%;float:left;color:white;text-align: center"><?php echo $show_rate;?></span>
						</span> -->
					<?php }?>
                    <button type="button" class="btn btn-info btn-lg btn-block" id="buy_ticket" style="float:left;margin-top:10px;">Report (Ctrl+3)</button>
                    
					<hr width="100%" style="float:left;border:1px solid #cccccc; margin:20px 20px 0 0;text-align: center;">
                	<div style="border:0px solid black; width:95%;height:200px; margin:15px 5px; float:left; text-align:center;">
                		<img src="<?php echo $url; ?>"  style="height:196px;" class="img-thumbnail">
                	</div>
					<span style="margin-top:10px; float:left; width:100%; text-align:center;">
						<strong>Logged in as&nbsp;<span style="color: #006dcc"><?php echo strtoupper($sql_user->user_name); ?></span></strong>
					</span>
                	<span style="margin-top:2px; float:left; width:100%; text-align:center;">
						Last Logged &nbsp;<span style="color: #006dcc"><?php echo ($sql_user->last_visit); ?></span>
					</span>
                </div> 
            </div>
        </div>

    	<div id="footer" class="col-sm-12 bg-info" style="padding: 0px !important;">
    		<div class="col-sm-7" style="margin-top:10px;padding: 0px !important;">
    			<span style="font-size:15px; text-align:center;color:red;">
					<b style="color:red;">Notice</b>:&nbsp; Payment is non-refundable. Please re-confirm with buyers before proceeding ticket</span>
    		</div>
    		<div class="col-sm-5" style="padding: 0px !important;">
    			<p class="" style="padding:15px; text-align:right;margin-bottom: 0px"><b>Today :</b><span id="show_time"></span></p>
    		</div>
        </div>
</div>

<!-- <div class="modal" id="inf_contact" tabindex="-1" role="dialog">
	<div class="modal-dialog" id="tragg_inf">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title">Contact Information</h4>
		    </div>
		    <div class="modal-body">
		    	<div class="form-group">
					<label class="control-label">First Name<span style="color:red;">*</span></label>
					<input type="text" name="first_name" id="first_name" class="form-control first_name" placeholder="your firstname">
		    	</div>
		    	<div class="form-group">
		    		<label class="control-label">Last Name<span style="color:red;">*</span></label>
		    		<input type="text" name="last_name" id="last_name" class="form-control last_name" placeholder=" your lastname">
		    	</div>
		    	<div class="from-group">
		    		<label class="control-label">Visitor Type<span style="color:red;">*</span></label>
		    		
		    		<SELECT name="visitor_type" id="visitor_type" class="form-control visitor_type" placeholder="visitor">
		    			<?php echo $opt_visitor;?>
		    		</SELECT>
		    	</div>
		    	<div class="from-group" id="status_company">
		    		<label class="control-label">Company</label>
		    		<input type="text" name="company" id="company" class="form-control company" placeholder="your company">
		    	</div>
		    	<div class="from-group">
		    		<label class="control-label">Email</label>
		    		<input type="text" name="email" id="email" class="form-control email" placeholder="your email">
		    	</div>
		    	<div class="from-group">
		    		<label class="control-label">Address</label>
		    		<input type="text" name="address" id="address" class="form-control address" placeholder="your address">
		    	</div>
		    	<div class="from-group">
		    		<label class="control-label">Phone</label>
		    		<input type="text" name="phone" id="phone" class="form-control phone" placeholder="your phone number">
		    	</div>
		    </div>
		    <div class="modal-footer">
		        <button type="button" id="btn_close" class="btn btn-default" data-dismiss="modal">Cancel</button>
		        <button type="button" id="btn_continue" class="btn btn-primary">Continue</button>
		    </div>
	    </div>
	</div>
</div> -->

<!-- form register -->
<div class="modal bs-example-modal-lg custom-modal" id="inf_register" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" id="tragg_inf">
	    <div class="modal-content modal-lg">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title">Ticket Register</h4>

		    </div>
		    <div class="modal-body">
		    	<div class="row">
		    		<div class="col-sm-12">
		    			<!-- <div class="from-group col-sm-6">
				    		<label class="control-label">First Name<span style="color:red;">*</span></label>
				    		<input type="text" name="firstname" id="firstname" class="form-control firstname" placeholder="first name">
				    		<input type="hidden" name="h_typeno_app" id="h_typeno_app" class="form-control h_typeno_app">
				    		<input type="hidden" name="h_cont_typeno" id="h_cont_typeno" class="form-control h_cont_typeno">
				    		<input type="hidden" name="h_def_currency" id="h_def_currency" value="<?=$def_currency[0] ?>" att_rate_def="<?=$def_currency[1]?>" def_curr_typeno="<?=$def_currency[2]?>" class="form-control h_def_currency">
				    	</div>
				    	<div class="from-group col-sm-6">
				    		<label class="control-label">Last Name<span style="color:red;">*</span></label>
				    		<input type="text" name="lastname" id="lastname" class="form-control lastname" placeholder="last name">
				    	</div> -->
				    	
				    	<div class="from-group col-sm-6">
				    		<label class="control-label">Country<span style="color:red;">*</span></label>
				    		<SELECT name="country" id="country" class="form-control country" placeholder="country">
								<option value=""></option>
				    			<?php echo $opt_countries;?>
				    		</SELECT>
				    	</div>
				    	<div class="from-group col-sm-6">
				    		<label class="control-label">Nationality</label>
				    		<select type="text" name="nationality" id="nationality" class="form-control nationality" placeholder="nationality">
								<option value=""></option>
								<?php echo $opt_countries;?>
				    		</select>
				    	</div>
				    	<!-- <div class="from-group col-sm-6">
				    		<label class="control-label">Age(how old is he/she?)</label>
				    		<input type="text" name="age" id="age" class="form-control age" placeholder="your age">
				    	</div> -->
				    	<div class="from-group col-sm-6">
				    		<label class="control-label">Remark</label>
				    		
				    		<div class="checkbox" style="margin-left:20px;">
								<label><input type="checkbox" id="adult" name="adult" value="">Adult</label>
							</div>
							<div class="checkbox" style="margin-left:20px;">
								<label><input type="checkbox" id="child" name="child" value="">Child</label>
							</div>
				    		<!-- <SELECT name="remark" id="remark" class="form-control remark" placeholder="remark">
								<option value="0"></option>
				    			<option value="1">Adult</option>
				    			<option value="2">Child</option>
				    		</SELECT> -->
				    	</div>
				    	<div class="from-group col-sm-6 hide">
				    		<label class="control-label">Passport No</label>
				    		<input type="text" name="passportno" id="passportno" class="form-control passportno" placeholder="passport no">
				    	</div>
				    	<div class="from-group col-sm-6">
				    		<label class="control-label">Sex</label>
				    		<div class="checkbox" style="margin-left:20px;">
								<label><input type="checkbox" id="male" value="">Male</label>
							</div>
							<div class="checkbox" style="margin-left:20px;">
								<label><input type="checkbox" id="male" value="">Female</label>
							</div>
				    		<!-- <SELECT name="sex" id="sex" class="form-control sex" placeholder="sex">
								<option value=""></option>
				    			<option value="male">Male</option>
				    			<option value="female">Female</option>
				    		</SELECT> -->
				    	</div>

				    	<!-- <div class="from-group col-sm-6">
				    		<label class="control-label">Currency</label>
				    		<SELECT name="currency" id="currency" class="form-control currency" placeholder="currency"><?php echo $opt_currency; ?></SELECT>
				    	</div> -->
					</div> <!-- end div col-sm-9 -->
		    		<div class="from-group col-sm-3"> 
		    			<form id="f_photo" target="ifram" method="POST" action="<?= site_url('interface/cform_register/customer_upload') ?>" enctype="multipart/form-data">
				    		<!-- <div class="col-sm-11" style="">
				    			<img id="uploadPreview" src="<?php echo base_url("assets/images/icons/images.png") ?>" class="img-thumbnail" onclick="$('#uploadImage').click();" style="cursor:pointer;" style="width:50px; height:50px; margin-bottom:15px">
				    		</div>
				    		<div class="col-sm-11">
				    			<input id="uploadImage" accept="image/gif, image/jpeg, image/jpg, image/png" type="file" name="userfile" onchange="PreviewImage();" style="visibility::hidden; display::none; width:0;height:0;" />
								<input type="hidden" name="image_insert" id="image_insert" value="">
								<input type="hidden" name="image_edit" id="image_edit" value="">
				    			<button type="button" class="col-sm-12 btn btn-primary" onclick="$('#uploadImage').click()" style="">Browse</button>
				    			<button type="button" class="col-sm-12 btn btn-danger" style="margin-top:3px;">Webcam</button> 
				    		</div>-->
			    		</form>
			    		<iframe id="ifram" name="ifram" style="display: none;"></iframe>
			    	</div>
		    		<div class="from-group col-sm-12">
				    		<fieldset class="scheduler-border" id="row_ticket">
					    		<legend class="scheduler-border" style="border-bottom:none;width:inherit;padding:0; font-size:16px; margin-bottom:15px;">Ticket Info Required</legend>
					    		<div class="table-responsive">
					    			<table class="table col-sm-12">
					    				<thead>
					    					<tr>
					    						<th style="text-align:center;" class="col-sm-3">Park Name</th>
						    					<th style="text-align:center;" class="col-sm-2">Type</th>
						    					<th style="text-align:center;" class="col-sm-2">Validity Date</th>
						    					<th style="text-align:center;" class="col-sm-2">Expiry Date</th>
						    					<th style="text-align:center;" class="col-sm-2">Price</th>
						    					<th style="text-align:center;" class="col-sm-1"><a href="javascript:void(0)" id="add_row"><img src="<?php echo base_url("assets/images/icons/add.png") ?>"></a></th>
					    					</tr>
					    				</thead>
					    				<tbody id='tbl_tr'></tbody>
					    				<tfoot>
					    					<tr>
					    						<td style="text-align:right;" colspan="4"><b>Total</b></td>
					    						<td style="text-align:right;"><b><span id="total_symbol" style="float:right;"></span><span id="show_total" style="float:right; margin-right:20px;">0</span></b></td>
					    						<td>&nbsp;</td>
					    					</tr>
					    					<tr>
					    						<td style="text-align:right;" colspan="4"><b>Discount</b></td>
					    						<td style="text-align:right;">
					    							<span id="dis_symbal" style="float:right; margin-top:5px;"></span>
					    							<input type="text" name="discount" class="form-control discount" id="discount" value="0" style="text-align:right;width:100px;float:right; margin-right:10px;">
					    						</td>
					    						<td>&nbsp;</td>
					    					</tr>
					    					<tr>
					    						<td style="text-align:right;" colspan="4"><b>Balance</b></td>
					    						<td style="text-align:right;">
					    							<b><span id="balance_symbal" style="float:right;"></span>
					    							<span name="balance" class="balance" id="balance" value="0" style="text-align:right;float:right; margin-right:20px;">0</span></b>
					    						</td>
					    						<td>&nbsp;</td>
					    					</tr>
					    				</tfoot>
					    			</table>
					    		</div>
				    		</fieldset>
					</div>
		    		<!-- <div class="col-sm-12">
				    	<div class="col-sm-12">
				    		<button type="button" class="btn btn-primary btn-lg" style="margin-top:10px;">Welcome</button>
				    		<button type="button" class="btn btn-primary btn-lg" style="margin-top:10px;">Passport..</button>
							<button type="button" class="btn btn-primary btn-lg" style="margin-top:10px;">Save(Enter)</button>
				    	</div>
		    		</div> -->
		    	</div>
		    	<!-- end div row -->
		    </div>
		    <div class="modal-footer">
		        <button type="button" id="btn_close_register" class="btn btn-default" data-dismiss="modal">Cancel</button>
		        <button type="button" class="btn btn-primary hide">Passport</button>
		        <button type="button" id="btn_save_ticket" class="btn btn-primary">Save(Enter)</button>
		    </div>
	    </div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- end form register -->

<div class="modal form_payment" id="form_payment" tabindex="-1" role="dialog">
	<div class="modal-dialog" id="tragg_payment">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title">Billing</h4>
		    </div>
		    <div class="modal-body">
		    	<div class="row">
			    	<div class="col-sm-8">
				    		<label for="nvisitor" class="col-sm-5 control-label" style="margin-top:10px;">#Ticket<span style="color:red;" readonly="readonly">*</span></label>
							<div class="col-sm-7">
								<input type="hidden" name="nvisitor" id="nvisitor" class="form-control nvisitor" placeholder="N.visitor" readonly="readony" style="margin-bottom:10px;">
					    		<input type="text" name="noticket" id="noticket" class="form-control noticket" placeholder="Number ticket" readonly="readony" style="margin-bottom:10px;text-align:right;">
					    	</div>
					    	<label for="total" class="col-sm-5 control-label"style="margin-top:10px;">Total</label>
					    	<div class="col-sm-7">
								<input type="text" name="total" id="total" class="form-control total" readonly="readony" style="margin-bottom:10px;text-align:right;">
					    	</div>
					    	<label for="ticket_disc" class="col-sm-5 control-label"style="margin-top:10px;">Discount</label>
					    	<div class="col-sm-7">
								<input type="text" name="ticket_disc" id="ticket_disc" class="form-control ticket_disc" value="0" readonly="readony" style="margin-bottom:10px; text-align:right;">
					    	</div>

					    	<label for="grand_total" class="col-sm-5 control-label" style="margin-top:10px;">Grand Total</label>
					    	<div class="col-sm-7">	
					    		<input type="text" id="label_gran_total" class="form-control label_gran_total" readonly="readony" style="margin-bottom:10px; text-align:right;">
					    		<input type="hidden" id="grand_total" class="grand_total" placeholder="grand total">
					    	</div>

					    	<!-- <label for="discount" class="col-sm-5"  style="margin-top:10px;">Discount<span style="color:red;">*</span></label>
							<div class="col-sm-7">
				    			<input type="text" name="discount" id="discount" class="form-control discount" placeholder="discount" style="margin-bottom:10px; text-align:right;">
					    	</div> -->

					    	<label for="payment_mode" class="col-sm-5 control-label" style="margin-top:10px;">Payment Mode</label>
					    	<div class="col-sm-7">	
					    		<select name="payment_mode" id="payment_mode" class="form-control payment_mode" placeholder="payment mode" style="margin-bottom:10px;">
				    			<?php echo $opt_payment_mode; ?>
				    			</select>
					    	</div>

					    	<label for="currency" class="col-sm-5 control-label" style="margin-top:10px;">Currency</label>
					    	<div class="col-sm-7">	
					    		<SELECT name="currency" id="currency" class="form-control currency" placeholder="currency" style="margin-bottom:10px;">
				    			<?php echo $opt_currency; ?>
				    			</SELECT>
					    	</div>

							<label for="rate" class="col-sm-5 control-label" style="margin:0px;">Rate</label>
							<div class="col-sm-7" style="margin-bottom:0px;">
								<b><span id="rate_show" class="col-sm-12 control-label rate_show" style="margin-bottom:10px;text-align:right;">&nbsp;</span></b>
								<input type="hidden" id="rate" class="rate">
								<input type="hidden" id="cur_typeno" class="cur_typeno">
								<input type="hidden" id="symbol_curr" class="symbol_curr">
					    	</div>

					    	<label for="cash_receive" class="col-sm-5 control-label" style="margin-top:5px;">Cash Receive</label>
							<div class="col-sm-7">
								<input type="text" name="cash_receive" id="cash_receive" class="form-control cash_receive" placeholder="cash receive" style="margin-bottom:10px; text-align:right;">
					    	</div>

					    	<label for="change" class="col-sm-5 control-label" style="margin-top:0px;">Change</label>
					    	<div class="col-sm-7">
				    			<b><span id="change" class="col-sm-12 change" style="margin-bottom:10px; text-align:right;">0</span></b>
				    			<b><span id="other_change" class="col-sm-12 other_change" style="margin-bottom:10px; text-align:right;">0</span></b>
					    	</div>
				    		
			    	</div> <!-- end col-sm-6 -->
			    	<div class="col-sm-4">
			    		<!-- <button type="button" id="btn_payment_mode" class="btn btn-default" data-dismiss="modal">Close</button> -->
			        	<button type="button" id="btn_payment_mode" class="btn btn-primary btn-lg btn-block">Print(Enter)</button>
			        	<button type="button" id="btn_close_payment" class="btn btn-danger btn-lg btn-block" data-dismiss="modal">Exit(ESC)</button>
			    	</div>
		    	</div>
		    </div><!-- end modal-body -->

		    <!-- <div class="modal-footer">
		     
		    </div> -->
	    </div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal list_print" id="list_print" tabindex="-1" role="dialog">
	<div class="modal-dialog" id="tragg_list_print">
	    <div class="modal-content">
		    <div class="modal-header">
		        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
		        <h4 class="modal-title">Do you want to continue?</h4>
		    </div>
		    <div class="modal-body">
		    	<div class="row">
			    	<div class="col-sm-8"> 
			    		<center>
				    	<button type="button" id="btn_close_home" class="btn btn-default" data-dismiss="modal">Home</button>
			        	<button type="button" id="btn_buy_more" class="btn btn-danger" data-dismiss="modal">Buy more ticket</button>
				    	</center>
			    	</div> <!-- end col-sm-6 -->
		    	</div>
		    	<!-- <div class="modal-footer">
		    		
		    	</div> -->
		    </div>
		    <!-- end modal-body -->
	    </div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal --> 
<script type="text/javascript">
	$(document).keydown(function(evt){
		var cash_receive=$("#cash_receive").val();
		if (evt.keyCode==13 && cash_receive==""){
			evt.preventDefault();
			$("#btn_save_ticket").click();
		}
		if (evt.keyCode==13 && cash_receive !=""){
			evt.preventDefault();
			$("#btn_payment_mode").click();
		}
		if (evt.keyCode==49 && (evt.ctrlKey)){
			evt.preventDefault();
			$("#buy_ticket").click();
		}
		if (evt.keyCode==68 && (evt.ctrlKey)){
			evt.preventDefault();
			$("#btn_clear").click();
		}
		if (evt.keyCode==112){
			evt.preventDefault();
			$("#btn_payment").click();
		}
	});
$(function(){
		startTime();
		fn_tbl_tr();
		var park_typeno_url = <?php echo isset($_REQUEST['park_typeno'])?$_REQUEST['park_typeno']:0;?>;
		if(park_typeno_url != ""){
			$("#park_name").val(park_typeno_url);
			$.ajax({
				type:"POST",
				url :"<?= site_url('interface/cform_register/fn_datetype') ?>",
				dataType:"JSON",
				data:{
					Para_date_type:1,
					park_typeno   : park_typeno_url	
				},
				success:function(data){
					$("#date_type").html(data.opt_date_type);
					//$("#date_type option:first").next().attr("selected",true);
					var price = $("#date_type option:selected").attr("att_price");
					$("#price").val(price);
					fn_total();
				}
			});
		}
		$("body").delegate('#adult',"click",function(){
			if($(this).is(":checked")){
				$(this).popup("checked",true);
			}else{
				$(this).popup("checked",false);
			}
		})
		$("body").delegate("#country","change",function(){
			var count_val = $(this).val();
			$("#nationality").val(count_val);
		})

		$("body").delegate("#park_name","change",function(){
			var tr = $(this).parent().parent();
			var park_typeno = $(this).val();
			$.ajax({
				type:"POST",
				url :"<?= site_url('interface/cform_register/fn_datetype') ?>",
				dataType:"JSON",
				data:{
					Para_date_type:1,
					park_typeno   : park_typeno
				},
				success:function(data){
					tr.find("#date_type").html(data.opt_date_type);
					var price = tr.find("#date_type option:selected").attr("att_price");
					tr.find("#price").val(price);
					fn_total();
				}
			})
			
			var tr_null = 0;
			$(".park_name").each(function(){
				var val_this = $(this).val();
				if(val_this == ""){
					tr_null++;
				}
			});
			if(tr_null == 0){
				fn_tbl_tr();
			}					
		});

		
		$("body").delegate("#age","keyup",function(){
			var val_age = $(this).val()-0;
			if(val_age == 0){
				$("#remark").val(0);
			}else if(val_age < 13 && val_age > 0){
				$("#remark").val(2);
			}else{
				$("#remark").val(1);
			}
			
		})
		$("body").delegate("#add_row","click",function(){
			fn_tbl_tr();
		});
		$("body").delegate("#delete_row","click",function(){
			var size_tr = $("#tbl_tr tr").size()-0;
			if(size_tr == 1){
				return false;
			}else{
				var alert_conf = confirm("Do you want to delete this row ?");
				if(alert_conf== true){
					$(this).parent().parent().remove();
				}
			}

		});


		// var get_contact = <?= isset($_REQUEST['pa_contact']) == 1?$_REQUEST['pa_contact']:0 ?>;
		// if(get_contact == 1){
		// 	fn_show_contack();
		// }
		$("body").delegate("#price,#age,#cash_receive","keydown", function (e) {
           // alert(e.keyCode);
            if ((e.keyCode >= 96 && e.keyCode <= 105) || (e.keyCode >= 48 && e.keyCode <= 57) || e.keyCode == 8 || e.keyCode == 190 || e.keyCode == 110) {
                $(this).removeAttr("readonly");
            } else {
                $(this).attr("readonly", "readonly");
            }
        });   
		
		$("body").delegate("#date_type","change",function(){
			var tr    = $(this).parent().parent();
			var price = $(this).find("option:selected").attr("att_price");
			tr.find("#price").val(price);
			fn_total();
			//$("#show_total").html(fn_total());
			
		})
		$('#status_company').hide();
		$("body").delegate('#btn_close','click',function(){
			if(get_contact == 1){
				window.location.href = "<?= site_url('interface/cinterface') ?>";
			}
			fn_clear_contact();
		});
		$("body").delegate("#visitor_type","change",function(){
			var agency = $(this).val();
			if(agency == 2){
				$('#status_company').show();
			}else{
				$('#status_company').hide();
			}
		});
		$("body").delegate("#buy_ticket","click",function(){
			fn_clear_register();
			fn_show_register();

		});
		$("body").delegate("#btn_save_ticket","click",function(){
			if($("#firstname").val() == ""){
				alert("Please input firstname first.");
				$("#firstname").focus();
			}else if($("#lastname").val() == ""){
				alert("Please input lastname first.");
				$("#lastname").focus();
			}else if($("#country").val() == ""){
				alert("Please choose country first.");
				$("#country").focus();
			}else{
				var bb = 0;
				var tt = 0;
				$(".park_name").each(function(){
					var val_p = $(this).val();
					var val_t = $(this).parent().parent().find("#date_type").val()
					if(val_p != ""){
						bb++;
					}
					if(val_t != ""){
						tt++;
					}
				})
				if(bb == 0){
					alert("Please choose park name first.");
					$(".park_name").focus();
				}else if(tt == 0){
					alert("Please choose type day first.");
					$(".date_type").focus();
				}else{
					var h_typeno_app = $("#h_typeno_app").val();
					fn_save_register();
					$('#inf_register').modal('hide');
					
				}
			}
		})
		$("body").delegate("#price,#discount","keyup",function(){
			//$("#show_total").html(fn_total());
			fn_total();
		})

		$("body").delegate("#btn_continue","click",function(){
			if($("#first_name").val() == ""){
				//$("#first_name").closest('.form-group').removeClass('has-success').addClass('has-error');
				alert("Please input your first name.");
				$("#first_name").focus();
			}else if($("#last_name").val() == ""){
				alert("Please input your last name.");
				$("#last_name").focus();
			}else{
				//fn_save_contact();
				fn_clear_contact();
				//$('#inf_contact').modal('hide');
				fn_show_register();

				/*var conf = confirm("Do you want to continue?");
				if(conf == true){

				}*/
				return false;
			}
			
		});
		
		$("body").delegate("#row_delete","click",function(){
			var typeno_ticket = $(this).parent().parent().find("#typeno_ticket").val();
			var conf = confirm("Do you want to delete ?");
			if(conf == true){
				var app_tr = $(this).parent().parent().find("#tran_app_typeno").val();
				var total_app_tr = 0;
				$(".count_"+app_tr).each(function(){
					total_app_tr++;
				});
				$.ajax({
					type : "POST",
					url  : "<?= site_url('interface/cform_register/fn_delet_ticket') ?>",
					dataType:"JSON",
					data:{
						para_delete_ticket : 1,
						typeno_ticket: typeno_ticket,
						total_app_tr : total_app_tr,
						typeno_app   : app_tr
					},
					success:function(data){
						//$(this).parent().parent().remove();
					}
				});
				$(this).parent().parent().remove();
				$(".row_index").each(function(e){
					$(this).html((e+1)-0);
				});
				
			}
		});

		$("body").delegate("#cash_receive","keyup",function(){
			var grand_total = $("#grand_total").val()-0;
			var cash_rec    = $(this).val()-0;
			var total       = (grand_total-cash_rec)-0;
			$("#change").val(total);
		})

		$("body").delegate("#edite_all","click",function(){
			var typeno_app = $(this).attr("typeno_app");
			$("#h_typeno_app").val(typeno_app); // for check save and edit
			$.ajax({
					type:"POST",
					url:"<?= site_url('interface/cform_register/edit_ticket') ?>",
					dataType:"JSON",
					data:{
						para_app   : 1,
						typeno_app : typeno_app
					},
					success:function(data){
						//fn_clear_register();
						$("#tbl_tr tr").remove(); 
						$("#firstname").val(data['tran_app'][0]['customer_firstname']);
						$("#lastname").val(data['tran_app'][0]['customer_lastname']);
						$("#sex").val(data['tran_app'][0]['gender']);
						$("#nationality").val(data['tran_app'][0]['nationality']);
						$("#country").val(data['tran_app'][0]['country']);
						$("#remark").val(data['tran_app'][0]['remark']);
						$("#passportno").val(data['tran_app'][0]['passportno']);
						$("#age").val(data['tran_app'][0]['age']);
						
						$("#show_total").html(data['tran_app'][0]['total_amount']);
						$("#discount").val(data['tran_app'][0]['discount_amount']);
						$("#image_edit").val(data['tran_app'][0]['photo']);
						$("#uploadPreview").attr("src",data.img+'?' + new Date().getTime());
						$("#tbl_tr").append(data.tran_ticket);
						//$('#img_park').attr({src: '<?= base_url("assets/upload/'+ (data.image != '' ? data.image : 'images.png') + '?' + new Date().getTime() +'") ?>'});
						
						fn_show_register();
						//$("#show_total").html(fn_total());
						fn_total();
						//var symbol = $("#currency").find("option:selected").attr("att_symbol");
						//$("#total_symbol").html(symbol);
						$("#validity_date,#expiry_date").datepicker({
								language: 'en',
					      		pick12HourFormat: true,
					         	format: 'dd/mm/yyyy',
					         	autoclose:true
						});
					}
			})
		});
		$("body").delegate("#currency","change",function(){
			var rate          = $("#currency").find("option:selected").attr("att_rate");
			var change_symbol = $("#currency").find("option:selected").attr("att_symbol");
			var cur_def       = $("#currency").find("option:selected").attr("cur_def");
			var cur_typeno    = $("#currency").val();
			var grand_total   = $("#grand_total").val();
			var curr_for_chang= $("#h_def_currency").val();
			$("#rate_show").html(change_symbol+"&nbsp;"+rate);
			$("#rate").val(rate);
			$("#symbol_curr").val(cur_typeno);
			$("#cash_receive").val(grand_total*rate);
			//var total_change = (cash_receive - (grand_total*rate))-0;
			//$("#change").html("$&nbsp;"+grand_total);
			$("#change").html(curr_for_chang+"&nbsp;0");
			$("#other_change").html(change_symbol+"&nbsp;0");
			if(cur_def == 1){
				$("#other_change").hide();
			}else{
				$("#other_change").show();
			}
			// fn_calculate();
		});
		var cur_def_first = $("#currency").find("option:selected").attr("cur_def");
		if(cur_def_first == 1){
			$("#other_change").hide();
		}else{
			$("#other_change").show();
		}
		$("body").delegate("#cash_receive","keyup",function(){
			fn_calculate();
		})
		$("body").delegate("#btn_payment_mode","click",function(){
			// $('#form_payment').modal('hide');
			// var show_li = "";
			// var j = 1;
			// $.each(show_arr_list(),function(k,v){
			// 	show_li+="<li style='text-align:left;'>"+j+".&nbsp;<a href='<?php echo site_url('report/c_report_payment'); ?>?app_typeno="+v['tran_app_typeno']+"&count="+v['count']+"' target='_blank'><b>"+v['custname']+"</b></a></li>";
			// 	j++;
			// })
			// $("#ul_print").html(show_li); 
			// fn_show_print();

			// //console.log(show_arr_list());


			var rate = $("#currency").find("option:selected").attr("att_rate")-0;
			var amt_payment_type = ($("#grand_total").val()*rate);
			var arr_master_recipt = {
									cont_typeno : $("#nvisitor").val(),
									grand_total : $("#grand_total").val(),
									payment_mode: $("#payment_mode").val(),
									currency    : $("#currency").val(),
									rate        : rate,
									cash_receive: amt_payment_type
									}
			var arr_detail_rec = [];
			$(".typeno_ticket").each(function(e){
				var tr = $(this).parent().parent();
				var typeno_ticket   = tr.find("#typeno_ticket").val();
				var tic_type_typeno = tr.find("#tic_type_typeno").val();
				var tran_app_typeno = tr.find("#tran_app_typeno").val();
				var price           = tr.find("#h_price").val();
				var park_typeno     = tr.find("#tran_park_typeno").val();
				arr_detail_rec[e] = {"typeno_ticket":typeno_ticket,
									 "tic_type_typeno":tic_type_typeno,
									 "tran_app_typeno":tran_app_typeno,
									 "price": price,"park_typeno":park_typeno
									}
			})
			// var conf = confirm("Do you want payment ?");
			// if(conf == true){
				$.ajax({
					type:"POST",
					url:"<?= site_url('interface/cform_register/fn_save_payment') ?>",
					dataType:"JSON",
					data:{
						para_payment : 1,
						arr_master_recipt : arr_master_recipt,
						arr_detail_rec : arr_detail_rec
					},
					success:function(data){
						//window.location.href="";
						window.open("<?= site_url('report/c_report_payment') ?>?typeno_inv="+data.inv_typeno,"_blank");
					}
				});
				fn_update_status();
				$("#form_payment").modal('hide');
				fn_show_print();
				
			// }else{
			// 	return false;
			// }
			
		});
		$("body").delegate("#btn_close_home","click",function(){
			window.location.href="<?= site_url('interface/cinterface') ?>";
		})
		$("body").delegate("#btn_buy_more","click",function(){
			//$("#form_payment").modal('hide');
			$("#show_data_register").html("");
			$("#show_disc").html("");
			$("#total_price").html("");
		})
		$("#show_data_register").html("");
		$("body").delegate("#btn_payment","click",function(){
			if($("#show_data_register").html() == ""){
				alert("Please buy ticket first");
				return false;
			}else{
				fn_clear_bilding();
				var typeno_cont      = $("#h_cont_typeno").val();
				var all_total       = $("#all_total").val();
				var discount         = $("#show_disc").html();
				var grand_total_show = $("#total_price").html()-0;
				var symbol           = $("#currency").find("option:selected").attr("att_symbol");
				var rate_def         = $("#h_def_currency").attr("att_rate_def");
				$("#nvisitor").val(typeno_cont);
				$("#label_gran_total").val(symbol+" "+grand_total_show);
				$("#total").val(symbol+" "+all_total);
				$("#ticket_disc").val(symbol+" "+discount);
				$("#rate_show").html(symbol+"&nbsp;"+rate_def);
				$("#grand_total").val(grand_total_show);
				$("#cash_receive").val(grand_total_show);
				fn_show_payment();
			}
			

			//console.log(show_arr_list());
		});
});
<<<<<<< HEAD
function show_arr_list(){
	var arr_typeno =[];
	var arr_check = [];
	$(".tran_app_typeno").each(function(e){
		var tr = $(this).parent().parent();
		var custname = tr.find("#customername").val();
		var tran_app_typeno = $(this).val();
		arr_check[e] = tran_app_typeno;
		if($.inArray(arr_check,tran_app_typeno) == -1){
			arr_typeno[e] = {'tran_app_typeno':tran_app_typeno,'custname':custname};
		}
				
	});
	return arr_typeno;
}
=======

// function show_arr_list(){
// 	var arr_typeno =[];
// 	var ii=0;
// 	var arr1 = [];
// 	$(".tran_app_typeno").each(function(e){
// 		var tr = $(this).parent().parent();
// 		var custname = tr.find("#customername").val();
// 		var tran_app_typeno = $(this).val();
// 		if($.inArray(tran_app_typeno , arr1) ==-1){
// 			var count = 0;
// 			$(".count_"+tran_app_typeno).each(function(){
// 				count++;
// 			});
// 			arr_typeno[ii] = {'tran_app_typeno':tran_app_typeno,'custname':custname,'count':count};
// 			arr1[ii] = tran_app_typeno
// 			ii++;
// 		}

// 	});	
// 	return arr_typeno;
// }
>>>>>>> 2cf166060cd5885854049f9c0f2c0f147fb74c47
function reload_img() {
  $("#f_photo").submit();
}
function fn_calculate(){
	var rate          = $("#currency").find("option:selected").attr("att_rate");
	var change_symbol = $("#currency").find("option:selected").attr("att_symbol");
	var symbol 		  = $("#currency").find("option:selected").attr("att_symbol");
	var h_def_currency = $("#h_def_currency").val();
	var rate_def      = $("#h_def_currency").attr("att_rate_def")-0;
	var grand_total   = $("#grand_total").val()-0;
	var cash_receive  = $("#cash_receive").val()-0;
	var total_change  = (cash_receive - (grand_total*rate))-0;
	var total_usd     = ((cash_receive/rate) - grand_total)-0;
	var show_usd      = number_format(total_usd,4);
	$("#change").html(h_def_currency+"&nbsp;"+show_usd);
	$("#other_change").html(symbol+"&nbsp;"+total_change);
}
function fn_tbl_tr(){
	var def_currency = $("#h_def_currency").val();
	var tr ='<tr class="new_row">'+
			    '<td><SELECT name="park_name" id="park_name" class="form-control park_name" placeholder="park name"><?php echo $opt_parkname; ?></SELECT></td>'+
			    '<td><SELECT name="date_type" id="date_type" class="form-control date_type" placeholder="type"></SELECT></td>'+
				'<td><input type="text" name="validity_date" id="validity_date" class="form-control validity_date" placeholder="validity date" value="<?= date('d/m/Y')?>"></td>'+
				'<td><input type="text" name="expiry_date" id="expiry_date" class="form-control expiry_date" placeholder="expiry date" value="<?= date('d/m/Y') ?>"></td>'+
				'<td><span style="float:right;margin:10px 0 0 10px;" id="show_symbol" class="show_symbol">'+def_currency+'</span><input type="text" name="price" id="price" class="form-control price" placeholder="price" style="text-align:right; width:100px; float:right;"></td>'+
				'<td style="text-align:center; vertical-align: middle;"><a href="javascript:void(0)" id="delete_row"><img src="<?php echo site_url("assets/images/icons/delete.png"); ?>"></a></td>'+
			'</tr>';
	$("#tbl_tr").append(tr);
	$("#validity_date,#expiry_date").datepicker({
			language: 'en',
      		pick12HourFormat: true,
         	format: 'dd/mm/yyyy',
         	autoclose:true
	});
}

function fn_save_register(){
	this.name = "kkk";
	var arr_tran_app = {
		firstname  : $("#firstname").val(),
		lastname   : $("#lastname").val(),
		sex        : $("#sex").val(),
		nationality: $("#nationality").val(),
		country    : $("#country").val(),
		remark     : $("#remark").val(),
		passportno : $("#passportno").val(),
		age        : $("#age").val(),
		h_typeno_app  : $("#h_typeno_app").val(),
		cont_typeno : $("#h_cont_typeno").val(),
		//show_total : $("#show_total").html(),
		show_total : $("#balance").html(),
		discount   : $("#discount").val()
		//currency_code : $("#currency").val(),
		//rate  :  $("#currency").find("option:selected").attr("att_rate")
	}
	var arr_ticket = [];
	var ii = 1;
	$(".park_name").each(function(e){
		var tr = $(this).parent().parent();
		var check_val = $(this).val();
		var qty_days  = tr.find("#date_type option:selected").attr("qty_day");
		if(check_val != ""){
			arr_ticket[e] = {
								park_name : $(this).val(),
								date_type : tr.find("#date_type").val(),
								validity_date : tr.find("#validity_date").val(),
								expiry_date   : tr.find("#expiry_date").val(),
								price     : tr.find("#price").val(),
								qty_days :  qty_days
							}
		}
		
	});
	var curr_total = $("#h_def_currency").val();
	$.ajax({
		type : "POST",
		url  : "<?= site_url('interface/cform_register/fn_save_ticket') ?>",
		dataType:"JSON",
		data:{
			para_ticket : 1,
			arr_tran_app: arr_tran_app,
			arr_ticket  : arr_ticket
		},
		success:function(data){
			$("#show_data_register").html(data.tr_register);
			//$("#edite_all").attr("typeno_app",data.typeno_app);
			$("#show_disc").html(data.total_dis);
			$("#total_price").html(data.total_amt);
			$("#all_total").val(data.all_total);
			//$("#total_price").html(fn_total_all_price());
			$(".currency_total").html(curr_total);
			$("#image_insert").val(data.typeno_app);
			$("#noticket").val(data.count_app);
			reload_img();
		}
	});
	$(".row_index").each(function(e){
		$(this).html((e+1)-0);
	});
	
}

function fn_total(){
	var total = 0;
	$(".price").each(function(){
		var this_price = $(this).val()-0;
		total+=this_price;
	})
	$("#show_total").html(number_format(total,4));
	var balance = (total-$("#discount").val())-0;
	$("#balance").html(number_format(balance,4));
	//return total;
}
function fn_total_all_price(){
	var total_all_price = 0;
	$(".h_price").each(function(){
		var val_price = $(this).val()-0;
		total_all_price+=val_price;
	});
	return total_all_price;
}
function fn_aut_ticketnumber(){
	$.ajax({
		type:"POST",
		url:"<?= site_url('interface/cform_register/fn_aut_ticketnumber') ?>",
		dataType:"JSON",
		data:{
			para_ticket : 1,
			park_id     : $("#park_name").val()
		},
		success:function(data){

		}
	})
}
function fn_update_status(){
	var arr_status = [];
	$(".typeno_ticket").each(function(e){
		var typeno_ticket = $(this).val();
		arr_status[e] = typeno_ticket;
	});
	$.ajax({
		type:"POST",
		url:"<?= site_url('interface/cform_register/fn_update_stats') ?>",
		dataType:"JSON",
		data:{
			para_status : 1,
			arr_status  : arr_status
		},
		success:function(data){
			if(data.ok == 1){
				//window.location.href="<?= site_url('interface/cinterface') ?>";
			}
			
		}
	});
}

// function fn_show_contack(){
// 	$("#inf_contact").modal({
// 			backdrop:'static'
// 	});
// 	$("#tragg_inf").draggable({
//         handle: ".modal-header"
//     });
// }
function fn_show_print(){
	$("#list_print").modal({
			backdrop:'static'
	});
	$("#tragg_list_print").draggable({
        handle: ".modal-header"
    });
}
function fn_show_register(){
	var h_def_currency = $("#h_def_currency").val();
	$("#inf_register").modal({
		backdrop:'static'
	});
	$("#tragg_inf").draggable({
        handle: ".modal-header"
    });
    $("#total_symbol").html(h_def_currency);
    $("#dis_symbal").html(h_def_currency);
    $("#balance_symbal").html(h_def_currency);
}
function fn_show_payment(){
	$("#form_payment").modal({
		backdrop:'static'
	});
	$("#tragg_payment").draggable({
        handle: ".modal-header"
    });
}
// function fn_save_contact(){
// 	var arr_contact = {
// 					"first_name":$("#first_name").val(),
// 					"last_name":$("#last_name").val(),
// 					"visitor_type":$("#visitor_type").val(),
// 					"company":$("#company").val(),
// 					"email":$("#email").val(),
// 					"address":$("#address").val(),
// 					"phone":$("#phone").val()
// 					};
// 	$.ajax({
// 		type:"POST",
// 		url:"<?= site_url('interface/cform_register/csave') ?>",
// 		dataType:"JSON",
// 		data:{
// 			para_save   : 1,
// 			arr_contact : arr_contact
// 		},
// 		success:function(data){
// 			$("#h_cont_typeno").val(data);
// 		}
// 	});
// 	$("#firstname").val(arr_contact.first_name);
// 	$("#lastname").val(arr_contact.last_name);
// }
function fn_clear_contact(){
	$("#first_name").val("");
	$("#last_name").val("");
	$("#visitor_type").val(1);
	$("#company").val("");
	$("#email").val("");
	$("#address").val("");
	$("#phone").val("");
}
function fn_clear_register(){
	$("#firstname").val("");
	$("#lastname").val("");
	$("#nationality").val("");
	$("#country").val(1);
	$("#remark").val("");
	$("#passportno").val("");
	$("#age").val("");
	$("#h_typeno_app").val("");
	$("#discount").val("");
	$("#sex").val("male");
	$("#uploadPreview").attr("src",'<?=base_url("assets/images/icons/images.png")?>');
	$("#image_insert").val("");
	$("#image_edit").val("");
	$("#uploadImage").val("");
	$("#tbl_tr").html("");
	fn_tbl_tr();
	$("#show_total").html(0);
	$("#balance").html(0);
	//$("#total_symbol").html("");
	
}

function fn_clear_bilding(){
	var curr_typeno = $("#h_def_currency").attr("def_curr_typeno")
	var symbol_def  = $("#h_def_currency").val();
	$("#nvisitor").val("");
	$("#label_gran_total").val("");
	$("#grand_total").val("");
	//$("#payment_mode").val();
	$("#currency").val(curr_typeno);
	$("#rate_show").html("");
	$("#cash_receive").html("");
	$("#change").html(symbol_def+"&nbsp;0");
	$("#other_change").html("");
}

function PreviewImage() {
	var oFReader = new FileReader();
	oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

	oFReader.onload = function (oFREvent) {
		document.getElementById("uploadPreview").src = oFREvent.target.result;
		document.getElementById("uploadPreview").style.backgroundImage = "none";
	};
};	
function checkTime(i) {
			if (i < 10) {
				i = "0" + i;
			}
    	return i;
	}
function startTime() {
	var today = new Date();
	var day   = today.getDay();
	var month = today.getMonth();
	var daym  = today.getDate();
	var years = today.getFullYear();
	var h = today.getHours();
	var m = today.getMinutes();
	var s = today.getSeconds();
	var weekdays = new Array(7);
	weekdays[0] = "Sunday";
	weekdays[1] = "Monday";
	weekdays[2] = "Tuesday";
	weekdays[3] = "Wednesday";
	weekdays[4] = "Thursday";
	weekdays[5] = "Friday";
	weekdays[6] = "Saturday";
	var months = new Array(12);
	months[0] = "January";
	months[1] = "February";
	months[2] = "March";
	months[3] = "April";
	months[4] = "May";
	months[5] = "June";
	months[6] = "July";
	months[7] = "August";
	months[8] = "September";
	months[9] = "October";
	months[10] = "November";
	months[11] = "December";
	// add a zero in front of numbers<10
	m = checkTime(m);
	s = checkTime(s);
	var ampm = "";
	if(h > 12){
		ampm = "PM";
		h=(h-12)-0;
	}else{
		ampm = "AM";
	}
	//document.getElementById('time').innerHTML = h + ":" + m + ":" + s;
	$("#show_time").html(weekdays[day]+" "+daym+" "+months[month]+" "+years+",&nbsp;"+h + ":" + m + ":" + s+"&nbsp;"+ampm);
	
	t = setTimeout(function () {
		startTime()
	}, 500);
	
}
</script>
