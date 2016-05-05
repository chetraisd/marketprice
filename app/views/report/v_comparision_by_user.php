<div class="wrapper">
	<div class="col-sm-12">
    	<div class="row result_info">
        	<div class="col-xs-6"><h5>Comparision By User Report</h5></div>
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
            <div class="col-sm-5">
                <label class="control-label">From Date</label>
                <input type="text" placeholder="Search From Date" id="from_date" class="form-control input-xs" value="<?php echo $this->green->gdate_format();?>"/>
            </div>
            <div class="col-sm-5">
                <label class="control-label">To Date</label>
                <input type="text" placeholder="Search To Date" id="to_date" class="form-control input-xs" value="<?php echo $this->green->gdate_format();?>"/>
            </div>
            <div class="col-sm-2">
                <label class="control-label">Report Type</label>
                <select class="form-control input-xs" style="font-size:13px;" type="text" id="report_type"> 
                    <option value="0">Summary</option>
                    <option value="1">Detail</option>
                </select>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="col-sm-5">
                <label class="control-label">Park</label>
                <!-- <input type="text" placeholder="Search Park" id="by_park" class="form-control input-xs" /> -->
                <select type="text" name="park[]" id="by_park" multiple size="5" class="form-control input-xs" style="font-size:14px;">                
                    <?php
                        echo $this->green->user_access_park(1);
                        // echo $option_park;
                    ?>
            </select>
            </div>
            <div class="col-sm-5">
                <label class="control-label">Entrance</label>
                <!-- <input type="text" placeholder="Search Gate" id="by_gate" class="form-control input-xs" /> -->
                <select class="form-control input-xs" style="font-size:13px;" type="text" id="by_gate"> 
                    <?php echo $option_gat; ?>
                </select>
                
            </div>           
            <div class="col-sm-2">
                <label class="control-label">Sort Type</label>
                <select class="form-control input-xs" style="font-size:13px;" type="text" id="sort_type"> 
                    <option value="ASC">A-Z</option>
                    <option value="DESC">Z-A</option>
                </select>
            </div>
            <div class="col-sm-5">
                <label class="control-label">User</label>
                <select class="form-control input-xs" style="font-size:13px;" type="text" id="search_user"> 
                    <?php echo $option_user; ?>
                </select>
            </div>
            <div class="col-sm-2">
                <label class="control-label">Sort By</label>
                <select class="form-control input-xs" style="font-size:13px;" type="text" id="sort_by"> 
                    
                    <option value="park_name">Park Name</option>
                    <option value="gat_name">Entrance Name</option>
                    <option value="user_name">User</option>
                </select>
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
                    <th>No</th>
                    <th>Park</th>
                    <th>Entrance</th>
                    <th>User</th>
                    <th>Quantity Ticket</th>
                    <th>Amount</th>
                    <th>Rate %</th>
                </tr>
            </thead>
            <tbody id="show_data">
            
            </tbody>
        </table>
    </div>    
</div>

<div  id="dv-ex" style="display:none">
    <center>
        <span>Comparision By Gate Report</span><br>     
        <table class="" border="1"> 
            <thead>
                <tr>
                    <th>No</th>
                    <th>Park</th>
                    <th>Entrance</th>
                    <th>User</th>
                    <th>Quantity Ticket</th>
                    <th>Amount</th>
                    <th>Rate %</th>
                </tr>
            </thead>
            <tbody id="show_data_ex">
            
            </tbody>
        </table>
    </center>
</div>    

<script type="text/javascript"> 
    $(function(){

        $('#a_print').tooltip({ title : 'Print'});
        $('#a_export').tooltip({ title : 'Export', placement : 'left'});

        var obj_show = new pro_comparision_by_user();
        obj_show.show_comparision_report();

        $('#search').click(function(){ 
            var obj_search = new pro_comparision_by_user();
            obj_search.show_comparision_report();
        });

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

    function pro_comparision_by_user(){ 

        this.from_date = $("#from_date").val();
        this.to_date = $("#to_date").val();
        this.report_type = $("#report_type").val();
        this.by_park = $("#by_park").val();
        this.by_gate = $("#by_gate").val();
        this.sort_type = $("#sort_type").val();
        this.search_user = $("#search_user").val();
        this.sort_by = $("#sort_by").val();

        this.show_comparision_report = function show(){ 
            $.ajax({ 
                type : 'POST',
                url  : "<?= site_url('report/c_comparision_by_user/show_comparision_report') ?>",
                dataType : 'json',
                async : false,
                data : { 
                    from_date : this.from_date,
                    to_date : this.to_date,
                    report_type : this.report_type,
                    by_park : this.by_park,
                    by_gate : this.by_gate,
                    sort_type : this.sort_type,
                    search_user : this.search_user,
                    sort_by : this.sort_by
                },
                success:function(data){ 
                    //console.log(data);
                    $('#show_data').html(data);
                    $('#show_data_ex').html(data);
                }
            });
        }
    }

    function fn_print(from_date){
        $(".remove_inv").removeAttr("href");
        var title   = "<center>"+ 
                            "<span style='font-weight:bold; font-size:16px;'>Comparision By Gate Report</span><br>"+
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
        var data = $("#dv-ex").html().replace(/<img[^>]*>/gi,"");
        var export_data = $("<center>"+data+"</center>").clone().find(".remove_tag").remove().end().html();
        //export_data+=htmlToPrint;
        return title+"####"+export_data;
    }

</script>