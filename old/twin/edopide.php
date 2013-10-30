<html>
<head>
<title>Pide datos Edo Online</title>
</head>

<body  onload="document.getElementById('id').focus();">

<?php

$aceptar = $_REQUEST['aceptar'];
$id = $_REQUEST['id'];

if(isset($aceptar)){

header('Location: factsform.php?id='.$id.'');

}

?>
<center><br><br><br>
<FORM ACTION="edopide.php" METHOD="post">
	<table border='0'>
		<tr>
			<th colspan='2'>Estado de Hechos</th>
		</tr>
		<tr>
			<th align='right'>ID del buque</th>
			<td><input type='text' name='id' size='10' value='<?php echo $id; ?>'></td>
			<td rowspan='2' align='center'><INPUT TYPE="submit" VALUE="Aceptar" NAME="aceptar"></td>
		</tr>
		</tr>

	</table>
</form>
</center>

</body>
</html>