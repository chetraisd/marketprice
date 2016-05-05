<!-- table -->
<div class="container-fluid">
   <div class="row">
      <div class="col-xs-12">         
         <div class="result_info">            
            <div class="col-xs-4" style="font-weight: bold;"><?= $this->lang->line("parks")?></div>
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
                  <input type="text" class="form-control" name="search_park_name" id="search_park_name" placeholder="<?= $this->lang->line("park name")?>">
               </div>
               <div class="col-sm-2">
                  <input type="text" class="form-control" name="search_description" id="search_description" placeholder="<?= $this->lang->line("description")?>">
               </div>
               <div class="col-sm-2">
                  <input type="text" class="form-control" name="search_location" id="search_location" placeholder="<?= $this->lang->line("location name")?>">
               </div>
               <div class="col-sm-2" style="padding-top: 6px;">
                  <input type="checkbox" name="search_is_active" id="search_is_active" value="1" checked>
                  <label for="search_is_active"><?= $this->lang->line("is_active")?></label>
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
            <table id="grid" class="table table-condensed table-hover table-striped" cellspacing="0" cellpadding="0" border="0">
               <thead>            
                  <tr>
                     <th width="5%">#<input type="hidden" id="set_sort" data-fd="park_name" data-order="ASC"></th>
                     <th width="20%" class="manage-column park_name" data-fd="park_name" data-order="ASC">
                        <a href="javascript: void(0)">                        
                           <span><?= $this->lang->line("park name") ?></span>
                           <span class="glyphicon glyphicon-menu-up" style="font-size: 9px;"></span>
                        </a>                     
                     </th>
                     <th width="30%" class="manage-column description" data-fd="description" data-order="ASC">
                        <a href="javascript: void(0)">
                           <span><?= $this->lang->line("description") ?></span>
                           <span style="font-size: 9px;"></span>
                        </a>                     
                     </th>
                     <th width="20%" class="manage-column loc_name" data-fd="loc_name" data-order="ASC">
                        <a href="javascript: void(0)">
                           <span><?= $this->lang->line("location name") ?></span>
                           <span style="font-size: 9px;"></span>
                        </a>                     
                     </th>
                     <th width="20%" class="manage-column prefix" data-fd="prefix" data-order="ASC">
                        <a href="javascript: void(0)">
                           <span>Series</span>
                           <span style="font-size: 9px;"></span>
                        </a>                     
                     </th>
                     <th width="20%" class="manage-column tick_form" data-fd="tick_form" data-order="ASC">
                        <a href="javascript: void(0)">
                           <span><?= $this->lang->line("Form") ?></span>
                           <span style="font-size: 9px;"></span>
                        </a>                     
                     </th>
                     <th width="5%">
                        <span><?= $this->lang->line("image") ?></span>
                        <span style="font-size: 9px;"></span>                    
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

<div id="m_park_save" class="modal">
   <div id="sub_m_park_save" class="modal-dialog modal-lg">
     <div class="modal-content">
         <div class="modal-header">
             <button type="button" id="close_top" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             <h5 id="title" class="modal-title">Modal title</h5>
         </div>
         <div class="modal-body">
            <form id="f_save" enctype="multipart/form-data">
               <input clear_a_element type="hidden" name="par_typeno" id="par_typeno">               
               <div class="row">
                  <div class="col-sm-6">
                     <label style="padding:0px;" for="location" class="col-sm-3 control-label"><?= $this->lang->line("location") ?><span style="color:red"> *</span></label>
                     <div class="input-group" style="width: 100%;">
                        <select class="form-control" name="location" id="location" data-parsley-required="true" data-parsley-error-message="This field required !"></select>
                        <?php if ($this->green->gAction("C")){ ?>
                           <span class="input-group-btn">
                             <button id="add_location" class="btn btn-primary" type="button">
                                <span class="glyphicon glyphicon-plus"></span>
                             </button>
                           </span>
                        <?php } ?>
                     </div>
                  </div>
                  <div class="col-sm-6">
                     <label style="padding:0px;" for="park_name" class="control-label"><?= $this->lang->line("park name") ?><span style="color:red"> *</span></label>
                     <input clear_a_element type="text" class="form-control required_validate" name="park_name" id="park_name" placeholder="" data-parsley-required="true" data-parsley-error-message="This field required !">
                  </div>
               </div>
               <div class="row" style="margin-top: 10px;">
                  <div class="col-sm-6">
                     <div class="panel panel-default" style="margin-bottom: 0px;">
                        <div class="panel-heading">Series</div>
                        <div class="panel-body">
                           <div class="col-sm-6" style="padding: 0px 5px;">
                              <label style="padding:0px;" for="fore_adult_series" class="control-label">Foreigner adult series</label>
                              <input clear_a_element type="text" class="form-control" name="fore_adult_series" id="fore_adult_series" placeholder="">
                           </div>
                           <div class="col-sm-6" style="padding: 0px 5px;">
                              <label style="padding:0px;" for="fore_child_series" class="control-label">Foreigner child series</label>
                              <input clear_a_element type="text" class="form-control" name="fore_child_series" id="fore_child_series" placeholder="">
                           </div>
                           <div class="col-sm-6" style="padding: 0px 5px;">
                              <label style="padding:0px;" for="loc_adult_series" class="control-label">Local adult series</label>
                              <input clear_a_element type="text" class="form-control" name="loc_adult_series" id="loc_adult_series" placeholder="">
                           </div>
                           <div class="col-sm-6" style="padding: 0px 5px;">
                              <label style="padding:0px;" for="loc_child_series" class="control-label">Local child series</label>
                              <input clear_a_element type="text" class="form-control" name="loc_child_series" id="loc_child_series" placeholder="">
                           </div>
                                 
                        </div>
                     </div>   
                  </div>
                  <div class="col-sm-6">
                     <div class="panel panel-default" style="margin-bottom: 0px;">
                        <div class="panel-heading">Form</div>
                        <div class="panel-body">
                           <div class="col-sm-6" style="padding: 0px 5px;">
                              <label style="padding:0px;" for="fore_adult_form" class="control-label">Foreigner adult form</label>
                              <input clear_a_element type="text" class="form-control" name="fore_adult_form" id="fore_adult_form" placeholder="">
                           </div>
                           <div class="col-sm-6" style="padding: 0px 5px;">
                              <label style="padding:0px;" for="fore_child_form" class="control-label">Foreigner child form</label>
                              <input clear_a_element type="text" class="form-control" name="fore_child_form" id="fore_child_form" placeholder="">
                           </div>
                           <div class="col-sm-6" style="padding: 0px 5px;">
                              <label style="padding:0px;" for="loc_adult_form" class="control-label">Local adult form</label>
                              <input clear_a_element type="text" class="form-control" name="loc_adult_form" id="loc_adult_form" placeholder="">
                           </div>
                          
                           <div class="col-sm-6" style="padding: 0px 5px;">
                              <label style="padding:0px;" for="loc_child_form" class="control-label">Local child form</label>
                              <input clear_a_element type="text" class="form-control" name="loc_child_form" id="loc_child_form" placeholder="">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </form>            

            <div class="row" style="margin-top: 10px;">
               <div class="col-sm-6">
                  <div class="col-sm-12" style="padding:0px;" >
                     <label style="padding:0px;" for="description" class="col-sm-3 control-label"><?= $this->lang->line("description") ?></label>
                     <textarea style="resize: none;" clear_a_element rows="5" class="form-control" name="description" id="description" placeholder="<?= $this->lang->line("description") ?>"></textarea>
                  </div>
                  <div class="col-sm-12" style="padding:0px;" >
                     <input type="checkbox" name="is_active" id="is_active" checked="checked" value="1">
                     <label style="text-align: right;" for="is_active" class="control-label"><?= $this->lang->line("is_active") ?></label>
                  </div>
                  <div class="col-sm-12" style="padding:0px;" >
                     <input type="checkbox" name="notforsale" id="notforsale" value="0">
                     <label style="text-align: right;" for="notforsale" class="control-label">Not for sale</label>
                  </div>
               </div>
               <div class="col-sm-6">
                  <label style="padding:0px;" for="img_park" class="col-sm-2 control-label"><?= $this->lang->line("image") ?></label>                   
                  <div class="col-sm-12" style="padding:0px;">
                     <form id="f_photo" target="ifram" method="POST" action="<?= site_url('setup/cpark/park_upload') ?>" enctype="multipart/form-data">
                        <input clear_a_element style="width: 0;height: 0;" type="file" name="photo" id="photo" accept="image/*">
                        <input type="hidden" name="image_insert" id="image_insert">
                        <input type="hidden" name="image_edit" id="image_edit">
                        <div id="dv_img" class="dv_img col-sm-6" onclick="$('#photo').click()" style="padding:0px;">
                          <img width="180" height="150" id="img_park" class="img-rounded" style="border: 1px solid #CCC;">
                        </div>
                     </form>
                     <label style="text-align: left;padding: 10px 0px;" class="col-sm-6 control-label">(File extension PNG/JPG/JPEG, Size <= 2MB)</label>
                  </div>
                 
                  <iframe id="ifram" name="ifram" style="display: none;"></iframe>
                  <div class="row">
                     <div class="col-sm-4" >
                        <button type="button" id="browser" onclick="$('#photo').click()" class="btn btn-primary btn-sm" style="margin: 3px;">Browse...</button>
                     </div>
                     
                  </div> 
               </div>
            </div>
                      
            <div class="row" style="margin-top: 10px;">
               <div class="col-sm-3">&nbsp;</div>
               
            </div>
         </div>
         <div class="modal-footer">
            <?php if ($this->green->gAction("C")){?>
               <button type="button" id="save" class="btn btn-primary save_park"><?= $this->lang->line('save')?></button>
               <button type="button" id="save_close" class="btn btn-primary save_park" data-close="true"><?= $this->lang->line('save close')?></button>
            <?php } ?>
            <button type="button" id="close_bottom" class="btn btn-warning" data-dismiss="modal">Close</button>
         </div>
     </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- location -->
<div id="m_location_save" class="modal">
  <div id="sub_m_location_save" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" id="close_location_top" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 id="title_location" class="modal-title">Modal title</h5>
      </div>
      <div class="modal-body">
         <form id="f_save_" class="form-horizontal" enctype="multipart/form-data">
            <input type="hidden" name="loc_typeno" id="loc_typeno">
            <div class="form-group">
               <label for="loc_name" class="col-sm-3 control-label"><?= $this->lang->line("location name")?> <span style="color:red">*</span></label>
               <div class="col-sm-8">
                  <input type="text" class="form-control" name="loc_name" id="loc_name" placeholder="<?= $this->lang->line("location name")?>" data-parsley-required="true" data-parsley-error-message="This field required !">
               </div>
            </div>
            <div class="form-group">
               <label for="description_loc" class="col-sm-3 control-label"><?= $this->lang->line("description")?></label>
               <div class="col-sm-8">
                  <textarea style="resize: none;" rows="5" class="form-control" name="description_loc" id="description_loc" placeholder="<?= $this->lang->line("description")?>"></textarea>
               </div>
            </div>
            <div class="form-group">
               <label for="address" class="col-sm-3 control-label"><?= $this->lang->line("address")?></label>
               <div class="col-sm-8">
                  <textarea style="resize: none;" rows="3" class="form-control" name="address" id="address" placeholder="<?= $this->lang->line("address")?>"></textarea>
               </div>
            </div>                    
         </form>
      </div>
      <div class="modal-footer">
         <?php if ($this->green->gAction("C")){ ?>
           <button type="button" id="save_location" class="btn btn-primary save_location"><?= $this->lang->line("save")?></button>
           <button type="button" id="save_close_location" class="btn btn-primary save_location" data-close_locaton="true"><?= $this->lang->line("save close")?></button>
         <?php } ?>
        <button type="button" id="close_location" class="btn btn-warning" data-dismiss="modal">Close</button>
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
            <th style="text-align: center;vertical-align: middle;">Description</th>
            <th style="text-align: center;vertical-align: middle;">Location Name</th>
            <th style="text-align: center;vertical-align: middle;">Series</th>            
            <th style="text-align: center;vertical-align: middle;">Form</th>
            <th style="text-align: center;vertical-align: middle;">Image</th>
         </tr>
      </thead>
      <tbody>      

      </tbody>
      <tfoot>
         
      </tfoot>
   </table>
</div>

<style type="text/css">
   .park_name > a, .description > a, .loc_name > a{text-decoration: none;display: block;} 
   a#add_new{display: block;}
   #grid.edit, #grid.del{display: block;}
   th{vertical-align: middle;margin: 0;padding: 0;}
   td{vertical-align: middle;}
   #dv_img{cursor: pointer;}
</style>

<script type="text/javascript">
   $(function () {

      // export ======
      $("body").delegate("a#export","click",function(){
         $('#tbl_data').find('caption').html('<center><b>Parks List</b></center>');
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

      // close loc. & destroy parsley =====
      $('#close_location_top, #close_location').on('click', function(){
         $('form#f_save_').parsley().destroy();
         $('#m_park_save').modal('show')
      });

      $('#add_location').on('click', function(){
         clear_location();
         $('#title_location').text('Add New - Locations');  
         $('#m_park_save').modal('hide')
         $('#m_location_save').modal({backdrop: 'static'})
         $('#sub_m_location_save').draggable({
            handle: ".modal-header"
         });
      });

      // tooltip ====      
      $('#a_search').tooltip({title: 'show / hide Search'})
      $('#export').tooltip({title: 'Export'})
      $('#print').tooltip({title: 'Print'})

      $('#add_location').tooltip({title: 'New Location'})
      
      $('body').delegate('', 'mouseover', function(){
         $('#search_loc_name').tooltip({title: 'Search by Location Name'})
      });
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
      $('#search_description').on('focus', function(){         
         $(this).select();
      });
      $('#search_location').on('focus', function(){         
         $(this).select();
      });

      // destroy parsley =======      
      $('#close_top, #close_bottom').on('click', function(){  
         $('form#f_save').parsley().destroy();
      });
      $('body').delegate('#is_active,#search_is_active', 'click', function(){
         if($(this).prop("checked")==true){
            $(this).val(1);
         }else{
            $(this).val(0);
         }
      });
      $('body').delegate('#notforsale', 'click', function(){
         if($(this).prop("checked")==true){
            $(this).val(1);
         }else{
            $(this).val(0);
         }
      });
      // save =======
      $('.save_park').on('click', function(e){
         var save_close = $(this);
         if($('#f_save').parsley().validate()){
            $.ajax({
               url: "<?= site_url('setup/cpark/save') ?>",
               type: "POST",
               dataType: "JSON",
               beforeSend: function(){
                  $('#loading_header').show();
               },
               data: {
                  par_typeno: $('#par_typeno').val(),                  
                  location: $('#location').val(),
                  park_name: $('#park_name').val(),
                  description: $('#description').val(),
                  //prefix: $('#prefix').val(),                  
                  //tick_form: $('#tick_form').val(),
                  image_edit: $('#image_edit').val(),
                  is_active: $('#is_active').val(),
                  notforsale: $('#notforsale').val(),

                  fore_adult_series : $("#fore_adult_series").val(),
                  fore_child_series : $("#fore_child_series").val(),
                  loc_adult_series : $("#loc_adult_series").val(),
                  loc_child_series : $("#loc_child_series").val(),
                  fore_adult_form : $("#fore_adult_form").val(),
                  fore_child_form : $("#fore_child_form").val(),
                  loc_adult_form  : $("#loc_adult_form").val(),
                  loc_child_form  : $("#loc_child_form").val()

               },
               success: function(data){    
                  if(data.arr.success == 'true'){                    
                     // image =======
                     $('#image_insert').val(data.par_typeno);                 
                     reload_img();

                     clear_a_element();
                     // $('#is_active').val('0');
                     // if($('#is_active').val() == '0'){
                     //    $('#is_active').prop('checked', false);
                     // }else{
                     //    $('#is_active').prop('checked', true);
                     // }
                     
                     $('#img_park').attr({src: '<?= base_url("assets/upload/packages/images.png") ?>'});
                     
                     if(save_close.attr('data-close') == 'true'){
                        $('#m_park_save').modal('hide')                                              
                     }                     
                     
                     setTimeout(function(){
                        grid(1, $('#total_display').val() - 0, $('#set_sort').attr('data-fd'), $('#set_sort').attr('data-order'));                      
                     }, 1000);
                     $('#success').show();
                     setTimeout(function(){
                        $('#success').hide();
                     }, 1500);

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

      // save location =======      
      $('.save_location').on('click', function(){
         var save_location_close = $(this);
         if($('#f_save_').parsley().validate()){
            $.ajax({
               url: "<?= site_url('setup/clocation/save') ?>",
               type: "POST",
               dataType: "JSON",
               beforeSend: function(){
                  $('#loading_header').show();
               },
               data: {
                  loc_typeno: $('#loc_typeno').val(),
                  loc_name: $('#loc_name').val(),
                  description: $('#description_loc').val(),
                  address: $('#address').val()                                 
               },
               success: function(data){              
                  if(data.arr.success == 'true'){
                     // add option =====
                     $('select#location').prepend('<option selected="selected" value="'+ data.loc_typeno +'">'+ $('#loc_name').val() +'</option>');
                     clear_location();
                     if(save_location_close.attr('data-close_locaton') == 'true'){
                        $('#m_park_save').modal('show') 
                        $('#m_location_save').modal('hide')                                               
                     }     

                     $('#success').show();
                     setTimeout(function(){                     
                        $('#success').hide();
                     }, 1000);
                  }else{
                     alert('Duplicate' + ' ' + "'" + $('#loc_name').val() + "'" + '!')
                     $('#loc_name').select();
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
         var par_typeno = $(this).parent().parent().find(this).data('id');
         $.ajax({
            url: "<?= site_url('setup/cpark/edit') ?>",
            type: "POST",
            dataType: "JSON",
            beforeSend: function(){
               $('#loading_header').show();
            },
            // async: false,
            data: {
               par_typeno: par_typeno
            },
            success: function(data){
               var loc_typeno = data.loc_typeno;
               $('#par_typeno').val(data.par_typeno);
               $('#park_name').val(data.park_name);
               $('#description').val(data.description);
               $('#image_edit').val(data.image);
               $('#is_active').val(data.is_active-0);
               $('#notforsale').val(data.notforsale-0);
               //$('#prefix').val(data.prefix);
               //$('#tick_form').val(data.tick_form);

               $('#fore_adult_series').val(data.fore_adult_series);
               $('#fore_child_series').val(data.fore_child_series);
               $('#loc_adult_series').val(data.loc_adult_series);
               $('#loc_child_series').val(data.loc_child_series);
               $('#fore_adult_form').val(data.fore_adult_form);
               $('#fore_child_form').val(data.fore_child_form);
               $('#loc_adult_form').val(data.loc_adult_form);
               $('#loc_child_form').val(data.loc_child_form);

               if(data.is_active==1){
                  $('#is_active').prop("checked",true);
               }else{
                  $('#is_active').prop("checked",false);
               }
               if(data.notforsale==1){
                  $('#notforsale').prop("checked",true);
               }else{
                  $('#notforsale').prop("checked",false);
               }
               $('#img_park').attr({src: '<?= base_url("assets/upload/packages/'+ (data.image != '' ? data.image : 'images.png') + '?' + new Date().getTime() +'") ?>'});

               // get locations =====
               $.ajax({
                  url: "<?= site_url('setup/cpark/get_location') ?>",
                  type: "POST",
                  dataType: "JSON",
                  beforeSend: function () {
                     
                  },
                  data: {
                   
                  },
                  success: function (data) {
                     var opt = '';
                     if (data.length > 0) {
                       $.each(data, function (i, row) {
                           if(loc_typeno == row.loc_typeno){
                              opt += '<option selected="selected" value="' + row.loc_typeno + '">' + row.loc_name + '</option>';
                           }else{
                             opt += '<option value="' + row.loc_typeno + '">' + row.loc_name + '</option>';
                           }
                        });
                     }
                     $('#location').html(opt);

                     $('#loading_header').hide();
                     
                     $('#title').text('Edit - Parks');
                     $('#m_park_save').modal({backdrop: 'static'})
                     $("#sub_m_park_save").draggable({
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

      // delete =========
      $('body').delegate('.del', 'click', function(){
         var par_typeno = $(this).parent().parent().find(this).data('id');
         var image_del = $(this).parent().parent().find(this).data('image_del');
         if(confirm('Are you sure to delete?')){
            $.ajax({
               url: "<?= site_url('setup/cpark/delete') ?>",
               type: "POST",
               dataType: "JSON",
               beforeSend: function(){
                  $('#loading_header').show();
               },
               // async: false,
               data: {
                  par_typeno: par_typeno,
                  image_del: image_del
               },
               success: function(data){
                  if(data.success == 'true'){
                     // if(confirm('Are you sure to delete?')){
                        grid(1, $('#total_display').val() - 0, $('#set_sort').attr('data-fd'), $('#set_sort').attr('data-order')); 
                        $('#loading_header').hide();
                        $('#success').show();                
                        setTimeout(function(){
                            $('#success').hide();
                        }, 1500);
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

      // add new ======
      $('#add_new').on('click', function(){  
         clear_a_element();   
         $('#title').text('Add New - Parks');
         $('#img_park').attr('src', '<?= base_url("assets/upload/packages/images.png") ?>');
         get_location();   
      });      

      // clear search ======
      $('#btn_clear').on('click', function(){         
         clear_park();         
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
         clear_park();         
         var fd = $('#set_sort').attr('data-fd');
         var order = $('#set_sort').attr('data-order');
         grid(1, $('#total_display').val() - 0, fd, order);
      });

   }); // ready ======= 

   // photo =========
   function reload_img() {
      $("#f_photo").submit();
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
     var title = "<center style='font-weight:bold; font-size:16px;'>Parks List</center>";
     //var s_adr   = "Title</div>";
     //    title+=s_adr;
     //title +="<h4 align='center'>Invoice</h4>"; 
     var data = $("#dv-print").html().replace('', ''); // /<img[^>]*>/gi
     var export_data = $("<center>" + data + "</center>").clone().find(".remove_tag").remove().end().html();
     //export_data+=htmlToPrint;
     return title + "####" + export_data;
   }

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

   // get locations ======
   function get_location() {
      $.ajax({
         url: "<?= site_url('setup/cpark/get_location') ?>",
         type: "POST",
         dataType: "JSON",
         beforeSend: function () {
            $('#loading_header').show();
         },
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
            $("#sub_m_park_save").draggable({
               handle: ".modal-header"
            });
         },
         error: function (err) {

         }
     });
   }

   // clear park ======
   function clear_park() {
     $('#search_park_name').val('');
     $('#search_description').val('');
     $('#search_location').val('');
   }

   // clear location ======
   function clear_location() {
      $('#loc_typeno').val(''); 
      $('#loc_name').val('');     
      $('#description_loc').val('');
      $('#address').val(''); 
   }

   // show data ======
   function grid(current_page, total_display, fd, order){
      offset = ((current_page - 1) * total_display) - 0;
      limit = total_display - 0;
      $.ajax({
         url: "<?= site_url('setup/cpark/grid') ?>",
         type: "POST",
         dataType: "JSON",
         beforeSend: function(){
            $('#loading_header').show();
         },
         // async: false,
         data: {
            search_park_name: $('#search_park_name').val(),
            search_description: $('#search_description').val(),
            search_location: $('#search_location').val(),
            search_is_active: $('#search_is_active').val(),
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
                           "<td>"+ (row.description != null ? row.description : '') +"</td>"+
                           "<td>"+ (row.loc_name != null ? row.loc_name : '') +"</td>"+ 
                           "<td>"+ 
                                 (row.fore_adult_series != "" &&  row.fore_adult_series != null ? "Foreigner adult series("+row.fore_adult_series+")<br>" : '') +
                                 (row.fore_child_series != "" && row.fore_child_series != null ? "Foreigner child series("+row.fore_child_series+")<br>" : '') +
                                 (row.loc_adult_series != "" && row.loc_adult_series != null ? "Local adult series("+row.loc_adult_series+")<br>" : '') +
                                 (row.loc_child_series != "" && row.loc_child_series != null ? "Local child series("+row.loc_child_series+")" : '') +
                           "</td>"+  
                           "<td>"+ 
                                 (row.fore_adult_form != null && row.fore_adult_form != "" ? "Foreigner adult series("+row.fore_adult_form+")<br>" : '') +
                                 (row.fore_child_form != null && row.fore_child_form != "" ? "Foreigner child series("+row.fore_child_form+")<br>" : '') +
                                 (row.loc_adult_form != null && row.loc_adult_form != "" ? "Local adult series("+row.loc_adult_form+")<br>" : '') +
                                 (row.loc_child_form != null && row.loc_child_form != "" ? "Local child series("+row.loc_child_form+")" : '') +
                           "</td>"+
                           "<td style='text-align: center;'><img width='20' height='20' src='<?= base_url("assets/upload/packages") ?>/"+ (row.image != '' ? row.image : 'images.png') + "?" + new Date().getTime() +"'></td>"+
                           "<td class='remove_tag' style='text-align: center;'>";
                  // condition ======      
                  if("<?php echo $this->green->gAction('U') ?>"){
                     tr += "<a href='javascript: void(0)' class='edit' data-id='"+ row.par_typeno +"'><img width='15px' height='15px' src='<?= base_url("assets/images/icons/edit.png") ?>'></a>";
                  }  
                  tr += "</td>";
                  tr += "<td class='remove_tag' style='text-align: center;'>";
                  if("<?php echo $this->green->gAction('D') ?>"){ 
                     tr += "<a href='javascript: void(0)' class='del' data-id='"+ row.par_typeno +"'data-image_del='"+ row.image +"'><img width='15px' height='15px' src='<?= base_url("assets/images/icons/delete.png") ?>'></a>";
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