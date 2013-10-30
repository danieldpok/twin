<?php
include("conexion.php");
$id=$_GET["id"];
$fecha=$_GET["fecha"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles.css" rel="stylesheet" type="text/css" />

<title>b2</title>
</head>

<body class="texto">
id=<?php echo $id; ?>
<form name="form1" id="form1" method="get" action="p3.php" target="formFrame">
A continuación seleccione el tipo de Operación:<br />
<select name="operacion" id="operacion"  class="textoField">
<option value="DISCHARGE">DISCHARGE</option>
<option value="LOAD">LOAD</option>
</select><br />
Por favor haga clic en el boton &quot;siguente&quot; para continuar.<br />
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="fecha" value="<?php echo $fecha; ?>"  />
<input type="submit" name="agregar" id="agregar" value="Siguiente" class="textoField" />
</form>
<br />
Fecha: <?php echo $fecha; ?><br />
</body>
</html>