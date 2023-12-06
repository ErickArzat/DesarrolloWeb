<?php
require 'Validaciones/vendor/autoload.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include("functions.php");
$conexionBD = connection();
$key = "tu_clave_secreta_para_generar_token";

if (isset($_GET["login"])) {
    
    $data = json_decode(file_get_contents("php://input"));
    
    $username = $data->username;
    $password = $data->password;

    $finalUsername = $username;
    $finalPassword = $password;
    
    $sqlLogin = mysqli_query($conexionBD, "SELECT * FROM staff WHERE user_staff = '$finalUsername' AND pass_staff = '$finalPassword'");
    
    if (mysqli_num_rows($sqlLogin) > 0) {
        
        $userData = mysqli_fetch_assoc($sqlLogin);
        
        $token = generarToken($userData['user_staff'], $key);
        
        echo json_encode(["success" => 1, "userType" => "admin", "token" => $token]);
        exit();
    } else {
        // Si no se encuentra en empleados, busca en clientes
        $sqlLoginCliente = mysqli_query($conexionBD, "SELECT * FROM clients WHERE user_clnt = '$username' AND pass_clnt = '$password'");
        if (mysqli_num_rows($sqlLoginCliente) > 0) {
            $clientData = mysqli_fetch_assoc($sqlLoginCliente);
            $token = generarToken($clientData['user_clnt'], $key);

            echo json_encode(["success" => 1, "userType" => "client", "userData" => $clientData, "token" => $token]);
            exit();
        } else {
            echo json_encode(["success" => 0]);
            exit();
        }
    }

}


?>