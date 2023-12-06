<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include("functions.php");
$conexionBD = connection();

if (isset($_GET["consultar"])) {
    // Obtener el arreglo de IDs de extras
    $ids = $_GET["consultar"];
    
    // Convertir el arreglo a una cadena separada por comas para usarlo en la consulta SQL
    $ids_str = implode(',', $ids);
    
    // Preparar la consulta usando IN para buscar múltiples IDs
    $sql = "SELECT * FROM extras WHERE id_extra IN ($ids_str)";
    
    $resultado = mysqli_query($conexionBD, $sql);

    if ($resultado) {
        if(mysqli_num_rows($resultado) > 0){
            $result = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
            echo json_encode($result);
            exit();
        } else {
            echo json_encode(["success" => 0]);
        }
    } else {
        echo json_encode(["success" => 0, "error" => mysqli_error($conexionBD)]);
    }
}


if (isset($_GET["borrar"])){
    $sql = mysqli_query($conexionBD,"DELETE FROM extras WHERE id_extra=".$_GET["borrar"]);
    if($sql){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); exit();}
    
}

if(isset($_GET["insertar"])){
    $data = json_decode(file_get_contents("php://input"));
    
    $name=$data->name;
    $price=$data->price;

    if(($name!=" ")&&($price!=" ")){ 
        $sql = mysqli_query($conexionBD,"INSERT INTO extras(name_extra, price_extra) VALUES('$name','$price')");
        echo json_encode(["success"=>1]);
        exit();
    }
    echo json_encode(["success"=>0]);
    exit();
}

if(isset($_GET["actualizar"])){
    $data = json_decode(file_get_contents("php://input"));
    $id = $data->id;
    $name=$data->name;
    $price=$data->price;
    $sqlUpdate = "UPDATE extras SET name_extra='$name', price_extra='$price' WHERE id_extra='$id'";
    $sql = mysqli_query($conexionBD,$sqlUpdate);
    echo json_encode(["success"=>1]);
    exit();
}

$sql = mysqli_query($conexionBD,"SELECT * FROM extras");
if(mysqli_num_rows($sql) > 0){
    $result = mysqli_fetch_all($sql,MYSQLI_ASSOC);
    echo json_encode($result);
}
else{ echo json_encode([["success"=>0]]); }


?>
