<?php
    class AdminTipoPropiedad extends Conectar{

        public function get_alltypes(){
            $conectar = parent::conexion();
            $sql = "CALL admin_tipoPropiedades (0,NULL,NULL,NULL);";
            $sql = $conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }

        public function put_propertytypes($descripcion){
            $conectar = parent::conexion();
            $sql = "CALL admin_tipoPropiedades (1,NULL,?,'A');";
            $sql = $conectar->prepare($sql);
            $sql -> bindValue(1,$descripcion);
            $sql->execute();
            return "Se ha almacenado correctamente la información";
        }

        public function delete_propertytypes($idTipo){
            $conectar = parent::conexion();
            $sql = "CALL admin_tipoPropiedades (3,?,NULL,NULL);";
            $sql = $conectar->prepare($sql);
            $sql -> bindValue(1,$idTipo);
            $sql->execute();
            return "Se ha eliminado correctamente la información";

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