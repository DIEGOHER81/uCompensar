<?php
   require_once("../config/conexion.php");
   require_once("../models/configuracion.model.php");

   $dataConfiguration = new AdminConfiguracion();
   $opcion = filter_input(INPUT_POST, 'Opc');

   if ($opcion == "")
   {
        $opcion = filter_input(INPUT_POST, 'txtActionPrivacidad');
   }

   if ($opcion == "")
   {
        $opcion = filter_input(INPUT_POST, 'txtterminos');
   }

   if ($opcion == "")
   {
        $opcion = filter_input(INPUT_POST, 'txtquienessomos');
   }
   
   if ($opcion == "")
   {
        $opcion = filter_input(INPUT_POST, 'txtInformacionContacto');
   }

   if ($opcion == "")
   {
        $opcion = filter_input(INPUT_POST, 'txtAdministrador');
   }


   
   

   switch ($opcion) {
    case 'txtActionPrivacidad':
        $documentoprivacidad = filter_input(INPUT_POST, 'txtPrivacidadName');
        $answer = $dataConfiguration->update_privacydocument($documentoprivacidad);
        echo $answer;
        break;
    
    case 'txtterminos':
        $documentoprivacidad = filter_input(INPUT_POST, 'txtTerminosyCondicionesName');
        $answer = $dataConfiguration->update_terminos($documentoprivacidad);
        echo $answer;
        break;
    
    case 'txtquienessomos':
        $documentoprivacidad = filter_input(INPUT_POST, 'long_desc');
        $answer = $dataConfiguration->update_quienessomos($documentoprivacidad);
        echo $answer;
        break;

    case 'txtInformacionContacto':
        

        $txtOficinaCentral = filter_input(INPUT_POST, 'txtOficinaCentral');
        $txttelefonoComercial = filter_input(INPUT_POST, 'txttelefonoComercial');
        $txtTelefonoWhatsapp = filter_input(INPUT_POST, 'txtTelefonoWhatsapp');
        $txtEmail = filter_input(INPUT_POST, 'txtEmail');
        $txtDiaInicio = filter_input(INPUT_POST, 'lstdiainicio');
        $txtHrInicio = filter_input(INPUT_POST, 'txtHorariosInicial');
        $txtDiaFinal = filter_input(INPUT_POST, 'lstdiafinal');
        $txtHrFinal = filter_input(INPUT_POST, 'txtHorariosfinal');
        $txtFacebook = filter_input(INPUT_POST, 'txtFacebook');
        $txtTwitter = filter_input(INPUT_POST, 'txtTwitter');
        $txtYoutube = filter_input(INPUT_POST, 'txtYoutube');
        $txtInstagram = filter_input(INPUT_POST, 'txtInstagram');


        $answer = $dataConfiguration->update_informacioncontacto($txtOficinaCentral, $txttelefonoComercial, $txtTelefonoWhatsapp,  $txtEmail, $txtDiaInicio, $txtHrInicio, $txtDiaFinal, $txtHrFinal  , $txtFacebook, $txtTwitter, $txtYoutube, $txtInstagram);
        echo $answer;
        break;
    

    case 'txtAdministrador':
        

        $txtNombreUsuario = filter_input(INPUT_POST, 'txtNombreUsuario');
        $txtPassword = filter_input(INPUT_POST, 'txtPassword');
        $EmailAdministrador = filter_input(INPUT_POST, 'EmailAdministrador');

        $answer = $dataConfiguration->update_administrador($txtNombreUsuario, $txtPassword, $EmailAdministrador );
        echo $answer;
        break;        

    case 'ConsultarInformacionEmpresa':
          // code...
          $answer = "ERROR";
          $codConsulta = filter_input(INPUT_POST, 'Opc');
          $answer = $dataConfiguration->get_CompanyInformation($codConsulta);
          
          $arr = array();

          foreach($answer as $configurationobject)
          {
              $arr[] = array('oficinacentral' => $configurationobject ['oficina_central'],
                              'dialphone' => $configurationobject ['dialphone'],
                              'whatsupphone' => $configurationobject ['whatsupphone'],
                              'email_contacto' => $configurationobject ['email_contacto'],
                              'diaInicio' => $configurationobject ['diaInicio'],
                              'HrInicio' => $configurationobject ['HrInicio'],
                              'diaFinal'=> $configurationobject ['diaFinal'],
                              'HrFinal'=> $configurationobject ['HrFinal'],
                              'QuienesSomos'=> $configurationobject ['QuienesSomos'],
                              'facebook'=> $configurationobject ['facebook'],
                              'twitter'=> $configurationobject ['twitter'],
                              'Youtube'=> $configurationobject ['Youtube'],
                              'useradmin'=> $configurationobject ['useradmin'],
                              'passwordadmin'=> $configurationobject ['passwordadmin'],
                              'email_administrador'=> $configurationobject ['email_administrador'],
                              'documentoprivacidad'=> $configurationobject ['documentoprivacidad'],
                              'documentoterminos'=> $configurationobject ['documentoterminos']

              );
          }

          echo json_encode($arr).'';

          break;

      case 'ConsultarCiudadesxCliente':
        // code...
            $cod = filter_input(INPUT_POST, 'cod');
          
            $AllCiudades = $userCiudad->get_allCiudadesxCliente($cod);
    
            $table  = "<select id='lstciudadcliente'  class='form-control' name='lstciudadcliente' style='width:100%'>";
            $table .= "<option value= 'NA' selected>SELECCIONE..</option>";
            foreach($AllCiudades as $row)
            {
                $table .= "<option value= '".$row["cod"]."'>".$row["descripcion"]."</option>";
            }
            $table .= "</select>";

            echo $table;

            


            break;
      case 'ConsultarCiudadesxCliente_second':
        // code...
            $cod = filter_input(INPUT_POST, 'cod');
          
            $AllCiudades = $userCiudad->get_allCiudadesxCliente($cod);
    
            $table  = "<select id='lstciudadcliente_second'  class='form-control' name='lstciudadcliente_second' style='width:100%'>";
            $table .= "<option value= 'NA' selected>SELECCIONE..</option>";
            foreach($AllCiudades as $row)
            {
                $table .= "<option value= '".$row["cod"]."'>".$row["descripcion"]."</option>";
            }
            $table .= "</select>";

            echo $table;

            


            break;      

     default:
       // code...
       break;
   }

?>