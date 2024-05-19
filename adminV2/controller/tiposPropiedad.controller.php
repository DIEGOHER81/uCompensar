<?php
   @session_start();
   require_once("../config/conexion.php");
   require_once("../models/tiposPropiedad.model.php");

   $tipoPropiedad = new AdminTipoPropiedad();
   $opcion = filter_input(INPUT_POST, 'Opc');

   if ($opcion ==""){
    $opcion = filter_input(INPUT_POST, 'txtAccion');
   }

    if (strlen($opcion) == 0)
    {
         $opcion = filter_input(INPUT_POST, 'txtAccion');
    }

   switch ($opcion) {

        case 'ConsultarTipoPropiedades':

            $AllTypes = $tipoPropiedad->get_alltypes();
            $tipopropiedad = "";
            $tipopropiedad = "<select class='form-control' id='lstselectTipoPropiedad' name = 'lstselectTipoPropiedad'>";
            $tipopropiedad .= "<option value='NA'>SELECCIONE TIPO ...</option>";
            foreach($AllTypes as $row)
            {
                
                $tipopropiedad .= "<option value='".$row['id']."'>".$row['nombre_tipo']."</option>";
            }
            $tipopropiedad .= "</select>";

            echo $tipopropiedad;
            
            break;

        case 'ConsultarTipos':        
            $AllPropiedades = $tipoPropiedad->get_alltypes();
            $table = "";
    
            $table = "<table id='tbltipospropiedad' class='table table-striped table-bordered' style='width:100%'>";
            $table .="<thead>";
            $table .="<tr><th>id</th>";
            $table .="<th>Descripción</th>";
            $table .="<th>Acciones</th>";
            $table .="</tr>";
            $table .="</thead>";
            $table .="<tbody>";
            foreach($AllPropiedades as $row)
            {
                $table .= "<tr>";
                $table .= "<td>".$row['id']."</td>";
                $table .= "<td>".$row['nombre_tipo']."</td>";
                $table .= "<td><button class='btn btn-danger' onclick='ConfirmDialogDelete(".$row['id'].")'><i class='fa fa-trash'></i></button></td>";
                $table .= "</tr>";
            }
            $table .="</tbody>";
            $table .= "</table>";
            echo $table;
    
            break;
        
        case "EliminarTipos":
            $idtipo = filter_input(INPUT_POST, 'idtipo');
            $AllTypes = $tipoPropiedad->delete_propertytypes($idtipo);
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
            $estado = filter_input(INPUT_POST,'lstestadoPropiedad');

            $tipoPropiedadIngresar= $tipoPropiedad ->put_propertytypes($descripcion);
        
            echo $tipoPropiedadIngresar;




       break;
   }

?>
