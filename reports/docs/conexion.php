<?php

function Conectar() 
{
	/*$servidor="localhost"; 
	$usuario = "root";
	$pasword = "";
	$base = "twinm";*/
	$usuario = "dakacom1_twinm";
	$pasword = "301727958";
	$base = "dakacom1_twinm";

   if (!($link=mysql_connect($servidor, $usuario, $pasword))) 
   { 
      echo "Error conectando a la base de datos."; 
      exit(); 
   } 
   if (!mysql_select_db($base,$link)) 
   { 
      echo "Error seleccionando la base de datos."; 
      exit(); 
   } 
   return $link; 
} 
?>