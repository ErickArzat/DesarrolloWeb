<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include("functions.php");
$conexionBD = connection();

if (isset($_GET["name"])){
    $sql = mysqli_query($conexionBD,"SELECT extras.name_extra FROM extra_party JOIN extras ON extras.id_extra=".$_GET["name"]);
    if(mysqli_num_rows($sql) > 0){
        $row = mysqli_fetch_row($sql);
        $result = $row[0];
        echo $result;
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

if (isset($_GET["delete"])){
    $sql = mysqli_query($conexionBD,"DELETE FROM extra_party WHERE id_extra=".$_GET["delete"]);
    if($sql){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); exit();}
    
}


if(isset($_GET["insertar"])){
    $data = json_decode(file_get_contents("php://input"));
    $party=$data->party;
    $extra=$data->extra;
    if(($party!="")&&($extra!="")){ 
        $sql = mysqli_query($conexionBD,"INSERT INTO extra_party(id_party, id_extra) VALUES('$party','$extra') ");
        echo json_encode(["success"=>1]);
    }
    exit();
}
if(isset($_GET["insertar_multiples"])){
    $data = json_decode(file_get_contents("php://input"));
    $party = $data->party;
    $extras = $data->extras; 

    if (!empty($party) && !empty($extras)) {
        foreach ($extras as $extra) {
            
            $sql = mysqli_prepare($conexionBD, "INSERT INTO extra_party(id_party, id_extra) VALUES (?, ?)");

            mysqli_stmt_bind_param($sql, "ii", $party, $extra);

            mysqli_stmt_execute($sql);

            mysqli_stmt_close($sql);
        }
        
        echo json_encode(["success" => 1]);
    } else {
        echo json_encode(["success" => 0, "message" => "Falta información"]);
    }
    exit();
}
$sql = mysqli_query($conexionBD,"SELECT * FROM extra_party");
if(mysqli_num_rows($sql) > 0){
    $result = mysqli_fetch_all($sql,MYSQLI_ASSOC);
    echo json_encode($result);
}
else{ echo json_encode([["success"=>0]]); }


?>
