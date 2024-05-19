<?php
@session_start();
$coduser = $_SESSION['coduser'];

if(!empty($_FILES)){ 
    // File path configuration 
    $uploadDir = "images/"; 
    $fileName = basename($_FILES['file']['name']); 
    $extension = pathinfo($fileName, PATHINFO_EXTENSION);
    $uploadFilePath = $uploadDir."IMGPERFIL_".$coduser.".".$extension; 
    
     
    // Upload file to server 
    if(move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath)){ 
        // Insert file information in the database 
        echo "OK ARCHIVO";
    } 
} 
?>