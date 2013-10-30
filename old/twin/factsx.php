<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<?php
include("conexion.php");
$id=$_GET["id"];
//$id="11111";
//DATOS DEL REGISTRO

$link = Conectar();

$table="chargeinformation";
$fields="recibidor";

$query = "select distinct ".$fields." from ".$table." where id='".$id."'";

$result = mysql_query($query, $link);
$recibidores="";
while($row = mysql_fetch_array($result)) {
	$recibidores=$recibidores.", ".$row["recibidor"];
}
$table="operaciones";
$fields="vessel, flag, puertodecarga, quantity, cargotype, sofremarks, remarks, typex";

$query = "select ".$fields." from ".$table." where id='".$id."'";

$result = mysql_query($query, $link);

while($row = mysql_fetch_array($result)) {
    $vessel=$row["vessel"];
    $flag=$row["flag"];
    $puertodecarga=$row["puertodecarga"];
    $quantity=$row["quantity"];
	$total=$row["quantity"];
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

?>

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <meta name="generator" content="Adobe GoLive" />
        <title>Estado de Hechos</title>
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
.tb {
	font-size: 14px;
}
.letra {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 14px;
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
								<td><img src="logo.jpg" alt="" width="385" height="120" border="0" /></td>
								<td bgcolor="#0183bf">
									<div align="center">
										<table width="375" border="1">
										  <tr>
										    <td><font size="+3" color="white" face="Tahoma"><strong>STATEMENT OF FACTS</strong></font></td>
									      </tr>
									  </table>
									</div>
								</td>
							</tr>
						</table>
					</div>
				</td>
            </tr>
        </table>
        <table width="777" border="1" cellspacing="2" cellpadding="0">
            <tr>
                <td width="769" height="130" bgcolor="#eeede5">
                    <table width="597" border="0" cellspacing="2" cellpadding="0">
                        <tr class="letra">
                            <td class="letra">VESSEL:  <?php echo $vessel; ?></td>
                            <td class="letra">FLAG:  <?php echo $flag; ?></td>
                        </tr>
                    </table>
                <table width="764" border="1" cellspacing="2" cellpadding="0">
                      <tr>
                            <td width="756" height="100"><table width="756" border="0">
                              <tr>
                                <td width="395" height="52"><table width="368" border="0" cellspacing="2" cellpadding="0">
                                  <tr>
                                    <td width="92"><font size="2" face="Tahoma"><strong>LOADING PORT:</strong></font></td>
                                    <td width="270"><input name="textfieldName" type="text" value="<?php echo $puertodecarga; ?>" size="45" readonly="readonly" /></td>
                                  </tr>
                                  <tr>
                                    <td><font size="2" face="Tahoma"><strong>CARGO:</strong></font></td>
                                    <td><input name="textfieldName" type="text" value='<?php echo $quantity."  ".$cargaentransito; ?>' size="45" readonly="readonly" /></td>
                                  </tr>
                            </table></td>
                                    <td width="354"><table width="354" border="0" cellspacing="2" cellpadding="0">
                                      <tr>
                                        <td width="81"><font size="2" face="Tahoma"><strong>DISCH. PORT:</strong></font></td>
                                        <td width="267"><input name="textfieldName2" type="text" value="VERACRUZ, MEXICO." size="45" readonly="readonly" /></td>
                                      </tr>
                                      <tr>
                                        <td><font size="2" face="Tahoma"><strong>AGENCY:</strong></font></td>
                                        <td><input name="textfieldName2" type="text" value="TWIN MARINE DE MEXICO, S.A. DE C.V." size="45" readonly="readonly" /></td>
                                      </tr>
                                    </table></td>
                              </tr>
                              <tr>
                                <td colspan="2"><font size="2" face="Tahoma"><strong>
                                <?php if($type=="IMPORT") echo "RECEIVER(S):"; else echo "SHIPERS:";?><br/>
                                  <textarea name="textfieldName3" cols="100" rows="3" readonly="readonly" class="normal" ><?php echo $recibidores; ?></textarea>
                                </strong></font></td>
                              </tr>
                              
                          </table></td>
                        </tr>                        
                  </table>
                </td>
            </tr>
        </table>
        <table width="782" border="1" cellspacing="2" cellpadding="0">
      <tr>
                <td>
                    <table width="274" border="0" cellspacing="2" cellpadding="0">
                        <tr>
                            <td bgcolor="#0183bf">
                                <div align="center">
                                    <font size="2" color="white" face="Tahoma"><strong>DATE</strong></font></div>
                            </td>
                            <td bgcolor="#0183bf">
                                <div align="center">
                                    <font size="2" color="white" face="Tahoma"><strong>TIME</strong></font></div>
                            </td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width="493" border="0" cellspacing="2" cellpadding="0">
                        <tr>
                            <td bgcolor="#0183bf">
                                <div align="center">
                                    <font size="2" color="white" face="Tahoma"><strong>FACTS</strong></font></div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
		<table width="781" border="1" cellspacing="2" cellpadding="0">
            <tr>
                <td>
                    <table width="772" border="0" cellspacing="2" cellpadding="0">
                        <?php
                        ///////////////IMPRIME VALORES EN LA TABLA

                        $query = "select distinct fecha from computotiempo where id='".$id."' order by fecha";
                        //echo $queryA;
                        $result = mysql_query($query, $link);
                        $j=0;
                        while($row = mysql_fetch_array($result)) {
                            $fechax[$j]=$row["fecha"];
                            $j++;
                        }

                        for($i=0; $i<=count($fechax); $i++) {

                            $query = "select ".$fields." from ".$table." where id='".$id."' and fecha='".$fechax[$i]."' and tipo='PREARRIVO' order by hinicial";
                            $result = mysql_query($query, $link);
                            $buf=0;

                            /////PRE ARRIVO
                            $date2=false;
                            while($row = mysql_fetch_array($result)) {
                                setlocale(LC_TIME , 'es_ES');
                                if($buf==0) {
                                    $fecha=strftime('%B, %d /%Y',strtotime($row["fecha"]));
                                    $buf=1;
                                } else if($buf==1) {
                                        $fecha=strftime('%A		',strtotime($row["fecha"]));
                                        $buf=2;
                                    }
                                    else {
                                        $fecha="			";
                                    }

                                $hinicio=$row["hinicial"];
                                $hfinal=$row["hfinal"];
                                if($hinicio==$hfinal) {
                                    $hinicio="";
                                }
                                if($hfinal=="23:59") {
                                    $hfinal="24:00";
                                }
                                $computotiempo=$row["fact"];
                                ?>
                        <tr>
                            <td>
                                <table width="273" border="0" cellspacing="2" cellpadding="0">
                                    <tr>
                                        <td>
                                            <div align="left">
                                                <table width="134" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td><font size="2" face="Tahoma"><strong><?php echo $fecha; ?></strong></font></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </td>
                                        <td>
                                            <div align="center">
                                                <font size="2" face="Tahoma"><?php echo $hfinal;?></font></div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="483" border="0" cellspacing="2" cellpadding="0">
                                    <tr>
                                        <td>
                                            <div align="left">
                                                <font size="2" face="Tahoma"><?php echo $computotiempo; ?> </font><?php echo $bodega;?></div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                            <?php
                            }  ////////////FIN DEL WHILE

                            $query = "select ".$fields." from ".$table." where id='".$id."' and fecha='".$fechax[$i]."' and tipo='ARRIVAL MANEUVERS' order by hinicial";
                            $result = mysql_query($query, $link);
                            $buf=0;

                            /////ARRIVAL MANEUVERS
                            while($row = mysql_fetch_array($result)) {
                                setlocale(LC_TIME , 'es_ES');
                                if($buf==0) {
                                    $fecha=strftime('%B, %d /%Y',strtotime($row["fecha"]));
                                    $buf=1;
                                } else if($buf==1) {
                                        $fecha=strftime('%A		',strtotime($row["fecha"]));
                                        $buf=2;
                                    }
                                    else {
                                        $fecha="			";
                                    }

                                $hinicio=$row["hinicial"];
                                $hfinal=$row["hfinal"];
                                $computotiempo=$row["fact"];
                                if($hinicio==$hfinal) {
                                    $hinicio="";
                                }
                                if($hfinal=="23:59") {

                                    $hfinal="24:00";
                                }
                                ?>
                        <tr>
                            <td>
                                <table width="273" border="0" cellspacing="2" cellpadding="0">
                                    <tr>
                                        <td>
                                            <div align="left">
                                                <table width="134" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td><font size="2" face="Tahoma"><strong><?php echo $fecha; ?></strong></font></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </td>
                                        <td>
                                            <div align="center">
                                                <font size="2" face="Tahoma"><?php
echo $hfinal;
?></font></div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="483" border="0" cellspacing="2" cellpadding="0">
                                    <tr>
                                        <td>
                                            <div align="left">
                                                <font size="2" face="Tahoma"><?php echo $computotiempo; ?> </font><?php echo $bodega;?></div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                            <?php
                            }  ////////////FIN DEL WHILE

                            $query = "select ".$fields." from ".$table." where id='".$id."' and fecha='".$fechax[$i]."' and tipo='OPERATIONAL' order by hinicial";
                            $result = mysql_query($query, $link);

                            /////OPERATIONAL
                            while($row = mysql_fetch_array($result)) {
                                setlocale(LC_TIME , 'es_ES');
                                if($buf==0) {
                                    $fecha=strftime('%B, %d /%Y',strtotime($row["fecha"]));
                                    $buf=1;
                                    $date2=true;
                                } else if($buf==1) {
                                        $fecha=strftime('%A		',strtotime($row["fecha"]));
                                        $buf=2;
                                        $date2=false;
                                    }
                                    else {
                                        $fecha="			";
                                    }

                                $hinicio=$row["hinicial"];
                                $hfinal=$row["hfinal"];
                                $computotiempo=$row["fact"];
                                if($hfinal=="23:59") {
                                    $hfinal="24:00";
                                }
                                ?>
                        <tr>
                            <td>
                                <table width="273" border="0" cellspacing="2" cellpadding="0">
                                    <tr>
                                        <td>
                                            <div align="left">
                                                <table width="134" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td><font size="2" face="Tahoma"><strong><?php echo $fecha; ?></strong></font></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </td>
                                        <td>
                                            <div align="center">
                                                <font size="2" face="Tahoma"><?php 
												if($hinicio!=$hfinal)	{

echo $hinicio."	".$hfinal;
}	else { echo  $hfinal;}?></font></div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="483" border="0" cellspacing="2" cellpadding="0">
                                    <tr>
                                        <td>
                                            <div align="left">
                                                <font size="2" face="Tahoma"><?php echo $computotiempo; ?> </font><?php echo $bodega;?></div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                            <?php
                            }  ////////////FIN DEL WHILE

                            ///////////////// STOP/IDLE TIME
                            $query = "select ".$fields." from ".$table." where id='".$id."' and fecha='".$fechax[$i]."' and tipo='STOP/IDLE TIME' order by hinicial";
                            $result = mysql_query($query, $link);
                            $flag=true;
                            while($row = mysql_fetch_array($result)) {
                                if($flag) {
                                    if($date2) {
                                        $fecha2=strftime('%A		',strtotime($row["fecha"]));
                                        //$buf=2;
                                        $date2=false;
                                    }
                                    else {
                                        $fecha2="";
                                    }
                                    $flag=false;
                                    ?>
                        <tr>
                            <td>
                                <table width="273" border="0" cellspacing="2" cellpadding="0">
                                    <tr>
                                        <td>
                                            <div align="left">
                                                <table width="134" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td><font size="2" face="Tahoma"><strong><?php echo $fecha2; ?></strong></font></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </td>
                                        <td>
                                            <div align="center"></div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="483" border="0" cellspacing="2" cellpadding="0">
                                    <tr>
                                        <td bgcolor="#0183bf">
                                            <div align="left">
                                                <font size="2" color="white" face="Tahoma"><strong>STOP/IDLE TIMES:</strong></font></div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                                <?php
                                }

                                $hinicio=$row["hinicial"];
                                $hfinal=$row["hfinal"];
                                $computotiempo=$row["fact"];
                                if($hfinal=="23:59") {
                                    $hfinal="24:00";
                                }
                                ?>	<tr>
                            <td>
                                <table width="273" border="0" cellspacing="2" cellpadding="0">
                                    <tr>
                                        <td>
                                            <div align="left">
                                                <table width="134" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td></td>
                                                    </tr>
                                                </table>
                                            </div> 
                                        </td>
                                        <td>
                                            <div align="center"><font size="2" face="Tahoma">
                                              <?php
												if($hinicio!=$hfinal)	{

echo $hinicio."	".$hfinal;
}	else { echo  $hfinal;} ?>
                                            </font></div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="483" border="0" cellspacing="2" cellpadding="0">
                                    <tr>
                                        <td>
                                            <div align="left">
                                                <font size="2" face="Tahoma"><?php echo $computotiempo; ?> </font></div>
                                        </td>
                                    </tr>
                                </table>
                            </td>                           
                        </tr>
                                
                            <?php
                            }  ////////////FIN DEL WHILE

                            ?><?php
                        } ////////////FIN DEL WHILE
                        ?>
                        <tr>
                                  <td>&nbsp;</td>
                                  <td><table width="483" border="0" cellspacing="2" cellpadding="0">
                                    <tr>
                                      <td><div align="left"><font size="2" face="Tahoma">FINAL DRAFT SURVEY</font></div></td>
                                    </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td><table width="483" border="0" cellspacing="2" cellpadding="0">
                                    <tr>
                                      <td><div align="left"><font size="2" face="Tahoma">DOCUMENTS ON BOARD</font></div></td>
                                    </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td><table width="483" border="0" cellspacing="2" cellpadding="0">
                                    <tr>
                                      <td><div align="left"><font size="2" face="Tahoma">PILOT ON BOARD</font></div></td>
                                    </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td><table width="483" border="0" cellspacing="2" cellpadding="0">
                                    <tr>
                                      <td><div align="left"><font size="2" face="Tahoma">UNBERTHED FROM THE PIER</font></div></td>
                                    </tr>
                                  </table></td>
                                </tr>
                    </table>
                </td>
            </tr>
        </table>
		<hr />
		<table width="781" border="1" cellspacing="2" cellpadding="0">
		  <tr>
				<td>
					<div align="left">
						<font size="4" color="#0183bf" face="Tahoma">Preliminary figures on completion of operations.</font></div>
				</td>
			</tr>
			<tr>
				<td>
					<table width="770" border="1" cellspacing="2" cellpadding="0">
						<tr>
							<td width="149" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>RECEIVER</strong></font></td>
							<td width="58" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>B/L</strong></font></td>
							<td width="108" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>CARGO</strong></font></td>
							<td width="139" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>TONNAGE</strong></font></td>
							<td width="193" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>SHORE SCALE</strong></font></td>
							<td width="95" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>DIFF.</strong></font></td>
						</tr>
						<?php
                                                $query = "select recibidor, producto, cantidad from conciliacion where id='$id'";
                                                $j=0;
                                                $result = mysql_query($query, $link);
                                                while($row = mysql_fetch_array($result)) {
                                                     $recibidor[$j]=$row["recibidor"];
                                                     $producto[$j]=$row["producto"];
                                                     $cantidad[$j]=$row["cantidad"];
                                                        $j++;
                                                }
                                                for($i=0; $i<count($recibidor); $i++) {
                                                    $query = "select recibidor, producto, pesoneto, bl from chargeinformation where id='$id' and recibidor='$recibidor[$i]' and producto='$producto[$i]'";
                                                    $result = mysql_query($query, $link);
                                                    $bl="";
                                                    $pesoneto=0.000;
                                                    while($row = mysql_fetch_array($result)) {
                                                        $reciver = $row["recibidor"];
                                                        $bl=$bl.$row["bl"].", ";
                                                        $product=$row["producto"];
                                                        $pesoneto+=$row["pesoneto"];
                                                    }
                                                    ?>
						<tr>
							<td><font size="2" face="Tahoma"><?php echo $recibidor[$i]; ?></font></td>
							<td><font size="2" face="Tahoma"><?php echo $bl;?></font></td>
							<td><font size="2" face="Tahoma"><?php echo $producto[$i];?></font></td>
							<td><font size="2" face="Tahoma"><?php printf("%.3f", $pesoneto);?></font></td>
							<td><font size="2" face="Tahoma"><?php echo $cantidad[$i];?></font></td>
							<td><table width="92" border="0">
					        <tr>
							      <td width="59"><font size="2" face="Tahoma"><?php printf("%.3f", $cantidad[$i]-$pesoneto);?></font></td>
						        </tr>
					        </table></td>
						</tr>
						<?php
                                                }
						
						?>
					</table>
				</td>
			</tr>
		</table>
		
		<p>&nbsp;</p>
		<p>SHORE DRAFT SURVEY WEIGHT  _____________________</p>
<p class="asd"><pre class="asdX"><font face="Arial, Helvetica, sans-serif"><?php printf($sof); ?></font></pre></p>
<p class="asd">M.V. <?php echo $vessel; ?></p>
<p class="asd">&nbsp;</p>
<p class="asd">______________________________________________</p>
<p class="asd">MASTER</p>
<p class="asdX"><pre class="asdX"><font face="Arial, Helvetica, sans-serif"><?php printf($remarks); ?></font></pre></p>
<p class="asdX">&nbsp;</p>
<p>TWIN MARINE DE MEXICO S.A. DE C.V. AS SHIP AGENTS ONLY</p>
<br />
<br />
<br />
<br />
<p>_________________________________</p>
<table width="730" border="0" cellspacing="4">
<td width="377">
  <span class="tb">
  <?php
$table="chargeinformation";
$fields="recibidor, agencia";

$query = "select distinct ".$fields." from ".$table." where id='".$id."'";

$result = mysql_query($query, $link);
$x=0;
while($row = mysql_fetch_array($result)) {
	
    $recibidor=$row["recibidor"];
	$agencia=$row["agencia"];
	
?>


  <?php if($x==0)	{  ?>
  </span>
<tr>
    <td height="157"><p class="tb"><?php echo $agencia; ?><br /> ON BEHALF OF <?php echo $recibidor; ?></p>
<br />
<br />
<br />
<br />
<p class="tb">_________________________________
<br />AS CARGO RECEIVERS.
</p>
<p class="tb">&nbsp;</p></td><?php } else { } ?>
    <?php if($x==1)	{?><td width="346"><p class="tb"><?php echo $agencia; ?><br /> ON BEHALF OF <?php echo $recibidor; ?></p>
<br />
<br />
<br />
<br />
<p class="tb">_________________________________
<br />AS CARGO RECEIVERS.
</p>
<p class="tb">&nbsp;</p></td></tr><?php } else { } ?>

<?php
if($x==0)
	$x=1;
else
	$x=0;
}
?>  
</table>
<?php
$table="chargeinformation";
$fields="estivador";

$query = "select distinct ".$fields." from ".$table." where id='".$id."'";

$result = mysql_query($query, $link);

while($row = mysql_fetch_array($result)) {
    $recibidor=$row["estivador"];
?>
<?php echo $recibidor; ?> <br />
<br />
<br />
<br />
<p>_________________________________<br />AS STEVEDORING COMPANY</p>
<p></p>
<?php
}
?>
<p><font size="-2">Powered in association  by TWIN MARINE DE MEXICO, S.A. DE C.V.  and  DAKA Technology. &lt;&lt;Copyright © 2009-2010 All Rights Reserved&gt;&gt;</font></p>
	</body>

</html>