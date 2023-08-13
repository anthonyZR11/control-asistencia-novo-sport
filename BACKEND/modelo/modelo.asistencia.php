<?php

require_once "conexion.php";

class ModeloAsistencias{

	/*=============================================
	CREAR ASISTENCIA
	=============================================*/

	static public function mdlCrearAsistencia($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idEmpleado, fecAsistencia,ingAsistencia,estadoAsistencia, salAsistencia) VALUES (:idEmpleado, :fecha, :horaIn, :estado, :horaSal)");

		$stmt->bindParam(":idEmpleado", $datos["idEmpleado"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":horaIn", $datos["horaIn"], PDO::PARAM_STR);
		$stmt->bindParam(":horaSal", $datos["horaSal"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
		

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		
		$stmt = null;

	}

	/*=============================================
	MOSTRAR ASISTENCIA
	=============================================*/

	static public function mdlMostrarAsistencias($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla AS a INNER JOIN empleado AS e ON a.idEmpleado = e.idEmpleado WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT *, empleado.idEmpleado AS e, asistencia.idAsistencia AS a FROM asistencia LEFT JOIN empleado ON empleado.idEmpleado =asistencia.idEmpleado ORDER BY asistencia.fecAsistencia DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		

		$stmt = null;

	}


	static public function mdlMostrarAsistencias2($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla  WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}
	}	
	

	static public function mdlMostrarUltimaAsistencia($tabla){


			$stmt = Conexion::conectar()->prepare("SELECT MAX(idAsistencia) AS idAsistencia FROM asistencia");

			$stmt -> execute();

			return $stmt -> fetch();

			

			$stmt = null;

	}




	static public function mdlCompararAsistencia($tabla,$item1,$valor1,$item2,$valor2){

		if($item1 != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 = :$item1 AND $item2 = :$item2");

			$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		    $stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}

		

		$stmt = null;

	}



	static public function mdlComprobarHora($tabla2,$item1,$valor1){

		if($item1 != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla2 LEFT JOIN empleado ON horario.idHorario = empleado.idHorario WHERE $item1 = :$item1");

			$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}

		

		$stmt = null;

	}

	/*=============================================
	EDITAR ASISTENCIA
	=============================================*/

	static public function mdlEditarAsistencia($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET fecAsistencia = :fecha, ingAsistencia = :ingreso, salAsistencia = :salida WHERE idAsistencia = :idAsistencia");

		$stmt -> bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt -> bindParam(":ingreso", $datos["ingreso"], PDO::PARAM_STR);
		$stmt -> bindParam(":salida", $datos["salida"], PDO::PARAM_STR);
		$stmt -> bindParam(":idAsistencia", $datos["idAsistencia"], PDO::PARAM_INT);

		var_dump($datos);
		
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		
		$stmt = null;

	}

	static public function mdlActualizarHora($tabla, $datos2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET cantHoraAsistencia = :horas WHERE idAsistencia = :idAsistencia");
		
		$stmt->bindParam(":horas", $datos2["horas"], PDO::PARAM_STR);
		$stmt -> bindParam(":idAsistencia", $datos2["idAsistencia"], PDO::PARAM_INT);
		
		
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		
		$stmt = null;

	}

	static public function mdlActualizarHoraEstado($tabla, $datos2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET cantHoraAsistencia = :horas, estadoAsistencia = :estado WHERE idAsistencia = :idAsistencia");
		
		$stmt->bindParam(":horas", $datos2["horas"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos2["estado"], PDO::PARAM_INT);
		$stmt -> bindParam(":idAsistencia", $datos2["idAsistencia"], PDO::PARAM_INT);
		

		
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

	static public function mdlBorrarAsistencia($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idAsistencia = :idAsistencia");

		$stmt -> bindParam(":idAsistencia", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		

		$stmt = null;

	}

	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasAsistencias($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT *, empleado.idEmpleado AS e, asistencia.idAsistencia AS a FROM $tabla INNER JOIN empleado ON empleado.idEmpleado =$tabla.idEmpleado ORDER BY idAsistencia ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT *, empleado.idEmpleado AS e, asistencia.idAsistencia AS a FROM $tabla INNER JOIN empleado ON empleado.idEmpleado =$tabla.idEmpleado WHERE fecAsistencia like '%$fechaFinal%'");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT *, empleado.idEmpleado AS e, asistencia.idAsistencia AS a FROM $tabla INNER JOIN empleado ON empleado.idEmpleado =$tabla.idEmpleado WHERE fecAsistencia BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT *, empleado.idEmpleado AS e, asistencia.idAsistencia AS a FROM $tabla INNER JOIN empleado ON empleado.idEmpleado =$tabla.idEmpleado WHERE fecAsistencia BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

}

