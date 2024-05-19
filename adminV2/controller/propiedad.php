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

    case "MostrarFechasPropiedad": 

        $idPropiedad = $_POST['id'];
        $fechasPropiedad =  $userPropiedad->get_fechasporpropiedad($idPropiedad);
        if (!empty($fechasPropiedad)) {
            foreach ($fechasPropiedad as $row) {
                $data[] = array(
                    'id'    => $row["id"],
                    'start' => $row["startEvent"],
                    'end'   => $row["endEvent"]
                );
            }
        
            echo json_encode($data);
        } 

        break;

    case "MostrarFechasPropiedadestbl":

        $result = "ERROR";
        $idPropiedad = $_POST['id'];
        $fechasPropiedad =  $userPropiedad->get_fechasporpropiedad($idPropiedad);

        
        
        $table = "<table id='tblFechas' class='table table-striped table-bordered' style='width:100%'>";
        $table .= " <thead> ";
        $table .= "  <th>Id</th>";
        $table .= "  <th>fecha Inicial</th>";
        $table .= "  <th>Fecha Final</th>";
        $table .= "  <th>Acción</th>";
        $table .= " </thead>";
        $table .= " <tbody>";

        $nrofilas = 1;
        foreach($fechasPropiedad as $row)
        {   
            
            $cadenainsertar = substr($row["startEvent"],0,10)."T00:00:00?".substr($row["endEvent"],0,10)."T23:59:00" ; 
            $table .= "<tr  id='" . $nrofilas ."'>";
            #$table .= "<td>".$row["id"]."</td>";
            $table .= "<td>".$nrofilas."</td>";
            $table .= "<td>".substr($row["startEvent"],0,10)."</td>";
            $table .= "<td>".substr($row["endEvent"],0,10)."</td>";
            $table .= "<td>";
            $table .= "<input type='hidden' class='form-control' value='".$cadenainsertar."' id='txtFecha". $nrofilas ."' name='informacionFecha[]'>";
            $table .= "<button type='button' class='btn btn-danger' onclick='deleterowFecha(".$nrofilas.")'><i class='fa fa-trash'></i></button>";
            $table .= "</td>";
            $table .= "</tr>";
            $nrofilas++;
        }
        $table .= "</tbody>";
        $table .= "</table>";

        echo $table;     
            
       
        break;    
    case "CaracteristicasDiligenciadas":

        $idPropiedad = $_POST['id'];
        $AllCaracteristicasRelacionadas = $userPropiedad->get_CaracteristicasDiigenciadas($idPropiedad);

        $tableCaracteristicasDiligenciadas = "<table id='tblCaracteristicas' class='table table-striped table-bordered' style='width:100%'>";
        $tableCaracteristicasDiligenciadas .="<thead>";
        $tableCaracteristicasDiligenciadas .="<th>Id</th>";
        $tableCaracteristicasDiligenciadas .="<th>Característica</th>";
        $tableCaracteristicasDiligenciadas .="<th>Valor</th>";
        $tableCaracteristicasDiligenciadas .="<th>Acciones</th>";
        $tableCaracteristicasDiligenciadas .="</thead>";
        $tableCaracteristicasDiligenciadas .="<tbody>";

        $NroFilas = 1;
        foreach ($AllCaracteristicasRelacionadas as $caracteristica) {
            $cadenainsertar =  $caracteristica['idCaracteristica']."?". $caracteristica['ValorCaractaristica']."?".$caracteristica['aspectolegalCaracteristica'];
            $tableCaracteristicasDiligenciadas .= "<tr id='" . $NroFilas  ."'  >"; 
            $tableCaracteristicasDiligenciadas .= "<td>" . $caracteristica['idCaracteristica'] . "</td>";
            $tableCaracteristicasDiligenciadas .= "<td>" . $caracteristica['rep_description']. "</td>";
            $tableCaracteristicasDiligenciadas .= "<td>" . $caracteristica['ValorCaractaristica']. "</td>";
            $tableCaracteristicasDiligenciadas .= "<td>" . $caracteristica['aspectolegalCaracteristica']. "</td>";
            $tableCaracteristicasDiligenciadas .= "<td>";
            $tableCaracteristicasDiligenciadas .= "<button type='button' class='btn btn-danger' onClick='deleterowCaracteristica(" . $NroFilas . ")'><i class='fa fa-trash'></i></button>";
            $tableCaracteristicasDiligenciadas .= "<input type='hidden' class='form-control' value='". $cadenainsertar . "' id='txtcaracteristica" . $NroFilas . "' name='informacioncaracteristica[]'>"; 
            $tableCaracteristicasDiligenciadas .= "</td>";
            $tableCaracteristicasDiligenciadas .='</tr>';
            $NroFilas++;
        }    


        $tableCaracteristicasDiligenciadas .="</tbody>";
        $tableCaracteristicasDiligenciadas .="</table>";
        echo $tableCaracteristicasDiligenciadas;

        break;

    case "ConsultarCarateristicas":
        $contador = 0;
        $AllCaracteristicas = $userPropiedad->get_Caracteristicasdefiltro();
        $divCarcateristicas =  '<div class="column">';
        foreach ($AllCaracteristicas as $caracteristica) {
            // Si el contador llega a 3, cerrar la columna actual y abrir una nueva
            if ($contador == 3) {
                $divCarcateristicas .='</div><div class="column">';
                $contador = 0;
            }
            // Generar el checkbox y el campo de valor
            $divCarcateristicas .= '<label>';
            $divCarcateristicas .= '<input type="checkbox" class="caracteristica" id="checkbox_'.$caracteristica['rep_id'] .'" name="caracteristicas[]" value="' . $caracteristica['rep_id'] . '"> ' . $caracteristica['rep_description'] . '<br>';
            $divCarcateristicas .= '</label>';
            $divCarcateristicas .= ' &nbsp; <input type="text" class="valor" id="valor_checkbox_'.$caracteristica['rep_id'].'" name="valores['.$caracteristica['rep_id'].']" placeholder="" style="display:none;width:40px;background-color:#D1F2EB"><br>';
            $contador++;
        }
        $divCarcateristicas .= '</div>';
        echo $divCarcateristicas;

        break;

    case "ConsultarCaracteristicaPropiedades":
        $idPropiedad = filter_input(INPUT_POST, 'idPropiedad');
        $AllPropiedades = $userPropiedad->get_caracteristicasporpropieadesbyid($idPropiedad);
        $answer = "ERROR";
        $lst ="<ul>";
        foreach($AllPropiedades as $row)
        {
            $lst .="<li>";
            $lst .= $row['rep_description']." : " .$row['ValorCaractaristica'] ;
            $lst .="</li>";
            
        }
        
        $lst .="</ul>";
        echo $lst;
        break;

    case "ConsultarPropiedadesporid":
        
        $idPropiedad = filter_input(INPUT_POST, 'idPropiedad');
        $AllPropiedades = $userPropiedad->get_propertiesbyid($idPropiedad);
        $answer = "ERROR";


        $arr = array();

        foreach($AllPropiedades as $configurationobject)
        {
            $arr[] = array('id' => $configurationobject ['id'],
                            'titulo' => $configurationobject ['titulo'],
                            'descripcion' => $configurationobject ['descripcion'],
                            'tipo' => $configurationobject ['tipo'],
                            'codtipo' => $configurationobject ['codtipo'],
                            'codEstado' => $configurationobject ['codEstado'],
                            'Objetivo' => $configurationobject ['Objetivo'],
                            'moneda' => $configurationobject ['moneda'],
                            'PrecioVenta'=> $configurationobject ['PrecioVenta'],
                            'PrecioMes'=> $configurationobject ['PrecioMes'],
                            'PrecioDia'=> $configurationobject ['PrecioDia'],
                            'preciodiata'=> $configurationobject ['preciodiata'],
                            'preciomesta'=> $configurationobject ['preciomesta'],
                            'pais'=> $configurationobject ['pais'],
                            'nombrepais'=> $configurationobject ['nombre_pais'],
                            'departamento'=> $configurationobject ['departamento'],
                            'nombredepartamento'=> $configurationobject ['nombre_departamento'],
                            'ciudad'=> $configurationobject ['ciudad'],
                            'nombreciudad'=> $configurationobject ['nombre_ciudad'],
                            'ubicacion'=> $configurationobject ['ubicacion'],
                            'barrio'=> $configurationobject ['barrio'],
                            'sector'=> $configurationobject ['sector'],
                            'url_foto_principal'=> $configurationobject ['url_foto_principal'],
                            'url_video'=> $configurationobject ['url_video'],
                            'seo'=> $configurationobject ['SEO']

            );
        }

        echo json_encode($arr).'';

        break;

     case 'ConsultarPropiedadesxUsuario':
        $usuarioConsulta = $_SESSION['coduser'];
        $AllPropiedades = $userPropiedad->get_allpropertiesbyUser($usuarioConsulta);
        $propiedad = "";
        $propiedad .="<table id='tblPropiedadesrelacionadas' class='table table-striped table-bordered dataTable no-footer' style='width:100%' role='grid' aria-describedby='datatable_info'>";
        $propiedad .=" <thead> ";
        $propiedad .=" <th>Nro. Registro</th>";
        $propiedad .=" <th>Título</th>";
        $propiedad .=" <th>Tipo</th>";
        $propiedad .=" <th>Fecha Registro</th>";
        $propiedad .=" <th>Estado Aprobación</th>";
        $propiedad .=" <th>Estado Propiedad</th>";
        $propiedad .=" <th>Acciones</th>";
        $propiedad .=" </thead>";
        $propiedad .=" <tbody>";

        foreach($AllPropiedades as $row)
        {
            $propiedad .="<tr>";
            $propiedad .="<td>".$row['id']."</td>";
            $propiedad .="<td>".$row['titulo']."</td>";
            $propiedad .="<td>".$row['tipo']."</td>";
            $propiedad .="<td>".$row['fecha_alta']."</td>";
            $propiedad .="<td>".$row['dardealta']."</td>";
            $propiedad .="<td>".$row['estado']."</td>";
            
            $propiedad .="<td><a style='width:40px' class='btn btn-primary form-control' href='propiedades.php?id=".$row["id"]."'><i class='fa fa-edit'></i></a>";
             if ($row['estado'] == "ACTIVA")
            {
                $propiedad .="<button class='btn btn-warning form-control' onClick='ActualizarEstadoPropiedad(&#039;".$row["id"]."&#039;,0)' title='Desactivar' style='width:40px'><i class='fa fa-close'></i></button>";    
            } else {
                $propiedad .="<button class='btn btn-success form-control' onClick='ActualizarEstadoPropiedad(&#039;".$row["id"]."&#039;,1)' title='Activar' style='width:40px'><i class='fa fa-check-square-o'></i></button>";    
            }
            $propiedad .=" <button class='btn btn-danger form-control' onClick='ConfirmDialogDelete(&#039;".$row["id"]."&#039;)' title='Eliminar Propiedad' style='width:40px'><i class='fa fa-trash'></i></button>";
            $propiedad .="</td>";
            $propiedad .="</tr>";
        }
        $propiedad .=" </tbody>";
        $propiedad .="</table>";
        echo $propiedad;

        break;

     case 'ConsultarPropiedades':
        $AllPropiedades = $userPropiedad->get_allproperties();
        $propiedad = "";
        foreach($AllPropiedades as $row)
        {

            $propiedad .="<div class='col-md-4'>";
            $propiedad .="<article class='aa-properties-item'>";
            $propiedad .= " <a href='properties-detail.html?id=".$row["id"]."'  class='aa-properties-item-img'>";
            $propiedad .= "           <img src='adminV2/view/peliculas/uploads/".$row["url_foto_principal"]."' alt='img'>";
            $propiedad .= "         </a>";
            if ($row["Objetivo"] == 1)
            {
                $propiedad .="    <div class='aa-tag for-rent'>";
                $propiedad .="".$row["objetivopropiedad"]."";
                $propiedad .="    </div>";
            } else 
            {
                $propiedad .="    <div class='aa-tag for-sale'>";
                $propiedad .="".$row["objetivopropiedad"]."";
                $propiedad .="    </div>";
            }
            $propiedad .= "         <div class='aa-properties-item-content'>";
            #$propiedad .= "           <div class='aa-properties-info'>";
            #$propiedad .= "             <span>5 Habitaciones</span>";
            #$propiedad .= "             <span>2 Camas</span>";
            #$propiedad .= "             <span>3 Baños</span>";
            #$propiedad .= "             <span>1100 M2</span>";
            #$propiedad .= "           </div>";
            $propiedad .= "           <div class='aa-properties-about'>";
            $propiedad .= "             <h3><a href='properties-detail.html?id=".$row["id"]."' >".$row["titulo"]."</a></h3>";
            $propiedad .= "             <p>".$row["descripcion"]."</p>                      ";
            $propiedad .= "           </div>";
            $propiedad .= "           <div class='aa-properties-detial'>";
            $propiedad .= "             <span class='aa-price'>";
            if ($row["Objetivo"] == 1)
            {
                $propiedad .= "               $".number_format($row["PrecioDia"], 0, ',', '.')."<strong style='font-size:0.6em'>/Noche</strong><br> ";
                $propiedad .= "               $".number_format($row["PrecioMes"], 0, ',', '.')."<strong style='font-size:0.6em'>/Mes</strong><br> ";
            } else 
            {
                $propiedad .= "               $".number_format($row["PrecioVenta"], 0, ',', '.')." ";

            }
            
            $propiedad .= "             </span>";
            $propiedad .= "             <a href='properties-detail.html?id=".$row["id"]."' class='aa-secondary-btn'>Ver detalles</a>";
            $propiedad .= "           </div>";
            $propiedad .= "         </div>";
            $propiedad .= "</article>";
            $propiedad .= "</div>";

        }
        echo $propiedad; 
        break;
    
    case 'ConsultarPropiedadesCatalogo':
            $AllPropiedades = $userPropiedad->get_allproperties();
            $propiedad = "";
            foreach($AllPropiedades as $row)
            {

                $propiedad .= "<li>";
                $propiedad .="  <article class='aa-properties-item'>";
                $propiedad .="    <a class='aa-properties-item-img' href='properties-detail.html?id=".$row["id"]."' >";
                $propiedad .="        <img src='adminV2/view/peliculas/uploads/".$row["url_foto_principal"]."' alt='img'>";
                $propiedad .="    </a>";
                $propiedad .="          <span class='aa-price'>";
                if ($row["Objetivo"] == 1)
                {
                    $propiedad .="    <div class='aa-tag for-rent'>";
                    $propiedad .="".$row["objetivopropiedad"]."";
                    $propiedad .="    </div>";
                } else 
                {
                    $propiedad .="    <div class='aa-tag for-sale'>";
                    $propiedad .="".$row["objetivopropiedad"]."";
                    $propiedad .="    </div>";
                }
                $propiedad .="    <div class='aa-properties-item-content'>";
                #$propiedad .="       <div class='aa-properties-info'>";
                #$propiedad .="            <span>5 Habitaciones</span>";
                #$propiedad .="            <span>2 Camas</span>";
                #$propiedad .="            <span>3 Baños</span>";
                #$propiedad .="            <span>1100 M2</span>";
                #$propiedad .="       </div>";
                $propiedad .="       <div class='aa-properties-about'>";
                $propiedad .="          <h3><a href='properties-detail.html?id=".$row["id"]."' >".$row["titulo"]."</a></h3>";
                $propiedad .="          <p>".$row["descripcion"]."</p> "; #Falta Adicionar la fecha de disponibilidad
                $propiedad .="       </div>";
                $propiedad .="       <div class='aa-properties-detial'>";
                $propiedad .="          <span class='aa-price'>";
                if ($row["Objetivo"] == 1)
                {
                    $propiedad .= "               $".number_format($row["PrecioDia"], 0, ',', '.')."<strong style='font-size:0.6em'>/Noche</strong><br> ";
                    $propiedad .= "               $".number_format($row["PrecioMes"], 0, ',', '.')."<strong style='font-size:0.6em'>/Mes</strong><br> ";
                } else 
                {
                    $propiedad .= "               $".number_format($row["PrecioVenta"], 0, ',', '.')." ";

                }
                $propiedad .="          </span>";
                $propiedad .="          <a class='aa-secondary-btn' href='properties-detail.html?id=".$row["id"]."'>Ver Detalles</a>";
                $propiedad .="      </div>";
                $propiedad .="    </div>";
                $propiedad .="</article>";
                $propiedad .="</li>";
            }
            echo $propiedad; 
            break;
    case 'ConsultarTipoPropiedades':

        $AllPropiedades = $userPropiedad->get_alltypes();
        $tipopropiedad = "";
        $tipopropiedad = "<select class='form-control' id='lstselect' name = 'lstselect'>";
        $tipopropiedad .= "<option value='NA'>SELECCIONE TIPO ...</option>";
        foreach($AllPropiedades as $row)
        {
            
            $tipopropiedad .= "<option value='".$row['id']."'>".$row['nombre_tipo']."</option>";
        }
        $tipopropiedad .= "</select>";

        echo $tipopropiedad;
        
        break;

     case 'ConsultarUsuariosAdmin':
       // code...
          $Allusers = $userAdmin->get_allactiveuseradmin();


          $table = "<table id='tblusuariosadmon' class='table table-striped table-bordered' style='width:100%'>";
          $table .="<thead>";
          $table .="<tr><th>Usuario</th>";
          $table .="<th>Id Num</th>";
          $table .="<th>Nombre</th>";
          $table .="<th>Email</th>";
          $table .="<th>Telefono</th>";
          $table .="<th>Estado</th>";
          $table .="<th>Acciones</th>";
          $table .="</tr>";
          $table .="</thead>";
          $table .="<tbody>";


          foreach($Allusers as $row)
          {

              $table .= "<tr>";
              $table .= "<td>".$row["coduser"]."</td>";
              $table .= "<td>".$row["idnumber_user"]."</td>";
              $table .= "<td>".$row["name_user"]."</td>";
              $table .= "<td>".$row["email_user"]."</td>";
              $table .= "<td>".$row["phone_user"]."</td>";
              $table .= "<td>".$row["state_user"]."</td>";
              $table .= "<td><button type='button' class='btn btn-info' onClick='editar('".$row["coduser"]."')'><i class='fa fa-edit'></i></button>";
              $table .= "<button type='button' class='btn btn-danger' onClick='eliminar('".$row["coduser"]."')'><i class='fa fa-trash'></i></button></td>";
              $table .= "</tr>";

          }

          $table .="</tbody>";
          $table .= "</table>";
          echo $table;
       break;

    case 'ConsultarUsuario':
       
       $coduser = filter_input(INPUT_POST, 'usercode');

       $Allusers = $userAdmin ->get_user($coduser);

       $direccionUsario = "";


       $arr = array();

       foreach($Allusers as $productobject)
       {
           
           $pos = strpos($productobject ['address'],"?");
            if ($pos === false) {
                $direccionUsario =  explode("?",'BOGOTA?BOGOTA');
            } else {
                $direccionUsario =  explode("?",$productobject ['address']);     
            }

           
           
           $arr[] = array('codigo' => $productobject ['coduser'],
                          'identificacion' => $productobject ['idnumber_user'],
                          'NombreCompleto' => $productobject ['name_user'],
                          'Nombres' => $productobject ['nombres'],
                          'Apellidos' => $productobject ['apellidos'],
                          'Birthday' => $productobject ['datebday'],
                          'email' => $productobject ['email_user'],
                          'Empresa' => $productobject ['company'],
                          'telefono' => $productobject ['phone'],
                          'celular' => $productobject ['phone_user'],
                          'url' => $productobject ['url'],
                          'direccion'=>$direccionUsario[0],
                          'Ciudad'=>$direccionUsario[1],
                          'cargo' => $productobject ['jobtittle'],
                          'notas' => $productobject ['notes'],
                          'pwduser' => $productobject ['pass_user'],
                          'estado' => $productobject ['state_user'],
                          'idperfil' => $productobject ['idperfil'],
           );
       }

       echo json_encode($arr).'';

       break;

    case "EliminarPropiedad": 
        $id = filter_input (INPUT_POST, 'id');
        $result = $userPropiedad->delete_property($id);
        if ($result["success"]) {
            echo $result["message"];
        } else {
            // Se produjo un error
            $errorCode = $result["errorCode"];
            $errorDescription = $result["errorDescription"];
            echo "ERROR $errorCode: $errorDescription";
        }

        break;



        break;
    case "ActualizarEstadoPropiedad": 
        $idPropiedad = filter_input(INPUT_POST, 'id');
        $idEstado = filter_input(INPUT_POST, 'estado');

        $resultEstado =  $userPropiedad->push_updatestateproperty($idPropiedad, $idEstado);

        echo $resultEstado;

        
        break;

    case "ConsultarItemGallery":
        $idPropiedad = filter_input(INPUT_POST,'idPropiedad');
        $resultEstado =  $userPropiedad->get_itemgallery($idPropiedad);

        $gallery = "<div class='row text-center text-lg-start'>";

       foreach($resultEstado as $row)
       {
                $gallery .="<div class='col-lg-3 col-md-4 col-6'>";
                $gallery .="<div class='d-block mb-4 h-100'>";
                $gallery .="<img class='img-fluid img-thumbnail gallery-image' onclick='bigimage(this)' src='uploads/".$row['nombreFoto']."' alt=''>";
                $gallery .="</div>";
                $gallery .="</div>";
       }
       $gallery .= "</div>";
       echo $gallery;
        
       break;

    case "ConsultarItemGalleryPrincipal":
        $idPropiedad = filter_input(INPUT_POST, 'idPropiedad');
        $resultEstado = $userPropiedad->get_itemgallery($idPropiedad);
        
        $gallery = "";
        
        $cont = 1;
        $cont_grande = 1;
        $col = 1;
        
        foreach ($resultEstado as $row) {

            
            if ($cont == $cont_grande)
            {
                $gallery .= "<div class='row'>"; 
                $gallery .= "   <div class='col-md-12' >";
                $gallery .= "       <img src='./adminV2/view/peliculas/uploads/" . $row['nombreFoto'] . "' alt='' class='img-fluid' style='max-width:100%'>";
                $gallery .= "   </div>";
                $gallery .= "</div>"; #Cierra Fila
                $cont_grande = $cont_grande + 3;    
                $col = 1;
            } else 
            {   
                if ($col == 1)
                {
                    $gallery .= "<div class='row'>"; 
                }
                
                if ($col == 1)
                {
                    $gallery .= "<div class='col-md-6' style='padding-right:0%'>";
                }    
                else 
                {
                    $gallery .= "<div class='col-md-6' style='padding-left:0%'>";
                }
                $gallery .= "<img src='./adminV2/view/peliculas/uploads/" . $row['nombreFoto'] . "' alt='' class='img-fluid' style='max-width:100%; '>";
                $gallery .= "</div>"; 
                if ($col == 2)
                {
                    $gallery .= "</div>";    
                    $col = 1;
                }    

                $col=2;
                
            }
            $cont++;
            
           

        }
        
        echo $gallery;
        
        
        
        break;        

    case "ConsultarGalleriadetallepropiedad":
        $idPropiedad = filter_input(INPUT_POST, 'idPropiedad');
        $resultEstado = $userPropiedad->get_itemgallery($idPropiedad);
        
        $gallery = "";
        $cont = 1;
        
        foreach ($resultEstado as $row) {
            if ($cont % 2 == 1) {
                // Iniciar una nueva fila
                $gallery .= "<div class='row row-cols-2'>";
            }
        
            // Agregar la imagen
            $gallery .= "<div class='col-md-6' style='padding:1%'>";
            $gallery .= "<img class='img-fluid img-responsive' src='./adminV2/view/peliculas/uploads/" . $row['nombreFoto'] . "' alt='Imagen 1' style='width:100%; max-height:210px' onclick='bigimage(this)'>";
            $gallery .= "</div>";
        
            if ($cont % 2 == 0 || $cont == count($resultEstado)) {
                // Cerrar la fila
                $gallery .= "</div>";
        
                // Agregar el enlace si es la cuarta imagen
                if ($cont == 4) {
                   
                    break;
                }
            }
        
            $cont++;
        }
        $gallery .= "<div class='row row-cols-2'>";
        $gallery .= "<a href='#' class='btn btn-primary' onclick='Mostrargaleria()'  data-bs-toggle='modal' data-bs-target='#myModal' style='width:100%'>&nbsp; <i class='fa fa-camera'></i>&nbsp; Ver todas las fotos</a>";
        $gallery .= "</div>";
        echo $gallery;
        break;        

    case 'CreateUser':

        $usuario = filter_input(INPUT_POST,'txtUsuario');
        $identificacion = filter_input(INPUT_POST,'txtID');
        $Nombre = filter_input(INPUT_POST,'txtNombre');
        $Apellido = filter_input(INPUT_POST,'txtApellido');
        $NombreCompleto = $Nombre . " " .$Apellido;
        $fechaBirthday = filter_input(INPUT_POST,'txtbday');
        $email = filter_input(INPUT_POST,'txtEmail');
        $Company = filter_input(INPUT_POST,'txtorganization');
        $telefono = filter_input(INPUT_POST,'txtphone');
        $Celular = filter_input(INPUT_POST,'txtcellphone');
        $SitioWeb = filter_input(INPUT_POST,'txturl');
        $Direccion = filter_input(INPUT_POST,'txtAddress');
        $Ciudad =  filter_input(INPUT_POST,'txtCiudad');
        if ($Ciudad == "")
        {
            $Ciudad = "Bogota";
        }

        $Direccion = $Direccion . "?" . $Ciudad;
        $Cargo = filter_input(INPUT_POST,'txtTitle');
        $Notas = filter_input(INPUT_POST,'txtNotes');
        $Password = filter_input(INPUT_POST,'txtpwd');
        $state_user="A";      
        
        $idperfil = filter_input(INPUT_POST,'lstperfiles');
        
        $Allusers = $userAdmin ->create_user($usuario, $identificacion,$NombreCompleto,$Nombre,$Apellido,$fechaBirthday,$email,$Company,$telefono,$Celular,$SitioWeb,
        $Direccion,$Cargo ,$Notas,$Password,$state_user, $usuario, $idperfil);
       
        echo $Allusers;

        break;

      default:

        #Process of recording the property from scratch

        # 1. Storage of global property data.

        $titulo = filter_input(INPUT_POST,'txttituloPropiedad');
        $descripcion= filter_input(INPUT_POST,'DescripcionPropiedad');
        $tipo= filter_input(INPUT_POST,'lstselectTipoPropiedad');        
        $objetivo = filter_input(INPUT_POST,'lstObjetivoPropiedad');        
        $estado = filter_input(INPUT_POST,'lstestadoPropiedad');
        $moneda = filter_input(INPUT_POST,'txtmoneda');
        $txtprecioVenta =  filter_input(INPUT_POST,'txtprecioVenta');
        $txtprecioDia = filter_input(INPUT_POST,'txtprecioDia');
        $txtprecioMes = filter_input(INPUT_POST,'txtprecioMes');
        $pais = 1; 
        $ciudad = 149; 
        $ubicacion = 'Calle 185 No. 45 - 03';
        $barrio = 'Mirandela'; 
        $sector = 'Suba'; 
        $url_foto_principal= filter_input(INPUT_POST,'txtImagenPrincipalName');
        $propietario =  $_SESSION['coduser'] ;  
        $etiquetasseo = filter_input(INPUT_POST,'txtEtiquetasSeo');
        $txtprecioDiaTA = filter_input(INPUT_POST,'txtprecioDia-ta');
        $txtprecioMesTA = filter_input(INPUT_POST,'txtprecioMes-ta');
        $urlvideo = filter_input(INPUT_POST,'txtVideoPropiedad');
        $CostoAdicional = '0';
        $ObsAprobacion= 'NA';
        $departamento = 11;
        $idPropiedad = filter_input(INPUT_POST,'idPropiedad');


        if ($idPropiedad !="")
        {

                    $respuestaProceso = "";
                    $Property= $userPropiedad ->update_property($titulo,$descripcion,$tipo, $objetivo, $estado,$moneda,
                    $txtprecioVenta,$txtprecioDia,$txtprecioMes,$pais, $ciudad,$ubicacion,$barrio,$sector,$url_foto_principal,
                    $propietario,$etiquetasseo,$txtprecioDiaTA, $txtprecioMesTA,$urlvideo,$CostoAdicional,$ObsAprobacion,$departamento, $idPropiedad);
                    
                    if ($Property["success"]) {
                        $respuestaProceso =  $Property["message"];
                    } else {
                        // Se produjo un error
                        $errorCode = $Property["errorCode"];
                        $errorDescription = $Property["errorDescription"];
                        $respuestaProceso = "ERROR $errorCode: $errorDescription";
                    }

                   
                    echo $respuestaProceso;
                    
        } else {

                    $Property= $userPropiedad ->create_property($titulo,$descripcion,$tipo, $objetivo, $estado,$moneda,
                    $txtprecioVenta,$txtprecioDia,$txtprecioMes,$pais, $ciudad,$ubicacion,$barrio,$sector,$url_foto_principal,
                    $propietario,$etiquetasseo,$txtprecioDiaTA, $txtprecioMesTA,$urlvideo,$CostoAdicional,$ObsAprobacion,$departamento);

                    $insert_id = 0;
                    foreach($Property as $row)
                    {
                        $insert_id = $row['inserted_id'];
                    }    
                


                    #echo var_dump($Property);
                    # 5. Gallery
                    $Gallery = filter_input(INPUT_POST,'txtGaleriaName');
                    $itemsGallery = explode('?',$Gallery); 
                    for ($cont = 0 ; $cont < count($itemsGallery); $cont++)
                    {
                        $respuesta = $userPropiedad->Storageitemgallery($insert_id,$itemsGallery[$cont]);
                    }

                    echo "Se ha creado correctamente la pelicula con consecutivo: " . $insert_id;
        }

        
       break;
   }

?>
