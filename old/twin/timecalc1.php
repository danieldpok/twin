<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<?php
include("conexion.php");
$id=$_GET["id"];
//$id="11111";
//DATOS DEL REGISTRO
$table="operaciones";
$fields="vessel, cargaentransito, quantity, startdischarging, completedescharging, dischperday, timeallowed, timetocount, nortendered, norpresented, noracepted, timeallowed";

$query = "select ".$fields." from ".$table." where id='".$id."'";
//echo $query;
$link = Conectar();
$result = mysql_query($query, $link);

while($row = mysql_fetch_array($result)){
setlocale(LC_TIME , 'es_ES');

$vessel=$row["vessel"];
$cargaentransito=$row["cargaentransito"];
$quantity=$row["quantity"];
$startdischarging=strftime('%d %b %y AT %H:%M',strtotime($row["startdischarging"]));
$completedischarging=strftime('%d %b %y AT %H:%M',strtotime($row["completedescharging"]));
$dischperday=$row["dischperday"];
$timeallowed=$row["timeallowed"];
$timetocount=strftime('%d %b %y AT %H:%M',strtotime($row["timetocount"]));
$nortendered=strftime('%d %b %y AT %H:%M',strtotime($row["nortendered"]));
$norpresented=strftime('%d %b %y AT %H:%M',strtotime($row["norpresented"]));
$noracepted=strftime('%d %b %y AT %H:%M',strtotime($row["noracepted"]));
$timeallowed=$row["timeallowed"];

}


?>

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta name="generator" content="Adobe GoLive" />
		<title>Time Calculation</title>
		<link href="css/basic.css" rel="stylesheet" type="text/css" media="all" />
	</head>

	<body bgcolor="#ffffff">
	

		<table width="942" border="1" cellspacing="2" cellpadding="0">
			<tr>
				<td>
					<div align="center">
						<font size="3"><strong>TIME CALCULATION</strong></font></div>
				</td>
			</tr>
			<tr>
				<td>
					<table width="848" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td>
								<div align="center">
									<table width="788" border="1" cellspacing="1" cellpadding="0">
										<tr>
											<td>
												<div align="center">
													GENERAL INFORMATION</div>
											</td>
											<td>
												<div align="center">
													TERMS AND CONDITIONS</div>
											</td>
										</tr>
										<tr>
											<td>
												<table width="325" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td>
															<div align="right">
																<font size="2" face="Tahoma">Vessel</font></div>
														</td>
														<td><font face="Tahoma"><input type="text" name="textfieldName" value="<?php echo $vessel; ?>" size="17" /></font></td>
													</tr>
													<tr>
														<td>
															<div align="right">
																<font size="2" face="Tahoma">Port</font></div>
														</td>
														<td><font face="Tahoma"><input type="text" name="textfieldName" size="17" /></font></td>
													</tr>
													<tr>
														<td>
															<div align="right">
																<font size="2" face="Tahoma">Cargo</font></div>
														</td>
														<td><font face="Tahoma"><input type="text" name="textfieldName" value="<?php echo $cargaentransito; ?>" size="17" /></font></td>
													</tr>
													<tr>
														<td>
															<div align="right">
																<font size="2" face="Tahoma">Quantity</font></div>
														</td>
														<td><font face="Tahoma"><input type="text" name="textfieldName" align="right" value="<?php echo $quantity; ?>" size="17" /></font></td>
													</tr>
													<tr>
														<td>
															<div align="right">
																<font size="2" face="Tahoma">Receiver</font></div>
														</td>
														<td><font face="Tahoma"><input type="text" name="textfieldName" size="17" /></font></td>
													</tr>
													<tr>
														<td>
															<div align="right">
																<font size="2" face="Tahoma">Start Discharging</font></div>
														</td>
														<td><font face="Tahoma"><input type="text" name="textfieldName" value="<?php echo $startdischarging; ?>" size="17" /></font></td>
													</tr>
													<tr>
														<td>
															<div align="right">
																<font size="2" face="Tahoma">Completed Discharging</font></div>
														</td>
														<td><font face="Tahoma"><input type="text" name="textfieldName" value="<?php echo $completedischarging; ?>" size="17" /></font></td>
													</tr>
												</table>
											</td>
											<td>
												<table width="296" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td>
															<div align="right">
																<font size="2" face="Tahoma">Rate</font></div>
														</td>
														<td><font face="Tahoma"><input type="text" name="textfieldName" value="<?php echo $dischperday; ?>" size="17" /></font></td>
													</tr>
													<tr>
														<td>
															<div align="right">
																<font size="2" face="Tahoma">Terms</font></div>
														</td>
														<td><font face="Tahoma"><input type="text" name="textfieldName" size="17" /></font></td>
													</tr>
													<tr>
														<td>
															<div align="right">
																<font size="2" face="Tahoma">Time Alowed</font></div>
														</td>
														<td><font face="Tahoma"><input type="text" name="textfieldName" value="<?php echo $timeallowed; ?>" size="17" /></font></td>
													</tr>
													<tr>
														<td>
															<div align="right">
																<font size="2" face="Tahoma">Time To Count</font></div>
														</td>
														<td><font face="Tahoma"><input type="text" name="textfieldName" value="<?php echo $timetocount; ?>" size="17" /></font></td>
													</tr>
													<tr>
														<td>
															<div align="right">
																<font size="2" face="Tahoma">Nor Tendered</font></div>
														</td>
														<td><font face="Tahoma"><input type="text" name="textfieldName" value="<?php echo $nortendered; ?>" size="17" /></font></td>
													</tr>
													<tr>
														<td>
															<div align="right">
																<font size="2" face="Tahoma">Nor Presented</font></div>
														</td>
														<td><font face="Tahoma"><input type="text" name="textfieldName" value="<?php echo $norpresented; ?>" size="17" /></font></td>
													</tr>
													<tr>
														<td>
															<div align="right">
																<font size="2" face="Tahoma">Nor Acepted</font></div>
														</td>
														<td><font face="Tahoma"><input type="text" name="textfieldName" value="<?php echo $noracepted; ?>" size="17" /></font></td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</div>
							</td>
							<td>
								<div align="center">
									<table width="115" border="1" cellspacing="0" cellpadding="0">
										<tr>
											<td>
												<div align="center">
													<font size="2"><strong>TIME ALLOWED</strong></font></div>
											</td>
										</tr>
										<tr>
											<td>
												<div align="center">
													<input type="text" name="textfieldName" value="<?php echo $timeallowed; ?>" size="17" /></div>
											</td>
										</tr>
										<tr>
											<td>
												<div align="center">
													<strong><font size="2">TIME USED</font></strong></div>
											</td>
										</tr>
										<tr>
											<td>
												<div align="center">
													<input type="text" name="timeused" size="17" /></div>
											</td>
										</tr>
										<tr>
											<td>
												<div align="center">
													</div>
											</td>
										</tr>
										<tr>
											<td>
												<div align="center">
													<input type="text" name="textfieldName" size="17" /></div>
											</td>
										</tr>
									</table>
								</div>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<div align="center">
						<font size="3">DESCRIPTION</font></div>
				</td>
			</tr>
		</table>
		<table width="952" border="1" cellspacing="2" cellpadding="0">
			<tr>
				<td><font size="2" face="Tahoma"><strong>DATE</strong></font></td>
				<td><font size="2" face="Tahoma"><strong>DAY</strong></font></td>
				<td><font size="2" face="Tahoma"><strong>PERIOD</strong></font></td>
				<td></td>
				<td><font size="2" face="Tahoma"><strong>TIME (%)</strong></font></td>
				<td><font size="2" face="Tahoma"><strong>REMARKS FOR DEDUCTION</strong></font></td>
				<td><font size="2" face="Tahoma"><strong>TO COUNT</strong></font></td>
				<td><font size="2" face="Tahoma"><strong>TIME USED</strong></font></td>
				<td><font size="2" face="Tahoma"><strong>DEMURRAGE</strong></font></td>
				<td><font size="2" face="Tahoma"><strong>REMARKS</strong></font></td>
			</tr>
			<?php
			function restaHoras($horaIni, $horaFin){
			    return (date("H:i", strtotime("00:00") + strtotime($horaFin) - strtotime($horaIni) ));
			}
			
			function sumaHoras($horaIni, $horaFin){
			    $hora1=$horaIni;
				$hora2=$horaFin;
				$hora1=split(":",$hora1);
				$hora2=split(":",$hora2);
				$horas=(int)$hora1[0]+(int)$hora2[0];
				$minutos=(int)$hora1[1]+(int)$hora2[1];
				$horas+=(int)($minutos/60);
				$minutos=$minutos%60;
				if($minutos==0)$minutos="00";
				return $horas.":".$minutos;

			}

			$query="select keyx from computotiempo where id='$id'";
			//echo $query;
			$result = mysql_query($query, $link);
			while($row = mysql_fetch_array($result)){
			$keyx=$row["keyx"];
			}
			
			//$query="select distinct fecha from facts where keyx='$keyx'";
			$query="select distinct fecha, hinicio, hfinal, timepercent, tipo, facts, clasificacion from facts where keyx='$keyx' and tipo!='OTHERS'";
			//echo $query;
			$result = mysql_query($query, $link);

			$hinicialbuf="";
			$hfinalbuf="";
			$fechabuf="";
			$timeused="00:00";

			while($row = mysql_fetch_array($result)){
			$date=strftime('%d %m %Y',strtotime($row["fecha"]));
			$day=strftime('%a',strtotime($row["fecha"]));
			$hinicial=date("H:i", strtotime($row["hinicio"]));
			$hfinal=date("H:i", strtotime($row["hfinal"]));
			$fact=$row["facts"];
			if($hinicialbuf!=$hinicial and $hfinalbuf!=$hfinal)	{
			
			$hinicialbuf=$hinicial;
			$hfinalbuf=$hfinal;
			$fechabuf=$date;
			
			if($row["timepercent"]==null)	{
				$timepercent=100;
			}
			else	{
				$timepercent=100-$row["timepercent"];
				$remarks="";
			}
			
			if($row["tipo"]=="STOP/IDLE TIME")	{
				$remarks4=$fact;
			}
			else if($row["tipo"]=="OPERATIONAL")	{
				$remarks4="";
				$remarks=$row["clasificacion"];
			}
			
			$tocount=restaHoras($hinicial, $hfinal);
			$timeused=sumaHoras($timeused, $tocount);
			
			$period="$hinicial / $hfinal";
			?>
			<tr>
				<td><font size="1" face="Tahoma"><?php echo $date; ?></font></td>
				<td><font size="1" face="Tahoma"><?php echo $day; ?></font></td>
				<td><font size="1" face="Tahoma"><?php echo $period; ?></font></td>
				<td></td>
				<td><font size="1" face="Tahoma"><?php echo "$timepercent %"; ?></font></td>
				<td><font size="1" face="Tahoma"><?php echo $remarks4; ?></font></td>
				<td><font size="1" face="Tahoma"><?php echo $tocount; ?></font></td>
				<td><font size="1" face="Tahoma"><?php echo $timeused; ?></font></td>
				<td></td>
				<td><font size="1" face="Tahoma"><?php echo $remarks; ?></font></td>
			</tr>
			<?php
			}
			}
			/*echo "<script language=JavaScript>
			setTimeUsed($timeused);
			</script>";*/
			?>
			<script language=JavaScript>
	function setTimeUsed() {
	document.timeused.texto.value="10";
	}
	</script>
			<script language=JavaScript>
			setTimeUsed();
			</script>
		</table>
		
		<p></p>
	</body>

</html>