<?php
include("conexion.php");
include('class.ezpdf.php');
set_time_limit(1000);

$id=$_GET["id"];

$pdf =& new Cezpdf('LETTER');

/////////////////////////	PONE AL FINAL DE LA PAG # DE TOT-PAG
//$pdf->ezStartPageNumbers(540,10,10,'','',1);

//$pdf->selectFont('fonts/courier.afm');

$datacreator = array (
    'Title'=>'CARATULA DE FILES',
    'Author'=>'ALDO VALDES (AVO)',
    'Subject'=>'AVO',
    'Creator'=>'lic.valdes@gmail.com',
    'Producer'=>'http://twinmarinedemexico.com'
);
$pdf->addInfo($datacreator);


$diff=array(225=>'aacute',233=>'eacute',
    237=>'iacute',243=>'oacute',
    250=>'uacute',252=>'udieresis',
    241=>'ntilde',209=>'Ntilde');

$pdf->selectFont('fonts/Helvetica.afm',array('encoding'=>'WinAnsiEncoding','differences'=>$diff));


$link = Conectar();
//////DATOS DE LA OPERACION

$query = "select * from operaciones where id='".$id."'";

$result = mysql_query($query, $link);

while($row = mysql_fetch_array($result)) {
    $vessel=$row["vessel"];
    $flag=$row["flag"];
    $puertodecarga=$row["puertodecarga"];
    $puerto=$row["puerto"];
    $quantity=$row["quantity"];
    $cargotype=$row["cargotype"];
    $puerto=$row["puerto"];
    $type=$row["typex"];
	
	$mastername=$row["mastername"];

    $uno=$row["uno"];
    $dos=$row["dos"];
    $tres=$row["tres"];
    $cuatro=$row["cuatro"];
    $cinco=$row["cinco"];
    $seis=$row["seis"];
    $siete=$row["siete"];
    $ocho=$row["ocho"];


    $shoredraft=$row["shoredraft"];
    $vesseldraft=$row["vesseldraft"];
    $shorescale=$row["shorescale"];
    $shortage=$row["shortage"];

    $sofremarks=$row["sofremarks"];
    $masterremarks=$row["masterremarks"];
    $remarks=$row["remarks"];
    $firmax=$row["firmax"];

    $startdischarging=strftime('%Y/%m/%d %H:%M',strtotime($row["startdischarging"]));
    $completedischarging=strftime('%Y/%m/%d %H:%M',strtotime($row["completedescharging"]));

    if($startdischarging=="1969/12/31 18:00")
        $startdischarging="";
    if($completedischarging=="1969/12/31 18:00")
        $completedischarging="";
		
	for($i=1; $i<=10; $i++)	{
		$titulo[$i]=$row["titulo$i"];
		$titulo2[$i]=$row["titulo2$i"];
		$onbehalf[$i]=$row["onbehalf$i"];
		$etiqueta[$i]=$row["etiqueta$i"];
	}

	
	$eta=$row["eta"];
	$etf=$row["etf"];
}
if($type=="IMPORT") $title="RECEIVER(S):"; else $title="SHIPPER(S):";

///////////////PAGINA

$indice=0;
$renglon=610
;
$d=10;

//////////////////	IMAGEN LOGO
$pdf->addJpegFromFile("logo.jpg",'200','650','250','');

//////////////////	IMAGEN DE FONDO
#$pdf->addJpegFromFile("fondo.jpg",'80','300','400','');
$x2=270;	

$pdf->ezText(utf8_decode(''), 135, array('justification'=>'center'));

#$pdf->addText($x2,$renglon,12,'<b>'.substr($id,0,2).' / '.substr($id,2,2).'</b>');
$pdf->ezText(utf8_decode(substr($id,0,2).'/'.substr($id,2,2)), 12, array('justification'=>'center'));

$pdf->ezText(utf8_decode('__________________________________________________________________________'), 12, array('justification'=>'center'));

$pdf->ezText(utf8_decode(''), 10, array('justification'=>'center'));

#$pdf->line(50,$renglon,550,$renglon);



$pdf->ezText(utf8_decode('<b>M.V. '.$vessel.'</b>'), 14, array('justification'=>'center'));
$pdf->ezText(utf8_decode(''), 30, array('justification'=>'center'));
$pdf->ezText(utf8_decode($eta.'-'.substr($id,2,2).' / '.$etf.'-'.substr($id,2,2)), 12, array('justification'=>'center'));
$pdf->ezText(utf8_decode(''), 30, array('justification'=>'center'));

$pdf->ezText(utf8_decode('<b>CARGO:</b>'), 12, array('justification'=>'center'));
$pdf->ezText(utf8_decode($cargotype), 12, array('justification'=>'center'));
$pdf->ezText(utf8_decode(''), 40, array('justification'=>'center'));
$pdf->ezText(utf8_decode('<b>'.$title.'</b>'), 12, array('justification'=>'center'));
//$pdf->ezText(utf8_decode(''), 15, array('justification'=>'center'));



///////////////////	RECUPERA NOMBRES DE RECIBIDOR

$query="select distinct recibidor from chargeinformation where id='".$id."'";
$result = mysql_query($query, $link);
$i=0;
while($row = mysql_fetch_array($result)) {
    $recibidor[$i]=$row["recibidor"];
    $i++;
}

for($j=0; $j<count($recibidor); $j++) {


////////////////	OBTENER EL TOTAL INICIAL
    $query="select pesoneto from chargeinformation where id='".$id."' and recibidor='".$recibidor[$j]."'";
    $pesototal=0;
    $result = mysql_query($query, $link);
    while($row = mysql_fetch_array($result)) {
        $pesototal+=str_replace(",", "", $row["pesoneto"]);
    }
    $x=$pdf->getTextWidth(10,number_format( $pesototal, 3, ".",","));

#    $pdf->addText(545-$x,$renglon,10,number_format( $pesototal, 3, ".",","));


    $ix=1;
    $limit=80;
    $bufx="";
    $size=0;
    for($i=0; $i<strlen($recibidor[$j]); $i++) {
        if($size<$limit) {
            $bufx=$bufx.substr($recibidor[$j], $i, 1);
            $size++;
            if($i==(strlen($recibidor[$j])-1)) {
                $size=0;
#                $pdf->addText(55,$renglon,10,$bufx);

		$pdf->ezText(utf8_decode($bufx.' <-> <b>'.number_format( $pesototal, 3, ".",",").' MT</b>'), 12, array('justification'=>'center'));

                $bufx="";
            }
        }
        else {
            $size=0;
            $bufx=$bufx.substr($recibidor[$j], $i, 1);
#            $pdf->addText(55, $renglon, 10,$bufx."-");

		$pdf->ezText(utf8_decode($bufx.' <-> <b>'.number_format( $pesototal, 3, ".",",").' MT</b>'), 12, array('justification'=>'center'));

            $ix++;
            $bufx="";
        }
    }
}


$pdf->ezText(utf8_decode(''), 40, array('justification'=>'center'));
$pdf->ezText(utf8_decode($puerto.', MEXICO'), 12, array('justification'=>'center'));

$pdf->ezText(utf8_decode('__________________________________________________________________________'), 12, array('justification'=>'center'));
$pdf->ezText(utf8_decode(''), 20, array('justification'=>'center'));
$pdf->ezText(utf8_decode(substr($id,0,2).'/'.substr($id,2,2)), 12, array('justification'=>'center'));



$pdf->ezStream(); 

?>
