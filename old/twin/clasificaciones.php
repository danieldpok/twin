<?php
include("conexion.php");
$id=$_GET["id"];
$link = Conectar();

if(isset($_POST["agregar"]))	{
		$query="insert into clasificacion (clasificacion) values ('".$_POST["clasificacion"]."')";
		mysql_query($query, $link);
		$id=$_POST["id"];
	}
	else if(isset($_POST["guardar"]))	{
		$query="update clasificacion set clasificacion='".$_POST["clasificacion"]."' where idclasificacion='".$_POST["idclasificacion"]."'";
		mysql_query($query, $link);
		$id=$_POST["id"];
	}
	else if(isset($_POST["borrar"]))	{
		$query="delete from clasificacion where idclasificacion='".$_POST["idclasificacion"]."'";
		mysql_query($query, $link);
		$id=$_POST["id"];
	}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
<title>Edicion de Clasificaciones.</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="300" border="1">
  <tr>
    <td width="290" height="88" bgcolor="#0066FF" class="titulo"><p>Clasificaciones</p></td>
  </tr>
  <tr>
    <td><table width="374" border="0">
      <tr>
        <td width="390">Clasificación:</td>
      </tr>
      <tr>
        <td><span id="sprytextfield1">
        <form name="form1" id="form1" method="post" action="clasificaciones.php?id=<?php echo $id; ?>">
          <label>
            <input type="text" name="clasificacion" id="clasificacion" size="100"/>
          </label>
          <label>
            <input type="submit" name="agregar" id="agregar" value="Agregar" />
          </label>
        </form>
          <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
      </tr>
    </table><a href="factsform.php?id=<?php echo $id; ?>" target="_self">Regresar</a>
      <table width="608" border="0">
      <?php
	  	$query="select * from clasificacion order by clasificacion";
	  	$result = mysql_query($query, $link);

		while($row = mysql_fetch_array($result)) {
		?>
        <form name="formx<?php echo $row["idclasificacion"]; ?>" id="formx<?php echo $row["idclasificacion"]; ?>" action="clasificaciones.php" method="post">
        <tr>        
          <td width="500"><input type="text" name="clasificacion" id="clasificacion" size="100" value="<?php echo $row["clasificacion"]; ?>" />
          <input type="hidden" name="idclasificacion" value="<?php echo $row["idclasificacion"]; ?>" />
          <input type="hidden" name="id" value="<?php echo $id; ?>" /></td>
          <td width="84"><input type="submit" name="guardar" id="guardar" value="guardar" /><br />
          <input type="submit" name="borrar" id="borrar" value="borrar" /></td>
        </tr>
        </form>
        <?php
		}
		?>
    </table></td>
  </tr>
</table>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
//-->
</script>
</body>
</html>