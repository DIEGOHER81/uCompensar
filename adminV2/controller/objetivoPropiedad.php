<?php
   @session_start();
   require_once("../config/conexion.php");
   require_once("../models/objetivoPropiedad.php");

   $Objetivo = new objetivoPropiedad();
   $opcion = filter_input(INPUT_POST, 'Opc');

   switch ($opcion) {

        case 'DeleteObjetivo':
            $idObjetivo = filter_input(INPUT_POST, 'id');
            $result = $Objetivo->delete_objetivosPropiedad($idObjetivo);
        
            if (is_array($result) && $result["error"]) {
                // Se produjo un error
                $errorCode = $result["errorCode"];
                $errorDescription = $result["errorDescription"];
        
                echo "ERROR ".$errorCode.": ".$errorDescription;
            } else {
                // Éxito, puedes manejar la respuesta exitosa aquí.
                echo "Se eliminó correctamente el objetivo";
            }
            break;
    
        case 'ConsultarObjetivos':

            $table = "<table id='tblObjetivos' class='table table-striped table-bordered' style='width:100%'>";
            $table .="<thead>";

            $table .="<tr><th>Id</th>";
            $table .="<th>Descripción</th>";
            $table .="<th>Acciones</th>";
            $table .="</tr>";
            $table .="</thead>";
            $table .="<tbody>";


            // Invocar la función
            $result = $Objetivo->get_objetivosPropiedad();

            if (is_array($result) && isset($result["error"])) {
                // Hubo un error en la función, puedes manejarlo aquí
                $errorCode = $result["errorCode"];
                $errorDescription = $result["errorDescription"];
                echo "Error: Código $errorCode - $errorDescription";
            } else {
                // La función se ejecutó con éxito, $result contiene los datos recuperados
                $ObjetivosPropiedad = $result;
                foreach ($ObjetivosPropiedad as $row) {
                    $table .= "<tr>";
                    $table .= "<td>".$row["id"]."</td>";
                    $table .= "<td>".$row["descripcion"]."</td>";
                    $table .= "<td><button type='button' class='btn btn-danger' onClick='ConfirmDialogDelete(&#039;".$row["id"]."&#039;)'><i class='fa fa-trash'></i></button>";
                    $table .= "</td>";
                    $table .= "</tr>";
                }
            }

           
            $table .="</tbody>";
            $table .= "</table>";
            echo $table;
            
            break;

        case 'ConsultarObjetivoslst':

            $lstCiudad = "<select class='form-control' id='lstObjetivos' name='lstObjetivos'>";
            $lstCiudad .= "<option value='NA'>SELECCIONE OBJETIVO ...</option>";
            // Invocar la función
            $result = $Objetivo->get_objetivosPropiedad();

            if (is_array($result) && isset($result["error"])) {
                // Hubo un error en la función, puedes manejarlo aquí
                $errorCode = $result["errorCode"];
                $errorDescription = $result["errorDescription"];
                echo "Error: Código $errorCode - $errorDescription";
            } else {
                // La función se ejecutó con éxito, $result contiene los datos recuperados
                $ciudades = $result;
                foreach ($ciudades as $row) {
                    $lstCiudad .= "<option value='".$row["id"]."'>".$row["descripcion"]."</option>";
                }
            }

            $lstCiudad .= "</select>";
            echo $lstCiudad;
            
            break;
    


      default:
            $descObjetivo = filter_input(INPUT_POST, 'txtDescripcion');
            $result = $Objetivo->create_objetivosPropiedad($descObjetivo);
        
            if (is_array($result) && $result["error"]) {
                // Se produjo un error
                $errorCode = $result["errorCode"];
                $errorDescription = $result["errorDescription"];
        
                echo "ERROR ".$errorCode.": ".$errorDescription;
            } else {
                // Éxito, puedes manejar la respuesta exitosa aquí.
                echo "Se ha agregado correctamente el objetivo";
            }
            break;
   }

?>
