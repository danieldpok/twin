<?php
$id=$_GET["id"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles.css" rel="stylesheet" type="text/css" />

<title>h1</title>
</head>

<body class="texto">
id=<?php echo $id; ?><br />
A continuación registre las descargas del dia, seleccione una de las siguientes:<br />
<a href="b1.php?id=<?php echo $id; ?>" target="formFrame">Registrar Descargas de Bodegas.</a><br />
<a href="r1.php?id=<?php echo $id; ?>" target="formFrame">Registrar Descargas de Recibidores.</a><br />
<a href="p1.php?id=<?php echo $id; ?>" target="formFrame">Registrar Descargas de Productos.</a><br />
</body>
</html>