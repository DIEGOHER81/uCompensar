<?php
   @session_start();
   require_once("../config/conexion.php");
   require_once("../models/parametrosbasicos.php");
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

   switch ($opcion) {

     case 'ConsultarPropiedades':
        $AllPropiedades = $userPropiedad->get_allproperties();
        $propiedad = "";
        foreach($AllPropiedades as $row)
        {

            $propiedad .="<div class='col-md-4'>";
            $propiedad .="<article class='aa-properties-item'>";
            $propiedad .= " <a href='#' class='aa-properties-item-img'>";
            $propiedad .= "           <img src='adminV2/view/propiedades/docsuploaded/".$row["url_foto_principal"]."' alt='img'>";
            $propiedad .= "         </a>";
            $propiedad .= "         <div class='aa-tag for-sale'>";
            $propiedad .= "           Venta";
            $propiedad .= "         </div>";
            $propiedad .= "         <div class='aa-properties-item-content'>";
            $propiedad .= "           <div class='aa-properties-info'>";
            $propiedad .= "             <span>5 Habitaciones</span>";
            $propiedad .= "             <span>2 Camas</span>";
            $propiedad .= "             <span>3 Baños</span>";
            $propiedad .= "             <span>1100 M2</span>";
            $propiedad .= "           </div>";
            $propiedad .= "           <div class='aa-properties-about'>";
            $propiedad .= "             <h3><a href='#'>".$row["titulo"]."</a></h3>";
            $propiedad .= "             <p>".$row["descripcion"]."</p>                      ";
            $propiedad .= "           </div>";
            $propiedad .= "           <div class='aa-properties-detial'>";
            $propiedad .= "             <span class='aa-price'>";
            $propiedad .= "               ".$row["precio"]." ";
            $propiedad .= "             </span>";
            $propiedad .= "             <a href='properties-detail.html' class='aa-secondary-btn'>Ver detalles</a>";
            $propiedad .= "           </div>";
            $propiedad .= "         </div>";
            $propiedad .= "</article>";
            $propiedad .= "</div>";

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
        /*
        $titulo = filter_input(INPUT_POST,'txttituloPropiedad');
        $descripcion= filter_input(INPUT_POST,'DescripcionPropiedad');
        $tipo= filter_input(INPUT_POST,'lsttipoPropiedad');
        $estado = filter_input(INPUT_POST,'lstestadoPropiedad');
        $ubicacion = filter_input(INPUT_POST,'address');
        $precio = filter_input(INPUT_POST,'txtprecio');
        $moneda = filter_input(INPUT_POST,'txtmoneda');
        $url_foto_principal= filter_input(INPUT_POST,'txtImagenPrincipalName');
        $pais = filter_input(INPUT_POST,'lstPais'); 
        $ciudad = filter_input(INPUT_POST,'lstCiudad'); 
        $propietario =  $_SESSION['coduser'] ;  

        $Property= $userPropiedad ->create_property($titulo,$descripcion,
        $tipo, $estado, $ubicacion, $precio, $moneda, $url_foto_principal,
        $pais,$ciudad, $propietario);
       
        echo $Property;
        */



       break;
   }

?>
