<?php
include("conexion.php");
include("sesionestar.php");
session_start();
$link= Conectar();
	$query = "select * from usuarios where User ='".$_SESSION['Usersession']."' and tipo='ADMINISTRADOR' and password='".$_SESSION['Pass']."' ";
	  $result= mysql_query($query,$link);
	
	while($row = mysql_fetch_array($result))
	{
	$User=$row["user"];
	$Pass=$row["password"];
    $tip=$row["tipo"];
	}
if($_SESSION['Usersession']==true && $tip=="ADMINISTRADOR")
{?><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Twin Marine de Mexico</title>

<link href="css/basic.css" type="text/css" media="all" rel="stylesheet" />
<script src="SpryAssets/SpryAccordion.js" type="text/javascript"></script>
<link href="SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css">
<body><table width="1001" border="1">
  <tr>
    <td width="850" height="772"><applet code="twin.EscritorioA" width="850" height="835" align="left" archive="twin.jar" background="255,255,255" >
    </applet></td>
    <td width="141" class="fontTITLE">REPORTES
    <table width="200" height="750" border="0">
     
      <tr>
        <td height="746" valign="top" bgcolor="#004E98">
        <p class="fontSub">&nbsp;</p>
        <div id="Accordion1" class="Accordion" tabindex="0">
          <div class="AccordionPanel">
              <div class="AccordionPanelTab">NOTICE OF READINEES</div>
              <div class="AccordionPanelContent">
                <p>Ingrese ID del Reporte a Consultar...</p>
                <form action="http://server-twinmarine.homelinux.com/twin/nor.php" method="get">
                <input type="text" name="id" value="">
                <input name="Enviar" type="submit" value="Enviar" >
                </form>
              </div>
            </div>
          <div class="AccordionPanel">
            <div class="AccordionPanelTab">Estado de Hechos</div>
            <div class="AccordionPanelContent">
              <p>Ingrese ID del Reporte a Consultar...</p>
              <form action="http://server-twinmarine.homelinux.com/twin/facts.php" method="get">
                <input type="text" name="id" value="">
                <input name="Enviar" type="submit" value="Enviar" >
              </form>
            </div>
          </div>
          <div class="AccordionPanel">
            <div class="AccordionPanelTab">Computo de Tiempo</div>
            <div class="AccordionPanelContent">
            <p>Ingrese ID del Reporte a Consultar...</p>
              <form action="http://server-twinmarine.homelinux.com/twin/timecalc.php" method="get">
                <input type="text" name="id" value="">
                <input name="Enviar" type="submit" value="Enviar" >
              </form>
              </div>
          </div>
          <div class="AccordionPanel">
            <div class="AccordionPanelTab">Estadisticas del Estado de Hechos</div>
            <div class="AccordionPanelContent">
              <p>Ingrese ID del Reporte a Consultar...</p>
              <form action="http://server-twinmarine.homelinux.com/twin/estadisticasfacts.php" method="get">
                <input type="text" name="id" value="">
                <input name="Enviar" type="submit" value="Enviar" >
              </form>
            </div>
          </div>
          <div class="AccordionPanel">
            <div class="AccordionPanelTab">Reporte Previo</div>
            <div class="AccordionPanelContent">
            <p>Ingrese ID del Reporte a Consultar...</p>
              <form action="http://server-twinmarine.homelinux.com/twin/previo.php" method="get">
                <input type="text" name="id" value="">
                <input name="Enviar" type="submit" value="Enviar" >
              </form>
              </div>
          </div>
          <div class="AccordionPanel">
            <div class="AccordionPanelTab">Reporte General de Status</div>
            <div class="AccordionPanelContent">
            <p>Ingrese ID del Reporte a Consultar...</p>
              <form action="http://server-twinmarine.homelinux.com/twin/charges.php" method="get">
                <p>
                  <input type="text" name="id" value="">
                  </p>
                <p>Ingrese el Numero Consecutivo del Reporte...</p>
                <p>
                  <input type="text" name="no" value="">
                </p>
                <p>
                  <input name="Enviar" type="submit" value="Enviar" >
                </p>
              </form>
              </div>
          </div>
          <div class="AccordionPanel">
            <div class="AccordionPanelTab">Reporte Preliminar</div>
            <div class="AccordionPanelContent">
            <p>Ingrese ID del Reporte a Consultar...</p>
              <form action="http://server-twinmarine.homelinux.com/twin/chargesdate.php" method="get">
                <p>
                  <input type="text" name="id" value="">
                  </p>
                <p>Ingrese la fecha inicial en formato yyyy-mm-dd&quot;, &quot;Fecha de Consulta</p>
                <p>
                  <input type="text" name="date" value="">
                </p>
                <p>&quot;Ingrese la cantidad de descarga del dia&quot;</p>
                <p>
                  <input type="text" name="descarga" value="">
                </p>
                <p>&quot;Ingrese el No. Consecutivo del Reporte&quot;</p>
                <p>
                  <input type="text" name="no" value="">
                </p>
                <p>
                  <input name="Enviar" type="submit" value="Enviar" >
                </p>
              </form>
            </div>
          </div>
          <div class="AccordionPanel">
            <div class="AccordionPanelTab">Reporte de Operaciones en 24 hrs</div>
            <div class="AccordionPanelContent">
            <p>Ingrese ID del Reporte a Consultar...</p>
              <form action="http://server-twinmarine.homelinux.com/twin/chargespreliminar.php" method="get">
                <p>
                  <input type="text" name="id" value="">
                </p>
                <p>&quot;Ingrese la fecha inicial en formato yyyy-mm-dd&quot;</p>
                <p>
                  <input type="text" name="date" value="">
                </p>
                <p>&quot;Ingrese la fecha final en formato yyyy-mm-dd&quot;</p>
                <p>
                  <input type="text" name="date1" value="">
                </p>
                <p>&quot;Ingrese el No. Consecutivo del Reporte&quot;</p>
                <p>
                  <input type="text" name="no" value="">
                </p>
                <p>
                  <input name="Enviar" type="submit" value="Enviar" >
                </p>
              </form></div>
          </div>
          <div class="AccordionPanel">
            <div class="AccordionPanelTab">Acta de Finalizacion</div>
            <div class="AccordionPanelContent">
              <p>Ingrese ID del Reporte a Consultar...</p>
              <form action="http://server-twinmarine.homelinux.com/twin/actafinalizacion.php" method="get">
                <input type="text" name="id" value="">
                <input name="Enviar" type="submit" value="Enviar" >
              </form>
            </div>
          </div>
          <div class="AccordionPanel">
            <div class="AccordionPanelTab">Reporte de Supervision</div>
            <div class="AccordionPanelContent">
            <p>Ingrese ID del Reporte a Consultar...</p>
              <form action="http://server-twinmarine.homelinux.com/twin/reportegral.php" method="get">
                <input type="text" name="id" value="">
                <input name="Enviar" type="submit" value="Enviar" >
              </form>
              </div>
          </div>
          <div class="AccordionPanel">
            <div class="AccordionPanelTab">Reporte de Supervision por Turnos         </div>
            <div class="AccordionPanelContent">
            <p>Ingrese ID del Reporte a Consultar...</p>
              <form action="http://server-twinmarine.homelinux.com/twin/reportegralturno.php" method="get">
                <p>
                  <input type="text" name="id" value="">
                  </p>
                <p>&quot;Ingrese la fecha que desea consultar. *aaaa/mm/dd&quot;</p>
                <p>
                  <input type="text" name="fecha" value="">
                </p>
                <p>&quot;Ingrese la hora inicial (hh:mm)en formato de 24hrs&quot;</p>
                <p>
                  <input type="text" name="hinicial" value="">
                </p>
                <p>&quot;Ingrese la hora final (hh:mm)en formato de 24hrs&quot;</p>
                <p>
                  <input type="text" name="hfinal" value="">
                </p>
                <p>
                  <input name="Enviar" type="submit" value="Enviar" >
                </p>
              </form>
              </div>
          </div>
          <div class="AccordionPanel">
            <div class="AccordionPanelTab">Reporte por Día</div>
            <div class="AccordionPanelContent">
            <p>Ingrese ID del Reporte a Consultar...</p>
              <form action="http://server-twinmarine.homelinux.com/twin/reportegralxdia.php" method="get">
                <p>
                  <input type="text" name="id" value="">
                  </p>
                <p>&quot;Ingrese la fecha en formato yyyy-mm-dd&quot;</p>
                <p>
                  <input type="text" name="date" value="">
                </p>
                <p>
                  <input name="Enviar" type="submit" value="Enviar" >
                </p>
              </form>
              </div>
          </div>
          <div class="AccordionPanel">
            <div class="AccordionPanelTab">Reporte por Destino y Producto</div>
            <div class="AccordionPanelContent">
            <p>Ingrese ID del Reporte a Consultar...</p>
              <form action="RRXDYP.php" method="get">
                <p>
                  <input type="text" name="id" value="">
                </p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>
                  <input name="Enviar" type="submit" value="Enviar" >
                </p>
              </form>
              </div>
          </div>
          <div class="AccordionPanel">
            <div class="AccordionPanelTab">Reporte por Transportista</div>
            <div class="AccordionPanelContent">
            <p>Ingrese ID del Reporte a Consultar...</p>
              <form action="transportistas1.php" method="get">
                <input type="text" name="id" value="">
                <input name="Enviar" type="submit" value="Enviar" >
              </form>
              </div>
          </div>
          <div class="AccordionPanel">
            <div class="AccordionPanelTab">Reporte de Bodegas</div>
            <div class="AccordionPanelContent">
            <p>Ingrese ID del Reporte a Consultar...</p>
              <form action="http://server-twinmarine.homelinux.com/twin/reportegralbodega.php" method="get">
                <input type="text" name="id" value="">
                <input name="Enviar" type="submit" value="Enviar" >
              </form>
              </div>
          </div>
          <div class="AccordionPanel">
            <div class="AccordionPanelTab">Reporte de Pagos y Anticipos</div>
            <div class="AccordionPanelContent">
            
              <form action="http://server-twinmarine.homelinux.com/twin/listaanticipos.php" method="get">
                <input name="Enviar2" type="submit" value="Consultar" >
              </form>
              </div>
          </div>
        </div></td>
      </tr>
    </table></td>
  </tr>
</table>
<script type="text/javascript">
<!--
var Accordion1 = new Spry.Widget.Accordion("Accordion1");
//-->
</script>
</body>
</html>

<?php }
else {
echo "Error, no tienes permiso.";

?>

<form action="index.html">
<input TYPE="submit" NAME="Back" VALUE="Back" /></form>
<?php
}
?>