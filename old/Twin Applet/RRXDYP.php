<?php
include("conexion.php");
include("sesionestar.php");
session_start();
$id=$_GET['id'];
//echo $id;
$_SESSION['idRRXCYP']=$id;
 ?><title>RRXDYP</title>
 <form name="carform" action="http://server-twinmarine.homelinux.com/twin/reporteprodes.php" method="get">
  <?php

 $link= Conectar();
 $query = "select distinct producto,id from movimientos where id = '".$id. "' order by producto";
 //echo $query;
 $result = mysql_query($query,$link);
  echo "<select name=\"producto\" ;\"> ";/* inicializa el menu */
     $producto=$_GET['producto']; /* obtiene la variable autoenviada  */
     $destino=$_GET['destino']; /* obtiene la variable autoenviada  */
   if (!isset($producto)) /* si el valor es nulo */
    {
     echo "<option value=null selected>Todos</option>";  /* asigna el valor */
    }
	
      /* de lo contrario obtiene de internet La clave del Grupo*/
     while(list($producto,$id) = mysql_fetch_array($result))   /* agrega las opciones al menu */
     {
	  echo "<option value=$producto";
       if ($producto == $producto)
	    {
		 echo " selected"; 
	    }
		else
		{
		}
        echo ">$producto</option>";
     }
      echo "</select>";
	  
       
	   
 echo "<select name=\"destino\" ;\">";/*envia la clave del grupo en la variable modelo*/
        
	//echo "<option value=null selected>Selecciona Primero Producto</option>"; 
          
	 
         $query2 = "select distinct destino,id from movimientos where id = '".$_SESSION['idRRXCYP']. "' order by destino";
         $result2 = mysql_query($query2,$link);
  
          $destino=$_GET['destino']; /* obtiene la variable autoenviada  */
   
          echo "<option value=null selected>Todos</option>";
  
         while(list($destino,$id) =  mysql_fetch_array($result2))
         {
          echo "<option value=$destino";
         if ($destino == $destino) 
         { 
         echo " selected"; 
          }
         echo ">$destino</option>";
        }
        
 
         echo "</select>";

          ?>
         
         <input type="hidden" name="id" value="<?php echo $_GET[['id'];?>" />
        <!-- <input type="hidden" name="destino" value="<?php echo $destino;?>" />
         <input type="hidden" name="producto" value="<?php echo $producto ;?>" />-->
         <input type="submit" value="Consultar" />
         </form>
       