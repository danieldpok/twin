<?php
include("bd.php");
$tabla=$_POST["tabla"];
$condicion=$_POST["condicion"];

$value=$_POST["valor"];
$text=$_POST["texto"];

if(!isset($_POST["condicion"]))
	$condicion="";

if($value==$text)
	$campos = $value;
else
	$campos =$value.", ".$text;

$query="select ".$campos." from ".$tabla." ".$condicion;

$result=$bd->Execute($query);

echo "<option>Seleccionar...</option>";
foreach($result as $row)	{
	echo '<option value="'.utf8_encode($row[$value]).'" >'.utf8_encode($row[$text]).'</option>';
}
?>