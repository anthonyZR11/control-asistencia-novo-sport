<?php

require_once "conexion.php";

class ModeloEmpleados{

	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/

	static public function mdlMostrarEmpleados($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT idEmpleado,docIdentEmpleado,e.idDepartamento,fotoEmpleado,nomEmpleado,apeEmpleado,dirEmpleado,emailEmpleado,fechaNacEmpleado,genEmpleado ,d.nomDepartamento,h.horaIngreso , h.horaSalida,celEmpleado,fecIngEmpleado FROM $tabla AS e INNER JOIN departamento as d ON e.idDepartamento = d.idDepartamento INNER JOIN horario as h ON e.idHorario = h.idHorario WHERE $item = :$item");


			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT idEmpleado, docIdentEmpleado,fotoEmpleado,nomEmpleado,apeEmpleado,d.nomDepartamento,h.horaIngreso,genEmpleado , h.horaSalida,celEmpleado,fecIngEmpleado FROM $tabla AS e INNER JOIN departamento as d ON e.idDepartamento = d.idDepartamento INNER JOIN horario as h ON e.idHorario = h.idHorario");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		


		$stmt = null;

	}

static public function mdlMostrarEmpleados2($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");


			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}

		$stmt = null;

	}


/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	static public function mdlIngresarEmpleado($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nomEmpleado, apeEmpleado, celEmpleado, dirEmpleado, docIdentEmpleado, emailEmpleado, fechaNacEmpleado, fotoEmpleado, genEmpleado, idDepartamento, idHorario, fecIngEmpleado) VALUES (:nombre, :apellido, :cel, :dir, :dni, :email, :cumple, :fotoEmpleado, :sexo, :idDep, :idHora, NOW())");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
		$stmt->bindParam(":cel", $datos["cel"], PDO::PARAM_INT);
		$stmt->bindParam(":dir", $datos["dir"], PDO::PARAM_STR);
		$stmt->bindParam(":dni", $datos["dni"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":cumple", $datos["cumple"], PDO::PARAM_STR);
		$stmt->bindParam(":fotoEmpleado", $datos["fotoEmpleado"], PDO::PARAM_STR);
		$stmt->bindParam(":sexo", $datos["sexo"], PDO::PARAM_INT);
		$stmt->bindParam(":idDep", $datos["idDep"], PDO::PARAM_INT);
		$stmt->bindParam(":idHora", $datos["idHora"], PDO::PARAM_INT);


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

	static public function mdlEditarEmpleado($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nomEmpleado = :nombre, apeEmpleado = :apellido, celEmpleado = :cel, dirEmpleado = :dir, docIdentEmpleado = :dni, emailEmpleado = :email, fechaNacEmpleado = :cumple, fotoEmpleado = :fotoEmpleado, genEmpleado = :sexo, idDepartamento = :idDep, idHorario = :idHora  WHERE idEmpleado = :id AND docIdentEmpleado = :dni");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
		$stmt->bindParam(":cel", $datos["cel"], PDO::PARAM_INT);
		$stmt->bindParam(":dir", $datos["dir"], PDO::PARAM_STR);
		$stmt->bindParam(":dni", $datos["dni"], PDO::PARAM_INT);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":cumple", $datos["cumple"], PDO::PARAM_STR);
		$stmt->bindParam(":fotoEmpleado", $datos["fotoEmpleado"], PDO::PARAM_STR);
		$stmt->bindParam(":sexo", $datos["sexo"], PDO::PARAM_INT);
		$stmt->bindParam(":idDep", $datos["idDep"], PDO::PARAM_INT);
		$stmt->bindParam(":idHora", $datos["idHora"], PDO::PARAM_INT);
	
		

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

	static public function mdlBorrarEmpleado($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idEmpleado = :idEmpleado AND docIdentEmpleado = :docEmpleado");

		$stmt -> bindParam(":idEmpleado", $datos["idEmpleado"], PDO::PARAM_INT);
		$stmt -> bindParam(":docEmpleado", $datos["docEmpleado"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt = null;


	}

}

