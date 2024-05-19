<?php
   @session_start();
   require_once("../config/conexion.php");
   require_once("../models/ciudad.model.php");

   $Ciudad = new AdminCiudad();
   $opcion = filter_input(INPUT_POST, 'Opc');

   if ($opcion ==""){
    $opcion = filter_input(INPUT_POST, 'txtAccion');
   }

    if (strlen($opcion) == 0)
    {
         $opcion = filter_input(INPUT_POST, 'txtAccion');
    }

   switch ($opcion) {

        case 'EliminarCiudad':
            $idCiudad = filter_input(INPUT_POST, 'idCiudad');
            $result = $Ciudad->delete_ciudad($idCiudad);
        
            if (is_array($result) && $result["error"]) {
                // Se produjo un error
                $errorCode = $result["errorCode"];
                $errorDescription = $result["errorDescription"];
        
                echo "ERROR ".$errorCode.": ".$errorDescription;
            } else {
                // Éxito, puedes manejar la respuesta exitosa aquí.
                echo "Se ha eliminado correctamente la ciudad";
            }
            break;
    
        case 'ConsultarCiudades':

            $table = "<table id='tblCiudades' class='table table-striped table-bordered' style='width:100%'>";
            $table .="<thead>";

            $table .="<tr><th>Id</th>";
            $table .="<th>País</th>";
            $table .="<th>Departamento</th>";
            $table .="<th>Descripción</th>";
            $table .="<th>Acciones</th>";
            $table .="</tr>";
            $table .="</thead>";
            $table .="<tbody>";


            // Invocar la función
            $result = $Ciudad->get_allCiudades();

            if (is_array($result) && isset($result["error"])) {
                // Hubo un error en la función, puedes manejarlo aquí
                $errorCode = $result["errorCode"];
                $errorDescription = $result["errorDescription"];
                echo "Error: Código $errorCode - $errorDescription";
            } else {
                // La función se ejecutó con éxito, $result contiene los datos recuperados
                $ciudades = $result;
                foreach ($ciudades as $row) {
                    $table .= "<tr>";
                    $table .= "<td>".$row["id"]."</td>";
                    $table .= "<td>".$row["nombre_pais"]."</td>";
                    $table .= "<td>".$row["nombre_departamento"]."</td>";
                    $table .= "<td>".$row["nombre_ciudad"]."</td>";
                    $table .= "<td><button type='button' class='btn btn-danger' onClick='ConfirmDialogDelete(&#039;".$row["id"]."&#039;)'><i class='fa fa-trash'></i></button>";
                    $table .= "</td>";
                    $table .= "</tr>";
                }
            }

           
            $table .="</tbody>";
            $table .= "</table>";
            echo $table;
            
            break;


        case 'SearchCitiesbyCountry':
            $idPais = filter_input(INPUT_POST, 'idPais');
            $idDepartamento = filter_input(INPUT_POST, 'idDepartamento');

            $lstCiudad = "<select class='form-control' id='lstCiudad' name='lstCiudad'>";
            // Invocar la función
            $result = $Ciudad->get_allCiudadesbyCountry($idPais,  $idDepartamento);

            if (is_array($result) && isset($result["error"])) {
                // Hubo un error en la función, puedes manejarlo aquí
                $errorCode = $result["errorCode"];
                $errorDescription = $result["errorDescription"];
                echo "Error: Código $errorCode - $errorDescription";
            } else {
                // La función se ejecutó con éxito, $result contiene los datos recuperados
                $ciudades = $result;
                foreach ($ciudades as $row) {
                    $lstCiudad .= "<option value='".$row["id"]."'>".$row["nombre_ciudad"]."</option>";
                }
            }

            $lstCiudad .= "</select>";
            echo $lstCiudad;
                

            break;    

        case 'ConsultarCiudadeslst':

            $lstCiudad = "<select class='form-control' id='lstCiudad' name='lstCiudad'>";
            // Invocar la función
            $result = $Ciudad->get_allCiudades();

            if (is_array($result) && isset($result["error"])) {
                // Hubo un error en la función, puedes manejarlo aquí
                $errorCode = $result["errorCode"];
                $errorDescription = $result["errorDescription"];
                echo "Error: Código $errorCode - $errorDescription";
            } else {
                // La función se ejecutó con éxito, $result contiene los datos recuperados
                $ciudades = $result;
                foreach ($ciudades as $row) {
                    $lstCiudad .= "<option value='".$row["id"]."'>".$row["nombre_ciudad"]."</option>";
                }
            }

            $lstCiudad .= "</select>";
            echo $lstCiudad;
            
            break;
    


      default:
            $descCiudad = filter_input(INPUT_POST, 'txtDescripcion');
            $idpais = filter_input(INPUT_POST, 'lstpais');
            $idDepartamento = filter_input(INPUT_POST, 'lstdepartamentos');
            $answerCiudad= $Ciudad ->add_ciudad($idpais, $descCiudad, $idDepartamento);
        
            echo $answerCiudad;

       break;
   }

?>
