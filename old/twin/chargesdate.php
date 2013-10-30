<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<?php

include("conexion.php");
$id=$_GET["id"];
$date=$_GET["date"];
$no=$_GET["no"];
$aaa="Location: ../asistente/final25.php?id=".$id."&date=".$date;
header($aaa);
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
		<title>Reporte Preliminar</title>
		<link href="css/basic.css" rel="stylesheet" type="text/css" media="all" />
    <style type="text/css">
<!--
.localBd {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 12px;
	font-weight: normal;
}
-->
    </style>
	</head>

<body bgcolor="#ffffff" class="body">
		<img src="logox.jpg" alt="" width="264" height="83" border="0" /><br />
		<font size="3" color="#0183bf" face="Tahoma"><strong><em>PRELIMINAR REPORT </em></strong></font><font size="3" face="Tahoma"><strong>			</strong></font>
	  <table width="386" border="1" cellspacing="2" cellpadding="0">
			<tr>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>REPORTE NO:</strong></font></td>
				<td><input type="text" name="textfieldName" value="<?php echo $no;  ?>" size="24" /></td>
			</tr>
            <tr>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>VESSEL:</strong></font></td>
				<td><input type="text" name="textfieldName" value="<?php echo $vessel;  ?>" size="24" /></td>
			</tr>
			<tr>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>CARGO: </strong></font></td>
				<td><input type="text" name="textfieldName" value="<?php echo $cargaentransito;  ?>" size="24" /></td>
			</tr>
			<tr>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>QUANTITY:</strong></font></td>
				<td><input type="text" name="textfieldName" value="<?php echo $quantity;  ?>" size="24" /></td>
			</tr>
			<tr>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>LOADING PORT:</strong></font></td>
				<td><input type="text" name="textfieldName" value="<?php echo $puertodecarga;  ?>" size="24" /></td>
			</tr>
			<tr>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>MAXIMUM ARRIVAL DRAFT: </strong></font></td>
				<td><input type="text" name="textfieldName" value="<?php echo $maxarrivaldraftmt;  ?>" size="24" /></td>
			</tr>
		</table>
  <font size="3" color="#0183bf" face="Tahoma"><strong><em>Preliminary figures up to 16:00hrs today.</em></strong></font>
    <?php
		///////////////OBTENER LOS DIAS ANTERIORES HASTA EL INDICADO
		$query = "select distinct fecha from computotiempo where id='$id' and fecha='$date' order by fecha";
		//echo $queryA;
		$result = mysql_query($query, $link);
                $j=0;
                while($row = mysql_fetch_array($result))	{
                            $fechax[$j]=$row["fecha"];
                            $j++;
                        }
			?>
	<font face="Tahoma"><strong><br />
</strong></font>
		<span class="localBd">
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

		for($i=0; $i<=count($fechax); $i++)	{
		$buf=true;
		$query="select fecha, hinicial, hfinal, fact from computotiempo where id='".$id."' and hinicial<='16:00' and hfinal>='08:00' and tipo='OPERATIONAL' and fecha='".$fechax[$i]."' order by hinicial";
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
			if((restaHorasInt($hora, "08:00")<0))   {
                            $hora="08:00";
                        }
            if((restaHorasInt($horafin, "16:00")>0))  {
                            $horafin="16:00";
                        }

			?>
				<font size="2" face="Tahoma"><?php
				$cadena = $row["fact"];
				$cadena = ucwords($cadena); // EN UN LUGAR DE LA MANCHA
				$cadena = ucwords(strtolower($cadena)); // de cuyo nombre no quiero acordarme
				echo strftime('%H:%M',strtotime($hora))."/".strftime('%H:%M',strtotime($horafin))." hrs.		".$cadena; ?><br />
                </font>
				<?php
			}
		}
		?>
				<font face="Tahoma"><strong>
STOP/IDLE TIMES</strong></font>
		<?php
		for($i=0; $i<=count($fechax); $i++)	{
		$buf=true;
		$query="select fecha, hinicial, hfinal, fact from computotiempo where id='".$id."' and hinicial<='16:00' and hfinal>='08:00' and tipo='STOP/IDLE TIME' and fecha='".$fechax[$i]."' order by hinicial";
			$result = mysql_query($query, $link);
			while($row = mysql_fetch_array($result)){
			
			setlocale(LC_TIME , 'es_ES');
			if($buf)	{
				$fecha=strftime('%B %d /%Y',strtotime($row["fecha"]));
				$buf=false;
				?><br />
				<font size="2" face="Tahoma"><strong><?php echo $fecha; ?></strong></font><br />
				<?php
			}
			$hora=$row["hinicial"];
                        $horafin=$row["hfinal"];
			if((restaHorasInt($hora, "08:00")<0))   {
                            $hora="08:00";
                        }
            if((restaHorasInt($horafin, "16:00")>0))  {
                            $horafin="16:00";
                        }
			?>
				<font size="2" face="Tahoma"><?php
				$cadena = $row["fact"];
				$cadena = ucwords($cadena); // EN UN LUGAR DE LA MANCHA
				$cadena = ucwords(strtolower($cadena)); // de cuyo nombre no quiero acordarme
				echo strftime('%H:%M',strtotime($hora))."/".strftime('%H:%M',strtotime($horafin))." hrs.		".$cadena; ?><br />
			    </font>
				<?php
			}
		}
		?>
</span><br />
			<font size="3" color="#0183bf" face="Tahoma"><strong><em>Quantities Discharged</em></strong></font>
			<table width="243" border="1" cellspacing="2" cellpadding="0">
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
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>Total parcel to Discharge</strong></font></td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php printf("%.3f", $totalDescarga);?></font></div>
				</td>
			</tr>
			<tr>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>Discharged Today</strong></font></td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php printf("%.3f", $descargadoDia);?></font></div>
				</td>
			</tr>
			<tr>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>Previous Discharge</strong></font></td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php printf("%.3f", $descargaPrevia);?></font></div>
				</td>
			</tr>
			<tr>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>Total Discharged</strong></font></td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php printf("%.3f", $descargadoDia+$descargaPrevia);?></font></div>
				</td>
			</tr>
			<tr>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>To be Discharged</strong></font></td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php printf("%.3f", $totalDescarga-($descargadoDia+$descargaPrevia));?></font></div>
				</td>
			</tr>
</table>
		<font size="-2">Powered in association  by TWIN MARINE DE MEXICO, S.A. DE C.V.  and  DAKA Technology. &lt;&lt;Copyright © 2009-2010 All Rights Reserved&gt;&gt;</font>
	</body>

</html>