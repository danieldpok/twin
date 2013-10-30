<?php
include("conexion.php");
$link = Conectar();

$id=$_GET["id"];
$bodega=$_GET["bodega"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles.css" rel="stylesheet" type="text/css" />

<title>bod3</title>
</head>

<body class="texto">
id=<?php echo $id; ?><br />
A continuación seleccione el producto que contiene la bodega:<br />
<form name="producto" target="formFrame" method="get" action="bod4.php">
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="bodega" value="<?php echo $bodega; ?>" />
<select name="producto" class="textoField">
<?php
	$query = "select distinct producto from chargeinformation where id='$id' order by producto";
	$rs = mysql_query($query, $link);
	while($row = mysql_fetch_array($rs)){
?>
  <option value="<?php echo $row["producto"]; ?>"><?php echo $row["producto"]; ?></option>
  <?php
	}
	mysql_close($link);
  ?>
</select>
<br />Haga clic en siguiente para continuar:
<br />
<input type="submit" name="agregar" id="agregar" value="Siguiente" class="textoField" />
</form>
<table>
<tr>
    <td>Bodega:</td>
    <td><?php echo $bodega; ?></td>
</tr>
</table>
</body>
</html>
