<?php
include("conexion.php");

$id=$_GET["id"];
$fecha=$_GET["fecha"];
$operacion=$_GET["operacion"];
$bodega=$_GET["bodega"];
$cantidad=$_GET["cantidad"];

$link=Conectar();
$query="insert into descargabodegas (id, fecha, operacion, bodega, cantidad) values ('$id', '$fecha', '$operacion', '$bodega', '$cantidad')";
	mysql_query($query, $link);
	mysql_close($link);
	?>
	<script>	
	top.listaFrame.location.reload()
	</script>
	<?php
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles.css" rel="stylesheet" type="text/css" />

<title>b5</title>
</head>

<body class="texto">
id=<?php echo $id; ?><br />
Registro Agregado.<br />
Seleccione alguna de las siguientes opciones:<br />
Registrar otra operación de Bodega:
<form name="productoForm" target="formFrame" method="get" action="b1.php">
<input type="hidden" name="id" value="<?php echo $id; ?>"  />
<input type="submit" name="agregar" id="agregar" value="Si" class="textoField" />
</form><br />
Registrar otra operación distinta:<br />
(por bodega, por producto o por recibidor).<br />
<form name="productoForm" target="formFrame" method="get" action="d1.php">
<input type="hidden" name="id" value="<?php echo $id; ?>"  />
<input type="submit" name="agregar" id="agregar" value="Continuar" class="textoField" />
</form>
</body>
</html>