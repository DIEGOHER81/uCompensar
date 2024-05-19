<?php
    class ParametrosBasicos extends Conectar{
        public function get_allMonedas(){
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

        


    }
?>
