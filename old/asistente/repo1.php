<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Generador de Reportes</title>
<link href="styles.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body class="fondo">
<p class="texto">Ingrese ID y Fecha para el reporte:</p>
<form id="form1" name="form1" method="get" action="final25.php" class="texto">
  <span id="sprytextfield1">
  <label>ID:
    <input type="text" name="id" id="id" />
  </label>
  <span class="textfieldRequiredMsg">Se necesita un valor.</span></span>
  <br />
  <span id="sprytextfield2">
  <label>FECHA:
    <input type="text" name="date" id="date" />
  </label>
  <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span> año-mes-dia
  <br />
  <label>
    <input type="submit" name="button" id="button" value="Enviar" />
  </label>
</form>
<p>&nbsp;</p>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "date", {format:"yyyy-mm-dd", hint:"yyyy-mm-dd"});
//-->
</script>
</body>
</html>