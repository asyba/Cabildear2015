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
/*Table structure for table `adherentes` */

DROP TABLE IF EXISTS `adherentes`;

CREATE TABLE `adherentes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `adherentes` */

insert  into `adherentes`(`id`,`nombre`,`logo`) values (1,'Poder Ciudadano','http://poderciudadano.org/sitio/wp-content/uploads/2014/11/Banner-web-25.jpg'),(2,'Fundacion emase','http://www.fundacionemase.org/images/logo-e+e.png'),(3,'Techo','https://www.techo.org.ar/socios/wp-content/themes/techo/assets/img/techoslider.png'),(4,'Open Data Cordoba','https://pbs.twimg.com/profile_images/525666671621455872/xkpisxVy.png'),(5,'Fundacion Rosa','https://pbs.twimg.com/profile_images/544883957393674241/Y_NDxIch.png'),(6,'Fundacion Gene','http://fundaciongene.org/wp-content/uploads/2013/11/Isologotipo-Fundaci%C3%B3n-Gen-E.png'),(7,'Ministerio de Industria Comercio y Mineria','http://www.cba.gov.ar/wp-content/themes/evolucion/img/logo_gobcordoba.png');

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
  `usuario_id` bigint(20) DEFAULT NULL,
  `creacion` datetime DEFAULT NULL,
  `imagen` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT '1',
  `ultima_actividad` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `propuestas` */

insert  into `propuestas`(`id`,`titulo`,`descripcion`,`usuario_id`,`creacion`,`imagen`,`activo`,`ultima_actividad`) values (1,'Software publico para municipios','Se requiere un equipo que impulse e integre desarrollo de software público (abierto y promovido por el estado) para que los municipios dejen de gastar tanto dinero en soluciones cerradas.\r\nLos municipios muchas veces no tiene equipos técnicos tomando decisiones de que tecnologia contrara y muchas veces terminan comprando por separado soluciones que no se integran.',2,NULL,NULL,1,NULL),(2,'Reforma Ley Provincial Agroquimicos','Reforma de la Ley Provincial 9164, que introduzca la modificación de la autoridad de aplicación (pasar de Agricultura a Ambiente); prohibición de fumigaciones aéreas y distancias de 2000mts de viviendas, escuelas y cursos de agua para fumigación terrestre; realización de evaluación de impacto ambiental a las fumigaciones; incorporación de la participación ciudadana al consejo provincial de agroquímicos. ',3,NULL,NULL,1,NULL),(3,'Vivienda y Producción Social del Hábitat  ','Establece la creación de un Sistema Integral de Políticas para la Vivienda y el Hábitat (SIPVH) que articule, coordine, complemente políticas, programas y los diferentes recursos públicos que se destinan para atender el desarrollo habitacional, en el ejercicio de las responsabilidades del Estado, a través de sus diferentes organismos, poderes y jurisdicciones.\r\nEl proyecto fue presentado en 2011 y nuevamente en 2013 luego de que perdiera estado parlamentario.2011: Cámara de Senadores: S2821/11 Cámara de Diputados: 5686 D 20112013: Cámara de Senadores: S2538/13 Cámara de Diputados: 5763 D 2013',4,NULL,NULL,1,NULL),(4,'Regulación del procedimiento de Desalojos  ','Consideramos que es imprescindible que se realicen las reformas legales y se implementen políticas públicas para dar cumplimiento a las obligaciones consagradas en los tratados de derechos humanos, especialmente los establecidos en la Observación General n° 4 y n° 7 del Comité de Derechos Económicos Sociales y Culturales en relación al procedimiento de Desalojos. \r\nEl proyecto fue presentado en 2011 y nuevamente en 2013 luego de que perdiera estado parlamentario.2011: Cámara de Senadores: S2847/11 Cámara de Diputados: 5648 D 20112013: Cámara de Senadores: S1745/13 Cámara de Diputados: 2744/13',5,NULL,NULL,1,NULL),(5,'Ley de Huertas Urbanas','Pedimos que se trabaje en la exigencia de crear huertas en espacios públicos urbanos.',5,NULL,NULL,1,NULL);

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

insert  into `usuario_tipo`(`usuario_id`,`tipo_id`) values (1,3),(2,1),(3,1),(4,1),(5,1);

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `es_persona_fisica` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `usuarios` */

insert  into `usuarios`(`id`,`titulo`,`slug`,`descripcion`,`email`,`facebook`,`twitter`,`foto`,`password`,`es_persona_fisica`) values (1,'superadmin','superadmin',NULL,NULL,NULL,NULL,NULL,'LBjnkaEhB4zEw',0),(2,'Andres Vazquez','andrez_vazquez',NULL,'andres@data99.com.ar',NULL,NULL,NULL,' ',1),(3,'Proyecto Ciudadania','proyecto_ciudadania',NULL,'proyectociudadania@gmail.com',NULL,NULL,NULL,'',0),(4,'Un Techo','techo',NULL,'pao-ferreyra@hotmail.com',NULL,NULL,NULL,'',0),(5,'Daniel Calvo','daniel_calvo',NULL,'dancalvos@hotmail.com',NULL,NULL,NULL,'',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
