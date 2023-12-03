<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include("functions.php");
$conn=connection();
$sql = "SELECT * FROM types_parties ORDER BY id_type ASC";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $data = array();
	while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo "0 resultados";
}
$conn->close();
?>