<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=datos_parties.csv");

include("functions.php"); 

$conexionBD = connection(); 
$sql = "SELECT * FROM parties"; 
$result = mysqli_query($conexionBD, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $delimiter = ",";
    $filename = "datos_parties.csv";

    $f = fopen('php://output', 'w');

    
    $fields = array('ID', 'id_type', 'id_clnt', 'id_pal', 'id_cake', 'id_pay', 'id_staff', 'date_party');
    fputcsv($f, $fields, $delimiter);


    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($f, $row, $delimiter);
    }
    fclose($f);
    exit;
} else {
    echo "No se encontraron resultados en la tabla 'parties'.";
}

// Cierra la conexión a la base de datos
mysqli_close($conexionBD);
?>
