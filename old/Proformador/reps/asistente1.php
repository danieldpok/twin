<?php
header('Content-Type: text/html; charset=iso-8859-1');
include("conexion.php");

$id=$_GET["id"];
$puerto=$_GET["puerto"];

$link = Conectar();


$queryx="select * from proformas where id='$id'";
$resultx = mysql_query($queryx, $link);
while($rowx = mysql_fetch_array($resultx)) {
    $puerto=$rowx["puerto"];
    $grt=$rowx["grt"];
    $vessel=$rowx["vessel"];
    $loa=$rowx["loa"];
    $cargo=$rowx["cargo"];
    $pier=$rowx["pier"];
    $tc=$rowx["tc"];
    $d=$rowx["d"];
    $h=$rowx["h"];
}

$time=($d*24)+$h;

function toHora($hora) {
    $hora=split(":",$hora);
    $hora=(int)$hora[0];
    return $hora;
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Documento sin título</title>
        <link href="estilos.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <form id="form1" name="form1" method="get" action="asistente2.php">
            <p><img src="logox.jpg" width="264" height="83" /></p>
            <p class="titulo"><?php echo "Asistente de Proformas (1 de 3)"; ?></p>
            <table width="832" border="1" cellspacing="0" class="general" bordercolor="#CCCCCC">
                <tr class="tituloTabla" bgcolor="#000066">
                    <td width="31">&nbsp;</td>
                    <td width="32">CANT</td>
                    <td width="208">CLASIFICACION</td>
                    <td width="340">CONCEPTO DE TARIFA</td>
                    <td width="120">REFERENCIA</td>
                    <td width="75">P.U. </td>
                </tr>
                <?php
                //////////////////////////////INICIO DE ITEM
                $item=1;

                $queryTarifa="select * from tarifas where puerto='$puerto' order by clasificacion";
                $resultTarifa = mysql_query($queryTarifa, $link);
                while($rowTarifa = mysql_fetch_array($resultTarifa)) {
                    $tarifa=0;
                    $concepto=$rowTarifa["concepto"];
                    $clasificacion=$rowTarifa["clasificacion"];
                    $referencia=$rowTarifa["referencia"];
                    if($rowTarifa["tarifafija"]=="1") {
                        $tarifa=$rowTarifa["tarifa"];
                    }
                    else {
                        if($rowTarifa["factor"]!=null or $rowTarifa["factor"]!="") {
                        ////////////FACTOR
                            if($rowTarifa["factortiempo"]!="0") {
                                $tarifa=$time*$rowTarifa["factor"];
                            }
                            else if($rowTarifa["factorgrt"]!="0") {
                                    $tarifa=$grt*$rowTarifa["factor"];
                                }
                                else if($rowTarifa["factorloa"]!="0") {
                                        $tarifa=$loa*$rowTarifa["factor"];
                                    }
                                    else if($rowTarifa["factordia"]!="0") {
                                            $tarifa=($time/24)*$rowTarifa["factor"];
                                        }

                            if($rowTarifa["porcentaje"]!="" or $rowTarifa["porcentaje"]!=null) {
                                $tarifa=$tarifa+(($tarifa*$rowTarifa["porcentaje"])/100);
                            }

                            if($rowTarifa["valorporcentaje"]!="" or $rowTarifa["valorporcentaje"]!=null) {
                                $tarifa=(($tarifa*$rowTarifa["valorporcentaje"])/100);
                            }
                        }
                        else {
                            $tarifa=0;
                        }
                        ////////////CRITERIOS//////////////////////////////////////////////////////////////////////////////////////
                        if($rowTarifa["criteriotiempo"]!="0") {
                            $queryCriterio="select * from criterios where concepto='$concepto'";
                            $resultCriterio = mysql_query($queryCriterio, $link);
                            while($rowCriterio = mysql_fetch_array($resultCriterio)) {
                                if(toHora($rowCriterio["de"])<=$time and toHora($rowCriterio["a"])>=$time) {
                                    if($rowTarifa["factortarifa"]!="0")
                                        $tarifa=$time*$rowCriterio["tarifa"];
                                    else
                                        $tarifa=$rowCriterio["tarifa"];
                                    if($rowCriterio["tarifa2"]!="" or $rowCriterio["tarifa2"]!=null) {
                                        if($rowTarifa["factortarifa"]!="0")
                                            $tarifa+=$time*$rowCriterio["tarifa2"];
                                        else
                                            $tarifa+=$rowCriterio["tarifa2"];
                                    }
                                }
                                else if(toHora($rowCriterio["de"])<=$time and ($rowCriterio["a"]=="" or $rowCriterio["a"]==null) ) {
                                        if($rowTarifa["factortarifa"]!="0")
                                            $tarifa=$time*$rowCriterio["tarifa"];
                                        else
                                            $tarifa=$rowCriterio["tarifa"];
                                        if($rowCriterio["tarifa2"]!="" or $rowCriterio["tarifa2"]!=null) {
                                            if($rowTarifa["factortarifa"]!="0")
                                                $tarifa+=$time*$rowCriterio["tarifa2"];
                                            else
                                                $tarifa+=$rowCriterio["tarifa2"];
                                        }
                                    }
                            }
                        }
                        else if($rowTarifa["criterioloa"]!="0") {
                                $queryCriterio="select * from criterios where concepto='$concepto'";
                                $resultCriterio = mysql_query($queryCriterio, $link);
                                while($rowCriterio = mysql_fetch_array($resultCriterio)) {
                                    if($rowCriterio["de"]<=$loa and $rowCriterio["a"]>=$loa) {
                                        if($rowTarifa["factortarifa"]!="0")
                                            $tarifa=$loa*$rowCriterio["tarifa"];
                                        else
                                            $tarifa=$rowCriterio["tarifa"];
                                        if($rowCriterio["tarifa2"]!="" or $rowCriterio["tarifa2"]!=null) {
                                            if($rowTarifa["factortarifa"]!="0")
                                                $tarifa+=$loa*$rowCriterio["tarifa2"];
                                            else
                                                $tarifa+=$rowCriterio["tarifa2"];
                                        }
                                    }
                                    else if($rowCriterio["de"]<=$loa and ($rowCriterio["a"]=="" or $rowCriterio["a"]==null) ) {
                                            if($rowTarifa["factortarifa"]!="0")
                                                $tarifa=$loa*$rowCriterio["tarifa"];
                                            else
                                                $tarifa=$rowCriterio["tarifa"];
                                            if($rowCriterio["tarifa2"]!="" or $rowCriterio["tarifa2"]!=null) {
                                                if($rowTarifa["factortarifa"]!="0")
                                                    $tarifa+=$loa*$rowCriterio["tarifa2"];
                                                else
                                                    $tarifa+=$rowCriterio["tarifa2"];
                                            }
                                        }
                                }
                            }
                            else if($rowTarifa["criteriogrt"]!="0") {
                                    $queryCriterio="select * from criterios where concepto='$concepto'";
                                    $resultCriterio = mysql_query($queryCriterio, $link);
                                    while($rowCriterio = mysql_fetch_array($resultCriterio)) {
                                        if($rowCriterio["de"]<=$grt and $rowCriterio["a"]>=$grt) {
                                            if($rowTarifa["factortarifa"]!="0")
                                                $tarifa=$grt*$rowCriterio["tarifa"];
                                            else
                                                $tarifa=$rowCriterio["tarifa"];
                                            if($rowCriterio["tarifa2"]!="" or $rowCriterio["tarifa2"]!=null) {
                                                if($rowTarifa["factortarifa"]!="0")
                                                    $tarifa+=$grt*$rowCriterio["tarifa2"];
                                                else
                                                    $tarifa+=$rowCriterio["tarifa2"];
                                            }
                                        }
                                        else if($rowCriterio["de"]<=$grt and ($rowCriterio["a"]=="" or $rowCriterio["a"]==null) ) {
                                                if($rowTarifa["factortarifa"]!="0")
                                                    $tarifa=$grt*$rowCriterio["tarifa"];
                                                else
                                                    $tarifa=$rowCriterio["tarifa"];
                                                if($rowCriterio["tarifa2"]!="" or $rowCriterio["tarifa2"]!=null) {
                                                    if($rowTarifa["factortarifa"]!="0")
                                                        $tarifa+=$grt*$rowCriterio["tarifa2"];
                                                    else
                                                        $tarifa+=$rowCriterio["tarifa2"];
                                                }
                                            }
                                    }
                                }
                        if($rowTarifa["factortarifa"]!="0") {
                        ////////////FACTOR
                            if($rowTarifa["factortiempo"]!="0") {
                                $tarifa=$time*$tarifa;
                            }
                            else if($rowTarifa["factorgrt"]!="0") {
                                    $tarifa=$grt*$tarifa;
                                }
                                else if($rowTarifa["factorloa"]!="0") {
                                        $tarifa=$loa*$tarifa;
                                    }
                                    else if($rowTarifa["factordia"]!="0") {
                                            $tarifa=($time/24)*$tarifa;
                                        }

                        }
                    }
                    ?>

                <tr bgcolor="#FFFFFF">
                    <td height="24">
                        <input type="checkbox" name="<?php echo $item."item"; ?>" id="x"  value="1" checked="true"/>
                    </td>
                    <td>
                        <input class="general" type="text" name="<?php echo $item."cantidad"; ?>" id="textBox" value="1" size="5" /></td>
                    <td><?php echo $clasificacion; ?></td>
                    <td><input class="generalCombo" type="text" name="<?php echo $item."concepto"; ?>" id="textfield" value="<?php echo $concepto; ?>" size="68" readonly="true"/></td>
                    <td><input class="generalCombo" type="text" name="<?php echo $item."referencia"; ?>" id="textfield2" value="<?php echo $referencia; ?>" readonly="true"/></td>
                    <td align="right"><input class="generalCombo" type="text" name="<?php echo $item."pu"; ?>" id="textfield3" value="<?php echo "$ ".number_format($tarifa, 2, ".", ","); ?>" size="15" align="right" readonly="true"/></td>
                </tr>
                    <?php
                    $item++;
                }
                ?>
            </table>
            <input class="general" name="item" type="hidden" value="<?php echo $item; ?>" />
            <input class="general" name="puerto" type="hidden" value="<?php echo $puerto; ?>" />
            <input class="general" name="id" type="hidden" value="<?php echo $id; ?>" />
            <input class="general" type="submit" name="button" id="button" value="Siguiente" align="right"/>
        </form>
    </body>
</html>