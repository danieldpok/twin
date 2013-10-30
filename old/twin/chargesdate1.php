<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<?php

include("conexion.php");
$id=$_GET["id"];
$date=$_GET["date"];
$date1=$_GET["date1"];
//$id="11111";
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

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta name="generator" content="Adobe GoLive" />
		<title>Reporte de 24hrs</title>
		<link href="css/basic.css" rel="stylesheet" type="text/css" media="all" />
	</head>

	<body bgcolor="#ffffff">
		<font size="5" color="#00b4ff" face="Tahoma"><strong><em>GENERAL INFORMATION 24hrs REPORT </em></strong></font><font size="3" face="Tahoma"><strong>
				<hr />
			</strong></font>
		<table width="386" border="1" cellspacing="2" cellpadding="0">
			<tr>
				<td bgcolor="#00b4d6"><font size="2" color="white" face="Tahoma"><strong>VESSEL:</strong></font></td>
				<td><input type="text" name="textfieldName" value="<?php echo $vessel;  ?>" size="24" /></td>
			</tr>
			<tr>
				<td bgcolor="#00b4d6"><font size="2" color="white" face="Tahoma"><strong>CARGO: </strong></font></td>
				<td><input type="text" name="textfieldName" value="<?php echo $cargaentransito;  ?>" size="24" /></td>
			</tr>
			<tr>
				<td bgcolor="#00b4d6"><font size="2" color="white" face="Tahoma"><strong>QUANTITY:</strong></font></td>
				<td><input type="text" name="textfieldName" value="<?php echo $quantity;  ?>" size="24" /></td>
			</tr>
			<tr>
				<td bgcolor="#00b4d6"><font size="2" color="white" face="Tahoma"><strong>LOADING PORT:</strong></font></td>
				<td><input type="text" name="textfieldName" value="<?php echo $puertodecarga;  ?>" size="24" /></td>
			</tr>
			<tr>
				<td bgcolor="#00b4d6"><font size="2" color="white" face="Tahoma"><strong>MAXIMUM ARRIVAL DRAFT: </strong></font></td>
				<td><input type="text" name="textfieldName" value="<?php echo $maxarrivaldraftmt;  ?>" size="24" /></td>
			</tr>
		</table>
		<hr />
		<p><font size="5" color="#00b4ff" face="Tahoma"><strong><em>OPERATIONAL REPORT</em></strong></font></p>
		<hr />
		<?php
		///////////////OBTENER LOS DIAS ANTERIORES HASTA EL INDICADO
		$query = "select distinct fecha from computotiempo where id='$id' and (fecha between '$date' and '$date1') order by fecha";
		//echo $queryA;
		$result = mysql_query($query, $link);
                $j=0;
                while($row = mysql_fetch_array($result))	{
                            $fechax[$j]=$row["fecha"];
                            $j++;
                        }
			?>
		<p><font face="Tahoma"><strong>OPERATIONAL TIMES</strong></font></p>
		<p><?php
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

		for($i=0; $i<=count($fechax); $i++)	{
		$buf=true;
		$query="select fecha, hinicial, hfinal, fact from computotiempo where id='".$id."' and tipo='OPERATIONAL' and fecha='".$fechax[$i]."' and (fecha >='$date' and hfinal>='08:00') and (fecha <='$date1' and hinicial<='08:00') order by hinicial";
			$result = mysql_query($query, $link);
			while($row = mysql_fetch_array($result)){
			
			setlocale(LC_TIME , 'es_ES');
			if($buf)	{
				$fecha=strftime('%B, %d /%Y',strtotime($row["fecha"]));
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

			?><font size="2" face="Tahoma"><?php echo strftime('%H:%M',strtotime($hora))."/".strftime('%H:%M',strtotime($horafin))." hrs.		".$row["fact"]; ?><br />
			</font><?php
			}
		}
		?></p>
		
		<p><font face="Tahoma"><strong>STOP/IDLE TIMES</strong></font></p>
		<?php
		for($i=0; $i<=count($fechax); $i++)	{
		$buf=true;
		$query="select fecha, hinicial, hfinal, fact from computotiempo where id='".$id."' and tipo='STOP/IDLE TIME' and fecha='".$fechax[$i]."' and (fecha >='$date' and hfinal>='08:00') and (fecha <='$date1' and hinicial<='08:00') order by hinicial";
			$result = mysql_query($query, $link);
			while($row = mysql_fetch_array($result)){
			
			setlocale(LC_TIME , 'es_ES');
			if($buf)	{
				$fecha=strftime('%B, %d /%Y',strtotime($row["fecha"]));
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
			?><font size="2" face="Tahoma"><?php echo strftime('%H:%M',strtotime($hora))."/".strftime('%H:%M',strtotime($horafin))." hrs.		".$row["fact"]; ?><br />
			</font><?php
			}
		}
		?></p>
		<hr />
		<p><font size="5" color="#00b4ff" face="Tahoma"><strong><em>OPERATIONS REPORT</em></strong></font></p>
		<hr />
		<p><font face="Tahoma"><strong><u>Quantities Discharged:</u></strong></font></p>
		<table width="243" border="1" cellspacing="2" cellpadding="0">
			<?php
			
			$totalDescarga=0.000;
			$descargadoDia=0.000;
			$descargaPrevia=0.000;
			
											
			//$query="select distinct bodega from chargeinformation where id='".$id."'";
			$query="select pesoneto from chargeinformation where id='".$id."'";
			$result = mysql_query($query, $link);
			
			while($row = mysql_fetch_array($result)){
				$totalDescarga+=$row["pesoneto"];
			}
			
			//$query="select distinct bodega from chargeinformation where id='".$id."'";
			$query="select cantidad from descargabodegas where id='".$id."' and fecha<'$date'";
			$result = mysql_query($query, $link);
			
			while($row = mysql_fetch_array($result)){
				$descargaPrevia+=$row["cantidad"];
			}
			
			$descargadoDia=$_GET["descarga"];
				
				?>
			<tr>
				<td bgcolor="#00b4d6"><font size="2" color="white" face="Tahoma"><strong>Total parcel to Discharge</strong></font></td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php printf("%.3f", $totalDescarga);?></font></div>
				</td>
			</tr>
			<tr>
				<td bgcolor="#00b4d6"><font size="2" color="white" face="Tahoma"><strong>Discharged Today</strong></font></td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php printf("%.3f", $descargadoDia);?></font></div>
				</td>
			</tr>
			<tr>
				<td bgcolor="#00b4d6"><font size="2" color="white" face="Tahoma"><strong>Previous Discharge</strong></font></td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php printf("%.3f", $descargaPrevia);?></font></div>
				</td>
			</tr>
			<tr>
				<td bgcolor="#00b4d6"><font size="2" color="white" face="Tahoma"><strong>Total Discharged</strong></font></td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php printf("%.3f", $descargadoDia+$descargaPrevia);?></font></div>
				</td>
			</tr>
			<tr>
				<td bgcolor="#00b4d6"><font size="2" color="white" face="Tahoma"><strong>To be Discharged</strong></font></td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php printf("%.3f", $totalDescarga-($descargadoDia+$descargaPrevia));?></font></div>
				</td>
			</tr>
		</table>
		<font size="-2">Powered By DAKA Technology</font>
	</body>

</html>