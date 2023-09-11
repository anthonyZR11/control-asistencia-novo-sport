/*
MySQL Backup
Source Server Version: 5.5.5
Source Database: novo_sport
Date: 10/09/2023 21:31:44
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
--  Table structure for `adelanto`
-- ----------------------------
DROP TABLE IF EXISTS `adelanto`;
CREATE TABLE `adelanto` (
  `idAdelanto` int(11) NOT NULL AUTO_INCREMENT,
  `cantAdelanto` decimal(18,2) DEFAULT NULL,
  `descAdelanto` text DEFAULT NULL,
  `fechaAdelanto` date DEFAULT NULL,
  `idEmpleado` int(11) DEFAULT NULL,
  PRIMARY KEY (`idAdelanto`),
  KEY `idEmpleado` (`idEmpleado`),
  CONSTRAINT `adelanto_ibfk_1` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`idEmpleado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
--  Table structure for `asistencia`
-- ----------------------------
DROP TABLE IF EXISTS `asistencia`;
CREATE TABLE `asistencia` (
  `idAsistencia` int(11) NOT NULL AUTO_INCREMENT,
  `idEmpleado` int(11) DEFAULT NULL,
  `fecAsistencia` datetime DEFAULT NULL,
  `ingAsistencia` time DEFAULT NULL,
  `salAsistencia` time DEFAULT NULL,
  `estadoAsistencia` int(11) DEFAULT NULL,
  PRIMARY KEY (`idAsistencia`),
  KEY `idEmpleado` (`idEmpleado`),
  CONSTRAINT `asistencia_ibfk_1` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`idEmpleado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
--  Table structure for `departamento`
-- ----------------------------
DROP TABLE IF EXISTS `departamento`;
CREATE TABLE `departamento` (
  `idDepartamento` int(11) NOT NULL AUTO_INCREMENT,
  `nomDepartamento` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`idDepartamento`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
--  Table structure for `empleado`
-- ----------------------------
DROP TABLE IF EXISTS `empleado`;
CREATE TABLE `empleado` (
  `idEmpleado` int(11) NOT NULL AUTO_INCREMENT,
  `nomEmpleado` varchar(60) DEFAULT NULL,
  `apeEmpleado` varchar(60) DEFAULT NULL,
  `celEmpleado` int(9) DEFAULT NULL,
  `dirEmpleado` text DEFAULT NULL,
  `docIdentEmpleado` int(8) DEFAULT NULL,
  `emailEmpleado` varchar(60) DEFAULT NULL,
  `fechaNacEmpleado` date DEFAULT NULL,
  `fotoEmpleado` text DEFAULT NULL,
  `genEmpleado` varchar(30) DEFAULT NULL,
  `idDepartamento` int(11) DEFAULT NULL,
  `idHorario` int(11) DEFAULT NULL,
  `fecIngEmpleado` date DEFAULT NULL,
  PRIMARY KEY (`idEmpleado`),
  KEY `idDepartamento` (`idDepartamento`),
  KEY `idHorario` (`idHorario`),
  CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`idDepartamento`) REFERENCES `departamento` (`idDepartamento`),
  CONSTRAINT `empleado_ibfk_2` FOREIGN KEY (`idHorario`) REFERENCES `horario` (`idHorario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
--  Table structure for `horario`
-- ----------------------------
DROP TABLE IF EXISTS `horario`;
CREATE TABLE `horario` (
  `idHorario` int(11) NOT NULL AUTO_INCREMENT,
  `horaIngreso` time DEFAULT NULL,
  `horaSalida` time DEFAULT NULL,
  PRIMARY KEY (`idHorario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
--  Table structure for `rol`
-- ----------------------------
DROP TABLE IF EXISTS `rol`;
CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL AUTO_INCREMENT,
  `nomRol` varchar(60) DEFAULT NULL,
  `desRol` text DEFAULT NULL,
  PRIMARY KEY (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
--  Table structure for `usuario`
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) DEFAULT NULL,
  `nomUsuario` varchar(60) DEFAULT NULL,
  `conUsuario` varchar(80) DEFAULT NULL,
  `idRol` int(11) DEFAULT NULL,
  `fotoUsuario` text DEFAULT NULL,
  `estadoUsuario` int(11) DEFAULT NULL,
  `fechaRegistroUsuario` datetime DEFAULT NULL,
  `ultimoLoginUsuario` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idUsuario`),
  KEY `idRol` (`idRol`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
--  Records 
-- ----------------------------
INSERT INTO `departamento` VALUES ('1','ventas'), ('2',NULL);
INSERT INTO `empleado` VALUES ('2','anthony','zavaleta','51','qef','73992723','anthony@gmail.com','0000-00-00','','1','1','1','2023-09-10');
INSERT INTO `horario` VALUES ('1','08:00:00','22:00:00');
INSERT INTO `rol` VALUES ('1','admin','admin'), ('2','empleado','empleado');
INSERT INTO `usuario` VALUES ('1','tony','tony@gmail.com','$2a$07$asxx54ahjppf45sd87a5auGZEtGHuyZwm.Ur.FJvWLCql3nmsMbXy','1','a','1','2023-09-10 20:43:53','2023-09-10 21:07:02');
