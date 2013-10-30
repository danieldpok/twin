<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<?php
include("conexion.php");
$id=$_GET["id"];

//////////////////////////FUNCIONES

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
                $minutos=$minutos%60;
                if($minutos==0)$minutos="00";
                else if($minutos==60) {
                        $minutos="00";
                        $horas++;
                    }
                $dias=(int)($horas/24);
                $horas=$horas%24;
                return $dias."D:".$horas."H:".$minutos."M";
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
				if($totmin!=0)
                	$portot=(100*$min)/$totmin;
				else
					$portot=0;
                return $portot;
            }
            function plus($datex)    {
                list($year,$mon,$day) = explode(' ',$datex);
                return date('d m Y',mktime(0,0,0,$mon,$day+1,$year));
            }
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

//////////////////////////
//DATOS DEL REGISTRO
$table="operaciones";
$fields="vessel, flag, puertodecarga, quantity, cargotype, sofremarks, remarks, typex";

$query = "select ".$fields." from ".$table." where id='".$id."'";

$link = Conectar();
$result = mysql_query($query, $link);

while($row = mysql_fetch_array($result)) {
    $vessel=$row["vessel"];
    $flag=$row["flag"];
    $puertodecarga=$row["puertodecarga"];
    $quantity=$row["quantity"];
    $cargaentransito=$row["cargotype"];
	$sof=$row["sofremarks"];
	$remarks=$row["remarks"];
	$type=$row["typex"];
}

////////////////////////////////
//OBTENER LOS HECHOS
$table="computotiempo";
$fields="fecha, hinicial, hfinal, fact";

$query = "select ".$fields." from ".$table." where id='".$id."'";
//echo $query;
//$result = mysql_query($query, $link);
////////////////////////////////////////
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

?>

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <meta name="generator" content="Adobe GoLive" />
        <title>TIME CALCULATION STATISTICS REPORT</title>
        <link href="css/basic.css" rel="stylesheet" type="text/css" media="all" />
    <style type="text/css">
<!--
.asd {
	text-align: center;
}
.asdX {
	text-align: left;
}
.gdfgdgd {
	font-family: Tahoma, Geneva, sans-serif;
}
.gdfgdgd {
	color: #FFF;
}
-->
    </style>
    </head>

<body bgcolor="#ffffff">
      <table width="782" border="1" cellspacing="2" cellpadding="0">
            <tr>
                <td bgcolor="#0183bf">
					<div align="left">
						<table width="768" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td bgcolor="#0183bf">
									<div align="center"><font color="white" size="+1" face="Tahoma">TIME CALCULATION STATISTICS REPORT</font></div>
								</td>
							</tr>
						</table>
					</div>
				</td>
            </tr>
        </table>
      <img src="logo.jpg" alt="" width="385" height="120" border="0" />
<p class="tit">Estadistic Report</p>
        <table width="380" border="1">
            <tr>
                <td width="256" bgcolor="#0183bf" class="gdfgdgd"><font size="2">Total Time Lost</font></td>
                <td width="108" class="sdfgd"><?php
                                    if(restaHorasInt("23:59", $timelost)<0) { echo formatoDias($timelost);}else { echo $timelost; }?></td>
            </tr>
            <tr>
                <td bgcolor="#0183bf" class="gdfgdgd"><font size="2">Total Time Lost Percent</font></td>
                <td class="sdfgd"><?php
                                        echo number_format(portot(miliseg($timelost), (miliseg($timeused)+miliseg($timelost))), 3);
                                        ?>%</td>
            </tr>
            <tr>
                <td bgcolor="#0183bf" class="gdfgdgd"><font size="2">Total Time Percent Used</font></td>
                <td class="sdfgd"><?php
                                        echo number_format(portot(miliseg($timeused), (miliseg($timeused)+miliseg($timelost))), 3);
                                        ?>%</td>
            </tr>
        </table>
<p class="tit">Estadistic of Time Discounted by Remarks
  <?php
  

                            ///////////////////////ESTADISTICAS
                            $i=0;
                            $j=0;
                            $x=0;
                            $bufx[$x]=null;
                            $bufVal[$x]=null;
                            while($j<count($VARX)) {

                                for($i=0; $i<count($VARX); $i++) {
                                    if($bufx[$x]==null) {
                                        if($VARX[$i]!=null) {
                                            $bufx[$x]=$VARX[$i];
                                            $bufVal[$x]=$VALX[$i];
                                            $VARX[$i]=null;
                                            $VALX[$i]=null;
                                            $j++;
                                        }
                                    }
                                    else {
                                        if($VARX[$i]==$bufx[$x]) {
                                            $bufVal[$x]+=$VALX[$i];
                                            $VARX[$i]=null;
                                            $VALX[$i]=null;
                                            $j++;
                                        }
                                    }
                                }//fin for
                                $x++;
                                $bufx[$x]=null;
                            }//fin while

                            ///////////////////////////////////
                            ?>
</p>
<table width="408" border="1">
<tr class="abajoz">
                <td width="230" bgcolor="#0183bf"><font size="2">Remark</font></td>
                <td width="96" bgcolor="#0183bf"><font size="2">Time Lost</font></td>
                <td width="60" bgcolor="#0183bf"><font size="2">Percent</font></td>
            </tr>
                                <?php for($i=0; $i<$x; $i++) { ?>
            <tr class="normal">
                <td><?php echo $bufx[$i];?>&nbsp;</td>
                <td class="sdfgd">
                                            <?php if(restaHorasInt("23:59", mintoho($bufVal[$i]))<0) { echo formatoDias(mintoho($bufVal[$i]));}else { echo mintoho($bufVal[$i]); }?>
                    &nbsp;</td>
                <td class="sdfgd"><?php echo number_format(portot($bufVal[$i], (miliseg($timeused)+miliseg($timelost))), 3);?>%</td>
            </tr>
                                <?php } ?>
        </table>
		<p><font size="-2">Powered in association  by TWIN MARINE DE MEXICO, S.A. DE C.V.  and  DAKA Technology. &lt;&lt;Copyright © 2009-2010 All Rights Reserved&gt;&gt;</font></p>
	</body>

</html>