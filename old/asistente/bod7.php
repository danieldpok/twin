<?php
$id=$_GET["id"];
$bodega=$_GET["bodega"];
$producto=$_GET["producto"];
$abreviacion=$_GET["abreviacion"];
$pesototal=$_GET["pesototal"];
$cantidad1=$_GET["cantidad1"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles.css" rel="stylesheet" type="text/css" />

<title>bod7</title>
</head>

<body class="texto">
id=<?php echo $id; ?><br />
A continuación escriba el peso que se descargara en el segundo puerto:<br />
<form name="producto" target="formFrame" method="get" action="bod8.php">
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="bodega" value="<?php echo $bodega; ?>" />
<input type="hidden" name="producto" value="<?php echo $producto; ?>" />
<input type="hidden" name="abreviacion" value="<?php echo $abreviacion; ?>" />
<input type="hidden" name="pesototal" value="<?php echo $pesototal; ?>" />
<input type="hidden" name="cantidad1" value="<?php echo $cantidad1; ?>" />
<input type="text" name="cantidad2" size="10"  />MT.
<br />Haga clic en siguiente para continuar:
<br />
<input type="submit" name="agregar" id="agregar" value="Siguiente" class="textoField" />
</form>
<table>
<tr>
    <td>Bodega:</td>
    <td><?php echo $bodega; ?></td>
</tr>
<tr>
    <td>Producto:</td>
    <td><?php echo $producto; ?></td>
</tr>
<tr>
    <td>Abreviacion:</td>
    <td><?php echo $abreviacion; ?></td>
</tr>
<tr>
    <td>Peso Total:</td>
    <td><?php echo $pesototal; ?></td>
</tr>
<tr>
    <td>Cantidad Primer Puerto:</td>
    <td><?php echo $cantidad1; ?></td>
</tr>
</table>
</body>
</html>
