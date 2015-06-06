/*
SQLyog Ultimate v8.61 
MySQL - 5.5.16 : Database - cabildear
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `categorias` */

DROP TABLE IF EXISTS `categorias`;

CREATE TABLE `categorias` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `categorias` */

/*Table structure for table `estados` */

DROP TABLE IF EXISTS `estados`;

CREATE TABLE `estados` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `estados` */

insert  into `estados`(`id`,`descripcion`) values (1,'aceptado'),(2,'abstencion'),(3,'negativo');

/*Table structure for table `legislador_usuario` */

DROP TABLE IF EXISTS `legislador_usuario`;

CREATE TABLE `legislador_usuario` (
  `legislador_id` bigint(20) DEFAULT NULL,
  `usuario_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `legislador_usuario` */

/*Table structure for table `legisladores` */

DROP TABLE IF EXISTS `legisladores`;

CREATE TABLE `legisladores` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellido` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `partido_id` bigint(20) DEFAULT NULL,
  `mail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ddjj` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `web` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `proyectos` bigint(20) DEFAULT NULL,
  `creacion` datetime DEFAULT NULL,
  `ultima_actividad` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `legisladores` */

/*Table structure for table `opciones` */

DROP TABLE IF EXISTS `opciones`;

CREATE TABLE `opciones` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `opcion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `valor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `opciones` */

insert  into `opciones`(`id`,`opcion`,`valor`) values (1,'root','');

/*Table structure for table `partidos` */

DROP TABLE IF EXISTS `partidos`;

CREATE TABLE `partidos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creacion` datetime DEFAULT NULL,
  `ultima_actividad` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `partidos` */

/*Table structure for table `propuesta_categoria` */

DROP TABLE IF EXISTS `propuesta_categoria`;

CREATE TABLE `propuesta_categoria` (
  `propuesta_id` bigint(20) DEFAULT NULL,
  `categoria_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `propuesta_categoria` */

/*Table structure for table `propuesta_respuesta_legislador` */

DROP TABLE IF EXISTS `propuesta_respuesta_legislador`;

CREATE TABLE `propuesta_respuesta_legislador` (
  `propuesta_id` bigint(20) NOT NULL,
  `respuesta_id` bigint(20) DEFAULT NULL,
  `legislador_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `propuesta_respuesta_legislador` */

/*Table structure for table `propuestas` */

DROP TABLE IF EXISTS `propuestas`;

CREATE TABLE `propuestas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `titulo` text COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `usuario_id` bigint(20) NOT NULL,
  `creacion` datetime NOT NULL,
  `imagen` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT '1',
  `ultima_actividad` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `propuestas` */

/*Table structure for table `respuestas` */

DROP TABLE IF EXISTS `respuestas`;

CREATE TABLE `respuestas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `texto` longtext COLLATE utf8_unicode_ci,
  `estado_id` int(10) DEFAULT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `respuestas` */

/*Table structure for table `tipos` */

DROP TABLE IF EXISTS `tipos`;

CREATE TABLE `tipos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tipos` */

insert  into `tipos`(`id`,`tipo`) values (1,'usuario'),(2,'moderador'),(3,'administrador'),(4,'legislador'),(5,'ong'),(6,'adherente');

/*Table structure for table `usuario_tipo` */

DROP TABLE IF EXISTS `usuario_tipo`;

CREATE TABLE `usuario_tipo` (
  `usuario_id` bigint(20) DEFAULT NULL,
  `tipo_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `usuario_tipo` */

insert  into `usuario_tipo`(`usuario_id`,`tipo_id`) values (1,3);

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `es_persona_fisica` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `usuarios` */

insert  into `usuarios`(`id`,`titulo`,`descripcion`,`email`,`facebook`,`twitter`,`foto`,`password`,`es_persona_fisica`) values (1,'superadmin',NULL,NULL,NULL,NULL,NULL,'LBjnkaEhB4zEw',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
