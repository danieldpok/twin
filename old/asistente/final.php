<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Vista Preeliminar</title>
<link href="styles.css" rel="stylesheet" type="text/css" />

<style type="text/css">
<!--
.localBd {	font-family: Tahoma, Geneva, sans-serif;
	font-size: 12px;
	font-weight: normal;
}
-->
</style>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body class="fondo">
<form id="form1" name="form1" method="get" action="final2.php">
<p>
  <label>
    <input type="radio" name="radio" id="radio" value="radio" />
    Rep. de 24Hrs.</label>
</p>
<p>
  <label>
    <input type="radio" name="radio2" id="radio2" value="radio2" />
    Rep. Pre.</label>
</p>
<table width="321" border="1">
  <tr>
    <td width="249" bgcolor="#0000FF" class="titulo3">Por favor introduzca los siguientes datos para elaborar el reporte.</td>
  </tr>
  <tr>
    <td height="81"><table width="308" border="0">
      <tr>
        <td width="154" bgcolor="#0000FF" class="titulo2">Fecha inicial:
        </td>
        <td width="144">
          <label>
          </br><span class="textoRed">año-mes-dia</span></label>
          <span id="sprytextfield1">
          <label>
            <input type="text" name="date" id="date" />
          </label>
          <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
      </tr>
      <tr>
        <td bgcolor="#0000FF" class="titulo2">Fecha final:</td>
        <td>
          <label>
          </br><span class="textoRed">año-mes-dia</span></label>
          <span id="sprytextfield2">
          <label>
            <input type="text" name="date1" id="date1" />
          </label>
          <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
      </tr>
      <tr>
        <td colspan="2">
        <input type="hidden" name="id" id="id" value="<?php echo $_GET["id"]; ?>"  />
            <input type="submit" name="button" id="button" value="Enviar" /></td>
        </tr>
    </table></td>
  </tr>
</table>
</form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "date", {format:"yyyy-mm-dd", hint:"yyyy-mm-dd"});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "date", {format:"yyyy-mm-dd", hint:"yyyy-mm-dd"});
//-->
</script>
</body>
</html>