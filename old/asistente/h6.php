<?php
include("conexion.php");
$id=$_GET["id"];
$fecha=$_GET["fecha"];
$hinicial=$_GET["hinicial"];
$hfinal=$_GET["hfinal"];
$tipo=$_GET["tipo"];
$fact=$_GET["fact"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles.css" rel="stylesheet" type="text/css" />

<title>h6</title>
</head>

<body class="texto">
id=<?php echo $id; ?>
<form name="form1" id="form1" method="get" action="h7.php" target="formFrame">
A continuación seleccione una clasificacion:<br />
<select name="clasif" id="clasif"  class="textoField">
                  <option value="Ninguna">Ninguna</option>
                    <?php
					$link=Conectar();
					$query = "select clasificacion from clasificacion order by clasificacion";
					$result = mysql_query($query, $link);
					while($row = mysql_fetch_array($result)) {
						echo "<option value=\"".$row["clasificacion"]."\">".$row["clasificacion"]."</option>";
					}
					mysql_close($link);
				  ?>
</select><br />
Indique un porcentaje a descontar si es que aplica:<br />
<input type="text" name="timepercent" size="5" class="textoField" />
<br />
Por favor haga clic en el boton &quot;siguente&quot; para continuar.<br />
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="hinicial" value="<?php echo $hinicial; ?>" />
<input type="hidden" name="hfinal" value="<?php echo $hfinal; ?>"  />
<input type="hidden" name="fecha" value="<?php echo $fecha; ?>"  />
<input type="hidden" name="tipo" value="<?php echo $tipo; ?>"  />
<input type="hidden" name="fact" value="<?php echo $fact; ?>"  />
<input type="submit" name="agregar" id="agregar" value="Siguiente" class="textoField" />
</form>
<br />
Fecha: <?php echo $fecha; ?><br />
Hora Inicial: <?php echo $hinicial; ?>,   Hora Final: <?php echo $hfinal; ?><br />
Tipo: <?php echo $tipo; ?><br />
Fact: <?php echo $fact; ?><br />
</body>
</html>