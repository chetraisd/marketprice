<div class="container-fluid">
   <div class="row">
      <div class="col-xs-12">         
         <div class="result_info">            
            <div class="col-xs-4" style="font-weight: bold;"><?= $this->lang->line("gates")?></div>
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
               <div class="col-sm-3">
                  <input type="text" class="form-control" name="search_gat_name" id="search_gat_name" placeholder="<?= $this->lang->line("gate name")?>">
               </div>
               <div class="col-sm-3">
                  <input type="text" class="form-control" name="search_description" id="search_description" placeholder="<?= $this->lang->line("description")?>">
               </div>
               <div class="col-sm-3">
                  <input type="text" class="form-control" name="search_park_name" id="search_park_name" placeholder="<?= $this->lang->line("park name")?>">
               </div>
               <div class="col-sm-3">
                  <button type="button" class="btn btn-primary" name="btn_search" id="btn_search"><?= $this->lang->line("search")?></button>
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
            <table id="grid" class="table table-condensed table-hover table-striped" cellspacing="0" cellpadding="0" border="0">
               <thead>            
                  <tr>
                     <th width="5%">#<input type="hidden" id="set_sort" data-fd="gat_name" data-order="ASC"></th>
                     <th width="20%" class="manage-column gat_name" data-fd="gat_name" data-order="ASC">
                        <a href="javascript: void(0)">                        
                           <span><?= $this->lang->line("gate name") ?></span>
                           <span class="glyphicon glyphicon-menu-up" style="font-size: 9px;"></span>
                        </a>                     
                     </th>
                     <th width="30%" class="manage-column description" data-fd="description" data-order="ASC">
                        <a href="javascript: void(0)">
                           <span><?= $this->lang->line("description") ?></span>
                           <span style="font-size: 9px;"></span>
                        </a>                     
                     </th>
                     <th width="30%" class="manage-column park_name" data-fd="park_name" data-order="ASC">
                        <a href="javascript: void(0)">
                           <span><?= $this->lang->line("park name") ?></span>
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
         <form id="f_save" class="form-horizontal">
            <input clear_a_element type="hidden" name="gat_typeno" id="gat_typeno">
            <div class="form-group">
               <label for="par_typeno_gat" class="col-sm-3 control-label"><?= $this->lang->line("park name") ?><span style="color:red"> *</span></label>
               <div class="col-sm-8">
                  <!-- <div class="input-group"> -->
                     <select class="form-control" name="par_typeno_gat" id="par_typeno_gat" multiple="multiple" size="8" data-parsley-required="true" data-parsley-error-message="This field required !"></select>
                        <?php if ($this->green->gAction("C")){ ?>
                           <!-- <span class="input-group-btn">
                             <button id="add_park" class="btn btn-primary" type="button">
                                <span class="glyphicon glyphicon-plus"></span>
                             </button>
                           </span> -->
                        <?php } ?>
                  <!-- </div> -->
               </div>
            </div>
            <div class="form-group">
               <label for="gat_name" class="col-sm-3 control-label"><?= $this->lang->line("gate name")?><span style="color:red"> *</span></label>
               <div class="col-sm-8">
                  <input clear_a_element type="text" class="form-control" name="gat_name" id="gat_name" placeholder="<?= $this->lang->line("gate name")?>" id="par_typeno_gat" data-parsley-required="true" data-parsley-error-message="This field required !"></textarea>
               </div>
            </div>
            <div class="form-group">
               <label for="description_gate" class="col-sm-3 control-label"><?= $this->lang->line("description")?></label>
               <div class="col-sm-8">
                  <textarea style="resize: none;" clear_a_element rows="5" class="form-control" name="description_gate" id="description_gate" placeholder="<?= $this->lang->line("description")?>"></textarea>
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

<div id="m_park_save" class="modal">
   <div id="sub_m_park_save" class="modal-dialog">
     <div class="modal-content">
         <div class="modal-header">
             <button type="button" id="close_park_top" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             <h5 id="title_park" class="modal-title">Modal title</h5>
         </div>
         <div class="modal-body">
            <form id="f_save_" enctype="multipart/form-data">
               <input type="hidden" name="par_typeno" id="par_typeno">               
               <div class="row">
                  <label style="text-align: right;" for="location" class="col-sm-3 control-label"><?= $this->lang->line("location") ?><span style="color:red"> *</span></label>
                  <div class="col-sm-8">
                     <select class="form-control" name="location" id="location" data-parsley-required="true" data-parsley-error-message="This field required !"></select>
                  </div>
               </div>
               <div class="row" style="margin-top: 8px;">
                  <label style="text-align: right;" for="park_name" class="col-sm-3 control-label"><?= $this->lang->line("park name") ?><span style="color:red"> *</span></label>
                  <div class="col-sm-8">
                      <input type="text" class="form-control required_validate" name="park_name" id="park_name" placeholder="<?= $this->lang->line("park name") ?>" data-parsley-required="true" data-parsley-error-message="This field required !">
                  </div>
               </div>                                 
               <div class="row" style="margin-top: 8px;">
                  <label style="text-align: right;" for="description" class="col-sm-3 control-label"><?= $this->lang->line("description") ?></label>
                  <div class="col-sm-8">
                      <textarea rows="3" class="form-control" name="description" id="description" placeholder="<?= $this->lang->line("description") ?>"></textarea>
                  </div>
               </div>
            </form>
            <div class="row" style="margin-top: 8px;">
               <label style="text-align: right;" for="img_park" class="col-sm-3 control-label"><?= $this->lang->line("image") ?></label>
               <div class="col-sm-3">                   
                  <form id="frm_photo" target="ifram" method="POST" action="<?= site_url('setup/cpark/park_upload') ?>" enctype="multipart/form-data">
                     <input style="width: 0;height: 0;" type="file" name="photo" id="photo" accept="image/*">
                     <input type="hidden" name="image_insert" id="image_insert">
                     <input type="hidden" name="image_edit" id="image_edit">
                     <div id="dv_img" class="dv_img" onclick="$('#photo').click()">
                       <img width="180" height="150" id="img_park" class="img-rounded" style="border: 1px solid #CCC;">
                     </div>
                  </form>
                  <iframe id="ifram" name="ifram" style="display: none;"></iframe>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-3">&nbsp;</div>
               <div class="col-sm-2">
                  <button type="button" id="browser" onclick="$('#photo').click()" class="btn btn-primary btn-sm" style="margin: 3px;">Browse...</button>
               </div>
               <label style="text-align: left;padding-top: 10px;" class="col-sm-7 control-label">(File extension PNG/JPG/JPEG, Size <= 2MB)</label>
            </div>
         </div>
         <div class="modal-footer">
            <?php if ($this->green->gAction("C")){ ?>
               <button type="button" id="save_park" class="btn btn-primary save_park"><?= $this->lang->line('save')?></button>
               <button type="button" id="save_park_close" class="btn btn-primary save_park" data-close="true"><?= $this->lang->line('save close')?></button>
            <?php } ?>
            <button type="button" id="close_park" class="btn btn-warning" data-dismiss="modal">Close</button>
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
            <th style="text-align: center;vertical-align: middle;"><?= $this->lang->line('gate name')?></th>
            <th style="text-align: center;vertical-align: middle;"><?= $this->lang->line('description')?></th>
            <th style="text-align: center;vertical-align: middle;"><?= $this->lang->line('park name')?></th>
         </tr>
      </thead>
      <tbody>      

      </tbody>
      <tfoot>
         
      </tfoot>
   </table>
</div>

<style type="text/css">
   .gat_name > a, .description > a, .park_name > a{text-decoration: none;display: block;} 
   a#add_new{display: block;}
   #grid.edit, #grid.del{display: block;}
	th{vertical-align: middle;margin: 0;padding: 0;}
	td{vertical-align: middle;margin: 0;padding: 0;}
   #dv_img{cursor: pointer;}

   #par_typeno_gat:opt_new{cursor: pointer;}
</style>

<script type="text/javascript">
	$(function(){ 

      // close park =====
      $('#close_park_top, #close_park').on('click', function(){
         $('form#f_save_').parsley().destroy();
         $('#myModal').modal({backdrop: 'static'})
      });

      // destroy gate =====
      $('#close_top, #close_bottom').on('click', function(){
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
      $('#search_park_name').on('focus', function(){         
         $(this).select();
      });
      $('#search_gat_name').on('focus', function(){         
         $(this).select();
      });
      $('#search_description').on('focus', function(){         
         $(this).select();
      });    

      // save =======      
      $('.save').on('click', function(){
         var close = $(this);
         var arr_p = [];
         $('#par_typeno_gat option:selected').each(function(i, selected){
            if($(selected).length > 0){
               arr_p[i] = {'par_typeno' : $(selected).val()};
            }
         });

         if($('#f_save').parsley().validate()){
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
                  par_typeno: arr_p,
                  gat_name: $('#gat_name').val(),
                  description: $('#description_gate').val(),                                                   
               },
               success: function(data){
                  if(data.arr.success == 'true'){
                     clear_a_element();                                                                                                                                                                                                      $('#set_sort').attr('data-order');
                     grid(1, $('#total_display').val() - 0, $('#set_sort').attr('data-fd'), $('#set_sort').attr('data-order'));                                     
                     $('#success').show();
                     setTimeout(function(){                     
                        $('#success').hide();
                     }, 1000);
                     if(close.attr('data-close') == 'true'){
                        $('#myModal').modal('hide')                                              
                     }
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

      // save park =======
      $('.save_park').on('click', function(e){
         var save_close = $(this);
         var park_name = $('#park_name').val();
         if($('#f_save_').parsley().validate()){           
            $.ajax({
               url: "<?= site_url('setup/cpark/save') ?>",
               type: "POST",
               dataType: "JSON",
               beforeSend: function(){
                  $('#loading_header').show();
               },
               // async: false,
               data: {
                  par_typeno: $('#par_typeno').val(),
                  location: $('#location').val(),
                  park_name: $('#park_name').val(),
                  description: $('#description').val()                                 
               },
               success: function(data){           
                  if(data.arr.success == 'true'){
                     // image ======= 
                     $('#image_insert').val(data.par_typeno);                 
                     reload_img();
                     // add option ======
                     $('select#par_typeno_gat').prepend('<option selected="selected" value="'+ data.par_typeno +'">'+ $('#park_name').val() +'</option>');
                     
                     clear_park();

                     if(save_close.attr('data-close') == 'true'){
                        $('#m_park_save').modal('hide')
                        $('#myModal').modal({backdrop: 'static'})     
                     }                     

                     $('#success').show();
                     setTimeout(function(){                  
                        $('#success').hide();
                     }, 1000);
                  }else{
                     alert('Duplicate' + ' ' + "'" + $('#park_name').val() + "'" + '!')
                     $('#park_name').select();
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
			var gat_typeno = $(this).parent().parent().find(this).data('id');
			$.ajax({
   			url: "<?= site_url('setup/cgate/edit') ?>",
   			type: "POST",
   			dataType: "JSON",
   			beforeSend: function(){
               $('#loading_header').show();
   			},
   			// async: false,
   			data: {
   				gat_typeno: gat_typeno
   			},
   			success: function(data){
               var row = data.row
               var p = data.p

               var par_typeno = data.par_typeno;
               $('#gat_typeno').val(row.gat_typeno);
               $('#par_typeno_gat').val(row.par_typeno);
               $('#gat_name').val(row.gat_name);
               $('#description_gate').val(row.description);

               // get parks =====
               $.ajax({
                  url: "<?= site_url('setup/cgate/get_park') ?>",
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
                           opt += '<option value="' + row.par_typeno + '">' + row.park_name + '</option>';
                        });
                     }
                     $('#par_typeno_gat').html(opt);

                     // park ========
                     if (p.length > 0) {
                        $.each(p, function (i, selected) {
                           $("#par_typeno_gat option[value='" + selected.par_typeno + "']").prop("selected", true);
                        });
                     }                     

                     $('#loading_header').hide();

                     $('#title').text('Edit - Entrances');
                     $('#myModal').modal({backdrop: 'static'})
                     $("#sub_myModal").draggable({
                        handle: ".modal-header"
                     });
                  },
                  error: function (err) {

                  }
               });

   			},
   			error: function(err){

   			}
   		});
		});

      // delete ======
      $('body').delegate('.del', 'click', function(){
         var gat_typeno = $(this).parent().parent().find(this).data('id');
         var par_gat_typeno = $(this).parent().parent().find(this).data('id_pg');
         
         if(confirm('Are you sure to delete?')){
            $.ajax({
               url: "<?= site_url('setup/cgate/delete') ?>",
               type: "POST",
               dataType: "JSON",
               beforeSend: function(){
                  $('#loading_header').show();
               },
               // async: false,
               data: {
                  gat_typeno: gat_typeno,
                  par_gat_typeno: par_gat_typeno
               },
               success: function(data){
                  if(data.success == 'true'){
                     // if(confirm('Are you sure to delete?')){
                        clear_search();
                        grid(1, $('#total_display').val() - 0, $('#set_sort').attr('data-fd'), $('#set_sort').attr('data-order')); 
                        $('#loading_header').hide();
                        $('#success').show();                
                        setTimeout(function(){
                           $('#success').hide();                        
                        }, 1000);
                     // }
                  }else{
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
         get_park(); 
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
      $('.gat_name').attr('data-order', 'DESC');
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
         $('#tbl_data').find('caption').html('<center><b>Entrances List</b></center>');
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

      // change photo ========
      $('#photo').on('change', function () {
         if(this.files[0].size - 0 < 2048000){
            var ext = this.value.match(/\.(.+)$/)[1];
            switch (ext) {
               case 'jpg':
               case 'jpeg':
               case 'png':
                  readURL(this);              
                  break;
               default:
                  alert('Your extensions can only PNG/JPG/JPEG! Please choose another file');
                  this.value = '';
            }         
         }else{
            alert('Your file size more than 2BM!');
            this.value = '';
         }
      });

      // photo ========
      function reload_img() {
         $("#frm_photo").submit();
      }

      $('#add_park').on('click', function(){   
         clear_park();
         $('#title_park').text('Add New - Parks');         
         get_location();          
      });

	}); // ready ======   

   // replace photo ======
   function readURL(input) {
     if (input.files && input.files[0]) {
         var reader = new FileReader();
         reader.onload = function (e) {
             $('#img_park').attr('src', e.target.result);
         };
         reader.readAsDataURL(input.files[0]);
     }
   }

   // clear search ======
   function clear_search() {
      $('#search_gat_name').val('');
      $('#search_description').val('');
      $('#search_park_name').val('');    
   }

   // clear park ======
   function clear_park() {
      $('#par_typeno').val('');
      $('#location').val('');
      $('#park_name').val('');    
      $('#description').val('');
      $('#photo').val('');
      $('#img_park').attr({src: '<?= base_url("assets/upload/images.png") ?>'});
   }   
   
   // get parks ======
   function get_park() {
      $.ajax({
         url: "<?= site_url('setup/cgate/get_park') ?>",
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
            $('#par_typeno_gat').html(opt);
            $("#par_typeno_gat").prop("selectedIndex", 0);

            $('#loading_header').hide();

            $('#title').text('Add New - Entrances');                 
            $('#myModal').modal({backdrop: 'static'})
            $("#sub_myModal").draggable({
               handle: ".modal-header"
            });
         },
         error: function (err) {

         }
     });
   }

   // get locations ======
   function get_location() {
      $.ajax({
         url: "<?= site_url('setup/cpark/get_location') ?>",
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
                  opt += '<option value="' + row.loc_typeno + '">' + row.loc_name + '</option>';
              });
            }
            $('#location').html(opt);
            
            $('#loading_header').hide();

            $('#m_park_save').modal({backdrop: 'static'})
            $('#myModal').modal('hide')
            $('#sub_m_park_save').draggable({
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
     var title = "<center style='font-weight:bold; font-size:16px;'>Entrances List</center>";
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
      $('#search_description').val('');
	}

	// show data ======
	function grid(current_page, total_display, fd, order){
      offset = ((current_page - 1) * total_display) - 0;
      limit = total_display - 0;
		$.ajax({
			url: "<?= site_url('setup/cgate/grid') ?>",
			type: "POST",
			dataType: "JSON",
			beforeSend: function(){
            $('#loading_header').show();
			},
			// async: false,
			data: {
            search_gat_name: $('#search_gat_name').val(),
            search_description: $('#search_description').val(),
            search_park_name: $('#search_park_name').val(),                         
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
									"<td>"+ (row.gat_name != null ? row.gat_name : '') +"</td>"+
									"<td>"+ (row.description != null ? row.description : '') +"</td>"+
                           "<td>"+ (row.park_name != null ? row.park_name : '') +"</td>"+
                           "<td class='remove_tag' style='text-align: center;'>";
                  // condition ======      
                  if("<?php echo $this->green->gAction('U') ?>"){
                     tr += "<a href='javascript: void(0)' class='edit' data-id='"+ row.gat_typeno +"'><img width='15px' height='15px' src='<?= base_url("assets/images/icons/edit.png") ?>'></a>";
						}	
                  tr += "</td>";
                  tr += "<td class='remove_tag' style='text-align: center;'>";
                  if("<?php echo $this->green->gAction('D') ?>"){	
                     tr += "<a href='javascript: void(0)' class='del' data-id='"+ row.gat_typeno +"' data-id_pg='"+ row.par_gat_typeno +"'><img width='15px' height='15px' src='<?= base_url("assets/images/icons/delete.png") ?>'></a>";
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