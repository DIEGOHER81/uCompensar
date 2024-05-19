<?php
   @session_start();
   require_once("../config/conexion.php");
   require_once("../models/departamentos.model.php");

   $Departamento = new AdminDepartamentos();
   $opcion = filter_input(INPUT_POST, 'Opc');

   if ($opcion ==""){
    $opcion = filter_input(INPUT_POST, 'txtAccion');
   }

    if (strlen($opcion) == 0)
    {
         $opcion = filter_input(INPUT_POST, 'txtAccion');
    }

   switch ($opcion) {

        case "ConsultarDepartamentos":
            $idPais = filter_input(INPUT_POST, 'idPais');
            $result = $Departamento->get_DepartamentsByCountry($idPais);
   
             if (is_array($result) && isset($result["error"])) {
                
                $errorCode = $result["errorCode"];
                $errorDescription = $result["errorDescription"];
        
                echo "ERROR ".$errorCode.": ".$errorDescription;
            } else {
                
                $lstDepartamentos = "<select id = 'lstdepartamentos'  class='form-control'  name='lstdepartamentos'  onChange='ConsultarCiudadesPorDepartamento(this.value)'>";
                $lstDepartamentos .= "<option  value='NA'>Seleccione departamento...</option>";
                $ciudades = $result;
                foreach ($ciudades as $row) {
                    $lstDepartamentos .= "<option value='".$row['id']."'>".$row['nombre_departamento']."</option>";
                }

                $lstDepartamentos .= "</select>";

            }
            
            echo $lstDepartamentos;
            
            break;

      default:

       break;
   }

?>
