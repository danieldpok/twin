<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<?php

include("conexion.php");
$id=$_GET["id"];
//$id="11111";
//DATOS DEL REGISTRO
$table="operaciones";
$fields="vessel, flag, puertodecarga, quantity, cargaentransito, maxarrivaldraftmt, sailed";

$query = "select ".$fields." from ".$table." where id='".$id."'";

$link = Conectar();
$result = mysql_query($query, $link);

while($row = mysql_fetch_array($result)){
$vessel=$row["vessel"];
$flag=$row["flag"];
$puertodecarga=$row["puertodecarga"];
$quantity=$row["quantity"];
$cargaentransito=$row["cargotype"];
$maxarrivaldraftmt=$row["maxarrivaldraftmt"];
$sailed=$row["sailed"];

}

?>

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta name="generator" content="Adobe GoLive" />
		<title>General Report</title>
		<link href="css/basic.css" rel="stylesheet" type="text/css" media="all" />
	</head>

	<body bgcolor="#ffffff" class="body">
		<p align="center"><img src="logo.jpg" alt="" width="385" height="120" border="0" /></p>
		<font size="5" color="#0183bf" face="Tahoma"><strong><em>GENERAL INFORMATION</em></strong></font><font size="3" face="Tahoma"><strong>
				<hr />
			</strong></font>
		<table width="386" border="1" cellspacing="2" cellpadding="0">
			<tr>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>VESSEL:</strong></font></td>
				<td><input type="text" name="textfieldName" value="<?php echo $vessel;  ?>" size="24" /></td>
			</tr>
			<tr>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>CARGO: </strong></font></td>
				<td><input type="text" name="textfieldName" value="<?php echo $cargaentransito;  ?>" size="24" /></td>
			</tr>
			<tr>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>QUANTITY:</strong></font></td>
				<td><input type="text" name="textfieldName" value="<?php echo $quantity;  ?>" size="24" /></td>
			</tr>
			<tr>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>LOADING PORT:</strong></font></td>
				<td><input type="text" name="textfieldName" value="<?php echo $puertodecarga;  ?>" size="24" /></td>
			</tr>
			<tr>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>MAXIMUM ARRIVAL DRAFT: </strong></font></td>
				<td><input type="text" name="textfieldName" value="<?php echo $maxarrivaldraftmt;  ?>" size="24" /></td>
			</tr>
		</table>
		<hr />
		<p><font size="5" color="#0183bf" face="Tahoma"><strong><em>GENERAL REPORT OF OPERATIONS</em></strong></font></p>
		<hr />
		<p><font face="Tahoma">HOLD REPORT</font></p>
		<table width="522" border="1" cellspacing="2" cellpadding="0">
			<tr>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>HOLD</strong></font></td>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>INITIAL TONAGE</strong></font></td>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>CURRENT DISCH</strong></font></td>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>TO BE DISCH</strong></font></td>
			</tr>
			<?php
			
			/////////////REPORTE GENERAL DE DESCARGA POR BODEGAS
			$totales=array(0,0,0);

						
			//$query="select distinct bodega from chargeinformation where id='".$id."'";
			$query="select distinct bodega from pesobodega where id='".$id."'";
			$result = mysql_query($query, $link);
			
			$i=0;
			while($row = mysql_fetch_array($result)){
			$bodega[$i]=$row["bodega"];
			$i++;
			}
			
			for($j=0; $j<count($bodega); $j++)	{
			
				
				/////////////OBTENER LAS CANTIDADES DESCARGADAS
				$query="select cantidad from descargabodegas where id='".$id."' and bodega='".$bodega[$j]."'";
				$result = mysql_query($query, $link);
				$cantidadTotal=0;
				while($row = mysql_fetch_array($result)){
				$cantidadTotal+=$row["cantidad"];
				}
				////////////////OBTENER EL TOTAL INICIAL
				$query="select pesototal from pesobodega where id='".$id."' and bodega='".$bodega[$j]."'";
				$result = mysql_query($query, $link);
				while($row = mysql_fetch_array($result)){
				$pesototal=$row["pesototal"];
				}
				
				$totales[0]+=$pesototal;
				$totales[1]+=$cantidadTotal;
				$totales[2]+=$pesototal-$cantidadTotal;
				
				?>
				
				<tr>
					<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><?php echo $bodega[$j];?></font></td>
					<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $pesototal;?></font></div>
				</td>
					<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $cantidadTotal;?></font></div>
				</td>
					<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $pesototal-$cantidadTotal;?></font></div>
				</td>
				</tr>
			
				<?php
			
			}
			
			?>
						
			<tr>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma">TTL</font></td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $totales[0]; ?></font></div>
				</td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $totales[1]; ?></font></div>
				</td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $totales[2]; ?></font></div>
				</td>
			</tr>
		</table>
		<p><strong><font face="Tahoma">REPORT BY PRODUCTS</font></strong></p>
		<table width="522" border="1" cellspacing="2" cellpadding="0">
			<tr>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>PRODUCT</strong></font></td>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>INITIAL TONAGE</strong></font></td>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>CURRENT DISCH</strong></font></td>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>TO BE DISCH</strong></font></td>
			</tr>
			<?php
			
			//---REPORTE GENERAL DE DESCARGA POR PRODUCTO ---- DAKA TECHNOLOGY---- PROP. INTELECTUAL DANIEL A. KENNEDY AYALA-----
			$totales=array(0,0,0);

						
			$query="select distinct producto from chargeinformation where id='".$id."'";
			$result = mysql_query($query, $link);
			
			$i=0;
			while($row = mysql_fetch_array($result)){
			$producto[$i]=$row["producto"];
			$i++;
			}
			
			for($j=0; $j<count($producto); $j++)	{
			
				
				////////////////OBTENER LAS CANTIDADES DESCARGADAS
				$query="select cantidad from descargaproducto where id='".$id."' and producto='".$producto[$j]."'";
				$result = mysql_query($query, $link);
				$cantidadTotal=0;
				while($row = mysql_fetch_array($result)){
				$cantidadTotal+=$row["cantidad"];
				}
				////////////////OBTENER EL TOTAL INICIAL
				$query="select pesoneto from chargeinformation where id='".$id."' and producto='".$producto[$j]."'";
				$pesototal=0;
				$result = mysql_query($query, $link);
				while($row = mysql_fetch_array($result)){
				$pesototal+=$row["pesoneto"];
				}
				
				$totales[0]+=$pesototal;
				$totales[1]+=$cantidadTotal;
				$totales[2]+=$pesototal-$cantidadTotal;
				
				?>
			<tr>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><?php echo $producto[$j];?></font></td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $pesototal;?></font></div>
				</td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $cantidadTotal;?></font></div>
				</td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $pesototal-$cantidadTotal;?></font></div>
				</td>
			</tr>
			<?php
			
			}
			
			?>
			<tr>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma">TTL</font></td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $totales[0]; ?></font></div>
				</td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $totales[1]; ?></font></div>
				</td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $totales[2]; ?></font></div>
				</td>
			</tr>
		</table>
		<p><strong><font face="Tahoma">REPORT BY RECEIVERS</font></strong></p>
		<table width="522" border="1" cellspacing="2" cellpadding="0">
			<tr>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>RECIVER</strong></font></td>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>INITIAL TONAGE</strong></font></td>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>CURRENT DISCH</strong></font></td>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><strong>TO BE DISCH</strong></font></td>
			</tr>
			<?php
			
			//---REPORTE GENERAL DE DESCARGA POR RECIVIDOR ---- DAKA TECHNOLOGY---- PROP. INTELECTUAL DANIEL A. KENNEDY AYALA-----
			$totales=array(0,0,0);

						
			$query="select distinct recibidor from chargeinformation where id='".$id."'";
			$result = mysql_query($query, $link);
			
			$i=0;
			while($row = mysql_fetch_array($result)){
			$producto[$i]=$row["recibidor"];
			$i++;
			}
			
			for($j=0; $j<count($producto); $j++)	{
			
				
				////////////////OBTENER LAS CANTIDADES DESCARGADAS
				$query="select cantidad from descargarecibidor where id='".$id."' and recibidor='".$producto[$j]."'";
				$result = mysql_query($query, $link);
				$cantidadTotal=0;
				while($row = mysql_fetch_array($result)){
				$cantidadTotal+=$row["cantidad"];
				}
				////////////////OBTENER EL TOTAL INICIAL
				$query="select pesoneto from chargeinformation where id='".$id."' and recibidor='".$producto[$j]."'";
				$pesototal=0;
				$result = mysql_query($query, $link);
				while($row = mysql_fetch_array($result)){
				$pesototal+=$row["pesoneto"];
				}
				
				$totales[0]+=$pesototal;
				$totales[1]+=$cantidadTotal;
				$totales[2]+=$pesototal-$cantidadTotal;
				
				?>
			<tr>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma"><?php echo $producto[$j];?></font></td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $pesototal;?></font></div>
				</td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $cantidadTotal;?></font></div>
				</td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $pesototal-$cantidadTotal;?></font></div>
				</td>
			</tr>
			<?php
			
			}
			
			?>
			<tr>
				<td bgcolor="#0183bf"><font size="2" color="white" face="Tahoma">TTL</font></td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $totales[0]; ?></font></div>
				</td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $totales[1]; ?></font></div>
				</td>
				<td>
					<div align="right">
						<font size="2" face="Tahoma"><?php echo $totales[2]; ?></font></div>
				</td>
			</tr>
		</table>
		<font size="-2">Powered in association  by TWIN MARINE DE MEXICO, S.A. DE C.V.  and  DAKA Technology. &lt;&lt;Copyright © 2009-2010 All Rights Reserved&gt;&gt;</font>
	</body>

</html>