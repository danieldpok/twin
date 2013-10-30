<?php

function Conectar() 
{ 
$usuario = "root";
$pasword = "";
//$servidor = "server-twinmarine.homelinux.com";
$servidor="localhost";
//$servidor="192.168.1.102";
$base = "twin";

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