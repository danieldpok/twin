<?php
include("conexion.php");
include('class.ezpdf.php');
set_time_limit(1000);

$id=$_GET["id"];

$pdf =& new Cezpdf('LETTER');
$pdf->ezStartPageNumbers(540,10,10,'','',1);
//$pdf->selectFont('fonts/courier.afm');
$datacreator = array (
    'Title'=>'Estado de Hechos PDF',
    'Author'=>'Daniel Kennedy DAKA',
    'Subject'=>'DAKA',
    'Creator'=>'daniel@daka.com.mx',
    'Producer'=>'http://daka.com.mx'
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
}


///////////////PAGINA

$indice=0;
$renglon=691;
$d=10;

$pdf->setColor(0,0.5,1);
$pdf->filledRectangle(20,710,550,79);
$pdf->setColor(1,1,1);

$pdf->addJpegFromFile("logo.jpg",'20','710','250','');

$pdf->setStrokeColor(.9,.9,.9);
$pdf->setLineStyle(.5);
$pdf->setColor(0,0.5,1);
$pdf->rectangle(290,730,257,35);

$pdf->setStrokeColor(.99,.99,.99);
$pdf->setLineStyle(.3);
$pdf->setColor(0,0.5,1);
$pdf->rectangle(290.5,730.5,257,35);

$pdf->setColor(.1,.1,.1);
$pdf->addText(298,741,20,'<b>PORT LOG</b>');

$pdf->setColor(1,1,1);
$pdf->addText(297,740,20,'<b>PORT LOG</b>');

$pdf->setStrokeColor(.9,.9,.9);
$pdf->setLineStyle(2);
$pdf->setColor(0,0.5,1);
$pdf->rectangle(20,710,550,79);

$pdf->addJpegFromFile("fondo.jpg",'80','300','400','');
$x2=270;	

$pdf->setColor(0.9,0.9,0.9);
$pdf->filledRectangle(20,689,550,15);
$pdf->setColor(0,0,0);

$pdf->setColor(0,0.5,1);
$pdf->addText(30,$renglon,10,'<b>VESSEL:</b>');
$pdf->setColor(0,0,0);
$pdf->addText(130,$renglon,10,'<b>'.$vessel.'</b>');

$pdf->setColor(0,0.5,1);
$pdf->addText($x2,$renglon,10,'<b>FLAG:</b>');
$pdf->setColor(0,0,0);
$pdf->addText($x2+80,$renglon,10,'<b>'.$flag.'</b>');
$renglon=$renglon-20;

$ix=0;
    $limit=20;
    $bufx="";
    $size=0;
    for($i=0; $i<strlen($cargotype); $i++) {
        if($size<$limit) {
            $bufx=$bufx.substr($cargotype, $i, 1);
            $size++;
            if($i==(strlen($cargotype)-1)) {
                $size=0;
                //$pdf->addText(130,$renglon,10,'<b>'.$bufx.'</b>');
                $ix++;
                $bufx="";
            //$renglon-=13;
            }
        }
        else {
            $size=0;
            $bufx=$bufx.substr($cargotype, $i, 1);
            //$pdf->addText(130, $renglon, 10,'<b>'.$bufx."-".'</b>');
            $ix++;
            $bufx="";
            //$renglon-=13;
        }
    }

$pdf->setColor(0.9,0.9,0.9);
$pdf->filledRectangle(20,($renglon-20-(10*($ix-1))),550,33+(10*($ix-1)));
$pdf->setColor(0,0,0);

$pdf->setColor(0,0.5,1);
$pdf->addText(30,$renglon,10,'<b>LOADING PORT:</b>');
$pdf->setColor(0,0,0);
$pdf->addText(130,$renglon,10,'<b>'.$puertodecarga.'</b>');

$pdf->setColor(0,0.5,1);
$pdf->addText($x2,$renglon,10,'<b>DISCH. PORT:</b>');
$pdf->setColor(0,0,0);
$pdf->addText($x2+80,$renglon,10,'<b>'.$puerto.'</b>');
$renglon-=10;

$pdf->setColor(0,0.5,1);
$pdf->addText($x2,$renglon,10,'<b>AGENCY:</b>');
$pdf->setColor(0,0,0);
$pdf->addText($x2+80,$renglon,10,'<b>TWIN MARINE DE MEXICO, S.A. DE C.V.</b>');


$pdf->setColor(0,0.5,1);
$pdf->addText(30,$renglon,10,'<b>CARGO:</b>');
$pdf->setColor(0,0,0);
//$pdf->addText(130,$renglon,10,'<b>'.$cargotype.'</b>');

	$ix=1;
    $limit=20;
    $bufx="";
    $size=0;
    for($i=0; $i<strlen($cargotype); $i++) {
        if($size<$limit) {
            $bufx=$bufx.substr($cargotype, $i, 1);
            $size++;
            if($i==(strlen($cargotype)-1)) {
                $size=0;
                $pdf->addText(130,$renglon,10,'<b>'.$bufx.'</b>');
                //$ix++;
                $bufx="";
            //$renglon-=13;
            }
        }
        else {
            $size=0;
            $bufx=$bufx.substr($cargotype, $i, 1);
            $pdf->addText(130, $renglon, 10,'<b>'.$bufx."-".'</b>');
            $ix++;
            $bufx="";
            $renglon-=13;
        }
    }

$renglon-=10;
$renglon-=10;
$renglon-=5;

if($type=="IMPORT") $title="RECEIVER(S):"; else $title="SHIPPERS:";

/*$pdf->setColor(0.9,0.9,0.9);
$pdf->filledRectangle(20,($renglon-3),550,13);
$pdf->setColor(0,0,0);
$pdf->addText(250, $renglon,10,'<b>'.$title.'</b>');
$renglon-=20;*/

$pdf->setColor(0,0.5,1);
$pdf->filledRectangle(50,$renglon-3,400,13); $pdf->filledRectangle(450,$renglon-3,100,13);
$pdf->setColor(0,0,0);

$pdf->setStrokeColor(.9,.9,.9);
$pdf->setLineStyle(1);
$pdf->rectangle(50,$renglon-3,400,13); $pdf->rectangle(450,$renglon-3,100,13);
$pdf->setColor(1,1,1);
$pdf->addText(55,$renglon,10,'<b>'.$title.'</b>');
$pdf->addText(455,$renglon, 10,'<b>TOTAL CARGO:</b>');
$pdf->setColor(0,0,0);
$renglon-=13;

//---REPORTE GENERAL DE DESCARGA POR RECIVIDOR ---- DAKA TECHNOLOGY---- PROP. INTELECTUAL DANIEL A. KENNEDY AYALA-----

$query="select distinct recibidor from chargeinformation where id='".$id."'";
$result = mysql_query($query, $link);
$i=0;
while($row = mysql_fetch_array($result)) {
    $recibidor[$i]=$row["recibidor"];
    $i++;
}

for($j=0; $j<count($recibidor); $j++) {
////////////////OBTENER EL TOTAL INICIAL
    $query="select pesoneto from chargeinformation where id='".$id."' and recibidor='".$recibidor[$j]."'";
    $pesototal=0;
    $result = mysql_query($query, $link);
    while($row = mysql_fetch_array($result)) {
        $pesototal+=str_replace(",", "", $row["pesoneto"]);
    }
    $x=$pdf->getTextWidth(10,number_format( $pesototal, 3, ".",","));
    $pdf->addText(545-$x,$renglon,10,number_format( $pesototal, 3, ".",","));

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
                $pdf->addText(55,$renglon,10,$bufx);
                //$ix++;
                $bufx="";
            //$renglon-=13;
            }
        }
        else {
            $size=0;
            $bufx=$bufx.substr($recibidor[$j], $i, 1);
            $pdf->addText(55, $renglon, 10,$bufx."-");
            $ix++;
            $bufx="";
            $renglon-=13;
        }
    }
    $pdf->rectangle(50,$renglon-3,400,13*$ix); $pdf->rectangle(450,$renglon-3,100,13*$ix);
    $renglon-=13;
}
//$pdf->ezTable($data, $title);
$pdf->setColor(0.9,0.9,0.9);
$pdf->filledRectangle(20,$renglon-3,550,5);
$pdf->setColor(0,0,0);
$pdf->setStrokeColor(0,0,0);
$pdf->rectangle(20,$renglon-3,550,707-$renglon);
$renglon-=15;

$pdf->setStrokeColor(.9,.9,.9);
//////TITULO DATE
$pdf->setColor(0,0.5,1);
$pdf->filledRectangle(20,$renglon-3,100,13);
$pdf->rectangle(20,$renglon-3,100,13);
$pdf->setColor(1,1,1);
$pdf->addText(55, $renglon,10,'<b>DATE:</b>');

/////TITULO TIME
$pdf->setColor(0,0.5,1);
$pdf->filledRectangle(120,$renglon-3,100,13);
$pdf->rectangle(120,$renglon-3,100,13);
$pdf->setColor(1,1,1);
$pdf->addText(155, $renglon,10,'<b>TIME:</b>');

/////TITULO FACTS
$pdf->setColor(0,0.5,1);
$pdf->filledRectangle(220,$renglon-3,350,13);
$pdf->rectangle(220,$renglon-3,350,13);
$pdf->setColor(1,1,1);
$pdf->addText(255, $renglon,10,'<b>FACTS:</b>');
$pdf->setColor(0,0,0);
$renglon-=13;

$maxLines=(int)($renglon/13)+3;//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$pdf->setStrokeColor(.5,.5,.5);
//////////////////////////////////////////////////////////////////ECHOS!!!!!!!!!

///////////////IMPRIME VALORES EN LA TABLA
$filas=0;

$query = "select distinct fecha from computotiempo where id='".$id."' order by fecha";
//echo $queryA;
$result = mysql_query($query, $link);
$j=0;
while($row = mysql_fetch_array($result)) {
    $fechax[$j]=$row["fecha"];
    $j++;
}

for($i=0; $i<=count($fechax); $i++) {

    $query = "select fecha, hinicial, hfinal, fact from computotiempo where id='".$id."' and fecha='".$fechax[$i]."' and tipo='ARRIVAL MANEUVERS' order by hinicial";
    $result = mysql_query($query, $link);
    $buf=0;

    /////PRE ARRIVO
    $date2=false;
    while($row = mysql_fetch_array($result)) {
        setlocale(LC_TIME , 'es_ES');
        if($buf==0) {
            $fecha=strftime('%b %d /%Y %a',strtotime($row["fecha"]));
            $buf=1;
        }else {
            $fecha="";
        }

        $hinicio=$row["hinicial"];
        $hfinal=$row["hfinal"];
        $computotiempo=$row["fact"];

        //////DATE
        if($fecha!="") {
            $pdf->addText(25, $renglon,10,$fecha);
        }

        /////TIME
        if($hinicio!=$hfinal) {
            $x=$pdf->getTextWidth(10,$hinicio." ".$hfinal);
            $pdf->addText(215-$x, $renglon,10,$hinicio." ".$hfinal);
        }	else {
            $x=$pdf->getTextWidth(10,$hfinal);
            $pdf->addText(215-$x, $renglon,10,$hfinal);
        }

        /////FACTS
		
		$palabra="";
		$bufk="";
		$limit=330; 
		
		for($ik=0; $ik<strlen($computotiempo); $ik++) {
			 if(substr($computotiempo, $ik, 1)!="\n" and substr($computotiempo, $ik, 1)!=" " and $ik!=(strlen($computotiempo)-1)) {
				 $palabra=$palabra.substr($computotiempo, $ik, 1);				 
			 }	else if(substr($computotiempo, $ik, 1)==" ")	{
				 if($pdf->getTextWidth(10,$bufk.$palabra)<$limit)	{
					 $bufk="$bufk $palabra ";
					 $palabra="";
					 if($ik==(strlen($computotiempo)-1))	{
						$pdf->addText(225, $renglon,10,"$bufk $palabra".substr($computotiempo, $ik, 1));
						$filas++;
					 }		
				 }	else	{
					 $pdf->addText(225, $renglon,10,$bufk);
					 $bufk=$palabra;
					 $palabra="";
					 $renglon-=10;
					 $filas++;
					 $jk++;
				 }
			 } else if($ik==(strlen($computotiempo)-1))	{
					$pdf->addText(225, $renglon,10,"$bufk $palabra".substr($computotiempo, $ik, 1));
					//$filas++;
			 }						
			 
		}

        if($fecha!="")
            //$pdf->rectangle(20,$renglon-3,100,13*$lineas);
        $pdf->setColor(0,0,0);

        $renglon-=13;
        $filas++;

        if($filas==$maxLines) {
			////
			$pdf->rectangle(20,20,550,$renglon-13);
			$pdf->line(20,20, 570, $renglon);
			////
            $filas=0;
            $pdf->ezNewPage();
            $pdf->addJpegFromFile("fondo.jpg",'60','400','400','');
            $renglon=760;
            $maxLines=57;
            $indice++;
        }

    }

    ////////////OPERATIONAL
    $query = "select fecha, hinicial, hfinal, fact from computotiempo where id='".$id."' and fecha='".$fechax[$i]."' and tipo='OPERATIONAL' order by hinicial, hfinal";
    $result = mysql_query($query, $link);
    $buf=0;
    $date2=false;
    while($row = mysql_fetch_array($result)) {
        setlocale(LC_TIME , 'es_ES');
        if($buf==0) {
            $fecha=strftime('%b %d /%Y %a',strtotime($row["fecha"]));
            $buf=1;
        }else {
            $fecha="";
        }

        $hinicio=$row["hinicial"];
        $hfinal=$row["hfinal"];
        $computotiempo=$row["fact"];

        //////DATE
        if($fecha!="") {
            //$pdf->rectangle(20,$renglon-3,100,13*$lineas);
            $pdf->addText(25, $renglon,10,$fecha);
        }

        /////TIME
        if($hinicio!=$hfinal) {
            $x=$pdf->getTextWidth(10,$hinicio." ".$hfinal);
            $pdf->addText(215-$x, $renglon,10,$hinicio." ".$hfinal);
        }	else {
            $x=$pdf->getTextWidth(10,$hfinal);
            $pdf->addText(215-$x, $renglon,10,$hfinal);
        }

        /////FACTS
		$palabra="";
		$bufk="";
		$limit=330; 
		
		for($ik=0; $ik<strlen($computotiempo); $ik++) {
			 if(substr($computotiempo, $ik, 1)!="\n" and substr($computotiempo, $ik, 1)!=" " and $ik!=(strlen($computotiempo)-1)) {
				 $palabra=$palabra.substr($computotiempo, $ik, 1);
			 }	else if(substr($computotiempo, $ik, 1)==" ")	{
				 if($pdf->getTextWidth(10,$bufk.$palabra)<$limit)	{
					 $bufk="$bufk $palabra ";
					 $palabra="";
					 if($ik==(strlen($computotiempo)-1))	{
						$pdf->addText(225, $renglon,10,"$bufk $palabra".substr($computotiempo, $ik, 1));
						//$filas++;
					 }	
				 }	else	{
					 $pdf->addText(225, $renglon,10,$bufk);
					 $bufk=$palabra;
					 $palabra="";
					 $renglon-=10;
					 $filas++;
					 $jk++;
					 
				 }
			 } else if($ik==(strlen($computotiempo)-1))	{
					$pdf->addText(225, $renglon,10,"$bufk $palabra".substr($computotiempo, $ik, 1));
					//$filas++;
			 }						
			 
		}

        if($fecha!="")
          //  $pdf->rectangle(20,$renglon-3,100,13*$lineas);
        $pdf->setColor(0,0,0);

        $renglon-=13;
        $filas++;

        //if($filas==$maxLines) {
			if($renglon<20) {
			////
			$pdf->rectangle(20,20,550,$renglon-13);
			$pdf->line(20,20, 570, $renglon);
			////
		
            $filas=0;
            $pdf->ezNewPage();
            $pdf->addJpegFromFile("fondo.jpg",'60','400','400','');
			
            $renglon=760;
            $maxLines=57;
            $indice++;
        }

    }

    ////////////STOP IDLE TIMES
    $query = "select fecha, hinicial, hfinal, fact from computotiempo where id='".$id."' and fecha='".$fechax[$i]."' and tipo='STOP/IDLE TIME' order by hinicial, hfinal";
    $result = mysql_query($query, $link);
    $buf=0;
    $date2=false;
    while($row = mysql_fetch_array($result)) {
        setlocale(LC_TIME , 'es_ES');
        if($buf==0) {
        /////STOP IDLE TIMES TITLE
            $pdf->setColor(0,0.5,1);
            $pdf->filledRectangle(220,$renglon-3,350,13);
            //$pdf->rectangle(220,$renglon-3,350,13);
            $pdf->setColor(1,1,1);
            $pdf->addText(255, $renglon,10,'<b>STOP/IDLE TIMES</b>');
            $pdf->setColor(0,0,0);
            $renglon-=13;
            $filas++;
            $buf=1;
        }else {
            $fecha="";
        }

        $hinicio=$row["hinicial"];
        $hfinal=$row["hfinal"];
        $computotiempo=$row["fact"];

        /////TIME
        if($hinicio!=$hfinal) {
            $x=$pdf->getTextWidth(10,$hinicio." ".$hfinal);
            $pdf->addText(215-$x, $renglon,10,$hinicio." ".$hfinal);
        }	else {
            $x=$pdf->getTextWidth(10,$hfinal);
            $pdf->addText(215-$x, $renglon,10,$hfinal);
        }

        /////FACTS
		$palabra="";
		$bufk="";
		$limit=330; 
		
		for($ik=0; $ik<strlen($computotiempo); $ik++) {
			 if(substr($computotiempo, $ik, 1)!="\n" and substr($computotiempo, $ik, 1)!=" " and $ik!=(strlen($computotiempo)-1)) {
				 $palabra=$palabra.substr($computotiempo, $ik, 1);
			 }	else if(substr($computotiempo, $ik, 1)==" ")	{
				 if($pdf->getTextWidth(10,$bufk.$palabra)<$limit)	{
					 $bufk="$bufk $palabra ";
					 $palabra="";
					 if($ik==(strlen($computotiempo)-1))	{
						$pdf->addText(225, $renglon,10,"$bufk $palabra".substr($computotiempo, $ik, 1));
						//$filas++;
					 }	
				 }	else	{
					 $pdf->addText(225, $renglon,10,$bufk);
					 $bufk=$palabra;
					 $palabra="";
					 $renglon-=10;
					 $filas++;
					 $jk++;
					 
				 }
			 } else if($ik==(strlen($computotiempo)-1))	{
					$pdf->addText(225, $renglon,10,"$bufk $palabra".substr($computotiempo, $ik, 1));
					//$filas++;
			 }						
			 
		}

        $pdf->setColor(0,0,0);
        $filas++;
        $renglon-=13;
        //if($filas==$maxLines) {
			if($renglon<20) {
			////
			$pdf->rectangle(20,20,550,$renglon-10);
			$pdf->line(20,21, 570, $renglon+9);
			////
            $filas=0;
            $pdf->ezNewPage();
            $pdf->addJpegFromFile("fondo.jpg",'60','400','400','');
            $renglon=760;
            $maxLines=57;
            $indice++;
        }
    //			$filas++;
    }
	
	
	
	
	//SAILING INFORMATION
$computotiempo="";
	$query = "select fecha, hinicial, hfinal, fact from computotiempo where id='".$id."' and fecha='".$fechax[$i]."' and tipo='SAILING INFORMATION' order by hinicial, hfinal";
    $result = mysql_query($query, $link);
    $buf=0;
    $date2=false;
    while($row = mysql_fetch_array($result)) {
        setlocale(LC_TIME , 'es_ES');
        
        $hinicio=$row["hinicial"];
        $hfinal=$row["hfinal"];
        $computotiempo=$row["fact"];

        /////TIME
        if($hinicio!=$hfinal) {
            $x=$pdf->getTextWidth(10,$hinicio." ".$hfinal);
            $pdf->addText(215-$x, $renglon,10,$hinicio." ".$hfinal);
        }	else {
            $x=$pdf->getTextWidth(10,$hfinal);
            $pdf->addText(215-$x, $renglon,10,$hfinal);
        }

        /////FACTS
		$palabra="";
		$bufk="";
		for($ik=0; $ik<strlen($computotiempo); $ik++) {
			 if(substr($computotiempo, $ik, 1)!="\n" and substr($computotiempo, $ik, 1)!=" " and $ik!=(strlen($computotiempo)-1)) {
				 $palabra=$palabra.substr($computotiempo, $ik, 1);
			 }	else if(substr($computotiempo, $ik, 1)==" ")	{
				 if($pdf->getTextWidth(10,$bufk.$palabra)<$limit)	{
					 $bufk="$bufk $palabra ";
					 $palabra="";
					 if($ik==(strlen($computotiempo)-1))	{
						$pdf->addText(225, $renglon,10,"$bufk $palabra".substr($computotiempo, $ik, 1));
						$filas++;
					 }	
				 }	else	{
					 $pdf->addText(225, $renglon,10,$bufk);
					 $bufk=$palabra;
					 $palabra="";
					 $renglon-=10;
					 $filas++;
					 $jk++;
					 
				 }
			 } else if($ik==(strlen($computotiempo)-1))	{
					$pdf->addText(225, $renglon,10,"$bufk $palabra".substr($computotiempo, $ik, 1));
					//$filas++;
			 }						
			 
		}
		
		
        /*$limit=54;
        $lineas=1;
        $bufx="";
        $size=0;
        for($ix=0; $ix<strlen($computotiempo); $ix++) {
            if($size<$limit) {
                $bufx=$bufx.substr($computotiempo, $ix, 1);
                $size++;
                if($ix==(strlen($computotiempo)-1)) {
                    $size=0;
                    $pdf->addText(225, $renglon,10,$bufx);
                    $bufx="";
                }
            }
            else {
                $size=0;
                $bufx=$bufx.substr($computotiempo, $ix, 1);
                $pdf->addText(225, $renglon,10,$bufx."-");
                $bufx="";
                $renglon-=13;
                $lineas++;
                $filas++;
            }
        }*/

//        $pdf->setColor(0,0.5,1);
  //      $pdf->rectangle(220,$renglon-3,350,13*$lineas);
    //    $pdf->rectangle(120,$renglon-3,100,13*$lineas);
        $pdf->setColor(0,0,0);
        $filas++;
        $renglon-=13;
//        if($filas==$maxLines) {
	if($renglon<20) {
			////
			$pdf->rectangle(20,20,550,$renglon-13);
			$pdf->line(20,20, 570, $renglon);
			////
            $filas=0;
            $pdf->ezNewPage();
            $pdf->addJpegFromFile("fondo.jpg",'60','400','400','');
            $renglon=760;
            $maxLines=57;
            $indice++;
        }
    //			$filas++;
    }
}
/////////////////	NOTES

/*
if($uno=="1") {


    $pdf->addText(225, $renglon,10, "FINAL DRAFT SURVEY");
    //$pdf->rectangle(220,$renglon-3,350,13);

    $renglon-=13;
    if($filas==$maxLines) {
        $filas=0;
        $pdf->ezNewPage();
        $pdf->addJpegFromFile("fondo.jpg",'60','400','400','');

        $renglon=760;
        $maxLines=57;
        $indice++;
    }
    $filas++;

*/
//}
///////////////////////////////////
//if($dos=="1") {


/* >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>	INICIA ELIMINACION
    $pdf->addText(225, $renglon,10, "DOCUMENTS ON BOARD");
  //  $pdf->rectangle(220,$renglon-3,350,13);

    $renglon-=13;
    if($filas==$maxLines) {
        $filas=0;
        $pdf->ezNewPage();
        $pdf->addJpegFromFile("fondo.jpg",'60','400','400','');

        $renglon=760;
        $maxLines=57;
        $indice++;
    }
    $filas++;
//}
///////////////////////////////////
//if($tres=="1") {
    $pdf->addText(225, $renglon,10, "PILOT ON BOARD");
  //  $pdf->rectangle(220,$renglon-3,350,13);

    $renglon-=13;
    if($filas==$maxLines) {
        $filas=0;
        $pdf->ezNewPage();
        $pdf->addJpegFromFile("fondo.jpg",'60','400','400','');

        $renglon=760;
        $maxLines=57;
        $indice++;
    }
    $filas++;
//}
///////////////////////////////////
//if($cuatro=="1") {
    $pdf->addText(225, $renglon,10, "UNBERTHED FROM THE PIER");
  //  $pdf->rectangle(220,$renglon-3,350,13);

    $renglon-=13;
    if($filas==$maxLines) {
        $filas=0;
        $pdf->ezNewPage();
        $pdf->addJpegFromFile("fondo.jpg",'60','400','400','');

        $renglon=760;
        $maxLines=57;
        $indice++;
    }
    $filas++;
//} >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>	FINALIZA ELIMINACION
*/
///////////////////////////////////

$diferencia=$maxLines-$filas;

//if($diferencia<6)	{	
$pdf->rectangle(20,20,550,$renglon-10);
$pdf->line(20,20, 570, $renglon+10);
$pdf->ezNewPage();
$pdf->addJpegFromFile("fondo.jpg",'60','400','400','');

$indice++;
$renglon=760;
$filas=0;

$pdf->addText(90, $renglon,10,'THE PRESENT SOF IS SIGNED AS PER CHARTER PARTY AND OR ANY ADDENDA THERETO');
$renglon-=13;
$pdf->setStrokeColor(0,0,0);

$pdf->addText(30, $renglon-13,10,'M.V. '.$vessel);
//$pdf->rectangle(25,$renglon-20, 230,20);
$pdf->line(25, $renglon-60, 255, $renglon-60);
$pdf->addText(30, $renglon-70,10,$mastername);


$pdf->addText(290, $renglon-13,10,'TWIN MARINE DE MEXICO, S.A. DE C.V.');
//$pdf->rectangle(280,$renglon-20, 230,20);
$pdf->line(280, $renglon-60, 510, $renglon-60);
$pdf->addText(290, $renglon-70,10,"AS SHIP'S AGENTS ONLY");

$renglon-=80;

//$pdf->rectangle(25,$renglon-50, 550,50);
$pdf->addText(30, $renglon-13,10,'<b>MASTER REMARKS:</b>');
//$pdf->addText(130, $renglon-13,10,$masterremarks);

$buf="";
$palabra="";
$limit=540;
$j=1;
$renglon2=$renglon-13;
for($i=0; $i<strlen($masterremarks); $i++) {
	 if(substr($masterremarks, $i, 1)!="\n" and substr($masterremarks, $i, 1)!=" " and $i!=(strlen($masterremarks)-1)) {
		 $palabra=$palabra.substr($masterremarks, $i, 1);
	 }	else if(substr($masterremarks, $i, 1)==" ")	{
		 if($pdf->getTextWidth(10,$buf.$palabra)<$limit)	{
			 $buf="$buf $palabra ";
			 $palabra="";
			if($i==(strlen($masterremarks)-1))	{
				$pdf->addText(30, $renglon2-10*$j,8,"$buf $palabra".substr($masterremarks, $i, 1));
				$filas++;
			 }
		 }	else	{
			 $pdf->addText(30, $renglon2-10*$j,8,$buf);
			 $buf=$palabra;
			 $palabra="";
			 $j++;
		 }
	 }	else if(substr($masterremarks, $i, 1)=="\n")	{
		 	 $pdf->addText(30, $renglon2-10*$j,8,$buf." $palabra");
			 //$buf=$palabra;
			 $buf="";
			 $palabra="";
			 $j++;
	 }	else if($i==(strlen($masterremarks)-1))	{
			$pdf->addText(30, $renglon2-10*$j,8,"$buf $palabra".substr($masterremarks, $i, 1));
	 }
	 
}

$renglon-=20+(10*$j);
//$pdf->rectangle(25,$renglon-50, 550,50);
$pdf->addText(30, $renglon-13,10,'<b>GENERAL REMARKS:</b>');
//$pdf->addText(140, $renglon-13,10,$remarks);
$palabra="";
$buf="";
$limit=540;
$j=1;
$renglon2=$renglon-13;
for($i=0; $i<strlen($remarks); $i++) {
	 if(substr($remarks, $i, 1)!="\n" and substr($remarks, $i, 1)!=" " and $i!=(strlen($remarks)-1)) {
		 $palabra=$palabra.substr($remarks, $i, 1);
	 }	else if(substr($remarks, $i, 1)==" ")	{
		 if($pdf->getTextWidth(10,$buf.$palabra)<$limit)	{
			 $buf="$buf $palabra ";
			 $palabra="";
			if($i==(strlen($remarks)-1))	{
				$pdf->addText(30, $renglon2-10*$j,8,"$buf $palabra".substr($remarks, $i, 1));
				$filas++;
			 }
		 }	else	{
			 $pdf->addText(30, $renglon2-10*$j,8,$buf);
			 $buf=$palabra;
			 $palabra="";
			 $j++;
		 } 
	 }	else if(substr($remarks, $i, 1)=="\n")	{
		 	 $pdf->addText(30, $renglon2-10*$j,8,$buf." $palabra");
			 //$buf=$palabra;
			 $buf="";
			 $palabra="";
			 $j++;
	 }	else if($i==(strlen($remarks)-1))	{
			$pdf->addText(30, $renglon2-10*$j,8,"$buf $palabra".substr($remarks, $i, 1));
	 }						
	 
}

/////////

$renglon-=80;
$j=1;
for($i=0; $i<5; $i++)	{

if($titulo[$j]!=NULL and $titulo[$j]!="" and $titulo[$j]!="NULL")	{
	$pdf->addText(30, $renglon-13,8,$titulo[$j]);
	$pdf->addText(30, $renglon-23,8,$titulo2[$j]);
	$pdf->addText(30, $renglon-33,8,$onbehalf[$j]);
	//$pdf->rectangle(25,$renglon-40, 180,40);
	$pdf->line(25, $renglon-60, 205, $renglon-60);
	$pdf->addText(30, $renglon-70, 8,$etiqueta[$j]);
}
$j++;


if($titulo[$j]!=NULL and $titulo[$j]!="" and $titulo[$j]!="NULL")	{
	$pdf->addText(300, $renglon-13,8,$titulo[$j]);
	$pdf->addText(300, $renglon-23,8,$titulo2[$j]);
	$pdf->addText(300, $renglon-33,8,$onbehalf[$j]);
	//$pdf->rectangle(210,$renglon-40, 180,40);
	$pdf->line(295, $renglon-60, 475, $renglon-60);
	$pdf->addText(300, $renglon-70, 8,$etiqueta[$j]);
}
$j++;
/*
if($titulo[$j]!=NULL and $titulo[$j]!="" and $titulo[$j]!="NULL")	{
	$pdf->addText(400, $renglon-13,8,$titulo[$j]);
	$pdf->addText(400, $renglon-23,8,$titulo2[$j]);
	$pdf->addText(400, $renglon-33,8,$onbehalf[$j]);
	//$pdf->rectangle(395,$renglon-40, 180,40);
	$pdf->line(395, $renglon-60, 575, $renglon-60);
	$pdf->addText(400, $renglon-70, 8,$etiqueta[$j]);
}
$j++;
*/
$renglon-=95;

}


/* >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>INICIA ELIMINACION
//}
///////////////////////SHORES
//$renglon-=13*2;
if(($cinco=="1") or ($seis=="1") or ($siete=="1") or ($ocho=="1")) {
    $pdf->setStrokeColor(0,0,0);
    $ix=5;
    if($cinco=="1") {
        $pdf->addText(150, $renglon,10,'SHORE DRAFT SURVEY WEIGHT <c:uline>'.$shoredraft.'</c:uline> MT');
        $ix++;
        $renglon-=13*2;
    }
    if($seis=="1") {
        $pdf->addText(150, $renglon,10,"VESSEL DRAFT SURVEY WEIGHT <c:uline>".$vesseldraft."</c:uline> MT");
        $ix++;
        $renglon-=13*2;
    }
    if($siete=="1") {
        $pdf->addText(150, $renglon,10,"SHORE SCALE WEIGHT <c:uline>".$shorescale."</c:uline> MT");
        $ix++;
        $renglon-=13*2;
    }
    if($ocho=="1") {
        $pdf->addText(150, $renglon,10,"SHORTAGE OF THE SHIPMENT <c:uline>".$shortage."</c:uline> MT");
        $ix++;
        $renglon-=13;
    }
    $pdf->setStrokeColor(.9,.9,.9);
    $pdf->rectangle(20,$renglon-5,550,13*$ix);
    $renglon-=13*3;
}
/////////////////////// SOFT REMARKS ////////////////////////////////////////////////////////////////////////////
if(($sofremarks!="") and ($sofremarks!="null")) {
    $ix=2;
    $limit=510;
    $lineas=1;
    $size=0;

    for($i=0; $i<strlen($sofremarks); $i++) {
        if($size<$limit) {
            $size++;
            if($i==(strlen($sofremarks)-1)) {
                $size=0;
                $lineas++;
            }
        }
        else {
            $size=0;
            $lineas++;
        }
    }

    if($renglon<(14*$lineas)) {
        $pdf->rectangle(20,20,550,$renglon+16);
        $pdf->line(20,20, 570, $renglon+29);
        $pdf->ezNewPage();

        $indice++;
        $renglon=760;
        $filas=0;
    }

    $bufx="";
    $size=0;
    for($i=0; $i<strlen($sofremarks); $i++) {
        if(($pdf->getTextWidth(10,$bufx))<$limit) {
            if(substr($sofremarks, $i, 1)=="\n") {
                $pdf->addText(25, $renglon,10,"");
                $sizex=$pdf->getTextWidth(10,$arg);
                $pdf->addText(25, $renglon,10,$bufx);
                $ix++;
                $renglon-=13;
                $bufx="";
            }else {
                $bufx=$bufx.substr($sofremarks, $i, 1);
            }
            $size++;
            if($i==(strlen($sofremarks)-1)) {
                $size=0;
                $pdf->addText(25,$renglon,10,$bufx);
                $ix++;
                $bufx="";
                $renglon-=13;
            }
        }
        else {
            $size=0;
            $bufx=$bufx.substr($sofremarks, $i, 1);
            $pdf->addText(25, $renglon, 10,$bufx."-");
            $ix++;
            $bufx="";
            $renglon-=13;
        }
    }
    $pdf->rectangle(20,$renglon-5,550,13*$ix);
    $renglon-=13*3;
}
////////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////// FIRMA DEL CAPITAN ////////////////////////////////////////////////////////////////////////////
if($renglon<(13*7)) {
    $pdf->rectangle(20,20,550,$renglon+16);
    $pdf->line(20,20, 570, $renglon+29);
    $pdf->ezNewPage();
    $pdf->addJpegFromFile("fondo.jpg",'60','400','400','');

    $indice++;
    $renglon=760;
    $filas=0;
}

$arg="<b>M.V. ".$vessel."</b>";
$size=$pdf->getTextWidth(10,$arg);
$pdf->addText(300-((int) $size/2), $renglon,10, $arg);
$renglon-=13*3;

$arg="<b>_______________________________</b>";
$size=$pdf->getTextWidth(10,$arg);
$pdf->addText(300-((int) $size/2), $renglon,10, $arg);	
$renglon-=13;

$arg="<b>MASTER</b>";
$size=$pdf->getTextWidth(10,$arg);
$pdf->addText(300-((int) $size/2), $renglon,10, $arg);

$pdf->rectangle(20,$renglon-5,550,13*6);
$renglon-=13*3;

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////// MASTER REMARKS ////////////////////////////////////////////////////////////////////////////
if(($masterremarks!="") and ($masterremarks!="null")) {
    $ix=2;
    $limit=510;
    $lineas=1;
    $size=0;

    for($i=0; $i<strlen($masterremarks); $i++) {
        if($size<$limit) {
            $size++;
            if($i==(strlen($masterremarks)-1)) {
                $size=0;
                $lineas++;
            }
        }
        else {
            $size=0;
            $lineas++;
        }
    }

    if($renglon<(14*$lineas)) {
        $pdf->rectangle(20,20,550,$renglon+16);
        $pdf->line(20,20, 570, $renglon+29);
        $pdf->ezNewPage();

        $indice++;
        $renglon=760;
        $filas=0;
    }

    $bufx="";
    $size=0;
    for($i=0; $i<strlen($masterremarks); $i++) {
        if(($pdf->getTextWidth(10,$bufx))<$limit) {
            if(substr($masterremarks, $i, 1)=="\n") {
                $pdf->addText(25, $renglon,10,"");
                $sizex=$pdf->getTextWidth(10,$arg);
                $pdf->addText(25, $renglon,10,$bufx);
                $ix++;
                $renglon-=13;
                $bufx="";
            }else {
                $bufx=$bufx.substr($masterremarks, $i, 1);
            }
            $size++;
            if($i==(strlen($masterremarks)-1)) {
                $size=0;
                $pdf->addText(25,$renglon,10,$bufx);
                $ix++;
                $bufx="";
                $renglon-=13;
            }
        }
        else {
            $size=0;
            $bufx=$bufx.substr($masterremarks, $i, 1);
            $pdf->addText(25, $renglon, 10,$bufx."-");
            $ix++;
            $bufx="";
            $renglon-=13;
        }
    }
    $pdf->rectangle(20,$renglon-5,550,13*$ix);
    $renglon-=13*3;
}
////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////REMARKS ////////////////////////////////////////////////////////////////////////////
if(($remarks!="") and ($remarks!="null")) {
    $ix=2;
    //$limit=100;
    $limit=510;
    $lineas=1;
    $size=0;

    for($i=0; $i<strlen($remarks); $i++) {
        if(($pdf->getTextWidth(10,$bufx))<$limit) {
            $size++;
            if($i==(strlen($remarks)-1)) {
                $size=0;
                $lineas++;
            }
        }
        else {
            $size=0;
            $lineas++;
        }
    }

    if($renglon<(14*$lineas)) {
        $pdf->rectangle(20,20,550,$renglon+16);
        $pdf->line(20,20, 570, $renglon+29);
        $pdf->ezNewPage();
        $pdf->addJpegFromFile("fondo.jpg",'60','400','400','');

        $indice++;
        $renglon=760;
        $filas=0;
    }

    $bufx="";
    $size=0;
    $pdf->getTextWidth(10,$arg);

    for($i=0; $i<strlen($remarks); $i++) {
        if(($pdf->getTextWidth(10,$bufx))<$limit) {
            if(substr($remarks, $i, 1)=="\n") {
                $sizex=$pdf->getTextWidth(10,$bufx);
                $pdf->addText(300-((int) $sizex/2), $renglon,10,"");
                $pdf->addText(300-((int) $sizex/2), $renglon,10,$bufx);
                $ix++;
                $renglon-=13;
                $bufx="";
            }else {
                $bufx=$bufx.substr($remarks, $i, 1);
            }
            if($i==(strlen($remarks)-1)) {
                $sizex=$pdf->getTextWidth(10,$bufx);
                $pdf->addText(300-((int) $sizex/2),$renglon,10,$bufx);
                $ix++;
                $bufx="";
                $renglon-=13;
            }
        }
        else {
            $sizex=$pdf->getTextWidth(10,$bufx);
            $bufx=$bufx.substr($remarks, $i, 1);
            $pdf->addText(300-((int) $sizex/2), $renglon, 10,$bufx."-");
            $ix++;
            $bufx="";
            $renglon-=13;
        }
    }
    $pdf->rectangle(20,$renglon+13,550,13*($ix-1));
}
//$renglon-=13*3;


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////// FIRMA DE TWIN MARINE DE MEXICO S.A. DE C.V. ////////////////////////////////////////////////////////////////////////////
if($renglon<(13*7)) {
    $pdf->rectangle(20,20,550,$renglon+16);
    $pdf->line(20,20, 570, $renglon+29);
    $pdf->ezNewPage();
    $pdf->addJpegFromFile("fondo.jpg",'60','400','400','');

    $indice++;
    $renglon=760;
    $filas=0;
}

$arg="<b>TWIN MARINE DE MEXICO S.A. DE C.V.</b>";
$size=$pdf->getTextWidth(10,$arg);
$pdf->addText(300-((int) $size/2), $renglon,10, $arg);
$renglon-=13*3;

$arg="<b>_______________________________</b>";
$size=$pdf->getTextWidth(10,$arg);
$pdf->addText(300-((int) $size/2), $renglon,10, $arg);	
$renglon-=13;

$arg="<b>AS SHIP AGENTS ONLY</b>";
$size=$pdf->getTextWidth(10,$arg);
$pdf->addText(300-((int) $size/2), $renglon,10, $arg);

$pdf->rectangle(20,$renglon-5,550,13*6);
$renglon-=13*3;

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////// FIRMA DE AGENCIAS RECIBIDORES ////////////////////////////////////////////////////////////////////////////

$table="chargeinformation";
$fields="recibidor, agencia";
//$fields="recibidor";

$query = "select distinct ".$fields." from ".$table." where id='".$id."'";

$result = mysql_query($query, $link);
$x=0;

while($row = mysql_fetch_array($result)) {

    $recibidorx=$row["recibidor"];
    $agencia=$row["agencia"];
    if($firmax=="0") {
        $bufer="ON BEHALF OF ".$recibidorx;
        $recibidorx=$bufer;
    } else {
        $recibidorx=$recibidorx;
    }

    if($x==0) {
        $ix=1;

        if($renglon<(13*11)) {
            $pdf->rectangle(20,20,550,$renglon+16);
            $pdf->line(20,20, 570, $renglon+29);
            $pdf->ezNewPage();
            $pdf->addJpegFromFile("fondo.jpg",'60','400','400','');

            $indice++;
            $renglon=760;
            $filas=0;
        }


        $buf=$renglon;
        if($firmax=="0" or $firmax=="2") {
            $limit=230;
            $bufx="";
            $size=0;
            for($i=0; $i<strlen($agencia); $i++) {
                if(($pdf->getTextWidth(10,$bufx))<$limit) {
                    $bufx=$bufx.substr($agencia, $i, 1);
                    $size++;
                    if($i==(strlen($agencia)-1)) {
                        $size=0;
                        $arg=$bufx;
                        $sizex=$pdf->getTextWidth(10,$arg);
                        $pdf->addText(150-((int) $sizex/2), $renglon,10, "<b>".$arg."</b>");
                        $ix++;
                        $renglon-=13;
                        $bufx="";
                    }
                }
                else {
                    $size=0;
                    $bufx=$bufx.substr($agencia, $i, 1);
                    $arg=$bufx;
                    $sizex=$pdf->getTextWidth(10,$arg);
                    $pdf->addText(150-((int) $sizex/2), $renglon,10, "<b>".$arg."-"."</b>");
                    $ix++;
                    $bufx="";
                    $renglon-=13;
                }
            }
        }
        else { }
        $limit=230;
        if($firmax=="0" or $firmax=="1") {
            $bufx="";
            $size=0;
            $txt=$recibidorx;
            for($i=0; $i<strlen($txt); $i++) {
                if(($pdf->getTextWidth(10,$bufx))<$limit) {
                    $bufx=$bufx.substr($txt, $i, 1);
                    $size++;
                    if($i==(strlen($txt)-1)) {
                        $size=0;
                        $arg=$bufx;
                        $sizex=$pdf->getTextWidth(10,$arg);
                        $pdf->addText(150-((int) $sizex/2), $renglon,10,"<b>".$arg."</b>");
                        $ix++;
                        $renglon-=13;
                        $bufx="";
                    }
                }
                else {
                    $size=0;
                    $bufx=$bufx.substr($txt, $i, 1);
                    $arg=$bufx;
                    $sizex=$pdf->getTextWidth(10,$arg);
                    $pdf->addText(150-((int) $sizex/2), $renglon,10, "<b>".$arg."-"."</b>");
                    $ix++;
                    $bufx="";
                    $renglon-=13;
                }
            }
        }
        else { }

        $renglon-=13*3;$ix++;$ix++;$ix++;


        $arg="<b>_______________________________</b>";
        $size=$pdf->getTextWidth(10,$arg);
        $pdf->addText(150-((int) $size/2), $renglon,10, $arg);
        $renglon-=13;$ix++;

        $arg="<b>AS CARGO RECEIVERS</b>";
        $size=$pdf->getTextWidth(10,$arg);
        $pdf->addText(150-((int) $size/2), $renglon,10, $arg);
        $renglon-=13;$ix++;$ix++;

        $pdf->rectangle(20,$renglon-5,265,13*$ix);
        $renglon-=13*3;
        $renglon2=$renglon;
    } else { } ////////////////////////////////////////////////////////////////////////////////////////////////////
    if($x==1) {
        $ix=1;
        $renglon=$buf;

        if($firmax=="0" or $firmax=="2") {
            $limit=230;
            $bufx="";
            $size=0;
            for($i=0; $i<strlen($agencia); $i++) {
                if(($pdf->getTextWidth(10,$bufx))<$limit) {
                    $bufx=$bufx.substr($agencia, $i, 1);
                    $size++;
                    if($i==(strlen($agencia)-1)) {
                        $size=0;
                        $arg=$bufx;
                        $sizex=$pdf->getTextWidth(10,$arg);
                        $pdf->addText(440-((int) $sizex/2), $renglon,10, "<b>".$arg."</b>");
                        $ix++;
                        $renglon-=13;
                        $bufx="";
                    }
                }
                else {
                    $size=0;
                    $bufx=$bufx.substr($agencia, $i, 1);
                    $arg=$bufx;
                    $sizex=$pdf->getTextWidth(10,$arg);
                    $pdf->addText(440-((int) $sizex/2), $renglon,10, "<b>".$arg."-"."</b>");
                    $ix++;
                    $bufx="";
                    $renglon-=13;
                }
            }
        }
        ///////////

        $limit=230;
        if($firmax=="0" or $firmax=="1") {
            $bufx="";
            $size=0;
            $txt=$recibidorx;
            for($i=0; $i<strlen($txt); $i++) {
                if(($pdf->getTextWidth(10,$bufx))<$limit) {
                    $bufx=$bufx.substr($txt, $i, 1);
                    $size++;
                    if($i==(strlen($txt)-1)) {
                        $size=0;
                        $arg=$bufx;
                        $sizex=$pdf->getTextWidth(10,$arg);
                        $pdf->addText(440-((int) $sizex/2), $renglon,10,"<b>".$arg."</b>");
                        $ix++;
                        $renglon-=13;
                        $bufx="";
                    }
                }
                else {
                    $size=0;
                    $bufx=$bufx.substr($txt, $i, 1);
                    $arg=$bufx;
                    $sizex=$pdf->getTextWidth(10,$arg);
                    $pdf->addText(440-((int) $sizex/2), $renglon,10, "<b>".$arg."-"."</b>");
                    $ix++;
                    $bufx="";
                    $renglon-=13;
                }
            }
        }
        $renglon-=13*3;$ix++;$ix++;$ix++;


        $arg="<b>_______________________________</b>";
        $size=$pdf->getTextWidth(10,$arg);
        $pdf->addText(440-((int) $size/2), $renglon,10, $arg);
        $renglon-=13;$ix++;

        $arg="<b>AS CARGO RECEIVERS</b>";
        $size=$pdf->getTextWidth(10,$arg);
        $pdf->addText(440-((int) $size/2), $renglon,10, $arg);
        $renglon-=13;$ix++;$ix++;

        $pdf->rectangle(305,$renglon-5,265,13*$ix);
        $renglon-=13*3;
        if($renglon2<$renglon)
            $renglon=$renglon2;
    } else { }
    if($x==0)
        $x=1;
    else
        $x=0;
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if($puerto=="VERACRUZ") {
    $table="chargeinformation";
    $fields="estivador";

    $query = "select distinct estivador from ".$table." where id='".$id."'";

    $result = mysql_query($query, $link);

    while($row = mysql_fetch_array($result)) {
        $recibidorx=$row["estivador"];
        if($renglon<(13*7)) {
            $pdf->rectangle(20,20,550,$renglon+16);
            $pdf->line(20,20, 570, $renglon+29);
            $pdf->ezNewPage();
            $pdf->addJpegFromFile("fondo.jpg",'60','400','400','');

            $indice++;
            $renglon=760;
            $filas=0;
        }

        $arg="<b>$recibidorx</b>";
        $size=$pdf->getTextWidth(10,$arg);
        $pdf->addText(300-((int) $size/2), $renglon,10, $arg);
        $renglon-=13*3;

        $arg="<b>_______________________________</b>";
        $size=$pdf->getTextWidth(10,$arg);
        $pdf->addText(300-((int) $size/2), $renglon,10, $arg);
        $renglon-=13;

        $arg="<b>AS STEVEDORING COMPANY</b>";
        $size=$pdf->getTextWidth(10,$arg);
        $pdf->addText(300-((int) $size/2), $renglon,10, $arg);

        $pdf->rectangle(20,$renglon-5,550,13*6);
        $renglon-=13*3;
    }
}
else if($puerto=="ALTAMIRA") {

        if($renglon<(13*7)) {
            $pdf->rectangle(20,20,550,$renglon+16);
            $pdf->line(20,20, 570, $renglon+29);
            $pdf->ezNewPage();
            $pdf->addJpegFromFile("fondo.jpg",'60','400','400','');

            $indice++;
            $renglon=760;
            $filas=0;
        }

        $arg="<b>TERMINAL MARITIMA DE ALTAMIRA</b>";
        $size=$pdf->getTextWidth(10,$arg);
        $pdf->addText(300-((int) $size/2), $renglon,10, $arg);
        $renglon-=13*3;

        $arg="<b>_______________________________</b>";
        $size=$pdf->getTextWidth(10,$arg);
        $pdf->addText(300-((int) $size/2), $renglon,10, $arg);
        $renglon-=13;

        $arg="<b>AS DISCHARGING TERMINAL</b>";
        $size=$pdf->getTextWidth(10,$arg);
        $pdf->addText(300-((int) $size/2), $renglon,10, $arg);

        $pdf->rectangle(20,$renglon-5,550,13*6);
        $renglon-=13*3;
    }
$pdf->rectangle(20,20,550,$renglon+9);
$pdf->line(20,20, 570, $renglon+29);
// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>TERMINA ELIMINACION
*/


$arg="<b>Powered by    <c:alink:www.twinmarinedemexico.com>TWIN MARINE DE MEXICO, S.A. DE C.V.</c:alink>       <<Copyright © 2011 All Rights Reserved></b>";
$size=$pdf->getTextWidth(6,$arg);
$pdf->addText(300-((int) $size/2), 10,6, $arg);

/////////FIN
///////////////////////

///////////777
$pdf->ezStream(); 

?>
