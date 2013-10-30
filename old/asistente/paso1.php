<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<link href="styles.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="552" border="1" bordercolor="#CCCCCC">
  <tr>
    <td width="542" height="71" bgcolor="#0000FF" class="titulo">Registro de Recibidores</td>
  </tr>
  <tr>
    <td height="126" class="texto" >A continuación Registre los Recibidores, haga clic en el botón agregar para agregarlos a la lista:
      <form id="form1" name="form1" method="post" action="">
    <span id="sprytextfield1">
          <label class="textoNegrita">Recibidor:
            <input type="text" name="recividor" id="recividor" class="textoField" size="100" />
          </label>
          <span class="textfieldRequiredMsg">Se necesita un valor.</span></span>          
      <label>
        <input type="submit" name="agregar" id="agregar" value="Agregar" />
      </label>
      </form>
    </td>
  </tr>
  <tr>
  	<td height="83"><table width="600" border="1">
        <tr>
          <td colspan="2" bgcolor="#0000FF" class="titulo2">Recibidores.</td>
        </tr>
        <tr>
          <td width="533" class="texto">&nbsp;</td>
          <td width="51" class="texto">Eliminar</td>
        </tr>
    </table></td>
  </tr>
  <tr bgcolor="#0000FF">
  <td height="28">
  <form action="paso2.php">
    <label>
      <input type="submit" name="button" id="button" value="Siguiente" />
    </label>
  
  </form>
  </td>
  </tr>
</table>
<span class="powered">&lt;&lt; Powered by Twin Marine de México, S.A. de C.V. &amp; DAKA Technology. 2010&gt;&gt;</span><br />
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
//-->
</script>
</body>
</html>
