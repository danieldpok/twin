<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
</head>
<?php
header('Content-Type: text/html; charset=iso-8859-1');
include("conexion.php");

$id=$_GET["id"];
$puerto=$_GET["puerto"];

$link = Conectar();
?>
<body>
<?php
$item=$_GET["item"];
$query="delete from tarifasprof where id='$id' and puerto='$puerto'";
mysql_query($query, $link);
for($i=1; $i<=$item; $i++)	{
	if($_GET[$i."item"]=="1")	{
		$query="insert into tarifasprof (id, puerto, cantidad, concepto, referencia, pu) values ("
				."'".$_GET["id"]."', '".$_GET["puerto"]."', '".$_GET[$i."cantidad"]."', '".$_GET[$i."concepto"]."', '".$_GET[$i."referencia"]."', '".$_GET[$i."pu"]."')";
		mysql_query($query, $link);
	}
}
?>
<img src="logox.jpg" alt="" width="264" height="83" />
<p class="titulo"><?php echo "Asistente de Proformas (2 de 3)"; ?></p>
<form id="form1" name="form1" method="get" action="caratulapda.php">
  <table width="60" border="1" cellspacing="0" class="general" bordercolor="#CCCCCC">
  <tr class="tituloTabla" bgcolor="#000066">
    <td>REFERENCIA</td>
    <td>IMPORTE</td>
  </tr>
  <?php
  $item=1;
  $query="select distinct referencia from tarifasprof where id='$id' and puerto='$puerto'";
  $result = mysql_query($query, $link);
  $size=0;
  while($row = mysql_fetch_array($result)) {
	  $referencia[$size]=$row["referencia"];
	  $size++;
  }
  
  for($i=0; $i<$size; $i++)	{
	  	$query="select referencia, cantidad, pu from tarifasprof where id='$id' and puerto='$puerto' and referencia='$referencia[$i]'";
  		$result = mysql_query($query, $link);
  		$importe=0;
  		while($row = mysql_fetch_array($result)) {
	  		$ref=$row["referencia"];
			$val1=str_replace( ",", "", $row["pu"]);
			$val1=str_replace( "$", "", $val1);
			$value=$row["cantidad"]*$val1;
	  		$importe+=$value;
  		}
		?>
        <tr>
    <td><label>
      <input type="text" name="<?php echo $item."referencia"; ?>" id="textfield" class="generalCombo" readonly="true" size="60" value="<?php echo $ref; ?>"/>
    </label></td>
    <td>
      <label>
        <input type="text" name="<?php echo $item."importe"; ?>" id="textfield2" value="<?php echo "$ ".number_format($importe, 2, ".", ","); ?>" />
      </label>
    </td>
  </tr>
        <?php
		$item++;
  }
  ?>
  
</table>
<input type="hidden" name="puerto" id="sads" value="<?php echo $puerto; ?>"/>
<input type="hidden" name="id" id="hiddenField" value="<?php echo $id; ?>" />
<input type="hidden" name="item" id="hiddenField" value="<?php echo $item; ?>" />
  <label>
    <input type="submit" name="button" id="button" value="Guardar y Continuar" />
  </label>
</form>
</body>
</html>