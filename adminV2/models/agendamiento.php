<?php
    
    
    class AdminAgendamiento extends Conectar{
        
        public function get_allevents(){
            $conectar = parent::conexion();
            $sql = "CALL admon_events (0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);";
            $sql = $conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        

        public function get_alleventsbyuser($coduser){
            $conectar = parent::conexion();
            $sql = "CALL admon_events (2,NULL,?,NULL,NULL,NULL);";
            $sql = $conectar->prepare($sql);
            $sql -> bindValue(1,$coduser,PDO ::PARAM_STR);
            $sql->execute();
            return $resultado=$sql->fetchAll();
            
        }
        
        public function get_alleventsbyIdEvent($idEvent){
            $conectar = parent::conexion();
            $sql = "CALL admon_events (1,?,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);";
            $sql = $conectar->prepare($sql);
            $sql -> bindValue(1,$idEvent,PDO ::PARAM_STR);
            $sql->execute();
            return $resultado=$sql->fetchAll();
            
        }





        public function get_allactiveproductos(){
            $conectar = parent::conexion();
            $sql = "CALL admon_productos (1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);";
            $sql = $conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_product($codproduct){
            $conectar = parent::conexion();

            try {
            
                $sql = "CALL admon_productos (4,?, NULL,NULL, NULL, NULL, NULL, NULL, NULL,NULL,NULL,NULL);";
                $sql = $conectar->prepare($sql);
                $sql -> bindValue(1,$codproduct);
                $sql->execute();

                return "Se ha eliminado correctamente el producto: ".$codproduct;

            } catch(PDOException $e)
            {
                return "Error en el momento de elilminar el producto. ".$codproduct. " DESC Error: " . $e->getMessage();   
            }

            
            return $resultado=$sql->fetchAll();
        }

        public function Find_product($codproduct){

            $conectar = parent::conexion();
            #$sql = "CALL admon_productos (7,'$codproduct', NULL,NULL, NULL, NULL, NULL, NULL, NULL,NULL,NULL,NULL);";
            #return $sql;
           
            try{
                $sql = "CALL admon_productos (7,?, NULL,NULL, NULL, NULL, NULL, NULL, NULL,NULL,NULL,NULL);";
                $sql = $conectar->prepare($sql);
                $sql -> bindValue(1,$codproduct);
                $sql->execute();

                return $resultado=$sql->fetchAll();


            } catch (PDOException $e){
                return "Error en el momento de consultar el producto" .$codproduct . "DESC Error: " . $e->getMessage();
            }

        }

        public function Create_Event($titulo,$fecInicio, $fecFinal, $Modallidad, $codcliente, $sucursal,$numerodecotizacion,$codcontacto, $observaciones,$presupuesto,  $estado, $usuario){
            $conectar = parent::conexion();
            
            try
            {
              
                $sql = "CALL admon_events (3,NULL,?,?,?,?,?,?,?,?,?,?,?,?);";
                $sql = $conectar->prepare($sql);
                $sql -> bindvalue(1,$titulo,PDO ::PARAM_STR);
                $sql -> bindvalue(2,$fecInicio,PDO ::PARAM_STR);
                $sql -> bindvalue(3,$fecFinal,PDO ::PARAM_STR);
                $sql -> bindvalue(4,$Modallidad,PDO ::PARAM_STR);
                $sql -> bindvalue(5,$codcliente,PDO ::PARAM_STR);
                $sql -> bindvalue(6,$sucursal,PDO ::PARAM_STR);
                $sql -> bindvalue(7,$numerodecotizacion,PDO ::PARAM_STR);
                $sql -> bindvalue(8,$codcontacto,PDO ::PARAM_STR);
                $sql -> bindvalue(9,$observaciones,PDO ::PARAM_STR);
                $sql -> bindvalue(10,$presupuesto,PDO ::PARAM_STR);
                $sql -> bindvalue(11,$estado,PDO ::PARAM_STR);
                $sql -> bindvalue(12,$usuario,PDO ::PARAM_STR);
                $sql->execute();

                
                $sqlcons = "SELECT MAX(id) as IdEvento FROM events";
                $sqlcons = $conectar->prepare($sqlcons);
                $sqlcons->execute();

                return $resultado=$sqlcons->fetchAll();


                #return "Se ha creado correctamente el evento: " . $titulo;

                
            }
            catch (PDOException $e){ 
                #Error
                return "Error en el momento de realizar el almacenamiento del Evento. DESC Error" . $e->getMessage();
            }
        }



        public function get_alleventsbyuserforList($user){
            $conectar = parent::conexion();
            
            try
            {
                $sql = "CALL admon_events (8,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,?);";
                $sql = $conectar->prepare($sql);
                $sql -> bindvalue(1,$user,PDO ::PARAM_STR);
                $sql->execute();
                return $resultado=$sql->fetchAll();
               
            }
            catch (PDOException $e){ 
                #Error
                return "Error en el momento de realizar la actualización del Producto. DESC Error" . $e->getMessage();
            }

        }

        public function Update_product($codproduct,$shortdescription, $longdescription, $category, $tradmark, $cost,$tax,$measure, $brandreference, $state, $user){
            $conectar = parent::conexion();
            
            try
            {
                $sql = "CALL admon_productos (3,?,?,?,?,?,?,?,?,?,?,?);";
                $sql = $conectar->prepare($sql);
                $sql -> bindvalue(1,$codproduct,PDO ::PARAM_STR);
                $sql -> bindvalue(2,$shortdescription,PDO ::PARAM_STR);
                $sql -> bindvalue(3,$longdescription,PDO ::PARAM_STR);
                $sql -> bindvalue(4,$category,PDO ::PARAM_STR);
                $sql -> bindvalue(5,$tradmark,PDO ::PARAM_STR);
                $sql -> bindvalue(6,$cost,PDO ::PARAM_STR);
                $sql -> bindvalue(7,$tax,PDO ::PARAM_STR);
                $sql -> bindvalue(8,$measure,PDO ::PARAM_STR);
                $sql -> bindvalue(9,$brandreference,PDO ::PARAM_STR);
                $sql -> bindvalue(10,$state,PDO ::PARAM_STR);
                $sql -> bindvalue(11,$user,PDO ::PARAM_STR);
                $sql->execute();

                return "Se ha actualizado exitosamente el producto: " . $codproduct;
            }
            catch (PDOException $e){ 
                #Error
                return "Error en el momento de realizar la actualización del Producto. DESC Error" . $e->getMessage();
            }
        }


        public function Create_contact_event($idEvent, $contact_name, $contact_Email ,$contact_celular, $company_name){
            $conectar = parent::conexion();

            try
            {
                $sql = "CALL admin_events_contacts (0,?,?,?,?,?);";
                $sql = $conectar->prepare($sql);
                $sql -> bindvalue(1,$idEvent,PDO ::PARAM_STR);
                $sql -> bindvalue(2,$contact_name,PDO ::PARAM_STR);
                $sql -> bindvalue(3,$contact_Email,PDO ::PARAM_STR);
                $sql -> bindvalue(4,$contact_celular,PDO ::PARAM_STR);
                $sql -> bindvalue(5,$company_name,PDO ::PARAM_STR);
                $sql->execute();

                return "OK";
            }
            catch (PDOException $e){ 
                #Error
                return "Error en el momento de Crear el contacto. DESC Error" . $e->getMessage();
            }

        }


        public function get_ContactByIdEvent($idEvent){
            $conectar = parent::conexion();
            $sql = "CALL admin_events_contacts (1,?,NULL,NULL,NULL,NULL);";
            $sql = $conectar->prepare($sql);
            $sql -> bindValue(1,$idEvent,PDO ::PARAM_STR);
            $sql->execute();
            return $resultado=$sql->fetchAll();
            
        }


        public function delete_event($idEvent)
        {
            $conectar = parent::conexion();
            $sql = "CALL admon_events (5,?,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);";
            $sql = $conectar->prepare($sql);
            $sql -> bindvalue(1,$idEvent,PDO ::PARAM_STR);
            $sql->execute();

            return "OK";

        }

        public function delete_contactevent($idEvent)
        {
            $conectar = parent::conexion();
            $sql = "CALL admin_events_contacts (2,?,NULL,NULL,NULL,NULL);";
            $sql = $conectar->prepare($sql);
            $sql -> bindvalue(1,$idEvent,PDO ::PARAM_STR);
            $sql->execute();

            return "OK";

        }

        public function delete_observationevent($idEvent)
        {
            $conectar = parent::conexion();
            $sql = "CALL admin_events_observations (2,NULL,?,NULL);";
            $sql = $conectar->prepare($sql);
            $sql -> bindvalue(1,$idEvent,PDO ::PARAM_STR);
            $sql->execute();

            return "OK";

        }


        public function add_observationevent($idEvent,$notes)
        {
            $conectar = parent::conexion();
            $sql = "CALL admin_events_observations (0,NULL,?,?);";
            $sql = $conectar->prepare($sql);
            $sql -> bindvalue(1,$idEvent,PDO ::PARAM_STR);
            $sql -> bindvalue(2,$notes,PDO ::PARAM_STR);
            $sql->execute();

            return "OK";

        }


        public function FindHistorialEventbyId($idEvent)
        {
            $conectar = parent::conexion();
            $sql = "CALL admin_events_observations (1,NULL,?,NULL);";
            $sql = $conectar->prepare($sql);
            $sql -> bindValue(1,$idEvent,PDO ::PARAM_STR);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }

    }


     

?>