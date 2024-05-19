<?php
if(!empty($_FILES)){ 

    $opc = $_GET['Folder'];
    $folder = "docsuploaded/";

    
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