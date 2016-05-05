<div class="wrapper">
   <div class="col-sm-12">
      <div class="row result_info">
        <div class="col-xs-6"><h5>Sale Report</h5></div>
            <div class="col-xs-6" align="right">                
                <?php if($this->green->gAction("E")){ ?>
                    <a href="javascript:void(0)" id="a_export"rch><img src="<?= base_url()."assets/images/icons/exports.png"?>" width="25"></a>
                <?php } ?>
                <?php if($this->green->gAction("P")){ ?>
                    <a href="javascript:void(0)" id="a_print"><img src="<?= base_url()."assets/images/icons/prints.png"?>" width="25"></a>
                <?php } ?>
            </div>
        </div>        
        <div class="col-sm-12">
            <div class="col-sm-3">
                <label class="control-label">From Date</label>
                <input type="text" placeholder="Search From Date" id="from_date" class="form-control input-xs" value="<?php echo $this->green->gdate_format();?>"/>
            </div>
            <div class="col-sm-3">
                <label class="control-label">To Date</label>
                <input type="text" placeholder="Search To Date" id="to_date" class="form-control input-xs" value="<?php echo $this->green->gdate_format();?>"/>
            </div>
            <div class="col-sm-2">
                <label for="visitor_type" class="label-control">Visitor Type </label>
                <select class="form-control" name="visitor_type" id="visitor_type">
                    <option value=""></option>
                    <option value="1">Individual</option>
                    <option value="2">Tour Group</option>                  
                </select>
            </div>
            <div class="col-sm-2">
                <label for="visitor_type" class="label-control">Report Type</label>
                <select class="form-control" name="visitor_type" id="report_type">
                    <option value="0" selected="selected">Summary</option>
                    <option value="1">Detail</option>                  
                </select>
            </div>
            <div class="col-sm-2">
                <label for="visitor_type" class="label-control">Status</label>
                <select class="form-control" name="visitor_type" id="sch_status">
                    <option value=""></option>
                    <option value="1">Close</option>
                    <option value="0">Open</option>                  
                </select>
            </div>
        </div>
        <div class="col-sm-12" style="display:none" id="search_detail">
            <div class="col-sm-3">
                <label for="visitor_type" class="label-control">Park/package</label>
                <select class="form-control" name="visitor_type" id="sch_pk_package">
                    <?php echo $option_pk; ?>                
                </select>
            </div>
            <div class="col-sm-3">
                <label for="visitor_type" class="label-control">Ticket No</label>
                <!-- <select class="form-control" name="visitor_type" id="sch_ticket_no">
                   <?php echo $ticket_no; ?>                 
                </select> -->
                <input type="text" class="form-control" id="sch_ticket_no">
            </div>
            <div id="detail_Individual" style="display:none">
                <div class="col-sm-2" >
                    <label for="visitor_type"> Country </label>
                    <select class="form-control" name="visitor_type" id="country">
                       <?php echo $country; ?>                  
                    </select>
                </div>
                <div class="col-sm-2">
                    <label for="visitor_type" class="label-control"> Gender </label>
                    <select class="form-control" name="visitor_type" id="gender">
                        <option value=""></option> 
                        <option value="0"> Male</option>
                        <option value="1">Female</option>               
                    </select>
                </div>
                <div class="col-sm-2">
                    <label for="visitor_type" class="label-control"> Remark</label>
                    <select class="form-control" name="visitor_type" id="remark">
                        <option value=""></option> 
                        <option value="0">Adult</option>
                        <option value="1">Child</option>               
                    </select>
                </div>
            </div>

            <div id="detail_tour_group" style="display:none">
                <div class="col-sm-6" >
                    <label for="visitor_type">Agency</label>
                    <select class="form-control" name="visitor_type" id="sch_agency">
                            <?php echo $opt_agency; ?>              
                    </select>
                </div>                
            </div>
        </div>

        <div class="col-sm-12">
            <div class="col-sm-4">&nbsp;</div>
            <div class="col-sm-4">
                <label class="control-label">&nbsp;</label>
                <div class="input-xs" style="text-align: center;">
                    <input type="button" name="search" id="search" class="btn btn-primary" value="Search" />
                </div>
                <br>
            </div>
        </div>
    </div>

    <div class="col-sm-12 table-responsive show_table"  id="dv-print">
       
    </div>
    
    <div style="clear:both"></div>

</div>   
</div>
<script type="text/javascript"> 
    $(function(){ 
       // search_detail
        search_type();

        $('#a_print').tooltip({ title : 'Print'});
        $('#a_export').tooltip({ title : 'Export', placement : 'left'});

        var show_report = new pro_report_sale();
        show_report.show_report_sale(); 

        $('#from_date,#to_date').datepicker({
            forceParse: false,
            format: "<?php echo $this->green->jdate_format();?>",
            autoclose: true
        });

        $('body').delegate('#search','click',function(){ 
            var search_report = new pro_report_sale();
            search_report.show_report_sale();
        });

        $('#report_type').on('change',function(){ 
            if($(this).val() == 1){ 
                $('#search_detail').show();
            }else{ 
                $('#search_detail').hide();
            }
        });

        $('#sch_ticket_no').focus(function(){ 
            ticket_no_auto($(this));
        });

        $('#visitor_type').on('change',function(){ 
            if($('#report_type').val() == 1){ 
                if($(this).val() == 1){ 
                    $('#detail_tour_group').hide(); 
                    $('#detail_Individual').show();
                }else if($(this).val() == 2){ 
                    $('#detail_Individual').hide();
                    $('#detail_tour_group').show();
                }else{ 
                    $('#detail_Individual').hide();
                    $('#detail_tour_group').hide();
                }
            }
        });

        $("body").delegate("#a_print","click",function(){
            var search_date = "<span>From date : "+$('#from_date').val()+"</span> &nbsp;&nbsp; <span>To date : "+$('#to_date').val()+"</span>";
            var arr_pr = fn_print(search_date).split("####");
            gsPrint(arr_pr[0],arr_pr[1]);
        });

        $("body").delegate("#a_export","click",function(){

            var arr_exp = fn_ex().split("####");
            window.open('data:application/vnd.ms-excel,' + encodeURIComponent(arr_exp[1]));
        });

    }); 

    function pro_report_sale(){ 
        this.from_date = $('#from_date').val();
        this.to_date = $('#to_date').val();
        this.visitor_type = $('#visitor_type').val();
        this.report_type = $('#report_type').val();
        this.sch_status = $('#sch_status').val();

        this.sch_pk_package = $('#sch_pk_package').val();
        this.sch_ticket_no = $('#sch_ticket_no').val();
        this.country = $('#country').val();
        this.gender = $('#gender').val();
        this.remark = $('#remark').val();
        this.sch_agency = $('#sch_agency').val();

        this.show_report_sale = function show_data(){ 
            $.ajax({ 
                type : 'POST',
                url  : "<?= site_url('report/c_report_sale/show_report_sale')?>",
                dataType : 'JSON',
                async : false,
                data : { 
                    from_date : this.from_date, 
                    to_date : this.to_date, 
                    visitor_type : this.visitor_type,
                    report_type : this.report_type,
                    sch_status : this.sch_status,
                    sch_pk_package : this.sch_pk_package,
                    sch_ticket_no : this.sch_ticket_no,
                    country  : this.country,
                    gender : this.gender, 
                    remark : this.remark, 
                    sch_agency : this.sch_agency 
                },
                success:function(data){ 
                    // console.log(data);
                    $('.show_table').html(data);
                }
            });
        }
    }

   
    function ticket_no_auto(this_ticket){
        var url = "<?php echo  site_url('report/c_report_sale/ticket_no_auto')?>";
        $("#sch_ticket_no").autocomplete({
            source: url,
            minLength:0,
            focus : function(event, ui){ 
                this_ticket.val(ui.item.value);
            },

            select: function (event, ui) {
                this_ticket.val(ui.item.value);
                return false;
            }      
        });
    }
    

    function search_type(){ 

        if($('#report_type').val() == 1){ 
            $('#search_detail').show();
            if($('#visitor_type').val() == 1){ 
                $('#detail_tour_group').hide();
                $('#detail_Individual').show();
            }else if($('#visitor_type').val() == 2){ 
                $('#detail_Individual').hide();
                $('#detail_tour_group').show();
            }else{ 
                $('#detail_Individual').hide();
                $('#detail_tour_group').hide();
            }
        }else{ 
            $('#search_detail').hide();
        }
    }

    function fn_print(from_date){
        $(".remove_inv").removeAttr("href");
        var title   = "<center>"+ 
                            "<span style='font-weight:bold; font-size:16px;'>Sale Dailly Report</span><br>"+
                            "<br>"+
                            "<span>"+from_date+"</span>"+ 
                    "</center>";
       
        var data = $("#dv-print").html().replace(/<img[^>]*>/gi,"");
        var export_data = $("<center>"+data+"</center>").clone().find(".remove_tag").remove().end().html();
        //export_data+=htmlToPrint;
        return title+"####"+export_data;
    }

    function fn_ex(from_date){
        $(".remove_inv").removeAttr("href");
        var title   = "";       
        var data = $("#dv-print").html().replace(/<img[^>]*>/gi,"");
        var export_data = $("<center>"+data+"</center>").clone().find(".remove_tag").remove().end().html();
        //export_data+=htmlToPrint;
        return title+"####"+export_data;
    }

</script>