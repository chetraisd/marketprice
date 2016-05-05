<html>
<title>Report Detail</title>
<head>

</head>
<body>
<div class="contain">
	<div class="row result_info">
    	<div class="col-sm-9" style="text-align:left;"><?php echo $this->lang->line("title_search")?></div>
        <div class="col-xs-3" style="text-align: right">
                        
                        <span class="top_action_button">
                            <?php if ($this->green->gAction("E")) { ?>
                                <a href="#" id="export" title="Export">
                                    <img id='export1' src="<?php echo base_url('assets/images/icons/export.png') ?>"/>
                                </a>
                            <?php } ?>
                        </span>
                        <span class="top_action_button">
                            <?php if ($this->green->gAction("P")) { ?>
                                <a href="#" id="print" title="Print">
                                    <img src="<?php echo base_url('assets/images/icons/print.png') ?>"/>
                                </a>
                            <?php } ?>
                        </span>
        </div>
    </div>
    <div class="row">
    	<div class="col-sm-12">
        	<div class="col-sm-6">
            	<label class="control-label"><?php echo $this->lang->line("customer")?></label>
                <input type="text" name="cust_code" id="cust_code" class="form-control input-xs cust_code">
                <input type="hidden" name="h_cust_code" id="h_cust_code" class="form-control input-xs h_cust_code">
            </div>
            <div class="col-sm-6">
            	<label class="control-label"><?php echo $this->lang->line("service_type")?></label>
                <select type="text" name="disease_code" id="disease_code" class="form-control input-xs" style="font-size:12px;">
                <?php 
                $select_dis = $this->db->query("SELECT disease_code,disease_name FROM tbl_disease_type")->result();
				$option_dis = '<option value=""></option>';
				foreach($select_dis as $row_dis){
					$option_dis.='<option value="'.$row_dis->disease_code.'">'.$row_dis->disease_name.'</option>';
				}
                echo $option_dis 
                ?>
                </select>
            </div>
       </div>
       <div class="col-sm-12">
            <div class="col-sm-6">
            	<label class="control-label"><?php echo $this->lang->line("invoice_number")?></label>
                <input type="text" name="invoice_number" id="invoice_number" class="form-control input-xs">
            </div>
            <div class="col-sm-6">
            	<label class="control-label"><?php echo $this->lang->line("service")?></label>
                <select name="serviceType" id="serviceType" class="form-control input-xs"  style="font-size:12px;">
               
                </select>
            </div>
     </div>
     <div class="col-sm-12">
            <div class="col-sm-6">
            	<label class="control-label"><?php echo $this->lang->line("from_date")?></label>
                <input type="text" name="from_date" id="from_date" class="form-control input-xs" value="<?php echo date("d/m/Y");?>">
            </div>
            <div class="col-sm-6">
            	<label class="control-label"><?php echo $this->lang->line("to_date")?></label>
                <input type="text" name="to_date" id="to_date" class="form-control input-xs" value="<?php echo date("d/m/Y");?>">
            </div>
        </div>
    </div>
    <br />
    <div class="row">
    	<div class="col-sm-12">
            <div class="col-sm-12">
                <input type="button" name="search" id="search" class="btn btn-primary" value="<?php echo $this->lang->line("search")?>" />
               <!--  <input type="button" name="clear" id="clear" class="btn btn-warning" value="CLEAR" /> 
                <input type="button" name="export" id="export" class="btn btn-warning" value="EXPORT" />
                <input type="button" name="print" id="print" class="btn btn-warning" value="PRINT" />-->
            </div>
        </div>
    </div>
    <div class="row">
    	<div  class="table-responsive">
            <div class="col-sm-12" id="dv-print">
                <table class="table table-condensed" id="tbl_content">
                	<thead>
                    	<tr>
                        	<th><?php echo $this->lang->line("no")?></th>
                            <th style="text-align:center;"><?php echo $this->lang->line("customer")?></th>
                            <th style="text-align:center;"><?php echo $this->lang->line("date")?></th>
                            <th style="text-align:center;"><?php echo $this->lang->line("service_type")?></th>
                            <th style="text-align:center;"><?php echo $this->lang->line("service")?></th>
                            <th style="text-align:center;"><?php echo $this->lang->line("quantity")?></th>
                            <th style="text-align:center;"><?php echo $this->lang->line("amount_paid")?></th>
                            <th style="text-align:center;" class='remove_tag'><?php echo $this->lang->line("action")?></th>
                        </tr>
                    </thead>
                    <tbody id="show_data">
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- <table class="table table-condensed" id="tbl_content_exp" style="display:none;" border="1">
    <thead>
        <tr>
            <th style="background:#CCCCE0;">No</th>
            <th style="text-align:center;background:#CCCCE0;">Customer</th>
            <th style="text-align:center;background:#CCCCE0;">Date</th>
            <th style="text-align:center;background:#CCCCE0;">Service type</th>
            <th style="text-align:center;background:#CCCCE0;">Service</th>
            <th style="text-align:center;background:#CCCCE0;">Quantity</th>
            <th style="text-align:center;background:#CCCCE0;">Amount paid</th>
        </tr>
    </thead>
    <tbody id="show_data_exp"></tbody>
</table>          -->
</body>
</html>
<script type="text/javascript">
$(function(){
	$("#from_date,#to_date").datepicker({
			language: 'en',
			pick12HourFormat: true,
			format:'dd/mm/yyyy'
	});
	var obj_show = new fn_proccess();
	obj_show.fn_show();
	$("#search").on("click",function(){
		var btn_search = new fn_proccess();
		btn_search.fn_show();
	});
	$("#clear").on("click",function(){
		$("#cust_code").val("");
		$("#disease_code").val("");
		$("#invoice_number").val("");
		$("#serviceType").val("");
		$("#search_date").val("");
		$("#from_date").val("");
		$("#to_date").val("");
	});
    $("body").delegate("a#a_delete","click",function(){
        var att_type   = $(this).attr("att_type");
        var att_typeno = $(this).attr("att_typeno");
        var conf = confirm("<?php echo $this->lang->line('confirm_delete')?>");
        // var conf = confirm("Do you want to delete this record ?");
        var obj_delete = new fn_proccess();
        if(conf == true){
            obj_delete.delete_inv(att_type,att_typeno);
            obj_delete.fn_show();
        }else{
            //obj_delete.fn_show();
            return false;
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
    $("body").delegate("#disease_code","change",function(){
    	$.ajax({
				type:"POST",
				url :"<?= site_url('report/C_report_detail/cservice') ?>",
				dataType:"json",
				async:false,
				data:{
					desease_type : $(this).val(),
				},
				success:function(data){
					$("#serviceType").html(data.opt_service);
				}
		});
    })

    $("body").delegate("#cust_code","keyup",function(){
        var cust_code = $(this).val();
        if(cust_code == ""){
            $('#h_cust_code').val("");
        }
    });
    $("#cust_code").focus(function (){
        $(this).select();
        autoCust();
    });

});
 function autoCust() {
    var url = "<?php echo site_url('report/c_report_detail/cautoCust')?>";
    $("#cust_code").autocomplete({
        source: url,
        minLength: 0,
        select: function (events, ui) {
            $('#cust_code').val(ui.item.id);
            $('#h_cust_code').val(ui.item.cust_code);
        }
    });
}
function fn_proccess(){
	var cust_code    = $("#h_cust_code").val();
	var disease_code = $("#disease_code").val();
	var invoice_number = $("#invoice_number").val();
	var serviceType  = $("#serviceType").val();
	var from_date    = $("#from_date").val();
	var to_date      = $("#to_date").val();
	this.fn_show = function fn_show(){
		$.ajax({
				type:"POST",
				url :"<?= site_url("report/C_report_detail/cshowData") ?>",
				dataType:"json",
				async:false,
				data:{
					showTbl   : 1,
					cust_code : cust_code,
					disease_code   : disease_code,
					invoice_number : invoice_number,
					serviceType    : serviceType,
					from_date      : from_date,
					to_date        : to_date
				},
				success:function(data){
					$("#show_data").html(data['tbl']);
                    //$("#show_data_exp").html(data['tbl']);
				}
		});
	},
    this.delete_inv = function delete_inv(type,typeno){
        $.ajax({
                type    : "POST",
                url     : "<?= site_url("report/C_report_detail/cdelete_inv") ?>",
                dataType:"JSON",
                async:false,
                data:{
                    para_delete  : 1,
                    type         : type,
                    typeno       : typeno
                },
                success:function(data){
                    //$("#show_data").html(data);
                }
        });
    }
}
function fn_pr_ex(){
        $(".remove_inv").removeAttr("href");
        // var htmlToPrint = ''+'<style type="text/css">' +
        //                        'table th, table td {' +
        //                        'border:1px solid #000 !important;' +
        //                        'padding;0.5em;' +
        //                        '}' +
        //                        '</style>';
        var title   = "<center><span style='font-weight:bold; font-size:16px;'>Report Invoice</span></center><br>";
        //var s_adr   = "Title</div>";
        //    title+=s_adr;
        //title +="<h4 align='center'>Invoice</h4>"; 
        var data = $("#dv-print").html().replace(/<img[^>]*>/gi,"");
        var export_data = $("<center>"+data+"</center>").clone().find(".remove_tag").remove().end().html();
        //export_data+=htmlToPrint;
        return title+"####"+export_data;
}
</script>