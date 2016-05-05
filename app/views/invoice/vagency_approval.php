<?php
    $sql_currency = $this->db->query("SELECT 
                                                set_currencies.cur_typeno,
                                                set_currencies.cur_type,
                                                set_currencies.curcode,
                                                set_currencies.rate,
                                                set_currencies.symbol
                                                FROM set_currencies
                                                WHERE cur_default=1")->row();
    if($agecy_trans_typeno !=''){ 
   
        $query_edit = $this->db->query("SELECT
                                        tran_agency_approval.agency_trans_typeno,
                                        tran_agency_approval.agency_typeno,
                                        tran_agency_approval.visitor_number,
                                        date(tran_agency_approval.visit_date) as this_visit_date,
                                        tran_agency_approval.description,
                                        tran_agency_approval.amount,
                                        tran_agency_approval.disocunt,
                                        tran_agency_approval.payment,
                                        tran_agency_approval.agency_refer_code,
                                        tran_agency_approval.reguester_by,
                                        tran_agency_approval.balance,
                                        tran_agency_approval.authorize_by
                                    FROM
                                        tran_agency_approval 
                                    WHERE agency_trans_typeno = '".$agecy_trans_typeno."'");

        if($query_edit->num_rows() > 0){ 
            $agency = $query_edit->row()->agency_typeno;
            $agency_name = $this->db->query("SELECT agency_name FROM set_agency_register WHERE agency_typeno = '".$agency."'")->row()->agency_name;
            $is_agency = $this->db->query("SELECT is_agency FROM set_agency_register WHERE agency_typeno = '".$agency."'")->row()->is_agency;
            $visitor_number = $query_edit->row()->visitor_number;
            $description = $query_edit->row()->description;
            $reguester_by = $query_edit->row()->reguester_by;
            $agency_refer_code = $query_edit->row()->agency_refer_code;
            $amount = $query_edit->row()->amount;
            $disocunt = $query_edit->row()->disocunt;
            $payment = $query_edit->row()->payment;
            $balance = $query_edit->row()->balance;
            $authorize_by = $query_edit->row()->authorize_by;

            $this_date = date('d-m-Y',strtotime($query_edit->row()->this_visit_date));

            $query_app_detail = $this->db->query("SELECT
                                                    tran_agency_approval_detail.package_typeno,
                                                    (tran_agency_approval_detail.price) AS price,
                                                    (tran_agency_approval_detail.discount) AS discount,
                                                    (tran_agency_approval_detail.amount) AS amount,
                                                    tran_agency_approval_detail.agency_trans_typeno
                                                FROM
                                                    tran_agency_approval_detail 
                                                WHERE agency_trans_typeno = '".$agecy_trans_typeno."'");
            
            if($query_app_detail->num_rows() > 0){ 
                $tr = '';
                $i = 1;
                foreach($query_app_detail->result() as $row_detail){ 

                    $select_pk = $this->db->query("SELECT
                                                    set_park_package.package_name,
                                                    set_park_package.package_typeno
                                                FROM
                                                    set_park_package
                                                WHERE is_active=1
                                                ORDER BY type_of");
                    $option = '<option></option>';
                    if($select_pk->num_rows() > 0){ 
                        $select = '';
                        foreach($select_pk->result() as $row_option){ 
                            if($row_detail->package_typeno == $row_option->package_typeno){ 
                                $select = 'selected';    
                            }else{ 
                                $select = '';
                            }

                            $option .= '<option value='.$row_option->package_typeno.' '.$select.'>'.$row_option->package_name.'</option>';
                        }
                    }

                    $tr .= '<tr>
                            <td class="munber_no">'.$i.'</td>
                            <td style="width:23%"><select class="form-control select_package" count_num='.$i.' num_d="1">'.$option.'</select></td>
                            <td><input type="text" class="form-control input-xs price" id="price" style="text-align:right" value='.$row_detail->price.'><input type="hidden" class="hdd_price" value='.$row_detail->price.'></td>
                            <td><input type="text" class="form-control input-xs discount" id="discount" style="text-align:right" value='.$row_detail->discount.'><input type="hidden" class="hdd_discount" value='.$row_detail->discount.'></td>
                            <td style="width:23%"><span class="form-control input-xs amount" style="text-align:right;width:90%;float:left;">'.$row_detail->amount.'</span><span style="float:left;margin:5px 0 0 5px;">'.$sql_currency->symbol.'</span><input type="hidden" class="hdd_amount" value='.$row_detail->amount.'></td>
                            <td style="text-align:center">
                                <a href="javascript:void(0)" class="a_delete">
                                    <img rel="2510" src='.base_url("/assets/images/icons/delete.png").' style="padding-top:10px;">
                                </a>
                            </td>
                        </tr>';

                        $i++;
                }
            }
        }

    }else{
        $agency = '';
        $agency_name = '';
        $description = '';
        $reguester_by = '';
        $agency_refer_code = '';
        $amount = 0;
        $disocunt = 0;
        $payment = 0;
        $balance = 0;
        $visitor_number = '';
        $authorize_by = '';
        $is_agency = '';
        $tr = '';
        $this_date = $this->green->gdate_format();
    }
    
?>
<div class="wrapper">
    <div class="col-sm-12">
        <div class="row result_info">
            <div class="col-xs-8"><h5>Agency Approval</h5></div>
            <div class="col-xs-4"><h5 id="msg_save" style="color:blue"> </h5></div>            
        </div>
    </div>
    <br>
    <form id="form_validate" class="form_v">
    <div class="col-sm-12">
        <div class="col-sm-6">
            <label class="control-label">Tour Class <span style="color:red">*</span></label>
            <select class="form-control" id="tour_class" data-parsley-required="true" data-parsley-error-message="This field required !">
                <option value=""></option>
                <option value="1">Agency</option>
                <option value="0">Group</option>
                <option value="2">School</option>
                <option value="3">Organization</option>
            </select>

        </div>

        <div class="col-sm-6">
            <label class="control-label">Agency <span style="color:red">*</span></label>
            <input type="text" id="agency_auto" value="<?php echo $agency_name; ?>" class="form-control input-xs" data-parsley-required="true" data-parsley-error-message="This field required !" placeholder=" "/>
            <input type="hidden" id="h_agency_auto" value="">
            <input type="hidden" id="agency_typeno" value="<?php echo $agency; ?>">
        </div>
        <!-- <div class="col-sm-3">
            <label class="control-label"> &nbsp;</label>
            <input type="text" placeholder="" id="agency_name" class="form-control input-xs" /> 
        </div> -->
    </div>
    <div class="col-sm-12">    
        <div class="col-sm-6">
            <label class="control-label">Authurization by <span style="color:red">*</span></label>
            <select placeholder="" id="authuriz_by" class="form-control input-xs" data-parsley-required="true" data-parsley-error-message="This field required !"/>
                <?php echo $option_user; ?>
            </select>
        </div>
        
        <div class="col-sm-6">
            <label class="control-label">Number Visitor <span style="color:red">*</span></label>
            <input type="text" placeholder="" value="<?php echo $visitor_number; ?>" id="number_visitor" class="form-control input-xs" data-parsley-required="true" data-parsley-error-message="This field required !"/>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="col-sm-6">
            <label class="control-label">Tour Reference</label>
            <input type="text" placeholder="" value="<?php echo $agency_refer_code; ?>" id="tour_reference" class="form-control input-xs" data-parsley-required="true" data-parsley-error-message="This field required !"/>
        </div>
   
        <div class="col-sm-6">
            <label class="control-label">Tour Guide <span style="color:red">*</span></label>
            <input type="text" placeholder="" value="<?php echo $reguester_by; ?>" id="tour_garde" class="form-control input-xs" data-parsley-required="true" data-parsley-error-message="This field required !"/>
        </div>
    </div>
    <div class="col-sm-12">
        
        <div class="col-sm-6">
            <label class="control-label">Visit Date <span style="color:red">*</span></label>
            <input type="text" placeholder="" id="visit_date" class="form-control input-xs" value="<?php echo $this_date; ?>" data-parsley-required="true" data-parsley-error-message="This field required !"/>
        </div>
    
        <div class="col-sm-6">
            <label class="control-label">Note</label>
            <textarea class="form-control input-xs" id="note"><?php echo $description; ?></textarea>
        </div>
    </div>
    </form>        
    <label class="control-label">&nbsp;</label>
    <div class="col-sm-12">
            <div class="table-responsive" id="table_pro">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width:50px;">No</th>
                                <th>Park/Package</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Amount</th>
                                <th class="th_add col-sm-1" style="text-align:center; width:50px;"> 
                                    <div id="add" style="width:100%"><img src="<?= base_url('assets/images/icons/adds.png') ?>" width="25px;">
                                </th>
                            </tr>
                        </thead>
                        <tbody id="add_tr">
                            <?php echo $tr; ?>
                        </tbody>
                    </table>
            </div>
    </div>
    <div class="col-sm-10" style="margin:0px;padding:0px !important;float:right !important;">
       
        <div class="col-sm-2" style="padding:0px;margin:2px;">
            <label><strong>Total(<?=$sql_currency->symbol ?>)</strong></label>
            <span class="form-control total_amt" style="text-align:right;"><?php echo $amount; ?></span>
            <input type="hidden" class="hdd_total_amt" value="<?php echo $amount; ?>">
        </div>
        <div class="col-sm-2" style="padding:0px;margin:2px;">
            <label><strong>Discount(<?=$sql_currency->symbol ?>)</strong></label>
            <input type="text" class="form-control discount_amt" value="<?php echo $disocunt; ?>" style="text-align:right;">
            <input type="hidden" class="hdd_discount_amt" value="<?php echo $disocunt; ?>">
        </div>
        <div class="col-sm-2" style="padding:0px;margin:2px;">
            <label><strong>Payment(<?=$sql_currency->symbol ?>)</strong></label>
            <input type="text" class="form-control payment_amt" value="<?php echo $payment; ?>" style="text-align:right;">
            <input type="hidden" class="hdd_payment_amt" value="<?php echo $payment; ?>">
        </div>
        <div class="col-sm-2" style="padding:0px;margin:2px;">
            <label id="show_balance"><strong>Balance(<?=$sql_currency->symbol ?>)</strong></label>
            <label id="show_change" style="display: none;"><strong>Change(<?=$sql_currency->symbol ?>)</strong></label>
            <span class="form-control balance_amt" style="text-align:right;"><?php echo $balance; ?></span>
            <input type="hidden" class="hdd_balance_amt"  value="<?php echo $balance; ?>">
        </div>
        
        <div class="col-sm-3" style="padding:0px;margin:23px 0 0px 2px;">
            <input type="hidden" id="hdd_edit_app" value="<?php echo $agecy_trans_typeno; ?>">
            <button class="btn btn-primary" id="save">Save</button>
        </div>
    </div>
    <div style="clear:both"></div>
</div>

<div class="modal fade" id="confirm_modal">
    <div class="modal-dialog modal_msg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title" align="center"><span id="title"></span></div>
            </div>
            <div class="modal-footer f1">
                <button type="button" id="btn_delete" style="display:none" data-dismiss="modal" class="btn btn-danger button_del">Delete</button>
                <button type="button" id="btn_ok" style="display:none" data-dismiss="modal" class="btn btn-primary button_ok">OK</button>
                <button type="button" class="btn btn-primary" id="close_msg" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    #table_pro{ border-right:0px solid #f3f1f0; height:100%; height:420px; margin:0; padding:0;}

    .th_add:hover{ box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(102, 175, 233, 0.6); border-color: #66afe9; cursor: pointer;}
</style>
<script type="text/javascript">

    $(function(){
        // clear();
        // this event happend when load first data
        $(".price").each(function(){
            var tr = $(this).parent().parent();
            var disc = tr.find(".hdd_discount").val();
            var amt  = tr.find(".hdd_amount").val();
            var price = tr.find(".hdd_price").val();
            $(this).val(formatNumber(parseFloat(price).toFixed(3)));
            tr.find(".discount").val(formatNumber(parseFloat(disc).toFixed(3)));
            tr.find(".amount").text(formatNumber(parseFloat(amt).toFixed(3)));
        });
        var total_amt = $(".hdd_total_amt").val();
        var disc_amt = $(".hdd_discount_amt").val();
        var pay_amt = $(".hdd_payment_amt").val();
        var bal_amt = $(".hdd_balance_amt").val();
        $(".total_amt").text(formatNumber(parseFloat(total_amt).toFixed(3)));
        $(".discount_amt").val(formatNumber(parseFloat(disc_amt).toFixed(3)));
        $(".payment_amt").val(formatNumber(parseFloat(pay_amt).toFixed(3)));
        $(".balance_amt").text(formatNumber(parseFloat(bal_amt).toFixed(3)));

        $(".hdd_total_amt").val(parseFloat(total_amt).toFixed(3));
        $(".hdd_discount_amt").val(parseFloat(disc_amt).toFixed(3));
        $(".hdd_payment_amt").val(parseFloat(pay_amt).toFixed(3));
        $(".hdd_balance_amt").val(parseFloat(bal_amt).toFixed(3));
        // end this event load first data
        
        if($('#hdd_edit_app').val() !=''){ 
            $('#authuriz_by').val(<?php echo $authorize_by; ?>);
            $('#tour_class').val(<?php echo $is_agency; ?>); 
        }else{ 
            add_row();
        }
              
        $('#save').click(function(){
            if($('#form_validate').parsley().validate()){ 
                if($('.select_package').val() !=''){
                    confirm_modal('Do you want to save ?',2);
                }else{ 
                    // alert('Please select package before save.');
                    confirm_modal('Please select package before save.',0);
                }
            }            
        });

        $('body').delegate('.button_ok','click',function(){ 
            var obj_save = new pro_agency_approval();
            obj_save.save_approval();
        });

        $("body").delegate('.select_package',"change",function(){
            var val_select = $(this).val();
            var aa = 0,bb=0;
            $(".select_package").each(function(){
                var each_val = $(this).val();
                if(val_select == each_val && each_val !=""){
                    aa++;
                }
                if(each_val == ""){
                    bb++;
                }
            });
            if(aa > 1){
                alert("Package is duplication. Please try again");
                $(this).val("");
                return false;
            }else{
                if(bb == 0){
                    add_row();
                }
            }
            

            // var att = $(this).attr('count_num')-0;
            // var num_d = $(this).attr('num_d')-0;
            // var re_each = 0;
            // $('.select_package').each(function(){ 
            //     re_each += $('.select_package').attr('num_d')-0; 
            // });

            // var get_this = $(this);
            // var e_this = $(this).val();
            // var this_selected = 0;
            // var obj_save = new pro_agency_approval();
            // $('.select_package').each(function(i){         
               
            //     if(e_this == $(this).val()){
            //         this_selected++;
            //     }
            // });
            // if($(this).val() ==''){ 
            //     this_selected = 0;
            //     value_zero($(this));
            //     total_amount();
            //     discount_amt();
            //     payment_amt();
            // }else if(this_selected > 1){
            //     // alert("Duplication value");
            //     confirm_modal('Package is duplication. Please try again.',0);
            //     $(this).val("");
            // }else if($(this).val() !=''){ 
            //     if(att == re_each){ 
            //         add_row();
            //     }
            // }
            
        });

        $('body').delegate('.ui-menu-item','click',function(){
            $('#agency_auto').parsley().destroy();
            $('#h_agency_auto').val('');
        });

        $('body').delegate('.form_v','click',function(){ 
            $('#msg_save').text(' ');
        });

        $('#add').click(function(){ 
            add_row();
        });

        $('#agency_auto').focus(function(){ 
            var tour_class = $('#tour_class').val();
            agency_auto($(this),tour_class);
        });

        $('#agency_auto').keyup(function(){ 
            $("#h_agency_auto").val($(this).val());
            // if($(this).val() == ''){ 
            //     $('#agency_name').val('');
            // }
        });

        $('#agency_name').focus(function(){ 
            $(this).attr("readonly", "readonly");
        });

        $('#agency_name').on('blur',function(){ 
            $(this).removeAttr("readonly");
        });

        $('#agency_auto').on('blur',function(){ 
            var h_agency_auto = $("#h_agency_auto").val();
            var tour_class = $('#tour_class').val();
            // alert(h_agency_auto);
            var obj_check = new pro_agency_approval();
            obj_check.check_agency(h_agency_auto,tour_class);
        });        

        $('body').delegate('.a_delete','click',function(){ 
            var tr = $(this).parent().parent();
            if($('#add_tr tr').size()-0 == 1){ 
                return false;
            }else{ 
                tr.find('td').css({'background-color' : '#DBDBDB'});
                confirm_modal('Are you sour to delete ?',1);
                $('body').delegate('#btn_delete','click',function(){ 
                    tr.remove();
                    total_amount();
                    discount_amt();
                    payment_amt();
                    $('.munber_no').each(function(i){ 
                        $(this).html(i+1);
                    });
                });
            }
        });

        $('body').delegate('#close_msg','click',function(){ 
            $('#add_tr td').css({'background-color' : ''});
        });

        $("#visit_date").datepicker({
            language: 'en',
            pick12HourFormat: true,
            format:"<?php echo $this->green->jdate_format();?>",
            autoclose : true
        });

        $("body").delegate(".price","blur",function(e){
            var this_value = $(this).val()-0;
            $(this).closest("td").find(".hdd_price").val(parseFloat(this_value).toFixed(3));
            $(this).val(formatNumber(parseFloat(this_value).toFixed(3)));  
            total_amount_package($(this));
            total_amount();
            discount_amt();
            $(this).removeAttr("readonly");
        });

        $("body").delegate(".price","focus",function(e){
            var this_package = $(this).parent().parent();
            if(this_package.find('.select_package').val() ==''){
                // alert('Please select package before input price');
                //confirm_modal('Please select package before input price',0);
                alert('Please select package before input price');
                $(this).val(parseFloat(0).toFixed(3));
            }else{
                var hdd_value = $(this).closest("td").find(".hdd_price").val();
                $(this).val(parseFloat(hdd_value).toFixed(3));
                $(this).select();
            }
            
        });

        $("body").delegate(".discount","blur",function(e){ 
            var this_parent = $(this).parent().parent();
            var this_value = $(this).val()-0;
            this_parent.find('.hdd_discount').val(parseFloat(this_value).toFixed(3));
            $(this).val(formatNumber(parseFloat(this_value).toFixed(3)));
            total_amount_package($(this));
            total_amount();
            discount_amt();
            $(this).removeAttr("readonly");

        });

        $('body').delegate('.discount','focus',function(e){ 
            var tr = $(this).parent().parent();
            if(tr.find(".select_package").val() == ""){
                alert('Please select package before input discount.');
                $(this).val(parseFloat(0).toFixed(3));
            }else{
                var hdd_value = tr.find('.hdd_discount').val();
                $(this).val(parseFloat(hdd_value).toFixed(3));
                $(this).select();
            }
            
        });

        $('body').delegate('.discount_amt',"blur",function(e){ 
            var this_value = $(this).val()-0;
            $('.hdd_discount_amt').val(parseFloat(this_value).toFixed(3));
            $(this).val(formatNumber(parseFloat(this_value).toFixed(3)));
            discount_amt();
            $(this).removeAttr("readonly");
        });

        $('body').delegate('.discount_amt','focus',function(e){ 
            var hdd_value = $('.hdd_discount_amt').val();
            $(this).val(parseFloat(hdd_value).toFixed(3));
            $(this).select();
        });

        $('body').delegate('.payment_amt','blur',function(e){ 
            var this_value = $(this).val()-0;
            $('.hdd_payment_amt').val(parseFloat(this_value).toFixed(3));
            $(this).val(formatNumber(parseFloat(this_value).toFixed(3)));
            payment_amt();
        });

        $('body').delegate('.payment_amt','focus',function(e){ 
            var hdd_value = $('.hdd_payment_amt').val();
            $(this).val(parseFloat(hdd_value).toFixed(3));
            $(this).select();
        });

        $('body').delegate('#number_visitor','blur',function(){ 
            $(this).removeAttr("readonly");
        });

        $("body").delegate(".discount_amt,.payment_amt,.price,.discount,#number_visitor","keydown", function (e) {
            if ((e.keyCode >= 96 && e.keyCode <= 105) || (e.keyCode >= 48 && e.keyCode <= 57) || e.keyCode == 8 || e.keyCode == 190 || e.keyCode == 110) {
                $(this).removeAttr("readonly");
            } else {
                $(this).attr("readonly", "readonly");
            }
        }); 


    });

    function pro_agency_approval(){ 
        
        this.agency_typeno = $('#agency_typeno').val();
        this.number_visitor = $('#number_visitor').val();
        this.visit_date = $('#visit_date').val();
        this.tour_garde = $('#tour_garde').val();
        this.tour_reference = $('#tour_reference').val();
        this.note = $('#note').val();

        this.total_amt = $('.hdd_total_amt').val();
        this.discount_amt = $('.hdd_discount_amt').val();
        this.payment_amt = $('.hdd_payment_amt').val();
        this.balance_amt = $('.hdd_balance_amt').val();

        this.authuriz_by = $('#authuriz_by').val();
        this.hdd_edit_app = $('#hdd_edit_app').val();

        var array_data = [];

        $('.select_package').each(function(i){ 
            this.park_package = $(this).val();
            if(this.park_package != ''){ 
                var tr = $(this).parent().parent();
                this.price = tr.find('.hdd_price').val();
                this.discount = tr.find('.hdd_discount').val();
                this.amount = tr.find('.hdd_amount').val();

                array_data[i] = { 
                    'park_package' : this.park_package,
                    'price' : this.price,
                    'discount' : this.discount,
                    'amount' : this.amount
                }
            }

        });

        this.save_approval = function save(){ 
            $.ajax({ 
                type : 'POST',
                url : "<?= site_url('invoice/cagency_approval/save_approval')?>",
                dataType : 'JSON',
                async : false,
                data : { 
                    
                    agency_typeno : this.agency_typeno,
                    number_visitor : this.number_visitor,
                    visit_date : this.visit_date,
                    tour_garde : this.tour_garde,
                    tour_reference : this.tour_reference,
                    note : this.note,
                    total_amt : this.total_amt,
                    discount_amt : this.discount_amt,
                    payment_amt : this.payment_amt,
                    balance_amt : this.balance_amt,
                    authuriz_by : this.authuriz_by,
                    hdd_edit_app : this.hdd_edit_app,
                    array_data :  array_data
                },
                success:function(data){ 
                    // console.log(data);
                    // var agency_trans_typeno = data.agency_trans_typeno;
                    clear();
                    $('#add_tr tr').remove();
                    add_row();
                    $('#msg_save').text('Successful');
                    // window.open('c_tour_group_ticket/index?agency_trans_typeno='+agency_trans_typeno+'');
                }
            });
        }

        this.check_package = function check_pk(pk_tyno,get_this){ 
            $.ajax({ 
                type : 'POST',
                url  : "<?= site_url('invoice/cagency_approval/check_package')?>",
                dataType : 'JSON',
                async : false,
                data : { 
                    pk_tyno : pk_tyno
                },
                success:function(data){ 
                    //console.log(data);
                    // var data_console = data.sql_check;
                //     if(data_console == 0){ 
                //         alert("This package can't approval. Please setup prefix ");
                //         get_this.val('');
                //         value_zero(get_this);
                //         total_amount();
                //         discount_amt();
                //         payment_amt();
                //     }
                }
            });
        }

        this.check_agency = function ch_agency(get_value,tour_class){ 
            $.ajax({ 
                type : "POST",
                url : "<?= site_url('invoice/cagency_approval/check_agency')?>",
                dataType : 'JSON',
                async : false,
                data : { 
                    get_value : get_value,
                    tour_class : tour_class
                },
                success : function(data){ 
                    // console.log(data.agency_typeno);w
                    var result_value = data.agency_typeno;
                    if(result_value != 0 && result_value != 1){ 
                        // $('#agency_auto').val('');
                        $('#h_agency_auto').val('');
                        $("#agency_typeno").val(result_value);
                        // $("#agency_name").val('');
                    }else if(result_value == 1){ 
                        return false;
                    }else{

                        $('#h_agency_auto').val('');
                        $('#agency_auto').val('');
                        $("#agency_typeno").val('');
                    }
                }
            });
        }
    }

    function add_row(){ 
        var outo_no = $('#add_tr tr').size()-0+1;
        // alert(outo_no);
        var tr ='<tr>'+
                '<td class="munber_no">'+outo_no+'</td>'+
                '<td style="width:23%"><select class="form-control select_package" count_num='+outo_no+' num_d="1"> <?php echo $option_package; ?> </select></td>'+
                '<td><input type="text" class="form-control input-xs price" id="price" style="text-align:right" value="0.000"><input type="hidden" class="hdd_price" value="0.000"></td>'+
                '<td><input type="text" class="form-control input-xs discount" id="discount" style="text-align:right" value="0.000"><input type="hidden" class="hdd_discount" value="0.000"></td>'+
                '<td style="width:23%"><span class="form-control  amount" style="text-align:right;width:90%;float:left;">0.000</span><span style="float:left;margin:5px 0px 0px 5px;"><?=$sql_currency->symbol ?></span><input type="hidden" class="hdd_amount"></td>'+
                '<td style="text-align:center">'+
                    '<a href="javascript:void(0)" class="a_delete">'+ 
                        '<img rel="2510" src="<?= base_url("/assets/images/icons/delete.png")?>" style="padding-top:10px;">'+
                    '</a>'+
                '</td>'+
            '</tr>';
        $('#add_tr').append(tr);
    }

    function total_amount_package(e_this){ 
        var price = e_this.parent().parent().find('.hdd_price').val()-0;
        var discount = e_this.parent().parent().find('.hdd_discount').val()-0;
        var amount = 0;
        if(price >= discount){ 
            amount = parseFloat(price - discount).toFixed(3);
        }else{ 
            // alert('discount > price');
            alert("Can not input discount bigger than price.",0);
            e_this.val(parseFloat(0).toFixed(3));
            e_this.parent().parent().find('.hdd_discount').val(0);
            amount = (price - 0)-0;
        }
        e_this.parent().parent().find('.hdd_amount').val(parseFloat(amount).toFixed(3));
        e_this.parent().parent().find('.amount').text(formatNumber(parseFloat(amount).toFixed(3)));
    }

    function total_amount(){ 
        var total = 0;
        $('.hdd_amount').each(function(){ 
            var amount = $(this).val()-0;
            total = total + amount -0;
        });
        $('.hdd_total_amt').val(parseFloat(total).toFixed(3));
        $('.total_amt').text(formatNumber(parseFloat(total).toFixed(3)));
        $('.hdd_payment_amt').val(parseFloat(total).toFixed(3));
        $('.payment_amt').val(formatNumber(parseFloat(total).toFixed(3)));
        $('.hdd_payment_amt').val(parseFloat(total).toFixed(3));
    }

    function discount_amt(){ 
        var total_amount = $('.hdd_total_amt').val()-0;
        var discount_ = $('.hdd_discount_amt').val()-0;
        var balance_amt = $('.hdd_balance_amt').val()-0;
        var hdd_payment_amt = $('.hdd_payment_amt').val()-0;
        var payment = 0;
        if(total_amount >= discount_){ 
            //payment = parseFloat(total_amount - discount_).toFixed(3);
            var total_pay = parseFloat(discount_+hdd_payment_amt).toFixed(3);
            var total_balance = parseFloat(total_amount-total_pay).toFixed(3);
            if(total_balance < 0){
                $("#show_change").show();
                $("#show_balance").hide();
            }else{
                $("#show_balance").show();
                $("#show_change").hide();
            }
            $(".balance_amt").text(formatNumber(total_balance));
        }else{ 
            // alert('discount > amount');
            confirm_modal("Can not input discount > amount",0);
            $('.discount_amt').val(parseFloat(0).toFixed(3));
            $('.hdd_payment_amt').val(parseFloat(total_amount).toFixed(3));
            $("#payment_amt").val(formatNumber(parseFloat(total_amount).toFixed(3)));
            $(".balance_amt").text(parseFloat(0).toFixed(3));
            $('.hdd_discount_amt').val(parseFloat(0).toFixed(3));
            //payment = (total_amount - 0)-0;
        }
        
        //$('.hdd_payment_amt').val(parseFloat(payment - balance_amt).toFixed(3));
        //$('.payment_amt').val(formatNumber(parseFloat(payment - balance_amt).toFixed(3)))-0;
        //}
        //$('.hdd_payment_amt').val(number_format(payment,4) - number_format(balance_amt,4))-0;
        //$('.payment_amt').val(formatNumber (number_format(payment,4) - number_format(balance_amt,4)))-0;
    }

    function payment_amt(){ 
        var total_amount = $('.hdd_total_amt').val()-0;
        var discount_ = $('.hdd_discount_amt').val()-0;
        var payment_amt = $('.hdd_payment_amt').val()-0;
        var total_p  = parseFloat(discount_ + payment_amt).toFixed(3);
        var total_b  = parseFloat(total_amount - total_p).toFixed(3);
        if(total_b < 0){
            $("#show_change").show();
            $("#show_balance").hide();
        }else{
            $("#show_balance").show();
            $("#show_change").hide();
        }
        $('.balance_amt').text(formatNumber(total_b));
        //$('.hdd_balance_amt').val(balance_amt)-0;
        //var balance_amt = (number_format(total_amount,4) - number_format(discount_,4) - number_format(payment_amt,4))-0;
        //$('.balance_amt').text(formatNumber (number_format(balance_amt,4)))-0;
        //$('.hdd_balance_amt').val(number_format(number_format(balance_amt,4)))-0;
    }

    function formatNumber (num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
    }

    function number_format(val,decimal){
        if(decimal=="" || decimal==0){
        decimal=3;
        }  
        return parseFloat(val).toFixed(decimal);   
    }

    function clear(){ 
       
        
        $('#number_visitor').val('');
        // $('#visit_date').val('');
        $('#tour_garde').val('');
        $('#tour_reference').val('');
        $('#note').val('');
        $('.total_amt').text(0);
        $('.discount_amt').val(0);
        $('.payment_amt').val(0);
        $('.balance_amt').text(0);

        $('.hdd_total_amt').val(0);
        $('.hdd_discount_amt').val(0);
        $('.hdd_payment_amt').val(0);
        $('.hdd_balance_amt').val(0);

        $('#tour_class').val('');
        $('#authuriz_by').val('');
        $('#agency_auto').val('');
        $('#h_agency_auto').val('');
        $('#agency_typeno').val('');
    
    }

    function value_zero(this_value){ 
        this_value.parent().parent().find('.price').val(0);
        this_value.parent().parent().find('.hdd_price').val(0);
        this_value.parent().parent().find('.discount').val(0);
        this_value.parent().parent().find('.hdd_discount').val(0);
        this_value.parent().parent().find('.amount').text(0);
        this_value.parent().parent().find('.hdd_amount').val(0);
    }

    function confirm_modal(title,num){
        var width_model = '';
        if(num == 1){
            $('.button_del').show();
            $('.button_ok').hide();
            width_model = '280px';
        }else if(num == 0){ 
            $('.button_del').hide();
            $('.button_ok').hide();
            width_model = '';
        }else{ 
            $('.button_ok').show();
            $('.button_del').hide();
            width_model = '280px';
        }

        $("#confirm_modal").modal({'backdrop' : false});            
        $('#title').html(title);
        $('#title').css({'color': 'red' , 'font-size' : '16px'});
        $('.modal_msg').css({'top' : '30%','width' : width_model });
    }

    function agency_auto(this_click,tour_class){ 

        var url = "<?php echo  site_url('invoice/cagency_approval/agency_auto?tour_class="+tour_class+"')?>";
        $("#agency_auto").autocomplete({
            source: url,
            minLength:0,
            focus : function(event, ui){ 
                this_click.val(ui.item.value);
                $('#h_agency_auto').val(ui.item.agency_code);
                $("#agency_typeno").val(ui.item.agency_typeno);
            },

            select: function (event, ui) {

                this_click.val(ui.item.value);
                $('#h_agency_auto').val(ui.item.agency_code);
                $("#agency_typeno").val(ui.item.agency_typeno);
                
                return false;
            }      
        });
    }

</script>

