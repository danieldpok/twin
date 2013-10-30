<?php
include("bd.php");
$idop = strtolower($_POST["idop"]);

$query="select idcomputotiempox, fecha, hinicial, hfinal, timepercent, fact, tipo, remarks from computotiempox where idop='$idop' order by fecha, hinicial";

$result=$bd->Execute($query);

foreach($result as $row)	{
	
	?>
	<form class="autoFormF">
		<input type="hidden" name="table" id="table" value="computotiempox" />
		<input type="hidden" name="id" id="id" value="<?php echo $row["idcomputotiempox"]; ?>" />
	<table class="form" style="padding: 0px 0px 0px 0px;">
	<tr>		
		<td width="80px"><input type="text" name="fecha" id="fecha" class="date" size="8" value="<?php echo $row["fecha"]; ?>" /></td>
		<td width="70px"><input type="text" name="hinicial" id="hinicial" class="time" size="4" value="<?php echo $row["hinicial"]; ?>"/></td>
		<td width="70px"><input type="text" name="hfinal" id="hfinal" class="time" size="4" value="<?php echo $row["hfinal"]; ?>"/></td>
		<td width="100px"><input type="text" name="timepercent" id="timepercent" size="2" value="<?php echo $row["timepercent"]; ?>"/></td>
		<td width="150px"><input type="text" id="fact" name="fact" cols="80" value="<?php echo $row["fact"]; ?>" /></td>
		<td width="100px"><?php echo $row["tipo"]; ?></td>
		<td width="200px"><input type="text" id="remarks" name="remarks" value="<?php echo $row["remarks"]; ?>" /></td>
		<td >Eliminar</td>		
	</tr>
	</table>
	</form>
<?php	}	?>
<script type="text/javascript">
	$('.autoFormF input').change(function(){
	        var form = $(this).parents('form:first');
	        var id= form.children('input[name="id"]').val();	        
	        if(id!=undefined && id!="")	{
		        var data = form.serialize();	        
		        autoSave(data);
	       	}
	    });
	  	$( ".date" ).datepicker({
		      changeMonth: true,
		      changeYear: true,
		      dateFormat: 'yy-mm-dd'
		    });
</script>