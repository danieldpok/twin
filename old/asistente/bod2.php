<?php
$id=$_GET["id"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles.css" rel="stylesheet" type="text/css" />

<title>bod2</title>
</head>

<body class="texto">
id=<?php echo $id; ?><br />
A continuación indique el numero de la bodega de la cual registrara los datos:<br />
<form name="bodega" target="formFrame" method="get" action="bod3.php">
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="text" name="bodega" size="5" />
<br />Haga clic en siguiente para continuar:<br />
<input type="submit" name="agregar" id="agregar" value="Siguiente" class="textoField" />
</form>
</body>
</html>