<?php
include("bd.php");
session_start();

if(isset($_SESSION['login']))	{
		
	$tabla=$_POST["table"];
	$id=$_POST["id"];
	
	$query="show fields from ".$tabla;
	$result=$bd->Execute($query);
	foreach($result as $row)	{
		if(isset($_POST[$row["Field"]]))	{
			$fields[] = $row["Field"];
			
			if($tabla=="usuarios" and $row["Field"]=="password")
				$values[] = base64_encode($_POST[$row["Field"]]);
			else if($row["Field"]=="id".$tabla)
				$values[] = $_POST["id"];	
			else
				$values[] = $_POST[$row["Field"]];
		}
	}
	
		
	if($id>0)	{
		$condition="id".$tabla."='".$id."'";		
		$bd->UpdateArray($tabla,$fields,$values,$condition);		
		echo $id;
	}	else {
		$id=$bd->InsertArray($tabla,$fields,$values);
		echo $id;
	}	
}
?>