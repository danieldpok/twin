<?php
include("conexion.php");
$id=$_GET["id"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<link href="styles.css" rel="stylesheet" type="text/css" />
</head>
<table width="1087" border="1" bordercolor="#CCCCCC" >
      <tr bgcolor="#0000FF" class="titulo3">
      <td>AGENCIA ADUANAL</td>
      <td>RECIBIDOR</td>
      <td>ESTIBADOR</td>
      <td>OPERACION</td>
      <td>PRODUCTO</td>
      <td>UNIDAD</td>
      <td>PESO UNIDAD</td>
      <td>CANTIDAD UNIDADES</td>
      <td>PESO TOTAL</td>
      <td>BL(S)</td>
      <td>eliminar</td>
      </tr>
      <?php
	  
	$link = Conectar();
	$query = "select * from chargeinformation where id='$id'";
	$rs = mysql_query($query, $link);
	while($row = mysql_fetch_array($rs)){
	  
	  ?>
      <tr class="texto2">
      <td><?php echo $row["agencia"]; ?></td>
      <td><?php echo $row["recibidor"]; ?></td>
      <td><?php echo $row["estivador"]; ?></td>
      <td><?php echo $row["operacion"]; ?></td>
      <td><?php echo $row["producto"]; ?></td>
      <td><?php echo $row["unidad"]; ?></td>
      <td><?php echo $row["pesounidad"]; ?></td>
      <td><?php echo $row["cantidadunidades"]; ?></td>
      <td><?php echo $row["pesoneto"]; ?></td>
      <td><?php echo $row["bl"]; ?></td>
      <td><a href="actions.php?action=delete&table=chargeinformation&field=idchargeinformation&value=<?php echo $row["idchargeinformation"]; ?>" target="actionFrame" >eliminar</a></td>
      </tr>
      <?php
	  $tots+=str_replace(",","",$row["pesoneto"]);
	}
	mysql_close($link);
	  ?>
      <tr class="texto2">
      <td>TOTALES:</td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td><?php printf("%.3f", $tots); ?></td>
      <td></td>
      <td><a href="actions.php?action=delete&table=chargeinformation&field=idchargeinformation&value=<?php echo $row["idchargeinformation"]; ?>" target="actionFrame" >eliminar</a></td>
      </tr>
      </table>
<body>
</body>
</html>