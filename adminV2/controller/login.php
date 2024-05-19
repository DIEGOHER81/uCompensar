<?php
   require_once("../config/conexion.php");
   require_once("../models/Login.php");
   
   @session_start();
   
   $perfil = new AdminIngreso();
   $opcion = filter_input(INPUT_POST, 'Opc');
   
   
   if (strlen($opcion) == 0)
   {
        $opcion = filter_input(INPUT_POST, 'txtActionRegistro');
   }

   if (strlen($opcion) == 0)
   {
        $opcion = filter_input(INPUT_POST, 'txtActionIngreso');
   }

    switch ($opcion) {
       case 'ConsultarPerfilesActivos':
           $Allperfiles = $perfil->get_allperfiles();
           $select = "<select id='lstperfiles' name='lstperfiles' class='form-control'>";
           $select .= "<option value=''>Seleccione Perfil...</option>";
           foreach($Allperfiles as $row)
           {
             $select .= "<option value='".$row['id']."'>".$row['descripcion']."</option>";
           }
           $select .= "</select>";
           echo $select;
           break;
       
       case 'RealizarIngreso':

            $answer = "ERROR. Los datos Ingresados no son correctos. Revise por favor e intente nuevamente";
            $codconsultado = filter_input(INPUT_POST, 'txtcoduser');
            $pwdingresado = filter_input(INPUT_POST, 'pwdlogin');
            $perfilusuario = $_POST['lstperfiles'];
            
            if ($perfilusuario == "1"){
                $usuario = $perfil->get_useradmin($codconsultado);
            } else {
                $usuario = $perfil->get_user($codconsultado);
            }
            
            
            foreach($usuario as $row)
            {
                if ($row['pass_user'] == $pwdingresado){
                    $_SESSION['user_name'] = $row['name_user'];
                    $_SESSION['coduser'] = $codconsultado;
                    $_SESSION['perfil']= $perfilusuario;
                    $_SESSION['phone'] = $row['phone_user'];
                    $_SESSION['email'] = $row['email_user'];
                    $answer = "OK";
                } else {
                    $answer = "ERROR. La contraseña ingresada no es correcta.";
                }
            }
            
            echo $answer;

            break;

       case 'RealizarRegistro':

            $answer = "ERROR. Se ha presentado un problema en el momento del ingreso. Revise por favor e intente nuevamente";
            $codusuario = filter_input(INPUT_POST, 'RegistroCodUser');
            $identificacion = filter_input(INPUT_POST, 'RegistroIdusuario');
            $Nombres = filter_input(INPUT_POST, 'RegistroNombres');
            $apellidos = filter_input(INPUT_POST, 'RegistroApellidos');
            $correo = filter_input(INPUT_POST, 'RegistroCorreo');
            $celular = filter_input(INPUT_POST, 'RegistroCelular');
            $Password = filter_input(INPUT_POST, 'RegistroContraseña');
            $state_user = "A";
            
            $usuario = $perfil->create_user($codusuario, $identificacion, $Nombres, $apellidos, $correo, $celular, $Password, $state_user);
            
            echo $usuario;

            break;

       default:
           # code...
           break;
   }
   

?>