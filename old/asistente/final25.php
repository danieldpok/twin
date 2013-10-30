<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Vista Preeliminar</title>
<link href="styles.css" rel="stylesheet" type="text/css" />

<style type="text/css">
<!--
.localBd {	font-family: Tahoma, Geneva, sans-serif;
	font-size: 12px;
	font-weight: normal;
}
-->
</style>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body class="fondo" >
  <?php
include("conexion.php");
$id=$_GET["id"];
$date=$_GET["date"];
$date1=$_GET["date1"];
$no=$_GET["no"];
$tabla="regulararrival";

if(isset($_GET["dhold"]))	{
	$link = Conectar();
		
	$id=$_GET["id"];
	$holdx=$_GET["hold"];
	$cargox=$_GET["cargo"];
	$cvx=$_GET["hold"].$_GET["cargo"];
	$inicial=$_GET["inicial"];
	
	$query="insert into dhold (cv, id, hold, cargo, inicial) values ('$cvx', '$id', '$holdx', '$cargox', '$inicial')";
	if(mysql_query($query, $link))
		header("Location: final25.php?id=$id&date=$date");
	mysql_close($link);
}	else if(isset($_GET["guardarhold"]))	{
	$cvx=$_GET["cv"];
	$id=$_GET["id"];
	//$fecha=$_GET["date"];
	$cantidad=$_GET["cantidad"];
	
	$link = Conectar();
	$query="delete from holdcargo where id='$id' and cv='$cvx' and fecha='$date'";
	mysql_query($query, $link);
	$query="insert into holdcargo (id, cv, fecha, cantidad) values ('$id', '$cvx', '$date', '$cantidad')";
	if(mysql_query($query, $link))
		header("Location: final25.php?id=$id&date=$date");
	mysql_close($link);
}
else if(isset($_GET["eliminarhold"]))	{
	$cvx=$_GET["cv"];
	$id=$_GET["id"];
	//$fecha=$_GET["date"];
	$cantidad=$_GET["cantidad"];
	
	$link = Conectar();
	$query="delete from holdcargo where id='$id' and cv='$cvx' and fecha='$date'";
	mysql_query($query, $link);
	$query="delete from dhold where id='$id' and cv='$cvx'";
	if(mysql_query($query, $link))
		header("Location: final25.php?id=$id&date=$date");
	mysql_close($link);
}
/////////////////////////////////////////////////////////////////////////
else if(isset($_GET["dreceiver"]))	{
	$link = Conectar();
		
	$id=$_GET["id"];
	$receiverx=$_GET["receiver"];
	$cvx=$_GET["receiver"];
	$inicial=$_GET["inicial"];
	
	$query="insert into dreceiver (cv, id, receiver, inicial) values ('$cvx', '$id', '$receiverx', '$inicial')";
	if(mysql_query($query, $link))
		header("Location: final25.php?id=$id&date=$date");
	mysql_close($link);
}	else if(isset($_GET["guardarreceiver"]))	{
	$cvx=$_GET["cv"];
	$id=$_GET["id"];
	//$fecha=$_GET["date"];
	$cantidad=$_GET["cantidad"];
	
	$link = Conectar();
	$query="delete from receivercargo where id='$id' and cv='$cvx' and fecha='$date'";
	mysql_query($query, $link);
	$query="insert into receivercargo (id, cv, fecha, cantidad) values ('$id', '$cvx', '$date', '$cantidad')";
	if(mysql_query($query, $link))
		header("Location: final25.php?id=$id&date=$date");
	mysql_close($link);
}	else if(isset($_GET["eliminarreceiver"]))	{
	$cvx=$_GET["cv"];
	$id=$_GET["id"];
	//$fecha=$_GET["date"];
	$cantidad=$_GET["cantidad"];
	
	$link = Conectar();
	$query="delete from receivercargo where id='$id' and cv='$cvx' and fecha='$date'";
	mysql_query($query, $link);
	$query="delete from dreceiver where id='$id' and cv='$cvx'";
	if(mysql_query($query, $link))
		header("Location: final25.php?id=$id&date=$date");
	mysql_close($link);
}
//////////////////////////////////////////////////////////////////////////
else if(isset($_GET["dproduct"]))	{
	$link = Conectar();
		
	$id=$_GET["id"];
	$productx=$_GET["product"];
	$cvx=$_GET["product"];
	$inicial=$_GET["inicial"];
	
	$link= Conectar();
	$query="insert into dproduct (cv, id, product, inicial) values ('$cvx', '$id', '$productx', '$inicial')";
	if(mysql_query($query, $link))
		header("Location: final25.php?id=$id&date=$date");
	mysql_close($link);
}	else if(isset($_GET["guardarproduct"]))	{
	$cvx=$_GET["cv"];
	$id=$_GET["id"];
	//$fecha=$_GET["date"];
	$cantidad=$_GET["cantidad"];
	
	$link = Conectar();
	$query="delete from productcargo where id='$id' and cv='$cvx' and fecha='$date'";
	mysql_query($query, $link);
	$query="insert into productcargo (id, cv, fecha, cantidad) values ('$id', '$cvx', '$date', '$cantidad')";
	if(mysql_query($query, $link))
		header("Location: final25.php?id=$id&date=$date");
	mysql_close($link);
} else if(isset($_GET["eliminarproduct"]))	{
	$cvx=$_GET["cv"];
	$id=$_GET["id"];
	//$fecha=$_GET["date"];
	$cantidad=$_GET["cantidad"];
	
	$link = Conectar();
	$query="delete from productcargo where id='$id' and cv='$cvx' and fecha='$date'";
	mysql_query($query, $link);
	$query="delete from dproduct where id='$id' and cv='$cvx'";
	if(mysql_query($query, $link))
		header("Location: final25.php?id=$id&date=$date");
	mysql_close($link);
}
////////////////////////////////////////////////////////////////
else if(isset($_GET["factnew"]))	{
	$id=$_GET["id"];
	$tipo=$_GET["tipo"];
	$fecha=$_GET["fecha"];
	$hinicial=$_GET["hinicial"];
	$hfinal=$_GET["hfinal"];
	$fact=$_GET["fact"];
	
	$link = Conectar();
	$query="insert into computotiempo (id, tipo, fecha, hinicial, hfinal, fact) values ('$id', '$tipo', '$fecha', '$hinicial', '$hfinal', '$fact')";
	if(mysql_query($query, $link))
		header("Location: final25.php?id=$id&date=$date");
	mysql_close($link);
}	else if(isset($_GET["tipo"]))	{
	if($_GET["tipo"]=="ARRIVAL MANEUVERS")	{
		$tabla="regulararrival";		
		$var1='selected="selected"';
	}else if($_GET["tipo"]=="OPERATIONAL")	{
		$tabla="regularoperational";
		$var2='selected="selected"';
	}else if($_GET["tipo"]=="STOP/IDLE TIME")	{
		$tabla="regularstop";
		$var3='selected="selected"';
	}
}	else if(isset($_GET["idcomputotiempo"]))	{
	$idcomputotiempo=$_GET["idcomputotiempo"];
	$link = Conectar();
	$query="delete from computotiempo where idcomputotiempo='$idcomputotiempo'";
	if(mysql_query($query, $link))
		header("Location: final25.php?id=$id&date=$date");
	mysql_close($link);
}	else if(isset($_GET["guardarquantities"]))	{
	$totq=$_GET["totq"];
	$dischq=$_GET["dischq"];
	$prevdq=$_GET["prevdq"];
	$totdq=$_GET["totdq"];
	$tobedq=$_GET["tobedq"];
	
	$link = Conectar();
	$idquantities="";
	$query="select * from quantities where id='".$id."'";
	$result = mysql_query($query, $link);			
	while($row = mysql_fetch_array($result)){
		$idquantities=$row["idquantities"];
	}
	if($idquantities=="")
		$query="insert into quantities ( id, totq, dischq, prevdq, totdq, tobedq ) values ( '$id', '$totq', '$dischq', '$prevdq', '$totdq', '$tobedq' )";
	else
		$query="update quantities set id='$id', totq='$totq', dischq='$dischq', prevdq='$prevdq', totdq='$totdq', tobedq='$tobedq' where idquantities='$idquantities'";
	
	if(mysql_query($query, $link))
		header("Location: final25.php?id=$id&date=$date");
	mysql_close($link);
}else if(isset($_GET["guardardatos"]))	{
	$vessel=$_GET["vessel"];
	$cargo=$_GET["cargo"];
	$quantity=$_GET["quantitya"];
	$loadingport=$_GET["loadingport"];
	$maximum=$_GET["maxarrival"];
	
	$link = Conectar();
	$query="update operaciones set vessel='$vessel', cargotype='$cargo', quantity='$quantity', puertodecarga='$loadingport', maxarrivaldraftmt='$maximum' where id='$id'";
	
	if(mysql_query($query, $link))
		header("Location: final25.php?id=$id&date=$date");
	mysql_close($link);
}
else if(isset($_GET["guardartitulo"]))	{
	$titulo=$_GET["titulo"];
	
	$link = Conectar();
	$query="update operaciones set titulo='$titulo' where id='$id'";
	
	if(mysql_query($query, $link))
		header("Location: final25.php?id=$id&date=$date");
	mysql_close($link);
}

//DATOS DEL REGISTRO
$table="operaciones";
$fields="vessel, flag, puertodecarga, quantity, cargotype, maxarrivaldraftmt, titulo, typex";

$query = "select ".$fields." from ".$table." where id='".$id."'";

$link = Conectar();
$result = mysql_query($query, $link);

while($row = mysql_fetch_array($result)){
$vessel=$row["vessel"];
$flag=$row["flag"];
$puertodecarga=$row["puertodecarga"];
$quantity=$row["quantity"];
$cargaentransito=$row["cargotype"];
$maxarrivaldraftmt=$row["maxarrivaldraftmt"];
$titulo=$row["titulo"];
$typex=$row["typex"];
}

if($typex=="IMPORT")	{
	$text1= "Discharged";
}
else	{
	$text2= "Charged";
}
?>
<form name="formuno" method="get" action="final25.php" >
<input type="hidden" name="id" value="<?php echo $id; ?>"  />
<input type="hidden" name="date" value="<?php echo $date; ?>"  />
<table width="330" border="1" cellspacing="2" cellpadding="0" class="texto">
  <tr>
    <td width="148" bgcolor="#0183bf" class="titulo3">VESSEL:</td>
    <td width="226"><label>        
        <input type="text" name="vessel" id="vessel" value="<?php echo $vessel; ?>" />
    </label></td>
  </tr>
</table>
<p>
  <label>
    <input type="submit" name="guardardatos" id="guardardatos" value="Guardar" />
  </label>
</p>
</form>
<form name="formx" id="formx" method="get" action="final25.php">
	<input type="hidden" name="id" value="<?php echo $id; ?>"  />
	<input type="hidden" name="date" value="<?php echo $date; ?>"  />
<span class="tituloNormal">Titulo del Reporte:</span>
  <label>
    <input type="text" name="titulo" id="titulo" size="100" value="<?php echo $titulo; ?>" />
  </label>
  <label>
    <input type="submit" name="guardartitulo" id="guardartitulo" value="Guardar" />
  </label>
</form>
<table border="1">
<tr>
<td bgcolor="#0183bf" class="titulo3">Tipo</td>
<td bgcolor="#0183bf" class="titulo3">Fecha</td>
<td bgcolor="#0183bf" class="titulo3">H. Inicial</td>
<td bgcolor="#0183bf" class="titulo3">H. Final</td>
<td bgcolor="#0183bf" class="titulo3">Facts.</td>
<td bgcolor="#0183bf" class="titulo3"></td>
</tr>
<tr>
<form name="formFact" id="formFact" method="get" action="final25.php" >
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="date" value="<?php echo $date; ?>"  />
<td><select name="tipo" class="textoField" id="tipo" onchange="submit()">
<option value="ARRIVAL MANEUVERS" <?php echo $var1; ?>>ARRIVAL MANEUVERS</option>
<option value="OPERATIONAL" <?php echo $var2; ?>>OPERATIONAL</option>
<option value="STOP/IDLE TIME" <?php echo $var3; ?>>STOP/IDLE TIME</option>
</select>
</td>
<td>
<span id="sprytextfield4">
<label>
  <input type="text" name="fecha" id="fecha" class="textoField" size="15" value="<?php echo $date; ?>" />
</label>
<span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span>
</td>
<td>
<span id="sprytextfield1">
<label>
  <input type="text" name="hinicial" id="hinicial" class="textoField" size="6" />
</label>
<span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span>
</td>
<td>
<span id="sprytextfield2">
<label>
  <input type="text" name="hfinal" id="hfinal" class="textoField" size="6" />
</label>
<span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span>
</td>
<td>
<span id="sprytextfield3">
<select name="na" id="na" onchange="fact.value=na.value" >
                  <option value="seleccionar...">Seleccionar...</option>
                    <?php
					$link=Conectar();
					$query = "select * from $tabla order by concepto";
					$result = mysql_query($query, $link);
					while($row = mysql_fetch_array($result)) {
						echo "<option value=\"".$row["concepto"]."\">".$row["concepto"]."</option>";
					}
					mysql_close($link);
				  ?>
</select><br />
<label>
  <input type="text" name="fact" id="fact" size="45"/>
</label>
<span class="textfieldRequiredMsg">Se necesita un valor.</span></span>
</td>
<td><label>
  <input type="submit" name="factnew" id="factnew" value="Enviar" />
</label>
</td>
</form>
</tr>
</table>

  <p>
      <?php
		////////////////OBTENER LOS DIAS ANTERIORES HASTA EL INDICADO
		$query = "select distinct fecha from computotiempo where id='$id' and (fecha between '$date' and (DATE_ADD('$date',INTERVAL 1 DAY))) order by fecha";
		//echo $query;
		$link=Conectar();
		$result = mysql_query($query, $link);
                $j=0;
                while($row = mysql_fetch_array($result))	{
                            $fechax[$j]=$row["fecha"];
                            $j++;
                        }
			?>
      <span class="localBd">
      <?php
		for($i=0; $i<=count($fechax); $i++)	{
		$buf=true;
		
		$query="select idcomputotiempo, fecha, hinicial, hfinal, fact from computotiempo where id='".$id."' and tipo='ARRIVAL MANEUVERS' and fecha='".$fechax[$i]."'order by hinicial";

			$result = mysql_query($query, $link);
			while($row = mysql_fetch_array($result)){
			$eliminar='<a href="final25.php?id='.$id.'&date='.$date.'&idcomputotiempo='.$row["idcomputotiempo"].'">eliminar</a>';
			setlocale(LC_TIME , 'es_ES');
			if($buf)	{
				$fecha=strftime('%B %d /%Y',strtotime($row["fecha"]));
				$buf=false;
				?>
      <font size="2" face="Tahoma"><strong><?php echo $fecha; ?></strong></font><br />
      <?php
			}
						$hora=$row["hinicial"];
                        $horafin=$row["hfinal"];						
			?>
      <font size="2" face="Tahoma">
      <?php
			  	$cadena = $row["fact"];
				$cadena = ucwords($cadena); // EN UN LUGAR DE LA MANCHA
				$cadena = ucwords(strtolower($cadena)); // de cuyo nombre no quiero acordarme

if($horafin!="24:00")	{	//if($horafin!="23:59:00")	{
echo strftime('%H:%M',strtotime($hora))."/".strftime('%H:%M',strtotime($horafin))." hrs.		".$cadena." ".$eliminar;  
} 
else
 echo strftime('%H:%M',strtotime($hora))."/24:00 hrs.		".$cadena." ".$eliminar;?>
      <br />
      </font>
      <?php
			}
		}
		?>
      </span><font face="Tahoma" size="2"><strong>OPERATIONAL</strong></font><br />
    <span class="localBd">
    <?php
		for($i=0; $i<=count($fechax); $i++)	{
		$buf=true;
		if($fechax[$i]==$date)
		$query="select idcomputotiempo, fecha, hinicial, hfinal, fact from computotiempo where id='".$id."' and tipo='OPERATIONAL' and fecha='".$fechax[$i]."' and hinicial>='08:00' order by hinicial";
		else
		$query="select idcomputotiempo, fecha, hinicial, hfinal, fact from computotiempo where id='".$id."' and tipo='OPERATIONAL' and fecha='".$fechax[$i]."' order by hinicial";

			$result = mysql_query($query, $link);
			while($row = mysql_fetch_array($result)){
			$eliminar='<a href="final25.php?id='.$id.'&date='.$date.'&idcomputotiempo='.$row["idcomputotiempo"].'">eliminar</a>';
			setlocale(LC_TIME , 'es_ES');
			if($buf)	{
				$fecha=strftime('%B %d /%Y',strtotime($row["fecha"]));
				$buf=false;
				?>
    <font size="2" face="Tahoma"><strong><?php echo $fecha; ?></strong></font><br />
    <?php
			}
						$hora=$row["hinicial"];
                        $horafin=$row["hfinal"];						
			?>
    <font size="2" face="Tahoma">
    <?php
			  	$cadena = $row["fact"];
				$cadena = ucwords($cadena); // EN UN LUGAR DE LA MANCHA
				$cadena = ucwords(strtolower($cadena)); // de cuyo nombre no quiero acordarme

if($horafin!="24:00")	{	//if($horafin!="23:59:00")	{
echo strftime('%H:%M',strtotime($hora))."/".strftime('%H:%M',strtotime($horafin))." hrs.		".$cadena." ".$eliminar;  
} 
else
 echo strftime('%H:%M',strtotime($hora))."/24:00 hrs.		".$cadena." ".$eliminar;?>
    <br />
    </font>
    <?php
			}
		}
		?>
    <font face="Tahoma"><strong>STOP/IDLE TIMES</strong></font> <br />
    <?php
		for($i=0; $i<=count($fechax); $i++)	{
		$buf=true;
		if($fechax[$i]==$date)
		$query="select idcomputotiempo, fecha, hinicial, hfinal, fact from computotiempo where id='".$id."' and tipo='STOP/IDLE TIME' and fecha='".$fechax[$i]."' and hinicial>='08:00' order by hinicial";
		else
		$query="select idcomputotiempo, fecha, hinicial, hfinal, fact from computotiempo where id='".$id."' and tipo='STOP/IDLE TIME' and fecha='".$fechax[$i]."' order by hinicial";

			$result = mysql_query($query, $link);
			while($row = mysql_fetch_array($result)){
			$eliminar='<a href="final25.php?id='.$id.'&date='.$date.'&idcomputotiempo='.$row["idcomputotiempo"].'">eliminar</a>';
			setlocale(LC_TIME , 'es_ES');
			if($buf)	{
				$fecha=strftime('%B %d /%Y',strtotime($row["fecha"]));
				$buf=false;
				?>
    <font size="2" face="Tahoma"><strong><?php echo $fecha; ?></strong></font><br />
    <?php
			}
			$hora=$row["hinicial"];
                        $horafin=$row["hfinal"];
						if((restaHorasInt($hora, "08:00")<0) and ($fechax[$i]==$date))   {
                            $hora="08:00";
                        }
                        else if((restaHorasInt($horafin, "08:00")>0) and ($fechax[$i]==$date1))  {
                            $horafin="08:00";
                        }
			
			?>
    <font size="2" face="Tahoma">
    <?php
  $cadena = $row["fact"];
				$cadena = ucwords($cadena); // EN UN LUGAR DE LA MANCHA
				$cadena = ucwords(strtolower($cadena)); // de cuyo nombre no quiero acordarme

if($horafin!="24:00")	{	//if($horafin!="23:59:00")	{
echo strftime('%H:%M',strtotime($hora))."/".strftime('%H:%M',strtotime($horafin))." hrs.		".$cadena." ".$eliminar;  
} 
else
 echo strftime('%H:%M',strtotime($hora))."/24:00 hrs.		".$cadena." ".$eliminar;?>
    <br />
    </font>
    <?php
			}
		}
		?>
    </span>
    </p>
</p><a name="quantities" id="quantities"></a>
<span class="tituloNormal"> Quantities <?php if($typex=="IMPORT") echo "Discharged"; else echo "Charged"; ?> </span><span class="texto">(
<label>
  <input name="tab1" type="checkbox" id="tab1" checked="checked" onchange="tab(this.value, 'quantitiesx')"/>
  Mostrar en Reporte</label>
)</span>
  <table width="247" border="1" cellspacing="2" cellpadding="0">
  <form name="quantitiesform" id="quantitiesform" method="get" action="final25.php#quantities" >
  <input type="hidden" name="id" value="<?php echo $id; ?>"  />
  <input type="hidden" name="date" value="<?php echo $date; ?>"  />
  <?php
			
			$totq=0.000;
			$dischq=0.000;
			$prevdq=0.000;
			$totdq=0.000;
			$tobedq=0.000;
														
			$query="select * from quantities where id='".$id."'";
			$result = mysql_query($query, $link);
			
			while($row = mysql_fetch_array($result)){
				$totq+=str_replace(",", "", $row["totq"]);
				$dischq+=str_replace(",", "", $row["dischq"]);
				$prevdq+=str_replace(",", "", $row["prevdq"]);
				$totdq+=str_replace(",", "", $row["totdq"]);
				$tobedq+=str_replace(",", "", $row["tobedq"]);
			}
				
				?>
  <tr>
    <td width="115" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>Total parcel to <?php if($typex=="IMPORT") echo "Discharge"; else echo "Charge"; ?></strong></font></td>
    <?php
		/*$query="select * from dhold where id='".$id."' order by hold";
			$result = mysql_query($query, $link);
			while($row = mysql_fetch_array($result)){
				$totq=str_replace(",", "", $row["inicial"]);	
			}*/
	?>
    <td width="120"><input type="text" name="totq" id="totq" class="textoField" value="<?php printf("%.3f", $totq);?>" /></td>
  </tr>
  <tr>
    <td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>Discharged Today</strong></font></td>
    <td><div align="right"> <font size="2" face="Tahoma">
      <label>
        <input type="text" name="dischq" id="dischq" class="textoField" value="<?php printf("%.3f", $dischq);?>"/>
      </label>
  </tr>
  <tr>
    <td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>Previous Discharge</strong></font></td>
    <td><input type="text" name="prevdq" id="prevdq" class="textoField" value="<?php printf("%.3f", $prevdq);?>" /><br />
    <input type="button" name="calcular" value="calcular" onclick="sumar();"  /></td>
  </tr>
  <tr>
    <td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>Total Discharged</strong></font></td>
    <td><input type="text" name="totdq" id="totdq" class="textoField" value=<?php printf("%.3f", $totdq); ?> /></td>
  </tr>
  <tr>
    <td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>To be Discharged</strong></font></td>
    <td><input type="text" name="tobedq" id="tobedq" class="textoField" value="<?php printf("%.3f", $tobedq); ?>" /></td>
  </tr>
  <tr>
    <td bgcolor="#0183bf"></td>
    <td><input type="submit" name="guardarquantities" value="Guardar"  /></td>
  </tr>  
  </form>
</table>
<br /><a name="hold" id="hold"></a>
<span class="tituloNormal"> Quantities Discharged per Hold</span>	<span class="texto">(
<label>
  <input name="tab2" type="checkbox" id="tab2" checked="checked" onchange="tab(this.value, 'holdx')" />
Mostrar en Reporte</label>
)</span>
<table width="954" border="1" cellspacing="2" cellpadding="0">
<tr>
				<td width="145" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>HOLD</strong></font></td>
                <td width="156" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>CARGO</strong></font></td>
				<td width="145" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>INITIAL TONNAGE</strong></font></td>
				<td width="81" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>PREVIOUS DISCH</strong></font></td>
				<td width="120" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>DAY DISCH</strong></font></td>
				<td width="58" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>TTL DISCH</strong></font></td>
				<td width="65" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>TO BE DISCH</strong></font></td>
				<td width="148" bgcolor="#0183bf" class="titulo3">OPTIONS</td>
  </tr>
			<?php
			
			/////////////REPORTE GENERAL DE DESCARGA POR BODEGAS
			$totales=array(0,0,0,0,0);
			unset($cv);			
			unset($inicial);
			//$query="select distinct bodega from chargeinformation where id='".$id."'";
			$query="select * from dhold where id='".$id."' order by hold";
			$result = mysql_query($query, $link);
			$i=0;
			while($row = mysql_fetch_array($result)){
//				$cv=array($i => $row["cv"]);
				$cv[$i]=$row["cv"];
//				$hold=array( $i => $row["hold"]);
				$hold[$i]=$row["hold"];
				$cargo[$i]=$row["cargo"];
				$inicial[$i]=str_replace(",", "", $row["inicial"]);	
				$i++;
			}
			
			for($j=0; $j<count($cv); $j++)	{			
				
				/////////////OBTENER LAS CANTIDADES DESCARGADAS HASTA EL DIA INDICADO
				$query="select cantidad from holdcargo where id='".$id."' and cv='".$cv[$j]."' and fecha<'$date'";
				$result = mysql_query($query, $link);
				$previo=0;
				while($row = mysql_fetch_array($result)){
				$previo+=str_replace(",", "", $row["cantidad"]);
				}
				
				/////////////OBTENER LAS CANTIDADES DESCARGADAS DEL DIA INDICADO
				$query="select cantidad from holdcargo where id='".$id."' and cv='".$cv[$j]."' and fecha='$date'";
				$result = mysql_query($query, $link);
				$descarga=0;
				while($row = mysql_fetch_array($result)){
				$descarga+=str_replace(",", "", $row["cantidad"]);
				}
				$totalHold=$previo+$descarga;
				$porDescargar=$inicial[$j]-($totalHold);
				
				
				$totales[0]+=$inicial[$j];
				$totales[1]+=$previo;
				$totales[2]+=$descarga;
				$totales[3]+=$totalHold;
				$totales[4]+=$porDescargar;
				
				?>
			<tr class="normal">
          <form name="form" method="get" action="final25.php#hold" >
				<td bgcolor="#0183bf" ><font size="2" color="white" face="Tahoma"><?php echo $hold[$j];?></font></td>
                <td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $cargo[$j]; ?></font></div>
				</td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo number_format($inicial[$j], 3, ".", ","); ?></font></div>
				</td>
				<td><div align="right">
						<font size="2" face="Tahoma"><?php echo number_format($previo, 3, ".", ",");?></font></div></td>
				<td><div align="right">
						<input type="text" name="cantidad" class="textoField" value="<?php echo number_format($descarga, 3, ".", ","); ?>"  /></div></td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo number_format($totalHold, 3, ".", ",");;?></font></div>
				</td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo number_format($porDescargar, 3, ".", ",");;?></font></div>
				</td>
				<td><input type="submit" name="guardarhold" id="guardarhold" value="Guardar" /><input type="submit" name="eliminarhold" id="eliminarhold" value="Eliminar" /></td>
            <input type="hidden" name="cv" id="cv" value="<?php echo $cv[$j]; ?>"  />
                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>"  />
			    <input type="hidden" name="date" id="date" value="<?php echo $date; ?>"  />
              </form>
			</tr>
			<?php
			
			}
				$totales[0]=number_format($totales[0], 3, ".", ",");
				$totales[1]=number_format($totales[1], 3, ".", ",");
				$totales[2]=number_format($totales[2], 3, ".", ",");
				$totales[3]=number_format($totales[3], 3, ".", ",");
				$totales[4]=number_format($totales[4], 3, ".", ",");
			?>
			<tr>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma">TTL</font></td>
                <td></td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $totales[0]; ?></font></div>
				</td>
				<td><div align="right">
						<font size="2" face="Tahoma"><?php echo $totales[1]; ?></font></div></td>
				<td><div align="right">
						<font size="2" face="Tahoma"><?php echo $totales[2]; ?></font></div></td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $totales[3]; ?></font></div>
				</td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $totales[4]; ?></font></div>
				</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
            <form name="form" id="form" method="get" action="final25.php#hold" >
			  <td bgcolor="#0183bf"><label>
			    <input type="text" name="hold" id="hold" />
		      </label></td>
			  <td><label>
			    <input type="text" name="cargo" id="cargo" />
		      </label></td>
			  <td><label>
			    <input type="text" name="inicial" id="inicial" />
		      </label></td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td><label>
			    <input type="submit" name="dhold" id="dhold" value="Agregar" />
		      </label></td>
              <input type="hidden" name="id" id="id" value="<?php echo $id; ?>"  />
              <input type="hidden" name="date" id="date" value="<?php echo $date; ?>"  />
              </form>
  </tr>
</table>
<br /><a name="receiver" id="receiver"></a>
<span class="tituloNormal">Quantities Discharged per Receiver</span> <span class="texto">(
<label>
  <input name="tab3" type="checkbox" id="tab3" checked="checked" onchange="tab(this.value, 'receiverx')"/>
  Mostrar en Reporte</label>
)</span><br />
<table width="894" border="1" cellspacing="2" cellpadding="0">
<tr>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>RECEIVER</strong></font></td>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>INITIAL TONNAGE</strong></font></td>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>PREVIOUS DISCH</strong></font></td>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>DAY DISCH</strong></font></td>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>TTL DISCH</strong></font></td>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>TO BE DISCH</strong></font></td>
				<td bgcolor="#0183bf" class="titulo3">OPTIONS</td>
  </tr>
			               
                <?php
			////////////////////////////aqui
			/////////////REPORTE GENERAL DE DESCARGA POR RECIVIDOR
			$totales=array(0,0,0,0,0);
			unset($cv);			
			unset($inicial);
			//$query="select distinct bodega from chargeinformation where id='".$id."'";
			$query="select * from dreceiver where id='".$id."' order by receiver";
			$result = mysql_query($query, $link);
			$i=0;
			while($row = mysql_fetch_array($result)){
				//$cv=array($i => $row["cv"]);
				//$receiver=array( $i => $row["receiver"]);
				$cv[$i]=$row["cv"];
				$receiver[$i]=$row["receiver"];
				//$cargo=array($i => $row["cargo"]);
				$inicial[$i]=str_replace(",", "", $row["inicial"]);	
				$i++;
			}			
			for($j=0; $j<count($cv); $j++)	{			
				
				/////////////OBTENER LAS CANTIDADES DESCARGADAS HASTA EL DIA INDICADO
				$query="select cantidad from receivercargo where id='".$id."' and cv='".$cv[$j]."' and fecha<'$date'";
				$result = mysql_query($query, $link);
				$previo=0;
				while($row = mysql_fetch_array($result)){
				$previo+=str_replace(",", "", $row["cantidad"]);
				}
				
				/////////////OBTENER LAS CANTIDADES DESCARGADAS DEL DIA INDICADO
				$query="select cantidad from receivercargo where id='".$id."' and cv='".$cv[$j]."' and fecha='$date'";
				$result = mysql_query($query, $link);
				$descarga=0;
				while($row = mysql_fetch_array($result)){
				$descarga+=str_replace(",", "", $row["cantidad"]);
				}
				$totalHold=$previo+$descarga;
				$porDescargar=$inicial[$j]-($totalHold);
				
				
				$totales[0]+=$inicial[$j];
				$totales[1]+=$previo;
				$totales[2]+=$descarga;
				$totales[3]+=$totalHold;
				$totales[4]+=$porDescargar;
				
				?>
			<tr class="normal">
            <form name="form" method="get" action="final25.php#receiver" >
				<td bgcolor="#0183bf" ><font size="2" color="white" face="Tahoma"><?php echo $receiver[$j];?></font></td>
                <td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo number_format($inicial[$j], 3, ".", ","); ?></font></div>
				</td>
				<td><div align="right">
						<font size="2" face="Tahoma"><?php echo number_format($previo, 3, ".", ",");?></font></div></td>
				<td><div align="right">
						<input type="text" name="cantidad" class="textoField" value="<?php echo number_format($descarga, 3, ".", ","); ?>"  /></div></td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo number_format($totalHold, 3, ".", ",");?></font></div>
				</td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo number_format($porDescargar, 3, ".", ",");?></font></div>
				</td>
				<td><input type="submit" name="guardarreceiver" id="guardarreceiver" value="Guardar" /><input type="submit" name="eliminarreceiver" id="eliminarreceiver" value="Eliminar" /></td>
                <input type="hidden" name="cv" id="cv" value="<?php echo $cv[$j]; ?>"  />
                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>"  />
			    <input type="hidden" name="date" id="date" value="<?php echo $date; ?>"  />
              </form>
			</tr>
			<?php
			
			}
			$totales[0]=number_format($totales[0], 3, ".", ",");
				$totales[1]=number_format($totales[1], 3, ".", ",");
				$totales[2]=number_format($totales[2], 3, ".", ",");
				$totales[3]=number_format($totales[3], 3, ".", ",");
				$totales[4]=number_format($totales[4], 3, ".", ",");
			?>
			<tr>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma">TTL</font></td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $totales[0]; ?></font></div>
				</td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $totales[1]; ?></font></div>
				</td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $totales[2]; ?></font></div>
				</td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $totales[3]; ?></font></div>
				</td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $totales[4]; ?></font></div>
				</td>
				<td>&nbsp;</td>
			</tr>
            <tr>
            <form name="form" id="form" method="get" action="final25.php#receiver" >
			  <td bgcolor="#0183bf"><label>
			    <input type="text" name="receiver" id="receiver" />
		      </label></td>			  
			  <td><label>
			    <input type="text" name="inicial" id="inicial" />
		      </label></td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td><label>
			    <input type="submit" name="dreceiver" id="dreceiver" value="Agregar" />
		      </label></td>
              <input type="hidden" name="id" id="id" value="<?php echo $id; ?>"  />
              <input type="hidden" name="date" id="date" value="<?php echo $date; ?>"  />
              </form>
  </tr>			
</table>
<br /><a name="product" id="product"></a>
<span class="tituloNormal">Quantities Discharged per Product</span> <span class="texto">(
<label>
  <input name="tab4" type="checkbox" id="tab4" checked="checked" onchange="tab(this.value, 'productx')"/>
  Mostrar en Reporte</label>
)</span><br />
<table width="894" border="1" cellspacing="2" cellpadding="0">
  <tr>
    <td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>PRODUCT</strong></font></td>
    <td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>INITIAL TONNAGE</strong></font></td>
    <td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>PREVIOUS DISCH</strong></font></td>
    <td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>DAY DISCH</strong></font></td>
    <td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>TTL DISCH</strong></font></td>
    <td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>TO BE DISCH</strong></font></td>
    <td bgcolor="#0183bf" class="titulo3">OPTIONS</td>
  </tr>
  <?php
			////////////////////////////aqui
			/////////////REPORTE GENERAL DE DESCARGA POR Producto
			$totales=array(0,0,0,0,0);
			unset($cv);			
			unset($inicial);
			//$query="select distinct bodega from chargeinformation where id='".$id."'";
			$query="select * from dproduct where id='".$id."' order by product";
			$result = mysql_query($query, $link);
			$i=0;
			while($row = mysql_fetch_array($result)){
				//$cv=array($i => $row["cv"]);
				//$receiver=array( $i => $row["receiver"]);
				$cv[$i]=$row["cv"];
				$product[$i]=$row["product"];
				//$cargo=array($i => $row["cargo"]);
				$inicial[$i]=str_replace(",", "", $row["inicial"]);	
				$i++;
			}			
			for($j=0; $j<count($cv); $j++)	{			
				
				/////////////OBTENER LAS CANTIDADES DESCARGADAS HASTA EL DIA INDICADO
				$query="select cantidad from productcargo where id='".$id."' and cv='".$cv[$j]."' and fecha<'$date'";
				$result = mysql_query($query, $link);
				$previo=0;
				while($row = mysql_fetch_array($result)){
				$previo+=str_replace(",", "", $row["cantidad"]);
				}
				
				/////////////OBTENER LAS CANTIDADES DESCARGADAS DEL DIA INDICADO
				$query="select cantidad from productcargo where id='".$id."' and cv='".$cv[$j]."' and fecha='$date'";
				$result = mysql_query($query, $link);
				$descarga=0;
				while($row = mysql_fetch_array($result)){
				$descarga+=str_replace(",", "", $row["cantidad"]);
				}
				$totalHold=$previo+$descarga;
				$porDescargar=$inicial[$j]-($totalHold);
				
				
				$totales[0]+=$inicial[$j];
				$totales[1]+=$previo;
				$totales[2]+=$descarga;
				$totales[3]+=$totalHold;
				$totales[4]+=$porDescargar;
				
				?>
  <tr class="normal">
    <form action="final25.php#product" method="get" name="form" id="form2" >
      <td bgcolor="#0183bf" ><font size="2" color="white" face="Tahoma"><?php echo $product[$j];?></font></td>
      <td><div align="right"> <font size="2" face="Tahoma"><?php echo number_format($inicial[$j], 3, ".", ","); ?></font></div></td>
      <td><div align="right"> <font size="2" face="Tahoma"><?php echo number_format($previo, 3, ".", ",");?></font></div></td>
      <td><div align="right">
        <input type="text" name="cantidad" class="textoField" value="<?php echo number_format($descarga, 3, ".", ","); ?>"  />
      </div></td>
      <td><div align="right"> <font size="2" face="Tahoma"><?php echo number_format($totalHold, 3, ".", ",");?></font></div></td>
      <td><div align="right"> <font size="2" face="Tahoma"><?php echo number_format($porDescargar, 3, ".", ",");?></font></div></td>
      <td><input type="submit" name="guardarproduct" id="guardarproduct" value="Guardar" />
        <input type="submit" name="eliminarproduct" id="eliminarproduct" value="Eliminar" /></td>
      <input type="hidden" name="cv" id="cv" value="<?php echo $cv[$j]; ?>"  />
      <input type="hidden" name="id" id="id" value="<?php echo $id; ?>"  />
      <input type="hidden" name="date" id="date" value="<?php echo $date; ?>"  />
    </form>
  </tr>
  <?php
			
			}
			$totales[0]=number_format($totales[0], 3, ".", ",");
				$totales[1]=number_format($totales[1], 3, ".", ",");
				$totales[2]=number_format($totales[2], 3, ".", ",");
				$totales[3]=number_format($totales[3], 3, ".", ",");
				$totales[4]=number_format($totales[4], 3, ".", ",");
			?>
  <tr>
    <td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma">TTL</font></td>
    <td><div align="right"> <font size="2" face="Tahoma"><?php echo $totales[0]; ?></font></div></td>
    <td><div align="right"> <font size="2" face="Tahoma"><?php echo $totales[1]; ?></font></div></td>
    <td><div align="right"> <font size="2" face="Tahoma"><?php echo $totales[2]; ?></font></div></td>
    <td><div align="right"> <font size="2" face="Tahoma"><?php echo $totales[3]; ?></font></div></td>
    <td><div align="right"> <font size="2" face="Tahoma"><?php echo $totales[4]; ?></font></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <form name="form" id="form2" method="get" action="final25.php#product" >
      <td bgcolor="#0183bf"><label>
        <input type="text" name="product" id="product" />
      </label></td>
      <td><label>
        <input type="text" name="inicial" id="inicial" />
      </label></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><label>
        <input type="submit" name="dproduct" id="dproduct" value="Agregar" />
      </label></td>
      <input type="hidden" name="id" id="id" value="<?php echo $id; ?>"  />
      <input type="hidden" name="date" id="date" value="<?php echo $date; ?>"  />
    </form>
  </tr>
</table>
<form name="final" id="final" method="get" action="final35.php" >
<input type="hidden" name="id" id="id" value="<?php echo $id; ?>"  />
    <input type="hidden" name="date" id="date" value="<?php echo $date; ?>"  />
  <label>
  <input type="hidden" name="quantitiesx" id="quantitiesx" value="on" />
  <input type="hidden" name="holdx" id="holdx" value="on" />
  <input type="hidden" name="receiverx" id="receiverx" value="on" />
  <input type="hidden" name="productx" id="productx" value="on" />
    Seleccione el reporte que desea consultar:
    <select name="reporte">
    	<option value="arrival">ARRIVAL</option>
        <option value="pre">Preliminar</option>
        <option value="24">24 Hrs.</option>        
    </select>
    <br />
    <input type="submit" name="button" id="button" value="Consultar Reporte Final" />
  </label>
  </form>
<br />
<br />
<script>
function sumar()	{
	var dtot=parseFloat(document.quantitiesform.dischq.value)+parseFloat(document.quantitiesform.prevdq.value);	
	document.quantitiesform.totdq.value=dtot.toFixed(3);
	var dfalt=parseFloat(document.quantitiesform.totq.value)-parseFloat(document.quantitiesform.totdq.value);
	document.quantitiesform.tobedq.value=dfalt.toFixed(3);	
}
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "custom", {pattern:"00:00", hint:"hh:mm"});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "custom", {pattern:"00:00", hint:"hh:mm"});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "date", {format:"yyyy-mm-dd", hint:"yyyy-mm-dd"});
</script>
<?php
function restaHorasInt($horaIni, $horaFin) {
                $hora1=$horaIni;
                $hora2=$horaFin;
                $hora1=split(":",$hora1);
                $hora2=split(":",$hora2);
                $horas=(int)$hora1[0]-(int)$hora2[0];
                $minutos=(int)$hora1[1]-(int)$hora2[1];
                $minutos+=$horas*60;
                return $minutos;
            }
			?>
            <SCRIPT>
function change()	{
	  document.forms[0].fact.value=document.forms[0].na.value;
	  document.forms[0].fact.focus();
  }
  function tab(valor, elemento)	{
	  document.getElementById(elemento).value=valor;	  
  }
  </SCRIPT>
</body>
</html>
