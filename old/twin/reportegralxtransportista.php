<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<?php
include("conexion.php");
$link = Conectar();
$id=$_GET["id"];
$fecha=date("r");
$transportista=$_GET["transportista"];

$table = "operaciones";
$fields="vessel, flag";


$table = "movimientos";
$fields="transportista, chofer, placas, placasremolque, eco, destino, producto, cartaporte, ticketbascula,
	pesobruto, pesoneto, pesotara, sacos, llegada, salida";
$query="select $fields from $table where id='$id'";

$table = "operaciones";
$fields="vessel, flag, eosp, unbertedfromthepier";
$query="select $fields from $table where id='$id'";
$result = mysql_query($query, $link);
while($row = mysql_fetch_array($result)){
$barco=$row["vessel"];
$flag=$row["flag"];
$fechadearrivo=$row["eosp"];
$fechaterminacion=$row["unbertedfromthepier"];

}

?>

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta name="generator" content="Adobe GoLive" />
		<title>Reporte General de Supervision</title>
		<link href="css/basic.css" rel="stylesheet" type="text/css" media="all" />
	</head>

	<body bgcolor="#ffffff">
		<table width="917" border="1" cellspacing="2" cellpadding="0">
			<tr>
				<td bgcolor="#0183bf">
					<div align="center">
						<font size="+3" color="white" face="Tahoma"><strong>REPORTE DE SUPERVISION POR TRANSPORTISTA</strong></font></div>
				</td>
			</tr>
		</table>
		<table width="854" border="1" cellspacing="2" cellpadding="0">
			<tr>
				<td bgcolor="#eeede5">
					<div align="center">
						<table width="597" border="0" cellspacing="2" cellpadding="0">
							<tr>
								<td><?php echo $buque;?></td>
								<td><?php echo $flag; ?></td>
							</tr>
						</table>
						<table width="493" border="1" cellspacing="2" cellpadding="0">
							<tr>
								<td><img src="logo.jpg" alt="" width="385" height="120" border="0" />
									<table width="151" border="1" cellspacing="2" cellpadding="0">
										<tr>
											<td bgcolor="white"><font face="Tahoma"><strong>VERACRUZ</strong></font></td>
										</tr>
										<tr>
											<td bgcolor="white"><font face="Tahoma"><strong>MEXICO</strong></font></td>
										</tr>
									</table>
								</td>
								<td>
									<table width="508" border="0" cellspacing="2" cellpadding="0">
										<tr>
											<td><font size="2" face="Tahoma"><strong>BUQUE:</strong></font></td>
											<td><input type="text" name="textfieldName" value="<?php echo $buque; ?>" size="40" /></td>
										</tr>
										<tr>
											<td><font size="2" face="Tahoma"><strong>REPORTE DEL DIA:</strong></font></td>
											<td><input type="text" name="textfieldName" value="<?php echo $fecha; ?>" size="40" /></td>
										</tr>
										<tr>
											<td><font size="2" face="Tahoma"><strong>FECHA DE ARRIVO:</strong></font></td>
											<td><input type="text" name="textfieldName" value="<?php echo $fechadearrivo; ?>" size="40" /></td>
										</tr>
										<tr>
											<td><font size="2" face="Tahoma"><strong>FECHA DE TERMINACION:</strong></font></td>
											<td><input type="text" name="textfieldName" value="<?php echo $fechaterminacion; ?>" size="40" /></td>
										</tr>
										<tr>
											<td><font size="2" face="Tahoma"><strong>REEXPEDIDORA:</strong></font></td>
											<td><input type="text" name="textfieldName" value="TWIN MARINE DE MEXICO, S.A. DE C.V." size="40" /></td>
										</tr>
										<tr>
											<td><font size="2" face="Tahoma"><strong>TRANSPORTISTA:</strong></font></td>
											<td><input type="text" name="textfieldName" value="<?php echo $transportista; ?>" size="40" /></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</div>
				</td>
			</tr>
		</table>
		<table width="987" border="1" cellspacing="2" cellpadding="0">
			<tr>
            <td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>Fecha</strong></font></td>
				<td width="43" bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>Bodega</strong></font></td>
				<td width="52" bgcolor="#0183bf"><font face="Tahoma"><font size="2" color="white"><strong>Producto</strong></font></font></td>
				<td width="131" bgcolor="#0183bf"><font face="Tahoma"><font size="2" color="white"><strong>Transportista</strong></font></font></td>
				<td width="38" bgcolor="#0183bf"><font face="Tahoma"><font size="2" color="white"><strong>Chofer</strong></font></font></td>
				<td width="32" bgcolor="#0183bf"><font face="Tahoma"><font size="2" color="white"><strong>Placa</strong></font></font></td>
				<td width="63" bgcolor="#0183bf"><font face="Tahoma"><font size="2" color="white"><strong>Economico</strong></font></font></td>
				<td width="19" bgcolor="#0183bf"><font face="Tahoma"><font size="2" color="white"><strong>C/P</strong></font></font></td>
				<td width="78" bgcolor="#0183bf"><font face="Tahoma"><font size="2" color="white"><strong>Ticket Bascula </strong></font></font></td>
				<td width="41" bgcolor="#0183bf"><font face="Tahoma"><font size="2" color="white"><strong>Peso Bruto</strong></font></font></td>
				<td width="39" bgcolor="#0183bf"><font face="Tahoma"><font size="2" color="white"><strong>Peso Tara</strong></font></font></td>
				<td width="39" bgcolor="#0183bf"><font face="Tahoma"><font size="2" color="white"><strong>Peso Neto</strong></font></font></td>
				<td width="47" bgcolor="#0183bf"><font face="Tahoma"><font size="2" color="white"><strong>Saco/ Granel</strong></font></font></td>
				<td width="68" bgcolor="#0183bf"><font face="Tahoma"><font size="2" color="white"><strong>Llegada Puerto</strong></font></font></td>
				<td width="103" bgcolor="#0183bf"><font face="Tahoma"><font size="2" color="white"><strong>Salida Puerto</strong></font></font></td>
			</tr>
			<?php
			$table = "movimientos";
			$fields="fecha, bodega, producto, transportista, chofer, placas, placasremolque, eco, destino, cartaporte, ticketbascula,
					pesobruto, pesoneto, pesotara, sacos, llegada, salida";
			$query="select $fields from $table where id='$id' and transportista='$transportista'";
			
			$Zmovimientos=0;
			$Zpesobruto=0;
			$Zpesotara=0;
			$Zpesoneto=0;
			$Zsacogranel=0;

			$result = mysql_query($query, $link);
			while($row = mysql_fetch_array($result))	{
			$Zmovimientos++;
			$Zpesobruto+=$row["pesobruto"];
			$Zpesotara+=$row["pesotara"];
			$Zpesoneto+=$row["pesoneto"];
			$Zsacogranel+=$row["sacos"];
			?>
			<tr>
            <td><table width="72" border="0">
              <tr>
                <td><font size="2" face="Tahoma"><?php echo $row["fecha"];?></font></td>
              </tr>
          </table></td>
				<td><font size="2" face="Tahoma"><?php echo $row["bodega"];?></font></td>
				<td><font size="2" face="Tahoma"><?php echo $row["producto"];?></font></td>
				<td><font size="2" face="Tahoma"><?php echo $row["transportista"];?></font></td>
				<td><font size="2" face="Tahoma"><?php echo $row["chofer"];?></font></td>
				<td><font size="2" face="Tahoma"><?php echo $row["placas"];?></font></td>
				<td><font size="2" face="Tahoma"><?php echo $row["eco"];?></font></td>
				<td><font size="2" face="Tahoma"><?php echo $row["cartaporte"];?></font></td>
				<td><font size="2" face="Tahoma"><?php echo $row["ticketbascula"];?></font></td>
				<td><font size="2" face="Tahoma"><?php echo $row["pesobruto"];?></font></td>
				<td><font size="2" face="Tahoma"><?php echo $row["pesotara"];?></font></td>
				<td><font size="2" face="Tahoma"><?php echo $row["pesoneto"];?></font></td>
				<td><font size="2" face="Tahoma"><?php echo $row["sacos"];?></font></td>
				<td><font size="2" face="Tahoma"><?php echo $row["llegada"];?></font></td>
				<td><font size="2" face="Tahoma"><?php echo $row["salida"];?></font></td>
			</tr>
			<?php
			}
			?>
			<tr>
            <td bgcolor="#0183bf"></td>
				<td bgcolor="#0183bf"></td>
				<td bgcolor="#0183bf"></td>
				<td bgcolor="#0183bf"><font color="white" face="Tahoma"><strong>TOT. MOVIMIENTOS:</strong></font></td>
				<td bgcolor="#0183bf"><?php echo $Zmovimientos;?></td>
				<td bgcolor="#0183bf"></td>
				<td bgcolor="#0183bf"></td>
				<td bgcolor="#0183bf"></td>
				<td bgcolor="#0183bf"><font color="white" face="Tahoma"><strong>TOTALES</strong></font></td>
				<td bgcolor="#0183bf"><?php echo number_format( $Zpesobruto, 3);?></td>
				<td bgcolor="#0183bf"><?php echo number_format($Zpesotara, 3);?></td>
				<td bgcolor="#0183bf"><?php echo number_format($Zpesoneto, 3);?></td>
				<td bgcolor="#0183bf"><?php echo number_format($Zsacogranel, 3);?></td>
				<td bgcolor="#0183bf"></td>
				<td bgcolor="#0183bf"></td>
			</tr>
		</table>
		<font size="-2">Powered in association  by TWIN MARINE DE MEXICO, S.A. DE C.V.  and  DAKA Technology. &lt;&lt;Copyright © 2009-2010 All Rights Reserved&gt;&gt;</font>
    </body>

</html>