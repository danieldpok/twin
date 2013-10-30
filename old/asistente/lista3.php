<?php
include("conexion.php");
$id=$_GET["id"];
$link = Conectar();
if(isset($_POST["delete"]))	{
	
	$query="delete from computotiempo where idcomputoTiempo='".$_POST["idcomputotiempo"]."'";
	mysql_query($query, $link);
	$id=$_POST["id"];
	
}else if(isset($_POST["save"]))	{
	
	$id=$_POST["id"];
	$fecha=$_POST["fecha"];
	$hinicial=$_POST["hinicial"];
	$hfinal=$_POST["hfinal"];
	$fact=$_POST["fact"];
	$timepercent=$_POST["timepercent"];
	$clasif=$_POST["clasif"];
	
	$query="update computotiempo set fecha='$fecha', hinicial='$hinicial', hfinal='$hfinal', fact='$fact', timepercent='$timepercent', clasif='$clasif' where idcomputoTiempo='".$_POST["idcomputotiempo"]."'";
		
	mysql_query($query, $link);	
}
mysql_close($link);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<link href="styles.css" rel="stylesheet" type="text/css" />
</head>
<table width="954" border="1" class="texto2">
            <tr bgcolor="#0000FF" class="titulo3">
              <td width="60">Fecha</td>
              <td width="40">H.Inicial</td>
              <td width="34">H.Final</td>
              <td width="144">Tipo</td>
              <td width="226">Clasificación</td>
              <td width="277">Fact</td>
              <td width="54">% to Discount</td>
              <td width="67">Option</td>
            </tr>
            <?php
			//OBTENER LOS HECHOS
			$link = Conectar();
			$query = "select * from computotiempo where id='".$id."' order by fecha, tipo, hinicial, hfinal";
			$result = mysql_query($query, $link);
			$ix=1;
			$fechaAnterior="start";
			while($row = mysql_fetch_array($result)) {
			if($row["fecha"]!=$fechaAnterior and $fechaAnterior!="start")	{
				$fechaAnterior=$row["fecha"];
				?>
				</table>
				<HR>
				<table width="954" border="1">
				<?php
			} else if($fechaAnterior=="start")	{
				$fechaAnterior=$row["fecha"];
			}
			?>
            <form name="form<?php echo $ix; ?>" id="form<?php echo $ix; ?>" method="post" action="lista3.php#<?php echo $ix; ?>">
            <tr bgcolor="#00CCFF">
              <td>
              <label>
                <input type="text" name="fecha" id="fecha" value="<?php echo $row["fecha"]; ?>" size="10" class="texto2"/>
              </label>
</td>
              <td>
              <label>
                <input type="text" name="hinicial" id="hinicial" value="<?php echo $row["hinicial"]; ?>" size="5" class="texto2"/>
              </label>
</td>
              <td>
              <label>
                <input type="text" name="hfinal" id="hfinal" value="<?php echo $row["hfinal"]; ?>" size="5" class="texto2"/>
              </label>
</td>              
              <td class="texto2"><a name="<?php echo $ix; ?>" id="<?php echo $ix; ?>"></a>
              <input type="hidden" name="id" value="<?php echo $id; ?>" />
              <input type="hidden" name="idcomputotiempo" value="<?php echo $row["idcomputoTiempo"]; ?>" /><?php echo $row["tipo"]; ?></td>
              <td><?php //if($row["clasif"]!="null") echo $row["clasif"]; ?>
                <label>
                  <select name="clasif" id="clasif" style="width:250px" class="texto2">
                  <option value="" >Seleccionar...</option>
                  <?php
				  $query = "select clasificacion from clasificacion order by clasificacion";
					$resultx = mysql_query($query, $link);
					while($rowx = mysql_fetch_array($resultx)) {
						if($rowx["clasificacion"]==$row["clasif"])
							echo "<option value=\"".$rowx["clasificacion"]."\" selected=\"selected\">".$rowx["clasificacion"]."</option>";
						else
							echo "<option value=\"".$rowx["clasificacion"]."\" >".$rowx["clasificacion"]."</option>";

					}
				  ?>
                  </select>
              </label></td>
<td>
                <label>
                  <textarea name="fact" cols="40" id="fact" class="texto2"><?php echo $row["fact"]; ?></textarea>
                </label>
              </td>
<td>
                <label>
                <?php
				if($row["timepercent"]!="null")	{
					$time=$row["timepercent"];
				}	else	{
					$time="";
				}
				
				?>
                  <input type="text" name="timepercent" id="timepercent" value="<?php echo $time; ?>" size="5" class="texto2"/>
                </label>
</td>
              <td>              
                <label>
                  <input type="submit" name="save" id="save" value="Guardar" class="texto2"/>
                </label>
                <label>
                  <input type="submit" name="delete" id="delete" value="Eliminar" class="texto2"/>
              </label></td>
            </tr>
            </form>         
          <?php
		  $ix++;
		}
		mysql_close($link);
		?>
</table>
<body>
</body>
</html>