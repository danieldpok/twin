<?php
include("conexion.php");
$link = Conectar();

$id=$_GET["id"];
$agencia=$_GET["agencia"];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles.css" rel="stylesheet" type="text/css" />

<title>Nor2</title>
</head>

<body class="texto">
id=<?php echo $id; ?><br />
Seleccione un Recibidor/Embarcador de la lista:<br />
<form name="recibidor" target="formFrame" method="get" action="nor3.php">
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="agencia" value="<?php echo $agencia ?>" />
<select name="recibidor" class="textoField">
<?php
	$query = "select * from recibidores order by recibidor";
	$rs = mysql_query($query, $link);
	while($row = mysql_fetch_array($rs)){
?>
  <option value="<?php echo $row["recibidor"]; ?>"><?php echo $row["recibidor"]; ?></option>
  <?php
	}
	mysql_close($link);
  ?>
</select>
<input type="submit" name="agregar" id="agregar" value="Siguiente" class="textoField" />
</form>
Si el Recibidor/Embarcador no aparece en la lista, escriba el nombre a continuación y haga clic en Agregar:<br />
<form name="addRecibidor" target="actionFrame" method="post" action="actions.php">
<input type="hidden" name="action" value="agergarRecibidor" />
<input type="text" name="recibidor" class="textoField" size="100" />
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
</table>
</body>
</html>