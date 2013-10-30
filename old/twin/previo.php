<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<?php

include("conexion.php");
$id=$_GET["id"];

$aaa="Location: ../asistente/previo2.php?id=".$id;
header($aaa);
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

<body bgcolor="#ffffff" class="body">
		<img src="logox.jpg" alt="" width="264" height="83" border="0" />
	<table width="64" border="0" cellspacing="0" cellpadding="0">
			<tr>
			  <td><font size="2" face="Tahoma"><strong><?php echo $vessel; ?></strong></font></td>
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
							<td class="tablaizq" ><span class="tablaizq"><font size="2"   face="Tahoma"><strong>LOADING PORT:</strong></font></span></td>
							<td align="left"><span class="tablaizq"><font size="2" face="Tahoma"><?php echo $puertodecarga;?></font></span></td>
						</tr>
						<tr>
							<td class="tablaizq" ><span class="tablaizq"><font size="2"   face="Tahoma"><strong>SAILED:</strong></font></span></td>
							<td align="left"><span class="tablaizq"><font size="2" face="Tahoma"><?php echo $sailed;?></font></span></td>
						</tr>
						<tr>
							<td class="tablaizq" ><span class="tablaizq"><font size="2"   face="Tahoma"><strong>TOTAL SHIPMENT:</strong></font></span></td>
							<td align="left"><span class="tablaizq"><font size="2" face="Tahoma"><?php echo $fquantity;?></font></span></td>
						</tr>
						<tr>
							<td class="tablaizq" ><span class="tablaizq"><font size="2"   face="Tahoma"><strong>FIRST DISCHARGING PORT:</strong></font></span></td>
							<td align="left"><span class="tablaizq"><font size="2" face="Tahoma"><?php echo $firstport;?></font></span></td>
						</tr>
						<tr>
							<td class="tablaizq" ><span class="tablaizq"><font size="2"   face="Tahoma"><strong>TOTAL PARCEL AT <?php echo $firstport; ?>: </strong></font></span></td>
							<td align="left"><span class="tablaizq"><font size="2" face="Tahoma"><?php echo $totalparcelfirst;?></font></span></td>
						</tr>
						<tr>
							<td class="tablaizq" ><span class="tablaizq"><font size="2"   face="Tahoma"><strong>MAXIMUM ARRIVAL DRAFT:</strong></font></span></td>
							<td align="left"><span class="tablaizq"><font size="2" face="Tahoma"><?php echo $madfirst;?><strong>MTS</strong></font></span></td>
						</tr>
						<tr>
							<td class="tablaizq" ><span class="tablaizq"><font size="2"   face="Tahoma"><strong>SECOND DISCHARGING PORT:</strong></font></span></td>
							<td align="left"><span class="tablaizq"><font size="2" face="Tahoma"><?php echo $secondport;?></font></span></td>
						</tr>
						<tr>
							<td class="tablaizq" ><span class="tablaizq"><font size="2"   face="Tahoma"><strong>TOTAL PARCEL:</strong></font></span></td>
							<td align="left"><span class="tablaizq"><font size="2" face="Tahoma"><?php echo $totalparcelsecond;?></font></span></td>
						</tr>
						<tr>
							<td class="tablaizq" ><span class="tablaizq"><font size="2"   face="Tahoma"><strong>MAXIMUM ARRIVAL DRAFT: </strong></font></span></td>
							<td align="left"><span class="tablaizq"><font size="2" face="Tahoma"><?php echo $madsecond;?><strong>MTS</strong></font></span></td>
						</tr>
				  </table>
					<?php
					} else {
					?>
<table width="394" border="0" cellspacing="2" cellpadding="0">
						<tr>
							<td align="left" class="tablaizq" ><font size="2"   face="Tahoma"><strong>LOADING PORT:</strong></font></td>
							<td align="left" class="tablaizq"><font size="2" face="Tahoma"><?php echo $puertodecarga;?></font></td>
						</tr>
						<tr>
							<td align="left" class="tablaizq" ><font size="2"   face="Tahoma"><strong>SAILED:</strong></font></td>
							<td align="left" class="tablaizq"><font size="2" face="Tahoma"><?php echo $sailed;?></font></td>
						</tr>
						<tr>
							<td align="left" class="tablaizq" ><font size="2"   face="Tahoma"><strong>TOTAL SHIPMENT:</strong></font></td>
							<td align="left" class="tablaizq"><font size="2" face="Tahoma"><?php echo $fquantity;?></font></td>
						</tr>
						<tr>
							<td align="left" class="tablaizq" ><font size="2"   face="Tahoma"><strong>DISCHARGE PORT:</strong></font></td>
							<td align="left" class="tablaizq"><font size="2" face="Tahoma"><?php echo $firstport;?></font></td>
						</tr>
						<tr>
							<td align="left" class="tablaizq" ><font size="2"   face="Tahoma"><strong>MAXIMUM ARRIVAL DRAFT:</strong></font></td>
							<td align="left" class="tablaizq"><font size="2" face="Tahoma"><?php echo $madfirst;?><strong>MTS</strong></font></td>
						</tr>
				  </table>
					<?php
					}
					?>
			  </td>
			</tr>
</table>
	<font size="2" face="Tahoma"><?php echo $notes; ?></font>
<br />
    <font size="2.5" color="#0183bf" face="Tahoma"><strong>MAIN DETAILS OF THE VESSEL INFORMED:</strong></font><br/>        
	<table width="406" border="0" cellspacing="2" cellpadding="0">
		  <tr>
				<td align="right" class="tble" ><span class="tablaizq"><font size="2"   face="Tahoma"><strong>NAME:</strong></font></span></td>
			<td align="left" class="tbl2"><span class="tablaizq"><font size="2" face="Tahoma"><strong><?php echo $vessel; ?></strong></font></span></td>
				<td align="right" class="tble" ><span class="tablaizq"><font size="2"   face="Tahoma"><strong>FLAG:</strong></font></span></td>
				<td align="left" class="tbl2"><span class="tablaizq"><font size="2" face="Tahoma"><strong><?php echo $flag; ?></strong></font></span></td>
	  </tr>
			<tr>
				<td align="right" class="tble" ><span class="tablaizq"><font size="2"   face="Tahoma"><strong>IMO:</strong></font></span></td>
			  <td align="left" class="tbl2"><span class="tablaizq"><font size="2" face="Tahoma"><?php echo $imo; ?></font></span></td>
				<td align="right" class="tble" ><span class="tablaizq"><font size="2"   face="Tahoma"><strong>CALL SIGN:</strong></font></span></td>
				<td align="left" class="tbl2"><span class="tablaizq"><font size="2" face="Tahoma"><?php echo $callsign; ?></font></span></td>
			</tr>
			<tr>
				<td align="right" class="tble" ><span class="tablaizq"><font size="2"   face="Tahoma"><strong>DWT:</strong></font></span></td>
			  <td align="left" class="tbl2"><span class="tablaizq"><font size="2" face="Tahoma"><?php echo $dwt; ?></font></span></td>
				<td align="right" class="tble" ><span class="tablaizq"><font size="2"   face="Tahoma"><strong>BUILT:</strong></font></span></td>
				<td align="left" class="tbl2"><span class="tablaizq"><font size="2" face="Tahoma"><?php echo $built; ?></font></span></td>
			</tr>
			<tr>
				<td align="right" class="tble" ><span class="tablaizq"><font size="2"   face="Tahoma"><strong>BEAM:</strong></font></span></td>
			  <td align="left" class="tbl2"><span class="tablaizq"><font size="2" face="Tahoma"><?php echo $beam; ?></font></span></td>
				<td align="right" class="tble" ><span class="tablaizq"><font size="2"   face="Tahoma"><strong>LOA:</strong></font></span></td>
				<td align="left" class="tbl2"><span class="tablaizq"><font size="2" face="Tahoma"><?php echo $loa; ?></font></span></td>
			</tr>
			<tr>
				<td align="right" class="tble" ><span class="tablaizq"><font size="2"   face="Tahoma"><strong>GRT:</strong></font></span></td>
			  <td align="left" class="tbl2"><span class="tablaizq"><font size="2" face="Tahoma"><?php echo $grt; ?></font></span></td>
				<td align="right" class="tble" ><span class="tablaizq"><font size="2"   face="Tahoma"><strong>NRT:</strong></font></span></td>
				<td align="left" class="tbl2"><span class="tablaizq"><font size="2" face="Tahoma"><?php echo $nrt; ?></font></span></td>
			</tr>
			<tr>
				<td align="right" class="tble" ><span class="tablaizq"><font size="2"   face="Tahoma"><strong>H/H</strong></font></span></td>
			  <td align="left" class="tbl2"><span class="tablaizq"><font size="2" face="Tahoma"><?php echo $hh; ?></font></span></td>
				<td align="right" class="tble" ><span class="tablaizq"><font size="2"   face="Tahoma"><strong>CRANES:</strong></font></span></td>
				<td align="left" class="tbl2"><span class="tablaizq"><font size="2" face="Tahoma"><?php echo $cranes; ?></font></span></td>
			</tr>
	</table>
	<font size="2.5" color="#0183bf" face="Tahoma"><strong>STOWAGE PLAN:</strong></font>
<table width="324" border="0" cellspacing="4" cellpadding="0">
			<tr>
				<td width="102" ><font size="2"   face="Tahoma"><strong>HOLD</strong></font></td>
				<td width="128" ><font size="2"   face="Tahoma"><strong>CARGO</strong></font></td>
                <?php if($secondport!="")	{ ?>
                <td width="86" ><font size="2"   face="Tahoma"><strong><?php echo $firstport;?></strong></font></td>
                <td width="86" ><font size="2"   face="Tahoma"><strong><?php echo $secondport;?></strong></font></td>
                <td width="86" ><font size="2"   face="Tahoma"><strong>TTL</strong></font></td>
        <?php } else {?>
				<td width="86" ><font size="2"   face="Tahoma"><strong>TONNAGE</strong></font></td>
                <?php }?>
			</tr>
			<?php
			
			/////////////REPORTE GENERAL DE DESCARGA POR BODEGAS
			$totales=array(0,0,0);

						
			//$query="select distinct bodega from chargeinformation where id='".$id."'";
			$query="select bodega, pesototal, abreviacion, cantidad1, cantidad2 from pesobodega where id='".$id."' order by bodega";
			$result = mysql_query($query, $link);
			
			$i=0.000;
			$j=0.000;
			$k=0.000;
			while($row = mysql_fetch_array($result)){
			$cargo=str_replace(",", "", $row["pesototal"]);
			$cantidad1=str_replace(",", "", $row["cantidad1"]);
			$cantidad2=str_replace(",", "", $row["cantidad2"]);
			$i+=$cargo;
			$j+=$cantidad1;
			$k+=$cantidad2;
			?>
			<tr>
					<td ><span class="tablaizq"><font size="2"   face="Tahoma"><strong><?php echo $row["bodega"];?></strong></font></span></td>
					<td>
<div align="left">
						<span class="tablaizq"><font size="2" face="Tahoma"><?php echo $row["abreviacion"];?></font></span></div>
				</td>
                <?php if($secondport!="")	{ ?>
				<td>
<div align="left"><span class="tablaizq"><font size="2" face="Tahoma"><?php printf("%.3f", $cantidad1);?></font></span></div>
				</td>                
                <td>
<div align="left"><font size="2" face="Tahoma"><?php printf("%.3f", $cantidad2);?></font></div>
				</td>
                <?php } ?>
                <td>
<div align="left"><font size="2" face="Tahoma"><?php printf("%.3f", $cargo);?></font></div>
				</td>                
			</tr>
			<?php
			}
			
			?>
						
			<tr>
				<td ><span class="tablaizq"><font size="2"   face="Tahoma"><strong>TTL</strong></font></span></td>
				<td>
					<div align="right">
				  </div>
				</td>
                <?php if($secondport!="")	{ ?>
				<td>
<div align="left"><font size="2" face="Tahoma"><strong><?php printf("%.3f", $j); ?></strong></font></div>
				</td>
                
                <td>
<div align="left"><span class="tablaizq"><font size="2" face="Tahoma"><strong><?php printf("%.3f", $k); ?></strong></font></span></div>
				</td>
                <?php } ?>
                <td>
<div align="left"><span class="tablaizq"><font size="2" face="Tahoma"><strong><?php printf("%.3f", $i); ?></strong></font></span></div>
				</td>
                
      </tr>
	</table>
    <p><font size="2.5" color="#0183bf" face="Tahoma"><strong>GENERAL COMENTS</strong></font>
      <br />
      <font size="2" face="Tahoma"><?php echo $weather; ?></font>
      </p>
    </p>
    <p><font size="-2">Powered in association  by TWIN MARINE DE MEXICO, S.A. DE C.V.  and  DAKA Technology. &lt;&lt;Copyright © 2009-2010 All Rights Reserved&gt;&gt;</font></p>
</body>

</html>