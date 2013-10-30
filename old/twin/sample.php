<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN"> 
<html> 
<head> 
    <title>Mándanos tus comentarios</title> 
</head> 

<body bgcolor="#cccc66" text="#003300" link="#006060" vlink="#006060"> 
<?php
$to='daka2712@gmail.com';
$from='daka2712@gmail.com';
function mail_utf8($to, $subject = '(No subject)', $message = '', $from) { 
  $header = 'MIME-Version: 1.0' . "\n" . 'Content-type: text/plain; charset=UTF-8' 
    . "\n" . 'From: Yourname <' . $from . ">\n"; 
  mail($to, '=?UTF-8?B?'.base64_encode($subject).'?=', $message, $header); 
} 

if (!$HTTP_POST_VARS){ 
?> 
<form action="sample.php" method=post> 
Nombre: <input type=text name="nombre" size=16> 
<br> 
Email: <input type=text name=email size=16> 
<br> 
Comentarios: <textarea name=coment cols=32 rows=6></textarea> 
<br> 
<input type=submit value="Enviar"> 
</form> 
<?php
}else{ 
    //Estoy recibiendo el formulario, compongo el cuerpo 
    $cuerpo = "Formulario enviado\n"; 
    $cuerpo .= "Nombre: " . $HTTP_POST_VARS["nombre"] . "\n"; 
    $cuerpo .= "Email: " . $HTTP_POST_VARS["email"] . "\n"; 
    $cuerpo .= "Comentarios: " . $HTTP_POST_VARS["coment"] . "\n"; 

    //mando el correo... 
    mail("admin@tudominio.com","Formulario recibido",$cuerpo); 

    //doy las gracias por el envío 
    echo "Gracias por rellenar el formulario. Se ha enviado correctamente."; 
}
mail_utf8($to, $subject = '(No subject)', $message = '', $from);
?> 
</body> 
</html> 