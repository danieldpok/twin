<?php
include("conexion.php");
$id=$_GET["id"];
$fecha=$_GET["fecha"];
$hinicial=$_GET["hinicial"];
$hfinal=$_GET["hfinal"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles.css" rel="stylesheet" type="text/css" />

<title>h4</title>
</head>

<body class="texto">
id=<?php echo $id; ?>
<form name="form1" method="get" action="h5.php" target="formFrame">
A continuación escoja el tipo al que corresponde:<br />
<select name="tipo" class="textoField">
  <option value="ARRIVAL MANEUVERS">ARRIVAL MANEUVERS</option>
  <option value="OPERATIONAL">OPERATIONAL</option>
  <option value="STOP/IDLE TIME">STOP/IDLE TIME</option>
</select>
<br />
Por favor haga clic en el boton &quot;siguente&quot; para continuar.<br />
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="hinicial" value="<?php echo $hinicial; ?>" />
<input type="hidden" name="hfinal" value="<?php echo $hfinal; ?>"  />
<input type="hidden" name="fecha" value="<?php echo $fecha; ?>"  />
<input type="submit" name="agregar" id="agregar" value="Siguiente" class="textoField" />
</form>
<br />
Fecha: <?php echo $fecha; ?><br />
Hora Inicial: <?php echo $hinicial; ?>,   Hora Final: <?php echo $hfinal; ?>
</body>
</html>