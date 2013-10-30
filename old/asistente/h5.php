<?php
include("conexion.php");
$id=$_GET["id"];
$fecha=$_GET["fecha"];
$hinicial=$_GET["hinicial"];
$hfinal=$_GET["hfinal"];
$tipo=$_GET["tipo"];

if($tipo=="ARRIVAL MANEUVERS")	{
		$tabla="regulararrival";		
	}else if($tipo=="OPERATIONAL")	{
		$tabla="regularoperational";
	}else if($tipo=="STOP/IDLE TIME")	{
		$tabla="regularstop";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles.css" rel="stylesheet" type="text/css" />

<title>h5</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body class="texto">
id=<?php echo $id; ?>
<form name="form1" id="form1" method="get" action="h6.php" target="formFrame">
A continuación escriba los hechos:<br />
<select name="na" id="na" onchange="change()" >
                  <option value="seleccionar...">Seleccionar...</option>
                    <?php
					$link=Conectar();
					$query = "select * from $tabla order by concepto";
					$result = mysql_query($query, $link);
					while($row = mysql_fetch_array($result)) {
						echo "<option value=\"".$row["concepto"]."\">".$row["concepto"]."</option>";
					}
					mysql_close($link);
				  ?>
</select><br />
<span id="sprytextfield1">
<label>
  <input type="text" name="fact" id="fact" class="textoField" size="100" />
</label>
<span class="textfieldRequiredMsg">Se necesita un valor.</span></span>
<br />
Por favor haga clic en el boton &quot;siguente&quot; para continuar.<br />
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="hinicial" value="<?php echo $hinicial; ?>" />
<input type="hidden" name="hfinal" value="<?php echo $hfinal; ?>"  />
<input type="hidden" name="fecha" value="<?php echo $fecha; ?>"  />
<input type="hidden" name="tipo" value="<?php echo $tipo; ?>"  />
<input type="submit" name="agregar" id="agregar" value="Siguiente" class="textoField" />
</form>
<br />
Fecha: <?php echo $fecha; ?><br />
Hora Inicial: <?php echo $hinicial; ?>,   Hora Final: <?php echo $hfinal; ?><br />
Tipo: <?php echo $tipo; ?>
<SCRIPT>
function change()	{
	  document.forms[0].fact.value=document.forms[0].na.value;
	  document.forms[0].fact.focus();
  }
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
</SCRIPT>
</body>
</html>