<?php

require_once "conexion.php";

class ModeloDeps{

	/*=============================================
	CREAR ROL
	=============================================*/

	static public function mdlIngresarDep($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nomDepartamento) VALUES (:nomDep)");

		$stmt->bindParam(":nomDep", $datos, PDO::PARAM_STR);

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

	static public function mdlMostrarDeps($tabla, $item, $valor){

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

	static public function mdlEditarDep($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nomDepartamento = :nomDep WHERE idDepartamento = :idDep");

		$stmt -> bindParam(":nomDep", $datos["nomDep"], PDO::PARAM_STR);
		$stmt -> bindParam(":idDep", $datos["idDep"], PDO::PARAM_INT);
		
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

	static public function mdlBorrarDep($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idDepartamento = :idDep");

		var_dump($stmt);

		$stmt -> bindParam(":idDep", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt = null;

	}

}

