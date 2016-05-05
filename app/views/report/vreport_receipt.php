<div class="container-fluid">
   <div class="row">
      <div class="col-xs-12">         
         <div class="result_info">            
            <div class="col-xs-6" style="font-weight: bold;"><?= $this->lang->line("report receipt")?><span id="title_top" ></span></div>
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
            <label for="from_date" class="label-control"><?= $this->lang->line("from date")?><span style="color:red"> *</span></label>
            <input date_ type="text" class="form-control" name="from_date" id="from_date" placeholder="<?= $this->lang->line('from date')?>" value="<?= $this->green->gdate_format() ?>" data-parsley-required="true" data-parsley-error-message="This field required!">
         </div>  
         <div class="col-sm-4">
            <label for="to_date" class="label-control"><?= $this->lang->line("to date")?><span style="color:red"> *</span></label>
            <input date_ type="text" class="form-control" name="to_date" id="to_date" placeholder="<?= $this->lang->line('to date')?>" value="<?= $this->green->gdate_format() ?>" data-parsley-required="true" data-parsley-error-message="This field required!">
         </div>
         <div class="col-sm-4">
            <label for="receipt_no" class="label-control"><?= $this->lang->line("receipt no")?></label>
            <input type="text" class="form-control" name="receipt_no" id="receipt_no" placeholder="<?= $this->lang->line('ticket no')?>">
         </div>

         <div class="col-sm-4" style="display: none;">
            <label for="park" class="label-control"><?= $this->lang->line("park")?></label>
            <select class="form-control" name="park" id="park">
            <option value=""></option>
             <?php  echo $this->green->user_access_park(1); ?>
            </select>
         </div>            
      </div>
      
      <div class="row">
         <div class="col-sm-4 hide" >
            <label for="report_type" class="label-control"><?= $this->lang->line("report type")?></label>
            <select class="form-control" name="report_type" id="report_type">
               <option value="1">Detail</option>
               <option value="2">Summary</option>               
            </select>
         </div>
         <div class="col-sm-4 hide">
            <label for="sort_by" class="label-control"><?= $this->lang->line("sort by")?></label>
            <select class="form-control" name="sort_by" id="sort_by">
               <option value="rp.create_date">Date</option>
               <option value="rp.reciept_typeno">Receipt No</option>
               <option value="rp.is_agency">Ticket Type</option>
               <option value="rp.pay_amount - 0">Amount</option>
               <option value="rp.discount - 0">Discount</option>            
            </select>
         </div>
         <div class="col-sm-4 hide">
            <label for="sort_type" class="label-control"><?= $this->lang->line("sort type")?></label>
            <select class="form-control" name="sort_type" id="sort_type">
               <option value="ASC">A-Z</option>
               <option value="DESC">Z-A</option>
            </select>
         </div>
         <div class="col-sm-4" style="display: none;">
            <label for="gate" class="label-control"><?= $this->lang->line("gate")?></label>
            <select class="form-control" name="gate" id="gate"></select>
         </div>  
        
      </div>

      <div class="row">
         <div class="col-sm-4">
            <label for="ticket_type" class="label-control"><?= $this->lang->line("ticket type")?></label>
            <select class="form-control" name="ticket_type" id="ticket_type">
               <option selected="selected" value="">All</option>
               <option value="0">Individual</option>
               <option value="1">Group Tour</option>                  
            </select>
         </div>              

         <div class="col-sm-4" style="padding: 22px;">
            <button type="button" class="btn btn-primary" name="btn_search" id="btn_search"><?= $this->lang->line("search")?></button>
            <button type="button" class="btn btn-warning" name="btn_clear" id="btn_clear"><?= $this->lang->line("clear")?></button>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-12">
            <div class="col-sm-12" style="border-bottom: 1px solid #CCC;margin-top: -20px;">&nbsp;</div> 
         </div>
      </div>

   </form>

     
   <div class="row">
      <div class="col-sm-12">
         <div id="dv-print">
            <div class="table-responsive">
               <table id="tbl_data" class="table table-condensed table-hover" cellspacing="0" cellpadding="0" border="0" width="100%">
                  <caption style="display: none;">&nbsp;</caption>
                  <thead>  
                     <tr>
                        <th id="no" width="5%">#</th>
                        <th width="10%">Date</th>
                        <th width="20%">Receipt No</th>
                        <th width="10%">Ticket Type</th>
                        <th width="20%" style="text-align: right;">Amount</th>
                        <th width="20%" style="text-align: right;">Discount</th>
                        <th width="20%" style="text-align: right;">Total Amount</th>                     
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

</div>

<style type="text/css">
   .loc_name>a, .address>a, .description>a{text-decoration: none;display: block;} 
   a#add_new{display: block;}
   #grid.edit, #grid.del{display: block;}
   th{vertical-align: middle;margin: 0;padding: 0;}
   td{vertical-align: middle;margin: 0;padding: 0;}
</style>

<script type="text/javascript">
    $(function(){      

      // gat name ======
      $('#gat_name').on('change', function(){
         if($(this).val() + '' != '' || $(this).val() != null){
            $.ajax({
               url: "<?= site_url('report/c_report_comparison_turnstile/get_turnstile') ?>",
               type: "POST",
               dataType: "JSON",
               beforeSend: function () {
                  $('#loading_header').show();
               },
               // async: false,
               data: {
                  gat_name: $(this).val() 
               },
               success: function (data) {
                  var opt = '';
                  if (data.length > 0) { 
                     opt += '<option></option>';                            
                     $.each(data, function (i, row) {
                        opt += '<option value="' + row.cou_typeno + '">' + row.counter_name + '</option>';
                     });
                  }
                  $('#counter_name').html(opt); 

                  $('#loading_header').hide();                          
               },
               error: function (err) {

               }
            });
         }
      });

     // get_park();
      get_gate();
      

      // report type ====
      $('#report_type').on('change', function(){
         var report_type = $(this).val() - 0;
         if(report_type == 1){
            var thead = '';
            thead = '<tr>'+
                        '<th id="no" width="5%">#</th>'+
                        '<th width="10%">Date</th>'+
                        '<th width="20%">Receipt No</th>'+
                        '<th width="10%">Ticket Type</th>'+
                        '<th width="20%" style="text-align: right;">Amount</th>'+
                        '<th width="20%" style="text-align: right;">Discount</th>'+                        
                        '<th width="20%" style="text-align: right;">Total Amount</th>'+                     
                     '</tr>';
            $('#tbl_data thead').html(thead);

            grid();

         }else{
            var thead = '';
            thead += '<tr>'+
                        '<th id="no" width="5%">#</th>'+
                        '<th width="10%">Date</th>'+
                        '<th width="20%" style="text-align: right;">Discount</th>'+
                        '<th width="20%" style="text-align: right;">Amount</th>'+                     
                     '</tr>';
            $('#tbl_data thead').html(thead);

            grid();
                
         }
      });

      //  from date =====
      $('#from_date').datepicker({
         forceParse: false,
         format: "<?php echo $this->green->jdate_format();?>",
         autoclose: true
      }).on('changeDate', function(){
         $('#f_save').parsley().validate();
      });

      //  to date =====
      $('#to_date').datepicker({
         forceParse: false,
         format: "<?php echo $this->green->jdate_format();?>",
         autoclose: true
      }).on('changeDate', function() {
         $('#f_save').parsley().validate();
      });

      // tooltip ====      
      $('#export').tooltip({title: 'Export'})
      $('#print').tooltip({title: 'Print'})

      // focusin ======
      $('#from_date, #to_date').on('focus', function(){         
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
         $('#report_type').change();
         grid();
      });    

      // export ======
      $("body").delegate("a#export","click", function(){
         var title_date = 'From date: ' + $('#from_date').val() + ' To date: ' + $('#to_date').val();
         $('#tbl_data').attr('border', '1');
         $('#tbl_data').find('caption').html('<center><b><div>Receipt Report</div><div>'+ title_date +'</div></b></center>');
         var arr_exp = fn_pr_ex().split("####");
         window.open('data:application/vnd.ms-excel,' + encodeURIComponent(arr_exp[1]));
         $('#tbl_data').find('caption').html('');         
         $('#tbl_data').attr('border', '0');
      });

      // print ======
      $("body").delegate("a#print","click",function(){
         var arr_pr = fn_pr_ex().split("####");
         gsPrint(arr_pr[0], arr_pr[1]);
      });

   }); // ready =====

   // print or export ======
   function fn_pr_ex(){
      var title_date = 'From date: ' + $('#from_date').val() + ' To date: ' + $('#to_date').val();
      var title = "<center style='font-weight:bold; font-size:14px;'><div>Receipt Report</div><div class='from_to_date' style='font-size:12px;'>"+ title_date +"</div></center>";
      var data = $("#dv-print").html();
      var export_data = $("<center>" + data + "</center>").html();
      return title + "####" + export_data;
   }

   // get parks ======
   function get_park() {
      $.ajax({
         url: "<?= site_url('report/c_report_receipt/get_park') ?>",
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
            $('#park').html(opt);

            $('#loading_header').hide();
         },
         error: function (err) {

         }
     });
   }

   // get gate ======
   function get_gate() {
      $.ajax({
         url: "<?= site_url('report/c_report_receipt/get_gate') ?>",
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
                  opt += '<option value="' + row.gat_typeno + '">' + row.gat_name + '</option>';
              });
            }
            $('#gate').html(opt);

            $('#loading_header').hide();
         },
         error: function (err) {

         }
     });
   }

   // clear ======
   function clear(){
      $('#from_date').val("<?= $this->green->gdate_format() ?>");    
      $('#to_date').val("<?= $this->green->gdate_format() ?>");   
      $('#receipt_no').val('');     
      $('#report_type').val('1');
      $('#sort_by').val('rp.create_date');           
      $('#sort_type').val('ASC'); 
      $('#ticket_type').val('all');          
   }   

   // show data ======
   function grid(){         
      // alert($('#report_type').val());
      // return false;     
      $.ajax({
         url: "<?= site_url('report/c_report_receipt/grid') ?>",
         type: "POST",
         dataType: "Html",
         beforeSend: function(){
            $('#loading_header').show();
         },
         // async: false,
         data: {
            from_date: $('#from_date').val(),   
            to_date: $('#to_date').val(),                
            receipt_no: $('#receipt_no').val(),
            report_type : $('#report_type').val(),
            sort_by: $('#sort_by').val(),
            sort_type: $('#sort_type').val(),   
            ticket_type: $('#ticket_type').val()
         },
         success: function(data){    
            // alert(data);

            $('#tbl_data tbody').html(data);

            // print/export ======     
            // $('#tbl_data tbody').html(data);

            // hide loading ======
            $('#loading_header').hide();            
         },
         error: function(err){

         }
      });
   }
</script>

