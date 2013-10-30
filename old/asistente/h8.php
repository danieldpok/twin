<?php
include("conexion.php");
$id=$_GET["id"];
$fecha=$_GET["fecha"];
$hinicial=$_GET["hinicial"];
$hfinal=$_GET["hfinal"];
$tipo=$_GET["tipo"];
$fact=$_GET["fact"];
$clasif=$_GET["clasif"];
$timepercent=$_GET["timepercent"];

$link=Conectar();
$query="insert into computotiempo (id, fecha, hinicial, hfinal, tipo, fact, clasif, timepercent) values ('$id', '$fecha', '$hinicial', '$hfinal', '$tipo', '$fact', '$clasif', '$timepercent')";
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

<title>h8</title>
</head>

<body class="texto">
id=<?php echo $id; ?><br />
Registro Agregado, si desea agregar otro registro haga clic en continuar, o en el boton de más abajo siguiente para revisar el reporte de 24hrs.<br />
<form name="productoForm" target="formFrame" method="get" action="h2.php">
<input type="hidden" name="id" value="<?php echo $id; ?>"  />
<input type="submit" name="agregar" id="agregar" value="Continuar" class="textoField" />
</form>
</body>
</html>