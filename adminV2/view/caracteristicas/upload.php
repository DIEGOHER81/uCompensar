<?php
if(!empty($_FILES)){ 

    $opc = $_GET['Folder'];

    switch ($opc) {
        case '1':
            $folder = "docsuploaded/lista";  # code...
            break;
        case '2':
            $folder = "docsuploaded/fichas";  # code...
            break;
        case '3':
            $folder = "docsuploaded/legales";  # code...
            break;
        case '4':
            $folder = "docsuploaded/creditos";  # code...
            break;
        case '5':
            $folder = "docsuploaded/catalogos";  # code...
            break;                
        default:
            # code...
            break;
    }

    // File path configuration 
    $uploadDir = $folder; 
    $fileName = basename($_FILES['file']['name']); 
    $uploadFilePath = $uploadDir.$fileName; 
    
     
    // Upload file to server 
    if(move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath)){ 
        // Insert file information in the database 
        echo "OK ARCHIVO";
    } 
} 

?>