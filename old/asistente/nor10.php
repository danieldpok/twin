<?php
include("conexion.php");
//$link = Conectar();

$id=$_GET["id"];
$agencia=$_GET["agencia"];
$recibidor=$_GET["recibidor"];
$estibador=$_GET["estibador"];
$operacion=$_GET["operacion"];
$producto=$_GET["producto"];
$bls=$_GET["bls"];
$unidades=$_GET["unidades"];
$peso=$_GET["peso"];
$cantidad=$_GET["cantidad"];
$pesototal=str_replace(",", "", $peso)*str_replace(",", "", $cantidad);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles.css" rel="stylesheet" type="text/css" />

<title>Nor9</title>
</head>

<body class="texto">
id=<?php echo $id; ?><br />
Por favor verifique que todos los conceptos sean correctos<br />
<form name="productoForm" target="formFrame" method="get" action="nor11.php">
Id:
<input type="text" name="id" value="<?php echo $id; ?>" size="5" class="textoField" readonly="readonly"/><br />
Agencia Aduanal:
<input type="text" name="agencia" value="<?php echo $agencia ?>" size="100" class="textoField" readonly="readonly"/><br />
Recibidor:
<input type="text" name="recibidor" value="<?php echo $recibidor ?>" size="100" class="textoField" readonly="readonly"/><br />
Estibador:
<input type="text" name="estibador" value="<?php echo $estibador ?>" size="100" class="textoField" readonly="readonly"/><br />
Operacion:
<input type="text" name="operacion" value="<?php echo $operacion ?>" class="textoField" readonly="readonly"/><br />
<input type="text" name="producto" value="<?php echo $producto ?>" size="100" class="textoField" readonly="readonly"/><br />
BL(s):
<input type="text" name="bls" value="<?php echo $bls ?>" size="5" class="textoField" readonly="readonly"/>
Unidades:
<input type="text" name="unidades" value="<?php echo $unidades ?>" class="textoField" readonly="readonly"/><br />
Peso de Unidad:
<input type="text" name="peso" value="<?php echo $peso ?>" class="textoField" readonly="readonly" align="right"/>
Cantidad de Unidades:
<input type="text" name="cantidad" value="<?php echo $cantidad ?>" class="textoField" readonly="readonly" align="right"/><br />
Peso Total:
<input type="text" name="pesototal" value="<?php echo number_format($pesototal, 3, ".", ","); ?>" class="textoField" readonly="readonly" /><br />

<input type="submit" name="agregar" id="agregar" value="Siguiente" class="textoField" />
</form>
</body>
</html>