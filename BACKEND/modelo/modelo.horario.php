<?php

require_once "conexion.php";

class ModeloHorarios{

	/*=============================================
	CREAR ROL
	=============================================*/

	static public function mdlIngresarHorario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(horaIngreso, horaSalida) VALUES (:horaIn, :horaSal)");

		

		$stmt->bindParam(":horaIn", $datos["horaIn"], PDO::PARAM_STR);
		$stmt->bindParam(":horaSal", $datos["horaSal"], PDO::PARAM_STR);
		var_dump($stmt);
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

	static public function mdlMostrarHorarios($tabla, $item, $valor){

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

	static public function mdlMostrarHorarioEmpleados($tabla, $item, $valor){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla as h INNER JOIN empleado AS e ON h.idHorario = e.idHorario INNER JOIN departamento AS d ON e.idDepartamento = d.idDepartamento");

			$stmt -> execute();

			return $stmt -> fetchAll();


		$stmt = null;

	}

	/*=============================================
	EDITAR CATEGORIA
	=============================================*/

	static public function mdlEditarHora($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET horaIngreso = :horaIn, horaSalida = :horaSal WHERE idHorario = :idHorario");

		$stmt -> bindParam(":horaIn", $datos["horaIn"], PDO::PARAM_STR);
		$stmt -> bindParam(":horaSal", $datos["horaSal"], PDO::PARAM_STR);
		$stmt -> bindParam(":idHorario", $datos["idHorario"], PDO::PARAM_INT);
		
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

	static public function mdlBorrarHorario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idHorario = :idHora");

		$stmt -> bindParam(":idHora", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}


		$stmt = null;

	}

}

