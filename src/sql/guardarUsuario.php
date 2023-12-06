<?php

require './vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access, Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Methods: GET, POST");
header("Content-Type: application/json; charset=UTF-8");

include("functions.php");
$conexionBD = connection();

if (isset($_GET["guardar"])) {
    $data = json_decode(file_get_contents("php://input"));
    $email = prevenirInyeccionSQL($conexionBD, $data->email);
    $sql = mysqli_query($conexionBD, "SELECT * FROM clients WHERE email_clnt = '$email'");
    if (mysqli_num_rows($sql) > 0) {
        echo json_encode(["success" => 0, "message" => "Correo ya registrado"]);
    } else {
        $name = prevenirInyeccionSQL($conexionBD, $data->name);
        $lastname = prevenirInyeccionSQL($conexionBD, $data->lastname);
        $user = prevenirInyeccionSQL($conexionBD, $data->user);
        $pass = prevenirInyeccionSQL($conexionBD, $data->pass);
        if ($name != "" && $lastname != "" && $email != "" && $user != "" && $pass != "") {
            $sql = mysqli_query($conexionBD, "INSERT INTO clients(name_clnt, last_name_clnt, user_clnt, pass_clnt, email_clnt) VALUES('$name', '$lastname', '$user', '$pass', '$email')");
            echo json_encode(["success" => 1, "message" => "Usuario registrado correctamente"]);
        } else {
            echo json_encode(["success" => 0, "message" => "Error al registrar"]);
        }
        exit();
    }
}

/*if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $conexionBD = connection();
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['name_clnt']) & isset($data['last_name_clnt']) & isset($data['user_clnt']) & isset($data['pass_clnt']) & isset($data['email_clnt'])) {
        $usua = guardaCliente($conexionBD, $data);
        echo json_encode($usua);
    }else {
        echo json_encode(array('mensaje' => 'Solicitud no válida'));
    }
}*/