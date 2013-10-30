<?php
include("conexion.php");

$id=$_GET["id"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registro de Agencias, Recibidores, Estibadores, Cargas, etc...</title>
<link href="styles.css" rel="stylesheet" type="text/css" />
</head>
<body class="fondo">
<table width="1102" border="1" bordercolor="#CCCCCC">
  <tr>
    <td width="1092" height="60" bgcolor="#0000FF" class="titulo">Registro de Agencias, Recibidores, Estibadores, Cargas, etc...</td>
  </tr>
  <tr>
    <td height="110" class="texto"><p><iframe name="formFrame" src="nor1.php?id=<?php echo $id; ?>" width="600" height="300" frameborder="1"></iframe>&nbsp;</p></td>
  </tr>
  <tr>
	  <td height="71">
      <iframe name="listaFrame" src="lista1.php?id=<?php echo $id; ?>" width="1100" height="150" frameborder="1"></iframe>
	  </td>
  </tr>
  <tr bgcolor="#0000FF">
  <td height="28" class="titulo3">
  <form action="registros2.php">
    <input type="hidden" name="id" value="<?php echo $id; ?>"  />
    <label>
      <input type="submit" name="button" id="button" value="Siguiente" />
    </label>
  (Paso 2, registro de Bodegas)
  </form>
  </td>
  </tr>
  <tr>
  <td>
  <iframe name="actionFrame" src="actions.php" width="600" height="40" frameborder="0"></iframe>
  </td>
  </tr>
</table>
<span class="powered">&lt;&lt; Powered by Twin Marine de México, S.A. de C.V. &amp; DAKA Technology. 2010&gt;&gt;</span><br />

</body>
</html>
