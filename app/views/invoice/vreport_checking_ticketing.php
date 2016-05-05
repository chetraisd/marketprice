<?php
$ticketno = isset($_GET['ticketno'])?$_GET['ticketno']:"";
$s_date   = isset($_GET['s_date'])?$_GET['s_date']:"";
?>
<div class="container-fluid">
   <div class="row">
      <div class="col-xs-12">         
         <div class="result_info">            
            <div class="col-xs-6" style="font-weight: bold;"><?= $this->lang->line("checking ticketing report")?><span id="title_top" ></span></div>
            <div class="col-xs-6" style="text-align: right;">
               <?php if($this->green->gAction("R")){ ?>
                  <!-- <a href="javascript: void(0)" id="a_search" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    <img width="24px" height="24px" src="<?= base_url('assets/images/icons/searchs.png') ?>">
                  </a> -->
               <?php } ?>
               <?php if($this->green->gAction("E")){ ?>
                  <a href="javascript: void(0)" id="export">
                    <img width="24px" height="24px" src="<?= base_url('assets/images/icons/exports.png') ?>">
                  </a>
               <?php } ?>
               <?php if($this->green->gAction("P")){ ?>
                  <a href="javascript: void(0)" id="print">
                    <img width="24px" height="24px" src="<?= base_url('assets/images/icons/prints.png') ?>">
                  </a>
               <?php } ?>
            </div>
         </div>
      </div>
   </div>

   <form id="f_save" enctype="multipart/form-data">
      <div class="row">
         <div class="col-sm-4">
            <label for="ticket_no" class="label-control"><?= $this->lang->line("ticket no")?></label>
            <div id="dv_loading" style="display: none;">Valid!</div>
            <input type="text" class="form-control" name="ticket_no" id="ticket_no" placeholder="<?= $this->lang->line('ticket no')?>" value="<?= $ticketno ?>">
         </div>
         <div class="col-sm-4">
            <label for="fromdate" class="label-control">From Date<span style="color:red"> *</span></label>
            <input date_ type="text" class="form-control" name="fromdate" id="fromdate" placeholder="<?= $this->lang->line('from date')?>" value="<?= ($s_date==""?$this->green->gdate_format():$s_date) ?>" data-parsley-required="true" data-parsley-error-message="This field required!">
         </div>         
         <div class="col-sm-4">
            <label for="todate" class="label-control">To Date<span style="color:red"> *</span></label>
            <input date_ type="text" class="form-control" name="todate" id="todate" placeholder="<?= $this->lang->line('todate')?>" value="<?= $this->green->gdate_format() ?>" data-parsley-required="true" data-parsley-error-message="This field required!">
         </div>         
      </div>

      <label style="height: 1px;">&nbsp;</label>            
      <div class="row"​ style="display: none;">
         <div class="col-sm-4">
            <label for="tourclass" class="label-control">Tour Class</label>
            <?php
                  // $sql_visitor = $this->db->query("SELECT
                  //                                     set_visitor_type.vis_typeno,
                  //                                     set_visitor_type.vistor_name
                  //                                     FROM
                  //                                     set_visitor_type");
                  // $opt_vis = "";
                  // if($sql_visitor->num_rows() > 0){
                  //    foreach($sql_visitor->result() as $row_vis){
                  //       $opt_vis.="<option value='".$row_vis->vis_typeno."'>".$row_vis->vistor_name."</option>";
                  //    }
                  // }
            ?>
            <select name="tourclass" id="tourclass" class="form-control">
               <option value="">All</option>
               <option value="1">Agency</option>
               <option value="0">Group</option>
               <option value="2">School</option>
               <option value="3">Organization</option>
            </select>
         </div>
         <div class="col-sm-4">
            <label for="groupagency" class="label-control">Group/Agency</label>
            <input type="text" class="form-control" name="groupagency" id="groupagency" placeholder="<?= $this->lang->line('group/agency')?>">
         </div>
         
      </div>  
      <div class="row">
         <div class="col-sm-4">
            <div id="ref_loading" style="display: none;">Valid!</div>
            <label for="tourreference" class="label-control">Tour Reference</label>
            <input type="text" class="form-control" name="tourreference" id="tourreference" placeholder="<?= $this->lang->line('tour reference')?>">
         </div>
         <div class="col-sm-4">
            <label for="park_name" class="label-control">Park Name</label>
            <select class="form-control" name="park_name" id="park_name">
               <?php  echo $this->green->user_access_park(1); ?>
            </select>
         </div>
      </div>
      <label style="height: 1px;">&nbsp;</label>
      <div class="row" style="text-align: center;">
         <div class="col-sm-12">
            <button type="button" class="btn btn-primary" name="btn_search" id="btn_search"><?= $this->lang->line("search")?></button>
            <button type="button" class="btn btn-warning" name="btn_clear" id="btn_clear"><?= $this->lang->line("clear")?></button>
         </div>
      </div>
   </form>

   <hr width="100%;" style="margin: 10px;" />

   <div class="row">      
      <div class="col-sm-12">
         <div class="table-responsive">
            <div id="dv-print">
               <table id="grid" class="table table-condensed table-hover" cellspacing="0" cellpadding="0" border="0">
                  
                  <thead>  
                     <tr>
                        <th id="no" width="5%">#</th>
                        <th width="10%">Create by</th>
                        <th width="5%">Date</th>
                        <th width="10%">Visitor type</th>
                        <th width="10%">Country</th>                     
                        <th width="10%">Remark</th>    
                        <th width="10%">Park Name</th>
                        <th width="10%" class="check_ticket">Checking Ticket</th>
                     </tr>
                  </thead>
                  <tbody>
                     
                  </tbody>
                  <tfoot>
                     
                  </tfoot>
               </table>
            </div>
            
         </div>
         <div id="dv-print-hidden" style="display: none;width: 100%;">
               <table id="tbl_print" class="tbl_print" cellspacing="0" cellpadding="0" border="0" style="width:100%;">
                  
                  <thead>  
                     <tr>
                        <th id="no" width="10%">#</th>
                        <th width="15%">Create by</th>
                        <th width="10%">Date</th>
                        <th width="15%">Visitor Type</th>
                        <th width="20%">Country</th>                     
                        <th width="10%">Remark</th>    
                        <th width="20%">Park Name</th>
                        <th width="10%" class="delete_td">Checking Ticket</th>
                     </tr>
                  </thead>
                  <tbody>
                     
                  </tbody>
                  <tfoot>
                     
                  </tfoot>
               </table>
            </div>
            
         </div>
      </div>      
   </div>
   <div class="row" style="text-align: center;"><div id="pagination"></div></div>
</div>


<!-- <div id="dv-print" style="display: none;">
   <table id="tbl_data" class="table table-condensed table-hover" cellspacing="0" cellpadding="0" border="1">
      <caption style="font-size: 16px;"></caption>
      <thead>  
         <tr>
            <th id="no" width="5%">#</th>
            <th width="10%"><?= $this->lang->line("park")?></th>
            <th width="10%"><?= $this->lang->line("gate")?></th>
            <th width="10%"><?= $this->lang->line("turnstile")?></th>
            <th width="10%" style="text-align: right;"><?= $this->lang->line("count ticket")?></th>
            <th width="10%" style="text-align: right;"><?= $this->lang->line("qty turnstile")?></th>
            <th width="10%" style="text-align: right;"><?= $this->lang->line("avalide")?></th>                     
         </tr>
      </thead>
      <tbody>
         
      </tbody>
      <tfoot>
         
      </tfoot>
   </table>   
</div> -->

<style type="text/css">
   .loc_name > a, .address > a, .description > a{text-decoration: none;display: block;} 
   a#add_new{display: block;}
   #grid.edit, #grid.del{display: block;}
   th{vertical-align: middle;margin: 0;padding: 0;}
   td{vertical-align: middle;margin: 0;padding: 0;}

   .chk_in:hover, .check_in_all:hover{text-decoration: none;}
   .chk_in:hover, .check_in_all:hover{background: #CCC;}   

   .ui-autocomplete-loading {
    background: white url("images/ui-anim_basic_16x16.gif") right center no-repeat;
   }

</style>

<script type="text/javascript">
    $(function(){
      $("body").delegate("","mouseover",function(){
         $('.check_park').tooltip({title:'save ticket'});
      });
      // autocomplete ======
      // $("#ticket_no").autocomplete({         
      //    source: "<?= site_url('invoice/c_report_checking_ticketing/autocomplete') ?>",   
      //    // autoFocus: true,
      //    focus: function( event, ui ) {
      //      $( "#ticket_no" ).val( ui.item.ticket_no );
      //      // $("#ticket_no").select();
      //      return false;
      //    },        
      //    minLength: 0,
      //    select: function( event, ui ) {
      //       $( "#ticket_no" ).val( ui.item.ticket_no );
      //       return false;
      //    }
      // })
      // .autocomplete( "instance" )._renderItem = function( ul, item ) {
      //    return $( "<li data-check_in='"+ item.check_in +"' data-ticket_no='"+ item.ticket_no +"'>" )
      //   .append( "<a>" + item.ticket_no + " | " + (item.check_in != null ? item.check_in : 0) +"</a>" )
      //   .appendTo( ul );
      // };

      // ticket no ======
      $("#ticket_no").select();
      // update ticket ======
      $("body").delegate('#ticket_no', 'keyup', function(e){
         var ticket_typeno = $(this).val();
         var code = (e.keyCode ? e.keyCode : e.which);
         if(ticket_typeno != ""){
            if(code == 13){                    
               check_code_ticket(1,ticket_typeno);
            }else{
               $('#dv_loading').hide();
            }
         }                 
         //grid();
      });
      $("body").delegate('#tourreference', 'keyup', function(e){
         var ticket_typeno = $(this).val();
         var code = (e.keyCode ? e.keyCode : e.which);
         if(ticket_typeno != ""){
            if(code == 13){                
               check_code_ticket(2,ticket_typeno);
               //$('#ref_loading').hide("slow");
            }else{
               //$('#ref_loading').hide();
            }
         }                 

      });
   
      // park  =========
      $('#park_name').on('change', function(){
         
         grid();
      });

      // get park ======
      // get_park();

      //  date =======
      $('#fromdate,#todate').datepicker({
         forceParse: false,
         format: "<?php echo $this->green->jdate_format();?>",
         autoclose: true
      }).on('changeDate', function(){
         //$('#f_save').parsley().validate();
         grid();
      });

      // tooltip ====      
      $('#export').tooltip({title: 'Export'});
      $('#print').tooltip({title: 'Print'});

      // focusin ======
      $('#fromdate, #todate, #ticket_no, #groupagency, #tourreference').on('focus', function(){         
         $(this).select();
      });

      // ini. =======
      grid();     

      // search ======
      $('#btn_search').on('click', function(){         
         if($('#f_save').parsley().validate()){
            grid();
         }         
      });

      // clear ======
      $('#btn_clear').on('click', function(){
         clear();
         grid();
      });    

      // export ======
      $("body").delegate("a#export","click", function(){
         //var title_date = 'Date: ' + $('#in_date').val();
         $('#tbl_print').attr('border', '1');
         $('#tbl_print').find('caption').html('<center><b><div>Checking Ticketing</div></b></center>');
         var arr_exp = fn_pr_ex().split("####");
         window.open('data:application/vnd.ms-excel,' + encodeURIComponent(arr_exp[1]));
         $('#tbl_print').find('caption').html('');         
         $('#tbl_print').attr('border', '0');
      });

      // print ======
      $("body").delegate("a#print","click",function(){
         var arr_pr = fn_pr_ex().split("####");
         gsPrint(arr_pr[0], arr_pr[1]);
      });

      // all check =========
      $('body').delegate('.all_chk', 'change', function(){
         var cc = this.checked;
         $('.a_chk').each(function() {
            $(this).prop('checked', cc);
         });
      });

      $("body").delegate(".check_park","click",function(){
         var tr = $(this).parent().parent();
         var ticket_agency_typeno = tr.find("#ticket_agency_typeno").val();
         var app_typeno           = tr.find("#app_typeno").val();
         var package_typeno       = tr.find("#package_typeno").val();
         var parkcode             = tr.find("#parkcode").val();
         var vis_typeno           = tr.find("#vis_typeno").val();
         $.ajax({
               url: "<?= site_url('invoice/c_report_checking_ticketing/check_ticket') ?>",
               type: "POST",
               dataType: "JSON",
               // beforeSend: function () {
               //    $('#success').show();
               // },
               data: {
                  par_check_ticket : 1,
                  ticket_agency_typeno : ticket_agency_typeno,
                  package_typeno   : package_typeno,
                  parkcode : parkcode,
                  vis_typeno : vis_typeno,
                  app_typeno : app_typeno
               },
               success: function (data) {
                  if(data.ok == 'OK'){
                     grid(1);
                  }
                  
               }
         })
      });
      

      $("body").delegate(".pagenav","click",function(){
         var start_page = $(this).attr("id");
         grid(start_page);
      })
   }); // ready =====

   function check_code_ticket(typeticket,ticket_typeno){
      $.ajax({
            url: "<?= site_url('invoice/c_report_checking_ticketing/checkticketno') ?>",
            type: "POST",
            dataType: "JSON",
            beforeSend: function () {
               // $('#dv_loading').show();
            },
            // async: false,
            data: {
               ticket_typeno: ticket_typeno,
               ticketno_or_ref:typeticket
            },
            success: function (data) {
               if(typeticket == 2){
                  if(data.success == 'true'){
                     $('#ref_loading').html('Valid!').css({color:'green', top:'30px', right:'0', 'margin-right':'20px', 'z-index':'9', 'position':'absolute','font-weight': 'bold'}).show();//.fadeOut(1200)
                  }else if(data.success == 'false'){
                     $('#ref_loading').html('Invalid!').css({color:'red', top:'30px', right:'0', 'margin-right':'20px', 'z-index':'9', 'position':'absolute','font-weight': 'bold'}).show();//.fadeOut(1200)
                  }else{
                     $('#ref_loading').html('Not found!').css({color:'red', top:'30px', right:'0', 'margin-right':'20px', 'z-index':'9', 'position':'absolute','font-weight': 'bold'}).show();//.fadeOut(1200)
                  }
                  $('#ref_loading').fadeOut(9000);
               }else{      
                  if(data.success == 'true'){
                     $('#dv_loading').html('Valid!').css({color:'green', top:'29px', right:'0', 'margin-right':'20px', 'z-index':'9', 'position':'absolute','font-weight': 'bold'}).show();//.fadeOut(1200)
                  }else if(data.success == 'false'){
                     $('#dv_loading').html('Invalid!').css({color:'red', top:'29px', right:'0', 'margin-right':'20px', 'z-index':'9', 'position':'absolute','font-weight': 'bold'}).show();//.fadeOut(1200)
                  }else{
                     $('#dv_loading').html('Not found!').css({color:'red', top:'29px', right:'0', 'margin-right':'20px', 'z-index':'9', 'position':'absolute','font-weight': 'bold'}).show();//.fadeOut(1200)
                  }
                  $('#dv_loading').fadeOut(9000);
               }
               grid();
               // $("#ticket_no").select();                 
            },
            error: function (err) {

            }
      });
   }
   
   // print or export ======
   function fn_pr_ex(){
      $("#tbl_print").find(".delete_td").remove();
      //var title_date = 'Date: ' + $('#in_date').val();
      var title = "<center style='font-weight:bold; font-size:14px;'><div>Checking Ticketing</div></center>";
      var data  = $("#dv-print-hidden").html();
      var export_data = $("<center>" + data + "</center>").html();
      return title + "####" + export_data;
   }

   // get parks ======
   function get_park() {
      $.ajax({
         url: "<?= site_url('invoice/c_report_checking_ticketing/get_park') ?>",
         type: "POST",
         dataType: "JSON",
         beforeSend: function () {
            $('#loading_header').show();
         },
         // async: false,
         data: {

         },
         success: function (data) {
            var opt = '';
            if (data.length > 0) {
              opt += '<option></option>';
              $.each(data, function (i, row) {
                  opt += '<option value="' + row.par_typeno + '">' + row.park_name + '</option>';
              });
            }
            $('#park_name').html(opt);

            $('#loading_header').hide();
         },
         error: function (err) {

         }
     });
   }

   // clear ======
   function clear(){
      //$('#in_date').val("<?= $this->green->gdate_format() ?>");    
      $('#park_name').val('');
      $('#ticket_no').val('');
      $('#ticket_type').val('');
      $('#park_name').val('');
      $('#contact_name').val('');      
   }   

   // show data ======
   function grid(page){
      //var para_ticketno = '<?php echo isset($ticketno)?$ticketno:'';?>'; 
      $.ajax({
         url: "<?= site_url('invoice/c_report_checking_ticketing/grid') ?>",
         type: "POST",
         dataType: "JSON",
         // beforeSend: function(){
         //    $('#loading_header').show();
         // },
         // async: false,
         data: {
            ticket_no: $('#ticket_no').val(),
            fromdate: $('#fromdate').val(),   
            todate  : $('#todate').val(), 
            //tourclass: $('#tourclass').val(), 
            //groupagency: $('#groupagency').val(),
            tourreference: $('#tourreference').val(),
            park_name: $('#park_name').val(),            
            page:page
         },
         success: function(data){
            if(data.tr == ""){
               $('#grid tbody').html("<tr><td colspan='8' style='text-align:center;color:red;'><b>Data not found</b></td></tr>");
            }else{
               $('#grid tbody').html(data.tr);
               $("#pagination").html(data.paging.pagination);
               $("#tbl_print tbody").html(data.tr);
            }
                     
         },
         error: function(err){

         }
      });
   }
</script>