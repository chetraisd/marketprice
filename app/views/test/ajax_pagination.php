<input type="text" id="name" />
<input type="button" id="search" value="Search"/>
<div id="list" class="table-responsive">
	<table id="" class="table">
		<thead>
			<TH>ID</TH>
			<TH>Last Name</TH>
			<TH>First Name</TH>
		</thead>
		<tbody id="tab_list">

		</tbody>
	</table>
</div>
<div id="pagination">

</div>
<script type="text/javascript">
	$(function() {
		$("#search").on("click",function(){
			search(1);
		});	
		$(document).on('click', '.pagenav', function(){
		    var page = $(this).attr("id");
			search(page);			
		});

	});
	function search(page){
		var name=$("#name").val();		
		$.ajax({
			url:"<?php echo site_url('test/welcome/searchStdAjax')?>",
			type:"POST",
			datatype:"Json",
			async:false,
			data:{
				getStd:1,	
				page:page,
				name:name
			},
			success:function(res){
				$("#tab_list").html(res.datas);
				$("#pagination").html(res.paging.pagination);
			}
		});
	}
</script>