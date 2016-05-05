<div class="container-fluid">
   <div class="row">
      <div class="col-xs-12">         
         <div class="result_info">            
            <div class="col-xs-4" style="font-weight: bold;"><?= $this->lang->line("application report")?></div>
            <div class="col-xs-8" style="text-align: right;">
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
            <label for="from_date" class="label-control"><?= $this->lang->line("from date")?></label>
            <!-- <div class="input-group date" name="my_from_date" id="my_from_date"> -->
               <input type="text" class="form-control" name="from_date" id="from_date" placeholder="<?= $this->lang->line('from date')?>" data-parsley-required="true" data-parsley-error-message="This field required!">
               <!-- <span class="glyphicon glyphicon-calendar"></span> -->
               <!-- <span class="input-group-addon">
                 <span class="fa fa-calendar"></span>
               </span> -->
            <!-- </div> -->
         </div>
         <div class="col-sm-4">
            <label for="to_date" class="label-control"><?= $this->lang->line("to date")?></label>
            <!-- <div class="input-group date" name="my_to_date" id="my_to_date"> -->
               <input validate type="text" class="form-control" name="to_date" id="to_date" placeholder="<?= $this->lang->line('to date')?>" data-parsley-required="true" data-parsley-error-message="This field required!">
               <!-- <span class="input-group-addon">
                 <span class="fa fa-calendar"></span>
               </span>
            </div> -->
         </div>
         <div class="col-sm-4">
            <label for="contact_name" class="label-control"><?= $this->lang->line("contact name")?></label>
            <input type="text" class="form-control" name="contact_name" id="contact_name" placeholder="<?= $this->lang->line('contact name')?>">
         </div>
      </div>

      <div class="row">
         <div class="col-sm-4">
            <label for="customer_name" class="label-control"><?= $this->lang->line("customer name")?></label>
            <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="<?= $this->lang->line('customer name')?>">
         </div>
         <div class="col-sm-4">
            <label for="country" class="label-control"><?= $this->lang->line("country")?></label>
            <select class="form-control" name="country" id="country"></select>
         </div>
         <div class="col-sm-4">
            <label for="gender" class="label-control"><?= $this->lang->line("gender")?></label>
            <select class="form-control" name="gender" id="gender">
               <option></option>
               <option value="female">Female</option>
               <option value="male">Male</option>                                          
            </select>
         </div>
      </div>

      <div class="row">
         <div class="col-sm-4">
            <label for="remark" class="label-control"><?= $this->lang->line("remark")?></label>
            <select class="form-control" name="remark" id="remark">
               <option></option>
               <option value="1">Adult</option>
               <option value="2">Children</option>                     
            </select>
         </div>
         <div class="col-sm-4">
            <label for="visitor_type" class="label-control"><?= $this->lang->line("visitor type")?></label>
            <select class="form-control" name="visitor_type" id="visitor_type"></select>
         </div>
         <div class="col-sm-4">
            <label for="age" class="label-control"><?= $this->lang->line("age")?></label>
            <input number type="text" class="form-control" name="age" id="age" placeholder="<?= $this->lang->line('age')?>">
         </div>
      </div>

      <div class="row">
         <div class="col-sm-4">
            <label for="sort_by" class="control-label"><?= $this->lang->line("sort by") ?></label>
            <select name="sort_by" id="sort_by" class="form-control">                
               <option value="a.create_date">Date</option>
               <option value="v.vistor_name">Visitor Type</option>
               <option value="contact_name">Contact Name</option>
               <option value="a.gender">Gender</option>                  
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
            <table id="grid" class="table table-condensed table-hover" cellspacing="0" cellpadding="0" border="0">
               <thead>  
                  <tr>
                     <th>#</th>
                     <th><?= $this->lang->line("date")?></th>
                     <th><?= $this->lang->line("contact name")?></th>
                     <th><?= $this->lang->line("visitor type")?></th>
                     <th><?= $this->lang->line("e-mail")?></th>
                     <th><?= $this->lang->line("customer name")?></th>
                     <th><?= $this->lang->line("country")?></th>
                     <th><?= $this->lang->line("nationality")?></th>
                     <th><?= $this->lang->line("gender")?></th>
                     <th><?= $this->lang->line("age")?></th>
                     <th><?= $this->lang->line("remark")?></th>
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

<div id="dv-print" style="display: none;">
   <table id="tbl_data" class="table table-bordered table-hover" cellspacing="0" cellpadding="0" border="1" width="70%">
      <caption style="font-size: 16px;"></caption>
      <thead>
         <tr>
            <th style="text-align: center;vertical-align: middle;">#</th>
            <th style="text-align: center;vertical-align: middle;">Date</th>
            <th style="text-align: center;vertical-align: middle;">Contact Name</th>
            <th style="text-align: center;vertical-align: middle;">Visitor Type</th>
            <th style="text-align: center;vertical-align: middle;">E-mail</th>
            <th style="text-align: center;vertical-align: middle;">Customer Name</th>
            <th style="text-align: center;vertical-align: middle;">Country</th>
            <th style="text-align: center;vertical-align: middle;">Nationality</th>
            <th style="text-align: center;vertical-align: middle;">Gender</th>
            <th style="text-align: center;vertical-align: middle;">Age</th>  
            <th style="text-align: center;vertical-align: middle;">Remark</th>                      
         </tr>
      </thead>
      <tbody>      

      </tbody>
      <tfoot>
         
      </tfoot>
   </table>   
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

      // get remark ======
      // get_remark();

      // get gender ======
      // get_gender();

      // get visitor type ======
      get_visitor_type();

      // get country ======
      get_country();

      // current date ======
      get_current_date();

      //  from date =====
      // $('#from_date').css({background: 'url("<?= base_url().'assets/images/icons/calendar.png' ?>") no-repeat right', 'padding-right': '32'});
      $('#from_date').datepicker({
         forceParse: false,
         format: "yyyy-mm-dd",
         autoclose: true
      }).on('changeDate', function(){
         $('#f_save').parsley().validate();
      });

      //  to date =====
      $('#to_date').datepicker({
         forceParse: false,
         format: "yyyy-mm-dd",
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
         $('#f_save').parsley().validate();       
         grid();
      });    

      // export ======
      $("body").delegate("a#export","click",function(){
         var title_date = 'From date: ' + $('#from_date').val() + ' To date: ' + $('#to_date').val();
         $('#tbl_data').find('caption').html('<center><b><div>Application Report</div><div>'+ title_date +'</div></b></center>');
         var arr_exp = fn_pr_ex().split("####");
         window.open('data:application/vnd.ms-excel,' + encodeURIComponent(arr_exp[1]));
      });

      // print ======
      $("body").delegate("a#print","click",function(){
         $('#tbl_data').find('caption').html('');
         var arr_pr = fn_pr_ex().split("####");
         gsPrint(arr_pr[0],arr_pr[1]);
      });

   }); // ready =====

   // validate ====
   function validate_date(){ 
      var bl = true;
      $('form').find('[validate]').each(function(){
         if($.trim($(this).val()) == '' || $.trim($(this).val()) == null){
            $(this).css({background: '#FFF2F2'});
            $(this).parent().css({border: '1px solid red'});            
            bl = false;
         }else{
            $(this).css({background: ''});
            $(this).parent().css({border: ''});
            bl = true;
         }         
      });
      return bl;
   }

   // get current date ====
   function get_current_date(){
      dt = new Date();
      $('#from_date').val(dt.getFullYear() + "-" + (dt.getMonth() + 1) + "-" + dt.getDate());
      $('#to_date').val(dt.getFullYear() + "-" + (dt.getMonth() + 1) + "-" + dt.getDate());
   }

   // clear ======
   function clear(){
      get_current_date();
      $('#contact_name').val('');
      $('#customer_name').val('');
      $('#country').val('');
      $('#gender').val('');
      $('#remark').val('');
      $('#visitor_type').val('');
      $('#age').val('');
   }      

   // get country ======
   function get_country() {
      $.ajax({
         url: "<?= site_url('report/c_report_application/get_country') ?>",
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
                  opt += '<option value="' + row.country + '">' + row.name + '</option>';
              });
            }
            $('#country').html(opt);

            $('#loading_header').hide();
         },
         error: function (err) {

         }
     });
   }

   // get visitor type ======
   function get_visitor_type() {
      $.ajax({
         url: "<?= site_url('report/c_report_application/get_visitor_type') ?>",
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
                  opt += '<option value="' + row.vistor_name + '">' + row.vistor_name + '</option>';
              });
            }
            $('#visitor_type').html(opt);

            $('#loading_header').hide();
         },
         error: function (err) {

         }
     });
   }

   // get remark ======
   function get_gender() {
      $.ajax({
         url: "<?= site_url('report/c_report_application/get_gender') ?>",
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
                  opt += '<option value="' + row.gender + '">' + row.gender + '</option>';
              });
            }
            $('#gender').html(opt);

            $('#loading_header').hide();
         },
         error: function (err) {

         }
     });
   }

   // get remark ======
   function get_remark() {
      $.ajax({
         url: "<?= site_url('report/c_report_application/get_remark') ?>",
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
                  opt += '<option value="' + row.remark + '">' + row.remark + '</option>';
              });
            }
            $('#remark').html(opt);

            $('#loading_header').hide();
         },
         error: function (err) {

         }
     });
   }   

   // print or export ======
   function fn_pr_ex(){
      var title_date = 'From date: ' + $('#from_date').val() + ' To date: ' + $('#to_date').val();
      var title = "<center style='font-weight:bold; font-size:14px;'><div>Application Report</div><div class='from_to_date' style='font-size:12px;'>"+ title_date +"</div></center>";
      var data = $("#dv-print").html();
      var export_data = $("<center>" + data + "</center>").html();
      return title + "####" + export_data;
   }

   // show data ======
   function grid(){      
      $.ajax({
         url: "<?= site_url('report/c_report_application/grid') ?>",
         type: "POST",
         dataType: "HTML",
         beforeSend: function(){
            $('#loading_header').show();
         },
         // async: false,
         data: {
            from_date: $('#from_date').val(),
            to_date: $('#to_date').val(),
            contact_name: $('#contact_name').val(),
            customer_name: $('#customer_name').val(),
            country: $('#country').val(),
            gender: $('#gender').val(),
            remark: $('#remark').val(),
            visitor_type: $('#visitor_type').val(),
            age: $('#age').val(),
            sort_by: $('#sort_by').val(),
            sort_type: $('#sort_type').val()
         },
         success: function(data){       
            $('#grid tbody').html(data);

            // print/export ======     
            $('#tbl_data tbody').html(data);

            // hide loading ======
            $('#loading_header').hide();            
         },
         error: function(err){

         }
      });
   }
</script>