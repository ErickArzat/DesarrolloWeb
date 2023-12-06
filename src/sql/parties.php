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
    $type = $data->type;
    $client = $data->cliente;
    $palette = $data->palette; 
    $cake = $data-> cake;
    $payment = $data-> payment; 
    $staff = $data ->staff;
    $date = $data -> date; 
    if(($cliente!= '')&&($payment!='')&&($date!='')){
        $sql = mysqli_query($conexionBD,"INSERT INTO parties(id_type, id_clnt, id_pal, id_cake, id_pay,date_party) VALUES('$type','$client','$palette','$cake','$payment','$date') ");
        echo json_encode(["success"=>1]);
    }
    exit();
}

//consulta todos los registros de la tabla parties
$sql = mysqli_query($conexionBD,"SELECT * FROM parties");
if(mysqli_num_rows($sql) > 0){
    $result = mysqli_fetch_all($sql,MYSQLI_ASSOC);
    echo json_encode($result);
}
else{ echo json_encode([["success"=>0]]); }
?>