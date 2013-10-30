<?php
include("conexion.php");
include("sesionestar.php");
session_start();
$id=$_GET[['id'];
?>
<form name="form2" action="http://server-twinmarine.homelinux.com/twin/reportegralxtransportista.php" method="post">
  <?php

 $link= Conectar();
 $query = "select distinct transportista,id from movimientos where id = '".$id. "' order by transportista";
 //echo $query;
 $result = mysql_query($query,$link);
 echo "<select name=\"transportista\" ;\"> ";/* inicializa el menu */
     $transportista=$_GET['transportista'];
	 
	 if (!isset($transportista)) /* si el valor es nulo */
    {
     echo "<option value=null selected>Seleccione un Transportista</option>";  /* asigna el valor */
    }
	
      /* de lo contrario obtiene de internet La clave del Grupo*/
     while(list($transportista,$id) = mysql_fetch_array($result))   /* agrega las opciones al menu */
     {
	  echo "<option value=\"$transportista\"";
       if ($transportista == $transportista)
	    {
		 echo " selected"; 
	    }
		else
		{
		}
        echo ">$transportista</option>";
     }
      echo "</select>";

?>
 <input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
 <input type="submit" value="Consultar" />
</form>