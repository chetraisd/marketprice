<div class="container-fluid">
   <div class="row">
      <div class="col-xs-12">         
         <div class="result_info">            
            <div class="col-xs-4" style="font-weight: bold;"><?= $this->lang->line("comparisons")?></div>
            <div class="col-xs-8" style="text-align: right;">
               <?php if($this->green->gAction("R")){ ?>
                  <a href="javascript: void(0)" id="a_search" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    <img width="24px" height="24px" src="<?= base_url('assets/images/icons/searchs.png') ?>">
                  </a>
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

   <div class="row" style="overflow-x: hidden;overflow-y: hidden;">      
      <div class="collapse" id="collapseExample">
         <div class="row"> 
            <div class="col-sm-12">
               <div class="col-sm-2">
                  <input type="text" class="form-control" name="search_park_name" id="search_park_name" placeholder="<?= $this->lang->line('park name')?>" />
               </div>
               <div class="col-sm-2">
                  <input type="text" class="form-control" name="search_gat_name" id="search_gat_name" placeholder="<?= $this->lang->line('gate name')?>">
               </div>
               <div class="col-sm-2">
                  <input type="text" class="form-control" name="search_counter_name" id="search_counter_name" placeholder="<?= $this->lang->line('turnstile name')?>">
               </div>
               <div class="col-sm-3" style="font-size: 10px;">
                  <div class="input-group date" name="my_date" id="my_date">
                      <input date_ type="text" class="form-control" name="search_count_date" id="search_count_date" placeholder="<?= $this->lang->line('count date')?>">
                      <span class="input-group-addon">
                          <span class="fa fa-calendar"></span>
                      </span>
                  </div>
               </div>
               <div class="col-sm-2">
                  <select class="form-control" name="search_status" id="search_status">
                     <option value="1" selected="selected">In</option>
                     <option value="0">Out</option>
                  </select>
               </div>
            </div>
         </div>  
         <div style="height: 10px;">&nbsp;</div>
         <div class="row"> 
            <div class="col-sm-12 col-sm-offset-5">
               <button type="button" class="btn btn-primary" name="btn_search" id="btn_search"><?= $this->lang->line("search")?></button>
               <button type="button" class="btn btn-warning" name="btn_clear" id="btn_clear">Refresh</button>
            </div>
         </div>               
         <div class="row">
            <div class="col-sm-12">
               <div class="col-sm-12">
                  <div style="border-bottom: 1px solid #CCC;">&nbsp;</div>
               </div>
            </div>
         </div>
      </div>      
   </div>

   <div class="row">
      <div class="col-sm-12">
         <div class="table-responsive">
            <table id="grid" class="table table-condensed table-hover" cellspacing="0" cellpadding="0" border="0">
               <thead>            
                  <tr>
                     <th width="5%">#<input type="hidden" id="set_sort" data-fd="park_name" data-order="ASC"></th>
                     <th width="15%" class="manage-column park_name" data-fd="park_name" data-order="ASC">
                        <a href="javascript: void(0)">                        
                           <span><?= $this->lang->line("park name") ?></span>
                           <span class="glyphicon glyphicon-menu-up" style="font-size: 9px;"></span>
                        </a>                     
                     </th>
                     <th width="15%" class="manage-column gat_name" data-fd="gat_name" data-order="ASC">
                        <a href="javascript: void(0)">
                           <span><?= $this->lang->line("gate name") ?></span>
                           <span style="font-size: 9px;"></span>
                        </a>                     
                     </th>
                     <th width="10%" class="manage-column counter_name" data-fd="counter_name" data-order="ASC">
                        <a href="javascript: void(0)">
                           <span><?= $this->lang->line("turnstile") ?></span>
                           <span style="font-size: 9px;"></span>
                        </a>                     
                     </th>
                     <th width="15%" class="manage-column count_date" data-fd="count_date" data-order="ASC">
                        <a href="javascript: void(0)">
                           <span><?= $this->lang->line("count date") ?></span>
                           <span style="font-size: 9px;"></span>
                        </a>                     
                     </th>
                     <th style="text-align: center;" width="10%" class="manage-column qty" data-fd="qty - 0" data-order="ASC">
                        <a href="javascript: void(0)">
                           <span><?= $this->lang->line("quantity") ?></span>
                           <span style="font-size: 9px;"></span>
                        </a>
                     </th>
                     
                     <th width="10%" style="text-align: center;">
                        <?= $this->lang->line("status") ?>                   
                     </th>
                     <th width="25%" class="manage-column note" data-fd="note" data-order="ASC">
                        <a href="javascript: void(0)">
                           <span><?= $this->lang->line("note") ?></span>
                           <span style="font-size: 9px;"></span>
                        </a>
                     </th>
                     <th width="5%" colspan="2">
                        <?php if($this->green->gAction("C")){ ?>
                           <a href="javascript: void(0)" id="add_new" style="text-align: center;">
                              <img width="24px" height="24px" src="<?= base_url('assets/images/icons/adds.png') ?>">
                           </a>
                        <?php } ?>
                     </th>
                  </tr>
               </thead>
               <tbody>
                  
               </tbody>
               <tfoot>
                  
               </tfoot>
            </table>
         </div>
      </div>     
   </div><br />

   <div id="dv_foot" class="row" style="margin: -20px;">
      <div class="col-sm-1">
         <select id="total_display" class="form-control input-sm" style="width: 80px;">
            <option value="5">5</option>
            <option value="10" selected="selected">10</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="500">500</option>
            <option value="1000">1000</option>
         </select>
      </div>
      <div class="col-sm-5">
         <ul class=" pagination pagination-sm" id="pagination-grid" style="display: inline;"></ul>
      </div>
      <div class="col-sm-6" style="text-align: right;">
         <div id="display" style="font-weight: bold;margin: 8px;"></div>
      </div>
   </div>

</div>

<div id="myModal" class="modal">
  <div id="sub_myModal" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" id="close_top" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 id="title" class="modal-title">Modal title</h5>
      </div>
      <div class="modal-body">
         <form id="f_save" class="form-horizontal" enctype="multipart/form-data">
            <input clear_a_element type="hidden" name="com_typeno" id="com_typeno">
            <div class="form-group">
               <label for="park_name" class="col-sm-3 control-label"><?= $this->lang->line("park name")?><span style="color:red"> *</span></label>
               <div class="col-sm-8">
                  <select clear_a_element class="form-control" name="park_name" id="park_name" data-parsley-required="true" data-parsley-error-message="This field required!"></select>
               </div>
            </div>
            <div class="form-group">
               <label for="gat_name" class="col-sm-3 control-label"><?= $this->lang->line("gate name")?><span style="color:red"> *</span></label>
               <div class="col-sm-8">
                  <select clear_a_element class="form-control" name="gat_name" id="gat_name" data-parsley-required="true" data-parsley-error-message="This field required!"></select>
               </div>
            </div>
            <div class="form-group">
               <label for="counter_name" class="col-sm-3 control-label"><?= $this->lang->line("turnstile name")?><span style="color:red"> *</span></label>
               <div class="col-sm-8">
                  <select clear_a_element class="form-control" name="counter_name" id="counter_name" data-parsley-required="true" data-parsley-error-message="This field required!"></select>
               </div>
            </div>            
            <div class="form-group">
               <label for="count_date" class="col-sm-3 control-label"><?= $this->lang->line("count date")?></label>
               <div class="col-sm-8">
                  <div class="input-group date" name="my_date_f" id="my_date_f">
                      <input date_ clear_a_element type="text" class="form-control" name="count_date" id="count_date" placeholder="<?= $this->lang->line('count date')?>">
                      <span class="input-group-addon">
                          <span class="fa fa-calendar"></span>
                      </span>
                  </div>
               </div>
            </div>
            <div class="form-group">
               <label for="qty" class="col-sm-3 control-label"><?= $this->lang->line("quantity")?></label>
               <div class="col-sm-8">
                  <input decimal clear_a_element type="text" class="form-control" name="qty" id="qty">
               </div>
            </div>
            <div class="form-group">
               <label for="status" class="col-sm-3 control-label"><?= $this->lang->line("status")?></label>
               <div class="col-sm-8">
                  <select class="form-control" name="status" id="status">
                     <option value="1" selected="selected">Count In</option>
                     <option value="0">Count Out</option>
                  </select>
               </div>
            </div>
            <div class="form-group">
               <label for="note" class="col-sm-3 control-label"><?= $this->lang->line("note")?></label>
               <div class="col-sm-8">
                  <textarea style="resize: none;" clear_a_element rows="5" class="form-control" name="note" id="note" placeholder="<?= $this->lang->line('note')?>"></textarea>
               </div>
            </div>                                
         </form>
      </div>
      <div class="modal-footer">
      <?php if ($this->green->gAction("C")){?>
        <button type="button" id="save" class="btn btn-primary save"><?= $this->lang->line("save")?></button>
        <button type="button" id="save_close" class="btn btn-primary save" data-close="true"><?= $this->lang->line("save close")?></button>
      <?php } ?>  
      <button type="button" id="close_bottom" class="btn btn-warning" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="dv-print" class="table-responsive" style="display: none;">
   <table id="tbl_data" class="table table-bordered table-hover" cellspacing="0" cellpadding="0" border="1" width="70%">
      <caption style="font-size: 16px;"></caption>
      <thead>
         <tr>
            <th style="text-align: center;vertical-align: middle;">#</th>
            <th style="text-align: center;vertical-align: middle;">Park Name</th>
            <th style="text-align: center;vertical-align: middle;">Gate Name</th>
            <th style="text-align: center;vertical-align: middle;">Count Date</th>
            <th style="text-align: center;vertical-align: middle;">Quantity</th>
            <th style="text-align: center;vertical-align: middle;">Status</th>
            <th style="text-align: center;vertical-align: middle;">Note</th>            
         </tr>
      </thead>
      <tbody>      

      </tbody>
      <tfoot>
         
      </tfoot>
   </table>
</div>

<style type="text/css">
   .park_name > a, .gat_name > a, .counter_name > a, .count_date > a, 
   .status > a, .qty > a, .note > a{text-decoration: none;display: block;} 
   a#add_new{display: block;}
   #grid.edit, #grid.del{display: block;}
	th{vertical-align: middle;margin: 0;padding: 0;}
	td{vertical-align: middle;margin: 0;padding: 0;}
   #dv_img{cursor: pointer;}

   .datepicker{z-index: 1151!important;}
   .input-group-addon{cursor: pointer;}
</style>

<script type="text/javascript">
	$(function(){           

      // destroy parsley =======      
      $('#close_bottom, #close_top').on('click', function(){  
         $('form#f_save').parsley().destroy();
      });

      //  search count date =====
      $('#my_date').datepicker({
         language: 'en',         
         pick12HourFormat: true,
         forceParse: false,
         format: "<?= $this->green->jdate_format() ?>",
         autoclose: true
      });

      //  save count date =====
      $('#my_date_f').datepicker({
         language: 'en',         
         pick12HourFormat: true,
         forceParse: false,
         format: "<?= $this->green->jdate_format() ?>",
         autoclose: true
      });

      // close park =====
      $('#close_park_top, #close_park').on('click', function(){
         $('#myModal').modal({backdrop: 'static'})
      });

      // tooltip ====      
      $('#a_search').tooltip({title: 'show / hide Search'})
      $('#export').tooltip({title: 'Export'})
      $('#print').tooltip({title: 'Print'})
      
      $('body').delegate('', 'mouseover', function(){
         $('#search_park_name').tooltip({title: 'Search by Location Name'})
      });
      $('#search_gat_name').tooltip({title: 'Search by Gate Name'})
      $('#search_description').tooltip({title: 'Search by Description'})

      $('#add_new').tooltip({title: 'Add New'})

      $('body').delegate('', 'mouseover', function(){
         $('.edit').tooltip({title: 'Edit'})
      });    
      $('body').delegate('', 'mouseover', function(){
         $('.del').tooltip({title: 'Delete'})
      });

      $('#total_display').tooltip({title: 'Total Display'})  

      $('body').delegate('', 'mouseover', function(){
         $('.fa-fast-backward').parent().tooltip({title: 'Start'})
      });
      $('body').delegate('', 'mouseover', function(){
         $('.fa-backward').parent().tooltip({title: 'Previous'})
      });
      $('body').delegate('', 'mouseover', function(){
         $('.fa-forward').parent().tooltip({title: 'Next'})
      });
      $('body').delegate('', 'mouseover', function(){
         $('.fa-fast-forward').parent().tooltip({title: 'End'})
      });   

      // focus =======
      $('#qty').on('focus', function(){
         $(this).select();
      });

      // save =======      
      $('.save').on('click', function(){
         var close = $(this);
         if($('#f_save').parsley().validate()){
            $.ajax({
               url: "<?= site_url('invoice/ccomparison/save') ?>",
               type: "POST",
               dataType: "JSON",
               beforeSend: function(){
                  $('#loading_header').show();
               },
               // async: false,
               data: {
                  com_typeno: $('#com_typeno').val(),
                  park_name: $('#park_name').val(),
                  gat_name: $('#gat_name').val(),
                  counter_name: $('#counter_name').val(),
                  count_date: $('#count_date').val(),                  
                  qty: $('#qty').val(),
                  status: $('#status').val(),
                  note: $('#note').val()                                               
               },
               success: function(data){              
                  if(data.success == 'true'){
                     clear_a_element();
                     $('#qty').val(0);                                                                                                                                                                                                      $('#set_sort').attr('data-order');
                     grid(1, $('#total_display').val() - 0, $('#set_sort').attr('data-fd'), $('#set_sort').attr('data-order'));                                     
                     $('#success').show();
                     setTimeout(function(){                     
                        $('#success').hide();
                     }, 1000);
                     if(close.attr('data-close') == 'true'){
                        $('#myModal').modal('hide')                                              
                     }
                  }else{
                     alert('Duplicate' + ' ' + "'" + $('#gat_name option:selected').text() + "' with '" + $('#count_date').val() + "' " +'!')
                     $('#gat_name').focus();
                  }
                  $('#loading_header').hide();
               },
               error: function(err){

               }
            });
         }
      });
		
		// edit ======
		$('body').delegate('.edit', 'click', function(){       
			var com_typeno = $(this).parent().parent().find(this).data('id');
         var park_name = $(this).parent().parent().find(this).data('park_name');
         var gat_name = $(this).parent().parent().find(this).data('gat_name');
         var turnstile_name = $(this).parent().parent().find(this).data('counter_name');
         var count_date = $(this).parent().parent().find(this).data('count_date');
         var qty = $(this).parent().parent().find(this).data('qty');
         var status = $(this).parent().parent().find(this).data('status');
         var note = $(this).parent().parent().find(this).data('note');

         $.ajax({
            url: "<?= site_url('invoice/ccomparison/get_park') ?>",
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
                     if(park_name == row.par_typeno){
                        opt += '<option selected="selected" value="' + row.par_typeno + '">' + row.park_name + '</option>';
                     }else{
                        opt += '<option value="' + row.par_typeno + '">' + row.park_name + '</option>';
                     }
                  });
               }
               $('#park_name').html(opt);

               // get gates =======
               if(park_name - 0 > 0){
                  $.ajax({
                     url: "<?= site_url('invoice/ccomparison/get_gate') ?>",
                     type: "POST",
                     dataType: "JSON",
                     beforeSend: function () {

                     },
                     // async: false,
                     data: {
                        par_typeno: park_name
                     },
                     success: function (data) {
                        var opt = '';
                        if (data.length > 0) {
                           opt += '<option></option>';
                          $.each(data, function (i, row) {
                              if(gat_name == row.gat_typeno){
                                 opt += '<option selected="selected" value="' + row.gat_typeno + '">' + row.gat_name + '</option>';
                              }else{
                                 opt += '<option value="' + row.gat_typeno + '">' + row.gat_name + '</option>';
                              }                              
                          });
                        }
                        $('#gat_name').html(opt);

                        // get turnstile =======
                        if(gat_name - 0 > 0){
                           $.ajax({
                              url: "<?= site_url('invoice/ccomparison/get_turnstile') ?>",
                              type: "POST",
                              dataType: "JSON",
                              beforeSend: function () {

                              },
                              // async: false,
                              data: {
                                 gat_typeno: gat_name
                              },
                              success: function (data) {
                                 var opt = '';
                                 if (data.length > 0) {
                                    opt += '<option></option>';
                                   $.each(data, function (i, row) {
                                       if(turnstile_name == row.cou_typeno){
                                          opt += '<option selected="selected" value="' + row.cou_typeno + '">' + row.counter_name + '</option>';
                                       }else{
                                          opt += '<option value="' + row.cou_typeno + '">' + row.counter_name + '</option>';
                                       }                              
                                   });
                                 }
                                 $('#counter_name').html(opt);

                                 // show a field ======
                                 $('#com_typeno').val(com_typeno);
                                 $('#count_date').val(count_date != '0000-00-00' ? count_date : '');    
                                 $('#qty').val((qty - 0 > 0 ? qty : 0));
                                 $('#status').val(status);
                                 $('#note').val(note);

                                 $('#loading_header').hide();

                                 $('#title').text('Edit - Comparisons');
                                 $('#myModal').modal({backdrop: 'static'})
                                 $("#sub_myModal").draggable({
                                    handle: ".modal-header"
                                 });
                              },
                              error: function (err) {

                              }
                          });
                        }


                     },
                     error: function (err) {

                     }
                 });
               }
               
            },
            error: function (err) {

            }
         });
		});

      // delete ======
      $('body').delegate('.del', 'click', function(){
         var com_typeno = $(this).parent().parent().find(this).data('id');
         if(confirm('Are you sure to delete?')){
            $.ajax({
               url: "<?= site_url('invoice/ccomparison/delete') ?>",
               type: "POST",
               dataType: "JSON",
               beforeSend: function(){
                  $('#loading_header').show();
               },
               // async: false,
               data: {
                  com_typeno: com_typeno
               },
               success: function(data){
                  if(data.success == 'true'){
                     clear_search();
                     grid(1, $('#total_display').val() - 0, $('#set_sort').attr('data-fd'), $('#set_sort').attr('data-order')); 
                     $('#loading_header').hide();
                     $('#success').show();                
                     setTimeout(function(){
                         $('#success').hide();
                     }, 1000);
                  }   

               },
               error: function(err){

               }
            });
         }
      });

      // add new ======
      $('#add_new').on('click', function(){ 
         clear_a_element();
         $('#gat_name').html('');
         $('#counter_name').html('');
         $('#qty').val(0);  
         $('#title').text('Add New - Comparisons');
         // get ==========         
         get_park();
         get_gate();
         get_turnstile();
      });

      // focusin ======
      $('#search_park_name').on('focus', function(){         
         $(this).select();
      });
      $('#search_gat_name').on('focus', function(){         
         $(this).select();
      });
      $('#search_count_date').on('focus', function(){         
         $(this).select();
      });

      // clear search ======
      $('#btn_clear').on('click', function(){         
         clear_search();                
         var fd = $('#set_sort').attr('data-fd');
         var order = $('#set_sort').attr('data-order');
         grid(1, $('#total_display').val() - 0, fd, order);
      });

      // sort ======
      $('body').delegate('.manage-column', 'click', function(){
         var fd = $(this).attr('data-fd');
         var order = $(this).attr('data-order');

         if(order != '' || order != null){
            $('.manage-column').find('span:last').removeClass();
            if(order === 'ASC'){
               $('#set_sort').attr('data-fd', $(this).attr('data-fd')); 
               $('#set_sort').attr('data-order', order);
               $(this).attr('data-order', 'DESC'); 
               $(this).find('span:last').addClass('glyphicon glyphicon-menu-up');
            }else{
               $('#set_sort').attr('data-fd', $(this).attr('data-fd')); 
               $('#set_sort').attr('data-order', order);
               $(this).attr('data-order', 'ASC');
               $(this).find('span:last').addClass('glyphicon glyphicon-menu-down');
            }
         }     
         grid(1, $('#total_display').val() - 0, fd, order);
      });

      // ini. =======
      var fd = $('#set_sort').attr('data-fd');
      var order = $('#set_sort').attr('data-order');
      $('.park_name').attr('data-order', 'DESC');
      grid(1, $('#total_display').val() - 0, fd, order);      

      // search ======
      $('#btn_search').on('click', function(){
         var fd = $('#set_sort').attr('data-fd');
         var order = $('#set_sort').attr('data-order');
         grid(1, $('#total_display').val() - 0, fd, order);
      });

      // display ======
      $('#total_display').on('change', function(){
         var fd = $('#set_sort').attr('data-fd');
         var order = $('#set_sort').attr('data-order');
         grid(1, $(this).val() - 0, fd, order);
      });

      // page =======
      $('body').delegate('.a-pagination', 'click', function(){ 
         var fd = $('#set_sort').attr('data-fd');
         var order = $('#set_sort').attr('data-order');      
         grid($(this).data('currentpage') - 0, $('#total_display').val() - 0, fd, order);
      });

      // search =======
      $('body').delegate('#a_search', 'click', function(){
         clear_search();
         var fd = $('#set_sort').attr('data-fd');
         var order = $('#set_sort').attr('data-order');
         grid(1, $('#total_display').val() - 0, fd, order);
      });

      // export ======
      $("body").delegate("a#export","click",function(){
         $('#tbl_data').find('caption').html('<center><b>Comparisons List</b></center>');
        // $("#tbl_content_exp #show_img").remove();
        // var htmltable= document.getElementById('tbl_content_exp');
        // var html = htmltable.outerHTML;
        // window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
        var arr_exp = fn_pr_ex().split("####");
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent(arr_exp[1]));
      });

      // print ======
      $("body").delegate("a#print","click",function(){
         $('#tbl_data').find('caption').html('');
         var arr_pr = fn_pr_ex().split("####");
         gsPrint(arr_pr[0],arr_pr[1]);
      });

      $('#add_park').on('click', function(){      
         $('#title_park').text('Add New - Parks');
         clear_park();
         $('#location').css({border: ''});
         $('#location').focus();
         $('#park_name').css({border: ''});
          
         $('#m_park_save').modal({backdrop: 'static'})
         $('#sub_m_park_save').draggable({
            handle: ".modal-header"
         }); 
         $('#myModal').modal('hide')
      });

	}); // ready ======   

   // clear park ======
   function clear_park() {
      $('#location').val('');
      $('#park_name').val('');    
      $('#description').val('');
      $('#photo').val('');
      $('#img_park').attr({src: '<?= base_url("assets/upload/images.png") ?>'});
   }   
   
   // get parks ======
   function get_park() {
      $.ajax({
         url: "<?= site_url('invoice/ccomparison/get_park') ?>",
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

            $('#myModal').modal({backdrop: 'static'})
            $("#sub_myModal").draggable({
               handle: ".modal-header"
            });
         },
         error: function (err) {

         }
     });
   }

   //  get gate ========
   function get_gate(){
      $.ajax({
         url: "<?= site_url('invoice/ccomparison/get_gate') ?>",
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
            if(data.length > 0){
              opt += '<option></option>';
              $.each(data, function (i, row) {
                  opt += '<option value="' + row.gat_typeno + '">' + row.gat_name + '</option>';
              });
            }
            $('#gat_name').html(opt);
            $('#loading_header').hide();
         },
         error: function (err) {

         }
      });
   }

   //  get turnstile ========
   function get_turnstile(){
      $.ajax({
         url: "<?= site_url('invoice/ccomparison/get_turnstile') ?>",
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
            if(data.length > 0){
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

   // print or export ======
   function fn_pr_ex(){
     // $(".remove_inv").remove();
     // var htmlToPrint = ''+'<style type="text/css">' +
     //                        'table th, table td {' +
     //                        'border:1px solid #000 !important;' +
     //                        'padding;0.5em;' +
     //                        '}' +
     //                        '</style>';
     var title = "<center style='font-weight:bold; font-size:16px;'>Comparisons List</center>";
     //var s_adr   = "Title</div>";
     //    title+=s_adr;
     //title +="<h4 align='center'>Invoice</h4>"; 
     var data = $("#dv-print").html().replace(/<img[^>]*>/gi,"");
     var export_data = $("<center>" + data + "</center>").clone().find(".remove_tag").remove().end().html();
     //export_data+=htmlToPrint;
     return title + "####" + export_data;
   }

	// clear ======
	function clear_search(){
		$('#search_park_name').val('');
      $('#search_gat_name').val('');
      $('#search_counter_name').val('');
      $('#search_count_date').val(''); 
      $('#search_status').val('1');
	}

   // number format ====
   function formatNumber(num) {
       return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
   }

	// show data ======
	function grid(current_page, total_display, fd, order){
      offset = ((current_page - 1) * total_display) - 0;
      limit = total_display - 0;
		$.ajax({
			url: "<?= site_url('invoice/ccomparison/grid') ?>",
			type: "POST",
			dataType: "JSON",
			beforeSend: function(){
            $('#loading_header').show();
			},
			// async: false,
			data: {
            search_park_name: $('#search_park_name').val(),
            search_gat_name: $('#search_gat_name').val(),
            search_counter_name: $('#search_counter_name').val(),
            search_count_date: $('#search_count_date').val(),
            search_status: $('#search_status').val(),                        
            offset: offset,
            limit: limit,
            fd, 
            order
			},
			success: function(data){
            var result = data.result;
            var total_records = data.total_records;
            var total_pages = data.total_pages;          
				var tr = '';
            var pagination = '';
            var display = '';

				if(result.length > 0){
					$.each(result, function(i, row){
						tr += "<tr>"+ 
									"<td>"+ (offset + i + 1) +"</td>"+
									"<td>"+ (row.park_name != null ? row.park_name : '') +"</td>"+
									"<td>"+ (row.gat_name != null ? row.gat_name : '') +"</td>"+
                           "<td>"+ (row.counter_name != null ? row.counter_name : '') +"</td>"+
                           "<td>"+ (row.count_date != '0000-00-00' ? row.count_date : '') +"</td>"+
                           "<td style='text-align: right;'>"+ (row.qty - 0 > 0 ? formatNumber(row.qty) : 0) +"</td>"+
                           "<td style='text-align: center;'>"+ (row.status == 1 ? 'In' : 'Out') +"</td>"+
                           "<td>"+ (row.note != null ? row.note : '') +"</td>"+
                           "<td class='remove_tag' style='text-align: center;'>";
                  // condition ======      
                  if("<?php echo $this->green->gAction('U') ?>"){
                     tr += "<a href='javascript: void(0)' class='edit' data-id='"+ row.com_typeno +"' data-park_name='"+ row.par_typeno +"' data-gat_name='"+ row.gat_typeno +"' data-counter_name='"+ row.cou_typeno +"' data-count_date='"+ row.count_date +"' data-qty='"+ row.qty +"' data-status='"+ row.status +"' data-note='"+ row.note +"'><img width='15px' height='15px' src='<?= base_url("assets/images/icons/edit.png") ?>'></a>";
						}	
                  tr += "</td>";
                  tr += "<td class='remove_tag' style='text-align: center;'>";
                  if("<?php echo $this->green->gAction('D') ?>"){	
                     tr += "<a href='javascript: void(0)' class='del' data-id='"+ row.com_typeno +"'><img width='15px' height='15px' src='<?= base_url("assets/images/icons/delete.png") ?>'></a>";
						}
                  // ================
                  tr +=  "</td>";
                  tr +=	"</tr>";
					});
               
              pagination += '<li><a class="a-pagination" href="javascript: void(0)" data-currentpage="1"><span class="fa fa-fast-backward"></span></a></li>';
              pagination += '<li><a class="a-pagination" href="javascript: void(0)" data-currentpage="' + (current_page > 1 ? current_page - 1 : 1) + '"><span class="fa fa-backward"></span></a></li>';

              // next ========
              for (var i = 1; i <= 1; i++) {
                  var p = 1;
                  if (current_page <= 2) {
                      p = i;
                  } else {
                      p = current_page - 2 + i;
                  }
                  if (p <= total_pages) {
                      var active = current_page == p ? ' class= "active" ' : '';
                      pagination += '<li ' + active + '><a class="a-pagination" href="javascript: void(0)" data-currentpage="' + p + '">' + p + '</a></li>';
                  }
              }
              // pre. =========
              for (var i = 0; i <= 2; i++) {
                  var pr = 1;
                  if (current_page <= 2) {
                      pr = 2 + i;
                  } else {
                      pr = current_page + i;
                  }
                  if (pr <= total_pages) {
                      var active = current_page == pr ? ' class= "active" ' : '';
                      pagination += '<li ' + active + '><a class="a-pagination" href="javascript: void(0)" data-currentpage="' + pr + '">' + pr + '</a></li>';
                  }
              }

              $('#dv_foot').show();
              display += (limit + offset >= total_records ? total_records : limit + offset) + ' / ' + total_records + ' Items';
              pagination += '<li><a class="a-pagination" href="javascript: void(0)" data-currentpage="' + (current_page < total_pages ? current_page + 1 : total_pages) + '"><span class="fa fa-forward"></span></a></li>';
              pagination += '<li><a class="a-pagination" href="javascript: void(0)" data-currentpage="' + total_pages + '"><span class="fa fa-fast-forward"></span></a></li>';
				}else{
               $('#dv_foot').hide();
               tr += "<tr>"+ 
                           "<td colspan='9' style='font-size: 14px;text-align: center;font-weight: bold;'>No Results</td>"+
                        "</tr>";
            }

            $('#grid tbody').html(tr);            
            $('#pagination-grid').html(pagination);
            $('#display').html(display);      
            // print/export ======     
            $('#tbl_data tbody').html(tr);

            // hide loading ======
            $('#loading_header').hide();            
			},
			error: function(err){

			}
		});
	}
</script>