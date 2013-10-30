<?php

include("conexion.php");
$link=conectar();


$id=$_GET["id"];


	$query = "select recibidor, producto, cantidad, abreviado, termino from conciliacion where id='$id'";
echo $query."<\br>";
                                                $j=0;
                                                $result = mysql_query($query, $link);
                                                while($row = mysql_fetch_array($result)) {
                                                     $recibidor[$j]=$row["recibidor"];
													 $rec[$j]=$row["abreviado"];
													 $termino[$j]=$row["termino"];
                                                     $producto[$j]=$row["producto"];
                                                     $cantidad[$j]=$row["cantidad"];
													 $cantidad[$j]=round($cantidad[$j] * 1000) / 1000;
                                                        $j++;
                                                }
                                                for($ix=0; $ix<count($recibidor); $ix++) {
                                                    $query = "select distinct c.bl, c.producto, c.pesoneto, p.abreviacion from chargeinformation c, pesobodega p where c.producto=p.producto and c.id='$id' and c.recibidor='$recibidor[$ix]' and c.producto='$producto[$ix]'";
?>
x
<?php
echo $query;
?>
x<br>
<?php

                                                    $result = mysql_query($query, $link);
                                                    $bl="";
                                                    $pesoneto=0.000;
                                                    while($row = mysql_fetch_array($result)) {
                                                        $reciver = $row["recibidor"];
                                                        $bl=$bl.$row["bl"].", ";
                                                        $product=$row["abreviacion"];
                                                        $pesoneto+=$row["pesoneto"];
														$pesoneto=round($pesoneto * 1000) / 1000;
                                                    }
}

?> 