<?php
    class Conectar{
        protected $dbhost;

        protected function Conexion(){
            try {
                #conectar = $this->dbhost = new PDO("mysql:local=localhost;dbname=inmobiliaria","root","");
                #$conectar = $this->dbhost = new PDO("mysql:local=localhost;dbname=inmobili_wp","inmobili_csc","xR^emb?YJqm4");
                $conectar = $this->dbhost = new PDO("mysql:local=localhost;dbname=desarol_peliculas","root","");
                return $conectar;
            } catch (Exception $e) {
                print "¡Error BD! : " .$e->getMessage(). "<br/>";
                die();
            }

        }

        public function set_name(){
             return $this->dbhost->query("SET NAMES 'utf8'");   
        }
    }
?>