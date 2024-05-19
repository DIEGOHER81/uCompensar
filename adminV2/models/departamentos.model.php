<?php
    class AdminDepartamentos extends Conectar{

        public function get_DepartamentsByCountry($idPais){
            try {
                $conectar = parent::conexion();
                $sql = "CALL admin_departamentos ('3', NULL, ?, NULL);";
                $sql = $conectar->prepare($sql);
                $sql->bindValue(1, $idPais);
                $sql->execute();
                return $resultado = $sql->fetchAll();
            } catch (PDOException $e) {
                // Ocurrió un error
                $errorCode = $e->getCode(); // Código de error
                $errorDescription = $e->getMessage(); // Descripción del error
        
                // Devolver el código y la descripción del error como resultado
                return array(
                    "error" => true,
                    "errorCode" => $errorCode,
                    "errorDescription" => $errorDescription
                );
            }
        }
        
    }

        
?>