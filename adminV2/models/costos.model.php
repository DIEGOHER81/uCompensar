<?php
    class AdminCostos extends Conectar{

        public function add_Costos($descripcionCosto,$estadoCosto, $idTipoPropiedad, $costoAdicional, $tipodecosto, $formadecobrol){
            $conectar = parent::conexion();

            $sql = "CALL admin_costosAdicionales (1,NULL,?,?,?,?,?,?);";
            $sql = $conectar->prepare($sql);
            $sql -> bindValue(1,$estadoCosto);
            $sql -> bindValue(2,$descripcionCosto);
            $sql -> bindValue(3,$costoAdicional);
            $sql -> bindValue(4,$idTipoPropiedad);
            $sql -> bindValue(5,$tipodecosto);
            $sql -> bindValue(6,$formadecobrol);
            $sql->execute();
            return "OK";

        }


        public function get_allCostos(){
            $conectar = parent::conexion();

            $sql = "CALL admin_costosAdicionales (0,NULL,NULL,NULL,NULL,NULL,NULL, NULL);";
            $sql = $conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }

        public function get_allCostosPerProperty($idtipoPropiedad){
            $conectar = parent::conexion();

            $sql = "CALL admin_costosAdicionales (3,NULL,NULL,NULL,NULL,?,NULL, NULL);";
            $sql = $conectar->prepare($sql);
            $sql -> bindValue(1,$idtipoPropiedad);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }

        public function get_valorCosto($idCosto){
            $conectar = parent::conexion();

            $sql = "CALL admin_costosAdicionales (4,?,NULL,NULL,NULL,NULL,NULL, NULL);";
            $sql = $conectar->prepare($sql);
            $sql -> bindValue(1,$idCosto);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }

        public function delete_Costo($idcosto){
            $conectar = parent::conexion();

            $sql = "CALL admin_costosAdicionales (2,?,NULL,NULL,NULL,NULL,NULL, NULL);";
            $sql = $conectar->prepare($sql);
            $sql -> bindValue(1,$idcosto);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }



    }
?>