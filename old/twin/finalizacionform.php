<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<?php
include("conexion.php");
$id=$_GET["id"];

$link = Conectar();

if(isset($_POST["aceptarC"]))	{

	$id=$_POST["id"];
	$observaciones=$_POST["observaciones"];
	
	$query="insert into finalizacionobservaciones (id, observaciones) values ('$id', '$observaciones')";
	mysql_query($query, $link);	
	
}else if(isset($_POST["deleteC"]))	{
	
	$query="delete from finalizacionobservaciones where idfinalizacionobservaciones='".$_POST["idfinalizacionobservaciones"]."'";
	mysql_query($query, $link);
	$id=$_POST["id"];
	
}else if(isset($_POST["aceptarB"]))	{

	$id=$_POST["id"];
	$firmante=$_POST["firmante"];
	
	$query="insert into finalizacionfirmantes (id, firmante) values ('$id', '$firmante')";
	mysql_query($query, $link);	
	
}else if(isset($_POST["deleteB"]))	{
	
	$query="delete from finalizacionfirmantes where idfinalizacionfirmantes='".$_POST["idfinalizacionfirmantes"]."'";
	mysql_query($query, $link);
	$id=$_POST["id"];
	
}else if(isset($_POST["aceptarA"]))	{

	$id=$_POST["id"];
	$bodega=$_POST["bodega"];
	$producto=$_POST["producto"];
	$tonelaje=$_POST["tonelaje"];
	
	$query="insert into finalizacionbod (id, bodega, producto, tonelaje) values ('$id', '$bodega', '$producto', '$tonelaje')";
	mysql_query($query, $link);	
	
}else if(isset($_POST["deleteA"]))	{
	
	$query="delete from finalizacionbod where idfinalizacionbod='".$_POST["idfinalizacionbod"]."'";
	mysql_query($query, $link);
	$id=$_POST["id"];
	
}else if(isset($_POST["aceptar"]))	{

	$id=$_POST["id"];
	$recibidor=$_POST["recibidor"];
	$bl=$_POST["bl"];
	$producto=$_POST["producto"];
	$inicial=$_POST["inicial"];
	$bascula=$_POST["bascula"];
	$dif=$inicial-$bascula;
	$termino=$_POST["termino"];
	
	$query="insert into tonelajes (id, recibidor, bl, producto, inicial, bascula, dif, termino) values ('$id', '$recibidor', '$bl', '$producto', '$inicial', '$bascula', '$dif', '$termino')";
	mysql_query($query, $link);	
	
}else if(isset($_POST["delete"]))	{
	
	$query="delete from tonelajes where idtonelajes='".$_POST["idtonelajes"]."'";
	mysql_query($query, $link);
	$id=$_POST["id"];
	
}
//////DATOS DE LA OPERACION
?>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <meta name="generator" content="Adobe GoLive" />
        <title>Acta de Finalizacion</title>
        <style type="text/css">
	body{
		/*
		You can remove these four options 
		
		*/
		background-repeat:no-repeat;
		font-family: Trebuchet MS, Lucida Sans Unicode, Arial, sans-serif;
		margin:0px;
		

	}
	#ad{
		padding-top:220px;
		padding-left:10px;
	}
	.xxxxxx {
	font-size: 36px;
	color: #06C;
}
        .zzzzzzz {
	color: #FFF;
	background-color: #006;
}
.titulo {
	color: #FFF;
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 18px;
	text-align: left;
}
.texto {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 12px;
}
        </style>
	<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
	<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
        <link href="css/basic.css" rel="stylesheet" type="text/css" media="all" />
</head>
    
<body bgcolor="#ffffff">
<table width="847" border="0" align="center">
        <tr>
          <td width="841">
          <table width="885" border="1" align="center">
            <tr>
              <td width="433"><img src="logo.jpg" alt="" width="385" height="120" /></td>
              <td width="442" bgcolor="#0066FF" class="titulo">Asistente de Acta de Finalización</td>
            </tr>
          </table>
          <table width="890" height="85" border="1">
          <tr>
          <td>
          	<table width="889" border="1">
            <tr>
            <td>
            	<form id="form0" method="post" action="finalizacionform.php">
                	<label>
                    	Bodega:
                        <input type="text" name="bodega" id="bodega" size="10" />
                    </label>
                    <label>
                    	Producto:
                        <input type="text" name="producto" id="producto" size="50" />
                    </label>
                    <label>
                    	Tonelaje Gral:
                        <input type="text" name="tonelaje" id="tonelaje" size="10" />
                    </label>
                     <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
            		<br />
                  <input type="submit" name="aceptarA" id="aceptarA" value="Agregar" />
                                  
                </form>
            </td>
            </tr>
            <tr>
            <td><table width="883" border="1">
              <tr bgcolor="#0099FF">
                <td width="133">Bodega</td>
                <td width="450">Producto</td>
                <td width="151">Tonelaje Gral.</td>
                <td width="121">Opciones</td>
              </tr>
              <?php
				$query = "select * from finalizacionbod where id='".$id."'";
				$result = mysql_query($query, $link);
				while($row = mysql_fetch_array($result)) {
				  ?>
              <tr>
                <td><?php echo $row["bodega"];?></td>
                <td><?php echo $row["producto"];?></td>
                <td><?php echo number_format($row["tonelaje"], 3, ".", ",");?></td>
                <td><form id="form3" method="post" action="finalizacionform.php">
                  <input type="submit" name="deleteA" id="deleteA" value="Eliminar" />
                  <input type="hidden" name="id" value="<?php echo $id; ?>"  />
                  <input type="hidden" name="idfinalizacionbod" value="<?php echo $row["finalizacionbod"]; ?>"  />
                </form></td>
              </tr>
              <?php
				}
				?>
            </table></td>
            </tr>
            </table>
          </td>
          </tr>
          <tr>
          <td>
          	<table width="889" border="1">
            <tr>
            <td>
            	<form id="formx" method="post" action="finalizacionform.php">
                	<label>
                    	Observaciones:
                        <input type="text" name="observaciones" id="observaciones" size="50" />
                    </label>
                     <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
            		<br />
                  <input type="submit" name="aceptarC" id="aceptarC" value="Agregar" />
                </form>
            </td>
            </tr>
            <tr>
            <td><table width="883" border="1">
              <tr bgcolor="#0099FF">
                <td width="643">Observaciones</td>
                <td width="643">Opciones</td>
              </tr>
              <?php
				$query = "select * from finalizacionobservaciones where id='".$id."'";
				$result = mysql_query($query, $link);
				while($row = mysql_fetch_array($result)) {
				  ?>
              <tr>
                <td><?php echo $row["observaciones"];?></td>
                <td width="224"><form id="formxx" method="post" action="finalizacionform.php">
                  <input type="submit" name="deleteC" id="deleteC" value="Eliminar" />
                  <input type="hidden" name="id" value="<?php echo $id; ?>"  />
                  <input type="hidden" name="idfinalizacionobservaciones" value="<?php echo $row["idfinalizacionobservaciones"]; ?>"  />
                </form></td>
              </tr>
              <?php
				}
				?>
            </table></td>
            </tr>
            </table>
          </td>
          </tr>
            <tr>
              <td><form id="form1" method="post" action="finalizacionform.php">
                <label>Recibidor:
                  <select name="recibidor" id="recibidor">
                  <?php
				$query = "select distinct abreviado from conciliacion where id='".$id."'";

				$result = mysql_query($query, $link);

				while($row = mysql_fetch_array($result)) {
				  ?>
                    <option value="<?php echo $row["abreviado"]; ?>"><?php echo $row["abreviado"]; ?></option>
                  <?php
				  }
				  ?>
                  </select>
                </label>
                <label>BL(S):
                  <input type="text" name="bl" id="bl" />
                </label>
                <br />
                <label>Producto:
                  <input type="text" name="producto" id="producto" size="100" />
                </label>
                <br />
                <label>Peso Inicial:
                  <input type="text" name="inicial" id="inicial" />
                </label>
                <label>Peso Bascula:
                  <input type="text" name="bascula" id="bascula" />
                </label>
                <label>Termino de la Descarga:
                  <input type="text" name="termino" id="termino" />
                </label>
                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
            <br />
                  <input type="submit" name="aceptar" id="aceptar" value="Agregar" />
              </form></td>
            </tr>
            <tr>
              <td><table width="883" border="1">
                <tr bgcolor="#0099FF">
                  <td width="205">Recibidor</td>
                  <td width="25">BL(s)</td>
                  <td width="87">Producto</td>
                  <td width="83">Peso Inicial</td>
                  <td width="79">Peso Bascula</td>
                  <td width="104">Diferencia</td>
                  <td width="154">Termino de Descarga</td>
                  <td width="94">Opciones</td>
                </tr>
                 <?php
				$query = "select * from tonelajes where id='".$id."'";
				$result = mysql_query($query, $link);
				while($row = mysql_fetch_array($result)) {
				  ?>
                <tr>                
                  <td><?php echo $row["recibidor"];?></td>
                  <td><?php echo $row["bl"];?></td>
                  <td><?php echo $row["producto"];?></td>
                  <td><?php echo number_format($row["inicial"], 3, ".", ",");?></td>
                  <td><?php echo number_format($row["bascula"], 3, ".", ",");?></td>
                  <td><?php echo number_format($row["dif"], 3, ".", ",");?></td>
                  <td><?php echo $row["termino"];?></td>
                  <td><form id="form2" method="post" action="finalizacionform.php">
                        <input type="submit" name="delete" id="delete" value="Eliminar" />
                        <input type="hidden" name="id" value="<?php echo $id; ?>"  />
                        <input type="hidden" name="idtonelajes" value="<?php echo $row["idtonelajes"]; ?>"  />
                  </form></td>
                </tr>
                <?php
				}
				?>
              </table></td>
            </tr>
            <tr>
          <td>
          	<table width="889" border="1">
            <tr>
            <td>
            	<form id="form5" method="post" action="finalizacionform.php">
                	<label>
                    	Firmantes:
                        <input type="text" name="firmante" id="firmante" size="50" />
                    </label>
                     <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
            		<br />
                  <input type="submit" name="aceptarB" id="aceptarB" value="Agregar" />
                                  
                </form>
            </td>
            </tr>
            <tr>
            <td><table width="883" border="1">
              <tr bgcolor="#0099FF">
                <td width="643">Firmante</td>
                <td width="643">Opciones</td>
              </tr>
              <?php
				$query = "select * from finalizacionfirmantes where id='".$id."'";
				$result = mysql_query($query, $link);
				while($row = mysql_fetch_array($result)) {
				  ?>
              <tr>
                <td><?php echo $row["firmante"];?></td>
                <td width="224"><form id="form6" method="post" action="finalizacionform.php">
                  <input type="submit" name="deleteB" id="deleteB" value="Eliminar" />
                  <input type="hidden" name="id" value="<?php echo $id; ?>"  />
                  <input type="hidden" name="idfinalizacionfirmantes" value="<?php echo $row["idfinalizacionfirmantes"]; ?>"  />
                </form></td>
              </tr>
              <?php
				}
				?>
            </table></td>
            </tr>
            </table>
          </td>
          </tr>          
          </table>
          <p><a href="actafinalizacionb.php?id=<?php echo $id; ?>" target="_blank">CONSULTAR ACTA DE FINALIZACION&gt;&gt;</a><BR />
          </p>
          <p><font size="-2">Powered in association  by TWIN MARINE DE MEXICO, S.A. DE C.V.  and  DAKA Technology. &lt;&lt;Copyright © 2009-2010 All Rights Reserved&gt;&gt;</font></p></td>
        </tr>
</table>

</body>

</html>
