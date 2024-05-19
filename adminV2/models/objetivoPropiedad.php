<?php
    class objetivoPropiedad extends Conectar{
        public function create_objetivosPropiedad($descripcion){
            try {
                $conectar = parent::conexion();
                $sql = "CALL admonobjetivos (1,NULL,?);";
                $sql = $conectar->prepare($sql);
                $sql->bindValue(1, $descripcion);
                $sql->execute();

                // Verificar si la consulta fue exitosa y retornar una respuesta adecuada
                return "Se agrego correctamente la información"; // Puedes cambiar esto según tus necesidades

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

        public function delete_objetivosPropiedad($id){
            try {
                $conectar = parent::conexion();
                $sql = "CALL admonobjetivos (3,?,NULL);";
                $sql = $conectar->prepare($sql);
                $sql->bindValue(1, $id);
                $sql->execute();

                // Verificar si la consulta fue exitosa y retornar una respuesta adecuada
                return "Se agrego correctamente la información"; // Puedes cambiar esto según tus necesidades

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



        public function get_objetivosPropiedad(){
            try {
                $conectar = parent::conexion();
                $sql = "CALL admonobjetivos (0,NULL,NULL);";
                $sql = $conectar->prepare($sql);
                $sql->execute();
                return $resultado=$sql->fetchAll();

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
