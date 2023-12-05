<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Ruta de la carpeta donde se almacenarán las imágenes
$uploadFolder = 'C:/xampp/htdocs/daw/DesarrolloWeb/src/assets/imagenes';

if ($_FILES['image']) {
    $tempFile = $_FILES['image']['tmp_name'];
    $targetFile = $uploadFolder . '/' . $_FILES['image']['name'];
    // Mueve la imagen al destino final
    move_uploaded_file($tempFile, $targetFile);
    echo json_encode(['success' => true, 'message' => 'Imagen subida correctamente']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al subir la imagen']);
}
?>

