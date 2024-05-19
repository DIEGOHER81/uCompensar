<?php
   @session_start();
   require_once("../config/conexion.php");
   require_once("../models/costos.model.php");

   $CostosAdicionales = new AdminCostos();
   $opcion = filter_input(INPUT_POST, 'Opc');

   if ($opcion ==""){
    $opcion = filter_input(INPUT_POST, 'txtAccion');
   }

    if (strlen($opcion) == 0)
    {
         $opcion = filter_input(INPUT_POST, 'txtAccion');
    }

   switch ($opcion) {
        case 'DeleteCosto':
            $idCosto = filter_input(INPUT_POST, 'id');
            $AllCostos = $CostosAdicionales->delete_Costo($idCosto);
            echo "OK";
            break;

        case 'ConsultarCostos':

            $AllCostos = $CostosAdicionales->get_allCostos();
           
            $table = "<table id='tblCostos' class='table table-striped table-bordered' style='width:100%'>";
            $table .="<thead>";

            $table .="<tr><th>Id</th>";
            $table .="<th>Descripción</th>";
            $table .="<th>Tipo Propiedad</th>";
            $table .="<th>Estado</th>";
            $table .="<th>Costo</th>";
            $table .="<th>Tipo de Costo</th>";
            $table .="<th>Forma de Cobro</th>";
            $table .="<th>Acciones</th>";
            $table .="</tr>";
            $table .="</thead>";
            $table .="<tbody>";


            foreach($AllCostos as $row)
            {

                $table .= "<tr>";
                $table .= "<td>".$row["id"]."</td>";
                $table .= "<td>".$row["descripcion"]."</td>";
                $table .= "<td>".$row["nombre_tipo"]."</td>";
                $table .= "<td>".$row["estado"]."</td>";
                $table .= "<td>".$row["costoservicio"]."</td>";
                $table .= "<td>".$row["tipoCosto"]."</td>";
                $table .= "<td>".$row["formaCobro"]."</td>";
                $table .= "<td><button type='button' class='btn btn-danger' onClick='ConfirmDialogDelete(".$row["id"].")'><i class='fa fa-trash'></i></button>";
                $table .= "</td>";
                $table .= "</tr>";

            }

            $table .="</tbody>";
            $table .= "</table>";
            echo $table;
            
            break;

     case "ConsultarCostosporTiposdePropiedades":
     
        $idtipoPropiedad = filter_input(INPUT_POST, 'codtipoPropiedad');
        $costosporPropiedad = $CostosAdicionales->get_allCostosPerProperty($idtipoPropiedad);
        $lstCostos = "<select id='lstcostos' name='lstcostos' class='form-control' onChange='TraerValorCosto(this.value)'>";
        $lstCostos .="<option value=''>Seleccione Costo Adicional</option>";
        $arr = array();
        foreach($costosporPropiedad as $row)
        {
            $lstCostos .="<option value='".$row['id']."'>".$row['descripcion']."</option>";
        }
        
        $lstCostos .= "</select>";
        echo $lstCostos;

        break;

      case "ConsultarValorpordefecto":
        
        $idCosto = filter_input(INPUT_POST, 'idCosto');
        $arr = array();
        if ($idCosto !="")
        {

            $valorCosto = $CostosAdicionales->get_valorCosto($idCosto);
            foreach($valorCosto as $valorobject)
            {
                $arr[] = array('valorCosto' => $valorobject ['costoservicio']
                );
            }
    
            
    
        } else {
                $arr[] = array('valorCosto' => 0 );
        }

        echo json_encode($arr).'';
        break;
      default:


            $estadoCosto = filter_input(INPUT_POST,'state'); 
            $descripcionCosto= filter_input(INPUT_POST,'txtDescripcion'); 
            $idTipoPropiedad= filter_input(INPUT_POST,'lstselectTipoPropiedad'); 
            $CostoServicio = filter_input(INPUT_POST,'txtCosto'); 
            $tipodecosto =  filter_input(INPUT_POST,'tipoCosto'); 
            $formadecobro =  filter_input(INPUT_POST,'lstformacobro'); 

            if ($estadoCosto==""){
                $estadoCaracteristica="A";
            }

            $ItemcaracteristicaPropiedad= $CostosAdicionales ->add_Costos($descripcionCosto,$estadoCosto, $idTipoPropiedad, $CostoServicio, $tipodecosto, $formadecobro);
        
            echo $ItemcaracteristicaPropiedad;

       break;
   }

?>
