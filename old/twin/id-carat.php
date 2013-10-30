<html>
<head>
<title>Pide datos</title>
</head>
<body  onload="document.getElementById('id').focus();">

<?php

$aceptar = $_REQUEST['aceptar'];
$id = $_REQUEST['id'];

if(isset($aceptar)){

header('Location: carat-files.php?id='.$id.'');

}

?>
<center><br><br><br>
<FORM ACTION="id-carat.php?id=<?php echo $id ?>" METHOD="post">
	<table border='0'>
		<tr>
			<th colspan='2'>ID DEL FILE A IMPRIMIR<br><hr><br></th>
		</tr>
		<tr>
			<th align='right'>ID del buque</th>
			<td><input type='text' name='id' size='10' value='<?php echo $id ?>'>
			<br><INPUT TYPE="submit" VALUE="Aceptar" NAME="aceptar"></td>
		</tr>
	</table>
</form>
</center>

</body>
</html>