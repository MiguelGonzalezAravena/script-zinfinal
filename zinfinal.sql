/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50024
Source Host           : localhost:3306
Source Database       : zinfinal

Target Server Type    : MYSQL
Target Server Version : 50024
File Encoding         : 65001

Date: 2010-07-26 18:58:12
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `categorias`
-- ----------------------------
DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `id_categoria` tinyint(3) NOT NULL,
  `nom_categoria` varchar(50) NOT NULL,
  `link_categoria` varchar(30) NOT NULL,
  `restringido` tinyint(8) NOT NULL,
  `rango` tinyint(8) NOT NULL,
  PRIMARY KEY  (`id_categoria`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of categorias
-- ----------------------------
INSERT INTO `categorias` VALUES ('7', 'Animaciones', 'animaciones', '0', '0');
INSERT INTO `categorias` VALUES ('18', 'Apuntes y Monograf&iacute;as', 'apuntes-y-monografias', '0', '0');
INSERT INTO `categorias` VALUES ('4', 'Arte', 'arte', '0', '0');
INSERT INTO `categorias` VALUES ('25', 'Autos y Motos', 'autos-motos', '0', '0');
INSERT INTO `categorias` VALUES ('17', 'Celulares', 'celulares', '0', '0');
INSERT INTO `categorias` VALUES ('33', 'Ciencia y Educaci&oacute;n', 'ciencia-educacion', '0', '0');
INSERT INTO `categorias` VALUES ('19', 'Comics e Historietas', 'comics', '0', '0');
INSERT INTO `categorias` VALUES ('16', 'Deportes', 'deportes', '0', '0');
INSERT INTO `categorias` VALUES ('9', 'Downloads', 'downloads', '0', '0');
INSERT INTO `categorias` VALUES ('23', 'E-books y Tutoriales', 'ebooks-tutoriales', '0', '0');
INSERT INTO `categorias` VALUES ('34', 'Ecolog&iacute;a', 'ecologia', '0', '0');
INSERT INTO `categorias` VALUES ('29', 'Econom&iacute;a y Negocios', 'economia-negocios', '0', '0');
INSERT INTO `categorias` VALUES ('24', 'Femme', 'femme', '0', '0');
INSERT INTO `categorias` VALUES ('35', 'Hazlo tu mismo', 'hazlo-tu-mismo', '0', '0');
INSERT INTO `categorias` VALUES ('26', 'Humor', 'humor', '0', '0');
INSERT INTO `categorias` VALUES ('1', 'Im&aacute;genes', 'imagenes', '0', '0');
INSERT INTO `categorias` VALUES ('12', 'Info', 'info', '0', '0');
INSERT INTO `categorias` VALUES ('37', 'Juegos', 'juegos', '0', '0');
INSERT INTO `categorias` VALUES ('2', 'Links', 'links', '0', '0');
INSERT INTO `categorias` VALUES ('15', 'Linux y GNU', 'linux', '0', '0');
INSERT INTO `categorias` VALUES ('22', 'Mac', 'mac', '0', '0');
INSERT INTO `categorias` VALUES ('32', 'Manga y Anime', 'manga-anime', '0', '0');
INSERT INTO `categorias` VALUES ('30', 'Mascotas', 'mascotas', '0', '0');
INSERT INTO `categorias` VALUES ('8', 'M&uacute;sica', 'musica', '0', '0');
INSERT INTO `categorias` VALUES ('10', 'Noticias', 'noticias', '0', '0');
INSERT INTO `categorias` VALUES ('5', 'Off-topic', 'offtopic', '0', '0');
INSERT INTO `categorias` VALUES ('21', 'Recetas y Cocina', 'recetas-y-cocina', '0', '0');
INSERT INTO `categorias` VALUES ('27', 'Salud y Bienestar', 'salud-bienestar', '0', '0');
INSERT INTO `categorias` VALUES ('20', 'Solidaridad', 'solidaridad', '0', '0');
INSERT INTO `categorias` VALUES ('28', 'ZinFinal', 'zinfinal', '0', '0');
INSERT INTO `categorias` VALUES ('31', 'Turismo', 'turismo', '0', '0');
INSERT INTO `categorias` VALUES ('13', 'TV, Peliculas y series', 'tv-peliculas-series', '0', '0');
INSERT INTO `categorias` VALUES ('3', 'Videos On-line', 'videos', '0', '0');
INSERT INTO `categorias` VALUES ('14', 'Patrocinados', 'patrocinados', '1', '50');

-- ----------------------------
-- Table structure for `comentarios`
-- ----------------------------
DROP TABLE IF EXISTS `comentarios`;
CREATE TABLE `comentarios` (
  `comid` int(7) NOT NULL auto_increment,
  `postid` int(20) NOT NULL default '0',
  `userid` int(20) NOT NULL default '0',
  `comentario` varchar(255) NOT NULL,
  `guardado` int(11) NOT NULL default '1260823886',
  PRIMARY KEY  (`comid`),
  KEY `id` (`comid`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of comentarios
-- ----------------------------
INSERT INTO `comentarios` VALUES ('1', '1', '2', 'muy bueno !!!!', '1273873370');
INSERT INTO `comentarios` VALUES ('2', '1', '3', 'igual', '1273873518');
INSERT INTO `comentarios` VALUES ('4', '2', '1', 'aaaaaaaaaaa\n', '1274638135');
INSERT INTO `comentarios` VALUES ('5', '1', '1', 'jajajaa', '1274986304');
INSERT INTO `comentarios` VALUES ('6', '1', '2', '[quote]aaaaa[/quote]', '1277530421');
INSERT INTO `comentarios` VALUES ('7', '1', '2', '[quote=harold][quote]aaaaa[/quote][/quote]\n', '1277532388');
INSERT INTO `comentarios` VALUES ('8', '1', '2', '[quote=harold][quote=harold][quote]aaaaa[/quote][/quote]\n[/quote]\n', '1277533222');
INSERT INTO `comentarios` VALUES ('9', '1', '2', ':)', '1277534962');

-- ----------------------------
-- Table structure for `configuracion`
-- ----------------------------
DROP TABLE IF EXISTS `configuracion`;
CREATE TABLE `configuracion` (
  `variable` tinytext NOT NULL,
  `valor` mediumtext NOT NULL,
  PRIMARY KEY  (`variable`(30))
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of configuracion
-- ----------------------------
INSERT INTO `configuracion` VALUES ('zinfinal_ver', '2.0');
INSERT INTO `configuracion` VALUES ('ca-pub', 'ca-pub-5717128494977839');
INSERT INTO `configuracion` VALUES ('mantenimiento', '0');
INSERT INTO `configuracion` VALUES ('mantenimiento_m', 'Estamos realizando algunas mejoras en el sistema, volveremos en unos minutos..');
INSERT INTO `configuracion` VALUES ('meta_keywords', 'zinfinal,linksharing,enlaces,juegos,musica,links,noticias,imagenes,videos,animaciones,arte,deportes,linux,apuntes,monografias,autos,motos,celulares,comics,tutoriales,ebooks,humor,mac,recetas,peliculas,series,argentina,comunidad');
INSERT INTO `configuracion` VALUES ('limite_posts', '50');
INSERT INTO `configuracion` VALUES ('limite_comentarios', '20');
INSERT INTO `configuracion` VALUES ('ideas-mostrar', '1');
INSERT INTO `configuracion` VALUES ('ideas-url', 'http://taringa.uservoice.com/');
INSERT INTO `configuracion` VALUES ('novatos-coment', '1');
INSERT INTO `configuracion` VALUES ('registro-activacion', '1');

-- ----------------------------
-- Table structure for `c_categorias`
-- ----------------------------
DROP TABLE IF EXISTS `c_categorias`;
CREATE TABLE `c_categorias` (
  `id_categoria` tinyint(3) NOT NULL auto_increment,
  `nom_categoria` varchar(60) default NULL,
  `link_categoria` varchar(60) default NULL,
  PRIMARY KEY  (`id_categoria`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of c_categorias
-- ----------------------------
INSERT INTO `c_categorias` VALUES ('9', 'Arte y Literatura', 'arte-literatura');
INSERT INTO `c_categorias` VALUES ('1', 'Deportes', 'deportes');
INSERT INTO `c_categorias` VALUES ('11', 'Diversi&oacute;n y Esparcimiento', 'diversion-esparcimiento');
INSERT INTO `c_categorias` VALUES ('2', 'Econom&iacute;a y Negocios', 'economia-negocios');
INSERT INTO `c_categorias` VALUES ('3', 'Entretenimiento y Medios', 'entretenimiento-medios');
INSERT INTO `c_categorias` VALUES ('7', 'Grupos y Organizaciones', 'grupos-organizaciones');
INSERT INTO `c_categorias` VALUES ('8', 'Inter&eacute;s general', 'interes-general');
INSERT INTO `c_categorias` VALUES ('5', 'Internet y Tecnolog&iacute;a', 'internet-tecnologia');
INSERT INTO `c_categorias` VALUES ('6', 'M&uacute;sica y Bandas', 'musica-bandas');
INSERT INTO `c_categorias` VALUES ('4', 'Regiones', 'regiones');

-- ----------------------------
-- Table structure for `c_comunidades`
-- ----------------------------
DROP TABLE IF EXISTS `c_comunidades`;
CREATE TABLE `c_comunidades` (
  `comid` int(11) unsigned NOT NULL auto_increment,
  `estado` tinyint(2) NOT NULL,
  `oficial` tinyint(2) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `shortname` varchar(50) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `pais` varchar(10) NOT NULL,
  `categoria` int(11) NOT NULL,
  `subcategoria` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `tags` varchar(100) NOT NULL,
  `privada` int(11) NOT NULL,
  `tipo_val` tinyint(2) NOT NULL,
  `rango_default` tinyint(2) NOT NULL,
  `fecha` int(11) NOT NULL,
  `creadorid` int(11) NOT NULL,
  `numte` int(11) NOT NULL,
  `numm` int(11) NOT NULL,
  `comentarios` int(11) NOT NULL,
  `follow` int(11) NOT NULL,
  PRIMARY KEY  (`comid`),
  UNIQUE KEY `id` (`comid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of c_comunidades
-- ----------------------------
INSERT INTO `c_comunidades` VALUES ('1', '0', '0', 'wtfffff', 'wtfffff', 'http://sdfdsfdsf', '21', '5', '4', 'hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh', 'forlan,goleador,mejor,jugador,oro,bota', '1', '1', '3', '1278730016', '1', '0', '1', '0', '0');

-- ----------------------------
-- Table structure for `c_miembros`
-- ----------------------------
DROP TABLE IF EXISTS `c_miembros`;
CREATE TABLE `c_miembros` (
  `mieid` int(11) NOT NULL auto_increment,
  `userid` int(11) NOT NULL,
  `comid` int(11) NOT NULL,
  `rangoco` int(11) NOT NULL,
  `fechaco` int(11) NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY  (`mieid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of c_miembros
-- ----------------------------
INSERT INTO `c_miembros` VALUES ('1', '1', '1', '5', '1278730017', '0');

-- ----------------------------
-- Table structure for `c_paises`
-- ----------------------------
DROP TABLE IF EXISTS `c_paises`;
CREATE TABLE `c_paises` (
  `paisid` tinyint(8) NOT NULL,
  `nombrepais` varchar(150) NOT NULL,
  `grupo` tinyint(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of c_paises
-- ----------------------------
INSERT INTO `c_paises` VALUES ('0', 'Argentina', '1');
INSERT INTO `c_paises` VALUES ('1', 'Bolivia', '1');
INSERT INTO `c_paises` VALUES ('2', 'Brasil', '1');
INSERT INTO `c_paises` VALUES ('3', 'Chile', '1');
INSERT INTO `c_paises` VALUES ('4', 'Colombia', '1');
INSERT INTO `c_paises` VALUES ('5', 'Costa Rica', '1');
INSERT INTO `c_paises` VALUES ('6', 'Cuba', '1');
INSERT INTO `c_paises` VALUES ('7', 'Rep&uacute;blica Checa', '1');
INSERT INTO `c_paises` VALUES ('8', 'Ecuador', '1');
INSERT INTO `c_paises` VALUES ('9', 'El Salvador', '1');
INSERT INTO `c_paises` VALUES ('10', 'Espa&ntilde;a', '1');
INSERT INTO `c_paises` VALUES ('11', 'Guatemala', '1');
INSERT INTO `c_paises` VALUES ('12', 'Guinea Ecuatorial', '1');
INSERT INTO `c_paises` VALUES ('13', 'Honduras', '1');
INSERT INTO `c_paises` VALUES ('14', 'Israel', '1');
INSERT INTO `c_paises` VALUES ('15', 'Italia', '1');
INSERT INTO `c_paises` VALUES ('16', 'Jap&oacute;n', '1');
INSERT INTO `c_paises` VALUES ('17', 'M&eacute;xico', '1');
INSERT INTO `c_paises` VALUES ('18', 'Nicaragua', '1');
INSERT INTO `c_paises` VALUES ('19', 'Panam&aacute;', '1');
INSERT INTO `c_paises` VALUES ('20', 'Paraguay', '1');
INSERT INTO `c_paises` VALUES ('21', 'Per&uacute;', '1');
INSERT INTO `c_paises` VALUES ('22', 'Portugal', '1');
INSERT INTO `c_paises` VALUES ('23', 'Puerto Rico', '1');
INSERT INTO `c_paises` VALUES ('24', 'Rep&uacute;blica Dominicana', '1');
INSERT INTO `c_paises` VALUES ('25', 'Estados Unidos', '1');
INSERT INTO `c_paises` VALUES ('26', 'Uruguay', '1');
INSERT INTO `c_paises` VALUES ('27', 'Venezuela', '1');
INSERT INTO `c_paises` VALUES ('28', '----', '0');
INSERT INTO `c_paises` VALUES ('29', 'Afganist&aacute;n', '0');
INSERT INTO `c_paises` VALUES ('30', 'Albania', '0');
INSERT INTO `c_paises` VALUES ('31', 'Argelia', '0');
INSERT INTO `c_paises` VALUES ('32', 'Samoa Americana', '0');
INSERT INTO `c_paises` VALUES ('33', 'Andorra', '0');
INSERT INTO `c_paises` VALUES ('34', 'Angola', '0');
INSERT INTO `c_paises` VALUES ('35', 'Anguila', '0');
INSERT INTO `c_paises` VALUES ('36', 'Ant&aacute;rtida', '0');
INSERT INTO `c_paises` VALUES ('37', 'Antigua y Barbuda', '0');
INSERT INTO `c_paises` VALUES ('38', 'Armenia', '0');
INSERT INTO `c_paises` VALUES ('39', 'Aruba', '0');
INSERT INTO `c_paises` VALUES ('41', 'Australia', '0');
INSERT INTO `c_paises` VALUES ('42', 'Austria', '0');
INSERT INTO `c_paises` VALUES ('43', 'Azerbaiy&aacute;n', '0');
INSERT INTO `c_paises` VALUES ('44', 'Bahamas', '0');
INSERT INTO `c_paises` VALUES ('45', 'Bahr&eacute;in', '0');
INSERT INTO `c_paises` VALUES ('47', 'Bangladesh', '0');
INSERT INTO `c_paises` VALUES ('48', 'Barbados', '0');
INSERT INTO `c_paises` VALUES ('50', 'Bielorrusia', '0');
INSERT INTO `c_paises` VALUES ('51', 'B&eacute;lgica', '0');
INSERT INTO `c_paises` VALUES ('52', 'Belice', '0');
INSERT INTO `c_paises` VALUES ('53', 'Benin', '0');
INSERT INTO `c_paises` VALUES ('54', 'Bermudas', '0');
INSERT INTO `c_paises` VALUES ('55', 'But&aacute;n', '0');
INSERT INTO `c_paises` VALUES ('56', 'Bosnia y Herzegovina', '0');
INSERT INTO `c_paises` VALUES ('57', 'Botswana', '0');
INSERT INTO `c_paises` VALUES ('58', 'Isla Bouvet', '0');
INSERT INTO `c_paises` VALUES ('59', 'Territorio Brit&aacute;nico del Oc&eacute;ano &iacute;ndico', '0');
INSERT INTO `c_paises` VALUES ('60', 'Islas V&iacute;rgenes Brit&aacute;nicas', '0');
INSERT INTO `c_paises` VALUES ('61', 'Brun&eacute;i', '0');
INSERT INTO `c_paises` VALUES ('62', 'Bulgaria', '0');
INSERT INTO `c_paises` VALUES ('63', 'Burkina Faso', '0');
INSERT INTO `c_paises` VALUES ('64', 'Myanmar', '0');
INSERT INTO `c_paises` VALUES ('65', 'Burundi', '0');
INSERT INTO `c_paises` VALUES ('66', 'Camboya', '0');
INSERT INTO `c_paises` VALUES ('67', 'Camer&uacute;n', '0');
INSERT INTO `c_paises` VALUES ('68', 'Canad&aacute;', '0');
INSERT INTO `c_paises` VALUES ('69', 'Cabo Verde', '0');
INSERT INTO `c_paises` VALUES ('70', 'Islas Caim&aacute;n', '0');
INSERT INTO `c_paises` VALUES ('71', 'Rep&uacute;blica Centroafricana', '0');
INSERT INTO `c_paises` VALUES ('72', 'Chad', '0');
INSERT INTO `c_paises` VALUES ('73', 'China', '0');
INSERT INTO `c_paises` VALUES ('74', 'Isla de Navidad', '0');
INSERT INTO `c_paises` VALUES ('76', 'Islas Cocos', '0');
INSERT INTO `c_paises` VALUES ('77', 'Comoras', '0');
INSERT INTO `c_paises` VALUES ('78', 'Rep&uacute;blica Democr&aacute;tica del Congo', '0');
INSERT INTO `c_paises` VALUES ('79', 'Rep&uacute;blica del Congo', '0');
INSERT INTO `c_paises` VALUES ('80', 'Islas Cook', '0');
INSERT INTO `c_paises` VALUES ('81', 'Coral Sea Islands', '0');
INSERT INTO `c_paises` VALUES ('82', 'Costa de Marfil', '0');
INSERT INTO `c_paises` VALUES ('83', 'Croacia', '0');
INSERT INTO `c_paises` VALUES ('84', 'Chipre', '0');
INSERT INTO `c_paises` VALUES ('85', 'Dinamarca', '0');
INSERT INTO `c_paises` VALUES ('86', 'Yibuti', '0');
INSERT INTO `c_paises` VALUES ('87', 'Dominica', '0');
INSERT INTO `c_paises` VALUES ('88', 'Timor Oriental', '0');
INSERT INTO `c_paises` VALUES ('89', 'Egipto', '0');
INSERT INTO `c_paises` VALUES ('90', 'Eritrea', '0');
INSERT INTO `c_paises` VALUES ('91', 'Estonia', '0');
INSERT INTO `c_paises` VALUES ('92', 'Etiop&iacute;a', '0');
INSERT INTO `c_paises` VALUES ('93', 'Isla Europa', '0');
INSERT INTO `c_paises` VALUES ('94', 'Islas Malvinas', '0');
INSERT INTO `c_paises` VALUES ('95', 'Islas Feroe', '0');
INSERT INTO `c_paises` VALUES ('96', 'Fiyi', '0');
INSERT INTO `c_paises` VALUES ('97', 'Finlandia', '0');
INSERT INTO `c_paises` VALUES ('98', 'Francia', '0');
INSERT INTO `c_paises` VALUES ('99', 'Guayana Francesa', '0');
INSERT INTO `c_paises` VALUES ('100', 'Polinesia Francesa', '0');
INSERT INTO `c_paises` VALUES ('101', 'Territorios Australes Franceses', '0');
INSERT INTO `c_paises` VALUES ('102', 'Gab&oacute;n', '0');
INSERT INTO `c_paises` VALUES ('103', 'Gambia', '0');
INSERT INTO `c_paises` VALUES ('104', 'Georgia', '0');
INSERT INTO `c_paises` VALUES ('105', 'Alemania', '0');
INSERT INTO `c_paises` VALUES ('106', 'Ghana', '0');
INSERT INTO `c_paises` VALUES ('107', 'Gibraltar', '0');
INSERT INTO `c_paises` VALUES ('108', 'Islas Gloriosas', '0');
INSERT INTO `c_paises` VALUES ('109', 'Grecia', '0');
INSERT INTO `c_paises` VALUES ('110', 'Groenlandia', '0');
INSERT INTO `c_paises` VALUES ('111', 'Granada', '0');
INSERT INTO `c_paises` VALUES ('112', 'Guadalupe', '0');
INSERT INTO `c_paises` VALUES ('113', 'Guam', '0');
INSERT INTO `c_paises` VALUES ('114', 'Guernsey', '0');
INSERT INTO `c_paises` VALUES ('115', 'Guinea', '0');
INSERT INTO `c_paises` VALUES ('116', 'Guinea-Bissau', '0');
INSERT INTO `c_paises` VALUES ('117', 'Guyana', '0');
INSERT INTO `c_paises` VALUES ('118', 'Hait&iacute;', '0');
INSERT INTO `c_paises` VALUES ('119', 'Islas Heard y McDonald', '0');
INSERT INTO `c_paises` VALUES ('120', 'Ciudad del Vaticano', '0');
INSERT INTO `c_paises` VALUES ('121', 'Hong Kong', '0');
INSERT INTO `c_paises` VALUES ('122', 'Howland Island', '0');
INSERT INTO `c_paises` VALUES ('123', 'Hungr&iacute;a', '0');
INSERT INTO `c_paises` VALUES ('124', 'Islandia', '0');
INSERT INTO `c_paises` VALUES ('125', 'India', '0');
INSERT INTO `c_paises` VALUES ('126', 'Indonesia', '0');
INSERT INTO `c_paises` VALUES ('127', 'Ir&aacute;n', '0');
INSERT INTO `c_paises` VALUES ('127', 'Iraq', '0');
INSERT INTO `c_paises` VALUES ('127', 'Irlanda', '0');
INSERT INTO `c_paises` VALUES ('127', 'Jamaica', '0');
INSERT INTO `c_paises` VALUES ('127', 'Svalbard y Jan Mayen', '0');
INSERT INTO `c_paises` VALUES ('127', 'Isla Jarvis', '0');
INSERT INTO `c_paises` VALUES ('127', 'Jersey', '0');
INSERT INTO `c_paises` VALUES ('127', 'Atol&oacute;n Johnston', '0');
INSERT INTO `c_paises` VALUES ('127', 'Jordania', '0');
INSERT INTO `c_paises` VALUES ('127', 'Isla Juan de Nova', '0');
INSERT INTO `c_paises` VALUES ('127', 'Kazajist&aacute;n', '0');
INSERT INTO `c_paises` VALUES ('127', 'Kenia', '0');
INSERT INTO `c_paises` VALUES ('127', 'Arrecife Kingman', '0');
INSERT INTO `c_paises` VALUES ('127', 'Kiribati', '0');
INSERT INTO `c_paises` VALUES ('127', 'Corea del Norte', '0');
INSERT INTO `c_paises` VALUES ('127', 'Corea del Sur', '0');
INSERT INTO `c_paises` VALUES ('127', 'Kuwait', '0');
INSERT INTO `c_paises` VALUES ('127', 'Kirguist&aacute;n', '0');
INSERT INTO `c_paises` VALUES ('127', 'Laos', '0');
INSERT INTO `c_paises` VALUES ('127', 'Letonia', '0');
INSERT INTO `c_paises` VALUES ('127', 'L&iacute;bano', '0');
INSERT INTO `c_paises` VALUES ('127', 'Lesoto', '0');
INSERT INTO `c_paises` VALUES ('127', 'Liberia', '0');
INSERT INTO `c_paises` VALUES ('127', 'Libia', '0');
INSERT INTO `c_paises` VALUES ('127', 'Liechtenstein', '0');
INSERT INTO `c_paises` VALUES ('127', 'Lituania', '0');
INSERT INTO `c_paises` VALUES ('127', 'Luxemburgo', '0');
INSERT INTO `c_paises` VALUES ('127', 'Macao', '0');
INSERT INTO `c_paises` VALUES ('127', 'Rep&uacute;blica de Macedonia', '0');
INSERT INTO `c_paises` VALUES ('127', 'Madagascar', '0');
INSERT INTO `c_paises` VALUES ('127', 'Malaui', '0');
INSERT INTO `c_paises` VALUES ('127', 'Malasia', '0');
INSERT INTO `c_paises` VALUES ('127', 'Maldivas', '0');
INSERT INTO `c_paises` VALUES ('127', 'Mal&iacute;', '0');
INSERT INTO `c_paises` VALUES ('127', 'Malta', '0');
INSERT INTO `c_paises` VALUES ('127', 'Isla de Man', '0');
INSERT INTO `c_paises` VALUES ('127', 'Islas Marshall', '0');
INSERT INTO `c_paises` VALUES ('127', 'Martinica', '0');
INSERT INTO `c_paises` VALUES ('127', 'Mauritania', '0');
INSERT INTO `c_paises` VALUES ('127', 'Mauricio', '0');
INSERT INTO `c_paises` VALUES ('127', 'Mayotte', '0');
INSERT INTO `c_paises` VALUES ('127', 'Micronesia', '0');
INSERT INTO `c_paises` VALUES ('127', 'Islas Midway', '0');
INSERT INTO `c_paises` VALUES ('127', 'Moldavia', '0');
INSERT INTO `c_paises` VALUES ('127', 'M&oacute;naco', '0');
INSERT INTO `c_paises` VALUES ('127', 'Mongolia', '0');
INSERT INTO `c_paises` VALUES ('127', 'Montenegro', '0');
INSERT INTO `c_paises` VALUES ('127', 'Montserrat', '0');
INSERT INTO `c_paises` VALUES ('127', 'Marruecos', '0');
INSERT INTO `c_paises` VALUES ('127', 'Mozambique', '0');
INSERT INTO `c_paises` VALUES ('127', 'Namibia', '0');
INSERT INTO `c_paises` VALUES ('127', 'Nauru', '0');
INSERT INTO `c_paises` VALUES ('127', 'Navassa Island', '0');
INSERT INTO `c_paises` VALUES ('127', 'Nepal', '0');
INSERT INTO `c_paises` VALUES ('127', 'Pa&iacute;ses Bajos', '0');
INSERT INTO `c_paises` VALUES ('127', 'Antillas Neerlandesas', '0');
INSERT INTO `c_paises` VALUES ('127', 'Neutral Zone', '0');
INSERT INTO `c_paises` VALUES ('127', 'Nueva Caledonia', '0');
INSERT INTO `c_paises` VALUES ('127', 'Nueva Zelanda', '0');
INSERT INTO `c_paises` VALUES ('127', 'Niger', '0');
INSERT INTO `c_paises` VALUES ('127', 'Nigeria', '0');
INSERT INTO `c_paises` VALUES ('127', 'Niue', '0');
INSERT INTO `c_paises` VALUES ('127', 'Norfolk', '0');
INSERT INTO `c_paises` VALUES ('127', 'Islas Marianas del Norte', '0');
INSERT INTO `c_paises` VALUES ('127', 'Noruega', '0');
INSERT INTO `c_paises` VALUES ('127', 'Om&aacute;n', '0');
INSERT INTO `c_paises` VALUES ('127', 'Pakist&aacute;n', '0');
INSERT INTO `c_paises` VALUES ('127', 'Palau', '0');
INSERT INTO `c_paises` VALUES ('127', 'Atol&oacute;n Palmyra', '0');
INSERT INTO `c_paises` VALUES ('127', 'Pap&uacute;a Nueva Guinea', '0');
INSERT INTO `c_paises` VALUES ('127', 'Islas Paracel', '0');
INSERT INTO `c_paises` VALUES ('127', 'Filipinas', '0');
INSERT INTO `c_paises` VALUES ('127', 'Islas Pitcairn', '0');
INSERT INTO `c_paises` VALUES ('127', 'Polonia', '0');
INSERT INTO `c_paises` VALUES ('127', 'Qatar', '0');
INSERT INTO `c_paises` VALUES ('127', 'Reuni&oacute;n', '0');
INSERT INTO `c_paises` VALUES ('127', 'Rumania', '0');
INSERT INTO `c_paises` VALUES ('127', 'Rusia', '0');
INSERT INTO `c_paises` VALUES ('127', 'Ruanda', '0');
INSERT INTO `c_paises` VALUES ('127', 'Santa Helena', '0');
INSERT INTO `c_paises` VALUES ('127', 'San Crist&oacute;bal y Nieves', '0');
INSERT INTO `c_paises` VALUES ('127', 'Santa Luc&iacute;a', '0');
INSERT INTO `c_paises` VALUES ('127', 'San Pedro y Miquel&oacute;n', '0');
INSERT INTO `c_paises` VALUES ('127', 'San Vicente y las Granadinas', '0');
INSERT INTO `c_paises` VALUES ('127', 'Samoa', '0');
INSERT INTO `c_paises` VALUES ('127', 'San Marino', '0');
INSERT INTO `c_paises` VALUES ('127', 'Sao Tom&eacute; y Principe', '0');
INSERT INTO `c_paises` VALUES ('127', 'Arabia Saudita', '0');
INSERT INTO `c_paises` VALUES ('127', 'Senegal', '0');
INSERT INTO `c_paises` VALUES ('127', 'Serbia', '0');
INSERT INTO `c_paises` VALUES ('127', 'Seychelles', '0');
INSERT INTO `c_paises` VALUES ('127', 'Sierra Leona', '0');
INSERT INTO `c_paises` VALUES ('127', 'Singapur', '0');
INSERT INTO `c_paises` VALUES ('127', 'Eslovaquia', '0');
INSERT INTO `c_paises` VALUES ('127', 'Eslovenia', '0');
INSERT INTO `c_paises` VALUES ('127', 'Islas Salom&oacute;n', '0');
INSERT INTO `c_paises` VALUES ('127', 'Somalia', '0');
INSERT INTO `c_paises` VALUES ('127', 'Sud&aacute;frica', '0');
INSERT INTO `c_paises` VALUES ('127', 'Islas Georgias del Sur y Sandwich del Sur', '0');
INSERT INTO `c_paises` VALUES ('127', 'Islas Spratly', '0');
INSERT INTO `c_paises` VALUES ('127', 'Sri Lanka', '0');
INSERT INTO `c_paises` VALUES ('127', 'Sud&aacute;n', '0');
INSERT INTO `c_paises` VALUES ('127', 'Surinam', '0');
INSERT INTO `c_paises` VALUES ('127', 'Svalbard y Jan Mayen', '0');
INSERT INTO `c_paises` VALUES ('127', 'Suazilandia', '0');
INSERT INTO `c_paises` VALUES ('127', 'Suecia', '0');
INSERT INTO `c_paises` VALUES ('127', 'Suiza', '0');
INSERT INTO `c_paises` VALUES ('127', 'Siria', '0');
INSERT INTO `c_paises` VALUES ('127', 'Taiw&aacute;n', '0');
INSERT INTO `c_paises` VALUES ('127', 'Tayikist&aacute;n', '0');
INSERT INTO `c_paises` VALUES ('127', 'Tanzania', '0');
INSERT INTO `c_paises` VALUES ('127', 'Tailandia', '0');
INSERT INTO `c_paises` VALUES ('127', 'Togo', '0');
INSERT INTO `c_paises` VALUES ('127', 'Tokelau', '0');
INSERT INTO `c_paises` VALUES ('127', 'Tonga', '0');
INSERT INTO `c_paises` VALUES ('127', 'Trinidad y Tobago', '0');
INSERT INTO `c_paises` VALUES ('127', 'Isla Tromelin', '0');
INSERT INTO `c_paises` VALUES ('127', 'T&uacute;nez', '0');
INSERT INTO `c_paises` VALUES ('127', 'Turqu&iacute;a', '0');
INSERT INTO `c_paises` VALUES ('127', 'Turkmenist&aacute;n', '0');
INSERT INTO `c_paises` VALUES ('127', 'Islas Turcas y Caicos', '0');
INSERT INTO `c_paises` VALUES ('127', 'Tuvalu', '0');
INSERT INTO `c_paises` VALUES ('127', 'Uganda', '0');
INSERT INTO `c_paises` VALUES ('127', 'Ucrania', '0');
INSERT INTO `c_paises` VALUES ('127', 'Emiratos &aacute;rabes Unidos', '0');
INSERT INTO `c_paises` VALUES ('127', 'Reino Unido', '0');
INSERT INTO `c_paises` VALUES ('127', 'Uzbekist&aacute;n', '0');
INSERT INTO `c_paises` VALUES ('127', 'Vanuatu', '0');
INSERT INTO `c_paises` VALUES ('127', 'Vietnam', '0');
INSERT INTO `c_paises` VALUES ('127', 'Islas V&iacute;rgenes Estadounidenses', '0');
INSERT INTO `c_paises` VALUES ('127', 'Wake Island', '0');
INSERT INTO `c_paises` VALUES ('127', 'Wallis y Futuna', '0');
INSERT INTO `c_paises` VALUES ('127', 'S&aacute;hara Occidental', '0');
INSERT INTO `c_paises` VALUES ('127', 'Yemen', '0');
INSERT INTO `c_paises` VALUES ('127', 'Zambia', '0');
INSERT INTO `c_paises` VALUES ('127', 'Zimbabue', '0');
INSERT INTO `c_paises` VALUES ('127', 'Islas ultramarinas de Estados Unidos', '0');
INSERT INTO `c_paises` VALUES ('127', 'Palaos', '0');
INSERT INTO `c_paises` VALUES ('127', 'República Árabe Saharaui Democrática', '0');
INSERT INTO `c_paises` VALUES ('127', 'Saint-Martin', '0');
INSERT INTO `c_paises` VALUES ('127', 'San Bartolomé', '0');
INSERT INTO `c_paises` VALUES ('127', 'Serbia y Montenegro', '0');
INSERT INTO `c_paises` VALUES ('127', 'Territorios palestinos', '0');

-- ----------------------------
-- Table structure for `c_respuestas`
-- ----------------------------
DROP TABLE IF EXISTS `c_respuestas`;
CREATE TABLE `c_respuestas` (
  `respid` int(11) unsigned NOT NULL auto_increment,
  `temaid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `respuesta` varchar(255) NOT NULL,
  `fechare` int(11) NOT NULL,
  PRIMARY KEY  (`respid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of c_respuestas
-- ----------------------------

-- ----------------------------
-- Table structure for `c_subscategorias`
-- ----------------------------
DROP TABLE IF EXISTS `c_subscategorias`;
CREATE TABLE `c_subscategorias` (
  `id_categoria` int(11) NOT NULL,
  `id_subcategoria` int(11) NOT NULL,
  `nombre_subcategoria` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of c_subscategorias
-- ----------------------------
INSERT INTO `c_subscategorias` VALUES ('9', '1', 'Artes pl&aacute;sticas');
INSERT INTO `c_subscategorias` VALUES ('9', '2', 'Artes visuales');
INSERT INTO `c_subscategorias` VALUES ('9', '3', 'Escritores');
INSERT INTO `c_subscategorias` VALUES ('9', '4', 'Fotograf&iacute;a');
INSERT INTO `c_subscategorias` VALUES ('9', '5', 'General y Otros');
INSERT INTO `c_subscategorias` VALUES ('9', '6', 'Pensamientos');
INSERT INTO `c_subscategorias` VALUES ('9', '7', 'Poes&iacute;a y Narraci&oacute;n');
INSERT INTO `c_subscategorias` VALUES ('1', '1', 'Ajedrez');
INSERT INTO `c_subscategorias` VALUES ('1', '2', 'Artes marciales');
INSERT INTO `c_subscategorias` VALUES ('1', '3', 'Atletismo y Aerobics');
INSERT INTO `c_subscategorias` VALUES ('1', '4', 'Automovilismo y Carreras');
INSERT INTO `c_subscategorias` VALUES ('1', '5', 'Basquet');
INSERT INTO `c_subscategorias` VALUES ('1', '6', 'Boxeo');
INSERT INTO `c_subscategorias` VALUES ('1', '6', 'Ciclismo');
INSERT INTO `c_subscategorias` VALUES ('1', '7', 'Deportes acu&aacute;ticos');
INSERT INTO `c_subscategorias` VALUES ('1', '8', 'Deportes al aire libre');
INSERT INTO `c_subscategorias` VALUES ('1', '9', 'Deportes de invierno');
INSERT INTO `c_subscategorias` VALUES ('1', '10', 'Deportes extremos');
INSERT INTO `c_subscategorias` VALUES ('1', '11', 'Deportes Ol&iacute;mpicos');
INSERT INTO `c_subscategorias` VALUES ('1', '12', 'Futb&oacute;l');
INSERT INTO `c_subscategorias` VALUES ('1', '13', 'General');
INSERT INTO `c_subscategorias` VALUES ('1', '14', 'General y Otros');
INSERT INTO `c_subscategorias` VALUES ('1', '15', 'Golf');
INSERT INTO `c_subscategorias` VALUES ('1', '16', 'Hockey');
INSERT INTO `c_subscategorias` VALUES ('1', '17', 'Instituciones y clubes');
INSERT INTO `c_subscategorias` VALUES ('1', '18', 'Montado y Trekking');
INSERT INTO `c_subscategorias` VALUES ('1', '19', 'Motociclismo');
INSERT INTO `c_subscategorias` VALUES ('1', '20', 'Patinaje');
INSERT INTO `c_subscategorias` VALUES ('1', '21', 'Rugby');
INSERT INTO `c_subscategorias` VALUES ('1', '22', 'S&oacute;fbol y B&eacute;isbol');
INSERT INTO `c_subscategorias` VALUES ('1', '23', 'Tenis');
INSERT INTO `c_subscategorias` VALUES ('1', '24', 'Voleibol');
INSERT INTO `c_subscategorias` VALUES ('1', '25', 'Yoga');
INSERT INTO `c_subscategorias` VALUES ('10', '1', 'Baile');
INSERT INTO `c_subscategorias` VALUES ('10', '2', 'Bares y Caf&eacute;s');
INSERT INTO `c_subscategorias` VALUES ('10', '3', 'General y Otros');
INSERT INTO `c_subscategorias` VALUES ('10', '4', 'Humor');
INSERT INTO `c_subscategorias` VALUES ('10', '5', 'Parques');
INSERT INTO `c_subscategorias` VALUES ('10', '6', 'Paseos');
INSERT INTO `c_subscategorias` VALUES ('10', '7', 'Salidas');
INSERT INTO `c_subscategorias` VALUES ('10', '8', 'Vida Nocturna');
INSERT INTO `c_subscategorias` VALUES ('2', '1', 'Contabilidad e Impuestos');
INSERT INTO `c_subscategorias` VALUES ('2', '2', 'Defensa al consumidor');
INSERT INTO `c_subscategorias` VALUES ('2', '3', 'Empleo y Trabjo');
INSERT INTO `c_subscategorias` VALUES ('2', '4', 'Emprendimientos');
INSERT INTO `c_subscategorias` VALUES ('2', '5', 'Empresas y Negocios');
INSERT INTO `c_subscategorias` VALUES ('2', '6', 'General y otros');
INSERT INTO `c_subscategorias` VALUES ('2', '7', 'Inversiones y Finanzas');
INSERT INTO `c_subscategorias` VALUES ('2', '8', 'Investigaciones ec&oacute;nomicas');
INSERT INTO `c_subscategorias` VALUES ('2', '9', 'Management y Administraci&oacute;n');
INSERT INTO `c_subscategorias` VALUES ('2', '10', 'Marketing y Publicidad');
INSERT INTO `c_subscategorias` VALUES ('3', '1', 'Celebredidades y famosos');
INSERT INTO `c_subscategorias` VALUES ('3', '2', 'Cine y Pel&iacute;culas');
INSERT INTO `c_subscategorias` VALUES ('3', '3', 'Diarios y revistas');
INSERT INTO `c_subscategorias` VALUES ('3', '4', 'Esprect&aacute;culos');
INSERT INTO `c_subscategorias` VALUES ('3', '5', 'General y Otros');
INSERT INTO `c_subscategorias` VALUES ('3', '6', 'Series de TV');
INSERT INTO `c_subscategorias` VALUES ('3', '7', 'Teatro');
INSERT INTO `c_subscategorias` VALUES ('3', '8', 'Televisi&oacute;n');
INSERT INTO `c_subscategorias` VALUES ('7', '1', 'Clubes y Sociedades');
INSERT INTO `c_subscategorias` VALUES ('7', '2', 'Dormitorios y Residencias');
INSERT INTO `c_subscategorias` VALUES ('7', '3', 'Estudiantes de Universidades');
INSERT INTO `c_subscategorias` VALUES ('7', '4', 'Estudianets Secundarios');
INSERT INTO `c_subscategorias` VALUES ('7', '5', 'Ex-alumnos');
INSERT INTO `c_subscategorias` VALUES ('7', '6', 'General y Otros');
INSERT INTO `c_subscategorias` VALUES ('7', '7', 'Grupos de estudio');
INSERT INTO `c_subscategorias` VALUES ('7', '8', 'Organizaciones de defensa');
INSERT INTO `c_subscategorias` VALUES ('7', '9', 'Organizaciones de profesionales');
INSERT INTO `c_subscategorias` VALUES ('7', '10', 'Organizaciones de voluntarios');
INSERT INTO `c_subscategorias` VALUES ('7', '11', 'Organizaciones pol&iacute;ticas');
INSERT INTO `c_subscategorias` VALUES ('7', '12', 'Organizaciones religiosas');
INSERT INTO `c_subscategorias` VALUES ('7', '13', 'Organizaciones sin fines de lucro');
INSERT INTO `c_subscategorias` VALUES ('7', '14', 'Postgrados');
INSERT INTO `c_subscategorias` VALUES ('8', '1', 'Actividades,Encuentros y Juntadas');
INSERT INTO `c_subscategorias` VALUES ('8', '2', 'Actualidad');
INSERT INTO `c_subscategorias` VALUES ('8', '3', 'Amantes de los motores');
INSERT INTO `c_subscategorias` VALUES ('8', '4', 'Amigos');
INSERT INTO `c_subscategorias` VALUES ('8', '5', 'Auto ayuda');
INSERT INTO `c_subscategorias` VALUES ('8', '6', 'Bebidas y vinos');
INSERT INTO `c_subscategorias` VALUES ('8', '7', 'Belleza y est&eacute;tica');
INSERT INTO `c_subscategorias` VALUES ('8', '8', 'Ciencia');
INSERT INTO `c_subscategorias` VALUES ('8', '9', 'Citas,Relciones y Amor');
INSERT INTO `c_subscategorias` VALUES ('8', '10', 'Coleccionistas');
INSERT INTO `c_subscategorias` VALUES ('8', '1', 'Actividades,Encuentros y Juntadas');
INSERT INTO `c_subscategorias` VALUES ('8', '2', 'Actualidad');
INSERT INTO `c_subscategorias` VALUES ('8', '3', 'Amantes de los motores');
INSERT INTO `c_subscategorias` VALUES ('8', '4', 'Amigos');
INSERT INTO `c_subscategorias` VALUES ('8', '5', 'Auto ayuda');
INSERT INTO `c_subscategorias` VALUES ('8', '6', 'Bebidas y vinos');
INSERT INTO `c_subscategorias` VALUES ('8', '7', 'Belleza y est&eacute;tica');
INSERT INTO `c_subscategorias` VALUES ('8', '8', 'Ciencia');
INSERT INTO `c_subscategorias` VALUES ('8', '9', 'Citas,Relciones y Amor');
INSERT INTO `c_subscategorias` VALUES ('8', '10', 'Coleccionistas');
INSERT INTO `c_subscategorias` VALUES ('8', '1', 'Actividades,Encuentros y Juntadas');
INSERT INTO `c_subscategorias` VALUES ('8', '2', 'Actualidad');
INSERT INTO `c_subscategorias` VALUES ('8', '3', 'Amantes de los motores');
INSERT INTO `c_subscategorias` VALUES ('8', '4', 'Amigos');
INSERT INTO `c_subscategorias` VALUES ('8', '5', 'Auto ayuda');
INSERT INTO `c_subscategorias` VALUES ('8', '6', 'Bebidas y vinos');
INSERT INTO `c_subscategorias` VALUES ('8', '7', 'Belleza y est&eacute;tica');
INSERT INTO `c_subscategorias` VALUES ('8', '8', 'Ciencia');
INSERT INTO `c_subscategorias` VALUES ('8', '9', 'Citas,Relciones y Amor');
INSERT INTO `c_subscategorias` VALUES ('8', '10', 'Coleccionistas');
INSERT INTO `c_subscategorias` VALUES ('8', '1', 'Actividades,Encuentros y Juntadas');
INSERT INTO `c_subscategorias` VALUES ('8', '2', 'Actualidad');
INSERT INTO `c_subscategorias` VALUES ('8', '3', 'Amantes de los motores');
INSERT INTO `c_subscategorias` VALUES ('8', '4', 'Amigos');
INSERT INTO `c_subscategorias` VALUES ('8', '5', 'Auto ayuda');
INSERT INTO `c_subscategorias` VALUES ('8', '6', 'Bebidas y vinos');
INSERT INTO `c_subscategorias` VALUES ('8', '7', 'Belleza y est&eacute;tica');
INSERT INTO `c_subscategorias` VALUES ('8', '8', 'Ciencia');
INSERT INTO `c_subscategorias` VALUES ('8', '9', 'Citas,Relciones y Amor');
INSERT INTO `c_subscategorias` VALUES ('8', '10', 'Coleccionistas');
INSERT INTO `c_subscategorias` VALUES ('8', '1', 'Actividades,Encuentros y Juntadas');
INSERT INTO `c_subscategorias` VALUES ('8', '2', 'Actualidad');
INSERT INTO `c_subscategorias` VALUES ('8', '3', 'Amantes de los motores');
INSERT INTO `c_subscategorias` VALUES ('8', '4', 'Amigos');
INSERT INTO `c_subscategorias` VALUES ('8', '5', 'Auto ayuda');
INSERT INTO `c_subscategorias` VALUES ('8', '6', 'Bebidas y Vinos');
INSERT INTO `c_subscategorias` VALUES ('8', '7', 'Belleza y Est&eacute;tica');
INSERT INTO `c_subscategorias` VALUES ('8', '8', 'Ciencia');
INSERT INTO `c_subscategorias` VALUES ('8', '9', 'Citas, Relaciones Y Amor');
INSERT INTO `c_subscategorias` VALUES ('8', '10', 'Coleccionistas');
INSERT INTO `c_subscategorias` VALUES ('8', '11', 'Comics e historietas');
INSERT INTO `c_subscategorias` VALUES ('8', '12', 'Comidas, Recetas y Cocina');
INSERT INTO `c_subscategorias` VALUES ('8', '13', 'Cultura Retro');
INSERT INTO `c_subscategorias` VALUES ('8', '14', 'Edades y Vivencias');
INSERT INTO `c_subscategorias` VALUES ('8', '15', 'Esoterismo');
INSERT INTO `c_subscategorias` VALUES ('8', '16', 'Familias');
INSERT INTO `c_subscategorias` VALUES ('8', '17', 'Filosof&iacute;a');
INSERT INTO `c_subscategorias` VALUES ('8', '18', 'General y Otros');
INSERT INTO `c_subscategorias` VALUES ('8', '19', 'Historia');
INSERT INTO `c_subscategorias` VALUES ('8', '20', 'Idiomas');
INSERT INTO `c_subscategorias` VALUES ('8', '21', 'Jardiner&iacute;a');
INSERT INTO `c_subscategorias` VALUES ('8', '22', 'Juegos de mesa');
INSERT INTO `c_subscategorias` VALUES ('8', '23', 'Manga y Anime');
INSERT INTO `c_subscategorias` VALUES ('8', '24', 'Mascotas y Animales');
INSERT INTO `c_subscategorias` VALUES ('8', '25', 'Modas y Tendencias');
INSERT INTO `c_subscategorias` VALUES ('8', '26', 'Pasatiempos y Manualidades');
INSERT INTO `c_subscategorias` VALUES ('8', '27', 'Pol&iacute;tica');
INSERT INTO `c_subscategorias` VALUES ('8', '28', 'Religi&oacute;n y Espiritualidad');
INSERT INTO `c_subscategorias` VALUES ('8', '29', 'Salud y Bienestar');
INSERT INTO `c_subscategorias` VALUES ('8', '30', 'Sexualidad');
INSERT INTO `c_subscategorias` VALUES ('8', '31', 'Viajes y Turismo');
INSERT INTO `c_subscategorias` VALUES ('5', '1', 'Aparatos electr&oacute;nicos');
INSERT INTO `c_subscategorias` VALUES ('5', '2', 'Celulares');
INSERT INTO `c_subscategorias` VALUES ('5', '3', 'Computadoras y Hardware');
INSERT INTO `c_subscategorias` VALUES ('5', '4', 'Comunidades 2.0 y Cultura online');
INSERT INTO `c_subscategorias` VALUES ('5', '5', 'Gadgets');
INSERT INTO `c_subscategorias` VALUES ('5', '6', 'General y Otros');
INSERT INTO `c_subscategorias` VALUES ('5', '7', 'Juegos');
INSERT INTO `c_subscategorias` VALUES ('5', '8', 'Linux & GNU');
INSERT INTO `c_subscategorias` VALUES ('5', '9', 'Mac');
INSERT INTO `c_subscategorias` VALUES ('5', '10', 'Multimedia');
INSERT INTO `c_subscategorias` VALUES ('5', '11', 'Noticias y Novedades');
INSERT INTO `c_subscategorias` VALUES ('5', '12', 'Programaci&oacute; y Lenguajes');
INSERT INTO `c_subscategorias` VALUES ('5', '13', 'Sitios web y Blogs');
INSERT INTO `c_subscategorias` VALUES ('5', '14', 'Software y Aplicaciones');
INSERT INTO `c_subscategorias` VALUES ('5', '15', 'Windows');
INSERT INTO `c_subscategorias` VALUES ('6', '1', 'Blues');
INSERT INTO `c_subscategorias` VALUES ('6', '2', 'Cl&aacute;sica');
INSERT INTO `c_subscategorias` VALUES ('6', '3', 'Compositores');
INSERT INTO `c_subscategorias` VALUES ('6', '4', 'Country');
INSERT INTO `c_subscategorias` VALUES ('6', '5', 'Cumbia');
INSERT INTO `c_subscategorias` VALUES ('6', '6', 'Dance');
INSERT INTO `c_subscategorias` VALUES ('6', '7', 'Electr&oacute;nica');
INSERT INTO `c_subscategorias` VALUES ('6', '8', 'Folklore');
INSERT INTO `c_subscategorias` VALUES ('6', '9', 'General y Otros');
INSERT INTO `c_subscategorias` VALUES ('6', '10', 'Indie');
INSERT INTO `c_subscategorias` VALUES ('6', '11', 'Instrumental');
INSERT INTO `c_subscategorias` VALUES ('6', '12', 'Jazz');
INSERT INTO `c_subscategorias` VALUES ('6', '13', 'Latina');
INSERT INTO `c_subscategorias` VALUES ('6', '14', 'Metal');
INSERT INTO `c_subscategorias` VALUES ('6', '15', 'Pop');
INSERT INTO `c_subscategorias` VALUES ('6', '16', 'R&B/Soul');
INSERT INTO `c_subscategorias` VALUES ('6', '17', 'Rap y Hip Hop');
INSERT INTO `c_subscategorias` VALUES ('6', '18', 'Reggae');
INSERT INTO `c_subscategorias` VALUES ('6', '19', 'Reggeaton');
INSERT INTO `c_subscategorias` VALUES ('6', '20', 'Religiosa');
INSERT INTO `c_subscategorias` VALUES ('6', '21', 'Rock');
INSERT INTO `c_subscategorias` VALUES ('4', '1', 'Barrios');
INSERT INTO `c_subscategorias` VALUES ('4', '2', 'General y Otros');
INSERT INTO `c_subscategorias` VALUES ('4', '3', 'Lugares');
INSERT INTO `c_subscategorias` VALUES ('4', '4', 'Pa&iacute;ses');
INSERT INTO `c_subscategorias` VALUES ('4', '5', 'Provincias y estados');

-- ----------------------------
-- Table structure for `c_suspendidos`
-- ----------------------------
DROP TABLE IF EXISTS `c_suspendidos`;
CREATE TABLE `c_suspendidos` (
  `suspid` int(11) NOT NULL auto_increment,
  `userid` int(11) NOT NULL,
  `comid` int(11) NOT NULL,
  `causa` tinytext NOT NULL,
  `dia` tinyint(2) NOT NULL,
  `por` tinytext NOT NULL,
  `accion` mediumint(2) NOT NULL,
  `fecha` int(11) NOT NULL,
  PRIMARY KEY  (`suspid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED;

-- ----------------------------
-- Records of c_suspendidos
-- ----------------------------

-- ----------------------------
-- Table structure for `c_temas`
-- ----------------------------
DROP TABLE IF EXISTS `c_temas`;
CREATE TABLE `c_temas` (
  `temaid` int(11) unsigned NOT NULL auto_increment,
  `comid` int(11) NOT NULL,
  `estado` tinyint(2) NOT NULL,
  `userid` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `cuerpo` text NOT NULL,
  `tagste` varchar(500) NOT NULL,
  `cerrado` varchar(2) NOT NULL,
  `importante` varchar(2) NOT NULL,
  `fechate` int(11) NOT NULL,
  `votada` int(11) NOT NULL,
  `visitas` int(11) NOT NULL,
  `numco` int(11) NOT NULL,
  PRIMARY KEY  (`temaid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of c_temas
-- ----------------------------
INSERT INTO `c_temas` VALUES ('1', '1', '0', '1', 'jajajajajaaj', 'asdasdasdasd', 'sdsd,s,ds,ds', '0', '0', '12332323', '0', '0', '0');

-- ----------------------------
-- Table structure for `denuncias`
-- ----------------------------
DROP TABLE IF EXISTS `denuncias`;
CREATE TABLE `denuncias` (
  `denid` int(11) NOT NULL auto_increment,
  `razon` int(6) NOT NULL,
  `cuerpo` varchar(200) NOT NULL,
  `postid` int(11) default NULL,
  `userid` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY  (`denid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of denuncias
-- ----------------------------
INSERT INTO `denuncias` VALUES ('1', '1', 'se rie mucho !!!!!!!!', '2', '3', '2010-05-27 18:17:40');
INSERT INTO `denuncias` VALUES ('2', '4', 'ffffffff', '2', '3', '2010-05-27 19:28:33');

-- ----------------------------
-- Table structure for `favoritos`
-- ----------------------------
DROP TABLE IF EXISTS `favoritos`;
CREATE TABLE `favoritos` (
  `favid` int(11) NOT NULL auto_increment,
  `postid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `guardado` int(10) NOT NULL default '0',
  PRIMARY KEY  (`favid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of favoritos
-- ----------------------------
INSERT INTO `favoritos` VALUES ('1', '1', '1', '1273869297');
INSERT INTO `favoritos` VALUES ('4', '1', '2', '1274387376');
INSERT INTO `favoritos` VALUES ('3', '1', '3', '1273873529');

-- ----------------------------
-- Table structure for `log_moderacion`
-- ----------------------------
DROP TABLE IF EXISTS `log_moderacion`;
CREATE TABLE `log_moderacion` (
  `logid` int(11) NOT NULL auto_increment,
  `type` varchar(0) NOT NULL,
  `id1` varchar(0) NOT NULL,
  `id2` varchar(0) NOT NULL,
  `id3` varchar(0) NOT NULL,
  `causa` varchar(0) NOT NULL,
  `time` varchar(0) NOT NULL,
  `duracion` varchar(0) NOT NULL,
  `accion` varchar(0) NOT NULL,
  PRIMARY KEY  (`logid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of log_moderacion
-- ----------------------------

-- ----------------------------
-- Table structure for `mensajes`
-- ----------------------------
DROP TABLE IF EXISTS `mensajes`;
CREATE TABLE `mensajes` (
  `id_mensaje` int(11) NOT NULL auto_increment,
  `id_emisor` int(11) NOT NULL,
  `id_receptor` int(11) NOT NULL,
  `asunto` varchar(100) collate latin1_general_ci NOT NULL,
  `contenido` varchar(255) collate latin1_general_ci NOT NULL,
  `papelera_emisor` tinyint(1) NOT NULL default '0',
  `papelera_receptor` tinyint(1) NOT NULL default '0',
  `eliminado_emisor` tinyint(1) NOT NULL default '0',
  `eliminado_receptor` tinyint(1) NOT NULL default '0',
  `id_carpeta` bigint(11) NOT NULL default '0',
  `leido_emisor` tinyint(1) NOT NULL default '0',
  `leido_receptor` tinyint(1) NOT NULL default '0',
  `fecha` datetime NOT NULL,
  `fecha_papelera` datetime NOT NULL,
  PRIMARY KEY  (`id_mensaje`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Records of mensajes
-- ----------------------------
INSERT INTO `mensajes` VALUES ('1', '1', '3', 'jajaajajja', 'aaaaaaaaaaaaaaaa', '0', '0', '0', '0', '0', '0', '1', '2010-05-27 13:54:36', '0000-00-00 00:00:00');
INSERT INTO `mensajes` VALUES ('2', '3', '1', 'hola que tal !', 'jjajajajajaja', '0', '0', '0', '0', '0', '0', '1', '2010-05-27 16:08:08', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `notificaciones`
-- ----------------------------
DROP TABLE IF EXISTS `notificaciones`;
CREATE TABLE `notificaciones` (
  `notiid` int(11) NOT NULL auto_increment,
  `userid` int(11) NOT NULL,
  `x` text NOT NULL,
  `user` int(11) NOT NULL,
  `post` int(11) NOT NULL,
  `tema` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `leido` int(11) NOT NULL,
  `enviado` int(11) NOT NULL,
  `type` text NOT NULL,
  PRIMARY KEY  (`notiid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED;

-- ----------------------------
-- Records of notificaciones
-- ----------------------------
INSERT INTO `notificaciones` VALUES ('1', '1', 'friend-new', '1', '0', '0', '1', '1', '1278624356', 'ff');

-- ----------------------------
-- Table structure for `paises`
-- ----------------------------
DROP TABLE IF EXISTS `paises`;
CREATE TABLE `paises` (
  `id_pais` int(8) NOT NULL auto_increment,
  `nombre_pais` varchar(50) NOT NULL,
  `img_pais` varchar(3) NOT NULL,
  PRIMARY KEY  (`id_pais`)
) ENGINE=MyISAM AUTO_INCREMENT=245 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of paises
-- ----------------------------
INSERT INTO `paises` VALUES ('1', 'Afganist&aacute;n', 'AF');
INSERT INTO `paises` VALUES ('2', 'Albania', 'AL');
INSERT INTO `paises` VALUES ('3', 'Alemania', 'DE');
INSERT INTO `paises` VALUES ('4', 'Argelia', 'DZ');
INSERT INTO `paises` VALUES ('5', 'Andorra', 'AD');
INSERT INTO `paises` VALUES ('6', 'Angola', 'AO');
INSERT INTO `paises` VALUES ('7', 'Anguila', 'AI');
INSERT INTO `paises` VALUES ('8', 'Antigua y Barbuda', 'AG');
INSERT INTO `paises` VALUES ('9', 'Antillas Neerlandesas', 'AN');
INSERT INTO `paises` VALUES ('10', 'Ant&aacute;rtida', 'AQ');
INSERT INTO `paises` VALUES ('11', 'Arabia Saudita', 'SA');
INSERT INTO `paises` VALUES ('12', 'Argentina', 'AR');
INSERT INTO `paises` VALUES ('13', 'Armenia', 'AM');
INSERT INTO `paises` VALUES ('14', 'Aruba', 'AW');
INSERT INTO `paises` VALUES ('15', 'Australia', 'AU');
INSERT INTO `paises` VALUES ('16', 'Austria', 'AT');
INSERT INTO `paises` VALUES ('17', 'Azerbaiy&aacute;n', 'AZ');
INSERT INTO `paises` VALUES ('18', 'Bahamas', 'BS');
INSERT INTO `paises` VALUES ('19', 'Bahr&eacute;in', 'BH');
INSERT INTO `paises` VALUES ('20', 'Bangladesh', 'BD');
INSERT INTO `paises` VALUES ('21', 'Barbados', 'BB');
INSERT INTO `paises` VALUES ('22', 'Belice', 'BZ');
INSERT INTO `paises` VALUES ('23', 'Benin', 'BJ');
INSERT INTO `paises` VALUES ('24', 'Bermudas', 'BM');
INSERT INTO `paises` VALUES ('25', 'Bielorrusia', 'BY');
INSERT INTO `paises` VALUES ('26', 'Bolivia', 'BO');
INSERT INTO `paises` VALUES ('27', 'Bosnia y Herzegovina', 'BA');
INSERT INTO `paises` VALUES ('28', 'Botswana', 'BW');
INSERT INTO `paises` VALUES ('29', 'Brasil', 'BR');
INSERT INTO `paises` VALUES ('30', 'Brun&eacute;i', 'BN');
INSERT INTO `paises` VALUES ('31', 'Bulgaria', 'BG');
INSERT INTO `paises` VALUES ('32', 'Burkina Faso', 'BF');
INSERT INTO `paises` VALUES ('33', 'Burundi', 'BI');
INSERT INTO `paises` VALUES ('34', 'But&aacute;n', 'BT');
INSERT INTO `paises` VALUES ('35', 'B&eacute;lgica', 'BE');
INSERT INTO `paises` VALUES ('36', 'Cabo Verde', 'CV');
INSERT INTO `paises` VALUES ('37', 'Camboya', 'KH');
INSERT INTO `paises` VALUES ('38', 'Camer&uacute;n', 'CM');
INSERT INTO `paises` VALUES ('39', 'Canad&aacute;', 'CA');
INSERT INTO `paises` VALUES ('40', 'Chad', 'TD');
INSERT INTO `paises` VALUES ('41', 'Chile', 'CL');
INSERT INTO `paises` VALUES ('42', 'China', 'CN');
INSERT INTO `paises` VALUES ('43', 'Chipre', 'CY');
INSERT INTO `paises` VALUES ('44', 'Ciudad del Vaticano', 'VA');
INSERT INTO `paises` VALUES ('45', 'Colombia', 'CO');
INSERT INTO `paises` VALUES ('46', 'Comoras', 'KM');
INSERT INTO `paises` VALUES ('47', 'Corea del Norte', 'KP');
INSERT INTO `paises` VALUES ('48', 'Corea del Sur', 'KR');
INSERT INTO `paises` VALUES ('49', 'Costa Rica', 'CR');
INSERT INTO `paises` VALUES ('50', 'Costa de Marfil', 'CI');
INSERT INTO `paises` VALUES ('51', 'Croacia', 'HR');
INSERT INTO `paises` VALUES ('52', 'Cuba', 'CU');
INSERT INTO `paises` VALUES ('53', 'Dinamarca', 'DK');
INSERT INTO `paises` VALUES ('54', 'Dominica', 'DM');
INSERT INTO `paises` VALUES ('55', 'Ecuador', 'EC');
INSERT INTO `paises` VALUES ('56', 'Egipto', 'EG');
INSERT INTO `paises` VALUES ('57', 'El Salvador', 'SV');
INSERT INTO `paises` VALUES ('58', 'Emiratos &Aacute;rabes Unidos', 'AE');
INSERT INTO `paises` VALUES ('59', 'Eritrea', 'ER');
INSERT INTO `paises` VALUES ('60', 'Eslovaquia', 'SK');
INSERT INTO `paises` VALUES ('61', 'Eslovenia', 'SI');
INSERT INTO `paises` VALUES ('62', 'Espa&ntilde;a', 'ES');
INSERT INTO `paises` VALUES ('63', 'Estados Unidos', 'US');
INSERT INTO `paises` VALUES ('64', 'Estonia', 'EE');
INSERT INTO `paises` VALUES ('65', 'Etiop&iacute;a', 'ET');
INSERT INTO `paises` VALUES ('66', 'Filipinas', 'PH');
INSERT INTO `paises` VALUES ('67', 'Finlandia', 'FI');
INSERT INTO `paises` VALUES ('68', 'Fiyi', 'FJ');
INSERT INTO `paises` VALUES ('69', 'Francia', 'FR');
INSERT INTO `paises` VALUES ('70', 'Gab&oacute;n', 'GA');
INSERT INTO `paises` VALUES ('71', 'Gambia', 'GM');
INSERT INTO `paises` VALUES ('72', 'Georgia', 'GE');
INSERT INTO `paises` VALUES ('73', 'Ghana', 'GH');
INSERT INTO `paises` VALUES ('74', 'Gibraltar', 'GI');
INSERT INTO `paises` VALUES ('75', 'Granada', 'GD');
INSERT INTO `paises` VALUES ('76', 'Grecia', 'GR');
INSERT INTO `paises` VALUES ('77', 'Groenlandia', 'GL');
INSERT INTO `paises` VALUES ('78', 'Guadalupe', 'GP');
INSERT INTO `paises` VALUES ('79', 'Guam', 'GU');
INSERT INTO `paises` VALUES ('80', 'Guatemala', 'GT');
INSERT INTO `paises` VALUES ('81', 'Guayana Francesa', 'GF');
INSERT INTO `paises` VALUES ('82', 'Guernsey', 'GG');
INSERT INTO `paises` VALUES ('83', 'Guinea', 'GN');
INSERT INTO `paises` VALUES ('84', 'Guinea Ecuatorial', 'GQ');
INSERT INTO `paises` VALUES ('85', 'Guinea-Bissau', 'GW');
INSERT INTO `paises` VALUES ('86', 'Guyana', 'GY');
INSERT INTO `paises` VALUES ('87', 'Hait&iacute;', 'HT');
INSERT INTO `paises` VALUES ('88', 'Honduras', 'HN');
INSERT INTO `paises` VALUES ('89', 'Hong Kong', 'HK');
INSERT INTO `paises` VALUES ('90', 'Hungr&iacute;a', 'HU');
INSERT INTO `paises` VALUES ('91', 'India', 'IN');
INSERT INTO `paises` VALUES ('92', 'Indonesia', 'ID');
INSERT INTO `paises` VALUES ('93', 'Iraq', 'IQ');
INSERT INTO `paises` VALUES ('94', 'Irlanda', 'IE');
INSERT INTO `paises` VALUES ('95', 'Ir&aacute;n', 'IR');
INSERT INTO `paises` VALUES ('96', 'Isla Bouvet', 'BV');
INSERT INTO `paises` VALUES ('97', 'Isla de Man', 'IM');
INSERT INTO `paises` VALUES ('98', 'Isla de Navidad', 'CX');
INSERT INTO `paises` VALUES ('99', 'Islandia', 'IS');
INSERT INTO `paises` VALUES ('100', 'Islas Caim&aacute;n', 'KY');
INSERT INTO `paises` VALUES ('101', 'Islas Cocos', 'CC');
INSERT INTO `paises` VALUES ('102', 'Islas Cook', 'CK');
INSERT INTO `paises` VALUES ('103', 'Islas Feroe', 'FO');
INSERT INTO `paises` VALUES ('104', 'Islas Georgias del Sur y Sandwich del Sur', 'GS');
INSERT INTO `paises` VALUES ('105', 'Islas Heard y McDonald', 'HM');
INSERT INTO `paises` VALUES ('106', 'Islas Marianas del Norte', 'MP');
INSERT INTO `paises` VALUES ('107', 'Islas Marshall', 'MH');
INSERT INTO `paises` VALUES ('108', 'Islas Pitcairn', 'PN');
INSERT INTO `paises` VALUES ('109', 'Islas Salom&oacute;n', 'SB');
INSERT INTO `paises` VALUES ('110', 'Islas Turcas y Caicos', 'TC');
INSERT INTO `paises` VALUES ('111', 'Islas V&iacute;rgenes Brit&aacute;nicas', 'VG');
INSERT INTO `paises` VALUES ('112', 'Islas V&iacute;rgenes Estadounidenses', 'VI');
INSERT INTO `paises` VALUES ('113', 'Islas ultramarinas de Estados Unidos', 'UM');
INSERT INTO `paises` VALUES ('114', 'Israel', 'IL');
INSERT INTO `paises` VALUES ('115', 'Italia', 'IT');
INSERT INTO `paises` VALUES ('116', 'Jamaica', 'JM');
INSERT INTO `paises` VALUES ('117', 'Jap&oacute;n', 'JP');
INSERT INTO `paises` VALUES ('118', 'Jersey', 'JE');
INSERT INTO `paises` VALUES ('119', 'Jordania', 'JO');
INSERT INTO `paises` VALUES ('120', 'Kazajist&aacute;n', 'KZ');
INSERT INTO `paises` VALUES ('121', 'Kenia', 'KE');
INSERT INTO `paises` VALUES ('122', 'Kirguist&aacute;n', 'KG');
INSERT INTO `paises` VALUES ('123', 'Kiribati', 'KI');
INSERT INTO `paises` VALUES ('124', 'Kuwait', 'KW');
INSERT INTO `paises` VALUES ('125', 'Laos', 'LA');
INSERT INTO `paises` VALUES ('126', 'Lesoto', 'LS');
INSERT INTO `paises` VALUES ('127', 'Letonia', 'LV');
INSERT INTO `paises` VALUES ('128', 'Liberia', 'LR');
INSERT INTO `paises` VALUES ('129', 'Libia', 'LY');
INSERT INTO `paises` VALUES ('130', 'Liechtenstein', 'LI');
INSERT INTO `paises` VALUES ('131', 'Lituania', 'LT');
INSERT INTO `paises` VALUES ('132', 'Luxemburgo', 'LU');
INSERT INTO `paises` VALUES ('133', 'L&iacute;bano', 'LB');
INSERT INTO `paises` VALUES ('134', 'Macao', 'MO');
INSERT INTO `paises` VALUES ('135', 'Madagascar', 'MG');
INSERT INTO `paises` VALUES ('136', 'Malasia', 'MY');
INSERT INTO `paises` VALUES ('137', 'Malaui', 'MW');
INSERT INTO `paises` VALUES ('138', 'Maldivas', 'MV');
INSERT INTO `paises` VALUES ('139', 'Malta', 'MT');
INSERT INTO `paises` VALUES ('140', 'Mal&iacute;', 'ML');
INSERT INTO `paises` VALUES ('141', 'Marruecos', 'MA');
INSERT INTO `paises` VALUES ('142', 'Martinica', 'MQ');
INSERT INTO `paises` VALUES ('143', 'Mauricio', 'MU');
INSERT INTO `paises` VALUES ('144', 'Mauritania', 'MR');
INSERT INTO `paises` VALUES ('145', 'Mayotte', 'YT');
INSERT INTO `paises` VALUES ('146', 'Micronesia', 'FM');
INSERT INTO `paises` VALUES ('147', 'Moldavia', 'MD');
INSERT INTO `paises` VALUES ('148', 'Mongolia', 'MN');
INSERT INTO `paises` VALUES ('149', 'Montenegro', 'ME');
INSERT INTO `paises` VALUES ('150', 'Montserrat', 'MS');
INSERT INTO `paises` VALUES ('151', 'Mozambique', 'MZ');
INSERT INTO `paises` VALUES ('152', 'Myanmar', 'MM');
INSERT INTO `paises` VALUES ('153', 'M&eacute;xico', 'MX');
INSERT INTO `paises` VALUES ('154', 'M&oacute;naco', 'MC');
INSERT INTO `paises` VALUES ('155', 'Namibia', 'NA');
INSERT INTO `paises` VALUES ('156', 'Nauru', 'NR');
INSERT INTO `paises` VALUES ('157', 'Nepal', 'NP');
INSERT INTO `paises` VALUES ('158', 'Nicaragua', 'NI');
INSERT INTO `paises` VALUES ('159', 'Niger', 'NE');
INSERT INTO `paises` VALUES ('160', 'Nigeria', 'NG');
INSERT INTO `paises` VALUES ('161', 'Niue', 'NU');
INSERT INTO `paises` VALUES ('162', 'Norfolk', 'NF');
INSERT INTO `paises` VALUES ('163', 'Noruega', 'NO');
INSERT INTO `paises` VALUES ('164', 'Nueva Caledonia', 'NC');
INSERT INTO `paises` VALUES ('165', 'Nueva Zelanda', 'NZ');
INSERT INTO `paises` VALUES ('166', 'Om&aacute;n', 'OM');
INSERT INTO `paises` VALUES ('167', 'Pakist&aacute;n', 'PK');
INSERT INTO `paises` VALUES ('168', 'Palaos', 'PW');
INSERT INTO `paises` VALUES ('169', 'Panam&aacute;', 'PA');
INSERT INTO `paises` VALUES ('170', 'Pap&uacute;a Nueva Guinea', 'PG');
INSERT INTO `paises` VALUES ('171', 'Paraguay', 'PY');
INSERT INTO `paises` VALUES ('172', 'Pa&iacute;ses Bajos', 'NL');
INSERT INTO `paises` VALUES ('173', 'Per&uacute;', 'PE');
INSERT INTO `paises` VALUES ('174', 'Polinesia Francesa', 'PF');
INSERT INTO `paises` VALUES ('175', 'Polonia', 'PL');
INSERT INTO `paises` VALUES ('176', 'Portugal', 'PT');
INSERT INTO `paises` VALUES ('177', 'Puerto Rico', 'PR');
INSERT INTO `paises` VALUES ('178', 'Qatar', 'QA');
INSERT INTO `paises` VALUES ('179', 'Reino Unido', 'GB');
INSERT INTO `paises` VALUES ('180', 'Rep&uacute;blica Centroafricana', 'CF');
INSERT INTO `paises` VALUES ('181', 'Rep&uacute;blica Checa', 'CZ');
INSERT INTO `paises` VALUES ('182', 'Rep&uacute;blica Democr&aacute;tica del Congo', 'CD');
INSERT INTO `paises` VALUES ('183', 'Rep&uacute;blica Dominicana', 'DO');
INSERT INTO `paises` VALUES ('184', 'Rep&uacute;blica de Macedonia', 'MK');
INSERT INTO `paises` VALUES ('185', 'Rep&uacute;blica del Congo', 'CG');
INSERT INTO `paises` VALUES ('186', 'Rep&uacute;blica &Aacute;rabe Saharaui Democr&aacu', 'EH');
INSERT INTO `paises` VALUES ('187', 'Reuni&oacute;n', 'RE');
INSERT INTO `paises` VALUES ('188', 'Ruanda', 'RW');
INSERT INTO `paises` VALUES ('189', 'Rumania', 'RO');
INSERT INTO `paises` VALUES ('190', 'Rusia', 'RU');
INSERT INTO `paises` VALUES ('191', 'Saint-Martin', 'MF');
INSERT INTO `paises` VALUES ('192', 'Samoa', 'WS');
INSERT INTO `paises` VALUES ('193', 'Samoa Americana', 'AS');
INSERT INTO `paises` VALUES ('194', 'San Bartolom&eacute;', 'BL');
INSERT INTO `paises` VALUES ('195', 'San Crist&oacute;bal y Nieves', 'KN');
INSERT INTO `paises` VALUES ('196', 'San Marino', 'SM');
INSERT INTO `paises` VALUES ('197', 'San Pedro y Miquel&oacute;n', 'PM');
INSERT INTO `paises` VALUES ('198', 'San Vicente y las Granadinas', 'VC');
INSERT INTO `paises` VALUES ('199', 'Santa Helena', 'SH');
INSERT INTO `paises` VALUES ('200', 'Santa Luc&iacute;a', 'LC');
INSERT INTO `paises` VALUES ('201', 'Sao Tom&eacute; y Principe', 'ST');
INSERT INTO `paises` VALUES ('202', 'Senegal', 'SN');
INSERT INTO `paises` VALUES ('203', 'Serbia', 'RS');
INSERT INTO `paises` VALUES ('204', 'Seychelles', 'SC');
INSERT INTO `paises` VALUES ('205', 'Sierra Leona', 'SL');
INSERT INTO `paises` VALUES ('206', 'Singapur', 'SG');
INSERT INTO `paises` VALUES ('207', 'Siria', 'SY');
INSERT INTO `paises` VALUES ('208', 'Somalia', 'SO');
INSERT INTO `paises` VALUES ('209', 'Sri Lanka', 'LK');
INSERT INTO `paises` VALUES ('210', 'Suazilandia', 'SZ');
INSERT INTO `paises` VALUES ('211', 'Sud&aacute;frica', 'ZA');
INSERT INTO `paises` VALUES ('212', 'Sud&aacute;n', 'SD');
INSERT INTO `paises` VALUES ('213', 'Suecia', 'SE');
INSERT INTO `paises` VALUES ('214', 'Suiza', 'CH');
INSERT INTO `paises` VALUES ('215', 'Surinam', 'SR');
INSERT INTO `paises` VALUES ('216', 'Svalbard y Jan Mayen', 'SJ');
INSERT INTO `paises` VALUES ('217', 'Tailandia', 'TH');
INSERT INTO `paises` VALUES ('218', 'Taiw&aacute;n', 'TW');
INSERT INTO `paises` VALUES ('219', 'Tanzania', 'TZ');
INSERT INTO `paises` VALUES ('220', 'Tayikist&aacute;n', 'TJ');
INSERT INTO `paises` VALUES ('221', 'Territorio Brit&aacute;nico del Oc&eacute;ano &Iac', 'IO');
INSERT INTO `paises` VALUES ('222', 'Territorios Australes Franceses', 'TF');
INSERT INTO `paises` VALUES ('223', 'Territorios palestinos', 'PS');
INSERT INTO `paises` VALUES ('224', 'Timor Oriental', 'TL');
INSERT INTO `paises` VALUES ('225', 'Togo', 'TG');
INSERT INTO `paises` VALUES ('226', 'Tokelau', 'TK');
INSERT INTO `paises` VALUES ('227', 'Tonga', 'TO');
INSERT INTO `paises` VALUES ('228', 'Trinidad y Tobago', 'TT');
INSERT INTO `paises` VALUES ('229', 'Turkmenist&aacute;n', 'TM');
INSERT INTO `paises` VALUES ('230', 'Turqu&iacute;a', 'TR');
INSERT INTO `paises` VALUES ('231', 'Tuvalu', 'TV');
INSERT INTO `paises` VALUES ('232', 'T&uacute;nez', 'TN');
INSERT INTO `paises` VALUES ('233', 'Ucrania', 'UA');
INSERT INTO `paises` VALUES ('234', 'Uganda', 'UG');
INSERT INTO `paises` VALUES ('235', 'Uruguay', 'UY');
INSERT INTO `paises` VALUES ('236', 'Uzbekist&aacute;n', 'UZ');
INSERT INTO `paises` VALUES ('237', 'Vanuatu', 'VU');
INSERT INTO `paises` VALUES ('238', 'Venezuela', 'VE');
INSERT INTO `paises` VALUES ('239', 'Vietnam', 'VN');
INSERT INTO `paises` VALUES ('240', 'Wallis y Futuna', 'WF');
INSERT INTO `paises` VALUES ('241', 'Yemen', 'YE');
INSERT INTO `paises` VALUES ('242', 'Yibuti', 'DJ');
INSERT INTO `paises` VALUES ('243', 'Zambia', 'ZM');
INSERT INTO `paises` VALUES ('244', 'Zimbabue', 'ZW');

-- ----------------------------
-- Table structure for `posts`
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `postid` int(11) NOT NULL auto_increment,
  `estado` tinyint(1) NOT NULL default '0',
  `userid` mediumint(8) NOT NULL default '0',
  `titulo` tinytext NOT NULL,
  `contenido` mediumtext NOT NULL,
  `creado` int(11) NOT NULL,
  `privado` tinyint(1) NOT NULL default '0',
  `coments` tinyint(1) NOT NULL default '0',
  `puntos` int(15) NOT NULL default '0',
  `comentarios` tinyint(1) NOT NULL default '0',
  `visitas` int(10) NOT NULL default '0',
  `favoritos` mediumint(2) NOT NULL,
  `tags` varchar(170) NOT NULL default '',
  `categoria` tinyint(3) NOT NULL default '0',
  `sticky` tinyint(1) NOT NULL,
  `patrocinado` tinyint(1) NOT NULL,
  `follow` int(11) NOT NULL,
  PRIMARY KEY  (`postid`),
  KEY `id` (`postid`),
  FULLTEXT KEY `tags` (`tags`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of posts
-- ----------------------------
INSERT INTO `posts` VALUES ('1', '0', '1', 'aaaaaaaa', 'aaaaaaaaaaaaaaaaaa', '1273869277', '1', '0', '18', '7', '158', '4', 'aaaa,aaaa,aaaaa,aaa5', '28', '0', '0', '0');
INSERT INTO `posts` VALUES ('2', '2', '2', 'jajajajajajaj', 'ajajajajajajajjaaaaaaaaaaaaaaaaaaaa', '1274461704', '0', '0', '0', '9', '46', '0', 'asasasasas,sasasaaaa,asassssss,sssssss', '9', '0', '0', '0');
INSERT INTO `posts` VALUES ('3', '0', '1', 'no se permite comentariosss', 'no se permite comentariosssno se permite comentariosssno se permite comentariosssno se permite comentariosssno se permite comentariosss ^^ ', '1274651186', '0', '1', '0', '10', '26', '0', 'nohay,coments,jejeejj,otros', '7', '0', '0', '0');
INSERT INTO `posts` VALUES ('4', '0', '3', 'hhhhhhhhhhhh', 'hhhhhhhhhhhhhh', '1275182835', '1', '1', '0', '0', '23', '0', 'hhhhh,fghfghfg,gfhfghgg,ggggg', '7', '1', '1', '0');

-- ----------------------------
-- Table structure for `puntos`
-- ----------------------------
DROP TABLE IF EXISTS `puntos`;
CREATE TABLE `puntos` (
  `postid` int(11) NOT NULL default '0',
  `userid` int(11) NOT NULL default '0',
  `id_receptor` int(11) NOT NULL default '0',
  `puntos` int(11) NOT NULL default '0',
  `fecha` int(11) NOT NULL default '1260823886'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of puntos
-- ----------------------------

-- ----------------------------
-- Table structure for `rangos`
-- ----------------------------
DROP TABLE IF EXISTS `rangos`;
CREATE TABLE `rangos` (
  `rango` tinyint(2) NOT NULL,
  `nom_rango` varchar(80) NOT NULL,
  `img_rango` text NOT NULL,
  `puntos_pordia` smallint(5) NOT NULL,
  `maxpuntos` mediumint(9) NOT NULL,
  `permisos` text NOT NULL,
  PRIMARY KEY  (`rango`)
) ENGINE=MyISAM AUTO_INCREMENT=256 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rangos
-- ----------------------------
INSERT INTO `rangos` VALUES ('127', 'Administrador', '-704px; clip:rect(704px 16px 720', '40', '-1', 'a:22:{s:12:\"acceso_admin\";i:1;s:10:\"acceso_mod\";i:1;s:7:\"crear_c\";i:1;s:8:\"numero_c\";i:5;s:8:\"editar_c\";i:1;s:10:\"eliminar_c\";i:1;s:8:\"editar_t\";i:1;s:10:\"eliminar_t\";i:1;s:11:\"elimcomen_t\";i:1;s:6:\"rest_t\";i:1;s:8:\"editar_p\";i:1;s:10:\"eliminar_p\";i:1;s:11:\"elimcomen_p\";i:1;s:8:\"coment_p\";i:1;s:10:\"darpunto_p\";i:1;s:6:\"rest_p\";i:1;s:7:\"crear_u\";i:1;s:8:\"editar_u\";i:1;s:10:\"eliminar_u\";i:1;s:11:\"suspender_u\";i:1;s:11:\"editarnom_r\";i:1;s:9:\"cambiar_r\";i:1;}');
INSERT INTO `rangos` VALUES ('100', 'Moderador', '-704px; clip:rect(704px 16px 720', '35', '-1', 'a:22:{s:12:\"acceso_admin\";i:0;s:10:\"acceso_mod\";i:1;s:7:\"crear_c\";i:1;s:8:\"numero_c\";i:5;s:8:\"editar_c\";i:1;s:10:\"eliminar_c\";i:1;s:8:\"editar_t\";i:1;s:10:\"eliminar_t\";i:1;s:11:\"elimcomen_t\";i:1;s:6:\"rest_t\";i:1;s:8:\"editar_p\";i:1;s:10:\"eliminar_p\";i:1;s:11:\"elimcomen_p\";i:1;s:8:\"coment_p\";i:1;s:10:\"darpunto_p\";i:1;s:6:\"rest_p\";i:1;s:7:\"crear_u\";i:0;s:8:\"editar_u\";i:0;s:10:\"eliminar_u\";i:0;s:11:\"suspender_u\";i:1;s:11:\"editarnom_r\";i:0;s:9:\"cambiar_r\";i:0;}');
INSERT INTO `rangos` VALUES ('50', 'Patrocinador', '-945px; clip: rect(945px, 16px, 961', '100', '-1', 'a:22:{s:12:\"acceso_admin\";i:0;s:10:\"acceso_mod\";i:0;s:7:\"crear_c\";i:1;s:8:\"numero_c\";i:5;s:8:\"editar_c\";i:0;s:10:\"eliminar_c\";i:0;s:8:\"editar_t\";i:0;s:10:\"eliminar_t\";i:0;s:11:\"elimcomen_t\";i:0;s:6:\"rest_t\";i:0;s:8:\"editar_p\";i:0;s:10:\"eliminar_p\";i:0;s:11:\"elimcomen_p\";i:0;s:8:\"coment_p\";i:1;s:10:\"darpunto_p\";i:1;s:6:\"rest_p\";i:0;s:7:\"crear_u\";i:0;s:8:\"editar_u\";i:0;s:10:\"eliminar_u\";i:0;s:11:\"suspender_u\";i:0;s:11:\"editarnom_r\";i:0;s:9:\"cambiar_r\";i:0;}');
INSERT INTO `rangos` VALUES ('14', 'Great User', '-682px; clip: rect(682px, 16px, 698', '17', '800', 'a:22:{s:12:\"acceso_admin\";i:0;s:10:\"acceso_mod\";i:0;s:7:\"crear_c\";i:1;s:8:\"numero_c\";i:4;s:8:\"editar_c\";i:0;s:10:\"eliminar_c\";i:0;s:8:\"editar_t\";i:0;s:10:\"eliminar_t\";i:0;s:11:\"elimcomen_t\";i:0;s:6:\"rest_t\";i:0;s:8:\"editar_p\";i:0;s:10:\"eliminar_p\";i:0;s:11:\"elimcomen_p\";i:0;s:8:\"coment_p\";i:1;s:10:\"darpunto_p\";i:1;s:6:\"rest_p\";i:0;s:7:\"crear_u\";i:0;s:8:\"editar_u\";i:0;s:10:\"eliminar_u\";i:0;s:11:\"suspender_u\";i:0;s:11:\"editarnom_r\";i:0;s:9:\"cambiar_r\";i:0;}');
INSERT INTO `rangos` VALUES ('13', 'Full User', '-110px; clip: rect(110px, 16px, 126', '12', '500', 'a:22:{s:12:\"acceso_admin\";i:0;s:10:\"acceso_mod\";i:0;s:7:\"crear_c\";i:1;s:8:\"numero_c\";i:3;s:8:\"editar_c\";i:0;s:10:\"eliminar_c\";i:0;s:8:\"editar_t\";i:0;s:10:\"eliminar_t\";i:0;s:11:\"elimcomen_t\";i:0;s:6:\"rest_t\";i:0;s:8:\"editar_p\";i:0;s:10:\"eliminar_p\";i:0;s:11:\"elimcomen_p\";i:0;s:8:\"coment_p\";i:1;s:10:\"darpunto_p\";i:1;s:6:\"rest_p\";i:0;s:7:\"crear_u\";i:0;s:8:\"editar_u\";i:0;s:10:\"eliminar_u\";i:0;s:11:\"suspender_u\";i:0;s:11:\"editarnom_r\";i:0;s:9:\"cambiar_r\";i:0;}');
INSERT INTO `rangos` VALUES ('12', 'New Full User', '-660px; clip:rect(660px 16px 676', '10', '50', 'a:22:{s:12:\"acceso_admin\";i:0;s:10:\"acceso_mod\";i:0;s:7:\"crear_c\";i:1;s:8:\"numero_c\";i:2;s:8:\"editar_c\";i:0;s:10:\"eliminar_c\";i:0;s:8:\"editar_t\";i:0;s:10:\"eliminar_t\";i:0;s:11:\"elimcomen_t\";i:0;s:6:\"rest_t\";i:0;s:8:\"editar_p\";i:0;s:10:\"eliminar_p\";i:0;s:11:\"elimcomen_p\";i:0;s:8:\"coment_p\";i:1;s:10:\"darpunto_p\";i:1;s:6:\"rest_p\";i:0;s:7:\"crear_u\";i:0;s:8:\"editar_u\";i:0;s:10:\"eliminar_u\";i:0;s:11:\"suspender_u\";i:0;s:11:\"editarnom_r\";i:0;s:9:\"cambiar_r\";i:0;}');
INSERT INTO `rangos` VALUES ('11', 'Novato', '-638px; clip:rect(638px 17px 654', '0', '0', 'a:22:{s:12:\"acceso_admin\";i:0;s:10:\"acceso_mod\";i:0;s:7:\"crear_c\";i:0;s:8:\"numero_c\";i:0;s:8:\"editar_c\";i:0;s:10:\"eliminar_c\";i:0;s:8:\"editar_t\";i:0;s:10:\"eliminar_t\";i:0;s:11:\"elimcomen_t\";i:0;s:6:\"rest_t\";i:0;s:8:\"editar_p\";i:0;s:10:\"eliminar_p\";i:0;s:11:\"elimcomen_p\";i:0;s:8:\"coment_p\";i:0;s:10:\"darpunto_p\";i:0;s:6:\"rest_p\";i:0;s:7:\"crear_u\";i:0;s:8:\"editar_u\";i:0;s:10:\"eliminar_u\";i:0;s:11:\"suspender_u\";i:0;s:11:\"editarnom_r\";i:0;s:9:\"cambiar_r\";i:0;}');

-- ----------------------------
-- Table structure for `seguidores`
-- ----------------------------
DROP TABLE IF EXISTS `seguidores`;
CREATE TABLE `seguidores` (
  `segid` int(11) NOT NULL auto_increment,
  `userid` int(11) NOT NULL,
  `type` text NOT NULL,
  `obj` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY  (`segid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED;

-- ----------------------------
-- Records of seguidores
-- ----------------------------
INSERT INTO `seguidores` VALUES ('1', '3', 'user', '1', '1278624356');

-- ----------------------------
-- Table structure for `usuarios`
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `userid` int(11) NOT NULL auto_increment,
  `id_zinfinal` varchar(40) NOT NULL default '',
  `estado` tinyint(2) NOT NULL default '0',
  `nick` varchar(20) NOT NULL default '',
  `password` varchar(40) NOT NULL default '',
  `email` varchar(45) NOT NULL,
  `pais` varchar(5) NOT NULL default '0',
  `provincia` tinyint(1) NOT NULL default '0',
  `ciudad` varchar(55) NOT NULL default '0',
  `rango` tinyint(2) NOT NULL,
  `puntos` int(11) NOT NULL default '0',
  `nombre` varchar(40) NOT NULL default '',
  `avatar` varchar(160) NOT NULL,
  `puntosdar` int(11) NOT NULL default '0',
  `sexo` tinytext NOT NULL,
  `dia` tinyint(4) NOT NULL default '0',
  `mes` tinyint(4) NOT NULL default '0',
  `ano` smallint(6) NOT NULL default '0',
  `fecha` int(11) NOT NULL,
  `numposts` bigint(20) NOT NULL default '0',
  `numcomentarios` bigint(20) NOT NULL default '0',
  `ultimaaccion` int(11) NOT NULL,
  `ultimaip` varchar(255) NOT NULL,
  `ultimaaccion2` int(11) NOT NULL,
  `opciones` varchar(15) NOT NULL,
  `bloqueados` text NOT NULL,
  `conectado` tinyint(2) NOT NULL,
  `follow` int(11) NOT NULL,
  PRIMARY KEY  (`userid`),
  KEY `id` USING BTREE (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES ('1', '06f5fb8d7d27b05539152fb454c5e688', '1', 'zinfinal', '5366bef809ba3609a408331836bc9bba', 'latinlover_121@hotmail.com', 'PE', '23', 'Tacna', '127', '18', 'Harold22', 'http://i48.tinypic.com/2a5axqa.jpg', '0', 'm', '14', '11', '1991', '1273869220', '2', '2', '1279396421', '127.0.0.1', '1274986304', 'on,on,on,', 'a:1:{i:3;a:2:{s:2:\"id\";s:1:\"3\";s:4:\"nick\";s:5:\"pacha\";}}', '0', '0');
INSERT INTO `usuarios` VALUES ('2', '3d476666221ff99f653860269d99dd54', '1', 'harold', '5366bef809ba3609a408331836bc9bba', 'pacha@hotmail.com', 'NE', '23', '', '127', '50', 'Harold Pacha', 'http://i48.tinypic.com/2a5axqa.jpg', '2', 'm', '13', '9', '1981', '1273873290', '1', '5', '1278624141', '127.0.0.1', '1277534962', 'on,on,on,on', '', '0', '0');
INSERT INTO `usuarios` VALUES ('3', '1d97322790ef0ffe5aaf97afc04fe3e1', '1', 'pacha', 'c57f431343f100b441e268cc12babc34', 'harold@hotmail.com', 'NE', '0', 'undefined', '127', '50', '', 'http://i48.tinypic.com/2a5axqa.jpg', '0', 'm', '12', '8', '1980', '1273873452', '1', '1', '1278624356', '127.0.0.1', '1275182835', '', '', '0', '0');
INSERT INTO `usuarios` VALUES ('4', '97ec3bbfe7994579cb7f12bfb3f7b0f7', '0', 'zinfinal2', '25f9e794323b453885f5181f1b624d0b', 'adsadasdasd@adasdas.com', 'PE', '23', '3928128', '11', '0', '', '', '0', 'm', '13', '10', '0', '1279931028', '0', '0', '0', '', '0', '', '', '0', '0');
INSERT INTO `usuarios` VALUES ('5', '4a6c4d9700867f6d2bc2b8c0a7bbd8e6', '0', 'josefano', '25f9e794323b453885f5181f1b624d0b', 'josefano@hotmail.com', 'AR', '1', '3435910', '11', '0', '', '', '0', 'm', '4', '3', '0', '1279931439', '0', '0', '0', '', '0', '', '', '0', '0');
INSERT INTO `usuarios` VALUES ('6', '91f695790547f191a22ed8a1db92fca6', '0', 'jose', '25f9e794323b453885f5181f1b624d0b', 'jose@dasfdsf.com', 'UY', '10', '3439706', '11', '0', '', '', '0', 'm', '26', '10', '0', '1279931710', '0', '0', '0', '', '0', '', '', '0', '0');

-- ----------------------------
-- Table structure for `usuarios_fotos`
-- ----------------------------
DROP TABLE IF EXISTS `usuarios_fotos`;
CREATE TABLE `usuarios_fotos` (
  `fotoid` int(11) unsigned NOT NULL auto_increment,
  `userid` int(11) NOT NULL,
  `imagen` text,
  `descripcion` varchar(200) NOT NULL,
  PRIMARY KEY  (`fotoid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of usuarios_fotos
-- ----------------------------
INSERT INTO `usuarios_fotos` VALUES ('1', '1', 'http://i43.tinypic.com/90byoj.jpg', 'ssssss');

-- ----------------------------
-- Table structure for `usuarios_perfil`
-- ----------------------------
DROP TABLE IF EXISTS `usuarios_perfil`;
CREATE TABLE `usuarios_perfil` (
  `userid` int(11) NOT NULL auto_increment,
  `mensaje` varchar(50) NOT NULL,
  `sitio` varchar(50) NOT NULL,
  `im_tipo` varchar(5) NOT NULL,
  `im` varchar(50) NOT NULL,
  `me_gustaria_amigos` tinyint(1) NOT NULL,
  `me_gustaria_conocer_gente` tinyint(1) NOT NULL,
  `me_gustaria_conocer_gente_negocios` tinyint(1) NOT NULL,
  `me_gustaria_encontrar_pareja` tinyint(1) NOT NULL,
  `me_gustaria_de_todo` tinyint(1) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `hijos` varchar(50) NOT NULL,
  `vivo` varchar(50) NOT NULL,
  `altura` varchar(3) NOT NULL,
  `peso` varchar(3) NOT NULL,
  `pelo_color` varchar(25) NOT NULL,
  `ojos_color` varchar(25) NOT NULL,
  `fisico` varchar(25) NOT NULL,
  `dieta` varchar(25) NOT NULL,
  `tengo_tatuajes` tinyint(1) NOT NULL,
  `tengo_piercings` tinyint(1) NOT NULL,
  `fumo` varchar(25) NOT NULL,
  `tomo_alcohol` varchar(25) NOT NULL,
  `estudios` varchar(25) NOT NULL,
  `idioma_castellano` varchar(12) NOT NULL,
  `idioma_ingles` varchar(12) NOT NULL,
  `idioma_portugues` varchar(12) NOT NULL,
  `idioma_frances` varchar(12) NOT NULL,
  `idioma_italiano` varchar(12) NOT NULL,
  `idioma_aleman` varchar(12) NOT NULL,
  `idioma_otro` varchar(12) NOT NULL,
  `profesion` varchar(30) NOT NULL,
  `empresa` varchar(30) NOT NULL,
  `sector` tinyint(8) NOT NULL,
  `ingresos` varchar(12) NOT NULL,
  `intereses_profesionales` varchar(50) NOT NULL,
  `habilidades_profesionales` varchar(50) NOT NULL,
  `mis_intereses` varchar(50) NOT NULL,
  `hobbies` varchar(50) NOT NULL,
  `series_tv_favoritas` varchar(50) NOT NULL,
  `musica_favorita` varchar(50) NOT NULL,
  `deportes_y_equipos_favoritos` varchar(50) NOT NULL,
  `libros_favoritos` varchar(50) NOT NULL,
  `peliculas_favoritas` varchar(50) NOT NULL,
  `comida_favorita` varchar(50) NOT NULL,
  `mis_heroes_son` varchar(50) NOT NULL,
  `candado` text NOT NULL,
  PRIMARY KEY  (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of usuarios_perfil
-- ----------------------------
INSERT INTO `usuarios_perfil` VALUES ('1', 'que viva zinfinal!!!!!!!', 'http://www.zinfina.org', 'msn', 'latinlover_121@hotmail.com', '0', '0', '0', '0', '0', 'soltero', 'no', 'padres', '1.7', 'hhh', '', '', '', '', '1', '1', '', '', '', '', '', '', '', '', '', '', '', '', '0', '', '', '', '', '', '', '', '', '', '', '', 'Goku', '');
INSERT INTO `usuarios_perfil` VALUES ('2', '', '', 'msn', '', '1', '1', '1', '1', '1', '', '', '', '', '', '', '', '', '', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '0', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `usuarios_perfil` VALUES ('3', '', '', '', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '0', '', '', '', '', '', '', '', '', '', '', '', '', '');
