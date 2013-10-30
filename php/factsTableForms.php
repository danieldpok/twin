<?php
include("bd.php");
$idop = strtolower($_POST["idop"]);

$query = "select clasificacion from clasificacion order by clasificacion";
$result=$bd->Execute($query);
$clas=array();
foreach($result as $row)	{
	$clas[]=$row["clasificacion"];
}

$query="select * from computotiempo where idop='$idop' order by fecha, tipo, hinicial, hfinal";

$result=$bd->Execute($query);

foreach($result as $row)	{
	if($row["timepercent"]!="null")	{
		$time=$row["timepercent"];
	}	else	{
		$time="";
	}
	?>
	<form class="autoFormF">
		<input type="hidden" name="table" id="table" value="computotiempo" />
		<input type="hidden" name="id" id="id" value="<?php echo $row["idcomputotiempo"]; ?>" />
	<table class="form" style="padding: 0px 0px 0px 0px;">
	<tr>		
		<td width="80px"><input type="text" name="fecha" id="fecha" class="date" size="8" value="<?php echo $row["fecha"]; ?>" /></td>
		<td width="70px"><input type="text" name="hinicial" id="hinicial" class="time" size="4" value="<?php echo $row["hinicial"]; ?>"/></td>
		<td width="70px"><input type="text" name="hfinal" id="hfinal" class="time" size="4" value="<?php echo $row["hfinal"]; ?>"/></td>
		<td width="100px"><?php echo $row["tipo"]; ?></td>
		<td width="100px"><select id="clasif" name="clasif" class="inputBlock">				
                    <option value="">Seleccionar...</option>
                    <?php
                    for($i=0; $i<sizeof($clas); $i++)	{
                    	if($row["clasif"]==$clas[$i])
							echo '<option value="'.$clas[$i].'" selected="selected">'.$clas[$i].'</option>';
						else {
							echo '<option value="'.$clas[$i].'">'.$clas[$i].'</option>';
						}
                    }
                    ?>
			</select></td>
		<td ><textarea id="fact" name="fact" cols="80" rows="1"><?php echo $row["fact"]; ?></textarea></td>
		<td width="100px"><input type="text" name="timepercent" id="timepercent" size="2" value="<?php echo $time; ?>"/></td>
		<td width="10px">Eliminar</td>		
	</tr>
	</table>
	</form>
<?php	}	?>
<script type="text/javascript">
	$('.autoFormF input, .autoFormF select, .autoFormF textarea').change(function(){
	        var form = $(this).parents('form:first');
	        var id= form.children('input[name="id"]').val();	        
	        if(id!=undefined && id!="")	{
		        var data = form.serialize();	        
		        autoSave(data);
	       	}
	    });
	    $(function(){
	  	$( ".date" ).datepicker({
		      changeMonth: true,
		      changeYear: true,
		      dateFormat: 'yy-mm-dd'
		    });
	  });
</script>