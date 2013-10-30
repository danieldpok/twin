<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<?php
include("conexion.php");
$id=$_GET["id"];
//$id="11111";
//DATOS DEL REGISTRO
$table="operaciones";
$fields="vessel, flag, puertodecarga, quantity, cargaentransito";

$query = "select ".$fields." from ".$table." where id='".$id."'";

$link = Conectar();
$result = mysql_query($query, $link);

while($row = mysql_fetch_array($result)){
$vessel=$row["vessel"];
$flag=$row["flag"];
$puertodecarga=$row["puertodecarga"];
$quantity=$row["quantity"];
$cargaentransito=$row["cargaentransito"];

}
//OBTENER EL KEYX PARA LA REFERENCIA DE LOS HECHOS
$table="computotiempo";
$fields="keyx";

$query = "select ".$fields." from ".$table." where id='".$id."'";

$result = mysql_query($query, $link);

while($row = mysql_fetch_array($result)){
$keyx=$row["keyx"];
}
////////////////////////////////
//OBTENER LOS HECHOS
$table="facts";
$fields="fecha, hinicio, hfinal, facts, bodega";

$query = "select ".$fields." from ".$table." where keyx='".$keyx."'";
//echo $query;
$result = mysql_query($query, $link);
////////////////////////////////////////

?>

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta name="generator" content="Adobe GoLive" />
		<title>facts</title>
		<link href="css/basic.css" rel="stylesheet" type="text/css" media="all" />
	</head>

	<body bgcolor="#ffffff">
		<table width="782" border="1" cellspacing="2" cellpadding="0">
			<tr>
				<td>
					<div align="center">
						<font size="+3" color="#0000bf" face="Tahoma"><strong>STATEMENT OF FACTS</strong></font></div>
				</td>
			</tr>
		</table>
		<table width="456" border="1" cellspacing="2" cellpadding="0">
			<tr>
				<td>
					<table width="597" border="0" cellspacing="2" cellpadding="0">
						<tr>
							<td><?php echo $vessel; ?></td>
							<td><?php echo $flag; ?></td>
						</tr>
					</table>
					<table width="493" border="1" cellspacing="2" cellpadding="0">
						<tr>
							<td><img src="logo.jpg" alt="" width="150" height="99" border="0" />
								<table width="151" border="1" cellspacing="2" cellpadding="0">
									<tr>
										<td><font face="Tahoma"><strong>VERACRUZ</strong></font></td>
									</tr>
									<tr>
										<td><font face="Tahoma"><strong>MEXICO</strong></font></td>
									</tr>
								</table>
							</td>
							<td>
								<table width="606" border="0" cellspacing="2" cellpadding="0">
									<tr>
										<td><font size="2" face="Tahoma"><strong>PORT OF LOADING:</strong></font></td>
										<td><input type="text" name="textfieldName" value="<?php echo $puertodecarga; ?>" size="50" /></td>
									</tr>
									<tr>
										<td><font size="2" face="Tahoma"><strong>1ST. DISCH. PORT DECLARED:</strong></font></td>
										<td><input type="text" name="textfieldName" value="VERACRUZ, MEXICO." size="50" /></td>
									</tr>
									<tr>
										<td><font size="2" face="Tahoma"><strong>CARGO:</strong></font></td>
										<td><input type="text" name="textfieldName" value='<?php echo $quantity."  ".$cargaentransito; ?>' size="50" /></td>
									</tr>
									<tr>
										<td><font size="2" face="Tahoma"><strong>RECIVER:</strong></font></td>
										<td><input type="text" name="textfieldName" size="50" /></td>
									</tr>
									<tr>
										<td><font size="2" face="Tahoma"><strong>AGENCY:</strong></font></td>
										<td><input type="text" name="textfieldName" value="TWIN MARINE DE MEXICO, S.A. DE C.V." size="50" /></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<table width="164" border="1" cellspacing="2" cellpadding="0">
			<tr>
				<td>
					<table width="274" border="0" cellspacing="2" cellpadding="0">
						<tr>
							<td>
								<div align="center">
									<font size="2" face="Tahoma"><strong>DATE</strong></font></div>
							</td>
							<td>
								<div align="center">
									<font size="2" face="Tahoma"><strong>TIME</strong></font></div>
							</td>
						</tr>
					</table>
				</td>
				<td>
					<table width="493" border="0" cellspacing="2" cellpadding="0">
						<tr>
							<td>
								<div align="center">
									<font size="2" face="Tahoma"><strong>FACTS</strong></font></div>
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
		
		$queryA = "select distinct fecha from facts where keyx='".$keyx."'";
		//echo $queryA;
		$resultA = mysql_query($queryA, $link);
		
		while($rowA = mysql_fetch_array($resultA))	{	
		
		$query = "select ".$fields." from ".$table." where keyx='".$keyx."' and fecha='".$rowA["fecha"]."' and tipo='OPERATIONAL' order by hinicio";
		$result = mysql_query($query, $link);	
		$buf=0;
			/////OPERATIONAL
			while($row = mysql_fetch_array($result))	{
			setlocale(LC_TIME , 'es_ES');
			if($buf==0)	{
				$fecha=strftime('%B, %d /%Y',strtotime($row["fecha"]));
				$buf=1;
			} else if($buf==1)	{
				$fecha=strftime('%A		',strtotime($row["fecha"]));
				$buf=2;
			}
			else	{
				$fecha="			";
			}

			$hinicio=$row["hinicio"];
			$hfinal=$row["hfinal"];
			$facts=$row["facts"];
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
												<font size="2" face="Tahoma"><?php echo $hinicio."	".$hfinal; ?></font></div>
										</td>
									</tr>
								</table>
							</td>
							<td>
								<table width="483" border="0" cellspacing="2" cellpadding="0">
									<tr>
										<td>
											<div align="left">
												<font size="2" face="Tahoma"><?php echo $facts; ?> </font><?php echo $bodega;?></div>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<?php
				}  ////////////FIN DEL WHILE
				?>
						<tr>
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
											<div align="center"></div>
										</td>
									</tr>
								</table>
							</td>
							<td>
								<table width="483" border="0" cellspacing="2" cellpadding="0">
									<tr>
										<td>
											<div align="left">
												<font face="Tahoma"><strong>STOP/IDLE TIMES:</strong></font></div>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<?php
			///////////////// STOP/IDLE TIME
			$query = "select ".$fields." from ".$table." where keyx='".$keyx."' and fecha='".$rowA["fecha"]."' and tipo='STOP/IDLE TIME' order by hinicio";
			$result = mysql_query($query, $link);	
			while($row = mysql_fetch_array($result))	{
			
			$hinicio=$row["hinicio"];
			$hfinal=$row["hfinal"];
			$facts=$row["facts"];
			$bodega=$row["bodega"];
		?>
						<tr>
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
											<div align="center">
												<font size="2" face="Tahoma"><?php echo $hinicio."	".$hfinal; ?></font></div>
										</td>
									</tr>
								</table>
							</td>
							<td>
								<table width="483" border="0" cellspacing="2" cellpadding="0">
									<tr>
										<td>
											<div align="left">
												<font size="2" face="Tahoma"><?php echo $facts; ?> </font><?php echo $bodega;?></div>
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
					</table>
				</td>
			</tr>
		</table>
	</body>

</html>