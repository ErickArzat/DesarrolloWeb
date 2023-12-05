<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include("functions.php");
$conexionBD = connection();

// $conn=connection();
// $sql = "SELECT * FROM types_parties ORDER BY id_type ASC";
// $result = mysqli_query($conn, $sql);
// if (mysqli_num_rows($result) > 0) {
//     $data = array();
// 	while($row = mysqli_fetch_assoc($result)) {
//         $data[] = $row;
//     }
//     echo json_encode($data);
// } else {
//     echo "0 resultados";
// }
// $conn->close();

if(isset($_GET["insertar"])){
    $data = json_decode(file_get_contents("php://input"));
    $amount = $data->amount; 
    $status = $data->status;
    $date_pay = $data-> date_pay;
    if(($amount!= '')&&($status!='')&&($date_pay!='')){
        $sql = mysqli_query($conexionBD,"INSERT INTO payments(amount, status, date_pay) VALUES('$amount','$status','$date_pay') ");
        echo json_encode(["success"=>1]);
    }
    exit();
}

//consulta todos los registros de la tabla parties
$sql = mysqli_query($conexionBD,"SELECT * FROM payment");
if(mysqli_num_rows($sql) > 0){
    $result = mysqli_fetch_all($sql,MYSQLI_ASSOC);
    echo json_encode($result);
}
else{ echo json_encode([["success"=>0]]); }
?>