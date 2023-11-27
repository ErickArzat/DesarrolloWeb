<?php

include("funciones.php");
$con=connection();
if($con){
	$sql = "select * from parties";
	$query = $con->query($sql);
	$data = array();
	while($reply = $query->fetch_assoc()){
		$data[] = $reply;
	}
	echo json_encode(array("partytion"=>$data));
}
?>