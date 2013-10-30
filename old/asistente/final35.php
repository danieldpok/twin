<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>REPORTE</title>
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

<body class="fondo">
  <p>
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
	mysql_query($query, $link);
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
	mysql_query($query, $link);
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
	mysql_query($query, $link);
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
	mysql_query($query, $link);
	mysql_close($link);
}
//////////////////////////////////////////////////////////////////////////
else if(isset($_GET["dproduct"]))	{
	$link = Conectar();
		
	$id=$_GET["id"];
	$productx=$_GET["product"];
	$cvx=$_GET["product"];
	$inicial=$_GET["inicial"];
	
	$query="insert into dproduct (cv, id, product, inicial) values ('$cvx', '$id', '$productx', '$inicial')";
	mysql_query($query, $link);
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
	mysql_query($query, $link);
	mysql_close($link);
}	else if(isset($_GET["factnew"]))	{
	$id=$_GET["id"];
	$tipo=$_GET["tipo"];
	$fecha=$_GET["fecha"];
	$hinicial=$_GET["hinicial"];
	$hfinal=$_GET["hfinal"];
	$fact=$_GET["fact"];
	
	$link = Conectar();
	$query="insert into computotiempo (id, tipo, fecha, hinicial, hfinal, fact) values ('$id', '$tipo', '$fecha', '$hinicial', '$hfinal', '$fact')";
	mysql_query($query, $link);
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
}

//DATOS DEL REGISTRO
$table="operaciones";
$fields="vessel, flag, puertodecarga, quantity, cargotype, maxarrivaldraftmt, titulo";

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

}
?>
  </p><?php if(false)	{ ?>
<table width="330" border="1" cellspacing="2" cellpadding="0" class="texto">
  <tr>
    <td width="148" bgcolor="#0183bf" class="titulo3">VESSEL:</td>
    <td width="226"><?php echo $vessel; ?></td>
  </tr>
  <tr>
    <td bgcolor="#0183bf" class="titulo3">CARGO:</td>
    <td><?php echo $cargaentransito;  ?></td>
  </tr>
  <tr>
    <td bgcolor="#0183bf" class="titulo3">QUANTITY:</td>
    <td><?php echo $quantity; ?></td>
  </tr>
  <tr>
    <td bgcolor="#0183bf" class="titulo3">LOADING PORT:</td>
    <td><?php echo $puertodecarga; ?></td>
  </tr>
  <tr>
    <td bgcolor="#0183bf" class="titulo3">MAXIMUM ARRIVAL DRAFT:</td>
    <td><?php echo $maxarrivaldraftmt;  ?></td>
  </tr>
</table>
<?php } ?>
<span class="tituloNormal2"><?php echo $vessel; ?></span><br />
<span class="tituloNormal2"><?php echo $titulo; ?></span><br />
<?php if($_GET["reporte"]!="arrival")	{ ?><?php
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
		for($i=0; $i<=count($fechax); $i++)	{
		$buf=true;
		if($fechax[$i]==$date)
		//$query="select idcomputotiempo, fecha, hinicial, hfinal, fact from computotiempo where id='".$id."' and tipo='OPERATIONAL' and fecha='".$fechax[$i]."' and hinicial>='08:00' order by hinicial";
////correccion solicitada
$query="select idcomputotiempo, fecha, hinicial, hfinal, fact from computotiempo where id='".$id."' and tipo='OPERATIONAL' and fecha='".$fechax[$i]."' order by hinicial";
		else
		$query="select idcomputotiempo, fecha, hinicial, hfinal, fact from computotiempo where id='".$id."' and tipo='OPERATIONAL' and fecha='".$fechax[$i]."' order by hinicial";

			$result = mysql_query($query, $link);
			while($row = mysql_fetch_array($result)){
			//$eliminar='<a href="final25.php?id='.$id.'&date='.$date.'&idcomputotiempo='.$row["idcomputotiempo"].'">eliminar</a>';
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
echo strftime('%H:%M',strtotime($hora))."/".strftime('%H:%M',strtotime($horafin))." hrs.		".$cadena." ";  
} 
else
 echo strftime('%H:%M',strtotime($hora))."/24:00 hrs.		".$cadena." ";?>
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
			//$eliminar='<a href="final25.php?id='.$id.'&date='.$date.'&idcomputotiempo='.$row["idcomputotiempo"].'">eliminar</a>';
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
echo strftime('%H:%M',strtotime($hora))."/".strftime('%H:%M',strtotime($horafin))." hrs.		".$cadena." ";  
} 
else
 echo strftime('%H:%M',strtotime($hora))."/24:00 hrs.		".$cadena." ";?>
    <br />
    </font>
    <?php
			}
		}
		?>
    </span>
<?php
}
//}   /////if reporte != arrival
		?>
<?php if($_GET["reporte"]=="arrival")	{ ?>
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
            
<br />
<span class="localBd">
<?php
		for($i=0; $i<=count($fechax); $i++)	{
		$buf=true;
		$query="select fecha, hinicial, hfinal, fact from computotiempo where id='".$id."' and tipo='ARRIVAL MANEUVERS' and fecha='".$fechax[$i]."' order by hinicial";
			$result = mysql_query($query, $link);
			while($row = mysql_fetch_array($result)){
			
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
	
echo strftime('%H:%M',strtotime($hora))."/".strftime('%H:%M',strtotime($horafin))." hrs.		".$cadena;  
} else	{
	
 echo strftime('%H:%M',strtotime($hora))."/24:00 hrs.		".$cadena;
}
 ?>
<br />
</font>
<?php
			}
		}
}
////////////////////////////////////////////
?>


</span>
<?php if($_GET["quantitiesx"]=="on")	{ ?>
<span class="tituloNormal"> Quantities Discharged </span>
<table width="247" border="1" cellspacing="2" cellpadding="0" class="texto">
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
    <td width="115" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>Total parcel to Discharge</strong></font></td>
    <td width="120"><?php echo number_format($totq, 3, ".", ","); ?></td>
  </tr>
  <tr>
    <td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>Discharged Today</strong></font></td>
    <td><?php echo number_format($dischq, 3, ".", ","); ?></td>      
  </tr>
  <tr>
    <td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>Previous Discharge</strong></font></td>
    <td><?php echo number_format($prevdq, 3, ".", ","); ?></td>
  </tr>
  <tr>
    <td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>Total Discharged</strong></font></td>
    <td><?php echo number_format($totdq, 3, ".", ","); ?></td>
  </tr>
  <tr>
    <td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>To be Discharged</strong></font></td>
    <td><?php echo number_format($tobedq, 3, ".", ","); ?></td>
  </tr>
</table>
<?php } 
if($_GET["holdx"]=="on")	{
	?>
<br />
<span class="tituloNormal"> Quantities Discharged per Hold</span>
<table width="882" border="1" cellspacing="2" cellpadding="0" class="texto">
  <tr>
				<td width="157" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>HOLD</strong></font></td>
                <td width="145" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>CARGO</strong></font></td>
				<td width="117" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>INITIAL TONNAGE</strong></font></td>
				<td width="121" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>PREVIOUS DISCH</strong></font></td>
				<td width="111" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>DAY DISCH</strong></font></td>
				<td width="106" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>TTL DISCH</strong></font></td>
				<td width="93" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>TO BE DISCH</strong></font></td>
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
				<td><div align="right"><?php echo number_format($descarga, 3, ".", ","); ?></div></td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo number_format($totalHold, 3, ".", ",");;?></font></div>
				</td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo number_format($porDescargar, 3, ".", ",");;?></font></div>
				</td>
				
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
				</tr>
</table>
<br /><?php }
if($_GET["receiverx"]=="on")	{
	?>
<span class="tituloNormal">Quantities Discharged per Receiver</span><br />
<table width="781" border="1" cellspacing="2" cellpadding="0" class="texto">
<tr>
				<td width="141" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>RECEIVER</strong></font></td>
				<td width="156" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>INITIAL TONNAGE</strong></font></td>
				<td width="122" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>PREVIOUS DISCH</strong></font></td>
				<td width="121" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>DAY DISCH</strong></font></td>
				<td width="111" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>TTL DISCH</strong></font></td>
				<td width="102" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>TO BE DISCH</strong></font></td>
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
				<td bgcolor="#0183bf" ><font size="2" color="white" face="Tahoma"><?php echo $receiver[$j];?></font></td>
                <td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo number_format($inicial[$j], 3, ".", ","); ?></font></div>
				</td>
				<td><div align="right">
						<font size="2" face="Tahoma"><?php echo number_format($previo, 3, ".", ",");?></font></div></td>
				<td><div align="right"><?php echo number_format($descarga, 3, ".", ","); ?></div></td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo number_format($totalHold, 3, ".", ",");?></font></div>
				</td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo number_format($porDescargar, 3, ".", ",");?></font></div>
				</td>				
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
			</tr>			
</table>
<br /><?php }
if($_GET["productx"]=="on")	{
	?>
<span class="tituloNormal">Quantities Discharged per Product</span><br />
<table width="781" border="1" cellspacing="2" cellpadding="0" class="texto">
  <tr>
    <td width="140" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>PRODUCT</strong></font></td>
    <td width="155" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>INITIAL TONNAGE</strong></font></td>
    <td width="124" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>PREVIOUS DISCH</strong></font></td>
    <td width="121" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>DAY DISCH</strong></font></td>
    <td width="111" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>TTL DISCH</strong></font></td>
    <td width="102" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>TO BE DISCH</strong></font></td>
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
      <td bgcolor="#0183bf" ><font size="2" color="white" face="Tahoma"><?php echo $product[$j];?></font></td>
      <td><div align="right"> <font size="2" face="Tahoma"><?php echo number_format($inicial[$j], 3, ".", ","); ?></font></div></td>
      <td><div align="right"> <font size="2" face="Tahoma"><?php echo number_format($previo, 3, ".", ",");?></font></div></td>
      <td><div align="right"><?php echo number_format($descarga, 3, ".", ","); ?></div></td>
      <td><div align="right"> <font size="2" face="Tahoma"><?php echo number_format($totalHold, 3, ".", ",");?></font></div></td>
      <td><div align="right"> <font size="2" face="Tahoma"><?php echo number_format($porDescargar, 3, ".", ",");?></font></div></td>
      
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
  </tr>
</table>
<?php } ?>
<script>
function sumar()	{
	var dtot=parseFloat(document.formu.descargahoy.value)+parseFloat(document.formu.descargaprevia.value);	
	document.formu.descargatotal.value=dtot.toFixed(3);
	var dfalt=parseFloat(document.formu.total.value)-parseFloat(document.formu.descargatotal.value);
	document.formu.descargafaltante.value=dfalt.toFixed(3);	
}
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
  </SCRIPT>
</body>
</html>
