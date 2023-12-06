<?php
use Firebase\JWT\JWT;
function connection(){
	$server = "localhost";
	$user = "root";
	$pass = "";
	$database = "partytion";

	$con = mysqli_connect($server, $user, $pass, $database);

	if($con->connect_error){
		die("Error de conexión a la base de datos: " . $con->connect_error);
	}
	if (!$con) {
    	die("Connection failed: " . mysqli_connect_error());
	}

	return $con;
}

function EjecutarSQL ($servidor, $usuario, $contrasena, $basedatos, $sentenciaSQL) {

	$conexion = connection();

	$resultado = mysqli_query($conexion, $sentenciaSQL);
	mysqli_close($conexion);

}

function ConsultarSQL ($servidor, $usuario, $contrasena, $basedatos, $sentenciaSQL) {

	$conexion = connection();

	$resultado = mysqli_query($conexion, $sentenciaSQL);
	
	for ($registros = array (); $fila = mysqli_fetch_assoc($resultado); $registros[] = $fila);	
	
	mysqli_close($conexion);
	
	return $registros;

}

function limpiarTexto($texto) {
    return strip_tags($texto);
}

function prevenirInyeccionSQL($conexion, $texto) {
    return mysqli_real_escape_string($conexion, $texto);
}

function generarToken($usuario, $key) {
	$ahora = time();
    $dosHorasEnSegundos = 2 * 60 * 60;

    $payload = array(
        "usuario" => $usuario,  
		"exp" => $ahora + $dosHorasEnSegundos 
    );
    $token = JWT::encode($payload, $key, 'HS256');

    return $token;
}

?>