<?php
include("conexion.php");
$id=$_GET["id"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles.css" rel="stylesheet" type="text/css" />

<title>b1</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body class="texto">
id=<?php echo $id; ?>
<form name="form1" method="get" action="b2.php" target="formFrame">
A continuación indique el dia del que se registraran las descargas:<br />
El formato para la fecha es <span class="textoRed">año/mes/dia</span>, Ej. 2010/04/06 para el 6 de Abril del 2010.<br />
<span id="sprytextfield1">
<label>
  <input type="text" name="fecha" id="fecha" class="textoField"/>
</label>
<span class="textfieldInvalidFormatMsg">Formato no válido.</span></span><br />
Por favor haga clic en el boton &quot;continuar&quot; para continuar.<br />
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="submit" name="agregar" id="agregar" value="Siguiente" class="textoField" />
</form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "custom", {pattern:"0000/00/00", hint:"yyyy/mm/dd", isRequired:false});
//-->
</script>
<script>	
	top.listaFrame.location.assign("lista4.php?id=<?php echo $id; ?>&lista=bodega");
</script>
</body>
</html>