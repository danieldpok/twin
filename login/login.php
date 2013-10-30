<?php
include("../php/bd.php");
$usuario=$_POST['usuario'];
$password=base64_encode($_POST['password']);

$query="select idusuarios, usuario from usuarios where usuario='".$usuario."' and password='".$password."'";

$exist='false';
$result=$bd->Execute($query);
foreach($result as $row)	{

	session_start();
	$_SESSION['login']='true';
	$_SESSION['idusuario']=$row['idusuarios'];
	$_SESSION['usuario']=$row['usuario'];
	$exist='true';
}

echo $exist;

?>
