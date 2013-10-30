<?php
include("conexion.php");

$action=$_POST["action"];
if(!isset($_POST["action"]))	{
	$action=$_GET["action"];
}

function insert($table, $fields, $args)	{
	$link = Conectar();
	$query="insert into $table ($fields) values ($args)";
	mysql_query($query, $link);
	mysql_close($link);
	?>
	<script>	
	top.formFrame.location.reload()
	</script>
	<?php
	return 0;
}

function delete($table, $field, $args)	{
	$link = Conectar();
	$query="delete from $table where $field='$args'";
	mysql_query($query, $link);
	mysql_close($link);
	?>
	<script>	
	top.listaFrame.location.reload()
	</script>
	<?php
	return 0;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles.css" rel="stylesheet" type="text/css" />
<title>Actions</title>
</head>
<body class="texto">
<?php

if($action=="agergarAgencia")	{
	insert("agenciasaduanales", "agencia", "'".$_POST["agencia"]."'");
	?>
    Agencia Agregada:"<?php echo $_POST["agencia"];?>"
    <?php
}
else if($action=="agergarRecibidor")	{
	insert("recibidores", "recibidor", "'".$_POST["recibidor"]."'");
	?>        
    Recibidor Agregado:"<?php echo $_POST["recibidor"];?>"    
    <?php
}
else if($action=="agregarEstibador")	{
	insert("estibadores", "estibador", "'".$_POST["estibador"]."'");
	?>        
    Estibador Agregado:"<?php echo $_POST["estibador"];?>"    
    <?php
}
else if($action=="delete")	{
	delete($_GET["table"], $_GET["field"], $_GET["value"]);
	?>
    Registro Eliminado   
    <?php
}
else	{
	?>
	Ready
    <?php
	}
	?>

</body>
</html>