<?php
include("bd.php");
session_start();

if(isset($_SESSION['login']))	{
		
	$tabla=$_POST["tabla"];
	$id=$_POST["id"];
		
	$query="show fields from ".$tabla;
	$result=$bd->Execute($query);
	foreach($result as $row)	{
		$fields[] = $row["Field"];
	}
	
	
	$condition="";
	if(isset($_POST["condition"]))	{
		$condition=$_POST["condition"];
		$query="select * from ".$tabla." where ".$condition;
	}	else {
		$query="select * from ".$tabla." where  id".$tabla."='".$id."'";
	}
	
	$result=$bd->Execute($query);
	foreach($result as $row)	{
		for($i=0; $i<sizeof($fields); $i++)  {
			if($tabla=="usuarios" and $fields[$i]=="password")
				echo "setValue('password','".base64_decode($row[$fields[$i]])."');";
			else if($fields[$i]=="id".$tabla)
                echo "setValue('id','".$row[$fields[$i]]."');";
            else {
            	//$string = trim(preg_replace('/\s\s+/', "", nl2br(utf8_encode($row[$fields[$i]]))));
            	$string = trim(preg_replace( "/\r|\n/", "", $row[$fields[$i]]));
                echo "setValue('".$fields[$i]."','".$string."');";
			}
        }
	}	
}	
?>