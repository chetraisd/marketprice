<!-- table -->
<div class="container-fluid">
   <div class="row">
      <div class="col-xs-12">         
         <div class="result_info">            
            <div class="col-xs-4" style="font-weight: bold;"><?= $this->lang->line("countries")?></div>
            <div class="col-xs-8" style="text-align: right;">
               <?php if($this->green->gAction("R")){ ?>
                  <a href="javascript: void(0)" id="a_search" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    <img width="24px" height="24px" src="<?= base_url('assets/images/icons/searchs.png') ?>">
                  </a>
               <?php } ?>
               <?php if($this->green->gAction("E")){ ?>
                  <!-- <a href="javascript: void(0)" id="export">
                    <img width="24px" height="24px" src="<?= base_url('assets/images/icons/exports.png') ?>">
                  </a> -->
               <?php } ?>
               <?php if($this->green->gAction("P")){ ?>
                  <!-- <a href="javascript: void(0)" id="print">
                    <img width="24px" height="24px" src="<?= base_url('assets/images/icons/prints.png') ?>">
                  </a> -->
               <?php } ?>
            </div>
         </div>
      </div>
   </div>

   <div class="row" style="overflow-x: hidden;overflow-y: hidden;">      
      <div class="collapse" id="collapseExample">
         <div class="row"> 
            <div class="col-sm-12">
               <div class="col-sm-1">&nbsp;</div>
               <div class="col-sm-3">
                  <input type="text" class="form-control" name="search_name" id="search_name" placeholder="<?= $this->lang->line("name")?>">
               </div>
               <div class="col-sm-1">&nbsp;</div>
               <div class="col-sm-3">
                  <input type="text" class="form-control" name="search_nationality" id="search_nationality" placeholder="<?= $this->lang->line("nationality")?>">
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
            <table id="grid" class="table table-condensed table-hover" cellspacing="0" cellpadding="0" border="0">
               <thead>            
                  <tr>
                     <th width="5%" style="color:#337ab7;">No<input type="hidden" id="set_sort" data-fd="name" data-order="ASC"></th>
                     <th width="30%" class="manage-column name" data-fd="name" data-order="ASC">
                        <a href="javascript: void(0)">                        
                           <span><?= $this->lang->line("name") ?></span>
                           <span class="glyphicon glyphicon-menu-up" style="font-size: 9px;"></span>
                        </a>                     
                     </th>
                     <th width="20%" class="manage-column nationality" data-fd="nationality" data-order="ASC">
                        <a href="javascript: void(0)">
                           <span><?= $this->lang->line("nationality") ?></span>
                           <span style="font-size: 9px;"></span>
                        </a>                     
                     </th>
                     <th style="color:#337ab7;">
                        Is local
                     </th>
                     <th style="color:#337ab7;"> 
                        Top country
                     </th>
                     <th width="10%" style="color:#337ab7;">
                        <span><?= $this->lang->line("flag") ?></span>
                        <span style="font-size: 9px;"></span>                    
                     </th>
                     <th width="5%" colspan="2">
                        <?php if($this->green->gAction("C")){ ?>
                           <!-- <a href="javascript: void(0)" id="add_new" style="text-align: center;">
                              <img width="24px" height="24px" src="<?= base_url('assets/images/icons/adds.png') ?>">
                           </a> -->
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

<!-- <form id="f_save" class="form-horizontal" enctype="multipart/form-data"> -->
   <div id="m_country_save" class="modal">
      <div id="sub_m_country_save" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h5 id="title" class="modal-title">Modal title</h5>
            </div>
            <div class="modal-body">
               <input clear_a_element type="hidden" name="id_countries" id="id_countries">               
               <div class="row">
                  <label style="text-align: right;" for="name" class="col-sm-3 control-label"><?= $this->lang->line("country") ?><span style="color:red"> *</span></label>
                  <div class="col-sm-8">
                     <input required clear_a_element type="text" class="form-control" name="name" id="name" placeholder="<?= $this->lang->line("country") ?>">
                  </div>
               </div>
               <div class="row" style="margin-top: 8px;">
                  <label style="text-align: right;" for="nationality" class="col-sm-3 control-label"><?= $this->lang->line("nationality") ?></label>
                  <div class="col-sm-8">
                     <input clear_a_element type="text" class="form-control" name="nationality" id="nationality" placeholder="<?= $this->lang->line("nationality") ?>">
                  </div>
               </div>  
               <div class="row" style="margin-top: 8px;">
                  <label style="text-align: right;" for="flag" class="col-sm-3 control-label"><?= $this->lang->line("flag") ?></label>
                  <div class="col-sm-3">                   
                     <form id="frm_flag" target="ifram" method="POST" action="<?= site_url('setup/ccountry/country_upload') ?>" enctype="multipart/form-data">
                        <input style="outline: none;width: 0;height: 0;" type="file" name="flag" id="flag" accept="image/*">
                        <input type="hidden" name="image_insert" id="image_insert">
                        <input type="hidden" name="image_edit" id="image_edit">
                        <div id="dv_img" class="dv_img" onclick="$('#flag').click()">
                          <img width="16" height="11" id="img_flag" class="img-responsive" style="">
                        </div>
                     </form>
                     <iframe id="ifram" name="ifram" style="display: none;"></iframe>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-3">&nbsp;</div>
                  <div class="col-sm-2">
                     <button type="button" id="browser" onclick="$('#flag').click()" class="btn btn-primary btn-xs" style="margin: 3px;">Browse...</button>
                  </div>
                  <label style="text-align: left;padding-top: 10px;" class="col-sm-7 control-label">(File extension PNG/JPG/JPEG, Size <= 2MB)</label>
               </div>
            </div>
            <div class="modal-footer">
               <!-- <button type="button" id="save" class="btn btn-primary save_country" data-close="true"><?= $this->lang->line('save')?></button> -->
               <button type="button" id="save_close" class="btn btn-primary save_country" data-close="true"><?= $this->lang->line('save close')?></button>
               <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
   </div><!-- /.modal -->
<!-- </form> -->

<!-- <div id="dv-print" class="table-responsive" style="display: none;">
   <table id="tbl_data" class="table table-bordered table-hover" cellspacing="0" cellpadding="0" border="1" width="70%">
      <caption style="font-size: 16px;"></caption>
      <thead>
         <tr>
            <th style="text-align: center;vertical-align: middle;">#</th>
            <th style="text-align: center;vertical-align: middle;">Park Name</th>
            <th style="text-align: center;vertical-align: middle;">Description</th>
            <th style="text-align: center;vertical-align: middle;">Location Name</th>
            <th style="text-align: center;vertical-align: middle;">Image</th>
         </tr>
      </thead>
      <tbody>      

      </tbody>
      <tfoot>
         
      </tfoot>
   </table>
</div> -->

<style type="text/css">
   .name > a, .nationality > a{text-decoration: none;display: block;} 
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

      $('#add_location').on('click', function(){
         $('#m_location_save').modal({backdrop: 'static'})
         $('#sub_m_location_save').draggable({
            handle: ".modal-header"
         });
         $('#title_location').text('Add New - Locations');
         clear_location();
         $('#loc_name').css({border: ''});
         $('#loc_name').focus();  
         $('#m_park_save').modal('hide')
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

      // save =======
      $('.save_country').on('click', function(e){
         $('#name').focus();  
         $('#name').css({border: ''});
         var save_close = $(this);
         if(validate()){
            $.ajax({
               url: "<?= site_url('setup/ccountry/save') ?>",
               type: "POST",
               dataType: "JSON",
               beforeSend: function(){
                  $('#loading_header').show();
               },
               async: false,
               data: {
                  id_countries: $('#id_countries').val(),                  
                  name: $('#name').val(),
                  nationality: $('#nationality').val()                                 
               },
               success: function(data){            
                  if(data.arr.success == 'true'){                     
                     clear_a_element();
                     // image =======
                     $('#image_insert').val(data.id_countries);            
                     reload_img();
                     $('#img_flag').attr({src: '<?= base_url("assets/upload/images.png") ?>'});
                     
                     if(save_close.attr('data-close') == 'true'){
                        $('#m_country_save').modal('hide')                                              
                     }                     
                     
                     setTimeout(function(){
                        grid(1, $('#total_display').val() - 0, $('#set_sort').attr('data-fd'), $('#set_sort').attr('data-order'));                      
                     }, 1000);
                     $('#success').show();
                     setTimeout(function(){
                        $('#success').hide();
                     }, 1500);

                  }else{
                     alert('Duplicate' + ' ' + "'" + $('#name').val() + "'" + '!')
                     $('#name').select();
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
         var id_countries = $(this).parent().parent().find(this).data('id');         
         $('#name').css({border: ''});           
         $('#name').focus();
         $.ajax({
            url: "<?= site_url('setup/ccountry/edit') ?>",
            type: "POST",
            dataType: "JSON",
            beforeSend: function(){
               $('#loading_header').show();
            },
            // async: false,
            data: {
               id_countries: id_countries
            },
            success: function(data){
               $('#id_countries').val(data.id_countries);
               $('#name').val(data.name);
               $('#nationality').val(data.nationality);
               $('#image_edit').val(data.flag);
               $('#img_flag').attr({src: '<?= base_url("assets/upload/flag/'+ (data.flag != '' ? data.flag : 'images.png') + '?' + new Date().getTime() +'") ?>'});

               $('#title').text('Edit - Countries');
               $('#m_country_save').modal({backdrop: 'static'})
               $("#sub_m_country_save").draggable({
                  handle: ".modal-header"
               });

               // hide ========
               $('#loading_header').hide();
            },
            error: function(err){

            }
         });
      });

      // delete =========
      $('body').delegate('.del', 'click', function(){
         var id_countries = $(this).parent().parent().find(this).data('id');
         var image_del = $(this).parent().parent().find(this).data('image_del');
         if(confirm('Are you sure to delete?')){
            $.ajax({
               url: "<?= site_url('setup/ccountry/delete') ?>",
               type: "POST",
               dataType: "JSON",
               beforeSend: function(){
                  $('#loading_header').show();
               },
               // async: false,
               data: {
                  id_countries: id_countries,
                  image_del: image_del
               },
               success: function(data){
                  if(data.success == 'true'){
                     clear();
                     grid(1, $('#total_display').val() - 0, $('#set_sort').attr('data-fd'), $('#set_sort').attr('data-order')); 
                     $('#loading_header').hide();
                     $('#success').show();                
                     setTimeout(function(){
                         $('#success').hide();
                     }, 1500);
                  }                  
               },
               error: function(err){

               }
            });
         }
      });        

      // change photo ========
      $('#flag').on('change', function () {
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
         $('#img_flag').attr('src', '<?= base_url("assets/upload/images.png") ?>');
         $('#title').text('Add New - Countries');
         clear_a_element();
         $('#name').css({border: ''});
         $('#name').focus();    
         $('#m_country_save').modal({backdrop: 'static'})
         $("#sub_m_country_save").draggable({
            handle: ".modal-header"
         });
      });

      // focusin ======
      $('#search_park_name').on('focus', function(){         
         $(this).select();
      });
      $('#search_description').on('focus', function(){         
         $(this).select();
      });

      // clear search ======
      $('#btn_clear').on('click', function(){         
         $('#search_name').val('');
         $('#search_nationality').val('');        
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
               $('#set_sort').attr('data-fd', $(thរis).attr('data-fd')); 
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
      $('.name').attr('data-order', 'ASC');
      grid(1, $('#total_display').val() - 0, 'order_country', 'ASC');

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
         $('#search_name').val('');
         $('#search_nationality').val('');       
         var fd = $('#set_sort').attr('data-fd');
         var order = $('#set_sort').attr('data-order');
         grid(1, $('#total_display').val() - 0, fd, order);
      });

      //----------------------- click check local and top by chantria-------------------------


      $('body').delegate('.check_local','click',function(){ 

            
            if($(this).is(":checked")){

               $(".check_local").prop("checked",false);
               $(this).prop("checked",true);

               if($(this).prop("checked")==true){
                  var id_countries = $(this).attr('cou_id');
                  check_local(id_countries,1);
               }
               
            }else{

               $(this).prop("checked",false);
               var id_countries = $(this).attr('cou_id');
               check_local(id_countries,0);
            }
      });//check_local

      $("body").delegate(".check_top","keydown", function (e) {
            if ((e.keyCode >= 96 && e.keyCode <= 105) || (e.keyCode >= 48 && e.keyCode <= 57) || e.keyCode == 8 || e.keyCode == 190 || e.keyCode == 110) {
                $(this).removeAttr("readonly");
               if($(this).val()!=""){
                        var id_countries = $(this).attr('cou_id');
                        var myVal = $(this).val()
                        check_top(id_countries,myVal);           
               }else{ 
                        var id_countries = $(this).attr('cou_id');
                        check_top(id_countries,'1000');
               }

            } else {
                $(this).attr("readonly", "readonly");
            }
      });

      $('body').delegate('.check_top','keyup',function(){ 
         
         if($(this).val()!=""){
               var id_countries = $(this).attr('cou_id');
               var myVal = $(this).val()
               check_top(id_countries,myVal);           
         }else{ 
               var id_countries = $(this).attr('cou_id');
               check_top(id_countries,'1000');
         }

      });

      //--------------------------- end click check ---------------------------------

   }); // ready ======= 

   //--------------------function check local and top by chantria -------------------

   function check_local(id_countries,value){ 
         $.ajax({ 
            type : 'POST',
            url  : "<?= site_url('setup/ccountry/check_local') ?>",
            data : { 
               id_countries : id_countries,
               value        : value
            },
            success:function(){ 
               
            }
         });
   }

   function check_top(id_countries,checked){
         $.ajax({ 
            type : 'POST',
            url  : "<?= site_url('setup/ccountry/check_top') ?>",
            data : { 
               id_countries : id_countries,
               checked     : checked
            },
            success:function(){ 

            }
         });
   }

   //----------------------End function ---------------------------------------------

   // photo =========
   function reload_img() {
      $("#frm_flag").submit();
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
             $('#img_flag').attr('src', e.target.result);
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

         },
         // async: false,
         data: {
          
         },
         success: function (data) {
             var opt = "";
             if (data.length > 0) {
                 opt += "<option></option>";
                 $.each(data, function (i, row) {
                     opt += "<option value='" + row.loc_typeno + "'>" + row.loc_name + "</option>";
                 });
             }
             $('#location').html(opt);
         },
         error: function (err) {

         }
     });
   }

   // clear country ======
   function clear() {
     $('#search_name').val('');
     $('#search_nationality').val('');
   }

   // show data ======
   function grid(current_page, total_display, fd, order){
      offset = ((current_page - 1) * total_display) - 0;
      limit = total_display - 0;
      $.ajax({
         url: "<?= site_url('setup/ccountry/grid') ?>",
         type: "POST",
         dataType: "JSON",
         beforeSend: function(){
            $('#loading_header').show();
         },
         // async: false,
         data: {
            search_name: $('#search_name').val(),
            search_nationality: $('#search_nationality').val(),                       
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
                  var local_checked = '';
                  var top_checked = '';
               $.each(result, function(i, row){
                  
                  if(row.is_local == 0){ 
                     local_checked = '';                     
                  }else{ 
                     local_checked = 'checked="checked"';                     
                  }

                  if(row.order_country == 0 || row.order_country == null){ 
                     top_checked = '';
                  }else{ 
                     top_checked = 'checked="checked"'; 
                  }

                  tr += "<tr>"+ 
                           "<td>"+ (offset + i + 1) +"</td>"+
                           "<td>"+ (row.name != null ? row.name : '') +"</td>"+
                           "<td>"+ (row.nationality != null ? row.nationality : '') +"</td>"+
                           "<td><input type='checkbox' cou_id='"+row.id_countries+"' class='check_local' "+local_checked+"></td>"+
                           "<td><input type='text' cou_id='"+row.id_countries+"' class='check_top'  id='check_top' value="+row.order_country+"  placeholder='0' min='0' max='1000' step='1' data-parsley-validation-threshold='1' data-parsley-trigger='keyup'></td>"+
                           "<td><img width='16' class='img-responsive' src='<?= base_url("assets/upload/flag") ?>/"+ (row.flag != '' ? row.flag : 'images.png') + "?" + new Date().getTime() +"'></td>"+
                           "<td class='remove_tag' style='text-align: center;'>";
                  // condition ======      
                  if("<?php echo $this->green->gAction('U') ?>"){
                     tr += "<a href='javascript: void(0)' class='edit' data-id='"+ row.id_countries +"'><img width='15px' height='15px' src='<?= base_url("assets/images/icons/edit.png") ?>'></a>";
                  }  
                  tr += "</td>";
                  tr += "<td class='remove_tag' style='text-align: center;'>";
                  if("<?php echo $this->green->gAction('D') ?>"){ 
                     // tr += "<a href='javascript: void(0)' class='del' data-id='"+ row.id_countries +"'data-image_del='"+ row.flag +"'><img width='15px' height='15px' src='<?= base_url("assets/images/icons/delete.png") ?>'></a>";
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