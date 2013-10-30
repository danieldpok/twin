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
</head>

<body class="fondo">
  <?php
include("conexion.php");
$id=$_GET["id"];
$date=$_GET["date"];
$date1=$_GET["date1"];
$no=$_GET["no"];
//DATOS DEL REGISTRO
$table="operaciones";
$fields="vessel, flag, puertodecarga, quantity, cargaentransito, maxarrivaldraftmt, sailed";

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
$sailed=$row["sailed"];

}
?>
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
</table><br />
<span class="tituloNormal">OPERATIONAL REPORT</span>
<?php
		////////////////OBTENER LOS DIAS ANTERIORES HASTA EL INDICADO
		$query = "select distinct fecha from computotiempo where id='$id' and (fecha between '$date' and '$date1') order by fecha";
		//echo $queryA;
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
		$query="select fecha, hinicial, hfinal, fact from computotiempo where id='".$id."' and tipo='OPERATIONAL' and fecha='".$fechax[$i]."' and ((fecha ='$date' and hfinal>='08:00') or (fecha ='$date1' and hinicial<='08:00')) order by hinicial";
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
echo strftime('%H:%M',strtotime($hora))."/".strftime('%H:%M',strtotime($horafin))." hrs.		".$cadena;  
} 
else
 echo strftime('%H:%M',strtotime($hora))."/24:00 hrs.		".$cadena;?>
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
		$query="select fecha, hinicial, hfinal, fact from computotiempo where id='".$id."' and tipo='STOP/IDLE TIME' and fecha='".$fechax[$i]."' and ((fecha ='$date' and hfinal>='08:00') or (fecha ='$date1' and hinicial<='08:00')) order by hinicial";
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
echo strftime('%H:%M',strtotime($hora))."/".strftime('%H:%M',strtotime($horafin))." hrs.		".$cadena;  
} 
else
 echo strftime('%H:%M',strtotime($hora))."/24:00 hrs.		".$cadena;?>
<br />
</font>
<?php
			}
		}
		?>
</span><p></p><form name="formu" id="formu" method="get" action="final3.php">
<span class="tituloNormal"> Quantities Discharged </span><span class="texto">(
<label>
  <input name="quantities" type="checkbox" id="quantities" checked="checked" />
  Mostrar en Reporte</label>
, <a href="registros4.php?id=<?php echo $id; ?>">modificar valores</a> )</span>
  <table width="247" border="1" cellspacing="2" cellpadding="0">
  <?php
			
			$totalDescarga=0.000;
			$descargadoDia=0.000;
			$descargaPrevia=0.000;
			
											
			//$query="select distinct bodega from chargeinformation where id='".$id."'";
			$query="select pesoneto from chargeinformation where id='".$id."'";
			$result = mysql_query($query, $link);
			
			while($row = mysql_fetch_array($result)){
				$totalDescarga+=str_replace(",", "", $row["pesoneto"]);
			}
			
			//$query="select distinct bodega from chargeinformation where id='".$id."'";
			$query="select cantidad from descargabodegas where id='".$id."' and fecha<='$date'";
			$result = mysql_query($query, $link);
			
			while($row = mysql_fetch_array($result)){
				$descargaPrevia+=str_replace(",", "", $row["cantidad"]);
			}
			
			$descargadoDia=$_GET["descarga"];
				
				?>
  <tr>
    <td width="115" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>Total parcel to Discharge</strong></font></td>
    <td width="120"><input type="text" name="total" id="total" class="textoField" value="<?php printf("%.3f", $totalDescarga);?>" readonly="readonly" /></td>
  </tr>
  <tr>
    <td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>Discharged Today</strong></font></td>
    <td><div align="right"> <font size="2" face="Tahoma">
      <label>
        <input type="text" name="descargahoy" id="descargahoy" class="textoField"/>
        <input type="button" name="calcular" value="calcular" onclick="sumar();"  />
      </label>
  </tr>
  <tr>
    <td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>Previous Discharge</strong></font></td>
    <td><input type="text" name="descargaprevia" id="descargaprevia" class="textoField" value="<?php printf("%.3f", $descargaPrevia);?>" readonly="readonly" /></td>
  </tr>
  <tr>
    <td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>Total Discharged</strong></font></td>
    <td><input type="text" name="descargatotal" id="descargatotal" class="textoField" readonly="readonly" /></td>
  </tr>
  <tr>
    <td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>To be Discharged</strong></font></td>
    <td><input type="text" name="descargafaltante" id="descargafaltante" class="textoField" readonly="readonly" /></td>
  </tr>
</table>
<br />
<span class="tituloNormal"> Quantities Discharged per Hold</span>	<span class="texto">(
<label>
  <input name="hold" type="checkbox" id="hold" checked="checked" />
Mostrar en Reporte</label>
, <a href="registros4.php?id=<?php echo $id; ?>">modificar valores</a>
)</span>
<table width="894" border="1" cellspacing="2" cellpadding="0">
<tr>
				<td width="60" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>HOLD</strong></font></td>
                <td width="192" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>CARGO</strong></font></td>
				<td width="121" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>INITIAL TONNAGE</strong></font></td>
				<td width="124" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>PREVIOUS DISCH</strong></font></td>
				<td width="117" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>DAY DISCH</strong></font></td>
				<td width="111" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>TTL DISCH</strong></font></td>
				<td width="137" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>TO BE DISCH</strong></font></td>
			</tr>
			<?php
			
			/////////////REPORTE GENERAL DE DESCARGA POR BODEGAS
			$totales=array(0,0,0,0,0);

						
			//$query="select distinct bodega from chargeinformation where id='".$id."'";
			$query="select distinct bodega from pesobodega where id='".$id."' order by bodega";
			$result = mysql_query($query, $link);
			
			$i=0;
			while($row = mysql_fetch_array($result)){
			$bodega[$i]=$row["bodega"];
			$i++;
			}
			
			for($j=0; $j<count($bodega); $j++)	{
			
				
				/////////////OBTENER LAS CANTIDADES DESCARGADAS HASTA EL DIA INDICADO
				$query="select cantidad from descargabodegas where id='".$id."' and bodega='".$bodega[$j]."'  and fecha<='$date1'";
				$result = mysql_query($query, $link);
				$cantidadTotal=0;
				while($row = mysql_fetch_array($result)){
				$cantidadTotal+=str_replace(",", "", $row["cantidad"]);
				}
				/////////////OBTENER LOS PRODUCTOS
				$query="select producto from pesobodega where id='".$id."' and bodega='".$bodega[$j]."'";
				$result = mysql_query($query, $link);
				$bf=0;
				while($row = mysql_fetch_array($result)){
					if($bf==0)	{
						$producto=$row["producto"];
						$abreviacion=$row["abreviacion"];
						$bf=1;
					}
					else	{
						$producto=$producto.", ".$row["producto"];
						$abreviacion=$abreviacion.", ".$row["abreviacion"];
					}
				}
				/////////////OBTENER LAS CANTIDADES DESCARGADAS HASTA EL DIA ANTERIOR AL INDICADO
				$query="select cantidad from descargabodegas where id='".$id."' and bodega='".$bodega[$j]."'  and fecha<'$date1'";
				$result = mysql_query($query, $link);
				$cantidadAnterior=0;
				while($row = mysql_fetch_array($result)){
				$cantidadAnterior+=str_replace(",", "", $row["cantidad"]);
				}
				/////////////OBTENER LAS CANTIDADES DESCARGADAS DE EL DIA INDICADO
				$query="select cantidad from descargabodegas where id='".$id."' and bodega='".$bodega[$j]."'  and fecha='$date1'";
				$result = mysql_query($query, $link);
				$cantidadDia=0;
				while($row = mysql_fetch_array($result)){
				$cantidadDia+=str_replace(",", "", $row["cantidad"]);
				}
				////////////////OBTENER EL TOTAL INICIAL
				$query="select pesototal from pesobodega where id='".$id."' and bodega='".$bodega[$j]."'";
				$result = mysql_query($query, $link);
				while($row = mysql_fetch_array($result)){
				$pesototal+=str_replace(",", "", $row["pesototal"]);
				}
				
				$totales[0]+=$pesototal;
				$totales[1]+=$cantidadTotal;
				$totales[2]+=$pesototal-$cantidadTotal;
				$totales[3]+=$cantidadAnterior;
				$totales[4]+=$cantidadDia;
				
				
				$toDisch=number_format($pesototal-$cantidadTotal, 3, ".", ",");
				$pesototal=number_format($pesototal, 3, ".", ",");
	    		$cantidadAnterior=number_format($cantidadAnterior, 3, ".", ",");
	    		$cantidadDia=number_format($cantidadDia, 3, ".", ",");
	    		$cantidadTotal=number_format($cantidadTotal, 3, ".", ",");
				
				?>
			<tr class="normal">
				<td bgcolor="#0183bf" ><font size="2" color="white" face="Tahoma"><?php echo $bodega[$j];?></font></td>
                <td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $abreviacion; $producto="";?></font></div>
				</td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $pesototal; $pesototal=0;?></font></div>
				</td>
				<td><div align="right">
						<font size="2" face="Tahoma"><?php echo $cantidadAnterior;?></font></div></td>
				<td><div align="right">
						<font size="2" face="Tahoma"><?php echo $cantidadDia;?></font></div></td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $cantidadTotal;?></font></div>
				</td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $toDisch;?></font></div>
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
						<font size="2" face="Tahoma"><?php echo $totales[3]; ?></font></div></td>
				<td><div align="right">
						<font size="2" face="Tahoma"><?php echo $totales[4]; ?></font></div></td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $totales[1]; ?></font></div>
				</td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $totales[2]; ?></font></div>
				</td>
			</tr>
		</table><br />
<span class="tituloNormal">Quantities Discharged per Receiver</span> <span class="texto">(
<label>
  <input name="receiver" type="checkbox" id="receiver" checked="checked" />
  Mostrar en Reporte</label>
, <a href="registros4.php?id=<?php echo $id; ?>">modificar valores</a> )</span><br />
<table width="894" border="1" cellspacing="2" cellpadding="0">
<tr>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>RECEIVER</strong></font></td>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>INITIAL TONNAGE</strong></font></td>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>PREVIOUS DISCH</strong></font></td>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>DAY DISCH</strong></font></td>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>TTL DISCH</strong></font></td>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>TO BE DISCH</strong></font></td>
  </tr>
			<?php
			
			//---REPORTE GENERAL DE DESCARGA POR RECIVIDOR ---- DAKA TECHNOLOGY---- PROP. INTELECTUAL DANIEL A. KENNEDY AYALA-----
			$totales=array(0,0,0);

						
			$query="select distinct recibidor from chargeinformation where id='".$id."'";
			$result = mysql_query($query, $link);
			$i=0;
			while($row = mysql_fetch_array($result)){
			$recibidor[$i]=$row["recibidor"];
			$i++;
			}
			
			for($j=0; $j<count($recibidor); $j++)	{
			
				
				/////////////OBTENER LAS CANTIDADES DESCARGADAS HASTA EL DIA INDICADO
				$query="select cantidad from descargarecibidor where id='".$id."' and recibidor='".$recibidor[$j]."'  and fecha<='$date1'";
				$result = mysql_query($query, $link);
				$cantidadTotal=0;
				while($row = mysql_fetch_array($result)){
				$cantidadTotal+=str_replace(",", "", $row["cantidad"]);
				}
				/////////////OBTENER LAS CANTIDADES DESCARGADAS HASTA EL DIA ANTERIOR AL INDICADO
				$query="select cantidad from descargarecibidor where id='".$id."' and recibidor='".$recibidor[$j]."'  and fecha<'$date1'";
				$result = mysql_query($query, $link);
				$cantidadAnterior=0;
				while($row = mysql_fetch_array($result)){
				$cantidadAnterior+=str_replace(",", "", $row["cantidad"]);
				}
				/////////////OBTENER LAS CANTIDADES DESCARGADAS DE EL DIA INDICADO
				$query="select cantidad from descargarecibidor where id='".$id."' and recibidor='".$recibidor[$j]."'  and fecha='$date1'";
				$result = mysql_query($query, $link);
				$cantidadDia=0;
				while($row = mysql_fetch_array($result)){
				$cantidadDia+=str_replace(",", "", $row["cantidad"]);
				}
				////////////////OBTENER EL TOTAL INICIAL
				$query="select pesoneto from chargeinformation where id='".$id."' and recibidor='".$recibidor[$j]."'";
				$pesototal=0;
				$result = mysql_query($query, $link);
				while($row = mysql_fetch_array($result)){
				$pesototal+=str_replace(",", "", $row["pesoneto"]);
				}
				
				$query="select distinct abreviado from conciliacion where recibidor='".$recibidor[$j]."'";
				$abreviado=$recibidor[$j];
				$result = mysql_query($query, $link);
				while($row = mysql_fetch_array($result)){
				$abreviado=$row["abreviado"];
				}
								
				$totales[0]+=$pesototal;
				$totales[1]+=$cantidadTotal;
				$totales[2]+=$pesototal-$cantidadTotal;
				$totales[3]+=$cantidadAnterior;
				$totales[4]+=$cantidadDia;
				
				
				
				$toDisch=number_format($pesototal-$cantidadTotal, 3, ".", ",");
				$pesototal=number_format($pesototal, 3, ".", ",");
	    		$cantidadAnterior=number_format($cantidadAnterior, 3, ".", ",");
	    		$cantidadDia=number_format($cantidadDia, 3, ".", ",");
	    		$cantidadTotal=number_format($cantidadTotal, 3, ".", ",");
				
				?>
			<tr class="normal">
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><?php echo $abreviado;?></font></td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $pesototal;?></font></div>
				</td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $cantidadAnterior;?></font></div>
				</td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $cantidadDia;?></font></div>
				</td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $cantidadTotal;?></font></div>
				</td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $toDisch;?></font></div>
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
						<font size="2" face="Tahoma"><?php echo $totales[3]; ?></font></div>
				</td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $totales[4]; ?></font></div>
				</td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $totales[1]; ?></font></div>
				</td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $totales[2]; ?></font></div>
				</td>
			</tr>
</table><br />
    <span class="tituloNormal">Quantities Discharged per Product</span> <span class="texto">(
    <label>
      <input name="product" type="checkbox" id="product" checked="checked"/>
      Mostrar en Reporte</label>
, <a href="registros4.php?id=<?php echo $id; ?>">modificar valores</a> )</span><br />
	<table width="894" border="1" cellspacing="2" cellpadding="0">
	  <tr>
	    <td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>PRODUCT</strong></font></td>
	    <td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>INITIAL TONNAGE</strong></font></td>
	    <td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>PREVIOUS DISCH</strong></font></td>
	    <td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>DAY DISCH</strong></font></td>
	    <td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>TTL DISCH</strong></font></td>
	    <td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>TO BE DISCH</strong></font></td>
      </tr>
	  <?php
			
			//---REPORTE GENERAL DE DESCARGA POR PRODUCTO ---- DAKA TECHNOLOGY---- PROP. INTELECTUAL DANIEL A. KENNEDY AYALA-----
			$totales=array(0,0,0);

						
			$query="select distinct producto from pesobodega where id='".$id."'";
			$result = mysql_query($query, $link);
			$i=0;
			while($row = mysql_fetch_array($result)){
			$producto[$i]=$row["producto"];
			$i++;
			}
			
			for($j=0; $j<count($producto); $j++)	{
				
				$query="select distinct abreviacion from pesobodega where id='".$id."' and producto='".$producto[$j]."'";
				$result = mysql_query($query, $link);
				while($row = mysql_fetch_array($result)){
				$abreviacion=$row["abreviacion"];
				}				
				
				/////////////OBTENER LAS CANTIDADES DESCARGADAS HASTA EL DIA INDICADO
				$query="select cantidad from descargaproducto where id='".$id."' and producto='".$producto[$j]."'  and fecha<='$date1'";
				$result = mysql_query($query, $link);
				$cantidadTotal=0;
				while($row = mysql_fetch_array($result)){
				$cantidadTotal+=$row["cantidad"];
				}
				/////////////OBTENER LAS CANTIDADES DESCARGADAS HASTA EL DIA ANTERIOR AL INDICADO
				$query="select cantidad from descargaproducto where id='".$id."' and producto='".$producto[$j]."'  and fecha<'$date1'";
				$result = mysql_query($query, $link);
				$cantidadAnterior=0;
				while($row = mysql_fetch_array($result)){
				$cantidadAnterior+=$row["cantidad"];
				}
				/////////////OBTENER LAS CANTIDADES DESCARGADAS DE EL DIA INDICADO
				$query="select cantidad from descargaproducto where id='".$id."' and producto='".$producto[$j]."'  and fecha='$date1'";
				$result = mysql_query($query, $link);
				$cantidadDia=0;
				while($row = mysql_fetch_array($result)){
				$cantidadDia+=$row["cantidad"];
				}
				////////////////OBTENER EL TOTAL INICIAL
				$query="select pesototal from pesobodega where id='".$id."' and producto='".$producto[$j]."'";
				$pesototal=0;
				$result = mysql_query($query, $link);
				while($row = mysql_fetch_array($result)){
				$pesototal+=$row["pesototal"];
				}
								
				$totales[0]+=$pesototal;
				$totales[1]+=$cantidadTotal;
				$totales[2]+=$pesototal-$cantidadTotal;
				$totales[3]+=$cantidadAnterior;
				$totales[4]+=$cantidadDia;
				
				$toDisch=number_format($pesototal-$cantidadTotal, 3, ".", ",");
				$pesototal=number_format($pesototal, 3, ".", ",");
	    		$cantidadAnterior=number_format($cantidadAnterior, 3, ".", ",");
	    		$cantidadDia=number_format($cantidadDia, 3, ".", ",");
	    		$cantidadTotal=number_format($cantidadTotal, 3, ".", ",");
				
				?>
	  <tr class="normal">
	    <td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><?php echo $abreviacion;?></font></td>
	    <td><div align="right"> <font size="2" face="Tahoma"><?php echo $pesototal;?></font></div></td>
	    <td><div align="right"> <font size="2" face="Tahoma"><?php echo $cantidadAnterior;?></font></div></td>
	    <td><div align="right"> <font size="2" face="Tahoma"><?php echo $cantidadDia;?></font></div></td>
	    <td><div align="right"> <font size="2" face="Tahoma"><?php echo $cantidadTotal;?></font></div></td>
	    <td><div align="right"> <font size="2" face="Tahoma"><?php echo $toDisch;?></font></div></td>
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
	    <td><div align="right"> <font size="2" face="Tahoma"><?php echo $totales[3]; ?></font></div></td>
	    <td><div align="right"> <font size="2" face="Tahoma"><?php echo $totales[4]; ?></font></div></td>
	    <td><div align="right"> <font size="2" face="Tahoma"><?php echo $totales[1]; ?></font></div></td>
	    <td><div align="right"> <font size="2" face="Tahoma"><?php echo $totales[2]; ?></font></div></td>
      </tr>
    </table>
    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>"  />
    <input type="hidden" name="date" id="date" value="<?php echo $date; ?>"  />
    <input type="hidden" name="date1" id="date1" value="<?php echo $date1; ?>"  />
  <label>
    <input type="submit" name="button" id="button" value="Consultar Reporte Final" />
  </label>
</form>
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
</body>
</html>