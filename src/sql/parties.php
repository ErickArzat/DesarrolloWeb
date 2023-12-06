<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include("functions.php");
$conexionBD = connection();

if (isset($_GET["nameTP"])){
    $sql = mysqli_query($conexionBD,
        "SELECT types_parties.name_type FROM parties JOIN types_parties ON types_parties.id_type=".$_GET["nameTP"]);
    if(mysqli_num_rows($sql) > 0){
        $row = mysqli_fetch_row($sql);
        $result = $row[0];
        echo $result;
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

if (isset($_GET["nameCP"])){
    $sql = mysqli_query($conexionBD, 
        "SELECT clients.name_clnt, clients.last_name_clnt FROM parties JOIN clients ON clients.id_clnt=".$_GET["nameCP"]);
    
    if(mysqli_num_rows($sql) > 0){
        $row = mysqli_fetch_row($sql);
        $result = $row[0] . " " . $row[1];
        echo $result;
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

if (isset($_GET["nameSP"])){
    $sql = mysqli_query($conexionBD,
        "SELECT staff.name_staff FROM parties JOIN staff ON staff.id_staff=".$_GET["nameSP"]);
    if(mysqli_num_rows($sql) > 0){
        $row = mysqli_fetch_row($sql);
        $result = $row[0];
        echo $result;
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

if (isset($_GET["nameCake"])){
    $sql = mysqli_query($conexionBD,
        "SELECT cakes.name_cake FROM parties JOIN cakes  ON cakes.id_cake=".$_GET["nameCake"]);
    if(mysqli_num_rows($sql) > 0){
        $row = mysqli_fetch_row($sql);
        $result = $row[0];
        echo $result;
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

if (isset($_GET["total"])){
    $sql = mysqli_query($conexionBD,
        "SELECT payments.amount FROM parties JOIN payments ON payments.id_pay=".$_GET["total"]);
    if(mysqli_num_rows($sql) > 0){
        $row = mysqli_fetch_row($sql);
        $result = $row[0];
        echo $result;
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

if(isset($_GET["insert"])){
    $data = json_decode(file_get_contents("php://input"));
    $type = $data->type;
    $client = $data->client;
    $palette = $data->palette; 
    $cake = $data-> cake;
    $payment = $data-> payment; 
    $staff = $data ->staff;
    $date = $data -> date; 
    if(($client!= '')&&($payment!='')&&($date!='')){
        $sql = mysqli_query($conexionBD,"INSERT INTO parties(id_type, id_clnt, id_pal, id_cake, id_pay,id_staff,date_party) VALUES('$type','$client','$palette','$cake','$payment','$staff','$date') ");
        if($sql){
            $lastInsertedId = mysqli_insert_id($conexionBD);
            echo json_encode(["success" => 1, "id_party" => $lastInsertedId]);
        } else {
            echo json_encode(["success" => 0, "error" => "Error al insertar en la base de datos: " . mysqli_error($conexionBD)]);
        }
    } else {
        echo json_encode(["success" => 0, "error" => "Faltan datos"]);
    }
    exit();
}

if(isset($_GET["insertDeco"])){
    $data = json_decode(file_get_contents("php://input"));
    $id=$data->id;
    $deco=$data->deco;
    $sql = mysqli_query($conexionBD,"INSERT INTO deco_party(id_party, id_deco) VALUES('$id','$deco') ");
    echo json_encode(["success"=>1]);
    exit();
}

if(isset($_GET["insertExtra"])){
    $data = json_decode(file_get_contents("php://input"));
    $id=$data->id;
    $extra=$data->extra;
    $sql = mysqli_query($conexionBD,"INSERT INTO extra_party(id_party, id_extra) VALUES('$id','$extra') ");
    echo json_encode(["success"=>1]);
    exit();
}

if(isset($_GET["update"])){
    
    $data = json_decode(file_get_contents("php://input"));

    $id=(isset($data->id))?$data->id:$_GET["update"];
    $type=$data->type;
    $clnt=$data->clnt;
    $pal=$data->pal;
    $cake=$data->cake;
    $pay=$data->pay;
    $staff=$data->staff;
    
    $sql = mysqli_query($conexionBD,"UPDATE parties SET id_type='$type',id_clnt='$clnt',id_pal='$pal',id_cake='$cake',id_pay='$pay',id_staff='$staff' WHERE id_party='$id'");
    echo json_encode(["success"=>1]);
    exit();
}

if(isset($_GET["updateDecos"])){
    
    $data = json_decode(file_get_contents("php://input"));

    $id=(isset($data->id))?$data->id:$_GET["update"];
    $deco=$data->deco;
    
    $sql = mysqli_query($conexionBD,"UPDATE deco_party SET id_deco='$deco' WHERE id_party='$id'");
    echo json_encode(["success"=>1]);
    exit();
}

if (isset($_GET["delete"])){
    $sql = mysqli_query($conexionBD,"DELETE FROM parties WHERE id_party=".$_GET["delete"]);
    if($sql){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); exit();}
    
}

//consulta todos los registros de la tabla parties
$sql = mysqli_query($conexionBD,"SELECT * FROM parties");
if(mysqli_num_rows($sql) > 0){
    $result = mysqli_fetch_all($sql,MYSQLI_ASSOC);
    echo json_encode($result);
}
else{ echo json_encode([["success"=>0]]); }
?>