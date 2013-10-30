<?php
include("bd.php");
$tabla=$_POST["tabla"];
$campos=$_POST["campos"];
$condicion=$_POST["condicion"];
$editable=$_POST["editable"];

$listaCampos=explode(',', $campos);

$filasPorPagina=10;

if(isset($condicion) and $condicion!="")
//	$condicion=" where ".$condicion;
$condicion="  ".$condicion;


$query="select @rownum:=@rownum+1 AS rownum, id".$tabla.", ".$campos." from (SELECT @rownum:=0) r, ".$tabla.$condicion;

$result=$bd->Execute($query);

$html="";
$bloque="";

$n=1;
$buf=0;
$ultimaFila=sizeof($result);
$paginas=(($ultimaFila%$filasPorPagina)==0)?($ultimaFila/$filasPorPagina):((int)($ultimaFila/$filasPorPagina))+1;
if($paginas>1)	{
	$divPaginas="<div>";
	for($i=1; $i<=$paginas; $i++)	{
		$divPaginas.='<div class="npagina" ref="bloque'.$i.'">'.$i.'</div>';
	}
	$divPaginas.="</div>";
}

foreach($result as $row)	{
	$colspanplus=0;	
	
	$bloque.='<tr class="bloque'.$n.'">';
	$bloque.='<td>'.$row["rownum"].'</td>';
	for($i=0; $i<sizeof($listaCampos); $i++)	{
		$bloque.='<td>'.$row[trim($listaCampos[$i])].'</td>';
	}
	if(isset($editable) and $editable=="true")	{	
		$bloque.='<td><div class="tedit" id="'.$row["id".$tabla].'" >editar</div><div class="tdelete" id="'.$row["id".$tabla].','.$tabla.'" >eliminar</div></td>';
		$colspanplus=1;
	}
	
	$bloque.='</tr>'."\n";
	
	$buf++;
	
	if($buf==$filasPorPagina)	{
		$html.=$bloque;
			$back=(($n-1)>0)?'<div class="tback" ref="bloque'.($n-1).'" >back</div>':'';
			$next='<div class="tnext" ref="bloque'.($n+1).'" >next</div>';
		$html.='<tr class="bloque'.$n.'"><td colspan="'.(sizeof($listaCampos)+$colspanplus+1).'">'.$back.$divPaginas.$next.'</td></tr>'."\n";
		$bloque="";
		$n++;
		$buf=0;		
	}	else if($row["rownum"]==$ultimaFila)	{
		$html.=$bloque;
			$back=((($n-1)>0)?'<div class="tback" ref="bloque'.($n-1).'" >back</div>':'');			
		$html.='<tr class="bloque'.$n.'"><td colspan="'.(sizeof($listaCampos)+$colspanplus+1).'">'.$back.$divPaginas.'</td></tr>'."\n";
	}
}

echo $html;
?>

