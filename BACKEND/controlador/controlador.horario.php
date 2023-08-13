<?php

class ControladorHorarios{

	/*=============================================
	CREAR ROLES
	=============================================*/

	static public function ctrCrearHorario(){

		if(isset($_POST["nuevaHoraIn"])){

			if(isset($_POST["nuevaHoraIn"])){

				$tabla = "horario";

				$time_in = $_POST["nuevaHoraIn"];

				$time_in = date('H:i:s', strtotime($time_in));

				$time_out = $_POST["nuevaHoraSal"];

				$time_out = date('H:i:s', strtotime($time_out));

				$datos = array("horaIn" => $time_in,
					           "horaSal" => $time_out);


				$respuesta = ModeloHorarios::mdlIngresarHorario($tabla, $datos);
				

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El rol ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "horario";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El rol no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "horario";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	MOSTRAR CATEGORIAS
	=============================================*/

	static public function ctrMostrarHorarios($item, $valor){

		$tabla = "horario";

		$respuesta = ModeloHorarios::mdlMostrarHorarios($tabla, $item, $valor);

		return $respuesta;
	
	}

	static public function ctrMostrarHorarioEmpleados($item, $valor){

		$tabla = "horario";

		$respuesta = ModeloHorarios::mdlMostrarHorarioEmpleados($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR CATEGORIA
	=============================================*/

	static public function ctrEditarHorario(){

		if(isset($_POST["editarHoraIn"])){

			// var_dump($_POST["editarRol"]);

			if(isset($_POST["editarHoraIn"])){

				$tabla = "horario";

				$time_in = $_POST["editarHoraIn"];

				$time_in = date('H:i:s', strtotime($time_in));

				$time_out = $_POST["editarHoraSal"];

				$time_out = date('H:i:s', strtotime($time_out));

				$datos = array("horaIn"=>$time_in,
								"horaSal"=>$time_out,
							   "idHorario"=>$_POST["idHorario"]);

				$respuesta = ModeloHorarios::mdlEditarHora($tabla, $datos);



				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El rol ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "horario";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El rol no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "horario";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR HORARIO
	=============================================*/

	static public function ctrBorrarHorario(){

		if(isset($_GET["idHora"])){

			$tabla ="horario";
			$datos = $_GET["idHora"];

			$respuesta = ModeloHorarios::mdlBorrarHorario($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "El Horario ha sido borrada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "horario";

									}
								})

					</script>';
			}
		}
		
	}
}
