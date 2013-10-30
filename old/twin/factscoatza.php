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
$fields="vessel, flag, puertodecarga, quantity, cargotype, sofremarks, remarks, typex, puerto";

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
	$puerto=$row["puerto"];
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
.fact {
	font-weight: normal;
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 12px;
}
-->
    </style>
    </head>

<body bgcolor="#ffffff">
      <table width="831" border="1" cellspacing="2" cellpadding="0">
            <tr>
                <td bgcolor="#0183bf">
					<div align="left">
						<table width="768" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td><img src="logo.jpg" alt="" width="385" height="120" border="0" /></td>
								<td bgcolor="#0183bf">
									<div align="center">
										<table width="375" border="1" bgcolor="#FFFFFF">
										  <tr bgcolor="#0183bf">
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
        <table width="831" border="1" cellspacing="2" cellpadding="0">
            <tr>
                <td width="830" height="130" bgcolor="#eeede5">
                    <table width="790" border="0" cellspacing="2" cellpadding="0">
                        <tr class="letra">
                            <td width="457" class="letra">VESSEL:  <?php echo $vessel; ?></td>
                            <td width="327" class="letra">FLAG:  <?php echo $flag; ?></td>
                        </tr>
                    </table>
                <table width="817" border="1" cellspacing="2" cellpadding="0">
                      <tr>
                            <td width="809" height="100"><table width="815" border="0">
                              <tr>
                                <td width="401" height="52"><table width="420" border="0" cellspacing="2" cellpadding="0">
                                  <tr>
                                    <td width="144"><font size="2" face="Tahoma"><strong>LOADING PORT:</strong></font></td>
                                    <td width="270"><input name="textfieldName" type="text" value="<?php echo $puertodecarga; ?>" size="45" readonly="readonly" /></td>
                                  </tr>
                                  <tr>
                                    <td><font size="2" face="Tahoma"><strong>CARGO:</strong></font></td>
                                    <td><input name="textfieldName" type="text" value='<?php echo $quantity."  ".$cargaentransito; ?>' size="45" readonly="readonly" /></td>
                                  </tr>
                            </table></td>
                                    <td width="404"><table width="384" border="0" cellspacing="2" cellpadding="0">
                                      <tr>
                                        <td width="146"><font size="2" face="Tahoma"><strong>DISCH. PORT:</strong></font></td>
                                        <td width="249"><input name="textfieldName2" type="text" value="<?php echo $puerto; ?>, MEXICO." size="42" readonly="readonly" /></td>
                                      </tr>
                                      <tr>
                                        <td><font size="2" face="Tahoma"><strong>AGENCY:</strong></font></td>
                                        <td><input name="textfieldName2" type="text" value="TWIN MARINE DE MEXICO, S.A. DE C.V." size="42" readonly="readonly" /></td>
                                      </tr>
                                    </table></td>
                              </tr>
                              <tr>
                                <td height="78" colspan="2"><font size="2" face="Tahoma"><strong>
                                <?php if($type=="IMPORT") echo "RECEIVER(S):"; else echo "SHIPERS:";?>
                                </strong></font>
		<table width="803" border="1" cellspacing="2" cellpadding="0" bgcolor="#FFFFFF">
		  <tr>
				<td width="534" bgcolor="#FFFFFF"><font size="2" face="Tahoma"><strong>RECEIVER</strong></font></td>
				<td width="257" bgcolor="#FFFFFF"><font size="2" face="Tahoma">TOTAL CARGO</font></td>
				</tr>
			<?php
			
			//---REPORTE GENERAL DE DESCARGA POR RECIVIDOR ---- DAKA TECHNOLOGY---- PROP. INTELECTUAL DANIEL A. KENNEDY AYALA-----
			$totales=array(0,0,0);

						
			$query="select distinct recibidor from chargeinformation where id='".$id."'";
			$result = mysql_query($query, $link);
			$i=0;
			while($row = mysql_fetch_array($result)){
			$recibidor[$i]=$row["recibidor"];
			$i++;
			}
			
			for($j=0; $j<count($recibidor); $j++)	{
			
				
				/////////////OBTENER LAS CANTIDADES DESCARGADAS HASTA EL DIA INDICADO
				$query="select cantidad from descargarecibidor where id='".$id."' and recibidor='".$recibidor[$j]."'  and fecha<='$date1'";
				$result = mysql_query($query, $link);
				$cantidadTotal=0;
				while($row = mysql_fetch_array($result)){
				$cantidadTotal+=$row["cantidad"];
				}
				/////////////OBTENER LAS CANTIDADES DESCARGADAS HASTA EL DIA ANTERIOR AL INDICADO
				$query="select cantidad from descargarecibidor where id='".$id."' and recibidor='".$recibidor[$j]."'  and fecha<'$date1'";
				$result = mysql_query($query, $link);
				$cantidadAnterior=0;
				while($row = mysql_fetch_array($result)){
				$cantidadAnterior+=$row["cantidad"];
				}
				/////////////OBTENER LAS CANTIDADES DESCARGADAS DE EL DIA INDICADO
				$query="select cantidad from descargarecibidor where id='".$id."' and recibidor='".$recibidor[$j]."'  and fecha='$date1'";
				$result = mysql_query($query, $link);
				$cantidadDia=0;
				while($row = mysql_fetch_array($result)){
				$cantidadDia+=$row["cantidad"];
				}
				////////////////OBTENER EL TOTAL INICIAL
				$query="select pesoneto from chargeinformation where id='".$id."' and recibidor='".$recibidor[$j]."'";
				$pesototal=0;
				$result = mysql_query($query, $link);
				while($row = mysql_fetch_array($result)){
				$pesototal+=$row["pesoneto"];
				}
								
				$totales[0]+=$pesototal;
				$totales[1]+=$cantidadTotal;
				$totales[2]+=$pesototal-$cantidadTotal;
				$totales[3]+=$cantidadAnterior;
				$totales[4]+=$cantidadDia;
				
				?>
			<tr class="normal">
				<td bgcolor="#FFFFFF"><font size="2"face="Tahoma"><?php echo $recibidor[$j];?></font></td>
				<td bgcolor="#FFFFFF">
				  <div align="right">
				    <font size="2" face="Tahoma"><?php printf("%.3f", $pesototal);?></font></div>
				  </td>
				</tr>
			<?php
			
			}
			
			?>
</table></td>
                              </tr>
                              
                          </table></td>
                        </tr>                        
                  </table>
                </td>
            </tr>
        </table>
        <table width="831" border="1" cellspacing="2" cellpadding="0">
      <tr>
                <td width="326">
                    <table width="324" border="0" cellspacing="2" cellpadding="0">
                        <tr>
                            <td width="198" bgcolor="#0183bf">
                                <div align="center">
                                    <font size="2" color="white" face="Tahoma"><strong>DATE</strong></font></div>
                            </td>
                            <td width="120" bgcolor="#0183bf">
                                <div align="center">
                                    <font size="2" color="white" face="Tahoma"><strong>TIME</strong></font></div>
                            </td>
                        </tr>
                    </table>
                </td>
                <td width="493">
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
		<table width="831" border="1" cellspacing="2" cellpadding="0">
<tr>
                <td width="823">
                    <table width="822" border="0" cellspacing="0" cellpadding="0">
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
                                    $fecha=strftime('%b, %d /%Y %a',strtotime($row["fecha"]));
                                    $buf=1;
                                }else {
                                        $fecha="			";
                                    }

                                $hinicio=$row["hinicial"];
                                $hfinal=$row["hfinal"];
                                /*if($hinicio==$hfinal) {
                                    $hinicio="";
                                }
                                if($hfinal=="23:59") {
                                    $hfinal="24:00";
                                }*/
                                $computotiempo=$row["fact"];
                                ?>
                        <tr>
                            <td width="284">
                                <table width="327" border="0" cellspacing="2" cellpadding="0">
                                    <tr>
                                        <td width="200">
                                            <div align="left">
                                                <table width="198" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td width="198"><font size="2" face="Tahoma"><strong><?php echo $fecha; ?></strong></font></td>
                                                    </tr>
                                                </table>
                                            </div>                                        </td>
                                        <td width="121" align="right">
                                            <div align="right" class="fact">
                                                <?php 
												if($hinicio!=$hfinal)	{

echo $hinicio."	".$hfinal;
}	else { echo  $hfinal;}?></div>                                        </td>
                                    </tr>
                                </table>                            </td>
                            <td width="538" class="fact">
                                <table width="493" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td width="538">
                                            <div align="left">
                                                <font size="2" face="Tahoma, Geneva, sans-serif"><?php echo $computotiempo; ?> <?php echo $bodega;?></font></div>                                        </td>
                                    </tr>
                                </table>                            </td>
                        </tr>
                            <?php
                            }  ////////////FIN DEL WHILE

                            $query = "select ".$fields." from ".$table." where id='".$id."' and fecha='".$fechax[$i]."' and tipo='MANIOBRAS DE ARRIVO' order by hinicial";
                            $result = mysql_query($query, $link);
                            $buf=0;

                            /////MANIOBRAS DE ARRIVO
                            while($row = mysql_fetch_array($result)) {
                                setlocale(LC_TIME , 'es_ES');
                                if($buf==0) {
                                    $fecha=strftime('%b, %d /%Y %a',strtotime($row["fecha"]));
                                    $buf=1;
                                } else {
                                        $fecha="			";
                                    }

                                $hinicio=$row["hinicial"];
                                $hfinal=$row["hfinal"];
                                $computotiempo=$row["fact"];
                                /*if($hinicio==$hfinal) {
                                    $hinicio="";
                                }
                                if($hfinal=="23:59") {

                                    $hfinal="24:00";
                                }*/
                                ?>
                        <tr>
                            <td>
                                <table width="325" border="0" cellspacing="2" cellpadding="0">
                                    <tr>
                                        <td width="198">
                                            <div align="left">
                                                <table width="198" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td width="152"><font size="2" face="Tahoma"><strong><?php echo $fecha; ?></strong></font></td>
                                                    </tr>
                                                </table>
                                            </div>                                        </td>
                                        <td width="121" align="right">
                                            <div align="right" class="fact">
                                              <?php 
												if($hinicio!=$hfinal)	{

echo $hinicio."	".$hfinal;
}	else { echo  $hfinal;}?>
                                            </div>                                        </td>
                                    </tr>
                                </table>                          </td>
                            <td class="fact">
                                <table width="493" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td>
                                            <div align="left">
                                                <font size="2" face="Tahoma, Geneva, sans-serif"><?php echo $computotiempo; ?> <?php echo $bodega;?></font></div>                                        </td>
                                    </tr>
                                </table>                            </td>
                        </tr>
                            <?php
                            }  ////////////FIN DEL WHILE

                            $query = "select ".$fields." from ".$table." where id='".$id."' and fecha='".$fechax[$i]."' and tipo='OPERATIONAL' order by hinicial";
                            $result = mysql_query($query, $link);

                            /////OPERATIONAL
                            while($row = mysql_fetch_array($result)) {
                                setlocale(LC_TIME , 'es_ES');
                                if($buf==0) {
                                    $fecha=strftime('%b, %d /%Y %a',strtotime($row["fecha"]));
                                    $buf=1;
                                    $date2=false;
                                } 
                                    else {
                                        $fecha="			";
                                    }

                                $hinicio=$row["hinicial"];
                                $hfinal=$row["hfinal"];
                                $computotiempo=$row["fact"];
                                /*if($hfinal=="23:59") {
                                    $hfinal="24:00";
                                }*/
                                ?>
                        <tr>
                            <td>
                                <table width="323" border="0" cellspacing="2" cellpadding="0">
                                    <tr>
                                        <td width="198">
                                            <div align="left">
                                                <table width="198" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td width="154"><font size="2" face="Tahoma"><strong><?php echo $fecha; ?></strong></font></td>
                                                    </tr>
                                                </table>
                                            </div>                                        </td>
                                        <td width="119" align="right">
                                            <div align="right" class="fact">
                                                <?php 
												if($hinicio!=$hfinal)	{

echo $hinicio."	".$hfinal;
}	else { echo  $hfinal;}?></div>                                        </td>
                                    </tr>
                                </table>                            </td>
                            <td class="fact">
                                <table width="493" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td>
                                            <div align="left">
                                                <font size="2" face="Tahoma, Geneva, sans-serif"><?php echo $computotiempo; ?> <?php echo $bodega;?></font></div>                                        </td>
                                    </tr>
                                </table>                            </td>
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
                                <table width="268" border="0" cellspacing="2" cellpadding="0">
                                    <tr>
                                        <td width="265">
                                            <div align="left">
                                                <table width="201" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td width="201"><font size="2" face="Tahoma"><strong><?php echo $fecha2; ?></strong></font></td>
                                                    </tr>
                                                </table>
                                            </div>                                        </td>
                                        <td width="12">
                                            <div align="center"></div>                                        </td>
                                    </tr>
                                </table>                            </td>
                            <td>
                                <table width="493" border="0" cellspacing="2" cellpadding="0">
                                    <tr>
                                        <td bgcolor="#0183bf">
                                            <div align="left">
                                                <font size="2" color="white" face="Tahoma"><strong>STOP/IDLE TIMES:</strong></font></div>                                        </td>
                                    </tr>
                                </table>                            </td>
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
                                <table width="325" border="0" cellspacing="2" cellpadding="0">
                                    <tr>
                                        <td width="200">
                                            <div align="left">
                                                <table width="134" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td></td>
                                                    </tr>
                                                </table>
                                            </div>                                        </td>
                                        <td width="119" align="right">
                                            <div align="right" class="fact">
                                              <?php
												if($hinicio!=$hfinal)	{

echo $hinicio."	".$hfinal;
}	else { echo  $hfinal;} ?>
                                            </div>                                        </td>
                                    </tr>
                                </table>                            </td>
                            <td class="fact">
                                <table width="493" border="0" cellspacing="2" cellpadding="0">
                                    <tr>
                                        <td>
                                            <div align="left">
                                                <font size="2" face="Tahoma, Geneva, sans-serif"><?php echo $computotiempo; ?> </font></div>                                        </td>
                                    </tr>
                                </table>                            </td>                           
                        </tr>
                                                        
                            <?php
                            }  ////////////FIN DEL WHILE
							///////////REMARKS
							$query = "select remark from remarksday where id='".$id."' and fecha='".$fechax[$i]."'";
                            $result = mysql_query($query, $link);
                            while($row = mysql_fetch_array($result)) {								
                            ?>
							<tr>
                                  <td class="fact">Remarks</td>
                                  <td class="fact"><table width="493" border="0" cellspacing="2" cellpadding="0">
                                    <tr>
                                      <td><pre class="fact"><font face="Arial, Helvetica, sans-serif"><?php printf($row["remark"]); ?></font></pre></td>
                                    </tr>
                              </table></td>
                      		</tr>
							<?php
							}////////FIN WHILE REMARK
                        } ////////////FIN DEL FOR
                        ?>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td class="fact"><table width="493" border="0" cellspacing="2" cellpadding="0">
                                    <tr>
                                      <td><div align="left"><font size="2" face="Tahoma">DOCUMENTS ON BOARD</font></div></td>
                                    </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td class="fact"><table width="493" border="0" cellspacing="2" cellpadding="0">
                                    <tr>
                                      <td><div align="left"><font size="2" face="Tahoma" class="fact">PILOT ON BOARD</font></div></td>
                                    </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td class="fact"><table width="493" border="0" cellspacing="2" cellpadding="0">
                                    <tr>
                                      <td><div align="left"><font size="2" face="Tahoma, Geneva, sans-serif">UNBERTHED FROM THE PIER</font></div></td>
                                    </tr>
                                  </table></td>
                                </tr>
                    </table>
                </td>
            </tr>
        </table>
		<hr />
<table width="831" border="1" >
          <tr>
            <td width="818"><p class="tb">SHORE DRAFT SURVEY WEIGHT  _____________________</p>
              <p class="tb">SHIPS SURVEYOR WEIGHT _____________________ </p>
              <p class="tb">TOTAL SHORTAGE  OF THE SHIPMENT __________________M.T.</p>
              <p class="tb">&nbsp;</p>
              <pre class="tb"><font face="Arial, Helvetica, sans-serif"><?php printf($sof); ?></font></pre>
              </p>
              <p class="tb" align="center">M.V. <?php echo $vessel; ?></p>
              <p class="tb">&nbsp;</p>
              <p class="tb" align="center">______________________________________________</p>
              <p class="tb" align="center">MASTER</p>
              <p class="tb">&nbsp;</p>
              <pre class="tb"><font face="Arial, Helvetica, sans-serif"><?php printf($remarks); ?></font></pre>
              </p>
              <p class="tb">&nbsp;</p>
              <p class="tb">TWIN MARINE DE MEXICO S.A. DE C.V. </p>
              <br />
              <br />
              <br />
              <br />
              <p class="tb">_________________________________</p>
              <p class="tb">AS SHIP AGENTS ONLY</p>
              <table width="730" border="0" cellspacing="4">
                <tr>
                  <td><span class="tb">
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
                  </span></td>
                </tr>
                <tr>
                  <td height="157"><p class="tb"><?php echo $agencia; ?><br />
                    ON BEHALF OF <?php echo $recibidor; ?></p>
                    <br />
                    <br />
                    <br />
                    <br />
                    <p class="tb">_________________________________ <br />
                      AS CARGO RECEIVERS. </p>
                    <p class="tb">&nbsp;</p></td>
                  <?php } else { } ?>
                  <?php if($x==1)	{?>
                  <td><p class="tb"><?php echo $agencia; ?><br />
                    ON BEHALF OF <?php echo $recibidor; ?></p>
                    <br />
                    <br />
                    <br />
                    <br />
                    <p class="tb">_________________________________ <br />
                      AS CARGO RECEIVERS. </p>
                    <p class="tb">&nbsp;</p></td>
                </tr>
                <?php } else { } ?>
                <?php
if($x==0)
	$x=1;
else
	$x=0;
}
?>
              </table>
              <?php
			  if($puerto=="VERACRUZ")	{
$table="chargeinformation";
$fields="estivador";

$query = "select distinct estivador from ".$table." where id='".$id."'";

$result = mysql_query($query, $link);

while($row = mysql_fetch_array($result)) {
    $recibidor=$row["estivador"];
?>
              <p class="tb"><?php echo $recibidor; ?> <br /></p>
              <br />
              <br />
              <br />
              <p class="tb">_________________________________<br />
                AS STEVEDORING COMPANY</p>
              </p>
            <?php
}
			  }
?></td>
          </tr>
</table>
<font size="-2">Powered in association  by TWIN MARINE DE MEXICO, S.A. DE C.V.  and  DAKA Technology. &lt;&lt;Copyright © 2009-2010 All Rights Reserved&gt;&gt;</font>
	</body>

</html>