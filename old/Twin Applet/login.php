<?php
include("conexion.php");
include("sesionestar.php");
session_start(); 
$Username = $_POST['Username'];
$_SESSION['Usersession'] = $Username;
$Password= $_POST['Password'];
$_SESSION['Pass']=$Password;

if (isset($_POST['Username']) && isset($_POST['Password']) && $_POST['Password']!="" &&$_POST['Username']!="")
 {
     
     $link= Conectar();
	$query = "select * from usuarios where User = '" .$Username."' and password='".$Password."' ";
	  $result= mysql_query($query,$link);
	
	while($row = mysql_fetch_array($result))
	{
	$User=$row["user"];
	$Pass=$row["password"];
    $tip=$row["tipo"];
	}
	
	if ( $_POST['Username'] == $User && $_POST['Password']== $Pass)
     {
		 switch ($tip)
		 {
			 case "ADMINISTRADOR":
		     session_start();
		     $_SESSION[access]=true;
 		     header("Location: Adminnew.php");
		     break;
			 
			 case "CAPTURISTA":
		     session_start();
		     $_SESSION[accessE]=true;
 		     header("Location: encargado.php");
		     break;
			 
			 case "PUERTO":
		     session_start();
		     $_SESSION[accessP]=true;
 		     header("Location: puertos.php");
		     break;
			 
			 default:
            echo "Access Denied... ";
		 }
      
	}
    else{
       echo "Usuario Invalido o  Contraseña Incorrecta, intente Nuevamente  $Username";
        }
 }
else
{
if (isset($_POST['Username']))
 {
 echo "Rellena los campos";
?>
<form action="Index.php">
<input TYPE="submit" NAME="Back" VALUE="Back" /></form>
<?php
}
}
?>
</body>
</html>
