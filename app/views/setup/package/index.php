<!-- table -->
<div class="container-fluid">
   <div class="row">
      <div class="col-xs-12">         
         <div class="result_info">            
            <div class="col-xs-4" style="font-weight: bold;"><?= $this->lang->line("packages")?></div>
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
               <!-- <div class="col-sm-1">&nbsp;</div> -->
               <div class="col-sm-2">
                  <input type="text" class="form-control" name="search_package_name" id="search_package_name" placeholder="<?= $this->lang->line("package name")?>">
               </div>
               <div class="col-sm-3">
                  <input type="text" class="form-control" name="search_description" id="search_description" placeholder="<?= $this->lang->line("description")?>">
               </div>
               <div class="col-sm-2">
                  <input type="text" class="form-control" name="search_prefix" id="search_prefix" placeholder="<?= $this->lang->line("prefix")?>">
               </div>
               <!-- <div class="col-sm-2">
                  <input type="text" class="form-control" name="search_prefix" id="search_prefix" placeholder="<?= $this->lang->line("prefix")?>">
               </div> -->
               <div class="col-sm-2">
                  <div class="checkbox">
                     <label>
                        <input type="checkbox" name="search_is_active" id="search_is_active" value="1"> <?= $this->lang->line("is active") ?>
                     </label>
                  </div>
               </div>
               <div class="col-sm-2" style="display: none;">
                  <input type="text" class="form-control" name="search_park_name" id="search_park_name" placeholder="<?= $this->lang->line("park name")?>">
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
         <!-- <div id="dv-print"> -->
            <div class="table-responsive">
               <table id="grid" class="table table-condensed table-hover" cellspacing="0" cellpadding="0" border="0">
                  <thead>            
                     <tr>
                        <th width="5%">#<input type="hidden" id="set_sort" data-fd="package_name" data-order="ASC"></th>
                        <th width="20%" class="manage-column package_name" data-fd="package_name" data-order="ASC">
                           <a href="javascript: void(0)">                        
                              <span><?= $this->lang->line("package name") ?></span>
                              <span class="glyphicon glyphicon-menu-up" style="font-size: 9px;"></span>
                           </a>                     
                        </th>
                        <th width="20%" class="manage-column description" data-fd="description" data-order="ASC">
                           <a href="javascript: void(0)">
                              <span><?= $this->lang->line("description") ?></span>
                              <span style="font-size: 9px;"></span>
                           </a>                     
                        </th> 
                        <th width="15%" class="manage-column prefix" data-fd="prefix" data-order="ASC">
                           <a href="javascript: void(0)">
                              <span>Series</span>
                              <span style="font-size: 9px;"></span>
                           </a>                     
                        </th>
                        <th width="15%" class="manage-column tick_form" data-fd="tick_form" data-order="ASC">
                           <a href="javascript: void(0)">
                              <span><?= $this->lang->line("Form") ?></span>
                              <span style="font-size: 9px;"></span>
                           </a>                     
                        </th>
                        <th width="15%" class="manage-column park_name" data-fd="park_name" data-order="ASC">
                           <a href="javascript: void(0)">
                              <span><?= $this->lang->line("park name") ?></span>
                              <span style="font-size: 9px;"></span>
                           </a>                     
                        </th>
                        <th width="15%" style="text-align: center;">
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

         <!-- </div> -->
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

<div id="m_package_save" class="modal">
   <div id="sub_m_package_save" class="modal-dialog modal-lg">
     <div class="modal-content">
         <div class="modal-header">
             <button type="button" id="close_top" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             <h5 id="title" class="modal-title">Modal title</h5>
         </div>
         <div class="modal-body">
            
               <div class="row">
                  <input clear_a_element type="hidden" name="package_typeno" id="package_typeno"> 
                  <div class="col-sm-8">
                     <div class="col-sm-12">
                        <label for="package_name" class="control-label"><?= $this->lang->line("package name") ?><span style="color:red"> *</span></label>
                        <input clear_a_element type="text" class="form-control" name="package_name" id="package_name" placeholder="" data-parsley-required="true" data-parsley-error-message="This field required !">
                     </div>
                     <div class="col-sm-12">
                        <label for="description" class="control-label"><?= $this->lang->line("description") ?></label>
                        <textarea style="resize: none;" clear_a_element rows="2" class="form-control" name="description" id="description" placeholder="<?= $this->lang->line("description") ?>"></textarea>
                     </div>
                  </div>
                  <div class="col-sm-4" style="margin-top:10px; text-align: center;">
                     <form id="f_photo" target="ifram" method="POST" action="<?= site_url('setup/cpackage/package_upload') ?>" enctype="multipart/form-data">
                        <input clear_a_element style="width: 0;height: 0;" type="file" name="photo" id="photo" accept="image/*">
                        <input type="hidden" name="image_insert" id="image_insert">
                        <input type="hidden" name="image_edit" id="image_edit">
                        
                        <div id="dv_img" class="dv_img" onclick="$('#photo').click()">
                          <img width="150" height="140" id="img_park" class="img-rounded" style="border: 1px solid #CCC;">
                        </div>
                     </form>
                     <iframe id="ifram" name="ifram" style="display: none;"></iframe>
                     <button type="button" id="browser" onclick="$('#photo').click()" class="btn btn-primary btn-xs" style="margin: 2px;">Browse...</button>
                  </div> 
                  
               </div>
            <form id="f_save" enctype="multipart/form-data">
               <div class="row">
                  <div class="col-sm-6">
                  
                     <div class="panel panel-default">
                        <div class="panel-heading">Series</div>
                        <div class="panel-body">
                           <div class="col-sm-6">
                              <label style="padding:0px;" for="fore_adult_series" class="control-label">Foreigner adult series</label>
                              <input clear_a_element type="text" class="form-control" name="fore_adult_series" id="fore_adult_series" placeholder="">
                           </div>
                           <div class="col-sm-6">
                              <label style="padding:0px;" for="fore_child_series" class="control-label">Foreigner child series</label>
                              <input clear_a_element type="text" class="form-control" name="fore_child_series" id="fore_child_series" placeholder="">
                           </div>
                           <div class="col-sm-6">
                              <label style="padding:0px;" for="loc_adult_series" class="control-label">Local adult series</label>
                              <input clear_a_element type="text" class="form-control" name="loc_adult_series" id="loc_adult_series" placeholder="">
                           </div>
                           <div class="col-sm-6">
                              <label style="padding:0px;" for="loc_child_series" class="control-label">Local child series</label>
                              <input clear_a_element type="text" class="form-control" name="loc_child_series" id="loc_child_series" placeholder="">
                           </div>
                        </div>
                     </div> <!--  end panel panel-default -->
                  </div>
                  <div class="col-sm-6">
                     <div class="panel panel-default">
                        <div class="panel-heading">Form</div>
                        <div class="panel-body">
                           <div class="col-sm-6">
                              <label style="padding:0px;" for="fore_adult_form" class="control-label">Foreigner adult form</label>
                              <input clear_a_element type="text" class="form-control" name="fore_adult_form" id="fore_adult_form" placeholder="">
                           </div>
                           <div class="col-sm-6">
                              <label style="padding:0px;" for="fore_child_form" class="control-label">Foreigner child form</label>
                              <input clear_a_element type="text" class="form-control" name="fore_child_form" id="fore_child_form" placeholder="">
                           </div>
                           <div class="col-sm-6">
                              <label style="padding:0px;" for="loc_adult_form" class="control-label">Local adult form</label>
                              <input clear_a_element type="text" class="form-control" name="loc_adult_form" id="loc_adult_form" placeholder="">
                           </div>
                           <div class="col-sm-6">
                              <label style="padding:0px;" for="loc_child_form" class="control-label">Local child form</label>
                              <input clear_a_element type="text" class="form-control" name="loc_child_form" id="loc_child_form" placeholder="">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
                  <!-- <div class="col-sm-6">
                     <label for="prefix" class="control-label"><?= $this->lang->line("prefix") ?></label>
                     <input clear_a_element type="text" class="form-control" name="prefix" id="prefix" placeholder="<?= $this->lang->line("prefix") ?>">
                  </div> 
                  <div class="col-sm-6">
                     <label for="tick_form" class="control-label"><?= $this->lang->line("Form") ?></label>
                     <input clear_a_element type="text" class="form-control" name="tick_form" id="tick_form" placeholder="<?= $this->lang->line("Form") ?>">
                  </div>-->
               
            </form>

            <div class="row">
               <div class="col-sm-8">
                  <div class="checkbox">
                     <label>
                        <input type="checkbox" name="is_active" id="is_active" checked="checked" value="1"> <?= $this->lang->line("is active") ?>
                     </label>
                  </div>
               </div>
            </div>     
          <!-- </div>end div modal-body -->

            <!-- <div class="col-sm-12">
               <div class="col-sm-12" style="border-bottom: 1px solid #CCC;"></div>
            </div> -->            

            <!-- table -->
            <div class="row">
               <div class="col-sm-12">
                  <div class="table-responsive">
                     <table id="grid_pck" class="table table-condensed table-hover" cellspacing="0" cellpadding="0" border="0">
                        <thead>            
                           <tr>
                              <th width="5%">#</th>
                              <th width="35%"><?= $this->lang->line("park name") ?></th>
                              <th width="50%"><?= $this->lang->line("description") ?></th>
                              <th width="10%" colspan="2" style="text-align: center;">
                                 <a href="javascript:void(0)" id="add_new_pck" class="add_new_pck">
                                    <img width="20" height="20" src="<?= base_url('assets/images/icons/adds.png') ?>">
                                 </a>
                              </th>                              
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td class="no" style="vertical-align: middle;">1</td>
                              <td style="vertical-align: middle !important;">
                                 <select clear_a_element class="form-control par_typeno" name="par_typeno[]">
                                    <option></option>
                                    <?= $this->green->user_access_park(1) ?>
                                 </select>
                              </td>
                              <td>
                                 <textarea disabled="disabled" style="resize: none;" clear_a_element rows="1" class="form-control description_park" name="description_park[]" placeholder="<?= $this->lang->line("description") ?>"></textarea>
                              </td>
                              <td style="text-align: center;vertical-align: middle;">
                                 <a href="javascript:void(0)" name="delete[]" class="delete">
                                    <img width="16px" height="16px" src="<?= base_url('assets/images/icons/delete.png') ?>">
                                 </a>
                              </td>                              
                           </tr>
                        </tbody>
                        <tfoot>
                           
                        </tfoot>
                     </table>
                  </div>
               </div>     
            </div>
                        
         </div><!-- content -->
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

<div id="dv-print" class="table-responsive" style="display: none;">
   <table id="tbl_data" class="table table-bordered table-hover" cellspacing="0" cellpadding="0" border="1" width="70%">
      <caption style="font-size: 16px;"></caption>
      <thead>
         <tr>
            <th style="text-align: center;vertical-align: middle;">#</th>
            <th style="text-align: center;vertical-align: middle;">Pakckage Name</th>
            <th style="text-align: center;vertical-align: middle;">Description</th>
            <th style="text-align: center;vertical-align: middle;">Prefix</th>
            <th style="text-align: center;vertical-align: middle;">Park Name</th>
            <th style="text-align: center;vertical-align: middle;">Image</th>            
         </tr>
      </thead>
      <tbody>      

      </tbody>
      <tfoot>
         
      </tfoot>
   </table>
</div>
<?php 
//print_r($park_select);
   $opt_park = '<option value=""></option>';
   if(count($park_select) > 0){
      foreach ($park_select as $key => $row_park) {
         $opt_park.='<option value="'.$row_park->par_typeno.'">'.$row_park->park_name.'</option>';
      }

   }
?>
<style type="text/css">
   .package_name > a, .description > a, .prefix > a, .park_name > a{text-decoration: none;display: block;} 
   a#add_new{display: block;}
   #grid.edit, #grid.del{display: block;}
   th{vertical-align: middle;margin: 0;padding: 0;}
   td{vertical-align: middle;}
   #dv_img{cursor: pointer;text-align: center;}

   .modal .modal-body {
    max-height: 600px;
    overflow-y: auto;
   }
</style>

<script type="text/javascript">
   $(function () {

      // is active =======
      $("body").delegate("#is_active", "change", function(){
         if($(this).prop('checked') == true){
            $(this).val(1);
         }else{
            $(this).val(0);
         }
      });   

      // export ======
      $("body").delegate("a#export", "click", function(){
         $('#tbl_data').find('caption').html('<center><b>Packages List</b></center>');
         var arr_exp = fn_pr_ex().split("####");
         window.open('data:application/vnd.ms-excel,' + encodeURIComponent(arr_exp[1]));
         $('#tbl_data').find('caption').html('');
      });

      // print ======
      $("body").delegate("a#print","click",function(){
         var arr_pr = fn_pr_ex().split("####");
         gsPrint(arr_pr[0],arr_pr[1]);
      });      

      // tooltip ====      
      $('#a_search').tooltip({title: 'show / hide Search'})
      $('#export').tooltip({title: 'Export'})
      $('#print').tooltip({title: 'Print'})
     
      $('#img_park').tooltip({placement: 'left', title: 'File extension PNG/JPG/JPEG, Size <= 2MB)'});

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
      $('#search_prefix').on('focus', function(){         
         $(this).select();
      });

      // destroy parsley =======      
      $('#close_top, #close_bottom').on('click', function(){  
         $('#f_save').parsley().destroy();
      });

      // save =======
      $('.save_park').on('click', function(e){
         var save_close = $(this);
         var arr = [];
         $('.par_typeno').each(function(i){
            if($(this).length > 0){
               arr[i] = {'par_typeno': $(this).val()};
            }
         });

         if($('#f_save').parsley().validate()){
            $.ajax({
               url: "<?= site_url('setup/cpackage/save') ?>",
               type: "POST",
               dataType: "JSON",
               beforeSend: function(){
                  $('#loading_header').show();
               },
               data: {
                  package_typeno: $('#package_typeno').val(),
                  package_name: $('#package_name').val(),                  
                  //prefix: $('#prefix').val(),                                 
                  //tick_form: $('#tick_form').val(),              
                  description: $('#description').val(),
                  is_active: $('#is_active').val(),
                  fore_adult_series : $("#fore_adult_series").val(),
                  fore_child_series : $("#fore_child_series").val(),
                  loc_adult_series : $("#loc_adult_series").val(),
                  loc_child_series : $("#loc_child_series").val(),
                  fore_adult_form : $("#fore_adult_form").val(),
                  fore_child_form : $("#fore_child_form").val(),
                  loc_adult_form  : $("#loc_adult_form").val(),
                  loc_child_form  : $("#loc_child_form").val(),
                  arr: arr
               },
               success: function(data){
                  if(data.arr.success == 'true'){                    
                     // image =======
                     $('#image_insert').val(data.package_typeno);
                     reload_img();
                     clear_a_element(); 
                     clear_pckd();                    
                     $('#img_park').attr({src: '<?= base_url("assets/upload/images.png") ?>'});
                     
                     if(save_close.attr('data-close') == 'true'){
                        $('#m_package_save').modal('hide')                                              
                     }                     
                     
                     setTimeout(function(){
                        grid(1, $('#total_display').val() - 0, $('#set_sort').attr('data-fd'), $('#set_sort').attr('data-order'));                      
                     }, 1000);
                     $('#success').show();
                     setTimeout(function(){
                        $('#success').hide();
                     }, 1500);

                  }else{
                     alert('Duplicate' + ' ' + "'" + $('#package_name').val() + "'" + '!')
                     $('#package_name').select();
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
         var package_typeno = $(this).parent().parent().find(this).data('id');

         $.ajax({
            url: "<?= site_url('setup/cpackage/edit') ?>",
            type: "POST",
            dataType: "JSON",
            beforeSend: function(){
               $('#loading_header').show();
            },
            // async: false,
            data: {
               package_typeno: package_typeno
            },
            success: function(data){
               $('#package_typeno').val(data.row_pck.package_typeno);
               $('#package_name').val(data.row_pck.package_name);               
               $('#description').val(data.row_pck.description);
               $('#is_active').val(data.row_pck.is_active);
               if($('#is_active').val() - 0 > 0 ){
                  $('#is_active').prop('checked', true);
               }else{
                  $('#is_active').prop('checked', false);
               }
               $('#prefix').val(data.row_pck.prefix);
               $('#tick_form').val(data.row_pck.tick_form);
               $('#img_park').attr({src: '<?= base_url("assets/upload/packages/'+ (data.row_pck.image != null ? data.row_pck.image : 'images.png') + '?' + new Date().getTime() +'") ?>'});

               $("#fore_adult_series").val(data.row_pck.fore_adult_series);
               $("#fore_child_series").val(data.row_pck.fore_child_series);
               $("#loc_adult_series").val(data.row_pck.loc_adult_series);
               $("#loc_child_series").val(data.row_pck.loc_child_series);
               $("#fore_adult_form").val(data.row_pck.fore_adult_form);
               $("#fore_child_form").val(data.row_pck.fore_child_form);
               $("#loc_adult_form").val(data.row_pck.loc_adult_form);
               $("#loc_child_form").val(data.row_pck.loc_child_form);

               var tr = '';
               if(data.qr_pckd.length > 0){
                  $.each(data.qr_pckd, function(i, row){   
                     var opt = ''; 
                     if(data.qr_park.length > 0){
                        var select_show = "";
                        // opt += '<option></option>';                        
                        $.each(data.qr_park, function(j, row1){ 
                           if(row.par_typeno == row1.par_typeno){
                              select_show = "selected='selected' ";
                           }else{
                              select_show = "";
                           }
                           opt += '<option value="'+ row1.par_typeno +'" '+ select_show +'>'+ row1.park_name +'</option>';
                        });
                     }

                     tr += '<tr>'+
                              '<td class="no" class="no" style="text-align: center;vertical-align: middle;">'+ (i + 1) +'</td>'+
                              '<td style="vertical-align:middle;">'+
                                 '<select clear_a_element class="form-control par_typeno" name="par_typeno[]">'+ opt +'</select>'+
                              '</td>'+
                              '<td><textarea disabled="disabled" style="resize: none;" clear_a_element rows="1" class="form-control description_park" name="description_park[]" placeholder="<?= $this->lang->line("description") ?>">'+ (row.description != null ? row.description : '') +'</textarea></td>'+
                              '<td style="text-align: center;vertical-align: middle;">'+
                                 '<a href="javascript:void(0)" name="delete[]" class="delete"><img width="16px" height="16px" src="<?= base_url().'assets/images/icons/delete.png' ?>"></a>'+
                              '</td>'+                  
                           '</tr>';  
                  });
               }

               $('#grid_pck tbody').html(tr);
               $('#title').text('Edit - Packages');
               $('#m_package_save').modal({backdrop: 'static'})
               $("#sub_m_package_save").draggable({
                  handle: ".modal-header"
               });

               $('#loading_header').hide();
            },
            error: function(err){

            }
         });
      });

      // delete =========
      $('body').delegate('.del', 'click', function(){         
         var package_typeno = $(this).parent().parent().find(this).data('id');
         var image_del = $(this).parent().parent().find(this).data('image_del');

         if(confirm('Are you sure to delete?')){
            $.ajax({
               url: "<?= site_url('setup/cpackage/delete') ?>",
               type: "POST",
               dataType: "JSON",
               beforeSend: function(){
                  $('#loading_header').show();
               },
               // async: false,
               data: {
                  package_typeno: package_typeno,
                  image_del: image_del
               },
               success: function(data){
                  if(data.success == true){
                     grid(1, $('#total_display').val() - 0, $('#set_sort').attr('data-fd'), $('#set_sort').attr('data-order')); 
                     $('#loading_header').hide();
                     $('#success').show();                
                     setTimeout(function(){
                         $('#success').hide();
                     }, 1500);                    
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
         get_park(); 
         clear_a_element();   
         clear_pckd();        
         $('#img_park').attr('src', '<?= base_url("assets/upload/images.png") ?>');           
      });      

      // clear search ======
      $('#btn_clear').on('click', function(){         
         clear();         
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
      $('.package_name').attr('data-order', 'DESC');
      grid(1, $('#total_display').val() - 0, fd, order);

      // search ======
      $('#btn_search').on('click', function(){
         var fd = $('#set_sort').attr('data-fd');
         var order = $('#set_sort').attr('data-order');
         grid(1, $('#total_display').val() - 0, fd, order);
      });

      // check ======
      $('#search_is_active').on('change', function(){
         if($('#search_is_active').prop('checked') == true){
            $('#search_is_active').val(1);
         }else{
            $('#search_is_active').val(0);
         }
      });      
      if($('#search_is_active').val() - 0 > 0 ){
         $('#search_is_active').prop('checked', true);
      }else{
         $('#search_is_active').prop('checked', false);
      }
      
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
         clear();         
         var fd = $('#set_sort').attr('data-fd');
         var order = $('#set_sort').attr('data-order');
         grid(1, $('#total_display').val() - 0, fd, order);
      });

      // add new row =======
      $('body').delegate('#add_new_pck', 'click', function(){
         add_new_row();
      });

      // remove row =======
      $('body').delegate('.delete', 'click', function(){
         if($('#grid_pck tr').size() - 0 > 2){
            $(this).parent().parent().remove();
            $('.no').each(function(i) {
               $(this).html(i + 1);
            });
         }else{
            alert('Only one cannot remove!');
            clear_pckd();
         }
      });

   }); // ready =======

   // clear list row_pckd =====
   function clear_pckd(){
      var tr = '';
      tr += '<tr>'+
                  '<td class="no" class="no" style="vertical-align: middle;">'+ (1) +'</td>'+
                  '<td>'+
                     '<select clear_a_element class="form-control par_typeno" name="par_typeno[]">'+
                        // '<?= $this->green->user_access_park(1) ?>'+
                        '<?= $opt_park ?>'+
                     '</select>'+
                  '</td>'+
                  '<td><textarea disabled="disabled" style="resize: none;" clear_a_element rows="1" class="form-control description_park" name="description_park[]" placeholder="<?= $this->lang->line("description") ?>"></textarea></td>'+
                  '<td style="text-align: center;vertical-align: middle;">'+
                     '<a href="javascript:void(0)" name="delete[]" class="delete"><img width="16px" height="16px" src="<?= base_url().'assets/images/icons/delete.png' ?>"></a>'+
                  '</td>'+                  
               '</tr>';
      $('#grid_pck tbody').html(tr);
   }

   // add row =======
   function add_new_row(){
      var tr = '';
      var i = $('#grid_pck tr').size() - 0;
      tr += '<tr>'+
                  '<td class="no" class="no" style="vertical-align: middle;">'+ i +'</td>'+
                  '<td>'+
                     '<select clear_a_element class="form-control par_typeno" name="par_typeno[]">'+
                        // '<?= $this->green->user_access_park(1) ?>'+
                        '<?= $opt_park ?>'+
                     '</select>'+
                  '</td>'+
                  '<td><textarea disabled="disabled" style="resize: none;" clear_a_element rows="1" class="form-control description_park" name="description_park[]" placeholder="<?= $this->lang->line("description") ?>"></textarea></td>'+
                  '<td style="text-align: center;vertical-align: middle;">'+
                     '<a href="javascript:void(0)" name="delete[]" class="delete"><img width="16px" height="16px" src="<?= base_url().'assets/images/icons/delete.png' ?>"></a>'+
                  '</td>'+                  
               '</tr>';
      $('#grid_pck tbody').append(tr);
   }

   // get locations ======
   function get_park() {
      $.ajax({
         url: "<?= site_url('setup/cpackage/get_park') ?>",
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
                  opt += '<option value="' + row.par_typeno + '">' + row.park_name + '</option>';
              });
            }
            $('.par_typeno:last').html(opt);

            $('#loading_header').hide();

            $('#m_package_save').modal({backdrop: 'static'});         
            $("#sub_m_package_save").draggable({
               handle: ".modal-header"
            }); 
            $('#title').text('Add New - Packages');

         },
         error: function (err) {

         }
     });
   }

   // photo =========
   function reload_img() {
      $("#f_photo").submit();
   }

   // print or export ======
   function fn_pr_ex(){
     var title = "<center style='font-weight:bold; font-size:16px;'>Packages List</center>";
     var data = $("#dv-print").html();
     var export_data = $("<center>" + data + "</center>").find(".remove_tag").remove().end().html();
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

   // clear ======
   function clear() {
     $('#search_package_name').val('');
     $('#search_description').val('');
     $('#search_prefix').val('');
     $('#search_park_name').val('');
   }

   // show data ======
   function grid(current_page, total_display, fd, order){
      offset = ((current_page - 1) * total_display) - 0;
      limit = total_display - 0;
      $.ajax({
         url: "<?= site_url('setup/cpackage/grid') ?>",
         type: "POST",
         dataType: "JSON",
         beforeSend: function(){
            $('#loading_header').show();
         },
         // async: false,
         data: {
            search_package_name: $('#search_package_name').val(),
            search_description: $('#search_description').val(),
            search_prefix: $('#search_prefix').val(),
            search_park_name: $('#search_park_name').val(),
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
                           "<td>"+ (row.package_name != null ? row.package_name : '') +"</td>"+
                           "<td>"+ (row.description != null ? row.description : '') +"</td>"+
                           "<td>"+ 
                              (row.fore_adult_series != null && row.fore_adult_series != "" ? "Foreigner series("+row.fore_adult_series+")" : '')+"<br>"+
                              (row.fore_child_series != null && row.fore_child_series != "" ? "Local series("+row.fore_child_series+")" : '') +"<br>"+
                              (row.loc_adult_series != null && row.loc_adult_series != "" ? "Adult series("+row.loc_adult_series+")" : '') +"<br>"+
                              (row.loc_child_series != null && row.loc_child_series != "" ? "Child series("+row.loc_child_series+")" : '') +
                           "</td>"+
                           "<td>"+ 
                              (row.fore_adult_form != null && row.fore_adult_form != "" ? "Foreigner form("+row.fore_adult_form+")" : '')+"<br>"+
                              (row.fore_child_form != null && row.fore_child_form != "" ? "Local form("+row.fore_child_form+")" : '') +"<br>"+
                              (row.loc_adult_form != null && row.loc_adult_form != "" ? "Adult form("+row.loc_adult_form+")" : '') +"<br>"+
                              (row.loc_child_form != null && row.loc_child_form != "" ? "Child form("+row.loc_child_form+")" : '') +
                           "</td>"+
                           "<td>"+ (row.park_name != null ? row.park_name : '') +"</td>"+
                           "<td style='text-align: center;'><img width='20' height='20' src='<?= base_url("assets/upload/packages/") ?>/"+ (row.image != null ? row.image : 'images.png') + "?" + new Date().getTime() +"'></td>"+
                           "<td class='remove_tag' style='text-align: center;'>";
                        
                  if("<?php echo $this->green->gAction('U') ?>"){
                     tr += "<a href='javascript: void(0)' class='edit' data-id='"+ row.package_typeno +"'><img width='15px' height='15px' src='<?= base_url("assets/images/icons/edit.png") ?>'></a>";
                  }  
                  tr += "</td>";
                  tr += "<td class='remove_tag' style='text-align: center;'>";
                  if("<?php echo $this->green->gAction('D') ?>"){ 
                     tr += "<a href='javascript: void(0)' class='del' data-id='"+ row.package_typeno +"'data-image_del='"+ row.image +"'><img width='15px' height='15px' src='<?= base_url("assets/images/icons/delete.png") ?>'></a>";
                  }
                  
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
                           "<td colspan='7' style='font-size: 14px;text-align: center;font-weight: bold;'>No Results</td>"+
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