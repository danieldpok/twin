<?php

include("conexion.php");
include('class.ezpdf.php');
set_time_limit(1000);

if(date('m')=='01')
$mes="ENERO";
else if(date('m')=='02')
$mes="FEBRERO";
else if(date('m')=='03')
$mes="MARZO";
else if(date('m')=='04')
$mes="ABRIL";
else if(date('m')=='05')
$mes="MAYO";
else if(date('m')=='06')
$mes="JUNIO";
else if(date('m')=='07')
$mes="JULIO";
else if(date('m')=='08')
$mes="AGOSTO";
else if(date('m')=='09')
$mes="SEPTIEMBRE";
else if(date('m')=='10')
$mes="OCTUBRE";
else if(date('m')=='11')
$mes="NOVIEMBRE";
else if(date('m')=='12')
$mes="DICIEMBRE";

$id=$_GET["id"];

function redondear_dos_decimal($valor) { 
   $float_redondeado=round($valor * 100) / 100; 
   return $float_redondeado; 
} 


$pdf =& new Cezpdf('a4');
//$pdf->selectFont('fonts/courier.afm');
$datacreator = array (
                    'Title'=>'Cartas PDF',
                    'Author'=>'Daniel Kennedy DAKA',
                    'Subject'=>'DAKA',
                    'Creator'=>'daka2712@gmail.com',
                    'Producer'=>'http://daka.com.mx'
);
$pdf->addInfo($datacreator);


$diff=array(225=>'aacute',233=>'eacute',
    237=>'iacute',243=>'oacute',
    250=>'uacute',252=>'udieresis',
    241=>'ntilde',209=>'Ntilde');

$pdf->selectFont('fonts/Helvetica.afm',array('encoding'=>'WinAnsiEncoding','differences'=>$diff));


$link = Conectar();
//
$queEmp = "select * from operaciones where id='$id'";
$resEmp = mysql_query($queEmp, $link);
while($row = mysql_fetch_array($resEmp)){


/**************************************
 *
 * MAIN
 *
 **************************************/

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //$pdf->addJpegFromFile("image004.jpg",'400','50','100','');
    //////AVISO DE LISTO///////////////////////////////////////////////////////////////////////////////////
    $pdf->addJpegFromFile("abajo.jpg",'0','10','600','');
    $pdf->addJpegFromFile("top.jpg",'5','750','580','');
    $pdf->ezText(utf8_decode('
    
    
    
    
    
    '), 10, array('justification'=>'right'));
    $pdf->ezText(utf8_decode('<b>NOTICE OF READINESS</b>
							 
    
	'), 14, array('justification'=>'center'));
	$pdf->addText(30,690,10,'<b>Flag m/v:</b>');	$pdf->addText(100,690,10,'<b>'.$row["flag"].'</b>');	$pdf->addText(300,690,10,'<b>TOTAL PARCEL</b>');	$pdf->addText(410,690,10,'<b>'.$row["quantity"].'</b>');
	$pdf->addText(30,680,10,'<b>Master:</b>');	$pdf->addText(100,680,10,'<b>'.$row["mastername"].'</b>');
	$pdf->addText(30,670,10,'<b>Vessel:</b>');	$pdf->addText(100,670,10,'<b>'.$row["vessel"].'</b>');
	$pdf->addText(30,660,10,'<b>Date:</b>');	$pdf->addText(100,660,10,'<b>'.date('M jS, Y').'</b>');
	
    $pdf->ezText(utf8_decode('
							 
Notice of Readiness Tendered on <b><u>'.strftime('%b. %d, %Y AT %H:%M hrs.',strtotime($row["nortendered"])).'</u></b>'), 10, array('justification'=>'left'));
	$pdf->ezText(utf8_decode('
Notice of Readiness Presented on <b><u>'.strftime('%b. %d, %Y AT %H:%M hrs.',strtotime($row["norpresented"])).'</u></b>
'), 10, array('justification'=>'left'));
	/////////////CONSULTA DE NOR
	$i=1;
	$queEmp = "select operacion, pesoneto, producto from chargeinformation where id='".$row["id"]."'";
    $resEmp2 = mysql_query($queEmp, $link);
    while($row2 = mysql_fetch_array($resEmp2)){
    	$pdf->ezText(utf8_decode(''.$i.' respect to <b><u>'.$row2["operacion"].'</u></b>   a cargo of about  <b><u>'.$row2["pesoneto"].'</u></b> tons of'), 10, array('justification'=>'left'));
		$pdf->ezText(utf8_decode(' <b><u>'.$row2["producto"].'</u></b>
		'), 10, array('justification'=>'left'));
		$i++;
    }
	/////////////////////////////////
    $pdf->ezNewPage();
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$queEmp = "select distinct recibidor, agencia, operacion from chargeinformation where id='".$row["id"]."'";
    $resEmp2 = mysql_query($queEmp, $link);
    while($row2 = mysql_fetch_array($resEmp2)){
		
	$queEmp2 = "select producto, pesoneto from chargeinformation where id='".$row["id"]."' and recibidor='".$row2["recibidor"]."'";
    $resEmp22 = mysql_query($queEmp2, $link);
	$productos="";
	$cantidad=0.000;
    while($row22 = mysql_fetch_array($resEmp22)){
		$cantidad+=str_replace(",", "", $row22["pesoneto"]);		
	}
	
	////////cuenta cuantos productos son
	$ix=0;
	$queEmp2 = "select distinct producto from chargeinformation where id='".$row["id"]."' and recibidor='".$row2["recibidor"]."'";
    $resEmp22 = mysql_query($queEmp2, $link);
	$productos="";
	while($row22 = mysql_fetch_array($resEmp22)){
		$ix++;
	}
	///////////////////////////////////
	
	$queEmp2 = "select distinct producto from chargeinformation where id='".$row["id"]."' and recibidor='".$row2["recibidor"]."'";
    $resEmp22 = mysql_query($queEmp2, $link);
	$productos="";
	while($row22 = mysql_fetch_array($resEmp22)){
		
		$queEmp2 = "select pesoneto from chargeinformation where id='".$row["id"]."' and recibidor='".$row2["recibidor"]."' and producto='".$row22["producto"]."'";
		$resEmpx = mysql_query($queEmp2, $link);
		$cantidadx=0.000;
		if($ix>1)	{
		  while($rowx = mysql_fetch_array($resEmpx)){
			  $cantidadx+=str_replace(",", "", $rowx["pesoneto"]);
		  }
			  $productos=$productos.sprintf("%.3f", $cantidadx)." tons of ".$row22["producto"].", ";
		}
		else	{
			  $productos=" of ".$row22["producto"].", ";
		}
			
	}
		
/**************************************
 *
 * RESUMEN
 *
 **************************************/
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $pdf->addJpegFromFile("abajo.jpg",'0','10','600','');
    $pdf->addJpegFromFile("top.jpg",'5','750','580','');
    $pdf->ezText(utf8_decode('
    
    
    
    
    
    '), 10, array('justification'=>'right'));
	$pdf->ezText(utf8_decode('<b>NOTICE OF READINESS</b>
    
	'), 14, array('justification'=>'center'));
	$pdf->addText(300,690,10,'<b>Vessel:</b>');	$pdf->addText(410,690,10,'<b>'.$row["vessel"].'</b>');
	//$pdf->addText(300,680,10,'<b>Date:</b>');	$pdf->addText(410,680,10,'<b>___________________</b>');
	$pdf->ezText(utf8_decode('
Messrs:																								
'.$row2["agencia"].'
ON BEHALF OF
'.$row2["recibidor"].'
RECEIVERS REPRESENTATIVES

This is to notify you that the <u>'.$row["flag"].'</u> flag m/v M.V. '.$row["vessel"].' under my command arrived at this port of Veracruz Mexico on <u>'.strftime('%b. %d, %Y AT %H:%M hrs.',strtotime($row["nortendered"])).'</u>  and from that date and time she is ready in every respect to <u>'.$row2["operacion"].'</u> a total cargo of about <u>'.sprintf("%.3f", $cantidad).'</u> tons,  <u>'.$productos.'</u> in accordance to all terms, conditions and exceptions of the Governing Charter Party.

Notice of Readiness Tendered on <b><u>'.strftime('%b. %d, %Y AT %H:%M hrs.',strtotime($row["nortendered"])).'</u></b>

Notice of Readiness Presented on <b><u>'.strftime('%b. %d, %Y AT %H:%M hrs.',strtotime($row["norpresented"])).'</u></b>




'), 10, array('justification'=>'full'));
				$pdf->addText(410,200,10,'<b> For and on behalf of Master.</b>');
				$pdf->addText(410,180,10,'<b>_____________________________</b>');
	//$pdf->addText(320,170,10,'<b>Master:</b>');	$pdf->addText(410,170,10,'<b>'.$row["mastername"].'</b>');
				$pdf->addText(410,160,10,'<b>Twin Marine de Mexico S .A. de C. V.</b>');
$pdf->ezText(utf8_decode('
accepted,   subject   to   all   terms,
conditions and exceptions  of  the
Governing Charter Party.

'.$row2["agencia"].'
ON BEHALF OF
'.$row2["recibidor"].'
RECEIVERS REPRESENTATIVES
Recivers

__________________________________________
Date:

___________________
Time:

_________Hrs.
'), 10, array('justification'=>'full'));
	
    $pdf->ezNewPage();
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

}
/////////////////////////////////////////////////////////////FIN

$pdf->ezStream(); 

?> 