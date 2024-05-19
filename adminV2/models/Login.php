<?php
    
    
    class AdminIngreso extends Conectar{
        
        public function get_allperfiles(){
            $conectar = parent::conexion();
            $sql = "CALL admon_perfiles (1, NULL, 'Administrador', 'A');";
            $sql = $conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        

        public function get_useradmin($coduser){
            $conectar = parent::conexion();
            $sql = "CALL admon_users_admin (2,?, NULL,NULL, NULL, NULL, NULL, NULL, NULL);";
            $sql = $conectar->prepare($sql);
            $sql -> bindvalue(1,$coduser);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }

        public function get_user($coduser){
            $conectar = parent::conexion();
            $sql = "CALL admon_users (1,?, NULL,NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL);";
            $sql = $conectar->prepare($sql);
            $sql -> bindvalue(1,$coduser);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }

        public function create_user($coduser, $identificacion, $nombres, $Apellidos, $Correo, $Celular, $password,$state_user){
            try {
                $conectar = parent::conexion();
                $name_user = $nombres ." ".$Apellidos;
                $user_code = "WEBPAGE";
                $perfil = 2;
                $sql = "CALL admon_users (2,?, ?,?, ?, ?, NULL, ?, NULL, ?, NULL, NULL, NULL, NULL, NULL, ?, ?, ?,?);";
                $sql = $conectar->prepare($sql);
                $sql -> bindvalue(1,$coduser,PDO ::PARAM_STR);
                $sql -> bindvalue(2,$identificacion,PDO ::PARAM_STR);
                $sql -> bindvalue(3,$name_user,PDO ::PARAM_STR);
                $sql -> bindvalue(4,$nombres,PDO ::PARAM_STR);
                $sql -> bindvalue(5,$Apellidos,PDO ::PARAM_STR);
                $sql -> bindvalue(6,$Correo,PDO ::PARAM_STR);
                $sql -> bindvalue(7,$Celular,PDO ::PARAM_STR);
                $sql -> bindvalue(8,$password,PDO ::PARAM_STR);
                $sql -> bindvalue(9,$state_user,PDO ::PARAM_STR);
                $sql -> bindvalue(10,$user_code,PDO ::PARAM_STR);
                $sql -> bindvalue(11,$perfil,PDO ::PARAM_STR);

                $sql->execute();
                
                return "Se ha creado correctamente su cuenta con el código del usuario: " . $coduser;

            }catch (PDOException $e)
            {
                #Error
                return "Error en el momento de realizar el almacenamiento. DESC Error" . $e->getMessage();
            }


        }



    }


     

?>