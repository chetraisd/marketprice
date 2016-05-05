<!DOCTYPE html>
<div class="wrapper">
	<div class="col-sm-12">
    	<div class="row result_info">
        	<div class="col-xs-6"><?php echo $this->lang->line('paymet_type_list')?></div>
       		<div class="col-xs-6" align="right">
                <?php if($this->green->gAction("R")){ ?>
                    <a href="javascript:void(0)" id="a_search" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><img src="<?= base_url()."assets/images/icons/searchs.png"?>" width="25"></a>
                <?php } ?>
                <?php if($this->green->gAction("E")){ ?>
                    <a href="javascript:void(0)" id="a_export"rch><img src="<?= base_url()."assets/images/icons/exports.png"?>" width="25"></a>
                <?php } ?>
                <?php if($this->green->gAction("P")){ ?>
                    <a href="javascript:void(0)" id="a_print"><img src="<?= base_url()."assets/images/icons/prints.png"?>" width="25"></a>
                <?php } ?>
            </div>
        </div>
        <div class="row collapse" id="collapseExample">
        	<div class="col-sm-12">
             	<div class="col-sm-4">
                    <label class="control-label">&nbsp;</label>
                    <input type="text" placeholder="Search payment type" id="sch_pt_name" class="form-control input-xs" />
                </div>
                <div class="col-sm-4">
                    <label class="control-label">&nbsp;</label>                        
                    <input type="text" placeholder="Search description" id="sch_pt_description" class="form-control input-xs" />
                </div>
                <div class="col-sm-4">
                    <label class="control-label">&nbsp;</label>
                    <div class="input-xs">
                        <button type="button" id="search" class="btn btn-primary">Search</button>
                        <button type="button" id="refresh" class="btn btn-warning">Refresh</button>
                    </div>
                </div>
            </div>
    	</div>
        <br>

        <div class="table-responsive" id="dv-print">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th class="col-xs-1 th_no"><?php echo $this->lang->line('No')?></th>
                        <th class="col-xs-3 sort_data" ftbl="payment_name" order="DESC" id="sort_pay">
                            <span id="sp_pn"><?php echo $this->lang->line('paymet_type_name')?></span> <span style="padding-left:10%"></span><span id="span_p" class="glyphicon glyphicon-menu-down"></span>
                        </th>
                        <th class="col-xs-4 sort_data" ftbl="description" order="DESC" class="sort_data" id="sort_des">
                            <?php echo $this->lang->line('description')?> <span style="padding-left:10%"></span><span id="span_p2">
                        </th>
                        <th class="col-xs-1 remove_tag th_add" style="text-align:center;">
                            <?php if($this->green->gAction("C")){ ?>
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
    <div class="col-sm-1">   
        <select id="total_display" class="form-control" style="width: 80px; height:29px;">
           <option value="5">5</option>
           <option value="10" selected="selected">10</option>
           <option value="50">50</option>
           <option value="100">100</option>
           <option value="500">500</option>
           <option value="1000">1000</option>
        </select>
    </div>
    <div class="col-sm-6">
        <ul class="pagination pagination-sm" id="pagination-grid" style="display: inline;"></ul><input type="hidden" id="hd_order" value="ASC"><input type="hidden" id="hd_ftbl" value="payment_name">
    </div>		
</div>

<!-- modal  -->

<div class="modal" id="myModal_payment_type" role="dialog">
    <div class="modal-dialog" id="dialog_payment_type">
        <div class="modal-content">
        <form id="form_validate">
            <div class="modal-header  move_modal" >
                <span id="title_modal"></span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>            
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group infor_">
                            <label class="control-label"><?php echo $this->lang->line('paymet_type_name')?><span style="color:red">*</span></label>
                            <input type="text" id="pt_name" class="form-control input-xs" placeholder="Enter payment type name" data-parsley-required="true" data-parsley-error-message="This field required !"/>
                            <input type="hidden" id="h_typeno" /><input type="hidden" id="h_pn">
                        </div>

                        <div class="form-group infor_">
                            <label class="control-label"><?php echo $this->lang->line('description')?></label>
                            <textarea class="form-control" rows="5" id="pt_description" placeholder="Enter description"> </textarea>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="modal-footer move_modal">
                <?php if ($this->green->gAction("C")){ ?>
                    <button type="button" id="save" class="btn btn-primary save_payment_type">Save</button>
                    <button type="button" class="btn btn-primary save_payment_type" saveclose="close">Save Close</button>
                <?php } ?>
                <button type="button" id="cancel" class="btn btn-warning" data-dismiss="modal">Cancel</button>
            </div>
        </div>
        </form>
    </div>
</div>
<!--  -->
<div class="modal" id="myModal_duplicate">
    <div class="modal-dialog modal_duplicate">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title text_duplicate"><?php echo $this->lang->line('alert_duplicate')?></div>
            </div>
            <div class="modal-footer">                
                <button type="button" class="btn btn-default" id="close_msg" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- -->
<div id="div-ex" style="display:none">
    <center>
    <span>Payment Type List</span>
    <table border="1" width="100%">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('No')?></th>
                <th><?php echo $this->lang->line('paymet_type_name')?></th>
                <th><?php echo $this->lang->line('description')?></th> 
                <th class="remove_tag"></th>
            </tr>
        </thead>
        <tbody id="show_tbl_ex">
            
        </tbody>
    </table>
    </center>
</div>

<!--  -->
<style type="text/css">
    .modal_duplicate{top: 15%}
    .text_duplicate{ color: red; font-size: 16px; text-align: center;}
    .sort_data{ color: #337ab7;}
    .sort_data:hover{ 
        /*box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(102, 175, 233, 0.6); */
        border-color: #66afe9; border-radius: 5px; cursor: pointer; color: #337ab7;
    }
    .th_no{  color: #337ab7; }
    .th_add:hover{ box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(102, 175, 233, 0.6); border-color: #66afe9; cursor: pointer;}
    #title_modal{ font-size: 18px; text-align: left; color: #337ab7;}
    #title_check{ font-size: 16px; text-align: center; color: red; }
</style>

<script type="text/javascript"> 
    $(function(){
        $('#add').tooltip({title : 'Add New', placement: 'top'});
        $('#a_search').tooltip({title : 'hide/show form search', placement: 'left'});
        $('#a_export').tooltip({title : 'Export', placement: 'top'});
        $('#a_print').tooltip({title : 'Print', placement: 'top'});
        $('#search').tooltip({title : 'Search'});
        $('#refresh').tooltip({title : 'Refresh'});
        $('body').delegate('','mouseover',function(){ 
            $('.a_edit').tooltip({title : 'Edit', placement: 'top'});
            $('.a_delete').tooltip({title : 'Delete', placement: 'top'});
            $('#total_display').tooltip({title : 'Display Limit', placement: 'top'});    
        });
       
        var obj_show = new pro_payment_type();
        obj_show.show_payment_type($('#hd_ftbl').val(),$('#hd_order').val(),1,$('#total_display').val()-0);

        $('#add').click(function(){
            $('#form_validate').parsley().destroy();
            clear_all();
            var obj_modal = new pro_payment_type();
            obj_modal.clear_textbox(); 
            $('#myModal_payment_type').modal({backdrop : 'static'});
            $('#title_modal').html('Create payment type');
            $('#dialog_payment_type').draggable({ handle : '.move_modal'});
            
        });

        $('.save_payment_type').click(function(){ 
            var this_save = $(this);
            var obj_save = new pro_payment_type();
            if($('#form_validate').parsley().validate()){
                obj_save.save_payment_type(this_save);  
            }
           
        });

        $('#search').click(function(){ 
            var obj_search = new pro_payment_type();           
            obj_search.show_payment_type($('#hd_ftbl').val(),$('#hd_order').val(),1,$('#total_display').val()-0);
        });

        $('#refresh').click(function(){ 
            $('#sch_pt_name').val('');
            $('#sch_pt_description').val('');
            var obj_re = new pro_payment_type();
            obj_re.show_payment_type('payment_name','ASC',1,$('#total_display').val()-0);
        });

        $('body').delegate('#a_edit','click',function(){
            $('#form_validate').parsley().destroy();
            var pay_typeno = $(this).attr('pay_typeno'); 
            var obj_edit = new pro_payment_type();
            obj_edit.edit_payment_type(pay_typeno);
        });

        $('body').delegate('#a_delete','click',function(){ 
            var pay_typeno = $(this).attr('pay_typeno');
            modal_delete(pay_typeno);
        });

        $('body').delegate('#btn_delete','click',function(){
            $('#sch_pt_name').val('');
            $('#sch_pt_description').val('');
            var obj_delete = new pro_payment_type();            
            obj_delete.delete_payment_type($(this).attr('attr'));
        });

        $('body').delegate('.sort_data','click',function(){ 
            var obj_sort = new pro_payment_type();
            obj_sort.show_payment_type($(this).attr('ftbl'),$(this).attr('order'),$('.a-pagination').attr('curr_page')-0,$('#total_display').val()-0);
            $('#hd_order').val($(this).attr('order'));
            $('#hd_ftbl').val($(this).attr('ftbl'));
            $('#span_p2').removeClass();
            $('#span_p').removeClass();

            if($(this).attr('order') == "ASC"){ 

                if($(this).attr('ftbl') == "payment_name"){ 
                    $('.sort_data').attr('order','DESC');
                    $('#span_p').addClass('glyphicon glyphicon-menu-down');
                }else{ 
                    $('.sort_data').attr('order','DESC');
                    $('#span_p2').addClass('glyphicon glyphicon-menu-down');
                }

            }else{ 

                if($(this).attr('ftbl') == "payment_name"){ 
                    $('.sort_data').attr('order','ASC');
                    $('#span_p').addClass('glyphicon glyphicon-menu-up');
                }else{ 
                    $('.sort_data').attr('order','ASC');
                    $('#span_p2').addClass('glyphicon glyphicon-menu-up');
                }
            }

        });

        $('body').delegate('.a-pagination','click',function(){ 
            var obj_pagination = new pro_payment_type();
            var curr_page = $(this).attr('curr_page')-0;           
            obj_pagination.show_payment_type($('#hd_ftbl').val(),$('#hd_order').val(),curr_page,$('#total_display').val()-0);
        });

        $('#total_display').on('change',function(){ 
            var obj_change = new pro_payment_type();
            obj_change.show_payment_type($('#hd_ftbl').val(),$('#hd_order').val(),1,$(this).val()-0);
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

        $('#pt_name').keydown(function(){ 
            if($(this).val() != ""){ 
                $('#title_check').text('');
            }
        });

    });

    function pro_payment_type(){ 
        this.sh_pt_name = $('#sch_pt_name').val();
        this.sh_pt_description = $('#sch_pt_description').val();
        this.pt_name = $('#pt_name').val();
        this.pt_description = $('#pt_description').val();
        this.h_typeno = $('#h_typeno').val();
        this.h_pn = $('#h_pn').val();
        var arr_data = { 
            'pt_name' : this.pt_name,
            'pt_description' : this.pt_description
        }

        this.save_payment_type = function save(this_save){ 
            var success = '';
            var value_n = '';
            $.ajax({ 
                type : 'POST',
                url  : "<?= site_url('setup/cpayment_type/save_payment_type')?>",
                dataType : 'json',
                async : false,
                data : { 
                    arr_data : arr_data,
                    h_typeno : this.h_typeno,
                    h_pn     : this.h_pn
                },
                success:function(data){ 
                    success = data.success;
                    value_n = data.value_n;
                }
            });
            
            if(success == "false"){
                $('#myModal_duplicate').modal({'backdrop' : false});
            }else{
                if(this_save.attr('saveclose') == "close"){ 
                    $('#myModal_payment_type').modal('hide');
                }
                this.clear_textbox();
                this.show_payment_type($('#hd_ftbl').val(),$('#hd_order').val(),1,$('#total_display').val()-0);
            }
        }

        this.show_payment_type = function show(ftbl,order,current_page,total_display){
           
            offset = ((current_page - 1) * total_display) - 0;
            limit = total_display - 0;
            $.ajax({ 
                type : 'POST',
                url  : "<?= site_url('setup/cpayment_type/show_payment_type')?>",
                dataType : 'json',
                async : false,
                data : { 
                    sh_pt_name : this.sh_pt_name,
                    sh_pt_description : this.sh_pt_description,
                    ftbl : ftbl,
                    order : order,
                    offset : offset,
                    limit : limit
                },
                success:function(data){ 
                    // console.log(data);
                    var result_sql = data.result_sql;
                    var total_records = data.total_records;
                    var total_pages = data.total_pages;
                    var pagination = '';
                    var display = '';

                    if(result_sql.length > 0){ 
                        var tr = '';
                        $.each(result_sql,function(i,row){ 
                            tr += '<tr>'+
                                    '<td>'+(i+1)+'</td>'+
                                    '<td>'+(row.payment_name != null ? row.payment_name :'')+'</td>'+
                                    '<td>'+(row.description != null ? row.description :'')+'</td>'+
                                    '<td class="remove_tag" align="center">';

                                        if("<?php echo $this->green->gAction('U') ?>"){
                                            tr += '<a href="javascript:void(0)" pay_typeno='+ row.pay_typeno +' id="a_edit" class="a_edit">'+
                                                '<img rel="2510" height="15" width="15" src="<?= base_url("/assets/images/icons/edit.png")?>">'+
                                            '</a> &nbsp; &nbsp; &nbsp; &nbsp; ';
                                        }
                                        if("<?php echo $this->green->gAction('D') ?>"){ 
                                            tr += '<a href="javascript:void(0)" pay_typeno='+ row.pay_typeno +' id="a_delete" class="a_delete"><img rel="2510" height="15" width="15" src="<?= base_url("/assets/images/icons/delete.png")?>"></a>'; 
                                        }

                                    tr += '</td>'+
                                '</tr>';
                        });

                        pagination += '<li><a class="a-pagination" href="javascript: void(0)" curr_page = "1" ><span class="fa fa-fast-backward"></span></a></li>';
                        pagination += '<li><a class="a-pagination" href="javascript: void(0)" curr_page = "' + (current_page > 1 ? current_page - 1 : 1) + '"><span class="fa fa-backward"></span></a></li>';
                        
                        for(var i = 1; i <= 1; i++){
                            var n = 1;
                            if(current_page <= 2){ 
                                n = i;
                            }else{ 
                                n = current_page - 2 + i;
                            }

                            if(n <= total_pages){ 
                                var active = current_page == n ? ' class= "active" ' : '';
                                pagination += '<li ' + active + '><a class="a-pagination" href="javascript: void(0)" curr_page ="' + n + '">' + n + '</a></li>';
                            }
                        }
             

                        for(var i = 0; i <= 2; i++){
                            var p = 1;
                            if(current_page <= 2){ 
                                p = 2 + i;
                            }else{ 
                                p = current_page + i;
                            }

                            if(p <= total_pages){ 
                                var active = current_page == p ? ' class= "active" ' : '';
                                pagination += '<li ' + active + '><a class="a-pagination" href="javascript: void(0)" curr_page ="' + p + '">' + p + '</a></li>';
                            }
                        }

                        pagination += '<li><a class="a-pagination" href="javascript: void(0)" curr_page ="' + (current_page < total_pages ? current_page + 1 : total_pages) + '"><span class="fa fa-forward"></span></a></li>';
                        pagination += '<li><a class="a-pagination" href="javascript: void(0)" curr_page ="' + total_pages + '"><span class="fa fa-fast-forward"></span></a></li>';

                    }else{ 
                        tr += '<tr>'+
                                '<td colspan="4" align="center"><i style="font-size:16px; color:red;">Sorry, the result not data.</i></td>'+
                            '</tr>'+
                            '<tr>'+ 
                                '<td colspan="4"><td>'
                            '</tr>';
                    }

                    $('#show_tbl').html(tr);
                    $('#show_tbl_ex').html(tr);
                    $('#pagination-grid').html(pagination);
                }
            });
        }

        this.edit_payment_type = function edit(pay_typeno){
            $.ajax({ 
                type : 'POST',
                url  : "<?= site_url('setup/cpayment_type/edit_payment_type')?>",
                datatype : 'json',
                async : false,
                data : { 
                    pay_typeno : pay_typeno
                },
                success:function(data){
                    $('#myModal_payment_type').modal({backdrop : 'static'});
                    $('#title_modal').html('Edit payment type');
                    $('#pt_name').val(data.payment_name);
                    $('#pt_description').val(data.description);
                    $('#h_typeno').val(data.pay_typeno);
                    $('#h_pn').val(data.description);
                }
            });
        }

        this.delete_payment_type = function delete_(pay_typeno){ 
            var data_success = '';
            $.ajax({ 
                type : 'POST',
                url  : "<?= site_url('setup/cpayment_type/delete_payment_type')?>",
                dataType : "json",
                async : false,
                data : { 
                    pay_typeno : pay_typeno
                },
                success:function(data){ 
                    // data_success = data.success;
                }
            });
            
            this.show_payment_type($('#hd_ftbl').val(),$('#hd_order').val(),1,$('#total_display').val()-0);

        }

        this.clear_textbox = function clear(){ 
            $('#pt_name').val('');
            $('#pt_description').val('');
            $('#h_typeno').val();
            $('#sch_pt_name').val('');
            $('#sch_pt_description').val('');
        }
    }

    function fn_print(){
        $(".remove_inv").removeAttr("href");
        var title   = "<center><span style='font-weight:bold; font-size:16px;'>Payment Type List</span></center><br>";
       
        var data = $("#dv-print").html().replace(/<img[^>]*>/gi,"");
        var export_data = $("<center>"+data+"</center>").clone().find(".remove_tag").remove().end().html();
        //export_data+=htmlToPrint;
        return title+"####"+export_data;
    }

    function fn_ex(){
        $(".remove_inv").removeAttr("href");
        var title   = "<center><span style='font-weight:bold; font-size:16px;'>Payment Type List</span></center><br>";
       
        var data = $("#div-ex").html().replace(/<img[^>]*>/gi,"");
        var export_data = $("<center>"+data+"</center>").clone().find(".remove_tag").remove().end().html();
        //export_data+=htmlToPrint;
        return title+"####"+export_data;
    }
    
    function clear_all(){ 
        $('#pt_name').val('');
        $('#pt_description').val('');
        $('#h_typeno').val('');
        $('#sch_pt_name').val('');
        $('#sch_pt_description').val('');
        $('#h_pn').val('');
    }

</script>