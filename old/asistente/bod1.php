<?php
$id=$_GET["id"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles.css" rel="stylesheet" type="text/css" />

<title>bod1</title>
</head>

<body>
<p class="texto">id=<?php echo $id; ?>
<p class="texto">A continuación deberá registrar las bodegas, el peso total de cada una, el producto, la abreviacion del producto y las cantidades que corresponden al primer y/o al segundo puerto de descarga.
<p class="texto">Por favor haga clic en el boton &quot;continuar&quot; para continuar.
<form name="form1" method="get" action="bod2.php" target="formFrame">
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="submit" name="agregar" id="agregar" value="Siguiente" class="textoField" />
</form>
</p>
</body>
</html>