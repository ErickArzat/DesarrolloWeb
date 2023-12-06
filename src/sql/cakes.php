<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include("functions.php");
$conexionBD = connection();

if (isset($_GET["consultar"])){
    $sql = mysqli_query($conexionBD,"SELECT * FROM cakes WHERE id_cake=".$_GET["consultar"]);
    if(mysqli_num_rows($sql) > 0){
        $result = mysqli_fetch_all($sql,MYSQLI_ASSOC);
        echo json_encode($result);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

if (isset($_GET["borrar"])){
    $sql = mysqli_query($conexionBD,"DELETE FROM cakes WHERE id_cake=".$_GET["borrar"]);
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
    if(($name!=" ")&&($img!=" ")&&($price!=" ")){ 
        $sql = mysqli_query($conexionBD,"INSERT INTO cakes(name_cake, img_cake, price_cake) VALUES('$name','$img','$price') ");
        echo json_encode(["success"=>1]);
    }
    exit();
}

if(isset($_GET["actualizar"])){
    $data = json_decode(file_get_contents("php://input"));
    
    $id = $data->id;
    $name=$data->name;
    $price=$data->price;
    $sqlUpdate = "UPDATE cakes SET name_cake='$name', price_cake='$price' WHERE id_cake='$id'";
    $result = mysqli_query($conexionBD, $sqlUpdate);
    if (!$result) {
        echo json_encode(["success" => 0, "message" => "Error al actualizar"]);
        exit();
    }
    echo json_encode(["success" => 1, "message" => "Datos actualizados correctamente"]);
    exit();
}

$sql = mysqli_query($conexionBD,"SELECT * FROM cakes");
if(mysqli_num_rows($sql) > 0){
    $result = mysqli_fetch_all($sql,MYSQLI_ASSOC);
    echo json_encode($result);
}
else{ echo json_encode([["success"=>0]]); }
?>
