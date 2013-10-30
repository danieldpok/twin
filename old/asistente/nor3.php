<?php
include("conexion.php");
$link = Conectar();

$id=$_GET["id"];
$agencia=$_GET["agencia"];
$recibidor=$_GET["recibidor"];


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles.css" rel="stylesheet" type="text/css" />

<title>Nor3</title>
</head>

<body class="texto">
id=<?php echo $id; ?><br />
Seleccione un Estibador de la lista:<br />
<form name="recibidor" target="formFrame" method="get" action="nor4.php">
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="agencia" value="<?php echo $agencia ?>" />
<input type="hidden" name="recibidor" value="<?php echo $recibidor ?>" />
<select name="estibador" class="textoField">
<?php
	$query = "select * from estibadores order by estibador";
	$rs = mysql_query($query, $link);
	while($row = mysql_fetch_array($rs)){
?>
  <option value="<?php echo $row["estibador"]; ?>"><?php echo $row["estibador"]; ?></option>
  <?php
	}
	mysql_close($link);
  ?>
</select>
<input type="submit" name="agregar" id="agregar" value="Siguiente" class="textoField" />
</form>
Si el Estibador no aparece en la lista, escriba el nombre a continuación y haga clic en Agregar:<br />
<form name="addEstibador" target="actionFrame" method="post" action="actions.php">
<input type="hidden" name="action" value="agregarEstibador" />
<input type="text" name="estibador" class="textoField" size="100" />
<input type="submit" name="agregar" id="agregar" value="Agregar" class="textoField"/>
</form>
<table>
<tr>
<td>
Agencia Aduanal:
</td>
<td>
<?php echo $agencia; ?>
</td>
</tr>
<tr>
<td>
Recibidor:
</td>
<td>
<?php echo $recibidor; ?>
</td>
</tr>
</table>
</body>
</html>