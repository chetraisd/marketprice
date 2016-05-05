<div class="wrapper">
<meta charset="Utf-8">
	<div class="col-sm-12">
    	<div class="row result_info">
        	<div class="col-xs-6"><h5><?php echo $this->lang->line('ticket_type')?></h5></div>
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
             	<div class="col-sm-3">
                    <label class="control-label">&nbsp;</label>
                    <input type="text" placeholder="Search Ticket Name " id="s_name_t" class="form-control input-xs" />
                </div>
                <div class="col-sm-3">
                    <label class="control-label">&nbsp;</label>
                    <input type="text" placeholder="Search Park " id="s_park_t" class="form-control input-xs" />
                </div>
                <div class="col-sm-3">
                    <label class="control-label">&nbsp;</label>
                    <input type="text" placeholder="Search Validities" id="s_qty_day_t" class="form-control input-xs" />
                </div>
                <div class="col-sm-3">
                    <label class="control-label">&nbsp;</label>
                    <input type="text" placeholder="Search price" id="s_price_t" class="form-control input-xs" />
                </div>
                <div class="col-sm-3">
                    <label class="control-label">&nbsp;</label>
                    <div class="input-xs">
                        <input type="button" name="search" id="search" class="btn btn-primary" value="Search" />
                        <input type="button" name="refresh" id="refresh" class="btn btn-warning" value="Refresh" />
                    </div>
                </div>
            </div>
    	</div>
        <br>
        <div class="table-responsive" id="dv-print">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th class="th_no"><?php echo $this->lang->line('No')?></th>
                        <th class="sort_data" fname="tickettype_name" order="DESC"> 
                            <?php echo $this->lang->line('ticket_type_name')?><span style="padding-left:10%"></span><span id="span_n" class="glyphicon glyphicon-menu-down"></span>
                        </th>
                        <th class="sort_data" fname="park_name" order="DESC"> 
                            <?php echo $this->lang->line('park_name')?><span style="padding-left:10%"></span><span id="span_pn"></span>
                        </th>
                        <th class="sort_data" fname="qty_day" order="DESC"> 
                            <?php echo $this->lang->line('validity')?> <span style="padding-left:10%"><span id="span_q"></span>
                        </th>
                        <th class="sort_data" fname="price" order="DESC">
                            <?php echo $this->lang->line('price')?> <span style="padding-left:10%"><span id="span_p"></span> 
                        </th>
                        <th class="sort_data" fname="description" order="DESC">
                            <?php echo $this->lang->line('description')?> <span style="padding-left:10%"></span><span id="span_d" ></span> 
                        </th>
                        <th class="remove_tag th_add" colspan="2" style="text-align:center;">
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
           <option value="20">20</option>
           <option value="50">50</option>
           <option value="100">100</option>
           <option value="500">500</option>
        </select>
    </div>
    <div class="col-sm-6">
        <ul class="pagination pagination-sm" id="pagination-grid" style="display: inline;"></ul><input type="hidden" id="hd_order" value="ASC"><input type="hidden" id="hd_fname" value="description">
    </div> 
       
</div>

<!-- ============================ modal-->

<div class="modal" id="myModal_ticket" role="dialog">
    <form role="form"  id="form_validate">
    <div class="modal-dialog" id="dialog_ticket">
        <div class="modal-content">
            <div class="modal-header modal_move">
                <span id="title_modal"></span><!-- <span id="title_check"></span> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <!-- ============== modal_body_ticket ===================== -->
            <div class="modal-body" id="modal_body_ticket">
                <div class="row">
                    <div class="col-sm-12">                            
                            <div class="form-group">
                                <label class="control-label"><?php echo $this->lang->line('parks')?> <span style="color:red">*</span></label>
                                <!-- <div class="input-group"> -->
                                    <select name="select_park[]" multiple class="form-control " id="select_park" data-parsley-required="true" data-parsley-error-message="This field required !"> 
                                        <?php 
                                            // echo $option_park; 
                                            echo $this->green->user_access_park(1);
                                        ?>
                                    </select>
                                    <!-- <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button" id="add_park">
                                            <span class="glyphicon glyphicon-plus"></span>
                                        </button>
                                    </span> -->
                                <!-- </div> -->
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?= $this->lang->line("ticket_type_name")?> <span style="color:red">*</span></label>
                                <input type="text" id="ticket_type_name" class="form-control input-xs" placeholder="Enter ticket type name " data-parsley-required="true" data-parsley-error-message="This field required !"/>
                                <input type="hidden" id="h_typeno" /><input type="hidden" id="h_ticket_type_name">
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?php echo $this->lang->line('price')?> ( $ )</label>
                                <input type="text" id="price_t" class="form-control input-xs" placeholder="Enter price" data-parsley-required="true" data-parsley-error-message="This field required !"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?php echo $this->lang->line('validity')?></label>
                                <input type="text" id="qty_date" class="form-control input-xs" placeholder="Enter quantity day" data-parsley-required="true" data-parsley-error-message="This field required !"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?php echo $this->lang->line('description')?></label>
                                <textarea class="form-control input-xs" rows="5" id="description_t" placeholder="Enter description "></textarea>
                            </div>
                    </div>
                </div> 
            </div>
            <!-- ===================== body_park =============================== -->

           <!--  <div class="modal-body" id="modal_body_park" style="display:none">
                <div class="row">
                    <div class="col-sm-12">
                        
                            <div class="form-group">
                                <label class="control-label ">location<span style="color:red"> *</span></label>
                                
                                    <select class="form-control" id="location"> 
                                        <?php 
                                            echo $option_localtion; 
                                        ?>
                                    </select>
                                
                            </div>
                            <div class="form-group">
                                <label class="control-label" >Park Name<span style="color:red"> *</span></label>
                                <input type="text" class="form-control required_validate " name="park_name" id="park_name" placeholder=" Enter park name">
                               
                            </div>
                            <div class="form-group">
                                <label class="control-label">Description</label>
                                <textarea   class="form-control input-xs" name="description" id="description" placeholder="<?= $this->lang->line("description") ?>"></textarea>
                            </div>
                            <div class="form-group">                                
                                <label class="control-label"> Import Image</label>
                                <form id="frm_photo" target="ifram" method="POST" action="<?= site_url('setup/cpark/park_upload') ?>" enctype="multipart/form-data">
                                    <input style="width: 0;height: 0;" type="file" name="photo" id="photo" accept="image/jpg,image/png,image/jpeg">
                                    <input type="hidden" name="image_insert" id="image_insert">
                                    <input type="hidden" name="image_edit" id="image_edit">
                                    <div id="dv_img" class="dv_img" >
                                        <img width="180" height="150" onclick="$('#photo').click()" id="img_park" class="img-rounded image_pion" style="border: 1px solid #CCC;">
                                    </div>
                                </form>
                                <iframe id="ifram" name="ifram" style="display: none;"></iframe>
                            </div>
                            <div class="form-group"> 
                                <div class="col-sm-2">
                                    <button type="button" id="browser" onclick="$('#photo').click()" class="btn btn-primary btn-sm" style="margin: 3px;">Browse...</button>
                                </div>
                                <label style="text-align: left;padding-top: 10px;" class="col-sm-7 control-label">(File extension PNG/JPG/JPEG, Size <= 2MB)</label>
                            </div>
                       
                    </div>
                </div> 
            </div> -->

            <!-- ===================== footer_ticket =========================== -->
            <div class="modal-footer modal_move" id="footer_ticket">
                <?php if ($this->green->gAction("C")){ ?>
                    <button type="button" id="save_ticket" class="btn btn-primary save_ticket">Save</button>
                    <button type="button" id="save_ticket_close" class="btn btn-primary save_ticket" saveclose="close">Save Close</button>
                <?php } ?>
                <button type="button" id="cancel" class="btn btn-warning" data-dismiss="modal">Cancel</button>
            </div>
            <!-- ===================== footer_footer_park =========================== -->
           <!--  <div class="modal-footer modal_move" id="footer_park" style="display:none">
                <button type="button" class="btn btn-primary save_park"><?= $this->lang->line('save')?></button>
                <button type="button" class="btn btn-primary save_park" data-close="true">Save Close</button>
                <button type="button" class="btn btn-warning" id="back_park">Back</button>
            </div> -->

        </div>
    </div>
    </form>
</div>

<!-- ==================================================================== -->
<div class="modal" id="myModal_confirm">
    <div class="modal-dialog modal_confirm">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title"><span id="title_confirm"></span><br><span id="con_answer">Do you want to save and update ?</span></div>
            </div>
            <div class="modal-footer">
                <button type="button" id="save_update" class="btn btn-default">Save and update</button>
                <button type="button" id="save_new" class="btn btn-default" style="display:none">Save new</button>
                <button type="button" class="btn btn-default" id="close_msg" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- ================ -->
<div id="div-ex" style="display:none">
    <center>
    <span>Ticket Type List</span>
    <table border="1" width="100%">
        <thead>
            <tr>
                <th class="th_no"><?php echo $this->lang->line('No')?></th>
               <th class="sort_data" fname="tickettype_name" order="DESC"> 
                    <?php echo $this->lang->line('ticket_type_name')?>
                </th>
                <th class="sort_data" fname="park_name" order="DESC"> 
                    <?php echo $this->lang->line('park_name')?>
                </th>
                <th class="sort_data" fname="qty_day" order="DESC"> 
                    <?php echo $this->lang->line('qty_day')?> 
                </th>
                <th class="sort_data" fname="price" order="DESC">
                    <?php echo $this->lang->line('price')?> 
                </th>
                <th class="sort_data" fname="description" order="DESC">
                    <?php echo $this->lang->line('description')?> 
                </th>
                <th class="remove_tag th_add" colspan="2" style="text-align:center;">
                    <div id="add" style="width:100%"><img src="<?= base_url('assets/images/icons/adds.png') ?>" width="25px;">
                </th>
            </tr>
        </thead>
        <tbody id="show_tbl_ex">
            
        </tbody>
    </table>
    </center>
</div>

<!-- ======================CSS -->
<style type="text/css">
    .sort_data,.th_no{ color: #337ab7;} 
    .th_add:hover{ box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(102, 175, 233, 0.6); border-color: #66afe9; cursor: pointer;}
    .sort_data:hover{ 
        /*box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(102, 175, 233, 0.6); */
        border-color: #66afe9; border-radius: 5px; cursor: pointer; color: #337ab7;
    }
    .image_pion{cursor: pointer;}
    #title_modal{ font-size: 18px; text-align: left; color: #337ab7;}
    #title_check{ font-size: 16px; text-align: center; color: red; display: none; }
</style>

<!-- =============script -->

<script type="text/javascript">
   
    $(function(){

        $('#add').tooltip({title : 'Add New', placement: 'top'});
        $('#a_export').tooltip({title : 'Export', placement: 'top'});
        $('#a_print').tooltip({title : 'Print', placement: 'top'});
        $('#a_search').tooltip({title : 'hide/show form search', placement: 'left'});
        $('#search').tooltip({title : 'Search'});
        $('#refresh').tooltip({title : 'Refresh'});        
        $('body').delegate('','mouseover',function(){ 
            $('.a_edit').tooltip({title : 'Edit', placement: 'left'});
            $('.a_delete').tooltip({title : 'Delete', placement: 'top'});
            $('#total_display').tooltip({title : 'Display Limit', placement: 'top'});
        });
        $('#add_park').tooltip({title : 'Add new park', placement : 'right'});

        var obj_show = new process_ticket();
        obj_show.show_ticket(1,$('#total_display').val()-0,$('#hd_fname').val(),$('#hd_order').val());

        $('#add').click(function(){ 
            $('#form_validate').parsley().destroy();
            var obj_modal = new process_ticket();
            obj_modal.clear_text();
            $('#qty_date').val(1);           
            $('#myModal_ticket').modal({backdrop : 'static',});
            $('#title_modal').text('Create Ticket Type');            
            $('#dialog_ticket').draggable({ handle : '.modal_move'});
            
        });

        // $('#add_park').click(function(){
        //     $('#title_check').text('');
        //     clear_text_park();
        //     $('#title_modal').text('Create New Park');
        //     $('#modal_body_ticket').hide();
        //     $('#modal_body_park').show();
        //     $('#footer_ticket').hide();
        //     $('#footer_park').show();
        //     $('#img_park').attr('src', '<?= base_url("assets/upload/images.png") ?>'); 
        // });

        // $('#back_park').click(function(){ 
        //     $('#title_modal').text('Create Ticket Type');
        //     $('#modal_body_ticket').show();
        //     $('#modal_body_park').hide();
        //     $('#footer_ticket').show();
        //     $('#footer_park').hide();
        //     $('#title_check').text('');
        // });

        $('.save_ticket').on('click',function(){
            var obj_check = new process_ticket();
            if($('#form_validate').parsley().validate()){
                var this_click = $(this);
                obj_check.check_duplicat(this_click);
            }
            
        });

        $('body').delegate('#save_update','click',function(){ 
            var obj_save_update = new process_ticket();
            obj_save_update.save_ticket();

        });

        $('body').delegate('#save_new','click',function(){ 
            var obj_save_new = new process_ticket();
            obj_save_new.save_new();
        });

        $('#search').click(function(){ 
            var obj_search = new process_ticket();
            obj_search.show_ticket(1,$('#total_display').val()-0,$('#hd_fname').val(),$('#hd_order').val());
        });

        $('#refresh').click(function(){
            clear_textbox_search();
            var obj_refresh = new process_ticket();
            obj_refresh.show_ticket(1,$('#total_display').val()-0,$('#hd_fname').val(),$('#hd_order').val());
        });

        $('body').delegate('#a_edit','click',function(){ 
            $('#form_validate').parsley().destroy();
            var attr_tyno = $(this).attr('attr_tyno');
            var obj_edit = new process_ticket();
            obj_edit.edit_ticket(attr_tyno);
            $('#save').val('<?php echo $this->lang->line("update")?>');
        });

        $('body').delegate('#a_delete','click',function(){
            modal_delete($(this).attr('attr_tyno'));
        });

        $('body').delegate('#btn_delete','click',function(){ 
            clear_textbox_search();            
            var obj_delete = new process_ticket();
            obj_delete.delete_ticket($(this).attr('attr'));
        });

        $('#qty_date').on('change',function(){ 
            if($(this).val()-0 == 0){
                $(this).val(1);
            }
        });

        $("body").delegate("#a_print","click",function(){
            $('#span_n').removeClass();
            $('#span_pn').removeClass();
            $('#span_d').removeClass();
            $('#span_q').removeClass();
            $('#span_p').removeClass();
            var arr_pr = fn_print().split("####");
            gsPrint(arr_pr[0],arr_pr[1]);
            
        });

        $("body").delegate("#a_export","click",function(){
            $('#span_n').removeClass();
            $('#span_pn').removeClass();
            $('#span_d').removeClass();
            $('#span_q').removeClass();
            $('#span_p').removeClass();
            var arr_exp = fn_ex().split("####");
            window.open('data:application/vnd.ms-excel,' + encodeURIComponent(arr_exp[1]));
            
        });

        $('#price_t').keydown(function (e){
            var this_clear = $(this);
            input_price(e,this_clear,'<?php echo $this->lang->line("p_input_p")?>');
        });

        $('#qty_date').keydown(function (e){ 
            var this_clear = $(this);
            input_price(e,this_clear);
        });

        $('#total_display').on('change',function(){ 
            var obj_change = new process_ticket();
            obj_change.show_ticket(1,$(this).val()-0,$('#hd_fname').val(),$('#hd_order').val());
        });

        $('body').delegate('.a-pagination','click',function(){ 
            var curr_page = $(this).attr('curr_page')-0;
            var obj_pag = new process_ticket();
            obj_pag.show_ticket(curr_page,$('#total_display').val()-0,$('#hd_fname').val(),$('#hd_order').val());
        });

        $('body').delegate('.sort_data','click',function(){ 
            var obj_sort = new process_ticket();
            obj_sort.show_ticket(1,$('#total_display').val()-0,$(this).attr('fname'),$(this).attr('order'));
            $('#hd_order').val($(this).attr('order'));
            $('#hd_fname').val($(this).attr('fname'));
            $('#span_d').removeClass();
            $('#span_q').removeClass();
            $('#span_p').removeClass();
            $('#span_n').removeClass();
            $('#span_pn').removeClass();

            if($(this).attr('order') == "ASC"){

                if($(this).attr('fname') =="tickettype_name"){ 
                    $('#span_n').addClass('glyphicon glyphicon-menu-down');
                    $('.sort_data').attr('order','DESC');
                }else if($(this).attr('fname') =="description"){ 
                    $('.sort_data').attr('order','DESC');
                    $('#span_d').addClass('glyphicon glyphicon-menu-down'); 
                }else if($(this).attr('fname') =="qty_day"){ 
                    $('.sort_data').attr('order','DESC');
                    $('#span_q').addClass('glyphicon glyphicon-menu-down');
                }else if($(this).attr('fname') == "park_name"){ 
                    $('.sort_data').attr('order','DESC');
                    $('#span_pn').addClass('glyphicon glyphicon-menu-down');
                }else{ 
                    $('.sort_data').attr('order','DESC');
                    $('#span_p').addClass('glyphicon glyphicon-menu-down');
                }
                
            }else{

                if($(this).attr('fname') == "tickettype_name"){ 
                    $('#span_n').addClass('glyphicon glyphicon-menu-up');
                    $('.sort_data').attr('order','ASC');
                }else if($(this).attr('fname') =="description"){ 
                    $('.sort_data').attr('order','ASC');
                    $('#span_d').addClass('glyphicon glyphicon-menu-up'); 
                }else if($(this).attr('fname') =="qty_day"){ 
                    $('.sort_data').attr('order','ASC');
                    $('#span_q').addClass('glyphicon glyphicon-menu-up');
                }else if($(this).attr('fname') =="park_name"){ 
                    $('.sort_data').attr('order','ASC');
                    $('#span_pn').addClass('glyphicon glyphicon-menu-up');
                }else{ 
                    $('.sort_data').attr('order','ASC');
                    $('#span_p').addClass('glyphicon glyphicon-menu-up');
                }
            }
            
        });

        // $('.save_park').on('click', function(e){
        //     $('#loc_name').focus();  
        //     $('#loc_name').css({border: ''});
        //     var save_close = $(this);
        //     if($('#location').val() == ""){ 
        //         check_textbox($('#location'),"Please select location before save.");
        //     }else if($('#park_name').val() == ""){ 
        //         check_textbox($('#park_name'),"Please input park name before save.");
        //     }else{
        //         $.ajax({
        //             url: "<?= site_url('setup/cpark/save') ?>",
        //             type: "POST",
        //             dataType: "JSON",
        //             data: {
        //                 par_typeno: $('#par_typeno').val(),
        //                 location: $('#location').val(),
        //                 park_name: $('#park_name').val(),
        //                 description: $('#description').val()                                 
        //             },
        //             success: function(data){                     
        //                 var arr = data.arr;             
        //                 if(arr.success == 'true'){
        //                     clear_a_element(); 
        //                     $('#img_park').attr({src: '<?= base_url("assets/upload/images.png") ?>'});
                            
        //                     $('#success').show();
        //                     setTimeout(function(){ $('#success').hide();}, 1000); 

        //                     if(save_close.attr('data-close') == 'true'){
        //                         // $('#m_park_save').modal('hide')
        //                             $('#title_modal').text('Create Ticket Type');
        //                             $('#modal_body_ticket').show();
        //                             $('#modal_body_park').hide();
        //                             $('#footer_ticket').show();
        //                             $('#footer_park').hide();                                              
        //                     }

        //                     $('#select_park').prepend("<option selected='selected' value='"+data.par_typeno+"'>"+ $('#park_name').val() +"</option>");
        //                     // image ======= 
        //                     $('#image_insert').val(data.par_typeno);  
        //                     $('#image_edit').val(data.par_typeno);                  
        //                     reload_img();
        //                 }else{
        //                     alert('Duplicate' + ' ' + "'" + $('#park_name').val() + "'" + '!')
        //                     $('#park_name').select();
        //                 }
        //                 $('#loading_header').hide();
        //             },
        //             error: function(err){

        //             }
        //         });
        //     }
        // });     
        
        // $('#photo').on('change', function () {
        //     if(this.files[0].size - 0 < 2048000){
        //         var ext = this.value.match(/\.(.+)$/)[1];
        //         switch (ext) {
        //             case 'jpg':
        //             case 'jpeg':
        //             case 'png':
        //             readURL(this);              
        //             break;
        //             default:
        //                 alert('Your extensions can only PNG/JPG/JPEG! Please choose another file');
        //                 this.value = '';
        //         }         
        //     }else{
        //         alert('Your file size more than 2BM!');
        //         this.value = '';
        //     }
        // });
      
    });
    
    function process_ticket(){
     
        this.s_name_t = $('#s_name_t').val(); 
        this.s_park_t = $('#s_park_t').val();       
        this.s_qty_day_t = $('#s_qty_day_t').val();
        this.s_price_t = $('#s_price_t').val();
        this.h_typeno = $('#h_typeno').val();
        this.description_t = $('#description_t').val();
        this.price_t = $('#price_t').val();
        this.h_ticket_type_name = $('#h_ticket_type_name').val();
        this.qty_date = $('#qty_date').val();
        this.select_park = $('#select_park').val();
        this.ticket_type_name = $('#ticket_type_name').val();

        this.check_duplicat = function check(this_click){ 
            var con = '';
            var tick_name = '';
            var park_name = '';
            var save_new = '';
            var arr_data = {
                "description_t" : this.description_t,
                "price_t"       : this.price_t,
                "qty_date"      : this.qty_date,
                "select_park"  : this.select_park,
                "ticket_type_name" : this.ticket_type_name
            }

            $.ajax({ 
                type : 'POST',
                url  : "<?= site_url('setup/cticket_type/check_duplicat')?>",
                dataType : 'json',
                async : false,
                data : { 
                    arr_data : arr_data
                },
                success:function(data){ 
                    console.log(data);
                    con = data.confirm;
                    tick_name = data.tick_name;
                    park_name = data.park_name;
                    save_new = data.save_new;
                 }
            });

            if(con == "true"){ 
                if(this_click.attr('saveclose') == "close"){ 
                    $('#myModal_ticket').modal('hide');
                }               
                myModal_confirm(tick_name,park_name,save_new);
            }else{ 
                if(this_click.attr('saveclose') == "close"){ 
                    $('#myModal_ticket').modal('hide');
                }
                this.save_ticket();
            }
        }

        this.save_ticket = function save(){
            var arr_data = {
                "description_t" : this.description_t,
                "price_t"       : this.price_t,
                "qty_date"      : this.qty_date,
                "select_park"  : this.select_park,
                "ticket_type_name" : this.ticket_type_name
            }
            
            var success ='';
            var value = '';
            $.ajax({ 
                type : 'POST',
                url  : "<?= site_url('setup/cticket_type/save_ticket')?>",
                dataType : 'json',
                async : false,
                data : { 
                   arr_data : arr_data,
                   h_typeno   : this.h_typeno,
                   h_ticket_type_name : this.h_ticket_type_name
                   
                },
                success:function(data){ 
                    success = data.success;
                    value = data.value;
                }
            });

            if(success == "true"){
                $('#myModal_confirm').modal('hide');
                this.show_ticket(1,$('#total_display').val()-0,$('#hd_fname').val(),$('#hd_order').val());
                this.clear_text();
            }
        }

        this.save_new = function save_new(){ 
            var arr_data = {
                "description_t" : this.description_t,
                "price_t"       : this.price_t,
                "qty_date"      : this.qty_date,
                "select_park"  : this.select_park,
                "ticket_type_name" : this.ticket_type_name
            }
            
            var success ='';
            var value = '';
            $.ajax({ 
                type : 'POST',
                url  : "<?= site_url('setup/cticket_type/save_new')?>",
                dataType : 'json',
                async : false,
                data : { 
                   arr_data : arr_data,
                   h_typeno   : this.h_typeno,
                   h_ticket_type_name : this.h_ticket_type_name
                   
                },
                success:function(data){ 
                    success = data.success;
                    value = data.value;
                }
            });

            if(success == "true"){              
                $('#myModal_confirm').modal('hide');
                this.show_ticket(1,$('#total_display').val()-0,$('#hd_fname').val(),$('#hd_order').val());
                this.clear_text();
            }
        }

        this.show_ticket = function show(current_page,total_display,fname,order){
            offset = ((current_page - 1) * total_display) - 0;
            limit = total_display - 0;
            $.ajax({ 
                type : 'POST',
                url  : "<?= site_url('setup/cticket_type/show_ticket')?>",
                dataType : 'json',
                async : false,
                data : { 
                    offset : offset,
                    limit  : limit,
                    fname  : fname,
                    order  : order,
                    s_name_t : this.s_name_t,
                    s_park_t : this.s_park_t,
                    s_qty_day_t : this.s_qty_day_t,
                    s_price_t : this.s_price_t
                },
                success:function(data){
                    // console.log(data); return false;
                    var total_records = data.total_records;
                    var total_pages = data.total_pages;
                    var result_sql = data.result_sql;
                    var pagination = '';
                    if(result_sql.length > 0){
                        var tr = ""; 
                        $.each(result_sql,function(i,row){ 
                            tr += '<tr>'+
                                    '<td>'+(i+1)+'</td>'+
                                    '<td>'+(row.tickettype_name != null ? row.tickettype_name :'')+'</td>'+
                                    '<td>'+(row.park_name != null ? row.park_name :'')+'</td>'+
                                    '<td>'+(row.qty_day != null ? row.qty_day :'')+'</td>'+
                                    '<td>'+(row.price != null ? row.price : '')+'</td>'+
                                    '<td>'+(row.description != null ? row.description :'')+'</td>'+
                                    '<td align="center" class="remove_tag">';
                                        if("<?php echo $this->green->gAction('U') ?>"){

                                            tr += '<a href="javascript:void(0)" id="a_edit" class="a_edit" attr_tyno='+row.tic_type_typeno+'>'+
                                                '<img rel="2510" height="15" width="15" src="<?= base_url("/assets/images/icons/edit.png")?>">'+
                                            '</a> &nbsp; &nbsp; &nbsp; &nbsp;';
                                        }

                                        if("<?php echo $this->green->gAction('D') ?>"){ 

                                            tr += '<a href="javascript:void(0)" class="a_delete" id="a_delete" attr_tyno='+row.tic_type_typeno+'>'+
                                                '<img rel="2510" src="<?= base_url("/assets/images/icons/delete.png")?>">'+
                                            '</a>';
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
                                '<td colspan="6" align="center"><i style="font-size:16px; color:red;">Sorry, the result not data.</i></td>'+
                            '</tr>'+
                            '<tr>'+ 
                                '<td colspan="6"><td>'
                            '</tr>';
                    }

                    $('#show_tbl').html(tr);
                    $('#show_tbl_ex').html(tr);
                    $('#pagination-grid').html(pagination);
                }
            });
        }

        this.edit_ticket = function edit(attr_tyno){
            $.ajax({ 
                type : 'POST',
                url  : "<?= site_url('setup/cticket_type/edit_ticket')?>",
                dataType : "json",
                async : false,
                data : { 
                    attr_tyno : attr_tyno
                },
                success:function(data){
                    // console.log(data);
                    $('#title_modal').text('Edit Ticket Type'); 
                    $('#myModal_ticket').modal({backdrop : 'static'});
                    $('#h_typeno').val(data.tic_type_typeno);
                    $('#description_t').val(data.description);
                    $('#ticket_type_name').val(data.tickettype_name);
                    $('#price_t').val(data.price);
                    $('#h_ticket_type_name').val(data.tickettype_name);
                    $('#qty_date').val(data.qty_day);
                    $('#select_park').val(data.par_typeno);
                }
            });
        }

        this.delete_ticket = function delete_t(attr_tyno){ 
            var success = '';
            $.ajax({ 
                type : 'POST',
                url  : "<?= site_url('setup/cticket_type/delete_ticket')?>",
                dataType : 'json',
                async : false,
                data : { 
                    attr_tyno : attr_tyno
                },
                success:function(data){ 
                    // console.log(data);
                    // success = data.success;
                }
            });

            this.show_ticket(1,$('#total_display').val()-0,$('#hd_fname').val(),$('#hd_order').val());
                
        }

        this.clear_text = function clear(){ 
            $('#h_typeno').val('');
            $('#description_t').val('');
            $('#price_t').val('');
            $('#h_ticket_type_name').val('');
            $('#qty_date').val(1);
            $('#select_park').val('');
            $('#ticket_type_name').val('');
        }
    }

    function input_price(e,this_clear,title){
     
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
            this_clear.val('');
        }
    }

    function fn_print(){
        $(".remove_inv").removeAttr("href");
        var title   = "<center><span style='font-weight:bold; font-size:16px;'>Ticket Type List</span></center><br>";
       
        var data = $("#dv-print").html().replace(/<img[^>]*>/gi,"");
        var export_data = $("<center>"+data+"</center>").clone().find(".remove_tag").remove().end().html();
        //export_data+=htmlToPrint;
        return title+"####"+export_data;
    }

    function fn_ex(){
        $(".remove_inv").removeAttr("href");
        var title   = "<center><span style='font-weight:bold; font-size:16px;'>Ticket Type List</span></center><br>";
       
        var data = $("#div-ex").html().replace(/<img[^>]*>/gi,"");
        var export_data = $("<center>"+data+"</center>").clone().find(".remove_tag").remove().end().html();
        //export_data+=htmlToPrint;
        return title+"####"+export_data;
    }

    function clear_textbox_search(){ 
        $('#s_name_t').val('');
        $('#s_park_t').val(''); 
        $('#s_qty_day_t').val('');
        $('#s_price_t').val('');
    }

    // function readURL(input) {
    //     if (input.files && input.files[0]) {
    //         var reader = new FileReader();
    //         reader.onload = function (e) {
    //             $('#img_park').attr('src', e.target.result);
    //         };
    //         reader.readAsDataURL(input.files[0]);
    //     }
    // }

    // function reload_img() {
    //     $("#frm_photo").submit();
    // }

    function clear_text_park(){ 
        $('#par_typeno').val("");
        $('#location').val("");
        $('#park_name').val("");
        $('#description').val("");
    }

    function myModal_confirm(tick_name,park_name,save_new){
        if(save_new == "true"){ 
            $('#save_new').show();
        }else{ 
            $('#save_new').hide();
        }
        $('#myModal_confirm').modal({backdrop : false});
        $('#title_confirm').text(tick_name+" go to "+park_name+" is duplicate.");
        $('#title_confirm').css({'color' :'red','font-size' : '16px'});
        $('#con_answer').css({'color' :'red','font-size' : '16px'});
        $('.modal_confirm').css({'top' : '25%'});
    }

</script>