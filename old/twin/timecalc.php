<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<?php
include("conexion.php");
$id=$_GET["id"];
//$id="11111";
//DATOS DEL REGISTRO
$table="operaciones";
$fields="vessel, cargotype, quantity, startdischarging, completedescharging, dischperday, timeallowed, timetocount, nortendered, norpresented, noracepted, timeallowed, puerto, terms, recibidorform, typex";

$query = "select * from ".$table." where id='".$id."'";
//echo $query;
$link = Conectar();
$result = mysql_query($query, $link);

while($row = mysql_fetch_array($result)) {
    setlocale(LC_TIME , 'es_ES');
	$recibidorform=$row["recibidorform"];
    $vessel=$row["vessel"];
    $cargaentransito=$row["cargotype"];
    $quantity=$row["quantity"];
	$total=str_replace(",", "", $quantity);
	$port=$row["puerto"];
	$terms=$row["terms"];
    $startdischarging=strftime('%b %d %Y AT %H:%M',strtotime($row["startdischarging"]));
    $completedischarging=strftime('%b %d %Y AT %H:%M',strtotime($row["completedescharging"]));
    $start=date("H:i", strtotime($row["startdischarging"]));
    $complete=date("H:i", strtotime($row["completedescharging"]));
    $dischperday=$row["dischperday"];
    $timeallowed=$row["timeallowed"];
    $startTime=strftime('%H:%M',strtotime($row["timetocount"]));
    $timetocount1=strftime('%Y-%m-%d',strtotime($row["timetocount"]));
    $timetocount=strftime('%b %d %Y AT %H:%M',strtotime($row["timetocount"]));
    $nortendered=strftime('%b %d %Y AT %H:%M',strtotime($row["nortendered"]));
    $norpresented=strftime('%b %d %Y AT %H:%M',strtotime($row["norpresented"]));
    $noracepted=strftime('%b %d %Y AT %H:%M',strtotime($row["noracepted"]))." HRS";
    $timeallowed=$row["timeallowed"];
    $stopDay=date('%d %m %Y', strtotime($row["completedescharging"]));
    $stopHr=date("H:i", strtotime($row["completedescharging"]));
	
	if($timeallowed=="Dec 31 1969 AT 18:00")
		$timeallowed="";
	if($timetocount=="Dec 31 1969 AT 18:00")
		$timetocount="";
	if($nortendered=="Dec 31 1969 AT 18:00")
		$nortendered="";
	if($norpresented=="Dec 31 1969 AT 18:00")
		$norpresented="";
	if($noracepted=="Dec 31 1969 AT 18:00 HRS")
		$noracepted="N/I";
	if($startdischarging=="Dec 31 1969 AT 18:00")
		$startdischarging="";
	if($completedischarging=="Dec 31 1969 AT 18:00")
		$completedischarging="";
	
	if($row["typex"]=="IMPORT")	{
		$var="Discharging";
	}
	else	{
		$var="Loading";
	}
}

////////////////////////////////////////////////////////////////////////
////////TTTTTTTTT  IIIIII  MMM   MMM   EEEEEEE             ////////////
////////   TT        II    MM  M  MM   EEE E                ////////////
////////   TT      IIIIII  MM     MM   EEEEEEE              ////////////
////////////////////////////////////////////////////////////////////////

$query="select distinct fecha from computotiempox where id='$id' order by fecha";
$result=mysql_query($query, $link);
$j=0;
while($row = mysql_fetch_array($result)) {
    $fechax[$j]=$row["fecha"];
    $j++;
}
$timeused="00:00";
/////ANALIZA LA INFORMACION POR DIA////////////////////////////////////////////////////////////////////////////////
/////////////ESTADITICA FINALES

            $query="select distinct fecha from computotiempox where id='$id' order by fecha";
            $result=mysql_query($query, $link);
            $j=0;
            while($row = mysql_fetch_array($result)) {
                $fechax[$j]=$row["fecha"];
                $j++;
            }
            $timeused="00:00";
            $timeusedDem="00:00";
            $timelost="00:00";
            $I=0;
            /////ANALIZA LA INFORMACION POR DIA////////////////////////////////////////////////////////////////////////////////
            $first=true;////si es el primero
            for($i=0; $i<count($fechax); $i++) {
            /////ANALIZA LOS CONCEPTOS
                $query="select fecha, hinicial, hfinal, timepercent, fact, tipo from computotiempox where id='$id' and fecha='".$fechax[$i]."' and fecha>='$timetocount1' order by hinicial";
                //echo $query;

                $result = mysql_query($query, $link);


                ////////// Datos a imprimir
                $date="";
                $day="";
                $period="";
                $timepercent="";
                $remarks4="";
                $tocount="";
                $remarks="";

                while($row = mysql_fetch_array($result)) {

                    $fca=$row["fecha"];
                    $date=strftime('%d %m %Y',strtotime($fca));
                    $day=strftime('%a',strtotime($fca));
                    //$hinicial=date("H:i", strtotime($row["hinicial"]));
                    //$hfinal=date("H:i", strtotime($row["hfinal"]));
                    $hinicial=$row["hinicial"];
                    $hfinal=$row["hfinal"];
                    $timepercent=$row["timepercent"];
                    $period=$hinicial." / ".$hfinal;
                    ///////////////CUENTA EL TIEMPO
                    if($row["tipo"]=="STOP/IDLE TIME") {
                        $remarks="STOP/IDLE TIME";
                        $remarks4=$row["fact"]; //
                        $timepercentbuf=100-$timepercent;
                        $tocount=restaHoras($hinicial, $hfinal);

                        $toDiscount=porcentajeHoras2($tocount, $timepercent);
                        $tocount=porcentajeHoras($tocount, $timepercentbuf);
                        $timelost=sumaHoras($timelost, $toDiscount);
                        $timeused=sumaHoras($timeused, $tocount);

                        $VARX[$I]=$remarks4;
                        $VALX[$I]=miliseg($toDiscount);
                        $I++;

                    }else {
                        $remarks="OPERATIONAL";
                        $tocount=restaHoras($hinicial, $hfinal);
                        $timeused=sumaHoras($timeused, $tocount);
                        $timepercentbuf="100";
                        $remarks4="";
                    }
            }////FIN DEL PROCESO DEL WHILE QUE ANALIZA LOS REGISTROS
            }//FIN DEL IF QUE REPRESENTA LAS FECHAS
            //
//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
?>

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <meta name="generator" content="Adobe GoLive" />
        <title>Computo de Tiempo</title>
        <link href="css/basic.css" rel="stylesheet" type="text/css" media="all" />
        <style type="text/css">
            <!--
            .tit {
                font-size: 18px;
            }
            .sdfgd {
                font-weight: normal;
				
            }
.aaa {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 10px;
	color: #000;
}
.tc {
	text-align: center;
}
.ablaabajo {
	font-size: 9px;
	font-family: Tahoma, Geneva, sans-serif;
}
            -->
        </style>
    </head>

<body bgcolor="#ffffff" >


        <table width="966" border="1" cellspacing="2" cellpadding="0">
            <tr>
                <td height="12">
                    <div align="center">
                      <table width="954" border="1">
                        <tr>
                          <td width="471"><img src="calctop.jpg" alt="" width="471" height="115" /></td>
                          <td width="467" align="center"><table width="351" height="54" border="1">
                            <tr>
                              <td width="341" align="center"><img src="calctop2.jpg" alt="" width="327" height="37" align="middle" /></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table>
                        
                    </div>
                </td>
            </tr>
            <tr>
                <td bgcolor="#eeede5">
                    <table width="848" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td>
                                <div align="center">
                                    <table width="788" border="1" cellspacing="1" cellpadding="0">
                                        <tr>
                                            <td bgcolor="#0183bf">
                                                <div align="center">
                                                    <font size="3" color="white" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>	GENERAL INFORMATION</strong></font></div>
                                            </td>
                                            <td bgcolor="#0183bf">
                                                <div align="center">
                                                    <font size="3" color="white" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>	TERMS AND CONDITIONS</strong></font></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#eeede5">
                                                <div align="center">
                                                    <table width="418" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td bgcolor="#eeede5">
                                                                <div align="left">
                                                                    <font size="2" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>Vessel</strong></font></div>
                                                            </td>
                                                            <td>
                                                                <div align="left">
                                                                    <input type="text" name="textfieldName" value="<?php echo $vessel; ?>" size="28" /></div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td bgcolor="#eeede5">
                                                                <div align="left">
                                                                    <font size="2" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>Port</strong></font></div>
                                                            </td>
                                                            <td>
                                                                <div align="left">
                                                                    <input name="textfieldName" type="text" value="<?php echo $port; ?>" size="28" /></div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td bgcolor="#eeede5">
                                                                <div align="left">
                                                                    <font size="2" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>Cargo</strong></font></div>
                                                            </td>
                                                            <td>
                                                                <div align="left">
                                                                    <input type="text" name="textfieldName" value="<?php echo $cargaentransito; ?>" size="28" /></div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td bgcolor="#eeede5">
                                                                <div align="left">
                                                                    <font size="2" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>Quantity</strong></font></div>
                                                            </td>
                                                            <td>
                                                                <div align="left">
                                                                    <input type="text" name="textfieldName" align="right" value="<?php echo $quantity;?> MT" size="28" /></div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td bgcolor="#eeede5">
                                                                <div align="left">
                                                                    <font size="2" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>Receiver</strong></font></div>
                                                            </td>
                                                            <td>
                                                                <div align="left">
                                                                    <input name="textfieldName" type="text" value="<?php echo $recibidorform; ?>" size="28" /></div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td bgcolor="#eeede5">
                                                                <div align="left">
                                                                    <font size="2" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>Start <?php echo $var; ?></strong></font></div>
                                                            </td>
                                                            <td>
                                                                <div align="left">
                                                                    <input type="text" name="textfieldName" value="<?php echo $startdischarging; ?> HRS." size="28" /></div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td bgcolor="#eeede5">
                                                                <div align="left">
                                                                    <font size="2" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>Completed <?php echo $var; ?></strong></font></div>
                                                            </td>
                                                            <td>
                                                                <div align="left">
                                                                    <input type="text" name="textfieldName" value="<?php echo $completedischarging; ?>  HRS." size="28" /></div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </td>
                                            <td bgcolor="#eeede5">
                                                <div align="center">
                                                    <table width="349" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td bgcolor="#eeede5">
                                                                <div align="left">
                                                                    <font size="2" color="black" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>Rate</strong></font></div>
                                                            </td>
                                                            <td><input type="text" name="textfieldName" value="<?php echo $dischperday; ?>" size="26" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td bgcolor="#eeede5">
                                                                <div align="left">
                                                                    <font size="2" color="black" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>Terms</strong></font></div>
                                                            </td>
                                                            <td><input name="textfieldName" type="text" value="<?php echo $terms; ?>" size="26" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td bgcolor="#eeede5">
                                                                <div align="left">
                                                                    <font size="2" color="black" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>Time Allowed</strong></font></div>
                                                            </td>
                                                            <td><input type="text" name="textfieldName" value="<?php echo $timeallowed; ?>" size="26" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td bgcolor="#eeede5">
                                                                <div align="left">
                                                                    <font size="2" color="black" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>Time To Count</strong></font></div>
                                                            </td>
                                                            <td><input type="text" name="textfieldName" value="<?php echo $timetocount; ?> HRS." size="26" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td bgcolor="#eeede5">
                                                                <div align="left">
                                                                    <font size="2" color="black" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>Nor Tendered</strong></font></div>
                                                            </td>
                                                            <td><input type="text" name="textfieldName" value="<?php echo $nortendered; ?> HRS." size="26" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td bgcolor="#eeede5">
                                                                <div align="left">
                                                                    <font size="2" color="black" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>Nor Presented</strong></font></div>
                                                            </td>
                                                            <td><input type="text" name="textfieldName" value="<?php echo $norpresented; ?> HRS." size="26" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td bgcolor="#eeede5">
                                                                <div align="left">
                                                                    <font size="2" color="black" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>Nor Acepted</strong></font></div>
                                                            </td>
                                                            <td><input type="text" name="textfieldName" value="<?php echo $noracepted; ?>" size="26" /></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </td>
                            <td bgcolor="black">
                                <div align="center">
                                    <table width="170" border="1" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td bgcolor="#0183bf">
                                                <div align="center">
                                                    <font size="2" color="white" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>TIME ALLOWED</strong></font></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#eeede5">
                                                <div align="center">
                                                    <font color="white" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><input type="text" name="textfieldName" value="<?php echo $timeallowed; ?>" size="17" /></font></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#0183bf">
                                                <div align="center">
                                                    <strong><font size="2" color="white" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif">TIME USED</font></strong></div>
                                            </td>
                                        </tr>
                                        <?php
                                        function formatoDias($arg) {
                                            $hora1=split(":",$arg);
                                            $horas=(int)$hora1[0];
                                            $minutos=(int)$hora1[1];
                                            $horas+=(int)($minutos/60);
                                            $minutos=$minutos%60;
                                            if($minutos==0)$minutos="00";
                                            $dias=(int)($horas/24);
                                            $minutos+=($horas%24)*60;
                                            $horas=(int)($minutos/60);
                                            $minutos=(int)($minutos%60);
                                            if($minutos==0)$minutos="00";
                                            return "$dias D: $horas H: $minutos M";
                                        }

                                        ?>
                                        <tr>
                                            <td bgcolor="#eeede5">
                                                <div align="center">
                                                    <font color="white"><input type="text" name="timeused" value="<?php echo formatoDias($timeused); ?>" size="17" /></font></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#0183bf">
                                                <div align="center">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#eeede5">
                                                <div align="center">
                                                    <p>
                                                      <?php
                                                    $vowels = array("D", "H", "M", " ");
                                                    $tallowed=str_replace($vowels, "", $timeallowed);
                                                    if(restaHorasIntStat($tallowed, $timeused)<0) {
                                                        $status="DEMURRAGE";
                                                    }
                                                    else {
                                                        $status="DISPATCH";
                                                    }
                                                    $diff=restaHorasdiff($tallowed, $timeused);


                                                    ?>
                                                      <input type="text" name="textfieldName" value="<?php echo $status; ?>" size="17" />
                                                      <br /><input type="text" name="textfieldName2" value="<?php echo $diff; ?>" size="17" /> 
                                                    </p>  
                                                </div>
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
                <td bgcolor="#0183bf">
                    <div align="center">
                        <font size="3" color="white" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>DESCRIPTION</strong></font></div>
                </td>
            </tr>
        </table>
        <table width="967" border="1" cellspacing="2" cellpadding="0">
          <tr>
                <td width="56" bgcolor="#0183bf"><font size="1.5" color="white" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>DATE</strong></font></td>
                <td width="29" bgcolor="#0183bf"><font size="1.5" color="white" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>DAY</strong></font></td>
                <td width="80" bgcolor="#0183bf"><font size="1.5" color="white" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>PERIOD</strong></font></td>
                <td width="56" bgcolor="#0183bf"><font size="1.5" color="white" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>TO DISCOUNT</strong></font></td>
                <td width="50" bgcolor="#0183bf"><font size="1.5" color="white" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>TIME (%)</strong></font></td>
                <td width="191" bgcolor="#0183bf"><font size="1.5" color="white" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>REMARKS FOR DEDUCTION</strong></font></td>
                <td width="91" bgcolor="#0183bf"><font size="1.5" color="white" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>TO COUNT</strong></font></td>
                <td width="80" bgcolor="#0183bf"><font size="1.5" color="white" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>TIME USED</strong></font></td>
                <td width="83" bgcolor="#0183bf"><font size="1.5" color="white" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>DEM/DISPACH</strong></font></td>
                <td width="207" bgcolor="#0183bf"><font size="1.5" color="white" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>REMARKS</strong></font></td>
            </tr>
            <?php
            function restaHoras($horaFin, $horaIni) {
                $hora1=$horaIni;
                $hora2=$horaFin;
                $hora1=split(":",$hora1);
                $hora2=split(":",$hora2);

                $minutos1=((int)$hora1[0]*60)+(int)$hora1[1];
                $minutos2=((int)$hora2[0]*60)+(int)$hora2[1];
                $minutosTotales=$minutos1-$minutos2;

                //$horas=(int)$hora1[0]-(int)$hora2[0];
                //$minutos=(int)$hora1[1]-(int)$hora2[1];
                //$horas+=(int)($minutos/60);
                $horas=(int)($minutosTotales/60);
                //$minutos=$minutos%60;
                $minutos=$minutosTotales%60;
                if($minutos==0)$minutos="00";
                else if($minutos==60) {
                        $minutos="00";
                        $horas++;
                    }
                return $horas.":".$minutos;
            }

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
            function restaHorasIntStat($horaIni, $horaFin) {
                $hora1=$horaIni;
                $hora2=$horaFin;
                $hora1=split(":",$hora1);
                $hora2=split(":",$hora2);
                $horas1=(int)($hora1[0]*24)+$hora1[1];
                $horas=(int)$horas1-(int)$hora2[0];
                $minutos=(int)$hora1[2]-(int)$hora2[1];
                $minutos+=$horas*60;
                return $minutos;
            }
            function restaHorasdiff($horaIni, $horaFin) {
                $hora1=$horaIni;
                $hora2=$horaFin;
                $hora1=split(":",$hora1);
                $hora2=split(":",$hora2);
                $horas1=(int)($hora1[0]*24)+$hora1[1];
                $horas=(int)$horas1-(int)$hora2[0];
                $minutos=(int)$hora1[2]-(int)$hora2[1];
                $minutos+=$horas*60;

                $horas=(int)($minutos/60);
                $minutos=($minutos%60);
                if($minutos==0)$minutos="00";
                else if($minutos==60) {
                        $minutos="00";
                        $horas++;
                    }
                $dias=(int)($horas/24);
                $horas=$horas%24;
                return $dias."D:".$horas."H:".$minutos."M";
            }
			function restaHorasdiffmin($horaIni, $horaFin) {
                $hora1=$horaIni;
                $hora2=$horaFin;
                $hora1=split(":",$hora1);
                $hora2=split(":",$hora2);
                $horas1=(int)($hora1[0]*24)+$hora1[1];
                $horas=(int)$horas1-(int)$hora2[0];
                $minutos=(int)$hora1[2]-(int)$hora2[1];
                $minutos+=$horas*60;

                $horas=(int)($minutos/60)*(-1);
                $minutos=($minutos%60)*(-1);
                if($minutos==0)$minutos="00";
                else if($minutos==60) {
                        $minutos="00";
                        $horas++;
                    }
                return $horas.":".$minutos;
            }

            function sumaHoras($horaIni, $horaFin) {
                $hora1=$horaIni;
                $hora2=$horaFin;
                $hora1=split(":",$hora1);
                $hora2=split(":",$hora2);
                $horas=(int)$hora1[0]+(int)$hora2[0];
                $minutos=(int)$hora1[1]+(int)$hora2[1];
                $horas+=(int)($minutos/60);
                $minutos=$minutos%60;
                if($minutos==0)$minutos="00";
                else if($minutos==60) {
                        $minutos="00";
                        $horas++;
                    }
                return $horas.":".$minutos;

            }

            function porcentajeHoras2($hora, $porcentaje) {
                $horas=0;
                $hora1=$hora;
                $por=$porcentaje;
                $hora1=split(":",$hora1);
                $htot=((int)$hora1[0]*60)+(int)$hora1[1];
				$buf=$htot*($por/100);
                $htot=(int)$htot*($por/100);
				$buf-=$htot;
                $horas+=(int)($htot/60);
                $minutos=$htot%60;
				if($buf>=0.5)
					$minutos++;
                if($minutos==0)$minutos="00";				
                return $horas.":".$minutos;

            }
            function porcentajeHoras($hora, $porcentaje) {
                $horas=0;
                $ajuste=0;
                $hora1=$hora;
                $por=$porcentaje;
                $hora1=split(":",$hora1);
                $htot=((int)$hora1[0]*60)+(int)$hora1[1];
                /*if(($por%100)>0)    {
                    $ajuste=1;
                }*/
				$buf=$htot*($por/100);
                $htot=(int)($htot*($por/100));
				$buf-=$htot;
                $horas+=(int)($htot/60);
                $minutos=$htot%60;
                $minutos+=$ajuste;
				if($buf>=0.5)
					$minutos++;
                if($minutos==0)$minutos="00";
                return $horas.":".$minutos;

            }
            function miliseg($var) {
                $mins=split(":", $var);
                $minfin=(int)$mins[1]+((int)$mins[0]*60);
                return (int)$minfin;
            }
            function mintoho($mtot) {
                $horas+=(int)($mtot/60);
                $minutos=$mtot%60;
                if($minutos==0)$minutos="00";
                return $horas.":".$minutos;
            }
            function portot($min, $totmin) {
                $portot=(100*$min)/$totmin;
                return $portot;
            }
            function plus($datex)    {
                list($year,$mon,$day) = explode(' ',$datex);
                return date('d m Y',mktime(0,0,0,$mon,$day+1,$year));
            }
            /////////////ESTADITICA FINALES

            $query="select distinct fecha from computotiempox where id='$id' order by fecha";
            $result=mysql_query($query, $link);
            $j=0;
            while($row = mysql_fetch_array($result)) {
                $fechax[$j]=$row["fecha"];
                $j++;
            }
            $timeused="00:00";
            $timeusedDem="00:00";
            $timelost="00:00";
            $I=0;
			$flagDem=false;
            /////ANALIZA LA INFORMACION POR DIA////////////////////////////////////////////////////////////////////////////////
            $first=true;////si es el primero
            for($i=0; $i<count($fechax); $i++) {
            /////ANALIZA LOS CONCEPTOS
                $query="select fecha, hinicial, hfinal, timepercent, fact, tipo, remarks from computotiempox where id='$id' and fecha='".$fechax[$i]."' and fecha>='$timetocount1' order by hinicial";
                //echo $query;
               
                $result = mysql_query($query, $link);
                
               
                ////////// Datos a imprimir
                $date="";
                $day="";
                $period="";
                $timepercent="";
                $remarks4="";
                $tocount="";
                $remarks="";

                while($row = mysql_fetch_array($result)) {
                    
                    $fca=$row["fecha"];
                    $date=strftime('%d %m %Y',strtotime($fca));
                    $day=strftime('%a',strtotime($fca));
                    //$hinicial=date("H:i", strtotime($row["hinicial"]));
                    //$hfinal=date("H:i", strtotime($row["hfinal"]));
                    $hinicial=$row["hinicial"];
                    $hfinal=$row["hfinal"];
                    $timepercent=$row["timepercent"];
                    $period=$hinicial." / ".$hfinal;
					$remarks=$row["remarks"];
                    ///////////////CUENTA EL TIEMPO
                    if($row["tipo"]=="STOP/IDLE TIME") {
                        //$remarks="STOP/IDLE TIME";
						//$remarks="";
                        $remarks4=$row["fact"]; //
                        $timepercentbuf=100-$timepercent;
                        $tocount=restaHoras($hinicial, $hfinal);

                        $toDiscount=porcentajeHoras2($tocount, $timepercent);
                        $tocount=porcentajeHoras($tocount, $timepercentbuf);
                        $timelost=sumaHoras($timelost, $toDiscount);
                        $timeused=sumaHoras($timeused, $tocount);

                        $VARX[$I]=$remarks4;
                        $VALX[$I]=miliseg($toDiscount);
                        $I++;
                        
                    }else {
                        //$remarks="OPERATIONAL";
                        $tocount=restaHoras($hinicial, $hfinal);
                        $timeused=sumaHoras($timeused, $tocount);
                        $timepercentbuf="100";
                        $remarks4=$row["fact"]; //ARISTIDES LO PIDIO ASI 25/03/2010
                        $toDiscount="";
                    }
					if(restaHorasIntStat($tallowed, $timeused)<0 && $flagDem==false) {
					$flagDem=true;
					$vowels = array("D", "H", "M", " ");
					$tallowed=str_replace($vowels, "", $timeallowed);
					$diferencia=restaHorasdiffmin($tallowed, $timeused);
					$period=$hinicial." / ".restaHoras($diferencia, $hfinal);
					$tocount=restaHoras($hinicial, restaHoras($diferencia, $hfinal));
					$tocount=porcentajeHoras($tocount, $timepercentbuf);
					$timeused2=restaHoras($diferencia, $timeused);
					?> <tr>
						<td><font size="1" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><?php echo $date; ?></font></td>
						<td><font size="1" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><?php echo $day; ?></font></td>
						<td><font size="1" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><?php echo $period; ?></font></td>
						<td><font size="1" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><?php echo $toDiscount; ?></font></td>
						<td><font size="1" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><?php echo $timepercentbuf; ?> %</font></td>
						<td><font size="1" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><?php echo $remarks4; ?></font></td>
						<td><font size="1" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><?php echo $tocount; ?></font></td>
						<td><font size="1" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><?php echo formatoDias($timeused2);?></font></td>
						<td><font size="1" color="red" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><b></b></font></td>
						<td><font size="1" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><?php if($remarks!="STOP/IDLE TIME"){echo $remarks;} ?></font></td>
					</tr>
                    <?php
					$period=restaHoras($diferencia, $hfinal)." / ".$hfinal;
					$tocount=restaHoras(restaHoras($diferencia, $hfinal), $hfinal);
					$tocount=porcentajeHoras($tocount, $timepercentbuf);
					?> <tr>
						<td><font size="1" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><?php echo $date; ?></font></td>
						<td><font size="1" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><?php echo $day; ?></font></td>
						<td><font size="1" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><?php echo $period; ?></font></td>
						<td><font size="1" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><?php echo $toDiscount; ?></font></td>
						<td><font size="1" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><?php echo $timepercentbuf; ?> %</font></td>
						<td><font size="1" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><?php echo $remarks4; ?></font></td>
						<td><font size="1" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><?php echo $tocount; ?></font></td>
						<td><font size="1" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><?php echo formatoDias($timeused);?></font></td>
						<td><font size="1" color="red" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><b><?php
															$vowels = array("D", "H", "M", " ");
															$tallowed=str_replace($vowels, "", $timeallowed);
															if(restaHorasIntStat($tallowed, $timeused)<0) {
																$timeusedDem=restaHorasdiff($tallowed, $timeused);
																if(restaHorasInt("23:59", $timeusedDem)<0) { echo formatoDias($timeusedDem);}else { echo $timeusedDem; }
															}
															else {
																echo "";
															}
															?></b></font></td>
						<td><font size="1" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><?php if($remarks!="STOP/IDLE TIME"){echo $remarks;} ?></font></td>
					</tr>
                    <?php
                    }	else	{

                                    ///////IMPRIME LA INFORMACION
                                    ?> <tr>
                <td><font size="1" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><?php echo $date; ?></font></td>
                <td><font size="1" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><?php echo $day; ?></font></td>
                <td><font size="1" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><?php echo $period; ?></font></td>
                <td><font size="1" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><?php echo $toDiscount; ?></font></td>
                <td><font size="1" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><?php echo $timepercentbuf; ?> %</font></td>
                <td><font size="1" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><?php echo $remarks4; ?></font></td>
                <td><font size="1" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><?php echo $tocount; ?></font></td>
                <td><font size="1" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><?php echo formatoDias($timeused);?></font></td>
                <td><font size="1" color="red" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><b><?php
                                                    $vowels = array("D", "H", "M", " ");
                                                    $tallowed=str_replace($vowels, "", $timeallowed);
                                                    if(restaHorasIntStat($tallowed, $timeused)<0) {
														$timeusedDem=restaHorasdiff($tallowed, $timeused);
                                                        if(restaHorasInt("23:59", $timeusedDem)<0) { echo formatoDias($timeusedDem);}else { echo $timeusedDem; }
                                                    }
                                                    else {
                                                        echo "";
                                                    }
                                                    ?></b></font></td>
                <td><font size="1" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><?php if($remarks!="STOP/IDLE TIME"){echo $remarks;} ?></font></td>
            </tr>
                                <?php
								}
            
            }////FIN DEL PROCESO DEL WHILE QUE ANALIZA LOS REGISTROS
            }//FIN DEL IF QUE REPRESENTA LAS FECHAS
/*
            ?>

        </table>
        <hr />
        <p class="tit">Estadistic Report</p>
        <table width="380" border="1">
            <tr>
                <td width="256" bgcolor="#0183bf" class="abajoz">Total Time Discounted</td>
                <td width="108" class="sdfgd"><?php
                                    if(restaHorasInt("23:59", $timelost)<0) { echo formatoDias($timelost);}else { echo $timelost; }?></td>
            </tr>
            <tr>
                <td bgcolor="#0183bf" class="abajoz">Total Time Percent Discounted</td>
                <td class="sdfgd"><?php
                                        echo number_format(portot(miliseg($timelost), (miliseg($timeused)+miliseg($timelost))), 3);
                                        ?>%</td>
            </tr>
            <tr>
                <td bgcolor="#0183bf" class="abajoz">Total Time Percent Used</td>
                <td class="sdfgd"><?php
                                        echo number_format(portot(miliseg($timeused), (miliseg($timeused)+miliseg($timelost))), 3);
                                        ?>%</td>
            </tr>
        </table>
        <p class="tit">Estadistic of Time Discounted by Remarks</p>
                            <?php
                            ///////////////////////ESTADISTICAS
                            $i=0;
                            $j=0;
                            $x=0;
                            $buf[$x]=null;
                            $bufVal[$x]=null;
                            while($j<count($VARX)) {

                                for($i=0; $i<count($VARX); $i++) {
                                    if($buf[$x]==null) {
                                        if($VARX[$i]!=null) {
                                            $buf[$x]=$VARX[$i];
                                            $bufVal[$x]=$VALX[$i];
                                            $VARX[$i]=null;
                                            $VALX[$i]=null;
                                            $j++;
                                        }
                                    }
                                    else {
                                        if($VARX[$i]==$buf[$x]) {
                                            $bufVal[$x]+=$VALX[$i];
                                            $VARX[$i]=null;
                                            $VALX[$i]=null;
                                            $j++;
                                        }
                                    }
                                }//fin for
                                $x++;
                                $buf[$x]=null;
                            }//fin while

                            ///////////////////////////////////
                            ?>
        <table width="408" border="1">
            <tr class="abajoz">
                <td width="230" bgcolor="#0183bf">Remark</td>
                <td width="96" bgcolor="#0183bf">Time Discounted</td>
                <td width="60" bgcolor="#0183bf">Percent</td>
            </tr>
                                <?php for($i=0; $i<$x; $i++) { ?>
            <tr class="normal">
                <td><?php echo $buf[$i];?>&nbsp;</td>
                <td class="sdfgd">
                                            <?php if(restaHorasInt("23:59", mintoho($bufVal[$i]))<0) { echo formatoDias(mintoho($bufVal[$i]));}else { echo mintoho($bufVal[$i]); }?>
                    &nbsp;</td>
                <td class="sdfgd"><?php echo number_format(portot($bufVal[$i], (miliseg($timeused)+miliseg($timelost))), 3);?>%</td>
            </tr>
                                <?php }*/ ?>
        </table>
        <?php //if($status=="DISPATCH")	{ comentado por aristides?>
        <table width="617" border="1" cellspacing="2" cellpadding="0">        
		  <tr>
		    <td width="609"><div align="left"> <font size="4" color="#0183bf" face="Tahoma">Participation:</font></div></td>
	      </tr>
		  <tr>
		    <td><table width="607" border="1" cellspacing="2" cellpadding="0">
		      <tr>
		        <td width="394" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>RECEIVER</strong></font></td>
		        <td width="121" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>TONNAGE</strong></font></td>
		        <td width="76" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>%</strong></font></td>
	          </tr>
		      <?php
                                                $query = "select distinct recibidor from chargeinformation where id='$id'";
                                                $j=0;
                                                $result = mysql_query($query, $link);
                                                while($row = mysql_fetch_array($result)) {
                                                     $recibidor[$j]=$row["recibidor"];
                                                        $j++;
                                                }
                                                for($i=0; $i<count($recibidor); $i++) {
                                                    //$query = "select recibidor, producto, pesoneto, bl from chargeinformation where id='$id' and recibidor='$recibidor[$i]' and producto='$producto[$i]'";
													$query = "select distinct recibidor, producto, pesoneto, bl from chargeinformation where id='$id' and recibidor='$recibidor[$i]'";
                                                    $result = mysql_query($query, $link);
                                                    $bl="";
                                                    $pesoneto=0.000;
                                                    while($row = mysql_fetch_array($result)) {
                                                        $reciver = $row["recibidor"];
                                                        $bl=$bl.$row["bl"].", ";
                                                        $pesoneto+=str_replace(",", "", $row["pesoneto"]);														
                                                    }
													$por=(($pesoneto*100)/($total));
                                                    ?>
		      <tr>
		        <td><span class="ablaabajo"><font face="Tahoma"><?php echo $recibidor[$i]; ?></font></span></td>
		        <td><span class="ablaabajo"><font face="Tahoma"><?php printf("%.3f", $pesoneto);?></font></span></td>
		        <td><span class="ablaabajo"><font face="Tahoma"><?php printf("%.2f", $por);?> %</font></span></td>
	          </tr>
		      <?php
                                                }
						
						?>
                        <tr>
		        <td><span class="ablaabajo"><font face="Tahoma">TTL</font></span></td>
		        <td><span class="ablaabajo"><font face="Tahoma"><?php printf("%.3f", $total);?></font></span></td>
		        <td><span class="ablaabajo"><font face="Tahoma"><?php echo "100.00%";?></font></span></td>
	          </tr>
		      </table></td>
	      </tr>
</table>
<?php //} ?>
        <font size="-2">Powered in association  by TWIN MARINE DE MEXICO, S.A. DE C.V.  and  DAKA Technology. &lt;&lt;Copyright © 2009-2010 All Rights Reserved&gt;&gt;</font>
    </body>

</html>