<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include("functions.php");
$conexionBD = connection();

// Consulta datos y recepciona una clave para consultar dichos datos con dicha clave
if (isset($_GET["consultar"])){
    $sql = mysqli_query($conexionBD,"SELECT * FROM palettes WHERE id_pal=".$_GET["consultar"]);
    if(mysqli_num_rows($sql) > 0){
        $result = mysqli_fetch_all($sql,MYSQLI_ASSOC);
        echo json_encode($result);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}
//borrar pero se le debe de enviar una clave ( para borrado )
if (isset($_GET["borrar"])){
    $sql = mysqli_query($conexionBD,"DELETE FROM palettes WHERE id_pal=".$_GET["borrar"]);
    if($sql){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

if(isset($_GET["insertar"])){
    $data = json_decode(file_get_contents("php://input"));
    $name=$data->name;
    $img=$data->img;
    $price=$data->price;
    if(($name!="")&&($img!="")&&($price!="")){ 
        $sql = mysqli_query($conexionBD,"INSERT INTO palettes(name_pal, img_pal, price_pal) VALUES('$name','$img','$price') ");
        echo json_encode(["success"=>1]);
    }
    exit();
}
// Consulta todos los registros de la tabla empleados
$sql = mysqli_query($conexionBD,"SELECT * FROM palettes");
if(mysqli_num_rows($sql) > 0){
    $result = mysqli_fetch_all($sql,MYSQLI_ASSOC);
    echo json_encode($result);
}
else{ echo json_encode([["success"=>0]]); }


?>	
