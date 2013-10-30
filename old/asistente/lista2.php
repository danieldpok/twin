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
      <td>BODEGA</td>
      <td>PESO TOTAL</td>
      <td>PRODUCTO</td>
      <td>ABREVIACION</td>
      <td>CANTIDAD 1 (PRIMER PUERTO)</td>
      <td>CANTIDAD 2 (SEGUNDO PUERTO)</td>
      <td>eliminar</td>
      </tr>
      <?php
	  
	$link = Conectar();
	$query = "select * from pesobodega where id='$id'";
	$rs = mysql_query($query, $link);
	while($row = mysql_fetch_array($rs)){
	  
	  ?>
      <tr class="texto2">
      <td><?php echo $row["bodega"]; ?></td>
      <td><?php echo $row["pesototal"]; ?></td>
      <td><?php echo $row["producto"]; ?></td>
      <td><?php echo $row["abreviacion"]; ?></td>
      <td><?php echo $row["cantidad1"]; ?></td>
      <td><?php echo $row["cantidad2"]; ?></td>
      <td><a href="actions.php?action=delete&table=pesobodega&field=idpesobodega&value=<?php echo $row["idpesobodega"]; ?>" target="actionFrame" >eliminar</a></td>
      </tr>      
      <?php
	  $total1+=str_replace(",","",$row["cantidad1"]);
      $total2+=str_replace(",","",$row["cantidad2"]);
	  
	}
	  ?>
      <tr class="texto2">
      <td>TOTALES</td>
      <td></td>
      <td></td>
      <td></td>
      <td><?php printf("%.3f", $total1); ?></td>
      <td><?php printf("%.3f", $total2); ?></td>
      <td><a href="actions.php?action=delete&table=pesobodega&field=idpesobodega&value=<?php echo $row["idpesobodega"]; ?>" target="actionFrame" >eliminar</a></td>
      </tr>
      </table>
<body>
</body>
</html>