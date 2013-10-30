<?php
include("bd.php");
session_start();

if(isset($_SESSION['login']))	{
		
	$tabla=$_POST["table"];
	$id=$_POST["id"];
	
	$query="delete from ".$tabla." where id".$tabla."='".$id."'";
	$result=$bd->Execute($query);		
}	
?>