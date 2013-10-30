<?php
include("conexion.php");

$id=$_GET["id"];
$bodega=$_GET["bodega"];
$producto=$_GET["producto"];
$abreviacion=$_GET["abreviacion"];
$pesototal=$_GET["pesototal"];
$cantidad1=$_GET["cantidad1"];
$cantidad2=$_GET["cantidad2"];

$link = Conectar();
$fields="id, bodega, producto, abreviacion, pesototal, cantidad1, cantidad2";
$args="'$id', '$bodega', '$producto', '$abreviacion', '$pesototal', '$cantidad1', '$cantidad2'";
	$query="insert into pesobodega ($fields) values ($args)";
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
Registro Agregado, si desea agregar otro registro haga clic en continuar, o en el boton de más abajo siguiente para registrar los hechos.<br />
<form name="productoForm" target="formFrame" method="get" action="bod1.php">
<input type="hidden" name="id" value="<?php echo $id; ?>"  />
<input type="submit" name="agregar" id="agregar" value="Siguiente" class="textoField" />
</form>
</body>
</html>
