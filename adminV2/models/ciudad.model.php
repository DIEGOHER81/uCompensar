<?php
    class AdminCiudad extends Conectar{

        public function get_allCiudades(){
            try {
                $conectar = parent::conexion();
                $sql = "CALL admin_ciudades ('0', NULL, NULL, NULL, NULL);";
                $sql = $conectar->prepare($sql);
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
        
        public function get_allCiudadesbyCountry($idPais, $idDepartamento){
            try {
                $conectar = parent::conexion();
                $sql = "CALL admin_ciudades ('3', NULL, ?, NULL, ?);";
                $sql = $conectar->prepare($sql);
                $sql->bindValue(1, $idPais);
                $sql->bindValue(2, $idDepartamento);
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

        public function add_ciudad($idPais, $descCiudad, $idDepartamento){
            try {
                $conectar = parent::conexion();
                $sql = "CALL admin_ciudades ('1', NULL, ?, ?,?);";
                $sql = $conectar->prepare($sql);
                $sql->bindValue(1, $idPais);
                $sql->bindValue(2, $descCiudad);
                $sql->bindValue(3,$idDepartamento);
                $sql->execute();

                // Verificar si la consulta fue exitosa y retornar una respuesta adecuada
                return "Se agregó correctamente la ciudad"; // Puedes cambiar esto según tus necesidades

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



        public function delete_ciudad($idCiudad){
            try {
                $conectar = parent::conexion();
                $sql = "CALL admin_ciudades ('2', ?, NULL, NULL,NULL);";
                $sql = $conectar->prepare($sql);
                $sql->bindValue(1, $idCiudad);
                $sql->execute();

                // Verificar si la consulta fue exitosa y retornar una respuesta adecuada
                return "Se eliminó correctamente la ciudad"; // Puedes cambiar esto según tus necesidades

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

    }

        
?>