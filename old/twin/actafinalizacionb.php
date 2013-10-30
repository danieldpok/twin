<?php

include("conexion.php");
include('class.ezpdf.php');
set_time_limit(1000);


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

function FechaFormateada($FechaStamp){
	
$mes = strftime('%m', strtotime($FechaStamp)); //<-- número de mes (01-12)

if($mes=='01')
$mes="ENERO";
else if($mes=='02')
$mes="FEBRERO";
else if($mes=='03')
$mes="MARZO";
else if($mes=='04')
$mes="ABRIL";
else if($mes=='05')
$mes="MAYO";
else if($mes=='06')
$mes="JUNIO";
else if($mes=='07')
$mes="JULIO";
else if($mes=='08')
$mes="AGOSTO";
else if($mes=='09')
$mes="SEPTIEMBRE";
else if($mes=='10')
$mes="OCTUBRE";
else if($mes=='11')
$mes="NOVIEMBRE";
else if($mes=='12')
$mes="DICIEMBRE";

return strftime(''.$mes.' %d DE %Y A LAS %H:%M',strtotime($FechaStamp));
}

$link = Conectar();
/**************************************
 *
 * ACTA DE FINALIZACION
 *
 **************************************/
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $pdf->ezText(utf8_decode('
    
<b>ACTA DE FINALIZACION DE DESCARGAS Y TONELAJES RECIBIDOS</b>
    
	
    '), 10, array('justification'=>'center'));
	$pdf->ezText(utf8_decode('
Los abajo firmantes Recibidores Consignados que comparten una operación de descarga de Fertilizantes embarcados sin segregacion natural de uno o varios productos, o bien comparten el embarque total con productos diferentes en bodegas separadas reconocen y aceptan tacitamente los tiempos de finalizacion de la descarga, asi como los tonelajes retirados por cada Recibidor conforme a los siguientes elementos y base definitiva para la liquidacion de faltantes y sobrantes a prorrata según el porcentaje de participacion.    '), 10, array('justification'=>'full'));
	$pdf->ezText(utf8_decode('
    <b>DATOS GENERALES DEL EMBARQUE</b>'), 10, array('justification'=>'center'));
	
	$queEmp = "select * from operaciones where id='$id'";
	$resEmp = mysql_query($queEmp, $link);
	while($row = mysql_fetch_array($resEmp)){
		
		$pdf->addText(150,630,10,'BUQUE'); $pdf->addText(300,630,10,$row["vessel"]);
				$pdf->addText(150,620,10,'PUERTO'); $pdf->addText(300,620,10,$row["puerto"].', MEXICO');
		$pdf->addText(150,610,10,'MUELLE'); $pdf->addText(300,610,10,$row["muelle"]); 
		$pdf->addText(150,600,10,'INICIO DESCARGA'); $pdf->addText(300,600,10,FechaFormateada($row["startdischarging"])); 
		$pdf->addText(150,590,10,'TERMINO DESCARGA'); $pdf->addText(300,590,10,FechaFormateada($row["completedescharging"])); 
		$pdf->addText(150,580,10,'TONELAJE'); $pdf->addText(300,580,10,$row["quantity"]);
		$pdf->addText(150,570,10,'BASCULA DE PESAJE'); $pdf->addText(300,570,10,$row["bascula"]); 
	}
	$pdf->ezText(utf8_decode('
    
	
	
	
	
	
	
	
	'), 10, array('justification'=>'center'));
	$queEmp = "select * from finalizacionobservaciones where id='$id'";
		$resEmp = mysql_query($queEmp, $link);
		while($row = mysql_fetch_array($resEmp)){
			$obs=$row["observaciones"];
		}
	    $titles = array('obs'=>'OBSERVACIONES');
        $options = array('shadeCol'=>array(1,1,1),'xOrientation'=>'right','width'=>300,'showLines'=>0,'fontSize'=>10,'rowGap'=>0,'showHeadings'=>1);
		//$pdf->addText(300,520,10,'<b>OBSERVACIONES</b>');
		//$pdf->addText(300,510,10,'<b>'.$obs.'</b>');
		$data[] = array('obs'=>$obs);
        $pdf->ezTable($data,$titles,'',$options );
	
	$pdf->addText(70, 550, 10, utf8_decode('<b>CONFORMACION DE PESOS SEGUN PLANO DE ESTIBA Y ASIGNACIONES POR PUERTO</b>'));
	
		$pdf->addText(10,530,10,'<b>BOD</b>'); $pdf->addText(50,530,10,'<b>PRODUCTO</b>'); $pdf->addText(150,530,10,'<b>TONELAJE GENERAL</b>'); $pdf->ezText(utf8_decode(''), 10, array('justification'=>'center'));	
		

	$queEmp = "select bodega, abreviacion, pesototal from pesobodega where id='$id' order by bodega";
	//$queEmp = "select * from finalizacionbod where id='$id' order by bodega";
	$resEmp = mysql_query($queEmp, $link);
	$i=520;
	$j=0.000;
	while($row = mysql_fetch_array($resEmp)){		
	$pdf->addText(12,$i,10,$row["bodega"]); 
	$pdf->addText(52,$i,10,$row["abreviacion"]); 
	$pdf->addText(152,$i,10,$row["pesototal"]); 
	$pdf->ezText(utf8_decode(''), 10, array('justification'=>'center'));
	$j+=str_replace(",", "", $row["pesototal"]);
	$i-=10;
	}
	
	$pdf->addText(152,$i,10,'<b>'.sprintf("%.3f", $j).'</b>');	$pdf->ezText(utf8_decode(''), 10, array('justification'=>'center'));
	$i-=30;
	//$pdf->ezText(, 10, array('justification'=>'center'));
		$pdf->addText(70,$i,10,utf8_decode('<b>DETALLE DE RECIBIDORES Y TONELAJES RETIRADOS</b>')); 
		
	$j=0.000;
	$i-=10;
	/*$pdf->addText(10,$i,8,'RECIBIDOR'); $pdf->addText(80,$i,8,'BL No.'); $pdf->addText(140,$i,8,'PRODUCTO'); $pdf->addText(250,$i,8,'INICIAL'); $pdf->addText(330,$i,8,'PESO BASC.'); $pdf->addText(420,$i,8,'DIF'); $pdf->addText(480,$i,8,'TERMINO DE DESCARGA'); $pdf->ezText(utf8_decode(''), 8, array('justification'=>'center'));*/
	   $titles = array('rec'=>'RECIBIDOR','bls'=>'BL No.','pro'=>'PRODUCTO','ini'=>'INICIAL','pesobasc'=>'PESO BASC.','dif'=>'DIF','term'=>'TERMINO DE DESCARGA');
	   $options = array('shadeCol'=>array(.9,.9,.9),'xOrientation'=>'centre','width'=>500,'showLines'=>0,'fontSize'=>8,'rowGap'=>0,'showHeadings'=>1);
	   
       
	$i-=10;
	$tot1=0.000;
	$tot2=0.000;
	$tot3=0.000;
	$query = "select * from tonelajes where id='$id'";
	$result = mysql_query($query, $link);
	$k=0;
	while($row = mysql_fetch_array($result)) {		
			
			$reciver = $row["recibidor"];
			$bl=$row["bl"];
			$product=$row["producto"];
			$pesoneto=$row["inicial"];
			$bascula=$row["bascula"];
			$dif=$row["dif"];
			$termino=$row["termino"];
			
			$tot1+=str_replace(",", "", $pesoneto);			
			$tot2+=str_replace(",", "", $bascula); 			
			$tot3+=str_replace(",", "", $dif); 
			/*$options[] = array('rec'=>array('justification'=>'left'),
						'bls'=>array('justification'=>'center'),
						'pro'=>array('justification'=>'center'),
						'ini'=>array('justification'=>'right'),
						'pesobasc'=>array('justification'=>'right'),
						'dif'=>array('justification'=>'right'),
						'term'=>array('justification'=>'right'));*/
        
		$data[] = array('rec'=>$reciver,'bls'=>$bl,'pro'=>$product,'ini'=>sprintf("%.3f", $pesoneto),'pesobasc'=>sprintf("%.3f", $bascula),'dif'=>sprintf("%.3f", $dif),'term'=>$termino);	
        
		
/*$pdf->addText(10,$i,8,$reciver); 
$pdf->addText(80,$i,8,$bl); 
$pdf->addText(140,$i,8,$product);  
$pdf->addText(250,$i,8,sprintf("%.3f", $pesoneto)); 
$tot1+=str_replace(",", "", $pesoneto); 
$pdf->addText(330,$i,8,sprintf("%.3f", $bascula));
$tot2+=str_replace(",", "", $bascula); 
$pdf->addText(420,$i,8,sprintf("%.3f", $dif));
$tot3+=str_replace(",", "", $dif); 
$pdf->addText(480,$i,8,$termino); */
//$pdf->ezText(utf8_decode(''), 8, array('justification'=>'center'));
$k++;
$i-=$k;
//$k=$k+$i+10;
	}
	$data[]=array('pro'=>'<b>TOTALES:</b>','ini'=>sprintf("%.3f", $tot1),'pesobasc'=>sprintf("%.3f", $tot2),'dif'=>sprintf("%.3f", round($tot3 * 1000) / 1000));
$pdf->ezTable($data,$titles,'',$options );
/*$pdf->addText(140,$i,8, ); 
$pdf->addText(250,$i,8,); 
$pdf->addText(330,$i,8,); 
$pdf->addText(420,$i,8,); */
$pdf->ezText(utf8_decode(''), 10, array('justification'=>'center'));
	
	
	$pdf->ezText(utf8_decode('<b>DETALLE DE ACUERDO A DRAFT SURVEY:</b><b>FIRMANTES AUTORIZADOS</b>'), 10, array('justification'=>'center'));
	

//$query = "select distinct ".$fields." from ".$table." where id='".$id."'";
$query = "select * from finalizacionfirmantes where id='".$id."'";
$i-=60;
$result = mysql_query($query, $link);
$x=0;
$conter=0;
while($row = mysql_fetch_array($result)) {
	
	if($i<=200){
		//if($conter==5){
			//$pdf->ezText(utf8_decode("".$i.""), 10, array('justification'=>'center'));
			$i=740;
		$pdf->ezNewPage();
         $pdf->ezSetCmMargins(1,1,1,1); 
		 $pdf->ezText(utf8_decode('
	<b>DETALLE DE ACUERDO A DRAFT SURVEY:</b>
    <b>FIRMANTES AUTORIZADOS</b>'), 10, array('justification'=>'center'));
	//	}
	$titles = array('recibidor'=>'');
    $options = array('shadeCol'=>array(1,1,1),'xOrientation'=>'centre','width'=>400,'showLines'=>0,'fontSize'=>10,'rowGap'=>1);
    $recibidor=$row["firmante"];	
	$data[] = array('recibidor'=>$recibidor);
    $pdf->ezTable($data,$titles,'',$options );
	//$pdf->addText(140,$i,10, $recibidor);
	$i-=40;
	//$pdf->addText(220,$i,10,"_________________________");
	$titles = array('lineafirma'=>'');
	$options2 = array('shadeCol'=>array(1,1,1),'xOrientation'=>'centre','width'=>200,'showLines'=>0,'fontSize'=>10,'rowGap'=>1);
	$lf[] = array('lineafirma'=>"_________________________");
	$pdf->ezTable($lf,$titles,'',$options2 );
	$i-=20;
	unset($data);
	unset($lf);
	}else{
	$titles = array('recibidor'=>'');
    $options = array('shadeCol'=>array(1,1,1),'xOrientation'=>'centre','width'=>400,'showLines'=>0,'fontSize'=>10,'rowGap'=>1);
    $recibidor=$row["firmante"];	
	$data[] = array('recibidor'=>$recibidor);
    $pdf->ezTable($data,$titles,'',$options );
	//$pdf->addText(140,$i,10, $recibidor);
	$i-=40;
	//$pdf->addText(220,$i,10,"_________________________");
	$titles = array('lineafirma'=>'');
	$options2 = array('shadeCol'=>array(1,1,1),'xOrientation'=>'centre','width'=>200,'showLines'=>0,'fontSize'=>10,'rowGap'=>1);
	$lf[] = array('lineafirma'=>"_________________________");
	$pdf->ezTable($lf,$titles,'',$options2 );
	$i-=20;
	unset($data);
	unset($lf);
	}
	$conter++;
	/*
	if($x==0)	{
		$pdf->addText(140,$i,10, $recibidor);
		$pdf->addText(220,$i,10,$tot1);
		$i-=10;
	} else { }
	if($x==1)	{
		$pdf->addText(140,$i,10, $recibidor);
		$pdf->addText(220,$i,10,$tot1);
		$i-=10;
	} else {}
	if($x==0)
	$x=1;
	else
	$x=0;
	*/
}

/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////FIN

$pdf->ezStream(); 

?> 