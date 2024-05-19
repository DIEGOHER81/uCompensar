<?php
/*
if (!empty($_FILES)) { 
    $opc = $_GET['Folder'];
    #$folder = "./docsuploaded/";
    $folder = "https://demosdesarrollo.desarrollaloya.com/real_estate/adminV2/view/propiedades/docsuploaded/";
    $uploadDir = $folder; 
    $fileName = basename($_FILES['file']['name']); 
    $uploadFilePath = $uploadDir . $fileName; 
    if ($_FILES['file']['size'] > 0)
    {
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath)) { 
            // Insert file information in the database 
            echo "OK ARCHIVO";
        } else {
             $errorCode = $_FILES['file']['error']; // Get the error code
             error_log("Failed to move uploaded file. Error code: $errorCode, Destination: $uploadFilePath"); // Log the error with error code and destination
             echo "Error uploading file. Error code: $errorCode, Destination: $uploadFilePath";
        }    
    } else {
        error_log("Failed to move uploaded file. The file size is 0 bytes"); 
    }
    
} else {
    echo "No files received.";
}*/

/*
if(!empty($_FILES)){ 
    // File path configuration 
    $uploadDir = "docsuploaded/"; 
    $fileName = basename($_FILES['file']['name']); 
    $uploadFilePath = $uploadDir.$fileName; 
    
     
    // Upload file to server 
    if(move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath)){ 
        // Insert file information in the database 
        echo "OK ARCHIVO";
    } 
} 
*/



$targetDir = "uploads/"; // Directorio de destino para guardar archivos

if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true); // Crea el directorio si no existe
}

if (!empty($_FILES)) {
    $tempFile = $_FILES['file']['tmp_name'];
    $fileName = $_FILES['file']['name'];

    // Verificar el tipo de archivo permitido
    $allowedTypes = array('pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png');
    $fileParts = pathinfo($_FILES['file']['name']);
    $fileType = strtolower($fileParts['extension']);

    if (in_array($fileType, $allowedTypes)) {
        $targetFile = $targetDir . $fileName;

        // Redimensionar imagen si es una imagen
        if (in_array($fileType, array('jpg', 'jpeg', 'png'))) {
            list($width, $height) = getimagesize($tempFile);
            $newWidth = 800; // Nuevo ancho deseado
            $newHeight = ($height / $width) * $newWidth;

            $thumb = imagecreatetruecolor($newWidth, $newHeight);

            if ($fileType == 'jpg' || $fileType == 'jpeg') {
                $source = imagecreatefromjpeg($tempFile);
            } elseif ($fileType == 'png') {
                $source = imagecreatefrompng($tempFile);
            }

            imagecopyresized($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

            // Guardar la imagen redimensionada
            imagejpeg($thumb, $targetFile, 80); // 80 es la calidad de compresión, ajusta según tus necesidades
        } else {
            // Mover el archivo al directorio de destino
            move_uploaded_file($tempFile, $targetFile);
        }   

        echo "OK ARCHIVO";
        #echo json_encode(array('status' => 'success', 'message' => 'Archivo subido correctamente'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Tipo de archivo no permitido'));
    }
} else {
    echo json_encode(array('status' => 'error', 'message' => 'No se recibió ningún archivo'));
}






?>
