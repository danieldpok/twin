<?php

function Conectar() 
{ 
$usuario = "root";
$pasword = "3141516";
//$servidor = "server-twinmarine.homelinux.com";
$servidor="localhost";
$base = "proformador";

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