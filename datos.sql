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
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `legisladores` */

insert  into `legisladores`(`id`,`nombre`,`apellido`,`descripcion`,`partido_id`,`mail`,`twitter`,`facebook`,`telefono`,`foto`,`ddjj`,`web`,`proyectos`,`creacion`,`ultima_actividad`) values (1,'Julio Alberto','AGOSTI',NULL,1,'Julio.Agosti@legiscba.gob.ar','@legislaturacba','https://www.facebook.com/julio.agosti?fref=ts','(0351) 420 3468','http://www.legiscba.gob.ar/xFotos/Julio_Alberto_Agosti.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=901 ',NULL,526,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,'Orlando Víctor','ARDUH',NULL,2,'Orlando.Arduh@legiscba.gob.ar','https://twitter.com/orlandoarduh','https://www.facebook.com/legisladororlando.arduh','(0351) 420 3471','http://www.legiscba.gob.ar/xFotos/Orlando_Victor_Arduh.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=868',NULL,270,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,'Roberto César','BIRRI',NULL,3,'Roberto.Birri@legiscba.gob.ar','https://twitter.com/robertobirri','https://www.facebook.com/robertocesar.birri','(0351) 420 3462','http://www.legiscba.gob.ar/xFotos/Roberto_Cesar_Birri.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=808',NULL,1116,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,'Rubén Alberto','BORELLO',NULL,4,'Ruben.Borello@legiscba.gob.ar','https://twitter.com/borello_ruben',NULL,'(0351) 420 3452','http://www.legiscba.gob.ar/xFotos/Ruben_Alberto_Borello.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=918',NULL,131,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(5,'Graciela Susana ','BRARDA',NULL,5,'Graciela.Brarda@legiscba.gob.ar','https://twitter.com/gracielabrarda','https://www.facebook.com/graciela.brarda.5','(0351) 420 3417','http://www.legiscba.gob.ar/xFotos/Graciela_Susana_Brarda.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=873',NULL,552,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(6,'Luis Alberto ','BROUWER de KONING',NULL,2,'Luis.BrouwerdeKoning@legiscba.gob.ar','https://twitter.com/luisbdkoning','https://www.facebook.com/lbrouwerdekoning','(0351) 420 3441','http://www.legiscba.gob.ar/xFotos/Luis_Alberto_Brouwer_de_Koning.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=910',NULL,660,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(7,'Anselmo Emilio','BRUNO','',2,'Anselmo.Bruno@legiscba.gob.ar','@LegislaturaCBA','-','(0351) 420 3449','http://www.legiscba.gob.ar/xFotos/Anselmo_Emilio_Bruno.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=473','',282,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(8,'María Elisa','CAFFARATTI','',2,'MariaElisa.Caffaratti@legiscba.gob.ar','https://twitter.com/caffarattielisa','https://www.facebook.com/LegisladoraElisaCaffaratti','(0351) 420 3451','http://www.legiscba.gob.ar/xFotos/Maria_Elisa_Caffaratti.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=912','',347,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(9,'María del Carmen','CEBALLOS de CARBONETTI','',5,'Carmen.Ceballos@legiscba.gob.ar','@LegislaturaCBA','-','(0351) 420 3453','http://www.legiscba.gob.ar/xFotos/Maria_del_Carmen_Ceballos.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=877','',295,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(10,'María Amelia','CHIOFALO','',5,'MariaAmelia.Chiofalo@legiscba.gob.ar','@LegislaturaCBA','https://www.facebook.com/mariaamelia.chiofalo','(0351) 420-3414','http://www.legiscba.gob.ar/xFotos/Maria_Amelia_Chiofalo.jpg','NO PRESENTA','',221,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(11,'Juan Manuel','CID','',5,'Juan.Cid@legiscba.gob.ar','https://twitter.com/juanmanuelcid1','https://www.facebook.com/JuanManuelCid','(0351) 420 3485','http://www.legiscba.gob.ar/xFotos/Juan_Manuel_Cid.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=635','',455,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(12,'Edgardo Santiago','CLAVIJO','',1,'Edgar.Clavijo@legiscba.gob.ar','https://twitter.com/santiagoclavijo','https://www.facebook.com/SantiagoFlacoClavijo','(0351) 420 3466','http://www.legiscba.gob.ar/xFotos/Edgar_Santiago_Clavijo.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=902','http://santiagoclavijo.com',508,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(13,'Rodrigo Alfredo','de LOREDO','',2,'Rodrigo.DeLoredo@legiscba.gob.ar','https://twitter.com/rodrigodeloredo','https://www.facebook.com/rodrigodeloredo','(0351) 420 3423','http://www.legiscba.gob.ar/xFotos/Rodrigo_Alfredo_De_Loredo.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=913','http://rodrigodeloredo.com.ar',350,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(14,'María Alejandra','del BOCA','',1,'MariaAlejandra.DelBoca@legiscba.gob.ar','@LegislaturaCBA','https://www.facebook.com/adelboca','(0351) 420 3404','http://www.legiscba.gob.ar/xFotos/Maria_Alejandra_Del_Boca.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=903','',492,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(15,'Carlos Alberto','FELPETO','',2,'Carlos.Felpeto@legiscba.gob.ar','@LegislaturaCBA','https://www.facebook.com/carlosalberto.felpeto','(0351) 420 3461','http://www.legiscba.gob.ar/xFotos/Carlos_Alberto_Felpeto.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=505','',264,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(16,'Nadia','FERNANDEZ','',5,'nadia.fernandez@legiscba.gob.ar','https://twitter.com/nadiavfernandez','https://www.facebook.com/pages/Nadia-Fernández/483809661752874?fref=ts','(0351) 4203479','http://www.legiscba.gob.ar/xFotos/Nadia_Vanesa_Fernandez.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=809','',390,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(17,'Ricardo Oscar','FONSECA','',1,'ricardo.fonseca@legiscba.gob.ar','https://twitter.com/LegislaturaCBA','https://www.facebook.com/profile.php?id=1399355482&fref=ts','(0351) 4203450','http://www.legiscba.gob.ar/xFotos/Ricardo_Oscar_Fonseca.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=659','',1437,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(18,'Marisa','GAMAGGIO SOSA','',5,'marisa.gamaggiososa@legiscba.gob.ar','https://twitter.com/marisagamaggio','https://www.facebook.com/profile.php?id=100005630928011&fref=ts','(0351) 4203478','http://www.legiscba.gob.ar/xFotos/Marisa_Gamaggio_Sosa.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=860','',261,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(19,'Aurelio Francisco Garcia Elorrio','GARCIA ELORRIO','',6,'aurelio.garciaelorrio@legiscba.gob.ar','https://twitter.com/AGarciaElorrio','https://www.facebook.com/garciaelorrio217?fref=ts','(0351) 4203489','http://www.legiscba.gob.ar/xFotos/Aurelio_Francisco_Garcia_Elorrio.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=919','',302,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(20,'Silvia','GIGENA','',5,'silvianoemi.gigenademagalahes@legiscba.gob.ar','https://twitter.com/LegislaturaCBA','https://www.facebook.com/pages/Legislatura-de-la-Provincia-de-Córdoba/233613593320288?fref=ts','(0351) 4203490','http://www.legiscba.gob.ar/xFotos/Silvia_Gigena.jpg','NO PRESENTA','',83,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(21,'Carlos Mario','GUTIERREZ','',5,'carlos.gutierrez@legiscba.gob.ar','https://twitter.com/LegislaturaCBA','https://www.facebook.com/pages/Legislatura-de-la-Provincia-de-Córdoba/233613593320288?fref=ts','(0351) 4203457','http://www.legiscba.gob.ar/xFotos/Carlos_Mario_Gutierrez.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=866','',211,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(22,'Dante Fortunato','HEREDIA','',5,'dante.heredia@legiscba.gob.ar','https://twitter.com/LegislaturaCBA','https://www.facebook.com/pages/Legislatura-de-la-Provincia-de-Córdoba/233613593320288?fref=ts','(0351) 4203426','http://www.legiscba.gob.ar/xFotos/Dante_Fortunato_Heredia.jpg','NO PRESENTA','',390,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(23,'Marta Nicolasa','JUAREZ','',7,'marta.juarez@legiscba.gob.ar','https://twitter.com/LegislaturaCBA','https://www.facebook.com/pages/Legislatura-de-la-Provincia-de-Córdoba/233613593320288?fref=ts','(0351)  4203422','http://www.legiscba.gob.ar/xFotos/Marta_Nicolasa_Juarez.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=904','',602,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(24,'Maria Laura','LABAT','',5,'marialaura.labat@legiscba.gob.ar','https://twitter.com/LauraLabat','https://www.facebook.com/LauraLabatOficial','(0351) 4203405','http://www.legiscba.gob.ar/xFotos/Maria_Laura_Labat.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=883','',269,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(25,'Maria Fernanda','LEIVA','',1,'mariafernanda.leiva@legiscba.gob.ar','https://twitter.com/LegislaturaCBA','https://www.facebook.com/pages/Legislatura-de-la-Provincia-de-Córdoba/233613593320288?fref=ts','(0351) 4203421','http://www.legiscba.gob.ar/xFotos/Maria_Fernanda_Leiva.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=644','',696,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(26,'Nancy Fabiola','LIZZUL','',1,'nancy.lizzul@legiscba.gob.ar','https://twitter.com/NancyLizzul','https://www.facebook.com/lizzulnancy','(0351) 4203464','http://www.legiscba.gob.ar/xFotos/Nancy_Fabiola_Lizzul.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=802','',871,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(27,'Maria Alejandra','MATAR','',2,'alejandra.matar@legiscba.gob.ar','https://twitter.com/MatarAlejandra','https://www.facebook.com/MatarAlejandra?ref=br_rs','(0351) 4203455','http://www.legiscba.gob.ar/xFotos/Maria_Alejandra_Matar.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=793','',1466,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(28,'Liliana Rosa','MONTERO','',1,'liliana.montero@legiscba.gob.ar','https://twitter.com/monteroliliana','https://www.facebook.com/LilianaMonteroCordoba','(0351) 4203409','http://www.legiscba.gob.ar/xFotos/Liliana_Rosa_Montero.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=907','',600,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(29,'Alicia Isabel','NARDUCCI','',5,'alicia.narducci@legiscba.gob.ar','https://twitter.com/LegislaturaCBA','https://www.facebook.com/pages/Legislatura-de-la-Provincia-de-Córdoba/233613593320288?fref=ts','(0351) 4203406','http://www.legiscba.gob.ar/xFotos/Alicia_Isabel_Narducci.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=786','',372,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(30,'Beatriz Maria de los Dolores','PEREYRA','',2,'beatriz.pereyra@legiscba.gob.ar','https://twitter.com/LegislaturaCBA','https://www.facebook.com/pages/Legislatura-de-la-Provincia-de-Córdoba/233613593320288?fref=ts','(0351) 4203459','http://www.legiscba.gob.ar/xFotos/Beatriz_Maria_de_los_Dolores_Pereyra.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=914','',282,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(31,'Jose Emilio','PIHEN','',5,'jose.pihen@legiscba.gob.ar','https://twitter.com/LegislaturaCBA','https://www.facebook.com/pages/Legislatura-de-la-Provincia-de-Córdoba/233613593320288?fref=ts','(0351) 4203412','http://www.legiscba.gob.ar/xFotos/Jose_Emilio_Pihen.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=887','',183,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(32,'Carlos Alberto','PRESAS','',5,'carlos.presas@legiscba.gob.ar','@LegislaturaCBA','https://www.facebook.com/carlosalberto.presas','(0351) 4203416','http://www.legiscba.gob.ar/xFotos/Carlos_Alberto_Presas.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=338','',418,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(33,'Pedro Javier','PRETTO','',8,'Pedro.Pretto@legiscba.gob.ar','https://twitter.com/javierpretto1','https://www.facebook.com/JavierPretto','(0351) 4203473','http://www.legiscba.gob.ar/xFotos/Pedro_Javier_Pretto.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=890','',244,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(34,'Dario Eduardo','RANCO','',5,'Dario.Ranco@legiscba.gob.ar','https://twitter.com/DarioRanco','https://www.facebook.com/actividadlegislativa.darioeduardoranco','(0351) 4203460','http://www.legiscba.gob.ar/xFotos/Dario_Eduardo_Ranco.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=891','',427,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(35,'Olga Maria','RISTA','',2,'Olga.Rista@legiscba.gob.ar','https://twitter.com/Olgamariarista','https://www.facebook.com/olga.rista','(0351) 4203467','http://www.legiscba.gob.ar/xFotos/Olga_Maria_Rista.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=915','',297,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(36,'Carlos Oscar','ROFFE','',1,'Carlos.Roffe@legiscba.gob.ar','https://twitter.com/carlosroffelp','https://www.facebook.com/carlos.roffe.7','(0351) 4203407','http://www.legiscba.gob.ar/xFotos/Carlos_Oscar_Roffe.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=908','http://www.carlosroffe.com/',591,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(37,'Graciela Santina','SANCHEZ','',1,'Graciela.Sanchez@legiscba.gob.ar','https://twitter.com/LegislaturaCBA','-','(0351) 4203428','http://www.legiscba.gob.ar/xFotos/Graciela_Santina_Sanchez.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=909','',591,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(38,'Luis Antonio','SANCHEZ','',5,'Luis.Sanchez@legiscba.gob.ar','@LegislaturaCBA','-','(0351) 4203443','http://www.legiscba.gob.ar/xFotos/Luis_Antonio_Sanchez.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=893','',204,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(39,'Ricardo Roberto','SOSA','',5,'Ricardo.Sosa@legiscba.gob.ar','@LegislaturaCBA','-','(0351) 4203447','http://www.legiscba.gob.ar/xFotos/Ricardo_Roberto_Sosa.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=896','',114,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(40,'Sandra Beatriz','TRIGO','',5,'Sandra.Trigo@legiscba.gob.ar','https://twitter.com/sandrabtrigo','https://www.facebook.com/santrigo','(0351) 4203448','http://www.legiscba.gob.ar/xFotos/Sandra_Beatriz_Trigo.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=898','',182,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(41,'Amalia Andrea','VAGNI','',2,'Amalia.Vagni@legiscba.gob.ar','https://twitter.com/amaliavagni','https://www.facebook.com/LegisladoraAmaliaVagni','(0351) 4203456','http://www.legiscba.gob.ar/xFotos/Amalia_Andrea_Vagni.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=916','',319,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(42,'Laura','VILCHES','',9,'Laura.Vilches@legiscba.gob.ar','https://twitter.com/vilcheslaura','https://www.facebook.com/lvilches3','(0351) 4203442','http://www.legiscba.gob.ar/xFotos/Laura_Vilches.jpg','NO PRESENTA','',18,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(43,'Fernando Miguel','WINGERTER','',5,'Fernando.Wingerter@legiscba.gob.ar','@LegislaturaCBA','-','(0351) 4203475','http://www.legiscba.gob.ar/xFotos/Fernando_Miguel_Wingerter.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=900','',303,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(44,'Eduardo','YUNI','',2,'Eduardo.Yuni@legiscba.gob.ar','https://twitter.com/EduardoYuni','https://www.facebook.com/Eduardo.Yuni','(0351) 4203501','http://www.legiscba.gob.ar/xFotos/Eduardo_Yuni.jpg','http://www.legiscba.gob.ar/contenidos/themes/Legislatura-th01/descarga_ddjj.php?codi=1&pers=917','',236,'0000-00-00 00:00:00','0000-00-00 00:00:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `partidos` */

insert  into `partidos`(`id`,`titulo`,`creacion`,`ultima_actividad`) values (1,'Frente Civico',NULL,NULL),(2,'Union Civica Radical',NULL,NULL),(3,'Partido Socialista',NULL,NULL),(4,'Frente Renovador',NULL,NULL),(5,'Unión por Córdoba',NULL,NULL),(6,'Encuentro Vecinal Córdoba',NULL,NULL),(7,'Frente Para la Victoria',NULL,NULL),(8,'Unión PRO',NULL,NULL),(9,'Frente de Izquierda y de los Trabajadores',NULL,NULL);

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
  `titulo` text CHARACTER SET utf8 NOT NULL,
  `descripcion` longtext CHARACTER SET utf8,
  `usuario_id` bigint(20) DEFAULT NULL,
  `creacion` datetime DEFAULT NULL,
  `imagen` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `activo` tinyint(1) DEFAULT '1',
  `ultima_actividad` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `propuestas` */

insert  into `propuestas`(`id`,`titulo`,`descripcion`,`usuario_id`,`creacion`,`imagen`,`activo`,`ultima_actividad`) values (1,'Software publico para municipios','Se requiere un equipo que impulse e integre desarrollo de software público (abierto y promovido por el estado) para que los municipios dejen de gastar tanto dinero en soluciones cerradas.\r\n\r\nLos municipios muchas veces no tiene equipos técnicos tomando decisiones de que tecnologia contrara y muchas veces terminan comprando por separado soluciones que no se integran.',2,NULL,'lib/img/propuestas/1.jpg',1,NULL),(2,'Reforma Ley Provincial Agroquimicos','Reforma de la Ley Provincial 9164, que introduzca la modificación de la autoridad de aplicación (pasar de Agricultura a Ambiente); prohibición de fumigaciones aéreas y distancias de 2000mts de viviendas, escuelas y cursos de agua para fumigación terrestre; realización de evaluación de impacto ambiental a las fumigaciones; incorporación de la participación ciudadana al consejo provincial de agroquímicos. ',3,NULL,'lib/img/propuestas/2.jpg',1,NULL),(3,'Vivienda y Producción Social del Hábitat','Establece la creación de un Sistema Integral de Políticas para la Vivienda y el Hábitat (SIPVH) que articule, coordine, complemente políticas, programas y los diferentes recursos públicos que se destinan para atender el desarrollo habitacional, en el ejercicio de las responsabilidades del Estado, a través de sus diferentes organismos, poderes y jurisdicciones.\r\nEl proyecto fue presentado en 2011 y nuevamente en 2013 luego de que perdiera estado parlamentario.2011: Cámara de Senadores: S2821/11 Cámara de Diputados: 5686 D 20112013: Cámara de Senadores: S2538/13 Cámara de Diputados: 5763 D 2013',4,NULL,'lib/img/propuestas/3.jpg',1,NULL),(4,'Regulación del procedimiento de Desalojos','Consideramos que es imprescindible que se realicen las reformas legales y se implementen políticas públicas para dar cumplimiento a las obligaciones consagradas en los tratados de derechos humanos, especialmente los establecidos en la Observación General n° 4 y n° 7 del Comité de Derechos Económicos Sociales y Culturales en relación al procedimiento de Desalojos. \r\nEl proyecto fue presentado en 2011 y nuevamente en 2013 luego de que perdiera estado parlamentario.2011: Cámara de Senadores: S2847/11 Cámara de Diputados: 5648 D 20112013: Cámara de Senadores: S1745/13 Cámara de Diputados: 2744/13',5,NULL,'lib/img/propuestas/4.jpg',1,NULL),(5,'Ley de Huertas Urbanas','Pedimos que se trabaje en la exigencia de crear huertas en espacios públicos urbanos.',5,NULL,'lib/img/propuestas/5.jpg',1,NULL),(6,'Programación hackaton escuelas educación','Mi idea es que en todas las escuelas primarias de la Ciudad de Córdoba se dé la materia programación en forma extracurricular desde el primer grado.',NULL,NULL,'lib/img/propuestas/6.jpg',1,NULL);

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

insert  into `usuarios`(`id`,`titulo`,`slug`,`descripcion`,`email`,`facebook`,`twitter`,`foto`,`password`,`es_persona_fisica`) values (1,'superadmin','superadmin',NULL,NULL,NULL,NULL,NULL,'LBjnkaEhB4zEw',0),(2,'Andres Vazquez','andrez_vazquez',NULL,'andres@data99.com.ar',NULL,NULL,NULL,'LBUv3JFq9VS5',1),(3,'Proyecto Ciudadania','proyecto_ciudadania',NULL,'proyectociudadania@gmail.com',NULL,NULL,NULL,'LBUv3JFq9VS5',0),(4,'Un Techo','techo',NULL,'pao-ferreyra@hotmail.com',NULL,NULL,NULL,'LBUv3JFq9VS5',0),(5,'Daniel Calvo','daniel_calvo',NULL,'dancalvos@hotmail.com',NULL,NULL,NULL,'LBUv3JFq9VS5',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
