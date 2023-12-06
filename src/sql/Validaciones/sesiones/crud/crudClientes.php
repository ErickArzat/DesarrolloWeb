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

function guardaCliente($conexionBD, $data) {
    $correo = prevenirInyeccionSQL($conexionBD, $data['email_clnt']);

    $sqlEmpleado = "SELECT * FROM clients WHERE email_clnt = '$correo'";
    $resultado = mysqli_query($conexionBD, $sqlEmpleado);
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        return array('result' => false,
                        'message'=> 'Correo ya registrado');
    } else {
        $nombre = prevenirInyeccionSQL($conexionBD, $data['name_clnt']);
        $apellido = prevenirInyeccionSQL($conexionBD, $data['last_name_clnt']);
        $usuario = prevenirInyeccionSQL($conexionBD, $data['user_clnt']);
        $contrasenia = prevenirInyeccionSQL($conexionBD, $data['pass_clnt']); 
        $sqlInsert = "INSERT INTO clients (name_clnt, last_name_clnt, user_clnt, pass_clnt,email_clnt) VALUES ('$nombre', '$apellido', '$usuario', '$contrasenia', '$correo')";

        $resultado = mysqli_query($conexionBD, $sqlInsert);
        if ($resultado) {
            return array('success' => true, 'message' => 'Usuario registrado correctamente');
        } else {
            return array('success' => false, 'message' => 'Error al registrar el usuario');
        }
    } 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $conexionBD = new mysqli($servidor, $usuario, $contrasenia, $nombreBaseDatos);
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['name_clnt']) & isset($data['last_name_clnt']) & isset($data['user_clnt']) & isset($data['pass_clnt']) & isset($data['email_clnt'])) {
        $usua = guardaCliente($conexionBD, $data);
        echo json_encode($usua);
    }else {
        echo json_encode(array('mensaje' => 'Solicitud no válida'));
    }
}

?>