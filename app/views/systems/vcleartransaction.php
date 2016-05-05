<div class="wrapper">
    <div class="col-sm-12">
        <div class="row result_info">
            <div class="col-xs-6"><h5>Clear Data</h5></div>
        </div>
    </div>
    <div class="col-sm-12">
        <p class="bg-success del-message"></p>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading"><b>Please select what do you want to clear </b> </div>
            <div class="panel-body">
                <form action="" method="post">
                    <div class="form-group">
                        <input type="checkbox" id="alltrans" value="alltrans" class="ch_clear">
                        <label for="alltrans">Clear all transaction</label>
                    </div>

                    <div class="form-group ">
                        <input type="button" value="Clear" id="clear" class="btn btn-danger">
                    </div>
                </form>
            </div>
            <div class="panel-footer"><br/></div>
        </div>



    </div>
    <div class="col-xs-6">

    </div>
</div>

<script type="text/javascript">
    $(function(){
        $("body").delegate("#clear","click",function(){
            var ch_clear=[];
            $(".ch_clear:checked").each(function(e){
                ch_clear[e]=$(this).val();
            })
            if(ch_clear.length>0){
                if(confirm("Sure ! Do you want to delete select data?")){
                    $.ajax({
                        url:"<?php echo site_url("systems/sys/deletedata")?>",
                        type:"POST",
                        dataType:"Json",
                        data:{ch_clear:ch_clear},
                        async:false,
                        success:function(data){
                            if(data.del==1){
                                $(".del-message").text("Selected date was deleted.").fadeIn(1000).fadeOut(1000);
                            }
                        }
                    })
                }
            }else
            {
                alert("Please select type of data first.");
            }
        })
    });
</script>