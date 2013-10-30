<?php
header('Content-Type: text/html; charset=iso-8859-1');
include("conexion.php");
function toHora($hora) {
        $hora=split(":",$hora);
        $hora=(int)$hora[0];
        return $hora;
    }

$id=$_GET["id"];
$puerto=$_GET["puerto"];
$item=$_GET["item"];
$usd=$_GET["usd"];

$link = Conectar();
if($item!=0 and $item!=null and $item!="") {
	if($usd==0)	{
	  $query="delete from caratulapda where id='$id' and puerto='$puerto'";
	  mysql_query($query, $link);
	  for($i=1; $i<$item; $i++) {
		  $val=str_replace( ",", "", $_GET[$i."importe"]);
		  $val=str_replace( "$", "", $val);
		  $query="insert into caratulapda (id, puerto, referencia, importe) values ("
			  ."'".$id."', '".$puerto."', '".$_GET[$i."referencia"]."', '".$val."')";
		  mysql_query($query, $link);
	  }
	}
	else	{
	  $query="delete from caratulapda where id='$id' and puerto='$puerto'";
	  mysql_query($query, $link);
	  for($i=1; $i<$item; $i++) {
		  $val=str_replace( ",", "", $_GET[$i."importe"]);
		  $val=str_replace( "$", "", $val);
		  $val=$val*$usd;
		  $query="insert into caratulapda (id, puerto, referencia, importe) values ("
			  ."'".$id."', '".$puerto."', '".$_GET[$i."referencia"]."', '".$val."')";
		  mysql_query($query, $link);
	  }
	}
}
else {
    $queryx="select * from proformas where id='$id'";
    $resultx = mysql_query($queryx, $link);
    while($rowx = mysql_fetch_array($resultx)) {
        $puerto=$rowx["puerto"];
        $grt=$rowx["grt"];
        $vessel=$rowx["vessel"];
        $loa=$rowx["loa"];
        $cargo=$rowx["cargo"];
        $pier=$rowx["pier"];
        $tc=$rowx["tc"];
        $d=$rowx["d"];
        $h=$rowx["h"];
		$to=$rowx["tox"];
		$attn=$row["attn"];
    }

    $time=($d*24)+$h;

    

    $query="delete from tarifasprof where id='$id' and puerto='$puerto'";
    mysql_query($query, $link);

    $queryTarifa="select * from tarifas where puerto='$puerto' order by clasificacion";
    $resultTarifa = mysql_query($queryTarifa, $link);
    while($rowTarifa = mysql_fetch_array($resultTarifa)) {
        $tarifa=0;
        $concepto=$rowTarifa["concepto"];
        $clasificacion=$rowTarifa["clasificacion"];
        $referencia=$rowTarifa["referencia"];
        if($rowTarifa["tarifafija"]=="1") {
            $tarifa=$rowTarifa["tarifa"];
			if($rowTarifa["iva"]=="1") {
            $tarifa=$tarifa*1.16;
			}
			
			if($rowTarifa["usd"]=="1") {
            $tarifa=$tarifa*$tc;
			}
        }
        else {
            if($rowTarifa["factor"]!=null or $rowTarifa["factor"]!="") {
            ////////////FACTOR
			$A=1;
			$B=1;
			$C=1;
			$D=1;
			if($rowTarifa["factortiempo"]!="0") {
                    $A=$time;
                }
            if($rowTarifa["factorgrt"]!="0") {
                        $B=$grt;
                    }
            if($rowTarifa["factorloa"]!="0") {
                            $C=$loa;
                        }
            if($rowTarifa["factordia"]!="0") {
                                $D=($time/24);
                            }
							
							$tarifa=$A*$B*$C*$D*$rowTarifa["factor"];

                /*if($rowTarifa["factortiempo"]!="0") {
                    $tarifa=$time*$rowTarifa["factor"];
                }
                else if($rowTarifa["factorgrt"]!="0") {
                        $tarifa=$grt*$rowTarifa["factor"];
                    }
                    else if($rowTarifa["factorloa"]!="0") {
                            $tarifa=$loa*$rowTarifa["factor"];
                        }
                        else if($rowTarifa["factordia"]!="0") {
                                $tarifa=($time/24)*$rowTarifa["factor"];
                            }*/

                if($rowTarifa["porcentaje"]!="" or $rowTarifa["porcentaje"]!=null) {
                    $tarifa=$tarifa+(($tarifa*$rowTarifa["porcentaje"])/100);
                }

                if($rowTarifa["valorporcentaje"]!="" or $rowTarifa["valorporcentaje"]!=null) {
                    $tarifa=(($tarifa*$rowTarifa["valorporcentaje"])/100);
                }
            }
            else {
                $tarifa=0;
            }
            ////////////CRITERIOS//////////////////////////////////////////////////////////////////////////////////////
            if($rowTarifa["tarxtar"]!="0") {
                $queryCriterio="select * from criterios where concepto='$concepto'";
                $resultCriterio = mysql_query($queryCriterio, $link);
                while($rowCriterio = mysql_fetch_array($resultCriterio)) {
                    if($rowCriterio["de"]<=$grt and $rowCriterio["a"]>=$grt) {
                            $tarifa=$rowCriterio["tarifa"]*$rowCriterio["tarifa2"];
                    }
                    else if($rowCriterio["de"]<=$grt and ($rowCriterio["a"]=="" or $rowCriterio["a"]==null) ) {
                            $tarifa=$rowCriterio["tarifa"]*$rowCriterio["tarifa2"];
                        }
                }
            }
			/////////
			if($rowTarifa["criteriotiempo"]!="0") {
                $queryCriterio="select * from criterios where concepto='$concepto'";
                $resultCriterio = mysql_query($queryCriterio, $link);
                while($rowCriterio = mysql_fetch_array($resultCriterio)) {
                    if(toHora($rowCriterio["de"])<=$time and toHora($rowCriterio["a"])>=$time) {
                        if($rowTarifa["factortarifa"]!="0")
                            $tarifa=$time*$rowCriterio["tarifa"];
                        else
                            $tarifa=$rowCriterio["tarifa"];
                        if($rowCriterio["tarifa2"]!="" or $rowCriterio["tarifa2"]!=null) {
                            if($rowTarifa["factortarifa"]!="0")
                                $tarifa+=$time*$rowCriterio["tarifa2"];
                            else
                                $tarifa+=$rowCriterio["tarifa2"];
                        }
                    }
                    else if(toHora($rowCriterio["de"])<=$time and ($rowCriterio["a"]=="" or $rowCriterio["a"]==null) ) {
                            if($rowTarifa["factortarifa"]!="0")
                                $tarifa=$time*$rowCriterio["tarifa"];
                            else
                                $tarifa=$rowCriterio["tarifa"];
                            if($rowCriterio["tarifa2"]!="" or $rowCriterio["tarifa2"]!=null) {
                                if($rowTarifa["factortarifa"]!="0")
                                    $tarifa+=$time*$rowCriterio["tarifa2"];
                                else
                                    $tarifa+=$rowCriterio["tarifa2"];
                            }
                        }
                }
            }
            else if($rowTarifa["criterioloa"]!="0") {
                    $queryCriterio="select * from criterios where concepto='$concepto'";
                    $resultCriterio = mysql_query($queryCriterio, $link);
                    while($rowCriterio = mysql_fetch_array($resultCriterio)) {
                        if($rowCriterio["de"]<=$loa and $rowCriterio["a"]>=$loa) {
                            if($rowTarifa["factortarifa"]!="0")
                                $tarifa=$loa*$rowCriterio["tarifa"];
                            else
                                $tarifa=$rowCriterio["tarifa"];
                            if($rowCriterio["tarifa2"]!="" or $rowCriterio["tarifa2"]!=null) {
                                if($rowTarifa["factortarifa"]!="0")
                                    $tarifa+=$loa*$rowCriterio["tarifa2"];
                                else
                                    $tarifa+=$rowCriterio["tarifa2"];
                            }
                        }
                        else if($rowCriterio["de"]<=$loa and ($rowCriterio["a"]=="" or $rowCriterio["a"]==null) ) {
                                if($rowTarifa["factortarifa"]!="0")
                                    $tarifa=$loa*$rowCriterio["tarifa"];
                                else
                                    $tarifa=$rowCriterio["tarifa"];
                                if($rowCriterio["tarifa2"]!="" or $rowCriterio["tarifa2"]!=null) {
                                    if($rowTarifa["factortarifa"]!="0")
                                        $tarifa+=$loa*$rowCriterio["tarifa2"];
                                    else
                                        $tarifa+=$rowCriterio["tarifa2"];
                                }
                            }
                    }
                }
                else if($rowTarifa["criteriogrt"]!="0") {
                        $queryCriterio="select * from criterios where concepto='$concepto'";
                        $resultCriterio = mysql_query($queryCriterio, $link);
                        while($rowCriterio = mysql_fetch_array($resultCriterio)) {
                            if($rowCriterio["de"]<=$grt and $rowCriterio["a"]>=$grt) {
                                if($rowTarifa["factortarifa"]!="0")
                                    $tarifa=$grt*$rowCriterio["tarifa"];
                                else
                                    $tarifa=$rowCriterio["tarifa"];
                                if($rowCriterio["tarifa2"]!="" or $rowCriterio["tarifa2"]!=null) {
                                    if($rowTarifa["factortarifa"]!="0")
                                        $tarifa+=$grt*$rowCriterio["tarifa2"];
                                    else
                                        $tarifa+=$rowCriterio["tarifa2"];
                                }
                            }
                            else if($rowCriterio["de"]<=$grt and ($rowCriterio["a"]=="" or $rowCriterio["a"]==null) ) {
                                    if($rowTarifa["factortarifa"]!="0")
                                        $tarifa=$grt*$rowCriterio["tarifa"];
                                    else
                                        $tarifa=$rowCriterio["tarifa"];
                                    if($rowCriterio["tarifa2"]!="" or $rowCriterio["tarifa2"]!=null) {
                                        if($rowTarifa["factortarifa"]!="0")
                                            $tarifa+=$grt*$rowCriterio["tarifa2"];
                                        else
                                            $tarifa+=$rowCriterio["tarifa2"];
                                    }
                                }
                        }
                    }
            if($rowTarifa["factortarifa"]!="0") {
            ////////////FACTOR
                if($rowTarifa["factortiempo"]!="0") {
                    $tarifa=$time*$tarifa;
                }
                else if($rowTarifa["factorgrt"]!="0") {
                        $tarifa=$grt*$tarifa;
                    }
                    else if($rowTarifa["factorloa"]!="0") {
                            $tarifa=$loa*$tarifa;
                        }
                        else if($rowTarifa["factordia"]!="0") {
                                $tarifa=($time/24)*$tarifa;
                            }

            }
			if($rowTarifa["iva"]=="1") {
            $tarifa=$tarifa*1.16;
			}
			
			if($rowTarifa["usd"]=="1") {
            $tarifa=$tarifa*$tc;
			}
        }
        $query="insert into tarifasprof (id, puerto, cantidad, concepto, referencia, pu) values ("
            ."'".$_GET["id"]."', '".$_GET["puerto"]."', '".$rowTarifa["cantidad"]."', '".$rowTarifa["concepto"]."', '".$rowTarifa["referencia"]."', '".$tarifa."')";
        mysql_query($query, $link);
    }

 $query="delete from caratulapda where id='$id' and puerto='$puerto'";
    mysql_query($query, $link);

    $queryx="select referencia from referencias order by orden";
	
    $resultx = mysql_query($queryx, $link);
    while($rowx = mysql_fetch_array($resultx)) {
        
        $query="select referencia, cantidad, pu from tarifasprof where id='$id' and puerto='$puerto' and referencia='".$rowx["referencia"]."'";
        $result = mysql_query($query, $link);
        $importe=0;
        while($row = mysql_fetch_array($result)) {
            $ref=$row["referencia"];
            $val1=str_replace( ",", "", $row["pu"]);
            $val1=str_replace( "$", "", $val1);
            $value=$row["cantidad"]*$val1;
            $importe+=$value;
        }

        $query="insert into caratulapda (id, puerto, referencia, importe) values ("
            ."'".$id."', '".$puerto."', '".$rowx["referencia"]."', '".$importe."')";
        mysql_query($query, $link);
    }
}
?>
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    <!--
    .normal {
        font-family: Tahoma, Geneva, sans-serif;
        font-size: 10pt;
        font-weight: bold;
    }
    .clasificacion {
        font-family: Tahoma, Geneva, sans-serif;
        font-size: 9pt;
        font-weight: bold;
    }
    .tarifa {
        font-family: Tahoma, Geneva, sans-serif;
        font-size: 9pt;
        font-weight: normal;
    }
    .normalA {
        font-family: Tahoma, Geneva, sans-serif;
        font-size: 10pt;
        font-weight: normal;
    }
.normalTit {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 10pt;
	font-weight: bold;
	color: #FFF;
}
    -->
</style>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<div id="TabbedPanels1" class="TabbedPanels">
    <ul class="TabbedPanelsTabGroup">
      <li class="TabbedPanelsTab" tabindex="0">Caratula Preeliminar PDA</li>
      <li class="TabbedPanelsTab" tabindex="0">Caratula Preeliminar PDA USD</li>
    <li class="TabbedPanelsTab" tabindex="0">Caratula PDA USD</li>
        <li class="TabbedPanelsTab" tabindex="0">Caratula PDA USD Bancos<br />
        </li>
      <li class="TabbedPanelsTab" tabindex="0">Caratula PDA Bancos</li>
        <li class="TabbedPanelsTab" tabindex="0">Detalle<br />
        </li>
    </ul>
    <div class="TabbedPanelsContentGroup">
      <div class="TabbedPanelsContent">
        <form id="form1" name="form1" method="get" action="caratulapdafastandfourios.php">
          <table width="643" border="1" cellspacing="0" bgcolor="#FFFFFF" bordercolor="#CCCCCC">
            <tr>
              <td width="637" height="90" align="left" class="normal" ><table width="646" border="1" cellspacing="0">
                <tr>
                  <td width="264"><font color="#FFFFFF"><img src="logox.jpg" width="264" height="83" /></font></td>
                  <td width="372" align="center"><font color="#FFFFFF"><img src="top.jpg" width="285" height="83" /></font></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td>
              <?php
                            $queryx="select * from proformas where id='$id'";
                            $resultx = mysql_query($queryx, $link);
                            while($rowx = mysql_fetch_array($resultx)) {
                                $puerto=$rowx["puerto"];
                                $grt=$rowx["grt"];
                                $vessel=$rowx["vessel"];
                                $loa=$rowx["loa"];
                                $cargo=$rowx["cargo"];
                                $pier=$rowx["pier"];
                                $stay=$rowx["stay"];
                                $daily=$rowx["daily"];
                                $tox=$rowx["tox"];
                                $attn=$rowx["attn"];
								$d=$rowx["d"];
        						$h=$rowx["h"];
							    $time=($d*24)+$h;
                            }
                            ?>
              <table width="641" border="0" cellspacing="0">
                <tr>
                  <td width="55" bgcolor="#CCCCCC" class="normal">TO:</td>
                  <td width="237" class="normal"><?php echo $tox; ?></td>
                  <td width="61" bgcolor="#CCCCCC" class="normal">ATTN:</td>
                  <td width="280" class="normal"><?php echo $attn; ?></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td class="normalA">PLEASED TO SUBMIT THE FOLLOWING PDA TO COVER THE PRESENT CALL OF THE VESSEL AS FOLLOW </td>
            </tr>
            <tr>
              <td class="normal" bgcolor="#CCCCCC" align="center">GENERAL PROFORMA OF PORT EXPENSES:</td>
            </tr>
            <tr>
              <td>
                <table width="640" border="1" cellspacing="0" class="normalA" bordercolor="#CCCCCC">
                  <tr>
                    <td width="111">PORT:</td>
                    <td width="199" align="right"><?php echo $puerto; ?></td>
                    <td width="128">GRT:</td>
                    <td width="184" align="right"><?php echo $grt; ?></td>
                  </tr>
                  <tr>
                    <td>VESSEL:</td>
                    <td align="right"><?php echo $vessel; ?></td>
                    <td>LOA:</td>
                    <td align="right"><?php echo $loa; ?></td>
                  </tr>
                  <tr>
                    <td>CARGO:</td>
                    <td align="right"><?php echo number_format($cargo, 3, ".", ",")." MT"; ?></td>
                    <td>PIER:</td>
                    <td align="right"><?php echo $pier; ?></td>
                  </tr>
                  <tr>
                    <td>STAY:</td>
                    <td align="right"><?php echo $time; ?> Hrs.</td>
                    <td>DAILY LOAD/DISCH:</td>
                    <td align="right"><?php echo $daily; ?></td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td class="normal">BREAKDOWN OF PORT EXPENSES IN AND OUT  USD.</td>
            </tr>
            <tr>
              <td><table width="640" border="1" cellspacing="0" bordercolor="#CCCCCC">
                <tr class="normal" bgcolor="#0099FF">
                  <td width="48">ITEM</td>
                  <td width="286">REFERENCE.</td>
                  <td width="131">AMOUNT</td>
                  <td width="157">REMARKS</td>
                </tr>
                <?php
                                //////////////////////////////INICIO DE ITEM
                                $item=1;
                                $amount=0;
                                $queryRef="select * from caratulapda where puerto='$puerto' and id='$id' and referencia!='' and referencia is not null";
                                $resultRef = mysql_query($queryRef, $link);
                                $subtot1=0;
                                while($rowRef = mysql_fetch_array($resultRef)) {
                                    ?>
                <tr class="normalA">
                  <td><?php echo $item; ?></td>
                  <td><input type="text" name="<?php echo $item."referencia"; ?>" id="textfield" class="generalCombo" readonly="true" size="60" value="<?php echo $rowRef["referencia"]; ?>"/></td>
                  <td align="right"><input class="generalCombo" type="text" name="<?php echo $item."importe"; ?>" id="textfield" align="right" size="20" value="$ <?php echo number_format(round($rowRef["importe"]), 2, ".", ","); ?>"/>
                    <?php
                                            $val=str_replace( ",", "", $rowRef["importe"]);
                                            $val=str_replace( "$", "", $val);
                                            $subtot1+=$val; ?></td>
                  <td>&nbsp;</td>
                </tr>
                <?php
                                    $item++;
                                }
                                ////////////////////////////////FIN ITEM
                                ?>
                <tr class="normal">
                  <td>&nbsp;</td>
                  <td>SUB-TTL</td>
                  <td align="right"><?php echo "$ ".number_format($subtot1, 2, ".", ","); ?></td>
                  <td>&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td align="center"><table width="325" border="1" cellspacing="0" bordercolor="#CCCCCC">
                <tr class="normal" bgcolor="#0099FF">
                  <td width="201">OTHER EXPENSES</td>
                  <td width="114">AMOUNT</td>
                </tr>
                <?php
                                $queryRef="select * from cargosadicionales where id='$id'";
                                $resultRef = mysql_query($queryRef, $link);
                                $subtot2=0;
                                while($rowRef = mysql_fetch_array($resultRef)) {
                                    ?>
                <tr class="normalA">
                  <td><?php echo $rowRef["concepto"]; ?></td>
                  <td align="right"><?php echo "$ ".number_format($rowRef["cantidad"], 2, ".", ",");
                                        $subtot2+=$rowRef["cantidad"];?></td>
                </tr>
                <?php
                                }
                                ?>
                <tr class="normal">
                  <td>SUB-TTL</td>
                  <td align="right"><?php echo "$ ".number_format($subtot2, 2, ".", ","); ?></td>
                </tr>
                <tr class="normal">
                  <td>GRAND TOTAL TO REMIT.</td>
                  <td align="right"><?php echo "$ ".number_format($subtot1+$subtot2, 2, ".", ","); ?></td>
                </tr>
              </table></td>
            </tr>
          </table>
          <input type="hidden" name="puerto" id="sads" value="<?php echo $puerto; ?>"/>
          <input type="hidden" name="id" id="hiddenField" value="<?php echo $id; ?>" />
          <input type="hidden" name="item" id="hiddenField" value="<?php echo $item; ?>" />
          <input type="hidden" name="usd" id="hiddenField3" value="0" />
<input type="submit" name="button" id="button" value="Recalcular" />
        </form>
      </div>
      <div class="TabbedPanelsContent">
      <form id="form1" name="form1" method="get" action="caratulapdafastandfourios.php">
          <table width="643" border="1" cellspacing="0" bgcolor="#FFFFFF" bordercolor="#CCCCCC">
            <tr>
              <td width="637" height="90" align="left" class="normal" ><table width="646" border="1" cellspacing="0">
                <tr>
                  <td width="264"><font color="#FFFFFF"><img src="logox.jpg" width="264" height="83" /></font></td>
                  <td width="372" align="center"><font color="#FFFFFF"><img src="top.jpg" width="285" height="83" /></font></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td><table width="641" border="0" cellspacing="0">
                <tr>
                  <td width="55" bgcolor="#CCCCCC" class="normal">TO:</td>
                  <td width="237" class="normal"><?php echo $tox; ?></td>
                  <td width="61" bgcolor="#CCCCCC" class="normal">ATTN:</td>
                  <td width="280" class="normal"><?php echo $attn; ?></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td class="normalA">PLEASED TO SUBMIT THE FOLLOWING PDA TO COVER THE PRESENT CALL OF THE VESSEL AS FOLLOW </td>
            </tr>
            <tr>
              <td class="normal" bgcolor="#CCCCCC" align="center">GENERAL PROFORMA OF PORT EXPENSES:</td>
            </tr>
            <tr>
              <td><?php
                            $queryx="select * from proformas where id='$id'";
                            $resultx = mysql_query($queryx, $link);
                            while($rowx = mysql_fetch_array($resultx)) {
                                $puerto=$rowx["puerto"];
                                $grt=$rowx["grt"];
                                $vessel=$rowx["vessel"];
                                $loa=$rowx["loa"];
                                $cargo=$rowx["cargo"];
                                $pier=$rowx["pier"];
                                $stay=$rowx["stay"];
                                $daily=$rowx["daily"];								
	                            $tc=$rowx["tc"];
								$d=$rowx["d"];
        						$h=$rowx["h"];
							    $time=($d*24)+$h;
								
                            }
                            ?>
                <table width="640" border="1" cellspacing="0" class="normalA" bordercolor="#CCCCCC">
                  <tr>
                    <td width="111">PORT:</td>
                    <td width="199" align="right"><?php echo $puerto; ?></td>
                    <td width="128">GRT:</td>
                    <td width="184" align="right"><?php echo $grt; ?></td>
                  </tr>
                  <tr>
                    <td>VESSEL:</td>
                    <td align="right"><?php echo $vessel; ?></td>
                    <td>LOA:</td>
                    <td align="right"><?php echo $loa; ?></td>
                  </tr>
                  <tr>
                    <td>CARGO:</td>
                    <td align="right"><?php echo number_format($cargo, 3, ".", ",")." MT"; ?></td>
                    <td>PIER:</td>
                    <td align="right"><?php echo $pier; ?></td>
                  </tr>
                  <tr>
                    <td>STAY:</td>
                    <td align="right"><?php echo $time; ?> Hrs.</td>
                    <td>DAILY LOAD/DISCH:</td>
                    <td align="right"><?php echo $daily; ?></td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td class="normal">BREAKDOWN OF PORT EXPENSES IN AND OUT  USD.</td>
            </tr>
            <tr>
              <td><table width="640" border="1" cellspacing="0" bordercolor="#CCCCCC">
                <tr class="normal" bgcolor="#0099FF">
                  <td width="48">ITEM</td>
                  <td width="286">REFERENCE.</td>
                  <td width="131">AMOUNT</td>
                  <td width="157">REMARKS</td>
                </tr>
                <?php
                                //////////////////////////////INICIO DE ITEM
                                $item=1;
                                $amount=0;
                                $queryRef="select * from caratulapda where puerto='$puerto' and id='$id' and referencia!='' and referencia is not null";
                                $resultRef = mysql_query($queryRef, $link);
                                $subtot1=0;
                                while($rowRef = mysql_fetch_array($resultRef)) {
                                    ?>
                <tr class="normalA">
                  <td><?php echo $item; ?></td>
                  <td><input type="text" name="<?php echo $item."referencia"; ?>" id="textfield" class="generalCombo" readonly="true" size="60" value="<?php echo $rowRef["referencia"]; ?>"/></td>
                  <td align="right"><input class="generalCombo" type="text" name="<?php echo $item."importe"; ?>" id="textfield" align="right" size="20" value="$ <?php echo number_format(round($rowRef["importe"]/$tc), 2, ".", ","); ?>"/>
                    <?php
                                            $val=str_replace( ",", "", $rowRef["importe"]);
                                            $val=str_replace( "$", "", $val);
                                            $subtot1+=$val; ?></td>
                  <td>&nbsp;</td>
                </tr>
                <?php
                                    $item++;
                                }
                                ////////////////////////////////FIN ITEM
                                ?>
                <tr class="normal">
                  <td>&nbsp;</td>
                  <td>SUB-TTL</td>
                  <td align="right"><?php echo "$ ".number_format($subtot1/$tc, 2, ".", ","); ?></td>
                  <td>&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td align="center"><table width="325" border="1" cellspacing="0" bordercolor="#CCCCCC">
                <tr class="normal" bgcolor="#0099FF">
                  <td width="201">OTHER EXPENSES</td>
                  <td width="114">AMOUNT</td>
                </tr>
                <?php
                                $queryRef="select * from cargosadicionales where id='$id'";
                                $resultRef = mysql_query($queryRef, $link);
                                $subtot2=0;
                                while($rowRef = mysql_fetch_array($resultRef)) {
                                    ?>
                <tr class="normalA">
                  <td><?php echo $rowRef["concepto"]; ?></td>
                  <td align="right"><?php echo "$ ".number_format($rowRef["cantidad"]/$tc, 2, ".", ",");
                                        $subtot2+=$rowRef["cantidad"];?></td>
                </tr>
                <?php
                                }
                                ?>
                <tr class="normal">
                  <td>SUB-TTL</td>
                  <td align="right"><?php echo "$ ".number_format($subtot2/$tc, 2, ".", ","); ?></td>
                </tr>
                <tr class="normal">
                  <td>GRAND TOTAL TO REMIT.</td>
                  <td align="right"><?php echo "$ ".number_format(($subtot1+$subtot2)/$tc, 2, ".", ","); ?></td>
                </tr>
              </table></td>
            </tr>
          </table>
          <input type="hidden" name="puerto" id="sads" value="<?php echo $puerto; ?>"/>
          <input type="hidden" name="id" id="hiddenField" value="<?php echo $id; ?>" />
          <input type="hidden" name="item" id="hiddenField" value="<?php echo $item; ?>" />
          <input type="hidden" name="usd" id="hiddenField2" value="<?php echo $tc; ?>" />
<input type="submit" name="button" id="button" value="Recalcular" />
        </form>
      </div>
      <div class="TabbedPanelsContent">
      <table width="643" border="1" cellspacing="0" bgcolor="#FFFFFF" bordercolor="#CCCCCC">
            <tr>
              <td width="637" height="90" align="left" class="normal" ><table width="646" border="1" cellspacing="0">
                <tr>
                  <td width="264"><img src="logox.jpg" width="264" height="83" /></td>
                  <td width="372" align="center"><font color="#FFFFFF"><img src="top.jpg" width="285" height="83" /></font></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td><table width="641" border="0" cellspacing="0">
                <tr>
                  <td width="55" bgcolor="#0183bf" class="normalTit">TO:</td>
                  <td width="237" class="normal"><?php echo $tox; ?></td>
                  <td width="61" bgcolor="#0183bf" class="normalTit">ATTN:</td>
                  <td width="280" class="normal"><?php echo $attn; ?></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td class="normalA">PLEASED TO SUBMIT THE FOLLOWING PDA TO COVER THE PRESENT CALL OF THE VESSEL AS FOLLOW </td>
            </tr>
            <tr>
              <td class="normalTit" bgcolor="#0183bf" align="center">GENERAL PROFORMA OF PORT EXPENSES:</td>
            </tr>
            <tr>
              <td><?php
                        $queryx="select * from proformas where id='$id'";
                        $resultx = mysql_query($queryx, $link);
                        while($rowx = mysql_fetch_array($resultx)) {
                            $puerto=$rowx["puerto"];
                            $grt=$rowx["grt"];
                            $vessel=$rowx["vessel"];
                            $loa=$rowx["loa"];
                            $cargo=$rowx["cargo"];
                            $pier=$rowx["pier"];
                            $stay=$rowx["stay"];
                            $daily=$rowx["daily"];
                            $tc=$rowx["tc"];
							$d=$rowx["d"];
        						$h=$rowx["h"];
							    $time=($d*24)+$h;
                        }
                        ?>
                <table width="646" border="1" cellspacing="0" class="normalA" bordercolor="#CCCCCC">
                  <tr>
                    <td width="112" class="normal">PORT:</td>
                    <td width="200" align="right"><?php echo $puerto; ?></td>
                    <td width="135" class="normal">GRT:</td>
                    <td width="181" align="right"><?php echo $grt; ?></td>
                  </tr>
                  <tr>
                    <td class="normal">VESSEL:</td>
                    <td align="right"><?php echo $vessel; ?></td>
                    <td class="normal">LOA:</td>
                    <td align="right"><?php echo $loa; ?></td>
                  </tr>
                  <tr>
                    <td class="normal">CARGO:</td>
                    <td align="right"><?php echo number_format($cargo, 3, ".", ",")." MT"; ?></td>
                    <td class="normal">PIER:</td>
                    <td align="right"><?php echo $pier; ?></td>
                  </tr>
                  <tr>
                    <td class="normal">STAY:</td>
                    <td align="right"><?php echo $time; ?> Hrs.</td>
                    <td class="normal">DAILY LOAD/DISCH:</td>
                    <td align="right"><?php echo $daily; ?></td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td class="normal">BREAKDOWN OF PORT EXPENSES IN AND OUT  USD.</td>
            </tr>
            <tr>
              <td><table width="645" border="1" cellspacing="0" bordercolor="#CCCCCC">
                <tr class="normalTit" bgcolor="#0183bf">
                  <td width="48">ITEM</td>
                  <td width="286">REFERENCE.</td>
                  <td width="131" align="right">AMOUNT</td>
                  <td width="157" align="center">REMARKS</td>
                </tr>
                <?php
                            //////////////////////////////INICIO DE ITEM
                            $item=1;
                            $amount=0;
                            $queryRef="select * from caratulapda where puerto='$puerto' and id='$id' and referencia!='' and referencia is not null";
                            $resultRef = mysql_query($queryRef, $link);
                            $subtot1=0;
                            while($rowRef = mysql_fetch_array($resultRef)) {
                                ?>
                <tr class="normalA">
                  <td><?php echo $item; ?></td>
                  <td><?php echo $rowRef["referencia"]; ?></td>
                  <td align="right">$
                    <?php
                                        $val=str_replace( ",", "", $rowRef["importe"]);
                                        $val=str_replace( "$", "", $val);
                                        echo number_format(round($val/$tc), 2, ".", ",");
                                        $subtot1+=$val; ?></td>
                  <td>&nbsp;</td>
                </tr>
                <?php
                                $item++;
                            }
                            ////////////////////////////////FIN ITEM
                            ?>
                <tr class="normal">
                  <td>&nbsp;</td>
                  <td>SUB-TTL</td>
                  <td align="right"><?php echo "$ ".number_format($subtot1/$tc, 2, ".", ","); ?></td>
                  <td>&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td align="center"><table width="325" border="1" cellspacing="0" bordercolor="#CCCCCC">
                <tr class="normalTit" bgcolor="#0183bf">
                  <td width="201">OTHER EXPENSES</td>
                  <td width="114">AMOUNT</td>
                </tr>
                <?php
                            $queryRef="select * from cargosadicionales where id='$id'";
                            $resultRef = mysql_query($queryRef, $link);
                            $subtot2=0;
                            while($rowRef = mysql_fetch_array($resultRef)) {
                                ?>
                <tr class="normalA">
                  <td><?php echo $rowRef["concepto"]; ?></td>
                  <td align="right"><?php echo "$ ".number_format(round($rowRef["cantidad"]/$tc), 2, ".", ",");
                                    $subtot2+=$rowRef["cantidad"];?></td>
                </tr>
                <?php
                            }
                            ?>
                <tr class="normal">
                  <td>SUB-TTL</td>
                  <td align="right"><?php echo "$ ".number_format($subtot2/$tc, 2, ".", ","); ?></td>
                </tr>
                <tr class="normal">
                  <td>GRAND TOTAL TO REMIT.</td>
                  <td align="right"><?php echo "$ ".number_format(($subtot1+$subtot2)/$tc, 2, ".", ","); ?></td>
                </tr>
              </table></td>
            </tr>
          </table>
        </div>
        <div class="TabbedPanelsContent">
          <table width="643" border="1" cellspacing="0" bgcolor="#FFFFFF" bordercolor="#CCCCCC">
            <tr>
              <td width="637" height="90" align="left" class="normal" ><table width="646" border="1" cellspacing="0">
                <tr>
                  <td width="264"><img src="logox.jpg" alt="" width="264" height="83" /></td>
                  <td width="372" align="center"><font color="#FFFFFF"><img src="top.jpg" alt="" width="285" height="83" /></font></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td><table width="641" border="0" cellspacing="0">
                <tr>
                  <td width="55" bgcolor="#0183bf" class="normalTit">TO:</td>
                  <td width="237" class="normal"><?php echo $tox; ?></td>
                  <td width="61" bgcolor="#0183bf" class="normalTit">ATTN:</td>
                  <td width="280" class="normal"><?php echo $attn; ?></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td class="normalA">PLEASED TO SUBMIT THE FOLLOWING PDA TO COVER THE PRESENT CALL OF THE VESSEL AS FOLLOW </td>
            </tr>
            <tr>
              <td class="normalTit" bgcolor="#0183bf" align="center">GENERAL PROFORMA OF PORT EXPENSES:</td>
            </tr>
            <tr>
              <td><?php
                        $queryx="select * from proformas where id='$id'";
                        $resultx = mysql_query($queryx, $link);
                        while($rowx = mysql_fetch_array($resultx)) {
                            $puerto=$rowx["puerto"];
                            $grt=$rowx["grt"];
                            $vessel=$rowx["vessel"];
                            $loa=$rowx["loa"];
                            $cargo=$rowx["cargo"];
                            $pier=$rowx["pier"];
                            $stay=$rowx["stay"];
                            $daily=$rowx["daily"];
                            $tc=$rowx["tc"];
							$d=$rowx["d"];
        						$h=$rowx["h"];
							    $time=($d*24)+$h;
                        }
                        ?>
                <table width="646" border="1" cellspacing="0" class="normalA" bordercolor="#CCCCCC">
                  <tr>
                    <td width="111" class="normal">PORT:</td>
                    <td width="199" align="right"><?php echo $puerto; ?></td>
                    <td width="128" class="normal">GRT:</td>
                    <td width="184" align="right"><?php echo $grt; ?></td>
                  </tr>
                  <tr>
                    <td class="normal">VESSEL:</td>
                    <td align="right"><?php echo $vessel; ?></td>
                    <td class="normal">LOA:</td>
                    <td align="right"><?php echo $loa; ?></td>
                  </tr>
                  <tr>
                    <td class="normal">CARGO:</td>
                    <td align="right"><?php echo number_format($cargo, 3, ".", ",")." MT"; ?></td>
                    <td class="normal">PIER:</td>
                    <td align="right"><?php echo $pier; ?></td>
                  </tr>
                  <tr>
                    <td class="normal">STAY:</td>
                    <td align="right"><?php echo $time; ?> Hrs.</td>
                    <td class="normal">DAILY LOAD/DISCH:</td>
                    <td align="right"><?php echo $daily; ?></td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td class="normal">BREAKDOWN OF PORT EXPENSES IN AND OUT  USD.</td>
            </tr>
            <tr>
              <td><table width="645" border="1" cellspacing="0" bordercolor="#CCCCCC">
                <tr class="normalTit" bgcolor="#0183bf">
                  <td width="48">ITEM</td>
                  <td width="286">REFERENCE.</td>
                  <td width="131" align="right">AMOUNT</td>
                  <td width="157" align="center">REMARKS</td>
                </tr>
                <?php
                            //////////////////////////////INICIO DE ITEM
                            $item=1;
                            $amount=0;
                            $queryRef="select * from caratulapda where puerto='$puerto' and id='$id' and referencia!='' and referencia is not null";
                            $resultRef = mysql_query($queryRef, $link);
                            $subtot1=0;
                            while($rowRef = mysql_fetch_array($resultRef)) {
                                ?>
                <tr class="normalA">
                  <td><?php echo $item; ?></td>
                  <td><?php echo $rowRef["referencia"]; ?></td>
                  <td align="right">$
                    <?php
                                        $val=str_replace( ",", "", $rowRef["importe"]);
                                        $val=str_replace( "$", "", $val);
                                        echo number_format(round($val/$tc), 2, ".", ",");
                                        $subtot1+=$val; ?></td>
                  <td>&nbsp;</td>
                </tr>
                <?php
                                $item++;
                            }
                            ////////////////////////////////FIN ITEM
                            ?>
                <tr class="normal">
                  <td>&nbsp;</td>
                  <td>SUB-TTL</td>
                  <td align="right"><?php echo "$ ".number_format($subtot1/$tc, 2, ".", ","); ?></td>
                  <td>&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td align="center"><table width="325" border="1" cellspacing="0" bordercolor="#CCCCCC">
                <tr class="normalTit" bgcolor="#0183bf">
                  <td width="201">OTHER EXPENSES</td>
                  <td width="114">AMOUNT</td>
                </tr>
                <?php
                            $queryRef="select * from cargosadicionales where id='$id'";
                            $resultRef = mysql_query($queryRef, $link);
                            $subtot2=0;
                            while($rowRef = mysql_fetch_array($resultRef)) {
                                ?>
                <tr class="normalA">
                  <td><?php echo $rowRef["concepto"]; ?></td>
                  <td align="right"><?php echo "$ ".number_format(round($rowRef["cantidad"]/$tc), 2, ".", ",");
                                    $subtot2+=$rowRef["cantidad"];?></td>
                </tr>
                <?php
                            }
                            ?>
                <tr class="normal">
                  <td>SUB-TTL</td>
                  <td align="right"><?php echo "$ ".number_format($subtot2/$tc, 2, ".", ","); ?></td>
                </tr>
                <tr class="normal">
                  <td>GRAND TOTAL TO REMIT.</td>
                  <td align="right"><?php echo "$ ".number_format(($subtot1+$subtot2)/$tc, 2, ".", ","); ?></td>
                </tr>
              </table></td>
            </tr>
          </table>
          <table width="652" border="1" cellspacing="0" bordercolor="#CCCCCC" bgcolor="#FFFFFF">
            <tr bgcolor="#0183bf" class="normalTit">
              <td colspan="2">WIRE BANK TRANSFER DETAILS (USD)</td>
            </tr>
            <tr class="normal">
              <td width="279">BANK</td>
              <td width="360" align="right">SCOTIABANK S.A.</td>
            </tr>
            <tr class="normal">
              <td>BRANCH</td>
              <td align="right">001</td>
            </tr>
            <tr class="normal">
              <td>ACCOUNT (USD)</td>
              <td align="right">05500001724</td>
            </tr>
            <tr class="normal">
              <td>BENEFICIARY</td>
              <td align="right">TWIN MARINE DE MEXICO S.A. DE C.V.</td>
            </tr>
            <tr class="normal">
              <td>SWIFT</td>
              <td align="right">MBCOMXMM</td>
            </tr>
            <tr class="normal">
              <td>CITY</td>
              <td align="right">VERACRUZ, MEXICO</td>
            </tr>
          </table>
      </div>
        <div class="TabbedPanelsContent">
          <table width="650" border="1" cellspacing="0" bgcolor="#FFFFFF" bordercolor="#CCCCCC">
                <tr>
                    <td width="644" height="90" align="left" class="normal" ><table width="646" border="1" cellspacing="0">
                      <tr>
                          <td width="264"><img src="logox.jpg" width="264" height="83" /></td>
                          <td width="372" align="center"><font color="#FFFFFF"><img src="top.jpg" width="285" height="83" /></font></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                    <td><table width="641" border="0" cellspacing="0">
                            <tr>
                                <td width="55" bgcolor="#0183bf" class="normalTit">TO:</td>
                                <td width="237" class="normal"><?php echo $tox; ?></td>
                                <td width="61" bgcolor="#0183bf" class="normalTit">ATTN:</td>
                                <td width="280">&nbsp;</td>
                            </tr>
                        </table></td>
                </tr>
                <tr>
                    <td class="normalA">PLEASED TO SUBMIT THE FOLLOWING PDA TO COVER THE PRESENT CALL OF THE VESSEL AS FOLLOW </td>
                </tr>
                <tr>
                    <td bgcolor="#0183bf" class="normalTit" align="center">GENERAL PROFORMA OF PORT EXPENSES:</td>
                </tr>
                <tr>
                    <td><?php
                        $queryx="select * from proformas where id='$id'";
                        $resultx = mysql_query($queryx, $link);
                        while($rowx = mysql_fetch_array($resultx)) {
                            $puerto=$rowx["puerto"];
                            $grt=$rowx["grt"];
                            $vessel=$rowx["vessel"];
                            $loa=$rowx["loa"];
                            $cargo=$rowx["cargo"];
                            $pier=$rowx["pier"];
                            $stay=$rowx["stay"];
                            $daily=$rowx["daily"];
							$d=$rowx["d"];
        						$h=$rowx["h"];
							    $time=($d*24)+$h;
                        }
                        ?>
                        <table width="647" border="1" cellspacing="0" class="normalA" bordercolor="#CCCCCC">
                            <tr>
                                <td width="112" class="normal">PORT:</td>
                                <td width="201" align="right"><?php echo $puerto; ?></td>
                                <td width="136" class="normal">GRT:</td>
                                <td width="180" align="right"><?php echo $grt; ?></td>
                            </tr>
                            <tr>
                                <td class="normal">VESSEL:</td>
                                <td align="right"><?php echo $vessel; ?></td>
                                <td class="normal" >LOA:</td>
                                <td align="right"><?php echo $loa; ?></td>
                            </tr>
                            <tr>
                                <td class="normal">CARGO:</td>
                                <td align="right"><?php echo number_format($cargo, 3, ".", ",")." MT"; ?></td>
                                <td class="normal">PIER:</td>
                                <td align="right"><?php echo $pier; ?></td>
                            </tr>
                            <tr>
                                <td class="normal">STAY:</td>
                                <td align="right"><?php echo $time; ?> Hrs.</td>
                                <td class="normal">DAILY LOAD/DISCH:</td>
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                        <?php echo $daily; ?></td>
                </tr>
                <tr>
                    <td class="normal">BREAKDOWN OF PORT EXPENSES IN AND OUT  USD.</td>
                </tr>
                <tr>
                    <td><table width="650" border="1" cellspacing="0" bordercolor="#CCCCCC">
                            <tr bgcolor="#0183bf" class="normalTit">
                                <td width="48">ITEM</td>
                                <td width="286">REFERENCE.</td>
                                <td width="131" align="right">AMOUNT</td>
                                <td width="167" align="center">REMARKS</td>
                            </tr>
                            <?php
                            //////////////////////////////INICIO DE ITEM
                            $item=1;
                            $amount=0;
                            $queryRef="select * from caratulapda where puerto='$puerto' and id='$id' and referencia!='' and referencia is not null order by item";
                            $resultRef = mysql_query($queryRef, $link);
                            $subtot1=0;
                            while($rowRef = mysql_fetch_array($resultRef)) {
                                ?>
                            <tr class="normalA">
                                <td><?php echo $item; ?></td>
                                <td><?php echo $rowRef["referencia"]; ?></td>
                                <td align="right">$ <?php echo number_format(round($rowRef["importe"]), 2, ".", ",");
                                        $val=str_replace( ",", "", $rowRef["importe"]);
                                        $val=str_replace( "$", "", $val);
                                        $subtot1+=$val; ?></td>
                                <td>&nbsp;</td>
                            </tr>
                                <?php
                                $item++;
                            }
                            ////////////////////////////////FIN ITEM
                            ?>
                            <tr class="normal">
                                <td>&nbsp;</td>
                                <td>SUB-TTL</td>
                                <td align="right"><?php echo "$ ".number_format($subtot1, 2, ".", ","); ?></td>
                                <td>&nbsp;</td>
                            </tr>
                        </table></td>
                </tr>
                <tr>
                    <td align="center"><table width="325" border="1" cellspacing="0" bordercolor="#CCCCCC">
                            <tr bgcolor="#0183bf" class="normalTit">
                                <td width="201">OTHER EXPENSES</td>
                                <td width="114">AMOUNT</td>
                            </tr>
                            <?php
                            $queryRef="select * from cargosadicionales where id='$id'";
                            $resultRef = mysql_query($queryRef, $link);
                            $subtot2=0;
                            while($rowRef = mysql_fetch_array($resultRef)) {
                                ?>
                            <tr class="normalA">
                                <td><?php echo $rowRef["concepto"]; ?></td>
                                <td align="right"><?php echo "$ ".number_format(round($rowRef["cantidad"]), 2, ".", ",");
                                    $subtot2+=$rowRef["cantidad"];?></td>
                            </tr>
                            <?php
                            }
                            ?>
                            <tr class="normal">
                                <td>SUB-TTL</td>
                                <td align="right"><?php echo "$ ".number_format($subtot2, 2, ".", ","); ?></td>
                            </tr>
                            <tr class="normal">
                                <td>GRAND TOTAL TO REMIT.</td>
                                <td align="right"><?php echo "$ ".number_format($subtot1+$subtot2, 2, ".", ","); ?></td>
                            </tr>
                        </table></td>
                </tr>
            </table>
            <table width="654" border="1" cellspacing="0" bordercolor="#CCCCCC" bgcolor="#FFFFFF">
                <tr bgcolor="#0183bf" class="normalTit">
                    <td colspan="2">WIRE BANK TRANSFER DETAILS (MN)</td>
                </tr>
                <tr class="normal">
                    <td width="276">BANK</td>
                    <td width="360" align="right">SCOTIABANK S.A.</td>
                </tr>
                <tr class="normal">
                    <td>BRANCH</td>
                    <td align="right">001</td>
                </tr>
                <tr class="normal">
                    <td>ACCOUNT (USD)</td>
                    <td align="right">05506453287</td>
                </tr>
                <tr class="normal">
                    <td>BENEFICIARY</td>
                    <td align="right">TWIN MARINE DE MEXICO S.A. DE C.V.</td>
                </tr>
                <tr class="normal">
                    <td>SWIFT</td>
                    <td align="right">MBCOMXMM</td>
                </tr>
                <tr class="normal">
                    <td>CITY</td>
                    <td align="right">VERACRUZ, MEXICO</td>
                </tr>
            </table>
        </div>
        <div class="TabbedPanelsContent">
            <form id="form1" name="form1" method="get" action="asistente2.php">
                <table width="832" border="1" cellspacing="0" class="general" bordercolor="#CCCCCC">
                    <tr class="tituloTabla" bgcolor="#000066">
                        <td width="32">CANT</td>
                        <td width="208">CLASIFICACION</td>
                        <td width="340">CONCEPTO DE TARIFA</td>
                        <td width="120">REFERENCIA</td>
                        <td width="75">P.U. </td>
                    </tr>
                    <?php
                    //////////////////////////////INICIO DE ITEM
                    $item=1;

                    $queryTarifa="select * from tarifas where puerto='$puerto' and setdefault='1' order by clasificacion";
                    $resultTarifa = mysql_query($queryTarifa, $link);
                    while($rowTarifa = mysql_fetch_array($resultTarifa)) {
                        $tarifa=0;
                        $concepto=$rowTarifa["concepto"];
                        $clasificacion=$rowTarifa["clasificacion"];
                        $referencia=$rowTarifa["referencia"];
                        $cantidad=$rowTarifa["cantidad"];
                        if($rowTarifa["tarifafija"]=="1") {
                            $tarifa=$rowTarifa["tarifa"];
							if($rowTarifa["iva"]=="1") {
            					$tarifa=$tarifa*1.16;
							}
							
							if($rowTarifa["usd"]=="1") {
            					$tarifa=$tarifa*$tc;
							}
                        }
                        else {
                            if($rowTarifa["factor"]!=null or $rowTarifa["factor"]!="") {
                            ////////////FACTOR
                                $A=1;
			$B=1;
			$C=1;
			$D=1;
			if($rowTarifa["factortiempo"]!="0") {
                    $A=$time;
                }
            if($rowTarifa["factorgrt"]!="0") {
                        $B=$grt;
                    }
            if($rowTarifa["factorloa"]!="0") {
                            $C=$loa;
                        }
            if($rowTarifa["factordia"]!="0") {
                                $D=($time/24);
                            }
							
							$tarifa=$A*$B*$C*$D*$rowTarifa["factor"];

                /*if($rowTarifa["factortiempo"]!="0") {
                    $tarifa=$time*$rowTarifa["factor"];
                }
                else if($rowTarifa["factorgrt"]!="0") {
                        $tarifa=$grt*$rowTarifa["factor"];
                    }
                    else if($rowTarifa["factorloa"]!="0") {
                            $tarifa=$loa*$rowTarifa["factor"];
                        }
                        else if($rowTarifa["factordia"]!="0") {
                                $tarifa=($time/24)*$rowTarifa["factor"];
                            }*/

                                if($rowTarifa["porcentaje"]!="" or $rowTarifa["porcentaje"]!=null) {
                                    $tarifa=$tarifa+(($tarifa*$rowTarifa["porcentaje"])/100);
                                }

                                if($rowTarifa["valorporcentaje"]!="" or $rowTarifa["valorporcentaje"]!=null) {
                                    $tarifa=(($tarifa*$rowTarifa["valorporcentaje"])/100);
                                }
                            }
                            else {
                                $tarifa=0;
                            }
                            ////////////CRITERIOS//////////////////////////////////////////////////////////////////////////////////////
							if($rowTarifa["tarxtar"]!="0") {
                $queryCriterio="select * from criterios where concepto='$concepto'";
                $resultCriterio = mysql_query($queryCriterio, $link);
                while($rowCriterio = mysql_fetch_array($resultCriterio)) {
                    if($rowCriterio["de"]<=$grt and $rowCriterio["a"]>=$grt) {
                            $tarifa=$rowCriterio["tarifa"]*$rowCriterio["tarifa2"];
                    }
                    else if($rowCriterio["de"]<=$grt and ($rowCriterio["a"]=="" or $rowCriterio["a"]==null) ) {
                            $tarifa=$rowCriterio["tarifa"]*$rowCriterio["tarifa2"];
                        }
                }
            }
                            if($rowTarifa["criteriotiempo"]!="0") {
                                $queryCriterio="select * from criterios where concepto='$concepto'";
                                $resultCriterio = mysql_query($queryCriterio, $link);
                                while($rowCriterio = mysql_fetch_array($resultCriterio)) {
                                    if(toHora($rowCriterio["de"])<=$time and toHora($rowCriterio["a"])>=$time) {
                                        if($rowTarifa["factortarifa"]!="0")
                                            $tarifa=$time*$rowCriterio["tarifa"];
                                        else
                                            $tarifa=$rowCriterio["tarifa"];
                                        if($rowCriterio["tarifa2"]!="" or $rowCriterio["tarifa2"]!=null) {
                                            if($rowTarifa["factortarifa"]!="0")
                                                $tarifa+=$time*$rowCriterio["tarifa2"];
                                            else
                                                $tarifa+=$rowCriterio["tarifa2"];
                                        }
                                    }
                                    else if(toHora($rowCriterio["de"])<=$time and ($rowCriterio["a"]=="" or $rowCriterio["a"]==null) ) {
                                            if($rowTarifa["factortarifa"]!="0")
                                                $tarifa=$time*$rowCriterio["tarifa"];
                                            else
                                                $tarifa=$rowCriterio["tarifa"];
                                            if($rowCriterio["tarifa2"]!="" or $rowCriterio["tarifa2"]!=null) {
                                                if($rowTarifa["factortarifa"]!="0")
                                                    $tarifa+=$time*$rowCriterio["tarifa2"];
                                                else
                                                    $tarifa+=$rowCriterio["tarifa2"];
                                            }
                                        }
                                }
                            }
                            else if($rowTarifa["criterioloa"]!="0") {
                                    $queryCriterio="select * from criterios where concepto='$concepto'";
                                    $resultCriterio = mysql_query($queryCriterio, $link);
                                    while($rowCriterio = mysql_fetch_array($resultCriterio)) {
                                        if($rowCriterio["de"]<=$loa and $rowCriterio["a"]>=$loa) {
                                            if($rowTarifa["factortarifa"]!="0")
                                                $tarifa=$loa*$rowCriterio["tarifa"];
                                            else
                                                $tarifa=$rowCriterio["tarifa"];
                                            if($rowCriterio["tarifa2"]!="" or $rowCriterio["tarifa2"]!=null) {
                                                if($rowTarifa["factortarifa"]!="0")
                                                    $tarifa+=$loa*$rowCriterio["tarifa2"];
                                                else
                                                    $tarifa+=$rowCriterio["tarifa2"];
                                            }
                                        }
                                        else if($rowCriterio["de"]<=$loa and ($rowCriterio["a"]=="" or $rowCriterio["a"]==null) ) {
                                                if($rowTarifa["factortarifa"]!="0")
                                                    $tarifa=$loa*$rowCriterio["tarifa"];
                                                else
                                                    $tarifa=$rowCriterio["tarifa"];
                                                if($rowCriterio["tarifa2"]!="" or $rowCriterio["tarifa2"]!=null) {
                                                    if($rowTarifa["factortarifa"]!="0")
                                                        $tarifa+=$loa*$rowCriterio["tarifa2"];
                                                    else
                                                        $tarifa+=$rowCriterio["tarifa2"];
                                                }
                                            }
                                    }
                                }
                                else if($rowTarifa["criteriogrt"]!="0") {
                                        $queryCriterio="select * from criterios where concepto='$concepto'";
                                        $resultCriterio = mysql_query($queryCriterio, $link);
                                        while($rowCriterio = mysql_fetch_array($resultCriterio)) {
                                            if($rowCriterio["de"]<=$grt and $rowCriterio["a"]>=$grt) {
                                                if($rowTarifa["factortarifa"]!="0")
                                                    $tarifa=$grt*$rowCriterio["tarifa"];
                                                else
                                                    $tarifa=$rowCriterio["tarifa"];
                                                if($rowCriterio["tarifa2"]!="" or $rowCriterio["tarifa2"]!=null) {
                                                    if($rowTarifa["factortarifa"]!="0")
                                                        $tarifa+=$grt*$rowCriterio["tarifa2"];
                                                    else
                                                        $tarifa+=$rowCriterio["tarifa2"];
                                                }
                                            }
                                            else if($rowCriterio["de"]<=$grt and ($rowCriterio["a"]=="" or $rowCriterio["a"]==null) ) {
                                                    if($rowTarifa["factortarifa"]!="0")
                                                        $tarifa=$grt*$rowCriterio["tarifa"];
                                                    else
                                                        $tarifa=$rowCriterio["tarifa"];
                                                    if($rowCriterio["tarifa2"]!="" or $rowCriterio["tarifa2"]!=null) {
                                                        if($rowTarifa["factortarifa"]!="0")
                                                            $tarifa+=$grt*$rowCriterio["tarifa2"];
                                                        else
                                                            $tarifa+=$rowCriterio["tarifa2"];
                                                    }
                                                }
                                        }
                                    }
                            if($rowTarifa["factortarifa"]!="0") {
                            ////////////FACTOR
                                if($rowTarifa["factortiempo"]!="0") {
                                    $tarifa=$time*$tarifa;
                                }
                                else if($rowTarifa["factorgrt"]!="0") {
                                        $tarifa=$grt*$tarifa;
                                    }
                                    else if($rowTarifa["factorloa"]!="0") {
                                            $tarifa=$loa*$tarifa;
                                        }
                                        else if($rowTarifa["factordia"]!="0") {
                                                $tarifa=($time/24)*$tarifa;
                                            }

                            }
							if($rowTarifa["iva"]=="1") {
            					$tarifa=$tarifa*1.16;
							}
							
							if($rowTarifa["usd"]=="1") {
            					$tarifa=$tarifa*$tc;
							}
                        }
                        ?>
                    <tr bgcolor="#FFFFFF">
                        <td><input class="general" type="text" name="<?php echo $item."cantidad"; ?>" id="textBox" value="<?php echo $cantidad; ?>" size="5" /></td>
                        <td><?php echo $clasificacion; ?></td>
                        <td><input class="generalCombo" type="text" name="<?php echo $item."concepto"; ?>" id="textfield2" value="<?php echo $concepto; ?>" size="68" readonly="true"/></td>
                        <td><input class="generalCombo" type="text" name="<?php echo $item."referencia"; ?>" id="textfield3" value="<?php echo $referencia; ?>" readonly="true"/></td>
                        <td align="right"><input class="generalCombo" type="text" name="<?php echo $item."pu"; ?>" id="textfield4" value="<?php echo "$ ".number_format($tarifa, 2, ".", ","); ?>" size="15" align="right" readonly="true"/></td>
                    </tr>
                        <?php
                        $item++;
                    }
                    ?>
                </table>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    <!--
    var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
    //-->
</script>