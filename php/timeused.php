<?php
include ("bd.php");
include ("timeFunc.php");
$id = $_GET["id"];
/////////////ESTADITICA FINALES
$query="select distinct fecha from computotiempox where idop='$id' order by fecha";
$result = $bd -> Execute($query);

$j = 0;
foreach ($result as $row) {
	$fechax[$j] = $row["fecha"];
	$j++;
}

$query="select timetocount from operaciones where idop='$id'";
$result = $bd -> Execute($query);
foreach ($result as $row) {
$timetocount=$row["timetocount"];
}

$timeused = "00:00";
$timeusedDem = "00:00";
$timelost = "00:00";
$I = 0;
/////ANALIZA LA INFORMACION POR DIA////////////////////////////////////////////////////////////////////////////////
$first = true;
////si es el primero
for ($i = 0; $i < count($fechax); $i++) {
	/////ANALIZA LOS CONCEPTOS
	$query = "select idcomputotiempox, fecha, hinicial, hfinal, timepercent, fact, tipo, remarks from computotiempox where idop='$id' and fecha='" . $fechax[$i] . "' and fecha>='$timetocount' order by fecha";
	//echo $query;

	$result = $bd -> Execute($query);

	////////// Datos a imprimir
	$date = "";
	$day = "";
	$period = "";
	$timepercent = "";
	$remarks4 = "";
	$tocount = "";
	$remarks = "";

	foreach ($result as $row) {

		$fca = $row["fecha"];
		$idx = $row["idcomputotiempox"];
		$date = strftime('%d %m %Y', strtotime($fca));
		$day = strftime('%a', strtotime($fca));
		//$hinicial=date("H:i", strtotime($row["hinicial"]));
		//$hfinal=date("H:i", strtotime($row["hfinal"]));
		$hinicial = $row["hinicial"];
		$hfinal = $row["hfinal"];
		$timepercent = $row["timepercent"];
		$period = $hinicial . " / " . $hfinal;
		$remarks = $row["remarks"];
		///////////////CUENTA EL TIEMPO
		if ($row["tipo"] == "STOP/IDLE TIME") {
			//$remarks="STOP/IDLE TIME";
			//$remarks="";
			$remarks4 = $row["fact"];
			//
			$timepercentbuf = 100 - $timepercent;
			$tocount = restaHoras($hinicial, $hfinal);

			$toDiscount = porcentajeHoras2($tocount, $timepercent);
			$tocount = porcentajeHoras($tocount, $timepercentbuf);
			$timelost = sumaHoras($timelost, $toDiscount);
			$timeused = sumaHoras($timeused, $tocount);

			$VARX[$I] = $remarks4;
			$VALX[$I] = miliseg($toDiscount);
			$I++;

		} else {
			//$remarks="OPERATIONAL";
			$tocount = restaHoras($hinicial, $hfinal);
			$timeused = sumaHoras($timeused, $tocount);
			$timepercentbuf = "100";
			$remarks4 = $row["fact"];
			$toDiscount = "";
		}
	}
}
echo formatoDias($timeused);
?>