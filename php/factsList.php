<?php
include("bd.php");
$q = strtolower($_GET["term"]);

$query="select distinct fact from computotiempo where fact like '$q%'";

$result=$bd->Execute($query);
$return = array();


foreach($result as $row)	{
    array_push($return,array('label'=>$row['fact'],'value'=>$row['fact']));
}
echo(json_encode($return));
?>

