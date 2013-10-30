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
	
	if($row["typex"]=="IMPORT")	{
		$var="DESCARGA";
		$var2="<b>***EN LASTRE</b>";
		$var3="CONDUCE";
		$var4="A";
	}
	else	{
		$var="CARGA";
		$var2="";
		$var3="CARGARA";
		$var4="DE";
	}


/**************************************
 *
 * CARTA DE AVISO DE ENTRADA	1
 *
 **************************************/

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //$pdf->addJpegFromFile("image004.jpg",'400','50','100','');
    //////AVISO DE LISTO///////////////////////////////////////////////////////////////////////////////////
    $pdf->addJpegFromFile("abajo.jpg",'0','10','600','');
    $pdf->addJpegFromFile("top.jpg",'5','750','580','');
    $pdf->ezText(utf8_decode('
    
    
    
    
    
    '), 10, array('justification'=>'right'));
    $pdf->ezText(utf8_decode('<b>AVISO DE ENTRADA</b>
    '), 14, array('justification'=>'center'));
    $pdf->ezText(utf8_decode(''), 10, array('justification'=>'right'));
    $pdf->ezText(utf8_decode(''), 10, array('justification'=>'right'));
//    $pdf->ezText(utf8_decode('VERACRUZ MÉXICO A . '.date('d').' DE '.$mes.' DE '.date('Y').'
	$pdf->ezText(utf8_decode('VERACRUZ MÉXICO A . _____ DE __________________ DE __________
        '), 10, array('justification'=>'right'));
    $pdf->ezText(utf8_decode(''), 10, array('justification'=>'right'));
    $pdf->ezText(utf8_decode(''), 10, array('justification'=>'right'));

    $pdf->ezText(utf8_decode('<b>C. DELEGACION REGIONAL DEL INSTITUTO NACIONAL DE MIGRACION</b>'), 10, array('justification'=>'left'));
    $pdf->ezText(utf8_decode('<b>C. DELEGADO DE SANIDAD INTERNACIONAL</b>'), 10, array('justification'=>'left'));
    $pdf->ezText(utf8_decode('<b>C. SANIDAD VEGETAL Y ANIMAL</b>'), 10, array('justification'=>'left'));
    $pdf->ezText(utf8_decode('<b>P R E S E N T E </b>'), 10, array('justification'=>'left'));
    $pdf->ezText(utf8_decode(''), 10, array('justification'=>'right'));
    $pdf->ezText(utf8_decode(''), 10, array('justification'=>'right'));
    $pdf->ezText(utf8_decode('BUQUE MOTOR:  <b><u>'.$row["vessel"].'</u></b>'), 10, array('justification'=>'right'));
    $pdf->ezText(utf8_decode('VIAJE:        <b><u>'.$row["noviaje"].'</u></b>'), 10, array('justification'=>'right'));
    $pdf->ezText(utf8_decode('NACIONALIDAD: <b><u>'.$row["flag"].'</u></b>'), 10, array('justification'=>'right'));
    $pdf->ezText(utf8_decode('MUELLE:       <b><u>'.$row["muelle"].'</u></b>'), 10, array('justification'=>'right'));
    $pdf->ezText(utf8_decode('PROCEDENCIA:  <b><u>'.$row["lastport"].'</u></b>'), 10, array('justification'=>'right'));
    $pdf->ezText(utf8_decode(''), 10, array('justification'=>'right'));
    $pdf->ezText(utf8_decode(''), 10, array('justification'=>'right'));
    $pdf->ezText(utf8_decode(''), 10, array('justification'=>'right'));
    $pdf->ezText(utf8_decode('PARA   LOS   EFECTOS   LEGALES   PROCEDENTES,   HACEMOS    DEL   CONOCIMIENTO   DE   USTED   QUE   EL B/M <u><b> '.$row["vessel"].' </b></u> DE BANDERA <u><b> '.$row["flag"].' </b></u> ARRIBARA A ESTE PUERTO, PROCEDENTE DE <u><b>'.$row["lastport"].'</b></u> ATRACANDO AL MUELLE <u><b> '.$row["muelle"].' </b></u> A LAS <u><b> '.$row["etahora"].' </b></u> DEL DIA <u><b>'.$row["eta"].'</b></u> CONDUCIENDO PARA ESTE PUERTO <u><b> '.$row["quantity"].' </b></u> TONS. DE CARGA Y   <u><b>'.$row["pasajeros"].'</b></u> PASAJEROS.

LO  QUE  INFORMAMOS  A  USTEDES  PARA  LOS  EFECTOS  POSTERIORES.

SIN MAS QUE AGREGAR AL PRESENTE, LE REITERAMOS LA SEGURIDAD DE NUESTRA ATENCION Y RESPETO.



FAVOR DE FACTURAR A NOMBRE DE:
<b><u>'.$row["razonsocial"].'</u></b>
<b><u>'.$row["domicilio"].'</u></b>
'), 10, array('justification'=>'full'));
    $pdf->ezText(utf8_decode(''), 10, array('justification'=>'right'));
    $pdf->ezText(utf8_decode(''), 10, array('justification'=>'right'));
    $pdf->ezText(utf8_decode(''), 10, array('justification'=>'right'));
    $pdf->ezText(utf8_decode('A T E N T A M E N T E'), 10, array('justification'=>'center'));
    $pdf->ezText(utf8_decode($row["firma"]), 10, array('justification'=>'center'));
    $pdf->ezText(utf8_decode('TWIN MARINE DE MÉXICO S.A. DE C.V.'), 10, array('justification'=>'center'));
    $pdf->ezText(utf8_decode($row["cargo"]), 10, array('justification'=>'center'));
    $pdf->ezNewPage();
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/**************************************
 *
 * SHORE PASS	2
 *
 **************************************/
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $pdf->addJpegFromFile("abajo.jpg",'0','10','600','');
    $pdf->addJpegFromFile("top.jpg",'5','750','580','');
    $pdf->ezText(utf8_decode('
    
    
    
    
    
    '), 10, array('justification'=>'right'));
    $pdf->ezText(utf8_decode('VERACRUZ MÉXICO A . '.date('d').' DE '.$mes.' DE '.date('Y').'	
        '), 10, array('justification'=>'right'));
    $pdf->ezText(utf8_decode(''), 10, array('justification'=>'right'));
    $pdf->ezText(utf8_decode(''), 10, array('justification'=>'right'));

    $pdf->ezText(utf8_decode('<b>INSTITUTO NACIONAL DE MIGRACION</b>'), 10, array('justification'=>'left'));
    $pdf->ezText(utf8_decode('<b>DELEGACION REGIONAL VERACRUZ</b>'), 10, array('justification'=>'left'));
    $pdf->ezText(utf8_decode('<b>P R E S E N T E </b>'), 10, array('justification'=>'left'));
    $pdf->ezText(utf8_decode(''), 10, array('justification'=>'right'));
    $pdf->ezText(utf8_decode(''), 10, array('justification'=>'right'));
    $pdf->ezText(utf8_decode('
CON FUNDAMENTO EN EL ARTICULO 42, FRACCION IX DE LA LEY GENERAL DE POBLACION Y 170 DE SU REGLAMENTO, SOLICITAMOS SE OTORGUE LA CALIDAD Y CARACTERISTICA MIGRATORIA DE NO INMIGRANTE VISITANTE LOCAL, A LOS TRIPULANTES DEL BUQUE <u><b> '.$row["vessel"].' </b></u> CON BANDERA DE <u><b> '.$row["flag"].' </b></u> CUYO ATRAQUE SE TIENE PREVISTO PARA EL DIA  <u><b> '.$row["eta"].' </b></u> EN EL MUELLE <u><b> '.$row["muelle"].' </b></u> SE ESTIMA QUE LA PERMANENCIA DE LA EMBARCACION EN EL PUERTO DE VERACRUZ SERA APROXIMADAMENTE 3 DIAS.

EN RELACION ANEXA, QUE CONTIENE LOS DATOS DE NOMBRE, CARGO, NUMERO DE PASAPORTE Y NACIONALIDAD, SE DESGLOSA A LAS SIGUIENTES PERSONAS:
'), 10, array('justification'=>'full'));
$pdf->ezText(utf8_decode(''), 10, array('justification'=>'right'));
$pdf->ezText(utf8_decode(''), 10, array('justification'=>'right'));
$pdf->ezText(utf8_decode(''), 10, array('justification'=>'right'));


//////////////////TABLA DE TRIPULANTES
$pdf->ezSetCmMargins(1,1,1,1);
    $titles = array( 'fd1'=>'NO DE TRIPULANTES', 'data1'=>'NACIONALIDAD'  );
    $options = array(
                'shadeCol'=>array(0.9,0.9,0.9),
                'xOrientation'=>'center',
                'width'=>500
    );
    $options=array('fontSize'=>10);
    $queEmp = "select * from crew where id='".$id."'";
    $resEmp2 = mysql_query($queEmp, $link);
    while($row2 = mysql_fetch_array($resEmp2)){
    $data[] = array('fd1'=>$row2["crewmembers"], 'data1'=>$row2["nacionalidad"]);
    }
    $pdf->ezTable($data, $titles,'',$options );
    unset($data);
//////////////////////////////////////
$pdf->ezText(utf8_decode('
ASI MISMO, HACEMOS DE SU CONOCIMIENTO QUE ESTA AGENCIA CONSIGNATARIA SE OBLIGA SOLIDARIA RESPONSABLE POR CUALQUIER VIOLACION Y/O SANCION A LAS DISPOSICIONES LEGALES DE LA LEY GENERAL DE POBLACION Y SU REGLAMENTO.
'), 10, array('justification'=>'full'));
    $pdf->ezText(utf8_decode(''), 10, array('justification'=>'right'));
    $pdf->ezText(utf8_decode(''), 10, array('justification'=>'right'));
    $pdf->ezText(utf8_decode(''), 10, array('justification'=>'right'));
    $pdf->ezText(utf8_decode('A T E N T A M E N T E'), 10, array('justification'=>'center'));
    $pdf->ezText(utf8_decode($row["firma"]), 10, array('justification'=>'center'));
    $pdf->ezText(utf8_decode('TWIN MARINE DE MÉXICO S.A. DE C.V.'), 10, array('justification'=>'center'));
    $pdf->ezText(utf8_decode($row["cargo"]), 10, array('justification'=>'center'));
    $pdf->ezNewPage();

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/**************************************
 *
 * PERMISO DE ENTRADA	3
 *
 **************************************/
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $pdf->addJpegFromFile("abajo.jpg",'0','10','600','');
    $pdf->addJpegFromFile("top.jpg",'5','750','580','');
    $pdf->ezText(utf8_decode('





    '), 10, array('justification'=>'right'));
    $pdf->ezText(utf8_decode('<b>PERMISO DE ENTRADA</b>
    '), 14, array('justification'=>'center'));
    $pdf->ezText(utf8_decode(''), 10, array('justification'=>'right'));
    $pdf->ezText(utf8_decode(''), 10, array('justification'=>'right'));

    $pdf->ezText(utf8_decode('<b>C. CAPITAN DE PUERTO</b>'), 10, array('justification'=>'left'));
    $pdf->ezText(utf8_decode('<b>P R E S E N T E </b>'), 10, array('justification'=>'left'));
    $pdf->ezText(utf8_decode(''), 10, array('justification'=>'right'));
    $pdf->ezText(utf8_decode(''), 10, array('justification'=>'right'));
    $pdf->ezText(utf8_decode(''), 10, array('justification'=>'right'));
    $pdf->ezText(utf8_decode('COMO CONSIGNATARIOS DEL BUQUE MOTOR <u><b> '.$row["vessel"].' </b></u> DE BANDERA <u><b> '.$row["flag"].' </b></u> PUERTO DE REGISTRO <u><b> '.$row["portofreg"].' </b></u> T.R.B. <u><b> '.$row["dwtgrt"].' </b></u> T.R.N. <u><b> '.$row["dwtnrt"].' </b></u> CAPITAN <u><b> '.$row["mastername"].' </b></u> PROCEDENTE DEL PUERTO DE <u><b> '.$row["lastport"].' </b></u> ATENTAMENTE SOLICITAMOS A USTED SE SIRVA PERMITIR QUE DICHO BUQUE ENTRE A PUERTO CON EL OBJETO DE HACER OPERACIONES DE '.$var.' DE <u><b> '.$row["quantity"].' </b></u>TONS. DE <u><b> '.$row["cargotype"].' </b></u> EN EL MUELLE <u><b> '.$row["muelle"].' </b></u> BANDA <u><b> '.$row["banda"].' </b></u> OMI<u><b> '.$row["imonbr"].' </b></u> ESLORA<u><b> '.$row["loamt"].' </b></u>MT MANGA <u><b> '.$row["breadthmouldedmt"].' </b></u>MT CALADO <u><b> '.$row["maxarrivaldraftmt"].' </b></u>MT, E.T.F.<u><b> '.$row["etf"].' </b></u> DESTINO <u><b> '.$row["etfnextport"].' </b></u> E.T.A. <u><b> '.$row["eta"].' </b></u> COLOR CASCO:<u><b> '.$row["colorcasco"].' </b></u> ARMADOR <u><b> '.$row["owners"].' </b></u>.																																																																																																																																																																																																																																																																					      

'), 10, array('justification'=>'full'));

$pdf->ezText(utf8_decode(''), 10, array('justification'=>'full'));
$pdf->ezText(utf8_decode(''), 10, array('justification'=>'full'));
$pdf->ezText(utf8_decode('LUGAR Y FECHA ULTIMOS 10 PUERTOS:
'), 10, array('justification'=>'full'));
$pdf->ezText(utf8_decode('<u><b> '.$row["portsofcalls"].' </b></u>'), 10, array('justification'=>'full'));
$pdf->ezText(utf8_decode(''), 10, array('justification'=>'full'));
$pdf->ezText(utf8_decode(''), 10, array('justification'=>'full'));
$pdf->ezText(utf8_decode('HACEMOS CONSTAR QUE NOS SOMETEREMOS A LAS DISPOSICIONES VIGENTES ANTES DE LA AMANIOBRA, DE ACUERDO A LA ORDEN DE OPERACIÓN DEL PUERTO, ASI COMO QUE ESTA SOLICITUD LA PRESENTAMOS HOY A LAS _______HRS. EL BUQUE DEBERA ENTRAR EL DIA <u><b> '.$row["eta"].' </b></u> A LAS ___________HRS. '), 10, array('justification'=>'full'));
$pdf->ezText(utf8_decode(''), 10, array('justification'=>'full'));
$pdf->ezText(utf8_decode(''), 10, array('justification'=>'full'));
$pdf->ezText(utf8_decode('VERACRUZ MÉXICO A . '.date('d').' DE '.$mes.' DE '.date('Y').''), 10, array('justification'=>'left'));
$pdf->ezText(utf8_decode(''), 10, array('justification'=>'full'));
$pdf->ezText(utf8_decode(''), 10, array('justification'=>'full'));
$pdf->ezText(utf8_decode('<b>FAVOR DE FACTURAR A NOMBRE DE:</b>'), 10, array('justification'=>'full'));
$pdf->ezText(utf8_decode(''), 10, array('justification'=>'full'));
$pdf->ezText(utf8_decode('<b><u>'.$row["razonsocial"].'</u></b>
<b><u>'.$row["domicilio"].'</u></b>
'), 10, array('justification'=>'full'));
    $pdf->ezText(utf8_decode(''), 10, array('justification'=>'right'));
	$pdf->addText(80,210,10,utf8_decode('<b>A T E N T A M E N T E</b>'));
	$pdf->addText(60,200,10,utf8_decode('<b>'.$row["firma"].'</b>'));
	$pdf->addText(50,190,10,utf8_decode('<b>TWIN MARINE DE MÉXICO S.A. DE C.V.</b>'));
	
	$pdf->addText(410,210,10,utf8_decode('<b>AUTORIZA</b>'));
	$pdf->addText(380,200,10,utf8_decode('<b>CAPITAN DE PUERTO</b>'));
	$pdf->addText(330,190,10,utf8_decode('<b>CAP.ALT. ENRIQUE CASARRUBIAS GARCÍA</b>'));
    /*$pdf->ezText(utf8_decode('<b>A T E N T A M E N T E</b>'), 10, array('justification'=>'center'));
    $pdf->ezText(utf8_decode('<b>LIC. ALEJANDRA GÓMEZ BORJA</b>'), 10, array('justification'=>'center'));
    $pdf->ezText(utf8_decode('<b>TWIN MARINE DE MÉXICO S.A. DE C.V.</b>'), 10, array('justification'=>'center'));*/
    $pdf->ezText(utf8_decode(''), 10, array('justification'=>'right'));
    /*$pdf->ezText(utf8_decode('<b>AUTORIZA</b>'), 10, array('justification'=>'center'));
    $pdf->ezText(utf8_decode('<b>CAPITAN DE PUERTO</b>'), 10, array('justification'=>'center'));
    $pdf->ezText(utf8_decode('<b>CAP.ALT. ENRIQUE CASARRUBIAS GARCÍA</b>'), 10, array('justification'=>'center'));*/
     $pdf->ezText(utf8_decode('
							  
							  
					
					
					
					
 '), 10, array('justification'=>'left'));
    $pdf->ezText(utf8_decode('<b>C.C.P..- API-VER, S.A. DE C.V.</b>'), 10, array('justification'=>'left'));
    $pdf->ezText(utf8_decode('<b>C.C.P..- PILOTOS DE PUERTOS</b>'), 10, array('justification'=>'left'));
    $pdf->ezText(utf8_decode('<b>C.C.P..- REMOLQUE Y LANCHAJE</b>'), 10, array('justification'=>'left'));

    
$pdf->ezNewPage();

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/**************************************
 *
 * CARTA PILOTOS	4
 *
 **************************************/
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   $pdf->addJpegFromFile("abajo.jpg",'0','10','600','');
    $pdf->addJpegFromFile("top.jpg",'5','750','580','');
    $pdf->ezText(utf8_decode('





    '), 10, array('justification'=>'right'));
    //$pdf->ezText(utf8_decode('VERACRUZ MÉXICO A . '.date('d').' DE '.$mes.' DE '.date('Y').'
	$pdf->ezText(utf8_decode('VERACRUZ MÉXICO A . _______ DE ______________________ DE ________
        
        '), 10, array('justification'=>'right'));
    $pdf->ezText(utf8_decode(''), 10, array('justification'=>'right'));
    $pdf->ezText(utf8_decode(''), 10, array('justification'=>'right'));

    $pdf->ezText(utf8_decode('<b>SINDICATO NACIONAL DE PILOTOS DEL PUERTO</b>'), 11, array('justification'=>'left'));
    $pdf->ezText(utf8_decode('<b>DELEGACION VERACRUZ</b>'), 11, array('justification'=>'left'));
    $pdf->ezText(utf8_decode('<b>P R E S E N T E </b>'), 11, array('justification'=>'left'));
    $pdf->ezText(utf8_decode(''), 10, array('justification'=>'right'));
    $pdf->ezText(utf8_decode(''), 10, array('justification'=>'right'));
    $pdf->ezText(utf8_decode('
    TWIN MARINE DE MÉXICO S.A. DE C.V. CON  R.F.C <u>TMM0312123M7</u>	CON DOMICILIO EN <u>ZAMORA NO. 462 DESP. 201 ALTOS</u>,  POR ESTE MEDIO NOTIFICAMOS A USTEDES  QUE   SOMOS  AGENTES CONSIGNATARIOS DEL BUQUE: <b><u>'.$row["vessel"].'</u></b> DE   BANDERA <b><u>'.$row["flag"].'</u></b> QUE ES OPERADO POR LA EMPRESA:

<b><u>'.$row["razonsocial"].'</u></b>
<b><u>'.$row["domicilio"].'</u></b>

QUE   ARRIBO    A  ESTE  PUERTO  EL  DIA '.$row["eta"].' A   LAS: _______ POR  LO  QUE  ESTAMOS  SOLICITANDO  QUE  LA   FACTURACION  SE  HAGA  A  NOMBRE  DE   NUESTRO  REPRESENTADO, TODA VEZ QUE  DICHA  FACTURA  NO  DARA  LUGAR  A  DEDUCCION NI ACREDITAMIENTO DE IMPUESTOS FEDERALES EN NUESTRO PAIS.

LA  FACTURACIÓN  DE  NUESTRO REPRESENTADO LA FUNDAMENTAMOS  EN  LA FRACCIÓN VI DE LA REGLA 34 Y 35  DE  LA MISCELANEA FISCAL VIGENTE DEL 1ro. DE ABRIL DE 1994, QUE FUE PUBLICADO EN EL DIARIO OFICIAL DE LA FEDERACIÓN EL 28 DE MARZO DE 1994.

SIN MÁS QUE AGREGAR AL PRESENTE QUEDAMOS DE USTEDES.'), 10, array('justification'=>'full'));
$pdf->ezText(utf8_decode(''), 10, array('justification'=>'right'));
$pdf->ezText(utf8_decode(''), 10, array('justification'=>'right'));
$pdf->ezText(utf8_decode('

'), 10, array('justification'=>'right'));
    $pdf->ezText(utf8_decode('<b>A T E N T A M E N T E</b>'), 10, array('justification'=>'center'));
    $pdf->ezText(utf8_decode('<b>'.$row["firma"].'</b>'), 10, array('justification'=>'center'));
    $pdf->ezText(utf8_decode('<b>TWIN MARINE DE MÉXICO S.A. DE C.V.</b>'), 10, array('justification'=>'center'));
    $pdf->ezText(utf8_decode(''), 10, array('justification'=>'right'));

$pdf->ezNewPage();

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/**************************************
 *
 * HOJA LLENADO BUQUE	5
 *
 **************************************/
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$pdf->addJpegFromFile("abajo.jpg",'0','10','600','');
    $pdf->addJpegFromFile("top.jpg",'5','750','580','');
    $pdf->ezText(utf8_decode('
    
    
    
    
    
    '), 10, array('justification'=>'right'));

$pdf->rectangle(15,600,550,120);
$pdf->addText(20,700,10,'M.V.');$pdf->addText(150,700,10,'<b>'.$row["vessel"].'</b>');
$pdf->addText(20,690,10,'FLAG:'); $pdf->addText(150,690,10,'<b>'.$row["flag"].'</b>');	$pdf->addText(400,690,10,'CALL SIGN:'); $pdf->addText(460,690,10,'<b>'.$row["callsign"].'</b>');
$pdf->addText(20,680,10,'PORT OF REGISTRY:'); $pdf->addText(150,680,10,'<b>'.$row["portofreg"].'</b>');
$pdf->addText(20,670,10,'GROSS TONS:'); $pdf->addText(150,670,10,'<b>'.$row["dwtgrt"].'</b>');	$pdf->addText(400,670,10,'NET TONS:'); $pdf->addText(460,670,10,'<b>'.$row["dwtnrt"].'</b>');
$pdf->addText(20,660,10,'L.O.A.:');  $pdf->addText(150,660,10,'<b>'.$row["loamt"].'</b>');	$pdf->addText(400,660,10,'O.M.I.:'); $pdf->addText(460,660,10,'<b>'.$row["imonbr"].'</b>');
$pdf->addText(20,650,10,'OWNERS:'); $pdf->addText(150,650,10,'<b>'.$row["owners"].'</b>');
$pdf->addText(20,640,10,'CHARTERS:');
$pdf->addText(20,630,10,'LAST PORT:'); $pdf->addText(150,630,10,'<b>'.$row["lastport"].'</b>');
$pdf->addText(20,620,10,'CAPTAIN:'); $pdf->addText(150,620,10,'<b>'.$row["mastername"].'</b>');
$pdf->addText(20,610,10,'CARGO TYPE:'); $pdf->addText(150,610,10,'<b>'.$row["cargotype"].'    '.$row["quantity"].' M.T.</b>');
$pdf->ezText(utf8_decode('
 










<b><u>ARRIVAL CONDITIONS:</b></u>
<b><u>Arrival Times:</b></u> '), 10, array('justification'=>'left'));           $pdf->addText(400,560,10,'<b>Bunkers:</b>');
$pdf->rectangle(15,438,550,155);
$pdf->addText(20,560,10,'ARRIVAL.'); $pdf->addText(200,560,10,'<b>'.$row["arrivo"].'</b>');
$pdf->addText(20,548,10,'EOSP.'); $pdf->addText(200,548,10,'<b>'.$row["eosp"].'</b> Hrs.');	$pdf->addText(400,548,10,'IFO:'); $pdf->addText(430,548,10,'<b>'.$row["ifo1"].'</b> MT');
$pdf->addText(20,536,10,'Anchorage.'); $pdf->addText(200,536,10,'<b>'.$row["anchorage"].'</b> Hrs.');	$pdf->addText(400,536,10,'MDO:'); $pdf->addText(430,536,10,'<b>'.$row["mdo1"].'</b> MT');
$pdf->addText(20,524,10,'POB'); $pdf->addText(200,524,10,'<b>'.$row["pob"].'</b> Hrs.');	$pdf->addText(400,524,10,'FW:'); $pdf->addText(430,524,10,'<b>'.$row["fw1"].'</b> MT');
$pdf->addText(20,512,10,'Crossed brakewaters.'); $pdf->addText(200,512,10,'<b>'.$row["crossedbrakewaters"].'</b> Hrs.');
$pdf->addText(20,500,10,'First line ashore.'); $pdf->addText(200,500,10,'<b>'.$row["firstlineashore"].'</b> Hrs.');      $pdf->addText(400,500,10,'Draft:');
$pdf->addText(20,488,10,'Berthed alongside'); $pdf->addText(200,488,10,'<b>'.$row["berthedalongside"].'</b> Hrs.');   $pdf->addText(400,488,10,'FWD:'); $pdf->addText(430,488,10,'<b>'.$row["fwd1"].'</b> Mts.');
$pdf->addText(20,476,10,'Authorities on board.'); $pdf->addText(200,476,10,'<b>___________________</b>Hrs.');	$pdf->addText(400,476,10,'AFW:'); $pdf->addText(430,476,10,'<b>'.$row["afw1"].'</b> Mts.');
$pdf->addText(20,464,10,'Free pratique.'); $pdf->addText(200,464,10,'<b>___________________</b>Hrs.');
$pdf->addText(20,452,10,'Start Discharging.'); $pdf->addText(200,452,10,'<b>'.$row["startdischarging"].'</b>Hrs.');
$pdf->addText(20,440,10,'Pier:'); $pdf->addText(200,440,10,'<b>'.$row["muelle"].'</b>');
$pdf->ezText(utf8_decode('











<b><u>DEPARTURE INFORMATION.</b></u>
<b><u>Sailing Times:</b></u>
'), 10, array('justification'=>'left'));
$pdf->rectangle(15,310,550,125);                                                $pdf->addText(400,400,10,'<b>Bunkers:</b>');
$pdf->addText(20,400,10,'Complete Discharge.'); $pdf->addText(200,400,10,'<b>'.$row["completedescharging"].'</b> Hrs.');
$pdf->addText(20,388,10,'Final draft Survey.'); $pdf->addText(200,388,10,'<b>'.$row["finaldraftsurvey"].'</b> Hrs.');     $pdf->addText(400,388,10,'IFO:'); $pdf->addText(430,388,10,'<b>'.$row["ifo2"].'</b> MT');
$pdf->addText(20,376,10,'Doc. On board.'); $pdf->addText(200,376,10,'<b>'.$row["doconboard"].'</b> Hrs.');	$pdf->addText(400,376,10,'MDO:'); $pdf->addText(430,376,10,'<b>'.$row["mdo2"].'</b> MT');
$pdf->addText(20,364,10,'Pilot on board.'); $pdf->addText(200,364,10,'<b>'.$row["pilotonboard"].'</b> Hrs.');	$pdf->addText(400,364,10,'FW:'); $pdf->addText(430,364,10,'<b>'.$row["fw2"].'</b> MT');
$pdf->addText(20,352,10,'Unberted from the pier.'); $pdf->addText(200,352,10,'<b>'.$row["unbertedfromthepier"].'</b> Hrs.');
$pdf->addText(20,340,10,'Crossed out breakewaters.'); $pdf->addText(200,340,10,'<b>'.$row["crossedoutbrakewaters"].'</b> Hrs.');$pdf->addText(400,340,10,'<b>Draft:</b>');
$pdf->addText(20,328,10,'ETA TO NEXT PORT.'); $pdf->addText(200,328,10,'<b>'.$row["etfnextport"].' '.$row["nextportfecha"].' '.$row["etfhora"].'</b>');	$pdf->addText(400,328,10,'FWD:'); $pdf->addText(430,328,10,'<b>'.$row["fwd2"].'</b> Mts.');
$pdf->rectangle(15,120,550,180);	$pdf->addText(400,316,10,'AFW:'); $pdf->addText(430,316,10,'<b>'.$row["afw2"].'</b> Mts.');
$pdf->addText(20,290,10,'<b>REMARKS:</b>');

/////////////////////////////////////////////////////////////////////////////////////////////////////
$pdf->ezNewPage();
/////////////////////////////////////////////////////////////////////////////////////////////////////
/**************************************
 *
 * SHIPS PARTICULARS	6
 *
 **************************************/
    $pdf->addJpegFromFile("abajo.jpg",'0','10','600','');
    $pdf->addJpegFromFile("top.jpg",'5','750','580','');
    $pdf->ezText(utf8_decode('





    '), 10, array('justification'=>'right'));
    $pdf->addText(400,700,10,'ARRIBO:____________:_________HRS');
    $pdf->addText(400,690,10,'FONDEO:____________:_________HRS');
    $pdf->addText(400,680,10,'CRUZO:____________:_________HRS');
    $pdf->addText(400,670,10,'ATRACO:____________:_________HRS');
    $pdf->addText(400,660,10,'MUELLE: <b>'.$row["muelle"].'</b>');
$pdf->ezText(utf8_decode('






VSL. NAME:  <b><u>'.$row["vessel"].'</b></u>
PORT OF REGISTRY:  <b><u>'.$row["portofreg"].'</b></u>
CALL SIGN:  <b><u>'.$row["callsign"].'</b></u>
OFICIAL NUMBER:  <b><u>'.$row["oficialnbr"].'</b></u>
IMO NUMBER:  <b><u>'.$row["imonbr"].'</b></u>
BUILDERS:  <b><u>'.$row["builders"].'</b></u>
KEEL LAID:  <b><u>'.$row["keellaid"].'</b></u>
LAUNCHED:  <b><u>'.$row["launched"].'</b></u>
CLASS:  <b><u>'.$row["class"].'</b></u>
ENGINE:  <b><u>'.$row["engine"].'</b></u>
OWNERS:  <b><u>'.$row["owners"].'</b></u>
MANAGERS:  <b><u>'.$row["managers"].'</b></u>
LENGHT:  <b><u>'.$row["loamt"].'</b></u> M.T.'), 10, array('justification'=>'left'));
    $pdf->addText(400,510,10,'DWT: <b>'.$row["dwtsummer"].'</b>');
    $pdf->addText(400,500,10,'GRT: <b>'.$row["dwtgrt"].'</b>');
    $pdf->addText(400,490,10,'NRT: <b>'.$row["dwtnrt"].'</b>');
$pdf->ezText(utf8_decode('

BREADTH: <b><u>'.$row["breadthmouldedmt"].'</b></u>
DEPTH SUMMER DRAFT: <b><u>'.$row["depthsummerdraftmt"].'</b></u>
KEEL TO MAST: <b><u>'.$row["keeltomastmt"].'</b></u>
LIGHT SHIP: <b><u>'.$row["lightship"].'</b></u>
SUEZ CERTIFICATE ISSUED: <b><u>'.$row["suezcertificateissued"].'</b></u>'), 10, array('justification'=>'left'));
    $pdf->addText(400,440,10,'GRT: <b>'.$row["suezgrt"].'</b>');
    $pdf->addText(400,430,10,'NRT: <b>'.$row["sueznrt"].'</b>');
    $pdf->addText(400,420,10,'NRT: <b>'.$row["panamanrt"].'</b>');
$pdf->ezText(utf8_decode('<b>PANAMA CERTIFICATE ISSUED: '.$row["panamacertificateissued"].'</b>'), 10, array('justification'=>'left'));
$pdf->ezText(utf8_decode('
CERTIFICATE:_________________   ISSUED:___________________   DATED ISSUED:___________________  EXPIRED DATE:____________

INTERNATIONAL TONNAGE:______________________________________________
SAFETY EQUP T:_______________________________________________________
RADIO SAFETY:________________________________________________________
SAFETY CONSTRUCTION:_________________________________________________
LOAD LINE:___________________________________________________________
OIL POLLUTION:_______________________________________________________

'), 10, array('justification'=>'left'));
$pdf->ezText(utf8_decode('
<b><u>'.$row["mastername"].'</u>
MASTER



TWIN MARINE DE MÉXICO
<u>'.$row["firma"].'</u>
OPERACIONES</b>

'), 10, array('justification'=>'center'));

$pdf->ezNewPage();
/////////////////////////////////////////////////////////////////////////////////////////////////////
/**************************************
 *
 * ISPS2	7
 *
 **************************************/
 //$pdf->addJpegFromFile("abajo.jpg",'0','10','600','');
   // $pdf->addJpegFromFile("top.jpg",'5','750','580','');
    $pdf->ezText(utf8_decode('





    '), 10, array('justification'=>'right'));
    $pdf->addJpegFromFile("sct.jpg",'80','690','140','');
    $pdf->addJpegFromFile("api.jpg",'400','690','80','');
    $pdf->ezText(utf8_decode('




    '), 10, array('justification'=>'right'));
    $pdf->rectangle(15,100,560,570);
    $pdf->ezText(utf8_decode('<b>DECLARACION DEL CAPITAN DE REQUERIMIENTOS DE SERVICIOS
GENERALES AL BUQUE</b>'), 10, array('justification'=>'center'));
    $pdf->addText(25,610,10,'FECHA: _______________');     $pdf->addText(300,610,10,'BUQUE: <b>'.$row["vessel"].'</b>');
    $pdf->addText(25,599,10,'MUELLE: <b>'.$row["muelle"].'</b>');     $pdf->addText(300,599,10,'CANAL DE TRABAJO: 16');
    $pdf->addText(25,580,10,'NOMBRE DEL CAPITAN DEL BUQUE: <b>'.$row["mastername"].'</b>');
    $pdf->addText(25,570,10,'AGENCIA NAVIERA: <b>TWIN MARINE DE MEXICO S.A. DE C.V.</b>');
    $pdf->rectangle(15,548,560,12);$pdf->rectangle(278,548,65,12);$pdf->rectangle(295,548,23,12);
    $pdf->addText(25,550,10,'<b>SERVICIOS REQUERIDOS POR EL BUQUE</b>');$pdf->addText(280,550,10,'<b>SI</b>');$pdf->addText(300,550,10,'<b>NO</b>');$pdf->addText(320,550,10,'<b>N/A</b>');$pdf->addText(400,550,10,'<b>OBSERVACIONES</b>');
    $pdf->rectangle(15,536,560,12);$pdf->rectangle(278,536,65,12);$pdf->rectangle(295,536,23,12);$pdf->addText(279,537,10,'X');
    $pdf->rectangle(15,524,560,12);$pdf->rectangle(278,524,65,12);$pdf->rectangle(295,524,23,12);$pdf->addText(279,525,10,'X');
    $pdf->rectangle(15,512,560,12);$pdf->rectangle(278,512,65,12);$pdf->rectangle(295,512,23,12);$pdf->addText(279,513,10,'X');
    $pdf->rectangle(15,500,560,12);$pdf->rectangle(278,500,65,12);$pdf->rectangle(295,500,23,12);$pdf->addText(279,501,10,'X');
    $pdf->rectangle(15,488,560,12);$pdf->rectangle(278,488,65,12);$pdf->rectangle(295,488,23,12);$pdf->addText(279,489,10,'X');
    $pdf->rectangle(15,476,560,12);$pdf->rectangle(278,476,65,12);$pdf->rectangle(295,476,23,12);$pdf->addText(279,477,10,'X');
    $pdf->rectangle(15,464,560,12);$pdf->rectangle(278,464,65,12);$pdf->rectangle(295,464,23,12);$pdf->addText(279,465,10,'X');
    $pdf->rectangle(15,452,560,12);$pdf->rectangle(278,452,65,12);$pdf->rectangle(295,452,23,12);
    $pdf->addText(25,538,10,'AVITUALLAMIENTO');
    $pdf->addText(25,526,10,'SUMINISTRO DE AGUA');
    $pdf->addText(25,514,10,'SUMINISTRO DE COMBUSTIBLE');
    $pdf->addText(25,502,10,'SUMINISTRO DE LUBRICANTE');
    $pdf->addText(25,490,10,'REPARACIONES MENORES A FLOTE');
    $pdf->addText(25,478,10,'RETIRO DE RESIDUOS PELIGROSOS');
    $pdf->addText(25,466,10,'RETIRO DE BASURA');
    $pdf->addText(25,454,10,'OTRO SERVICIO');
    $pdf->rectangle(15,440,560,12);
    $pdf->addText(270,442,10,'OBSERVACIONES');
    $pdf->rectangle(15,428,560,12);
    $pdf->rectangle(15,416,560,12);
    $pdf->rectangle(15,404,560,12);
    $pdf->ezText(utf8_decode('




















<b>1 El agente consignatario del buque, mediante el registro en el formato debe asegurarse que las
necesidades de los servicios requeridos del buque en puerto, sean declaradas por el buque.</b>'), 10, array('justification'=>'center'));
    $pdf->rectangle(15,320,560,84);
    $pdf->rectangle(15,260,560,60);
    $pdf->addText(25,205,10,'<b>'.$row["mastername"].'</b>');
    $pdf->rectangle(15,200,560,60); $pdf->rectangle(195,200,180,60);
    $pdf->addText(25,185,10,'FIRMA DEL CAPITAN');   $pdf->addText(380,185,10,utf8_decode($row["firma"]));
    $pdf->addText(25,175,10,'Y SELLO DEL BUQUE');   $pdf->addText(380,175,10,'TWIN MARINE DE MEXICO S.A. DE C.V.');
                                                    $pdf->addText(380,165,10,'TEL: 9 32 97 30	');
    $pdf->rectangle(15,140,560,60); $pdf->rectangle(195,140,180,60);
    $pdf->addText(380,120,10,'<b>API-VER-GO-F-52</b>');
	$pdf->addText(380,110,10,'<b>REV: 00 05/10/04</b>');

$pdf->ezNewPage();
/////////////////////////////////////////////////////////////////////////////////////////////////////
/**************************************
 *
 * ISPS3	8
 *
 **************************************/
    //$pdf->addJpegFromFile("abajo.jpg",'0','10','600','');
    //$pdf->addJpegFromFile("top.jpg",'5','750','580','');
    $pdf->ezText(utf8_decode('





    '), 10, array('justification'=>'right'));

    $pdf->addJpegFromFile("sct.jpg",'80','690','140','');
    $pdf->addJpegFromFile("api.jpg",'400','690','80','');
    $pdf->ezText(utf8_decode('




    '), 10, array('justification'=>'right'));
    $pdf->rectangle(15,100,560,570);
    $pdf->ezText(utf8_decode('<b>DECLARACION DE PERMISO DE TIERRA Y CAMBIOS DE PERSONAL DEL BUQUE</b>'), 10, array('justification'=>'center'));
    $pdf->addText(25,610,10,'FECHA: _______________');     $pdf->addText(300,610,10,'BUQUE: <b>'.$row["vessel"].'</b>');
    $pdf->addText(25,599,10,'MUELLE: <b>'.$row["muelle"].'</b>');     $pdf->addText(300,599,10,'CANAL DE TRABAJO: 16');

    $pdf->rectangle(20,548,550,12);$pdf->rectangle(230,548,160,12);
    $pdf->addText(25,550,10,'PERMISO DE TIERRA DE PERSONAL');$pdf->addText(235,550,10,'NACIONALIDAD');$pdf->addText(400,550,10,'OBSERVACIONES');
    $pdf->rectangle(20,536,550,12);$pdf->rectangle(230,536,160,12);
    $pdf->rectangle(20,524,550,12);$pdf->rectangle(230,524,160,12);
    $pdf->rectangle(20,512,550,12);$pdf->rectangle(230,512,160,12);
    $pdf->addText(25,538,10,'DE BUQUE');
    $pdf->addText(25,526,10,'NOMBRE TRIPULANTE');
    $pdf->addText(180,502,10,'<b>LISTAS DE TRIPULANTES ENTREGADA</b>');
    $pdf->rectangle(20,500,550,12);
    $pdf->rectangle(20,488,550,12);
    $pdf->rectangle(20,476,550,12);
    $pdf->addText(220,454,10,'<b>OBSERVACIONES</b>');
    $pdf->rectangle(20,452,550,12);
	$pdf->addText(150,444,7.5,'TODOS LOS TRIPULANTES ESTAN AUTORIZADOS A BAJAR A TIERRA');
	
	$pdf->addText(22,432,7.5,'CAMBIO DE PERSONAL DEL BUQUE');
	$pdf->addText(22,420,7.5,'NOMBRE DEL TRIPULANTE');
	$pdf->addText(240,432,7.5,'NACIONALIDAD');
	$pdf->addText(422,432,7.5,'EMB');
	$pdf->addText(475,432,7.5,'DES EMB');
	$pdf->addText(525,432,7.5,'N/A');

    $pdf->rectangle(20,430,550,12);$pdf->rectangle(20,430,210,12);$pdf->rectangle(420,430,50,12);$pdf->rectangle(520,430,50,12);
    $pdf->rectangle(20,418,550,12);$pdf->rectangle(20,418,210,12);$pdf->rectangle(420,418,50,12);$pdf->rectangle(520,418,50,12);
    $pdf->rectangle(20,406,550,12);$pdf->rectangle(20,406,210,12);$pdf->rectangle(420,406,50,12);$pdf->rectangle(520,406,50,12);
    $pdf->rectangle(20,394,550,12);$pdf->rectangle(20,394,210,12);$pdf->rectangle(420,394,50,12);$pdf->rectangle(520,394,50,12);
    $pdf->rectangle(20,382,550,12);$pdf->rectangle(20,382,210,12);$pdf->rectangle(420,382,50,12);$pdf->rectangle(520,382,50,12);
    $pdf->rectangle(20,370,550,12);$pdf->rectangle(20,370,210,12);$pdf->rectangle(420,370,50,12);$pdf->rectangle(520,370,50,12);
    $pdf->rectangle(20,358,550,12);$pdf->rectangle(20,358,210,12);$pdf->rectangle(420,358,50,12);$pdf->rectangle(520,358,50,12);
    $pdf->rectangle(20,346,550,12);$pdf->rectangle(20,346,210,12);$pdf->rectangle(420,346,50,12);$pdf->rectangle(520,346,50,12);
    $pdf->rectangle(20,334,550,12);$pdf->rectangle(20,334,210,12);$pdf->rectangle(420,334,50,12);$pdf->rectangle(520,334,50,12);
    $pdf->rectangle(20,322,550,12);$pdf->rectangle(20,322,210,12);$pdf->rectangle(420,322,50,12);$pdf->rectangle(520,322,50,12);
    $pdf->rectangle(20,310,550,12);$pdf->rectangle(20,310,210,12);$pdf->rectangle(420,310,50,12);$pdf->rectangle(520,310,50,12);
    
  
    $pdf->ezText(utf8_decode('





























<b>1   El agente naviero debe solicitar al capitan del buque los nombres y la nacionalidad del
personal que tiene permiso de tierra y de los cambios de personal para embarco y
desembarco según proceda y el canal de trabajo del buque.
</b>'), 10, array('justification'=>'center'));
    //$pdf->rectangle(15,320,560,84);
    //$pdf->rectangle(15,260,560,60);
    $pdf->addText(25,205,10,'<b>'.$row["mastername"].'</b>');
    $pdf->rectangle(15,200,560,60); $pdf->rectangle(195,200,180,60);
    $pdf->addText(25,185,10,'FIRMA DEL CAPITAN');   $pdf->addText(380,185,10,utf8_decode($row["firma"]));
    $pdf->addText(25,175,10,'Y SELLO DEL BUQUE');   $pdf->addText(380,175,10,'TWIN MARINE DE MEXICO S.A. DE C.V.');
                                                    $pdf->addText(380,165,10,'TEL: 9 32 97 30	');
    $pdf->rectangle(15,140,560,60); $pdf->rectangle(195,140,180,60);
    $pdf->addText(380,120,10,'<b>API-VER-GO-F-49</b>');
	$pdf->addText(380,110,10,'<b>REV: 00 05/10/04</b>');

$pdf->ezNewPage();
/////////////////////////////////////////////////////////////////////////////////////////////////////
/**************************************
 *
 * CARATULA SCT		9
 *
 **************************************/
    $pdf->addJpegFromFile("abajo.jpg",'0','10','600','');
    $pdf->addJpegFromFile("top.jpg",'5','750','580','');
    $pdf->ezText(utf8_decode('





    '), 10, array('justification'=>'right'));
    $pdf->addJpegFromFile("sct2.jpg",'80','690','80','');
    $pdf->ezText(utf8_decode('SECRETARIA DE COMUNICACIONES Y TRANSPORTES
CAPITANIA DE PUERTO: VERACRUZ, VER
'), 10, array('justification'=>'right'));
    $pdf->addText(340,690,10,'<b>SOLICITUD DE TRAMITE</b>');
    $pdf->rectangle(15,200,560,480);
    $pdf->rectangle(15,665,560,15);
    $pdf->addText(25,667,10,'TRAMITE 5C');      $pdf->addText(300,667,10,'AUTORIZACION DE DESPACHO DE EMBARCACIONES');

    $pdf->addText(25,650,10,'NOMBRE DEL SOLICITANTE:');      $pdf->addText(200,650,10,'<b>TWIN MARINE DE MEXICO S.A. DE C.V.</b>');
    $pdf->addText(25,630,10,'R.F.C.:');      $pdf->addText(120,630,10,'<b>TMM0312123M7</b>');
    $pdf->addText(25,610,10,'DOMICILIO:');      $pdf->addText(120,610,10,'<b>GUTIERREZ ZAMORA 462 DESP. 201</b>');$pdf->addText(350,610,10,'COD.POST.');      $pdf->addText(450,610,10,'<b>91700</b>');
    $pdf->addText(25,590,10,'MUNICIPIO:');      $pdf->addText(120,590,10,'<b>VERACRUZ</b>');$pdf->addText(350,590,10,'TELEFONO:');      $pdf->addText(450,590,10,'<b>9329730</b>');
    $pdf->addText(25,570,10,'ESTADO:');      $pdf->addText(120,570,10,'<b>VERACRUZ</b>');$pdf->addText(350,570,10,'FAX:');      $pdf->addText(450,570,10,'<b>9316482</b>');
    $pdf->addText(25,550,10,'PAIS:');      $pdf->addText(120,550,10,'<b>MEXICO</b>');
$pdf->rectangle(15,200,560,320);
    $pdf->addText(25,500,10,'NOMBRE DE LA EMBARCACION:');      $pdf->addText(200,500,10,'<b>'.$row["vessel"].'</b>');
    $pdf->addText(25,480,10,'PROPOSITO DEL VIAJE:');      $pdf->addText(200,480,10,'<b>___________________</b>');
    $pdf->addText(25,460,10,'PUERTO DE DESTINO:');      $pdf->addText(200,460,10,'<b>'.$row["etfnextport"].'</b>');
    $pdf->addText(25,440,10,'DOCUMENTOS ENTREGADOS:');
    
    $pdf->addText(180,430,10,'1.-	SAFETY CONSTRUCTIONS CERTIFICATE');
    $pdf->addText(180,420,10,'2.-	SAFETY EQUIPMENT CERTIFICATE');
    $pdf->addText(180,410,10,'3.-	SAFETY RADIO CERTIFICATE');
    $pdf->addText(180,400,10,'4.-	SAFETY MANAGEMENT CERTIFICATE');
    $pdf->addText(180,390,10,'5.-	MINIMUM SAFETY MANAGEMENT');
    $pdf->addText(180,380,10,'6.-	CERTIFICATE OF REGISTRY');
    $pdf->addText(180,370,10,'7.-	OIL POLLUTION PREVETION');
    $pdf->addText(180,360,10,'8.-	INTERNATIONAL LOAD LINE');
    $pdf->addText(180,350,10,'9.-	LISTAS DE TRIPULANTES');
    $pdf->addText(180,340,10,'10.-	CALCULO DE ESTABILIDAD');
    $pdf->addText(180,330,10,'11.-	PLANO DE ESTIBA '.$var2.'');
    $pdf->addText(180,320,10,'12.-	CERTIFICADO DE NO ADEUDO DE A.P.I.');
    $pdf->addText(180,310,10,'13.-	DESPACHO DE SANIDAD');
    $pdf->addText(180,300,10,'14.-	PERMISOS DE SALIDA');
    $pdf->addText(300,150,10,'<b>FECHA:</b> '.date('d').' DE '.$mes.' DE '.date('Y').'');

$pdf->ezText(utf8_decode('











































NOMBRE DE LA AGENCIA								
<b>TWIN MARINE DE MEXICO S.A. DE C.V.</b>
					
<b>'.$row["firma"].'</b>
'.$row["cargo"].'
    '), 10, array('justification'=>'left'));

$pdf->ezNewPage();
/////////////////////////////////////////////////////////////////////////////////////////////////////
/**************************************
 *
 * CARATULA SCT II	11
 *
 **************************************/
    $pdf->addJpegFromFile("abajo.jpg",'0','10','600','');
    $pdf->addJpegFromFile("top.jpg",'5','750','580','');
    $pdf->ezText(utf8_decode('





    '), 10, array('justification'=>'right'));
    $pdf->addJpegFromFile("sct2.jpg",'80','690','80','');
    $pdf->ezText(utf8_decode('SECRETARIA DE COMUNICACIONES Y TRANSPORTES
CAPITANIA DE PUERTO: VERACRUZ, VER
'), 10, array('justification'=>'right'));
    $pdf->addText(340,690,10,'<b>SOLICITUD DE TRAMITE</b>');
    $pdf->rectangle(15,200,560,480);
    $pdf->rectangle(15,665,560,15);
    $pdf->addText(25,667,10,'TRAMITE 5C');      $pdf->addText(300,667,10,'AUTORIZACION DE ARRIBO DE EMBARCACIONES');

    $pdf->addText(25,650,10,'NOMBRE DEL SOLICITANTE:');      $pdf->addText(200,650,10,'<b>TWIN MARINE DE MEXICO S.A. DE C.V.</b>');
    $pdf->addText(25,630,10,'R.F.C.:');      $pdf->addText(120,630,10,'<b>TMM0312123M7</b>');
    $pdf->addText(25,610,10,'DOMICILIO:');      $pdf->addText(120,610,10,'<b>GUTIERREZ ZAMORA 462 DESP. 201</b>');$pdf->addText(350,610,10,'COD.POST.');      $pdf->addText(450,610,10,'<b>91700</b>');
    $pdf->addText(25,590,10,'MUNICIPIO:');      $pdf->addText(120,590,10,'<b>VERACRUZ</b>');$pdf->addText(350,590,10,'TELEFONO:');      $pdf->addText(450,590,10,'<b>9329730</b>');
    $pdf->addText(25,570,10,'ESTADO:');      $pdf->addText(120,570,10,'<b>VERACRUZ</b>');$pdf->addText(350,570,10,'FAX:');      $pdf->addText(450,570,10,'<b>9316482</b>');
    $pdf->addText(25,550,10,'PAIS:');      $pdf->addText(120,550,10,'<b>MEXICO</b>');
$pdf->rectangle(15,200,560,320);
    $pdf->addText(25,500,10,'NOMBRE DE LA EMBARCACION:');      $pdf->addText(300,500,10,'<b>'.$row["vessel"].'</b>');
    $pdf->addText(25,480,10,'TIPO DE LA EMBARCACION:');      $pdf->addText(300,480,10,'<b>'.$row["vesseltype"].'</b>');
    $pdf->addText(25,460,10,'TIPO DE CARGA QUE TRANSPORTA:');      $pdf->addText(300,460,10,'<b>'.$row["cargotype"].'</b>');
	$pdf->addText(25,440,10,'PUERTO DE PROCEDENCIA DE LA EMBARCACION:');      $pdf->addText(300,440,10,'<b>'.$row["lastport"].'</b>');
	$pdf->addText(25,420,10,'HORARIO PREVISTO DE ARRIBO DE LA EMBARCACION:');      $pdf->addText(300,420,10,'<b>___________________________</b>');
	
    $pdf->addText(25,400,10,'DOCUMENTOS ENTREGADOS:');
        
    $pdf->addText(180,390,10,'1.-	CARATULA DE AUTORIZACION DE ARRIBO (SCT)');
    $pdf->addText(180,380,10,'2.-	SHIP\'S PARTICULARS (3 COPIAS)');
    $pdf->addText(180,370,10,'3.-	CERTIFICADO DE TONELAJE 1969 (1 COPIA)');
    $pdf->addText(180,360,10,'4.-	DATOS DE ARRIBO ISPS (INC. CERT. SEGURIDAD Y SINOPSIS)');
    $pdf->addText(180,350,10,'5.-	DESPACHO ULTIMO PUERTO (1 ORIGINAL)');
    $pdf->addText(180,340,10,'6.-	BITACORA DEL ULTIMO PUERTO (1 COPIA)');
    $pdf->addText(180,330,10,'7.-	LIBRE PLATICA (ORIGINAL)');
    $pdf->addText(180,320,10,'8.-	ACTA INSPECCION SAGARPA (ORIGINAL)');
    $pdf->addText(180,310,10,'9.-	LISTA DE TRIPULANTES (3 COPIAS)');
    $pdf->addText(180,300,10,'10.-	LISTA DE EFECTOS PERSONALES (1 COPIA)');
	$pdf->addText(180,290,10,'11.-	LISTA DE PROVISIONES (1 COPIA)');
	$pdf->addText(180,280,10,'12.-	LISTA DE PUERTOS (1 COPIA)');
	$pdf->addText(180,270,10,'13.-	NIL LIST (1 COPIA)');
	$pdf->addText(180,260,10,'14.-	CARTA DE CONSIGNACION (1 ORIGINAL)');
	$pdf->addText(180,250,10,'15.-	CERTIFICATE OF ENTRY (1 COPIA)');
    $pdf->addText(300,150,10,'<b>FECHA:</b> '.date('d').' DE '.$mes.' DE '.date('Y').'');

$pdf->ezText(utf8_decode('











































NOMBRE DE LA AGENCIA								
<b>TWIN MARINE DE MEXICO S.A. DE C.V.</b>
					
<b>'.$row["firma"].'</b>
'.$row["cargo"].'
    '), 10, array('justification'=>'left'));

$pdf->ezNewPage();
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/**************************************
 *
 * ISPS1	12
 *
 **************************************/$pdf->addJpegFromFile("abajo.jpg",'0','10','600','');
    $pdf->addJpegFromFile("top.jpg",'5','750','580','');
    $pdf->ezText(utf8_decode('





    '), 10, array('justification'=>'right'));
    //$pdf->ezText(utf8_decode('VERACRUZ MÉXICO A . '.date('d').' DE '.$mes.' DE '.date('Y').'
	$pdf->ezText(utf8_decode('VERACRUZ MÉXICO A . _______ DE ______________________ DE ________
        '), 10, array('justification'=>'right'));
    $pdf->ezText(utf8_decode(''), 10, array('justification'=>'right'));
    $pdf->ezText(utf8_decode(''), 10, array('justification'=>'right'));
    $pdf->ezText(utf8_decode('<b>
CAPITANIA DE PUERTO
COORDINACION GENERAL DE PUERTOS
Y MARINA MERCANTE
</b>
'), 10, array('justification'=>'left'));
$pdf->ezText(utf8_decode('<b>
AT\'N. DIRECCION GENERAL DE CAPITANIA
DE PUERTO REGIONAL VERACRUZ
</b>
'), 10, array('justification'=>'center'));

$pdf->ezText(utf8_decode('DATOS DE ARRIBO REFERENTES AL CODIGO PBIP (ISPS)
		'), 10, array('justification'=>'left'));
    $pdf->addText(20,516,10,'NOMBRE DEL BUQUE (Ship\'s name):');      $pdf->addText(310,516,10,'<b>'.$row["vessel"].'</b>');
    $pdf->rectangle(15,514,560,12);$pdf->rectangle(295,514,280,12);
    $pdf->addText(20,504,10,'PABELLON DEL BUQUE: (Nationality):');      $pdf->addText(310,504,10,'<b>'.$row["flag"].'</b>');
    $pdf->rectangle(15,502,560,12);$pdf->rectangle(295,502,280,12);
    $pdf->addText(20,492,10,'TIPO DE BUQUE (Type of Ship):');      $pdf->addText(310,492,10,'<b>'.$row["vesseltype"].'</b>');
    $pdf->rectangle(15,490,560,12);$pdf->rectangle(295,490,280,12);
    $pdf->addText(20,480,10,'NUMERO DE OMI (IMO Number):');      $pdf->addText(310,480,10,'<b>'.$row["imonbr"].'</b>');
    $pdf->rectangle(15,478,560,12);$pdf->rectangle(295,478,280,12);
    $pdf->addText(20,468,10,'ARQUEO BRUTO (Gross Tons):');      $pdf->addText(310,468,10,'<b>'.$row["dwtgrt"].'</b>');
    $pdf->rectangle(15,466,560,12);$pdf->rectangle(295,466,280,12);
    $pdf->addText(20,456,10,'PESO MUERTO (Deadweight):');      $pdf->addText(310,456,10,'<b>'.$row["dwtsummer"].'</b>');
    $pdf->rectangle(15,454,560,12);$pdf->rectangle(295,454,280,12);
    $pdf->addText(20,444,10,'AÑO DE CONSTRUCCION (Year of built):');      $pdf->addText(310,444,10,'<b>'.$row["keellaid"].'</b>');
    $pdf->rectangle(15,442,560,12);$pdf->rectangle(295,442,280,12);
    $pdf->addText(20,432,10,'PESO MUERTO (Deadweight):');      $pdf->addText(310,432,10,'<b>'.$row["dwtsummer"].'</b>');
    $pdf->rectangle(15,430,560,12);$pdf->rectangle(295,430,280,12);//
    $pdf->addText(20,422,10,'CERTIFICADO DE SEGURIDAD INTERNACIONAL');      $pdf->addText(310,422,10,'<b>SE ANEXA</b>');
    $pdf->addText(20,412,10,'DEL BUQUE.');
    $pdf->addText(20,402,10,'( International Ship security certificate )');
    $pdf->rectangle(15,400,560,30);$pdf->rectangle(295,400,280,30);
    $pdf->addText(20,390,10,'NIVEL DE PROTECCION DEL BUQUE');      $pdf->addText(310,390,10,'<b>LEVEL 1</b>');
    $pdf->addText(20,380,10,'(Vessel\'s security level)');
    $pdf->rectangle(15,370,560,30);$pdf->rectangle(295,370,280,30);
    $pdf->addText(20,360,10,'REGISTRO SINOPTICO DEL BUQUE');      $pdf->addText(310,360,10,'<b>YES</b>');
    $pdf->addText(20,350,10,'(Continuous sinopsis record)');      $pdf->addText(310,350,10,'<b>SE ANEXA</b>');
    $pdf->rectangle(15,340,560,30);$pdf->rectangle(295,340,280,30);
    /*

        $data[] = array('fd1'=>'CERTIFICADO DE SEGURIDAD INTERNACIONAL DEL BUQUE. ( International Ship security certificate )', 'data1'=>'');
        $data[] = array('fd1'=>'NIVEL DE PROTECCION DEL BUQUE (Vessel\'s security level)', 'data1'=>$row["pool"]);
        $data[] = array('fd1'=>'REGISTRO SINOPTICO DEL BUQUE', 'data1'=>$row["pool"]);

    $pdf->ezTable($data,'','',$options );

    unset($data);
/////////////////////////////////////////////////////////////
		*/
$pdf->ezText(utf8_decode('

















		ANEXAMOS COPIAS DE LOS DOCUMENTOS QUE ANTERIORMENTE SE DETALLARON EN																								
		LA INFORMACION																								
																										
		SIN MAS POR EL MOMENTO QUEDO DE UD. COMO SU ATTO. Y SEGURO SERVIDOR																								
																										
																										
ATENTAMENTE																										
'.$row["firma"].'																										
TWIN MARINE DE MÉXICO S.A. DE C.V.
'.$row["cargo"].'																										
'), 10, array('justification'=>'left'));
 
$pdf->ezNewPage();
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/**************************************
 *
 *  CONSIGNACION ADUANA	15
 *
 **************************************/
    $pdf->addJpegFromFile("abajo.jpg",'0','10','600','');
    $pdf->addJpegFromFile("top.jpg",'5','750','580','');
    $pdf->ezText(utf8_decode('





    '), 10, array('justification'=>'right'));
//$pdf->ezText(utf8_decode('VERACRUZ MÉXICO A . '.date('d').' DE '.$mes.' DE '.date('Y').'
$pdf->ezText(utf8_decode('VERACRUZ MÉXICO A . _______ DE ______________________ DE ________
        '), 10, array('justification'=>'right'));
        
 $pdf->ezText(utf8_decode('       													
<b>DEAR SIR, ADMINISTRATOR OF THE CUSTOM																										
HOUSE FROM VERACRUZ PORT																										
																										
																										
C. ADMINISTRADOR DE LA ADUANA MARITIMA 																										
DE VERACRUZ</b>
'), 12, array('justification'=>'left'));
$pdf->ezText(utf8_decode('															
THE UNDERSIGNED CAPTAIN FROM THE MOTOR VESSEL <b><u>'.$row["vessel"].'</b></u>
																										
EL   QUE   SUSCRIBE   CAPITAN   DEL   BUQUE   MOTOR		<b><u>'.$row["vessel"].'</b></u>				
																										
WITH FLAG FROM <b><u>'.$row["flag"].'</b></u> BERTHING TO PORT ON DATE													
																										
CON BANDERA DE <b><u>'.$row["flag"].'</b></u> ENTRADO A PUERTO EN LA FECHA													
																										
																										
ATTENTIVELY  I  INFORM  YOU  THAT  IN  ACCORDANCE  WITH  TO  WRITING  IN   THE  ARTICLE  12 FROM THE MEXCIAN CUSTOM HOUSE 																										
ATENTAMENTE SE PERMITE COMUNICAR A USTED QUE DE CONFORMIDAD CON LO PREVISTO EN EL ARTICULO 12 DE LA LEY ADUANERA																										
																										
IN FORCE I DESIGNATED  AS  MY  AGENTS  IN  THIS  PORT  TO  MESSRS.  TWIN  MARINE  DE  MÉXICO  S.A.  DE  C.V.  WHOM   WILL  BE
EN VIRGOR,HE DESIGNADO COMO MIS AGENTES EN ESTE PUERTO A LOS SRES.  TWIN MARINE DE MÉXICO S.A. DE C.V.  LOS  CUALES
																										
																										
IN CHARGE ABOUT ALL THE ARRIVAL AND SAILING FORMALLITIES OF THE CAPTIONED VESSEL UNDER MI COMMAND.																										
SE ENCARGARAN DE LOS TRAMITES DE  ENTRADA Y DESPACHO DEL BUQUE A MI MANDO.

'), 10, array('justification'=>'left'));
$pdf->ezText(utf8_decode('	

RESPECTFULLY / RESPETUOSAMENTE																										
<b>MASTER OF THE VESSEL/CAPITAN DEL BUQUE																										
																										
																										
																										
<b><u>'.$row["mastername"].'</b></u></b>
'), 10, array('justification'=>'center'));
$pdf->ezText(utf8_decode('	
ACEPTAMOS LA CONSIGNACION																										
																										
<b>																										
LIC. ARMANDO QUIÑONEZ LOPEZ																										
TWIN MARINE DE MÉXICO S.A. DE C.V.
AS PORT AGENTS ONLY / COMO AGENTES DE PUERTO</b>
'), 10, array('justification'=>'left'));

$pdf->ezNewPage();
/////////////////////////////////////////////////////////////////////////////////////////////////////
/**************************************
 *
 *  AVISO DE SALIDA		16
 *
 **************************************/
    $pdf->addJpegFromFile("abajo.jpg",'0','10','600','');
    $pdf->addJpegFromFile("top.jpg",'5','750','580','');
    $pdf->ezText(utf8_decode('





    '), 10, array('justification'=>'right'));
$pdf->ezText(utf8_decode('AVISO   DE   SALIDA																										

'), 12, array('justification'=>'center'));
$pdf->ezText(utf8_decode('

VERACRUZ MÉXICO A . '.date('d').' DE '.$mes.' DE '.date('Y').'

        '), 10, array('justification'=>'right'));
        $pdf->ezText(utf8_decode('
<b>
C. DELEGACION REGIONAL DEL INSTITUTO NACIONAL DE MIGRACION																										
C. DELEGADO DE SANIDAD INTERNACIONAL																										
P R E S E N T E</b>

'), 10, array('justification'=>'left'));
$pdf->ezText(utf8_decode('																										
CAPITAN: <b><u>'.$row["mastername"].'</b></u>
TON. BRUTO: <b><u>'.$row["dwtgrt"].'</b></u>						
TON. NETO: <b><u>'.$row["dwtnrt"].'</b></u>
TRIPULANTES: <b><u>'.$row["allmembers"].'</b></u>
'), 10, array('justification'=>'right'));
$pdf->ezText(utf8_decode('
PARA LOS EFECTOS LEGALES PROCEDENTES, HACEMOS DEL CONOCIMIENTO DE USTED QUE EL B.M.	<b><u>'.$row["vessel"].'</b></u> DE BANDERA <b><u>'.$row["flag"].'</b></u> ZARPARA DE ESTE PUERTO CON DESTINO A:									

																										
<b><u>'.$row["etfnextport"].'</b></u> ZARPANDO DEL MUELLE <b><u>'.$row["muelle"].'</b></u>  A LAS	_________ HRS. DEL DIA _____________________________ ZARPANDO DE ESTE PUERTO CON :	<b><u>'.$row["cargaentransito"].'</b></u> <b><u>'.$row["tonstrans"].'</b></u> TONS.  DE CARGA Y  <b><u>'.$row["pasajeros"].'</b></u>  PASAJEROS.
																										
LO  QUE  INFORMAMOS  A  USTEDES  PARA  LOS  EFECTOS  POSTERIORES.																										
																										
SIN MAS QUE AGREGAR AL PRESENTE, LE REITERAMOS LA SEGURIDAD DE NUESTRA ATENCION Y RESPETO.																										
																										
FAVOR DE FACTURAR A NOMBRE DE:																										
<b><u>'.$row["razonsocial"].'</b></u>																									
<b><u>'.$row["domicilio"].'</b></u>																	
																										
																										
A T E N T A M E N T E 																										
																										
'.$row["firma"].'																										
TWIN MARINE DE MÉXICO S.A. DE C.V.
'.$row["cargo"].'																								
'), 10, array('justification'=>'full'));
$pdf->ezNewPage();
/////////////////////////////////////////////////////////////////////////////////////////////////////
/**************************************
 *
 *  PERMISO DE SALIDA	17
 *
 **************************************/
    $pdf->addJpegFromFile("abajo.jpg",'0','10','600','');
    $pdf->addJpegFromFile("top.jpg",'5','750','580','');
    $pdf->ezText(utf8_decode('





    '), 10, array('justification'=>'right'));
$pdf->ezText(utf8_decode('<b>PERMISO DE SALIDA</b>'), 12, array('justification'=>'center'));
$pdf->ezText(utf8_decode('
ETA. PTO. DESTINO <b><u>'.$row["etfnextport"].'</b></u>
ESLORA    <b><u>'.$row["loamt"].'</b></u> M.T.			
CALADO PROA	<b><u>'.$row["fwd2"].'</b></u> MT			
CALADO POPA <b><u>'.$row["aft2"].'</b></u> MT			
COMBUSTIBLE D.O. <b><u>'.$row["mdo2"].'</b></u> MT		
F.O. <b><u>'.$row["ifo2"].'</b></u> MT	FW:	<b><u>'.$row["fw2"].'</b></u> MT
'), 10, array('justification'=>'right'));
$pdf->ezText(utf8_decode('
C. CAPITAN DE PUERTO																										
P  R  E  S  E  N  T  E																										
'), 10, array('justification'=>'left'));
$pdf->ezText(utf8_decode('																										
COMO CONSIGNATARIOS DEL BUQUE  <b><u>'.$row["vessel"].'</b></u> DEL PORTE DE <b><u>'.$row["dwtgrt"].'</b></u> TONS. BRUTAS Y DE <b><u>'.$row["dwtnrt"].'</b></u> TONS, NETAS CON BANDERA DE <b><u>'.$row["flag"].'</b></u> Y CON MATRICULA <b><u>'.$row["portofreg"].'</b></u>	ATENTAMENTE SOLICITAMOS A	USTED  SE  SIRVA A CONCEDERNOS  EL  PERMISO  DE  SALIDA  CON  DESTINO  AL PUERTO DE <b><u>'.$row["etfnextport"].'</b></u>, AL MANDO DEL CAPITAN <b><u>'.$row["mastername"].'</b></u> LLEVANDO	<b><u>'.$row["allmembers"].'</b></u> TRIPULANTES	INCLUSIVE SU CAPITAN. HABIENDO TOMADO EN ESTE PUERTO <b><u>'.$row["pasajeros"].'</b></u> PASAJEROS, Y  <b><u>'.$row["cargatomada"].'</b></u> <b><u>'.$row["tonstom"].'</b></u> TONS. DE CARGA, Y EN TRANSITO LLEVA 0 PASAJEROS, Y <b><u>'.$row["cargaentransito"].'</b></u> <b><u>'.$row["tonstrans"].'</b></u> TONS. DE CARGA.

HACEMOS  CONSTAR  QUE   NOS  SOMETEREMOS  A  LAS  DISPOSICIONES  VIGENTES  ANTES DE LA MANIOBRA, DE ACUERDO AL ORDEN DE LA OPERACIÓN  DEL  PUERTO,  ASI  COMO  QUE ESTA SOLICITUD LA PRESENTAMOS HOY A LAS __________HORAS. TODOS LOS REQUERIMIENTOS DE SEGURIDAD PARA HACERCE A LA MAR.																										

EL BUQUE  ZARPARA EL DIA  _____________________ A LAS	23:00	HORAS, DEL MUELLE <b><u>'.$row["muelle"].'</b></u> VERACRUZ MÉXICO A . '.date('d').' DE '.$mes.' DE '.date('Y').'

'), 10, array('justification'=>'full'));
$pdf->ezText(utf8_decode('
A T E N T A M E N T E															
																										
'.$row["firma"].'																										
TWIN MARINE DE MÉXICO S.A. DE C.V.
'), 10, array('justification'=>'center'));
$pdf->ezText(utf8_decode('												
																										
																										
SE AUTORIZA:
EL CAPITAN DE PUERTO
																										
CAP.ALT. ENRIQUE CASARRUBIAS GARCÍA																										
C.C.P..- Admon. Port. Integral de Veracruz S.A. de C.V.
C.C.P..- Pilotos de Puerto.
C.C.P..- Remolque y Lanchaje

FACTURA A NOMBRE DE:
<b><u>'.$row["razonsocial"].'</b></u>
<b><u>'.$row["domicilio"].'</b></u>
'), 10, array('justification'=>'left'));																										
$pdf->addText(340,220,10,'NO EXISTE ADEUDO');
$pdf->addText(340,210,10,'ADMINISTRACION PORTUARIA INTEGRAL');
$pdf->addText(340,200,10,'DE VERACRUZ, S.A. DE C.V.');
$pdf->ezNewPage();
/////////////////////////////////////////////////////////////////////////////////////////////////////
/**************************************
 *
 *  API ACCESOS		18
 *
 **************************************/

    $pdf->addJpegFromFile("topx.jpg",'15','720','100','100');
$pdf->ezText(utf8_decode('<b>
SERVICIOS DE SALUD DE VERACRUZ
HEALTH SERVICES OF VERACRUZ
COORDINACION JURISDICCIONAL DE EPIDEMIOLOGIA
JURISDICTIONAL COORDINATION OF EPIDEMIOLOGY
SANIDAD INTERNACIONAL
INTERNATIONAL HEALTH</b>
'), 12, array('justification'=>'center'));

$pdf->addText(130,660,10,utf8_decode('<b>'.$row["mastername"].'</b>'));
$pdf->addText(40,625,10,utf8_decode('<b>'.$row["vessel"].'</b> '));
$pdf->addText(280,625,10,utf8_decode('<b>'.$row["dwtgrt"].'</b> '));
$pdf->addText(180,590,10,utf8_decode('<b>'.$row["dwtnrt"].'</b>'));


$pdf->ezText(utf8_decode('


EL SUSCRITO  __________________________________________________________ CAPITAN DEL BUQUE 
The undersigned                                                                                                                       master of m/v

_____________________________________ DE ___________________________________________________ 
                                                                           of

TONELADAS BRUTAS Y ________________________________________________________ TONELADAS NETAS
Gross tonnage and                                                                                                                       net tonnage

'), 10, array('justification'=>'full'));
$pdf->ezText(utf8_decode('
C E R T I F I C A
DECLARES

'), 10, array('justification'=>'center'));
$pdf->ezText(utf8_decode('
QUE HOY __________________________  DE _________________________ DEL ______  A LAS ____HRS. 
That today

FUERON PRACTICADAS LAS VERIFICACIONES SANITARIAS REGLAMENTADAS
Was practicad the sanitary inspection Ander sanitary

DE SALIDA CON EL SIGUIENTE RESULTADO.
Rules with the following result.
'), 10, array('justification'=>'full'));
$pdf->ezText(utf8_decode('


CONDICIONES SANITARIAS DEL BARCO _________________<u>BUENAS</u>___________ TRIPULANTES: <b>'.$row["allmembers"].'</b>
Ship sanitary conditions                                                                                           crew members: 

<b><u>'.$row["allmembers"].'</u></b> PASAJEROS: ________________<u><b>'.$row["pasajeros"].'</b></u>__________________   DESTINO FINAL: __<u><b>'.$row["etfnextport"].'</b></u>___
<b><u>'.$row["allmembers"].'</u></b>  Passengers ___________________________________   final destiny: _______________________________

'), 10, array('justification'=>'full'));
$pdf->ezText(utf8_decode('
O B S E R V A C I O N E S
REMARKS

_____________________________________<u>NINGUNA</u>___________________________________________
______________________________________________________________________________________________

'), 10, array('justification'=>'center'));
$pdf->ezText(utf8_decode('

     CAPITAN                                                                                                        
     Master
	 <b>'.$row["mastername"].'</b>
	 
________________________ 
'), 10, array('justification'=>'left'));
$pdf->addText(380,160,10,utf8_decode('______________________'));
$pdf->addText(380,150,10,utf8_decode('JEFE DEL SERVICIO DE'));
$pdf->addText(380,140,10,utf8_decode('Chief of internacional'));
$pdf->addText(380,130,10,utf8_decode('SANIDAD INTERNATIONAL'));
$pdf->addText(380,120,10,utf8_decode('Sanitary services '));
$pdf->addText(380,110,10,utf8_decode('MEXICO________________'));
$pdf->addText(440,100,10,utf8_decode('No'));
$pdf->addText(380,90,10,utf8_decode('--------------------------'));

$pdf->ezNewPage();
/////////////////////////////////////////////////////////////////////////////////////////////////////
/**************************************
 *
 *  RENOVACION BAJAR A TIERRA	19
 *
 **************************************/
    $pdf->addJpegFromFile("abajo.jpg",'0','10','600','');
    $pdf->addJpegFromFile("top.jpg",'5','750','580','');
    $pdf->ezText(utf8_decode('





    '), 10, array('justification'=>'right'));
//$pdf->ezText(utf8_decode('VERACRUZ MÉXICO A . '.date('d').' DE '.$mes.' DE '.date('Y').'
$pdf->ezText(utf8_decode('VERACRUZ MÉXICO A . _______ DE ______________________ DE ________

        '), 10, array('justification'=>'right'));
$pdf->ezText(utf8_decode('      
 
INSTITUTO NACIONAL DE MIGRACION																										
DELEGACION REGIONAL VERACRUZ																										
P R E S E N T E																										
																										
																										
																										
																										
	CON FUNDAMENTO EN EL ARTICULO 42,  FRACCION IX DE LA LEY GENERAL DE POBLACION  Y  170 DE SU REGLAMENTO, SOLICITAMOS SE EXTIENDA  LA CALIDAD Y  CARACTERISTICA  MIGRATORIA DE  NO  INMIGRANTE  VISITANTE  LOCAL,  A  LOS  TRIPULANTES  DEL   BUQUE CON BANDERA DE <b><u>'.$row["flag"].'</u>  "<u>'.$row["vessel"].'</u>" EL CUAL ARRIBO A ESTE  PUERTO EL DIA  ____  DE  ____________  DE _____ </b> Y ACTUALMENTE   SE   ENCUENTRA   ATRACADO EN EL MUELLE <b><u>'.$row["muelle"].'</u></b> SE ESTIMA QUE LA EMBARCACION PERMANEZCA EN EL PUERTO DE VERACRUZ POR UN PERIODO MAS DE ________ DIAS.
																										
																										
	EN RELACION ANEXA, QUE CONTIENE LOS DATOS DE NOMBRE, CARGO, NUMERO DE PASAPORTE	Y NACIONALIDAD, SE DESGLOSA A LAS SIGUIENTES PERSONAS:
	'), 10, array('justification'=>'full'));

//////////////////TABLA DE TRIPULANTES
$pdf->ezSetCmMargins(1,1,1,1);
    $titles = array( 'fd1'=>'NO DE TRIPULANTES', 'data1'=>'NACIONALIDAD'  );
    $options = array(
                'shadeCol'=>array(0.9,0.9,0.9),
                'xOrientation'=>'center',
                'width'=>500
    );
    $options=array('fontSize'=>10);
    $queEmp = "select * from crew where id='".$row["id"]."'";
    $resEmp2 = mysql_query($queEmp, $link);
    while($row2 = mysql_fetch_array($resEmp2)){
    $data[] = array('fd1'=>$row2["crewmembers"], 'data1'=>$row2["nacionalidad"]);
    }
    $pdf->ezTable($data, $titles,'',$options );
    unset($data);
//////////////////////////////////////
$pdf->ezText(utf8_decode('
						 
ASIMISMO,  HACEMOS  DE SU CONOCIMIENTO  QUE  ESTA  AGENCIA CONSIGNATARIA SE OBLIGA 	SOLIDARIA  RESPONSABLE  POR  CUALQUIER  VIOLACION  Y/O  SANCION  A  LAS  DISPOSICIONES 	LEGALES DE LA LEY GENERAL DE POBLACION Y SU REGLAMENTO.	
																										
																										
																										
																										
	ATENTAMENTE																									
	'.$row["firma"].'																									
	'.$row["cargo"].'																									
	TEL: 932 97 30																									
																										
'), 10, array('justification'=>'full'));																										

 
$pdf->ezNewPage();

    ////////////////////////////TABLA!!!!!!!!!!!!!!!!!!
/*
    $pdf->ezSetCmMargins(1,1,1,1);
    $titles = array(
                'fd1'=>'',
                'data1'=>'------------------------',
                'fd2'=>'',
                'data2'=>'------------------------',
                'fd3'=>'',
                'data3'=>'------------------------'
    );
    $options = array(
                'shadeCol'=>array(0.9,0.9,0.9),
                'xOrientation'=>'center',
                'width'=>500
    );
    $options=array('fontSize'=>6);
        $data[] = array('fd1'=>'POOL', 'data1'=>$row["pool"], 'fd2'=>'ETIQUETA1', 'data2'=>$row["ETIQUETA1"], 'fd3'=>'APOYO', 'data3'=>$row["productos"]);

    $pdf->ezTable($data,$titles,'',$options );

    unset($data);
    $pdf->ezNewPage();*/
}
/////////////////////////////////////////////////////////////FIN

$pdf->ezStream(); 
//$pdfcode=$pdf->ezOutput();
//$fp=fopen('cartas.pdf', 'wb');
//fwrite($fp, $pdfcode);
//fclose($fp);

?> 