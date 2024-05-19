<?php
    class AdminCaracteristicaPropiedad extends Conectar{
/*
            IN `_opc` INTEGER,
            IN `_idCaracteristica` INT,
            IN `_estadoCaracteristica` CHAR(1),
            IN `_descripcionCaracteristica` VARCHAR(150),
            IN `_idTipoPropiedad` INT,
            IN `_escaracteristicaBase` CHAR(1),
            IN `_Usuario` VARCHAR(15)
*/

        public function delete_caracteristicas($idCartacteristica, $idtipopropiedad){
            try {
                $conectar = parent::conexion();
                $sql = "CALL admin_caracteristicasPropiedades (4,?,NULL,NULL,?,NULL,NULL);";
                $sql = $conectar->prepare($sql);
                $sql->bindValue(1, $idCartacteristica);
                $sql->bindValue(2, $idtipopropiedad);
                $sql->execute();

                // Verificar si la consulta fue exitosa y retornar una respuesta adecuada
                return "Se elimino correctamente la información"; // Puedes cambiar esto según tus necesidades

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


        public function get_allProperties(){
            $conectar = parent::conexion();
            $sql = "CALL admin_caracteristicasPropiedades (0,NULL,NULL,NULL,NULL,NULL,NULL);";
            $sql = $conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }

        public function get_allPropertiesbytype($idcodtipo){
            $conectar = parent::conexion();

            $sql = "CALL admin_caracteristicasPropiedades (3,NULL,NULL,NULL,?,NULL,NULL);";
            $sql = $conectar->prepare($sql);
            $sql -> bindValue(1,$idcodtipo);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }


        public function get_allPropertiesbytypelst($idcodtipo){
            $conectar = parent::conexion();

            $sql = "CALL admin_caracteristicasPropiedades (2,NULL,NULL,NULL,?,NULL,NULL);";
            $sql = $conectar->prepare($sql);
            $sql -> bindValue(1,$idcodtipo);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }



        public function put_Properties($estadoCaracteristica, $descripcionCaracteristica, $idTipoPropiedad, $escaracteristicaBase,$usuario){
            $conectar = parent::conexion();

            $sql = "CALL admin_caracteristicasPropiedades (1,NULL,?,?,?,?,?);";
            $sql = $conectar->prepare($sql);
            $sql -> bindValue(1,$estadoCaracteristica);
            $sql -> bindValue(2,$descripcionCaracteristica);
            $sql -> bindValue(3,$idTipoPropiedad);
            $sql -> bindValue(4,$escaracteristicaBase);
            $sql -> bindValue(5,$usuario);
            $sql->execute();
            return "OK";

        }


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
                $sql = "CALL GETCompanyInformation(?);";
                $sql = $conectar->prepare($sql);
                $sql -> bindValue(1,$opcion);
                $sql->execute();
                return $resultado=$sql->fetchAll();
            } catch (PDOException $e)
            {
                return "Error en el momento de realizar Consulta de las ciudades. DESC Error" . $e->getMessage();

            }
            
            
        }


       


    }
?>