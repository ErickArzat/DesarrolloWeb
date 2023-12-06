<?php
require 'vendor/autoload.php';
use Firebase\JWT\JWT;

function limpiarTexto($texto) {
    return strip_tags($texto);
}

function prevenirInyeccionSQL($conexion, $texto) {
    return mysqli_real_escape_string($conexion, $texto);
}

function generarToken($usuario, $contrasenia, $key) {
	$ahora = time();
    $dosHorasEnSegundos = 2 * 60 * 60;

    $payload = array(
        "usuario" => $usuario,  
        "contrasena"=> $contrasenia,
		"exp" => $ahora + $dosHorasEnSegundos 
    );
    $token = JWT::encode($payload, $key, 'HS256');

    return $token;
}

?>