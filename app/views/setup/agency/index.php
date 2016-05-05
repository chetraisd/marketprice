<div class="container-fluid">
   <div class="row">
      <div class="col-xs-12">         
         <div class="result_info">            
            <div class="col-xs-4" style="font-weight: bold;"><?= $this->lang->line("Tour Group Information")?></div>
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
                  <input type="text" class="form-control" name="search_agen_code" id="search_agen_code" placeholder="<?= $this->lang->line("agency code")?>">
               </div>
               <div class="col-sm-3">
                  <input type="text" class="form-control" name="search_agen_name" id="search_agen_name" placeholder="<?= $this->lang->line("agency name")?>">
               </div>
               <div class="col-sm-3">
                  <select class="form-control" name="search_agen_group" id="search_agen_group">
                     <option></option>
                     <option value="1">Agency</option>
                     <option value="0">Group</option>                     
                     <option value="2">School</option>
                     <option value="3">Organization</option></select> 
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
                     <th width="5%">#<input type="hidden" id="set_sort" data-fd="agency_code" data-order="ASC"></th>
                     <th width="20%" class="manage-column agency_code" data-fd="agency_code" data-order="ASC">
                        <a href="javascript: void(0)">                        
                           <span><?= $this->lang->line("code") ?></span>
                           <span class="glyphicon glyphicon-menu-up" style="font-size: 9px;"></span>
                        </a>                     
                     </th>
                     <th width="20%" class="manage-column agency_name" data-fd="agency_name" data-order="ASC">
                        <a href="javascript: void(0)">                        
                           <span><?= $this->lang->line("name") ?></span>
                           <span class="glyphicon glyphicon-menu-up" style="font-size: 9px;"></span>
                        </a>                     
                     </th>
                     <th width="10%" class="manage-column tel" data-fd="tel" data-order="ASC">
                        <a href="javascript: void(0)">
                           <span><?= $this->lang->line("tel") ?></span>
                           <span style="font-size: 9px;"></span>
                        </a>                     
                     </th>
                     <th width="10%" class="manage-column email" data-fd="email" data-order="ASC">
                        <a href="javascript: void(0)">
                           <span><?= $this->lang->line("email") ?></span>
                           <span style="font-size: 9px;"></span>
                        </a>                     
                     </th>
                     <th width="15%" class="manage-column address" data-fd="address" data-order="ASC">
                        <a href="javascript: void(0)">
                           <span><?= $this->lang->line("address") ?></span>
                           <span style="font-size: 9px;"></span>
                        </a>                     
                     </th>
                     <th width="15%" class="manage-column note" data-fd="note" data-order="ASC">
                        <a href="javascript: void(0)">
                           <span><?= $this->lang->line("note") ?></span>
                           <span style="font-size: 9px;"></span>
                        </a>                     
                     </th>
                      <th width="5%" class="manage-column is_agency" data-fd="is_agency" data-order="ASC">
                        <a href="javascript: void(0)">
                           <span><?= $this->lang->line("class") ?></span>
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
            <div class="form-group">
               <label for="agency_code" class="col-sm-3 control-label"><?= $this->lang->line("Tour Class")?> <span style="color:red">*</span></label>
               <div class="col-sm-8">
                  <select name="tour_class" id="tour_class"  class="form-control" placeholder="<?= $this->lang->line("Tour Class")?>">
                     <option value="1">Agency</option>
                     <option value="0">Group</option>                     
                     <option value="2">School</option>
                     <option value="3">Organization</option>
                  </select>
               </div>
            </div>
            <input clear_a_element type="hidden" name="agency_typeno" id="agency_typeno">
            <div class="form-group">
               <label for="agency_code" class="col-sm-3 control-label"><?= $this->lang->line("code")?> <span style="color:red">*</span></label>
               <div class="col-sm-8">
                  <input data-parsley-required="true" data-parsley-error-message="This field required!" clear_a_element type="text" class="form-control" name="agency_code" id="agency_code" placeholder="<?= $this->lang->line("code")?>">
               </div>
            </div>
            <div class="form-group">
               <label for="agency_name" class="col-sm-3 control-label"><?= $this->lang->line("name")?> <span style="color:red">*</span></label>
               <div class="col-sm-8">
                  <input data-parsley-required="true" data-parsley-error-message="This field required!" clear_a_element type="text" class="form-control" name="agency_name" id="agency_name" placeholder="<?= $this->lang->line("name")?>">
               </div>
            </div>
            <div class="form-group">
               <label for="agency_tel" class="col-sm-3 control-label"><?= $this->lang->line("tel")?></label>
               <div class="col-sm-8">
                  <input data-parsley-required="false" data-parsley-error-message="This field required!" clear_a_element type="text" class="form-control" name="agency_tel" id="agency_tel" placeholder="<?= $this->lang->line("tel")?>">
               </div>
            </div>
            <div class="form-group">
               <label for="agency_email" class="col-sm-3 control-label"><?= $this->lang->line("email")?> </label>
               <div class="col-sm-8">
                  <input data-parsley-required="false" data-parsley-error-message="This field required!" clear_a_element type="e-mail" class="form-control" name="agency_email" id="agency_email" placeholder="<?= $this->lang->line("email")?>">
               </div>
            </div>
            <div class="form-group">
               <label for="address" class="col-sm-3 control-label"><?= $this->lang->line("address")?></label>
               <div class="col-sm-8">
                  <textarea style="resize: none;" clear_a_element rows="3" class="form-control" name="address" id="address" placeholder="<?= $this->lang->line("address")?>"></textarea>
               </div>
            </div> 
            <div class="form-group">
               <label for="note" class="col-sm-3 control-label"><?= $this->lang->line("note")?></label>
               <div class="col-sm-8">
                  <textarea style="resize: none;" clear_a_element rows="3" class="form-control" name="note" id="note" placeholder="<?= $this->lang->line("note")?>"></textarea>
               </div>
            </div>                   
             
            </form>
      </div>
      <div class="modal-footer">
         <?php if ($this->green->gAction("C")){ ?>
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
            <th style="text-align: center;vertical-align: middle;">Code</th>
            <th style="text-align: center;vertical-align: middle;">Name</th>
            <th style="text-align: center;vertical-align: middle;">Tel</th>
            <th style="text-align: center;vertical-align: middle;">E-mail</th>
            <th style="text-align: center;vertical-align: middle;">Address</th>
            <th style="text-align: center;vertical-align: middle;">Note</th>
            <th style="text-align: center;vertical-align: middle;">Type</th>
         </tr>
      </thead>
      <tbody>      

      </tbody>
      <tfoot>
         
      </tfoot>
   </table>
</div>

<style type="text/css">
   .agency_code>a, .agency_name>a, .agency_is_group>a{text-decoration: none;display: block;} 
   a#add_new{display: block;}
   #grid.edit, #grid.del{display: block;}
	th{vertical-align: middle;margin: 0;padding: 0;}
	td{vertical-align: middle;margin: 0;padding: 0;}
</style>

<script type="text/javascript">
	$(function(){

      // tooltip ====      
      $('#a_search').tooltip({title: 'show / hide Search'})
      $('#export').tooltip({title: 'Export'})
      $('#print').tooltip({title: 'Print'})
      
      $('body').delegate('', 'mouseover', function(){
         $('#search_agen_code').tooltip({title: 'Search by Agency Code'})
      });
      $('#search_agen_name').tooltip({title: 'Search by Agency Name'})
      $('#search_agen_group').tooltip({title: 'Search by Agency or Group'})

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

      // destroy parsley =======      
      $('#close_bottom, #close_top').on('click', function(){  
         $('form#f_save').parsley().destroy();
      });

      // $('body').delegate('#agency_is_group', 'click', function(){
      //    if($(this).prop("checked")==true){
      //       $(this).val(1);
      //    }else{
      //       $(this).val(0);
      //    }

      // });


      // save =======      
      $('.save').on('click', function(){
         var save_close = $(this);
         if($('#f_save').parsley().validate()){
            $.ajax({
               url: "<?= site_url('setup/cagency/save') ?>",
               type: "POST",
               dataType: "JSON",
               beforeSend: function(){
                  $('#loading_header').show();
               },
               // async: false,
               data: {
                  agency_typeno:$('#agency_typeno').val(),
                  agency_code: $('#agency_code').val(),
                  agency_name: $('#agency_name').val(),
                  agency_tel: $('#agency_tel').val(),
                  agency_email: $('#agency_email').val(),
                  address: $('#address').val(),
                  note: $('#note').val(),
                  agency_is_group: $('#tour_class').val()                             
               },
               success: function(data){              
                  if(data.arr.success == 'true'){
                     clear_a_element();                                                                                                                                                                                                      $('#set_sort').attr('data-order');
                     grid(1, $('#total_display').val() - 0, $('#set_sort').attr('data-fd'), $('#set_sort').attr('data-order'));                                     
                     $('#success').show();
                     setTimeout(function(){                     
                        $('#success').hide();
                     }, 1000);
                     if(save_close.attr('data-close') == 'true'){
                        $('#myModal').modal('hide')                                               
                     }
                  }else{
                     alert('Duplicate' + ' ' + "'" + $('#agency_code').val() + "'" + '!')
                     $('#agency_code').select();
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
			var agency_typeno = $(this).parent().parent().find(this).data('id');
         $('#agency_name').css({border: ''});
			$.ajax({
   			url: "<?= site_url('setup/cagency/edit') ?>",
   			type: "POST",
   			dataType: "JSON",
   			beforeSend: function(){
               $('#loading_header').show();
   			},
   			// async: false,
   			data: {
   				agency_typeno: agency_typeno
   			},
   			success: function(data){
               $('#agency_typeno').val(data.agency_typeno);
   				$('#agency_code').val(data.agency_code);
   				$('#agency_name').val(data.agency_name);
               $('#agency_tel').val(data.tel);
               $('#agency_email').val(data.email);
   				$('#address').val(data.address);               
   				$('#note').val(data.note);
               
               $('#tour_class').val(data.is_agency-0);
               
               $('#title').text('update Agencys');
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
         var agency_typeno = $(this).parent().parent().find(this).data('id');
         if(confirm('Are you sure to delete?')){
            $.ajax({
               url: "<?= site_url('setup/cagency/delete') ?>",
               type: "POST",
               dataType: "JSON",
               beforeSend: function(){
                  $('#loading_header').show();
               },
               // async: false,
               data: {
                  agency_typeno: agency_typeno
               },
               success: function(data){
                  if(data.success == 'true'){
                     // if(confirm('Are you sure to delete?')){
                        clear_search();
                        var fd = $('#set_sort').attr('data-fd');
                        var order = $('#set_sort').attr('data-order');
                        grid(1, $('#total_display').val() - 0, fd, order); 
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
         $('#myModal').modal({backdrop: 'static'})
         $("#sub_myModal").draggable({
            handle: ".modal-header"
         });
         $('#title').text('Agency');
         clear_a_element();
         $('#agency_code').focus();  
         $('#agency_code').css({border: ''});
        
      });

      // focusin ======
      $('#search_agen_name').on('focus', function(){         
         $(this).select();
      });
      $('#search_agen_code').on('focus', function(){         
         $(this).select();
      });
      $('#search_agen_group').on('focus', function(){         
         $(this).select();
      });

      // clear search ======
      $('#btn_clear').on('click', function(){         
         $('#search_agen_name').val('');
         $('#search_agen_code').val('');
         //$('#search_agen_group').val('');         
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
      $('.agency_name').attr('data-order', 'DESC');
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
         $('#search_agen_name').val('');
         $('#search_agen_code').val('');
         var fd = $('#set_sort').attr('data-fd');
         var order = $('#set_sort').attr('data-order');
         grid(1, $('#total_display').val() - 0, fd, order);
      });

      // export ======
      $("body").delegate("a#export","click",function(){
         $('#tbl_data').find('caption').html('<center><b>Agency List</b></center>');
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

	}); // ready =====

   // print or export ======
   function fn_pr_ex(){
     // $(".remove_inv").remove();
     // var htmlToPrint = ''+'<style type="text/css">' +
     //                        'table th, table td {' +
     //                        'border:1px solid #000 !important;' +
     //                        'padding;0.5em;' +
     //                        '}' +
     //                        '</style>';
     var title = "<center style='font-weight:bold; font-size:16px;'>Agencys List</center>";
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
		$('#search_agen_name').val('');
      $('#search_agen_code').val('');
	}

	// show data ======
	function grid(current_page, total_display, fd, order){
      offset = ((current_page - 1) * total_display) - 0;
      limit = total_display - 0;
		$.ajax({
			url: "<?= site_url('setup/cagency/grid') ?>",
			type: "POST",
			dataType: "JSON",
			beforeSend: function(){
            $('#loading_header').show();
			},
			// async: false,
			data: {
            search_agen_name: $('#search_agen_name').val(),
            search_agen_code: $('#search_agen_code').val(),
            search_agen_group: $('#search_agen_group').val(),                         
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
									"<td>"+ (row.agency_code != null ? row.agency_code : '') +"</td>"+
									"<td>"+ (row.agency_name != null ? row.agency_name : '') +"</td>"+
                           "<td>"+ (row.tel != null ? row.tel : '') +"</td>"+
									"<td>"+ (row.email != null ? row.email : '') +"</td>"+
                           "<td>"+ (row.address != null ? row.address : '') +"</td>"+
                           "<td>"+ (row.note != null ? row.note : '') +"</td>"+
                           "<td>"+ (row.is_agency == 0 ? 'Group':(row.is_agency == 1?'Agency':(row.is_agency == 2?'School':'Organization'))) +"</td>"+
                           "<td class='remove_tag' style='text-align: center;'>";
                  // condition ======      
                  if("<?php echo $this->green->gAction('U') ?>"){
                     tr += "<a href='javascript: void(0)' class='edit' data-id='"+ row.agency_typeno +"'><img width='15px' height='15px' src='<?= base_url("assets/images/icons/edit.png") ?>'></a>";
                  }  
                  tr += "</td>";
                  tr += "<td class='remove_tag' style='text-align: center;'>";
                  if("<?php echo $this->green->gAction('D') ?>"){ 
                     tr += "<a href='javascript: void(0)' class='del' data-id='"+ row.agency_typeno +"'><img width='15px' height='15px' src='<?= base_url("assets/images/icons/delete.png") ?>'></a>";
                  }
                  // ===============
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