<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<?php
include("conexion.php");
$link = Conectar();
$id=$_GET["id"];


$table = "operaciones o, pagos p";
$query="select o.vessel, o.builders, o.puerto, o.noviaje, eosp, unbertedfromthepier, valorpda, anticiposrecibidos, tipodecambio, valorfpda, tipodecambio2, diferencianuestra, diferenciafavorprincipal, fechaenviodeefa, mensajeria, fechapagoarmador, importe, fechadevolucionarmador, importe2 from $table where (o.id='$id' and p.id='$id')";

//echo $query;
$result = mysql_query($query, $link);
while($row = mysql_fetch_array($result)){
$BUQUE=$row["vessel"];
$ARMADOR=$row["builders"];
$VIAJE=$row["noviaje"];
$PUERTO=$row["puerto"];
$FECHAENTRADA=$row["eosp"];
$FECHASALIDA=$row["unbertedfromthepier"];
$VALORPDA=$row["valorpda"];
$ANTICIPOSRECIBIDOS=$row["anticiposrecibidos"];
$TIPODECAMBIO=$row["tipodecambio"];
$VALORFPDA=$row["valorfpda"];
$TIPODECAMBIO2=$row["tipodecambio2"];
$DIFERENCIANUESTRA=$row["diferencianuestra"];
$DIFERENCIAPRINCIPAL=$row["diferenciaprincipal"];
$FECHADEENVIODEEFA=$row["fechaenviodeefa"];
$MENSAJERIA=$row["mensajeria"];
$FECHADEPAGOARMADOR=$row["fechapagoarmador"];
$IMPORTE=$row["importe"];
$FECHADEVOLUCIONARMADOR=$row["fechadevolucion"];
$IMPORTE2=$row["importe2"];


}

?>

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta name="generator" content="Adobe GoLive" />
		<title>Detalle de anticipos</title>
		<link href="css/basic.css" rel="stylesheet" type="text/css" media="all" />
	</head>

	<body bgcolor="#ffffff">
		<div align="center">
			<table width="230" border="1" cellspacing="2" cellpadding="0">
				<tr>
					<td bgcolor="#eeede5">
						<div align="center">
							<img src="logo.jpg" alt="" width="385" height="120" border="0" />
							<hr />
							<table width="396" border="1" cellspacing="2" cellpadding="0">
								<tr>
									<td bgcolor="#0183bf"><font face="Tahoma"><font size="2" color="white" face="Tahoma"><strong>BUQUE</strong></font></font></td>
									<td bgcolor="white">
										<div align="right">
											<font size="2" face="Tahoma"><strong><?php echo $BUQUE; ?></strong></font></div>
									</td>
								</tr>
								<tr>
									<td bgcolor="#0183bf"><font face="Tahoma"><font size="2" color="white" face="Tahoma"><strong>ARMADOR</strong></font></font></td>
									<td bgcolor="white">
										<div align="right">
											<font size="2" face="Tahoma"><strong><?php echo $ARMADOR; ?></strong></font></div>
									</td>
								</tr>
								<tr>
									<td bgcolor="#0183bf"><font face="Tahoma"><font size="2" color="white" face="Tahoma"><strong>VIAJE</strong></font></font></td>
									<td bgcolor="white">
										<div align="right">
											<font size="2" face="Tahoma"><strong><?php echo $VIAJE; ?></strong></font></div>
									</td>
								</tr>
								<tr>
									<td bgcolor="#0183bf"><font face="Tahoma"><font size="2" color="white" face="Tahoma"><strong>PUERTO</strong></font></font></td>
									<td bgcolor="white">
										<div align="right">
											<font size="2" face="Tahoma"><strong><?php echo $PUERTO; ?></strong></font></div>
									</td>
								</tr>
								<tr>
									<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>FECHA DE ENTRADA</strong></font></td>
									<td bgcolor="white">
										<div align="right">
											<font size="2" face="Tahoma"><strong><?php echo $FECHAENTRADA; ?></strong></font></div>
									</td>
								</tr>
								<tr>
									<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>FECHA DE SALIDA</strong></font></td>
									<td bgcolor="white">
										<div align="right">
											<font size="2" face="Tahoma"><strong><?php echo $FECHASALIDA; ?></strong></font></div>
									</td>
								</tr>
								<tr>
									<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>VALOR DE PDA</strong></font></td>
									<td bgcolor="white">
										<div align="right">
											<font size="2" face="Tahoma"><strong><?php echo $VALORPDA; ?></strong></font></div>
									</td>
								</tr>
								<tr>
									<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>ANTICIPOS RECIBIDOS</strong></font></td>
									<td bgcolor="white">
										<div align="right">
											<font size="2" face="Tahoma"><strong><?php echo $ANTICIPOSRECIBIDOS; ?></strong></font></div>
									</td>
								</tr>
								<tr>
									<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>TIPO DE CAMBIO</strong></font></td>
									<td bgcolor="white">
										<div align="right">
											<font size="2" face="Tahoma"><strong><?php echo $TIPODECAMBIO; ?></strong></font></div>
									</td>
								</tr>
								<tr>
									<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>VALOR FPDA</strong></font></td>
									<td bgcolor="white">
										<div align="right">
											<font size="2" face="Tahoma"><strong><?php echo $VALORFPDA; ?></strong></font></div>
									</td>
								</tr>
								<tr>
									<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>TIPO DE CAMBIO</strong></font></td>
									<td bgcolor="white">
										<div align="right">
											<font size="2" face="Tahoma"><strong><?php echo $TIPODECAMBIO2; ?></strong></font></div>
									</td>
								</tr>
								<tr>
									<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>DIFERENCIA NUESTRA</strong></font></td>
									<td bgcolor="white">
										<div align="right">
											<font size="2" face="Tahoma"><strong><?php echo $DIFERENCIANUESTRA; ?></strong></font></div>
									</td>
								</tr>
								<tr>
									<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>DIFERENCIA FAVOR PRINCIPAL</strong></font></td>
									<td bgcolor="white">
										<div align="right">
											<font size="2" face="Tahoma"><strong><?php echo $DIFERENCIAPRINCIPAL; ?></strong></font></div>
									</td>
								</tr>
								<tr>
									<td bgcolor="#0183bf"><font face="Tahoma"><font size="2" color="white" face="Tahoma"><strong>FECHA DE ENVIO DE EFA</strong></font></font></td>
									<td bgcolor="white">
										<div align="right">
											<font size="2" face="Tahoma"><strong><?php echo $FECHADEENVIODEEFA; ?></strong></font></div>
									</td>
								</tr>
								<tr>
									<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>MENSAJERIA</strong></font></td>
									<td bgcolor="white">
										<div align="right">
											<font size="2" face="Tahoma"><strong><?php echo $MENSAJERIA; ?></strong></font></div>
									</td>
								</tr>
								<tr>
									<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>FECHA DE PAGO ARMADOR</strong></font></td>
									<td bgcolor="white">
										<div align="right">
											<font size="2" face="Tahoma"><strong><?php echo $FECHADEPAGOARMADOR; ?></strong></font></div>
									</td>
								</tr>
								<tr>
									<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>IMPORTE</strong></font></td>
									<td bgcolor="white">
										<div align="right">
											<font size="2" face="Tahoma"><strong><?php echo $IMPORTE; ?></strong></font></div>
									</td>
								</tr>
								<tr>
									<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>FECHA DEVOLUCION ARMADOR</strong></font></td>
									<td bgcolor="white">
										<div align="right">
											<font size="2" face="Tahoma"><strong><?php echo $FECHADEVOLUCIONARMADOR; ?></strong></font></div>
									</td>
								</tr>
								<tr>
									<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>IMPORTE</strong></font></td>
									<td bgcolor="white">
										<div align="right">
											<font size="2" face="Tahoma"><strong><?php echo $IMPORTE2; ?></strong></font></div>
									</td>
								</tr>
							</table>
							<hr />
							<p><font size="4" face="Tahoma"><strong>ANTICIPOS</strong></font></p>
							<table width="556" border="1" cellspacing="2" cellpadding="0">
								<tr>
									<td bgcolor="#0183bf">
										<div align="center">
											<font size="2" color="white" face="Tahoma"><strong>FECHA</strong></font></div>
									</td>
									<td bgcolor="#0183bf">
										<div align="center">
											<font size="2" color="white" face="Tahoma"><strong>CANTIDAD</strong></font></div>
									</td>
									<td bgcolor="#0183bf">
										<div align="center">
											<font size="2" color="white" face="Tahoma"><strong>TIPO DE CAMBIO</strong></font></div>
									</td>
									<td bgcolor="#0183bf">
										<div align="center">
											<font size="2" color="white" face="Tahoma"><strong>CANTIDAD M.N.</strong></font></div>
									</td>
								</tr>
							<?php
							$table = "anticipos";
							$query="select fecha, cantidad, tipodecambio, cantidadmn from $table where id='$id'";

							$result = mysql_query($query, $link);
							while($row = mysql_fetch_array($result)){
								?>
								<tr>
									<td bgcolor="white"><?php echo $row["fecha"]; ?></td>
									<td bgcolor="white"><?php echo $row["cantidad"]; ?></td>
									<td bgcolor="white"><?php echo $row["tipodecambio"]; ?></td>
									<td bgcolor="white"><?php echo $row["cantidadmn"]; ?></td>
								</tr>
								<?php
							}
							?>
							</table>
							<p></p>
						</div>
					</td>
				</tr>
			</table>
		<font size="-2">Powered in association  by TWIN MARINE DE MEXICO, S.A. DE C.V.  and  DAKA Technology. &lt;&lt;Copyright © 2009-2010 All Rights Reserved&gt;&gt;</font> </div>
	</body>

</html>