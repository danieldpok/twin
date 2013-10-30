<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<?php
include("conexion.php");
$id=$_GET["id"];
$link = Conectar();
/////agrega los datos si los hay
if(isset($_POST["add"]))	{
	
	$fecha=$_POST["fecha"];
	$hinicial=$_POST["hinicial"];
	$hfinal=$_POST["hfinal"];
	$fact=$_POST["fact"];
	$timepercent=$_POST["timepercent"];
	$remarks=$_POST["remarks"];
	$id=$_POST["id"];
	$tipo=$_POST["tipo"];
	$query="insert into computotiempox (id, fecha, hinicial, hfinal, tipo, fact, timepercent, remarks) values ('$id', '$fecha', '$hinicial', '$hfinal', '$tipo', '$fact', '$timepercent', '$remarks')";
	mysql_query($query, $link);	
} else if(isset($_POST["delete"]))	{
	//echo "delete";
	$query="delete from computotiempox where idcomputotiempox='".$_POST["idx"]."'";
	mysql_query($query, $link);
	$id=$_POST["id"];
}	else if(isset($_POST["save"]))	{
	
	$hinicial=$_POST["hinicial"];
	$hfinal=$_POST["hfinal"];
	$fact=$_POST["fact"];
	$timepercent=$_POST["timepercent"];
	$remarks=$_POST["remarks"];
	$query="update computotiempox set hinicial='$hinicial', hfinal='$hfinal', fact='$fact', timepercent='$timepercent', remarks='$remarks' where idcomputotiempox='".$_POST["idx"]."'";
	
	mysql_query($query, $link);
	$id=$_POST["id"];
}	else if(isset($_POST["guardar"]))	{
	$vessel=$_POST["vessel"];
	$port=$_POST["port"];
	$quantity=$_POST["quantity"];
	$charge=$_POST["charge"];
	$dischperday=$_POST["dischperday"];
	$terms=$_POST["terms"];
	$timeallowed=$_POST["timeallowed"];
	$nortendered=$_POST["nortendered"];
	$norpresented=$_POST["norpresented"];
	$noracepted=$_POST["noracepted"];
		
	$timetocount=$_POST["timetocount"];
	$startdischarging=$_POST["startdischarging"];
	$completedischarging=$_POST["completedischarging"];
	$recibidorform=$_POST["recibidorform"];
	
	
	
	$query="update operaciones set vessel='$vessel', puerto='$port', quantity='$quantity', cargotype='$charge', dischperday='$dischperday', terms='$terms', timeallowed='$timeallowed', nortendered='$nortendered', norpresented='$norpresented', noracepted='$noracepted', recibidorform='$recibidorform', timetocount='$timetocount', startdischarging='$startdischarging', completedescharging='$completedischarging' where id='".$_POST["id"]."'";
	//echo $query;
	
	mysql_query($query, $link);
	$id=$_POST["id"];
} else if(isset($_POST["tipo"]) and !isset($_POST["add"]))	{
	if($_POST["tipo"]=="ARRIVAL MANEUVERS")	{
		$table="regulararrival";
	}else if($_POST["tipo"]=="OPERATIONAL")	{
		$table="regularoperational";
	}else if($_POST["tipo"]=="STOP/IDLE TIME")	{
		$table="regularstop";
	}
}


//DATOS DEL REGISTRO
$table="operaciones";
$fields="vessel, cargotype, quantity, startdischarging, completedescharging, dischperday, timeallowed, timetocount, nortendered, norpresented, noracepted, timeallowed, puerto, terms, recibidorform, charge";

$query = "select ".$fields." from ".$table." where id='".$id."'";
//echo $query;
$link = Conectar();
$result = mysql_query($query, $link);

while($row = mysql_fetch_array($result)) {
    setlocale(LC_TIME , 'es_ES');
	$charge=$row["cargotype"];
    $vessel=$row["vessel"];
	$recibidorform=$row["recibidorform"];
    $quantity=$row["quantity"];
	$total=str_replace(",", "", $quantity);
	$port=$row["puerto"];
	$terms=$row["terms"];
    $startdischarging=strftime('%Y/%m/%d %H:%M',strtotime($row["startdischarging"]));
    $completedischarging=strftime('%Y/%m/%d %H:%M',strtotime($row["completedescharging"]));
    $start=date("H:i", strtotime($row["startdischarging"]));
    $complete=date("H:i", strtotime($row["completedescharging"]));
    $dischperday=$row["dischperday"];
    $timeallowed=$row["timeallowed"];
    $startTime=strftime('%H:%M',strtotime($row["timetocount"]));
    $timetocount1=strftime('%Y-%m-%d',strtotime($row["timetocount"]));
    $timetocount=strftime('%Y/%m/%d %H:%M',strtotime($row["timetocount"]));
    $nortendered=strftime('%Y/%m/%d %H:%M',strtotime($row["nortendered"]));
    $norpresented=strftime('%Y/%m/%d %H:%M',strtotime($row["norpresented"]));
    $noracepted=strftime('%Y/%m/%d %H:%M',strtotime($row["noracepted"]));
    $timeallowed=$row["timeallowed"];
    $stopDay=date('%d %m %Y', strtotime($row["completedescharging"]));
    $stopHr=date("H:i", strtotime($row["completedescharging"]));
	
	if($timeallowed=="1969/12/31 18:00")
		$timeallowed="";
	if($timetocount=="1969/12/31 18:00")
		$timetocount="";
	if($nortendered=="1969/12/31 18:00")
		$nortendered="";
	if($norpresented=="1969/12/31 18:00")
		$norpresented="";
	if($noracepted=="1969/12/31 18:00")
		$noracepted="";
	if($startdischarging=="1969/12/31 18:00")
		$startdischarging="";
	if($completedischarging=="1969/12/31 18:00")
		$completedischarging="";

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
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <meta name="generator" content="Bluefish 1.0.7"/>
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
#TabbedPanels1 .TabbedPanelsContentGroup .TabbedPanelsContent.TabbedPanelsContentVisible table tr td table tr td div table tr td div #form1 table tr td input {
	text-align: left;
}
            -->
        </style>
    <script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
    <link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
    </head>

<body bgcolor="#ffffff" >
<table width="966" border="1" cellspacing="2" cellpadding="0">
                
                <tr>
                  <td bgcolor="#eeede5"><table width="848" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><div align="center">
                      <form method="post" action="timecalcform.php" id="form1" name="form1">
                        <table width="788" border="1" cellspacing="1" cellpadding="0">
                          <tr>
                            <td width="473" bgcolor="#0183bf"><div align="center"> <font size="3" color="white" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong> GENERAL INFORMATION</strong></font></div></td>
                            <td width="306" bgcolor="#0183bf"><div align="center"> <font size="3" color="white" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong> TERMS AND CONDITIONS</strong></font></div></td>
                          </tr>
                          <tr>
                            <td height="105" bgcolor="#eeede5"><div align="center">                            
                            <input type="hidden" name="id" value="<?php echo $id; ?>" />
                              <table width="418" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                  <td bgcolor="#eeede5"><div align="left"> <font size="2" color="black" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>Vessel</strong></font></div></td>
                <td><span id="sprytextfield12">
                                    <label>
                                      <input name="vessel" type="text" id="vessel" value="<?php echo $vessel; ?>"  />
                                    </label>
</span></td>
                                </tr>
                                <tr>
                                  <td bgcolor="#eeede5"><div align="left"> <font size="2" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>Port</strong></font></div></td>
                <td><span id="sprytextfield13">
                                    <label>
                                      <input name="port" type="text" id="port" value="<?php echo $port; ?>"  />
                                    </label>
</span></td>
                                </tr>
                                <tr>
                                  <td bgcolor="#eeede5"><div align="left"><font size="2" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif">Cargo</font></div></td>
                <td><span id="sprytextfield14">
                                    <label>
                                      <input name="charge" type="text" id="charge" value="<?php echo $charge; ?>"  />
                                    </label>
</span></td>
                                </tr> 
                                <tr>
                                  <td bgcolor="#eeede5"><div align="left"><font size="2" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif">Quantity</font></div></td>
                <td><span id="sprytextfield15">
                                    <label>
                                      <input name="quantity" type="text" id="quantity" value="<?php echo $quantity; ?>"  />
                                    </label>
</span></td>
                                </tr>
                                <tr>
                                  <td bgcolor="#eeede5"><div align="left"><font size="2" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif">Time To Count</font></div></td>
                                  <td><span id="sprytextfield16">
                                  <label>
                                    <input name="timetocount" type="text" id="timetocount" value="<?php echo $timetocount; ?>"  />
									<br>
									yyyy/mm/dd hh:mm
                                  </label>
<span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
                                </tr>
                                <tr>
                                  <td bgcolor="#eeede5"><div align="left"><font size="2" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif">Start Discharging</font></div></td>
                                  <td><span id="sprytextfield17">
                                  <label>
                                    <input name="startdischarging" type="text" id="startdischarging" value="<?php echo $startdischarging; ?>"  />
									<br>
									yyyy/mm/dd hh:mm
                                  </label>
<span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
                                </tr>
                                <tr>
                                  <td bgcolor="#eeede5"><div align="left"><font size="2" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif">Completed Discharging</font></div></td>
                                  <td><span id="sprytextfield18">
                                  <label>
                                    <input name="completedischarging" type="text" id="completedischarging" value="<?php echo $completedischarging; ?>"  />
									<br>
									yyyy/mm/dd hh:mm
                                  </label>
<span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
                                </tr>                               
                              </table>
                              
                            </div></td>
                            <td bgcolor="#eeede5"><table width="418" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td bgcolor="#eeede5"><div align="left"> <font size="2" color="black" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>Rate</strong></font></div></td>
              <td><span id="sprytextfield19">
                                  <label>
                                    <input name="dischperday" type="text" id="dischperday" value="<?php echo $dischperday; ?>"  />
                                  </label>
</span></td>
                              </tr>
                              <tr>
                                <td bgcolor="#eeede5"><div align="left"><font size="2" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif">Terms</font></div></td>
              <td><span id="sprytextfield20">
                                  <label>
                                    <input name="terms" type="text" id="terms" value="<?php echo $terms; ?>"  />
                                  </label>
</span></td>
                              </tr>
                              <tr>
                                <td bgcolor="#eeede5"><div align="left"><font size="2" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif">Time Allowed</font></div></td>
        <td><span id="sprytextfield21">
                                  <label>
                                    <input name="timeallowed" type="text" id="timeallowed" value="<?php echo $timeallowed; ?>"  />
                                  </label>
</span>
                <label>calculate
                  <input type="button" name="calculate" id="calculate" value="Calculate" onclick="calcular();" />
                </label></td>
                              </tr>
                              <tr>
                                <td bgcolor="#eeede5"><div align="left"><font size="2" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif">Receiver</font></div></td>
              <td><span id="sprytextfield22">
                                  <label>
                                    <input name="recibidorform" type="text" id="recibidorform" value="<?php echo $recibidorform; ?>" />
                                  </label>
</span></td>
                              </tr>
                              <tr>
                                <td bgcolor="#eeede5"><div align="left"><font size="2" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif">Nor Tendered</font></div></td>
                                <td><span id="sprytextfield23">
                                <label>
                                  <input name="nortendered" type="text" id="nortendered" value="<?php echo $nortendered; ?>" />
								  <br>
								  yyyy/mm/dd hh:mm
                                </label>
<span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
                              </tr>
                              <tr>
                                <td bgcolor="#eeede5"><div align="left"><font size="2" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif">Nor Presented</font></div></td>
                                <td><span id="sprytextfield24">
                                <label>
                                  <input name="norpresented" type="text" id="norpresented" value="<?php echo $norpresented; ?>" />
								  <br>
								  yyyy/mm/dd hh:mm
                                </label>
<span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
                              </tr>
                              <tr>
                                <td bgcolor="#eeede5"><div align="left"><font size="2" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif">Nor Acepted</font></div></td>
                                <td><span id="sprytextfield25">
                                <label>
                                  <input name="noracepted" type="text" id="noracepted" value="<?php echo $noracepted; ?>" />
								  <br>
								  yyyy/mm/dd hh:mm
                                </label>
<span class="textfieldInvalidFormatMsg">Formato no válido. yyyy/mm/dd hh:mm</span></span></td>
                              </tr>
                            </table></td>
                          </tr>
                        </table>
                        <input type="submit" name="guardar" id="guardar" value="Guardar" /></form>
                      </div></td>
                      <td bgcolor="black"><div align="center">
                        <table width="170" border="1" cellspacing="0" cellpadding="0">
                          <tr>
                            <td bgcolor="#0183bf"><div align="center"> <font size="2" color="white" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>TIME ALLOWED</strong></font></div></td>
                          </tr>
                          <tr>
                            <td bgcolor="#eeede5"><div align="center"> <font color="white" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif">
                              <input type="text" name="textfieldName" value="<?php echo $timeallowed; ?>" size="17" />
                            </font></div></td>
                          </tr>
                          <tr>
                            <td bgcolor="#0183bf"><div align="center"> <strong><font size="2" color="white" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif">TIME USED</font></strong></div></td>
                          </tr>
                          <?php
                                        function formatoDias($arg) {
                                            $hora1=explode(":",$arg);
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
                            <td bgcolor="#eeede5"><div align="center"> <font color="white">
                              <input type="text" name="timeused" value="<?php echo formatoDias($timeused); ?>" size="17" />
                            </font></div></td>
                          </tr>
                          <tr>
                            <td bgcolor="#0183bf"><div align="center"></div></td>
                          </tr>
                          <tr>
                            <td bgcolor="#eeede5"><div align="center">
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
                                <br />
                                <input type="text" name="textfieldName2" value="<?php echo $diff; ?>" size="17" />
                              </p>
                            </div></td>
                          </tr>
                        </table>
                      </div></td>
                    </tr>
                  </table></td>
                </tr>                
</table> 
<form id="form2" method="post" action="timecalcform.php">
              <table width="964" border="0">
                <tr>
                  <td width="958"><span id="sprytextfield1">
                <label>Fecha
                  <input type="text" name="fecha" id="fecha" size="15" readonly="readonly" value="<?php echo $fecha; ?>"/>
                  <input type="button" value="Cal" onclick="displayCalendar(document.forms[1].fecha,'yyyy/mm/dd',this)">
                </label>
                <span class="textfieldRequiredMsg">Se necesita un valor.</span></span>
                <span id="sprytextfield2">
                <label>H. Inicial
                  <input type="text" name="hinicial" id="hinicial" size="10" />
                </label>
                <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span>
                <span id="sprytextfield3">
                <label>H. Final

                  <input type="text" name="hfinal" id="hfinal" size="10" />
                </label>
                <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span>
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <label>
                  <select name="tipo" id="tipo" onchange="change2()">
                    <option value="OPERATIONAL">OPERATIONAL</option>
                    <option value="STOP/IDLE TIME">STOP/IDLE TIME</option>
                  </select>
                </label></td>
                </tr>
                <tr>
                  <td><label>Remarks for Deduction:
                      <select name="remarksx" id="remarksx" style="width:250px" onchange="change()">
                        <?php
					$query = "select remark from remarks order by remark";
					$result = mysql_query($query, $link);
					while($row = mysql_fetch_array($result)) {
						echo "<option value=\"".$row["remark"]."\">".$row["remark"]."</option>";
					}
					?>
                      </select>
                  </label>
                  <input type="text" name="fact" id="fact" style="width:300px" />
                  </td>
                </tr>
                <tr>
                  <td><label> </label>
                    <span id="sprytextfield5">
                    <label>% to Discount:
                      <input type="text" name="timepercent" id="timepercent" size="10"/>
                    </label>
                    </span><span id="sprytextfield6">
                    <label>Remarks:
                      <input type="text" name="remarks" id="remarks" />
                    </label>
                    </span>
                    <label>
                      <input type="submit" name="add" id="button2" value="Add" />
                  </label></td>
                </tr>
              </table>
              </form>
<table width="1222" border="1" cellspacing="2" cellpadding="0" bordercolordark="#CCCCCC" bordercolorlight="#FFFFFF" bgcolor="#FFFFFF">
                <tr>
                  <td width="103" height="28" bgcolor="#0183bf"><font size="1.5" color="white" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>DATE</strong></font></td>
                  <td width="50" bgcolor="#0183bf"><font size="1.5" color="white" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>DAY</strong></font></td>
                  <td width="180" bgcolor="#0183bf"><font size="1.5" color="white" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>PERIOD</strong></font></td>
                  <td width="72" bgcolor="#0183bf"><font size="1.5" color="white" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>TO DISCOUNT</strong></font></td>
                  <td width="82" bgcolor="#0183bf"><font size="1.5" color="white" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>TO DISCOUNT</strong></font></td>
                  <td width="240" bgcolor="#0183bf"><font size="1.5" color="white" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>REMARKS FOR DEDUCTION</strong></font></td>
                  <td width="57" bgcolor="#0183bf"><font size="1.5" color="white" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>TO COUNT</strong></font></td>
                  <td width="106" bgcolor="#0183bf"><font size="1.5" color="white" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>TIME USED</strong></font></td>
                  <td width="78" bgcolor="#0183bf"><font size="1.5" color="white" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>DEM/DISPACH</strong></font></td>
                  <td width="144" bgcolor="#0183bf"><font size="1.5" color="white" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>REMARKS</strong></font></td>
                  <td width="62" bgcolor="#0183bf"><font size="1.5" color="white" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><strong>SEL</strong></font></td>
                </tr>
                <?php
            function restaHoras($horaFin, $horaIni) {
                $hora1=$horaIni;
                $hora2=$horaFin;
                $hora1=explode(":",$hora1);
                $hora2=explode(":",$hora2);

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
                $hora1=explode(":",$hora1);
                $hora2=explode(":",$hora2);
                $horas=(int)$hora1[0]-(int)$hora2[0];
                $minutos=(int)$hora1[1]-(int)$hora2[1];
                $minutos+=$horas*60;
                return $minutos;
            }
            function restaHorasIntStat($horaIni, $horaFin) {
                $hora1=$horaIni;
                $hora2=$horaFin;
                $hora1=explode(":",$hora1);
                $hora2=explode(":",$hora2);
                $horas1=(int)($hora1[0]*24)+$hora1[1];
                $horas=(int)$horas1-(int)$hora2[0];
                $minutos=(int)$hora1[2]-(int)$hora2[1];
                $minutos+=$horas*60;
                return $minutos;
            }
            function restaHorasdiff($horaIni, $horaFin) {
                $hora1=$horaIni;
                $hora2=$horaFin;
                $hora1=explode(":",$hora1);
                $hora2=explode(":",$hora2);
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
                $hora1=explode(":",$hora1);
                $hora2=explode(":",$hora2);
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
                $hora1=explode(":",$hora1);
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
                $hora1=explode(":",$hora1);
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
                $mins=explode(":", $var);
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
            /////ANALIZA LA INFORMACION POR DIA////////////////////////////////////////////////////////////////////////////////
            $first=true;////si es el primero
            for($i=0; $i<count($fechax); $i++) {
            /////ANALIZA LOS CONCEPTOS
                $query="select idcomputotiempox, fecha, hinicial, hfinal, timepercent, fact, tipo, remarks from computotiempox where id='$id' and fecha='".$fechax[$i]."' and fecha>='$timetocount1' order by fecha";
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
					$idx=$row["idcomputotiempox"];
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
                        $remarks4=$row["fact"];
                        $toDiscount="";
                    }

                                    ///////IMPRIME LA INFORMACION
                                    ?>
                <tr bgcolor="#FFFFFF">
                <form method="post" action="timecalcform.php#<?php echo $idx; ?>">
                  <td><font size="1" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><?php echo $fca; ?></font></td>
                  <td><font size="1" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><?php echo $day; ?></font></td>
                  <td><font size="1" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif">
                    <input type="text" name="hinicial" id="hinicial" size="5" value="<?php echo $hinicial; ?>"/>
                    <input name="hfinal" type="text" id="hfinal" value="<?php echo $hfinal; ?>" size="5" /></font></td>
                  <td><font size="1" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><?php echo $toDiscount; ?></font></td>
                  <td>
                      <input type="text" name="timepercent" id="timepercent" value="<?php echo $timepercent;?>" size="3"/>%</td>
                  <td><span id="sprytextfield10">
                    <label>
                      <input type="text" name="fact" id="fact" value="<?php echo $remarks4; ?>" size="40"/>
                    </label>
</span></font></td>
                  <td><font size="1" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><?php echo $tocount; ?></font></td>
                  <td><font size="1" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif">
                    <?php  echo formatoDias($timeused);?>
                  </font></td>
                  <td><font size="2" color="red" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"><b>
                    <?php
                                                    $vowels = array("D", "H", "M", " ");
                                                    $tallowed=str_replace($vowels, "", $timeallowed);
                                                    if(restaHorasIntStat($tallowed, $timeused)<0) {
														$timeusedDem=restaHorasdiff($tallowed, $timeused);
                                                        if(restaHorasInt("23:59", $timeusedDem)<0) { echo formatoDias($timeusedDem);}else { echo $timeusedDem; }
                                                    }
                                                    else {
                                                        echo "";
                                                    }
                                                    ?>
                  </b></font></td>
                  <td><span id="sprytextfield11">
                    <label>
                      <input type="text" name="remarks" id="remarks" value="<?php echo $remarks; ?>"/>
                    </label>
</span></font></td>
                  <td><font size="1" face="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif">
                  <a name="<?php echo $id; ?>" id="<?php echo $idx; ?>"></a>
                  <input type="hidden" name="idx" value="<?php echo $idx; ?>" />
                  <input type="hidden" name="id" value="<?php echo $id; ?>" />
                  <input type="submit" name="save" id="button" value="Guardar" /><input type="submit" name="delete" id="button" value="Eliminar" /></font></td>
                  </form>
                </tr>
                <?php

            
            }////FIN DEL PROCESO DEL WHILE QUE ANALIZA LOS REGISTROS
            }//FIN DEL IF QUE REPRESENTA LAS FECHAS
 ?>
              </table>
<p><a href="timecalc.php?id=<?php echo $id; ?>" target="_blank">Consultar Computo Final</a></p>
        <p><font size="-2">Powered in association  by TWIN MARINE DE MEXICO, S.A. DE C.V.  and  DAKA Technology. &lt;&lt;Copyright © 2009-2010 All Rights Reserved&gt;&gt;</font>        </p>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "custom", {pattern:"00:00", hint:"00:00"});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "custom", {pattern:"00:00", hint:"00:00"});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "custom", {pattern:"00:00"});
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "custom", {pattern:"00:00"});
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9", "none", {isRequired:false});
var sprytextfield10 = new Spry.Widget.ValidationTextField("sprytextfield10", "none", {isRequired:false});
var sprytextfield11 = new Spry.Widget.ValidationTextField("sprytextfield11", "none", {isRequired:false});
var sprytextfield12 = new Spry.Widget.ValidationTextField("sprytextfield12", "none", {isRequired:false});
var sprytextfield13 = new Spry.Widget.ValidationTextField("sprytextfield13", "none", {isRequired:false});
var sprytextfield14 = new Spry.Widget.ValidationTextField("sprytextfield14", "none", {isRequired:false});
var sprytextfield15 = new Spry.Widget.ValidationTextField("sprytextfield15", "none", {isRequired:false});
var sprytextfield16 = new Spry.Widget.ValidationTextField("sprytextfield16", "custom", {pattern:"0000/00/00 00:00", hint:"yyyy/mm/dd hh:mm", isRequired:false});
var sprytextfield17 = new Spry.Widget.ValidationTextField("sprytextfield17", "custom", {pattern:"0000/00/00 00:00", hint:"yyyy/mm/dd hh:mm", isRequired:false});
var sprytextfield18 = new Spry.Widget.ValidationTextField("sprytextfield18", "custom", {pattern:"0000/00/00 00:00", hint:"yyyy/mm/dd hh:mm", isRequired:false});
var sprytextfield19 = new Spry.Widget.ValidationTextField("sprytextfield19", "none", {isRequired:false});
var sprytextfield20 = new Spry.Widget.ValidationTextField("sprytextfield20", "none", {isRequired:false});
var sprytextfield21 = new Spry.Widget.ValidationTextField("sprytextfield21", "none", {isRequired:false});
var sprytextfield22 = new Spry.Widget.ValidationTextField("sprytextfield22", "none", {isRequired:false});
var sprytextfield23 = new Spry.Widget.ValidationTextField("sprytextfield23", "custom", {pattern:"0000/00/00 00:00", hint:"yyyy/mm/dd hh:mm", isRequired:false});
var sprytextfield24 = new Spry.Widget.ValidationTextField("sprytextfield24", "custom", {pattern:"0000/00/00 00:00", hint:"yyyy/mm/dd hh:mm", isRequired:false});
var sprytextfield25 = new Spry.Widget.ValidationTextField("sprytextfield25", "custom", {pattern:"0000/00/00 00:00", isRequired:false});
//-->
</script>
<SCRIPT>
  function change()	{
	  document.forms[1].fact.value=document.forms[1].remarksx.value;
	  document.forms[1].fact.focus();
  }
  
  function change2()	{
	  document.forms[1].remarks.value=document.forms[1].tipo.value;
	  document.forms[1].remarks.focus();
  }
  
  function calcular()	{

	var dxmin=parseFloat(form1.dischperday.value.replace(",",""))/1440;
	var tmin=parseFloat(form1.quantity.value.replace(",",""))/dxmin;

	var minTot = parseFloat(form1.quantity.value.replace(",","")) / (parseFloat(form1.dischperday.value.replace(",",""))/ 1440);

        var MIN = parseInt(minTot);
        var HORAS, DIAS, BUF;

        if (MIN % 60 != 0) {
            BUF = MIN;
            MIN = MIN % 60;
            HORAS = (BUF - MIN) / 60;
        } else {
            HORAS = MIN / 60;
            MIN = 0;
        }

        if (HORAS % 24 != 0) {
            BUF = HORAS;
            HORAS = HORAS % 24;
            DIAS = (BUF - HORAS) / 24;
        } else {
            DIAS = HORAS / 24;
            HORAS = 0;
        }

        var min = parseInt(MIN), dias = parseInt(DIAS), horas = parseInt(HORAS);

        var fVal;
        fVal = dias+"D:"+horas+"H:"+min+"M";

        

	//alert('fuck you');
	//alert(form1.quantity.value);
	//var allowed = (parseFloat(form1.quantity.value)/parseFloat(form1.dischperday.value))*1440;
	
	//alert(allowed);
	//var hours=allowed/60;//tiene que ser entero
	//var hours=tmin/60;
	//var minutes=allowed%60;//modulo
	//var minutes=tmin%60;
	//var days=hours/24; //tiene que ser entero
	//var days=hours/24;	
	//hours=hours%24;//modulo
	//allowed=parseInt(days)+"D:"+parseInt(hours)+"H:"+parseInt(minutes)+"M";

	form1.timeallowed.value=fVal;
  }
  </SCRIPT>
</body>

</html>
