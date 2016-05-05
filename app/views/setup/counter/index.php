<div class="container-fluid">
   <div class="row">
      <div class="col-xs-12">         
         <div class="result_info">            
            <div class="col-xs-4" style="font-weight: bold;"><?= $this->lang->line("turnstiles")?></div>
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
               <div class="col-sm-1" style="width: 40px;">&nbsp;</div>
               <div class="col-sm-3">
                  <input type="text" class="form-control" name="search_counter_name" id="search_counter_name" placeholder="<?= $this->lang->line("turnstile name")?>">
               </div>
               <div class="col-sm-3">
                  <input type="text" class="form-control" name="search_description" id="search_description" placeholder="<?= $this->lang->line("description")?>">
               </div>
               <div class="col-sm-3">
                  <input type="text" class="form-control" name="search_gat_name" id="search_gat_name" placeholder="<?= $this->lang->line("gate name")?>">
               </div>
               <div class="col-sm-1">
                  <button type="button" class="btn btn-primary" name="btn_search" id="btn_search"><?= $this->lang->line("search")?></button>
               </div>
               <div class="col-sm-1">
                  <button type="button" class="btn btn-warning" name="btn_clear" id="btn_clear">Refresh</button>
               </div>               
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
                     <th width="5%">#<input type="hidden" id="set_sort" data-fd="counter_name" data-order="ASC"></th>
                     <th width="20%" class="manage-column counter_name" data-fd="counter_name" data-order="ASC">
                        <a href="javascript: void(0)">                        
                           <span><?= $this->lang->line("turnstile name") ?></span>
                           <span class="glyphicon glyphicon-menu-up" style="font-size: 9px;"></span>
                        </a>                     
                     </th>
                     <th width="30%" class="manage-column description" data-fd="description" data-order="ASC">
                        <a href="javascript: void(0)">
                           <span><?= $this->lang->line("description") ?></span>
                           <span style="font-size: 9px;"></span>
                        </a>                     
                     </th>
                     <th width="20%" class="manage-column gat_name" data-fd="gat_name" data-order="ASC">
                        <a href="javascript: void(0)">
                           <span><?= $this->lang->line("gate name") ?></span>
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
        <button type="button" class="close close_counter" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 id="title" class="modal-title">Modal title</h5>
      </div>
      <div class="modal-body">
         <form id="f_save" class="form-horizontal" enctype="multipart/form-data">
            <input clear_a_element type="hidden" name="cou_typeno" id="cou_typeno">
            <div class="form-group">
               <label for="gate" class="col-sm-3 control-label"><?= $this->lang->line("gate name") ?><span style="color:red"> *</span></label>
               <div class="col-sm-8">
                  <div class="input-group" style="width: 100%;">
                     <select clear_a_element class="form-control" name="gate" id="gate" data-parsley-required="true" data-parsley-error-message="This field required!"></select>
                        <?php if ($this->green->gAction("C")){ ?>
                           <span class="input-group-btn">
                             <button id="add_gate" class="btn btn-primary" type="button">
                                <span class="glyphicon glyphicon-plus"></span>
                             </button>
                           </span>
                        <?php } ?>   
                  </div>
               </div>
            </div>
            <div class="form-group">
               <label for="counter_name" class="col-sm-3 control-label"><?= $this->lang->line("turnstile name")?> <span style="color:red">*</span></label>
               <div class="col-sm-8">
                  <input clear_a_element type="text" class="form-control" name="counter_name" id="counter_name" placeholder="<?= $this->lang->line("turnstile name")?>" data-parsley-required="true" data-parsley-error-message="This field required!">
               </div>
            </div>
            <div class="form-group">
               <label for="description_counter" class="col-sm-3 control-label"><?= $this->lang->line("description")?></label>
               <div class="col-sm-8">
                  <textarea style="resize: none;" clear_a_element rows="5" class="form-control" name="description_counter" id="description_counter" placeholder="<?= $this->lang->line("description")?>"></textarea>
               </div>
            </div>
         </form>
      </div>
      <div class="modal-footer">
         <?php if ($this->green->gAction("C")){ ?>
           <button type="button" id="save" class="btn btn-primary save"><?= $this->lang->line("save")?></button>
           <button type="button" id="save_close" class="btn btn-primary save" data-close="true"><?= $this->lang->line("save close")?></button>
         <?php } ?>
        <button type="button" class="btn btn-warning close_counter" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="m_gate_save" class="modal">
  <div id="sub_m_gate_save" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close close_gate" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 id="title_gate" class="modal-title">Modal title</h5>
      </div>
      <div class="modal-body">
         <form id="f_save_" class="form-horizontal" enctype="multipart/form-data">
            <input clear_a_element type="hidden" name="gat_typeno" id="gat_typeno">
            <div class="form-group">
               <label for="par_typeno" class="col-sm-3 control-label"><?= $this->lang->line("park name") ?><span style="color:red"> *</span></label>
               <div class="col-sm-8">
                  <select clear_a_element class="form-control" name="par_typeno" id="par_typeno" data-parsley-required="true" data-parsley-error-message="This field required!"></select>
               </div>
            </div>
            <div class="form-group">
               <label for="gat_name" class="col-sm-3 control-label"><?= $this->lang->line("gate name")?><span style="color:red"> *</span></label>
               <div class="col-sm-8">
                  <input clear_a_element type="text" class="form-control" name="gat_name" id="gat_name" placeholder="<?= $this->lang->line("gate name")?>" data-parsley-required="true" data-parsley-error-message="This field required!"></textarea>
               </div>
            </div>
            <div class="form-group">
               <label for="description_gate" class="col-sm-3 control-label"><?= $this->lang->line("description")?></label>
               <div class="col-sm-8">
                  <textarea clear_a_element rows="5" class="form-control" name="description_gate" id="description_gate" placeholder="<?= $this->lang->line("description")?>"></textarea>
               </div>
            </div>                                
         </form>
      </div>
      <div class="modal-footer">
         <?php if ($this->green->gAction("C")){ ?>   
            <button type="button" id="save" class="btn btn-primary save_gate"><?= $this->lang->line("save")?></button>
            <button type="button" id="save_close" class="btn btn-primary save_gate" data-close_gate="true"><?= $this->lang->line("save close")?></button>
         <?php } ?>
         <button type="button" class="btn btn-warning close_gate" data-dismiss="modal">Close</button>
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
            <th style="text-align: center;vertical-align: middle;"><?= $this->lang->line("turnstile name")?></th>            
            <th style="text-align: center;vertical-align: middle;"><?= $this->lang->line("description")?></th>
            <th style="text-align: center;vertical-align: middle;"><?= $this->lang->line("gate name")?></th>
         </tr>
      </thead>
      <tbody>      

      </tbody>
      <tfoot>
         
      </tfoot>
   </table>
</div>

<style type="text/css">
   .counter_name > a, .description > a, .gat_name > a{text-decoration: none;display: block;} 
   a#add_new{display: block;}
   #grid.edit, #grid.del{display: block;}
	th{vertical-align: middle;margin: 0;padding: 0;}
	td{vertical-align: middle;margin: 0;padding: 0;}
</style>

<script type="text/javascript"> 
	$(function(){     

      // close & destroy park parsley =====
      $('.close_gate').on('click', function(){
         $('form#f_save_').parsley().destroy();
         $('#myModal').modal({backdrop: 'static'})
      });

      // destroy gate =====
      $('.close_counter').on('click', function(){
         $('form#f_save').parsley().destroy();
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

      // focusin ======
      $('#search_counter_name').on('focus', function(){         
         $(this).select();
      });  
      $('#search_description').on('focus', function(){         
         $(this).select();
      });  
      $('#search_gat_name').on('focus', function(){         
         $(this).select();
      });  

      // save =======      
      $('.save').on('click', function(){
         var close = $(this);
         if($('#f_save').parsley().validate()){
            $.ajax({
               url: "<?= site_url('setup/ccounter/save') ?>",
               type: "POST",
               dataType: "JSON",
               beforeSend: function(){
                  $('#loading_header').show();
               },
               // async: false,
               data: {
                  cou_typeno: $('#cou_typeno').val(),
                  gate: $('#gate').val(),
                  counter_name: $('#counter_name').val(),
                  description: $('#description_counter').val(),                                                   
               },
               success: function(data){         
                  if(data.success == 'true'){
                     clear_a_element();                                                                                                                                                                                                      $('#set_sort').attr('data-order');
                     
                     grid(1, $('#total_display').val() - 0, $('#set_sort').attr('data-fd'), $('#set_sort').attr('data-order'));                                     
                     
                     if(close.attr('data-close') == 'true'){
                        $('#myModal').modal('hide')                                              
                     }

                     $('#success').show();
                     setTimeout(function(){                     
                        $('#success').hide();
                     }, 1000);
                     
                  }else{
                     alert('Duplicate' + ' ' + "'" + $('#counter_name').val() + "'" + '!')
                     $('#counter_name').select();
                  }
                  $('#loading_header').hide();
               },
               error: function(err){

               }
            });
         }
      });

      // save gate =======
      $('.save_gate').on('click', function(e){
         var close_gate = $(this);
         if($('#f_save_').parsley().validate()){          
            $.ajax({
               url: "<?= site_url('setup/cgate/save') ?>",
               type: "POST",
               dataType: "JSON",
               beforeSend: function(){
                  $('#loading_header').show();
               },
               // async: false,
               data: {
                  gat_typeno: $('#gat_typeno').val(),
                  par_typeno: $('#par_typeno').val(),                  
                  gat_name: $('#gat_name').val(),
                  description: $('#description_gate').val()                                
               },
               success: function(data){
                  var arr = data.arr;             
                  if(arr.success == 'true'){    
                     // add option ======
                     $('select#gate').prepend('<option selected="selected" value="'+ data.gat_typeno +'">'+ $('#gat_name').val() +'</option>');
                     
                     clear_gate();
                     
                     if(close_gate.attr('data-close_gate') == 'true'){
                        $('#m_gate_save').modal('hide')
                        $('#myModal').modal({backdrop: 'static'})
                     }

                     $('#success').show();
                     setTimeout(function(){                     
                        $('#success').hide();
                     }, 1000);
                  }else{
                     alert('Duplicate' + ' ' + "'" + $('#gat_name').val() + "'" + '!')
                     $('#gat_name').select();
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
         var cou_typeno = $(this).parent().parent().find(this).data('id');
         $.ajax({
            url: "<?= site_url('setup/ccounter/edit') ?>",
            type: "POST",
            dataType: "JSON",
            beforeSend: function(){
               $('#loading_header').show();
            },
            // async: false,
            data: {
               cou_typeno: cou_typeno
            },
            success: function(data){  
               $('#cou_typeno').val(data.cou_typeno);
               $('#counter_name').val(data.counter_name);               
               $('#description_counter').val(data.description);

               var gat_typeno = data.gat_typeno;
               // get gate =====
               $.ajax({
                  url: "<?= site_url('setup/ccounter/get_gate') ?>",
                  type: "POST",
                  dataType: "JSON",
                  beforeSend: function () {

                  },
                  // async: false,
                  data: {

                  },
                  success: function (data) {
                     var opt = '';
                     if (data.length > 0) {
                       $.each(data, function (i, row) {
                           if(gat_typeno == row.gat_typeno){
                              opt += '<option selected="selected" value="' + row.gat_typeno + '">' + row.gat_name + '</option>';
                           }else{
                              opt += '<option value="' + row.gat_typeno + '">' + row.gat_name + '</option>';
                           }
                        });
                     }
                     $('#gate').html(opt);

                     $('#loading_header').hide();

                     $('#myModal').modal({backdrop: 'static'})
                     $("#sub_myModal").draggable({
                        handle: ".modal-header"
                     });
                  },
                  error: function (err) {

                  }
               });               
               
               $('#title').text('Edit - Turnstiles');
               $('#myModal').modal({backdrop: 'static'})
               $("#sub_myModal").draggable({
                  handle: ".modal-header"
               });
               $('#loading_header').hide();
            },
            error: function(err){

            }
         });
      });

      // delete ======
      $('body').delegate('.del', 'click', function(){
         var cou_typeno = $(this).parent().parent().find(this).data('id');
         if(confirm('Are you sure to delete?')){
            $.ajax({
               url: "<?= site_url('setup/ccounter/delete') ?>",
               type: "POST",
               dataType: "JSON",
               beforeSend: function(){
                  $('#loading_header').show();
               },
               // async: false,
               data: {
                  cou_typeno: cou_typeno
               },
               success: function(data){
                  if(data.success == 'true'){
                     // if(confirm('Are you sure to delete?')){
                        // clear_search();
                        grid(1, $('#total_display').val() - 0, $('#set_sort').attr('data-fd'), $('#set_sort').attr('data-order')); 
                        $('#loading_header').hide();
                        $('#success').show();                
                        setTimeout(function(){
                            $('#success').hide();
                        }, 1000);
                     // }
                  }else{
                     // alert('Data in process! Cannot delete.');
                     bootbox.alert("Data in process! Can't delete.", function() {
                        // Example.show("Hello world callback");
                     });
                  }
                  $('#loading_header').hide();   

               },
               error: function(err){

               }
            });
         }
      });

      // add new ======
      $('#add_new').on('click', function(){ 
         clear_a_element();            
         $('#title').text('Add New - Turnstiles'); 
         get_gate();               
      });

      // focusin ======
      $('#search_park_name').on('focus', function(){         
         $(this).select();
      });
      $('#search_gat_name').on('focus', function(){         
         $(this).select();
      });
      $('#search_description').on('focus', function(){         
         $(this).select();
      });

      // clear search ======
      $('#btn_clear').on('click', function(){         
         $('#search_counter_name').val('');
         $('#search_description').val(''); 
         $('#search_gat_name').val('');                
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
      $('.counter_name').attr('data-order', 'DESC');
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
         $('#search_counter_name').val('');
         $('#search_gat_name').val('');
         $('#search_description').val('');
         var fd = $('#set_sort').attr('data-fd');
         var order = $('#set_sort').attr('data-order');
         grid(1, $('#total_display').val() - 0, fd, order);
      });

      // export ======
      $("body").delegate("a#export","click",function(){
         $('#tbl_data').find('caption').html('<center><b>Turnstiles List</b></center>');
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
         gsPrint(arr_pr[0], arr_pr[1]);
      });

      // add gate ======
      $('#add_gate').on('click', function(){  
         clear_gate();       
         $('#title_gate').text('Add New - Entrances');
         get_park();         
      });

   }); // ready ======   

   // clear gate ======
   function clear_gate() {
      $('#gat_typeno').val('');
      $('#par_typeno').val('');  
      $('#gat_name').val(''); 
      $('#description_gate').val('');       
   }

   // get gate ======
   function get_gate() {
      $.ajax({
         url: "<?= site_url('setup/ccounter/get_gate') ?>",
         type: "POST",
         dataType: "JSON",
         beforeSend: function () {
            $('#loading_header').show();
         },
         // async: false,
         data: {

         },
         success: function (data) {
            var opt = "";
            if (data.length > 0) {
              // opt += "<option></option>";
              $.each(data, function (i, row) {
                  opt += "<option value='" + row.gat_typeno + "'>" + row.gat_name + "</option>";
              });
            }
            $('#gate').html(opt);

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

   // get parks ======
   function get_park() {
      $.ajax({
         url: "<?= site_url('setup/ccounter/get_park') ?>",
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
              // opt += '<option></option>';
              $.each(data, function (i, row) {
                  opt += '<option value="' + row.par_typeno + '">' + row.park_name + '</option>';
              });
            }
            $('#par_typeno').html(opt);

            $('#loading_header').hide();

            $('#myModal').modal('hide')
            $('#m_gate_save').modal({backdrop: 'static'})
            $('#sub_m_gate_save').draggable({
               handle: ".modal-header"
            }); 
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
      var title = "<center style='font-weight:bold; font-size:16px;'>Turnstiles List</center>";
      //var s_adr   = "Title</div>";
      //    title+=s_adr;
      //title +="<h4 align='center'>Invoice</h4>"; 
      var data = $("#dv-print").html().replace('', '');//.html().replace(/<img[^>]*>/gi,"");
      var export_data = $("<center>" + data + "</center>").clone().find(".remove_tag").remove().end().html();
      //export_data+=htmlToPrint;
      return title + "####" + export_data;
      }

   // clear ======
   function clear_search(){
      $('#search_park_name').val('');
      $('#search_gat_name').val('');
      $('#search_description').val('');
   }

	// show data ======
	function grid(current_page, total_display, fd, order){
      offset = ((current_page - 1) * total_display) - 0;
      limit = total_display - 0;
		$.ajax({
			url: "<?= site_url('setup/ccounter/grid') ?>",
			type: "POST",
			dataType: "JSON",
			beforeSend: function(){
            $('#loading_header').show();
			},
			// async: false,
			data: {
            search_counter_name: $('#search_counter_name').val(),            
            search_description: $('#search_description').val(), 
            search_gat_name: $('#search_gat_name').val(),
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
									"<td>"+ (row.counter_name != null ? row.counter_name : '') +"</td>"+
									"<td>"+ (row.description != null ? row.description : '') +"</td>"+
                           "<td>"+ (row.gat_name != null ? row.gat_name : '') +"</td>"+
                           "<td class='remove_tag' style='text-align: center;'>";
                  // condition ======      
                  if("<?php echo $this->green->gAction('U') ?>"){
                     tr += "<a href='javascript: void(0)' class='edit' data-id='"+ row.cou_typeno +"'><img width='15px' height='15px' src='<?= base_url("assets/images/icons/edit.png") ?>'></a>";
                  }  
                  tr += "</td>";
                  tr += "<td class='remove_tag' style='text-align: center;'>";
                  if("<?php echo $this->green->gAction('D') ?>"){ 
                     tr += "<a href='javascript: void(0)' class='del' data-id='"+ row.cou_typeno +"'><img width='15px' height='15px' src='<?= base_url("assets/images/icons/delete.png") ?>'></a>";
                  }
                  // ================
                  tr +=  "</td>";
                  tr += "</tr>";
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
                           "<td colspan='6' style='font-size: 14px;text-align: center;font-weight: bold;'>No Results</td>"+
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