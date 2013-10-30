<?php
include("bd.php");
$q = strtolower($_GET["term"]);

$query="select vessel from barcos where vessel like '$q%'";

$result=$bd->Execute($query);
$return = array();


foreach($result as $row)	{
    array_push($return,array('label'=>$row['vessel'],'value'=>$row['vessel']));
}
echo(json_encode($return));
?>

