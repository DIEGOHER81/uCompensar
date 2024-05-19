<?php
   @session_start();
   require_once("../config/conexion.php");
   require_once("../models/highSeason.model.php");

   $highSeasson = new High_Seassons();
   $opcion = filter_input(INPUT_POST, 'Opc');

   
   switch ($opcion) {

        case "DeleteHighSeassonDate":
            $id = filter_input (INPUT_POST, 'id');
            $result  = $highSeasson-> Delete_peak_season_date($id);

            if ($result["success"]) {
                echo $result["message"];
            } else {
                // Se produjo un error
                $errorCode = $result["errorCode"];
                $errorDescription = $result["errorDescription"];
                echo "ERROR $errorCode: $errorDescription";
            }

            break;

        case "QueryHighSeassonDates":
            
            # Save Product...
            $result = "ERROR";
            $result = $highSeasson->get_alldates_highSeasson();

            
            if ($result["success"]) {

                $data_Result = $result["data"];
                $data = array();
                foreach($data_Result as $row)
                {
                    $data[] = array(
                    'id'    => $row["id"],
                    'start' => $row["startEvent"],
                    'end'   => $row["endEvent"]
                    );
                }
    
                $resultado_json = json_encode($data, JSON_UNESCAPED_UNICODE);
    
                if ($resultado_json !== false) {
                    // La codificación JSON fue exitosa
                    # echo "JSON codificado correctamente: $resultado_json";
                    echo $resultado_json;
                } else {
                    // Ocurrió un error durante la codificación JSON
                    $error = json_last_error();
                    switch ($error) {
                        case JSON_ERROR_NONE:
                            echo "No se produjo ningún error.";
                            break;
                        case JSON_ERROR_DEPTH:
                            echo "Se alcanzó el límite de profundidad máximo.";
                            break;
                        case JSON_ERROR_STATE_MISMATCH:
                            echo "Error de estado (mismatch) en JSON.";
                            break;
                        case JSON_ERROR_CTRL_CHAR:
                            echo "Error de carácter de control en JSON.";
                            break;
                        case JSON_ERROR_SYNTAX:
                            echo "Error de sintaxis en JSON.";
                            break;
                        case JSON_ERROR_UTF8:
                            echo "Error de caracteres UTF-8 malformados en JSON.";
                            break;
                        default:
                            echo "Error JSON desconocido: $error";
                            break;
                    }
                }
                 
                
            } else {
                // Se produjo un error
                $errorCode = $result["errorCode"];
                $errorDescription = $result["errorDescription"];
                echo "ERROR $errorCode: $errorDescription";
            }
            
            break;     

        case "QueryHighSeassonDatestbl":
            
                # Save Product...
                $result = "ERROR";
                $user = $_SESSION['coduser'];
                $result = $highSeasson->get_alldates_highSeasson($user);
    
                
                if ($result["success"]) {
                    $table = "<table id='tblFechas' class='table table-striped table-bordered' style='width:100%'>";
                    $table .= " <thead> ";
                    $table .= "  <th>Id</th>";
                    $table .= "  <th>fecha Inicial</th>";
                    $table .= "  <th>Fecha Final</th>";
                    $table .= "  <th>Acción</th>";
                    $table .= " </thead>";
                    $table .= " <tbody>";

                    $data_Result = $result["data"];
                    $nrofilas = 1;
                    foreach($data_Result as $row)
                    {   
                        
                        $cadenainsertar = substr($row["startEvent"],0,10)."T00:00:00?".substr($row["endEvent"],0,10)."T23:59:00" ; 
                        $table .= "<tr>";
                        #$table .= "<td>".$row["id"]."</td>";
                        $table .= "<td>".$nrofilas."</td>";
                        $table .= "<td>".substr($row["startEvent"],0,10)."</td>";
                        $table .= "<td>".substr($row["endEvent"],0,10)."</td>";
                        $table .= "<td>";
                        $table .= "<input type='hidden' class='form-control' value='".$cadenainsertar."' id='txtFecha". $nrofilas ."' name='informacionFecha[]'>";
                        $table .= "<button type='button' class='btn btn-danger' onClick='ConfirmDialogDelete(&#039;".$row["id"]."&#039;)'><i class='fa fa-trash'></i></button>";
                        $table .= "</td>";
                        $table .= "</tr>";
                        $nrofilas++;
                    }
                    $table .= "</tbody>";
                    $table .= "</table>";

                    echo $table;     
                    
                } else {
                    // Se produjo un error
                    $errorCode = $result["errorCode"];
                    $errorDescription = $result["errorDescription"];
                    echo "ERROR $errorCode: $errorDescription";
                }
                


                break;     
      default:
            
            $result = $highSeasson-> Delete_peak_season_dates();
            if ($result["success"]) {
                $datesProperty = $_POST['informacionFecha'];
                $fechaInicial = "";
                $fechaFinal = "";
                
                foreach ($datesProperty as $DatetoInsert)
                {
                    $conceptos = explode('?',$DatetoInsert);
                    $fechaInicial = $conceptos[0]."T00:00:00";
                    $fechaFinal = $conceptos[1]."T23:59:00";
    
                    $result = $highSeasson -> StorageDates($fechaInicial, $fechaFinal);
    
                    if ($result["success"]) {
                        // Éxito, puedes manejar la respuesta exitosa aquí.
                        $message = "";
                        $message = $result["message"];
                        #echo $message;
                    } else {
                        // Se produjo un error
                        $errorCode = $result["errorCode"];
                        $errorDescription = $result["errorDescription"];
                        echo "ERROR $errorCode: $errorDescription";
                    }
    
                }
    
                echo $message;
            } else {
                // Se produjo un error
                $errorCode = $result["errorCode"];
                $errorDescription = $result["errorDescription"];
                echo "ERROR $errorCode: $errorDescription";
            }
      
      
       break;
   }

?>
