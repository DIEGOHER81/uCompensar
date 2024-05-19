<?php
    class AdminConfiguracion extends Conectar{
        public function get_allCiudades(){

            try{
                $conectar = parent::conexion();
                $sql = "CALL admon_ciudades (0,NULL, NULL, NULL)";
                $sql = $conectar->prepare($sql);
                $sql->execute();

                return $resultado=$sql->fetchAll();
            } catch (PDOException $e)
            {
                return "Error en el momento de realizar Consulta de las ciudades. DESC Error" . $e->getMessage();

            }
            
            
        }


        public function get_allCiudadesxCliente($codcliente){

            try{
                $conectar = parent::conexion();
                $sql = "CALL admon_ciudades (1,NULL, NULL,? )";
                $sql = $conectar->prepare($sql);
                $sql -> bindValue(1,$codcliente);
                $sql->execute();
                return $resultado=$sql->fetchAll();
            } catch (PDOException $e)
            {
                return "Error en el momento de realizar Consulta de las ciudades. DESC Error" . $e->getMessage();

            }
            
            
        }
        
        public function get_CompanyInformation($opcion){

            try{
                $conectar = parent::conexion();
                $sql = "CALL GETCompanyInformation(?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);";
                $sql = $conectar->prepare($sql);
                $sql -> bindValue(1,$opcion);
                $sql->execute();
                return $resultado=$sql->fetchAll();
            } catch (PDOException $e)
            {
                return "Error en el momento de realizar Consulta de las ciudades. DESC Error" . $e->getMessage();

            }
            
            
        }


        public function update_privacydocument($documentofprivacy){

            try{
                $conectar = parent::conexion();
                $sql = "CALL GETCompanyInformation(1, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);";
                $sql = $conectar->prepare($sql);
                $sql -> bindValue(1,$documentofprivacy);
                $sql->execute();
                return "Se actualizo documento de privacidad";
            } catch (PDOException $e)
            {
                return "Error en el momento de realizar Consulta de las ciudades. DESC Error" . $e->getMessage();

            }
            
            
        }

        public function update_terminos($documentofterms){

            try{
                $conectar = parent::conexion();
                $sql = "CALL GETCompanyInformation(2, NULL, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);";
                $sql = $conectar->prepare($sql);
                $sql -> bindValue(1,$documentofterms);
                $sql->execute();
                return $resultado=$sql->fetchAll();
            } catch (PDOException $e)
            {
                return "Error en el momento de realizar Consulta de las ciudades. DESC Error" . $e->getMessage();

            }
            
            
        }

        public function update_quienessomos($quienessomos){

            try{
                $conectar = parent::conexion();
                $sql = "CALL GETCompanyInformation(3, NULL, NULL, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);";
                $sql = $conectar->prepare($sql);
                $sql -> bindValue(1,$quienessomos);
                $sql->execute();
                return $resultado=$sql->fetchAll();
            } catch (PDOException $e)
            {
                return "Error en el momento de realizar Consulta de las ciudades. DESC Error" . $e->getMessage();

            }
            
            
        }

        public function update_informacioncontacto($txtOficinaCentral, $txttelefonoComercial, $txtTelefonoWhatsapp,  $txtEmail, $txtDiaInicio, $txtHrInicio, $txtDiaFinal, $txtHrFinal  , $txtFacebook, $txtTwitter, $txtYoutube, $txtInstagram){

            try{
                $conectar = parent::conexion();
                $sql = "CALL GETCompanyInformation(4, NULL, NULL, NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NULL, NULL, NULL);";
                $sql = $conectar->prepare($sql);
                $sql -> bindValue(1,$txtOficinaCentral); 
                $sql -> bindValue(2,$txttelefonoComercial);
                $sql -> bindValue(3,$txtTelefonoWhatsapp); 
                $sql -> bindValue(4,$txtEmail); 
                $sql -> bindValue(5,$txtDiaInicio); 
                $sql -> bindValue(6,$txtHrInicio); 
                $sql -> bindValue(7,$txtDiaFinal); 
                $sql -> bindValue(8,$txtHrFinal);
                $sql -> bindValue(9,$txtFacebook); 
                $sql -> bindValue(10,$txtTwitter); 
                $sql -> bindValue(11,$txtYoutube); 
                $sql -> bindValue(12,$txtInstagram);
                
                $sql->execute();
                return $resultado=$sql->fetchAll();
            } catch (PDOException $e)
            {
                return "Error en el momento de realizar la actualización de contacto. DESC Error" . $e->getMessage();

            }
            
            
        }

        public function update_administrador($txtNombreUsuario, $txtPassword, $EmailAdministrador ){

            try{
                $conectar = parent::conexion();
                $sql = "CALL GETCompanyInformation(5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ?, ?, ?);";
                $sql = $conectar->prepare($sql);
                $sql -> bindValue(1,$txtNombreUsuario);
                $sql -> bindValue(2,$txtPassword);
                $sql -> bindValue(3,$EmailAdministrador);
                $sql->execute();
                return $resultado=$sql->fetchAll();
            } catch (PDOException $e)
            {
                return "Error en el momento de realizar actualización de administrador. DESC Error" . $e->getMessage();

            }
            
            
        }



    }
?>