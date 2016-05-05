<div class="wrapper">
	<div class="col-sm-12">
    	<div class="row result_info">
        	<div class="col-xs-6"><h5>Setup Price</h5></div>
       		<div class="col-xs-6" align="right">
                <?php if($this->green->gAction("R")){ ?>
                    <!-- <a href="javascript:void(0)" id="a_search" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><img src="<?= base_url()."assets/images/icons/searchs.png"?>" width="25"></a> -->
                <?php } ?>
                <?php if($this->green->gAction("E")){ ?>
                    <a href="javascript:void(0)" id="a_export"rch><img src="<?= base_url()."assets/images/icons/exports.png"?>" width="25"></a>
                <?php } ?>
                <?php if($this->green->gAction("P")){ ?>
                    <a href="javascript:void(0)" id="a_print"><img src="<?= base_url()."assets/images/icons/prints.png"?>" width="25"></a>
                <?php } ?>
            </div>
        </div>
       <!--  <div class="row collapse" id="collapseExample">
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
    	</div> -->
        <br>

        <div class="table-responsive" id="dv-print">
            <table class="table table-condensed table-striped">
                <thead>
                    <tr>
                        <th class="th_no">No</th>
                         <th class="sort_data">
                            Park/Package
                        </th>
                        <th class="sort_data">
                            Tour Class<!--  <span style="padding-left:10%"></span><span id="span_p" class="glyphicon glyphicon-menu-down"></span> -->
                        </th>
                        <th class="sort_data">
                            Old<!--  <span style="padding-left:10%"></span><span id="span_p2"> -->
                        </th>
                        <th class="sort_data"> 
                            Discount
                        </th>
                        <th class="sort_data"> 
                            Price
                        </th>
                        <th class="th_add remove_tag" style="text-align:center;">
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

        <div id="div-ex" style="display:none;">
            <table border="1">
                <thead>
                    <tr>
                        <th class="th_no">No</th>
                         <th class="sort_data">
                            Park/Package
                        </th>
                        <th class="sort_data">
                            Tour Class<!--  <span style="padding-left:10%"></span><span id="span_p" class="glyphicon glyphicon-menu-down"></span> -->
                        </th>
                        <th class="sort_data">
                            Old<!--  <span style="padding-left:10%"></span><span id="span_p2"> -->
                        </th>
                        <th class="sort_data"> 
                            Discount
                        </th>
                        <th class="sort_data"> 
                            Price
                        </th>
                        <th class="th_add remove_tag" style="text-align:center;">                            
                            <div id="add" style="width:100%"><img src="<?= base_url('assets/images/icons/adds.png') ?>" width="25px;">
                        </th>
                    </tr>
                </thead>
                <tbody id="show_tbl_ex">
                    
                </tbody>
            </table>            
        </div>

    </div>
    <!-- <div class="col-sm-1">   
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
    </div>		 -->
</div>



<!-- modal  -->

<div class="modal" id="myModal_price_list" role="dialog">
    <form role="form"  id="form_validate">
    <div class="modal-dialog" id="dialog_price_list">
        <div class="modal-content">
        <form id="form_validate">
            <div class="modal-header  move_modal" >
                <span id="title_modal"></span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>            
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Park / Package</label>
                            <select name="select_country"  class="form-control " id="select_parkage" data-parsley-required="true" data-parsley-error-message="This field required !">
                               <?php 
                                    echo $option_package;
                               ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Tour class</label>
                            <select name="select_country"  class="form-control " id="select_tourclass" data-parsley-required="true" data-parsley-error-message="This field required !">
                                <option value="1">Local</option>
                                <option value="0">Foreigner</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Old</label>
                            <select name="select_country"  class="form-control " id="select_old" data-parsley-required="true" data-parsley-error-message="This field required !">
                                <option value="0">Adult</option>
                                <option value="1">Child</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Price</label>
                            <input type="text" id="price" class="form-control input-xs" placeholder="Enter price" data-parsley-required="true" data-parsley-error-message="This field required !"/>
                            <input type="hidden" id="pric_code">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Discount</label>
                            <input type="text" id="discount" class="form-control input-xs" placeholder="Enter discount" />
                        </div>
                    </div>
                </div> 
            </div>
            <div class="modal-footer move_modal">
                <?php if ($this->green->gAction("C")){ ?>
                    <button type="button" id="save" class="btn btn-primary save_price">Save</button>
                    <button type="button" class="btn btn-primary save_price" saveclose="close">Save Close</button>
                <?php } ?>
                <button type="button" id="cancel" class="btn btn-warning" data-dismiss="modal">Cancel</button>
            </div>
        </div>
        </form>
    </div>
    </div>
    </form>
</div>

<!--  -->
<div class="modal" id="myModal_duplicate">
    <div class="modal-dialog modal_duplicate">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title text_duplicate"></div>
            </div>
            <div class="modal-footer">                
                <button type="button" class="btn btn-default" id="close_msg" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- -->

<style type="text/css">
    .modal_duplicate{top: 25%} 
    .text_duplicate{ color: red; font-size: 16px; text-align: center; top:30%;}
    .sort_data,.th_no{ color: #337ab7;}
    .sort_data:hover{ 
        /*box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(102, 175, 233, 0.6); */
        /*border-color: #66afe9; border-radius: 5px; cursor: pointer; color: #337ab7;*/
    }
    .th_add:hover{ box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(102, 175, 233, 0.6); 
                    border-color: #66afe9; cursor: pointer;
                }
    #title_modal{ color : #337ab7; text-align : left; font-size: 18px}

</style>

<script type="text/javascript"> 

    $(function(){ 

        var obj_show = new pro_price();
        obj_show.show_price_list();

        $('#a_export').tooltip({title : 'Export'});
        $('#a_print').tooltip({title : 'Print'});
        $('#add').tooltip({title : 'Add New', placement : 'left'});
        $('body').delegate('','mouseover',function(){ 
            $('.a_edit').tooltip({title : 'Edit', placement : 'left'});
            $('.a_delete').tooltip({title : 'Delete'});
        });

        $('body').delegate('#add','click',function(){ 
            $('#form_validate').parsley().destroy();
            clear_value();
            $('#title_modal').text('Setup price');
            $('#myModal_price_list').modal({backdrop : 'static'});
            $('#dialog_price_list').draggable({ handla : '.move_modal'});
        });

        $('.save_price').click(function(){
            var obj_save = new pro_price();
            if($('#form_validate').parsley().validate()){
                if( $('#price').val()-0 < $('#discount').val()-0 ){ 
                    $('#myModal_duplicate').modal({'backdrop' : false});
                    $('.text_duplicate').html('Please input discount again. ( price > discount )');
                }else{ 
                    obj_save.setup_price($(this).attr('saveclose'));
                }
            }
        });

        $('body').delegate('#a_edit','click',function(){
            $('#form_validate').parsley().destroy();
            var obj_edit = new pro_price();
            obj_edit.edit_price_list($(this).attr('pric_typeno'));
        });

        $('body').delegate('#a_delete','click',function(){ 
            modal_delete($(this).attr('pric_typeno'));
        });

        $('body').delegate('#btn_delete','click',function(){
            var obj_delete = new pro_price();
            obj_delete.delete_price_list($(this).attr('attr'));
        });

        $("body").delegate("#a_print","click",function(){
            var arr_pr = fn_print().split("####");
            gsPrint(arr_pr[0],arr_pr[1]);
            
        });

        $("body").delegate("#a_export","click",function(){
            var arr_exp = fn_ex().split("####");
            window.open('data:application/vnd.ms-excel,' + encodeURIComponent(arr_exp[1]));
            
        });

        $('#price').keyup(function(e){ 
            input_number(e,$(this),'Please input number in price.');
            //alert();
        });

        $('#discount').keyup(function(e){ 
            input_number(e,$(this),'Please input number in discount.');
            //alert();
        });

    });

    function pro_price(){ 

        this.select_parkage = $('#select_parkage').val();
        this.select_tourclass = $('#select_tourclass').val();
        this.select_old = $('#select_old').val();
        this.price = $('#price').val();
        this.discount = $('#discount').val();
        this.pric_code = $('#pric_code').val();

        this.setup_price = function save(attr_close){ 
            $.ajax({ 
                type : 'POST',
                url  : "<?= site_url('setup/cprice_list/setup_price'); ?>",
                dataType : 'JSON',
                async : false,
                data : { 
                    select_parkage : this.select_parkage, 
                    select_tourclass : this.select_tourclass,
                    select_old : this.select_old,
                    price : this.price,
                    discount : this.discount,
                    pric_code : this.pric_code
                },
                success:function(data){ 
                    if(data.success == 'true'){ 

                        var obj_show = new pro_price();
                        obj_show.show_price_list();
                        clear_value();
                        if(attr_close == 'close'){ 
                            $('#myModal_price_list').modal('hide');
                        }
                    }else{ 
                        $('#myModal_duplicate').modal({'backdrop' : false});
                        $('.text_duplicate').html('This package price is duplicate. Please type again.');
                    }
                    
                }
            });
        }

        this.show_price_list = function show(){ 
            $.ajax({ 
                type : 'POST',
                url  : "<?= site_url('setup/cprice_list/show_price_list'); ?>",
                dataType : 'json',
                async : false,
                data  : { 

                },
                success:function(data){ 
                    //console.log(data.sql_query);
                    if(data.sql_query.length > 0){ 
                        var tr = '';
                        $.each(data.sql_query,function(i,row){ 
                            if(row.is_local != null && row.is_local == 0){ 
                                tour_class = 'Foreigner';
                            }else{ 
                                tour_class = 'Local';
                            }
                            if(row.old_type != null && row.old_type == 0){ 
                                oldtype = 'Adult';
                            }else{ 
                                oldtype = 'Child';
                            }

                            tr += '<tr>'+
                                '<td>'+(i + 1)+'</td>'+
                                '<td>'+(row.package_name != null ? row.package_name : '')+'</td>'+
                                '<td>'+tour_class+'</td>'+
                                '<td>'+oldtype+'</td>'+
                                '<td>'+(row.discount != null ? row.discount : '')+'</td>'+
                                '<td>'+(row.price != null ? row.price : '')+'</td>'+
                                '<td align="center" class="remove_tag">'+
                                    '<a href="javascript:void(0)" id="a_edit" class="a_edit" pric_typeno='+row.pric_typeno+'><img rel="2510" height="15" width="15" src="<?= base_url("/assets/images/icons/edit.png")?>"></a> &nbsp; &nbsp;'+
                                    '&nbsp; &nbsp; <a href="javascript:void(0)" class="a_delete" id="a_delete" pric_typeno='+row.pric_typeno+'><img rel="2510" src="<?= base_url("/assets/images/icons/delete.png")?>"></a>'+
                                '</td>'+
                            '</tr>';
                        });
                    }else{ 
                        tr ='<tr>'+
                            '<td colspan="7" align="center"><i style="font-size:15px; color:red;">Result not data.</i></td>'+ 
                        '</tr>'+
                        '</tr><tr><td colspan="7"></td>';
                    }

                    $('#show_tbl').html(tr);
                    $('#show_tbl_ex').html(tr);
                }
            });
        }

        this.edit_price_list = function edit(pric_typeno){ 
            $.ajax({ 
                type : 'POST',
                url  : "<?= site_url('setup/cprice_list/edit_price_list')?>",
                dataType : 'JSON',
                async : false,
                data : { 
                    pric_typeno : pric_typeno
                },
                success:function(data){ 
                    //console.log(data);
                    $('#select_parkage').val(data[0].package_typeno);
                    $('#select_tourclass').val(data[0].is_local);
                    $('#select_old').val(data[0].old_type);
                    $('#price').val(data[0].price);
                    $('#discount').val(data[0].discount);
                    $('#pric_code').val(data[0].pric_typeno);

                    $('#title_modal').text('Edit price');
                    $('#myModal_price_list').modal({backdrop : 'static'});
                    $('#dialog_price_list').draggable({ handla : '.move_modal'});
                }
            });
        }

        this.delete_price_list = function delete_price(pric_typeno){ 
            $.ajax({ 
                type : 'POST',
                url  : "<?= site_url('setup/cprice_list/delete_price_list')?>",
                dataType : 'JSON',
                async : false,
                data : { 
                   pric_typeno : pric_typeno 
                },
                success:function(data){
                    if(data == 'true'){
                        var obj_show = new pro_price();
                        obj_show.show_price_list();   
                    }
                   
                    //console.log(data);
                }
            });
        }
    }

    function clear_value(){ 
        $('#select_parkage').val('');
        $('#select_tourclass').val('');
        $('#select_old').val('');
        $('#price').val('');
        $('#discount').val('');
        $('#pric_code').val('');
    }

    function fn_print(){
        $(".remove_inv").removeAttr("href");
        var title   = "<center><span style='font-weight:bold; font-size:16px;'>Package price Type List</span></center><br>";
       
        var data = $("#dv-print").html().replace(/<img[^>]*>/gi,"");
        var export_data = $("<center>"+data+"</center>").clone().find(".remove_tag").remove().end().html();
        //export_data+=htmlToPrint;
        return title+"####"+export_data;
    }

    function fn_ex(){
        $(".remove_inv").removeAttr("href");
        var title   = "<center><span style='font-weight:bold; font-size:16px;'></span></center><br>";
       
        var data = $("#div-ex").html().replace(/<img[^>]*>/gi,"");
        var export_data = $("<center>"+data+"</center>").clone().find(".remove_tag").remove().end().html();
        //export_data+=htmlToPrint;
        return title+"####"+export_data;
    }

    function input_number(e,this_clear,title){
     
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
            $('#myModal_duplicate').modal({'backdrop' : false});
            $('.text_duplicate').html(title);
            this_clear.val('');
        }
    }

</script>