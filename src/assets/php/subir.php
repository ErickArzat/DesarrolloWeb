<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Resto del código para procesar la solicitud POST
    // ...
    if (isset($_POST['link']) && isset($_POST['filename'])) {
        $targetFile = $_POST['link'];
        $filename = $_POST['filename'];

        $targetDir = "/src/assets/imagenes/pasteles"; 
        if (!file_exists($targetDir)) mkdir($targetDir, 0777, true); 
        // Mueve el archivo desde su ubicación temporal al destino final
        if (move_uploaded_file($_FILES[$filename]["tmp_name"], $targetFile)) {
            echo "Archivo subido correctamente.";
        } else {
            echo "Error al subir el archivo.";
        }
    } else {
        echo "Datos insuficientes para subir el archivo.";
    }
}else {
    http_response_code(405); // Devolver un código de estado 405 si no es una solicitud POST
    echo "Método no permitido";
}
?>