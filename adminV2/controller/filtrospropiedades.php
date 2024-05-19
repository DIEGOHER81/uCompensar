<?php
   @session_start();
   require_once("../config/conexion.php");
   require_once("../models/propiedad.php");

   $userPropiedad = new PropiedadAdmin();
   $opcion = filter_input(INPUT_POST, 'Opc');

   if ($opcion ==""){
    $opcion = filter_input(INPUT_POST, 'txtAccion');
   }

    if (strlen($opcion) == 0)
    {
         $opcion = filter_input(INPUT_POST, 'txtAccion');
    }

   #$opcion = "ConsultaFiltro";
   switch ($opcion) {

      case "":
        
       
    
      default:


            // Obtener las características seleccionadas y sus valores
            $caracteristicas = isset($_POST['caracteristicas']) ? $_POST['caracteristicas'] : array();
            $valores = isset($_POST['valores']) ? $_POST['valores'] : array();

            $tipoPropiedad = $_POST['lstselectTipoPropiedad'];
            $ObjetivoPropiedad = $_POST['lstObjetivos'];


            // Inicializar array para almacenar condiciones
            $condiciones = [];
            $condicionesAdicionales = [];

            // Verificar si $tipoPropiedad no es "NA" y agregar como condición
            if ($tipoPropiedad !== "NA") {
                $condicionesAdicionales[] = "prop.tipo = '$tipoPropiedad'";
            }

            // Verificar si $ObjetivoPropiedad no es "NA" y agregar como condición
            if ($ObjetivoPropiedad !== "NA") {
                $condicionesAdicionales[] = "prop.Objetivo = '$ObjetivoPropiedad'";
            }

           
            // Construir la parte WHERE de la consulta SQL
            $whereAdicionales = '';
            if (!empty($condicionesAdicionales)) {
                $whereAdicionales = ' AND ' . implode(' AND ', $condicionesAdicionales);
            }

            // Construir las condiciones para las características seleccionadas
            foreach ($caracteristicas as $caracteristica) {
                // Verificar si la característica tiene un valor asociado
                if (isset($valores[$caracteristica])) {
                    $valor = $valores[$caracteristica];
                    if (!empty($valor)) {
                        $condiciones[] = "(rpc.idCaracteristica = '$caracteristica' AND ValorCaractaristica = '$valor')";
                    } else {
                        $condiciones[] = "(rpc.idCaracteristica = '$caracteristica')";
                    }
                }
            }

           

            // Si hay condiciones, unirlas con "OR"
            $where = '';
            if (!empty($condiciones)) {
                $where = 'WHERE (' . implode(' OR ', $condiciones) .')';
            }

            // Construir la consulta SQL
            $sql = " SELECT DISTINCT prop.id, prop.titulo, prop.descripcion, url_foto_principal, depto.nombre_departamento, ci.nombre_ciudad
                       FROM r_propiedades_caracteristicas rpc
                      INNER JOIN real_estate_properties rep ON rep.rep_id = rpc.idCaracteristica
                      INNER JOIN propiedades prop ON prop.id = rpc.idPropiedad 
                      INNER JOIN departamentos depto ON depto.cod_departamento = prop.departamento
                      INNER JOIN ciudades ci ON ci.id = prop.ciudad AND depto.cod_departamento = ci.id_departamentos
                    $where $whereAdicionales";
            

            $respuestapropiedades = $userPropiedad->get_propiedadesporfiltro($sql);
            
            
            $listapropiedades = "<ul class='alternating-background'>";
            // Mostrar resultados
            foreach ($respuestapropiedades as $propiedad) {
                $listapropiedades .= "<li style='padding:2%'>";
                $listapropiedades .= "<div class='row'>";
                $listapropiedades .= "<div class='col-md-4' style='text-align:right'>";
                $listapropiedades .= "<img src='adminV2/view/propiedades/uploads/".$propiedad['url_foto_principal']."' alt='' style='width:100px;'>";
                $listapropiedades .= "</div>";
                $listapropiedades .= "<div class='col-md-8'>";
                $listapropiedades .= "<h4 style='color:#59abe3'>".$propiedad['titulo']."</h4><br>";
                $listapropiedades .= "<label>".$propiedad['nombre_departamento']."</label><br>";
                $listapropiedades .= "<label>".$propiedad['nombre_ciudad']."</label><br>";
                $listapropiedades .= "<a href='properties-detail.html?id=".$propiedad['id']."' class='aa-secondary-btn'>Ver detalles</a>";
                $listapropiedades .= "</div>";
                $listapropiedades .= "</div>";
                $listapropiedades .= "</li>";
            }

            $listapropiedades .= "<ul>";
            echo $listapropiedades;
            # echo $sql;
            # echo var_dump($_POST);
        
                
            break;
   }

?>
