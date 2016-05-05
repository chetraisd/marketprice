<?php


?>
<div class="wrapper">
    <div class="clearfix" id="main_content_outer">
        <div id="main_content">
            <div class="row result_info">
                <div class="col-xs-3">
                    <strong id='title'>DASHBOARD</strong>
                </div>
                <div class="col-xs-9" style="text-align: right">
		      		<span class="top_action_button">
							 
			    	</span>
			    	<span class="top_action_button">	
			    		<a href="#" id="export" title="Export">
                            <img src="<?php echo base_url('assets/images/icons/export.png') ?>"/>
                        </a>
			    	</span>
		      		<span class="top_action_button">
						<a href="#" id="print" title="Print">
                            <img src="<?php echo base_url('assets/images/icons/print.png') ?>"/>
                        </a>
		      		</span>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">Search</h4>
                        </div>


                    </div>
                    <div class="row" id='tab_print'>


                    </div>
                </div>
            </div>
            <script type="text/javascript">


                function gsPrint(emp_title, data) {
                    var element = "<div id='print_area'>" + data + "</div>";
                    $("<center><p style='padding-top:15px;text-align:center;'><b>" + emp_title + "</b></p><hr>" + element + "</center>").printArea({
                        mode: "popup",  //printable window is either iframe or browser popup
                        popHt: 1000,  // popup window height
                        popWd: 1024,  // popup window width
                        popX: 0,  // popup window screen X position
                        popY: 0, //popup window screen Y position
                        popTitle: "test", // popup window title element
                        popClose: false,  // popup window close after printing
                        strict: false
                    });
                }
                $(function () {
                    $("#s_date,#e_date").datepicker({
                        language: 'en',
                        pick12HourFormat: true,
                        format: 'yyyy-mm-dd'
                    });
                    $("#print").on("click", function () {
                        var title = "<h4 align='center'>" + $("#title").text() + "</h4>";
                        var data = $("#tab_print").html().replace(/<img[^>]*>/gi, "");
                        var data_print = $("<div>" + data + "</div>").html().replace(/<A[^>]*>|<\/A>/gi, "");
                        var export_data = $("<center>" + data_print + "</center>").clone().find(".remove_tag").remove().end().html();

                        gsPrint(title, export_data);
                    });
                    $("#export").on("click", function (e) {
                        var data = $("#tab_print").html().replace(/<img[^>]*>/gi, "");
                        var export_data = $("<center><h3 align='center'>DASHBOARD</h3>" + data + "</center>").clone().find(".remove_tag").remove().end().html();
                        window.open('data:application/vnd.ms-excel,' + encodeURIComponent(export_data));
                        e.preventDefault();
                    });
                })
                function search() {
                    var yearid = $('#s_year').val();
                    var s_date = $('#s_date').val();
                    var e_date = $('#e_date').val();
                    var s_minage = $('#s_minage').val();
                    var s_maxage = $('#s_maxage').val();

                    location.href = "<?PHP echo site_url('system/dashboard/search');?>/" + yearid + '/' + s_date + '/' + e_date + '/' + s_minage + '/' + s_maxage;
                }
            </script>