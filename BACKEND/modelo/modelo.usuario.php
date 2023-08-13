<?php

require_once "conexion.php";

class ModeloUsuarios{

	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/

	static public function mdlMostrarUsuarios($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT u.idUsuario,u.nomUsuario,u.nombre,u.conUsuario,u.idRol,u.fotoUsuario,u.estadoUsuario,u.estadoUsuario,u.fechaRegistroUsuario,u.ultimoLoginUsuario,r.idRol, r.nomRol, r.desRol FROM $tabla as u JOIN rol as r on u.idRol = r.idRol WHERE $item = :$item");


			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla INNER JOIN rol ON $tabla.idRol = rol.idRol");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		
		$stmt = null;

	}

	static public function mdlMostrarUsuarios2($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");


			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}
	}


	static public function mdlMostrarUsuarioActual($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT r.idRol, r.nomRol FROM $tabla as u JOIN rol as r on u.idRol = r.idRol WHERE $item = :$item");


			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}
		

		$stmt = null;

	}





/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	static public function mdlIngresarUsuario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, nomUsuario, conUsuario, idRol, fotoUsuario, fechaRegistroUsuario) VALUES (:nombre, :nomUsuario, :conUsuario, :idRol, :fotoUsuario, NOW())");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":nomUsuario", $datos["nomUsuario"], PDO::PARAM_STR);
		$stmt->bindParam(":conUsuario", $datos["conUsuario"], PDO::PARAM_STR);
		$stmt->bindParam(":idRol", $datos["idRol"], PDO::PARAM_INT);
		$stmt->bindParam(":fotoUsuario", $datos["fotoUsuario"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}
		
		$stmt = null;

	}

	/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function mdlEditarUsuario($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, conUsuario = :conUsuario, idRol = :idRol, fotoUsuario = :fotoUsuario WHERE nomUsuario = :nomUsuario");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":nomUsuario", $datos["nomUsuario"], PDO::PARAM_STR);
		$stmt->bindParam(":conUsuario", $datos["conUsuario"], PDO::PARAM_STR);
		$stmt->bindParam(":idRol", $datos["idRol"], PDO::PARAM_INT);
		$stmt->bindParam(":fotoUsuario", $datos["fotoUsuario"], PDO::PARAM_STR);
	
		

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt = null;

	}











	/*=============================================
	ACTUALIZAR USUARIO
	=============================================*/

	static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt = null;

	}

	/*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function mdlBorrarUsuario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idUsuario = :idUsuario");

		$stmt -> bindParam(":idUsuario", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt = null;


	}

}

