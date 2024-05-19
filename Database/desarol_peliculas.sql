-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 12-05-2024 a las 04:49:39
-- Versión del servidor: 5.7.39
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `desarol_peliculas`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_caracteristicasPropiedades` (IN `_opc` INT, IN `_idCaracteristica` INT, IN `_estadoCaracteristica` CHAR(1), IN `_descripcionCaracteristica` VARCHAR(150), IN `_idTipoPropiedad` INT, IN `_escaracteristicaBase` CHAR(1), IN `_Usuario` VARCHAR(15))   BEGIN
   DECLARE  _idInsertado INT;
   /*Búsqueda de todas las caracteristicas*/
   IF (_opc = 0)  THEN
			SELECT rep.rep_id, rep_description, CASE WHEN rep_status = 'A' THEN 'ACTIVO' ELSE 'INACTIVO' END AS rep_status  , tipos.nombre_tipo, is_base, rrept.tipo_id
			  FROM real_estate_properties rep
			  LEFT JOIN r_rep_tipos rrept ON  rep.rep_id = rrept.rep_id
			  LEFT JOIN tipos ON rrept.tipo_id = tipos.id AND tipos.estado = 'A'
			  ORDER BY rep.rep_id desc
			  ;
   END IF;
   IF (_opc = 1) THEN
		INSERT INTO real_estate_properties 
			 (rep_description, rep_status, rep_created_by) 
        VALUES
             (_descripcionCaracteristica, _estadoCaracteristica, _Usuario) ;
		SELECT max(rep_id) INTO _idInsertado from real_estate_properties;
		INSERT INTO r_rep_tipos (rep_id, tipo_id, is_base) VALUES(_idInsertado, _idTipoPropiedad, _escaracteristicaBase);
   END IF;
   /*Búsqueda de todas las caracteristicas*/
   IF (_opc = 2)  THEN
			SELECT rep.rep_id, rep_description, CASE WHEN rep_status = 'A' THEN 'ACTIVO' ELSE 'INACTIVO' END AS rep_status  , tipos.nombre_tipo, is_base, rrept.tipo_id
			  FROM real_estate_properties rep
			  LEFT JOIN r_rep_tipos rrept ON  rep.rep_id = rrept.rep_id
			  LEFT JOIN tipos ON rrept.tipo_id = tipos.id AND tipos.estado = 'A'
  		    WHERE rrept.tipo_id = _idTipoPropiedad
			   AND rep_status ='A'
			  ORDER BY rep.rep_id desc
			  ;
   END IF;
   IF (_opc = 3)  THEN
			SELECT rep.rep_id, rep_description, CASE WHEN rep_status = 'A' THEN 'ACTIVO' ELSE 'INACTIVO' END AS rep_status  , tipos.nombre_tipo, is_base, 
		  			 rrept.tipo_id
			  FROM real_estate_properties rep
			  LEFT JOIN r_rep_tipos rrept ON  rep.rep_id = rrept.rep_id
			  LEFT JOIN tipos ON rrept.tipo_id = tipos.id AND tipos.estado = 'A'
  		    WHERE rrept.tipo_id = _idTipoPropiedad
			   AND rep_status ='A'
			   AND rrept.is_base = 'S'
			  ORDER BY rep.rep_id desc
			  ;
   END IF;
   IF (_opc = 4)  THEN
 			DELETE FROM r_rep_tipos WHERE rep_id = _idCaracteristica AND tipo_id = _idTipoPropiedad;
			SELECT COUNT(tipo_id) INTO _idInsertado from r_rep_tipos WHERE rep_id = _idCaracteristica;
			IF (_idInsertado = 0 ) THEN
	 			DELETE FROM real_estate_properties WHERE rep_id = _idCaracteristica;			
			END IF;
   END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Admin_Caracteristicas_Propiedades` (IN `_opc` INTEGER, IN `_idPropiedad` INT, IN `_idCaracteristica` INT, IN `_ValorCaractaristica` VARCHAR(50), IN `_aspectolegalCaracteristica` VARCHAR(800))   BEGIN
     /*Seleccionar todas las características de una propiedad */
	IF (_opc = 0) THEN
	SELECT idCaracteristica, rep_description,  ValorCaractaristica, aspectolegalCaracteristica
  		   FROM r_propiedades_caracteristicas, real_estate_properties
		WHERE rep_id = idCaracteristica
		      AND rep_status = 'A'
 		      AND idPropiedad = _idPropiedad ;
	END IF;
    IF (_opc = 2) THEN	
		INSERT INTO r_propiedades_caracteristicas (idPropiedad, idCaracteristica, ValorCaractaristica, aspectolegalCaracteristica )
		VALUES
		(_idPropiedad, _idCaracteristica,_ValorCaractaristica, _aspectolegalCaracteristica);
	END IF;	
	IF (_opc = 3) THEN
		DELETE FROM  r_propiedades_caracteristicas
		  WHERE  idPropiedad = _idPropiedad ;
	END IF;
	IF (_opc = 4) THEN 
	  SELECT DISTINCT rep_id, rep_description
		 FROM r_propiedades_caracteristicas rpc, real_estate_properties rep
      WHERE rep.rep_id = rpc.idCaracteristica;
	END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_ciudades` (IN `_opc` INT, IN `_idCiudad` INT, IN `_idPais` INT, IN `_descCiudad` VARCHAR(150), IN `_idDepartamento` INT)   BEGIN
   DECLARE  _idInsertado INT;
   /*Búsqueda de todas las caracteristicas*/
   IF (_opc = 0)  THEN
			SELECT ciudades.id, ciudades.id_pais, nombre_ciudad, paises.nombre_pais, departamentos.nombre_departamento
 			  FROM ciudades, paises, departamentos
 			 WHERE ciudades.id_pais = paises.id
			   AND ciudades.id_departamentos = departamentos.cod_departamento
			   AND departamentos.id_pais = paises.id
			   AND ciudades.id_pais = departamentos.id_pais
			 ORDER BY nombre_ciudad ASC;
   END IF;
   IF (_opc = 1) THEN
		INSERT INTO ciudades
			 (id_pais, nombre_ciudad, id_departamentos)
        VALUES
             (_idPais, _descCiudad, _idDepartamento) ;
   END IF;
   /*Búsqueda de todas las caracteristicas*/
   IF (_opc = 2)  THEN
		DELETE FROM ciudades where id = _idCiudad;
   END IF;
      IF (_opc = 3)  THEN
		   SELECT ciudades.id, id_pais, nombre_ciudad, paises.nombre_pais
 			  FROM ciudades, paises 
			 WHERE ciudades.id_pais = paises.id
			   AND paises.id = _idPais
			   AND id_departamentos = _idDepartamento
			 ORDER BY nombre_ciudad ASC;
   END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Admin_Contactos_Propiedades` (IN `_opc` INTEGER, IN `_idPropiedad` INT, IN `_NombreContacto` VARCHAR(150), IN `_NombreEmpresa` VARCHAR(150), IN `_telefonocontacto` VARCHAR(800))   BEGIN
     /*Seleccionar todas las características de una propiedad */
	IF (_opc = 0) THEN
		 SELECT `NombreContacto`,`EmpresaContacto`,	`TelefonoContacto` 
  		   FROM r_propiedades_contactos
 		  WHERE idPropiedad = _idPropiedad;
	END IF;
    IF (_opc = 1) THEN	
		INSERT INTO r_propiedades_contactos (idPropiedad,`NombreContacto`,`EmpresaContacto`,`TelefonoContacto` )
		VALUES
		(_idPropiedad, _NombreContacto,_NombreEmpresa, _telefonocontacto);
	END IF;	
	IF (_opc = 3) THEN
		DELETE FROM  r_propiedades_contactos
		  WHERE  idPropiedad = _idPropiedad ;
	END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_costosAdicionales` (IN `_opc` INTEGER, IN `_idCosto` INT, IN `_estadoCosto` CHAR(1), IN `_descripcionCosto` VARCHAR(150), IN `_CostoServicio` FLOAT, IN `_idTipoPropiedad` INT, IN `_tipodecosto` CHAR(1), IN `_formadecobro` CHAR(1))   BEGIN
   DECLARE  _idInsertado INT;
   /*Búsqueda de todas las caracteristicas*/
   IF (_opc = 0)  THEN
		SELECT c.id, c.descripcion,  CASE WHEN c.estado = 'A' THEN 'ACTIVO' ELSE 'INACTIVO' END AS estado  , tipos.nombre_tipo, c.costoservicio, 
			        case WHEN c.tipoCosto = 'D' THEN 'Deducción' else 'Adición' END as tipoCosto, 
 					case WHEN c.formaCobro = 'P' THEN 'Porcentual' else 'Valor' END as formaCobro
			  FROM costos c
			  LEFT JOIN tipos ON c.tipopropiedad = tipos.id AND tipos.estado = 'A'
			  ORDER BY c.id desc
			  ;   
	END IF;
   IF (_opc = 1) THEN
		INSERT INTO costos 
			 (descripcion, estado, tipopropiedad, costoservicio, tipoCosto, formaCobro)
        VALUES
             (_descripcionCosto, _estadoCosto, _idTipoPropiedad,_CostoServicio, _tipodecosto, _formadecobro) ;
   END IF;
   /*Búsqueda de todas las caracteristicas*/
   IF (_opc = 2)  THEN
		DELETE FROM costos where id = _idCosto;
   END IF;
   IF (_opc = 3)  THEN
			SELECT id , descripcion 
   		     FROM costos
		    WHERE estado = 'A'
			  AND tipopropiedad = _idTipoPropiedad
			  ;
   END IF;
     IF (_opc = 4)  THEN
			SELECT costoservicio
   		     FROM costos
		    WHERE  id = _idCosto
			  ;
   END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_dashboard` (IN `_opc` INTEGER)   BEGIN
    IF (_opc = 0) THEN
		SELECT COUNT(*) AS qty_properties FROM propiedades;          
    END IF;
   -- Propiedades Activas
    IF (_opc = 1) THEN
		SELECT COUNT(*) AS qty_properties FROM propiedades WHERE estado = 1;          
    END IF;
    -- Arriendo
    IF (_opc = 2) THEN
		SELECT COUNT(*) AS qty_properties FROM propiedades WHERE objetivo = 1;          
    END IF;
    -- Venta
    IF (_opc = 3) THEN
    	SELECT COUNT(*) AS qty_properties FROM propiedades WHERE objetivo = 2;          
	END IF;
    IF (_opc = 4) THEN
		SELECT COUNT(*) AS qty_users FROM users WHERE state_user = 'A';   
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_departamentos` (IN `_opc` INT, IN `_iddepartamento` VARCHAR(3), IN `_idPais` INT, IN `_descDepartamento` VARCHAR(150))   BEGIN
   DECLARE  _idInsertado INT;
   /*Búsqueda de todas las caracteristicas*/
   IF (_opc = 0)  THEN
			SELECT departamentos.cod_departamento AS id, id_pais, nombre_departamento, paises.nombre_pais
 			  FROM departamentos, paises 
			WHERE ciudades.id_pais = paises.id
			 ORDER BY nombre_ciudad ASC;
   END IF;
   IF (_opc = 1) THEN
		INSERT INTO departamentos
			 (id_pais, cod_departamento, nombre_departamento)
        VALUES
         (_idPais, _iddepartamento, _descDepartamento);
   END IF;
   /*Búsqueda de todas las caracteristicas*/
   IF (_opc = 2)  THEN
		DELETE FROM departamentos where cod_departamento = _iddepartamento;
   END IF;
  IF (_opc = 3)  THEN
  			SELECT departamentos.cod_departamento AS id, id_pais, nombre_departamento, paises.nombre_pais
 			  FROM departamentos, paises 
			 WHERE departamentos.id_pais = paises.id
 			   AND paises.id = _idPais
			 ORDER BY nombre_departamento ASC;
   END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_monedas` (IN `_opc` INTEGER, IN `_idMoneda` INTEGER, IN `_descMoneda` VARCHAR(150))   BEGIN
   /*Búsqueda de todas las caracteristicas*/
   IF (_opc = 0)  THEN
			SELECT monedas.id ,  monedas.descripcion
 			  FROM  monedas 
			 ORDER BY monedas.descripcion ASC;
   END IF;
   IF (_opc = 1) THEN
		INSERT INTO monedas
			 (descripcion)
        VALUES
             (_descMoneda) ;
   END IF;
   /*Búsqueda de todas las caracteristicas*/
   IF (_opc = 2)  THEN
		DELETE FROM monedas where id = _idMoneda;
   END IF;
   IF (_opc = 3)  THEN
		UPDATE monedas
		         SET descripcion =  _descMoneda
        WHERE id = _idMoneda;				 
   END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_paises` (IN `_opc` INT, IN `_idPais` INT, IN `_descPais` VARCHAR(150))   BEGIN
   /*Búsqueda de todas las caracteristicas*/
   IF (_opc = 0)  THEN
			SELECT paises.id ,  paises.nombre_pais
 			  FROM  paises 
			 ORDER BY nombre_pais ASC;
   END IF;
   IF (_opc = 1) THEN
		INSERT INTO paises
			 (nombre_pais)
        VALUES
             (_descPais) ;
   END IF;
   /*Búsqueda de todas las caracteristicas*/
   IF (_opc = 2)  THEN
		DELETE FROM paises where id = _idPais;
   END IF;
   IF (_opc = 3)  THEN
		UPDATE paises
		         SET nombre_pais =  _descPais
        WHERE id = _idPais;				 
   END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Admin_realestate_property` (IN `_opc` INT, IN `_id` INT(11), IN `_codigo` VARCHAR(50), IN `_dardealta` INT(11), IN `_fecha_alta` DATE, IN `_titulo` VARCHAR(100), IN `_descripcion` TEXT, IN `_tipo` INT(11), IN `_Objetivo` INT(11), IN `_estado` VARCHAR(15), IN `_moneda` VARCHAR(5), IN `_PrecioVenta` FLOAT, IN `_PrecioDia` FLOAT, IN `_PrecioMes` FLOAT, IN `_pais` INT(11), IN `_ciudad` INT(11), IN `_ubicacion` VARCHAR(200), IN `_barrio` VARCHAR(150), IN `_sector` VARCHAR(150), IN `_url_foto_principal` VARCHAR(200), IN `_propietario` VARCHAR(100), IN `_etiquetasseo` VARCHAR(800), IN `_PrecioDiaTA` FLOAT, IN `_PrecioMesTA` FLOAT, IN `_urlvideo` VARCHAR(800), IN `_costoadicinal` FLOAT, IN `_ObsAprobacion` VARCHAR(800), IN `_departamento` INT(11), OUT `_inserted_id` INT(11))   BEGIN
	IF (_opc = 0) THEN
		SELECT   propiedades.id,  `codigo`,  
				   case when `dardealta` = 1 then  'APROBADA' ELSE 'DENEGADA' END AS dardealta ,  `fecha_alta`,  `titulo`, `descripcion`, 
					tipos.id AS codtipo,
					tipos.nombre_tipo as `tipo`,  `Objetivo`,  
					propiedades.estado AS codEstado,
					case when propiedades.estado =  1 then 'ACTIVA' ELSE 'INACTIVA' END AS estado,  `moneda`,  `PrecioVenta`,  `PrecioDia`,  `PrecioMes`, `PrecioDiaTA` AS preciodiata,  `PrecioMesTA` AS preciomesta, 
					`pais`, paises.nombre_pais,  departamento, departamentos.nombre_departamento, `ciudad`, ciudades.nombre_ciudad,
					 `ubicacion`,  `barrio`,  `sector`,  `url_foto_principal`,  `propietario` 
					,  `SEO` , url_video, costoadicinal,ObsAprobacion, departamento
  		  FROM propiedades, tipos, paises, departamentos, ciudades  
  		 WHERE propiedades.id = _id
		   AND propiedades.tipo = tipos.id 
			AND propiedades.pais = paises.id
			AND propiedades.departamento = departamentos.cod_departamento
			AND paises.id = departamentos.id_pais
			AND propiedades.ciudad = ciudades.id
			AND ciudades.id_departamentos = departamentos.cod_departamento;
	END IF;
	IF (_opc = 1) THEN
		SELECT  `id`,  `codigo`,  `dardealta`,  `fecha_alta`,  `titulo`, `descripcion`,  `tipo`,  `Objetivo`,  `estado`,  `moneda`,  `PrecioVenta`,  `PrecioDia`,  `PrecioMes`, `PrecioDiaTA`,  `PrecioMesTA`,  `pais`,  `ciudad`,  `ubicacion`,  `barrio`,  `sector`,  `url_foto_principal`,  `propietario` 
					,  `SEO` , url_video, costoadicinal,ObsAprobacion, departamento
  		  FROM propiedades
 		WHERE codigo = _codigo ;
	END IF;
	IF (_opc = 2) THEN	
		INSERT INTO propiedades ( `dardealta`,  `fecha_alta`,  `titulo`, `descripcion`,  `tipo`,  `Objetivo`,  `estado`,  `moneda`,  `PrecioVenta`,  `PrecioDia`,  `PrecioMes`, `PrecioDiaTA`,  `PrecioMesTA`,   `pais`,  `ciudad`,  `ubicacion`,  `barrio`,  `sector`,  `url_foto_principal`,  `propietario`,  `SEO` , url_video, costoadicinal,ObsAprobacion, departamento)
		VALUES
		(1,DATE(NOW()),  `_titulo`, `_descripcion`,  `_tipo`,  `_Objetivo`,  `_estado`,  `_moneda`,  `_PrecioVenta`,  `_PrecioDia`,  `_PrecioMes`, `_PrecioDiaTA`,  `_PrecioMesTA`,  `_pais`,  `_ciudad`,  `_ubicacion`,  `_barrio`,  `_sector`,  `_url_foto_principal`,  `_propietario`,`_etiquetasseo` , _urlvideo, _costoadicinal,_ObsAprobacion,_departamento);
		SELECT MAX(id) INTO _inserted_id FROM propiedades;
	END IF;	
	IF (_opc = 3) THEN
		SELECT propiedades.`id`,  `codigo`,  `dardealta`,  `fecha_alta`,  `titulo`, propiedades.`descripcion`,  `tipo`,  `Objetivo`,  propiedades.`estado`,  `moneda`,  `PrecioVenta`,  `PrecioDia`,  `PrecioMes`, `PrecioDiaTA`,  `PrecioMesTA`,  `pais`,  `ciudad`,  `ubicacion`,  `barrio`,  `sector`,  `url_foto_principal`,  `propietario` ,  `SEO`, tipos.nombre_tipo, objetivospropiedad.descripcion AS objetivopropiedad
				  , url_video, costoadicinal,ObsAprobacion, departamento
  		  FROM propiedades, tipos, objetivospropiedad
 		 WHERE dardealta = 1
 		   AND tipos.id = propiedades.tipo
 		   AND propiedades.estado = 1
 		   AND objetivospropiedad.id = propiedades.Objetivo
		 ORDER BY fecha_alta DESC;
	END IF;
	IF (_opc = 4) THEN
		UPDATE propiedades 
			SET 
				titulo = _titulo,
				descripcion =_descripcion,
				tipo =_tipo, 
				Objetivo = _Objetivo,
				estado =_estado, 
				moneda =_moneda,   
				PrecioVenta=_PrecioVenta,  
				PrecioDia =_PrecioDia,  
				PrecioMes =_PrecioMes, 
				PrecioDiaTA =_PrecioDiaTA,   
				PrecioMesTA =_PrecioMesTA,    
				pais =_pais,   
				ciudad =_ciudad,   
				ubicacion =_ubicacion,
				barrio =_barrio,   
				sector =_sector,   
				url_foto_principal =_url_foto_principal,  
				propietario =_propietario,  
				SEO =_etiquetasseo , 
				url_video =  _urlvideo, 
				costoadicinal = _costoadicinal,
				ObsAprobacion = _ObsAprobacion, 
				departamento = _departamento
		WHERE propiedades.id = _id;
	END IF;
	IF (_opc = 5) THEN
		SELECT   propiedades.id,  `codigo`,  
				   case when `dardealta` = 1 then  'APROBADA' ELSE 'DENEGADA' END AS dardealta ,  `fecha_alta`,  `titulo`, `descripcion`, tipos.nombre_tipo as `tipo`,  `Objetivo`,  
					case when propiedades.estado =  1 then 'ACTIVA' ELSE 'INACTIVA' END AS estado,  `moneda`,  `PrecioVenta`,  `PrecioDia`,  `PrecioMes`,  `PrecioDiaTA`,  `PrecioMesTA`, `pais`,  `ciudad`,  `ubicacion`,  `barrio`,  `sector`,  `url_foto_principal`,  `propietario` 
					,  `SEO` , url_video, costoadicinal,ObsAprobacion, departamento
  		  FROM propiedades, tipos 
 		WHERE propietario = _propietario
		  AND propiedades.tipo = tipos.id ;
	END IF;
	IF (_opc = 6) THEN
		UPDATE propiedades
		        SET
						`estado` = `_estado`
 		 WHERE `id` = `_id`;
	END IF;	
    IF (_opc = 7) THEN
		DELETE FROM  propiedades
 		 WHERE `id` = `_id`;
	END IF;	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_tipoPropiedades` (IN `_opc` INT, IN `_id` INT, IN `_nombretipo` VARCHAR(50), IN `_estado` CHAR(1))   BEGIN
   IF (_opc = 0) THEN
        SELECT 
               id, nombre_tipo, estado
        FROM 
               tipos
        WHERE 
		         estado = 'A'       
        ORDER BY nombre_tipo DESC;
   END IF;
   IF (_opc = 1) THEN
		  INSERT INTO tipos (
               nombre_tipo, estado)
        VALUES
               (_nombretipo, _estado);
   END IF;
   IF (_opc = 2) THEN
		UPDATE tipos
 		   SET 
 		   	nombre_tipo = _nombretipo,
 		   	estado = _estado
       WHERE
       		id = _id;
   END IF;
   IF (_opc = 3) THEN
		DELETE FROM tipos
       WHERE
       		id = _id;
   END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `admonobjetivos` (IN `_opc` INT, IN `_id` INT, IN `_descripcion` VARCHAR(250))   BEGIN
	IF (_opc = 0) THEN
		SELECT id, descripcion 
  		  FROM objetivospropiedad;
	END IF;
	IF (_opc = 1) THEN
		INSERT INTO objetivospropiedad (descripcion) VALUES (_descripcion);
	END IF;
	IF (_opc = 2) THEN
		UPDATE objetivospropiedad SET
             descripcion = _descripcion
 		 WHERE id = _id;
	END IF;
	IF (_opc = 3) THEN
		DELETE FROM objetivospropiedad WHERE id = _id;
	END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `admon_events` (IN `_opc` INTEGER, IN `_id` INTEGER, IN `_idPropiedad` INTEGER, IN `_startEvent` DATETIME, IN `_endEvent` DATETIME, IN `_state` CHAR(1))   BEGIN
    /*Select all events */
    IF (_opc= 0) THEN
        SELECT 
            id, idPropiedad, startEvent, endEvent,  state
        FROM
            events 
        ORDER BY
            id;
    END IF;
    /*Select event by id Event*/
    IF (_opc= 1) THEN
        SELECT 
            id, idPropiedad, startEvent, endEvent,  state
        FROM
            events
        WHERE 
            id = _id 
        ORDER BY
            id;
    END IF;
    /*Select event by id Event*/
    IF (_opc= 2) THEN
        SELECT 
            id, idPropiedad, startEvent, endEvent,  state
        FROM
            events
        WHERE 
            idPropiedad = _idPropiedad
        ORDER BY
            id;
    END IF;
    /*Insert event*/
    IF (_opc= 3) THEN
        INSERT INTO events  
            (idPropiedad, startEvent, endEvent,  state)
        VALUES 
            (_idPropiedad, _startEvent, _endEvent, 'A' );
    END IF;
    /*Update evvent*/
    IF (_opc= 4) THEN
        UPDATE events
            SET 
               startEvent = _startevent, 
               endEvent = _endEvent, 
               state = _state
        WHERE 
            id = _id;
    END IF;
    /*Delete record */
    IF (_opc= 5) THEN
        DELETE FROM events
        WHERE  id = _id;
    END IF;
    /*Delete all events */
    IF (_opc= 6) THEN
        DELETE FROM events;
    END IF;
    /*Reinicilizar la tabla */
    IF (_opc= 7) THEN
        TRUNCATE TABLE events;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `admon_Gallery` (IN `_opc` INTEGER, IN `_id` INTEGER, IN `_idPropiedad` INTEGER, IN `_nombreFoto` VARCHAR(150))   BEGIN
    /*Select all events */
    IF (_opc= 0) THEN
        SELECT 
            id, idPropiedad, nombreFoto
        FROM
        		r_propiedades_imagenes
        WHERE	
            idPropiedad = _idPropiedad
        ORDER BY
            id;
    END IF;
    /*Select event by id Event*/
    IF (_opc= 1) THEN
        INSERT INTO r_propiedades_imagenes  
            (idPropiedad, nombreFoto)
        VALUES 
            (_idPropiedad, _nombreFoto);
    END IF;
    /*Delete record */
    IF (_opc= 2) THEN
        DELETE FROM r_propiedades_imagenes
        WHERE  id = _id;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `admon_high_season` (IN `_opc` INTEGER, IN `_id` INTEGER, IN `_startEvent` DATETIME, IN `_endEvent` DATETIME, IN `_state` CHAR(1))   BEGIN
    /*Select all high_season */
    IF (_opc= 0) THEN
        SELECT 
            id,  startEvent, endEvent,  state
        FROM
            high_season 
        ORDER BY
            id;
    END IF;
    /*Select high_season by id high_season*/
    IF (_opc= 1) THEN
        SELECT 
            id,  startEvent, endEvent,  state
        FROM
            high_season
        WHERE 
            id = _id 
        ORDER BY
            id;
    END IF;
    /*Insert event*/
    IF (_opc= 2) THEN
        INSERT INTO high_season  
            (startEvent, endEvent,  state)
        VALUES 
            ( _startEvent, _endEvent, 'A' );
    END IF;
    /*Update evvent*/
    IF (_opc= 3) THEN
        UPDATE high_season
            SET 
               startEvent = _startevent, 
               endEvent = _endEvent, 
               state = _state
        WHERE 
            id = _id;
    END IF;
    /*Delete record */
    IF (_opc= 4) THEN
        DELETE FROM high_season
        WHERE  id = _id;
    END IF;
    /*Delete all high_season */
    IF (_opc= 5) THEN
        DELETE FROM high_season;
    END IF;
    /*Reinicilizar la tabla */
    IF (_opc= 6) THEN
        TRUNCATE TABLE high_season;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `admon_perfiles` (IN `_opc` INTEGER, IN `_id` INTEGER, IN `_descripcion` VARCHAR(250), IN `_estado` CHAR(1))   BEGIN
    /*Seleccionar todas las empresas*/
    IF (_opc= 0) THEN
        SELECT 
            id, descripcion, estado
        FROM
            perfiles
        ORDER BY
            descripcion;
    END IF;
    /*Seleccionar todas las empresas activas*/
    IF (_opc= 1) THEN
        SELECT 
            id, descripcion, estado
        FROM
            perfiles
        WHERE 
            estado = 'A'
        ORDER BY
            descripcion;
    END IF;
    /*Insertar registro*/
    IF (_opc= 2) THEN
        INSERT INTO perfiles  
            (descripcion, estado)
        VALUES (
            _descripcion, _estado
            );
    END IF;
    /*Actualizar registro*/
    IF (_opc= 3) THEN
        UPDATE perfiles
            SET descripcion = _descripcion
        WHERE 
            id = _id;
    END IF;
    /*Borrar registro*/
    IF (_opc= 4) THEN
        DELETE FROM perfiles
        WHERE  id = _id;
    END IF;
    /*Borrar todos los registros */
    IF (_opc= 5) THEN
        DELETE FROM perfiles;
    END IF;
    /*Reinicilizar la tabla */
    IF (_opc= 6) THEN
        TRUNCATE TABLE perfiles;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `admon_users` (IN `_opc` INTEGER, IN `_coduser` VARCHAR(15), IN `_idnumber_user` VARCHAR(20), IN `_name_user` VARCHAR(150), IN `_nombres` VARCHAR(150), IN `_apellidos` VARCHAR(150), IN `_datebday` DATE, IN `_email_user` VARCHAR(150), IN `_company` VARCHAR(150), IN `_phone` VARCHAR(20), IN `_phone_user` VARCHAR(15), IN `_url` VARCHAR(150), IN `_address` VARCHAR(150), IN `_jobtittle` VARCHAR(100), IN `_notes` VARCHAR(300), IN `_pass_user` VARCHAR(250), IN `_state_user` CHAR(1), IN `_usercode` VARCHAR(15), `_idperfil` INTEGER)   BEGIN
    /*Seleccionar todos los usuarios*/
    IF (_opc= 0) THEN
        SELECT 
            coduser,idnumber_user,name_user,nombres,apellidos,
	        datebday,email_user,company,phone,phone_user,
	        url,address,jobtittle ,notes,pass_user ,
	        state_user
        FROM
            users
        ORDER BY
            name_user;
    END IF;
    /*Seleccionar todos los empleados activos*/
    IF (_opc= 1) THEN
        SELECT 
           u.coduser,u.idnumber_user,u.name_user,u.nombres,u.apellidos,
	        u.datebday,u.email_user,u.company,u.phone,u.phone_user,
	        u.url,u.address,u.jobtittle,u.notes,u.pass_user ,
	        u.state_user, r.idperfil
        FROM
           users u 
        LEFT JOIN  r_perfil_usuario r ON 	r.codusuario = u.coduser
        WHERE 
            state_user = 'A'
        AND 
            coduser = _coduser
        ORDER BY
            name_user;
    END IF;
    /*Insertar registro*/
    IF (_opc= 2) THEN
        INSERT INTO users
            (
                coduser,idnumber_user,name_user,nombres,apellidos,
                datebday,email_user,company,phone,phone_user,
                url,address,jobtittle ,notes,pass_user ,
                state_user, createdby, createddatatime
            )
        VALUES (
                _coduser,_idnumber_user,_name_user,_nombres,_apellidos,
                _datebday,_email_user,_company,_phone,_phone_user,
                _url,_address,_jobtittle ,_notes,_pass_user ,
                _state_user, _usercode, now()
            );
         INSERT INTO r_perfil_usuario (idperfil, codusuario) VALUES (_idperfil, _coduser);   
    END IF;
    /*Actualizar registro*/
    IF (_opc= 3) THEN
        UPDATE users  
            SET 
                coduser =_coduser,
                idnumber_user = _idnumber_user,
                name_user = _name_user,
                nombres = _nombres,
                apellidos = _apellidos,
                datebday = _datebday,
                email_user = _email_user,
                company = _company,
                phone = _phone,
                phone_user = _phone_user,
                url = _url,
                address = _address,
                jobtittle = _jobtittle,
                notes = _notes,
                pass_user = _pass_user ,
                state_user = _state_user,
                modifiedby = _usercode, 
                modifieddatetime = now()
        WHERE 
            coduser = _coduser;
         UPDATE r_perfil_usuario
			   SET idperfil = _idperfil
  		    WHERE codusuario = _coduser;
    END IF;
    /*Borrar registro*/
    IF (_opc= 4) THEN
        DELETE FROM users
        WHERE   coduser = _coduser;
    END IF;
    /*Borrar todos los registros */
    IF (_opc= 5) THEN
        DELETE FROM users;
    END IF;
    /*Reinicilizar la tabla */
    IF (_opc= 6) THEN
        TRUNCATE TABLE users;
    END IF;
    /*Traer la información de los usuarios con perfil comercial*/
    IF (_opc=7) THEN
       SELECT u.coduser, u.name_user, u.email_user, u.phone_user
         FROM r_perfil_usuario r, users u 
        WHERE r.idperfil in (3,4)
         AND  r.codusuario = u.coduser 
        ORDER BY u.name_user;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetCompanyInformation` (IN `_opc` INTEGER, IN `_documentoprivacidad` VARCHAR(250), IN `_documentoterminos` VARCHAR(250), IN `_quienessomos` VARCHAR(8000), IN `_oficina_central` VARCHAR(150), IN `_telefono1` VARCHAR(150), IN `_telefono2` VARCHAR(150), IN `_email_contacto` VARCHAR(150), IN `_diaInicio` VARCHAR(150), IN `_HrInicio` VARCHAR(150), IN `_diaFinal` VARCHAR(150), IN `_HrFinal` VARCHAR(150), IN `_facebook` VARCHAR(150), IN `_twitter` VARCHAR(150), IN `_youtube` VARCHAR(150), IN `_instagram` VARCHAR(150), IN `_user` VARCHAR(50), IN `_password` VARCHAR(150), IN `_emailadministrador` VARCHAR(150))   BEGIN
	IF (_opc = 0) THEN
		SELECT oficina_central, telefono1 AS dialphone, telefono2 AS whatsupphone, email_contacto, diaInicio, HrInicio, 
             diaFinal, HrFinal, QuienesSomos, facebook, twitter, Youtube, user AS useradmin, password AS passwordadmin,
             email_administrador,documentoprivacidad,documentoterminos
  		  FROM configuracion;
	END IF;
	IF (_opc = 1) THEN
		UPDATE configuracion SET
             documentoprivacidad = _documentoprivacidad;
	END IF;
	IF (_opc = 2) THEN
		UPDATE configuracion SET
             documentoterminos = _documentoterminos;
	END IF;
	IF (_opc = 3) THEN
		UPDATE configuracion SET
             QuienesSomos = _quienessomos;
	END IF;
	IF (_opc = 4) THEN
		UPDATE configuracion SET
             oficina_central = _oficina_central, 
				 telefono1 = _telefono1, 
				 telefono2 = _telefono2, 
				 email_contacto = _email_contacto, 
				 diaInicio = _diaInicio,
				 HrInicio = _HrInicio,
				 diaFinal = _diaFinal, 
				 HrFinal = _HrFinal,
				 facebook = _facebook, 
				 twitter = _twitter, 
				 Youtube = _youtube, 
				 instagram = _instagram;
	END IF;
	IF (_opc = 5) THEN
		UPDATE configuracion SET
				user = _user,
				password = _password, 
				email_administrador = _emailadministrador;
	END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `id` int(11) NOT NULL,
  `id_pais` int(11) NOT NULL,
  `nombre_ciudad` varchar(100) NOT NULL,
  `id_departamentos` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`id`, `id_pais`, `nombre_ciudad`, `id_departamentos`) VALUES
(1, 1, 'MEDELLIN', '5'),
(2, 1, 'ABEJORRAL', '5'),
(3, 1, 'ABRIAQUI', '5'),
(4, 1, 'ALEJANDRIA', '5'),
(5, 1, 'AMAGA', '5'),
(6, 1, 'AMALFI', '5'),
(7, 1, 'ANDES', '5'),
(8, 1, 'ANGELOPOLIS', '5'),
(9, 1, 'ANGOSTURA', '5'),
(10, 1, 'ANORI', '5'),
(11, 1, 'SANTAFE DE ANTIOQUIA', '5'),
(12, 1, 'ANZA', '5'),
(13, 1, 'APARTADO', '5'),
(14, 1, 'ARBOLETES', '5'),
(15, 1, 'ARGELIA', '5'),
(16, 1, 'ARMENIA', '5'),
(17, 1, 'BARBOSA', '5'),
(18, 1, 'BELMIRA', '5'),
(19, 1, 'BELLO', '5'),
(20, 1, 'BETANIA', '5'),
(21, 1, 'BETULIA', '5'),
(22, 1, 'CIUDAD BOLIVAR', '5'),
(23, 1, 'BRICEÑO', '5'),
(24, 1, 'BURITICA', '5'),
(25, 1, 'CACERES', '5'),
(26, 1, 'CAICEDO', '5'),
(27, 1, 'CALDAS', '5'),
(28, 1, 'CAMPAMENTO', '5'),
(29, 1, 'CAÑASGORDAS', '5'),
(30, 1, 'CARACOLI', '5'),
(31, 1, 'CARAMANTA', '5'),
(32, 1, 'CAREPA', '5'),
(33, 1, 'EL CARMEN DE VIBORAL', '5'),
(34, 1, 'CAROLINA', '5'),
(35, 1, 'CAUCASIA', '5'),
(36, 1, 'CHIGORODO', '5'),
(37, 1, 'CISNEROS', '5'),
(38, 1, 'COCORNA', '5'),
(39, 1, 'CONCEPCION', '5'),
(40, 1, 'CONCORDIA', '5'),
(41, 1, 'COPACABANA', '5'),
(42, 1, 'DABEIBA', '5'),
(43, 1, 'DON MATIAS', '5'),
(44, 1, 'EBEJICO', '5'),
(45, 1, 'EL BAGRE', '5'),
(46, 1, 'ENTRERRIOS', '5'),
(47, 1, 'ENVIGADO', '5'),
(48, 1, 'FREDONIA', '5'),
(49, 1, 'FRONTINO', '5'),
(50, 1, 'GIRALDO', '5'),
(51, 1, 'GIRARDOTA', '5'),
(52, 1, 'GOMEZ PLATA', '5'),
(53, 1, 'GRANADA', '5'),
(54, 1, 'GUADALUPE', '5'),
(55, 1, 'GUARNE', '5'),
(56, 1, 'GUATAPE', '5'),
(57, 1, 'HELICONIA', '5'),
(58, 1, 'HISPANIA', '5'),
(59, 1, 'ITAGÜI', '5'),
(60, 1, 'ITUANGO', '5'),
(61, 1, 'JARDIN', '5'),
(62, 1, 'JERICO', '5'),
(63, 1, 'LA CEJA', '5'),
(64, 1, 'LA ESTRELLA', '5'),
(65, 1, 'LA PINTADA', '5'),
(66, 1, 'LA UNION', '5'),
(67, 1, 'LIBORINA', '5'),
(68, 1, 'MACEO', '5'),
(69, 1, 'MARINILLA', '5'),
(70, 1, 'MONTEBELLO', '5'),
(71, 1, 'MURINDO', '5'),
(72, 1, 'MUTATA', '5'),
(73, 1, 'NARIÑO', '5'),
(74, 1, 'NECOCLI', '5'),
(75, 1, 'NECHI', '5'),
(76, 1, 'OLAYA', '5'),
(77, 1, 'PEÑOL', '5'),
(78, 1, 'PEQUE', '5'),
(79, 1, 'PUEBLORRICO', '5'),
(80, 1, 'PUERTO BERRIO', '5'),
(81, 1, 'PUERTO NARE', '5'),
(82, 1, 'PUERTO TRIUNFO', '5'),
(83, 1, 'REMEDIOS', '5'),
(84, 1, 'RETIRO', '5'),
(85, 1, 'RIONEGRO', '5'),
(86, 1, 'SABANALARGA', '5'),
(87, 1, 'SABANETA', '5'),
(88, 1, 'SALGAR', '5'),
(89, 1, 'SAN ANDRES', '5'),
(90, 1, 'SAN CARLOS', '5'),
(91, 1, 'SAN FRANCISCO', '5'),
(92, 1, 'SAN JERONIMO', '5'),
(93, 1, 'SAN JOSE DE LA MONTAÑA', '5'),
(94, 1, 'SAN JUAN DE URABA', '5'),
(95, 1, 'SAN LUIS', '5'),
(96, 1, 'SAN PEDRO', '5'),
(97, 1, 'SAN PEDRO DE URABA', '5'),
(98, 1, 'SAN RAFAEL', '5'),
(99, 1, 'SAN ROQUE', '5'),
(100, 1, 'SAN VICENTE', '5'),
(101, 1, 'SANTA BARBARA', '5'),
(102, 1, 'SANTA ROSA DE OSOS', '5'),
(103, 1, 'SANTO DOMINGO', '5'),
(104, 1, 'EL SANTUARIO', '5'),
(105, 1, 'SEGOVIA', '5'),
(106, 1, 'SONSON', '5'),
(107, 1, 'SOPETRAN', '5'),
(108, 1, 'TAMESIS', '5'),
(109, 1, 'TARAZA', '5'),
(110, 1, 'TARSO', '5'),
(111, 1, 'TITIRIBI', '5'),
(112, 1, 'TOLEDO', '5'),
(113, 1, 'TURBO', '5'),
(114, 1, 'URAMITA', '5'),
(115, 1, 'URRAO', '5'),
(116, 1, 'VALDIVIA', '5'),
(117, 1, 'VALPARAISO', '5'),
(118, 1, 'VEGACHI', '5'),
(119, 1, 'VENECIA', '5'),
(120, 1, 'VIGIA DEL FUERTE', '5'),
(121, 1, 'YALI', '5'),
(122, 1, 'YARUMAL', '5'),
(123, 1, 'YOLOMBO', '5'),
(124, 1, 'YONDO', '5'),
(125, 1, 'ZARAGOZA', '5'),
(126, 1, 'BARRANQUILLA', '8'),
(127, 1, 'BARANOA', '8'),
(128, 1, 'CAMPO DE LA CRUZ', '8'),
(129, 1, 'CANDELARIA', '8'),
(130, 1, 'GALAPA', '8'),
(131, 1, 'JUAN DE ACOSTA', '8'),
(132, 1, 'LURUACO', '8'),
(133, 1, 'MALAMBO', '8'),
(134, 1, 'MANATI', '8'),
(135, 1, 'PALMAR DE VARELA', '8'),
(136, 1, 'PIOJO', '8'),
(137, 1, 'POLONUEVO', '8'),
(138, 1, 'PONEDERA', '8'),
(139, 1, 'PUERTO COLOMBIA', '8'),
(140, 1, 'REPELON', '8'),
(141, 1, 'SABANAGRANDE', '8'),
(142, 1, 'SABANALARGA', '8'),
(143, 1, 'SANTA LUCIA', '8'),
(144, 1, 'SANTO TOMAS', '8'),
(145, 1, 'SOLEDAD', '8'),
(146, 1, 'SUAN', '8'),
(147, 1, 'TUBARA', '8'),
(148, 1, 'USIACURI', '8'),
(149, 1, 'BOGOTA', '11'),
(150, 1, 'CARTAGENA', '13'),
(151, 1, 'ACHI', '13'),
(152, 1, 'ALTOS DEL ROSARIO', '13'),
(153, 1, 'ARENAL', '13'),
(154, 1, 'ARJONA', '13'),
(155, 1, 'ARROYOHONDO', '13'),
(156, 1, 'BARRANCO DE LOBA', '13'),
(157, 1, 'CALAMAR', '13'),
(158, 1, 'CANTAGALLO', '13'),
(159, 1, 'CICUCO', '13'),
(160, 1, 'CORDOBA', '13'),
(161, 1, 'CLEMENCIA', '13'),
(162, 1, 'EL CARMEN DE BOLIVAR', '13'),
(163, 1, 'EL GUAMO', '13'),
(164, 1, 'EL PEÑON', '13'),
(165, 1, 'HATILLO DE LOBA', '13'),
(166, 1, 'MAGANGUE', '13'),
(167, 1, 'MAHATES', '13'),
(168, 1, 'MARGARITA', '13'),
(169, 1, 'MARIA LA BAJA', '13'),
(170, 1, 'MONTECRISTO', '13'),
(171, 1, 'MOMPOS', '13'),
(172, 1, 'MORALES', '13'),
(173, 1, 'PINILLOS', '13'),
(174, 1, 'REGIDOR', '13'),
(175, 1, 'RIO VIEJO', '13'),
(176, 1, 'SAN CRISTOBAL', '13'),
(177, 1, 'SAN ESTANISLAO', '13'),
(178, 1, 'SAN FERNANDO', '13'),
(179, 1, 'SAN JACINTO', '13'),
(180, 1, 'SAN JACINTO DEL CAUCA', '13'),
(181, 1, 'SAN JUAN NEPOMUCENO', '13'),
(182, 1, 'SAN MARTIN DE LOBA', '13'),
(183, 1, 'SAN PABLO', '13'),
(184, 1, 'SANTA CATALINA', '13'),
(185, 1, 'SANTA ROSA', '13'),
(186, 1, 'SANTA ROSA DEL SUR', '13'),
(187, 1, 'SIMITI', '13'),
(188, 1, 'SOPLAVIENTO', '13'),
(189, 1, 'TALAIGUA NUEVO', '13'),
(190, 1, 'TIQUISIO', '13'),
(191, 1, 'TURBACO', '13'),
(192, 1, 'TURBANA', '13'),
(193, 1, 'VILLANUEVA', '13'),
(194, 1, 'ZAMBRANO', '13'),
(195, 1, 'TUNJA', '15'),
(196, 1, 'ALMEIDA', '15'),
(197, 1, 'AQUITANIA', '15'),
(198, 1, 'ARCABUCO', '15'),
(199, 1, 'BELEN', '15'),
(200, 1, 'BERBEO', '15'),
(201, 1, 'BETEITIVA', '15'),
(202, 1, 'BOAVITA', '15'),
(203, 1, 'BOYACA', '15'),
(204, 1, 'BRICEÑO', '15'),
(205, 1, 'BUENAVISTA', '15'),
(206, 1, 'BUSBANZA', '15'),
(207, 1, 'CALDAS', '15'),
(208, 1, 'CAMPOHERMOSO', '15'),
(209, 1, 'CERINZA', '15'),
(210, 1, 'CHINAVITA', '15'),
(211, 1, 'CHIQUINQUIRA', '15'),
(212, 1, 'CHISCAS', '15'),
(213, 1, 'CHITA', '15'),
(214, 1, 'CHITARAQUE', '15'),
(215, 1, 'CHIVATA', '15'),
(216, 1, 'CIENEGA', '15'),
(217, 1, 'COMBITA', '15'),
(218, 1, 'COPER', '15'),
(219, 1, 'CORRALES', '15'),
(220, 1, 'COVARACHIA', '15'),
(221, 1, 'CUBARA', '15'),
(222, 1, 'CUCAITA', '15'),
(223, 1, 'CUITIVA', '15'),
(224, 1, 'CHIQUIZA', '15'),
(225, 1, 'CHIVOR', '15'),
(226, 1, 'DUITAMA', '15'),
(227, 1, 'EL COCUY', '15'),
(228, 1, 'EL ESPINO', '15'),
(229, 1, 'FIRAVITOBA', '15'),
(230, 1, 'FLORESTA', '15'),
(231, 1, 'GACHANTIVA', '15'),
(232, 1, 'GAMEZA', '15'),
(233, 1, 'GARAGOA', '15'),
(234, 1, 'GUACAMAYAS', '15'),
(235, 1, 'GUATEQUE', '15'),
(236, 1, 'GUAYATA', '15'),
(237, 1, 'GÜICAN', '15'),
(238, 1, 'IZA', '15'),
(239, 1, 'JENESANO', '15'),
(240, 1, 'JERICO', '15'),
(241, 1, 'LABRANZAGRANDE', '15'),
(242, 1, 'LA CAPILLA', '15'),
(243, 1, 'LA VICTORIA', '15'),
(244, 1, 'LA UVITA', '15'),
(245, 1, 'VILLA DE LEYVA', '15'),
(246, 1, 'MACANAL', '15'),
(247, 1, 'MARIPI', '15'),
(248, 1, 'MIRAFLORES', '15'),
(249, 1, 'MONGUA', '15'),
(250, 1, 'MONGUI', '15'),
(251, 1, 'MONIQUIRA', '15'),
(252, 1, 'MOTAVITA', '15'),
(253, 1, 'MUZO', '15'),
(254, 1, 'NOBSA', '15'),
(255, 1, 'NUEVO COLON', '15'),
(256, 1, 'OICATA', '15'),
(257, 1, 'OTANCHE', '15'),
(258, 1, 'PACHAVITA', '15'),
(259, 1, 'PAEZ', '15'),
(260, 1, 'PAIPA', '15'),
(261, 1, 'PAJARITO', '15'),
(262, 1, 'PANQUEBA', '15'),
(263, 1, 'PAUNA', '15'),
(264, 1, 'PAYA', '15'),
(265, 1, 'PAZ DE RIO', '15'),
(266, 1, 'PESCA', '15'),
(267, 1, 'PISBA', '15'),
(268, 1, 'PUERTO BOYACA', '15'),
(269, 1, 'QUIPAMA', '15'),
(270, 1, 'RAMIRIQUI', '15'),
(271, 1, 'RAQUIRA', '15'),
(272, 1, 'RONDON', '15'),
(273, 1, 'SABOYA', '15'),
(274, 1, 'SACHICA', '15'),
(275, 1, 'SAMACA', '15'),
(276, 1, 'SAN EDUARDO', '15'),
(277, 1, 'SAN JOSE DE PARE', '15'),
(278, 1, 'SAN LUIS DE GACENO', '15'),
(279, 1, 'SAN MATEO', '15'),
(280, 1, 'SAN MIGUEL DE SEMA', '15'),
(281, 1, 'SAN PABLO DE BORBUR', '15'),
(282, 1, 'SANTANA', '15'),
(283, 1, 'SANTA MARIA', '15'),
(284, 1, 'SANTA ROSA DE VITERBO', '15'),
(285, 1, 'SANTA SOFIA', '15'),
(286, 1, 'SATIVANORTE', '15'),
(287, 1, 'SATIVASUR', '15'),
(288, 1, 'SIACHOQUE', '15'),
(289, 1, 'SOATA', '15'),
(290, 1, 'SOCOTA', '15'),
(291, 1, 'SOCHA', '15'),
(292, 1, 'SOGAMOSO', '15'),
(293, 1, 'SOMONDOCO', '15'),
(294, 1, 'SORA', '15'),
(295, 1, 'SOTAQUIRA', '15'),
(296, 1, 'SORACA', '15'),
(297, 1, 'SUSACON', '15'),
(298, 1, 'SUTAMARCHAN', '15'),
(299, 1, 'SUTATENZA', '15'),
(300, 1, 'TASCO', '15'),
(301, 1, 'TENZA', '15'),
(302, 1, 'TIBANA', '15'),
(303, 1, 'TIBASOSA', '15'),
(304, 1, 'TINJACA', '15'),
(305, 1, 'TIPACOQUE', '15'),
(306, 1, 'TOCA', '15'),
(307, 1, 'TOGÜI', '15'),
(308, 1, 'TOPAGA', '15'),
(309, 1, 'TOTA', '15'),
(310, 1, 'TUNUNGUA', '15'),
(311, 1, 'TURMEQUE', '15'),
(312, 1, 'TUTA', '15'),
(313, 1, 'TUTAZA', '15'),
(314, 1, 'UMBITA', '15'),
(315, 1, 'VENTAQUEMADA', '15'),
(316, 1, 'VIRACACHA', '15'),
(317, 1, 'ZETAQUIRA', '15'),
(318, 1, 'MANIZALES', '17'),
(319, 1, 'AGUADAS', '17'),
(320, 1, 'ANSERMA', '17'),
(321, 1, 'ARANZAZU', '17'),
(322, 1, 'BELALCAZAR', '17'),
(323, 1, 'CHINCHINA', '17'),
(324, 1, 'FILADELFIA', '17'),
(325, 1, 'LA DORADA', '17'),
(326, 1, 'LA MERCED', '17'),
(327, 1, 'MANZANARES', '17'),
(328, 1, 'MARMATO', '17'),
(329, 1, 'MARQUETALIA', '17'),
(330, 1, 'MARULANDA', '17'),
(331, 1, 'NEIRA', '17'),
(332, 1, 'NORCASIA', '17'),
(333, 1, 'PACORA', '17'),
(334, 1, 'PALESTINA', '17'),
(335, 1, 'PENSILVANIA', '17'),
(336, 1, 'RIOSUCIO', '17'),
(337, 1, 'RISARALDA', '17'),
(338, 1, 'SALAMINA', '17'),
(339, 1, 'SAMANA', '17'),
(340, 1, 'SAN JOSE', '17'),
(341, 1, 'SUPIA', '17'),
(342, 1, 'VICTORIA', '17'),
(343, 1, 'VILLAMARIA', '17'),
(344, 1, 'VITERBO', '17'),
(345, 1, 'FLORENCIA', '18'),
(346, 1, 'ALBANIA', '18'),
(347, 1, 'BELEN DE LOS ANDAQUIES', '18'),
(348, 1, 'CARTAGENA DEL CHAIRA', '18'),
(349, 1, 'CURILLO', '18'),
(350, 1, 'EL DONCELLO', '18'),
(351, 1, 'EL PAUJIL', '18'),
(352, 1, 'LA MONTAÑITA', '18'),
(353, 1, 'MILAN', '18'),
(354, 1, 'MORELIA', '18'),
(355, 1, 'PUERTO RICO', '18'),
(356, 1, 'SAN JOSE DE LA FRAGUA', '18'),
(357, 1, 'SAN VICENTE DEL CAGUAN', '18'),
(358, 1, 'SOLANO', '18'),
(359, 1, 'SOLITA', '18'),
(360, 1, 'VALPARAISO', '18'),
(361, 1, 'POPAYAN', '19'),
(362, 1, 'ALMAGUER', '19'),
(363, 1, 'ARGELIA', '19'),
(364, 1, 'BALBOA', '19'),
(365, 1, 'BOLIVAR', '19'),
(366, 1, 'BUENOS AIRES', '19'),
(367, 1, 'CAJIBIO', '19'),
(368, 1, 'CALDONO', '19'),
(369, 1, 'CALOTO', '19'),
(370, 1, 'CORINTO', '19'),
(371, 1, 'EL TAMBO', '19'),
(372, 1, 'FLORENCIA', '19'),
(373, 1, 'GUAPI', '19'),
(374, 1, 'INZA', '19'),
(375, 1, 'JAMBALO', '19'),
(376, 1, 'LA SIERRA', '19'),
(377, 1, 'LA VEGA', '19'),
(378, 1, 'LOPEZ', '19'),
(379, 1, 'MERCADERES', '19'),
(380, 1, 'MIRANDA', '19'),
(381, 1, 'MORALES', '19'),
(382, 1, 'PADILLA', '19'),
(383, 1, 'PAEZ', '19'),
(384, 1, 'PATIA', '19'),
(385, 1, 'PIAMONTE', '19'),
(386, 1, 'PIENDAMO', '19'),
(387, 1, 'PUERTO TEJADA', '19'),
(388, 1, 'PURACE', '19'),
(389, 1, 'ROSAS', '19'),
(390, 1, 'SAN SEBASTIAN', '19'),
(391, 1, 'SANTANDER DE QUILICHAO', '19'),
(392, 1, 'SANTA ROSA', '19'),
(393, 1, 'SILVIA', '19'),
(394, 1, 'SOTARA', '19'),
(395, 1, 'SUAREZ', '19'),
(396, 1, 'SUCRE', '19'),
(397, 1, 'TIMBIO', '19'),
(398, 1, 'TIMBIQUI', '19'),
(399, 1, 'TORIBIO', '19'),
(400, 1, 'TOTORO', '19'),
(401, 1, 'VILLA RICA', '19'),
(402, 1, 'VALLEDUPAR', '20'),
(403, 1, 'AGUACHICA', '20'),
(404, 1, 'AGUSTIN CODAZZI', '20'),
(405, 1, 'ASTREA', '20'),
(406, 1, 'BECERRIL', '20'),
(407, 1, 'BOSCONIA', '20'),
(408, 1, 'CHIMICHAGUA', '20'),
(409, 1, 'CHIRIGUANA', '20'),
(410, 1, 'CURUMANI', '20'),
(411, 1, 'EL COPEY', '20'),
(412, 1, 'EL PASO', '20'),
(413, 1, 'GAMARRA', '20'),
(414, 1, 'GONZALEZ', '20'),
(415, 1, 'LA GLORIA', '20'),
(416, 1, 'LA JAGUA DE IBIRICO', '20'),
(417, 1, 'MANAURE', '20'),
(418, 1, 'PAILITAS', '20'),
(419, 1, 'PELAYA', '20'),
(420, 1, 'PUEBLO BELLO', '20'),
(421, 1, 'RIO DE ORO', '20'),
(422, 1, 'LA PAZ', '20'),
(423, 1, 'SAN ALBERTO', '20'),
(424, 1, 'SAN DIEGO', '20'),
(425, 1, 'SAN MARTIN', '20'),
(426, 1, 'TAMALAMEQUE', '20'),
(427, 1, 'MONTERIA', '23'),
(428, 1, 'AYAPEL', '23'),
(429, 1, 'BUENAVISTA', '23'),
(430, 1, 'CANALETE', '23'),
(431, 1, 'CERETE', '23'),
(432, 1, 'CHIMA', '23'),
(433, 1, 'CHINU', '23'),
(434, 1, 'CIENAGA DE ORO', '23'),
(435, 1, 'COTORRA', '23'),
(436, 1, 'LA APARTADA', '23'),
(437, 1, 'LORICA', '23'),
(438, 1, 'LOS CORDOBAS', '23'),
(439, 1, 'MOMIL', '23'),
(440, 1, 'MONTELIBANO', '23'),
(441, 1, 'MOÑITOS', '23'),
(442, 1, 'PLANETA RICA', '23'),
(443, 1, 'PUEBLO NUEVO', '23'),
(444, 1, 'PUERTO ESCONDIDO', '23'),
(445, 1, 'PUERTO LIBERTADOR', '23'),
(446, 1, 'PURISIMA', '23'),
(447, 1, 'SAHAGUN', '23'),
(448, 1, 'SAN ANDRES DE SOTAVENTO', '23'),
(449, 1, 'SAN ANTERO', '23'),
(450, 1, 'SAN BERNARDO DEL VIENTO', '23'),
(451, 1, 'SAN CARLOS', '23'),
(452, 1, 'SAN PELAYO', '23'),
(453, 1, 'TIERRALTA', '23'),
(454, 1, 'VALENCIA', '23'),
(455, 1, 'AGUA DE DIOS', '25'),
(456, 1, 'ALBAN', '25'),
(457, 1, 'ANAPOIMA', '25'),
(458, 1, 'ANOLAIMA', '25'),
(459, 1, 'ARBELAEZ', '25'),
(460, 1, 'BELTRAN', '25'),
(461, 1, 'BITUIMA', '25'),
(462, 1, 'BOJACA', '25'),
(463, 1, 'CABRERA', '25'),
(464, 1, 'CACHIPAY', '25'),
(465, 1, 'CAJICA', '25'),
(466, 1, 'CAPARRAPI', '25'),
(467, 1, 'CAQUEZA', '25'),
(468, 1, 'CARMEN DE CARUPA', '25'),
(469, 1, 'CHAGUANI', '25'),
(470, 1, 'CHIA', '25'),
(471, 1, 'CHIPAQUE', '25'),
(472, 1, 'CHOACHI', '25'),
(473, 1, 'CHOCONTA', '25'),
(474, 1, 'COGUA', '25'),
(475, 1, 'COTA', '25'),
(476, 1, 'CUCUNUBA', '25'),
(477, 1, 'EL COLEGIO', '25'),
(478, 1, 'EL PEÑON', '25'),
(479, 1, 'EL ROSAL', '25'),
(480, 1, 'FACATATIVA', '25'),
(481, 1, 'FOMEQUE', '25'),
(482, 1, 'FOSCA', '25'),
(483, 1, 'FUNZA', '25'),
(484, 1, 'FUQUENE', '25'),
(485, 1, 'FUSAGASUGA', '25'),
(486, 1, 'GACHALA', '25'),
(487, 1, 'GACHANCIPA', '25'),
(488, 1, 'GACHETA', '25'),
(489, 1, 'GAMA', '25'),
(490, 1, 'GIRARDOT', '25'),
(491, 1, 'GRANADA', '25'),
(492, 1, 'GUACHETA', '25'),
(493, 1, 'GUADUAS', '25'),
(494, 1, 'GUASCA', '25'),
(495, 1, 'GUATAQUI', '25'),
(496, 1, 'GUATAVITA', '25'),
(497, 1, 'GUAYABAL DE SIQUIMA', '25'),
(498, 1, 'GUAYABETAL', '25'),
(499, 1, 'GUTIERREZ', '25'),
(500, 1, 'JERUSALEN', '25'),
(501, 1, 'JUNIN', '25'),
(502, 1, 'LA CALERA', '25'),
(503, 1, 'LA MESA', '25'),
(504, 1, 'LA PALMA', '25'),
(505, 1, 'LA PEÑA', '25'),
(506, 1, 'LA VEGA', '25'),
(507, 1, 'LENGUAZAQUE', '25'),
(508, 1, 'MACHETA', '25'),
(509, 1, 'MADRID', '25'),
(510, 1, 'MANTA', '25'),
(511, 1, 'MEDINA', '25'),
(512, 1, 'MOSQUERA', '25'),
(513, 1, 'NARIÑO', '25'),
(514, 1, 'NEMOCON', '25'),
(515, 1, 'NILO', '25'),
(516, 1, 'NIMAIMA', '25'),
(517, 1, 'NOCAIMA', '25'),
(518, 1, 'VENECIA', '25'),
(519, 1, 'PACHO', '25'),
(520, 1, 'PAIME', '25'),
(521, 1, 'PANDI', '25'),
(522, 1, 'PARATEBUENO', '25'),
(523, 1, 'PASCA', '25'),
(524, 1, 'PUERTO SALGAR', '25'),
(525, 1, 'PULI', '25'),
(526, 1, 'QUEBRADANEGRA', '25'),
(527, 1, 'QUETAME', '25'),
(528, 1, 'QUIPILE', '25'),
(529, 1, 'APULO', '25'),
(530, 1, 'RICAURTE', '25'),
(531, 1, 'SAN ANTONIO DEL TEQUENDAMA', '25'),
(532, 1, 'SAN BERNARDO', '25'),
(533, 1, 'SAN CAYETANO', '25'),
(534, 1, 'SAN FRANCISCO', '25'),
(535, 1, 'SAN JUAN DE RIO SECO', '25'),
(536, 1, 'SASAIMA', '25'),
(537, 1, 'SESQUILE', '25'),
(538, 1, 'SIBATE', '25'),
(539, 1, 'SILVANIA', '25'),
(540, 1, 'SIMIJACA', '25'),
(541, 1, 'SOACHA', '25'),
(542, 1, 'SOPO', '25'),
(543, 1, 'SUBACHOQUE', '25'),
(544, 1, 'SUESCA', '25'),
(545, 1, 'SUPATA', '25'),
(546, 1, 'SUSA', '25'),
(547, 1, 'SUTATAUSA', '25'),
(548, 1, 'TABIO', '25'),
(549, 1, 'TAUSA', '25'),
(550, 1, 'TENA', '25'),
(551, 1, 'TENJO', '25'),
(552, 1, 'TIBACUY', '25'),
(553, 1, 'TIBIRITA', '25'),
(554, 1, 'TOCAIMA', '25'),
(555, 1, 'TOCANCIPA', '25'),
(556, 1, 'TOPAIPI', '25'),
(557, 1, 'UBALA', '25'),
(558, 1, 'UBAQUE', '25'),
(559, 1, 'VILLA DE SAN DIEGO DE UBATE', '25'),
(560, 1, 'UNE', '25'),
(561, 1, 'UTICA', '25'),
(562, 1, 'VERGARA', '25'),
(563, 1, 'VIANI', '25'),
(564, 1, 'VILLAGOMEZ', '25'),
(565, 1, 'VILLAPINZON', '25'),
(566, 1, 'VILLETA', '25'),
(567, 1, 'VIOTA', '25'),
(568, 1, 'YACOPI', '25'),
(569, 1, 'ZIPACON', '25'),
(570, 1, 'ZIPAQUIRA', '25'),
(571, 1, 'QUIBDO', '27'),
(572, 1, 'ACANDI', '27'),
(573, 1, 'ALTO BAUDO', '27'),
(574, 1, 'ATRATO', '27'),
(575, 1, 'BAGADO', '27'),
(576, 1, 'BAHIA SOLANO', '27'),
(577, 1, 'BAJO BAUDO', '27'),
(578, 1, 'BELEN DE BAJIRA', '27'),
(579, 1, 'BOJAYA', '27'),
(580, 1, 'EL CANTON DEL SAN PABLO', '27'),
(581, 1, 'CARMEN DEL DARIEN', '27'),
(582, 1, 'CERTEGUI', '27'),
(583, 1, 'CONDOTO', '27'),
(584, 1, 'EL CARMEN DE ATRATO', '27'),
(585, 1, 'EL LITORAL DEL SAN JUAN', '27'),
(586, 1, 'ISTMINA', '27'),
(587, 1, 'JURADO', '27'),
(588, 1, 'LLORO', '27'),
(589, 1, 'MEDIO ATRATO', '27'),
(590, 1, 'MEDIO BAUDO', '27'),
(591, 1, 'MEDIO SAN JUAN', '27'),
(592, 1, 'NOVITA', '27'),
(593, 1, 'NUQUI', '27'),
(594, 1, 'RIO IRO', '27'),
(595, 1, 'RIO QUITO', '27'),
(596, 1, 'RIOSUCIO', '27'),
(597, 1, 'SAN JOSE DEL PALMAR', '27'),
(598, 1, 'SIPI', '27'),
(599, 1, 'TADO', '27'),
(600, 1, 'UNGUIA', '27'),
(601, 1, 'UNION PANAMERICANA', '27'),
(602, 1, 'NEIVA', '41'),
(603, 1, 'ACEVEDO', '41'),
(604, 1, 'AGRADO', '41'),
(605, 1, 'AIPE', '41'),
(606, 1, 'ALGECIRAS', '41'),
(607, 1, 'ALTAMIRA', '41'),
(608, 1, 'BARAYA', '41'),
(609, 1, 'CAMPOALEGRE', '41'),
(610, 1, 'COLOMBIA', '41'),
(611, 1, 'ELIAS', '41'),
(612, 1, 'GARZON', '41'),
(613, 1, 'GIGANTE', '41'),
(614, 1, 'GUADALUPE', '41'),
(615, 1, 'HOBO', '41'),
(616, 1, 'IQUIRA', '41'),
(617, 1, 'ISNOS', '41'),
(618, 1, 'LA ARGENTINA', '41'),
(619, 1, 'LA PLATA', '41'),
(620, 1, 'NATAGA', '41'),
(621, 1, 'OPORAPA', '41'),
(622, 1, 'PAICOL', '41'),
(623, 1, 'PALERMO', '41'),
(624, 1, 'PALESTINA', '41'),
(625, 1, 'PITAL', '41'),
(626, 1, 'PITALITO', '41'),
(627, 1, 'RIVERA', '41'),
(628, 1, 'SALADOBLANCO', '41'),
(629, 1, 'SAN AGUSTIN', '41'),
(630, 1, 'SANTA MARIA', '41'),
(631, 1, 'SUAZA', '41'),
(632, 1, 'TARQUI', '41'),
(633, 1, 'TESALIA', '41'),
(634, 1, 'TELLO', '41'),
(635, 1, 'TERUEL', '41'),
(636, 1, 'TIMANA', '41'),
(637, 1, 'VILLAVIEJA', '41'),
(638, 1, 'YAGUARA', '41'),
(639, 1, 'RIOHACHA', '44'),
(640, 1, 'ALBANIA', '44'),
(641, 1, 'BARRANCAS', '44'),
(642, 1, 'DIBULLA', '44'),
(643, 1, 'DISTRACCION', '44'),
(644, 1, 'EL MOLINO', '44'),
(645, 1, 'FONSECA', '44'),
(646, 1, 'HATONUEVO', '44'),
(647, 1, 'LA JAGUA DEL PILAR', '44'),
(648, 1, 'MAICAO', '44'),
(649, 1, 'MANAURE', '44'),
(650, 1, 'SAN JUAN DEL CESAR', '44'),
(651, 1, 'URIBIA', '44'),
(652, 1, 'URUMITA', '44'),
(653, 1, 'VILLANUEVA', '44'),
(654, 1, 'SANTA MARTA', '47'),
(655, 1, 'ALGARROBO', '47'),
(656, 1, 'ARACATACA', '47'),
(657, 1, 'ARIGUANI', '47'),
(658, 1, 'CERRO SAN ANTONIO', '47'),
(659, 1, 'CHIVOLO', '47'),
(660, 1, 'CIENAGA', '47'),
(661, 1, 'CONCORDIA', '47'),
(662, 1, 'EL BANCO', '47'),
(663, 1, 'EL PIÑON', '47'),
(664, 1, 'EL RETEN', '47'),
(665, 1, 'FUNDACION', '47'),
(666, 1, 'GUAMAL', '47'),
(667, 1, 'NUEVA GRANADA', '47'),
(668, 1, 'PEDRAZA', '47'),
(669, 1, 'PIJIÑO DEL CARMEN', '47'),
(670, 1, 'PIVIJAY', '47'),
(671, 1, 'PLATO', '47'),
(672, 1, 'PUEBLOVIEJO', '47'),
(673, 1, 'REMOLINO', '47'),
(674, 1, 'SABANAS DE SAN ANGEL', '47'),
(675, 1, 'SALAMINA', '47'),
(676, 1, 'SAN', '47'),
(677, 1, 'SAN ZENON', '47'),
(678, 1, 'SANTA ANA', '47'),
(679, 1, 'SANTA BARBARA DE PINTO', '47'),
(680, 1, 'SITIONUEVO', '47'),
(681, 1, 'TENERIFE', '47'),
(682, 1, 'ZAPAYAN', '47'),
(683, 1, 'ZONA BANANERA', '47'),
(684, 1, 'VILLAVICENCIO', '50'),
(685, 1, 'ACACIAS', '50'),
(686, 1, 'BARRANCA DE UPIA', '50'),
(687, 1, 'CABUYARO', '50'),
(688, 1, 'CASTILLA LA NUEVA', '50'),
(689, 1, 'CUBARRAL', '50'),
(690, 1, 'CUMARAL', '50'),
(691, 1, 'EL CALVARIO', '50'),
(692, 1, 'EL CASTILLO', '50'),
(693, 1, 'EL DORADO', '50'),
(694, 1, 'FUENTE DE ORO', '50'),
(695, 1, 'GRANADA', '50'),
(696, 1, 'GUAMAL', '50'),
(697, 1, 'MAPIRIPAN', '50'),
(698, 1, 'MESETAS', '50'),
(699, 1, 'LA MACARENA', '50'),
(700, 1, 'URIBE', '50'),
(701, 1, 'LEJANIAS', '50'),
(702, 1, 'PUERTO CONCORDIA', '50'),
(703, 1, 'PUERTO GAITAN', '50'),
(704, 1, 'PUERTO LOPEZ', '50'),
(705, 1, 'PUERTO LLERAS', '50'),
(706, 1, 'PUERTO RICO', '50'),
(707, 1, 'RESTREPO', '50'),
(708, 1, 'SAN CARLOS DE GUAROA', '50'),
(709, 1, 'SAN JUAN DE ARAMA', '50'),
(710, 1, 'SAN JUANITO', '50'),
(711, 1, 'SAN MARTIN', '50'),
(712, 1, 'VISTA HERMOSA', '50'),
(713, 1, 'PASTO', '52'),
(714, 1, 'ALBAN', '52'),
(715, 1, 'ALDANA', '52'),
(716, 1, 'ANCUYA', '52'),
(717, 1, 'ARBOLEDA', '52'),
(718, 1, 'BARBACOAS', '52'),
(719, 1, 'BELEN', '52'),
(720, 1, 'BUESACO', '52'),
(721, 1, 'COLON', '52'),
(722, 1, 'CONSACA', '52'),
(723, 1, 'CONTADERO', '52'),
(724, 1, 'CORDOBA', '52'),
(725, 1, 'CUASPUD', '52'),
(726, 1, 'CUMBAL', '52'),
(727, 1, 'CUMBITARA', '52'),
(728, 1, 'CHACHAGÜI', '52'),
(729, 1, 'EL CHARCO', '52'),
(730, 1, 'EL PEÑOL', '52'),
(731, 1, 'EL ROSARIO', '52'),
(732, 1, 'EL TABLON DE GOMEZ', '52'),
(733, 1, 'EL TAMBO', '52'),
(734, 1, 'FUNES', '52'),
(735, 1, 'GUACHUCAL', '52'),
(736, 1, 'GUAITARILLA', '52'),
(737, 1, 'GUALMATAN', '52'),
(738, 1, 'ILES', '52'),
(739, 1, 'IMUES', '52'),
(740, 1, 'IPIALES', '52'),
(741, 1, 'LA CRUZ', '52'),
(742, 1, 'LA FLORIDA', '52'),
(743, 1, 'LA LLANADA', '52'),
(744, 1, 'LA TOLA', '52'),
(745, 1, 'LA UNION', '52'),
(746, 1, 'LEIVA', '52'),
(747, 1, 'LINARES', '52'),
(748, 1, 'LOS ANDES', '52'),
(749, 1, 'MAGÜI', '52'),
(750, 1, 'MALLAMA', '52'),
(751, 1, 'MOSQUERA', '52'),
(752, 1, 'NARIÑO', '52'),
(753, 1, 'OLAYA HERRERA', '52'),
(754, 1, 'OSPINA', '52'),
(755, 1, 'FRANCISCO PIZARRO', '52'),
(756, 1, 'POLICARPA', '52'),
(757, 1, 'POTOSI', '52'),
(758, 1, 'PROVIDENCIA', '52'),
(759, 1, 'PUERRES', '52'),
(760, 1, 'PUPIALES', '52'),
(761, 1, 'RICAURTE', '52'),
(762, 1, 'ROBERTO PAYAN', '52'),
(763, 1, 'SAMANIEGO', '52'),
(764, 1, 'SANDONA', '52'),
(765, 1, 'SAN BERNARDO', '52'),
(766, 1, 'SAN LORENZO', '52'),
(767, 1, 'SAN PABLO', '52'),
(768, 1, 'SAN PEDRO DE CARTAGO', '52'),
(769, 1, 'SANTA BARBARA', '52'),
(770, 1, 'SANTACRUZ', '52'),
(771, 1, 'SAPUYES', '52'),
(772, 1, 'TAMINANGO', '52'),
(773, 1, 'TANGUA', '52'),
(774, 1, 'TUMACO', '52'),
(775, 1, 'TUQUERRES', '52'),
(776, 1, 'YACUANQUER', '52'),
(777, 1, 'CUCUTA', '54'),
(778, 1, 'ABREGO', '54'),
(779, 1, 'ARBOLEDAS', '54'),
(780, 1, 'BOCHALEMA', '54'),
(781, 1, 'BUCARASICA', '54'),
(782, 1, 'CACOTA', '54'),
(783, 1, 'CACHIRA', '54'),
(784, 1, 'CHINACOTA', '54'),
(785, 1, 'CHITAGA', '54'),
(786, 1, 'CONVENCION', '54'),
(787, 1, 'CUCUTILLA', '54'),
(788, 1, 'DURANIA', '54'),
(789, 1, 'EL CARMEN', '54'),
(790, 1, 'EL TARRA', '54'),
(791, 1, 'EL ZULIA', '54'),
(792, 1, 'GRAMALOTE', '54'),
(793, 1, 'HACARI', '54'),
(794, 1, 'HERRAN', '54'),
(795, 1, 'LABATECA', '54'),
(796, 1, 'LA ESPERANZA', '54'),
(797, 1, 'LA PLAYA', '54'),
(798, 1, 'LOS PATIOS', '54'),
(799, 1, 'LOURDES', '54'),
(800, 1, 'MUTISCUA', '54'),
(801, 1, 'OCAÑA', '54'),
(802, 1, 'PAMPLONA', '54'),
(803, 1, 'PAMPLONITA', '54'),
(804, 1, 'PUERTO SANTANDER', '54'),
(805, 1, 'RAGONVALIA', '54'),
(806, 1, 'SALAZAR', '54'),
(807, 1, 'SAN CALIXTO', '54'),
(808, 1, 'SAN CAYETANO', '54'),
(809, 1, 'SANTIAGO', '54'),
(810, 1, 'SARDINATA', '54'),
(811, 1, 'SILOS', '54'),
(812, 1, 'TEORAMA', '54'),
(813, 1, 'TIBU', '54'),
(814, 1, 'TOLEDO', '54'),
(815, 1, 'VILLA CARO', '54'),
(816, 1, 'VILLA DEL ROSARIO', '54'),
(817, 1, 'ARMENIA', '63'),
(818, 1, 'BUENAVISTA', '63'),
(819, 1, 'CALARCA', '63'),
(820, 1, 'CIRCASIA', '63'),
(821, 1, 'CORDOBA', '63'),
(822, 1, 'FILANDIA', '63'),
(823, 1, 'GENOVA', '63'),
(824, 1, 'LA TEBAIDA', '63'),
(825, 1, 'MONTENEGRO', '63'),
(826, 1, 'PIJAO', '63'),
(827, 1, 'QUIMBAYA', '63'),
(828, 1, 'SALENTO', '63'),
(829, 1, 'PEREIRA', '66'),
(830, 1, 'APIA', '66'),
(831, 1, 'BALBOA', '66'),
(832, 1, 'BELEN DE UMBRIA', '66'),
(833, 1, 'DOSQUEBRADAS', '66'),
(834, 1, 'GUATICA', '66'),
(835, 1, 'LA CELIA', '66'),
(836, 1, 'LA VIRGINIA', '66'),
(837, 1, 'MARSELLA', '66'),
(838, 1, 'MISTRATO', '66'),
(839, 1, 'PUEBLO RICO', '66'),
(840, 1, 'QUINCHIA', '66'),
(841, 1, 'SANTA ROSA DE CABAL', '66'),
(842, 1, 'SANTUARIO', '66'),
(843, 1, 'BUCARAMANGA', '68'),
(844, 1, 'AGUADA', '68'),
(845, 1, 'ALBANIA', '68'),
(846, 1, 'ARATOCA', '68'),
(847, 1, 'BARBOSA', '68'),
(848, 1, 'BARICHARA', '68'),
(849, 1, 'BARRANCABERMEJA', '68'),
(850, 1, 'BETULIA', '68'),
(851, 1, 'BOLIVAR', '68'),
(852, 1, 'CABRERA', '68'),
(853, 1, 'CALIFORNIA', '68'),
(854, 1, 'CAPITANEJO', '68'),
(855, 1, 'CARCASI', '68'),
(856, 1, 'CEPITA', '68'),
(857, 1, 'CERRITO', '68'),
(858, 1, 'CHARALA', '68'),
(859, 1, 'CHARTA', '68'),
(860, 1, 'CHIMA', '68'),
(861, 1, 'CHIPATA', '68'),
(862, 1, 'CIMITARRA', '68'),
(863, 1, 'CONCEPCION', '68'),
(864, 1, 'CONFINES', '68'),
(865, 1, 'CONTRATACION', '68'),
(866, 1, 'COROMORO', '68'),
(867, 1, 'CURITI', '68'),
(868, 1, 'EL CARMEN DE CHUCURI', '68'),
(869, 1, 'EL GUACAMAYO', '68'),
(870, 1, 'EL PEÑON', '68'),
(871, 1, 'EL PLAYON', '68'),
(872, 1, 'ENCINO', '68'),
(873, 1, 'ENCISO', '68'),
(874, 1, 'FLORIAN', '68'),
(875, 1, 'FLORIDABLANCA', '68'),
(876, 1, 'GALAN', '68'),
(877, 1, 'GAMBITA', '68'),
(878, 1, 'GIRON', '68'),
(879, 1, 'GUACA', '68'),
(880, 1, 'GUADALUPE', '68'),
(881, 1, 'GUAPOTA', '68'),
(882, 1, 'GUAVATA', '68'),
(883, 1, 'GÜEPSA', '68'),
(884, 1, 'HATO', '68'),
(885, 1, 'JESUS MARIA', '68'),
(886, 1, 'JORDAN', '68'),
(887, 1, 'LA BELLEZA', '68'),
(888, 1, 'LANDAZURI', '68'),
(889, 1, 'LA PAZ', '68'),
(890, 1, 'LEBRIJA', '68'),
(891, 1, 'LOS SANTOS', '68'),
(892, 1, 'MACARAVITA', '68'),
(893, 1, 'MALAGA', '68'),
(894, 1, 'MATANZA', '68'),
(895, 1, 'MOGOTES', '68'),
(896, 1, 'MOLAGAVITA', '68'),
(897, 1, 'OCAMONTE', '68'),
(898, 1, 'OIBA', '68'),
(899, 1, 'ONZAGA', '68'),
(900, 1, 'PALMAR', '68'),
(901, 1, 'PALMAS DEL SOCORRO', '68'),
(902, 1, 'PARAMO', '68'),
(903, 1, 'PIEDECUESTA', '68'),
(904, 1, 'PINCHOTE', '68'),
(905, 1, 'PUENTE NACIONAL', '68'),
(906, 1, 'PUERTO PARRA', '68'),
(907, 1, 'PUERTO WILCHES', '68'),
(908, 1, 'RIONEGRO', '68'),
(909, 1, 'SABANA DE TORRES', '68'),
(910, 1, 'SAN ANDRES', '68'),
(911, 1, 'SAN BENITO', '68'),
(912, 1, 'SAN GIL', '68'),
(913, 1, 'SAN JOAQUIN', '68'),
(914, 1, 'SAN JOSE DE MIRANDA', '68'),
(915, 1, 'SAN MIGUEL', '68'),
(916, 1, 'SAN VICENTE DE CHUCURI', '68'),
(917, 1, 'SANTA BARBARA', '68'),
(918, 1, 'SANTA HELENA DEL OPON', '68'),
(919, 1, 'SIMACOTA', '68'),
(920, 1, 'SOCORRO', '68'),
(921, 1, 'SUAITA', '68'),
(922, 1, 'SUCRE', '68'),
(923, 1, 'SURATA', '68'),
(924, 1, 'TONA', '68'),
(925, 1, 'VALLE DE SAN JOSE', '68'),
(926, 1, 'VELEZ', '68'),
(927, 1, 'VETAS', '68'),
(928, 1, 'VILLANUEVA', '68'),
(929, 1, 'ZAPATOCA', '68'),
(930, 1, 'SINCELEJO', '70'),
(931, 1, 'BUENAVISTA', '70'),
(932, 1, 'CAIMITO', '70'),
(933, 1, 'COLOSO', '70'),
(934, 1, 'COROZAL', '70'),
(935, 1, 'CHALAN', '70'),
(936, 1, 'EL ROBLE', '70'),
(937, 1, 'GALERAS', '70'),
(938, 1, 'GUARANDA', '70'),
(939, 1, 'LA UNION', '70'),
(940, 1, 'LOS PALMITOS', '70'),
(941, 1, 'MAJAGUAL', '70'),
(942, 1, 'MORROA', '70'),
(943, 1, 'OVEJAS', '70'),
(944, 1, 'PALMITO', '70'),
(945, 1, 'SAMPUES', '70'),
(946, 1, 'SAN BENITO ABAD', '70'),
(947, 1, 'SAN JUAN DE BETULIA', '70'),
(948, 1, 'SAN MARCOS', '70'),
(949, 1, 'SAN ONOFRE', '70'),
(950, 1, 'SAN PEDRO', '70'),
(951, 1, 'SINCE', '70'),
(952, 1, 'SUCRE', '70'),
(953, 1, 'SANTIAGO DE TOLU', '70'),
(954, 1, 'TOLUVIEJO', '70'),
(955, 1, 'IBAGUE', '73'),
(956, 1, 'ALPUJARRA', '73'),
(957, 1, 'ALVARADO', '73'),
(958, 1, 'AMBALEMA', '73'),
(959, 1, 'ANZOATEGUI', '73'),
(960, 1, 'ARMERO', '73'),
(961, 1, 'ATACO', '73'),
(962, 1, 'CAJAMARCA', '73'),
(963, 1, 'CARMEN DE APICALA', '73'),
(964, 1, 'CASABIANCA', '73'),
(965, 1, 'CHAPARRAL', '73'),
(966, 1, 'COELLO', '73'),
(967, 1, 'COYAIMA', '73'),
(968, 1, 'CUNDAY', '73'),
(969, 1, 'DOLORES', '73'),
(970, 1, 'ESPINAL', '73'),
(971, 1, 'FALAN', '73'),
(972, 1, 'FLANDES', '73'),
(973, 1, 'FRESNO', '73'),
(974, 1, 'GUAMO', '73'),
(975, 1, 'HERVEO', '73'),
(976, 1, 'HONDA', '73'),
(977, 1, 'ICONONZO', '73'),
(978, 1, 'LERIDA', '73'),
(979, 1, 'LIBANO', '73'),
(980, 1, 'MARIQUITA', '73'),
(981, 1, 'MELGAR', '73'),
(982, 1, 'MURILLO', '73'),
(983, 1, 'NATAGAIMA', '73'),
(984, 1, 'ORTEGA', '73'),
(985, 1, 'PALOCABILDO', '73'),
(986, 1, 'PIEDRAS', '73'),
(987, 1, 'PLANADAS', '73'),
(988, 1, 'PRADO', '73'),
(989, 1, 'PURIFICACION', '73'),
(990, 1, 'RIOBLANCO', '73'),
(991, 1, 'RONCESVALLES', '73'),
(992, 1, 'ROVIRA', '73'),
(993, 1, 'SALDAÑA', '73'),
(994, 1, 'SAN ANTONIO', '73'),
(995, 1, 'SAN LUIS', '73'),
(996, 1, 'SANTA ISABEL', '73'),
(997, 1, 'SUAREZ', '73'),
(998, 1, 'VALLE DE SAN JUAN', '73'),
(999, 1, 'VENADILLO', '73'),
(1000, 1, 'VILLAHERMOSA', '73'),
(1001, 1, 'VILLARRICA', '73'),
(1002, 1, 'CALI', '76'),
(1003, 1, 'ALCALA', '76'),
(1004, 1, 'ANDALUCIA', '76'),
(1005, 1, 'ANSERMANUEVO', '76'),
(1006, 1, 'ARGELIA', '76'),
(1007, 1, 'BOLIVAR', '76'),
(1008, 1, 'BUENAVENTURA', '76'),
(1009, 1, 'GUADALAJARA DE BUGA', '76'),
(1010, 1, 'BUGALAGRANDE', '76'),
(1011, 1, 'CAICEDONIA', '76'),
(1012, 1, 'CALIMA', '76'),
(1013, 1, 'CANDELARIA', '76'),
(1014, 1, 'CARTAGO', '76'),
(1015, 1, 'DAGUA', '76'),
(1016, 1, 'EL AGUILA', '76'),
(1017, 1, 'EL CAIRO', '76'),
(1018, 1, 'EL CERRITO', '76'),
(1019, 1, 'EL DOVIO', '76'),
(1020, 1, 'FLORIDA', '76'),
(1021, 1, 'GINEBRA', '76'),
(1022, 1, 'GUACARI', '76'),
(1023, 1, 'JAMUNDI', '76'),
(1024, 1, 'LA CUMBRE', '76'),
(1025, 1, 'LA UNION', '76'),
(1026, 1, 'LA VICTORIA', '76'),
(1027, 1, 'OBANDO', '76'),
(1028, 1, 'PALMIRA', '76'),
(1029, 1, 'PRADERA', '76'),
(1030, 1, 'RESTREPO', '76'),
(1031, 1, 'RIOFRIO', '76'),
(1032, 1, 'ROLDANILLO', '76'),
(1033, 1, 'SAN PEDRO', '76'),
(1034, 1, 'SEVILLA', '76'),
(1035, 1, 'TORO', '76'),
(1036, 1, 'TRUJILLO', '76'),
(1037, 1, 'TULUA', '76'),
(1038, 1, 'ULLOA', '76'),
(1039, 1, 'VERSALLES', '76'),
(1040, 1, 'VIJES', '76'),
(1041, 1, 'YOTOCO', '76'),
(1042, 1, 'YUMBO', '76'),
(1043, 1, 'ZARZAL', '76'),
(1044, 1, 'ARAUCA', '81'),
(1045, 1, 'ARAUQUITA', '81'),
(1046, 1, 'CRAVO NORTE', '81'),
(1047, 1, 'FORTUL', '81'),
(1048, 1, 'PUERTO RONDON', '81'),
(1049, 1, 'SARAVENA', '81'),
(1050, 1, 'TAME', '81'),
(1051, 1, 'YOPAL', '85'),
(1052, 1, 'AGUAZUL', '85'),
(1053, 1, 'CHAMEZA', '85'),
(1054, 1, 'HATO COROZAL', '85'),
(1055, 1, 'LA SALINA', '85'),
(1056, 1, 'MANI', '85'),
(1057, 1, 'MONTERREY', '85'),
(1058, 1, 'NUNCHIA', '85'),
(1059, 1, 'OROCUE', '85'),
(1060, 1, 'PAZ DE ARIPORO', '85'),
(1061, 1, 'PORE', '85'),
(1062, 1, 'RECETOR', '85'),
(1063, 1, 'SABANALARGA', '85'),
(1064, 1, 'SACAMA', '85'),
(1065, 1, 'SAN LUIS DE PALENQUE', '85'),
(1066, 1, 'TAMARA', '85'),
(1067, 1, 'TAURAMENA', '85'),
(1068, 1, 'TRINIDAD', '85'),
(1069, 1, 'VILLANUEVA', '85'),
(1070, 1, 'MOCOA', '86'),
(1071, 1, 'COLON', '86'),
(1072, 1, 'ORITO', '86'),
(1073, 1, 'PUERTO ASIS', '86'),
(1074, 1, 'PUERTO CAICEDO', '86'),
(1075, 1, 'PUERTO GUZMAN', '86'),
(1076, 1, 'LEGUIZAMO', '86'),
(1077, 1, 'SIBUNDOY', '86'),
(1078, 1, 'SAN FRANCISCO', '86'),
(1079, 1, 'SAN MIGUEL', '86'),
(1080, 1, 'SANTIAGO', '86'),
(1081, 1, 'VALLE DEL GUAMUEZ', '86'),
(1082, 1, 'VILLAGARZON', '86'),
(1083, 1, 'SAN ANDRES', '88'),
(1084, 1, 'PROVIDENCIA', '88'),
(1085, 1, 'LETICIA', '91'),
(1086, 1, 'EL ENCANTO', '91'),
(1087, 1, 'LA CHORRERA', '91'),
(1088, 1, 'LA PEDRERA', '91'),
(1089, 1, 'LA VICTORIA', '91'),
(1090, 1, 'MIRITI - PARANA', '91'),
(1091, 1, 'PUERTO ALEGRIA', '91'),
(1092, 1, 'PUERTO ARICA', '91'),
(1093, 1, 'PUERTO NARIÑO', '91'),
(1094, 1, 'PUERTO SANTANDER', '91'),
(1095, 1, 'TARAPACA', '91'),
(1096, 1, 'INIRIDA', '94'),
(1097, 1, 'BARRANCO MINAS', '94'),
(1098, 1, 'MAPIRIPANA', '94'),
(1099, 1, 'SAN FELIPE', '94'),
(1100, 1, 'PUERTO COLOMBIA', '94'),
(1101, 1, 'LA GUADALUPE', '94'),
(1102, 1, 'CACAHUAL', '94'),
(1103, 1, 'PANA PANA', '94'),
(1104, 1, 'MORICHAL', '94'),
(1105, 1, 'SAN JOSE DEL GUAVIARE', '95'),
(1106, 1, 'CALAMAR', '95'),
(1107, 1, 'EL RETORNO', '95'),
(1108, 1, 'MIRAFLORES', '95'),
(1109, 1, 'MITU', '97'),
(1110, 1, 'CARURU', '97'),
(1111, 1, 'PACOA', '97'),
(1112, 1, 'TARAIRA', '97'),
(1113, 1, 'PAPUNAUA', '97'),
(1114, 1, 'YAVARATE', '97'),
(1115, 1, 'PUERTO CARREÑO', '99'),
(1116, 1, 'LA PRIMAVERA', '99'),
(1117, 1, 'SANTA ROSALIA', '99'),
(1118, 1, 'CUMARIBO', '99');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `pelicula_id` int(11) DEFAULT NULL,
  `nombre_usuario` varchar(100) DEFAULT NULL,
  `comentario` text,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL,
  `propiedad1` int(11) DEFAULT NULL,
  `propiedad2` int(11) DEFAULT NULL,
  `propiedad3` int(11) DEFAULT NULL,
  `propiedad4` int(11) DEFAULT NULL,
  `propiedad5` int(11) DEFAULT NULL,
  `propiedad6` int(11) DEFAULT NULL,
  `oficina_central` varchar(400) DEFAULT NULL,
  `telefono1` varchar(100) DEFAULT NULL,
  `telefono2` varchar(100) DEFAULT NULL,
  `email_contacto` varchar(100) DEFAULT NULL,
  `horarios` varchar(200) DEFAULT NULL,
  `diaInicio` varchar(50) DEFAULT NULL,
  `HrInicio` varchar(50) DEFAULT NULL,
  `diaFinal` varchar(50) DEFAULT NULL,
  `HrFinal` varchar(50) DEFAULT NULL,
  `QuienesSomos` varchar(8000) DEFAULT NULL,
  `mapa` varchar(300) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `twitter` varchar(200) DEFAULT NULL,
  `Youtube` varchar(200) DEFAULT NULL,
  `instagram` varchar(150) DEFAULT NULL,
  `tipo_visualizacion_propiedades` varchar(1) DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `email_administrador` varchar(100) DEFAULT NULL,
  `documentoprivacidad` varchar(150) NOT NULL,
  `documentoterminos` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `propiedad1`, `propiedad2`, `propiedad3`, `propiedad4`, `propiedad5`, `propiedad6`, `oficina_central`, `telefono1`, `telefono2`, `email_contacto`, `horarios`, `diaInicio`, `HrInicio`, `diaFinal`, `HrFinal`, `QuienesSomos`, `mapa`, `facebook`, `twitter`, `Youtube`, `instagram`, `tipo_visualizacion_propiedades`, `user`, `password`, `email_administrador`, `documentoprivacidad`, `documentoterminos`) VALUES
(1, 0, 0, 0, 0, 0, 0, 'medellin', '3137933725', '3137933725', 'info@inmobiliariacsc.com', 'De 12h a 12h', 'Lunes - Viernes ', '9:00 am - 5:00 pm', 'Sábado', '9:00 am - 12:00 pm', '<div style=\"text-align: justify;\"><span style=\"color: rgb(51, 51, 51); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 15px;\">En</span><span style=\"font-family: &quot;Open Sans&quot;, sans-serif; font-size: 15px;\"> </span><span style=\"font-family: &quot;Open Sans&quot;, sans-serif; font-size: 15px;\"><b style=\"\">Inmobiliaria CSC,</b></span><span style=\"color: rgb(51, 51, 51); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 15px;\"> creemos en el poder de un hogar para transformar vidas y comunidades. Desde nuestros inicios, nos hemos comprometido a ofrecer un servicio excepcional en el mercado inmobiliario de Medellí­n, marcando la diferencia a través de nuestra pasión y conocimiento profundo de la región.</span><br></div><div style=\"text-align: justify;\"><font color=\"#333333\" face=\"Open Sans, sans-serif\"><span style=\"font-size: 15px;\"><br></span></font></div><div style=\"text-align: justify;\"><font color=\"#333333\" face=\"Open Sans, sans-serif\"><span style=\"font-size: 15px;\"><b>Nuestra Misión</b></span></font></div><div style=\"text-align: justify;\"><span style=\"font-size: 15px; color: rgb(51, 51, 51); font-family: &quot;Open Sans&quot;, sans-serif;\">Nuestra misión es simple pero poderosa: facilitar los sueños de nuestros clientes de encontrar el lugar perfecto para llamar hogar. Entendemos que comprar, vender o rentar una propiedad es una de las decisiones más importantes en la vida de una persona, y estamos aquí­ para hacer que ese proceso sea emocionante, sin complicaciones y exitoso.</span><br></div><div style=\"text-align: justify;\"><font color=\"#333333\" face=\"Open Sans, sans-serif\"><span style=\"font-size: 15px;\"><br></span></font></div><div style=\"text-align: justify;\"><font color=\"#333333\" face=\"Open Sans, sans-serif\"><span style=\"font-size: 15px;\"><b>Nuestro Compromiso</b></span></font></div><div style=\"text-align: justify;\"><span style=\"font-size: 15px; color: rgb(51, 51, 51); font-family: &quot;Open Sans&quot;, sans-serif;\">En Inmobiliaria CSC, estamos comprometidos con la excelencia en todo lo que hacemos. Nuestro equipo de agentes inmobiliarios está formado por profesionales apasionados y con experiencia que conocen cada rincón de Medellí­n. Nos enorgullece brindar un servicio personalizado y transparente, basado en la confianza y la integridad.</span></div><div style=\"text-align: justify;\"><font color=\"#333333\" face=\"Open Sans, sans-serif\"><span style=\"font-size: 15px;\"><br></span></font></div><div style=\"text-align: justify;\"><font color=\"#333333\" face=\"Open Sans, sans-serif\"><span style=\"font-size: 15px;\"><b>Nuestra Experiencia</b></span></font></div><div style=\"text-align: justify;\"><span style=\"font-size: 15px; color: rgb(51, 51, 51); font-family: &quot;Open Sans&quot;, sans-serif;\">Con años de experiencia en el mercado inmobiliario de Medellí­n, hemos establecido relaciones sólidas con clientes satisfechos y colaboradores en toda la industria. Esto nos permite ofrecer un acceso exclusivo a una amplia gama de propiedades y oportunidades de inversión.</span><br></div><div style=\"text-align: justify;\"><font color=\"#333333\" face=\"Open Sans, sans-serif\"><span style=\"font-size: 15px;\"><br></span></font></div><div style=\"text-align: justify;\"><font color=\"#333333\" face=\"Open Sans, sans-serif\"><span style=\"font-size: 15px;\"><b>Únete a Nuestra Comunidad</b></span></font></div><div style=\"text-align: justify;\"><span style=\"font-size: 15px; color: rgb(51, 51, 51); font-family: &quot;Open Sans&quot;, sans-serif;\">En Inmobiliaria CSC, no solo ayudamos a nuestros clientes a encontrar propiedades, sino que también construimos comunidades fuertes. Creemos en el poder de la propiedad para unir a las personas y fortalecer vecindarios. Únete a nuestra comunidad de propietarios y descubre todo lo que Medellí­n y sus alrededores tiene para ofrecer.</span><br></div><div style=\"text-align: justify;\"><font color=\"#333333\" face=\"Open Sans, sans-serif\"><span style=\"font-size: 15px;\"><br></span></font></div><div style=\"text-align: justify;\"><font color=\"#333333\" face=\"Open Sans, sans-serif\"><span style=\"font-size: 15px;\">Gracias por considerarnos como tu socio en el emocionante viaje de bienes raí­ces. Estamos aquí para servirte y guiarte en cada paso del camino.</span></font></div><div style=\"text-align: justify;\"><font color=\"#333333\" face=\"Open Sans, sans-serif\"><span style=\"font-size: 15px;\"><br></span></font></div><div style=\"text-align: justify;\"><font color=\"#333333\" face=\"Open Sans, sans-serif\"><span style=\"font-size: 15px;\">Contáctanos para comenzar su próxima aventura inmobiliaria en Medellín.</span></font></div>', 'mapa', 'https://www.facebook.com/apartamentosamobladoscsc', '', 'https://www.youtube.com/@apartamentosamobladoscsc2092', '', 'f', 'forpao', 'Ariana0430', 'admin@gmail.com', 'PolÃ­tica de Privacidad.pdf', 'PolÃ­tica de Privacidad.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `costos`
--

CREATE TABLE `costos` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `estado` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipopropiedad` int(11) DEFAULT NULL,
  `costoservicio` float DEFAULT NULL,
  `formaCobro` char(1) DEFAULT NULL,
  `tipoCosto` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `costos`
--

INSERT INTO `costos` (`id`, `descripcion`, `estado`, `tipopropiedad`, `costoservicio`, `formaCobro`, `tipoCosto`) VALUES
(17, 'Servicio de aseo ', 'A', 16, 120000, 'V', 'A'),
(18, 'Garantia reembolsable ', 'A', 14, 300000, 'V', 'A'),
(19, 'Garantia reembolsable ', 'A', 16, 1500000, 'V', 'A'),
(20, 'Servicio de aseo', 'A', 14, 120000, 'V', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id` int(11) NOT NULL,
  `id_pais` int(11) NOT NULL,
  `cod_departamento` varchar(3) NOT NULL,
  `nombre_departamento` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id`, `id_pais`, `cod_departamento`, `nombre_departamento`) VALUES
(1, 1, '5', 'Antioquia'),
(2, 1, '8', 'Atlántico'),
(3, 1, '11', 'Bogota D.C.'),
(4, 1, '13', 'Bolívar'),
(5, 1, '15', 'Boyacá'),
(6, 1, '17', 'Caldas'),
(7, 1, '18', 'Caquetá'),
(8, 1, '19', 'Cauca'),
(9, 1, '20', 'Cesar'),
(10, 1, '23', 'Córdoba'),
(11, 1, '25', 'Cundinamarca'),
(12, 1, '27', 'Chocó'),
(13, 1, '41', 'Huila'),
(14, 1, '44', 'La Guajira'),
(15, 1, '47', 'Magdalena'),
(16, 1, '47', 'SEBASTIAN'),
(17, 1, '50', 'Meta'),
(18, 1, '52', 'Nariño'),
(19, 1, '54', 'Norte de Santander'),
(20, 1, '63', 'Quindio'),
(21, 1, '66', 'Risaralda'),
(22, 1, '68', 'Santander'),
(23, 1, '70', 'Sucre'),
(24, 1, '73', 'Tolima'),
(25, 1, '76', 'Valle del Cauca'),
(26, 1, '81', 'Arauca'),
(27, 1, '85', 'Casanare'),
(28, 1, '86', 'Putumayo'),
(29, 1, '88', 'San Andres'),
(30, 1, '91', 'Amazonas'),
(31, 1, '94', 'Guainía'),
(32, 1, '95', 'Guaviare'),
(33, 1, '97', 'Vaupés'),
(34, 1, '99', 'Vichada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `idPropiedad` int(11) DEFAULT NULL,
  `startEvent` datetime DEFAULT NULL,
  `endEvent` datetime DEFAULT NULL,
  `state` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `events`
--

INSERT INTO `events` (`id`, `idPropiedad`, `startEvent`, `endEvent`, `state`) VALUES
(1, 1, '2024-03-25 00:00:00', '2024-02-29 00:00:00', 'A'),
(2, 3, '2024-01-17 00:00:00', '2024-02-16 00:00:00', 'A'),
(3, 4, '2024-01-17 00:00:00', '2024-02-16 00:00:00', 'A'),
(4, 6, '2024-02-22 00:00:00', '2024-02-22 00:00:00', 'A'),
(5, 7, '2024-02-26 00:00:00', '2024-02-26 00:00:00', 'A'),
(6, 8, '2024-02-19 00:00:00', '2024-02-27 00:00:00', 'A'),
(7, 9, '2024-02-26 00:00:00', '2024-02-27 00:00:00', 'A'),
(8, 10, '2024-02-26 00:00:00', '2024-02-27 00:00:00', 'A'),
(9, 11, '2024-02-26 00:00:00', '2024-02-27 00:00:00', 'A'),
(10, 12, '2024-02-26 00:00:00', '2024-02-28 00:00:00', 'A'),
(11, 13, '2024-02-26 00:00:00', '2024-02-26 00:00:00', 'A'),
(12, 14, '2024-01-26 00:00:00', '2024-02-29 00:00:00', 'A'),
(13, 15, '2024-01-26 00:00:00', '2024-02-29 00:00:00', 'A'),
(14, 16, '2024-01-26 00:00:00', '2024-02-29 00:00:00', 'A'),
(15, 17, '2024-01-26 00:00:00', '2024-02-29 00:00:00', 'A'),
(16, 18, '2024-01-26 00:00:00', '2024-02-29 00:00:00', 'A'),
(17, 19, '2024-01-26 00:00:00', '2024-02-29 00:00:00', 'A'),
(18, 20, '2024-02-25 00:00:00', '2024-03-01 00:00:00', 'A'),
(19, 21, '2024-02-25 00:00:00', '2024-03-02 00:00:00', 'A'),
(20, 22, '2024-02-27 00:00:00', '2024-03-02 00:00:00', 'A'),
(21, 23, '2024-02-26 00:00:00', '2024-03-05 00:00:00', 'A'),
(22, 24, '2024-01-30 00:00:00', '2024-02-29 00:00:00', 'A'),
(23, 25, '2024-03-04 00:00:00', '2024-03-14 00:00:00', 'A'),
(24, 31, '2024-03-16 00:00:00', '2024-03-17 00:00:00', 'A'),
(25, 32, '2024-03-16 00:00:00', '2024-03-17 00:00:00', 'A'),
(26, 33, '2024-03-16 00:00:00', '2024-03-17 00:00:00', 'A'),
(27, 33, '2024-03-23 00:00:00', '2024-03-24 00:00:00', 'A'),
(28, 34, '2024-03-16 00:00:00', '2024-03-17 00:00:00', 'A'),
(29, 36, '2024-04-03 00:00:00', '2024-04-04 00:00:00', 'A'),
(30, 37, '2024-04-12 00:00:00', '2024-04-13 00:00:00', 'A'),
(31, 38, '2024-02-26 00:00:00', '2024-03-05 00:00:00', 'A'),
(32, 39, '2024-03-16 00:00:00', '2024-03-17 00:00:00', 'A'),
(33, 40, '2024-05-01 00:00:00', '2024-05-31 00:00:00', 'A'),
(34, 41, '2024-05-01 00:00:00', '2024-05-31 00:00:00', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--

CREATE TABLE `fotos` (
  `id` int(11) NOT NULL,
  `id_propiedad` int(11) NOT NULL,
  `nombre_foto` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `high_season`
--

CREATE TABLE `high_season` (
  `id` int(11) NOT NULL,
  `startEvent` datetime DEFAULT NULL,
  `endEvent` datetime DEFAULT NULL,
  `state` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monedas`
--

CREATE TABLE `monedas` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL,
  `createdby` varchar(15) DEFAULT NULL,
  `createdatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `monedas`
--

INSERT INTO `monedas` (`id`, `descripcion`, `estado`, `createdby`, `createdatetime`) VALUES
(1, 'COP', NULL, NULL, '2023-10-03 20:12:38'),
(2, 'USD', NULL, NULL, '2023-10-03 21:27:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `objetivospropiedad`
--

CREATE TABLE `objetivospropiedad` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `objetivospropiedad`
--

INSERT INTO `objetivospropiedad` (`id`, `descripcion`) VALUES
(5, 'Cartelera'),
(6, 'Pronto'),
(7, 'Cine Alternativo'),
(8, 'Comida');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `id` int(11) NOT NULL,
  `nombre_pais` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`id`, `nombre_pais`) VALUES
(1, 'Colombia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE `peliculas` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `sinopsis` text,
  `reseña` text,
  `actores` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `fecha_estreno` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`id`, `descripcion`, `estado`) VALUES
(1, 'Administrador', 'I'),
(2, 'Asociado', 'A'),
(3, 'Cliente', 'I'),
(4, 'Community Manager', 'I'),
(5, 'Coworkers', 'I');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedades`
--

CREATE TABLE `propiedades` (
  `id` int(11) NOT NULL,
  `codigo` varchar(50) DEFAULT NULL,
  `dardealta` int(11) DEFAULT NULL,
  `fecha_alta` date DEFAULT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `tipo` int(11) DEFAULT NULL,
  `Objetivo` int(11) DEFAULT NULL,
  `estado` varchar(15) DEFAULT NULL,
  `moneda` varchar(5) DEFAULT NULL,
  `PrecioVenta` float DEFAULT NULL,
  `PrecioDia` float DEFAULT NULL,
  `PrecioMes` float DEFAULT NULL,
  `PrecioDiaTA` float DEFAULT NULL,
  `PrecioMesTA` float DEFAULT NULL,
  `pais` int(11) DEFAULT NULL,
  `departamento` int(11) DEFAULT NULL,
  `ciudad` int(11) DEFAULT NULL,
  `ubicacion` varchar(200) DEFAULT NULL,
  `barrio` varchar(150) DEFAULT NULL,
  `sector` varchar(150) DEFAULT NULL,
  `url_foto_principal` varchar(200) DEFAULT NULL,
  `propietario` varchar(100) DEFAULT NULL,
  `SEO` varchar(800) DEFAULT NULL,
  `url_video` varchar(350) DEFAULT NULL,
  `costoadicinal` float DEFAULT NULL,
  `ObsAprobacion` varchar(800) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `propiedades`
--

INSERT INTO `propiedades` (`id`, `codigo`, `dardealta`, `fecha_alta`, `titulo`, `descripcion`, `tipo`, `Objetivo`, `estado`, `moneda`, `PrecioVenta`, `PrecioDia`, `PrecioMes`, `PrecioDiaTA`, `PrecioMesTA`, `pais`, `departamento`, `ciudad`, `ubicacion`, `barrio`, `sector`, `url_foto_principal`, `propietario`, `SEO`, `url_video`, `costoadicinal`, `ObsAprobacion`) VALUES
(3, NULL, 1, '2024-02-09', 'Arriendo apartamento Amoblado Dúplex en Medellín, barrio el poblado, sector la aguacatala', '<h4 style=\"font-family: Poppins, sans-serif; line-height: 1.1; color: rgb(51, 51, 51); margin-top: 20px; margin-bottom: 15px; font-size: 22px;\">Acerca de este espacio</h4><p><br style=\"color: rgb(51, 51, 51); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 15px;\"></p><p id=\"txtdescripcionpropiedad\" style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(51, 51, 51); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 15px; text-align: justify;\"></p><div style=\"border: 1pt solid rgb(227, 227, 227); padding: 0cm; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\"><p class=\"MsoNormal\" style=\"margin-right: 0px; margin-bottom: 15pt; margin-left: 0px; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: none; padding: 0cm;\"><b style=\"font-weight: bold;\"><span style=\"font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif; color: rgb(13, 13, 13); border: 1pt solid rgb(227, 227, 227); padding: 0cm;\">Arriendo apartamento Amoblado Dúplex en Medellín, barrio el poblado, sector la aguacatala</span></b><span style=\"font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif; color: rgb(13, 13, 13);\"><o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin: 15pt 0cm; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: none; padding: 0cm;\"><b style=\"font-weight: bold;\"><span style=\"font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif; color: rgb(13, 13, 13); border: 1pt solid rgb(227, 227, 227); padding: 0cm;\">Ubicación:</span></b><span style=\"font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif; color: rgb(13, 13, 13);\">&nbsp;Mejor barrio de Medellín, rodeado de naturaleza y montañas.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin: 15pt 0cm; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: none; padding: 0cm;\"><b style=\"font-weight: bold;\"><span style=\"font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif; color: rgb(13, 13, 13); border: 1pt solid rgb(227, 227, 227); padding: 0cm;\">Seguridad:</span></b><span style=\"font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif; color: rgb(13, 13, 13);\">&nbsp;Vigilancia las 24 horas, ascensor, estacionamiento privado y visitantes<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-right: 0px; margin-bottom: 15pt; margin-left: 0px; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: none; padding: 0cm;\"><b style=\"font-weight: bold;\"><span style=\"font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif; color: rgb(13, 13, 13); border: 1pt solid rgb(227, 227, 227); padding: 0cm;\">Comodidades del Apartamento:</span></b><span style=\"font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif; color: rgb(13, 13, 13);\"><o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin: 15pt 0cm; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: none; padding: 0cm;\"><b style=\"font-weight: bold;\"><span style=\"font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif; color: rgb(13, 13, 13); border: 1pt solid rgb(227, 227, 227); padding: 0cm;\">Primer Nivel:</span></b><span style=\"font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif; color: rgb(13, 13, 13);\"><o:p></o:p></span></p></div><div style=\"border: 1pt solid rgb(227, 227, 227); padding: 0cm 0cm 0cm 5pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-left: 18pt; margin-right: 0cm;\"><ul type=\"disc\" style=\"margin: 0cm 0px 0px 20px; padding: 0px; list-style: none;\"><li class=\"MsoNormal\" style=\"margin-bottom: 0cm; color: rgb(13, 13, 13); margin-left: 18pt; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: none; padding: 0cm;\"><span style=\"font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif;\">Cocina semi-integral con dotación completa.<o:p></o:p></span></li><li class=\"MsoNormal\" style=\"margin-bottom: 0cm; color: rgb(13, 13, 13); margin-left: 18pt; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: none; padding: 0cm;\"><span style=\"font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif;\">Lavadora.<o:p></o:p></span></li><li class=\"MsoNormal\" style=\"margin-bottom: 0cm; color: rgb(13, 13, 13); margin-left: 18pt; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: none; padding: 0cm;\"><span style=\"font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif;\">Calentador de agua.<o:p></o:p></span></li><li class=\"MsoNormal\" style=\"margin-bottom: 0cm; color: rgb(13, 13, 13); margin-left: 18pt; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: none; padding: 0cm;\"><span style=\"font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif;\">Comedor para cuatro personas.<o:p></o:p></span></li></ul></div><div style=\"border: 1pt solid rgb(227, 227, 227); padding: 0cm; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\"><p class=\"MsoNormal\" style=\"margin: 15pt 0cm; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: none; padding: 0cm;\"><b style=\"font-weight: bold;\"><span style=\"font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif; color: rgb(13, 13, 13); border: 1pt solid rgb(227, 227, 227); padding: 0cm;\">Habitación Principal:</span></b><span style=\"font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif; color: rgb(13, 13, 13);\"><o:p></o:p></span></p></div><div style=\"border: 1pt solid rgb(227, 227, 227); padding: 0cm 0cm 0cm 5pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-left: 18pt; margin-right: 0cm;\"><ul type=\"disc\" style=\"margin: 0cm 0px 0px 20px; padding: 0px; list-style: none;\"><li class=\"MsoNormal\" style=\"margin-bottom: 0cm; color: rgb(13, 13, 13); margin-left: 18pt; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: none; padding: 0cm;\"><span style=\"font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif;\">Cama doble.<o:p></o:p></span></li><li class=\"MsoNormal\" style=\"margin-bottom: 0cm; color: rgb(13, 13, 13); margin-left: 18pt; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: none; padding: 0cm;\"><span style=\"font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif;\">Amplio armario.<o:p></o:p></span></li><li class=\"MsoNormal\" style=\"margin-bottom: 0cm; color: rgb(13, 13, 13); margin-left: 18pt; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: none; padding: 0cm;\"><span style=\"font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif;\">Baño privado con ducha.<o:p></o:p></span></li><li class=\"MsoNormal\" style=\"margin-bottom: 0cm; color: rgb(13, 13, 13); margin-left: 18pt; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: none; padding: 0cm;\"><span style=\"font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif;\">Televisor plasma.<o:p></o:p></span></li></ul></div><div style=\"border: 1pt solid rgb(227, 227, 227); padding: 0cm; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\"><p class=\"MsoNormal\" style=\"margin: 15pt 0cm; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: none; padding: 0cm;\"><b style=\"font-weight: bold;\"><span style=\"font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif; color: rgb(13, 13, 13); border: 1pt solid rgb(227, 227, 227); padding: 0cm;\">Segunda Habitación:</span></b><span style=\"font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif; color: rgb(13, 13, 13);\"><o:p></o:p></span></p></div><div style=\"border: 1pt solid rgb(227, 227, 227); padding: 0cm 0cm 0cm 5pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-left: 18pt; margin-right: 0cm;\"><ul type=\"disc\" style=\"margin: 0cm 0px 0px 20px; padding: 0px; list-style: none;\"><li class=\"MsoNormal\" style=\"margin-bottom: 0cm; color: rgb(13, 13, 13); margin-left: 18pt; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: none; padding: 0cm;\"><span style=\"font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif;\">Cama doble.<o:p></o:p></span></li><li class=\"MsoNormal\" style=\"margin-bottom: 0cm; color: rgb(13, 13, 13); margin-left: 18pt; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: none; padding: 0cm;\"><span style=\"font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif;\">Armario.<o:p></o:p></span></li><li class=\"MsoNormal\" style=\"margin-bottom: 0cm; color: rgb(13, 13, 13); margin-left: 18pt; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: none; padding: 0cm;\"><span style=\"font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif;\">Ventilador.<o:p></o:p></span></li><li class=\"MsoNormal\" style=\"margin-bottom: 0cm; color: rgb(13, 13, 13); margin-left: 18pt; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: none; padding: 0cm;\"><span style=\"font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif;\">Estudio.<o:p></o:p></span></li></ul></div><div style=\"border: 1pt solid rgb(227, 227, 227); padding: 0cm; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\"><p class=\"MsoNormal\" style=\"margin-right: 0px; margin-bottom: 15pt; margin-left: 0px; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: none; padding: 0cm;\"><b style=\"font-weight: bold;\"><span style=\"font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif; color: rgb(13, 13, 13); border: 1pt solid rgb(227, 227, 227); padding: 0cm;\">Segundo Nivel:</span></b><span style=\"font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif; color: rgb(13, 13, 13);\"><o:p></o:p></span></p></div><div style=\"border: 1pt solid rgb(227, 227, 227); padding: 0cm 0cm 0cm 5pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-left: 18pt; margin-right: 0cm;\"><ul type=\"disc\" style=\"margin: 0cm 0px 0px 20px; padding: 0px; list-style: none;\"><li class=\"MsoNormal\" style=\"margin-bottom: 0cm; color: rgb(13, 13, 13); margin-left: 18pt; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: none; padding: 0cm;\"><span style=\"font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif;\">Salón con sofá cama.<o:p></o:p></span></li><li class=\"MsoNormal\" style=\"margin-bottom: 0cm; color: rgb(13, 13, 13); margin-left: 18pt; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: none; padding: 0cm;\"><span style=\"font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif;\">Ventanal con balcón y bonita vista.<o:p></o:p></span></li><li class=\"MsoNormal\" style=\"margin-bottom: 0cm; color: rgb(13, 13, 13); margin-left: 18pt; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: none; padding: 0cm;\"><span style=\"font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif;\">Baño social. Televisor.<o:p></o:p></span></li></ul></div><div style=\"border: 1pt solid rgb(227, 227, 227); padding: 0cm; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\"><p class=\"MsoNormal\" style=\"margin-right: 0px; margin-bottom: 15pt; margin-left: 0px; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: none; padding: 0cm;\"><b style=\"font-weight: bold;\"><span style=\"font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif; color: rgb(13, 13, 13); border: 1pt solid rgb(227, 227, 227); padding: 0cm;\">Servicios Adicionales:</span></b><span style=\"font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif; color: rgb(13, 13, 13);\"><o:p></o:p></span></p></div><p><p></p></p><div style=\"box-sizing: border-box; border: 1pt solid rgb(227, 227, 227); padding: 0cm 0cm 0cm 5pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-left: 18pt; margin-right: 0cm;\"><ul type=\"disc\" style=\"box-sizing: border-box; margin: 0cm 0px 0px 20px; padding: 0px; list-style: none;\"><li class=\"MsoNormal\" style=\"box-sizing: border-box; margin-bottom: 0cm; color: rgb(13, 13, 13); margin-left: 18pt; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: none; padding: 0cm;\"><span style=\"box-sizing: border-box; font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif;\">Excelente servicio de transporte público (bus, taxi y metro).<o:p style=\"box-sizing: border-box;\"></o:p></span></li><li class=\"MsoNormal\" style=\"box-sizing: border-box; margin-bottom: 0cm; color: rgb(13, 13, 13); margin-left: 18pt; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: none; padding: 0cm;\"><span style=\"box-sizing: border-box; font-size: 12pt; font-family: &quot;Segoe UI&quot;, sans-serif;\">Cerca de supermercado Jumbo, Universidad Eafit y estación de metro Ayurá.</span></li></ul></div>', 16, 1, '1', NULL, 0, 200000, 3000000, 2100000, 3100000, 1, 5, 1, 'diagonal 47 A #17 sur 27', 'el poblado', 'aguacatala ', 'AP46 arriendo-apartamento-amoblado-el-poblado-la-aguacatala 20.jpg', 'inmobiliariacsc', 'arriendo, apartamento, amoblado, medellin, aguacatala, inmobiliariacsc ', 'https://www.youtube.com/embed/ahBlko0LdXE?si=RLE_mQnYHh8UXr9P', NULL, NULL),
(5, NULL, 1, '2024-02-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, NULL, 1, '2024-02-26', 'AP88, Sabaneta, tres recamaras, departamento amueblado en arriendo, Unidad con dos piscinas', '<h2 class=\"wp-block-heading\">Alquiler de apartamentos</h2><p> El confort y la comodidad son dos conceptos que se ven involucrados en esta acogedora propiedad con un área de 67 mts². El alojamiento está equipado con tres habitaciones de las cuales la habitación principal tiene baño privado con ducha y vestidor, además en frente de las otras dos habitaciones tenemos un segundo baño social con ducha. <br>También sala-comedor, cocina integral completamente dotada, zona de ropa, agua caliente, Internet wifi, balcón con vista hacia las montañas</p><p>Este apartamento está en una unidad ubicada en la zona campestre de Sabaneta, lo cual le da la posibilidad de estar cerca de la naturaleza, sin duda la comodidad y la tranquilidad hacen parte del diario vivir. El apartamento tiene todo su amueblado con la dotación necesaria, pensando en que a usted no le haga falta absolutamente nada.<br>La unidad residencial ofrece cancha de fútbol, piscina para adultos y niños, juegos para niños. </p><p>Cercano a centro comercial Aves María, el ceipa business school,  hospital venancio diaz diaz, mall zaratoga, éxito de sabaneta y tan solo a siete minutos de la zona comercial y gastronómica de sabaneta. </p><p><!-- wp:heading -->\r\n\r\n<!-- /wp:heading -->\r\n\r\n<!-- wp:paragraph -->\r\n\r\n<!-- /wp:paragraph -->\r\n\r\n<!-- wp:paragraph -->\r\n\r\n<!-- /wp:paragraph -->\r\n\r\n<!-- wp:paragraph -->\r\n\r\n<!-- /wp:paragraph -->\r\n\r\n<!-- wp:heading {\"level\":4} -->\r\n\r\n<!-- /wp:heading -->\r\n\r\n<!-- wp:paragraph -->\r\n<p></p>\r\n<!-- /wp:paragraph --></p><h4 class=\"wp-block-heading\">Me interesa alquilar un apartamento amoblado en sabaneta </h4>', 16, 1, '1', NULL, 0, 100000, 2000000, 110000, 2200000, 1, 5, 87, 'CLL 77 sur # 35 A 71', 'san jose ', 'maderos del campo', 'rental-penthouses-furnished-medellin-sabaneta-san-diego-envigado-laureles-dúplex-medellin-sabanetaO-AP88 (2).jpg', 'inmobiliariacsc', 'apartamento, sabaneta, en alquiler, amoblado, inmobiliaria csc, renta mes, tres habitaciones', 'https://www.youtube.com/embed/K68xqiX1lPs?si=i3-O207fu_uYyIMX', NULL, NULL),
(20, NULL, 1, '2024-03-01', 'Alquiler de Apartamento en el poblado, sector la frontera, 3 Habitaciones, ', '<p><span style=\"font-family: Arial; font-weight: 700; white-space-collapse: preserve; background-color: rgb(255, 255, 255);\">AP395:  Alquiler de Apartamento en el poblado, sector la frontera, 3 Habitaciones, Totalmente AMOBLADO</span></p><p><span style=\"font-family: Arial; font-weight: 700; white-space-collapse: preserve; background-color: rgb(255, 255, 255);\"><br></span></p><p><span style=\"font-family: Arial; font-weight: 700; white-space-collapse: preserve; background-color: rgb(255, 255, 255);\"><br></span><br></p>', 16, 1, '1', NULL, 0, 0, 0, 0, 0, 1, 5, 1, 'Cra. 44 #17c Sur 40', '', '', 'ap395, el poblado, la frontera, poblado verde,apartamento amoblado, inmobiliaria csc  (1).jpg', NULL, 'AlquilerApartamento, Apartamento, ElPoblado, SectorLaFrontera, 3Habitaciones, TotalmenteAmoblado, ApartamentoAmoblado, LivingDeLujo, AlquilerElPoblado, ViviendaDeAlquiler, ComodidadTotal, LujoResidencial, ModernoApartamento, ServiciosIncluidos, ExclusividadResidencial.ncial ModernoApartamento ServiciosIncluidos ExclusividadResidencial', '', NULL, NULL),
(22, NULL, 1, '2024-03-01', 'Alquiler de Apartamento en el poblado, sector las palmas, 3 Habitaciones', '<p><span style=\"font-family: Arial; font-weight: 700; white-space-collapse: preserve; background-color: rgb(255, 255, 255);\">AP394:  Alquiler de Apartamento en el poblado, sector las palmas, 3 Habitaciones, Totalmente AMOBLADO</span></p><p><span style=\"font-family: Arial; font-weight: 700; white-space-collapse: preserve; background-color: rgb(255, 255, 255);\"><br></span></p><p><span style=\"font-family: Arial; font-weight: 700; white-space-collapse: preserve; background-color: rgb(255, 255, 255);\"><br></span><br></p>', 16, 1, '1', NULL, 0, 0, 3900000, 0, 0, 1, 5, 1, 'Carreta 33#28-150', '', '', 'AP394 arriendo apartamento, el poblado, loma el indio (13).jpeg', 'inmobiliariacsc', '', '', NULL, NULL),
(24, NULL, 1, '2024-03-04', 'Alquiler de Apartamento en Medellín, El Poblado, sector Oviedo, 3 Habitaciones, AMOBLADO AP397 ', '<p class=\"MsoNormal\">Ciudad: medellin <o:p></o:p></p><p class=\"MsoNormal\">&nbsp; Barrio: el poblado <o:p></o:p></p><p class=\"MsoNormal\">&nbsp;&nbsp;&nbsp; Sector: Oviedo <o:p></o:p></p><p class=\"MsoNormal\">Habitaciones: 3 + estudio <o:p></o:p></p><p class=\"MsoNormal\">Baños: 2<o:p></o:p></p><p class=\"MsoNormal\">Apartamento: 610 <o:p></o:p></p><p class=\"MsoNormal\">Área total (M²): 90 <o:p></o:p></p><p class=\"MsoNormal\">Estrato:5</p><p class=\"MsoNormal\">#Parqueadero: 1 privado <o:p></o:p></p><p class=\"MsoNormal\">Seguridad: 24 horas <o:p></o:p></p><p class=\"MsoNormal\">Características de la propiedad: &nbsp;cocina amplia, habitaciones con closet, vista\r\npanorámica, sala -comedor, baños completos, agua caliente.<br></p><p class=\"MsoNormal\"><o:p></o:p></p><p>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n</p><p class=\"MsoNormal\">¿Qué puedes decirnos sobre el sector?: cerca al centro\r\ncomercial Oviedo, milla de oro del poblado, una cuadra de Carulla de Oviedo,\r\ncentro comercial santa fe distancia a dos cuadras, clínicas, restaurantes,\r\nbancos, casinos.&nbsp;<o:p></o:p></p>', 16, 1, '1', NULL, 0, 0, 6700000, 0, 0, 1, 5, 1, 'Cl. 8 Sur #43b 112', '', '', 'AP397, Arriendo apartamento amoblado en el poblado (3).jpg', 'inmobiliariacsc', 'Alquiler de Apartamento,  Medellín, El Poblado, Oviedo, 3 Habitaciones, AMOBLADO ', '', NULL, NULL),
(25, NULL, 1, '2024-03-04', 'Sabaneta, Aves Maria, 3 cuartos, piso, amueblado, en arriendo AP383', '<p>Características de la propiedad:<br></p><p>Unidad en hermoso conjunto residencial ubicado en excelente zona de sabaneta, cerca a las estaciones del metro de sabaneta y la estrella, cerca al centro comercial aves América, contiguo a la alcaldía de sabaneta y rodeado de negocios comerciales, la unidad cuenta con piscina, gym, zonas húmedas, salones sociales y zonas de recreación, ubicado en un 24 piso con una hermosa vista a la ciudad, 3 habitaciones dotadas, cocina dotada y hermosa sala para estrenar</p><p>¿Qué puedes decirnos sobre el sector?:</p><p>\r\n<!-- /wp:paragraph -->\r\n\r\n<!-- wp:paragraph -->\r\n\r\n<!-- /wp:paragraph -->\r\n\r\n<!-- wp:paragraph -->\r\n\r\n<!-- /wp:paragraph -->\r\n\r\n<!-- wp:paragraph -->\r\n\r\n<!-- /wp:paragraph --></p><p>Esta ubicado en unos de los mejores sectores de sabaneta, cerca de restaurantes, supermercados&nbsp; y todo lo que necesites</p>', 16, 1, '1', NULL, 0, 0, 4400000, 0, 0, 1, 5, 1, 'Carrera 46#75sur_150', '', '', '', 'inmobiliariacsc', 'Arriendo, apartamento, amoblado, sabaneta, kore, inmobiliaria csc', 'https://www.youtube.com/embed/K68xqiX1lPs?si=wyfVubKI4TlNeY3w', NULL, NULL),
(26, NULL, 1, '2024-03-04', 'Alquiler de Apartamento en el poblado, sector patio bonito, 3 Habitaciones, cod. AP403', '<p class=\"MsoNormal\">3 alcobas <o:p></o:p></p><p class=\"MsoNormal\">2 baños <o:p></o:p></p><p class=\"MsoNormal\">Estudio<o:p></o:p></p><p class=\"MsoNormal\">Cocina abierta<o:p></o:p></p><p class=\"MsoNormal\">Zona de ropas<o:p></o:p></p><p class=\"MsoNormal\">Parqueadero<o:p></o:p></p><p>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n</p><p class=\"MsoNormal\">Dos balcones<o:p></o:p></p>', 16, 1, '1', NULL, 0, 0, 6200000, 0, 0, 1, 5, 1, 'Cra 45 # 1-191', '', '', 'AP403 arriendo, apartamento, amoblado el poblado, torres de patio bonito (1).jpeg', 'inmobiliariacsc', 'arriendo, apartamento, amoblado, patio bonito, el poblado, medellin', '', NULL, NULL),
(29, NULL, 1, '2024-03-08', 'AP398 Alquiler de Apartaestudio en Sabaneta, sector Parque Principal, una habitación, AMOBLADO.', '<p><span style=\"font-family: Arial; font-weight: 700; white-space-collapse: preserve; background-color: rgb(255, 255, 0);\">AP398 Alquiler de Apartaestudio en Sabaneta, sector Parque Principal, una habitación, AMOBLADO.</span></p><p><span style=\"font-family: Arial; font-weight: 700; white-space-collapse: preserve; background-color: rgb(255, 255, 0);\"><br></span></p><p><br></p>', 16, 1, '1', NULL, 0, 0, 3000000, 0, 0, 1, 5, 87, 'calle71 sur # 43 B-52', '', '', '13.jpg', 'inmobiliariacsc', 'arriendo, apartamento, amoblado, sabaneta, apartaestudio, inmobiliaria csc', '', NULL, NULL),
(33, NULL, 1, '2024-03-14', 'Fi02 Finca en alquiler, GIRARDOTA, Antioquia, para 25 personas', '<p><span style=\"font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, Oxygen-Sans, Ubuntu, Cantarell, &quot;Helvetica Neue&quot;, sans-serif; font-size: 18px; white-space-collapse: preserve;\">WhatsApp   </span><a href=\"https://api.whatsapp.com/send?phone=573508453212\" style=\"--tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: #3b82f680; --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; color: rgb(34, 113, 177); transition: none 0s ease 0s; font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, Oxygen-Sans, Ubuntu, Cantarell, &quot;Helvetica Neue&quot;, sans-serif; font-size: 18px; font-weight: 400; white-space-collapse: preserve; background-color: rgb(255, 255, 255);\"> (+57) 350 845 32 12</a><span style=\"font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, Oxygen-Sans, Ubuntu, Cantarell, &quot;Helvetica Neue&quot;, sans-serif; font-size: 18px; white-space-collapse: preserve;\">     </span><br data-rich-text-line-break=\"true\" style=\"--tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: #3b82f680; --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, Oxygen-Sans, Ubuntu, Cantarell, &quot;Helvetica Neue&quot;, sans-serif; font-size: 18px; white-space-collapse: preserve;\"><span style=\"font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, Oxygen-Sans, Ubuntu, Cantarell, &quot;Helvetica Neue&quot;, sans-serif; font-size: 18px; white-space-collapse: preserve;\">WhatsApp    </span><a href=\"https://api.whatsapp.com/send?phone=573001373204\" style=\"--tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: #3b82f680; --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; color: rgb(34, 113, 177); transition: none 0s ease 0s; font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, Oxygen-Sans, Ubuntu, Cantarell, &quot;Helvetica Neue&quot;, sans-serif; font-size: 18px; font-weight: 400; white-space-collapse: preserve; background-color: rgb(255, 255, 255);\">(+57) 300 137 32 04 </a><span style=\"font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, Oxygen-Sans, Ubuntu, Cantarell, &quot;Helvetica Neue&quot;, sans-serif; font-size: 18px; white-space-collapse: preserve;\">  </span></p><p><em><b>DISPONIBILIDAD</b></em><br></p><p><em>SABADO A DOMINGO</em><br>Arriendo: 2.000.000 pesos<br>Deposito: 200.000 pesos (reembolsable)<br>Horario<br>Ingresa Sábado: 9:00 am<br>Salida Domingo: 5:00 pm</p><p>Finca de recreo con excelente vista panoramica, cerca a medellin.<br></p><p>Comodamente en camas hasta 25 personas, pero dejan ingresar hasta 35 personas&nbsp;<span style=\"font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, Oxygen-Sans, Ubuntu, Cantarell, &quot;Helvetica Neue&quot;, sans-serif; font-size: 18px; white-space-collapse: preserve;\"><br></span><br></p>', 14, 1, '1', NULL, 0, 2000000, 0, 0, 0, 1, 5, 51, 'Girardota', '', '', 'photo_4944978388746087721_y.jpg', NULL, 'Finca en alquiler, piscina para adultos, jacuzzi, moderna, economica, girardota, copacabana, barbosa', '', NULL, NULL),
(35, NULL, 1, '2024-03-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, NULL, 1, '2024-04-08', 'AP215 MEDELLIN, dos dormitorios, apartamento amoblado boston en arriendo POR NOCHES', '<p>Si estás buscando comodidad y estilo de vida en el corazón de Medellín, ¡tenemos el apartamento perfecto para ti! En CSC Inmobiliaria, nos enorgullece ofrecer un apartamento amoblado de dos dormitorios en el barrio Boston de Medellín.</p><p>Nuestro apartamento está equipado con todas las comodidades que necesitas para una estadía confortable, incluyendo una cocina moderna y totalmente equipada, sala de estar acogedora y ambiente tranquilo y relajante. Disfruta de una experiencia de hospedaje única con nuestro jacuzzi y turco, terraza con zona de fumadores, así como con acceso a WiFi y restaurante con venta de desayunos y almuerzos.</p><p>Si te gusta salir y explorar la ciudad, la ubicación de nuestro apartamento amoblado boston es ideal, cerca de restaurantes, bares y tiendas, así como de transporte público para que puedas disfrutar de todo lo que Medellín tiene para ofrecer. Algunos lugares turísticos que se encuentran cerca de Boston Medellín son el Parque de los Deseos, el Jardín Botánico y el Museo de Antioquia. Además, hay varios centros comerciales cercanos, como el Centro Comercial San Diego y el Centro Comercial Premium Plaza.</p><p>Si necesitas atención médica, hay varias clínicas y hospitales cercanos, incluyendo la Clínica Las Américas y el Hospital Universitario San Vicente Fundación. También encontrarás una amplia variedad de servicios de estética y odontología en la zona, como el Centro Odontológico San Diego y el Centro de Estética Integral.</p><p><a href=\"https://api.whatsapp.com/send?phone=573105406769\">No pierdas la oportunidad de vivir una experiencia única en nuestro apartamento en arriendo en Medellín. ¡Reserva ahora y haz de nuestro apartamento tu hogar lejos de casa en Medellín! Para reservar o recibir más información, llámanos hoy mismo.</a></p><p style=\"margin: 0cm;\"></p><p><br>Se renta por días y meses</p>', 16, 1, '1', NULL, 0, 250000, 0, 300000, 0, 1, 5, 1, 'Cra 36 # 54-54', '', '', 'AP215-MEDELLIN-Boston-dos-dormitorios-apartamento-amoblado-en-arriendo-403137933725.jpg', 'inmobiliariacsc', 'arriendo, apartamento, amoblado en boston, airbnb ', '', NULL, NULL),
(39, NULL, 1, '2024-04-08', 'Fi01 Finca en alquiler, GIRARDOTA, para 35 a 40 personas', '<p><span style=\"font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, Oxygen-Sans, Ubuntu, Cantarell, &quot;Helvetica Neue&quot;, sans-serif; font-size: 12px; white-space-collapse: preserve;\">WhatsApp </span><a href=\"https://api.whatsapp.com/send?phone=573508453212\" style=\"color: rgb(34, 113, 177); background-color: rgb(255, 255, 255); font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, Oxygen-Sans, Ubuntu, Cantarell, &quot;Helvetica Neue&quot;, sans-serif; font-weight: 400; --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: #3b82f680; --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; transition: none 0s ease 0s; font-size: 12px; white-space-collapse: preserve;\"> </a><a href=\"https://api.whatsapp.com/send?phone=573508453212\" style=\"font-weight: 400; color: rgb(34, 113, 177); background-color: rgb(255, 255, 255); font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, Oxygen-Sans, Ubuntu, Cantarell, &quot;Helvetica Neue&quot;, sans-serif; --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: #3b82f680; --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; transition: none 0s ease 0s; font-size: 12px; white-space-collapse: preserve;\">(+57) 350 845 32 12</a><span style=\"font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, Oxygen-Sans, Ubuntu, Cantarell, &quot;Helvetica Neue&quot;, sans-serif; font-size: 18px; white-space-collapse: preserve;\">     </span><a href=\"https://api.whatsapp.com/send?phone=573001373204\" style=\"font-weight: 400; color: rgb(34, 113, 177); background-color: rgb(255, 255, 255); font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, Oxygen-Sans, Ubuntu, Cantarell, &quot;Helvetica Neue&quot;, sans-serif; --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: #3b82f680; --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; transition: none 0s ease 0s; font-size: 12px; white-space-collapse: preserve;\">(+57) 300 137 32 04 </a><span style=\"font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, Oxygen-Sans, Ubuntu, Cantarell, &quot;Helvetica Neue&quot;, sans-serif; font-size: 12px; white-space-collapse: preserve;\">  </span></p><p>Arriendo: 2.750.000 pesos<br></p><p>Deposito: 300.000 pesos (reembolsable)</p><p>Ingresa Sábado: 10:00 am<br>Salida Domingo: 5:00 pm</p><p><b>DESCRIPCIÓN</b></p><p></p><p>Finca en alquiler en girardota, se renta para finde semana, dia de sol, puentes, semana santa.</p>', 14, 1, '1', NULL, 0, 2750000, 0, 0, 0, 1, 5, 51, 'Girardota', '', '', 'photo_4944978388746087715_y.jpg', 'inmobiliariacsc', 'Finca, en alquiler, girardota, barbosa, copacabana, inmobiliaria csc', '', NULL, NULL),
(40, NULL, 1, '2024-04-09', 'PR001 - PRUEBA 001', '<p>Apartamento Amoblado La calendaria</p><p>Arriendo : $2.800.000</p><p>Deposito: 200.000 (Reembolsable)</p><p>Aseo: 200.000</p><p><br></p><p>Entrada el día Sábado 10 am</p><p><br></p><p><br></p>', 0, 1, '1', NULL, 0, 0, 2800000, 0, 0, 1, 5, 1, 'Carrera 40 # 49-25, la candelaria', 'La candelaria', '', '', 'inmobiliariacsc', 'Finca, en alquiler, girardota, barbosa, copacabana, inmobiliaria csc', '', NULL, NULL),
(41, NULL, 1, '2024-04-09', 'PR002 - PRUEBA 002', '<h4 style=\"font-family: Poppins, sans-serif; line-height: 1.1; color: rgb(51, 51, 51); margin-top: 20px; margin-bottom: 15px; font-size: 22px;\">Propiedad de Prueba</h4><h4 style=\"font-family: Poppins, sans-serif; line-height: 1.1; color: rgb(51, 51, 51); margin-top: 20px; margin-bottom: 15px; font-size: 22px;\">Acerca de este espacio</h4><p><br style=\"color: rgb(51, 51, 51); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 15px;\"></p><p id=\"txtdescripcionpropiedad\" style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(51, 51, 51); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 15px; text-align: justify;\"></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px;\">Si estás buscando comodidad y estilo de vida en el corazón de Medellín, ¡tenemos el apartamento perfecto para ti! En CSC Inmobiliaria, nos enorgullece ofrecer un apartamento amoblado de dos dormitorios en el barrio Boston de Medellín.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px;\">Nuestro apartamento está equipado con todas las comodidades que necesitas para una estadía confortable, incluyendo una cocina moderna y totalmente equipada, sala de estar acogedora y ambiente tranquilo y relajante. Disfruta de una experiencia de hospedaje única con nuestro jacuzzi y turco, terraza con zona de fumadores, así como con acceso a WiFi y restaurante con venta de desayunos y almuerzos.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px;\">Si te gusta salir y explorar la ciudad, la ubicación de nuestro apartamento amoblado boston es ideal, cerca de restaurantes, bares y tiendas, así como de transporte público para que puedas disfrutar de todo lo que Medellín tiene para ofrecer. Algunos lugares turísticos que se encuentran cerca de Boston Medellín son el Parque de los Deseos, el Jardín Botánico y el Museo de Antioquia. Además, hay varios centros comerciales cercanos, como el Centro Comercial San Diego y el Centro Comercial Premium Plaza.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px;\">Si necesitas atención médica, hay varias clínicas y hospitales cercanos, incluyendo la Clínica Las Américas y el Hospital Universitario San Vicente Fundación. También encontrarás una amplia variedad de servicios de estética y odontología en la zona, como el Centro Odontológico San Diego y el Centro de Estética Integral.</p><p></p><p></p><p></p><p style=\"box-sizing: border-box; margin: 0px 0px 10px;\"><a href=\"https://api.whatsapp.com/send?phone=573105406769\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(51, 51, 51); text-decoration: none;\">No pierdas la oportunidad de vivir una experiencia única en nuestro apartamento en arriendo en Medellín. ¡Reserva ahora y haz de nuestro apartamento tu hogar lejos de casa en Medellín! Para reservar o recibir más información, llámanos hoy mismo.</a></p>', 14, 1, '1', NULL, 0, 0, 3000000, 0, 0, 1, 5, 19, 'Bello, Antioquia', '', '', '', 'inmobiliariacsc', 'finca, bello, finca en alquiler, inmobiliaria csc', 'https://youtu.be/migvFNWclbU?si=sZy-coaEqs4xgDag', NULL, NULL),
(42, NULL, 1, '2024-05-11', 'kingdom of the planet of the apes', '<p><span style=\"color: rgb(92, 92, 92); font-family: Roboto; font-size: 14px; letter-spacing: 0.45px;\">El director Wes Ball da nueva vida a la franquicia épica global ambientada varias generaciones en el futuro después del reinado de César, en la que los simios son la especie dominante que vive en armonía y los humanos se han visto reducidos a vivir en las sombras. Mientras un nuevo líder simio tiránico construye su imperio, un joven simio emprende un viaje desgarrador que lo hará cuestionar todo lo que sabía sobre el pasado y tomar decisiones que definirán el futuro tanto de los simios como de los humanos.</span><br></p>', 19, 6, '1', NULL, 15000, 15000, 15000, 15000, 15000, 1, 11, 149, 'Calle 185 No. 45 - 03', 'Mirandela', 'Suba', 'Planetadelossimios.jpg', 'DIEGOHER', 'Planeta de los simios', 'https://www.youtube.com/embed/fWWrW_VLjws?si=gNBni4SVYri4s74T', 0, 'NA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `real_estate_properties`
--

CREATE TABLE `real_estate_properties` (
  `rep_id` int(11) NOT NULL,
  `rep_description` varchar(100) DEFAULT NULL,
  `rep_status` char(1) DEFAULT NULL,
  `rep_created_by` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `real_estate_properties`
--

INSERT INTO `real_estate_properties` (`rep_id`, `rep_description`, `rep_status`, `rep_created_by`) VALUES
(2, 'Edad', 'A', 'DIEGOHER');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `r_perfil_usuario`
--

CREATE TABLE `r_perfil_usuario` (
  `idperfil` int(11) DEFAULT NULL,
  `codusuario` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `r_perfil_usuario`
--

INSERT INTO `r_perfil_usuario` (`idperfil`, `codusuario`) VALUES
(2, 'DIEGOHER'),
(2, 'PROP'),
(2, 'sandramr'),
(0, 'inmobiliariacsc'),
(1, 'FORPAO'),
(2, 'PruebasSR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `r_propiedades_caracteristicas`
--

CREATE TABLE `r_propiedades_caracteristicas` (
  `idPropiedad` int(11) DEFAULT NULL,
  `idCaracteristica` int(11) DEFAULT NULL,
  `ValorCaractaristica` varchar(50) DEFAULT NULL,
  `aspectolegalCaracteristica` varchar(800) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `r_propiedades_contactos`
--

CREATE TABLE `r_propiedades_contactos` (
  `idPropiedad` int(11) DEFAULT NULL,
  `NombreContacto` varchar(150) DEFAULT NULL,
  `EmpresaContacto` varchar(150) DEFAULT NULL,
  `TelefonoContacto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `r_propiedades_imagenes`
--

CREATE TABLE `r_propiedades_imagenes` (
  `id` int(11) NOT NULL,
  `idPropiedad` int(11) DEFAULT NULL,
  `nombreFoto` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `r_propiedades_imagenes`
--

INSERT INTO `r_propiedades_imagenes` (`id`, `idPropiedad`, `nombreFoto`) VALUES
(1, 42, 'Planetadelossimios.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `r_rep_tipos`
--

CREATE TABLE `r_rep_tipos` (
  `rep_id` int(11) DEFAULT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `is_base` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `r_rep_tipos`
--

INSERT INTO `r_rep_tipos` (`rep_id`, `tipo_id`, `is_base`) VALUES
(2, 19, 'N');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE `tipos` (
  `id` int(11) NOT NULL,
  `nombre_tipo` varchar(50) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`id`, `nombre_tipo`, `estado`) VALUES
(18, 'Acción', 'A'),
(19, 'Drama', 'A'),
(20, 'Aventura', 'A'),
(21, 'Ciencia Ficción', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `coduser` varchar(15) NOT NULL,
  `idnumber_user` varchar(20) NOT NULL,
  `name_user` varchar(350) NOT NULL,
  `nombres` varchar(150) NOT NULL,
  `apellidos` varchar(150) NOT NULL,
  `datebday` date DEFAULT NULL,
  `email_user` varchar(150) NOT NULL,
  `company` varchar(150) DEFAULT NULL,
  `phone` varchar(10) NOT NULL,
  `phone_user` varchar(15) DEFAULT NULL,
  `url` varchar(150) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `jobtittle` varchar(150) DEFAULT NULL,
  `notes` varchar(300) DEFAULT NULL,
  `pass_user` varchar(250) NOT NULL,
  `state_user` char(1) NOT NULL DEFAULT 'I',
  `createddatatime` datetime DEFAULT NULL,
  `createdby` varchar(15) DEFAULT NULL,
  `modifieddatetime` datetime DEFAULT NULL,
  `modifiedby` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`coduser`, `idnumber_user`, `name_user`, `nombres`, `apellidos`, `datebday`, `email_user`, `company`, `phone`, `phone_user`, `url`, `address`, `jobtittle`, `notes`, `pass_user`, `state_user`, `createddatatime`, `createdby`, `modifieddatetime`, `modifiedby`) VALUES
('DIEGOHER', '12345678', 'Diego Hernández', 'Diego', 'Hernández', NULL, 'diegoahernandez@ucompensar.edu.co', NULL, '3254402352', NULL, NULL, NULL, NULL, NULL, 'aa', 'A', '2024-05-11 11:39:03', 'WEBPAGE', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelicula_id` (`pelicula_id`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `costos`
--
ALTER TABLE `costos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `high_season`
--
ALTER TABLE `high_season`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `monedas`
--
ALTER TABLE `monedas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `objetivospropiedad`
--
ALTER TABLE `objetivospropiedad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `real_estate_properties`
--
ALTER TABLE `real_estate_properties`
  ADD PRIMARY KEY (`rep_id`);

--
-- Indices de la tabla `r_propiedades_imagenes`
--
ALTER TABLE `r_propiedades_imagenes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`coduser`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1120;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `costos`
--
ALTER TABLE `costos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `fotos`
--
ALTER TABLE `fotos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `high_season`
--
ALTER TABLE `high_season`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `monedas`
--
ALTER TABLE `monedas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `objetivospropiedad`
--
ALTER TABLE `objetivospropiedad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `real_estate_properties`
--
ALTER TABLE `real_estate_properties`
  MODIFY `rep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `r_propiedades_imagenes`
--
ALTER TABLE `r_propiedades_imagenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipos`
--
ALTER TABLE `tipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`pelicula_id`) REFERENCES `peliculas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
