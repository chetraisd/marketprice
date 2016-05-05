<div class="container-fluid">
   <div class="row">
      <div class="col-xs-12">         
         <div class="result_info">            
            <div class="col-xs-6" style="font-weight: bold;"><?= $this->lang->line("comparison turnstile report")?><span id="title_top" ></span></div>
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
            <div class="row">
               <div class="col-sm-12">
                  <label for="park_name" class="label-control"><?= $this->lang->line("park")?></label>
                  <select class="form-control" name="park_name" id="park_name" multiple size="10">
                     <?php 

                     echo $this->green->user_access_park(1);?>
                  </select>
               </div>
            </div>
         </div>
         <div class="col-sm-8">
            <div class="row">
               <div class="col-sm-6">
                  <label for="from_date" class="label-control"><?= $this->lang->line("from date")?><span style="color:red"> *</span></label>
                  <input date_ type="text" class="form-control" name="from_date" id="from_date" placeholder="<?= $this->lang->line('from date')?>" value="<?= $this->green->gdate_format() ?>" data-parsley-required="true" data-parsley-error-message="This field required!">
               </div>
               <div class="col-sm-6">
                  <label for="to_date" class="label-control"><?= $this->lang->line("to date")?><span style="color:red"> *</span></label>
                  <input date_ type="text" class="form-control" name="to_date" id="to_date" placeholder="<?= $this->lang->line('to date')?>" value="<?= $this->green->gdate_format() ?>" data-parsley-required="true" data-parsley-error-message="This field required!">
               </div>               
            </div>
            <div class="row">
               <div class="col-sm-6">
                  <label for="gat_name" class="label-control"><?= $this->lang->line("gate")?></label>
                  <select class="form-control" name="gat_name" id="gat_name"></select>
               </div>
               <div class="col-sm-6">
                  <label for="counter_name" class="label-control"><?= $this->lang->line("turnstile")?></label>
                  <select class="form-control" name="counter_name" id="counter_name"></select>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-4">
                  <label for="report_type" class="label-control"><?= $this->lang->line("report type")?></label>
                  <select class="form-control" name="report_type" id="report_type">                                        
                     <option selected="selected" value="1"><?= $this->lang->line("summary")?></option>
                     <option value="2"><?= $this->lang->line("detail")?></option>
                  </select>
               </div>
               <div class="col-sm-4">
                  <label for="sort_by" class="control-label"><?= $this->lang->line("sort by") ?></label>
                  <select name="sort_by" id="sort_by" class="form-control">                
                     <option value="p.park_name"><?= $this->lang->line("park") ?></option>
                     <option value="g.gat_name"><?= $this->lang->line("gate") ?></option>
                     <option value="c.counter_name"><?= $this->lang->line("turnstile") ?></option>
                     <!-- <option value="total_ticket"><?= $this->lang->line("count ticket") ?></option> -->
                     <!-- <option value="qty"><?= $this->lang->line("qty turnstile") ?></option>               -->
                  </select>
               </div>      
               <div class="col-sm-4">
                  <label for="sort_type" class="control-label"><?= $this->lang->line("sort type") ?></label>
                  <select type="text" name="sort_type" id="sort_type" class="form-control">                
                     <option value="ASC">A-Z</option>
                     <option value="DESC">Z-A</option>
                   </select>
               </div>         
            </div>

         </div>
                 
      </div>

      <div class="row" style="margin: 8px;">
         <div class="col-sm-12" style="text-align: center;">
            <button type="button" class="btn btn-primary" name="btn_search" id="btn_search"><?= $this->lang->line("search")?></button>
            <button type="button" class="btn btn-warning" name="btn_clear" id="btn_clear"><?= $this->lang->line("clear")?></button>
         </div>
      </div>
   </form>
   <hr width="100%;" />

   <div class="row">      
         <div class="col-sm-12">
            <div class="table-responsive">
               <div id="dv-print">
                  <table id="grid" class="table table-condensed table-hover" cellspacing="0" cellpadding="0" border="0">
                     <caption></caption>
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
               </div>
               
            </div>
         </div>
      </div>
      
   </div>

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
   .loc_name>a, .address>a, .description>a{text-decoration: none;display: block;} 
   a#add_new{display: block;}
   #grid.edit, #grid.del{display: block;}
   th{vertical-align: middle;margin: 0;padding: 0;}
   td{vertical-align: middle;margin: 0;padding: 0;}
</style>

<script type="text/javascript">
    $(function(){

      // park  =========
      // $('#park_name').on('change', function(){

      //    var arr = [];
      //    $('#park_name option:selected').each(function(i){
      //       if($(this).val() != ''){
      //          arr[i] = {'park_name': $(this).val()};
      //       }            
      //    });

      //    if($(this).val() + '' != '' || $(this).val() != null){
      //       $.ajax({
      //          url: "<?= site_url('report/c_report_comparison_turnstile/get_gate') ?>",
      //          type: "POST",
      //          dataType: "Html",
      //          beforeSend: function () {
      //             $('#loading_header').show();
      //          },
      //          // async: false,
      //          data: {
      //             park_name: arr
      //          },
      //          success: function (data) {
      //             $('#gat_name').html(data);
                  
      //             // hide ======
      //             $('#loading_header').hide();
      //          },
      //          error: function (err) {

      //          }
      //      });
      //    }
      // });

      // gat name ======
      // $('#gat_name').on('change', function(){
      //    if($(this).val() + '' != '' || $(this).val() != null){
      //       $.ajax({
      //          url: "<?= site_url('report/c_report_comparison_turnstile/get_turnstile') ?>",
      //          type: "POST",
      //          dataType: "JSON",
      //          beforeSend: function () {
      //             $('#loading_header').show();
      //          },
      //          // async: false,
      //          data: {
      //             gat_name: $(this).val() 
      //          },
      //          success: function (data) {
      //             var opt = '';
      //             if (data.length > 0) { 
      //                opt += '<option></option>';                            
      //                $.each(data, function (i, row) {
      //                   opt += '<option value="' + row.cou_typeno + '">' + row.counter_name + '</option>';
      //                });
      //             }
      //             $('#counter_name').html(opt); 

      //             $('#loading_header').hide();                          
      //          },
      //          error: function (err) {

      //          }
      //       });
      //    }
      // });

      // get park gate ======
      // get_park();
      get_gate();
      get_turnstile();

      // report type ====
      $('#report_type').on('change', function(){
         var report_type = $(this).val() - 0;
         if(report_type == 1){
            $('#title_top').html(' - Summary');
            $('#grid').find('#date').remove();
            var tr = "";
            tr += "<tr>"+ 
                        "<td colspan='7' style='font-size: 14px;text-align: center;font-weight: bold;'>No Results</td>"+
                     "</tr>";
            $('#grid tbody').html(tr);
            $("#sort_by option[value='tc.count_date']").remove();
         }else{
            $('#title_top').html(' - Detail');
            $('#grid').find('#no').after('<th id="date" width="10%"><?= $this->lang->line("date")?></th>');
            var tr = "";
            tr += "<tr>"+ 
                        "<td colspan='8' style='font-size: 14px;text-align: center;font-weight: bold;'>No Results</td>"+
                     "</tr>";
            $('#grid tbody').html(tr); 

            $("#sort_by option[value='tc.count_date']").remove();
            $('#sort_by').prepend('<option selected="selected" value="tc.count_date">Date</option>');                  
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
      $('#from_date, #to_date, #contact_name, #customer_name, #age').on('focus', function(){         
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
         var title_date = 'From date: ' + $('#from_date').val() + ' To date: ' + $('#to_date').val();
         $('#grid').attr('border', '1');
         $('#grid').find('caption').html('<center><b><div>Comparison Turnstile Report</div><div>'+ title_date +'</div></b></center>');
         var arr_exp = fn_pr_ex().split("####");
         window.open('data:application/vnd.ms-excel,' + encodeURIComponent(arr_exp[1]));
         $('#grid').find('caption').html('');         
         $('#grid').attr('border', '0');
      });

      // print ======
      $("body").delegate("a#print","click",function(){
         var arr_pr = fn_pr_ex().split("####");
         gsPrint(arr_pr[0], arr_pr[1]);
      });

      // sortTable($('#mytable'),'asc')

   }); // ready =====

   // print or export ======
   function fn_pr_ex(){
      var title_date = 'From date: ' + $('#from_date').val() + ' To date: ' + $('#to_date').val();
      var title = "<center style='font-weight:bold; font-size:14px;'><div>Comparison Turnstile Report</div><div class='from_to_date' style='font-size:12px;'>"+ title_date +"</div></center>";
      var data = $("#dv-print").html();
      var export_data = $("<center>" + data + "</center>").html();
      return title + "####" + export_data;
   }

   function sortTable($table, order){
       var $rows = $('tbody > tr', $table);
       $rows.sort(function (a, b) {
           var keyA = $('td', a).text();
           var keyB = $('td', b).text();
           if (order == 'asc') {
               return (keyA > keyB) ? 1 : 0;
           } else {
               return (keyA > keyB) ? 0 : 1;
           }
       });
       $.each($rows, function (index, row) {
           $table.append(row);
       });
   }

   // get turnstile ======
   function get_turnstile(){
      $.ajax({
         url: "<?= site_url('report/c_report_comparison_turnstile/get_turnstile') ?>",
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

   // get parks ======
   function get_gate() {
      $.ajax({
         url: "<?= site_url('report/c_report_comparison_turnstile/get_gate') ?>",
         type: "POST",
         dataType: "Html",
         beforeSend: function () {
            $('#loading_header').show();
         },
         // async: false,
         data: {
            
         },
         success: function (data) {
            $('#gat_name').html(data);
            
            // hide ======
            $('#loading_header').hide();
         },
         error: function (err) {

         }
      });
   }

   // get parks ======
   function get_park() {
      $.ajax({
         url: "<?= site_url('report/c_report_comparison_turnstile/get_park') ?>",
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
      $('#from_date').val("<?= $this->green->gdate_format() ?>");
      $('#to_date').val("<?= $this->green->gdate_format() ?>");      
      $('#park_name').val('');
      $('#gat_name').val('');
      $('#counter_name').val('');
      $('#report_type').val('1');
      $('#sort_by').val('p.park_name');
      $('#sort_type').val('ASC');
      $('#grid').find('#date').remove();
   }   

   // show data ======
   function grid(){
      var arr = [];
      $('#park_name option:selected').each(function(i){
         if($(this).val() != ''){
            arr[i] = {'park_name': $(this).val()};
         }            
      });
               
      $.ajax({
         url: "<?= site_url('report/c_report_comparison_turnstile/grid') ?>",
         type: "POST",
         dataType: "HTML",
         beforeSend: function(){
            $('#loading_header').show();
         },
         // async: false,
         data: {
            from_date: $('#from_date').val(),
            to_date: $('#to_date').val(),
            park_name: arr,
            gat_name: $('#gat_name').val(),
            counter_name: $('#counter_name').val(),
            report_type: $('#report_type').val(),          
            sort_by: $('#sort_by').val(),
            sort_type: $('#sort_type').val()
         },
         success: function(data){       
            $('#grid tbody').html(data);

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