<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=datos_payments.csv");

include("functions.php"); 

$conexionBD = connection();

$sql = "SELECT * FROM payments"; 
$result = mysqli_query($conexionBD, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $delimiter = ",";
    $filename = "datos_payments.csv";

    $f = fopen('php://output', 'w');

    
    $fields = array('ID', 'amount', 'status', 'date_pay');
    fputcsv($f, $fields, $delimiter);

    
    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($f, $row, $delimiter);
    }
    fclose($f);
    exit;
} else {
    echo "No se encontraron resultados en la tabla 'payments'.";
}


mysqli_close($conexionBD);
?>
