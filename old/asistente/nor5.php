<?php
include("conexion.php");
//$link = Conectar();

$id=$_GET["id"];
$agencia=$_GET["agencia"];
$recibidor=$_GET["recibidor"];
$estibador=$_GET["estibador"];
$operacion=$_GET["operacion"];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles.css" rel="stylesheet" type="text/css" />

<title>Nor5</title>
</head>

<body class="texto">
id=<?php echo $id; ?><br />
Escriba el nombre del Producto:<br />
<form name="productoForm" target="formFrame" method="get" action="nor6.php">
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="agencia" value="<?php echo $agencia ?>" />
<input type="hidden" name="recibidor" value="<?php echo $recibidor ?>" />
<input type="hidden" name="estibador" value="<?php echo $estibador ?>" />
<input type="hidden" name="operacion" value="<?php echo $operacion ?>" />
<input type="text" name="producto" size="100" class="textoField"  />
<input type="submit" name="agregar" id="agregar" value="Siguiente" class="textoField" />
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

<tr>
<td>
Estibador:
</td>
<td>
<?php echo $estibador; ?>
</td>
</tr>

<tr>
<td>
Operación:
</td>
<td>
<?php echo $operacion; ?>
</td>
</tr>
</table>
</body>
</html>