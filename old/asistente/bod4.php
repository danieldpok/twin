<?php
$id=$_GET["id"];
$bodega=$_GET["bodega"];
$producto=$_GET["producto"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles.css" rel="stylesheet" type="text/css" />

<title>bod4</title>
</head>

<body class="texto">
id=<?php echo $id; ?><br />
A continuación escriba el nombre abreviado del producto:<br />
"<?php echo $producto; ?>"<br />
<form name="producto" target="formFrame" method="get" action="bod5.php">
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="bodega" value="<?php echo $bodega; ?>" />
<input type="hidden" name="producto" value="<?php echo $producto; ?>" />
<input type="text" name="abreviacion" size="10"  />
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
</table>
</body>
</html>
