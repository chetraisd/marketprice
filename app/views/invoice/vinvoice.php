<div class="contain">
        <div class="result_info">
            <div class="col-xs-9" style="text-align:left;"><?php echo $this->lang->line("create_invoice")?></div>
        </div>
        <div class="col-sm-12">
            <div class="col-sm-5">
                <label class="control-label"><?php echo $this->lang->line("cust_name")?><span style="color:red;">*</span></label>
                <input type="text" id="invcustname" name="invcustname" class="form-control"/>
                <input type="hidden" id="cust_code" name="cust_code" class="form-control input-xs"/>
                <input type="hidden" name="h_currency" id="h_currency" class="h_currency">

            </div>
            <div class="col-sm-1" style="padding:0; margin-top:20px;">
                <input type="button" name="add_customer" id="add_customer" class="btn btn-primary" value="<?php echo $this->lang->line("new")?>"/>
            </div>
            <div class="col-sm-6">
                <label class="control-label"><?php echo $this->lang->line("date")?><span style="color:red;">*</span></label>
                <input type="text" id="date_inv" class="date_inv form-control input-xs"
                       value="<?php echo date("d/m/Y"); ?>">
            </div>
        </div>
        <!-- end div 12 -->
        <div class="col-sm-12">
            <div class="col-sm-6">
                <label class="control-label"><?php echo $this->lang->line("gender")?></label>
                <input type="text" id="gender" class="gender form-control input-xs" readonly>
            </div>
            <div class="col-sm-6">
                <label class="control-label"><?php echo $this->lang->line("service_type_")?><span style="color:red;">*</span></label>
                <select id="disease_type" class="disease_type form-control input-xs"  style="font-size:12px;">
                    <?php echo $option_dis; ?>
                </select>
            </div>
        </div>
        <!-- end div 12 -->
        <div class="col-sm-12">
            <div class="col-sm-6">
                <label class="control-label"><?php echo $this->lang->line("age")?></label>
                <input type="text" id="age" class="age form-control input-xs" readonly>
            </div>
            <div class="col-sm-6">
                <label class="control-label"><?php echo $this->lang->line("note")?></label>
                <textarea id="note" class="note form-control input-xs" style="width: 462px; height: 33px;"></textarea>
            </div>
        </div>
        <!-- end div 12 -->


    <!-- end div row -->
    <br>

    <div class="col-sm-12"> <!--  div table -->
        <div class="table-responsive">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th class=""><?php echo $this->lang->line("no")?></th>
                        <th class="" style="text-align:center;"><?php echo $this->lang->line("service___")?></th>
                        <th class="" style="text-align:center;"><?php echo $this->lang->line("quantity")?></th>
                        <th class="" style="text-align:center;"><?php echo $this->lang->line("amount")?></th>
                        <th class="" style="text-align:center;"><a href="Javascript:void(0)" id="add_tr"><?php echo $this->lang->line("add")?></a>
                        </th>
                    </tr>
                </thead>
                <tbody id="show_tbl" class="show_tbl">

                </tbody>
            </table>
        </div>
    </div>
    <!-- end div table -->
    <div class="col-sm-12">
        <div class="col-sm-12" style="text-align:right;">
            <input type="button" name="save" id="save" class="btn btn-primary" value="<?php echo $this->lang->line("save")?>"/>
            <input type="button" name="clear" id="clear" class="btn btn-warning" value="<?php echo $this->lang->line("clear")?>"/>
        </div>
    </div>
</div>

<!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ -->

<div id="add_new_cust" class="col-sm-12" style="display:none;">
    <div class="col-sm-12">
        <div class="panel-heading">
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <label class="control-label"><?php echo $this->lang->line("cust_code")?><span style="color:red">*</span></label>
                        <input type="text" name="custcode" id="custcode" class="form-control input-xs"/>
                        <input type="hidden" name="h_custcode" id="h_custcode" class="form-control input-xs"/>
                    </div>
                    <div class="col-sm-6">
                        <label class="control-label"><?php echo $this->lang->line("cust_name")?><span style="color:red">*</span></label>
                        <input type="text" name="custname" id="custname" class="form-control input-xs"/>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <label class="control-label"><?php echo $this->lang->line("gender")?></label>
                        <SELECT name="gender_cust" id="gender_cust" class="form-control input-xs">
                            <option value="Male"><?php echo $this->lang->line("male")?></option>
                            <option value="Female"><?php echo $this->lang->line("female")?></option>
                        </SELECT>
                        <!--<input type="text" name="gender" id="gender" class="form-control input-xs" />-->
                    </div>
                    <div class="col-sm-6">
                        <label class="control-label"><?php echo $this->lang->line("dob")?></label>
                        <input type="text" name="dob" id="dob" class="form-control input-xs"/>
                    </div>
                    
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <label class="control-label"><?php echo $this->lang->line("age")?></label>
                        <input type="text" name="years" id="years" class="form-control input-xs"/>
                    </div>
                    <div class="col-sm-6">
                        <label class="control-label"><?php echo $this->lang->line("address")?></label>
                        <input type="text" name="address" id="address" class="form-control input-xs"/>
                    </div>
                    
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <label class="control-label"><?php echo $this->lang->line("currency")?></label>
                        <SELECT name="cust_currency" id="cust_currency" class="form-control input-xs cust_currency" style="font-size:12px;">
                            <?php
                            $sql_cur = $this->db->query("SELECT curcode,currencyname FROM currencies ORDER BY id DESC")->result();
                            foreach ($sql_cur as $row_curr) {
                                $opt_curr .= "<option value='" . $row_curr->curcode . "'>" . $row_curr->currencyname . "</option>";
                            }
                            echo $opt_curr;
                            ?>
                        </SELECT>
                    </div>
                    <div class="col-sm-6">
                        <label class="control-label"><?php echo $this->lang->line("phone")?></label>
                        <input type="text" name="phone" id="phone" class="form-control input-xs"/>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <label class="control-label"><?php echo $this->lang->line("note")?></label>
                        <textarea name="note" id="note" class="form-control input-xs"/></textarea>
                    </div>
                </div>

            </div>
            <!-- div row-->
        </div>
        <!-- div head-->
    </div>
</div> <!-- and div add customer new -->



<!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ -->

<script type="text/javascript">
$(function () {
    
        $("#invcustname").focus(function (){
            autoCust();
        });
        
        $("#date_inv,#dob").datepicker({
            language: 'en',
            pick12HourFormat: true,
            format: 'dd/mm/yyyy'
        });
        $("#dob").on("changeDate",function(ev){
            var val_date = $(this).val();
            $("#years").val(claculate_year(val_date));
        });
        
        var typeno = <?= isset($_REQUEST["typeno"])?$_REQUEST["typeno"]:0?>;
        var type = <?= isset($_REQUEST["type"])?$_REQUEST["type"]:0?>;

        if (typeno == 0 && type == 0) {
            var obj_tr = new fn_proccess();
            obj_tr.fn_add_tr();
            $("#clear").show();
        } else {
            fn_edite(type, typeno);
            $("#clear").hide();
        }

        $("#cust_code").on("change", function () {
            var gender = $(this).find("option:selected").attr("att_gender");
            var age = $(this).find("option:selected").attr("att_age");
            var currency = $(this).find("option:selected").attr("att_curr");
            $("#gender").val(gender);
            $("#age").val(age);
            $("#h_currency").val(currency);
            $(".currency").html(currency);
        });
        $("body").delegate("#delete_tr", "click", function () {
            var amt_tr = $(".table #show_tbl tr").size() - 0;
            if (amt_tr > 1) {
                var conf = confirm("<?php echo $this->lang->line('confirm__delete')?>");
                //var conf = confirm("Do you want to delete this record ?");
                if (conf == true) {
                    $(this).parent().parent().remove();
                    $(".number_index").each(function(e){
                        $(this).html((e+1)-0);
                    })
                } else {
                    return false;
                }
            } else {
                return false;
            }
        });

        $("body").delegate("#add_tr", "click", function () {
            var obj = new fn_proccess();
            obj.fn_add_tr();
            obj.fn_diseasetype();
        });

        $("body").delegate("#disease_type", "change", function () {
            $(".table #show_tbl tr").remove();
            var obj = new fn_proccess();
            obj.fn_add_tr();
            obj.fn_diseasetype();

        });


        $("#save").on('click', function () {
            var obj_pr = new fn_proccess();
            //obj_pr.fn_save();
            if (obj_pr.cust_code == "") {
                alert("<?php echo $this->lang->line('alert_customer')?>");
                //alert("Please choose customer before proccess.");
                $("#cust_code").focus();
            } else if (obj_pr.date_inv == "") {
                alert("<?php echo $this->lang->line('alert_date')?>");
                //alert("Please input date before proccess.");
                $("#date_inv").focus();
            } else if (obj_pr.disease_type == "") {
                alert("<?php echo $this->lang->line('alert_disease')?>");
                //alert("Please choose disease type before proccess.");
                $("#disease_type").focus();
            } else {
                var conf = confirm("<?php echo $this->lang->line('confirm_save')?>");
                //var conf = confirm("Do you want to save ?");
                if (conf == true) {
                    obj_pr.fn_save();
                    if (typeno > 0) {
                        window.location.href = "<?= site_url("invoice/c_invoice"); ?>";
                    }
                    obj_pr.fn_clear();
                } else {
                    return false;
                }
            }
        });
        $("#clear").on("click", function () {
            var obj_clear = new fn_proccess();
            obj_clear.fn_clear();
        });
        $("body").delegate("#servicetype", "change", function () {
            var get_price = $(this).find("option:selected").attr("att_price");
            $(this).parent().parent().find("#amtpaid").val(get_price);
            var obj_add_tr = new fn_proccess();
            var val_change = $(this).val();
            var ii = 0;
            var jj = 0;
            $(".servicetype").each(function () {
                var val_each = $(this).val();
                if (val_each == val_change) {
                    ii++;
                }
                if(val_each == ""){
                    jj = 1;
                }
            });
            if (ii > 1) {
                alert("<?php echo $this->lang->line('choose_service')?>");
                //alert("Sorry you choose service type duplicate. Please try again.");
                //$(this).parent().parent().find(".table #show_tbl tr").remove();
                $(this).val("");
                obj_add_tr.fn_diseasetype();
            } else {
                if(jj == 0){
                    obj_add_tr.fn_add_tr();
                }
                obj_add_tr.fn_diseasetype();
            }

        });

        $("body").delegate("#add_customer", "click", function () {
            customer_clear();
            cust_code_auto();
            $("#add_new_cust").dialog({
                title: "<?php echo $this->lang->line("new_cust")?>",
                resizable: false,
                height: 450,
                width: 700,
                modal: true,
                closeOnEscape: false,
                open: function(event, ui) { 
                    $(".ui-dialog-titlebar-close", ui.dialog | ui).hide();
                },
                buttons: {
                    "<?php echo $this->lang->line("save")?>": function () {
                        var custcode1 = $("#custcode").val();
                        var custname1 = $("#custname").val();
                        if (custcode1 == "") {
                            alert("<?php echo $this->lang->line('code_add')?>");
                            //alert("Please input customer code before proccess.");
                            $("#custcode").focus();
                        } else if (custname1 == "") {
                            alert("<?php echo $this->lang->line('name_add')?>");
                            //alert("Please input customer name before proccess.");
                            $("#custname").focus();
                        } else {
                            var obj_ch = new fn_proccess();
                            if(obj_ch.fn_check(custcode1) > 0){
                                alert("<?php echo $this->lang->line("alert_customer_code"); ?>");
                                $("#custcode").focus();
                                return false;
                            }else{
                                    var arr_obj = {
                                                    custcode: $("#custcode").val(),
                                                    h_custcode: $("#h_custcode").val(),
                                                    custname: $("#custname").val(),
                                                    gender: $("#gender_cust").val(),
                                                    years: $("#years").val(),
                                                    address: $("#address").val(),
                                                    phone: $("#phone").val(),
                                                    note: $("#note").val(),
                                                    currency: $("#cust_currency").val(),
                                                    dob : $("#dob").val()
                                                };
                                    $.ajax({
                                        type: "POST",
                                        url: "<?= site_url("customer/c_customer/csave"); ?>",
                                        DataType: "Json",
                                        async: false,
                                        data: {
                                            save: 1,
                                            para_obj: arr_obj
                                        },
                                        success: function (data) {
                                            if (data.custcode != "") {
                                                $('#cust_code').val($("#custcode").val());
                                                $("#invcustname").val($("#custname").val());
                                                $("#gender").val($("#gender_cust").val());
                                                $("#age").val($("#years").val());
                                                $(".currency").html($("#cust_currency").val());
                                                $("#h_currency").val($("#cust_currency").val());
                                            }
                                        }
                                    });
                                    $("#add_new_cust").dialog("destroy");
                            }
                        }
                    },
                    "<?php echo $this->lang->line("close")?>": function () {
                        $("#add_new_cust").dialog("destroy");
                    }
                }
            })
        })

        $("body").delegate("#years,#amtpaid,#quantity","keydown", function (e) {
           // alert(e.keyCode);
            if ((e.keyCode >= 96 && e.keyCode <= 105) || (e.keyCode >= 48 && e.keyCode <= 57) || e.keyCode == 8 || e.keyCode == 190 || e.keyCode == 110) {
                $(this).removeAttr("readonly");
            } else {
                $(this).attr("readonly", "readonly");
            }
        });   
        $("body").delegate("a#new_page","click",function(){
            gsPrint();
        });
});
function claculate_year(dob_age){
    var ret_age =0;
    $.ajax({ 
            type:"POST",
            url:"<?= site_url("customer/c_customer/ccalculate_y"); ?>",
            DataType:"JSON",
            async:false,
            data:{
                dob_age : dob_age
            },
            success:function(data){
                ret_age = data.age;
            }
    });
    return ret_age;
}
function autoCust(){
    var url = "<?php echo site_url('invoice/c_invoice/autocust')?>";
    $("#invcustname").autocomplete({
        source: url,
        minLength: 0,
        select: function (events, ui) {
            $('#cust_code').val(ui.item.id);
            $('#gender').val(ui.item.gender);
            $('#age').val(ui.item.years);
            $(".currency").html(ui.item.currcode);
            $(".h_currency").val(ui.item.currcode);
        }
    });
}

function customer_clear() {
    $("#custcode").val("");
    $("#h_custcode").val("");
    $("#custname").val("");
    $("#dob").val("");
    $("#years").val("");
    $("#address").val("");
    $("#phone").val("");
    $("#note").val("");
    //$("#currency").val("");
}
function fn_proccess() {
    this.disease_type = $("#disease_type").val();
    this.cust_code = $("#cust_code").val();
    this.date_inv = $("#date_inv").val();
    this.gender = $("#gender").val();
    this.age = $("#age").val();
    //this.dob = $("#dob").val();
    this.note = $("#note").val();
    this.h_currency = $("#h_currency").val();

    var arr_detail = [];
    var total_paid = 0;
    $(".servicetype").each(function (e) {
        var tr = $(this).parent().parent();
        var val_service = $(this).val();
        var quantity = tr.find("#quantity").val();
        var amtpaid = tr.find("#amtpaid").val() - 0;
        var row_index = tr.find("#row_index").val();
        var currency = tr.find(".currency").html();
        if (val_service != "") {
            total_paid = (total_paid + amtpaid) - 0;
            arr_detail[e] = {
                "custCodeDetail": $("#cust_code").val(),
                "dateDetail": $("#date_inv").val(),
                "disease_Detail": $("#disease_type").val(),
                "servicetype": val_service,
                "quantity": quantity,
                "amtpaid": amtpaid,
                "row_index": row_index,
                "currency": currency
            }
        }

    });

    var arr_order = {
        custcode: this.cust_code,
        dateinv: this.date_inv,
        gender: this.gender,
        age: this.age,
        //dob: this.dob,
        note: this.note,
        diseasetype: this.disease_type,
        total_paid: total_paid,
        h_currency: this.h_currency
    }

    this.fn_save = function fn_save() {
        var url = "<?= site_url('invoice/c_invoice/csave')?>";
        var data = {"arr_order": arr_order, "arr_detail": arr_detail};
        if (arr_detail.length > 0) {
            var type_typeno = fn_ajax(url, data);
            var type   = type_typeno['type'];
            var typeno = type_typeno['typeno'];
            $("<div></div>", {id: "show_conf"})
                .html("<center><a id='new_page' href='<?= site_url('report/c_report_print')?>?type=" + type + "&typeno=" + typeno + "' target='_blank'><p style='color:red;'>Print report</p></a></center>").dialog({
                    title: "Print report",
                    resizable: false,
                    height: 150,
                    width: 400,
                    modal: true,
                    closeOnEscape: false,
                    open: function(event, ui) { 
                        $(".ui-dialog-titlebar-close", ui.dialog | ui).hide();
                    },
                    close: function () {
                        $(this).dialog("destroy").remove();
                    },
                    buttons: {
                        "CLOSE": function () {
                            $(this).dialog("destroy").remove();
                        }
                    }
                });
                
        } else {
            return false;
        }
    },
    this.fn_add_tr = function fn_add_tr() {
        var no = $("#show_tbl tr").size() + 1 - 0;
        var tr ='<tr>' +
                '<td width="10"><span id="number_index" class="number_index">' + no + '</span></td>' +
                '<input type="hidden" id="row_index" id="row_index" class="row_index" value="' + no + '">' +
                '<td algin="left"><select id="servicetype" class="form-control input-xs servicetype" name="servicetype"  style="font-size:12px;"></select></td>' +
                '<td><input type="text" name="quantity" id="quantity" class="form-control quantity" value="1" style="text-align:right;"></td>' +
                '<td style="text-align:right !important;">'+
                '<input type="text" name="amtpaid" id="amtpaid" class="form-control input-xs amtpaid" value="0" style="text-align:right;width:150px; float:left;">'+
                '<span class="currency input-xs"  style="padding-top:5px; float:right; margin-left:5px;"></span>'+
                '</td>'+
                '<td style="text-align:center;"><a href="javascript:void(0)" id="delete_tr"><img rel="2510" src="<?= base_url()?>/assets/images/icons/delete.png"></a></td>' +
                '</tr>';
        $("#show_tbl").append(tr);
        var curr = $("#h_currency").val();
        $(".currency").html(curr);
    },
    this.fn_diseasetype = function fn_diseasetype() {
        $.ajax({
            type: "POST",
            url: "<?= site_url('invoice/c_invoice/cdiseasetype')?>",
            dataType: "HTML",
            async: false,
            data: {
                Pare_diseasetype : 1,
                diseasetype : this.disease_type
            },
            success: function (data) {
                $(".servicetype").each(function () {
                    var show_this = $(this).val();
                    if (show_this == null) {
                        $(this).html(data);
                    }
                });
            }
        });
    },
    this.fn_clear = function fn_clear() {
        $("#disease_type").val("");
        $("#invcustname").val("");
        //$("#date_inv").val("");
        $("#gender").val("");
        $("#age").val("");
        $("#note").val("");
        $(".table #show_tbl tr").remove();
        this.fn_add_tr();
    },
    this.fn_check = function fn_check(par_code){
        var amt_v = 0;
        $.ajax({
                type:"POST",
                url:"<?= site_url("customer/c_customer/ccheck"); ?>",
                DataType:"JSON",
                async:false,
                data:{
                    para_check : par_code
                },
                success:function(data){
                    amt_v = data.amt;
                }
        });
        return amt_v;
    }

}
function fn_ajax(url, data) {
    var vreturn = [];
    var typeno_save = <?= isset($_REQUEST["typeno"])?$_REQUEST["typeno"]:0?>;
    var type_save = <?= isset($_REQUEST["type"])?$_REQUEST["type"]:0?>;
    $.ajax({
        type: "POST",
        url: url,
        dataType: "JSON",
        async: false,
        data: {arr: data, typeno_save: typeno_save, type_save: type_save},
        success: function (data) {
            vreturn = data;
        }
    });
    return vreturn;
}

function fn_edite(type, typeno) {
    $.ajax({
        type: "POST",
        url: "<?= site_url('invoice/c_invoice/cedite')?>",
        dataType: "JSON",
        async: false,
        data: {
            typeno: typeno,
            type: type
        },
        success: function (data) {
            $("#disease_type").val(data[0][0]['disease_code']);
            $("#cust_code").val(data[0][0]['customercode']);
            $("#invcustname").val(data[0][0]['customername']);
            $("#h_currency").val(data[0][0]['currcode']);
            $("#date_inv").val(data[0][0]['date_inv']);
            $("#gender").val(data[0][0]['gender']);
            $("#age").val(data[0][0]['years']);
            $("#note").val(data[0][0]['note']);
            $("#show_tbl").html(data[1]);
        }
    });
}

function cust_code_auto(){
    $.ajax({ 
        type : 'POST',
        url  : "<?= site_url('customer/c_customer/coustomer_code_df') ?>",
        DataType : "JSON",
        async : false,
        data : { 
            code_auto : 1
        },
        success:function(data){ 
            //console.log(data);
            $('#custcode').val(data.cus+"-"+data.code);
        }
    });
}
</script>