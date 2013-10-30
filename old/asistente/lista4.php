<?php
include("conexion.php");
$id=$_GET["id"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<link href="styles.css" rel="stylesheet" type="text/css" />
</head>
<?php
if($_GET["lista"]=="bodega")	{
	$field="bodega";
	$table="descargabodegas";
}
else if($_GET["lista"]=="producto")	{
	$field="producto";
	$table="descargaproducto";}
else if($_GET["lista"]=="recibidor")	{
	$field="recibidor";
	$table="descargarecibidor";
}
else	{
?>
Selecione una opcion para desplegar una lista.
<?php
}
?>

<body>
<table width="531" border="1" class="texto2">
  <tr bgcolor="#0000FF" class="titulo3">
    <td width="32">Id</td>
    <td width="107">Fecha</td>
    <td width="124">Operación</td>
    <td width="132"><?php echo $field; ?></td>
    <td width="102">Cantidad</td>
    <td>eliminar</td>
  </tr>
  <?php
  if(isset($_GET["lista"]))	{
  	$link = Conectar();
	$query = "select * from $table where id='".$id."' order by fecha, $field";
	$result = mysql_query($query, $link);
	while($row = mysql_fetch_array($result)) {
  ?>
  <tr>
    <td><?php echo $row["id"];?></td>
    <td><?php echo $row["fecha"];?></td>
    <td><?php echo $row["operacion"];?></td>
    <td><?php echo $row[$field];?></td>
    <td><?php echo $row["cantidad"];?></td>
    <td><a href="actions.php?action=delete&table=<?php echo $table; ?>&field=id<?php echo $table; ?>&value=<?php echo $row["id$table"]; ?>" target="actionFrame" >eliminar</a></td>
  </tr>
  <?php
  	$total+=str_replace(",", "", $row["cantidad"]);
	}
	mysql_close($link);
  }
	?>
    <tr>
    <td>TOTAL</td>
    <td></td>
    <td></td>
    <td></td>
    <td><?php printf(",", "", $total);?></td>
    <td><a href="actions.php?action=delete&table=<?php echo $table; ?>&field=id<?php echo $table; ?>&value=<?php echo $row["id$table"]; ?>" target="actionFrame" >eliminar</a></td>
  </tr>
</table>
</body>
</html>