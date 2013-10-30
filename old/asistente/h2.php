<?php
include("conexion.php");
$id=$_GET["id"];
$link=Conectar();
$query = "select fecha, hfinal from computotiempo where id='".$id."' order by fecha, hfinal";
$result = mysql_query($query, $link);
$flag=false;
while($row = mysql_fetch_array($result)) {
	$flag=true;
	$fecha=$row["fecha"];
	$hfinal=$row["hfinal"];
}
mysql_close($link);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles.css" rel="stylesheet" type="text/css" />

<title>h2</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body class="texto">
id=<?php echo $id; ?>
<?php
if(!$flag)	{
?>
<form name="form1" method="get" action="h3.php" target="formFrame">
A continuación deberá indicar el día con el que se registraran los hechos:<br />
El formato para la fecha es año/mes/dia, Ej. 2010/04/06 para el 6 de Abril del 2010.<br />
<span id="sprytextfield1">
<label>
  <input type="text" name="fecha" id="fecha" class="textoField"/>
</label>
<span class="textfieldInvalidFormatMsg">Formato no válido.</span></span><br />
Por favor haga clic en el boton &quot;continuar&quot; para continuar.<br />
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="hinicial" value="x"  />
<input type="submit" name="agregar" id="agregar" value="Siguiente" class="textoField" />
</form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "custom", {pattern:"0000/00/00", hint:"yyyy/mm/dd", isRequired:false});
//-->
</script>
<?php
}	else	{	
	if($hfinal=="24:00")	{
		$hfinal="00:00";
		$fecha=date("Y/m/d", strtotime("$fecha + 1 days"));
	}
?>

<form name="form1" method="get" action="h3.php" target="formFrame">
A continuación deberá indicar el día con el que se registraran los hechos:<br />
El formato para la fecha es año/mes/dia, Ej. 2010/04/06 para el 6 de Abril del 2010.<br />
  <input type="text" name="fecha" id="fecha" value="<?php echo $fecha; ?>" class="textoField"/><br />
Por favor haga clic en el boton &quot;siguente&quot; para continuar.<br />
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="hinicial" value="<?php echo $hfinal; ?>"  />
<input type="submit" name="agregar" id="agregar" value="Siguiente" class="textoField" />
</form>
<?php
}
?>
</body>
</html>