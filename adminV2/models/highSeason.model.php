<?php
    class High_Seassons extends Conectar{

        public function StorageDates ($fechaInicial, $FechaFinal)
        {
            try
            {

                $conectar = parent::conexion();
                $sql = "CALL admon_high_season (2,NULL,?,?,'A');";
                $sql = $conectar->prepare($sql);
                $sql -> bindvalue(1,$fechaInicial,PDO ::PARAM_STR);
                $sql -> bindvalue(2,$FechaFinal,PDO ::PARAM_STR);
                $sql->execute();
                
                // Verifica si la operación fue exitosa y devuelve un arreglo de respuesta con éxito.
                return array(
                    "success" => true,
                    "message" => "Se ha creado correctamente las fechas de temporada alta"
                );

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


        public function Delete_peak_season_dates ()
        {
            try
            {

                $conectar = parent::conexion();
                $sql = "CALL admon_high_season (6,NULL,NULL,NULL,'A');";
                $sql = $conectar->prepare($sql);
                $sql->execute();
                
                // Verifica si la operación fue exitosa y devuelve un arreglo de respuesta con éxito.
                return array(
                    "success" => true,
                    "message" => "Se han eliminado correctamente las fechas de temporada alta"
                );

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


        public function Delete_peak_season_date ($idEvent)
        {
            try
            {

                $conectar = parent::conexion();
                $sql = "CALL admon_high_season (4,?,NULL,NULL,'A');";
                $sql = $conectar->prepare($sql);
                $sql -> bindvalue(1,$idEvent,PDO ::PARAM_STR);
                $sql->execute();
                
                // Verifica si la operación fue exitosa y devuelve un arreglo de respuesta con éxito.
                return array(
                    "success" => true,
                    "message" => "Se han eliminado correctamente el registro seleccionado"
                );

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




        public function get_alldates_highSeasson(){
                try {
                    $conectar = parent::conexion();
                    $sql = "CALL admon_high_season (0,NULL,NULL,NULL,NULL);";
                    $sql = $conectar->prepare($sql);
                    $sql->execute();
                    
                    // Recupera todos los datos obtenidos de la consulta.
                    $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
                    
                    // Verifica si se obtuvieron datos exitosamente.
                    if ($resultado !== false) {
                        return array(
                            "success" => true,
                            "data" => $resultado
                        );
                    } else {
                        // Devuelve un arreglo de respuesta con error si no se obtuvieron datos.
                        return array(
                            "success" => false,
                            "errorCode" => null, // Puedes agregar un código de error específico si lo deseas.
                            "errorDescription" => "No se encontraron datos."
                        );
                    }
                } catch (PDOException $e) {
                    // Ocurrió un error
                    $errorCode = $e->getCode(); // Código de error
                    $errorDescription = $e->getMessage(); // Descripción del error
                    
                    // Devuelve un arreglo de respuesta con error.
                    return array(
                        "success" => false,
                        "errorCode" => $errorCode,
                        "errorDescription" => $errorDescription
                    );
                }
        }
    }
?>
