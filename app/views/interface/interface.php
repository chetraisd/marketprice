
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
	height:90px;
	position:relative;
	/*width:100%;*/
}
#mainue{
	height:40px;
	margin-top:1px;
	background:#548525;
	/*width:100%;*/
}
#contain{
	border:0px solid #333;
	/*width:100%;*/
	margin-top:1px;
	height: 100%;
}
/*#footer{
	height:100px;
	border:1px solid #333;
	margin-top:0px;
}*/
#visit_left,#visit_center{
	border:0px solid blue;
	margin:0;
	padding:0;
}

.park_left{
	border:0px solid #333;
	/*background:#D9DAF4;*/
	position: relative;
	width:100px;
	height:100px;
	float:left;
	text-align:center;
	padding-top:0px;
	font-size:16px;
	background-size: 100px 100px;
	border-radius: 0px;
	box-shadow: 3px 3px 1px lightgray;
	margin-top: 20px;

}

#left_title{
	height:30px;
	width:100%;
	float:left;
	margin:0;
	padding:0;
	text-align:center;
	background-color:: #fae1d4;
	background-color: #294580;
}
#center_title{
	height:30px;
	width:100%;
	float:left;
	margin:0;
	padding:0;
	text-align:center;
	border-bottom:0px solid #333;
	background-color:: #9ccb82;
	background-color: #4769A4;
}
#wrap_left,#wrap_center{
	overflow-y:: auto;
	padding: 0;
	margin:0;
	border:0px solid black;
}
#wrap_center{
	height:100%;
}
#wrap_left{
	overflow-y: auto;
	border-right: 0px solid #e5e1df;
	width:100%;
	height:100%;
}
#tbl_resp{
	overflow-y: auto;
	height: 100%;
	font-size: 10px;
	border: 0px solid red;
}

#park_desc{
	bottom: -8px;
	color: #fff2f2;
	float: left;
	position: absolute;
	left: 10px;
	text-align: left;
	text-shadow: -1px 2px 2px #000103;
}

.choosen_list{
	color:: #00099B;
	color: #FFFFFF;
	margin-top:5px; 
	text-align:left;
	font-weight: bold;
	padding-left: 20px;
	float:left;
}
.dv_most_visited{
	/*background-color: #87818b;*/
	bottom: 0;
	position: relative;
	right: 5px;
	top: 172px;
}
#footer{
	position: fixed;
	bottom: 0px;

	/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#356aa0+0,9a9c9e+0,356aa0+37 */
	background: rgb(53,106,160); /* Old browsers */
	background: -moz-linear-gradient(top,  rgba(53,106,160,1) 0%, rgba(154,156,158,1) 0%, rgba(53,106,160,1) 37%); /* FF3.6-15 */
	background: -webkit-linear-gradient(top,  rgba(53,106,160,1) 0%,rgba(154,156,158,1) 0%,rgba(53,106,160,1) 37%); /* Chrome10-25,Safari5.1-6 */
	background: linear-gradient(to bottom,  rgba(53,106,160,1) 0%,rgba(154,156,158,1) 0%,rgba(53,106,160,1) 37%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#356aa0', endColorstr='#356aa0',GradientType=0 ); /* IE6-9 */

}

#diplay_footer{
	/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#f9fcf7+0,f9fcf7+0,bcbcbc+100,f5f9f0+100 */
	background: rgb(249,252,247); /* Old browsers */
	background: -moz-linear-gradient(top, rgba(249,252,247,1) 0%, rgba(249,252,247,1) 0%, rgba(188,188,188,1) 100%, rgba(245,249,240,1) 100%); /* FF3.6-15 */
	background: -webkit-linear-gradient(top, rgba(249,252,247,1) 0%,rgba(249,252,247,1) 0%,rgba(188,188,188,1) 100%,rgba(245,249,240,1) 100%); /* Chrome10-25,Safari5.1-6 */
	background: linear-gradient(to bottom, rgba(249,252,247,1) 0%,rgba(249,252,247,1) 0%,rgba(188,188,188,1) 100%,rgba(245,249,240,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f9fcf7', endColorstr='#f5f9f0',GradientType=0 ); /* IE6-9 */
}

#visit_left,#visit_center{
    height: 506px !important;
}

.no-wrap{
    white-space: nowrap;
}
#tbl_resp{
    height: 88% !important;
}
@media screen and (min-height:700px){
    #tbl_resp{
        height: 100% !important;
    }
	#visit_left,#visit_center{
	    height: 558px !important;
	}
	#visit_left{
	    height: 616px !important;
	}
}
#div_wrap{
	position: relative;
	width:603px;
	height:288px;
	top:150px;
	display: none;
	border:0px solid red;
}
#div_show_num{
	float:left;
	text-align: center;
	width:100%;
	height:50px;
	border:0px solid black;
}
#key_number{
	position: absolute;
	border:1px solid rgb(0, 51, 102);
	background: #cce6ff;
	width:100%;
	height:100%;
	z-index: 1;
}
#key_number ul{
	list-style: none;
	width:100%;
	height:100%;
	float:left;
	margin:0px;
	padding:5px 20px;

}

#key_number ul li{
	float:left;
	width:110px;
	height:70px;
	border-radius:5px;
	background:rgb(0, 51, 102);
	color:white;
	text-align: center;
	padding:25px;
	margin:1px;
	cursor:pointer;
	font-size: 14px;
}

#key_number ul li:last-child{
	float:left;
	width:223px;
	height:70px;
	border-radius:5px;
	background:rgb(0, 51, 102);
	color:white;
	text-align: center;
	padding:30px;
	margin:1px;
	cursor:pointer;
}
#key_number ul li:nth-last-child(2){
	color:red;
}
#key_number ul li:hover{
	background:#0059b3;
}
.show_old,.show_gender{
	border-radius:3px;
	/*background:#819FF7;*/
	background:#81BEF7;
	cursor:pointer;
}
/*#show_ad:hover,#show_ch:hover{
	cursor:pointer;
	border-radius:3px;
	background:#819FF7;
}
#show_ad:visited,#show_ch:visited {
    cursor:pointer;
	border-radius:3px;
	background:#819FF7;
}
#show_ad:active,#show_ch:active {
    cursor:pointer;
	border-radius:3px;
	background:#819FF7;
}*/
</style>
<div id="main" class="container-fluid">
		
    	<div class="col-sm-12" style="padding:0px !important;">
    		<div id="header">
    		<!-- stdClass Object ( [cur_typeno] => 41512071413532 [cur_type] => 5 [curcode] => USD [rate] => 1 [symbol] => $ ) 1;  -->
            	<div class="col-sm-5 col-md-4" style="position: absolute;top:10px;right:0;">
                        <div class="dropdown" style="float:left; margin-right:5px;">
                              <button class="btn btn-default dropdown-toggle hide" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Dropdown
                                <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a href="#">Action</a></li>
                              </ul>
                        </div>
                        
                        <div class="input-group">
                              <input type="text" class="form-control" id="search_ticket" placeholder="Search ticket number">
                              <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" id="btn_check"><img src="<?php echo base_url("assets/images/icons/search2.png"); ?>" class="img-rounded"></button>
                              </span>
                        </div>
                </div>
    			<img src="<?php echo base_url("assets/profile/ticking_banner.png"); ?>" width="100%" height="100%">
            </div><!-- div header -->
        </div><!-- div header 12 -->
    	<!--<div class="col-sm-12">
    		<div id="mainue">
    			<MARQUEE style=""><p style="font-size:15px;color:white; margin-top:0px;line-height: 40px">
						<strong>Welcome to Hue City the capital of Thua Thien Hue province in Central Vietnam</strong></p></MARQUEE>
    		</div>
        </div>-->
    	<div class="col-sm-12" id="contain" style="padding:0px !important;">
            <div class="col-sm-3 col-md-3" id="visit_left">
            	<div id="left_title" class="col-sm-2"><p><font size="+1" color="#FFFFFF"><b>MOST VISITED</b></font></p></div>
                <div id="wrap_left">
                <?php
                	$sql_park = $this->db->query("SELECT package_name,package_type,package_typeno,image,type_of FROM set_park_package WHERE is_active=1 AND notforsale=0 ORDER BY type_of")->result();
                	$park_img = "";
                	if(count($sql_park) > 0){
                		foreach($sql_park as $row_park){
                			$is_local      = $this->db->query("SELECT is_local FROM countries WHERE order_country='1'")->row();
                			//$parkage_price = $this->db->query("SELECT ROUND(price) AS price,ROUND(discount) AS discount FROM set_price_list WHERE package_typeno='".$row_park->package_typeno."' AND is_local='".$is_local->is_local."' AND old_type='0'")->row();
                			$sql_prefix    = $this->db->query("SELECT count(*) amt FROM z_setup_prefix WHERE package_typeno='".$row_park->package_typeno."'")->row();
                			$pack_price    = 0;
                			$pack_discount = 0;
                			//echo $img_url;
                			// if(count($parkage_price) > 0){
                			// 	$pack_price    = $parkage_price->price;
                			// 	$pack_discount = $parkage_price->discount;
                			// }
                			if($row_park->image != ""){
                				$img_url  = FCPATH."assets/upload/packages/".$row_park->image;
	                			if(file_exists($img_url)){
	                				$park_img.='<a href="javascript:void(0)" id="park_left" class="park_left" style="width:100px;height:100px;float:left; margin-left:10px;">
	                								<img src="'.base_url("assets/upload/packages/".$row_park->image).'"  class="img-thumbnail" style="width:100%;height:100%;">
	                								<p style="font-size:10px;white-space: nowrap;overflow: hidden;">'.$row_park->package_name.'</p>
	                								<input type="hidden" id="h_price" class="h_price" value="'.$pack_price.'">
	                								<input type="hidden" id="h_discount" class="h_discount" value="'.$pack_discount.'">
	                								<input type="hidden" id="h_package_typeno" class="h_package_typeno" value="'.$row_park->package_typeno.'">
	                								<input type="hidden" id="h_typeof" class="h_typeof" value="'.$row_park->type_of.'">
	                								<input type="hidden" id="h_prefix" class="h_prefix" value="'.$sql_prefix->amt.'">
							                   	</a>';
	                			}else{
		                			$park_img.='<a href="javascript:void(0)" id="park_left" class="park_left" style="float:left;width:100px;height:100px;float:left; margin-left:10px;">
							                    	<img src="'.base_url("assets/upload/images.png").'"  class="img-thumbnail" style="width:100%;height:100%;">
							                   		<p style="font-size:10px;white-space: nowrap;overflow: hidden;">'.$row_park->package_name.'</p>
							                   		<input type="hidden" id="h_price" class="h_price" value="'.$pack_price.'">
	                								<input type="hidden" id="h_discount" class="h_discount" value="'.$pack_discount.'">
							                   		<input type="hidden" id="h_package_typeno" class="h_package_typeno" value="'.$row_park->package_typeno.'">
	                								<input type="hidden" id="h_typeof" class="h_typeof" value="'.$row_park->type_of.'">
	                								<input type="hidden" id="h_prefix" class="h_prefix" value="'.$sql_prefix->amt.'">
							                   	</a>';
						        }
                			}else{
                				$park_img.='<a href="javascript:void(0)" id="park_left" class="park_left" style="float:left;width:100px;height:100px;float:left; margin-left:10px;">
						                    	<img src="'.base_url("assets/upload/images.png").'"  class="img-thumbnail" style="width:100%;height:100%;">
						                   		<p style="font-size:10px;">'.$row_park->package_name.'</p>
						                   		<input type="hidden" id="h_price" class="h_price" value="'.$pack_price.'">
                								<input type="hidden" id="h_discount" class="h_discount" value="'.$pack_discount.'">
						                   		<input type="hidden" id="h_package_typeno" class="h_package_typeno" value="'.$row_park->package_typeno.'">
                								<input type="hidden" id="h_typeof" class="h_typeof" value="'.$row_park->type_of.'">
                								<input type="hidden" id="h_prefix" class="h_prefix" value="'.$sql_prefix->amt.'">
						                   	</a>';
                			}
                			
                		}
                		
                	}
                	echo $park_img;
                ?>
                </div>
            </div>
            <div class="col-sm-9 col-md-9" id="visit_center">
            	<div id="center_title" class="col-sm-12 test">
            		<h4 class="choosen_list">TICKET REGISTRATION SYSTEM</h4>
            		<span class="" style="float:right;border:0px solid #808080;width:30px;height:30px;margin-right:5px;"><img src="<?php echo site_url("assets/profile/report.png"); ?>"></span>
            		<span class="" id="add_agency" style="float:right;border:0px solid #808080;width:30px;height:30px;margin-right:5px;cursor:pointer;"><img src="<?php echo site_url("assets/profile/agency.png"); ?>"></span>
            	</div>
                <div id="wrap_center" class="col-sm-12">
	                <div class="table-responsive" id="tbl_resp">
	                	<table class="table table-bordered" cellpadding="0" cellspacing="0">
	                		<thead>
	                			<tr>
	                				<th style="text-align:center; width:10%;">Park</th>
	                				<th style="text-align:center; width:18%;">Country</th>
	                				<th style="text-align:center; width:10%;">Remark</th>
	                				<th style="text-align:center; width:10%;">Gender</th>
	                				<th style="text-align:center; width:5%;">#ticket</th>
	                				<th style="text-align:center; width:7%;">Discount</th>
	                				<th style="text-align:center; width:15%;">Price</th>
	                				<th style="text-align:center; width:20%;">Amount</th>
	                				<th style="text-align:center; width:3%;">Act</th>
	                			</tr>
	                		</thead>
	                		
	                		<tbody id="tbl_tr">
	                			
	                		</tbody>
	                	</table>
	                </div>
	                <div class="col-sm-10" id="diplay_footer" style="position:fixed;bottom:28px;border-top:0px solid blue; padding-left:60px !important;">
						<div class="col-sm-2" style="padding:0px;margin:2px;">
	                		<label><strong>Total (<?php echo $currency->symbol;?>)</strong></label>
	                		<input type="text" class="form-control show_total_amt" id="show_total_amt" value="0" readonly="readonly" style="text-align:right;">
	                		<input type="hidden" class="form-control total_amt" id="total_amt" value="0" readonly="readonly" style="text-align:right;">
	                	</div>
	                	<div class="col-sm-2" style="padding:0px;margin:2px;">
	                		<label><strong>Discount (<?php echo $currency->symbol;?>)</strong></label>
	                		<input type="text" class="form-control show_discount_amt" id="show_discount_amt" value="0" style="text-align:right;">
	                		<input type="hidden" class="form-control discount_amt" id="discount_amt" value="0" style="text-align:right;">
	                	</div>
	                	<div class="col-sm-2" style="padding:0px;margin:2px;">
	                		<label><strong>Payment (<?php echo $currency->symbol;?>)</strong></label>
	                		<input type="text" class="form-control show_payment_amt" id="show_payment_amt" value="0" style="text-align:right;">
	                		<input type="hidden" class="form-control payment_amt" id="payment_amt" value="0" style="text-align:right;">
	                	</div>
	                	<div class="col-sm-2" style="padding:0px;margin:2px;" id="show_balance">
	                		<label><strong>Balance (<?php echo $currency->symbol;?>)</strong></label>
	                		<input type="text" class="form-control balance_amt" id="balance_amt" value="0" readonly="readonly" style="text-align:right;">
	                	</div>
	                	<div class="col-sm-2" style="padding:0px;margin:2px;display: none;" id="show_change">
	                		<label><strong>Change (<?php echo $currency->symbol;?>)</strong></label>
	                		<input type="text" class="form-control change_amt" id="change_amt" value="0" readonly="readonly" style="text-align:right;">
	                	</div>
	                	<div class="col-sm-2" style="padding:0px;margin:23px 0 0px 2px;">
	                		<!-- <button class="btn btn-danger" id="clear">CLEAR</button> -->
	                		<button class="btn btn-success" id="save">SAVE</button>
	                	</div>
					</div>
                </div> <!-- end div wrapp center -->
                
            </div>
            <?php
                $ses_user = $this->session->userdata("userid");
                $sql_user = $this->db->query("SELECT userid,user_name,last_visit FROM sch_user WHERE userid='".$ses_user."'")->row();
            	// $url = FCPATH."assets/upload/user_profile/".$ses_user."_thumb.png";
            	// if(file_exists($url)){
            	// 	$url = base_url("assets/upload/user_profile/".$ses_user."_thumb.png");
            	// }else{
            	// 	$url = base_url("assets/upload/user_profile/No_person.jpg");
            	// }	
            
            ?>
            
        </div> <!-- end div id ='contain' -->
    	
    	<div id="footer" class="" style="width: 100%;padding: 0px !important;margin:0px !important;border-top:0px solid #b3b3cc;">
    		<div class="col-sm-7" style="padding:0px;">
    			<span style="font-size:9px;float:left;color:#FFFFFF;margin-top:5px;">
					<p style="margin:0px;"><b>Notice</b>:&nbsp; Payment is non-refundable. Please re-confirm with buyers before proceeding ticket</p>
				</span>
    		</div>
    		<div class="col-sm-2" style="padding:0px;">
    			<p style="color:#80ffff;font-size: 9px; margin-top:5px;padding:0px;">Last Logged :&nbsp;<b><?php echo ($sql_user->user_name); ?></b></p>
    		</div>
    		<div class="col-sm-3 f_date" style="padding: 0px !important; text-align: left;margin-top:0px;">
    			<p style="padding:0px;margin-top: 5px;color:#FFFFFF;font-size: 9px;"><b>Today :</b>&nbsp;<span id="show_t"></span></p>
    		</div>
        </div>

		<div class="modal fade" id="show_agency" tabindex="-1" role="dialog">
			<div class="modal-dialog" id="sub-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4>Check Agency</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="tourreference">Tour Reference<span style="color:red;">*</span></label>
							<input type="text" name="tourreference" id="tourreference" class="form-control">
						</div>
						<div class="form-group">
							<label for="tourname">Tour Name<span style="color:red;">*</span></label>
							<input type="text" name="tourname" id="tourname" class="form-control">
						</div>
						<div class="form-group">
							<label for="tourcode">Tour Code<span style="color:red;">*</span></label>
							<input type="text" name="tourcode" id="tourcode" class="form-control">
							<input type="hidden" name="agency_tran_typeno" id="agency_tran_typeno" class="form-control">
						</div>
						<div class="form-group">
							<label>Select park</label>
							<ul style="list-style: none;" id="parkage_agency_name">
								<!-- <li><input type="checkbox" name="checktest">&nbsp;aaaaa</li>
								<li><input type="checkbox" name="checktest">&nbsp;bbbbb</li> -->
							</ul>
						</div>
						<!-- <div class="form-group">
							<label for="authorizenumber">Authorize Number</label>
							<input type="text" name="authorizenumber" id="authorizenumber" class="form-control">
						</div> -->
						<div class="form-group">
							<label for="vistornumber">Vistor Number<span style="color:red;">*</span></label>
							<input type="text" name="vistornumber" id="vistornumber" class="form-control">
						</div>
						<div class="form-group">
							<label for="authorizeby">Authorize by</label>
							<input type="text" name="authorizeby" id="authorizeby" class="form-control">
							<input type="hidden" name="authorize_code" id="authorize_code" class="form-control">
						</div>
						<div class="form-group">
							<label for="discription">Discription</label>
							<textarea name="discription" id="discription" class="form-control"></textarea>
						</div>
						<!-- <div class="form-group">
							<label>Authorize No<span style="color:red;">*</span></label>
							<input type="text" name="authorizeno" id="authorizeno" class="form-control">
							</div>
							<div class="form-group">
								<label>Tour Code<span style="color:red;">*</span></label>
								<input type="text" name="tourcode" id="tourcode" readonly="readonly" class="form-control">
							</div>
							<div class="form-group">
								<label>Number Visitor<span style="color:red;">*</span></label>
								<input type="text" name="numbervisitor" id="numbervisitor" readonly="readonly" class="form-control">
							</div>
							<div class="form-group">
								<label>Description</label>
								<textarea name="description" id="description" class="form-control"></textarea>
							</div>-->
					</div> 

					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal" id="btn_closs">Close</button>
						<button type="button" class="btn btn-primary" id="save_agency">SAVE</button>
					</div>
				</div>
			</div>
		</div> 
		<center>
		<div id="div_wrap">
					<div id="key_number">
						<div id="div_show_num">
							<input type="hidden" id="show_append" value="0"></span>
							<input type="hidden" id="show_rowindex" class="show_rowindex">
							<input type="text" id="show_number_key" style="margin-top:10px;height:36px; width:50%;font-size:16px;text-align: center;">
						</div>
						<ul>
							<li id="add_number1" class="add_number" attvalue="1">1</li>
							<li id="add_number2" class="add_number"  attvalue="2">2</li>
							<li id="add_number3" class="add_number"  attvalue="3">3</li>
							<li id="add_number4" class="add_number"  attvalue="4">4</li>
							<li id="backspace" class="backspace">backspace</li>
							<li id="add_number5" class="add_number"  attvalue="5">5</li>
							<li id="add_number6" class="add_number"  attvalue="6">6</li>
							<li id="add_number7" class="add_number"  attvalue="7">7</li>
							<li id="add_number8" class="add_number"  attvalue="8">8</li>
							<li id="clear" class="clear">CLEAR</li>
							<li id="add_number9" class="add_number"  attvalue="9">9</li>
							<li id="add_number0" class="add_number"  attvalue="0">0</li>
							<li id="close">CLOSE</li>
							<li id="enter">ENTER</li>
						</ul>
					</div>
				</div>
		</center>
</div>

<?php
	$sql_countries = $this->db->query("SELECT
										countries.id_countries,
										countries.name,
										countries.is_local,
										countries.flag
										FROM
										countries
										ORDER BY order_country ASC")->result();
	$opt_countries = '<option value=""></option>';
	if(count($sql_countries) > 0){
		$i=1;
		foreach($sql_countries as $val_countries){
			$flag_img="";
			if(isset($val_countries->flag)){
				$flag_img=base_url('assets/upload/flag/'.$val_countries->flag);
			}

			$opt_countries.= '<option style="vertical-align:bottom;height:20px;margin-left:3px;padding-left:20px;background-image:url('.$flag_img.');background-repeat:no-repeat;	background-position: left center;" is_local="'.$val_countries->is_local.'" value="'.$val_countries->id_countries.'">'.$val_countries->name.'</option>';
			if($i==10){
				$opt_countries.= '<option value="">-----------------------------------</option>';
			}
			$i++;
		}
	}
	// echo $opt_countries;
?>
					
<script type="text/javascript">
	$(document).keydown(function(evt){
		if (evt.keyCode==49 && (evt.ctrlKey)){
			evt.preventDefault();
			$("#buy_ticket_derect").click();
		}
	});
	
function addTextTag(txt)
{
	var arr_p;
	var str = $("#show_number_key").val();
	arr_p = str.toString();
	//arr_p.push(txt);
	arr_p+=txt;
	return arr_p;
}
function removeTextTag()
{
	var strng = $("#show_number_key").val();
	$("#show_number_key").val(strng.substring(0,strng.length-1));
}
	$(function(){
		//fn_show_park();
		//fn_tbl_tr();
		// ========================= add number =================
		$("body").delegate(".add_number","click",function(){
			var att_v = $(this).attr("attvalue");
			var ad_num = addTextTag(att_v); 
			$("#show_number_key").val(ad_num);
			//$("#show_append").append(att_v);
			//var aa = $("#show_append").val();
			//$("#show_number_key").val(aad);
		})
		 $("body").delegate("#backspace","click",function(e){
        	var textVal = $("#show_append").val();
        	removeTextTag();
        	//$('#show_append').val(textVal.substring(0,textVal.length - 1));
        	//var textVal1 = $("#show_append").val();
        	//$('#show_number_key').val(textVal.substring(0,textVal.length - 1));
        })

		$("body").delegate("#close","click",function(){
			$("#show_append").val("");
			$("#show_number_key").val("");
			$("#show_rowindex").val("");
			$("#div_wrap").hide();
		})

		$("body").delegate("#qtyticket","dblclick",function(){
			var row_index = $(this).parent().parent().find("#row_index").val();
			$("#show_rowindex").val(row_index);
			$("#div_wrap").show();
		});
		$("body").delegate("#enter","click",function(){
			var number_qty    = $("#show_number_key").val();
			var show_rowindex = $("#show_rowindex").val();
			if(number_qty != 0 || number_qty != ""){
				$(".number_auto"+show_rowindex).parent().parent().find("#qtyticket").val(number_qty);
				var tr = $(".number_auto"+show_rowindex).parent().parent();			
				fn_total_line(tr);
			}
			$("#show_append").val("");
			$("#show_number_key").val("");
			$("#show_rowindex").val("");
			$("#div_wrap").hide();
		});
		$("body").delegate("#clear","click",function(){
			$("#show_append").val("");
			$("#show_number_key").val("");
		});
		// ========================= end add number =================
		startTime();
		$("body").delegate("#btn_check","click",function(){
			$.ajax({
				type:"POST",
				url:"<?php echo site_url('interface/cinterface/fn_search_ticket'); ?>",
				dataType:"JSON",
				async:false,
				data:{
					search_ticket:$("#search_ticket").val()
				},
				success:function(data){
					if(data.ticketno == ""){
						alert("This number ticket have checked aready.");
					}else{
						//window.open("<?= site_url('report/c_report_payment') ?>?app_typeno="+data.app_typeno,"_blank");
						window.open("<?= site_url('invoice/c_report_checking_ticketing') ?>?ticketno="+data.ticketno+"&s_date="+data.s_date,"_blank");
					}
				}
			})
		})
		$("body").delegate("#add_agency","click",function(){
			fn_clear_agency();
			$("#show_agency").modal("show");
		})
		$("#sub-dialog").draggable({
            handle: ".modal-header"
        });
		$("body").delegate("#authorizeno","focus",function(){
			fn_autoAuthorize();
		})
        $("body").delegate("#btn-save","click",function(){
        	$.ajax({
        		type:"POST",
        		url :"<?php echo site_url('interface/cinterface/save_agency'); ?>",
        		dataType:"JSON",
        		async:false,
        		data:{
        			Para_save   : 1,
        			authorizeno : $("#authorizeno").val(),
        			tourcode    : $("#tourcode").val(),
        			numbervisitor : $("#numbervisitor").val(),
        			description : $("#description").val(),
        		},
        		success:function(data){
        			if(data.amt == 0){
						alert("Sorry your authorize code incorrect !");
						$("#authorizeno").focus().select();
        			}else{
        				$("#show_agency").modal("hide");
        			}
        			
        		}
        	})
        })
        
		$("body").delegate("#park_left","click",function(){
			//alert(ii++);
			var src = $(this).find("img").attr("src");

			var parkage_typeno = $(this).find("#h_package_typeno").val();
			var att_typeof     = $(this).find("#h_typeof").val();
			var h_price        = $(this).find("#h_price").val();
			var h_discount     = $(this).find("#h_discount").val();
			var h_prefix       = $(this).find("#h_prefix").val();
			if(h_prefix == 0){
				alert("Please create prefix first !");
			 	return false;
			}else{
				fn_tbl_tr(src,parkage_typeno,att_typeof,h_price,h_discount,ii++);
			}
						
		});
		// $("body").delegate(".test","click",function(){			
		// 	//$("#header").fadeToggle("slow", "linear" );
		// 	var height_rest = $("#tbl_resp").height()-0;
		// 	$(this).addClass("test1");
		// 	$("#center_title").removeClass("test");
		// 	//$("#tbl_resp").css({'height':'592'})
		// 	$("#visit_center").css("cssText","height: 610px !important;");
		// 	$("#header").hide();
		  	
		// });
		// $("body").delegate(".test1","click",function(){
		// 	$("#visit_center").css("cssText","height : 558px !important;");
		// 	$(this).addClass("test");
		// 	$("#center_title").removeClass("test1");
		// 	$("#header").show();
		// })

		$("body").delegate(".ch_remark","click",function(){
			var tr = $(this).parent().parent();
			if($(this).is(":checked")){
				var val_remark     = $(this).val();
				$(this).parent().parent().find("#remake").val(val_remark);
				var is_local       = tr.find("#country").find("option:selected").attr("is_local");
				var typeno_parkage = tr.find("#parkage_typeno").val();
				var country_v      = tr.find("#country").val();
				if(country_v != ""){
					fn_getprice(typeno_parkage,is_local,val_remark,tr);
				}else{
					return false;
				}
				
			}
		})

		$("body").delegate("#country","change",function(){
			var tr = $(this).parent().parent();
			var is_local       = $(this).find("option:selected").attr("is_local");
			var typeno_parkage = tr.find("#parkage_typeno").val();
			var val_remark     = tr.find("#remake").val();
			if($(this).val() == ""){
				tr.find("#show_price").val(0);
				tr.find("#show_discount").val(0);
				tr.find("#show_total").val(0);
			}else{
				fn_getprice(typeno_parkage,is_local,val_remark,tr);
			}
			
		})
		$("body").delegate("#show_discount_amt","keyup",function(){
			var amt_total = $("#total_amt").val()-0;
			var discount_amt = $(this).val()-0;
			$("#discount_amt").val(discount_amt);
			// var amt_pay   = $("#payment_amt").val()-0;
			var amt_disc  = discount_amt;
			//var balance_pay = 0;
			if(amt_disc > (amt_total-amt_disc)){
				alert("Sorry your discount can't bigger than payment! Please try agian.");
				$("#discount_amt").val(0);
				$(this).val(0);
				$("#payment_amt").val(amt_total); 
				//var balance_pay = (amt_total-((amt_total-amt_disc)+amt_disc))-0;
				$("#balance_amt").val(0);
				$("#show_payment_amt").val(formatNumber(amt_total));
				$("#show_balance").show();
				$("#show_change").hide();
			}else{
				// var amt_payment = $("#payment_amt").val()-0;
				// var balance_pay = (amt_total-(amt_disc+amt_payment))-0;
				// $("#balance_amt").val(balance_pay);
				// $("#show_payment_amt").val(formatNumber(amt_payment));
				if(fn_total_amt()-0 < 0){
					$("#show_balance").hide();
					$("#show_change").show();
					$("#change_amt").val(formatNumber(fn_total_amt()));
				}else{
					$("#show_balance").show();
					$("#show_change").hide();
					$("#balance_amt").val(formatNumber(fn_total_amt()));
				}
			}
		})
		$("body").delegate("#show_discount_amt","blur",function(){
			var disc_amt    = $(this).val();
			var payment_amt =  $("#payment_amt").val();
			$(this).val(formatNumber(disc_amt));
			//$("#show_payment_amt").val(formatNumber(payment_amt));
		})

		$("body").delegate("#show_discount_amt","focus",function(){
			var disc_amt    = $("#discount_amt").val();
			$(this).val(disc_amt);
			$(this).select();
		})
		$("body").delegate("#show_payment_amt","keyup",function(){
			var amt_total = $("#total_amt").val()-0;
			var amt_disc  = $("#discount_amt").val()-0;
			$("#payment_amt").val($(this).val()-0);
			//var amt_pay   = $(this).parent().parent().find("#payment_amt").val()-0;
			
			//var balance_pay = (amt_total-(amt_pay+amt_disc))-0;
			if(fn_total_amt()-0 < 0){
				$("#show_balance").hide();
				$("#show_change").show();
				$("#change_amt").val(formatNumber(fn_total_amt()));
			}else{
				$("#show_balance").show();
				$("#show_change").hide();
				$("#balance_amt").val(formatNumber(fn_total_amt()));
			}
		})
		$("body").delegate("#show_payment_amt","blur",function(){
			var val_this = $(this).val();
			$(this).val(formatNumber(val_this));
		});
		$("body").delegate("#show_payment_amt","focus",function(){
			// var total_amt = $("#total_amt").val()-0;
			// var total_disc = $("#discount_amt").val()-0;
			var total_pay = $("#payment_amt").val()-0;
			$(this).val(total_pay);
			$(this).select();
		});

		// $("body").delegate("#discount","keyup",function(){
		// 	var tr = $(this).parent().parent();
		// 	var disc = $(this).val()-0;
		// 	var val_price = tr.find("#price").val()-0;
		// 	if(disc > val_price){
		// 		alert("Sorry your disount can't bigger than price ! Please try again.");
		// 		$(this).val(0);
		// 	}
		// 	fn_total_line(tr);				
		// });

		
		$("body").delegate("#qtyticket","keyup",function(){
			var qtytic = $(this).val();
			if(qtytic == 0 || qtytic == ""){
				$(this).val(1);
			}
			var tr = $(this).parent().parent();			
			fn_total_line(tr);				
		});
		$("body").delegate("#show_price","keyup",function(){
			var tr = $(this).parent().parent();			
			fn_total_line(tr);				
		});

		$("body").delegate(".ch_gender","click",function(){
			if($(this).is(":checked")){
				var val_gender = $(this).val();
				$(this).parent().parent().find("#gender").val(val_gender);
			}
		})
		$("body").delegate("#qtyticket,#show_discount,#show_payment_amt,#show_discount_amt,#show_price,#total,#show_number_key","keydown", function (e) {
           	if ((e.keyCode >= 96 && e.keyCode <= 105) || (e.keyCode >= 48 && e.keyCode <= 57) || e.keyCode == 8 || e.keyCode == 190 || e.keyCode == 110) {
                $(this).removeAttr("readonly");
            } else {
                $(this).attr("readonly", "readonly");
            }
        });
       
        $("body").delegate("#delete_row","click",function(){
        	var conf = confirm("Do you want to delete ?");
        	if(conf == true){
        		$(this).parent().remove();
        		var tr = $(this).parent().parent();
        		fn_total_line(tr);
        	}
        	return false;
        });
        $("body").delegate("#discount_amt,#payment_amt","focus",function(){
        	$(this).select();
        })
        var ii = 0; // for making remark not duplicate
        $("body").delegate("#save","click",function(){
        	var total_amt    = $("#total_amt").val()-0;
        	var discount_amt = $("#discount_amt").val()-0;
        	var payment_amt  = $("#payment_amt").val()-0;
        	var amt_payment = (discount_amt+payment_amt);
        	var arr_save = [];
        	var country_v = 0;
        	$(".row_index").each(function(e){
        		var tr = $(this).parent().parent();
        		var country_name = tr.find("#country").val();
        		arr_save[e] = {
        			parkage_typeno : tr.find("#parkage_typeno").val(),
					country        : tr.find("#country").val(),
					is_local       : tr.find("#country").find("option:selected").attr("is_local"),
					remake         : tr.find("#remake").val(),
					gender         : tr.find("#gender").val(),
					qtyticket      : tr.find("#qtyticket").val(),
					discount       : tr.find("#discount").val(),
					price          : tr.find("#price").val(),
					total          : tr.find("#total").val(),
					type_of        : tr.find("#type_of").val()
        		}
        		if(country_name == ""){
        			country_v++;
        		}
        	});
        	var count_arr = arr_save.length;
        	if(count_arr == 0){
        		alert("Please choose park first !");
        		return false;
        	}else if(country_v > 0){
        		alert("Please choose country first.");
        		return false;
        	}else{
        		if(amt_payment < total_amt){
        			alert("Sorry your payment not enought.");
        		}else{
	        		var conf = confirm("Do you want to save ?");
	        		if(conf == true){
		        		$.ajax({
		        			type :"POST",
		        			url  :"<?php echo site_url('interface/cinterface/save');?>",
		        			dataType:"JSON",
		        			async   : false,
		        			data:{
		        				Para_save : 1,
		        				rate : "<?php echo $currency->rate; ?>",
		        				curr_typeno : "<?php echo $currency->cur_typeno; ?>",
		        				arr_save  : arr_save,
		        				total_amt      : $("#total_amt").val(),
		        				discount_amt   : $("#discount_amt").val()
		        			},
		        			success:function(data){
		        				if(data.app_typeno.length > 0){
		        					//window.location.href="<?php echo site_url('report/c_report_payment');?>?"+data.app_typeno;
		        					
		        					//window.open("<?= site_url('report/c_report_payment/print_receipt') ?>?app_typeno="+data.app_typeno,"_blank");
		        					window.open("<?= site_url('report/c_report_payment') ?>?app_typeno="+data.app_typeno,"_blank");
		        				}
		        			}
		        		});
		        		ii=0;
		        		fn_clear();
		        	}
		        }
        	}
        })
        $("body").delegate("#tourreference","focus",function(){
        	autoAgency();
        })
        $("body").delegate('.ch_park','click',function(){
        	//var tr = $(this).parent().parent();
        	if($(this).is(":checked")){
        		$('.ch_park').removeClass('ch_data');
        		$(".ch_park").prop("checked",false);
        		$(this).addClass("ch_data");
        		$(".ch_data").prop("checked",true);
        		//$(".ch_park").removeAttr('checked');
        		// $(this).attr("checked",true);
        		// tr.find('.ch_park').removeAttr('checked');
        	}
        	else{
        		var amt_ch = $(".ch_park:checked").length;
        		if(amt_ch == 0){
        			$(this).prop("checked",true);
        		}
        		//alert(amt_ch);
        		//$(this).removeClass('ch_data');
        	}
        })
        $("body").delegate("#save_agency","click",function(){
        	var parkage_agency_name = $("#agency_tran_typeno").val();
    		if(parkage_agency_name == ""){
    			alert("Your tour reference is not corrected. Please try again.");
    		}else{
	        	var conf = confirm("Do you want to save ?");
	        	if(conf == true){
		        		var agency_tran_typeno = $("#agency_tran_typeno").val();
		        		var ticket_typeno      = $(".ch_park:checked").attr("att_ticket_typeno");
		        		var package_typeno     = $(".ch_park:checked").attr("att_packagetypeno");
		        		var parktypeno         = $(".ch_park:checked").attr("parktypeno"); 
			        	var arr_agency = {
			        					"tourreference":$("#tourreference").val(),
			        					"agency_tran_typeno":agency_tran_typeno,
			        					"tourname":$("#tourname").val(),
			        					"tourcode":$("#tourcode").val(),
			        					"package_typeno":package_typeno,
			        					"parktypeno":parktypeno,
			        					//"park_type":$(".ch_park:checked").attr("att_park_type"),
			        					"ticket_typeno":ticket_typeno,
			        					"vistornumber":$("#vistornumber").val(),
			        					"authorizeby":$("#authorizeby").val(),
			        					"discription":$("#discription").val()
			        					}
			        	$.ajax({
			    			type :"POST",
			    			url  :"<?php echo site_url('interface/cinterface/save_agency');?>",
			    			dataType:"JSON",
			    			async   : false,
			    			data:{
			    				Para_agency : 1,
			    				arr_agency  : arr_agency
			    			},
			    			success:function(data){
			    				if(data.ok == 10000){	    				
			    					window.open("<?= site_url('invoice/c_tour_group_ticket') ?>?agency_trans_typeno="+agency_tran_typeno+"&package_typeno="+package_typeno,"_blank");
			    				}
			    			}
			    		});
			    		clear_agency_check();
			    		$("#show_agency").modal("hide");
		        }else{
		        	return false;
		        }
		    }
        })
        $("body").delegate('#btn_closs','click',function(){
        	clear_agency_check();
        })

        $("body").delegate("#show_price","blur", function (e) {
			var mm = $(this).val()-0;
			$(this).closest("td").find(".price").val(mm);
			$(this).val(formatNumber(mm));
			var tr = $(this).parent().parent();
			fn_total_line(tr);
		});

		$("body").delegate("#show_price","focus", function (e) {
		 	var price = $(this).closest("td").find(".price").val();
		 	$(this).val(price);
		 	$(this).select();
		});
		$("body").delegate("#show_discount","blur", function (e) {
			var disc = $(this).val()-0;
			$(this).closest("td").find(".discount").val(disc);
			$(this).val(formatNumber(disc));
			var tr = $(this).parent().parent();
			fn_total_line(tr);
		});
		$("body").delegate("#show_discount","focus", function (e) {
			var disc = $(this).closest("td").find(".discount").val();
			$(this).val(disc);
			$(this).select();
		});
		$("body").delegate("#show_ad","click",function(){
			var tr = $(this).parent().parent();
			tr.find("#show_ch").removeClass("show_old")
			$(this).addClass("show_old");
		})
		$("body").delegate("#show_ch","click",function(){
			var tr = $(this).parent().parent();
			tr.find("#show_ad").removeClass("show_old");
			$(this).addClass("show_old");
		})
		$("body").delegate("#show_male","click",function(){
			var tr = $(this).parent().parent();
			tr.find("#show_female").removeClass("show_gender")
			$(this).addClass("show_gender");
		})
		$("body").delegate("#show_female","click",function(){
			var tr = $(this).parent().parent();
			tr.find("#show_male").removeClass("show_gender");
			$(this).addClass("show_gender");
		})
		$('body').delegate('', 'mouseover', function(){
	        $(".show_ad").parent().tooltip({title:"adult"})
	    });
	    $('body').delegate('', 'mouseover', function(){
	        $(".show_ch").parent().tooltip({title:"child"})
	    });
	    $('body').delegate('', 'mouseover', function(){
	        $(".show_m").parent().tooltip({title:"male"})
	    });
	    $('body').delegate('', 'mouseover', function(){
	        $(".show_f").parent().tooltip({title:"femal"})
	    });
	});
// $(document).ready(function(){
//     $('[data-toggle="tooltip"]').tooltip();   
// });
	function formatNumber (num) {
	    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
	}
	
	function fn_total_amt(){
		//parseFloat(val).toFixed(decimal)
		var total_amt    = $("#total_amt").val()-0;
		var discount_amt = $("#discount_amt").val()-0;
		var payment_amt  = $("#payment_amt").val()-0;
		var balance_amt  = $("#balance_amt").val()-0;
		var total_pay_dic= parseFloat(payment_amt+discount_amt).toFixed(3);
		var balance      = parseFloat(total_amt-total_pay_dic).toFixed(3);
		return balance;
	}
	function autoAgency(){
	    var url = "<?php echo site_url('interface/cinterface/auto_agency');?>";
	    $("#tourreference").autocomplete({
	        source: url,
	        minLength: 0,
	        select: function (events, ui) {
	        	$("#tourreference").val(ui.item.agency_typeno);
	        	$("#agency_tran_typeno").val(ui.item.agency_trans_typeno);
	        	$("#tourname").val(ui.item.tourname);
	           	$("#tourcode").val(ui.item.tourcode);
	            $("#numbervisitor").val(ui.item.visitor_number);
	           	$("#vistornumber").val(ui.item.visitor_number);
	           	$("#authorize_code").val(ui.item.authorize_code);
	           	$("#authorizeby").val(ui.item.authorize_by);
	           	$("#discription").text(ui.item.description);
	           	$("#parkage_agency_name").html(ui.item.li_park);
	        }
	    });
	}
	function clear_agency_check(){
		$("#tourreference").val("");
    	$("#agency_tran_typeno").val("");
    	$("#tourname").val("");
       	$("#tourcode").val("");
        $("#numbervisitor").val("");
       	$("#vistornumber").val("");
       	$("#authorize_code").val("");
       	$("#authorizeby").val("");
       	$("#discription").text("");
       	$("#parkage_agency_name").html("");
	}
	function fn_autoAuthorize() {
	    var url = "<?php echo site_url('interface/cinterface/cautoCustomer');?>";
		$("#authorizeno").autocomplete({
	        source: url,
	        minLength: 0,
	        select: function (events, ui) {
	           	$("#authorizeno").val(ui.item.id);
	           	$("#tourcode").val(ui.item.agency_typeno);
	           	$("#numbervisitor").val(ui.item.visitor_number);
	           	$("#description").val(ui.item.description);
	        }
	    });
	    
	}
	function fn_tbl_tr(get_src,parkage_typeno,att_typeof,get_price,get_discount,ii){
		var trr ='<tr class="new_row">'+
				    '<td style="margin:2px 10px;float:left;padding:0px;vertical-align: middle;"><img src="'+get_src+'" width=50 height=50>'+
				    '<input type="hidden" name="row_index" id="row_index" class="row_index number_auto'+ii+'" value="'+ii+'">'+
				    '<input type="hidden" name="is_local" id="is_local" class="is_local" value="1">'+
				    '<input type="hidden" name="type_of" id="type_of" class="type_of" value="'+att_typeof+'">'+
				    '<input type="hidden" name="parkage_typeno" id="parkage_typeno" class="parkage_typeno" value="'+parkage_typeno+'"></td>'+
				    '<td><SELECT name="country" id="country" class="form-control country" placeholder="type" style="font-size:10px;"><?php echo $opt_countries; ?></SELECT></td>'+
					'<td style="padding:10px 0 0 0px;">'+
						'<input type="radio" name="ch_remark'+ii+'" class="ch_remark remark'+parkage_typeno+'" id="adult_'+ii+'" value="0" checked="checkex" style="margin-top:3px;font-size:10px;float:left;display:none;">&nbsp;<label for="adult_'+ii+'" class="show_old" id="show_ad" style="float:left;margin-left:3px;cursor:pointer;"><img src="<?php echo base_url("assets/oldgender/Ticket_Pic/adult3.png"); ?>" width="28" height="28" class="show_ad"></label>'+
						'<input type="radio" name="ch_remark'+ii+'" class="ch_remark" id="child_'+ii+'" value="1" style="float:left;margin-left:10px;display:none;">&nbsp;<label for="child_'+ii+'" style="font-size:10px;float:left;margin-left:3px;cursor:pointer;" id="show_ch"><img src="<?php echo base_url("assets/oldgender/ticket_pic/child3.png"); ?>" width="28" height="28" style="float:left;" class="show_ch"></label>'+
						'<input type="hidden" name="remake" class="remake" id="remake" value="0">'+ 
					'</td>'+
					'<td style="padding:10px 0 0 0px;"><input type="radio" name="ch_gender'+ii+'" class="ch_gender" id="male_'+ii+'" value="0" checked="checked" style="margin:0px;display:none;">&nbsp;'+
						'<label for="male_'+ii+'" style="font-size:10px;float:left;cursor:pointer;margin:0px 0px 0px 5px;" class="show_gender" id="show_male">'+
						'<img src="<?php echo base_url("assets/oldgender/ticket_pic/male.png"); ?>" width="28" height="28" style="float:left;" class="show_m"> </label><input type="radio" name="ch_gender'+ii+'" class="ch_gender" id="female_'+ii+'" value="1" style="display:none;">&nbsp;'+
						'<label for="female_'+ii+'" style="font-size:10px;float:left;cursor:pointer;margin:0px 0px 0px 0px;" id="show_female"><img src="<?php echo base_url("assets/oldgender/ticket_pic/femal.png"); ?>" width="28" height="28" style="float:left;" class="show_f"></label>'+
						'<input type="hidden" name="gender" class="gender" id="gender" value="0">'+
					'</td>'+
					'<td><input type="text" name="qtyticket" id="qtyticket" class="form-control qtyticket" value="1" style="text-align:right; width:40px; float:right;font-size:10px;"></td>'+
					'<td>'+
					'<input type="text" name="show_discount" id="show_discount" class="form-control show_discount" value="'+get_discount+'" placeholder="discount" style="text-align:right; width:70px; float:right; font-size:10px;">'+
					'<input type="hidden" name="discount" id="discount" class="form-control discount" value="'+get_discount+'">'+
					'</td>'+
					'<td>'+
						'<input type="text" name="show_price" id="show_price" class="form-control show_price" value="'+formatNumber(get_price)+'" placeholder="price" style="text-align:right; width:90px; float:right;font-size:10px;">'+
						'<input type="hidden" name="price" id="price" class="form-control price" value="'+get_price+'">'+
					'</td>'+
					'<td>'+
						'<input type="text" name="show_total" id="show_total" class="form-control show_total" readonly="readonly" style="text-align:right; width:90px; float:left;font-size:10px;"><span style="float:right;margin-top:8px;"><?php echo $currency->symbol;?></span>'+
						'<input type="hidden" name="total" id="total" class="form-control total">'+
					'</td>'+
					'<td style="text-align:center; vertical-align: middle;margin:0px;padding:0px; cursor:pointer;" id="delete_row"><img src="<?php echo site_url("assets/images/icons/delete.png"); ?>"></td>'+
					//'<td style="text-align:center; vertical-align: middle;margin:0px;padding:0px;"><a href="javascript:void(0)" id="delete_row"><img src="<?php echo site_url("assets/images/icons/delete.png"); ?>"></a></td>'+
				'</tr>';
		$("#tbl_tr").append(trr);
		var tr = $(".number_auto"+ii).parent().parent();
		//fn_getprice(parkage_typeno,1,0,tr);
		fn_total_line(tr);
	}
	function fn_clear(){
		$("#tbl_tr").html("");
		$("#total_amt").val(0);
		$("#discount_amt").val(0);
		$("#payment_amt").val(0);
		$("#balance_amt").val(0);
		$("#show_discount_amt").val(0);
		$("#show_payment_amt").val(0);
		$("#show_total_amt").val(0);
		$("#show_balance").show();
		$("#show_change").hide();
	}
	function fn_clear_agency(){
		$("#authorizeno").val("");
		$("#tourcode").val("");
		$("#numbervisitor").val("");
		$("#description").val("");
	}
	function fn_getprice(typeno_parkage,is_local,remark,tr){
		//var tr = $(".remark"+typeno_parkage).parent().parent();
		$.ajax({
			type:"POST",
			url : "<?php echo site_url('interface/cinterface/show_price'); ?>",
			dataType:"JSON",
			async:false,
			data:{
				Para_parkage   : 1,
				is_local       : is_local,
				old            : remark,
				typeno_parkage : typeno_parkage
			},
			success:function(data){
				// if(data['parkage'] == ""){
				// 	return false;
				// }
				tr.find("#discount").val(data['discount']);
				tr.find("#price").val(data['price']);
				tr.find("#show_price").val(formatNumber(data['price']));
				fn_total_line(tr);
			}
		})
	}
	function fn_total_line(tr){
		var qty      = tr.find("#qtyticket").val();
		var discount = tr.find("#discount").val();
		var price 	 = tr.find("#price").val();
		$("#show_change").hide();
		$("#show_balance").show();
		var total_line = (number_format(qty,3)*number_format(price,3))-number_format(discount,3)-0;
		tr.find("#show_total").val(formatNumber(total_line));
		tr.find("#total").val(total_line);
		
		var total_amt = 0;
		var total_dis = 0;
		var discount_amt = $("#discount_amt").val()-0;
		
		$(".total").each(function(){
			var total_this = $(this).val()-0;
			total_amt+=total_this;
		});
		$("#show_total_amt").val(formatNumber(total_amt));
		$("#show_payment_amt").val(formatNumber(total_amt));
		$("#discount_amt").val(0);
		$("#payment_amt").val(total_amt);
		var payment_amt  = $("#payment_amt").val()-0;
		//var balance = (total_amt-(discount_amt+(total_amt-discount_amt)))-0;
		//var balance = (total_amt-(discount_amt+(total_amt-discount_amt)))-0;
		$("#show_discount_amt").val(0);
		$("#total_amt").val(total_amt);
		$("#balance_amt").val(formatNumber(number_format(total_amt)-number_format(payment_amt)));
		//show_discount_amt
	}
	function number_format(val,decimal){
		if(decimal=="" || decimal==0){
			decimal=4;
		}  
		return parseFloat(val).toFixed(decimal);   
	}
	function fn_show_park(){
		$.ajax({
			type:"POST",
			url :'<?php echo site_url("interface/cinterface/show_park"); ?>',
			dataType:"JSON",
			data:{
				para_park:1
			},
			success:function(data){
				$("#wrap_center").html(data.park);
			}
		})
	}
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
		if(h >= 12){
			ampm = "PM";
			//h=(h-12)-0;
		}else{
			ampm = "AM";
		}
		//document.getElementById('time').innerHTML = h + ":" + m + ":" + s;
		$("#show_t").html(weekdays[day]+" "+daym+" "+months[month]+" "+years+",&nbsp;"+h + ":" + m + ":" + s+"&nbsp;"+ampm);
		// if(m == 21){
		// 	alert("hhhhhhhhhh");
		// 	//m = 0;
		// 	return false;	
		// }
		t = setTimeout(function () {
			startTime()
		}, 500);
		
	}
</script>
