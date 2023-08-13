<?php

require_once "conexion.php";

class ModeloRoles{

	/*=============================================
	CREAR ROL
	=============================================*/

	static public function mdlIngresarRol($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nomRol, desRol) VALUES (:nomRol, :desRol)");

		$stmt->bindParam(":nomRol", $datos["nomRol"], PDO::PARAM_STR);
		$stmt->bindParam(":desRol", $datos["desRol"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt = null;

	}

	/*=============================================
	MOSTRAR ROL
	=============================================*/

	static public function mdlMostrarRoles($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}



		$stmt = null;

	}

	/*=============================================
	EDITAR CATEGORIA
	=============================================*/

	static public function mdlEditarRol($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nomRol = :nomRol, desRol = :desRol WHERE idRol = :idRol");

		$stmt -> bindParam(":nomRol", $datos["nomRol"], PDO::PARAM_STR);
		$stmt -> bindParam(":desRol", $datos["desRol"], PDO::PARAM_STR);
		$stmt -> bindParam(":idRol", $datos["idRol"], PDO::PARAM_INT);
		
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt = null;

	}

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function mdlBorrarRol($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idRol = :idRol");

		$stmt -> bindParam(":idRol", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}


		$stmt = null;

	}

}

