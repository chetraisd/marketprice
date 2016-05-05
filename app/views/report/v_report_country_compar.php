<html>
<head>
</head>
<body>
<form  id="f_save" class="form-horizontal" enctype="multipart/form-data">
<div class="container-fluid">
	<div class="row">
      	<div class="col-xs-12">
			<div class="row result_info">
		    	<div class="col-sm-9" style="text-align:left;"><b><?php echo $this->lang->line("Comparison Country Report")?></b></div>
		        <div class="col-xs-3" style="text-align: right">
		                        
		                        <span class="top_action_button">
		                            <?php if ($this->green->gAction("E")) { ?>
		                                <a href="javascript:void(0)" id="export" title="Export">
		                                    <img width="24px" height="24px"  id='export1' src="<?php echo base_url('assets/images/icons/exports.png') ?>"/>
		                                </a>
		                            <?php } ?>
		                        </span>
		                        <span class="top_action_button">
		                            <?php if ($this->green->gAction("P")) { ?>
		                                <a href="javascript:void(0)" id="print" title="Print">
		                                    <img width="24px" height="24px" src="<?php echo base_url('assets/images/icons/prints.png') ?>"/>
		                                </a>
		                            <?php } ?>
		                        </span>
		        </div>
		    </div>
		</div>
	</div>
    <div class="row">
    	<div class="col-sm-12">
        	<div class="col-sm-6">
            	<label class="control-label"><?php echo $this->lang->line("from_date")?></label>
                <input type="text" name="from_date" id="from_date" class="form-control input-xs" value="<?php echo $this->green->gdate_format();?>"  required data-parsley-required-message="Enter date to search">
            </div>
            <div class="col-sm-6">
            	<label class="control-label"><?php echo $this->lang->line("to_date")?></label>
                <input type="text" name="to_date" id="to_date" class="form-control input-xs " value="<?php echo $this->green->gdate_format();?>"  required data-parsley-required-message="Enter date to search">            	
            </div>            
       </div>
       <div class="col-sm-12">
            <div class="col-sm-6">
            	<label class="control-label"><?php echo $this->lang->line("country")?></label>
                <select type="text" name="country" id="country" class="form-control input-xs" style="font-size:12px;" >
                <?php 
	                $select_country = $this->db->query("SELECT DISTINCT tc.country, c.`name` FROM countries AS c INNER JOIN tran_application AS tc ON c.id_countries = tc.country")->result();
					$option_country = '<option value=""></option>';
					foreach($select_country as $row_country){
						$option_country.='<option value="'.$row_country->country.'">'.$row_country->name.'</option>';
					}
	                echo $option_country
                ?>
                </select>
            </div>
            <div class="col-sm-6">
            	<label class="control-label"><?php echo $this->lang->line("nationality")?></label>
                <input type="text" name="nationality" id="nationality" class="form-control input-xs">
            </div>
    	</div>     
	    <div class="col-sm-12">
	            <div class="col-sm-6">
	            	<label class="control-label"><?php echo $this->lang->line("park")?></label>
	                <select type="text" name="park[]" id="park" multiple class="form-control input-xs" style="font-size:12px;">                
	                <?php
						echo $this->green->user_access_park(1);
	                ?>
	                </select>
	            </div>
	            <div class="col-sm-6">
	            	<label class="control-label"><?php echo $this->lang->line("report type")?></label>
	            	<select type="text" name="report_type" id="report_type" class="form-control input-xs" style="font-size:12px;">                
	                	<option value="1"><?php echo $this->lang->line("summary")?></option>
	                	<option value="0"><?php echo $this->lang->line("detail")?></option>
	                </select> 	                  
	            </div>
	     </div>
    	<div class="col-sm-12">
            <div class="col-sm-6">
            	<label class="control-label"><?php echo $this->lang->line("sort by")?></label>
                <select type="text" name="sort_by" id="sort_by" class="form-control input-xs" style="font-size:12px;">                
                	<option value="country"><?php echo $this->lang->line("country")?></option>
                </select>
            </div>
            <div class="col-sm-6">
            	<label class="control-label"><?php echo $this->lang->line("sort type")?></label>
            	<select type="text" name="sort_type" id="sort_type" class="form-control input-xs" style="font-size:12px;">                
                	<option value="ASC">A-Z</option>
                	<option value="DESC">Z-A</option>
                </select>    
            </div>
     	</div>
    </div>
    
    <div class="row">
    	<div class="col-sm-12">
    		<div class="col-sm-4">&nbsp;</div>
            <div class="col-sm-4" style="padding:10px; text-align:center;">
                <input type="button" name="search" id="search" class="btn btn-primary" value="<?php echo $this->lang->line("search")?>" />
               <!--  <input type="button" name="clear" id="clear" class="btn btn-warning" value="CLEAR" /> 
                <input type="button" name="export" id="export" class="btn btn-warning" value="EXPORT" />
                <input type="button" name="print" id="print" class="btn btn-warning" value="PRINT" />-->
            </div>
			<div class="col-sm-4">&nbsp;</div>
        </div>
    </div>
</from>
    <div class="row">
    	<div  class="table-responsive">
    		
            <div class="col-sm-12" id="dv-print">

	            <div class="col-sm-12">
		    		<div class="col-sm-1">&nbsp;</div>
		            <div class="col-sm-10" id="distital" style="padding:10px; text-align:center;"></div>		            
		            
					<div class="col-sm-1">&nbsp;</div>
	        	</div>
	        	<div class="col-sm-12">
		    		<div class="col-sm-2">&nbsp;</div>
		            <div class="col-sm-8" style="padding:10px; text-align:center;">
		            <strong class="displayDate">
		            	<span class="show_f_date"></span>	            
		            	<span class="show_t_date"></span>
		            </strong>
		            </div>
					<div class="col-sm-2">&nbsp;</div>
	        	</div>
                <table class="table table-condensed" id="tbl_content">
                	<thead>
                    	<tr>
                        	<th><?php echo $this->lang->line("no")?></th>
                            <th style="text-align:center;"><?php echo $this->lang->line("country")?></th>
                            <th style="text-align:center;"><?php echo $this->lang->line("total ticket")?></th>
                            <th style="text-align:center;"><?php echo $this->lang->line("amount")?></th>
                            <th style="text-align:center;"><?php echo $this->lang->line("rate")?></th>
                        </tr>
                    </thead>
                    <tbody id="show_data">
                    
                    </tbody>
                </table>
            </div>
        </div>
	</div>
</div>
</body>
</html>
<script type="text/javascript">
$(function(){

	addselect();

	$("#from_date,#to_date").datepicker({
			language: 'en',			
			pick12HourFormat: true,
			forceParse: false,
			format:'<?php echo $this->green->jdate_format();?>',
			autoclose: true
	}).on('changeDate', function() {
         $('#f_save').parsley().validate();
    });

	// displayDate();

	var obj_show = new fn_proccess();
	obj_show.fn_show();

	$("#search").on("click",function(){
		if($('#f_save').parsley().validate()){
			var btn_search = new fn_proccess();
			btn_search.fn_show();
		}
	});

    $("body").delegate("a#export","click",function(){
        // $("#tbl_content_exp #show_img").remove();
        // var htmltable= document.getElementById('tbl_content_exp');
        // var html = htmltable.outerHTML;
        // window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));

        var arr_exp = fn_pr_ex().split("####");
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent(arr_exp[1]));
    });

    $("body").delegate("a#print","click",function(){
        var arr_pr = fn_pr_ex().split("####");
        gsPrint(arr_pr[0],arr_pr[1]);
    });
    $("body").delegate("#country","change",function(){
    	$.ajax({
				type:"POST",
				url :"<?= site_url('report/c_report_country_compar/cnatoinal') ?>",
				dataType:"json",
				async:false,
				data:{
					country : $(this).val(),
				},
				success:function(data){
					$("#nationality").val(data.opt_national);
				}
		});
    });
   
});
function addselect(){
	$("#park").find("option").attr("selected",true);
}
function displayDate(){ 
	var fd= $("#from_date").val();
	var td= $("#to_date").val();
	$(".show_f_date").html("From Date: "+fd);	
	$(".show_t_date").html("To Date: "+td);

}
function fn_proccess(){
	var park  = $("#park").val();
	var country    = $("#country").val();
	var nationality = $("#nationality").val();
	var report_type = $("#report_type").val();
	var sort_by  = $("#sort_by").val(); 
	var sort_type  = $("#sort_type").val();
	var from_date    = $("#from_date").val();
	var to_date      = $("#to_date").val();
	this.fn_show = function fn_show(){
		$.ajax({
				type:"POST",
				url :"<?= site_url("report/c_report_country_compar/cshowcountry") ?>",
				dataType:"json",
				async:false,
				data:{
					showTbl   : 1, 
					park   : park,
					country : country,
					nationality   : nationality,
					report_type : report_type,
					sort_by    : sort_by,
					sort_type    : sort_type,
					from_date      : from_date,
					to_date        : to_date
				},
				success:function(data){
					$("#show_data").html(data['tbl']);
                    //$("#show_data_exp").html(data['tbl']);
				}
		});
	}  
	//displayDate(); 
}
function fn_pr_ex(){
        $(".remove_inv").removeAttr("href");
        var htmlToPrint = ''+'<style type="text/css">' +
                                'table th, table td {' +
                                'border:1px solid #000 !important;' +
                                'padding;0.5em;' +
                                '}' +
                                '</style>';
        var disdate ="";
        var title   = "";
        //var s_adr   = "Title</div>";
        //    title+=s_adr;
        title += $("#distital").html("<h4 align='center'>Comparison Country Report</h4>");
       // disdate +=displayDate();
        var data = $("#dv-print").html().replace(/<img[^>]*>/gi,"");
        var export_data = $("<center>"+data+"</center>").clone().find(".remove_tag").remove().end().html();
        //export_data+=htmlToPrint;
        return title+"####"+export_data;
}
</script>