<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include("functions.php");
$conexionBD = connection();

if (isset($_GET["consultar"])){
    $sql = mysqli_query($conexionBD,"SELECT * FROM decorations WHERE id_deco=".$_GET["consultar"]);
    if(mysqli_num_rows($sql) > 0){
        $result = mysqli_fetch_all($sql,MYSQLI_ASSOC);
        echo json_encode($result);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}
if (isset($_GET["consultar_multiples"]) && isset($_GET["arreglo_ids"])) {
    $ids = $_GET["arreglo_ids"]; 
    $ids_str = implode(",", $ids); 

    $sql = mysqli_query($conexionBD, "SELECT * FROM decorations WHERE id_deco IN ($ids_str)");

    if (mysqli_num_rows($sql) > 0) {
        $result = mysqli_fetch_all($sql, MYSQLI_ASSOC);
        echo json_encode($result);
        exit();
    } else {
        echo json_encode(["success" => 0]);
    }
}
if (isset($_GET["borrar"])){
    $sql = mysqli_query($conexionBD,"DELETE FROM decorations WHERE id_deco=".$_GET["borrar"]);
    if($sql){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); exit();}
    
}

if(isset($_GET["insertar"])){
    $data = json_decode(file_get_contents("php://input"));
    $name=$data->name;
    $img=$data->img;
    $price=$data->price;
    if(($name!="")&&($img!="")&&($price!="")){ 
        $sql = mysqli_query($conexionBD,"INSERT INTO decorations(name_deco, img_deco, price_deco) VALUES('$name','$img','$price') ");
        echo json_encode(["success"=>1]);
    }
    exit();
}

if(isset($_GET["actualizar"])){
    $data = json_decode(file_get_contents("php://input"));

    foreach ($data as $deco) {
        $id = $deco->id_deco;
        $nombre = $deco->name_deco;
        $precio = $deco->price_deco;

        $sql = "UPDATE decorations SET name_deco='$nombre', price_deco='$precio' WHERE id_deco='$id'";
        $result = mysqli_query($conexionBD, $sql);

        if (!$result) {
            echo json_encode(["success" => 0, "message" => "Error al actualizar las decoraciones"]);
            exit();
        }
    }

    echo json_encode(["success" => 1, "message" => "Decoraciones actualizados correctamente"]);
    exit();
}

$sql = mysqli_query($conexionBD,"SELECT * FROM decorations");
if(mysqli_num_rows($sql) > 0){
    $result = mysqli_fetch_all($sql,MYSQLI_ASSOC);
    echo json_encode($result);
}
else{ echo json_encode([["success"=>0]]); }


?>
