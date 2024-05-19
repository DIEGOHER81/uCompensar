<?php
   @session_start();
   require_once("../config/conexion.php");
   require_once("../models/agendamiento.php");

   
   $event = new AdminAgendamiento();
   $opcion = filter_input(INPUT_POST, 'Opc');

   switch ($opcion) {

        case "ConsultarHistorialEvento":
            $idEvent = filter_input(INPUT_POST,'idEvent');
            $answer = $event->FindHistorialEventbyId($idEvent);    

            $table  = "<table id='tblclientes' class='table table-striped table-bordered' style='width:100%'>";
            $table .= "<thead>";
            $table .= "<tr>";
            $table .= "<th>ID</th>";
            $table .= "<th>Observación</th>";
            $table .= "<th>Fecha de Registro</th>";
            $table .= "</tr>";
            $table .= "</thead>";
            $table .= "<tbody>";
            
            foreach($answer as $row)
            {
                    $table .= "<tr>";
                    $table .= "<td>".$row["idenvent"]."</td>";
                    $table .= "<td>".$row["observation"]."</td>";
                    $table .= "<td>".$row["createddatetime"]."</td>";
                    $table .= "</tr>";
            }
            $table .= "</tbody>";
            $table .= "</table>";
            echo $table;
            
            
            break;


        case "AddObservation":
          
          $idEvent = filter_input(INPUT_POST,'idEvent');
          $note =  filter_input(INPUT_POST,'note');  

          $answer = $event->add_observationevent($idEvent, $note);
          echo $answer;


          break;

        case "DeleteEventbyId":
          $answer = "";
          $idEvent = filter_input(INPUT_POST,'idEvent');
          $answer = $event->delete_observationevent($idEvent);
          $answer = $event->delete_contactevent($idEvent);
          $answer = $event->delete_event($idEvent);

          echo $answer;

          break; 
       case "FindEventsforUser":
        
           # Save Product...
           $answer = "ERROR";
           $user = '39';
           //$user = "DIEGOHER";
           $answer = $event->get_alleventsbyuser($user);

          

           if (!empty($answer)) {
            foreach ($answer as $row) {
                $data[] = array(
                    'id'    => $row["id"],
                    'start' => $row["startEvent"],
                    'end'   => $row["endEvent"]
                );
            }
        
            echo json_encode($data);
        } else {
            #echo "No hay datos disponibles.";
        }
        
           

          break; 

        case "FindEventsforAsesor":
        
            # Save Product...
            $answer = "ERROR";
            $user = filter_input(INPUT_POST,'Asesor');
            //$user = "DIEGOHER";
            
            if ($user =="NA")
            {
                $user = $_SESSION['coduser'];
            }
            
            $answer = $event->get_alleventsbyuser($user);
 
           
 
            foreach($answer as $row)
            {
                 $data[] = array(
                 'id'    => $row["id"],
                 'title' => $row["tittle"],
                 'start' => $row["startEvent"],
                 'end'   => $row["endEvent"],
                 'notes' => $row["notes"]
                 );
            }
 
            echo json_encode($data);    
            
 
           break; 


        case "ConsultarProximosEventos":  

            $answer = "ERROR";
            $user = $_SESSION['coduser'];
            $answer = $event->get_alleventsbyuserforList($user);
            $list = "";
            foreach ($answer as $row)
            {
                $list .= "<li>";
                $list .="<div class='block'>";
                $list .="<div class='block_content'>";
                $list .="    <h2 class='title'>";
                $list .="      <a>".htmlentities($row['tittle'])."</a>";
                $list .="    </h2>";
                $list .="    <div class='byline'>";
                $list .="      <span>Realizada</span> Por: ".$_SESSION['user_name']."</br><span>Fecha</span>: ".$row['startEvent'];
                $list .="    </div>";
                $list .="    <p class='excerpt'>".htmlentities($row['notes']);
                $list .="    </p>";
                $list .="  </div>";
                $list .="</div>";
                $list .="</li>";

            }

            echo $list;
            break;
        case 'FindEventbyId':

            $idEvent = filter_input(INPUT_POST,'idEvent');
            $answer = $event->get_alleventsbyIdEvent($idEvent);
            foreach($answer as $row)
            {
                    $data[] = array(
                    'id'    => $row["id"],
                    'title' => $row["tittle"],
                    'start' => str_replace(" ","T",$row["startEvent"]),
                    'end'   => str_replace(" ","T",$row["endEvent"]),
                    'Modalidad' => $row["modality"],
                    'Cliente'   => $row["codclient"],
                    'NroCotizacion'=> $row["quotenumber"],
                    'Contacto'  => $row["codContact"],
                    'Observacion' => $row["notes"],
                    'Presupuesto' => $row["budget"],
                    );
            }
            echo json_encode($data);    
            break;

       case 'FindContactByEventId':
        
            $idEvent = filter_input(INPUT_POST,'idEvent');
            $answer = $event->get_ContactByIdEvent($idEvent);
            foreach($answer as $row)
            {
                    $data[] = array(
                      'nombrecontacto' => $row['contact_name'],
                      'correocontacto' => $row['contact_email'],
                      'telefonocontacto' => $row['contact_celular'],
                      'empresacontacto' => $row['contact_company']
                    );
            }
            echo json_encode($data);    

            break;



       case 'ConsultarTodoslosproductos':
           $Productos = $product->get_allproductos();
           $table  = "<table id='tblproductos' class='table table-striped table-bordered' style='width:100%'>";
           $table .= "<thead>";
           $table .= "<tr>";
           $table .= "<th>Cód. Producto</th>";
           $table .= "<th>Descripción Corta</th>";
           $table .= "<th>Descripción Larga</th>";
           $table .= "<th>Unidad de Medida</th>";
           $table .= "<th>Costo</th>";
           $table .= "<th>Estado</th>";
           $table .= "<th>Acciones</th>";
           $table .= "</tr>";
           $table .= "</thead>";
           $table .= "<tbody>";
           
           foreach($Productos as $row)
           {
                $table .= "<tr>";
                $table .= "<td>".$row["codproducto"]."</td>";
                $table .= "<td>".$row["desc_corta"]."</td>";
                $table .= "<td>".$row["desc_larga"]."</td>";
                $table .= "<td>".$row["um"]."</td>";
                $table .= "<td>".$row["costo"]."</td>";
                $table .= "<td>".$row["estado"]."</td>";
                $table .= "<td><button type='button' class='btn btn-info' onClick='editar(&#39;".$row["codproducto"]."&#39;)'><i class='fa fa-edit'></i></button>";
                $table .= "<button type='button' class='btn btn-danger' onClick='ConfirmDialogDelete(&#39;".$row['codproducto']."&#39;)'><i class='fa fa-trash'></i></button></td>";
                $table .= "</tr>";
           }
           $table .= "</tbody>";
           $table .= "</table>";
           echo $table;
           break;
       
       case 'DeleteProduct':

            $answer = "ERROR";
            $productCode = filter_input(INPUT_POST, 'idProduct');
            $answer = $product->delete_product($productCode);
            echo $answer;

            break;

        case "FindProduct":
            $answer = "ERROR";
            $productCode = filter_input(INPUT_POST, 'idProduct');
            $answer = $product->Find_product($productCode);

            $arr = array();

            foreach($answer as $productobject)
            {
                $arr[] = array('codproduct' => $productobject ['codproducto'],
                               'DescCorta' => $productobject ['desc_corta'],
                               'DescLarga' => $productobject ['desc_larga'],
                               'categoria' => $productobject ['categoria'],
                               'marca' => $productobject ['marca'],
                               'costo' => $productobject ['costo'],
                               'impuesto' => $productobject ['impuesto'],
                               'um' => $productobject ['um'],
                               'referencia' => $productobject ['referencia'],
                               'estado' => $productobject ['estado']
                );
            }

            echo json_encode($arr).'';

            break;
       default:

           # Save Product...
           $answer = "ERROR";
           $anser_contacto = "";

           $titulo = filter_input(INPUT_POST,'titleNewEvent');
           $fecInicio = filter_input(INPUT_POST,'HoraInicioNewEvent');
           $fecFinal = filter_input(INPUT_POST,'HoraFinNewEvent');
           $Modallidad =  filter_input(INPUT_POST,'lstModalidadNewEvent');
           $codcliente = filter_input(INPUT_POST,'lstclients');
           $codcontacto = filter_input(INPUT_POST,'lstcontactos');
           $observaciones = filter_input(INPUT_POST,'descrNewEvent');
           $presupuesto = filter_input(INPUT_POST,'txtbudgetnewEvent');
           $estado = "A";
           $sucursal=filter_input(INPUT_POST,'lstcodigosclientes');
           $numerodecotizacion = filter_input(INPUT_POST,'txtcodCotizacionNewEvent');
           $usuario = $_SESSION['coduser'];

           $contact_name = filter_input(INPUT_POST,'txtnamenewEvent');
           $contact_email = filter_input(INPUT_POST,'txtDireccionNewEvent');
           $contact_celular = filter_input(INPUT_POST,'txttelefonoNewEvent');
           $contact_company = filter_input(INPUT_POST,'txtnamecompanynewEvent');;

           
           $answer = $event->Create_Event($titulo,$fecInicio, $fecFinal, $Modallidad, $codcliente, $sucursal,$numerodecotizacion,$codcontacto, $observaciones,$presupuesto, $estado, $usuario);
           $respuesta = ""; 

           foreach($answer as $row)
           {
                $respuesta = $row['IdEvento'];
           }


           if (strlen($contact_name)>0)
            { 
                $answer_contacto = $event->Create_contact_event($respuesta, $contact_name, $contact_email, $contact_celular, $contact_company);
            }
           

           echo $respuesta;


           /*
           foreach($answer as $row)
           {
                $respuesta = $row['IdEvento'];
           }

           echo $respuesta;
           */

           break;
   }
   

?>