<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<?php
include("conexion.php");
$link = Conectar();
$id=$_GET["id"];

?>

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta name="generator" content="Adobe GoLive" />
		<title>Reporte General de Supervision</title>
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
							<font size="4" face="Tahoma"><strong>RESUMEN</strong></font>
							<table width="676" border="1" cellspacing="2" cellpadding="0">
								<tr>
								<td bgcolor="#0183bf">
										<div align="center">
											<font face="Tahoma"><font size="2" color="white" face="Tahoma"><strong>ID</strong></font></font></div>
									</td>
									<td bgcolor="#0183bf">
										<div align="center">
											<font face="Tahoma"><font size="2" color="white" face="Tahoma"><strong>BUQUE</strong></font></font></div>
									</td>
									<td bgcolor="#0183bf">
										<div align="center">
											<font face="Tahoma"><font size="2" color="white" face="Tahoma"><strong>ARMADOR</strong></font></font></div>
									</td>
									<td bgcolor="#0183bf">
										<div align="center">
											<font face="Tahoma"><font size="2" color="white" face="Tahoma"><strong>VIAJE</strong></font></font></div>
									</td>
									<td bgcolor="#0183bf">
										<div align="center">
											<font face="Tahoma"><font size="2" color="white" face="Tahoma"><strong>PUERTO</strong></font></font></div>
									</td>
									<td bgcolor="#0183bf">
                                    
										<div align="center">
										  <font size="2" color="white" face="Tahoma"><strong>FECHA DE ENTRADA</strong></font>
										</div>
                                  </td>
									<td bgcolor="#0183bf">
										<div align="center">
										  <font size="2" color="white" face="Tahoma"><strong>FECHA DE SALIDA</strong></font>
                                          </div>
									</td>
									<td bgcolor="#0183bf">
										<div align="center">
											<font size="2" color="white" face="Tahoma"><strong>VALOR DE PDA</strong></font></div>
									</td>
									<td bgcolor="#0183bf">
										<div align="center">
											<font size="2" color="white" face="Tahoma"><strong>ANTICIPOS RECIBIDOS</strong></font></div>
									</td>
									<td bgcolor="#0183bf">
										<div align="center">
											<font size="2" color="white" face="Tahoma"><strong>TIPO DE CAMBIO</strong></font></div>
									</td>
									<td bgcolor="#0183bf">
										<div align="center">
											<font size="2" color="white" face="Tahoma"><strong>VALOR FPDA</strong></font></div>
									</td>
									<td bgcolor="#0183bf">
										<div align="center">
											<font size="2" color="white" face="Tahoma"><strong>TIPO DE CAMBIO</strong></font></div>
									</td>
									<td bgcolor="#0183bf">
										<div align="center">
											<font size="2" color="white" face="Tahoma"><strong>DIFERENCIA NUESTRA</strong></font></div>
									</td>
									<td bgcolor="#0183bf">
										<div align="center">
											<font size="2" color="white" face="Tahoma"><strong>DIFERENCIA FAVOR PRINCIPAL</strong></font></div>
									</td>
									<td bgcolor="#0183bf">
										<div align="center">
											<font size="2" color="white" face="Tahoma"><strong>FECHA ENVIO DE EFA</strong></font></div>
									</td>
									<td bgcolor="#0183bf">
										<div align="center">
											<font size="2" color="white" face="Tahoma"><strong>MENSAJERIA</strong></font></div>
									</td>
									<td bgcolor="#0183bf">
										<div align="center">
											<font size="2" color="white" face="Tahoma"><strong>FECHA DE PAGO ARMADOR</strong></font></div>
									</td>
									<td bgcolor="#0183bf">
										<div align="center">
											<font size="2" color="white" face="Tahoma"><strong>IMPORTE</strong></font></div>
									</td>
									<td bgcolor="#0183bf">
										<div align="center">
											<font size="2" color="white" face="Tahoma"><strong>FECHA DEVOLUCION ARMADOR</strong></font></div>
									</td>
									<td bgcolor="#0183bf">
										<div align="center">
											<font size="2" color="white" face="Tahoma"><strong>IMPORTE</strong></font></div>
									</td>
								</tr>
							<?php
							$table = "operaciones o, pagos p";
								$query="select o.id, o.vessel, o.builders, o.puerto, o.noviaje, eosp, unbertedfromthepier, valorpda, anticiposrecibidos, tipodecambio, valorfpda, tipodecambio2, diferencianuestra, diferenciafavorprincipal, fechaenviodeefa, mensajeria, fechapagoarmador, importe, fechadevolucionarmador, importe2 from $table where o.id=p.id order by id desc";
								//echo $query;
								$result = mysql_query($query, $link);
								while($row = mysql_fetch_array($result)){
									$id=$row["id"];
									$BUQUE=$row["vessel"];
									$ARMADOR=$row["builders"];
									$VIAJE=$row["noviaje"];
									$PUERTO=$row["puerto"];
									$FECHADEENTRADA=$row["eosp"];
									$FECHADESALIDA=$row["unbertedfromthepier"];
									$VALORPDA=$row["valorpda"];
									$ANTICIPOSRECIBIDOS=$row["anticiposrecibidos"];
									$TIPODECAMBIO=$row["tipodecambio"];
									$VALORFPDA=$row["valorfpda"];
									$TIPODECAMBIO2=$row["tipodecambio2"];
									$DIFERENCIANUESTRA=$row["diferencianuestra"];
									$DIFERENCIAFAVORPRINCIPAL=$row["diferenciafavorprincipal"];
									$FECHADEENVIO=$row["fechadeenviodeefa"];
									$MENSAJERIA=$row["mensajeria"];
									$FECHADEPAGOARMADOR=$row["fechadepagoarmador"];
									$IMPORTE=$row["importe"];
									$FECHADEVOLUCIONARMADOR=$row["fechadevolucionarmador"];
									$IMPORTE2=$row["importe2"];
								?>
								<tr>
									<td bgcolor="white"><font size="2" face="Tahoma"><a href="resumenanticipos.php?id=<?php echo $id; ?>"><?php echo $id; ?></a></font></td>
									<td bgcolor="white"><font size="2" face="Tahoma"><?php echo $BUQUE; ?></font></td>
									<td bgcolor="white"><font size="2" face="Tahoma"><?php echo $ARMADOR; ?></font></td>
									<td bgcolor="white"><font size="2" face="Tahoma"><?php echo $VIAJE; ?></font></td>
									<td bgcolor="white"><font size="2" face="Tahoma"><?php echo $PUERTO; ?></font></td>
									<td bgcolor="white"><font size="2" face="Tahoma"><?php echo $FECHADEENTRADA; ?></font></td>
									<td bgcolor="white"><font size="2" face="Tahoma"><?php echo $FECHADESALIDA; ?></font></td>
									<td bgcolor="white"><font size="2" face="Tahoma"><?php echo $VALORPDA; ?></font></td>
									<td bgcolor="white"><font size="2" face="Tahoma"><?php echo $ANTICIPOSRECIBIDOS; ?></font></td>
									<td bgcolor="white"><font size="2" face="Tahoma"><?php echo $TIPODECAMBIO; ?></font></td>
									<td bgcolor="white"><font size="2" face="Tahoma"><?php echo $VALORFPDA; ?></font></td>
									<td bgcolor="white"><font size="2" face="Tahoma"><?php echo $TIPODECAMBIO2; ?></font></td>
									<td bgcolor="white"><font size="2" face="Tahoma"><?php echo $DIFERENCIANUESTRA; ?></font></td>
									<td bgcolor="white"><font size="2" face="Tahoma"><?php echo $DIFERENCIAFAVORPRINCIPAL; ?></font></td>
									<td bgcolor="white"><font size="2" face="Tahoma"><?php echo $FECHADEENVIO; ?></font></td>
									<td bgcolor="white"><font size="2" face="Tahoma"><?php echo $MENSAJERIA; ?></font></td>
									<td bgcolor="white"><font size="2" face="Tahoma"><?php echo $FECHADEPAGOARMADOR; ?></font></td>
									<td bgcolor="white"><font size="2" face="Tahoma"><?php echo $IMPORTE; ?></font></td>
									<td bgcolor="white"><font size="2" face="Tahoma"><?php echo $FECHADEVOLUCIONARMADOR; ?></font></td>
									<td bgcolor="white"><font size="2" face="Tahoma"><?php echo $IMPORTE2; ?></font></td>
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