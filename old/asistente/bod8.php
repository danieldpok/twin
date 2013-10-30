<?php
$id=$_GET["id"];
$bodega=$_GET["bodega"];
$producto=$_GET["producto"];
$abreviacion=$_GET["abreviacion"];
$pesototal=$_GET["pesototal"];
$cantidad1=$_GET["cantidad1"];
$cantidad2=$_GET["cantidad2"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles.css" rel="stylesheet" type="text/css" />

<title>bod8</title>
</head>

<body class="texto">
id=<?php echo $id; ?><br />
Por favor verifique que los Datos sean correctos:<br />
<form name="producto" target="formFrame" method="get" action="bod9.php">
Id:<input type="text" name="id" value="<?php echo $id; ?>" size="5" readonly="readonly" /><br />
Bodega:<input type="text" name="bodega" value="<?php echo $bodega; ?>" size="5" readonly="readonly" /><br />
Producto:<input type="text" name="producto" value="<?php echo $producto; ?>" size="100" readonly="readonly" /><br />
Abreviacion:<input type="text" name="abreviacion" value="<?php echo $abreviacion; ?>" size="10" readonly="readonly" /><br />
Peso Total:<input type="text" name="pesototal" value="<?php echo $pesototal; ?>" size="10" readonly="readonly" />MT.<br />
Cantidad Primer Puerto:<input type="text" name="cantidad1" value="<?php echo $cantidad1; ?>" size="10" readonly="readonly" />MT.<br />
Cantidad Segundo Puerto:<input type="text" name="cantidad2" value="<?php echo $cantidad2; ?>" size="10" readonly="readonly"  />MT.<br />
<br />Haga clic en siguiente para continuar:
<br />
<input type="submit" name="agregar" id="agregar" value="Siguiente" class="textoField" />
</form>
</body>
</html>
