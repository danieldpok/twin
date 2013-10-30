<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<?php
include("conexion.php");
$id=$_GET["id"];

$link = Conectar();
$tabla="regulararrival";
if(isset($_POST["add"]))	{
	
	$id=$_POST["id"];
	$fecha=$_POST["fecha"];
	$hinicial=$_POST["hinicial"];
	$hfinal=$_POST["hfinal"];
	$tipo=$_POST["tipo"];
	$fact=$_POST["fact"];
	$clasif=$_POST["clasif"];
	$timepercent=$_POST["timepercent"];
	$tipo=$_POST["tipo"];
	
	$query="insert into computotiempo (id, fecha, hinicial, hfinal, tipo, fact, clasif, timepercent) values ('$id', '$fecha', '$hinicial', '$hfinal', '$tipo', '$fact', '$clasif', '$timepercent')";
	mysql_query($query, $link);	
	
}else if(isset($_POST["delete"]))	{
	
	$query="delete from computotiempo where idcomputoTiempo='".$_POST["idcomputotiempo"]."'";
	mysql_query($query, $link);
	$id=$_POST["id"];
	
}else if(isset($_POST["save"]))	{
	
	$id=$_POST["id"];
	$fecha=$_POST["fecha"];
	$hinicial=$_POST["hinicial"];
	$hfinal=$_POST["hfinal"];
	$fact=$_POST["fact"];
	$timepercent=$_POST["timepercent"];
	$clasif=$_POST["clasif"];
	
	$query="update computotiempo set fecha='$fecha', hinicial='$hinicial', hfinal='$hfinal', fact='$fact', timepercent='$timepercent', clasif='$clasif' where idcomputoTiempo='".$_POST["idcomputotiempo"]."'";
	
	//echo $query;
	
	mysql_query($query, $link);
	
	
}else if(isset($_POST["guardar"]))	{
	
	$id=$_POST["id"];
	$vessel=$_POST["vessel"];
	$flag=$_POST["flag"];
	$puertodecarga=$_POST["puertodecarga"];
	$puerto=$_POST["dischport"];
	$cargotype=$_POST["cargaentransito"];
	$mastername=$_POST["mastername"];
	
	$startdischarging=$_POST["startdischarging"];
	$completedischarging=$_POST["completedischarging"];
	
	$query="update operaciones set startdischarging='$startdischarging', completedescharging='$completedischarging', vessel='$vessel', flag='$flag', puertodecarga='$puertodecarga', puerto='$puerto', cargotype='$cargotype', mastername='$mastername' where id='".$_POST["id"]."'";	
	//echo $query;	
	mysql_query($query, $link);
	
	
}
else if(isset($_POST["reg"]))	{

	$id=$_POST["id"];
	$fecha=$_POST["fecha"];
	$fact=$_POST["fact"];
	
	if($_POST["tipo"]=="ARRIVAL MANEUVERS")	{
		$tabla="regulararrival";
		$var1="selected=\"selected\"";
	}else if($_POST["tipo"]=="OPERATIONAL")	{
		$tabla="regularoperational";
		$var2="selected=\"selected\"";
	}else if($_POST["tipo"]=="STOP/IDLE TIME")	{
		$tabla="regularstop";
		$var3="selected=\"selected\"";
	}else if($_POST["tipo"]=="SAILING INFORMATION")	{
		$tabla="sailing";
		$var4="selected=\"selected\"";
	}
	
	$query="insert into $tabla (concepto) values ('$fact')";
	mysql_query($query, $link);	
}
else if(isset($_POST["notas"]))	{
	
	$id=$_POST["id"];
	
	$masterremarks=$_POST["masterremarks"];
	$remarks=$_POST["remarks"];
	
	$query="update operaciones set masterremarks='$masterremarks', remarks='$remarks' where id='".$_POST["id"]."'";
	mysql_query($query, $link);
	
	for($i=1; $i<=10; $i++)	{
		$query="update operaciones set titulo$i='".$_POST["titulo$i"]."', titulo2$i='".$_POST["titulo2$i"]."', onbehalf$i='".$_POST["onbehalf$i"]."', etiqueta$i='".$_POST["etiqueta$i"]."' where id='".$_POST["id"]."'";
		//echo $query;
	mysql_query($query, $link);
	}	
	
}

else if(isset($_POST["tipo"]))	{
	$id=$_POST["id"];
	$fecha=$_POST["fecha"];
	
	if($_POST["tipo"]=="ARRIVAL MANEUVERS")	{
		$tabla="regulararrival";
		$var1="selected=\"selected\"";
	}else if($_POST["tipo"]=="OPERATIONAL")	{
		$tabla="regularoperational";
		$var2="selected=\"selected\"";
	}else if($_POST["tipo"]=="STOP/IDLE TIME")	{
		$tabla="regularstop";
		$var3="selected=\"selected\"";
	}else if($_POST["tipo"]=="SAILING INFORMATION")	{
		$tabla="sailing";
		$var4="selected=\"selected\"";
	}
}

//////DATOS DE LA OPERACION

$query = "select * from operaciones where id='".$id."'";

$result = mysql_query($query, $link);

while($row = mysql_fetch_array($result)) {
    $vessel=$row["vessel"];
    $flag=$row["flag"];
    $puertodecarga=$row["puertodecarga"];
    $quantity=$row["quantity"];
    $cargotype=$row["cargotype"];
	$puerto=$row["puerto"];
	$startdischarging=strftime('%Y-%m-%d %H:%M',strtotime($row["startdischarging"]));
	$completedischarging=strftime('%Y-%m-%d %H:%M',strtotime($row["completedescharging"]));
	
	if($startdischarging=="1969/12/31 18:00")
		$startdischarging="";
	if($completedischarging=="1969/12/31 18:00")
		$completedischarging="";
	if($startdischarging=="1969-12-31 18:00")
		$startdischarging="";
	if($completedischarging=="1969-12-31 18:00")
		$completedischarging="";
		
	
	
	$shoredraft=$row["shoredraft"];
	$vesseldraft=$row["vesseldraft"];
	$shorescale=$row["shorescale"];
	$shortage=$row["shortage"];

	$masterremarks=$row["masterremarks"];
	$remarks=$row["remarks"];
	$firmax=$row["firmax"];
	
	
	$mastername=$row["mastername"];
	
	for($i=1; $i<=10; $i++)	{
		$titulo[$i]=$row["titulo$i"];
		$titulo2[$i]=$row["titulo2$i"];
		$onbehalf[$i]=$row["onbehalf$i"];
		$etiqueta[$i]=$row["etiqueta$i"];	
		
	}
		
		
}

?>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <meta name="generator" content="Adobe GoLive" />
        <title>Estado de Hechos</title>
        <style type="text/css">
	body{
		/*
		You can remove these four options 
		
		*/
		background-repeat:no-repeat;
		font-family: Trebuchet MS, Lucida Sans Unicode, Arial, sans-serif;
		margin:0px;
		

	}
	#ad{
		padding-top:220px;
		padding-left:10px;
	}
	.xxxxxx {
	font-size: 36px;
	color: #06C;
}
        .zzzzzzz {
	color: #FFF;
	background-color: #006;
}
.titulo {
	color: #FFF;
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 18px;
	text-align: left;
}
.texto {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 12px;
}
        </style>
	<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
	<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
        <link href="css/basic.css" rel="stylesheet" type="text/css" media="all" />
    <script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
    <script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
    <script src="SpryAssets/SpryCollapsiblePanel.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
    <link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
    <link href="SpryAssets/SpryCollapsiblePanel.css" rel="stylesheet" type="text/css" />


<!--- ##########     MODIFICADO POR AVO   ############--->
<!--- ### pone los : a las cajas de txt de las hrs ###--->
<script language="javascript" type="text/javascript">
function fmthr(hr, nom)
{
  var hrf;
  if(hr.substring(2,3) !== ':' && nom.value!== "")
  {
    hrf = hr.substring(0,2) + ":" + hr.substring(2,4);
    nom.value = hrf;
  }

  if (hr.length < 4)
  {
    nom.value = "";
  }
}
</script>


</head>
    
<body bgcolor="#ffffff">
<table width="847" border="0" align="center">
        <tr>
          <td width="841">
          <table width="885" border="1" align="center">
            <tr>
              <td width="433"><img src="logo.jpg" alt="" width="385" height="120" /></td>
              <td width="442" bgcolor="#0066FF" class="titulo">Asistente de Estado de Hechos</td>
            </tr>
          </table>
          <form name="form0" id="form0" method="post" action="factsform.php">
          <table width="668" border="1" align="center">
            <tr>
<td><span id="sprytextfield6">
                <label>Vessel:
                  <input type="text" name="vessel" id="vessel" value="<?php echo $vessel; ?>"  />
                </label>
</span></td>
<td><span id="sprytextfield12">
                <label>Flag:
                  <input type="text" name="flag" id="flag" value="<?php echo $flag; ?>" />
                </label>
</span></td>
            </tr>
            <tr>
<td><span id="sprytextfield13">
                <label>Loading Port:
                  <input type="text" name="puertodecarga" id="puertodecarga" value="<?php $puertodecarga; ?>"  />
                </label>
</span></td>
<td><span id="sprytextfield15">
                <label>Disch Port:
                  <input type="text" name="dischport" id="dischport" value="<?php echo $puerto; ?>"  />
                </label>
</span></td>
            </tr>
            <tr>
<td><span id="sprytextfield14">
                <label>Cargo:
                  <input type="text" name="cargaentransito" id="cargaentransito" value="<?php echo $cargotype; ?>"  />
                </label>
</span></td>
<td><span id="sprytextfield16">
                <label>Agency:
                  <input type="text" name="agency" id="agency" value="TWIN MARINE DE MEXICO, S.A. DE C.V."  />
                </label>
</span></td>
            </tr>
            <tr>
            <td><span id="sprytextfield17">
            <label>Start Discharging:
              <input type="text" name="startdischarging" id="startdischarging" value="<?php echo $startdischarging; ?>" />
            </label><br />yyyy-mm-dd hh:mm
            </span></td>
            <td><span id="sprytextfield18">
            <label>Complete Discharging:
              <input type="text" name="completedischarging" id="completedischarging" value="<?php echo $completedischarging; ?>" />
            </label><br />yyyy-mm-dd hh:mm
</span></td>
            </tr>
            <tr>
              <td colspan="2">Master Name: 
                <label>
                  <input type="text" name="mastername" id="mastername" value="<?php echo $mastername; ?>" />
              </label></td>
            </tr>
            
          </table>
<input type="hidden" name="id" id="id" value="<?php echo $id?>" />
          <label>
            <input type="submit" name="guardar" id="guardar" value="Guardar" />
          </label>
          </form>
          <form name="form" id="form" method="post" action="factsform.php">
          <input type="hidden" name="id" value="<?php echo $id; ?>" />
          <table width="880" border="1" align="center">
            <tr>
<td width="807"><span id="spryselect1">
                <label>Tipo:
                  <select name="tipo" id="tipo"  onchange="this.form.submit()">
                    <option value="ARRIVAL MANEUVERS" selected="selected" <?php echo $var1; ?>>ARRIVAL MANEUVERS</option>
                    <option value="OPERATIONAL" <?php echo $var2; ?>>OPERATIONAL</option>
                    <option value="STOP/IDLE TIME" <?php echo $var3; ?>>STOP/IDLE TIME</option>
                    <option value="SAILING INFORMATION" <?php echo $var4; ?>>SAILING INFORMATION</option>
                  </select>
              </label>
              <span class="selectRequiredMsg">Seleccione un elemento.</span></span><span id="spryselect2">
              <label>Clasificación:
                <select name="clasif" id="clasif">
                  <option value="seleccionar..." selected="selected">Seleccionar...</option>
                  <?php
				  $query = "select clasificacion from clasificacion order by clasificacion";
					$result = mysql_query($query, $link);
					while($row = mysql_fetch_array($result)) {
						echo "<option value=\"".$row["clasificacion"]."\">".$row["clasificacion"]."</option>";
					}
				  ?>
                </select>
              </label>
              <span class="selectRequiredMsg">Seleccione un elemento.</span></span> <a href="clasificaciones.php?id=<?php echo $id; ?>" target="_self">Editar Clasificaciones</a></td>
            </tr>
            <tr>
<td><span id="spryselect3">
                <label>Opciones Regulares:
                  <select name="na" id="na" onchange="fact.value=na.value" >
                  <option value="seleccionar...">Seleccionar...</option>
                    <?php
					$query = "select * from $tabla order by concepto";
					$result = mysql_query($query, $link);
					while($row = mysql_fetch_array($result)) {
						echo "<option value=\"".$row["concepto"]."\">".$row["concepto"]."</option>";
					}
				  ?>
                  </select>
                  
                </label>
              <span class="selectRequiredMsg">Seleccione un elemento.</span></span></td>
            </tr>
            <tr>
<td><span id="sprytextfield1">
                <label>FACT:
                  <input type="text" name="fact" id="fact" size="100"/>
                </label>
              <span class="textfieldRequiredMsg">Se necesita un valor.</span></span><input type="submit" name="reg" id="reg" value="Guardar en Opc. Reg." /></td>
            </tr>
            <tr>
<td><span id="sprytextfield2">
                <label>Fecha:
                  <input type="text" name="fecha" id="fecha" size="10" readonly="readonly" value="<?php echo $fecha; ?>"/>
                  <input type="button" value="Cal" onclick="displayCalendar(document.forms[1].fecha,'yyyy/mm/dd',this)" />
                </label>
              <span class="textfieldRequiredMsg">Se necesita un valor.</span></span><span id="sprytextfield3">
              <label>H.Inicial:
                <input type="text" name="hinicial" id="hinicial" size="5" OnBlur= " fmthr(this.value, this) " />
              </label>
<span class="textfieldInvalidFormatMsg">Formato no válido.</span></span><span id="sprytextfield4">
              <label>H.Final:
                <input type="text" name="hfinal" id="hfinal" size="5" OnBlur= " fmthr(this.value, this) " />
              </label>
<span class="textfieldInvalidFormatMsg">Formato no válido.</span></span><span id="sprytextfield5">
              <label>% to Discount:
                <input type="text" name="timepercent" id="timepercent" size="5" />
              </label>
</span>
              <label>
                <input type="submit" name="add" id="add" value="add" />
              </label></td>
            </tr>
          </table></form>
          <table width="954" border="1">
            <tr class="zzzzzzz">
              <td width="60">Fecha</td>
              <td width="40">H.Inicial</td>
              <td width="34">H.Final</td>
              <td width="144">Tipo</td>
              <td width="226">Clasificación</td>
              <td width="277">Fact</td>
              <td width="54">% to Discount</td>
              <td width="67">Option</td>
            </tr>
            <?php
			//OBTENER LOS HECHOS
			$query = "select * from computotiempo where id='".$id."' order by fecha, tipo, hinicial, hfinal";
			$result = mysql_query($query, $link);
			$ix=1;
			$fechaAnterior="start";
			while($row = mysql_fetch_array($result)) {
			if($row["fecha"]!=$fechaAnterior and $fechaAnterior!="start")	{
				$fechaAnterior=$row["fecha"];
				?>
			</table>
			<?php
			#####################################
			#####     resalta cambio de fechas    
			#####################################
			?>
			
				<HR size="15" color="red">
				<table width="954" border="1">
				<?php
			} else if($fechaAnterior=="start")	{
				$fechaAnterior=$row["fecha"];
			}
			?>
            <form name="form<?php echo $ix; ?>" id="form<?php echo $ix; ?>" method="post" action="factsform.php#<?php echo $ix; ?>">
            <tr bgcolor="#00CCFF">
              <td height="52"><span id="sprytextfield7">
              <label>
                <input type="text" name="fecha" id="fecha" value="<?php echo $row["fecha"]; ?>" size="10" />
              </label>
</span></td>
              <td><span id="sprytextfield8">
              <label>
                <input type="text" name="hinicial" id="hinicial" value="<?php echo $row["hinicial"]; ?>" size="5" OnBlur= " fmthr(this.value, this) " />
              </label>
<span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
              <td><span id="sprytextfield9">
              <label>
                <input type="text" name="hfinal" id="hfinal" value="<?php echo $row["hfinal"]; ?>" size="5" OnBlur= " fmthr(this.value, this) " />
              </label>
<span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>              
              <td><a name="<?php echo $ix; ?>" id="<?php echo $ix; ?>"></a>
              <input type="hidden" name="id" value="<?php echo $id; ?>" />
              <input type="hidden" name="idcomputotiempo" value="<?php echo $row["idcomputoTiempo"]; ?>" /><?php echo $row["tipo"]; ?></td>
              <td><?php //if($row["clasif"]!="null") echo $row["clasif"]; ?>
                <label>
                  <select name="clasif" id="clasif" style="width:250px">
                  <option value="" >Seleccionar...</option>
                  <?php
				  $query = "select clasificacion from clasificacion order by clasificacion";
					$resultx = mysql_query($query, $link);
					while($rowx = mysql_fetch_array($resultx)) {
						if($rowx["clasificacion"]==$row["clasif"])
							echo "<option value=\"".$rowx["clasificacion"]."\" selected=\"selected\">".$rowx["clasificacion"]."</option>";
						else
							echo "<option value=\"".$rowx["clasificacion"]."\" >".$rowx["clasificacion"]."</option>";

					}
				  ?>
                  </select>
              </label></td>
<td><span id="sprytextfield10">
                <label>
                  <textarea name="fact" cols="40" id="fact"><?php echo $row["fact"]; ?></textarea>
                </label>
              <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
<td><span id="sprytextfield11">
                <label>
                <?php
				if($row["timepercent"]!="null")	{
					$time=$row["timepercent"];
				}	else	{
					$time="";
				}
				
				?>
                  <input type="text" name="timepercent" id="timepercent" value="<?php echo $time; ?>" size="5" />
                </label>
</span></td>
              <td width="67">              
                <label>
                  <input type="submit" name="save" id="save" value="Guardar" />
                </label>
                <label>
                  <input type="submit" name="delete" id="delete" value="Eliminar" />
              </label></td>
            </tr>
            </form>         
          <?php
		  $ix++;
		}
		?>
</table>
          <div id="CollapsiblePanel1" class="CollapsiblePanel">
            <div class="CollapsiblePanelTab" tabindex="0">Remarks (clic para mostrar el panel)</div>
            <div class="CollapsiblePanelContent">
            <form name="formnotas" id="formnotas" method="post" action="factsform.php#remark">
            <a name="remark" id="remark"></a>
              <table width="536" border="1" align="center" bgcolor="#FFFFFF">
                <tr>
                  <td bgcolor="#0066FF" class="titulo">Remarks</td>
                </tr>
                <tr>
                  <td height="80"><label>Master Remarks:<br />
                    <textarea name="masterremarks" id="masterremarks" cols="130" rows="3" ><?php echo $masterremarks; ?></textarea>
                  </label><br />
                  <label>General Remarks:<br />
                    <textarea name="remarks" id="remarks" cols="130" rows="6"><?php echo $remarks; ?></textarea>
                  </label>                  
                  </td>
                </tr>
              </table>
              <table width="316" border="1" align="center" bgcolor="#FFFFFF">
                <tr>
                  <td width="306" bgcolor="#0066FF" class="titulo">Firmas</td>
                </tr>
                <tr>
                  <td>
                  
                    <?php for($i=1; $i<=10; $i++)	{ ?>
                  Firma:
                  <table width="306" border="1">
                    <tr>
                      <td width="296"><label>
                        <input type="text" name="titulo<?php echo $i; ?>" id="titulo<?php echo $i; ?>" size="50" value="<?php echo $titulo[$i]; ?>"/>
                      </label></td>
                    </tr>
			<tr>
                      <td width="296"><label>
                        <input type="text" name="titulo2<?php echo $i; ?>" id="titulo2<?php echo $i; ?>" size="50" value="<?php echo $titulo2[$i]; ?>"/>
                      </label></td>
                    </tr>
                    <tr>
                      <td><label>
                          <input type="text" name="onbehalf<?php echo $i; ?>" id="onbehalf<?php echo $i; ?>"size="50" value="<?php echo $onbehalf[$i]; ?>" />
                      </label></td>
                    </tr>
                    <tr>
                      <td><label>
                          <input type="text" name="etiqueta<?php echo $i; ?>" id="etiqueta<?php echo $i; ?>" size="50" value="<?php echo $etiqueta[$i]; ?>" />
                      </label></td>
                    </tr>
                  </table>
                  <?php } ?>
                  <p>&nbsp;</p></td>
                </tr>
              </table>
              <input type="hidden" name="id" value="<?php echo $id; ?>" />
              <label>
                <input type="submit" name="notas" id="notas" value="Guardar" />
              </label>
            </form>
            </div>
          </div>
          <p><a href="facts.php?id=<?php echo $id; ?>" target="_blank">CONSULTAR ESTADO DE HECHOS&gt;&gt;</a><BR />
          <a href="edicionestadisticasfacts.php?id=<?php echo $id; ?>" target="_blank">CONSULTAR ESTADISTICAS DE HECHOS&gt;&gt;</a><BR />
          <a href="timecalcform.php?id=<?php echo $id; ?>" target="_blank">CONSULTAR COMPUTO DE TIEMPO&gt;&gt;</a><BR />
          </p>
          <p><font size="-2">Powered in association  by TWIN MARINE DE MEXICO, S.A. DE C.V.  and  DAKA Technology. &lt;&lt;Copyright © 2009-2010 All Rights Reserved&gt;&gt;</font></p></td>
        </tr>
</table>
<script type="text/javascript">
<!--
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2");
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3");
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "custom", {pattern:"00:00", hint:"00:00", isRequired:false});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "custom", {pattern:"00:00", hint:"00:00", isRequired:false});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {isRequired:false});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "none", {isRequired:false});
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "custom", {pattern:"00:00", isRequired:false});
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9", "custom", {pattern:"00:00", isRequired:false});
var sprytextfield10 = new Spry.Widget.ValidationTextField("sprytextfield10");
var sprytextfield11 = new Spry.Widget.ValidationTextField("sprytextfield11", "none", {isRequired:false});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "none", {isRequired:false});
var sprytextfield12 = new Spry.Widget.ValidationTextField("sprytextfield12", "none", {isRequired:false});
var sprytextfield13 = new Spry.Widget.ValidationTextField("sprytextfield13", "none", {isRequired:false});
var sprytextfield14 = new Spry.Widget.ValidationTextField("sprytextfield14", "none", {isRequired:false});
var sprytextfield15 = new Spry.Widget.ValidationTextField("sprytextfield15", "none", {isRequired:false});
var sprytextfield16 = new Spry.Widget.ValidationTextField("sprytextfield16", "none", {isRequired:false});
//-->
  </script>
<SCRIPT>
function clasificaciones(valor)	{
    window.open(document.forms[valor].tipo.value, "", "");

	<?php
	$query = "select * from regulararrival order by concepto";
	$result = mysql_query($query, $link);
	$i=0;
	while($row = mysql_fetch_array($result)) {
		if($i==0)	{
			$varA=$varA."\"".$row["concepto"]."\"";
			$i++;
		} else	{
			$varA=$varA.", \"".$row["concepto"]."\"";
		}
	}	
	?>
	var arrival=new Array(<?php echo $varA; ?>);
	<?php	
	$query = "select * from regularoperational order by concepto";
	$result = mysql_query($query, $link);
	$i=0;
	while($row = mysql_fetch_array($result)) {
		if($i==0)	{
			$varA=$varA."\"".$row["concepto"]."\"";
			$i++;
		} else	{
			$varA=$varA.", \"".$row["concepto"]."\"";
		}
	}	
	?>	
	var stopTime=new Array(<?php echo $varA; ?>);
	<?php	
	$query = "select * from regularstop order by concepto";
	$result = mysql_query($query, $link);
	$i=0;
	while($row = mysql_fetch_array($result)) {
		if($i==0)	{
			$varA=$varA."\"".$row["concepto"]."\"";
			$i++;
		} else	{
			$varA=$varA.", \"".$row["concepto"]."\"";
		}
	}	
	?>
	var operational=new Array(<?php echo $varA; ?>);
	
	
//		document.forms[0].fact.value=document.forms[0].na.value
		
		/*num_reg = objeto.lengt;		
		if(valor[valor.selectedIndex].value=="ARRIVAL MANEUVERS")	{
			for(i=0;i<num_reg;i++){ 
			  objeto[i].value=arrival[i];
			  objeto[i].text=arrival[i];
		   }
		} else if(valor[valor.selectedIndex].value=="OPERATIONAL")	{
			for(i=0;i<num_reg;i++){ 
			  objeto[i].value=stopTime[i];
			  objeto[i].text=stopTime[i];
		   }
		}	else if(valor[valor.selectedIndex].value=="STOP/IDLE TIME")	{
			for(i=0;i<num_reg;i++){ 
			  objeto[i].value=operational[i];
			  objeto[i].text=operational[i];
		   }
		}*/
	}
var sprytextfield17 = new Spry.Widget.ValidationTextField("sprytextfield17", "none", {isRequired:false});
var sprytextfield18 = new Spry.Widget.ValidationTextField("sprytextfield18", "none", {isRequired:false});
  </SCRIPT>
  <SCRIPT>
function change()	{
	  document.forms[1].fact.value=document.forms[1].na.value;
	  document.forms[1].fact.focus();
  }
var CollapsiblePanel1 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel1");
  </SCRIPT>
</body>

</html>
