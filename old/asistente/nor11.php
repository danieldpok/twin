<?php
include("conexion.php");
//$link = Conectar();

$id=$_GET["id"];
$agencia=$_GET["agencia"];
$recibidor=$_GET["recibidor"];
$estibador=$_GET["estibador"];
$operacion=$_GET["operacion"];
$producto=$_GET["producto"];
$bls=$_GET["bls"];
$unidades=$_GET["unidades"];
$peso=$_GET["peso"];
$cantidad=$_GET["cantidad"];
$pesototal=str_replace(",", "", $peso)*str_replace(",", "", $cantidad);

$link = Conectar();
$fields="id, agencia, recibidor, estivador, operacion, producto, unidad, pesounidad, cantidadunidades, pesoneto, bl";
$args="'$id', '$agencia', '$recibidor', '$estibador', '$operacion', '$producto', '$unidades', '$peso', '$cantidad', '$pesototal', '$bls'";
	$query="insert into chargeinformation ($fields) values ($args)";
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

<title>Final</title>
</head>

<body class="texto">
id=<?php echo $id; ?><br />
Registro Agregado, si desea agregar otro registro haga clic en continuar, o en el boton de más abajo siguiente para registrar las bodegas.<br />
<form name="productoForm" target="formFrame" method="get" action="nor1.php">
<input type="hidden" name="id" value="<?php echo $id; ?>"  />
<input type="submit" name="agregar" id="agregar" value="Siguiente" class="textoField" />
</form>
</body>
</html>