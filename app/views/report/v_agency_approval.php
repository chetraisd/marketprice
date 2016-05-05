<div class="wrapper">
   <div class="col-sm-12">
      <div class="row result_info">
         <div class="col-xs-6"><h5>Agrncy Approval</h5></div>
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
            <div class="col-sm-4">
                <label class="control-label">Tour Guide</label>
                <select class="form-control input-xs" style="font-size:14px;" type="text" id="tour_guide"> 
                    <?php echo $option_tour_guide; ?>
                </select>
            </div>
            <div class="col-sm-4">
                <label class="control-label">Park/Package</label>
                <select class="form-control input-xs" style="font-size:14px;" type="text" id="park_package"> 
                    <?php echo $option_parkage; ?>
                </select>
            </div>
            <div class="col-sm-4">
                <label class="control-label">Group & Agency</label>
                <select class="form-control input-xs" style="font-size:14px;" type="text" id="group_agency"> 
                    <?php echo $option_agency; ?>
                </select>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="col-sm-4">
                <label class="control-label">From Date</label>
                <input type="text" placeholder="Search From Date" id="from_date" class="form-control input-xs" value="<?php echo $this->green->gdate_format();?>"/>
            </div>
            <div class="col-sm-4">
                <label class="control-label">To Date</label>
                <input type="text" placeholder="Search To Date" id="to_date" class="form-control input-xs" value="<?php echo $this->green->gdate_format();?>"/>
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

    <div class="col-sm-12 table-responsive"  id="dv-print">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th style="text-align: center;">No</th>
                    <th style="text-align: center;">Park/Package</th>
                    <th style="text-align: center;">Price</th>
                    <th style="text-align: center;">Discount</th>
                    <th style="text-align: center;">Amount</th>
                    <th class="remove_tag" style="text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody id="show_data">
            
            </tbody>
        </table>
    </div>
    
    <div style="clear:both"></div>

    <div class="modal" id="confirm_modal">
        <div class="modal-dialog modal_msg" style="width:280px; top:30%">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-title" align="center" style="color:red; font-size:16px;">Are you sure to delete ?</div>
                </div>
                <div class="modal-footer f1">
                    <button type="button" id="btn_delete" data-dismiss="modal" attr="" class="btn btn-danger button_del">Delete</button>
                    <button type="button" class="btn btn-primary" id="close_msg" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

</div>   
</div>

<script type="text/javascript"> 
    $(function(){ 

        var show_app = new list_approval();
        show_app.query_approval();

        $('#a_print').tooltip({ title : 'Print'});
        $('#a_export').tooltip({ title : 'Export', placement : 'left'});

        $("#from_date,#to_date").datepicker({
            language: 'en',
            pick12HourFormat: true,
            format:"<?php echo $this->green->jdate_format();?>",
            autoclose : true
        });

        $('#from_date').change(function(){ 
            if($(this).val() == ""){ 
                $(this).val('<?php echo $this->green->gdate_format();?>');
            }
        });

        $('#to_date').change(function(){ 
            if($(this).val() == ""){ 
                $(this).val('<?php echo $this->green->gdate_format();?>');
            }
        });

        $('body').delegate('#search','click',function(){ 
            var search_app = new list_approval();
            search_app.query_approval();
        });

        $('body').delegate('.a_edit','click',function(){ 
            // alert($(this).attr('agecy_trans'));
            var this_attr = $(this).attr('agecy_trans');
            window.open("<?= site_url('invoice/cagency_approval/index?agecy_trans_typeno="+this_attr+"')?>");
        });

        $('body').delegate('.a_delete','click',function(){ 
            var this_attr = $(this).attr('agecy_trans');
            $('#confirm_modal').modal();
            $('.button_del').attr('attr',this_attr);
        });

        $('body').delegate('#btn_delete','click',function(){ 
            var attr_this = $(this).attr('attr');
            var delete_app = new list_approval();
            delete_app.delete_approval(attr_this);
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

    function list_approval(){ 
        this.from_date = $('#from_date').val();
        this.to_date = $('#to_date').val();
        this.tour_guide = $('#tour_guide').val();
        this.park_package = $('#park_package').val();
        this.group_agency = $('#group_agency').val();

        this.query_approval = function show(){ 
            $.ajax({ 
                type : 'POST',
                url  : "<?= site_url('report/c_agency_approval/query_approval')?>",
                dataType : 'JSON',
                async : false,
                data : { 
                    from_date : this.from_date,
                    to_date : this.to_date,
                    tour_guide : this.tour_guide,
                    park_package : this.park_package,
                    group_agency : this.group_agency
                },
                success:function(data){ 
                    //console.log(data.result_query);
                    var tr = '<tr>'+ 
                                '<td colspan="6" align="center"><i style="font-size:15px; color:red;">Result not data.</i></td>'+
                            '</tr><tr><td colspan="6"></td></tr>';
                    if(data.result_query != ''){ 
                        $('#show_data').html(data.result_query);
                        
                    }else{ 
                        $('#show_data').html(tr);
                    }
                }
            });
        }

        this.delete_approval = function delete_(this_typeno){ 
            
            $.ajax({ 
                type : 'POST',
                url  : "<?= site_url('report/c_agency_approval/delete_approval')?>",
                dataType : 'JSON',
                async : false,
                data : { 
                    this_typeno : this_typeno
                },
                success:function(data){ 
                    // console.log(data.success);
                    if(data.success == 'true'){ 
                        var show = new list_approval();
                        show.query_approval();
                    }
                }
            });
        }
    }

    function fn_print(from_date){
        $(".remove_inv").removeAttr("href");
        var title   = "<center>"+ 
                            "<span style='font-weight:bold; font-size:16px;'>Agency Approval Report</span><br>"+
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