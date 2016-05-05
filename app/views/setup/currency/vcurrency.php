<div class="wrapper">
	<div class="col-sm-12">
    	<div class="row result_info">
        	<div class="col-sm-6"><?php echo $this->lang->line("list_currency"); ?></div>
            <div class="col-xs-6" align="right">
                <a href="javascript:void(0)" id="a_export"rch><img src="<?= base_url()."assets/images/icons/exports.png"?>" width="25"></a>
                <a href="javascript:void(0)" id="a_print"><img src="<?= base_url()."assets/images/icons/prints.png"?>" width="25"></a>
            </div>
        </div>


        <div class="modal" id="myModal_curr" role="dialog">
            <div class="modal-dialog" id="dailog_curr">
                <div class="modal-content">
                    <div class="modal-header move_modal">
                        <span class="title_modal"></span><span id="title_check"></span>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
                    </div>
                    <div class="modal-body">
                    
                        <div class="row">
                            <div class="col-sm-12">
                            <form id="form_validate">
                                <div class="form-group">
                                    <label class="control-label"><?php echo $this->lang->line("country"); ?><span style="color:red">*</span></label>
                                    <select name="select_country"  class="form-control " id="select_country" data-parsley-required="true" data-parsley-error-message="This field required !">
                                    <?php echo $select_country; ?>
                                    </select>
                                    <!-- <input type="text" id="country" class="form-control input-xs" placeholder="Enter country"/> -->
                                </div>

                                <div class="form-group ">
                                    <label class="control-label"><?php echo $this->lang->line("currency_code"); ?></label>
                                    <!-- <input type="text" id="curr_code" class="form-control input-xs edit_this" placeholder="Enter currency code" requirementType 'number'/> -->
                                    <input type="hidden" id="h_typeno" /> <input type="hidden" id="h_value_code"/>
                                    <label class="form-control input-xs" id="curr_code"></label>
                                </div>

                                <div class="form-group ">
                                    <label class="control-label"><?php echo $this->lang->line("currency_name"); ?></label>
                                    <!-- <input type="text" id="curr_name" class="form-control input-xs" placeholder="Enter currency name"/> -->
                                    <label class="form-control input-xs" id="curr_name"></label>
                                </div>

                                <div class="form-group edit_this">
                                    <label class="control-label"><?php echo $this->lang->line("exchange_rate"); ?><span style="color:red">*</span></label>
                                    <input type="text" id="exchange_rate" class="form-control input-xs edit_this " placeholder="Enter exchange rate" data-parsley-required="true" data-parsley-error-message="This field required !" />
                                </div>

                                <div class="form-group">
                                    <label class="control-label"><?php echo $this->lang->line("symbol"); ?></label>
                                    <!-- <input type="text" id="symbol" class="form-control input-xs" placeholder="Enter symbol"/> -->
                                    <label class="form-control input-xs" id="symbol"></label>
                                </div>
                            </form>   
                            </div>
                        </div>
                    
                    </div>
                    <div class="modal-footer move_modal">
                        <?php if ($this->green->gAction("C")){ ?>
                            <button type="button" id="save" class="btn btn-primary">Save</button>
                        <?php } ?>
                        <button type="button" id="cancel" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>    
</div>

<!-- end div wrap  -->

<div class="modal" id="myModal_duplicate">
    <div class="modal-dialog modal_duplicate">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title text_duplicate"><?php echo $this->lang->line('alert_curr_duplicate')?></div>
            </div>
            <div class="modal-footer">                
                <button type="button" class="btn btn-default" id="close_msg" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- <div class="modal"> -->

<div class="col-sm-12">
    <meta charset="Utf-8">
    <div class="table-responsive" id="dv-print">
    <table class="table table-condensed">
        <thead>
            <tr>
                <th class="th_table"><?php echo $this->lang->line("currency_code"); ?></th>
                <th class="th_table"><?php echo $this->lang->line("currency_name"); ?></th>
                <th class="th_table"><?php echo $this->lang->line("country"); ?></th>
                <th class="th_table"><?php echo $this->lang->line("exchange_rate"); ?></th>
                <th class="th_table"><?php echo $this->lang->line("symbol"); ?></th>
                <th class="th_table remove_tag"><?php echo $this->lang->line("Payment"); ?></th>
                <th class="th_table remove_tag"><?php echo $this->lang->line("currency_default"); ?></th>
                <th class="col-xs-1 remove_tag th_add" colspan="2" style="text-align:center;">
                    <?php if ($this->green->gAction("C")){ ?>
                        <div id="add" style="width:100%"><img src="<?= base_url('assets/images/icons/adds.png') ?>" width="25px;">
                    <?php } ?>
                </th>
            </tr>
        </thead>
        <tbody id="show_tbl">
            
        </tbody>
    </table>
    </div>
</div>
<div style="display:none" id="div-ex">
    <center>
    <span style="font-size:16px; text-align:center;">Currency List</span>
    <table border="1">
        <tr>
            <th class="th_table"><?php echo $this->lang->line("currency_code"); ?></th>
            <th class="th_table"><?php echo $this->lang->line("currency_name"); ?></th>
            <th class="th_table"><?php echo $this->lang->line("country"); ?></th>
            <th class="th_table"><?php echo $this->lang->line("exchange_rate"); ?></th>
            <th class="th_table"><?php echo $this->lang->line("symbol"); ?></th>
            <th class="th_table remove_tag"><?php echo $this->lang->line("Payment"); ?></th>
            <th class="th_table remove_tag"><?php echo $this->lang->line("currency_default"); ?></th>
            <th class="col-xs-1 remove_tag th_add" style="text-align:center;">
                <div id="add" style="width:100%"><img src="<?= base_url('assets/images/icons/adds.png') ?>" width="25px;">
            </th>
        </tr>
        </thead>
        <tbody id="show_tbl_ex">
            
        </tbody>
    </table>
    </center>
</div>

<style type="text/css">
    .modal_duplicate{ top: 25%}
    .title_modal{ color : #337ab7; text-align : left; font-size: 18px}
    .text_duplicate{ color: red; font-size: 16px; text-align: center;}
    .th_table{ color: #337ab7; }
    #title_check{ color : red ; font-size : 16px ; padding-left : 5%;}
    .th_add:hover{ box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(102, 175, 233, 0.6); border-color: #66afe9; cursor: pointer;}
</style>
<script type="text/javascript">

	$(function(){

        $('#a_export').tooltip({title : 'Export'});
        $('#a_print').tooltip({title : 'Print'});
        $('#add').tooltip({title : 'Add New', placement : 'left'});
        $('body').delegate('','mouseover',function(){ 
            $('.a_edit').tooltip({title : 'Edit', placement : 'left'});
            $('.a_delete').tooltip({title : 'Delete'});
        });
		var obj_show = new process_currency();
		obj_show.show_currency();
       
        $('#add').click(function(){ 
            // $('#curr_code').attr('readonly',false);
            // $('#curr_name').attr('readonly',false);
            // $('#symbol').attr('readonly',false);
            
            // $('.edit_this').removeAttr('readonly');
            // $('.a_r_class').addClass('keyup_ex');
            $('#form_validate').parsley().destroy();
            var obj_add = new process_currency();
            obj_add.clear_textbox();
            $('#myModal_curr').modal({ backdrop : 'static'});
            $('#dailog_curr').draggable({ handla : '.move_modal'});
            $('.title_modal').html("Create currency");
            
        });

        $('#save').click(function(){
            var obj_save = new process_currency();
            if($('#form_validate').parsley().validate()){
                obj_save.save_currency();
            }
        });
        
        $('#select_country').change(function(){
            var obj_change = new process_currency();
            obj_change.change_country($(this).val());
        });

        $('body').delegate('#a_edit','click',function(){ 
            var obj_edit = new process_currency();
            obj_edit.edit_currency($(this).attr('cur_typeno'));
            $('#save').val('<?php echo $this->lang->line("update"); ?>');
        });

        $('body').delegate('#a_delete','click',function(){ 
            modal_delete($(this).attr('cur_typeno'));
        });

        $('body').delegate('#btn_delete','click',function(){ 
            var obj_delete = new process_currency();
            obj_delete.delete_currency($(this).attr('attr'));            
        });

        $('body').delegate('input:checkbox.radio','click',function() {
            var box = $(this);
            if (box.is(":checked")) {
                var group = $("input:checkbox[name='" + box.attr("name") + "']");     
                $(group).prop("checked", false);
                box.prop("checked", true);
                // alert($(this).attr('cur_typeno'));
                // alert($(this).val());
                var obj_curr = new process_currency();
                obj_curr.ch_currency($(this).attr('cur_typeno'),1);             
            }
        });

        $('body').delegate('.checkbox_fc','change',function(){ 
            var cur_typeno = $(this).attr('cur_typeno');
            var obj_curr = new process_currency();
            var value_ch = 0;
            if($(this).is(":checked") == false){ 
                value_ch = 0;
            }else if($(this).is(":checked") == true){ 
                value_ch = 1;
            }
            obj_curr.ch_curr_payment(cur_typeno,value_ch);
        }); 

        $(document).on('click','#clear',function(){ 
            var obj_clear = new process_currency();
            obj_clear.clear_textbox();
        });

        $(document).on('keyup','#exchange_rate',function(e){ 
            input_exchange_rate(e);
        });

        $("body").delegate("#a_print","click",function(){
            $('#span_p2').removeClass();
            $('#span_p').removeClass();
            var arr_pr = fn_print().split("####");
            gsPrint(arr_pr[0],arr_pr[1]);
        });

        $("body").delegate("#a_export","click",function(){
            var arr_exp = fn_ex().split("####");
            window.open('data:application/vnd.ms-excel,' + encodeURIComponent(arr_exp[1]));
            
        });       
        
	});

	function process_currency(){
        this.h_typeno  = $('#h_typeno').val();
        this.h_value_code = $('#h_value_code').val();
        this.curr_code = $('#curr_code').text();
        this.curr_name = $('#curr_name').text();
        this.country   = $('#select_country').val();       
        this.exchange_rate = $('#exchange_rate').val();
        this.symbol    = $('#symbol').text();
        
        var data_curr = { 
            'curr_code' : this.curr_code,
            'curr_name' : this.curr_name,
            'country'   : this.country,
            'exchange_rate' : this.exchange_rate,
            'symbol'    : this.symbol
        }

        this.change_country = function change_country(country_id){ 
            $.ajax({ 
                type : 'POST',
                url  : "<?= site_url('setup/ccurrency/change_country')?>",
                dataType : "JSON",
                async : false,
                data : { 
                    country_id : country_id    
                },
                success :function(data){ 
                    //console.log(data);
                    // $('#curr_code').attr('readonly',true);
                    // $('#curr_name').attr('readonly',true);
                    // $('#symbol').attr('readonly',true);
                    $('#curr_code').text(data[0]['currency_code']);
                    $('#curr_name').text(data[0]['currency_name']);
                    $('#symbol').text(data[0]['currrency_symbol']);
                    $('#exchange_rate').val('').focus();
                }
            });
        }

        this.save_currency = function save_curr(){
            var success = '';
            var value_code = '';
            $.ajax({ 
                type : 'POST',
                url  : "<?= site_url('setup/ccurrency/save_curr')?>",
                dataType:'json',
                async : false,
                data : { 
                    data_curr : data_curr,
                    h_typeno    : this.h_typeno,
                    h_value_code : this.h_value_code
                },
                success:function(data){ 
                    success = data.success;
                    // value_code = data.value_code;
                }
            });
            if(success == "true"){
                $('#myModal_curr').modal('hide');
                
                this.show_currency();
                this.clear_textbox();
            }else{
                $('#myModal_duplicate').modal({'backdrop' : false});
            }  
        }

        this.edit_currency = function edit_curr(cur_typeno){

            $.ajax({ 
                type : 'POST',
                url  : "<?= site_url('setup/ccurrency/edit_curr')?>",
                dataType:"json",
                async:false,
                data : { 
                    cur_typeno : cur_typeno
                },
                success:function(data){
                    //console.log(data);
                    // if(data.curcode == "USD"){ 
                    //     $('.edit_this').attr('readonly',true);
                    //     $('.a_r_class').removeClass('keyup_ex');
                    // }else{ 
                    //     $('.edit_this').removeAttr('readonly');
                    //     $('.a_r_class').addClass('keyup_ex');
                    // }

                    // $('#curr_code').attr('readonly',true);
                    // $('#curr_name').attr('readonly',true);
                    // $('#symbol').attr('readonly',true);

                    $('#h_typeno').val(data.cur_typeno);
                    $('#h_value_code').val(data.curcode);
                    $('#curr_code').text(data.curcode);
                    $('#curr_name').text(data.currencyname);
                    $('#select_country').val(data.country);
                    $('#exchange_rate').val(data.rate);
                    $('#symbol').text(data.symbol);
                    $('#myModal_curr').modal({ backdrop : 'static'});
                   
                    $('.title_modal').html('Edit currency');
                }
            });
        }

		this.show_currency = function show_curr(){ 
			$.ajax({ 
				type : 'POST',
				url  : "<?= site_url('setup/ccurrency/show_curr')?>",
                dataType:"json",
                async:false,
				data : { 
					show : 1
				},
				success:function(data){ 
                    //console.log(data);
                    if(data.length > 0){ 
                        var tr = '';
                        var td_action = '';
                        var td_ch = ''; 
                        $.each(data,function(i,row){
                            var ch = "";
                            if(row.reciept_payment == 0){ 
                                ch = "";
                            }else{ 
                                ch = "checked='checked'";
                            }

                            if(row.cur_default == 1){ 
                                ch_def = "checked='checked'";
                                td_ch = "<td class='remove_tag' style='color:blue'>Functional</td>";
                                td_action = '<td align="center" class="remove_tag" >'+
                                                '<a href="javascript:void(0)" id="a_edit" class="a_edit" cur_typeno='+row.cur_typeno+' style="padding-right:48%"><img rel="2510" height="15" width="15" src="<?= base_url("/assets/images/icons/edit.png")?>"></a> &nbsp; &nbsp;'+
                                                
                                            '</td>';
                            }else{
                                ch_def = "";
                                td_ch = '<td class="remove_tag"><input type="checkbox" class="checkbox_fc" '+ch+' cur_typeno='+(row.cur_typeno)+'></td>';
                                    
                                td_action = '<td align="center" class="remove_tag">'+
                                                '<a href="javascript:void(0)" id="a_edit" class="a_edit" cur_typeno='+row.cur_typeno+'><img rel="2510" height="15" width="15" src="<?= base_url("/assets/images/icons/edit.png")?>"></a> &nbsp; &nbsp;'+
                                                '&nbsp; &nbsp; <a href="javascript:void(0)" class="a_delete" id="a_delete" cur_typeno='+row.cur_typeno+'><img rel="2510" src="<?= base_url("/assets/images/icons/delete.png")?>"></a>'+
                                            '</td>';
                            }

                            td_ch_def = '<td class="remove_tag"><input type="checkbox" class="radio" value="1" cur_typeno='+(row.cur_typeno)+' '+ch_def+' name="fooby[1][]" /></td>';  
                            
                            tr += '<tr>'+
                                    '<td>'+(row.curcode != null ? row.curcode :'')+'</td>'+
                                    '<td>'+(row.currencyname != null ? row.currencyname :'')+'</td>'+
                                    '<td>'+(row.name != null ? row.name :'')+'</td>'+                                    
                                    '<td>'+(row.rate != null ? row.rate :'')+'</td>'+
                                    '<td>'+(row.symbol != null ? row.symbol :'')+'</td>'+td_ch+td_ch_def+td_action+
                                '</tr>';
                        });

                    }else{ 
                        tr += '<tr>'+
                                '<td colspan="8" style="color:red;text-align:center;font-size:16px;"><i>Not have currency</i></td>'+
                                
                            '</tr>'+
                            '<tr><td colspan="8"></td></tr>';
                    }
                        $('#show_tbl').html(tr);
                        $('#show_tbl_ex').html(tr);
				}
			});
		}

        this.delete_currency = function delete_curr(cur_typeno){
            var success = "";
            $.ajax({ 
                type : 'POST',
                url  : "<?= site_url('setup/ccurrency/delete_curr')?>",
                dataType : "json",
                async : false,
                data : { 
                    cur_typeno : cur_typeno
                },
                success:function(data){ 
                    success = data.success;
                },
            });

            if(success == "true"){ 
                this.show_currency();
            }
        }

        this.ch_currency = function ch_curr(cur_typeno,value_ch){
            
            $.ajax({ 
                type : 'POST',
                url  : "<?= site_url('setup/ccurrency/ch_curr')?>",
                data : { 
                    cur_typeno : cur_typeno,
                    value_ch  : value_ch
                },
                success:function(){ 
                    var show = new process_currency();
                    show.show_currency();
                }
            });
        }

        this.ch_curr_payment = function ch_curr_payment(cur_typeno,value_ch){
            
            $.ajax({ 
                type : 'POST',
                url  : "<?= site_url('setup/ccurrency/ch_curr_payment')?>",
                data : { 
                    cur_typeno : cur_typeno,
                    value_ch  : value_ch
                },
                success:function(){ 
                    var show = new process_currency();
                    show.show_currency();
                }
            });
        }

        this.clear_textbox = function clear(){ 
            $('#h_typeno').val('');
            $('#h_value_code').val('');
            $('#curr_code').text('');
            $('#curr_name').text('');
            $('#select_country').val('').select();
            $('#exchange_rate').val('');
            $('#symbol').text('');
        }
	}

    function input_exchange_rate(e){
     
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
            // alert('<?php echo $this->lang->line("pl_input_num")?>');
            $('#exchange_rate').val('');
        }
    }

    function fn_print(){
        $(".remove_inv").removeAttr("href");
        var title   = "<center><span style='font-weight:bold; font-size:16px;'>Currency List</span></center><br>";
       
        var data = $("#dv-print").html().replace(/<img[^>]*>/gi,"");
        var export_data = $("<center>"+data+"</center>").clone().find(".remove_tag").remove().end().html();
        //export_data+=htmlToPrint;
        return title+"####"+export_data;
    }

    function fn_ex(){
        $(".remove_inv").removeAttr("href");
        var title   = "<center><span style='font-weight:bold; font-size:16px;'>currency List</span></center><br>";
       
        var data = $("#div-ex").html().replace(/<img[^>]*>/gi,"");
        var export_data = $("<center>"+data+"</center>").clone().find(".remove_tag").remove().end().html();
        //export_data+=htmlToPrint;
        return title+"####"+export_data;
    }


</script> 
