<?php

require_once "conexion.php";

class ModeloAdelantos{

	/*=============================================
	CREAR ROL
	=============================================*/

	static public function mdlIngresarAdelanto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idEmpleado, cantAdelanto, descAdelanto, fechaAdelanto) VALUES (:idEmpleado, :cantidad, :descripcion, NOW())");

		$stmt->bindParam(":idEmpleado", $datos["idEmpleado"], PDO::PARAM_INT);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);

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

	static public function mdlMostrarAdelantos($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla as a INNER JOIN empleado as e ON a.idEmpleado=e.idEmpleado WHERE a.idAdelanto  = :$item");

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
	MOSTRAR ROL
	=============================================*/

	static public function mdlMostrarAdelantos3($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}
	}

	static public function mdlMostrarAdelantos2($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM empleado  WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla as a INNER JOIN empleado as e ON a.idEmpleado = e.idEmpleado");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt = null;

	}

	

	/*=============================================
	EDITAR CATEGORIA
	=============================================*/

	static public function mdlEditarAdelanto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET cantAdelanto = :cantidad, descAdelanto = :descripcion WHERE idAdelanto = :idAdelanto");

		$stmt -> bindParam(":idAdelanto", $datos["idAdelanto"], PDO::PARAM_INT);
		$stmt -> bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		
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

	static public function mdlBorrarAdelanto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idAdelanto = :idAdelanto");

		$stmt -> bindParam(":idAdelanto", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt = null;

	}

}

