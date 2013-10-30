<html>
<head>
<title>Pide datos</title>
</head>
<body  onload="document.getElementById('id').focus();">

<?php

$aceptar = $_REQUEST['aceptar'];
$id = $_REQUEST['id'];
$dias = $_REQUEST['dias'];

if(isset($aceptar)){

header('Location: formato2.php?id='.$id.'&dias='.$dias.'');

}

?>
<center><br><br><br>
<FORM ACTION="formato.php" METHOD="post">
	<table border='0'>
		<tr>
			<th colspan='3'>DATOS PARA LOS REPORTES</th>
		</tr>
		<tr>
			<th align='right'>ID del buque</th>
			<td><input tabindex='1' type='text' name='id' size='10' value='<?php echo $id; ?>'></td>
			<td rowspan='2' align='center'><INPUT tabindex='3' TYPE="submit" VALUE="Aceptar" NAME="aceptar"></td>
		</tr>
		<tr>
			<th align='right'>Con fecha de: </th>
			<td><select tabindex='2' name="dias">
            <option value="0">Hoy</option>
            <option value="1">Ma&ntilde;ana</option>
            <option value="2">Pasado ma&ntilde;ana</option>
            <option value="-1">Ayer</option>
          </select> 
		</tr>

	</table>
</form>
</center>

</body>
</html>