<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<?php

include("conexion.php");
$id=$_GET["id"];
//$id="11111";
//DATOS DEL REGISTRO
$table="operaciones";
$fields="*";

$query = "select ".$fields." from ".$table." where id='".$id."'";

$link = Conectar();
$result = mysql_query($query, $link);

while($row = mysql_fetch_array($result)){
$vessel=$row["vessel"];
$flag=$row["flag"];
$quantity=$row["quantity"];
$cargotype=$row["cargotype"];
$puertodecarga=$row["puertodecarga"];
$sailed=$row["sailed"];
$fquantity=$row["fquantity"];
$firstport=$row["firstport"];
$totalparcelfirst=$row["totalparcelfirst"];
$madfirst=$row["madfirst"];
$secondport=$row["secondport"];
$totalparcelsecond=$row["totalparcelsecond"];
$madsecond=$row["madsecond"];
$notes=$row["notes"];
$weather=$row["weather"];

$imo=$row["imonbr"];
$dwt=$row["dwtsummer"];
$beam=$row["breadthmouldedmt"];
$grt=$row["dwtgrt"];
$hh=$row["nbrhh"];
$callsign=$row["callsign"];
$built=$row["built"];
$loa=$row["loamt"];
$nrt=$row["dwtnrt"];
$cranes=$row["cranesonboard"];

$thirdport=$row["thirdport"];
$totalparcelthird=$row["totalparcelthird"];
$madthird=$row["madthird"];

}

?>

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta name="generator" content="Adobe GoLive" />
		<title>General Report</title>
		<link href="css/basic.css" rel="stylesheet" type="text/css" media="all" />
    <style type="text/css">
<!--
tablaizq {
	text-align: left;
}
.tablaizq {
	text-align: left;
}
.tble {
	text-align: right;
}
.tbl2 {
	text-align: left;
}
-->
    </style>
	</head>
    <link href="styles.css" rel="stylesheet" type="text/css" />

<body bgcolor="#ffffff" class="fondo">
	<table width="64" border="0" cellspacing="0" cellpadding="0">
			<tr>
			  <td class="tituloNormal2"><font size="2" face="Tahoma"><strong><?php echo $vessel; ?></strong></font></td>
		  </tr>
			<tr>
			  <td><font size="2"   face="Tahoma"><strong><?php echo $fquantity; ?>  <?php echo $cargotype; ?></strong></font></td>
			</tr>
			<tr>
				<td>
				<?php if($secondport!="")	{
				?>
<table width="394" border="0" cellspacing="2" cellpadding="0">
						<tr>
							<td width="228"  ><span ><font size="2"   face="Tahoma"><strong>LOADING PORT:</strong></font></span></td>
							<td width="160" align="left"><span ><font size="2" face="Tahoma"><?php echo $puertodecarga;?></font></span></td>
						</tr>
						<tr>
							<td  ><span ><font size="2"   face="Tahoma"><strong>SAILED:</strong></font></span></td>
							<td align="left"><span ><font size="2" face="Tahoma"><?php echo $sailed;?></font></span></td>
						</tr>
						<tr>
							<td  ><span ><font size="2"   face="Tahoma"><strong>TOTAL SHIPMENT:</strong></font></span></td>
							<td align="left"><span ><font size="2" face="Tahoma"><?php echo $fquantity;?></font></span></td>
						</tr>
						<tr>
							<td  ><span ><font size="2"   face="Tahoma"><strong>FIRST DISCHARGING PORT:</strong></font></span></td>
							<td align="left"><span ><font size="2" face="Tahoma"><?php echo $firstport;?></font></span></td>
						</tr>
						<tr>
							<td  ><span ><font size="2"   face="Tahoma"><strong>TOTAL PARCEL AT <?php echo $firstport; ?>: </strong></font></span></td>
							<td align="left"><span ><font size="2" face="Tahoma"><?php echo $totalparcelfirst;?></font></span></td>
						</tr>
						<tr>
							<td  ><span ><font size="2"   face="Tahoma"><strong>MAXIMUM ARRIVAL DRAFT:</strong></font></span></td>
							<td align="left"><span ><font size="2" face="Tahoma"><?php echo $madfirst;?><strong>MTS</strong></font></span></td>
						</tr>
						<tr>
							<td  ><span ><font size="2"   face="Tahoma"><strong>SECOND DISCHARGING PORT:</strong></font></span></td>
							<td align="left"><span ><font size="2" face="Tahoma"><?php echo $secondport;?></font></span></td>
						</tr>
						<tr>
							<td  ><span ><font size="2"   face="Tahoma"><strong>TOTAL PARCEL:</strong></font></span></td>
							<td align="left"><span ><font size="2" face="Tahoma"><?php echo $totalparcelsecond;?></font></span></td>
						</tr>
						<tr>
							<td  ><span ><font size="2"   face="Tahoma"><strong>MAXIMUM ARRIVAL DRAFT: </strong></font></span></td>
							<td align="left"><span ><font size="2" face="Tahoma"><?php echo $madsecond;?><strong>MTS</strong></font></span></td>
						</tr>
                        <?php if($thirdport!="")	{
							?>
                            <tr>
							<td  ><span ><font size="2"   face="Tahoma"><strong>THIRD DISCHARGING PORT:</strong></font></span></td>
							<td align="left"><span ><font size="2" face="Tahoma"><?php echo $thirdport;?></font></span></td>
						</tr>
						<tr>
							<td  ><span ><font size="2"   face="Tahoma"><strong>TOTAL PARCEL:</strong></font></span></td>
							<td align="left"><span ><font size="2" face="Tahoma"><?php echo $totalparcelthird;?></font></span></td>
						</tr>
						<tr>
							<td  ><span ><font size="2"   face="Tahoma"><strong>MAXIMUM ARRIVAL DRAFT: </strong></font></span></td>
							<td align="left"><span ><font size="2" face="Tahoma"><?php echo $madthird;?><strong>MTS</strong></font></span></td>
						</tr>
                            <?php
						}
						?>
				  </table>
					<?php
					} else {
					?>
<table width="394" border="0" cellspacing="2" cellpadding="0">
						<tr>
							<td width="228" align="left"  ><font size="2"   face="Tahoma"><strong>LOADING PORT:</strong></font></td>
							<td width="160" align="left" ><font size="2" face="Tahoma"><?php echo $puertodecarga;?></font></td>
						</tr>
						<tr>
							<td align="left"  ><font size="2"   face="Tahoma"><strong>SAILED:</strong></font></td>
							<td align="left" ><font size="2" face="Tahoma"><?php echo $sailed;?></font></td>
						</tr>
						<tr>
							<td align="left"  ><font size="2"   face="Tahoma"><strong>TOTAL SHIPMENT:</strong></font></td>
							<td align="left" ><font size="2" face="Tahoma"><?php echo $fquantity;?></font></td>
						</tr>
						<tr>
							<td align="left"  ><font size="2"   face="Tahoma"><strong>DISCHARGE PORT:</strong></font></td>
							<td align="left" ><font size="2" face="Tahoma"><?php echo $firstport;?></font></td>
						</tr>
						<tr>
							<td align="left"  ><font size="2"   face="Tahoma"><strong>MAXIMUM ARRIVAL DRAFT:</strong></font></td>
							<td align="left" ><font size="2" face="Tahoma"><?php echo $madfirst;?><strong>MTS</strong></font></td>
						</tr>
				  </table>
					<?php
					}
					?>
			  </td>
			</tr>
</table>
	<font size="2" face="Tahoma"><?php echo nl2br($notes); ?></font>
<br />
    <font size="2.5" color="#0183bf" face="Tahoma"><strong>MAIN DETAILS OF THE VESSEL INFORMED:</strong></font><br/>        
	<table width="429" border="0" cellspacing="2" cellpadding="0">
		  <tr>
				<td width="65"><span ><font size="2"   face="Tahoma"><strong>NAME:</strong></font></span></td>
			<td width="141"><span ><font size="2" face="Tahoma"><strong><?php echo $vessel; ?></strong></font></span></td>
				<td width="103"><span ><font size="2"   face="Tahoma"><strong>FLAG:</strong></font></span></td>
				<td width="110"><span ><font size="2" face="Tahoma"><strong><?php echo $flag; ?></strong></font></span></td>
	  </tr>
			<tr>
				<td   ><span ><font size="2"   face="Tahoma"><strong>IMO:</strong></font></span></td>
			  <td align="left" class="tbl2"><span ><font size="2" face="Tahoma"><?php echo $imo; ?></font></span></td>
				<td   ><span ><font size="2"   face="Tahoma"><strong>CALL SIGN:</strong></font></span></td>
				<td align="left" class="tbl2"><span ><font size="2" face="Tahoma"><?php echo $callsign; ?></font></span></td>
			</tr>
			<tr>
				<td   ><span ><font size="2"   face="Tahoma"><strong>DWT:</strong></font></span></td>
			  <td align="left" class="tbl2"><span ><font size="2" face="Tahoma"><?php echo $dwt; ?></font></span></td>
				<td   ><span ><font size="2"   face="Tahoma"><strong>BUILT:</strong></font></span></td>
				<td align="left" class="tbl2"><span ><font size="2" face="Tahoma"><?php echo $built; ?></font></span></td>
			</tr>
			<tr>
				<td   ><span ><font size="2"   face="Tahoma"><strong>BEAM:</strong></font></span></td>
			  <td align="left" class="tbl2"><span ><font size="2" face="Tahoma"><?php echo $beam; ?></font></span></td>
				<td   ><span ><font size="2"   face="Tahoma"><strong>LOA:</strong></font></span></td>
				<td align="left" class="tbl2"><span ><font size="2" face="Tahoma"><?php echo $loa; ?></font></span></td>
			</tr>
			<tr>
				<td   ><span ><font size="2"   face="Tahoma"><strong>GRT:</strong></font></span></td>
			  <td align="left" class="tbl2"><span ><font size="2" face="Tahoma"><?php echo $grt; ?></font></span></td>
				<td   ><span ><font size="2"   face="Tahoma"><strong>NRT:</strong></font></span></td>
				<td align="left" class="tbl2"><span ><font size="2" face="Tahoma"><?php echo $nrt; ?></font></span></td>
			</tr>
			<tr>
				<td   ><span ><font size="2"   face="Tahoma"><strong>H/H</strong></font></span></td>
			  <td align="left" class="tbl2"><span ><font size="2" face="Tahoma"><?php echo $hh; ?></font></span></td>
				<td   ><span ><font size="2"   face="Tahoma"><strong>CRANES:</strong></font></span></td>
				<td align="left" class="tbl2"><span ><font size="2" face="Tahoma"><?php echo $cranes; ?></font></span></td>
			</tr>
	</table>
    <?php
	$mostrar=false;
	$query="select * from pesobodega where id='".$id."'";
			$result = mysql_query($query, $link);
			while($row = mysql_fetch_array($result)){
				$mostrar=true;
			}
	if($mostrar)	{
	?>
	<font size="2.5" color="#0183bf" face="Tahoma"><strong>STOWAGE PLAN:</strong></font>
<table width="324" border="0" cellspacing="4" cellpadding="0">
			<tr>
				<td width="102" ><font size="2"   face="Tahoma"><strong>HOLD</strong></font></td>
				<td width="128" ><font size="2"   face="Tahoma"><strong>CARGO</strong></font></td>
                <?php if($secondport!="")	{ ?>
                <td width="86" ><font size="2"   face="Tahoma"><strong><?php echo $firstport;?></strong></font></td>
                <td width="86" ><font size="2"   face="Tahoma"><strong><?php echo $secondport;?></strong></font></td>
                 <?php if($thirdport!="")	{
					?>
                    <td width="86" ><font size="2"   face="Tahoma"><strong><?php echo $thirdport;?></strong></font></td>
                    <?php
				}
					?>
                <td width="86" ><font size="2"   face="Tahoma"><strong>TTL</strong></font></td>
        <?php } else {?>
				<td width="86" ><font size="2"   face="Tahoma"><strong>TONNAGE</strong></font></td>
                <?php }?>
			</tr>
			<?php
			
			/////////////REPORTE GENERAL DE DESCARGA POR BODEGAS
			$totales=array(0,0,0);

						
			//$query="select distinct bodega from chargeinformation where id='".$id."'";
			$query="select bodega, pesototal, abreviacion, cantidad1, cantidad2, cantidad3 from pesobodega where id='".$id."' order by bodega";
			$result = mysql_query($query, $link);
			
			$i=0.000;
			$j=0.000;
			$k=0.000;
			while($row = mysql_fetch_array($result)){
			//$cargo=str_replace(",", "", $row["pesototal"]);
			$cantidad1=str_replace(",", "", $row["cantidad1"]);
			$cantidad2=str_replace(",", "", $row["cantidad2"]);
			$cantidad3=str_replace(",", "", $row["cantidad3"]);
			$cargo=$cantidad1+$cantidad2+$cantidad3;
			$i+=$cargo;
			$j+=$cantidad1;
			$k+=$cantidad2;
			$l+=$cantidad3;
			?>
			<tr>
					<td ><span ><font size="2"   face="Tahoma"><strong><?php echo $row["bodega"];?></strong></font></span></td>
					<td>
<div align="left">
						<span ><font size="2" face="Tahoma"><?php echo $row["abreviacion"];?></font></span></div>
				</td>
                <?php if($secondport!="")	{ ?>
				<td>
<div align="left"><span ><font size="2" face="Tahoma"><?php printf("%.3f", $cantidad1);?></font></span></div>
				</td>                
                <td>
<div align="left"><font size="2" face="Tahoma"><?php printf("%.3f", $cantidad2);?></font></div>
				</td>
                <?php } ?>
                <?php if($thirdport!="")	{
					?>
                    <td>
				<div align="left"><font size="2" face="Tahoma"><?php printf("%.3f", $cantidad3);?></font></div>
				</td>
                    <?php
				}
					?>
                <td>
<div align="left"><font size="2" face="Tahoma"><?php printf("%.3f", $cargo);?></font></div>
				</td>                
			</tr>
			<?php
			}
			
			?>
						
			<tr>
				<td ><span ><font size="2"   face="Tahoma"><strong>TTL</strong></font></span></td>
				<td>
					<div >
				  </div>
				</td>
                <?php if($secondport!="")	{ ?>
				<td>
<div align="left"><font size="2" face="Tahoma"><strong><?php printf("%.3f", $j); ?></strong></font></div>
				</td>
                
                <td>
<div align="left"><span ><font size="2" face="Tahoma"><strong><?php printf("%.3f", $k); ?></strong></font></span></div>
				</td>
                <?php } ?>
                <?php if($thirdport!="")	{
					?>
                    <td>
				<div align="left"><span ><font size="2" face="Tahoma"><strong><?php printf("%.3f", $l); ?></strong></font></span></div>
				</td>
                    <?php
				}
					?>
                <td>
<div align="left"><span ><font size="2" face="Tahoma"><strong><?php printf("%.3f", $i); ?></strong></font></span></div>
				</td>
                
      </tr>
	</table>
    <?php
    } ?>
    <p><font size="2.5" color="#0183bf" face="Tahoma"><strong>GENERAL COMENTS</strong></font>
      <br />
      <font size="2" face="Tahoma"><?php echo nl2br($weather); ?></font><br />
      <font size="-2">Powered in association  by TWIN MARINE DE MEXICO, S.A. DE C.V.  and  DAKA Technology. &lt;&lt;Copyright © 2009-2010 All Rights Reserved&gt;&gt;</font></p>
</body>

</html>