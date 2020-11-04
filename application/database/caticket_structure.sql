/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 5.5.64-MariaDB : Database - caticket
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`caticket` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci */;

USE `caticket`;

/*Table structure for table `categoria` */

DROP TABLE IF EXISTS `categoria`;

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

/*Table structure for table `equipo` */

DROP TABLE IF EXISTS `equipo`;

CREATE TABLE `equipo` (
  `id_equipo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id_equipo`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

/*Table structure for table `estado` */

DROP TABLE IF EXISTS `estado`;

CREATE TABLE `estado` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_estado`),
  UNIQUE KEY `id_estado_UNIQUE` (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

/*Table structure for table `nota` */

DROP TABLE IF EXISTS `nota`;

CREATE TABLE `nota` (
  `usuario` int(11) NOT NULL,
  `nota` text COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

/*Table structure for table `observacion` */

DROP TABLE IF EXISTS `observacion`;

CREATE TABLE `observacion` (
  `id_observacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_ticket` int(11) NOT NULL,
  `observacion` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `creador` int(11) NOT NULL,
  `activo` int(1) NOT NULL DEFAULT '1',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_observacion`),
  UNIQUE KEY `id_observacion_UNIQUE` (`id_observacion`),
  KEY `OBSERVACIONES_index_9` (`id_ticket`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

/*Table structure for table `poder` */

DROP TABLE IF EXISTS `poder`;

CREATE TABLE `poder` (
  `id_poder` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_poder`),
  UNIQUE KEY `id_poder` (`id_poder`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

/*Table structure for table `prioridad` */

DROP TABLE IF EXISTS `prioridad`;

CREATE TABLE `prioridad` (
  `id_prioridad` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_prioridad`),
  UNIQUE KEY `id_prioridad` (`id_prioridad`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

/*Table structure for table `sector` */

DROP TABLE IF EXISTS `sector`;

CREATE TABLE `sector` (
  `id_sector` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_sector`)
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

/*Table structure for table `sede` */

DROP TABLE IF EXISTS `sede`;

CREATE TABLE `sede` (
  `id_sede` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_sede`),
  UNIQUE KEY `id_sede_UNIQUE` (`id_sede`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

/*Table structure for table `ticket` */

DROP TABLE IF EXISTS `ticket`;

CREATE TABLE `ticket` (
  `id_ticket` int(11) NOT NULL AUTO_INCREMENT,
  `creador` int(11) NOT NULL,
  `responsable` int(11) DEFAULT NULL,
  `solicitante` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `interno` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `terminal` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `estado` int(1) NOT NULL DEFAULT '1',
  `fecha_resolucion` timestamp NULL DEFAULT NULL,
  `resolucion` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `fecha_alta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `prioridad` int(11) NOT NULL DEFAULT '0',
  `equipo` int(11) NOT NULL DEFAULT '0',
  `tipo` int(11) NOT NULL DEFAULT '0',
  `categoria` int(11) NOT NULL DEFAULT '0',
  `sector` int(11) NOT NULL DEFAULT '0',
  `sede` int(11) NOT NULL DEFAULT '1',
  `cerrador` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_ticket`),
  KEY `TICKETS_index_4` (`creador`),
  KEY `TICKETS_index_5` (`responsable`),
  KEY `TICKETS_index_6` (`estado`),
  KEY `TICKETS_index_7` (`prioridad`),
  KEY `FK_Equipo` (`equipo`),
  KEY `FK_Tipo` (`tipo`),
  KEY `FK_Categoria` (`categoria`),
  KEY `FK_Sede_idx` (`sede`),
  KEY `FK_Sector` (`sector`),
  CONSTRAINT `FK_Categoria` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`id_categoria`),
  CONSTRAINT `FK_Creador` FOREIGN KEY (`creador`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `FK_Equipo` FOREIGN KEY (`equipo`) REFERENCES `equipo` (`id_equipo`),
  CONSTRAINT `FK_Estado` FOREIGN KEY (`estado`) REFERENCES `estado` (`id_estado`),
  CONSTRAINT `FK_Prioridad` FOREIGN KEY (`prioridad`) REFERENCES `prioridad` (`id_prioridad`),
  CONSTRAINT `FK_Sector` FOREIGN KEY (`sector`) REFERENCES `sector` (`id_sector`),
  CONSTRAINT `FK_Sede` FOREIGN KEY (`sede`) REFERENCES `sede` (`id_sede`),
  CONSTRAINT `FK_Tipo` FOREIGN KEY (`tipo`) REFERENCES `tipo` (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=5885 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

/*Table structure for table `tipo` */

DROP TABLE IF EXISTS `tipo`;

CREATE TABLE `tipo` (
  `id_tipo` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `apellido` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `poderes` tinyint(4) NOT NULL,
  `caticket` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Usuario de caticket al que se le puede interactuar por medio de tickets',
  `fecha_alta` date NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `vigencia` date DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `id_usuario_UNIQUE` (`id_usuario`),
  KEY `USUARIOS_index_1` (`poderes`),
  KEY `ID_INDEX` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

/* Procedure structure for procedure `BlanquearPassword` */

/*!50003 DROP PROCEDURE IF EXISTS  `BlanquearPassword` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `BlanquearPassword`(in vUser varchar(255), 
	in vEmail varchar(255), 
    in vPass varchar(255))
BEGIN
	if(select 1 from usuario where user=vUser and email=vEmail) then
		update usuario set 
			vigencia=null,
            password=vPass
		where user=vUser and email=vEmail;
        select 1 as ban;
    end if;
END */$$
DELIMITER ;

/* Procedure structure for procedure `CerrarTicket` */

/*!50003 DROP PROCEDURE IF EXISTS  `CerrarTicket` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `CerrarTicket`(IN iTicket INT, IN tResolucion TEXT, IN iUser INT)
BEGIN
	UPDATE ticket 
    SET estado=2,
		resolucion=tResolucion,
        fecha_resolucion=CURRENT_TIMESTAMP,
        cerrador=iUser
	WHERE id_ticket=iTicket;
	SELECT 1 AS bandera;
END */$$
DELIMITER ;

/* Procedure structure for procedure `GetCategorias` */

/*!50003 DROP PROCEDURE IF EXISTS  `GetCategorias` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `GetCategorias`()
BEGIN
		select * from categoria;
	END */$$
DELIMITER ;

/* Procedure structure for procedure `GetEquipos` */

/*!50003 DROP PROCEDURE IF EXISTS  `GetEquipos` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `GetEquipos`()
BEGIN
		select * from equipo;
	END */$$
DELIMITER ;

/* Procedure structure for procedure `GetEstados` */

/*!50003 DROP PROCEDURE IF EXISTS  `GetEstados` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `GetEstados`()
BEGIN

		SELECT * FROM caticket.estado e where e.activo=1;

	END */$$
DELIMITER ;

/* Procedure structure for procedure `GetNota` */

/*!50003 DROP PROCEDURE IF EXISTS  `GetNota` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `GetNota`(in iUser int)
BEGIN
		select n.nota from caticket.nota n where n.usuario=iUser;
	END */$$
DELIMITER ;

/* Procedure structure for procedure `GetObservacionesTicket` */

/*!50003 DROP PROCEDURE IF EXISTS  `GetObservacionesTicket` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `GetObservacionesTicket`(in iTicket int)
BEGIN
		select * from caticket.observacion where id_ticket=iTicket;
	END */$$
DELIMITER ;

/* Procedure structure for procedure `GetPrioridades` */

/*!50003 DROP PROCEDURE IF EXISTS  `GetPrioridades` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `GetPrioridades`()
BEGIN

		SELECT * FROM caticket.prioridad p where p.activo=1;

	END */$$
DELIMITER ;

/* Procedure structure for procedure `GetSectores` */

/*!50003 DROP PROCEDURE IF EXISTS  `GetSectores` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `GetSectores`()
BEGIN
		select * from sector where activo=1;
	END */$$
DELIMITER ;

/* Procedure structure for procedure `GetSedes` */

/*!50003 DROP PROCEDURE IF EXISTS  `GetSedes` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `GetSedes`()
BEGIN
	select * from sede where activo=1;
END */$$
DELIMITER ;

/* Procedure structure for procedure `GetTicketsPorUsuario` */

/*!50003 DROP PROCEDURE IF EXISTS  `GetTicketsPorUsuario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `GetTicketsPorUsuario`(in iUser int)
BEGIN
		select 	t.id_ticket,
			t.creador,
			t.solicitante,
			t.descripcion,
			t.fecha,
			t.hora,
			concat(u.apellido, ", ", u.nombre) as usuario,
			t.estado,
			p.id_prioridad,
			p.descripcion as prioridad
		from caticket.ticket t
		left join caticket.usuario u
		on t.creador=u.id_usuario
		LEFT JOIN caticket.prioridad p
		ON t.prioridad=p.id_prioridad
		where t.responsable=iUser and t.estado=1
		order by t.id_ticket desc;
	END */$$
DELIMITER ;

/* Procedure structure for procedure `GetEstadisticasPorUsuario` */

/*!50003 DROP PROCEDURE IF EXISTS  `GetEstadisticasPorUsuario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `GetEstadisticasPorUsuario`(in iUser int)
BEGIN
		select "Urgentes" AS descripcion, COUNT(*) AS cantidad from ticket where prioridad = 4 and estado=1 and responsable=iUser
		union
		select "Alta prioridad" as descripcion, count(*) as cantidad from ticket where prioridad = 3 and estado=1 and responsable=iUser
		union
		select "Media prioridad" AS descripcion, COUNT(*) AS cantidad from ticket where prioridad = 2 and estado=1 and responsable=iUser
		union
		select "Baja prioridad" AS descripcion, COUNT(*) AS cantidad from ticket where prioridad = 1 and estado=1 and responsable=iUser
		union
		select "Abiertos" AS descripcion, COUNT(*) AS cantidad from ticket where estado = 1 and responsable=iUser
		union
		select "Cerrados" AS descripcion, COUNT(*) AS cantidad from ticket where estado = 2 and responsable=iUser;
	END */$$
DELIMITER ;

/* Procedure structure for procedure `GetTicket` */

/*!50003 DROP PROCEDURE IF EXISTS  `GetTicket` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `GetTicket`(in iID int)
BEGIN
        select 	
			t.id_ticket,
			t.creador,
			t.solicitante,
			t.descripcion,
			t.fecha,
			t.hora,
			t.creador,
            t.tipo,
            ti.descripcion as tipo_descripcion,
            t.interno,
            t.email,
            t.equipo,
            eq.descripcion as equipo_descripcion,
            t.categoria,
            c.descripcion as categoria_descripcion,
            t.terminal,
			CONCAT(uc.apellido, ", ", uc.nombre) as creador_nombre,
			t.responsable,
			CONCAT(ur.apellido, ", ", ur.nombre) as responsable_nombre,
			t.estado,
			e.descripcion as estado_descripcion,
			t.prioridad,
			p.descripcion as prioridad_descripcion,
			t.estado,
			t.sede,
			s.descripcion as sede_descripcion,
			t.sector,
			se.descripcion as sector_descripcion
		from caticket.ticket t
		left join caticket.usuario uc
		on t.creador=uc.id_usuario
		left join caticket.estado e
		on t.estado=e.id_estado
		left join caticket.usuario ur
		on t.responsable=ur.id_usuario
		left join caticket.prioridad p
		on t.prioridad=p.id_prioridad
		left join caticket.sede s
		on t.sede=s.id_sede
		left join caticket.tipo ti
		on t.tipo=ti.id_tipo
		left join caticket.equipo eq
		on t.equipo=eq.id_equipo
		left join caticket.categoria c
		on t.categoria=c.id_categoria
		left join caticket.sector se
		on t.sector=se.id_sector
		where t.id_ticket=iID;
	END */$$
DELIMITER ;

/* Procedure structure for procedure `GetTickets` */

/*!50003 DROP PROCEDURE IF EXISTS  `GetTickets` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `GetTickets`(
		in dDesde date,
		in dHasta date,
		in iEstado int,
		in iPrioridad int
	)
BEGIN
		SELECT 	t.id_ticket,
			t.creador,
			t.solicitante,
			t.descripcion,
			t.fecha,
			t.hora,
			t.creador,
			CONCAT(uc.apellido, ", ", uc.nombre) AS creador_nombre,
			t.responsable,
			CONCAT(ur.apellido, ", ", ur.nombre) AS responsable_nombre,
			t.estado,
			e.descripcion as estado_descripcion,
			t.prioridad,
			p.descripcion as prioridad_descripcion,
			t.fecha_resolucion
		FROM caticket.ticket t
		LEFT JOIN caticket.usuario uc
		ON t.creador=uc.id_usuario
		LEFT JOIN caticket.estado e
		ON t.estado=e.id_estado
		LEFT JOIN caticket.usuario ur
		ON t.responsable=ur.id_usuario
		left join caticket.prioridad p
		on t.prioridad=p.id_prioridad
		where	t.fecha>=dDesde
			and t.fecha<=dHasta
			and if(iEstado=0, true, t.estado=iEstado)
			and IF(iPrioridad=0, TRUE, t.prioridad=iPrioridad)
			
		order by id_ticket desc;
	END */$$
DELIMITER ;

/* Procedure structure for procedure `GetTipos` */

/*!50003 DROP PROCEDURE IF EXISTS  `GetTipos` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `GetTipos`()
BEGIN
		select * from tipo;
	END */$$
DELIMITER ;

/* Procedure structure for procedure `GetUsuariosTickets` */

/*!50003 DROP PROCEDURE IF EXISTS  `GetUsuariosTickets` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `GetUsuariosTickets`()
BEGIN

		SELECT 0 as id_usuario, "Sin asignar" as nombre

		UNION

		SELECT
			u.id_usuario,
			CONCAT(u.apellido, ", ", u.nombre) as nombre
		from caticket.usuario u
		where u.activo=1 and u.caticket=1;

	END */$$
DELIMITER ;

/* Procedure structure for procedure `Login` */

/*!50003 DROP PROCEDURE IF EXISTS  `Login` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `Login`(in vUser varchar(255), in vPassword varchar(255))
BEGIN
		select 
			u.id_usuario, 
			u.user,
			u.apellido,
			u.nombre,
			u.email,
			u.poderes,
            u.vigencia,
            u.activo,
            u.caticket
		from caticket.usuario u
		where 
			u.user=vUser
			and u.password=vPassword
            and not activo = 0;

	END */$$
DELIMITER ;

/* Procedure structure for procedure `SetNota` */

/*!50003 DROP PROCEDURE IF EXISTS  `SetNota` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SetNota`(in iUser int, in tNota text)
BEGIN
		if exists(select 1 from caticket.nota where usuario=iUser) then
			update caticket.nota set nota=tNota where usuario=iUser;
		else
			insert into caticket.nota (usuario, nota) values (iUser, tNota);
		end if;
		select 1 as bandera;
	END */$$
DELIMITER ;

/* Procedure structure for procedure `SetObservacion` */

/*!50003 DROP PROCEDURE IF EXISTS  `SetObservacion` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `SetObservacion`(in iTicket int, in vObservacion varchar(255), in iUser int)
BEGIN
		insert into caticket.observacion (id_ticket, observacion, creador) values (iTicket, vObservacion, iUser);
		select * from caticket.observacion where id_observacion=last_insert_id();
	END */$$
DELIMITER ;

/* Procedure structure for procedure `SetTicket` */

/*!50003 DROP PROCEDURE IF EXISTS  `SetTicket` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `SetTicket`(
						in iCreador int,
						in iResponsable int,
						in vSolicitante varchar(255),
						in vDescripcion varchar(255),
						in dFecha date,
						in tHora time,
						in vInterno varchar(255),
						in vTerminal varchar(255),
						in vEmail varchar(255),
						in iPrioridad int,
						IN iTipo INT,
						IN iEquipo INT,
						IN iCategoria INT,
						in iSector int,
                        in iSede int
					)
BEGIN

		INSERT INTO caticket.ticket
			(
				`creador`,
				`responsable`,
				`solicitante`,
				`descripcion`,
				`fecha`,
				`hora`,
				`interno`,
				`terminal`,
				`email`,
				`prioridad`,
				`tipo`,
				`equipo`,
				`categoria`,
				`sector`,
                `sede`
			)
		VALUES
			(
				iCreador,
				if(iResponsable = 0,  null, iResponsable),
				vSolicitante,
				vDescripcion,
				dFecha,
				tHora,
				vInterno,
				vTerminal,
				vEmail,
				iPrioridad,
				iTipo,
				iEquipo,
				iCategoria,
				iSector,
                iSede
			);

		select LAST_INSERT_ID() as id;

	END */$$
DELIMITER ;

/* Procedure structure for procedure `UpdatePassword` */

/*!50003 DROP PROCEDURE IF EXISTS  `UpdatePassword` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `UpdatePassword`(in iUser int, in vPassword varchar(255))
BEGIN
	if(select 1 from usuario where id_usuario=iUser) then
		update usuario set 
			password=vPassword,
            vigencia=date(NOW() + INTERVAL 3 MONTH)
		where id_usuario=iUser;
        select 1 as ban;
    end if;
END */$$
DELIMITER ;

/* Procedure structure for procedure `UpdateTicket` */

/*!50003 DROP PROCEDURE IF EXISTS  `UpdateTicket` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `UpdateTicket`(in iTicket int, in iResponsable int, in vInterno varchar(255), in vTerminal varchar(255), in vEmail varchar(255), in iUser int)
BEGIN
		update caticket.ticket set 
			responsable=iResponsable, 
			interno=vInterno, 
			terminal=vTerminal, 
			email=vEmail 
		where id_ticket=iTicket;
		
		select 1 as bandera;
	END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
