<?php
include("conexion.php");
$link = Conectar();

$id=$_GET["id"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles.css" rel="stylesheet" type="text/css" />

<title>nor1</title>
</head>

<body>
<p class="texto">id=<?php echo $id; ?><br />
Seleccione una Agencia Aduanal de la lista:<br />
<form name="agencia" target="formFrame" method="get" action="nor2.php">
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<select name="agencia" class="textoField">
<?php
	$query = "select * from agenciasaduanales order by agencia";
	$rs = mysql_query($query, $link);
	while($row = mysql_fetch_array($rs)){
?>
  <option value="<?php echo $row["agencia"]; ?>"><?php echo $row["agencia"]; ?></option>
  <?php
	}
	mysql_close($link);
  ?>
</select>
<input type="submit" name="agregar" id="agregar" value="Siguiente" class="textoField" />
</form>
</p>
<p class="texto">Si la Agencia no aparece en la lista, escriba el nombre a continuación y haga clic en Agregar:<br />
<form name="addAgency" target="actionFrame" method="post" action="actions.php">
<input type="hidden" name="action" value="agergarAgencia" />
<input type="text" name="agencia" class="textoField" size="100" />
<input type="submit" name="agregar" id="agregar" value="Agregar" class="textoField"/>
</form>
</p>
</body>
</html>