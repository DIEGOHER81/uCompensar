<?php
    class monedas extends Conectar{
        public function create_monedas($descripcion){
            try {
                $conectar = parent::conexion();
                $sql = "CALL admin_monedas (1, NULL, ?);";
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

        public function delete_monedas($id){
            try {
                $conectar = parent::conexion();
                $sql = "CALL admin_monedas (2,?,NULL);";
                $sql = $conectar->prepare($sql);
                $sql->bindValue(1, $id);
                $sql->execute();

                // Verificar si la consulta fue exitosa y retornar una respuesta adecuada
                return "Se eliminó correctamente la información"; // Puedes cambiar esto según tus necesidades

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



        public function get_allmonedas(){
            try {
                $conectar = parent::conexion();
                $sql = "CALL admin_monedas (0,NULL,NULL);";
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
