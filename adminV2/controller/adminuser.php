<?php
   require_once("../config/conexion.php");
   require_once("../models/adminusers.php");

   $userAdmin = new UserAdmin();
   $opcion = filter_input(INPUT_POST, 'Opc');

   if ($opcion ==""){
    $opcion = filter_input(INPUT_POST, 'txtAccion');
   }

    if (strlen($opcion) == 0)
    {
         $opcion = filter_input(INPUT_POST, 'txtAccion');
    }

   switch ($opcion) {

     case 'ConsultarUsuariosAplicacion':
        $Allusers = $userAdmin->get_allusersapp();


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
            $table .= "<td>".strtoupper($row["coduser"])."</td>";
            $table .= "<td>".$row["idnumber_user"]."</td>";
            $table .= "<td>".strtoupper($row["name_user"])."</td>";
            $table .= "<td>".strtolower($row["email_user"])."</td>";
            $table .= "<td>".$row["phone_user"]."</td>";
            $table .= "<td>".$row["state_user"]."</td>";
            $table .= "<td><button type='button' class='btn btn-info' onClick='editar(&#39".$row['coduser']."&#39)'><i class='fa fa-edit'></i></button>";
            #$table .= "<button type='button' class='btn btn-danger' onClick='eliminar('".$row["coduser"]."')'><i class='fa fa-trash'></i></button></td>";
            $table .= "</tr>";

        }

        $table .="</tbody>";
        $table .= "</table>";
        echo $table;
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

        $filephoto = filter_input(INPUT_POST,'txtccname');

        if ($filephoto == "")
        {
            $filephoto = "../view/users/Images/IMGPERFIL_".$usuario.".jpg";
            unlink($filephoto);
        }

        $idperfil = filter_input(INPUT_POST,'lstperfiles');

        $Allusers = $userAdmin ->update_user($usuario, $identificacion,$NombreCompleto,$Nombre,$Apellido,$fechaBirthday,$email,$Company,$telefono,$Celular,$SitioWeb,
        $Direccion,$Cargo ,$Notas,$Password,$state_user, $usuario, $idperfil);
       
        echo $Allusers;




       break;
   }

?>
