<?php
function restaHoras($horaFin, $horaIni) {
                $hora1=$horaIni;
                $hora2=$horaFin;
                $hora1=explode(":",$hora1);
                $hora2=explode(":",$hora2);

                $minutos1=((int)$hora1[0]*60)+(int)$hora1[1];
                $minutos2=((int)$hora2[0]*60)+(int)$hora2[1];
                $minutosTotales=$minutos1-$minutos2;

                //$horas=(int)$hora1[0]-(int)$hora2[0];
                //$minutos=(int)$hora1[1]-(int)$hora2[1];
                //$horas+=(int)($minutos/60);
                $horas=(int)($minutosTotales/60);
                //$minutos=$minutos%60;
                $minutos=$minutosTotales%60;
                if($minutos==0)$minutos="00";
                else if($minutos==60) {
                        $minutos="00";
                        $horas++;
                    }
                return $horas.":".$minutos;
            }

            function restaHorasInt($horaIni, $horaFin) {
                $hora1=$horaIni;
                $hora2=$horaFin;
                $hora1=explode(":",$hora1);
                $hora2=explode(":",$hora2);
                $horas=(int)$hora1[0]-(int)$hora2[0];
                $minutos=(int)$hora1[1]-(int)$hora2[1];
                $minutos+=$horas*60;
                return $minutos;
            }
            function restaHorasIntStat($horaIni, $horaFin) {
                $hora1=$horaIni;
                $hora2=$horaFin;
                $hora1=explode(":",$hora1);
                $hora2=explode(":",$hora2);
                $horas1=(int)($hora1[0]*24)+$hora1[1];
                $horas=(int)$horas1-(int)$hora2[0];
                $minutos=(int)$hora1[2]-(int)$hora2[1];
                $minutos+=$horas*60;
                return $minutos;
            }
            function restaHorasdiff($horaIni, $horaFin) {
                $hora1=$horaIni;
                $hora2=$horaFin;
                $hora1=explode(":",$hora1);
                $hora2=explode(":",$hora2);
                $horas1=(int)($hora1[0]*24)+$hora1[1];
                $horas=(int)$horas1-(int)$hora2[0];
                $minutos=(int)$hora1[2]-(int)$hora2[1];
                $minutos+=$horas*60;

                $horas=(int)($minutos/60);
                $minutos=$minutos%60;
                if($minutos==0)$minutos="00";
                else if($minutos==60) {
                        $minutos="00";
                        $horas++;
                    }
                $dias=(int)($horas/24);
                $horas=$horas%24;
                return $dias."D:".$horas."H:".$minutos."M";
            }

            function sumaHoras($horaIni, $horaFin) {
                $hora1=$horaIni;
                $hora2=$horaFin;
                $hora1=explode(":",$hora1);
                $hora2=explode(":",$hora2);
                $horas=(int)$hora1[0]+(int)$hora2[0];
                $minutos=(int)$hora1[1]+(int)$hora2[1];
                $horas+=(int)($minutos/60);
                $minutos=$minutos%60;
                if($minutos==0)$minutos="00";
                else if($minutos==60) {
                        $minutos="00";
                        $horas++;
                    }
                return $horas.":".$minutos;

            }

            function porcentajeHoras2($hora, $porcentaje) {
                $horas=0;
                $hora1=$hora;
                $por=$porcentaje;
                $hora1=explode(":",$hora1);
                $htot=((int)$hora1[0]*60)+(int)$hora1[1];
				$buf=$htot*($por/100);
                $htot=(int)$htot*($por/100);
				$buf-=$htot;
                $horas+=(int)($htot/60);
                $minutos=$htot%60;
				if($buf>=0.5)
					$minutos++;
                if($minutos==0)$minutos="00";				
                return $horas.":".$minutos;

            }
            function porcentajeHoras($hora, $porcentaje) {
                $horas=0;
                $ajuste=0;
                $hora1=$hora;
                $por=$porcentaje;
                $hora1=explode(":",$hora1);
                $htot=((int)$hora1[0]*60)+(int)$hora1[1];
                /*if(($por%100)>0)    {
                    $ajuste=1;
                }*/
				$buf=$htot*($por/100);
                $htot=(int)($htot*($por/100));
				$buf-=$htot;
                $horas+=(int)($htot/60);
                $minutos=$htot%60;
                $minutos+=$ajuste;
				if($buf>=0.5)
					$minutos++;
                if($minutos==0)$minutos="00";
                return $horas.":".$minutos;

            }
            function miliseg($var) {
                $mins=explode(":", $var);
                $minfin=(int)$mins[1]+((int)$mins[0]*60);
                return (int)$minfin;
            }
            function mintoho($mtot) {
                $horas+=(int)($mtot/60);
                $minutos=$mtot%60;
                if($minutos==0)$minutos="00";
                return $horas.":".$minutos;
            }
            function portot($min, $totmin) {
                $portot=(100*$min)/$totmin;
                return $portot;
            }
            function plus($datex)    {
                list($year,$mon,$day) = explode(' ',$datex);
                return date('d m Y',mktime(0,0,0,$mon,$day+1,$year));
            }
			function formatoDias($arg) {
                                            $hora1=explode(":",$arg);
                                            $horas=(int)$hora1[0];
                                            $minutos=(int)$hora1[1];
                                            $horas+=(int)($minutos/60);
                                            $minutos=$minutos%60;
                                            if($minutos==0)$minutos="00";
                                            $dias=(int)($horas/24);
                                            $minutos+=($horas%24)*60;
                                            $horas=(int)($minutos/60);
                                            $minutos=(int)($minutos%60);
                                            if($minutos==0)$minutos="00";
                                            return "$dias D: $horas H: $minutos M";
                                        }
?>