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

header('Location: portlogpdf.php?id='.$id);

}

?>
<center><br><br><br>
<FORM ACTION="idportlog.php" METHOD="post">
	<table border='0'>
		<tr>
			<th colspan='3'>ID DEL BUQUE PARA PORT LOG<br><hr><br></th>
		</tr>
		<tr>
			<th align='right'>ID del buque</th>
			<td><input type='text' name='id' size='10' value='2212'></td>
			<td rowspan='2' align='center'><INPUT TYPE="submit" VALUE="Aceptar" NAME="aceptar"></td>
		</tr>
	</table>
</form>
</center>

</body>
</html>