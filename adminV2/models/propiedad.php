<?php
    class PropiedadAdmin extends Conectar{


        public function get_CaracteristicasDiigenciadas($idPropiedad)
        {

            try{
                $conectar = parent::conexion();
                $sql = "CALL Admin_Caracteristicas_Propiedades(0, ?, NULL, NULL, NULL);";
                $sql = $conectar->prepare($sql);
                $sql -> bindvalue(1,$idPropiedad,PDO ::PARAM_STR);
                $sql->execute();
                return $resultado=$sql->fetchAll();
            } catch (PDOException $e)
            {
                return "Error en el momento de realizar Consulta de las características. DESC Error" . $e->getMessage();

            }
        }

        public function get_Caracteristicasdefiltro(){

            try{
                $conectar = parent::conexion();
                $sql = "CALL Admin_Caracteristicas_Propiedades(4, NULL, NULL, NULL, NULL);";
                $sql = $conectar->prepare($sql);
                $sql->execute();
                return $resultado=$sql->fetchAll();
            } catch (PDOException $e)
            {
                return "Error en el momento de realizar Consulta de las características. DESC Error" . $e->getMessage();

            }
            
            
        }


        public function get_propiedadesporfiltro($querysql){

            try{
                $conectar = parent::conexion();
                $sql = $querysql;
                $sql = $conectar->prepare($sql);
                $sql->execute();
                return $resultado=$sql->fetchAll();
            } catch (PDOException $e)
            {
                return "Error en el momento de realizar Consulta de las propieades por filtro. DESC Error" . $e->getMessage();

            }
            
            
        }




        public function update_property($titulo,$descripcion,$tipo, $objetivo, $estado,$moneda,
        $txtprecioVenta,$txtprecioDia,$txtprecioMes,$pais, $ciudad,$ubicacion,$barrio,$sector,$url_foto_principal,
        $propietario,$etiquetasseo,$txtprecioDiaTA, $txtprecioMesTA,$urlvideo,$CostoAdicional,$ObsAprobacion,$departamento, $idPropiedad)
        {

            $conectar = parent::Conexion();

            try {

                $sql ="CALL Admin_realestate_property (4,?,NULL,NULL,NULL,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,@insert_id);";
                
                $sql = $conectar->prepare($sql);
                $sql -> bindvalue(1,$idPropiedad,PDO ::PARAM_STR);
                $sql -> bindvalue(2,$titulo,PDO ::PARAM_STR);
                $sql -> bindvalue(3,$descripcion,PDO ::PARAM_STR);
                $sql -> bindvalue(4,$tipo,PDO ::PARAM_STR);
                $sql -> bindvalue(5,$objetivo,PDO ::PARAM_STR);
                $sql -> bindvalue(6,$estado,PDO ::PARAM_STR);
                $sql -> bindvalue(7,$moneda,PDO ::PARAM_STR);
                $sql -> bindvalue(8,$txtprecioVenta,PDO ::PARAM_STR);
                $sql -> bindvalue(9,$txtprecioDia,PDO ::PARAM_STR);
                $sql -> bindvalue(10,$txtprecioMes,PDO ::PARAM_STR);
                $sql -> bindvalue(11,$pais,PDO ::PARAM_STR);
                $sql -> bindvalue(12,$ciudad,PDO ::PARAM_STR);
                $sql -> bindvalue(13,$ubicacion,PDO ::PARAM_STR);
                $sql -> bindvalue(14,$barrio,PDO ::PARAM_STR);
                $sql -> bindvalue(15,$sector,PDO ::PARAM_STR);
                $sql -> bindvalue(16,$url_foto_principal,PDO ::PARAM_STR);
                $sql -> bindvalue(17,$propietario,PDO ::PARAM_STR);
                $sql -> bindvalue(18,$etiquetasseo,PDO ::PARAM_STR);
                $sql -> bindvalue(19,$txtprecioDiaTA,PDO ::PARAM_STR);
                $sql -> bindvalue(20,$txtprecioMesTA,PDO ::PARAM_STR);
                $sql -> bindvalue(21,$urlvideo,PDO ::PARAM_STR);
                $sql -> bindvalue(22,$CostoAdicional,PDO ::PARAM_STR);
                $sql -> bindvalue(23,$ObsAprobacion,PDO ::PARAM_STR);
                $sql -> bindvalue(24,$departamento,PDO ::PARAM_STR);

                $sql->execute();
           
                return array(
                    "success" => true,
                    "message" => "Se ha actualizado correctamente la propiedad"
                );
                

            }catch (PDOException $e)
            {
                // Ocurrió un error
                $errorCode = $e->getCode(); // Código de error
                $errorDescription = $e->getMessage(); // Descripción del error

                // Puedes registrar el error en un archivo de registro o mostrar un mensaje de error al usuario.
                // También puedes devolver el código y la descripción del error como una respuesta si es necesario:

                return array(
                    "error" => true,
                    "errorCode" => $errorCode,
                    "errorDescription" => $errorDescription
                );
             
            }
        }


        public function create_property($titulo,$descripcion,$tipo, $objetivo, $estado,$moneda,
        $txtprecioVenta,$txtprecioDia,$txtprecioMes,$pais, $ciudad,$ubicacion,$barrio,$sector,$url_foto_principal,
        $propietario,$etiquetasseo,$txtprecioDiaTA, $txtprecioMesTA,$urlvideo,$CostoAdicional,$ObsAprobacion,$departamento)
        {

            $conectar = parent::Conexion();

            try {

                $sql ="CALL Admin_realestate_property (2,NULL,NULL,NULL,NULL,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,@insert_id);";
                
                $sql = $conectar->prepare($sql);
                $sql -> bindvalue(1,$titulo,PDO ::PARAM_STR);
                $sql -> bindvalue(2,$descripcion,PDO ::PARAM_STR);
                $sql -> bindvalue(3,$tipo,PDO ::PARAM_STR);
                $sql -> bindvalue(4,$objetivo,PDO ::PARAM_STR);
                $sql -> bindvalue(5,$estado,PDO ::PARAM_STR);
                $sql -> bindvalue(6,$moneda,PDO ::PARAM_STR);
                $sql -> bindvalue(7,$txtprecioVenta,PDO ::PARAM_STR);
                $sql -> bindvalue(8,$txtprecioDia,PDO ::PARAM_STR);
                $sql -> bindvalue(9,$txtprecioMes,PDO ::PARAM_STR);
                $sql -> bindvalue(10,$pais,PDO ::PARAM_STR);
                $sql -> bindvalue(11,$ciudad,PDO ::PARAM_STR);
                $sql -> bindvalue(12,$ubicacion,PDO ::PARAM_STR);
                $sql -> bindvalue(13,$barrio,PDO ::PARAM_STR);
                $sql -> bindvalue(14,$sector,PDO ::PARAM_STR);
                $sql -> bindvalue(15,$url_foto_principal,PDO ::PARAM_STR);
                $sql -> bindvalue(16,$propietario,PDO ::PARAM_STR);
                $sql -> bindvalue(17,$etiquetasseo,PDO ::PARAM_STR);
                $sql -> bindvalue(18,$txtprecioDiaTA,PDO ::PARAM_STR);
                $sql -> bindvalue(19,$txtprecioMesTA,PDO ::PARAM_STR);
                $sql -> bindvalue(20,$urlvideo,PDO ::PARAM_STR);
                $sql -> bindvalue(21,$CostoAdicional,PDO ::PARAM_STR);
                $sql -> bindvalue(22,$ObsAprobacion,PDO ::PARAM_STR);
                $sql -> bindvalue(23,$departamento,PDO ::PARAM_STR);

                $sql->execute();
           
                $sql ="SELECT @insert_id AS inserted_id";
                $sql = $conectar->prepare($sql);
                $sql->execute();
                return $resultado=$sql->fetchAll();

                

            }catch (PDOException $e)
            {
                #Error
                return "Error en el momento de realizar la actualización del cliente indicado. DESC Error" . $e->getMessage();
            }
        }
        
        public function delete_property ($idProperty)
        {

            try
            {

                $conectar = parent::conexion();
                $sql = "CALL Admin_realestate_property (7,?,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,@insert_id);";
                $sql = $conectar->prepare($sql);
                $sql -> bindvalue(1,$idProperty,PDO ::PARAM_STR);
                $sql->execute();
                
                // Verifica si la operación fue exitosa y devuelve un arreglo de respuesta con éxito.
                return array(
                    "success" => true,
                    "message" => "Se ha eliminado correctamente la propiedad"
                );

            } catch (PDOException $e) {
                // Ocurrió un error
                $errorCode = $e->getCode(); // Código de error
                $errorDescription = $e->getMessage(); // Descripción del error

                // Puedes registrar el error en un archivo de registro o mostrar un mensaje de error al usuario.
                // También puedes devolver el código y la descripción del error como una respuesta si es necesario:

                return array(
                    "error" => true,
                    "errorCode" => $errorCode,
                    "errorDescription" => $errorDescription
                );
            }

        }

        public function StorageofCharacteristics($propertyid, $characteristicid, $CharacteriticValue, $LegalAspect)
        {

            try
            {

                $conectar = parent::conexion();
                $sql = "CALL Admin_Caracteristicas_Propiedades (2,?,?,?,?);";
                $sql = $conectar->prepare($sql);
                $sql -> bindvalue(1,$propertyid,PDO ::PARAM_STR);
                $sql -> bindvalue(2,$characteristicid,PDO ::PARAM_STR);
                $sql -> bindvalue(3,$CharacteriticValue,PDO ::PARAM_STR);
                $sql -> bindvalue(4,$LegalAspect,PDO ::PARAM_STR);
                $sql->execute();
                
                // Verifica si la operación fue exitosa y devuelve un arreglo de respuesta con éxito.
                return array(
                    "success" => true,
                    "message" => "Se ha registrado las caracteristicas de la propiedad"
                );

            } catch (PDOException $e) {
                // Ocurrió un error
                $errorCode = $e->getCode(); // Código de error
                $errorDescription = $e->getMessage(); // Descripción del error

                // Puedes registrar el error en un archivo de registro o mostrar un mensaje de error al usuario.
                // También puedes devolver el código y la descripción del error como una respuesta si es necesario:

                return array(
                    "error" => true,
                    "errorCode" => $errorCode,
                    "errorDescription" => $errorDescription
                );
            }


        }

        public function DeleteCharacteristics($propertyid)
        {

            try
            {

                $conectar = parent::conexion();
                $sql = "CALL Admin_Caracteristicas_Propiedades (3,?,NULL,NULL,NULL);";
                $sql = $conectar->prepare($sql);
                $sql -> bindvalue(1,$propertyid,PDO ::PARAM_STR);
                $sql->execute();
                
                // Verifica si la operación fue exitosa y devuelve un arreglo de respuesta con éxito.
                return array(
                    "success" => true,
                    "message" => "Se han eliminado las caracteristicas"
                );

            } catch (PDOException $e) {
                // Ocurrió un error
                $errorCode = $e->getCode(); // Código de error
                $errorDescription = $e->getMessage(); // Descripción del error

                // Puedes registrar el error en un archivo de registro o mostrar un mensaje de error al usuario.
                // También puedes devolver el código y la descripción del error como una respuesta si es necesario:

                return array(
                    "error" => true,
                    "errorCode" => $errorCode,
                    "errorDescription" => $errorDescription
                );
            }


        }

        public function StorageContacts ($propertyid, $NameContact, $CompanyContact, $PhoneContact)
        {

            $conectar = parent::conexion();
            $sql = "CALL Admin_Contactos_Propiedades (1,?,?,?,?);";
            $sql = $conectar->prepare($sql);
            $sql -> bindvalue(1,$propertyid,PDO ::PARAM_STR);
            $sql -> bindvalue(2,$NameContact,PDO ::PARAM_STR);
            $sql -> bindvalue(3,$CompanyContact,PDO ::PARAM_STR);
            $sql -> bindvalue(4,$PhoneContact,PDO ::PARAM_STR);
            $sql->execute();
            return "OK";
        }

        
        public function StorageDates ($propertyid, $fechaInicial, $FechaFinal)
        {
            $conectar = parent::conexion();
            $sql = "CALL admon_events (3,NULL,?,?,?,'A');";
            $sql = $conectar->prepare($sql);
            $sql -> bindvalue(1,$propertyid,PDO ::PARAM_STR);
            $sql -> bindvalue(2,$fechaInicial,PDO ::PARAM_STR);
            $sql -> bindvalue(3,$FechaFinal,PDO ::PARAM_STR);
            $sql->execute();
            return "OK";
        }

        public function Storageitemgallery ($propertyid, $itemGalleryName)
        {
            $conectar = parent::conexion();
            $sql = "CALL admon_Gallery (1,NULL,?,?);";
            $sql = $conectar->prepare($sql);
            $sql -> bindvalue(1,$propertyid,PDO ::PARAM_STR);
            $sql -> bindvalue(2,$itemGalleryName,PDO ::PARAM_STR);
            $sql->execute();
            return "OK";
        }


        public function get_itemgallery ($propertyid)
        {
            $conectar = parent::conexion();
            $sql = "CALL admon_Gallery (0,NULL,?,NULL);";
            $sql = $conectar->prepare($sql);
            $sql -> bindvalue(1,$propertyid,PDO ::PARAM_STR);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }


        public function get_allproperties(){
            $conectar = parent::conexion();
            $sql = "CALL Admin_realestate_property (3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,@insert_id);";
            $sql = $conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_allpropertiesbyUser($coduser){
            $conectar = parent::conexion();
            $sql = "CALL Admin_realestate_property (5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,?,NULL,NULL,NULL,NULL,NULL,NULL,NULL,@insert_id);";
            $sql = $conectar->prepare($sql);
            $sql -> bindvalue(1,$coduser,PDO ::PARAM_STR);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }


        public function get_propertiesbyid($idProperty){
            $conectar = parent::conexion();
            $sql = "CALL Admin_realestate_property (0,?,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,@insert_id);";
            $sql = $conectar->prepare($sql);
            $sql -> bindvalue(1,$idProperty,PDO ::PARAM_STR);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }


        public function get_caracteristicasporpropieadesbyid($idProperty){
            $conectar = parent::conexion();
            $sql = "CALL Admin_Caracteristicas_Propiedades (0,?,NULL,NULL,NULL);";
            $sql = $conectar->prepare($sql);
            $sql -> bindvalue(1,$idProperty,PDO ::PARAM_STR);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }



        public function get_alltypes(){
            $conectar = parent::conexion();
            $sql = "CALL admin_tipoPropiedades (0,NULL,NULL,NULL);";
            $sql = $conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }

        public function get_alluseradmin(){
            $conectar = parent::conexion();
            $sql = "CALL admon_users_admin (0,NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL);";
            $sql = $conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_allactiveuseradmin(){
            $conectar = parent::conexion();
            $sql = "CALL admon_users_admin (1,NULL, NULL,NULL, NULL, NULL, NULL, NULL, NULL);";
            $sql = $conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
          
        }


        public function get_useradminxcodeuser($coduser){
            $conectar = parent::conexion();
            $sql = "CALL admon_users_admin (2,?, NULL,NULL, NULL, NULL, NULL, NULL, NULL);";
            $sql = $conectar->prepare($sql);
            $sql -> bindvalue(1,$coduser);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_useradminxcodeuser($coduser){
            $conectar = parent::conexion();
            $sql = "CALL admon_users_admin (5,?, NULL,NULL, NULL, NULL, NULL, NULL, NULL);";
            $sql = $conectar->prepare($sql);
            $sql -> bindvalue(1,$coduser);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function insert_useradminxcodeuser($coduser, $nrocedula,$nameuser,$emailuser,$phoneuser,$passworduser,$estadouser,$createdBy){
            $conectar = parent::conexion();
            $sql = "CALL admon_users_admin (3,?,?,?,?,?,?,?,?);";
            $sql = $conectar->prepare($sql);
            $sql -> bindvalue(1,$coduser);
            $sql -> bindvalue(2,$nrocedula);
            $sql -> bindvalue(3,$nameuser);
            $sql -> bindvalue(4,$emailuser);
            $sql -> bindvalue(5,$phoneuser);
            $sql -> bindvalue(6,$passworduser);
            $sql -> bindvalue(7,$estadouser);
            $sql -> bindvalue(8,$createdBy);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }


        public function update_useradminxcodeuser($coduser, $nrocedula,$nameuser,$emailuser,$phoneuser,$passworduser,$estadouser,$createdBy){
            $conectar = parent::conexion();
            $sql = "CALL admon_users_admin (4,?,?,?,?,?,?,?,?);";
            $sql = $conectar->prepare($sql);
            $sql -> bindvalue(1,$coduser);
            $sql -> bindvalue(2,$nrocedula);
            $sql -> bindvalue(3,$nameuser);
            $sql -> bindvalue(4,$emailuser);
            $sql -> bindvalue(5,$phoneuser);
            $sql -> bindvalue(6,$passworduser);
            $sql -> bindvalue(7,$estadouser);
            $sql -> bindvalue(8,$createdBy);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_allcomercialuser()
        {
            $conectar = parent::Conexion();
            $sql ="CALL admon_users (7,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL, NULL);";
            $sql = $conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }

        public function get_user($coduser)
        {
            $conectar = parent::Conexion();
            $sql ="CALL admon_users (1,?,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);";
            $sql = $conectar->prepare($sql);
            $sql -> bindvalue(1,$coduser);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }



        public function get_allusersapp()
        {
            $conectar = parent::Conexion();
            $sql ="CALL admon_users (0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);";
            $sql = $conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }



        public function update_user($coduser, $idnumber_user,$name_user,$nombres,$apellidos,$datebday,$email_user,$company,$phone,$phone_user,$url,
        $address,$jobtittle ,$notes,$pass_user,$state_user, $usercode,$idperfil)
        {
            $conectar = parent::Conexion();


            try {
           
                $sql ="CALL admon_users (3,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
                
                $sql = $conectar->prepare($sql);
                $sql -> bindvalue(1,$coduser,PDO ::PARAM_STR);
                $sql -> bindvalue(2,$idnumber_user,PDO ::PARAM_STR);
                $sql -> bindvalue(3,$name_user,PDO ::PARAM_STR);
                $sql -> bindvalue(4,$nombres,PDO ::PARAM_STR);
                $sql -> bindvalue(5,$apellidos,PDO ::PARAM_STR);
                $sql -> bindvalue(6,$datebday,PDO ::PARAM_STR);
                $sql -> bindvalue(7,$email_user,PDO ::PARAM_STR);
                $sql -> bindvalue(8,$company,PDO ::PARAM_STR);
                $sql -> bindvalue(9,$phone,PDO ::PARAM_STR);
                $sql -> bindvalue(10,$phone_user,PDO ::PARAM_STR);
                $sql -> bindvalue(11,$url,PDO ::PARAM_STR);
                $sql -> bindvalue(12,$address,PDO ::PARAM_STR);
                $sql -> bindvalue(13,$jobtittle,PDO ::PARAM_STR);
                $sql -> bindvalue(14,$notes,PDO ::PARAM_STR);
                $sql -> bindvalue(15,$pass_user,PDO ::PARAM_STR);
                $sql -> bindvalue(16,$state_user,PDO ::PARAM_STR);
                $sql -> bindvalue(17,$usercode,PDO ::PARAM_STR);
                $sql -> bindvalue(18,$idperfil,PDO ::PARAM_STR);
                $sql->execute();
           
                return "Se ha creado actualizado correctamente el usuario: " . $coduser;

            }catch (PDOException $e)
            {
                #Error
                return "Error en el momento de realizar la actualización del cliente indicado. DESC Error" . $e->getMessage();
            }
           

        }
        

        public function create_user($coduser, $idnumber_user,$name_user,$nombres,$apellidos,$datebday,$email_user,$company,$phone,$phone_user,$url,
        $address,$jobtittle ,$notes,$pass_user,$state_user, $usercode,$idperfil)
        {
            $conectar = parent::Conexion();

            try {
           
                $sql ="CALL admon_users (2,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
                
                $sql = $conectar->prepare($sql);
                $sql -> bindvalue(1,$coduser,PDO ::PARAM_STR);
                $sql -> bindvalue(2,$idnumber_user,PDO ::PARAM_STR);
                $sql -> bindvalue(3,$name_user,PDO ::PARAM_STR);
                $sql -> bindvalue(4,$nombres,PDO ::PARAM_STR);
                $sql -> bindvalue(5,$apellidos,PDO ::PARAM_STR);
                $sql -> bindvalue(6,$datebday,PDO ::PARAM_STR);
                $sql -> bindvalue(7,$email_user,PDO ::PARAM_STR);
                $sql -> bindvalue(8,$company,PDO ::PARAM_STR);
                $sql -> bindvalue(9,$phone,PDO ::PARAM_STR);
                $sql -> bindvalue(10,$phone_user,PDO ::PARAM_STR);
                $sql -> bindvalue(11,$url,PDO ::PARAM_STR);
                $sql -> bindvalue(12,$address,PDO ::PARAM_STR);
                $sql -> bindvalue(13,$jobtittle,PDO ::PARAM_STR);
                $sql -> bindvalue(14,$notes,PDO ::PARAM_STR);
                $sql -> bindvalue(15,$pass_user,PDO ::PARAM_STR);
                $sql -> bindvalue(16,$state_user,PDO ::PARAM_STR);
                $sql -> bindvalue(17,$usercode,PDO ::PARAM_STR);
                $sql -> bindvalue(18,$idperfil,PDO ::PARAM_STR);
                $sql->execute();
           
                return "Se ha creado actualizado correctamente el usuario: " . $coduser;

            }catch (PDOException $e)
            {
                #Error
                return "Error en el momento de realizar la actualización del cliente indicado. DESC Error" . $e->getMessage();
            }
           
           

        }

        
        public function push_updatestateproperty($id, $Estado){
            $conectar = parent::conexion();
            $sql = "CALL Admin_realestate_property (6,?,NULL,NULL,NULL,NULL,NULL,NULL,NULL,?,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,@insert_id);";
            $sql = $conectar->prepare($sql);
            $sql -> bindvalue(1,$id,PDO ::PARAM_STR);
            $sql -> bindvalue(2,$Estado,PDO ::PARAM_STR);
            $sql->execute();
            return "Se ha actualizado correctamente el estado de la propiedad";
        }

        public function get_fechasporpropiedad($idPropiedad)
        {
            $conectar = parent::conexion();
            $sql = "CALL admon_events (2,NULL, ?, NULL, NULL, NULL)";
            $sql = $conectar->prepare($sql);
            $sql -> bindvalue(1,$idPropiedad,PDO ::PARAM_STR);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }


    }
?>
