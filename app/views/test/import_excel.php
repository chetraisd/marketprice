

<center>
<form method="post" enctype="multipart/form-data" action="<?php echo base_url().'test/welcome/importexcel'?>">
<div class="Form_Action">   
   <center>
    <table>
        <tr>
            <td id="file_style">
            	<input type="file" name="file[]"/>
            </td>
            <td></td>
        </tr>
        <tr>
            <td>
             
                <input type="submit" value="Import" name="submit"/>            
                <input type="submit" value="Export template" id="submit" name="excel" />            
            </td>
        </tr>
    </table>
    </center>
</div>
</form>
</center>

<script type="text/javascript">
	
</script>