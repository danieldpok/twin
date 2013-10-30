<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<?php
include("conexion.php");
$id=$_GET["id"];
//$id="11111";
//DATOS DEL REGISTRO
$table="operaciones";
$fields="vessel, cargotype, quantity, startdischarging, completedescharging, dischperday, timeallowed, timetocount, nortendered, norpresented, noracepted, timeallowed";

$query = "select ".$fields." from ".$table." where id='".$id."'";
//echo $query;
$link = Conectar();
$result = mysql_query($query, $link);

while($row = mysql_fetch_array($result)) {
    setlocale(LC_TIME , 'es_ES');

    $vessel=$row["vessel"];
    $cargaentransito=$row["cargotype"];
    $quantity=$row["quantity"];
    $startdischarging=strftime('%d %b %y AT %H:%M',strtotime($row["startdischarging"]));
    $completedischarging=strftime('%d %b %y AT %H:%M',strtotime($row["completedescharging"]));
    $start=date("H:i", strtotime($row["startdischarging"]));
    $complete=date("H:i", strtotime($row["completedescharging"]));
    $dischperday=$row["dischperday"];
    $timeallowed=$row["timeallowed"];
    $timetocount1=strftime('%Y-%m-%d',strtotime($row["timetocount"]));
    $timetocount=strftime('%d %b %y AT %H:%M',strtotime($row["timetocount"]));
    $nortendered=strftime('%d %b %y AT %H:%M',strtotime($row["nortendered"]));
    $norpresented=strftime('%d %b %y AT %H:%M',strtotime($row["norpresented"]));
    $noracepted=strftime('%d %b %y AT %H:%M',strtotime($row["noracepted"]));
    $timeallowed=$row["timeallowed"];

}

////////////////////////////////////////////////////////////////////////
////////TTTTTTTTT  IIIIII  MMM   MMM   EEEEEEE             ////////////
////////   TT        II    MM  M  MM   EEE E                ////////////
////////   TT      IIIIII  MM     MM   EEEEEEE              ////////////
////////////////////////////////////////////////////////////////////////

$query="select distinct fecha from computotiempo where id='$id' order by fecha";
            $result=mysql_query($query, $link);
            $j=0;
            while($row = mysql_fetch_array($result)) {
                $fechax[$j]=$row["fecha"];
                $j++;
            }
            $timeused="00:00";
            /////ANALIZA LA INFORMACION POR DIA////////////////////////////////////////////////////////////////////////////////
            $first=true;////si es el primero
            for($i=0; $i<count($fechax); $i++) {
            /////ANALIZA LOS CONCEPTOS
                $query="select fecha, hinicial, hfinal, timepercent, fact, tipo from computotiempo where id='$id' and (tipo='OPERATIONAL' or tipo='STOP/IDLE TIME') and fecha='".$fechax[$i]."' and fecha>='$timetocount1' order by hinicial";
                //echo $query;
                $n=0;//NUMERO DE REGISTROS
                ///CONTAMOS EL NUMERO DE REGISTROS
                $result = mysql_query($query, $link);
                while($row = mysql_fetch_array($result)) {
                    $n++;
                }

                $pos=0;//POSICION DEL REGISTRO ACTUAL
                $result = mysql_query($query, $link);
                $buferTime=null;///bufer del tipo
                $bufHinicial="00:00";///bufer de la hora inicial
                $flag=true;///flag para leer informacion
                //$first=true;////si es el primero
                $last=false;
                ////////// Datos a imprimir
                $date="";
                $day="";
                $period="";
                $timepercent="";
                $remarks4="";
                $tocount="";
               

                while($row = mysql_fetch_array($result)) {
                //$bufHinicial="00:00";
                    if($pos==($n-1)) {
                        $last=true;
                    }
                    if($first) {
                        $bufHinicial=$start;
                        //$buferTime=$row["timepercent"];
                        $first=false;
                    }
                    
                    $fca=$row["fecha"];
                    $date=strftime('%d %m %Y',strtotime($fca));
                    $day=strftime('%a',strtotime($fca));
                    $hfinal=date("H:i", strtotime($row["hfinal"]));
                    $timepercent=$row["timepercent"];


                    //$remarks=$row["clasificacion"];
                    $tocount=restaHoras($bufHinicial, $hfinal);
                    /////SI IDENTIFICA QUE NO ES TIEMPO AL 100% IMPRIME Y COMIENZA UNA NUEVA CUENTA
                    if($timepercent=="") {
                        $timepercent=100;
                    }
                    else if($timepercent!="") {
                        //////////////////////////////////////////////////////////////////////////////////
                        $hinicial=date("H:i", strtotime($row["hinicial"]));
                        if($bufHiniciallast!=$hinicial)    {
                        $tocount=restaHoras($bufHiniciallast, $hinicial);
                        $period=$bufHiniciallast." / ".$hinicial;
                        $timeused=sumaHoras($timeused, $tocount);

                        }
                        //////////////////////////////////////////////////////////////////////////////////
                        $remarksx=$row["fact"]; //
                            $timepercentbuf=100-$timepercent;
                            $hinicial=date("H:i", strtotime($row["hinicial"]));
                            $tocount=restaHoras($hinicial, $hfinal);
                            $toDiscount=porcentajeHoras($tocount, $timepercent);
                            $tocount=porcentajeHoras($tocount, $timepercentbuf);

                        $period=$hinicial." / ".$hfinal;
                        $timeused=sumaHoras($timeused, $tocount);
                        $bufHinicial=$hfinal;

                        }
                    /////SI ES EL ULTIMO REGISTRO DEL DIA IMPRIME LA INFORMACION
                    if($last) {
                        if($i!=(count($fechax)-1) and $hfinal!="23:59") {
                            $hfinal="23:59";
                        }
                        else if($i==(count($fechax)-1))   {
                            $hfinal=$complete;
                        }

                        $tocount=restaHoras($bufHinicial, $hfinal);
                        $print=$hfinal!="23:59"?$hfinal:"24:00";
                        $period=$bufHinicial." / ".$print;
                        $timeused=sumaHoras($timeused, $tocount);
                        $bufHinicial="00:00";
                        if($print=="24:00") {
                            $timeused++;
                            $tocount++;
                        }

                    }
                    $bufHiniciallast=$bufHinicial;
                    $pos++;
            }////FIN DEL PROCESO DEL WHILE QUE ANALIZA LOS REGISTROS
            }//FIN DEL IF QUE REPRESENTA LAS FECHAS



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
-->
    </style>
    </head>

<body bgcolor="#ffffff">


        <table width="966" border="1" cellspacing="2" cellpadding="0">
            <tr>
                <td bgcolor="#0183bf">
                    <div align="center">
						<table width="954" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td><img src="logo.jpg" alt="" width="385" height="120" border="0" /></td>
								<td>
									<div align="center">
										<font size="5" color="white" face="Tahoma"><strong>TIME CALCULATION</strong></font></div>
								</td>
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
													<font size="3" color="white" face="Tahoma"><strong>	GENERAL INFORMATION</strong></font></div>
                                            </td>
                                            <td bgcolor="#0183bf">
                                                <div align="center">
													<font size="3" color="white" face="Tahoma"><strong>	TERMS AND CONDITIONS</strong></font></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#eeede5">
												<div align="center">
													<table width="418" border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td bgcolor="#eeede5">
																<div align="left">
																	<font size="2" face="Tahoma"><strong>Vessel</strong></font></div>
															</td>
															<td>
																<div align="left">
																	<input type="text" name="textfieldName" value="<?php echo $vessel; ?>" size="28" /></div>
															</td>
														</tr>
														<tr>
															<td bgcolor="#eeede5">
																<div align="left">
																	<font size="2" face="Tahoma"><strong>Port</strong></font></div>
															</td>
															<td>
																<div align="left">
																	<input type="text" name="textfieldName" size="28" /></div>
															</td>
														</tr>
														<tr>
															<td bgcolor="#eeede5">
																<div align="left">
																	<font size="2" face="Tahoma"><strong>Cargo</strong></font></div>
															</td>
															<td>
																<div align="left">
																	<input type="text" name="textfieldName" value="<?php echo $cargaentransito; ?>" size="28" /></div>
															</td>
														</tr>
														<tr>
															<td bgcolor="#eeede5">
																<div align="left">
																	<font size="2" face="Tahoma"><strong>Quantity</strong></font></div>
															</td>
															<td>
																<div align="left">
																	<input type="text" name="textfieldName" align="right" value="<?php printf("%.3f", $quantity);?>" size="28" /></div>
															</td>
														</tr>
														<tr>
															<td bgcolor="#eeede5">
																<div align="left">
																	<font size="2" face="Tahoma"><strong>Receiver</strong></font></div>
															</td>
															<td>
																<div align="left">
																	<input type="text" name="textfieldName" size="28" /></div>
															</td>
														</tr>
														<tr>
															<td bgcolor="#eeede5">
																<div align="left">
																	<font size="2" face="Tahoma"><strong>Start Discharging</strong></font></div>
															</td>
															<td>
																<div align="left">
																	<input type="text" name="textfieldName" value="<?php echo $startdischarging; ?>" size="28" /></div>
															</td>
														</tr>
														<tr>
															<td bgcolor="#eeede5">
																<div align="left">
																	<font size="2" face="Tahoma"><strong>Completed Discharging</strong></font></div>
															</td>
															<td>
																<div align="left">
																	<input type="text" name="textfieldName" value="<?php echo $completedischarging; ?>" size="28" /></div>
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
																	<font size="2" color="black" face="Tahoma"><strong>Rate</strong></font></div>
															</td>
															<td><input type="text" name="textfieldName" value="<?php echo $dischperday; ?>" size="26" /></td>
														</tr>
														<tr>
															<td bgcolor="#eeede5">
																<div align="left">
																	<font size="2" color="black" face="Tahoma"><strong>Terms</strong></font></div>
															</td>
															<td><input type="text" name="textfieldName" size="26" /></td>
														</tr>
														<tr>
															<td bgcolor="#eeede5">
																<div align="left">
																	<font size="2" color="black" face="Tahoma"><strong>Time Alowed</strong></font></div>
															</td>
															<td><input type="text" name="textfieldName" value="<?php echo $timeallowed; ?>" size="26" /></td>
														</tr>
														<tr>
															<td bgcolor="#eeede5">
																<div align="left">
																	<font size="2" color="black" face="Tahoma"><strong>Time To Count</strong></font></div>
															</td>
															<td><input type="text" name="textfieldName" value="<?php echo $timetocount; ?>" size="26" /></td>
														</tr>
														<tr>
															<td bgcolor="#eeede5">
																<div align="left">
																	<font size="2" color="black" face="Tahoma"><strong>Nor Tendered</strong></font></div>
															</td>
															<td><input type="text" name="textfieldName" value="<?php echo $nortendered; ?>" size="26" /></td>
														</tr>
														<tr>
															<td bgcolor="#eeede5">
																<div align="left">
																	<font size="2" color="black" face="Tahoma"><strong>Nor Presented</strong></font></div>
															</td>
															<td><input type="text" name="textfieldName" value="<?php echo $norpresented; ?>" size="26" /></td>
														</tr>
														<tr>
															<td bgcolor="#eeede5">
																<div align="left">
																	<font size="2" color="black" face="Tahoma"><strong>Nor Acepted</strong></font></div>
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
                                                    <font size="2" color="white" face="Tahoma"><strong>TIME ALLOWED</strong></font></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#eeede5">
                                                <div align="center">
													<font color="white" face="Tahoma"><input type="text" name="textfieldName" value="<?php echo $timeallowed; ?>" size="17" /></font></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#0183bf">
                                                <div align="center">
                                                    <strong><font size="2" color="white" face="Tahoma">TIME USED</font></strong></div>
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
                                                <?php
                                                $vowels = array("D", "H", "M", " ");
                                                $tallowed=str_replace($vowels, "", $timeallowed);
                                                if(restaHorasIntStat($tallowed, $timeused)<0)	{
                                                	$status="DEMURRAGE";
                                                }
                                                else	{
                                                	$status="DISPATCH";
                                                }
                                                
                                                
                                                ?>
                                                    <input type="text" name="textfieldName" value="<?php echo $status; ?>" size="17" /></div>
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
                        <font size="3" color="white" face="Tahoma"><strong>DESCRIPTION</strong></font></div>
                </td>
            </tr>
        </table>
        <table width="967" border="1" cellspacing="2" cellpadding="0">
            <tr>
                <td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>DATE</strong></font></td>
                <td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>DAY</strong></font></td>
                <td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>PERIOD</strong></font></td>
                <td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>TO DISCOUNT</strong></font></td>
                <td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>TIME (%)</strong></font></td>
                <td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>REMARKS FOR DEDUCTION</strong></font></td>
                <td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>TO COUNT</strong></font></td>
                <td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>TIME USED</strong></font></td>
                <td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>DEMURRAGE</strong></font></td>
                <td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>REMARKS</strong></font></td>
            </tr>
            <?php
            function restaHoras($horaIni, $horaFin) {
                return (date("H:i", strtotime("00:00") + strtotime($horaFin) - strtotime($horaIni) ));
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
				else if($minutos==60)	{ 
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
                $htot=(int)$htot*($por/100);
                $horas+=(int)($htot/60);
                $minutos=$htot%60;
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
                $htot=(int)($htot*($por/100));
                $horas+=(int)($htot/60);
                $minutos=$htot%60;
                $minutos+=$ajuste;
                if($minutos==0)$minutos="00";
                return $horas.":".$minutos;

            }
			function miliseg($var)	{
				$mins=split(":", $var);
				$minfin=(int)$mins[1]+((int)$mins[0]*60);
				return (int)$minfin;
			}
			function mintoho($mtot)	{
				$horas+=(int)($mtot/60);
                $minutos=$mtot%60;
				if($minutos==0)$minutos="00";
                return $horas.":".$minutos;
			}
			function portot($min, $totmin)	{
				$portot=(100*$min)/$totmin;
				return $portot;
			}
			
			/////////////ESTADITICA FINALES
			$lineas=0;
			$PTotal=0;
			$PAcumulado=0;


            $query="select distinct fecha from computotiempo where id='$id' order by fecha";
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
                $query="select fecha, hinicial, hfinal, timepercent, fact, tipo from computotiempo where id='$id' and (tipo='OPERATIONAL' or tipo='STOP/IDLE TIME') and fecha='".$fechax[$i]."' and fecha>='$timetocount1' order by hinicial";
                //echo $query;
                $n=0;//NUMERO DE REGISTROS
                ///CONTAMOS EL NUMERO DE REGISTROS
                $result = mysql_query($query, $link);
                while($row = mysql_fetch_array($result)) {
                    $n++;
                }

                $pos=0;//POSICION DEL REGISTRO ACTUAL
                $result = mysql_query($query, $link);
                $buferTime=null;///bufer del tipo
                $bufHinicial="00:00";///bufer de la hora inicial
                $flag=true;///flag para leer informacion
                //$first=true;////si es el primero
                $last=false;
                ////////// Datos a imprimir
                $date="";
                $day="";
                $period="";
                $timepercent="";
                $remarks4="";
                $tocount="";
                $remarks="";

                while($row = mysql_fetch_array($result)) {
                //$bufHinicial="00:00";
                    if($pos==($n-1)) {
                        $last=true;
                    }
                    if($first) {
                        $bufHinicial=$start;
                        //$buferTime=$row["timepercent"];
                        $first=false;
                    }

                    if($row["tipo"]=="STOP/IDLE TIME")	{
                    $remarks="STOP/IDLE TIME";
                    }else{
                    $remarks="OPERATIONAL";
                    }
                    $fca=$row["fecha"];
                    $date=strftime('%d %m %Y',strtotime($fca));
                    $day=strftime('%a',strtotime($fca));
                    $hfinal=date("H:i", strtotime($row["hfinal"]));
                    $timepercent=$row["timepercent"];


                    //$remarks=$row["clasificacion"];
                    $tocount=restaHoras($bufHinicial, $hfinal);
                    /////SI IDENTIFICA QUE NO ES TIEMPO AL 100% IMPRIME Y COMIENZA UNA NUEVA CUENTA
                    if($timepercent=="") {
                        $timepercent=100;
                    }
                    else if($timepercent!="") {
                        //////////////////////////////////////////////////////////////////////////////////
                        $hinicial=date("H:i", strtotime($row["hinicial"]));
                        if($bufHiniciallast!=$hinicial)    {
                        $tocount=restaHoras($bufHiniciallast, $hinicial);
                        $period=$bufHiniciallast." / ".$hinicial;
                        $timeused=sumaHoras($timeused, $tocount);
                        //$bufHinicial="00:00";
                        ///////IMPRIME LA INFORMACION
                        
                    $remarks="OPERATIONAL";
					$lineas++;
					$PTotal+=100;
                        ?> <tr>
                <td><font size="1" face="Tahoma"><?php echo $date; ?></font></td>
                <td><font size="1" face="Tahoma"><?php echo $day; ?></font></td>
                <td><font size="1" face="Tahoma"><?php echo $period; ?></font></td>
                <td></td>
                <td><font size="1" face="Tahoma">100 %</font></td>
                <td><font size="1" face="Tahoma"><?php echo $remarks4; ?></font></td>
                <td><font size="1" face="Tahoma"><?php echo $tocount; ?></font></td>
                <td><font size="1" face="Tahoma"><?php if(restaHorasInt("23:59", $timeused)<0){ echo formatoDias($timeused);}else{ echo $timeused; }?></font></td>
                <td><font size="2" color="red" face="Tahoma"><b><?php
                $vowels = array("D", "H", "M", " ");
                $tallowed=str_replace($vowels, "", $timeallowed);
                if(restaHorasIntStat($tallowed, $timeused)<0)	{
                	$timeusedDem=sumaHoras($timeusedDem, $tocount);
                	//echo $timeusedDem;
                      if(restaHorasInt("23:59", $timeusedDem)<0){ echo formatoDias($timeusedDem);}else{ echo $timeusedDem; }
                }
                else	{
                      echo "";
                }
                ?></b></font></td>
                <td><font size="1" face="Tahoma"><?php echo $remarks; ?></font></td>
                </tr>
                        <?php
                        }
                        //////////////////////////////////////////////////////////////////////////////////
                        $remarksx=$row["fact"]; //
                            $timepercentbuf=100-$timepercent;
                            $hinicial=date("H:i", strtotime($row["hinicial"]));
                            $tocount=restaHoras($hinicial, $hfinal);
                            $toDiscount=porcentajeHoras2($tocount, $timepercent);
                            $tocount=porcentajeHoras($tocount, $timepercentbuf);
                            
                        $period=$hinicial." / ".$hfinal;
                        $timeused=sumaHoras($timeused, $tocount);
                        $bufHinicial=$hfinal;
                        if($timepercentbuf!="100")	{
                    $remarks="STOP/IDLE TIME";
                    }else{
                    $remarks="OPERATIONAL";
                    }
					$lineas++;
					$timelost=sumaHoras($timelost, $toDiscount);
					$PTotal+=$timepercentbuf;
					//////////////////////GUARDA PARA ESTADISTICA
					$VARX[$I]=$remarksx;
					$VALX[$I]=miliseg($toDiscount);
					$I++;
					///////////////////////////////////////////////
                        ///////IMPRIME LA INFORMACION
                        ?> <tr>
                <td><font size="1" face="Tahoma"><?php echo $date; ?></font></td>
                <td><font size="1" face="Tahoma"><?php echo $day; ?></font></td>
                <td><font size="1" face="Tahoma"><?php echo $period; ?></font></td>
                <td><font size="1" face="Tahoma"><?php echo $toDiscount; ?></font></td>
                <td><font size="1" face="Tahoma"><?php echo $timepercentbuf; ?> %</font></td>
                <td><font size="1" face="Tahoma"><?php echo $remarksx; ?></font></td>
                <td><font size="1" face="Tahoma"><?php echo $tocount; ?></font></td>
                <td><font size="1" face="Tahoma"><?php if(restaHorasInt("23:59", $timeused)<0){ echo formatoDias($timeused);}else{ echo $timeused; }?></font></td>
                <td><font size="2" color="red" face="Tahoma"><b><?php
                $vowels = array("D", "H", "M", " ");
                $tallowed=str_replace($vowels, "", $timeallowed);
                if(restaHorasIntStat($tallowed, $timeused)<0)	{
                	$timeusedDem=sumaHoras($timeusedDem, $tocount);
                	//echo $timeusedDem;
                      if(restaHorasInt("23:59", $timeusedDem)<0){ echo formatoDias($timeusedDem);}else{ echo $timeusedDem; }
                }
                else	{
                      echo "";
                }
                ?></b></font></td>
                <td><font size="1" face="Tahoma"><?php echo $remarks; ?></font></td>
            </tr>
                        <?php
                        }
                    /////SI ES EL ULTIMO REGISTRO DEL DIA IMPRIME LA INFORMACION
                    if($last) {
                        if($i!=(count($fechax)-1) and $hfinal!="23:59") {
                            $hfinal="23:59";
                        }
                        else if($i==(count($fechax)-1))   {
                            $hfinal=$complete;
                        }

                        $tocount=restaHoras($bufHinicial, $hfinal);
                        $print=$hfinal!="23:59"?$hfinal:"24:00";
                        $period=$bufHinicial." / ".$print;
                        $timeused=sumaHoras($timeused, $tocount);
                        if($print=="24:00") {
                            $timeused++;
                            $tocount++;
                        }
                        $bufHinicial="00:00";
                        if($timepercent!="100")	{
                    $remarks="STOP/IDLE TIME";
                    }else{
                    $remarks="OPERATIONAL";
                    }
					$lineas++;
					$PTotal+=$timepercent;
                        ///////IMPRIME LA INFORMACION
                        ?> <tr>
                <td><font size="1" face="Tahoma"><?php echo $date; ?></font></td>
                <td><font size="1" face="Tahoma"><?php echo $day; ?></font></td>
                <td><font size="1" face="Tahoma"><?php echo $period; ?></font></td>
                <td></td>
                <td><font size="1" face="Tahoma"><?php echo $timepercent; ?> %</font></td>
                <td><font size="1" face="Tahoma"><?php echo $remarks4; ?></font></td>
                <td><font size="1" face="Tahoma"><?php echo $tocount; ?></font></td>
                <td><font size="1" face="Tahoma"><?php if(restaHorasInt("23:59", $timeused)<0){ echo formatoDias($timeused);}else{ echo $timeused; }?></font></td>
                <td><font size="2" color="red" face="Tahoma"><b><?php
                $vowels = array("D", "H", "M", " ");
                $tallowed=str_replace($vowels, "", $timeallowed);
                if(restaHorasIntStat($tallowed, $timeused)<0)	{
                	$timeusedDem=sumaHoras($timeusedDem, $tocount);
                	//echo $timeusedDem;
                      if(restaHorasInt("23:59", $timeusedDem)<0){ echo formatoDias($timeusedDem);}else{ echo $timeusedDem; }
                }
                else	{
                      echo "";
                }
                
                ?></b></font></td>
                <td><font size="1" face="Tahoma"><?php echo $remarks; ?></font></td>
            </tr>
                    <?php
                    }
                    $bufHiniciallast=$bufHinicial;
                    $pos++;
            }////FIN DEL PROCESO DEL WHILE QUE ANALIZA LOS REGISTROS
            }//FIN DEL IF QUE REPRESENTA LAS FECHAS

            ?>

        </table>
        <hr />
<p class="tit">Estadistic Report</p>
		<table width="380" border="1">
		  <tr>
		    <td width="256" bgcolor="#0183bf" class="abajoz">Total Time Discounted</td>
		    <td width="108" class="sdfgd"><?php
			if(restaHorasInt("23:59", $timelost)<0){ echo formatoDias($timelost);}else{ echo $timelost; }?></td>
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
		while($j<count($VARX))	{
			
			for($i=0; $i<count($VARX); $i++)	{
				if($buf[$x]==null)	{
					if($VARX[$i]!=null)	{
						$buf[$x]=$VARX[$i];
						$bufVal[$x]=$VALX[$i];
						$VARX[$i]=null;
						$VALX[$i]=null;
						$j++;
					}
				}
				else	{
					if($VARX[$i]==$buf[$x])	{
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
          <?php for($i=0; $i<$x; $i++)	{ ?>
		  <tr class="normal">
		    <td><?php echo $buf[$i];?>&nbsp;</td>
		    <td class="sdfgd">
	        <?php if(restaHorasInt("23:59", mintoho($bufVal[$i]))<0){ echo formatoDias(mintoho($bufVal[$i]));}else{ echo mintoho($bufVal[$i]); }?>
	        &nbsp;</td>
		    <td class="sdfgd"><?php echo number_format(portot($bufVal[$i], (miliseg($timeused)+miliseg($timelost))), 3);?>%</td>
	      </tr>
          <?php } ?>
    </table>
	<p><font size="-2">Powered in association  by TWIN MARINE DE MEXICO, S.A. DE C.V.  and  DAKA Technology.</font></p>
    </body>

</html>