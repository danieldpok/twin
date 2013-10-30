<?php
include("conexion.php");
$id=$_GET["id"];
$fecha=$_GET["fecha"];
$hinicial=$_GET["hinicial"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles.css" rel="stylesheet" type="text/css" />

<title>h3</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body class="texto">
id=<?php echo $id; ?>
<form name="form1" method="get" action="h4.php" target="formFrame">
A continuación deberá indicar el periodo: (hora inicial, hora final)<br />
El formato es de 24Hrs..<br />
<span id="sprytextfield1">
<label>Hora Inicial:
  <input type="text" name="hinicial" size="5" id="hinicial" class="textoField" <?php if($hinicial!="x") { ?> value="<?php echo $hinicial; ?>" <?php } ?>/>
</label>
<span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span>
<br />
<span id="sprytextfield2">
<label>Hora Final:
  <input type="text" name="hfinal" id="hfinal" size="5" class="textoField"/>
</label>
<span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span><br />
Por favor haga clic en el boton &quot;siguente&quot; para continuar.<br />
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="fecha" value="<?php echo $fecha; ?>"  />
<input type="submit" name="agregar" id="agregar" value="Siguiente" class="textoField" />
</form>
<br />
Fecha: <?php echo $fecha; ?>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "custom", {pattern:"00:00", hint:"hh:mm"});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "custom", {hint:"hh:mm", pattern:"00:00"});
//-->
</script>
</body>
</html>