<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<?php
include("conexion.php");
$link = Conectar();
$id=$_GET["id"];

if(isset($_POST["guardar"]))	{
	$vessel=$_POST["vessel"];
	$port=$_POST["port"];
	$timetocount=$_POST["timetocount"];
	$completedischarging=$_POST["completedischarging"];
	$id=$_POST["id"];
	
	$query="update operacionesestadisticas set vessel='$vessel', port='$port', timetocount='$timetocount', completedischarging='$completedischarging' where id='".$_POST["id"]."'";
	mysql_query($query, $link);
	
}	else if(isset($_POST["add"]))	{
	$fecha=$_POST["fecha"];
	$hinicial=$_POST["hinicial"];
	$hfinal=$_POST["hfinal"];
	$clasif=$_POST["clasif"];
	$timepercent=$_POST["timepercent"];
	$id=$_POST["id"];
	
	$query="insert into tiemposestadisticas (id, fecha, hinicial, hfinal, clasif, timepercent) values ('$id', '$fecha', '$hinicial', '$hfinal', '$clasif', '$timepercent')";
	mysql_query($query, $link);
} else if(isset($_POST["update"]))	{
	$idtiemposestadisticas=$_POST["idtiemposestadisticas"];
	$hinicial=$_POST["hinicial"];
	$hfinal=$_POST["hfinal"];
	$timepercent=$_POST["timepercent"];
	$clasif=$_POST["clasif"];
	$id=$_POST["id"];
	$query="update tiemposestadisticas set hinicial='$hinicial', hfinal='$hfinal', timepercent='$timepercent', clasif='$clasif' where idtiemposestadisticas='$idtiemposestadisticas'";
	mysql_query($query, $link);
}	else if(isset($_POST["eliminar"]))	{
	$idtiemposestadisticas=$_POST["idtiemposestadisticas"];
	$query="delete from tiemposestadisticas where idtiemposestadisticas='$idtiemposestadisticas'";
	$id=$_POST["id"];
	mysql_query($query, $link);
}

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
function plus($datex) {
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
$table="operacionesestadisticas";
$fields="id, vessel, port, timetocount, completedischarging";

$query = "select ".$fields." from ".$table." where id='".$id."'";

$result = mysql_query($query, $link);

while($row = mysql_fetch_array($result)) {
    $vessel=$row["vessel"];
    $port=$row["port"];
    $timetocount=$row["timetocount"];
    $completedischarging=$row["completedischarging"];
}
//OBTENER EL TIEMPO DEL BARCO
//////////////////////////////////////////////////////////////////////////
$query="SELECT TIMEDIFF(completedischarging, timetocount) as diff from ".$table." where id='".$id."'";
$result = mysql_query($query, $link);

while($row = mysql_fetch_array($result)) {
    $totalTime=split(":", $row["diff"]);
    $TotalTime=$totalTime[0].":".$totalTime[1];
}

////////////////////////////////
//OBTENER LOS DATOS
$table="tiemposestadisticas";
$fields="id, fecha, hinicial, hfinal, clasif";

$query = "select ".$fields." from ".$table." where id='".$id."'";
////////////////////////////////////////

/////ANALIZA LA INFORMACION POR DIA////////////////////////////////////////////////////////////////////////////////
/////////////ESTADITICA FINALES

$query="select distinct fecha from tiemposestadisticas where id='$id' order by fecha";
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
    $query="select fecha, hinicial, hfinal, clasif, timepercent from tiemposestadisticas where id='$id' and fecha='".$fechax[$i]."' and fecha>='$timetocount1' order by hinicial";
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
        
            $remarks="STOP/IDLE TIME";
            $remarks4=$row["clasif"]; //
            $timepercentbuf=100-$timepercent;
            $tocount=restaHoras($hinicial, $hfinal);

            $toDiscount=porcentajeHoras2($tocount, $timepercent);
            $tocount=porcentajeHoras($tocount, $timepercentbuf);
            $timelost=sumaHoras($timelost, $toDiscount);
            $timeused=sumaHoras($timeused, $tocount);

            $VARX[$I]=$remarks4;
            $VALX[$I]=miliseg($toDiscount);
            $I++;
        
}////FIN DEL PROCESO DEL WHILE QUE ANALIZA LOS REGISTROS
}//FIN DEL IF QUE REPRESENTA LAS FECHAS
//
//////////////////////////////////////////////////////////////////////////

?>

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <meta name="generator" content="Adobe GoLive" />
        <title>FACTS STATISTICS REPORT</title>
        <style type="text/css">
	body{
		/*
		You can remove these four options 
		
		*/
		background-repeat:no-repeat;
		font-family: Trebuchet MS, Lucida Sans Unicode, Arial, sans-serif;
		margin:0px;
		

	}
	#ad{
		padding-top:220px;
		padding-left:10px;
	}
	    </style>
	<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
	<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
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
            .ttttt {
                font-size: 14px;
            }
            .dsfsdfsdf {
                text-align: center;
            }
.aaa {
	text-align: left;
}
.asdasdadasdas {
	text-align: left;
}
            -->
        </style>
    <script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
    <script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
    <link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
    <link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
<!--
.XXXXXXX {	color: #F00;
}
-->
    </style>
</head>

<body bgcolor="#ffffff">
        <table width="609" height="190" border="0" align="center">
            <tr>
                <td width="603"><table width="606" border="1" cellspacing="2" cellpadding="0">
                        <tr>
                            <td bgcolor="#0183bf"><div align="left">
                                    <table width="593" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td bgcolor="#0183bf"><div align="center"><font color="white" size="+1" face="Tahoma">FACTS STADISTICS REPORT</font></div></td>
                                        </tr>
                                    </table>
                                </div></td>
                        </tr>
                    </table>
                    <img src="logo.jpg" alt="" width="385" height="120" border="0" />
                    <p class="ttttt">Stadistics Report</span></p>
                    <form name="form1" id="form1" method="post" action="soloestadisticasfacts.php">
                    <table width="329" border="1" cellpadding="0" cellspacing="2" align="center">
                        
                        <tr>
                          <td align="left" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>ID:</strong></font></td>
                          <td><span id="sprytextfield1">
                            <label>
                              <input type="text" name="id" id="id" value="<?php echo $id; ?>" />
                            </label>
                          <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
                        </tr>
                        <tr>
                          <td align="left" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>VESSEL:</strong></font></td>
                          <td><span id="sprytextfield2">
                            <label>
                              <input type="text" name="vessel" id="vessel" value="<?php echo $vessel; ?>" />
                            </label>
                          <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
                        </tr>
                        <tr>
                          <td align="left" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>PORT:</strong></font></td>
                          <td><span id="sprytextfield3">
                            <label>
                              <input type="text" name="port" id="port" value="<?php echo $port; ?>"/>
                            </label>
                          <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
                        </tr>
                        <tr>
                            <td align="left" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>TIME TO COUNT:</strong></font></td>
                            <td><span id="sprytextfield4">
                            <label>
                              <input type="text" name="timetocount" id="timetocount" value="<?php echo strftime('%Y/%m/%d %H:%M',strtotime($timetocount)); ?>" />
                            </label>
                            <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
                        </tr>
                        <tr>
                            <td align="left" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>COMPLETE DISCHARGING:</strong></font></td>
                            <td><span id="sprytextfield5">
                            <label>
                              <input type="text" name="completedischarging" id="completedischarging" value="<?php echo strftime('%Y/%m/%d %H:%M',strtotime($completedischarging)); ?>" />
                            </label>
                            <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
                        </tr>
                    </table>
                      <label>
                        <input type="submit" name="guardar" id="guardar" value="Guardar"/>
                      </label>
                    </form>
                    </br>
                    <form  name="form2" id="form2" method="post" action="soloestadisticasfacts.php">
                  <table width="578" border="1">
                      <tr>
                        <td width="572" class="aaa"><span id="sprytextfield6">
                        <label>Fecha:
                          <input type="text" name="fecha" id="fecha" readonly="readonly" size="12" value="<?php echo $fecha; ?>"/>
                        </label>
                        <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span><input type="button" value="Cal" onclick="displayCalendar(document.forms[1].fecha,'yyyy/mm/dd',this)" /><span id="sprytextfield7">
                        <label>H. Inicial
                          <input type="text" name="hinicial" id="hinicial" size="5"/>
                        </label>
                        <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span><span id="sprytextfield8">
                        <label>H. Final
                          <input type="text" name="hfinal" id="hfinal" size="5"/>
                        </label>
                        <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
                      </tr>
                      <tr>
                        <td class="aaa"><span id="spryselect1">
                          <label>Clasificacion:
                            <select name="clasif" id="clasif">
                            <?php
							$query="select clasificacion from clasificacion order by clasificacion";
							$result = mysql_query($query, $link);

    						while($row = mysql_fetch_array($result)) {
							?>
                              <option value="<?php echo $row["clasificacion"];?>"><?php echo $row["clasificacion"];?></option>
                              <?php	}	?>
                            </select>
                          </label>
                          <span class="selectRequiredMsg">Seleccione un elemento.</span></span>  
                                                  
                          <label>
                            <span id="sprytextfield9">% to Discount
                            <input type="text" name="timepercent" id="timepercent" size="5"/>
                            <span class="textfieldRequiredMsg">Se necesita un valor.</span></span>
                            <input type="submit" name="add" id="add" value="Add" />
                          </label>
                          <input type="hidden" name="id" value="<?php echo $id;?>" /></td>
                      </tr>
                  </table>
                  </form>
                  </br>
                    <span class="XXXXXXX">PARA GENERAR TIEMPO EN PUERTO CAPTURE EL &quot;TIME TO COUNT&quot; Y EL &quot;COMPLETED DISCHARGE&quot;</span>
                  <table width="407" border="1" align="center">
                      <tr>
                            <td bgcolor="#0183bf" class="gdfgdgd"><font size="2">Total Time Vessel in Port</font></td>
                            <td class="sdfgd"><?php echo formatoDias($TotalTime); ?></td>
                        </tr>
                        <tr>
                            <td bgcolor="#0183bf" class="gdfgdgd"><font size="2">Lost Time Affected</font></td>
                            <td class="sdfgd"><?php
                            if(restaHorasInt("23:59", $timelost)<0) { echo formatoDias($timelost);}else { echo formatoDias($timelost); }?></td>
                        </tr>
                        <tr>
                            <td bgcolor="#0183bf" class="gdfgdgd"><font size="2">Total Lost Time Percent</font></td>
                            <td class="sdfgd"><?php
                                echo number_format(portot(miliseg($timelost), miliseg($TotalTime)), 2);
                                ?>
                                %</td>
                        </tr>
                        <tr>
                            <td bgcolor="#0183bf" class="gdfgdgd"><font size="2">Total Time Percent Used</font></td>
                            <td class="sdfgd"><?php
                                echo number_format(portot((miliseg($TotalTime)-miliseg($timelost)), miliseg($TotalTime)), 2);
                                ?>
                                %</td>
                        </tr>
                  </table>
                    <?php


                    ///////////////////////ESTADISTICAS
                    $i=0;
                    $j=0;
                    $x=0;
                    $fg=true;
                    $bufx[$x]=null;
                    $bufVal[$x]=null;
                    while($j<count($VARX)) {

                        for($i=0; $i<count($VARX); $i++) {
                            if($fg) {
                                if($VARX[$i]!=null and $VARX[$i]!="null") {
                                    $bufx[$x]=$VARX[$i];
                                    $bufVal[$x]=$VALX[$i];
                                    $VARX[$i]=null;
                                    $VALX[$i]=null;
                                    $fg=false;
                                }
                            }
                            else {
                                if($VARX[$i]==$bufx[$x] and $VARX[$i]!="null" and $VARX[$i]!=null) {
                                    $bufVal[$x]+=$VALX[$i];
                                    $VARX[$i]=null;
                                    $VALX[$i]=null;
                                }
                            }

                            if($i==(count($VARX)-1))
                                $x++;
                        }//fin for
                        $j++;
                        $fg=true;

                    }//fin while

                    ///////////////////////////////////
                    ?>
                    </p>
                    <table width="408" border="1" align="center">
                        <tr class="abajoz">
                            <td bgcolor="#0183bf"><font size="2">Remark</font></td>
                            <td bgcolor="#0183bf"><font size="2">Time Discounted</font></td>
                            <td bgcolor="#0183bf"><font size="2">Percent</font></td>
                        </tr>
                        <?php for($i=0; $i<count($bufx); $i++) { ?>
                        <tr class="normal">
                            <td><?php echo $bufx[$i];?>&nbsp;</td>
                            <td class="sdfgd"><?php if(restaHorasInt("23:59", mintoho($bufVal[$i]))<0) { echo formatoDias(mintoho($bufVal[$i]));}else { echo formatoDias(mintoho($bufVal[$i])); }?>
                                &nbsp;</td>
                            <td class="sdfgd"><?php echo number_format(portot($bufVal[$i], miliseg($TotalTime)), 2);?>%</td>
                        </tr>
                        <?php } ?>
                    </table>
                    <table width="641" border="1">
                      <tr class="abajoz">
                        <td width="50" bgcolor="#0183bf"><font size="2">Fecha</font></td>
                        <td width="44" bgcolor="#0183bf"><font size="2">H.Inicial</font></td>
                        <td width="61" bgcolor="#0183bf"><font size="2">H.Final</font></td>
                        <td width="292" bgcolor="#0183bf"><font size="2">Clasificación</font></td>
                        <td width="57" bgcolor="#0183bf"><font size="2">% to Discount</font></td>
                        <td width="62" bgcolor="#0183bf">&nbsp;</td>
                      </tr>
                      <?php
					  $query = "select * from tiemposestadisticas where id='".$id."'";
					  $result = mysql_query($query, $link);
					  $frm=3;
					  while($row = mysql_fetch_array($result)) {
					  ?>
                      <form id="form<?php echo $frm; ?>" method="post" action="soloestadisticasfacts.php#<?php echo $row["idtiemposestadisticas"]; ?>">
                      <tr class="normal">
                        <td height="52"><?php echo $row["fecha"]; ?></td>
                        <td class="sdfgd"><span id="sprytextfield10">
                          <label>
                            <input type="text" name="hinicial" id="hinicial" size="5" value="<?php echo $row["hinicial"]; ?>" />
                          </label>
                        <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
                        <td class="sdfgd"><span id="sprytextfield11">
                          <label>
                            <input type="text" name="hfinal" id="hfinal" size="5" value="<?php echo $row["hfinal"]; ?>" />
                          </label>
                        <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
                        <td class="sdfgd"><span id="sprytextfield13">
                          <label>
                            <input type="text" name="clasif" id="clasif" value="<?php echo $row["clasif"]; ?>" size="30" />
                          </label>
                        <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
                        <td class="sdfgd"><span id="sprytextfield12">
                          <label>
                            <input type="text" name="timepercent" id="timepercent" value="<?php echo $row["timepercent"]; ?>" size="5"/>
                          </label>
                        <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
                        <td class="sdfgd">
                        <a name="<?php echo $id; ?>" id="<?php echo $row["idtiemposestadisticas"]; ?>"></a>
                        <input type="hidden" name="idtiemposestadisticas" value="<?php echo $row["idtiemposestadisticas"]; ?>" />
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <label>
                          <input type="submit" name="eliminar" id="eliminar" value="eliminar" />
                        </label>
                        <label>
                          <input type="submit" name="update" id="update" value="guardar" />
                        </label></td>
                      </tr>                      
                      </form>
                      <?php
					  $frm++;
					  }
					  ?>
                    </table>
                    <p><a href="estadisticasfactsfinal.php?id=<?php echo $id; ?>" target="_blank">Consultar Estadisticas Finales</a></p>
                    <p><font size="-2">Powered in association  by TWIN MARINE DE MEXICO, S.A. DE C.V.  and  DAKA Technology. &lt;&lt;Copyright © 2009-2010 All Rights Reserved&gt;&gt;</font></p>
                    <p>&nbsp;</p></td>
            </tr>
        </table>
    <script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "custom", {pattern:"0000/00/00 00:00", hint:"yyyy/mm/dd hh:mm", validateOn:["change"]});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "custom", {hint:"yyyy/mm/dd hh:mm", pattern:"0000/00/00 00:00", validateOn:["change"]});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "date", {format:"yyyy/mm/dd"});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "custom", {pattern:"00:00", hint:"00:00"});
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "custom", {pattern:"00:00", hint:"00:00"});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9");
var sprytextfield10 = new Spry.Widget.ValidationTextField("sprytextfield10");
var sprytextfield11 = new Spry.Widget.ValidationTextField("sprytextfield11");
var sprytextfield12 = new Spry.Widget.ValidationTextField("sprytextfield12");
var sprytextfield13 = new Spry.Widget.ValidationTextField("sprytextfield13");
//-->
    </script>
    </body>

</html>