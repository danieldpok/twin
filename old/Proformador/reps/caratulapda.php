<?php
header('Content-Type: text/html; charset=iso-8859-1');
include("conexion.php");

$id=$_GET["id"];
$puerto=$_GET["puerto"];

$link = Conectar();

$item=$_GET["item"];
$query="delete from caratulapda where id='$id' and puerto='$puerto'";
mysql_query($query, $link);
for($i=1; $i<$item; $i++)	{
		$query="insert into caratulapda (id, puerto, referencia, importe) values ("
				."'".$_GET["id"]."', '".$_GET["puerto"]."', '".$_GET[$i."referencia"]."', '".$_GET[$i."importe"]."')";
		mysql_query($query, $link);
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
-->
</style>
<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0">Caratula PDA</li>
    <li class="TabbedPanelsTab" tabindex="0">Caratula PDA USD</li>
    <li class="TabbedPanelsTab" tabindex="0">Caratula PDA Bancos</li>
    <li class="TabbedPanelsTab" tabindex="0">Detalle de Conceptos</li>
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">
      <table width="643" border="1" cellspacing="0" bgcolor="#FFFFFF" bordercolor="#CCCCCC">
        <tr>
          <td width="637" class="normal" align="center"  bgcolor="#000066"><font color="#FFFFFF">TWIN MARINE DE MEXICO, S.A. DE C.V.</font></td>
        </tr>
        <tr>
          <td><table width="641" border="0" cellspacing="0">
            <tr>
              <td width="55" bgcolor="#CCCCCC" class="normal">TO:</td>
              <td width="237">&nbsp;</td>
              <td width="61" bgcolor="#CCCCCC" class="normal">ATTN:</td>
              <td width="280">&nbsp;</td>
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
		  	while($rowx = mysql_fetch_array($resultx)){
				$puerto=$rowx["puerto"];
				$grt=$rowx["grt"];
				$vessel=$rowx["vessel"];
				$loa=$rowx["loa"];
				$cargo=$rowx["cargo"];
				$pier=$rowx["pier"];
				$stay=$rowx["stay"];
				$daily=$rowx["daily"];
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
                <td><?php echo $vessel; ?></td>
                <td>LOA:</td>
                <td><?php echo $loa; ?></td>
              </tr>
              <tr>
                <td>CARGO:</td>
                <td><?php echo number_format($cargo, 3, ".", ",")." MT"; ?></td>
                <td>PIER:</td>
                <td><?php echo $pier; ?></td>
              </tr>
              <tr>
                <td>STAY:</td>
                <td><?php echo $stay; ?></td>
                <td>DAILY LOAD:</td>
                <td><?php echo $daily; ?></td>
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
			$queryRef="select * from caratulapda where puerto='$puerto' and id='$id'";
			$resultRef = mysql_query($queryRef, $link);
			$subtot1=0;
		  	while($rowRef = mysql_fetch_array($resultRef)){	
			?>
            <tr class="normalA">
              <td><?php echo $item; ?></td>
              <td><?php echo $rowRef["referencia"]; ?></td>
              <td align="right"><?php echo $rowRef["importe"];
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
		  	while($rowRef = mysql_fetch_array($resultRef)){	
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
    </div>
    <div class="TabbedPanelsContent">
      <table width="643" border="1" cellspacing="0" bgcolor="#FFFFFF" bordercolor="#CCCCCC">
        <tr>
          <td width="637" class="normal" align="center"  bgcolor="#000066"><font color="#FFFFFF">TWIN MARINE DE MEXICO, S.A. DE C.V.</font></td>
        </tr>
        <tr>
          <td><table width="641" border="0" cellspacing="0">
            <tr>
              <td width="55" bgcolor="#CCCCCC" class="normal">TO:</td>
              <td width="237">&nbsp;</td>
              <td width="61" bgcolor="#CCCCCC" class="normal">ATTN:</td>
              <td width="280">&nbsp;</td>
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
		  	while($rowx = mysql_fetch_array($resultx)){
				$puerto=$rowx["puerto"];
				$grt=$rowx["grt"];
				$vessel=$rowx["vessel"];
				$loa=$rowx["loa"];
				$cargo=$rowx["cargo"];
				$pier=$rowx["pier"];
				$stay=$rowx["stay"];
				$daily=$rowx["daily"];
				$tc=$rowx["tc"];
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
                <td><?php echo $vessel; ?></td>
                <td>LOA:</td>
                <td><?php echo $loa; ?></td>
              </tr>
              <tr>
                <td>CARGO:</td>
                <td><?php echo number_format($cargo, 3, ".", ",")." MT"; ?></td>
                <td>PIER:</td>
                <td><?php echo $pier; ?></td>
              </tr>
              <tr>
                <td>STAY:</td>
                <td><?php echo $stay; ?></td>
                <td>DAILY LOAD:</td>
                <td><?php echo $daily; ?></td>
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
			$queryRef="select * from caratulapda where puerto='$puerto' and id='$id'";
			$resultRef = mysql_query($queryRef, $link);
			$subtot1=0;
		  	while($rowRef = mysql_fetch_array($resultRef)){	
			?>
            <tr class="normalA">
              <td><?php echo $item; ?></td>
              <td><?php echo $rowRef["referencia"]; ?></td>
              <td align="right">$ <?php
			  		$val=str_replace( ",", "", $rowRef["importe"]);
					$val=str_replace( "$", "", $val);
					 echo number_format($val/$tc, 2, ".", ",");
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
		  	while($rowRef = mysql_fetch_array($resultRef)){	
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
              <td align="right"><?php echo "$ ".number_format($subtot2, 2, ".", ","); ?></td>
            </tr>
            <tr class="normal">
              <td>GRAND TOTAL TO REMIT.</td>
              <td align="right"><?php echo "$ ".number_format($subtot1+$subtot2, 2, ".", ","); ?></td>
            </tr>
          </table></td>
        </tr>
      </table>
      <p>&nbsp;</p>
    </div>
    <div class="TabbedPanelsContent">
      <table width="643" border="1" cellspacing="0" bgcolor="#FFFFFF" bordercolor="#CCCCCC">
        <tr>
          <td width="637" class="normal" align="center"  bgcolor="#000066"><font color="#FFFFFF">TWIN MARINE DE MEXICO, S.A. DE C.V.</font></td>
        </tr>
        <tr>
          <td><table width="641" border="0" cellspacing="0">
            <tr>
              <td width="55" bgcolor="#CCCCCC" class="normal">TO:</td>
              <td width="237">&nbsp;</td>
              <td width="61" bgcolor="#CCCCCC" class="normal">ATTN:</td>
              <td width="280">&nbsp;</td>
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
		  	while($rowx = mysql_fetch_array($resultx)){
				$puerto=$rowx["puerto"];
				$grt=$rowx["grt"];
				$vessel=$rowx["vessel"];
				$loa=$rowx["loa"];
				$cargo=$rowx["cargo"];
				$pier=$rowx["pier"];
				$stay=$rowx["stay"];
				$daily=$rowx["daily"];
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
                <td><?php echo $vessel; ?></td>
                <td>LOA:</td>
                <td><?php echo $loa; ?></td>
              </tr>
              <tr>
                <td>CARGO:</td>
                <td><?php echo number_format($cargo, 3, ".", ",")." MT"; ?></td>
                <td>PIER:</td>
                <td><?php echo $pier; ?></td>
              </tr>
              <tr>
                <td>STAY:</td>
                <td><?php echo $stay; ?></td>
                <td>DAILY LOAD:</td>
                <td><?php echo $daily; ?></td>
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
			$queryRef="select * from caratulapda where puerto='$puerto' and id='$id'";
			$resultRef = mysql_query($queryRef, $link);
			$subtot1=0;
		  	while($rowRef = mysql_fetch_array($resultRef)){	
			?>
            <tr class="normalA">
              <td><?php echo $item; ?></td>
              <td><?php echo $rowRef["referencia"]; ?></td>
              <td align="right"><?php echo $rowRef["importe"];
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
		  	while($rowRef = mysql_fetch_array($resultRef)){	
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
      <table width="325" border="1" cellspacing="0" bordercolor="#CCCCCC" bgcolor="#FFFFFF">
        <tr class="normal" bgcolor="#0099FF">
          <td colspan="2">WIRE BANK TRANSFER DETAILS</td>
        </tr>
        <tr class="normal">
          <td width="201">BANCO</td>
          <td width="114" align="right">SANTANDER</td>
        </tr>
        <tr class="normal">
          <td>SUC</td>
          <td align="right">1</td>
        </tr>
        <tr class="normal">
          <td>CIUDAD</td>
          <td align="right">VERACRUZ</td>
        </tr>
        <tr class="normal">
          <td>CTA</td>
          <td align="right">5506453287</td>
        </tr>
        <tr class="normal">
          <td>CLABE</td>
          <td align="right">044905055064532879</td>
        </tr>
      </table>
    </div>
    <div class="TabbedPanelsContent">Contenido 4</div>
  </div>
</div>
<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>