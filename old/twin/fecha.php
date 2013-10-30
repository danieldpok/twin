<html>
<head>
<title>fecha</title>
</head>
<body>
<?php

echo "la fecha de hoy es: ".date('d/m/Y')."<br>";
$fecha = date("d-m-Y", mktime(0, 0, 0, date('m'), date('d')+1,date('Y')));

echo "la fecha de mañana es: ".$fecha;

echo "<br>";

print_r(getdate());

echo "<br>";


echo date("d-m-Y", mktime(0, 0, 0, date('m'), date('d')+1,date('Y')));
echo "<br>";
echo gmdate("d-m-Y", mktime(0, 0, 0, date('m'), date('d'),date('Y')));


?> 
</body>
</html>