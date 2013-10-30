<?php
include("conexion.php");

$id=$_GET["id"];
$puerto=$_GET["puerto"];

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
    <li class="TabbedPanelsTab" tabindex="0">Tarifas</li>
    <li class="TabbedPanelsTab" tabindex="0">Caratula PDA</li>
    <li class="TabbedPanelsTab" tabindex="0">Caratula PDA Bancos</li>
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">
      <table width="643" border="0" cellspacing="0" bgcolor="#FFFFFF">
        <tr>
          <td width="637" class="normal" align="center"  bgcolor="#000066"><font color="#FFFFFF">TWIN MARINE DE MEXICO, S.A. DE C.V.</font></td>
        </tr>
        <tr>
          <td class="normal" align="center" bgcolor="#CCCCCC">HOJA DE CALCULO PARA GASTOS PORTUARIOS DE EMBARCACIONES EN <?php echo $puerto; ?><br />PORT EXPENSES CALCULATION SHEET FOR VESSESL AT <?php echo $puerto; ?></td>
        </tr>
        <tr>
          <td class="normal" align="center"  bgcolor="#000066"><font color="#FFFFFF">TARIFAS DE PUERTO / PORT TARIFFS:</font></td>
        </tr>
        <tr>
          <td>
          <?php
		  $table="clasificaciones";
		  $fields="clasificacion";
		  
		  $query = "select ".$fields." from ".$table." where puerto='".$puerto."'";
		  
		  $link = Conectar();
		  $result = mysql_query($query, $link);
		  $indice=1;
		  while($row = mysql_fetch_array($result)){
			  $clasificacion=$row["clasificacion"];
		  ?>
          <table width="636" border="0">
            <tr>
              <td class="clasificacion" bgcolor="#CCCCCC"><?php echo $indice.".- ".$clasificacion; ?></td>
            </tr>
            <tr>
              <td>
              <?php //////////////TARIFAS
			  $queryb="select * from tarifas where puerto='$puerto' and clasificacion='$clasificacion'";
			  $resultb = mysql_query($queryb, $link);
		  	  $subindice=97;
		  	  while($rowb = mysql_fetch_array($resultb)){
				  if($rowb["tarifafija"]=="1")	{
			  ?>
                <table width="633" border="0" cellspacing="0" class="tarifa">
                  <tr>
                  	<td width="15"><?php echo chr($subindice).")";?></td>
                    <td width="497"><?php echo $rowb["concepto"];?></td>
                    <td width="107" align="right"><?php if(number_format($rowb["tarifa"], 2, ".", ",")!="0.00") echo "$ ".number_format($rowb["tarifa"], 2, ".", ","); ?></td>
                  </tr>
                </table>
                <?php
				  }////fin de tarifa fija
                  else if($rowb["tarifavariable"]=="1")	{
					  ?>
                      <table width="633" border="0" cellspacing="0" class="tarifa">
                  <tr>
                  	<td width="15"><?php echo chr($subindice).")";?></td>
                    <td width="497"><?php echo $rowb["concepto"];?></td>
                    <td width="107" align="right"><?php if(number_format($rowb["tarifa"], 2, ".", ",")!="0.00") echo "$ ".number_format($rowb["tarifa"], 2, ".", ","); else echo "$ ".number_format($rowb["factor"], 3, ".", ",");?></td>
                  </tr>
                </table>
                <?php
					if(($rowb["criteriotiempo"]=="1" or $rowb["criterioloa"]=="1" or $rowb["criteriogrt"]=="1") and ($rowb["titulo1"]!="" or $rowb["titulo1"]))	{	/////si hay criterios
				?>
                <table width="633" border="1" cellspacing="0" class="tarifa" bordercolor="#999999">
                <tr >
                  	<td width="187">&nbsp;</td>
                  	<td width="20"></td>
                  	<td width="107">&nbsp;</td>
                  	<td width="17"></td>
                  	<td width="80">&nbsp;</td>
                  	<td width="93" align="left"><?php echo $rowb["titulo1"]; ?></td>
                  	<td width="99" align="left"><?php echo $rowb["titulo2"]; ?></td>
                  </tr>
                  <?php		////tabla de valores de la tarifa variable
                  	$queryc="select * from criterios where concepto='".$rowb["concepto"]."' order by de asc";
			  		$resultc = mysql_query($queryc, $link);
		  	  		while($rowc = mysql_fetch_array($resultc)){
						?>
                  <tr>
                  	<td width="187">&nbsp;</td>
                  	<td width="20" align="left">de</td>
                  	<td width="107" align="left"><?php echo $rowc["de"]; ?></td>
                  	<td width="17" align="left">a</td>
                  	<td width="80" align="left"><?php echo $rowc["a"]; ?></td>
                  	<td width="93" align="left"><?php echo "$ ".number_format($rowc["tarifa"], 2, ".", ","); ?></td>
                  	<td width="99" align="left"><?php echo "$ ".number_format($rowc["tarifa2"], 2, ".", ","); ?></td>
                  </tr><?php
					}		////////FIN DE LOS VALORES DE LA TARIFA VARIABLE
					?>
                </table>
                <?php
                	}////// fin de los criterios
				?>
                      <?php
					}  /////////FIN IF TARIFA VARIABLE
				  ?>
                <?php	/////////////FIN TARIFAS
				$subindice++;
			  }
				?>
                </td>
            </tr>
          </table>
          <?php
		  $indice++;
		  } //fin del while de las clasificaciones
		  ?>
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
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
          <td class="normalA">PLEASED TO SUBMIT THE FOLLOWING PDA TO COVER THE PRESENT CALL OF THE VESSEL AS FOLLOW							
</td>
        </tr>
        <tr>
          <td class="normal" bgcolor="#CCCCCC" align="center">GENERAL PROFORMA OF PORT EXPENSES:</td>
        </tr>
        <tr>
          <td>
          <?php
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
          </table>
          </td>
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
			$queryRef="select distinct referencia from tarifas where puerto='$puerto'";
			$resultRef = mysql_query($queryRef, $link);
		  	while($rowRef = mysql_fetch_array($resultRef)){
				$referencia=$rowRef["referencia"];
				
				$queryTarifa="select * from tarifas where puerto='$puerto' and referencia='$referencia'";
				$resultTarifa = mysql_query($queryTarifa, $link);
			  	while($rowTarifa = mysql_fetch_array($resultTarifa)){
					$concepto=$rowTarifa["concepto"];
					if($rowTarifa["tarifafija"]=="1")	{
						$tarifa=$rowTarifa["tarifa"];
					}
					else	{
						if($rowTarifa["factor"]!=null or $rowTarifa["factor"]!="")	{
							////////////FACTOR
							if($rowTarifa["factortiempo"]=!"0")	{
								
							}
							else if($rowTarifa["factorgrt"]=!"0")	{
								$tarifa=$grt*$rowTarifa["factor"];
							}
							else if($rowTarifa["factorloa"]=!"0")	{
								$tarifa=$loa*$rowTarifa["factor"];
							}
						}
						else	{
							$tarifa=0;
						}
						////////////CRITERIOS
						if($rowTarifa["criteriotiempo"]!="0")	{
							$queryCriterio="select * from criterios where concepto='$concepto'";
							$resultCriterio = mysql_query($queryCriterio, $link);
			  				while($rowCriterio = mysql_fetch_array($resultCriterio)){
								/*if()	{
								}*/
							}
						}
						else if($rowTarifa["criterioloa"]!="0")	{
							$queryCriterio="select * from criterios where concepto='$concepto'";
							$resultCriterio = mysql_query($queryCriterio, $link);
			  				while($rowCriterio = mysql_fetch_array($resultCriterio)){
								if($rowCriterio["de"]<=$loa and $rowCriterio["a"]>=$loa)	{
									$amount+=$rowCriterio["tarifa"];
									if($rowCriterio["tarifa2"]!="" or $rowCriterio["tarifa2"]!=null)	{
										$amount+=$rowCriterio["tarifa2"];
									}
								}
								else if($rowCriterio["de"]<=$loa and ($rowCriterio["a"]=="" or $rowCriterio["a"]==null) )	{
									$amount+=$rowCriterio["tarifa"];
									if($rowCriterio["tarifa2"]!="" or $rowCriterio["tarifa2"]!=null)	{
										$amount+=$rowCriterio["tarifa2"];
									}
								}
							}
						}
						else if($rowTarifa["criteriogrt"]!="0")	{
							echo "fuck";
							$queryCriterio="select * from criterios where concepto='$concepto'";
							$resultCriterio = mysql_query($queryCriterio, $link);
			  				while($rowCriterio = mysql_fetch_array($resultCriterio)){
								if($rowCriterio["de"]<=$grt and $rowCriterio["a"]>=$grt)	{
									$amount+=$rowCriterio["tarifa"];									
									if($rowCriterio["tarifa2"]!="" or $rowCriterio["tarifa2"]!=null)	{
										$amount+=$rowCriterio["tarifa2"];
									}
								}
								else if($rowCriterio["de"]<=$grt and ($rowCriterio["a"]=="" or $rowCriterio["a"]==null) )	{
									$amount+=$rowCriterio["tarifa"];
									if($rowCriterio["tarifa2"]!="" or $rowCriterio["tarifa2"]!=null)	{
										$amount+=$rowCriterio["tarifa2"];
									}
								}
							}
						}
					}
					$amount+=$tarifa;
				}
				
			?>
            <tr class="normalA">
              <td><?php echo $item; ?></td>
              <td><?php echo $referencia; ?></td>
              <td><?php echo "$ ".number_format($amount, 2, ".", ","); ?></td>
              <td>&nbsp;</td>
            </tr>
            <?php
			$item++;
			$amount=0;
			}
			////////////////////////////////FIN ITEM
			?>
            <tr class="normal">
              <td>&nbsp;</td>
              <td>SUB-TTL</td>
              <td>&nbsp;</td>
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
            <tr class="normalA">
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr class="normal">
              <td>SUB-TTL</td>
              <td>&nbsp;</td>
            </tr>
            <tr class="normal">
              <td>GRAND TOTAL TO REMIT.</td>
              <td>&nbsp;</td>
            </tr>
          </table></td>
        </tr>
      </table>
    </div>
    <div class="TabbedPanelsContent">Contenido 3</div>
  </div>
</div>
<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>