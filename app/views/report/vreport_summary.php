<html>
<title>Report Summary</title>
<head>

</head>
<body>
<div class="contain">
	<div class="row result_info">
    	<div class="col-sm-9" style="text-align:left;"><?php echo $this->lang->line("search_cust")?></div>
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
                <input type="text" name="cust_code" id="cust_code" class="form-control input-xs">
               <!--  <input type="hidden" name="h_cust_code" id="h_cust_code" class="form-control input-xs h_cust_code"> -->               
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
				echo $option_dis;
				?>
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
                <input type="button" name="export" id="export" class="btn btn-warning" value="EXPORT" /> -->
            </div>
        </div>
    </div>
    <div class="row">
    	<div  class="table-responsive">
            <div class="col-sm-12"  id="div_export">
                <table class="table table-condensed" id="showTable">
                	<thead>
                    	<tr>
                        	<th><?php echo $this->lang->line("No")?></th>
                            <th><?php echo $this->lang->line("customer")?></th>
                            <th><?php echo $this->lang->line("date")?></th>
                            <th><?php echo $this->lang->line("invoice")?></th>
                            <th><?php echo $this->lang->line("service_type")?></th>
                            <th><?php echo $this->lang->line("amount")?></th>
                            <th style="text-align:center;" class="remove_tag"><?php echo $this->lang->line("action")?></th>
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

    $(document).on('click','#a_delete',function(){ 
        var attr_typeno = $(this).attr('delete');
        var obj_delete = new fn_proccess();
        obj_delete.fn_delete(attr_typeno);
        obj_delete.fn_show();
    });

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
	$("body").delegate("#a_edite","click",function(){
		
	}); 
	// $("#export").on('click',function (e) {
	// 	window.open('data:application/vnd.ms-excel,' + $('#div_print').html());
	// 	e.preventDefault();
	// });
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

    $("#cust_code").focus(function (){
        $(this).select();
        autoCust();
    });
    
});
function autoCust() {
    var url = "<?php echo site_url('report/c_report_summary/cautoCust')?>";
    $("#cust_code").autocomplete({
        source: url,
        minLength: 0,
        select: function (events, ui) {
            $('#cust_code').val(ui.item.id);
            //$('#h_cust_code').val(ui.item.cust_code);
        }
    });
}
function fn_proccess(){
	var cust_code    = $("#cust_code").val();
	var disease_code = $("#disease_code").val();
	var from_date    = $("#from_date").val();
	var to_date      = $("#to_date").val();
	this.fn_show = function fn_show(){
		$.ajax({
				type:"POST",
				url :"<?= site_url("report/c_report_summary/showTbl") ?>",
				dataType:"JSON",
				async:false,
				data:{
					showTbl   : 1,
					cust_code : cust_code,
					disease_code : disease_code,
					from_date : from_date,
					to_date   : to_date
				},
				success:function(data){
					$("#show_data").html(data);
				}
		});
	},
	this.fn_edite = function fn_edite(){
		$.ajax({
				type:"POST",
				url :"<?= site_url("invoice/vinvoice") ?>",
				dataType:"JSON",
				async:false,
				data:{
					showTbl   : 1,
					cust_code : cust_code,
					disease_code : disease_code
				},
				success:function(data){
					$("#show_data").html(data);
				}
		});
	}

    this.fn_delete = function fn_delete(attr_typeno){

        if(confirm('<?php echo $this->lang->line("confirm_delete")?>')){ 
        //if(confirm('Do you want to delete ?')){ 
            $.ajax({ 
                type : 'POST',
                url  : "<?= site_url("report/c_report_summary/delete_report") ?>",
                data : { 
                    attr_typeno : attr_typeno
                }
            });
        }else{ 
            return false;
        }
    }
	
}
function fn_pr_ex(){
        
        // var htmlToPrint = ''+'<style type="text/css">' +
        //                        'table th, table td {' +
        //                        'border:1px solid #000 !important;' +
        //                        'padding;0.5em;' +
        //                        '}' +
        //                        '</style>';
        $(".remove_inv").removeAttr("href");
        var title   = "<center><span style='font-weight:bold; font-size:16px;'>Report Invoice</span></center><br>";
        
        var data = $("#div_export").html().replace(/<img[^>]*>/gi,"");
        var export_data = $("<center>"+data+"</center>").clone().find(".remove_tag").remove().end().html();
        //export_data+=htmlToPrint;
        return title+"####"+export_data;
}

</script>