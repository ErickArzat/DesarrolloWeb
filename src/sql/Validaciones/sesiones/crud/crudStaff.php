<?php
require '../vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include("../variables.php");
include("../funciones.php");
function guardaStaff($conexionBD, $data) {
    $correo = prevenirInyeccionSQL($conexionBD, $data['email_staff']);

    $sqlEmpleado = "SELECT * FROM staff WHERE email_staff = '$correo'";
    $resultado = mysqli_query($conexionBD, $sqlEmpleado);
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        return array('result' => false,
                        'message'=> 'Correo ya registrado');
    } else {
        $nombre = prevenirInyeccionSQL($conexionBD, $data['name_staff']);
        $apellido = prevenirInyeccionSQL($conexionBD, $data['last_name_staff']);
        $usuario = prevenirInyeccionSQL($conexionBD, $data['user_staff']);
        $contrasenia = prevenirInyeccionSQL($conexionBD, $data['pass_staff']); 
        $sqlInsert = "INSERT INTO staff (name_staff, last_name_staff, user_staff, pass_staff, email_staff) VALUES ('$nombre', '$apellido', '$usuario', '$contrasenia', '$correo')";

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

    if (isset($data['name_staff']) & isset($data['last_name_staff']) & isset($data['user_staff']) & isset($data['pass_staff']) & isset($data['email_staff']) & isset($data['is_admin'])) {
        $usuario = guardaStaff($conexionBD, $data);
        echo json_encode($usuario);
    }else {
        echo json_encode(array('mensaje' => 'Solicitud no válida'));
    }
}

?>