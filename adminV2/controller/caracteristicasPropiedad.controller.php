<?php
   @session_start();
   require_once("../config/conexion.php");
   require_once("../models/caracteristicasPropiedad.model.php");

   $caracteristicaPropiedad = new AdminCaracteristicaPropiedad();
   $opcion = filter_input(INPUT_POST, 'Opc');

   if ($opcion ==""){
    $opcion = filter_input(INPUT_POST, 'txtAccion');
   }

    if (strlen($opcion) == 0)
    {
         $opcion = filter_input(INPUT_POST, 'txtAccion');
    }

   switch ($opcion) {

        case 'EliminarCaracteristica':
            $idCaracteristica = filter_input(INPUT_POST, 'idCaracteristica');
            $idPropiedad = filter_input(INPUT_POST, 'idtipo');
            $result = $caracteristicaPropiedad->delete_caracteristicas($idCaracteristica, $idPropiedad);
        
            if (is_array($result) && $result["error"]) {
                // Se produjo un error
                $errorCode = $result["errorCode"];
                $errorDescription = $result["errorDescription"];
        
                echo "ERROR ".$errorCode.": ".$errorDescription;
            } else {
                // Éxito, puedes manejar la respuesta exitosa aquí.
                echo "Se ha eliminado correctamente la caracteristica";
            }
            break;
    
        case 'ConsultarCaracteristicas':

            $AllCaracteristicas = $caracteristicaPropiedad->get_allProperties();
           
            $table = "<table id='tblCaracteristicas' class='table table-striped table-bordered' style='width:100%'>";
            $table .="<thead>";

            $table .="<tr><th>Id</th>";
            $table .="<th>Descripción</th>";
            $table .="<th>Genero</th>";
            $table .="<th>Estado</th>";
            $table .="<th>¿Es Base?</th>";
            $table .="<th>Acciones</th>";
            $table .="</tr>";
            $table .="</thead>";
            $table .="<tbody>";


            foreach($AllCaracteristicas as $row)
            {

                $table .= "<tr>";
                $table .= "<td>".$row["rep_id"]."</td>";
                $table .= "<td>".$row["rep_description"]."</td>";
                $table .= "<td>".$row["nombre_tipo"]."</td>";
                $table .= "<td>".$row["rep_status"]."</td>";
                $table .= "<td>".$row["is_base"]."</td>";
                $table .= "<td><button type='button' class='btn btn-danger' onClick='ConfirmDialogDelete(&#039;".$row["rep_id"]."&#039;,&#039;".$row["tipo_id"]."&#039;)'><i class='fa fa-trash'></i></button>";
                $table .= "</td>";
                $table .= "</tr>";

            }

            $table .="</tbody>";
            $table .= "</table>";
            echo $table;
            
            break;

        case "ConsultarCaracteristicasRelacionadaslstMS":
            $codtipoPropiedad = filter_input(INPUT_POST,'codtipoPropiedad');
            $AllCaracteristicas = $caracteristicaPropiedad->get_allPropertiesbytypelst($codtipoPropiedad);
            $select = "<select id='lstcaracteristicas' name='lstcaracteristicas' class='form-control' multiple style='height:250px;'>";
            foreach($AllCaracteristicas as $row)
            {
                $select .="<option value='".$row['rep_id']."'>".$row['rep_description']."</option>";
            }    
            $select .= "</select>";
            echo $select;

            break;

            break;
        case 'ConsultarCaracteristicasRelacionadas':

            $codtipoPropiedad = filter_input(INPUT_POST,'codtipoPropiedad');

            $AllCaracteristicas = $caracteristicaPropiedad->get_allPropertiesbytype($codtipoPropiedad);
           
            $table = "<table id='tblCaracteristicas' class='table table-striped table-bordered' style='width:100%'>";
            $table .="<thead>";

            $table .="<tr><th>Id</th>";
            $table .="<th>Característica</th>";
            $table .="<th>Valor</th>";
            $table .="<th>Especificación Contractual</th>";
            $table .="<th>Acciones</th>";
            $table .="</tr>";
            $table .="</thead>";
            $table .="<tbody>";

            $contadorfilas=1;
            foreach($AllCaracteristicas as $row)
            {

                

                $table .= "<tr id='".$contadorfilas."'>";
                $table .= "<td>".$row["rep_id"]."</td>";
                $table .= "<td>".$row["rep_description"]."</td>";
                $table .= "<td>";
                $table .= "<input type='text' value='' class='form-control' onblur='concatenarfilaCaracteristicas(".$contadorfilas.")' name='txtvalor-".$contadorfilas."' id='txtvalor-".$contadorfilas."'>";
                $table .= "</td>";
                $table .= "<td>";
                $table .= "<textarea class='form-control' id='txtMemoCaracteristicas-".$contadorfilas."' name='txtMemoCaracteristicas-".$contadorfilas."'  onblur='concatenarfilaCaracteristicas(".$contadorfilas.")' ></textarea>";
                $table .= "</td>";
                $table .= "<td>";
                $table .= "<button type='button' class='btn btn-danger' onClick='deleterowCaracteristica(".$contadorfilas.")'><i class='fa fa-trash'></i></button>";
                $table .= "<input type='hidden' class='form-control' value='".$row["rep_id"]."?' id='txtcaracteristica".$contadorfilas."' name='informacioncaracteristica[]'>";
                $table .= "</td>";
                $table .= "</tr>";
                $contadorfilas++;
            }

            $table .="</tbody>";
            $table .= "</table>";
            echo $table;
            


            break;

        case 'ConsultarCaracteristicasRelacionadaslst':
            $codtipoPropiedad = filter_input(INPUT_POST,'codtipoPropiedad');
            $AllCaracteristicas = $caracteristicaPropiedad->get_allPropertiesbytypelst($codtipoPropiedad);
            $select = "<select id='lstcaracteristicas' name='lstcaracteristicas' class='form-control'>";
            foreach($AllCaracteristicas as $row)
            {
                $select .="<option value='".$row['rep_id']."'>".$row['rep_description']."</option>";
            }    
            $select .= "</select>";
            echo $select;

            break;
      default:


            $estadoCaracteristica = filter_input(INPUT_POST,'state'); 
            $descripcionCaracteristica= filter_input(INPUT_POST,'txtDescripcion'); 
            $idTipoPropiedad= filter_input(INPUT_POST,'lstselectTipoPropiedad'); 
            $escaracteristicaBase= filter_input(INPUT_POST,'base');
            $usuario = $_SESSION['coduser'];

            if ($estadoCaracteristica==""){
                $estadoCaracteristica="A";
            }

            if ($escaracteristicaBase==""){
                $estadoCaracteristica="N";
            }

            $ItemcaracteristicaPropiedad= $caracteristicaPropiedad ->put_Properties($estadoCaracteristica, $descripcionCaracteristica, $idTipoPropiedad, $escaracteristicaBase,$usuario);
        
            echo $ItemcaracteristicaPropiedad;

       break;
   }

?>
