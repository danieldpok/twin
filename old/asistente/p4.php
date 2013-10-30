<?php
include("conexion.php");
$id=$_GET["id"];
$fecha=$_GET["fecha"];
$operacion=$_GET["operacion"];
$producto=$_GET["producto"];
$cantidad=$_GET["cantidad"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles.css" rel="stylesheet" type="text/css" />

<title>p4</title>
</head>

<body class="texto">
id=<?php echo $id; ?>
<form name="form1" id="form1" method="get" action="p5.php" target="formFrame">
Por favor verifique que todos los conceptos sean correctos:<br />
Id: <input type="text" name="id" value="<?php echo $id; ?>" readonly="readonly" class="textoField" size="5"  /><br />
Fecha: <input type="text" name="fecha" value="<?php echo $fecha; ?>" readonly="readonly" class="textoField" size="10"  /><br />
Operación: <input type="text" name="operacion" value="<?php echo $operacion; ?>" readonly="readonly" class="textoField" size="20"  /><br />
Producto: <input type="text" name="producto" value="<?php echo $producto; ?>" readonly="readonly" class="textoField" size="5"  /><br />
Cantidad: <input type="text" name="cantidad" value="<?php echo $cantidad; ?>" readonly="readonly" class="textoField" size="10"  /><br />
Por favor haga clic en el boton &quot;siguente&quot; para continuar.<br />
<input type="submit" name="agregar" id="agregar" value="Siguiente" class="textoField" />
</form>
</body>
</html>