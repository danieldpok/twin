<?php
$id=$_GET["id"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="SpryAssets/SpryValidationCheckbox.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationCheckbox.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.titulo {
	color: #FFF;
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 18px;
	text-align: left;
}
.texto {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 12px;
}
.fondo {
	background-attachment: scroll;
	background-image: url(fondo.jpg);
	background-repeat: no-repeat;
}
-->
</style>
</head>

<body class="fondo">
<table width="536" border="1">
  <tr>
    <td width="612" bgcolor="#0066FF" class="titulo">Asistente del estado de hechos</td>
  </tr>
  <tr>
    <td>
    <span class="texto">Seleccione los elementos que desea mostrar en el documento: </span>
    <form name="form" method="get" action="factspdf.php">
    <table width="528" border="0">
      <tr>
        <td width="522" class="texto">
          <label>
            <input type="checkbox" name="1" id="1" checked="checked"/>
            FINAL DRAFT SURVEY</label>
          Realice una selección.</td>
      </tr>
      <tr>
        <td class="texto">
          <label>
            <input type="checkbox" name="2" id="2" checked="checked"/>
            DOCUMENTS ON BOARD</label>
          Realice una selección.</td>
      </tr>
      <tr>
        <td class="texto">
          <label>
            <input type="checkbox" name="3" id="3" checked="checked"/>
            PILOT ON BOARD</label>
          Realice una selección.</td>
      </tr>
      <tr>
        <td class="texto">
          <label>
            <input type="checkbox" name="4" id="4" checked="checked"/>
            UNBERTHED FROM THE PIER</label>
          Realice una selección.</td>
      </tr>
      <tr>
        <td><span class="texto" id="sprycheckbox9">
          <label>
            <input type="checkbox" name="5" id="5" checked="checked"/>
            SHORE DRAFT SURVEY WEIGHT:</label>
        </span><span class="texto" id="sprytextfield4">
            <label>
              <input type="text" name="shore" id="shore" />
            </label>
          </span><span class="texto">MT</span></td>
      </tr>
      <tr>
        <td><span class="texto" id="sprycheckbox8">
          <label>
            <input type="checkbox" name="6" id="6" checked="checked"/>
            VESSEL DRAFT SUVEY WEIGHT</label>
          :
        </span><span class="texto" id="sprytextfield3">
            <label>
              <input type="text" name="vesseldraft" id="vesseldraft" />
            </label>
          </span><span class="texto">MT</span></td>
      </tr>
      <tr>
        <td class="texto">
          <label>
            <input type="checkbox" name="7" id="7" checked="checked"/>
            SHORE SCALE WEIGHT:</label>
            <label>
              <input type="text" name="shorescale" id="shorescale" />
            </label>
            MT</td>
      </tr>
      <tr>
        <td class="texto">
          <label>
            <input type="checkbox" name="8" id="8" checked="checked"/>
            SHORTAGE OF THE SHIPMENT :</label>
            <label>
              <input type="text" name="shortage" id="shortage" />
            </label>
            MT</td>
      </tr>
      <tr>
        <td><span class="texto" id="spryselect1">
          <label>FIRMA:
            <select name="firma" id="firma">
              <option value="0">RECIVER &amp; AGENCY</option>
              <option value="1">ONLY RECIVER</option>
              <option value="2">ONLY AGENCY</option>
            </select>
          </label>
          Seleccione un elemento.</span>
          <span class="texto">
          <input type="hidden" name="id" value="<?php echo $id; ?>" />
          <label>
            <input type="submit" name="button" id="button" value="Enviar" />
          </label>
          </span></td>
      </tr>
      </table>
    </form>
    </td>
  </tr>
</table>

<script type="text/javascript">
<!--
/*
var sprycheckbox1 = new Spry.Widget.ValidationCheckbox("sprycheckbox1");
var sprycheckbox2 = new Spry.Widget.ValidationCheckbox("sprycheckbox2");
var sprycheckbox9 = new Spry.Widget.ValidationCheckbox("sprycheckbox9");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {isRequired:false});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {isRequired:false});
var sprycheckbox7 = new Spry.Widget.ValidationCheckbox("sprycheckbox7");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprycheckbox8 = new Spry.Widget.ValidationCheckbox("sprycheckbox8");
var sprycheckbox3 = new Spry.Widget.ValidationCheckbox("sprycheckbox3");
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
*/
//-->
</script>
</body>
</html>
