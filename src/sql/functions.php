<?php

function connection(){
	$server = "localhost";
	$user = "root";
	$pass = "06diciembre2023";
	$database = "partytion";

	$con = new mysqli($server, $user, $pass, $database);

	if($con->connect_error){
		die("Error de conexión a la base de datos: " . $conexion->connect_error);
	}
	if (!$con) {
    	die("Fallo: " . mysqli_connect_error());
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


?>