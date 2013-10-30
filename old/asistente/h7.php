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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles.css" rel="stylesheet" type="text/css" />

<title>h7</title>
</head>

<body class="texto">
id=<?php echo $id; ?>
<form name="form1" id="form1" method="get" action="h8.php" target="formFrame">
Por favor revise que la información sea correcta:<br />
Id: <input type="text" name="id" value="<?php echo $id; ?>" class="textoField" readonly="readonly" size="5" /><br />
Fecha: <input type="text" name="fecha" value="<?php echo $fecha; ?>" class="textoField" readonly="readonly" size="10" /><br />
Hora Inicial: <input type="text" name="hinicial" value="<?php echo $hinicial; ?>" class="textoField" readonly="readonly" size="5" /><br />
Hora Final: <input type="text" name="hfinal" value="<?php echo $hfinal; ?>" class="textoField" readonly="readonly" size="5" /><br />
Tipo: <input type="text" name="tipo" value="<?php echo $tipo; ?>" class="textoField" readonly="readonly" size="15" /><br />
Fact: <input type="text" name="fact" value="<?php echo $fact; ?>" class="textoField" readonly="readonly" size="100" /><br />
Clasificacion: <input type="text" name="clasif" value="<?php echo $clasif; ?>" class="textoField" readonly="readonly" size="100"/><br />
% a descontar: <input type="text" name="timepercent" value="<?php echo $timepercent; ?>" size="5" class="textoField" readonly="readonly" />
<input type="submit" name="agregar" id="agregar" value="Siguiente" class="textoField" />
</form>
</body>
</html>