<?php session_start();	if(isset($_SESSION['login']))	{	?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

		<title>TMM Nav_b2p0</title>
		<meta name="description" content="" />
		<meta name="author" content="Daniel Kennedy" />

		<!--<meta name="viewport" content="width=device-width; initial-scale=1.0" />-->

		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="/favicon.ico" />
		<link rel="apple-touch-icon" href="/apple-touch-icon.png" />
		<link rel="stylesheet" type="text/css" href="css/menu.css">
		<link rel="stylesheet" type="text/css" href="css/forms.css">
		<link rel="stylesheet" type="text/css" href="css/principal.css">
		<link rel="stylesheet" type="text/css" href="css/table.css">
		
		<!-- JQuery -->
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		
		<!-- JQuery UI -->
		<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
		<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<script type="text/javascript" src="js/jquery.maskedinput.js"></script>
		
		<script type="text/javascript" src="js/menu.js"></script>
		<script type="text/javascript" src="js/forms.js"></script>
		<script type="text/javascript" src="js/table.js"></script>
		<script type="text/javascript" src="js/sonic.js"></script>
		<script type="text/javascript" src="js/principal.js"></script>
		<script type="text/javascript" src="js/twin.js"></script>
	</head>

	<body>
		<div>
			<header>
				<img src="images/logo.png" />
			</header>
			<div id='cssmenu'>
				<ul>
				   <li class='has-sub'><a href='#'><span>Admin</span></a>
				      <ul>
				         <!--<li><a id="forms/usuarios.html" href='#'><span>Usuarios</span></a></li>-->
				         <li><a id="reports/usuarios.html" href='#'><span>Usuarios</span></a></li>
				         <!--<li class='last'><a href='#'><span>BD</span></a></li>-->
				      </ul>
				   </li>
				   <li class="has-sub"><a><span>Registros</span></a>
				   		<ul>
						   	<li><a id="reports/barcos.html"><span>Barcos</span></a></li>
						   	<li><a id="reports/operaciones.html"><span>Operaciones</span></a></li>
						   	<li><a id="forms/estadoHechos.html"><span>Estado de Hechos</span></a></li>
						   	<li><a id="forms/computoTiempo.html"><span>Computo de Tiempo</span></a></li>
						   	<li><a id="forms/estadoHechos.html"><span>Descargas</span></a></li>
					   	</ul>
				   </li>
				   <li class="has-sub"><a><span>Supervision</span></a>
				   		<ul>
						   	<li><a id="forms/supervision.html"><span>Registro de Movimientos</span></a></li>
						   	<li><a id="reports/operaciones.html"><span>Reporte de Operaciones</span></a></li>
					   	</ul>
				   </li>
				   <li>
				   		<ul>
				   			<li><a></a></li>
				   		</ul>
				   </li>
				   <li class='last'><a href=''><span>Salir</span></a></li>
				</ul>
			</div>
			
			<nav>
				<div id="mainContent"></div>				
			</nav>

			<!--<div>

			</div>

			<footer>
				<p>
					&copy; Copyright  by Devant
				</p>
			</footer>-->
		</div>		
		<div id="mask" ></div>
		<div id="loading"><p>Cargando ...</p><div id="in"></div></div>
		<script type="text/javascript">makeLinks()</script>
	</body>
</html>
<?php	}
else {
	echo '<script>this.location="login/"</script>';
}	?>