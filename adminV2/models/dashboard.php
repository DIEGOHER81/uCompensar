<?php
    class DashboardAdmin extends Conectar{
        public function get_qtypropiedades(){
            $conectar = parent::conexion();
            $sql = "CALL admin_dashboard (0)";
            $sql = $conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_qtypropiedadesActivas(){
            $conectar = parent::conexion();
            $sql = "CALL admin_dashboard (1)";
            $sql = $conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
          
        }


        public function get_qtypropiedadesArriendo(){
            $conectar = parent::conexion();
            $sql = "CALL admin_dashboard (2)";
            $sql = $conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
          
        }

        public function get_qtypropiedadesVenta(){
            $conectar = parent::conexion();
            $sql = "CALL admin_dashboard (3)";
            $sql = $conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
          
        }

        public function get_qtyUsuarios(){
            $conectar = parent::conexion();
            $sql = "CALL admin_dashboard (4)";
            $sql = $conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
          
        }



    }
?>
