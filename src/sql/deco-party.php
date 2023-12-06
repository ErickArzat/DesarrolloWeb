<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include("functions.php");
$conexionBD = connection();

if (isset($_GET["consultar"])){
    $sql = mysqli_query($conexionBD,"SELECT * FROM deco_party WHERE id_party=".$_GET["consultar"]);
    if(mysqli_num_rows($sql) > 0){
        $result = mysqli_fetch_all($sql,MYSQLI_ASSOC);
        echo json_encode($result);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}


if(isset($_GET["insertar"])){
    $data = json_decode(file_get_contents("php://input"));
    $party=$data->party;
    $decos=$data->deco;
    if(($party!="")&&($deco!="")){ 
        foreach ($decos as $deco) {
            $sql = mysqli_query($conexionBD, "INSERT INTO deco_party(id_party, id_deco) VALUES ('$party', '$deco')");
            if(!$sql){
                echo json_encode(["success" => 0, "error" => "Error al insertar en la base de datos: " . mysqli_error($conexionBD)]);
                exit();
            }
        }
        echo json_encode(["success" => 1]);
    } else {
        echo json_encode(["success" => 0, "error" => "Faltan datos"]);
    }
    exit();
}

$sql = mysqli_query($conexionBD,"SELECT * FROM deco_party");
if(mysqli_num_rows($sql) > 0){
    $result = mysqli_fetch_all($sql,MYSQLI_ASSOC);
    echo json_encode($result);
}
else{ echo json_encode([["success"=>0]]); }


?>
