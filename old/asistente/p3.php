<?php
include("conexion.php");
$id=$_GET["id"];
$fecha=$_GET["fecha"];
$operacion=$_GET["operacion"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles.css" rel="stylesheet" type="text/css" />

<title>b3</title>
</head>

<body class="texto">
id=<?php echo $id; ?>
<form name="form1" id="form1" method="get" action="p4.php" target="formFrame">
A continuación seleccione un producto:<br />
<select name="producto" id="producto"  class="textoField">
		<?php
        $link=Conectar();
        $query = "select distinct producto from chargeinformation where id='$id' order by producto";
        $result = mysql_query($query, $link);
        while($row = mysql_fetch_array($result)) {
            echo "<option value=\"".$row["producto"]."\">".$row["producto"]."</option>";
        }
        mysql_close($link);
      ?>
</select><br />
Indique la cantidad de la operación:<br />
<input type="text" name="cantidad" size="5" class="textoField" />MT.<br />
Por favor haga clic en el boton &quot;siguente&quot; para continuar.<br />
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="fecha" value="<?php echo $fecha; ?>"  />
<input type="hidden" name="operacion" value="<?php echo $operacion; ?>"  />
<input type="submit" name="agregar" id="agregar" value="Siguiente" class="textoField" />
</form>
<br />
Fecha: <?php echo $fecha; ?><br />
Tipo de Operacion: <?php echo $operacion; ?>
</body>
</html>