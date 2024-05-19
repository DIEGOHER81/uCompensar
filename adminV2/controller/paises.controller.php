<?php
   @session_start();
   require_once("../config/conexion.php");
   require_once("../models/paises.model.php");

   $pais = new paises();
   $opcion = filter_input(INPUT_POST, 'Opc');

   if ($opcion ==""){
    $opcion = filter_input(INPUT_POST, 'txtAccion');
   }

    if (strlen($opcion) == 0)
    {
         $opcion = filter_input(INPUT_POST, 'txtAccion');
    }

   switch ($opcion) {

        case 'ConsultarPaisesLst':

            $AllCountries = $pais->get_allcountries();
            $tipopropiedad = "";
            $tipopropiedad = "<select class='form-control' id='lstpais' name = 'lstpais' onChange='ConsultarDepartamentos(this.value)'>";
            $tipopropiedad .= "<option value='NA'>SELECCIONE PAIS ...</option>";
            foreach($AllCountries as $row)
            {
                
                $tipopropiedad .= "<option value='".$row['id']."'>".$row['nombre_pais']."</option>";
            }
            $tipopropiedad .= "</select>";

            echo $tipopropiedad;
            
            break;

        case 'ConsultarPaisesLstforproperties':

            $AllCountries = $pais->get_allcountries();
            $tipopropiedad = "";
            $tipopropiedad = "<select class='form-control' id='lstpais' name = 'lstpais' onchange='consultarDepartamentosporPais(this.value)'>";
            $tipopropiedad .= "<option value='NA'>SELECCIONE PAIS ...</option>";
            foreach($AllCountries as $row)
            {
                
                $tipopropiedad .= "<option value='".$row['id']."'>".$row['nombre_pais']."</option>";
            }
            $tipopropiedad .= "</select>";

            echo $tipopropiedad;
            
            break;



        case 'ConsultarPaisesTbl':        
            
            $table = "<table id='tblpaises' class='table table-striped table-bordered' style='width:100%'>";
            $table .="<thead>";

            $table .="<tr><th>Id</th>";
            $table .="<th>Descripción</th>";
            $table .="<th>Acciones</th>";
            $table .="</tr>";
            $table .="</thead>";
            $table .="<tbody>";


            // Invocar la función
            $result = $pais->get_allcountries();

            if (is_array($result) && isset($result["error"])) {
                // Hubo un error en la función, puedes manejarlo aquí
                $errorCode = $result["errorCode"];
                $errorDescription = $result["errorDescription"];
                echo "Error: Código $errorCode - $errorDescription";
            } else {
                // La función se ejecutó con éxito, $result contiene los datos recuperados
                $paisResult = $result;
                foreach ($paisResult as $row) {
                    $table .= "<tr>";
                    $table .= "<td>".$row["id"]."</td>";
                    $table .= "<td>".$row["nombre_pais"]."</td>";
                    $table .= "<td><button type='button' class='btn btn-danger' onClick='ConfirmDialogDelete(&#039;".$row["id"]."&#039;)'><i class='fa fa-trash'></i></button>";
                    $table .= "</td>";
                    $table .= "</tr>";
                }
            }

           
            $table .="</tbody>";
            $table .= "</table>";
            echo $table;
            
            break;
        
        case "EliminarPaises":
            $idtipo = filter_input(INPUT_POST, 'idtipo');
            $AllTypes = $pais->delete_paises($idtipo);
            echo $AllTypes;
            break;    

        case 'ConsultarTipoPropiedadesComercial':

            $AllTypes = $tipoPropiedad->get_alltypes();
            $tipopropiedad = "";
            $tipopropiedad = "<select class='form-control' id='lstselectTipoPropiedad' name = 'lstselectTipoPropiedad' onblur='ConsultarCaracteristicasRelacionadas(this.value)'>";
            $tipopropiedad .= "<option value='NA'>SELECCIONE TIPO ...</option>";
            foreach($AllTypes as $row)
            {
                
                $tipopropiedad .= "<option value='".$row['id']."'>".$row['nombre_tipo']."</option>";
            }
            $tipopropiedad .= "</select>";

            echo $tipopropiedad;
            
            break;

      default:


            $descripcion= filter_input(INPUT_POST,'txtDescripcion');

            $tipoPropiedadIngresar= $pais ->create_paises($descripcion);
        
            echo $tipoPropiedadIngresar;




       break;
   }

?>
