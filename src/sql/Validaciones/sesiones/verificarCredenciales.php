<?php

require '../vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once("../variables.php");
require_once("../funciones.php");

function validarStaff($conexionBD, $data, $key) {
    $usuario = prevenirInyeccionSQL($conexionBD, $data['user_staff']);
    $contrasenia = prevenirInyeccionSQL($conexionBD, $data['pass_staff']); 

    $sqlEmpleado = "SELECT * FROM staff WHERE user_staff = '$usuario' AND pass_staff = '$contrasenia'";
    $resultado = mysqli_query($conexionBD, $sqlEmpleado);
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $token = generarToken($usuario, $contrasenia, $key);
        return array
            ('result' => true,
            'message'=> 'Bienvenido', 
            'token' => $token
        );
        ;
    }else {
        return array('success' => false);
    }
}

function decodificarToken($token, $conexionBD, $key) {
    

    try {
        $decoded = JWT::decode($token, new Key($key, 'HS256'));
        if($decoded->exp > 0){
            $usuario = $decoded->usuario; 

            $sqlEmpleado = "SELECT * FROM staff WHERE user_staff = '$usuario' AND is_admin = '1'";
            $resultado = mysqli_query($conexionBD, $sqlEmpleado);
            if ($resultado && mysqli_num_rows($resultado) > 0) {
                return array('access' => true);
            } else {
                return array('access' => false);
            }
        }else{
            return array('access' => false);
        }   
    } catch (Exception $e) {
        return null;
    }
}

function validarUsuario($conexionBD, $data, $key) {
    $usuario = prevenirInyeccionSQL($conexionBD, $data['user_clnt']);
    $contrasenia = prevenirInyeccionSQL($conexionBD, $data['pass_clnt']); 

    $sqlEmpleado = "SELECT * FROM clients WHERE user_clnt = '$usuario' AND pass_clnt = '$contrasenia'";
    $resultado = mysqli_query($conexionBD, $sqlEmpleado);
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $token = generarToken($usuario, $contrasenia, $key);
        return array
            ('result' => true,
            'message'=> 'Bienvenido', 
            'token' => $token
        );
    }else {       
        return validarStaff($conexionBD,  array('user_staff' => $usuario, 'pass_staff' => $contrasenia), $key);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $conexionBD = new mysqli($servidor, $usuario, $contrasenia, $nombreBaseDatos);
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['user_staff']) && isset($data['pass_staff'])) {
        $tokenGenerado = validarStaff($conexionB, $data, $key);
        echo json_encode(array('token' => $tokenGenerado));
    } elseif (isset($data['token'])) {
        $datosDecodificados = decodificarToken($data['token'], $conexionBD, $key);
        echo json_encode($datosDecodificados);
    }elseif(isset($data['user_clnt']) & isset($data['pass_clnt'])){
        $tokenGenerado = validarUsuario($conexionBD, $data, $key);
        echo json_encode($tokenGenerado);
    }else {
        echo json_encode(array('mensaje' => 'Solicitud no válida'));
    }
}
?>