<?php

function connection(){
	$server = "localhost";
	$user = "root";
	$pass = "";
	$database = "partytion";

	$con = mysqli_connect($server, $user, $pass, $database);

	if($con->connect_error){
		die("Error de conexión a la base de datos: " . $conexion->connect_error);
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


?>