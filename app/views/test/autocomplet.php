	<div class="container">				
		<input type="text" id="test_date">
		<input type="text" name="search" id="search">		
	</div>
	
	<script type="text/javascript">
		
		var url="<?php echo base_url("test/welcome/ajax")?>";
		var url1="<?php echo base_url("test/welcome/autoData")?>";
			 
		 $(function(){			
			$("#test_date").datepicker();
			$.ajax({
				url:url,
				type:"post",
				dataType:"Json",
				async:false,
				success:function(re){
					//alert(re.re);					
				}				
			});			
			
			$("#search").autocomplete({
				source: url1,
				minLength:0,
				select: function( event, ui ) {
					
				}						
			});
				
		})
		
		
		
		
	</script>

	