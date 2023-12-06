<?php
require 'vendor/autoload.php';
use Firebase\JWT\JWT;

function limpiarTexto($texto) {
    return strip_tags($texto);
}

function prevenirInyeccionSQL($conexion, $texto) {
    return mysqli_real_escape_string($conexion, $texto);
}



?>