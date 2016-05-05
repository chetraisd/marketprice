<div class="wrapper">
	<div class="col-sm-12">
    	<div class="row result_info">
        	<div class="col-xs-6"><h5>Tran Turnstile</h5></div>
       		<div class="col-xs-6" align="right">
                <?php if($this->green->gAction("R")){ ?>
                    <a href="javascript:void(0)" id="a_search" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><img src="<?= base_url()."assets/images/icons/searchs.png"?>" width="25"></a>
                <?php } ?>
                <?php if($this->green->gAction("E")){ ?>
                    <a href="javascript:void(0)" id="a_export"rch><img src="<?= base_url()."assets/images/icons/exports.png"?>" width="25"></a>
                <?php } ?>
                <?php if($this->green->gAction("P")){ ?>
                    <a href="javascript:void(0)" id="a_print"><img src="<?= base_url()."assets/images/icons/prints.png"?>" width="25"></a>
                <?php } ?>
            </div>
        </div>
        <div class="row collapse" id="collapseExample">
        	<div class="col-sm-12">
             	<div class="col-sm-3">
                    <label class="control-label">From date</label>
                    <input type="text" placeholder="" id="from_date" class="form-control input-xs" value="<?php echo $this->green->gdate_format();?>"/>
                </div>
                <div class="col-sm-3">
                    <label class="control-label">To date</label>                        
                    <input type="text" placeholder="" id="to_date" class="form-control input-xs" value="<?php echo $this->green->gdate_format();?>"/>
                </div>
                <div class="col-sm-3">
                    <label class="control-label">Turnstile</label>                        
                    <!-- <input type="text" placeholder="" id="turnstile_auto" class="form-control input-xs" /> -->
                    <select id="turnstile_auto" class="form-control input-xs">
                        <?php echo $search_turnstile; ?>
                    </select>
                </div>
                <div class="col-sm-3">
                    <label class="control-label">&nbsp;</label>
                    <div class="input-xs">
                        <button type="button" id="search" class="btn btn-primary">Search</button>
                        <button type="button" id="refresh" class="btn btn-warning">Refresh</button>
                    </div>
                </div>
            </div>
    	</div>
        <br>

        <div class="table-responsive" id="dv-print">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Turnstile</th>
                        <th>Date</th>
                        <th>New Value</th>                        
                        <th>Old Value</th> 
                        <th>Changed</th>
                        <th>Checked Ticket</th>
                        <th>Checked vs Turnstile</th>
                        <th>Status</th> 
                                             
                        <th class="th_add remove_tag" style="text-align:center;">
                            <?php if($this->green->gAction("C")){ ?>
                                <div id="add" style="width:100%"><img src="<?= base_url('assets/images/icons/adds.png') ?>" width="25px;">
                            <?php } ?>
                        </th>
                    </tr>
                </thead>
                <tbody id="show_tbl">
                    
                </tbody>
            </table>
        </div>
    </div>   
</div>



<!-- modal  -->

<div class="modal" id="myModal_tran_turnstile" role="dialog">
    <form role="form"  id="form_validate">
    <div class="modal-dialog" id="dialog_tran_turnstile">
        <div class="modal-content">
        <form id="form_validate">
            <div class="modal-header  move_modal" >
                <span id="title_modal">Form Turnstile</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>            
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Turnstile</label>
                            <select class="form-control " id="select_turnstile" data-parsley-required="true" data-parsley-error-message="This field required !">
                               <?php 
                                    echo $option_turnstile;
                               ?>
                            </select>
                            <input type="hidden" id="hdd_par_typeno">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Date</label>
                            <input type="text" id="input_date" class="form-control input-xs" value="<?php echo date('Y-m-d')?>"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Old Value</label>
                            <input type="text" id="old_value" class="form-control input-xs" placeholder=" " data-parsley-required="true" data-parsley-error-message="This field required !"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">New Value</label>
                            <input type="text" id="new_value" class="form-control input-xs" placeholder=" " data-parsley-required="true" data-parsley-error-message="This field required !"/>
                        </div>                       
                        
                    </div>
                </div> 
            </div>
            <div class="modal-footer move_modal">
                <?php if ($this->green->gAction("C")){ ?>
                    <button type="button" id="save" class="btn btn-primary save_turnstile">Save</button>
                    <button type="button" class="btn btn-primary save_turnstile" saveclose="close">Save Close</button>
                <?php } ?>
                <button type="button" id="cancel" class="btn btn-warning" data-dismiss="modal">Cancel</button>
            </div>
        </div>
        </form>
    </div>
    </div>
    </form>
</div>

<style type="text/css">
    .modal_duplicate{top: 25%} 
    .text_duplicate{ color: red; font-size: 16px; text-align: center; top:30%;}
    .sort_data,.th_no{ color: #337ab7;}
    .sort_data:hover{ 
        /*box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(102, 175, 233, 0.6); */
        /*border-color: #66afe9; border-radius: 5px; cursor: pointer; color: #337ab7;*/
    }
    .th_add:hover{ box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(102, 175, 233, 0.6); 
                    border-color: #66afe9; cursor: pointer;
                }
    #title_modal{ color : #337ab7; text-align : left; font-size: 18px}

</style>

<script type="text/javascript"> 
    $(function(){ 

        var show = new pro_tran_turnstile();
        show.show_list_turnstile();

        $('#from_date,#to_date,#input_date').datepicker({
            forceParse: false,
            format: 'yyyy-mm-dd',
            autoclose: true
        });

        $('body').delegate('.th_add','click',function(){ 
            $('#form_validate').parsley().destroy();
            $('#myModal_tran_turnstile').modal({backdrop : 'static',});
        });

        $('body').delegate('#select_turnstile','change',function(){
            var value_old = new pro_tran_turnstile();
            value_old.select_old_value($(this).val());

            var par_typeno =  $(this).find(':selected').attr('par_typeno');
            $('#hdd_par_typeno').val(par_typeno);
        });

        $('body').delegate('.save_turnstile','click',function(){

            if($('#form_validate').parsley().validate()){ 
                var save = new pro_tran_turnstile();
                save.save_turnstile($(this).attr('saveclose'));
            }
        });

        $('body').delegate('#new_value','change',function(){ 
            if($(this).val() !=''){ 
                if($(this).val()-0 < $('#old_value').val()-0){ 
                    alert('New value < old_value');
                    $(this).val('');
                } 
            }
        });

    });

    function pro_tran_turnstile(){ 
        this.from_date = $('#from_date').val();
        this.to_date = $('#to_date').val();
        this.turnstile_auto = $('#turnstile_auto').val();

        this.select_turnstile = $('#select_turnstile').val();
        this.hdd_par_typeno = $('#hdd_par_typeno').val();
        this.new_value = $('#new_value').val();       
        this.select_status = $('#select_status').val();

        this.select_old_value = function old_value(this_typeno){ 
            $.ajax({ 
                type : 'POST',
                url : "<?= site_url('setup/ctran_turnstile/select_old_value')?>",
                dataType : 'JSON',
                async : false,
                data : { 
                    this_typeno : this_typeno
                },
                success : function(data){ 
                    //console.log(data.to_day);
                    if(data.to_day == $('#input_date').val()){ 
                        alert('This value is duplicate.');
                        $('#select_turnstile').val('');
                        $('#old_value').val('');
                        $('#new_value').val('');
                    }else{ 
                        $('#old_value').val(data.old_value);
                    }
                }
            });
        }

        this.save_turnstile = function save(this_close){ 
            $.ajax({ 
                type : 'POST',
                url : "<?= site_url('setup/ctran_turnstile/save_turnstile'); ?>",
                dataType : 'JSON',
                async : false,
                data : { 
                    select_turnstile : this.select_turnstile,
                    hdd_par_typeno : this.hdd_par_typeno,
                    new_value : this.new_value,                    
                    select_status : this.select_status
                },
                success:function(data){ 
                    //console.log(data);
                    if(this_close == 'close'){ 
                        $('#myModal_tran_turnstile').modal('hide');
                    }
                    if(data.success == 'true'){ 
                        var show = new pro_tran_turnstile();
                        show.show_list_turnstile();
                    }
                }
            });
        }

        this.show_list_turnstile = function show(){ 
            $.ajax({ 
                type : 'POST',
                url  : "<?= site_url('setup/ctran_turnstile/show_list_turnstile')?>",
                dataType : 'JSON',
                async : false,
                data : { 
                    from_date : this.from_date,
                    to_date : this.to_date,
                    turnstile_auto : this.turnstile_auto
                },
                success:function(data){ 
                    // console.log(data);
                    if(data.query.length > 0){ 
                        var tr = '';
                        $.each(data.query,function(i,row){ 
                            if(row.status == 1){ 
                                var status = 'Scan';
                            }else{ 
                                var status = 'Entry';
                            }

                            tr += '<tr>'+
                                '<td>'+(i+1)+'</td>'+
                                '<td>'+(row.counter_name != null ? row.counter_name :'')+'</td>'+
                                '<td>'+(row.count_date != null ? row.count_date :'')+'</td>'+
                                '<td>'+(row.new_value != null ? row.new_value :'')+'</td>'+
                                '<td>'+(row.old_value != null ? row.old_value :'')+'</td>'+
                                '<td>'+(row.changed_value != null ? row.changed_value :'')+'</td>'+
                                '<td>'+(row.actual_checked_ticket != null ? row.actual_checked_ticket :'')+'</td>'+
                                '<td>'+(row.checked_vs_turnstile != null ? row.checked_vs_turnstile :'')+'</td>'+
                                '<td>'+status+'</td>'+
                                '<td></td>'+
                            '</tr>';
                        });

                        
                    }else{ 

                        tr += '<tr>'+
                                '<td colspan="10" align="center"><i style="font-size:16px; color:red;">Sorry, the result not data.</i></td>'+
                            '</tr>'+
                            '<tr>'+ 
                                '<td colspan="10"><td>'
                            '</tr>';
                    }

                    $('#show_tbl').html(tr);
                }
            });
        }

    }


</script>