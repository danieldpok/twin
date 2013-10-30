<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<?php

include("conexion.php");
$id=$_GET["id"];
//$id="11111";
//DATOS DEL REGISTRO

if(isset($_GET["guardar1"]))	{

$vessel=$_GET["vessel"];
$flag=$_GET["flag"];
$quantity=$_GET["quantity"];
$cargotype=$_GET["cargotype"];
$puertodecarga=$_GET["puertodecarga"];
$sailed=$_GET["sailed"];
$fquantity=$_GET["fquantity"];
$firstport=$_GET["firstport"];
$totalparcelfirst=$_GET["totalparcelfirst"];
$madfirst=$_GET["madfirst"];
$secondport=$_GET["secondport"];
$totalparcelsecond=$_GET["totalparcelsecond"];
$madsecond=$_GET["madsecond"];

$thirdport=$_GET["thirdport"];
$totalparcelthird=$_GET["totalparcelthird"];
$madthird=$_GET["madthird"];

$notes=$_GET["notes"];
$imo=$_GET["imo"];
$dwt=$_GET["dwt"];
$beam=$_GET["beam"];
$grt=$_GET["grt"];
$hh=$_GET["hh"];
$callsign=$_GET["callsign"];
$built=$_GET["built"];
$loa=$_GET["loa"];
$nrt=$_GET["nrt"];
$cranes=$_GET["cranes"];

		$link=Conectar();
		$query="update operaciones set flag='$flag', vessel='$vessel', quantity='$quantity', cargotype='$cargotype', puertodecarga='$puertodecarga', sailed='$sailed', fquantity='$fquantity', firstport='$firstport', totalparcelfirst='$totalparcelfirst', madfirst='$madfirst', secondport='$secondport', totalparcelsecond='$totalparcelsecond', madsecond='$madsecond', notes='$notes', imonbr='$imo', callsign='$callsign', dwtsummer='$dwt', built='$built', breadthmouldedmt='$beam', loamt='$loa', dwtgrt='$grt', dwtnrt='$nrt', nbrhh='$hh', cranesonboard='$cranes', thirdport='$thirdport', totalparcelthird='$totalparcelthird', madthird='$madthird' where id='$id'";
		//echo $query;
	
	mysql_query($query, $link);
	mysql_close($link);
} else if(isset($_GET["guardar2"]))	{
	$weather=$_GET["weather"];
	$link=Conectar();
		$query="update operaciones set weather='$weather' where id='$id'";
		//echo $query;
	
	mysql_query($query, $link);
	mysql_close($link);
}	else if(isset($_GET["guardarhold"]))	{
	$hold=$_GET["hold"];
	$abreviacion=$_GET["abreviacion"];
//	$cantidad1=$_GET["cantidad1"];
//	$cantidad2=$_GET["cantidad2"];
//	$cantidad3=$_GET["cantidad3"];
	$pesototal=$_GET["pesototal"];
	
	$link=Conectar();
		//$query="insert into pesobodega (id, bodega, abreviacion, cantidad1, cantidad2, cantidad3) values ('$id', '$hold', '$abreviacion', '$cantidad1', '$cantidad2', '$cantidad3')";
		//echo $query;
		$query="insert into pesobodega (id, bodega, abreviacion, pesototal, cantidad1) values ('$id', '$hold', '$abreviacion', '$pesototal', '$pesototal')";
	
	mysql_query($query, $link);
	mysql_close($link);
} else if(isset($_GET["eliminar"]))	{
	$link=Conectar();
	$idpesobodega=$_GET["eliminar"];
		$query="delete from pesobodega where idpesobodega='$idpesobodega'";
		//echo $query;
	
	mysql_query($query, $link);
	mysql_close($link);
} else if(isset($_GET["guardarholdcantidad"]))	{
	
	$cantidad1=$_GET["cantidad1"];
	$cantidad2=$_GET["cantidad2"];
	$cantidad3=$_GET["cantidad3"];
	$idpesobodega=$_GET["idpesobodega"];
	//$pesototal=$_GET["pesototal"];
	
	$link=Conectar();
		$query="update pesobodega set cantidad1='$cantidad1', cantidad2='$cantidad2', cantidad3='$cantidad3' where idpesobodega='$idpesobodega'";
		//echo $query;
		//$query="insert into pesobodega (id, bodega, abreviacion, pesototal) values ('$id', '$hold', '$abreviacion', '$pesototal')";
	
	mysql_query($query, $link);
	mysql_close($link);
}






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
	<script src="SpryAssets/SpryCollapsiblePanel.js" type="text/javascript"></script>
	<link href="SpryAssets/SpryCollapsiblePanel.css" rel="stylesheet" type="text/css" />
	</head>
    <link href="styles.css" rel="stylesheet" type="text/css" />

<body bgcolor="#ffffff" class="fondo">
<form name="form1" id="form1" method="get" action="previo2.php" >
    <table width="445" border="0" cellspacing="0" cellpadding="0">
			<tr>
			  <td width="445" class="tituloNormal2"><font size="2" face="Tahoma"><strong>Vessel:
			    <label>
			      <input type="text" name="vessel" id="vessel" value="<?php echo $vessel; ?>" />
		      </label>
		      </strong></font></td>
		  </tr>
			<tr>
			  <td><font size="2"   face="Tahoma"><strong>Quantity: <input type="text" name="fquantity" id="fquantity" value="<?php echo $fquantity; ?>" /> Cargo: <input type="text" name="cargotype" id="cargotype" value="<?php echo $cargotype; ?>" /></strong></font></td>
			</tr>
			</table>
<table width="441" border="0" cellspacing="2" cellpadding="0">
						<tr>
							<td width="204"  ><span ><font size="2"   face="Tahoma"><strong>LOADING PORT:</strong></font></span></td>
							<td width="231" align="left"><span ><font size="2" face="Tahoma"><strong>
						    <input type="text" name="puertodecarga" id="puertodecarga" value="<?php echo $puertodecarga;?>" />
						    </strong></font></span></td>
						</tr>
						<tr>
							<td  ><span ><font size="2"   face="Tahoma"><strong>SAILED:</strong></font></span></td>
							<td align="left"><span ><font size="2" face="Tahoma"><strong>
							  <input type="text" name="sailed" id="sailed" value="<?php echo $sailed;?>" />
							</strong></font></span></td>
						</tr>
						<tr>
							<td  ><span ><font size="2"   face="Tahoma"><strong>TOTAL SHIPMENT:</strong></font></span></td>
							<td align="left"><span ><font size="2" face="Tahoma"><strong>
							  <input type="text" name="fquantity" id="fquantity" value="<?php echo $fquantity;?>" />
							</strong></font></span></td>
						</tr>
						<tr>
							<td  ><span ><font size="2"   face="Tahoma"><strong>FIRST DISCHARGING PORT:</strong></font></span></td>
							<td align="left"><span ><font size="2" face="Tahoma"><strong>
							  <input type="text" name="firstport" id="firstport" value="<?php echo $firstport;?>" />
							</strong></font></span></td>
						</tr>
						<tr>
							<td  ><span ><font size="2"   face="Tahoma"><strong>TOTAL PARCEL AT FIRST PORT: </strong></font></span></td>
							<td align="left"><span ><font size="2" face="Tahoma"><strong>
							  <input type="text" name="totalparcelfirst" id="totalparcelfirst" value="<?php echo $totalparcelfirst;?>" />
							</strong></font></span></td>
						</tr>
						<tr>
							<td  ><span ><font size="2"   face="Tahoma"><strong>MAXIMUM ARRIVAL DRAFT:</strong></font></span></td>
							<td align="left"><span ><font size="2" face="Tahoma"><strong>
							  <input type="text" name="madfirst" id="madfirst" value="<?php echo $madfirst;?>" />MTS.
							</strong></font></span></td>
						</tr>
						<tr>
							<td  ><span ><font size="2"   face="Tahoma"><strong>SECOND DISCHARGING PORT:</strong></font></span></td>
							<td align="left"><span ><font size="2" face="Tahoma"><strong>
							  <input type="text" name="secondport" id="secondport" value="<?php echo $secondport;?>" />
							</strong></font></span></td>
						</tr>
						<tr>
							<td  ><span ><font size="2"   face="Tahoma"><strong>TOTAL PARCEL:</strong></font></span></td>
							<td align="left"><span ><font size="2" face="Tahoma"><strong>
							  <input type="text" name="totalparcelsecond" id="totalparcelsecond" value="<?php echo $totalparcelsecond;?>" />
							</strong></font></span></td>
						</tr>
						<tr>
							<td  ><span ><font size="2"   face="Tahoma"><strong>MAXIMUM ARRIVAL DRAFT: </strong></font></span></td>
							<td align="left"><span ><font size="2" face="Tahoma"><input type="text" name="madsecond" id="madsecond" value="<?php echo $madsecond;?>" /><strong>MTS</strong></font></span></td>
						</tr>
				  </table>
<div id="CollapsiblePanel1" class="CollapsiblePanel">
  <div class="CollapsiblePanelTab" tabindex="0">THIRD PORT</div>
  <div class="CollapsiblePanelContent">
    <table width="441" border="0" cellpadding="0" cellspacing="2">
      <tr>
        <td  ><span ><font size="2"   face="Tahoma"><strong>THIRD DISCHARGING PORT:</strong></font></span></td>
        <td align="left"><span ><font size="2" face="Tahoma"><strong>
          <input type="text" name="thirdport" id="thirdport" value="<?php echo $thirdport;?>" />
        </strong></font></span></td>
      </tr>
      <tr>
        <td  ><span ><font size="2"   face="Tahoma"><strong>TOTAL PARCEL:</strong></font></span></td>
        <td align="left"><span ><font size="2" face="Tahoma"><strong>
          <input type="text" name="totalparcelthird" id="totalparcelthird" value="<?php echo $totalparcelthird;?>" />
        </strong></font></span></td>
      </tr>
      <tr>
        <td  ><span ><font size="2"   face="Tahoma"><strong>MAXIMUM ARRIVAL DRAFT: </strong></font></span></td>
        <td align="left"><span ><font size="2" face="Tahoma">
          <input type="text" name="madthird" id="madthird" value="<?php echo $madthird;?>" />
          <strong>MTS</strong></font></span></td>
      </tr>
    </table>
  </div>
</div>
	<p><font size="2" face="Tahoma">Remarks:<br />
    <label></label>
    <textarea name="notes" id="notes" cols="45" rows="5"><?php echo $notes; ?></textarea>
    </font>
	  
  <br />
	  <font size="2.5" color="#0183bf" face="Tahoma"><strong>MAIN DETAILS OF THE VESSEL INFORMED:</strong></font><br/>        
  </p>
	<table width="429" border="0" cellspacing="2" cellpadding="0">
		  <tr>
				<td width="65">&nbsp;</td>
			<td width="141">&nbsp;</td>
				<td width="103"><span ><font size="2"   face="Tahoma"><strong>FLAG:</strong></font></span></td>
				<td width="110"><span ><font size="2" face="Tahoma"><strong>
				  <input type="text" name="flag" id="flag" value="<?php echo $flag; ?>" />
				</strong></font></span></td>
	  </tr>
			<tr>
				<td   ><span ><font size="2"   face="Tahoma"><strong>IMO:</strong></font></span></td>
			  <td align="left" class="tbl2"><span ><font size="2" face="Tahoma"><strong>
			    <input type="text" name="imo" id="imo" value="<?php echo $imo; ?>" />
	      </strong></font></span></td>
				<td   ><span ><font size="2"   face="Tahoma"><strong>CALL SIGN:</strong></font></span></td>
				<td align="left" class="tbl2"><span ><font size="2" face="Tahoma"><strong>
				  <input type="text" name="callsign" id="callsign" value="<?php echo $callsign; ?>" />
				</strong></font></span></td>
			</tr>
			<tr>
				<td   ><span ><font size="2"   face="Tahoma"><strong>DWT:</strong></font></span></td>
			  <td align="left" class="tbl2"><span ><font size="2" face="Tahoma"><strong>
			    <input type="text" name="dwt" id="dwt" value="<?php echo $dwt; ?>" />
	      </strong></font></span></td>
				<td   ><span ><font size="2"   face="Tahoma"><strong>BUILT:</strong></font></span></td>
				<td align="left" class="tbl2"><span ><font size="2" face="Tahoma"><strong>	
                <input type="text" name="built" id="built" value="<?php echo $built; ?>" />			  
				</strong></font></span></td>
			</tr>
			<tr>
				<td   ><span ><font size="2"   face="Tahoma"><strong>BEAM:</strong></font></span></td>
			  <td align="left" class="tbl2"><span ><font size="2" face="Tahoma"><strong>
			    <input type="text" name="beam" id="beam" value="<?php echo $beam; ?>" />
	      </strong></font></span></td>
				<td   ><span ><font size="2"   face="Tahoma"><strong>LOA:</strong></font></span></td>
				<td align="left" class="tbl2"><span ><font size="2" face="Tahoma"></font></span><font size="2"   face="Tahoma"><strong>
				  <input type="text" name="loa" id="loa" value="<?php echo $loa; ?>" />
				</strong></font></td>
			</tr>
			<tr>
				<td   ><span ><font size="2"   face="Tahoma"><strong>GRT:</strong></font></span></td>
			  <td align="left" class="tbl2"><span ><font size="2" face="Tahoma"><strong>
			    <input type="text" name="grt" id="grt" value="<?php echo $grt; ?>" />
	      </strong></font></span></td>
				<td   ><span ><font size="2"   face="Tahoma"><strong>NRT:</strong></font></span></td>
				<td align="left" class="tbl2"><span ><font size="2" face="Tahoma"><strong>
				  <input type="text" name="nrt" id="nrt" value="<?php echo $nrt; ?>" />
				</strong></font></span></td>
			</tr>
			<tr>
				<td   ><span ><font size="2"   face="Tahoma"><strong>H/H</strong></font></span></td>
			  <td align="left" class="tbl2"><span ><font size="2" face="Tahoma"><strong>
			    <input type="text" name="hh" id="hh" value="<?php echo $hh; ?>" />
	      </strong></font></span></td>
				<td   ><span ><font size="2"   face="Tahoma"><strong>CRANES:</strong></font></span></td>
				<td align="left" class="tbl2"><span ><font size="2" face="Tahoma"><strong>
				  <input type="text" name="cranes" id="cranes" value="<?php echo $cranes; ?>" />
				</strong></font></span></td>
			</tr>
  </table>
  <input type="hidden" name="id" value="<?php echo $id; ?>"  />
    <input type="submit" name="guardar1" id="guardar1" value="GUARDAR" />
</form>
<a name="stowage" id="stowage" ></a>
	<font size="2.5" color="#0183bf" face="Tahoma"><strong>STOWAGE PLAN:</strong></font>
    
<table width="915" border="0" cellspacing="4" cellpadding="0">
			<tr>
				<td width="34" ><font size="2"   face="Tahoma"><strong>HOLD</strong></font></td>                
				<td width="144" ><font size="2"   face="Tahoma"><strong>CARGO</strong></font></td>
                <td width="90" ><font size="2"   face="Tahoma"><strong>TOTAL</strong></font></td>
                <td width="114" ><font size="2"   face="Tahoma"><strong>FIRST PORT:</strong></font></td>
                <td width="114" ><font size="2"   face="Tahoma"><strong>SECOND PORT:</strong></font></td>
                <td width="115" ><font size="2"   face="Tahoma"><strong>THIRD PORT:</strong></font></td>
                <td width="272">&nbsp;</td>
			</tr>
			<?php
			
			/////////////REPORTE GENERAL DE DESCARGA POR BODEGAS
			$totales=array(0,0,0);

						
			//$query="select distinct bodega from chargeinformation where id='".$id."'";
			$query="select idpesobodega, bodega, pesototal, abreviacion, cantidad1, cantidad2, cantidad3 from pesobodega where id='".$id."' order by bodega";
			$result = mysql_query($query, $link);
			
			$i=0.000;
			$j=0.000;
			$k=0.000;
			while($row = mysql_fetch_array($result)){
				$idpesobodega=$row["idpesobodega"];
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
            <form name="hold<?php echo $row["bodega"];?>" id="hold<?php echo $row["bodega"];?>" method="get" action="previo2.php#stowage">
            <input type="hidden" name="id" value="<?php echo $id; ?>"  />
            <input type="hidden" name="idpesobodega" value="<?php echo $idpesobodega; ?>"  />
			<tr>
					<td ><span ><font size="2"   face="Tahoma"><strong><?php echo $row["bodega"];?></strong></font></span></td>
					<td>
<div align="left">
						<span ><font size="2" face="Tahoma"><?php echo $row["abreviacion"];?></font></span></div>
				</td>
                <td>
                <div align="left">
						<span ><font size="2" face="Tahoma"></font></span></div>
                        <label>
    <input type="text" name="total" id="total" size="15" value="<?php echo $row["pesototal"];?>" readonly="readonly" />
  </label>
                </td>                
				<td>
<div align="left"><span ><font size="2" face="Tahoma"></font></span>
  <label>
    <input type="text" name="cantidad1" id="cantidad1" value="<?php printf("%.3f", $cantidad1);?>" size="15" onchange="calcular(total.value, cantidad1.value, cantidad2)" />
  </label>
</div>
				</td>                
                <td>
<div align="left"><font size="2" face="Tahoma"></font>
  <label>
    <input type="text" name="cantidad2" id="cantidad2" value="<?php printf("%.3f", $cantidad2);?>" size="15" onchange="calcular2(total.value, cantidad1.value, cantidad2.value, cantidad3)" />
  </label>
</div>
				</td>
                <td>
<div align="left"><font size="2" face="Tahoma"></font>
  <label>
    <input type="text" name="cantidad3" id="cantidad3" value="<?php printf("%.3f", $cantidad3);?>" size="15" />
  </label>
</div>
				</td>
                <td>
           	    <a href="previo2.php?eliminar=<?php echo $idpesobodega; ?>&id=<?php echo $id; ?>">eliminar</a>
           	    <input type="submit" name="guardarholdcantidad" id="guardarholdcantidad" value="GUARDAR" />
           	    </td>                         
</tr>
</form>

      <?php
			}
			?>
           						
			<tr>
				<td ><span ><font size="2"   face="Tahoma"><strong>TTL</strong></font></span></td>
				<td>
					<div >
				  </div>
				</td>
                
				<td>
<div align="left"><font size="2" face="Tahoma"><strong><?php printf("%.3f", $i); ?></strong></font>  
</div>
				</td>
                
                <td>
<div align="left"><span ><font size="2" face="Tahoma"><strong><?php printf("%.3f", $j); ?></strong></font></span></div>
				</td>
                
                <td>
<div align="left"><span ><font size="2" face="Tahoma"><strong><?php printf("%.3f", $k); ?></strong></font></span></div>
				</td>
                
                <td>
<div align="left"><span ><font size="2" face="Tahoma"><strong><?php printf("%.3f", $l); ?></strong></font></span></div>
				</td>
                
      </tr>
      <tr>
      <form name="form2" id="form2" method="get" action="previo2.php#stowage">
    <input type="hidden" name="id" value="<?php echo $id; ?>"  />
      	<td><label>
      	  <input type="text" name="hold" id="hold" size="5" />
   	    </label></td>
        <td>
          <label>
            <input type="text" name="abreviacion" id="cargo" />
        </label></td>
        <td>
          <label>
            <input type="text" name="pesototal" id="pesototal" size="15" />
        </label></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><label>
          <input type="submit" name="guardarhold" id="guardarhold" value="GUARDAR" />
        </label></td>
        </form>
      </tr>
	</table>
    
<font size="2.5" color="#0183bf" face="Tahoma"><strong>GENERAL COMENTS</strong></font>
    <form name="form3" id="form3" method="get" action="previo2.php" >
    <input type="hidden" name="id" value="<?php echo $id; ?>"  />
      <label>
        <textarea name="weather" id="weather" cols="45" rows="5"><?php echo $weather; ?></textarea>
      </label>
      <input type="submit" name="guardar2" id="guardar2" value="GUARDAR" />
</form>
      <br />
      <form name="final" id="final" method="get" action="previo.php">
      <input type="hidden" name="id" value="<?php echo $id; ?>"  />
      <input type="submit" name="consultar" id="consultar" value="CONSULTAR REPORTE" />
      </form>
      <p>
      <p>
      </p>
      </p>
      <font size="2" face="Tahoma"></font><br />
      <font size="-2">Powered in association  by TWIN MARINE DE MEXICO, S.A. DE C.V.  and  DAKA Technology. &lt;&lt;Copyright © 2009-2010 All Rights Reserved&gt;&gt;</font>
<script type="text/javascript">
function calcular(total, cantidad1, campo)	{
	var final=total-cantidad1;	
	campo.value=final;
	//var cant1=parseFloat(document.getElementById("hold".numero)+parseFloat(document.quantitiesform.prevdq.value);	
	//document.quantitiesform.totdq.value=dtot.toFixed(3);
	//var dfalt=parseFloat(document.quantitiesform.totq.value)-parseFloat(document.quantitiesform.totdq.value);
	//document.quantitiesform.tobedq.value=dfalt.toFixed(3);	
}

function calcular2(total, cantidad1, cantidad2, campo)	{
	var final=total-cantidad1-cantidad2;
	campo.value=final;
}
<!--
var CollapsiblePanel1 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel1", {contentIsOpen:false});
//-->
      </script>
</body>

</html>